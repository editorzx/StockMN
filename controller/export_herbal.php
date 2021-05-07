<!-- /.modal-->
<div class="modal fade" id="exportHerbalList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">เบิกยาสมุนไพรไปยังคลังนอก</h4>
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
										$result_getherballist = $functions->getHerbalInStock_ForExport();
										foreach ($result_getherballist['result'] as $row) 
										{
									?>
											<option value="<?php  echo $row['herbalId']; ?>" name-data="<?php  echo $row['Name'];?>" maximum-data="<?php echo $row['value_sum']; ?>" count-data="<?php echo $row['counting_name']; ?>" desc-data="<?php  echo $row['Desc_name']; ?>"><?php  echo $row['Name'] . ' ('.$row['value_sum'].')'; ?> </option>
									<?php 
										}
									?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">จำนวน</label>
						<div class="col-md-9">
							<input class="form-control" id="quantity" name="quantity" min="1" value="1" type="number" placeholder="จำนวน" required>
							<span class="help-block text-muted font-xs">ชิ้น</span>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="form-control bg-primary text-white" type="button" id="add_export_herbal">เพิ่ม</button>
				</div>
			</div>
						<!-- /.modal-content-->
		</div>
					<!-- /.modal-dialog-->
	</div>
				<!-- /.modal-->