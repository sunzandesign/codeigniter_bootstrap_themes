<!DOCTYPE html>
<html lang="en">
	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>SB Admin 2 - Dashboard</title>
		
		<!-- Custom fonts for this template-->
		<link href="{base_url}assets/themes/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		
		<!-- Require -->
		<link href="{base_url}assets/bootstrap_extras/select2/select2.css" rel="stylesheet">
		<link href="{base_url}assets/css/jquery-ui.min.css" rel="stylesheet">
		
		<!-- Custom styles for this template -->
		<link href="{base_url}assets/themes/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">
		
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
	
		<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

		  <!-- Sidebar - Brand -->
		  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
			<div class="sidebar-brand-icon rotate-n-15">
			  <i class="fas fa-laugh-wink"></i>
			</div>
			<div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
		  </a>

		  <!-- Divider -->
		  <hr class="sidebar-divider my-0">

		  {left_sidebar}

		</ul>
		<!-- End of Sidebar -->
		
		

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
		
			<!-- Main Content -->
			<div id="content">
			
				{top_navbar}
				
				{page_content}
		
			</div>
			<!-- End of Main Content -->
			
			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
				  <div class="copyright text-center my-auto">
					<span>Copyright &copy; Your Website 2019</span>
				  </div>
				</div>
			</footer>
		  <!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	


	</div>
	<!-- End of Page Wrapper -->
		
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
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
					<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<a class="btn btn-primary" href="login.html">Logout</a>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Bootstrap core JavaScript-->
		<script src="{base_url}assets/themes/sb-admin-2/vendor/jquery/jquery.min.js"></script>
		<script src="{base_url}assets/themes/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		
		<!-- Core plugin JavaScript-->
		<script src="{base_url}assets/themes/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"></script>
		
		<!-- Custom scripts for all pages-->
		<script src="{base_url}assets/themes/sb-admin-2/js/sb-admin-2.min.js"></script>
		
		<!-- Page level plugins -->
		<script src="{base_url}assets/themes/sb-admin-2/vendor/chart.js/Chart.min.js"></script>
		
		<!-- Page level custom scripts -->
		<script src="{base_url}assets/themes/sb-admin-2/js/demo/chart-area-demo.js"></script>
		<script src="{base_url}assets/themes/sb-admin-2/js/demo/chart-pie-demo.js"></script>
		
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