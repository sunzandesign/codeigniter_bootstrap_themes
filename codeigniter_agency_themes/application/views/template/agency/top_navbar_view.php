<!-- Navbar -->
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#team">Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
        
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link {login_inactive_class}" href="{site_url}/member_login" >
				<i class="fas fa-user-circle fa-fw"></i>
			</a>
			
			<a class="nav-link dropdown-toggle {login_active_class}" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-user-circle fa-fw"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right {login_active_class}" aria-labelledby="userDropdown">
				<a class="dropdown-item">{user_prefix_name} {user_fullname} {user_lastname}</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{site_url}/member_profile">ข้อมูลสมาชิก</a>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_change_pass">เปลี่ยนรหัสผ่าน</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
				
				
				
			</div>
		</li>
	</ul>
</div>