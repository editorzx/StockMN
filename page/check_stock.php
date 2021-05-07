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
						<div class="input-group mb-3 col-sm-12">
							<input class="form-control" id="search" type="text" placeholder="Want to search?">
						</div>
					</div>
					
					<div class="col-lg-12" id="herbal">
						<div class="card">
							<div class="card-header"><small>ตรวจสอบยาสมุนไพรและเวชภัณฑ์</small>
							</div>
							<div class="card-body">
							  <div class="row">
								<div class="col-4">
								  <div class="list-group" id="list-tab" role="tablist">
									  <a class="list-group-item list-group-item-action active" data-toggle="tab" href="#list-herbal" role="tab">ยาสมุนไพร</a>
									  <a class="list-group-item list-group-item-action"  data-toggle="tab" href="#list-medical" role="tab">เวชภัณฑ์</a>
									 </div>
								</div>
								<div class="col-8">
								  <div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade active show" id="list-herbal" role="tabpanel" >
									    <ul class="list-group" id="herbal_list">
											<?php
												
												$result_list = $functions->getViewCheckStockHerbal();
												foreach ($result_list['result'] as $row) 
												{
													$sum = 0;
													if($row['value_sum'] > 0)
														$sum = $row['value_sum'];
											?>
											<li id="list-e" data-id="<?php echo $row['IDHERBAL'];?>" data-name="<?php echo $row['Name']; ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
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
									<div class="tab-pane fade " id="list-medical" role="tabpanel">
									   <ul class="list-group">
											<?php
												
												$result_list = $functions->getViewCheckStockMedical();
												foreach ($result_list['result'] as $row) 
												{
													$sum = 0;
													if($row['value_sum'] > 0)
														$sum = $row['value_sum'];
											?>
											<li id="list-m" data-id="<?php echo $row['idmedical'] ?>" data-name="<?php echo $row['Name']; ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<?php echo $row['Name']; ?>
												<?php 
													if($sum <= MINIMUM_MEDICAL)
													{
												?>
													<span class="badge badge-danger badge-pill">
														<?php echo $sum; ?> <?php echo $row['counting_name']; ?> 
													</span>
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