<?php
	$countingAlert =  array();
?>
<!-- /.modal-->
            <div class="modal fade" id="minimumherbal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">รายการยาสมุนไพรคลังในเหลือน้อยกว่าที่กำหนด</h4>
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
								$i_count = 0;
								foreach ($result_list['result'] as $row) 
								{	
									$dafault_valoe = 0;
									if($row['value_sum'] != 0)
										$dafault_valoe = max(0,$row['value_sum']);
									if($dafault_valoe < MINIMUM_HERBAL)
									{
							?>
							<tr>
								<td>
								<?php echo $i_count+1;?>
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
										$i_count++;
									}
									if($i_count >= ALERT_MAXIMUM && ALERT_MAXIMUM !== -1)
										break;
								}
								
								if($i_count > 0)
									$countingAlert[0] = true;
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
                    <h4 class="modal-title">รายการยาสมุนไพรคลังในกำลังจะหมดอายุ</h4>
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
								$i_count = 0;
								foreach ($result_list['result'] as $row) 
								{	
									if(strtotime(date("Y/m/d H:i:s")) > strtotime($row['expire'] . "-5 days"))
									{
										$date = date("d-m-Y",strtotime($row['expire']));
							?>
									<tr>
										<td>
										<?php echo $i_count+1;?>
										</td>
										<td>
											<?php echo $row['Name'];  ?>
										</td>
										<td class="text-center">

											<?php 
												if($date <= date('d-m-Y'))
													echo "<font color=\"red\">".$date."</font>";
												else
													echo $date;
											?>
										</td>
									</tr>
							<?php
									}
									$i_count++;
								}
								
								if($i_count > 0)
									$countingAlert[1] = true;
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
                    <h4 class="modal-title">ยาสมุนไพรคลังนอกคงเหลือน้อย</h4>
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
								$result_list = $functions->getMinimumHerbalOutStock();
								$i_count = 0;
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
								<?php echo $i_count+1;?>
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
										$i_count++;
									}
									if($i_count >= ALERT_MAXIMUM && ALERT_MAXIMUM !== -1)
										break;
								}
								if($i_count > 0)
									$countingAlert[2] = true;
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
            <div class="modal fade" id="expireHerbal_out" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">รายการยาสมุนไพรคลังนอกกำลังจะหมดอายุ</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <table class="table table-responsive-sm table-secondary table-hover table-outline mb-0">
						<thead class="thead-light">
						  <tr>
							<th></th>
							<th>รหัสสต็อค</th>
							<th>ชื่อยาสมุนไพร</th>
							<th class="text-center">วันที่นำเข้า</th>
							<th class="text-center">วันหมดอายุ</th>
						  </tr>
						</thead>
						<tbody>
							<?php
								$result_list = $functions->getExpireHerbalOutStock();
								$i_count = 0;
								foreach ($result_list['result'] as $row) 
								{	
									if(strtotime(date("Y/m/d H:i:s")) > strtotime($row['Expire'] . "-5 days"))
									{
										$date = date("d-m-Y",strtotime($row['Expire']));
							?>
									<tr>
										<td>
											<?php echo $i_count+1;?>
										</td>
										<td>
											<?php echo $row['StockNumber'];?>
										</td>
										<td>
											<?php echo $row['Name'];  ?>
										</td>
										<td class="text-center">
											<?php
												echo $functions->thai_date_and_time(strtotime($row['Import_date']));//;
											?>
										</td>
										<td class="text-center">

											<?php 
												if($date <= date('Y-m-d'))
													echo "<font color=\"red\">".$functions->thai_date_and_time(strtotime($row['Expire']))."</font>";
												else
													echo $functions->thai_date_and_time(strtotime($row['Expire']));
											?>
										</td>
									</tr>
							<?php
									}
									$i_count++;
								}
								
								if($i_count > 0)
									$countingAlert[3] = true;
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