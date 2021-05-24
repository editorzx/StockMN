<?php


?>

	<div class="modal fade" id="webSetting_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">ตั้งค่าระบบเว็บ</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			  </div>
			  <div class="modal-body">
					<div class="form-group col-sm-12">
						<div class="row">
							<div class="col-md-12 mb-3">
								<span class="help-block">ชื่อเว็บไซต์</span>
								<input class="form-control" id="web_name" name="web_name" value="<?php echo WEB_NAME; ?>" type="text" placeholder="web_name" required>
							</div>
							<div class="col-md-12 mb-3">
								<span class="help-block">อัตราการแจ้งเตือนสินค้าในคลังเหลือน้อย (ชิ้น)</span>
								<input class="form-control" id="minimum" name="minimum" value="<?php echo MINIMUM_HERBAL; ?>" type="number" placeholder="minimum" required>
							</div>
							<div class="col-md-12 mb-3">
								<span class="help-block">สินค้าใกล้หมดอายุกี่วันจะแจ้งเตือน (วัน)</span>
								<input class="form-control" id="minimum_date" name="minimum_date" value="<?php echo MINIMUM_DATE_ALERT; ?>" type="number" placeholder="minimum_date" required>
							</div>
						</div>
					</div>
			  </div>
			  <div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
				<button class="btn btn-primary" type="submit" onclick="return confirm('ยืนยันการแก้ไข?')" id="editWebSettings">แก้ไข</button>
			  </div>
			</div>
		</div>
	</div>