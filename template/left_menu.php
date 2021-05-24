<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-sidebar-brand d-lg-down-none">
			<?php echo WEB_NAME;?>
      </div>
      <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
			<a class="c-sidebar-nav-link" href="index">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home"></use>
            </svg> 
				หน้าแรก
			<span class="badge badge-danger">HOME</span>
			</a>
		</li>
		<li class="c-sidebar-nav-divider"></li>
		<?php if($_SESSION['admin']) { ?>
		<li class="c-sidebar-nav-title"><?php echo IS_ADMIN; ?></li>
		<li class="c-sidebar-nav-item">
			<a class="c-sidebar-nav-link" href="#" data-toggle="modal" data-target="#webSetting_modal">
				<svg class="c-sidebar-nav-icon">
				  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
				</svg> 
				ตั้งค่าระบบ
			</a>
		</li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
			<a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-info"></use>
            </svg> <?php echo MENUHEAD; ?>
			</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<?php 
				foreach (MENU_MANAGEMENT as &$value) 
				{
				?>
					<li class="c-sidebar-nav-item">
						<a class="c-sidebar-nav-link" href="index?p=<?php echo $value[1]; ?>">
							 <?php echo $value[0]; ?>
						</a>
					</li>
				<?php
				}
				?>
			</ul>
        </li>
		<?php } ?>
        <li class="c-sidebar-nav-title"><?php echo IS_MEDIC;?></li>
		<li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
			<a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
            </svg> <?php echo MENUHEAD2; ?>
			</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<?php 
				foreach (MENU_MANAGEMENT2 as &$value) 
				{
					if(is_array($value[1])){
				?>
				<li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
					<a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
						<svg class="c-sidebar-nav-icon">
						  <use xlink:href="vendors/@coreui/icons/svg/free.svg#<?php echo $value[2]; ?>"></use>
						</svg> 
						<?php echo $value[0]; ?>
					</a>
					<ul class="c-sidebar-nav-dropdown-items">
					<?php 
						foreach ($value[1] as &$submenu) 
						{
					?>
							<li class="c-sidebar-nav-item">
								<a class="c-sidebar-nav-link" href="index?p=<?php echo $submenu[1]; ?>">
									 <?php echo $submenu[0]; ?>
								</a>
							</li>
					<?php
						}
					?>
					</ul>
				</li>
				<?php
					}else{
				?>
					<li class="c-sidebar-nav-item">
						<a class="c-sidebar-nav-link" href="index?p=<?php echo $value[1]; ?>">
							<svg class="c-sidebar-nav-icon">
							  <use xlink:href="vendors/@coreui/icons/svg/free.svg#<?php echo $value[2]; ?>"></use>
							</svg> 
							<?php echo $value[0]; ?>
						</a>
					</li>
				<?php
					}
				}
				?>
			</ul>
        </li>
       <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
			<a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-view-module"></use>
            </svg> <?php echo MENUHEAD3; ?>
			</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<?php 
				foreach (MENU_MANAGEMENT3 as &$value) 
				{
					if(is_array($value[1])){
				?>
				<li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
					<a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
						<svg class="c-sidebar-nav-icon">
						  <use xlink:href="vendors/@coreui/icons/svg/free.svg#<?php echo $value[2]; ?>"></use>
						</svg> 
						<?php echo $value[0]; ?>
					</a>
					<ul class="c-sidebar-nav-dropdown-items">
					<?php 
						foreach ($value[1] as &$submenu) 
						{
					?>
							<li class="c-sidebar-nav-item">
								<a class="c-sidebar-nav-link" href="index?p=<?php echo $submenu[1]; ?>">
									 <?php echo $submenu[0]; ?>
								</a>
							</li>
					<?php
						}
					?>
					</ul>
				</li>
				<?php
					}else{
				?>
					<li class="c-sidebar-nav-item">
						<a class="c-sidebar-nav-link" href="index?p=<?php echo $value[1]; ?>">
							<svg class="c-sidebar-nav-icon">
							  <use xlink:href="vendors/@coreui/icons/svg/free.svg#<?php echo $value[2]; ?>"></use>
							</svg> 
							<?php echo $value[0]; ?>
						</a>
					</li>
				<?php
					}
				}
				?>
			</ul>
        </li>
		
		 <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
			<a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-print"></use>
            </svg> <?php echo MENUHEAD4; ?>
			</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<?php 
				foreach (MENU_MANAGEMENT4 as &$value) 
				{
					if(is_array($value[1])){
				?>
				<li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
					<a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
						<svg class="c-sidebar-nav-icon">
						  <use xlink:href="vendors/@coreui/icons/svg/free.svg#<?php echo $value[2]; ?>"></use>
						</svg> 
						<?php echo $value[0]; ?>
					</a>
					<ul class="c-sidebar-nav-dropdown-items">
					<?php 
						foreach ($value[1] as &$submenu) 
						{
					?>
							<li class="c-sidebar-nav-item">
								<a class="c-sidebar-nav-link" href="index?p=<?php echo $submenu[1]; ?>">
									 <?php echo $submenu[0]; ?>
								</a>
							</li>
					<?php
						}
					?>
					</ul>
				</li>
				<?php
					}else{
				?>
					<li class="c-sidebar-nav-item">
						<a class="c-sidebar-nav-link" href="index?p=<?php echo $value[1]; ?>">
							<svg class="c-sidebar-nav-icon">
							  <use xlink:href="vendors/@coreui/icons/svg/free.svg#<?php echo $value[2]; ?>"></use>
							</svg> 
							<?php echo $value[0]; ?>
						</a>
					</li>
				<?php
					}
				}
				?>
			</ul>
        </li>
		
		
				
        <!--
        <li class="c-sidebar-nav-item mt-auto">
			<a class="c-sidebar-nav-link c-sidebar-nav-link-danger" href="index?p=logout" onclick="return confirm('ต้องการออกจากระบบ?')">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
            </svg>
			<strong> <?php echo MENU_LOGOUT; ?></strong>
			</a>
		</li>
		-->
      </ul>
	  
    </div>
	