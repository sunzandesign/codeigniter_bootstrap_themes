<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">


	<title>Stylish Portfolio - Start Bootstrap Template</title>

	<!-- Bootstrap Core CSS -->
	<link href="{base_url}assets/themes/stylish-portfolio/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="{base_url}assets/themes/stylish-portfolio/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="{base_url}assets/themes/stylish-portfolio/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="{base_url}assets/themes/stylish-portfolio/css/stylish-portfolio.min.css" rel="stylesheet">
	
	 <!-- Require -->
	<link href="{base_url}assets/bootstrap_extras/select2/select2.css" rel="stylesheet">
	<link href="{base_url}assets/css/jquery-ui.min.css" rel="stylesheet">

	{another_css}
	
	<style>
	div[data-notify="container"]{
		z-index : 3000!important;
	}

	#exampleAccordion{
		overflow-y: auto;
		overflow-x: hidden;
	}

	.content-wrapper{
		overflow-x: auto;
	}

	.card .bg-primary .card-title {
		color: white;
	}

	div.alert span[data-notify="message"] p{
		margin-bottom: 0px !important;
	}

	.upload-box .btn-file {
	        background-color: #22b5c0;
	}
	.upload-box .hold {
	    float: left;
	    width: 100%;
	    position: relative;
	    border: 1px solid #ccc;
	    border-radius: 3px;
	    padding: 4px;
	}
	.upload-box .hold span {
	    font: 400 14px/36px 'Roboto',sans-serif;
	    color: #666;
	    text-decoration: none;
	}

	.upload-box .btn-file {
	    position: relative;
	    overflow: hidden;
	    float: left;
	    padding: 2px 10px;
	    font: 900 14px/14px 'Roboto',sans-serif;
	    color: #fff !important;
	    margin: 0 10px 0 0;
	    text-transform: uppercase;
	    border-radius: 3px;
	    cursor: pointer;
	}
	.upload-box .btn-file input[type=file] {
	    position: absolute;
	    top: 0;
	    right: 0;
	    min-width: 100%;
	    min-height: 100%;
	    font-size: 100px;
	    text-align: right;
	    opacity: 0;
	    outline: none;
	    background: #fd0707;
	    cursor: inherit;
	    display: block;
	}
	
	.div_file_preview {
		background-color: #fefcfc;
		border: 1px dashed #ccc;
	}
	
	.navbar-nav .nav-item .nav-link .badge{
		margin-left: -0.3rem;
	}
	</style>

	<script>
		var baseURL = '{base_url}/';
		var siteURL = '{site_url}/';
		var csrf_token_name = '{csrf_token_name}';
		var csrf_cookie_name = '{csrf_cookie_name}';
	</script>
</head>
<body id="page-top">

	<!-- Navigation -->
	<!-- Navigation -->
	<a class="menu-toggle rounded" href="#">
		<i class="fas fa-bars"></i>
	</a>
	<nav id="sidebar-wrapper">

		<!-- Navbar -->
		{left_sidebar}
    </nav>

	<!-- Page Content -->
	{page_content}
	

	<!-- Footer -->
  <footer class="footer text-center">
    <div class="container">
      <ul class="list-inline mb-5">
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white mr-3" href="#">
            <i class="icon-social-facebook"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white mr-3" href="#">
            <i class="icon-social-twitter"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white" href="#">
            <i class="icon-social-github"></i>
          </a>
        </li>
      </ul>
      <p class="text-muted small mb-0">Copyright &copy; Your Website 2019</p>
    </div>
  </footer>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
	  


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">คลิกปุ่ม "Logout" เพื่อสิ้นสุดการทำงาน.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{site_url}/member_login/destroy">Logout</a>
                </div>
            </div>
        </div>
    </div>
	
	
	<!-- Change Password Modal-->
	<div class="modal fade" id="modal_change_pass" tabindex="-1" role="dialog" 
		aria-labelledby="modal_change_pass_Label" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title" id="modal_change_pass_Label">เปลี่ยนรหัสผ่าน</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					
				</div> <!-- /.modal-header -->

				<div class="modal-body">
					<form role="form" id="formChangePass">
						<div class="form-group">
							<div class="input-group">
								<input class="form-control" id="resetPassword1" name="resetPassword1" placeholder="รหัสผ่านใหม่" type="password">
								<label for="resetPassword1" class="input-group-addon glyphicon glyphicon-lock new"></label>
							</div>
						</div> <!-- /.form-group -->

						<div class="form-group">
							<div class="input-group">
								<input class="form-control" id="resetPassword2" name="resetPassword2" placeholder="ยืนยันรหัสผ่านใหม่อีกครั้ง" type="password">
								<label for="resetPassword2" class="input-group-addon glyphicon glyphicon-lock new"></label>
							</div> <!-- /.input-group -->
						</div> <!-- /.form-group -->

						<div class="form-group">
							<div class="input-group">
								<input class="form-control" id="uPasswordOld" name="uPasswordOld" placeholder="รหัสผ่านเดิม" type="password">
								<label for="uPasswordOld" class="input-group-addon glyphicon glyphicon-lock"></label>
							</div> <!-- /.input-group -->
						</div> <!-- /.form-group -->

					</form>

				</div> <!-- /.modal-body -->

				<div class="modal-footer">
					<button id="btn_change_pass" class="form-control btn btn-primary">Ok</button>

					<div class="progress">
						<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="100" style="width: 0%;">
							<span class="sr-only">progress</span>
						</div>
					</div>
				</div> <!-- /.modal-footer -->

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<!-- Bootstrap core JavaScript -->
	<script src="{base_url}assets/themes/stylish-portfolio/vendor/jquery/jquery.min.js"></script>
	<script src="{base_url}assets/themes/stylish-portfolio/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Plugin JavaScript -->
	<script src="{base_url}assets/themes/stylish-portfolio/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for this template -->
	<script src="{base_url}assets/themes/stylish-portfolio/js/stylish-portfolio.min.js"></script>


    <!-- Require -->
    <script src="{base_url}assets/js/jquery-ui.min.js"></script>
    <script src="{base_url}assets/bootstrap_extras/bootstrap-notify.min.js"></script>
	<script src="{base_url}assets/bootstrap_extras/select2/select2.min.js"></script>
    <script src="{base_url}assets/js/jquery.cookie.min.js"></script>
    <script src="{base_url}assets/js/ci_utilities.js?ver=1541805506"></script>

	<script src="{base_url}assets/js/member_reset_pass.js"></script>
	{another_js}
</body>
</html>