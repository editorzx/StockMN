<!-- /.modal-->
            <div class="modal fade" id="minimumherbal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">ยาสมุนไพรกำลังจะหมด</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
					<table class="table table-responsive-sm table-secondary table-hover table-outline mb-0">
						<thead class="thead-light">
						  <tr>
							<th></th>
							<th>ชื่อยาสมุนไพร</th>
							<th class="text-right">จำนวนคงเหลือ</th>
						  </tr>
						</thead>
						<tbody>
							<?php
								$result_list = $functions->GetminimumHerbal();
								$ix = 0;
								foreach ($result_list['result'] as $row) 
								{	
									$dafault_valoe = 0;
									if($row['value_sum'] != 0)
										$dafault_valoe = $row['value_sum'];
									if($dafault_valoe < MINIMUM_HERBAL)
									{
							?>
							<tr>
								<td>
								<?php echo $ix+1;?>
								</td>
								<td>
									<?php echo $row['Name'];  ?>
								</td>
								<td class="text-right">
									<?php 
									switch($dafault_valoe){
										case 0:
											echo "<font color=\"red\">$dafault_valoe</font>";
										break;
										default:
											echo $dafault_valoe;
										break;
									}
									?>
								</td>
							</tr>
							<?php
										$ix++;
									}
									if($ix >= ALERT_MAXIMUM)
										break;
								}
							?>
						</tbody>
					</table>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  </div>
                </div>
                <!-- /.modal-content-->
              </div>
              <!-- /.modal-dialog-->
            </div>
            <!-- /.modal-->
			 <!-- /.modal-->
            <div class="modal fade" id="expireherbal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">ยาสมุนไพรกำลังจะหมดอายุ</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <table class="table table-responsive-sm table-secondary table-hover table-outline mb-0">
						<thead class="thead-light">
						  <tr>
							<th></th>
							<th>ชื่อยาสมุนไพร</th>
							<th class="text-center">วันหมดอายุ</th>
						  </tr>
						</thead>
						<tbody>
							<?php
								$result_list = $functions->GetExpireHerbal();
								$ix = 0;
								foreach ($result_list['result'] as $row) 
								{	
									if(strtotime(date("Y/m/d H:i:s")) > strtotime($row['expire'] . "-5 days"))
								{
									$date = date("d-m-Y",strtotime($row['expire']));
							?>
							<tr>
								<td>
								<?php echo $ix+1;?>
								</td>
								<td>
									<?php echo $row['Name'];  ?>
								</td>
								<td class="text-center">
									<?php echo $date;?>
								</td>
							</tr>
							<?php
								}
										$ix++;
								}
							?>
						</tbody>
					</table>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  </div>
                </div>
                <!-- /.modal-content-->
              </div>
              <!-- /.modal-dialog-->
            </div>
            <!-- /.modal-->
			
			<!-- /.modal-->
            <div class="modal fade" id="minimumherbal_out" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">ยาสมุนไพรกำลังจะหมด</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
					<table class="table table-responsive-sm table-secondary table-hover table-outline mb-0">
						<thead class="thead-light">
						  <tr>
							<th></th>
							<th>ชื่อยาสมุนไพร</th>
							<th class="text-right">จำนวนคงเหลือ</th>
						  </tr>
						</thead>
						<tbody>
							<?php
								$result_list = $functions->GetminimumHerbal_out();
								$ix = 0;
								foreach ($result_list['result'] as $row) 
								{	
									$dafault_valoe = 0;
									if($row['value_sum'] != 0)
										$dafault_valoe = $row['value_sum'];
									if($dafault_valoe < MINIMUM_HERBAL)
									{
							?>
							<tr>
								<td>
								<?php echo $ix+1;?>
								</td>
								<td>
									<?php echo $row['Name'];  ?>
								</td>
								<td class="text-right">
									<?php 
									switch($dafault_valoe){
										case 0:
											echo "<font color=\"red\">$dafault_valoe</font>";
										break;
										default:
											echo $dafault_valoe;
										break;
									}
									?>
								</td>
							</tr>
							<?php
										$ix++;
									}
									if($ix >= ALERT_MAXIMUM)
										break;
								}
							?>
						</tbody>
					</table>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  </div>
                </div>
                <!-- /.modal-content-->
              </div>
              <!-- /.modal-dialog-->
            </div>
            <!-- /.modal-->