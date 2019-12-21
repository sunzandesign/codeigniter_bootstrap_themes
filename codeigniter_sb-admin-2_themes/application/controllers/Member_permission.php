<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Members_permission.php ]
 */
class Member_permission extends CRUD_Controller 
{

	private $another_js;
	private $another_css;
	private $tbMember;
	
	public function __construct()
	{
		parent::__construct();
		$this->per_page = 30;
		$this->num_links = 6;
		$this->uri_segment = 4;
		$this->load->model('Member_profile_model', 'Member_profile');
		$this->load->model('Member_login_model', 'Login_model');
		
		$this->tbMember = 'tb_members';

		$this->data['page_url'] = site_url('member_manage');
		$this->data['page_title'] = 'PHP CI MANIA - LOGIN';
		
	}
	
	protected function render_view($path)
	{
		$template_name = 'sb-admin-2';
		
		$this->data['top_navbar'] = $this->parser->parse('template/'.$template_name.'/top_navbar_view', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('template/'.$template_name.'/left_sidebar_view', $this->left_sidebar_data, TRUE);
		$this->data['breadcrumb_list'] = $this->parser->parse('template/'.$template_name.'/breadcrumb_view', $this->breadcrumb_data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		
		$this->parser->parse('template/'.$template_name.'/homepage_view', $this->data);
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->list_all();
	}

	/**
	 * Set up pagination config
	 * @param String path of controller
	 * @param Integer total record
	 */
	public function create_pagination($page_url, $total) {
		$this->load->library('pagination');
		$config['base_url'] = $page_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $this->per_page;
		$config['num_links'] = $this->num_links;
		$config['uri_segment'] = $this->uri_segment;
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	// ------------------------------------------------------------------------

	/**
	 * List all record 
	 */
	public function list_all() {
		$this->session->unset_userdata($this->Member_profile->session_name . '_search_field');
		$this->session->unset_userdata($this->Member_profile->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'รายชื่อสมาชิก', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field');
			$value = $this->input->post('txtSearch');
			$arr = array($this->Member_profile->session_name . '_search_field' => $search_field, $this->Member_profile->session_name . '_value' => $value );
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Member_profile->session_name . '_search_field');
			$value = $this->session->userdata($this->Member_profile->session_name . '_value');
		}

		$start_row = $this->uri->segment(4 ,'0');
		if(!is_numeric($start_row)){
			$start_row = 0;
		}
		
		$per_page = $this->per_page;
		$results = $this->Member_profile->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataFormat($results['list_data'], $start_row);

		$page_url = site_url('member_manage');
		$pagination = $this->create_pagination($page_url.'/index', $search_row);
		$end_row = $start_row + $per_page;
		if($search_row < $per_page){
			$end_row = $search_row;
		}

		$this->data['recData']	= $list_data;
		$this->data['search_field']	= $search_field;
		$this->data['txt_search']	= $value;
		$this->data['current_page_offset'] = $start_row;
		$this->data['start_row']	= $start_row + 1;
		$this->data['end_row']	= $end_row;
		$this->data['total_row']	= $total_row;
		$this->data['search_row']	= $search_row;
		$this->data['page_url']	= $page_url;
		$this->data['pagination_link']	= $pagination;
		$this->data['csrf_protection']	= insert_csrf_field(true);

		$this->render_view('member_manage/list_view');
	}

	/**
	 * Get title from level value
	 */
	private function setLevel($value)
	{
		return $this->Member_profile->getValueOf('tb_members_level', 'level_title', "level_value = $value");
	}

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'รายชื่อสมาชิก', 'url' => site_url('member_manage')),
						array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('message/warning');
		} else {
			$results = $this->Member_profile->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('message/danger');
			} else {
				$this->data['master_data'] = $this->setPreviewFormat($results);
				$this->render_view('member_manage/preview_view');
			}
		}
	}


	// ------------------------------------------------------------------------
	/**
	 * Add form
	 */
	public function add()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Members', 'url' => site_url('member_manage')),
						array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);
		$this->data['department_option_list'] = optionList("tb_department", "dpm_id", "dpm_name", array('return'=>true), $this->db);
		$this->render_view('member_manage/add_view'); 
	}

	// ------------------------------------------------------------------------

	/**
	 * Default Validation
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidate($case='')
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;
		if($case == 'insert'){
			$frm->set_rules('username', 'ชื่อผู้ใช้งาน', 'trim|required');
			$frm->set_rules('password', 'รหัสผ่าน', 'trim|required');
		}
		$frm->set_rules('level', 'สิทธิ์การใช้งาน', 'trim|required|is_natural');
		$frm->set_rules('email', 'อีเมล', 'trim|required');
		$frm->set_rules('tel_number', 'เบอร์โทรศัพท์', 'trim|required');
		$frm->set_rules('line_id', 'ไอดี Line', 'trim|required');
		$frm->set_rules('prefix_name', 'คำนำหน้าชื่อ', 'trim|required');
		$frm->set_rules('fullname', 'ชื่อ', 'trim|required');
		$frm->set_rules('lastname', 'นามสกุล', 'trim|required');
		$frm->set_rules('department_id', 'ไอดีหน่วยงาน', 'trim|required|is_natural');

		$frm->set_message('required', 'กรุณากรอก %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			if($case == 'insert'){
				$message .= form_error('username');
				$message .= form_error('password');
			}
			$message .= form_error('level');
			$message .= form_error('email');
			$message .= form_error('tel_number');
			$message .= form_error('line_id');
			$message .= form_error('prefix_name');
			$message .= form_error('fullname');
			$message .= form_error('lastname');
			$message .= form_error('department_id');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Create new record
	 */
	public function save()
	{

		if ($message = $this->formValidate()) {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message
			));
			echo $json;
		} else {
			$post = $this->input->post(NULL, TRUE);

			$id = $this->Member_profile->create($post);
			if($id !== false){
				$encrypt_id = encrypt($id);

				$json = json_encode(array(
							'is_successful' => TRUE,
							'encrypt_id' =>  $encrypt_id,
							'message' => '<strong>บันทึกข้อมูลเรียบร้อย</strong>'
				));
			}else{
				$json = json_encode(array(
							'is_successful' => FALSE,
							'message' => $this->Member_profile->error_message
				));
			}
			echo $json;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Load data to form
	 * @param String encrypt id
	 */
	public function edit($encrypt_id = '')
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'รายชื่อสมาชิก', 'url' => site_url('member_manage')),
						array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('message/warning');
		} else {
			$results = $this->Member_profile->load($id);
			if (empty($results)) {
			$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);
				$this->data['master_data'] = $this->setPreviewFormat($results);
				$this->data['department_option_list'] = optionList("tb_department", "dpm_id", "dpm_name", array('return'=>true), $this->db);
				$this->render_view('member_manage/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$userid = checkEncryptData($data['encrypt_userid']);
		if($userid==''){
			$error .= '- รหัส userid';
		}
		return $error;
	}

	/**
	 * Update Record
	 */
	public function update()
	{
		$message = $this->formValidate();
		$edit_remark = $this->input->post('edit_remark', TRUE);
		if ($edit_remark == '') {
			$message .= 'ระบุเหตุผล';
		}
		
		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "รหัสอ้างอิงที่ใช้สำหรับอัพเดตข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message
			));
			 echo $json;
		} else {

			$result = $this->Member_profile->update($post);
			if($result == false){
				$message = $this->Member_profile->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Member_profile->error_message;
				$ok = TRUE;
			}
			$json = json_encode(array(
						'is_successful' => $ok,
						'message' => $message
			));

			echo $json;
		}
	}

	/**
	 * Delete Record
	 */
	public function del()
	{
		$delete_remark = $this->input->post('delete_remark', TRUE);
			$message = '';
		if ($delete_remark == '') {
			$message .= 'ระบุเหตุผล';
		}
		
		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "รหัสอ้างอิงที่ใช้สำหรับลบข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message    
			));
			echo $json;
		}else{
			$result = $this->Member_profile->delete($post);
			if($result == false){
				$message = $this->Member_profile->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>ลบข้อมูลเรียบร้อย</strong>';
				$ok = TRUE;
			}
			$json = json_encode(array(
						'is_successful' => $ok,
						'message' => $message
			));
			echo $json;
		}
	}


	/**
	 * SET array data list
	 */
	private function setDataFormat($lists_data, $start_row=0)
	{
		$data = $lists_data;
		$count = count($lists_data);
		for($i=0;$i<$count;$i++){
			$start_row++;
			$data[$i]['record_number'] = $start_row;
			$pk1 = $data[$i]['userid'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if($pk1 != ''){
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_userid'] = $pk1;
			$data[$i]['create_date'] = setThaiDate($data[$i]['create_date']);
			$data[$i]['modify_date'] = setThaiDate($data[$i]['modify_date']);
			
			$count_pass = strlen($data[$i]['password']);
			$data[$i]['password'] = str_repeat('*', $count_pass);
			$data[$i]['level_text'] = $this->setLevel($data[$i]['level']);
		}
		return $data;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($lists_data)
	{
		$data = $lists_data;
		$pk1 = $data['userid'];
		$data['url_encrypt_id'] = urlencode(encrypt($pk1));

		if($pk1 != ''){
			$pk1 = encrypt($pk1);
		}
		$data['encrypt_userid'] = $pk1;

		$departmentIdDepartmentName = $this->Member_profile->getValueOf('tb_department', 'dpm_name', "dpm_id = '$data[department_id]'");
		$data['departmentIdDepartmentName'] = $departmentIdDepartmentName;

		$titleRow = $this->Member_profile->getRowOf('tb_members', 'fullname, lastname', "userid = '$data[create_user_id]'", $this->db);
		$createUserIdFullname = $titleRow['fullname'];
		$createUserIdLastname = $titleRow['lastname'];
		$data['createUserIdFullname'] = $createUserIdFullname;
		$data['createUserIdLastname'] = $createUserIdLastname;


		$titleRow = $this->Member_profile->getRowOf('tb_members', 'fullname, lastname', "userid = '$data[modify_user_id]'", $this->db);
		$modifyUserIdFullname = $titleRow['fullname'];
		$modifyUserIdLastname = $titleRow['lastname'];
		$data['modifyUserIdFullname'] = $modifyUserIdFullname;
		$data['modifyUserIdLastname'] = $modifyUserIdLastname;

		$data['create_date'] = setThaiDate($data['create_date']);
		$data['modify_date'] = setThaiDate($data['modify_date']);
		
		$count_pass = strlen($data['password']);
		$data['password'] = str_repeat('*', $count_pass);
		$data['level_text'] = $this->setLevel($data['level']);

		return array('master' => $data);
	}
	
	public function reset_password()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('password1', 'รหัสผ่านใหม่', 'trim|required');
		$frm->set_rules('password2', 'ยืนยันรหัสผ่านใหม่', 'trim|required');
		$frm->set_rules('encrypt_userid', 'รหัสสมาชิกที่ต้องการเปลี่ยนแปลง', 'trim|required');

		$frm->set_message('required', 'กรุณากรอก %s');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('password1');
			$message .= form_error('password2');
			$message .= form_error('encrypt_userid');
			$json = json_encode(array(
			  'is_successful' => FALSE,
			  'message' => $message
			));
			echo $json;
		} else {
			$post = $this->input->post(NULL, TRUE);

			if($post['password1'] != $post['password2']){
				echo json_encode(array(
				  'is_successful' => FALSE,
				  'message' => 'กรุณายืนยันรหัสผ่านให้ตรงกัน'
				));
				return;
			}
			
			$member_id = checkEncryptData($post['encrypt_userid']);
			if($member_id == ''){
				echo json_encode(array(
				  'is_successful' => FALSE,
				  'message' => 'ไม่พบรหัสสมาชิกที่ต้องการเปลี่ยนแปลง <b>' . $post['encrypt_userid'] . '</b> เป็นรหัสสมาชิกที่ไม่ถูกต้อง'
				));
				return;
			}

			$result = $this->Member_profile->reset_password($member_id, $post);
			if($result){
			  $json = array(
				  'is_successful' => TRUE,
				  'message' => '<strong>บันทึกข้อมูลเรียบร้อย</strong>'
			  );
			}else{
			  $json = array(
				  'is_successful' => FALSE,
				  'message' => $this->Member_profile->error_message
			  );
			}
			echo json_encode($json);
		}
	}
	
}
/*---------------------------- END Controller Class --------------------------------*/
