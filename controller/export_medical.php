	 
	 <!-- /.modal-->
<div class="modal fade" id="exportMedicalList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">เบิกเวชภัณฑ์</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">เวชภัณฑ์</label>
						<div class="col-md-9">
							<select class="form-control" name="items" id="items" required>
									<?php
										$result_getherballist = $functions->Getmedicalinstock();
										foreach ($result_getherballist['result'] as $row) 
										{
									?>
											<option value="<?php  echo $row['medicalid']; ?>" unit-price="<?php echo ceil($row['UnitPrice']) ?>" name-data="<?php  echo $row['Name'];?>" maximum-data="<?php echo $row['value_sum']; ?>" count-data="<?php echo $row['counting_name']; ?>" desc-data="<?php  echo $row['Desc_name']; ?>"><?php  echo $row['Name'] . ' ('.$row['value_sum'].')'; ?> </option>
									<?php 
										}
									?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">ราคา/หน่วย</label>
						<div class="col-md-9">
							<input class="form-control" id="price_val" name="price_val" min="1" value="1" type="number" placeholder="ราคา" required>
							<span class="help-block text-muted font-xs">บาท</span>
						</div>
					</div>

					<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">จำนวน</label>
						<div class="col-md-9">
							<input class="form-control" id="quantity" name="quantity" min="1" value="1" type="number" placeholder="จำนวน" required>
							<span class="help-block text-muted font-xs">ชิ้น</span>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="form-control bg-primary text-white" type="button" id="add_export_medical">เพิ่ม</button>
				</div>
			</div>
						<!-- /.modal-content-->
		</div>
					<!-- /.modal-dialog-->
	</div>
				<!-- /.modal-->