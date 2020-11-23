<?php include ('template/left_menu.php'); ?>
<div class="c-wrapper c-fixed-components">
<?php include ('template/top_menu.php'); ?>
 <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
		 
            <div class="fade-in">
              <div class="row">
					<div class="col-lg-12">
						<div class="input-group mb-3 col-sm-6">
							<label class="c-switch c-switch-label  c-switch-pill c-switch-danger">
								<input class="c-switch-input" type="checkbox" checked id="changeType">
								<span class="c-switch-slider" data-checked="ON" data-unchecked="Off"></span>
							</label>
						</div>
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
												
												$result_list = $functions->Getherbalinstock();
												//$arrayItem = array();
												foreach ($result_list['result'] as $row) 
												{
													$sum = 0;
													//array_push($arrayItem, $row['Name'], $sum, $row['Expire'], $row['Type'], $row['Price']);
													//$arrayItem[] = $row['IDHERBAL'];
													if($row['value_sum'] > 0)
														$sum = $row['value_sum'];
											?>
											<li id="list-e" data-id="<?php echo $row['IDHERBAL'];?>" data-name="<?php echo $row['Name']; ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<?php echo $row['Name']; ?>
												<?php 
													if($sum <= ALERT_MAXIMUM)
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
												
												$result_list = $functions->GetViewReSultMedical();
												foreach ($result_list['result'] as $row) 
												{
													$sum = 0;
													if($row['value_sum'] > 0)
														$sum = $row['value_sum'];
											?>
											<li data-name="<?php echo $row['Name']; ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<?php echo $row['Name']; ?>
												<?php 
													if($sum <= ALERT_MAXIMUM)
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
	 <?php 
		if(isset($_GET['ids']))
		{
	 ?>
	  <script>
	 $(document).ready(function() {
		$('#myModal').modal('show');
	 });
	 </script>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title">ตรวจสอบข้อมูล <span id="index"></span></h4>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					  </div>
					  <div class="modal-body">
							<div class="list-group">
								<?php
									$result_list = $functions->GetHerbaldetail($_GET['ids']);
									foreach ($result_list['result'] as $row) 
									{

								?>
								<div class="list-group-item list-group-item-action flex-column align-items-start">
								  <p class="mb-1">
									<?php echo sprintf(DETAIL_MEDICAL,$row['Name'],$row['Quantity'],$row['counting_name'],$row['Type']);?> 
								  </p>
								 <small class="text-muted">วันที่นำเข้า : <?php echo $row['Date'];?></small>
								  </br>
								 <small class="text-muted">วันหมดอายุ : <?php echo $row['Expire'];?></small>								 
								</div>
								<?php
									}
								?>
							</div>
					  </div>
					  <div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
					  </div>
					</div>
				  </div>
				</div>
		<?php
		}
		?>