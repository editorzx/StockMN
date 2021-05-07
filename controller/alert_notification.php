<?php
	//countingAlert [0] = ยาสมุนไพรคลังในเหลือน้อย
	//countingAlert [1] = ยาสมุนไพรคลังในหมดอายุ
	//countingAlert [2] = ยาสมุนไพรคลังนอกคงเหลือน้อย
	//[3] = ยาสมุนไพรคลังนอกใกล้หมดอายุใน 5 วัน
?>
<li class="c-header-nav-item dropdown d-md-down-none mx-2">
	<a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		<svg class="c-icon">
		<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
		</svg>
		<span class="badge badge-pill badge-danger">
			<?php echo sizeof($countingAlert);?>
		</span>
	</a>
	<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
		<div class="dropdown-header bg-light"><strong>คุณมี <?php echo sizeof($countingAlert);?> การจัดการต้องทำ </strong></div>
		<!-- minimumherbal_INSTOCK-->
		<?php 
			if(isset($countingAlert[0])){
		?>
		<a class="dropdown-item" href="#" data-toggle="modal" data-target="#minimumherbal">
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
				<div class="text-truncate font-weight-normal"><span class="text-danger">!</span> <?php echo MINIMUM_HERBAL_DESC[0][0]?></div>
				<div class="small text-muted  text-truncate"><?php echo MINIMUM_HERBAL_DESC[0][1];?></div>
			</div>
		</a>
		<?php
			}
		?>
		<?php 
			if(isset($countingAlert[1])){
		?>
		<a class="dropdown-item" href="#" data-toggle="modal" data-target="#expireherbal">
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
				<div class="text-truncate font-weight-normal"><span class="text-danger">!</span> <?php echo MINIMUM_HERBAL_DESC[1][0]?></div>
				<div class="small text-muted  text-truncate"><?php echo MINIMUM_HERBAL_DESC[1][1];?></div>
			</div>
		</a>
		<?php
			}
		?>
		<?php 
			if(isset($countingAlert[2])){
		?>
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
				<div class="text-truncate font-weight-normal"><span class="text-danger">!</span> <?php echo MINIMUM_HERBAL_DESC[2][0]?></div>
				<div class="small text-muted  text-truncate"><?php echo MINIMUM_HERBAL_DESC[2][1];?></div>
			</div>
		</a>
		<?php
			}
		?>
		<?php 
		if(isset($countingAlert[3])){
		?>
		<a class="dropdown-item" href="#" data-toggle="modal" data-target="#expireHerbal_out">
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
				<div class="text-truncate font-weight-normal"><span class="text-danger">!</span> <?php echo MINIMUM_HERBAL_DESC[3][0]?></div>
				<div class="small text-muted  text-truncate"><?php echo MINIMUM_HERBAL_DESC[3][1];?></div>
			</div>
		</a>
		<?php
			}
		?>
	</div>
</li>