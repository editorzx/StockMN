<!-- /.modal-->
<div class="modal fade" id="addmedicallist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">เพิ่มเวชภัณฑ์</h4>
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
										$result_getherballist = $functions->Gettinglist('medical_list');
										foreach ($result_getherballist['result'] as $row) 
										{
											//foreach ($row as $element)
											//{
									?>
												<option value="<?php  echo $row['Id']; ?>" count-data="<?php echo $functions->GettingCount($row['Id_Counting'],'counting_list')['Name']; ?>" desc-data="<?php  echo $row['Desc']; ?>"><?php  echo $row['Name']; ?></option>
									<?php 
											//}
										}
									?>
							</select>
							<small class="text-muted" id="desc-tooltips" data-toggle="tooltip" data-placement="right" data-original-title="">สรรพคุณ</small>
						</div>
					</div>
					<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">คู่ค้า</label>
						<div class="col-md-9">
							<select class="form-control" name="partner" id="partner" required>
								<?php $result_getherballist = $functions->Gettinglist('partner_list');
								foreach ($result_getherballist['result'] as $row)
								{
								?>
								<option name-data="<?php  echo $row['name']; ?>" value="<?php  echo $row['id']; ?>">
									<?php echo $row['name' ]; ?>
								</option>
								<?php 
								}
								?>
							</select>
						</div>
					</div>
						<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">ล็อตสินค้า</label>
						<div class="col-md-9">
							<select class="form-control" name="loter" id="loter" required>
								<?php $result_getherballist = $functions->Gettinglist('lot_list');
								foreach ($result_getherballist['result'] as $row)
								{
								?>
								<option name-data="<?php  echo $row['name']; ?>" value="<?php  echo $row['id']; ?>">
									<?php echo $row['name' ]; ?>
								</option>
								<?php 
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-12 row">
						<label class="col-md-3 col-form-label">ราคาทั้งหมด</label>
						<div class="col-md-9">
							<input class="form-control" id="price_val" name="price_val" min="1" value="1" type="number" placeholder="ราคาทั้งหมด" required>
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
					<div class="form-group col-sm-12">
						
					</div>
				</div>
				<div class="modal-footer">
					<button class="form-control bg-primary text-white" type="button" id="addmedical">เพิ่ม</button>
				</div>
			</div>
						<!-- /.modal-content-->
		</div>
					<!-- /.modal-dialog-->
	</div>
				<!-- /.modal-->