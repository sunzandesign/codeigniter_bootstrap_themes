
function LogIn(){
    var pUrl = site_url('member_login/process');
    var data = $('#frm_login').serialize();
	data += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
	//Loading
	loading_on($('#btn_login'));
	
    $.ajax({
        method: "POST",
        url: pUrl,
        dataType: "json",
        data : data,
        success: function (results) { 
            if(results.is_successful == true){
				if(results.redirect_url){
					window.location = results.redirect_url;
				}else{
					window.location = site_url();
				}
            }else{
				notify('แจ้งเตือน', results.message, 'danger', 'right');
				
				loading_on_remove($('#btn_login'));
            }
        }
    });
	return false;
}