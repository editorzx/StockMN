<?php
if(!isset($_SESSION["token"])) 
	exit(0);
?>
<?php include ('template/left_menu.php'); ?>
<div class="c-wrapper c-fixed-components">
<?php include ('template/top_menu.php'); ?>
 <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
		 
            <div class="fade-in">
              <div class="row">
					<div class="col-lg-12">
						<!--<div class="input-group mb-3 col-sm-6">
							<label class="c-switch c-switch-label  c-switch-pill c-switch-danger">
								<input class="c-switch-input" type="checkbox" checked id="changeType">
								<span class="c-switch-slider" data-checked="ON" data-unchecked="Off"></span>
							</label>
						</div>-->
						<div class="input-group mb-3 col-sm-12">
							<input class="form-control" id="search" type="text" placeholder="อยากค้นหายาอะไรหล่ะ?">
						</div>
					</div>
					
					<div class="col-lg-12" id="herbal">
						<div class="card">
							<div class="card-header"><small>ตรวจสอบยาสมุนไพรคงเหลือ(คลังนอก)</small>
							</div>
							<div class="card-body">
							  <div class="row">
								<div class="col-4">
								  <div class="list-group" id="list-tab" role="tablist">
									  <a class="list-group-item list-group-item-action active" data-toggle="tab" href="#list-herbal" role="tab">ยาสมุนไพร</a>
									 </div>
								</div>
								<div class="col-8">
								  <div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade active show" id="list-herbal" role="tabpanel" >
									    <ul class="list-group" id="herbal_list">
											<?php
												
												$result_list = $functions->getResultHerbal_OutStock_ForCheck();
												foreach ($result_list['result'] as $row) 
												{
													$sum = 0;
													if($row['value_sum'] > 0)
														$sum = $row['value_sum'];
											?>
											<li id="list-ex" data-id="<?php echo $row['IDHERBAL'];?>" data-name="<?php echo $row['Name']; ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<?php echo $row['Name']; ?>
												<?php 
													if($sum <= MINIMUM_HERBAL)
													{
												?>
													<span class="badge badge-danger badge-pill"><?php echo $sum; ?> <?php echo $row['counting_name']; ?> </span>
												<?php
													}else{
												?>
													<span class="badge badge-success"><?php echo $sum; ?> <?php echo $row['counting_name']; ?> </span>
												<?php
													}
												?>
											</li>
											<?php 
												}
											?>
										</ul>
									</div>
								  </div>
								</div>
							  </div>
							</div>
					    </div>
					</div>
            </div>
          </div>
        </main>
      </div>
	  </div>
	 </div>