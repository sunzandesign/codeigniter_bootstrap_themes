
var Members = {

	current_page : 0,

	confirmDelete: function (pUserid,  irow){
		$('[name="encrypt_userid"]').val(pUserid);

		$('#xrow').text(irow);
		var my_thead = $('#row_' + irow).closest('table').find('th:not(:first-child):not(:last-child)');
		var th = [];
		my_thead.each (function(index) {
			th.push($(this).text());
		});
		
		var active_row = $('#row_' + irow).find('td:not(:first-child):not(:last-child)');
		var detail = '<table class="table table-striped">';
		active_row.each (function(index) {
				detail += '<tr><td align="right"><b>' + th[index] + ' : </b></td><td> ' + $(this).text() + '</td></tr>';
		});
		detail += '</table>';
		$('#div_del_detail').html(detail);

		$('#confirmDelModal').modal('show');
	},
    
	// delete by ajax jquery 
	deleteRecord: function(){
		var frm_action = site_url('member_manage/del'); 
		var fdata = $('#formDelete').serialize();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		var obj = $('#btn_confirm_delete');
		loading_on(obj);
		$.ajax({
			method: 'POST',
			url: frm_action,
			dataType: 'json',
			data : fdata,
			success: function (results) {
				if(results.is_successful){
					alert_type = 'success';
					setTimeout(function(){ 
						$(window.location).attr('href', site_url('member_manage/index/'+ this.current_page));
					}, 500);
				}else{
					alert_type = 'danger';
				}
				notify('ลบรายการ', results.message, alert_type, 'center');
				loading_on_remove(obj);
			},
				error : function(jqXHR, exception){
				loading_on_remove(obj);
				ajaxErrorMessage(jqXHR, exception);
			}
		});
	},

	// load preview to modal 
	loadPreview: function(id){ 
		$.ajax({
			method: 'GET',
			url: site_url('member_manage/preview/'+ id),
			success: function (results) {
				$('#divPreview').html(results);
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
			}
		});
		$('#modalPreview').modal('show');
	},
	
	validateFormEdit: function(){
		if($('#edit_remark').val().length < 5){
				notify('กรุณาระบุเหตุผล', 'เหตุผลการแก้ไขจะต้องระบุให้ชัดเจน', 'warning', 'center', 'bottom');
		}else{
				this.saveEditForm();
		}
		return false;
	},

	saveFormData: function(){
		var frm_action = site_url('member_manage/save');
		var fdata = $('#formAdd').serialize();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);

		var obj = $('#btnConfirmSave');
		loading_on(obj);		
		$.ajax({
			method: 'POST',
			url: frm_action,
			dataType: 'json',
			data : fdata,
			success: function (results) {
				if(results.is_successful){
					alert_type = 'success';
					$('#formAdd')[0].reset();
				}else{
					alert_type = 'danger';
				}
					notify('เพิ่มข้อมูล', results.message, alert_type, 'center');
					loading_on_remove(obj);
				},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
					loading_on_remove(obj);
			}
		});
	},

	saveEditForm: function(){
		$('#editModal').modal('hide');
		var frm_action = site_url('member_manage/update');
		var fdata = $('#formEdit').serialize();
		fdata += '&edit_remark=' + $('#edit_remark').val();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);

		var obj = $('#btnSaveEdit');
		loading_on(obj);
		$.ajax({
			method: 'POST',
			url: frm_action,
			dataType: 'json',
			data : fdata,
			success: function (results) {
				if(results.is_successful){
					alert_type = 'success';
				}else{
					alert_type = 'danger';
				}
				notify('บันทึกข้อมูล', results.message, alert_type, 'center');
				loading_on_remove(obj);
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
				loading_on_remove(obj);
			}
		});
	},
	
	passwordReset : function(){
		var new_pass1, new_pass2, reset_pass_remark, err_message;
		new_pass1 = $('#password1').val();
		new_pass2 = $('#password2').val();
		reset_pass_remark = $('#reset_pass_remark').val();
		err_message = '';
		if(new_pass1 == ''){
			err_message += '<br/>- กรุณาป้อนรหัสผ่าน';
		}
		if(new_pass2.length < 6){
			err_message += '<br/>- รหัสผ่านอย่างน้อย 6 ตัวอักษรขึ้นไป';
		}
		if(new_pass1 != new_pass2){
			err_message += '<br/>- กรุณายืนยันรหัสผ่านให้ตรงกัน';
		}
		if(reset_pass_remark == ''){
			err_message += '<br/>- กรุณาระบุเหตุผล';
		}
		
		if(err_message != ''){
			notify("ตรวจสอบข้อมูล", err_message, 'danger', 'center');
			return false;
		}

		var frm_action = site_url('member_manage/reset_password');
		var fdata = $('#formResetMemberPass').serialize();
		fdata += '&encrypt_userid=' + $('[name=encrypt_userid]').val();
		fdata += '&edit_remark=' + $('#reset_pass_remark').val();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		var obj = $('#btn_reset_pass');
		loading_on(obj);
		$.ajax({
			method: 'POST',
			url: frm_action,
			dataType: 'json',
			data : fdata,
			success: function (results) {
				if(results.is_successful){
					alert_type = 'success';
				}else{
					alert_type = 'danger';
				}
				notify('เปลี่ยนแปลงรหัสผ่าน', results.message, alert_type, 'center');
				loading_on_remove(obj);
				$('#formResetMemberPass button').button('reset');
				$('#modal_reset_member_pass').modal('hide');				
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
				loading_on_remove(obj);
			}
		});
	},
	
	enablePasswordReset : function(){
		$('#password').attr('readonly', false).select();
		$('#password').data('old-pass', $('#password').val());
	},
	
	disablePasswordReset : function(){
		$('#password').attr('readonly', true);
		$('#password').val($('#password').data('old-pass'));
	}
}

$(document).ready(function() {
	
	$(document).on('change','#set_order_by',function(){
		$('input[name="order_by"]').val($(this).val());
		$('button[name="submit"]').click();
	});
	
	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);
	
	$('#btnSave').click(function() {            
		$('#addModal').modal('hide');
		Members.saveFormData();
		return false;            
	});//click

	$('#btnSaveEdit').click(function() {            
		return Members.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		Members.current_page = Math.abs(param_current_page);
	}

	$('.btn-delete-row').click(function() {
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pUserid = $(this).attr('data-userid');

		Members.confirmDelete(pUserid,  row_num);
	});//click

	$('#btn_confirm_delete').click(function(){
		Members.deleteRecord();
	});
	
	$('#chk_reset_pass').click(function(){
		if ($(this).is(':checked')) {
			Members.enablePasswordReset();
		}else{
			Members.disablePasswordReset();
		}
	});
	
	$('#btn_reset_pass').click(function(){
		Members.passwordReset();
	});

	/*
	$('#department_id').select2({
		dropdownAutoWidth : true,
		width: 'auto'
	});
	var department_id = $('#department_id').attr('value');
	$('#department_id').val('').val(department_id).trigger('change');
	*/
	setDropdownList('#department_id');
	
	/*
	$('#level').select2({
		dropdownAutoWidth : true,
		width: 'auto'
	});
	var level = $('#level').attr('value');
	$('#level').val('').val(level).trigger('change');
	*/
	setDropdownList('#level');
	
	setDropdownList('#void');
});//ready