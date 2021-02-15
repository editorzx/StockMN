	<?php
		include "controller/alert.php";
	?>
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
        <ul class="c-header-nav ml-auto mr-4">
			<!-- Message -->
			<li class="c-header-nav-item dropdown d-md-down-none mx-2"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<svg class="c-icon">
				<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
				</svg><span class="badge badge-pill badge-danger">4</span></a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
					<div class="dropdown-header bg-light"><strong>คุณมี 4 การจัดการต้องทำ </strong></div>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#minimumherbal_out">
						<div class="message">
							<div class="py-3 mfe-3 float-left">
								<div class="c-avatar">
									<img class="c-avatar-img" src="vendors/assets/img/avatars/1.png" alt="user@email.com">
									<span class="c-avatar-status bg-success"></span>
								</div>
							</div>
							<div>
								<small class="text-muted">Alert</small>
								<small class="text-muted float-right mt-1">Just now</small>
							</div>
							<div class="text-truncate font-weight-normal"><span class="text-danger">!</span> ยาสมุนไพรกำลังจะหมด</div>
							<div class="small text-muted text-truncate">มียาสมุนไพรหลายรายการกำลังจะหมดจากคลังเร็วๆนี้</div>
						</div>
					</a>
				</div>
			</li>
			<!-- Notification -->
			<!--
			<li class="c-header-nav-item dropdown d-md-down-none mx-2"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<svg class="c-icon">
				<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
				</svg><span class="badge badge-pill badge-danger">5</span></a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
					<div class="dropdown-header bg-light"><strong>You have 5 notifications</strong></div><a class="dropdown-item" href="#">
					<svg class="c-icon mfe-2 text-success">
					<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-follow"></use>
					</svg> New user registered</a><a class="dropdown-item" href="#">
					<svg class="c-icon mfe-2 text-danger">
					<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-unfollow"></use>
					</svg> User deleted</a><a class="dropdown-item" href="#">
					<svg class="c-icon mfe-2 text-info">
					<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart"></use>
					</svg> Sales report is ready</a><a class="dropdown-item" href="#">
					<svg class="c-icon mfe-2 text-success">
					<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-basket"></use>
					</svg> New client</a><a class="dropdown-item" href="#">
					<svg class="c-icon mfe-2 text-warning">
					<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
					</svg> Server overloaded</a>
					<div class="dropdown-header bg-light"><strong>Server</strong></div><a class="dropdown-item d-block" href="#">
					<div class="text-uppercase mb-1"><small><b>CPU Usage</b></small></div><span class="progress progress-xs">
					<div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</span><small class="text-muted">348 Processes. 1/4 Cores.</small>
					</a><a class="dropdown-item d-block" href="#">
					<div class="text-uppercase mb-1"><small><b>Memory Usage</b></small></div><span class="progress progress-xs">
					 <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
					</span><small class="text-muted">11444GB/16384MB</small>
					</a><a class="dropdown-item d-block" href="#">
					<div class="text-uppercase mb-1"><small><b>SSD 1 Usage</b></small></div><span class="progress progress-xs">
					<div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
					</span><small class="text-muted">243GB/256GB</small>
					</a>
				</div>
			</li>
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
					
					<div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
					<a class="dropdown-item" href="index?p=logout" onclick="return confirm('ต้องการออกจากระบบ?')">
						<svg class="c-icon mr-2">
						<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
						</svg> 
						Updates
						<span class="badge badge-danger ml-auto">42</span>
					</a>
				</div>
			</li>
        </ul>
    </header>