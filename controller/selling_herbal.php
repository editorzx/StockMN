<?php
if(!isset($_SESSION["token"])) 
	exit(0);
?>
<!-- /.modal-->
<div class="modal fade" id="sellingHerbalList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">จ่ายยาสมุนไพร</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">ยาสมุนไพร</label>
						<div class="col-md-9">
							<select class="form-control" name="items" id="items" required>
								<?php
									$result_getherballist = $functions->getHerbalOutStock_ForSelling();
									foreach ($result_getherballist['result'] as $row) 
									{
								?>
										<option value="<?php  echo $row['herbalId']; ?>" name-data="<?php  echo $row['herbalName'];?>" maximum-data="<?php echo $row['value_sum']; ?>" count-data="<?php echo $row['countingName']; ?>" desc-data="<?php  echo $row['herbalDesc']; ?>"><?php  echo $row['herbalName'] . ' ('.$row['value_sum'].')'; ?> </option>
								<?php 
									}
								?>
							</select>
							<small class="text-muted" id="desc-tooltips" data-toggle="tooltip" data-placement="right" data-original-title="">สรรพคุณ</small>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">ราคา/ชิ้น</label>
						<div class="col-md-9">
							<input class="form-control" id="price_val" name="price_val" min="1" value="1" type="number" placeholder="ราคา/ชิ้น" required>
							<span class="help-block text-muted font-xs">บาท</span>
						</div>
					</div>

					<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">จำนวน</label>
						<div class="col-md-9">
							<input class="form-control" id="quantity" name="quantity" min="1" value="1" type="number" placeholder="จำนวน" required>
							<span class="help-block text-muted font-xs" id="quantity-name">ชิ้น</span>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">สถานะ</label>
						<div class="col-md-9">
							<select class="form-control" name="status" id="status" required>
								<option value="0" selected>สนับสนุนใช้ในคลีนิค</option>
								<option value="1">ออกหน่วยบริการ</option>
							</select>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="form-control bg-primary text-white" type="button" id="add_selling_herbal">เพิ่ม</button>
				</div>
			</div>
			<!-- /.modal-content-->
		</div>
		<!-- /.modal-dialog-->
	</div>
<!-- /.modal-->