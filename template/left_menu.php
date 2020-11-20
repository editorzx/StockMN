<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-sidebar-brand d-lg-down-none">
        KDXR PANEL
      </div>
      <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
			<a class="c-sidebar-nav-link" href="index.php">
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
			$ix = 0;
			foreach (MENU_MANAGEMENT2 as &$value) 
			{
				if($ix == 3){ echo "<li class=\"c-sidebar-nav-divider\"></li>"; $ix = 0;}
			?>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="index?p=<?php echo $value[1]; ?>">
						 <?php echo $value[0]; ?>
					</a>
				</li>
			<?php
				$ix++;
			}
			?>
          </ul>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
			<a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-paragraph"></use>
            </svg> <?php echo MENU_MANAGEMENT3[0]; ?>
			</a>
          <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link" href="index.php?page=randomgold">
					 <svg class="c-sidebar-nav-icon">
					  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-star"></use>
					</svg><?php echo MENU_MANAGEMENT3[1]; ?>
				</a>
			</li>
			 <li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link" href="index.php?page=randompoint">
					 <svg class="c-sidebar-nav-icon">
					  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-star"></use>
					</svg> <?php echo MENU_MANAGEMENT3[2]; ?>
				</a>
			</li>
          </ul>
        </li>
		<li class="c-sidebar-nav-item">
			<a class="c-sidebar-nav-link" href="index.php?page=shop">
				<svg class="c-sidebar-nav-icon">
				  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-print"></use>
				</svg> <?php echo MENU_MANAGEMENT4[0]; ?>
			</a>
		</li>
        
        <li class="c-sidebar-nav-item mt-auto">
			<a class="c-sidebar-nav-link c-sidebar-nav-link-danger" href="index?p=logout" onclick="return confirm('ต้องการออกจากระบบ?')">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
            </svg>
			<strong> <?php echo MENU_LOGOUT; ?></strong>
			</a>
		</li>
      </ul>
	  
    </div>
	