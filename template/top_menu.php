<header class="c-header  c-header-light c-header-fixed c-header-with-subheader">
        <!-- Responsive Button-->
		<button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
          <svg class="c-icon c-icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button>
		<a class="c-header-brand d-lg-none" href="#">
          <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui.svg#full"></use>
          </svg>
		  </a>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
          <svg class="c-icon c-icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button>
		 <!-- Responsive Button-->
        <ul class="c-header-nav ml-auto mr-4">
         
		<!-- <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
              <svg class="c-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
              </svg></a></li>
          <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
              <svg class="c-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
              </svg></a></li>
          <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
              <svg class="c-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
              </svg></a></li>
			  -->
          <li class="c-header-nav-item dropdown">
				<a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				  <div class="c-avatar"><img class="c-avatar-img" src="./vendors/assets/img/avatars/1.png"></div>
				</a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
				<div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
				<span class="dropdown-item">
					 <?php 
						$result_officer = $functions->GetOfficerStatusByToken($_SESSION['token']);
						echo $result_officer['result']['Officer_Name'] . " " . $result_officer['result']['Officer_Lastname'];
					 ?>
				</span>
				<div class="dropdown-divider"></div>
				<span class="dropdown-item">
					 <?php 
						echo $result_officer['result']['Last_Login'];
					 ?>
				</span>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="index?p=logout" onclick="return confirm('ต้องการออกจากระบบ?')">
					<svg class="c-icon mr-2">
					  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
					</svg>  <?php echo MENU_LOGOUT; ?>
				</a>

             <!-- <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg> Profile</a><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                </svg> Settings</a><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
                </svg> Payments<span class="badge badge-secondary ml-auto">42</span></a><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                </svg> Projects<span class="badge badge-primary ml-auto">42</span></a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                </svg> Lock Account</a><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                </svg> Logout</a>-->
            </div>
          </li>
		  
        </ul>
      </header>