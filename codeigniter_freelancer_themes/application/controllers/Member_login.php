<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Member_login extends CRUD_Controller
{

	private $another_js;
	private $another_css;

    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
		
		$this->data['page_url'] = site_url('member_login');
		$this->data['page_title'] = 'PHP CI MANIA - LOGIN';
		
		
		$this->another_js = '<script src="'. base_url() .'assets/js/member_login.js"></script>';
    }
	
	//ปรับแต่งตาม Template ที่ใช้งาน
	protected function render_view($path)
	{
		$template_name = 'freelancer';
		
		$this->data['top_navbar'] = $this->parser->parse('template/'.$template_name.'/top_navbar_view', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('template/'.$template_name.'/left_sidebar_view', $this->left_sidebar_data, TRUE);
		$this->data['breadcrumb_list'] = $this->parser->parse('template/'.$template_name.'/breadcrumb_view', $this->breadcrumb_data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/'.$template_name.'/homepage_view', $this->data);
	}
    
    public function index($msg = NULL){
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'เข้าสู่ระบบ', 'class' => 'active', 'url' => '#'),
		);
		$this->render_view('member_login/login_view');  
    }
    
    public function process(){
        $frm = $this->form_validation;

        $frm->set_rules('input_username', 'ชื่อผู้ใช้งาน', 'trim|required');
        $frm->set_rules('input_password', 'รหัสผ่าน', 'trim|required');
      
        $frm->set_message('required', 'กรุณากรอก %s');

        if ($frm->run() == FALSE) {
            $message  = '';
            $message .= form_error('input_username');
            $message .= form_error('input_password');
            $data = array(
                    'is_successful' => false,
                    'message' => $message     
                );
        } else {
            // Load the model
            $this->load->model('Member_login_model');
            // Validate the user can login
            $result = $this->Member_login_model->validate();
            // Now we verify the result
            $data = array();
            if(! $result){
                $data['message'] = 'ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง.';
                $data['is_successful'] = false;
				$data['redirect_url'] = '';
            }else{
                $data['message'] = '';
                $data['is_successful'] = true;
				if($url = $this->session->userdata('after_login_redirect')){
					$data['redirect_url'] = $url;
				}
            }
        }
        echo json_encode($data);
    }

    public function destroy(){
		$data = array(
			'user_id' => '',
			'user_prefix_name' => '',
			'user_fullname' => '',
			'user_lastname' => '',
			'user_email' => '',
			'user_level' => '',
			'user_department_id' => '',
			'login_validated' => FALSE
		);
		$this->session->set_userdata($data);
		
        redirect($this->session->userdata('after_login_redirect'));
    }

}
?>