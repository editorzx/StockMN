
            <div class="modal fade" id="user_setting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">ตั้งค่าผู้ใช้</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
					<div class="row">
						<div class="form-group col-sm-12 row">
							<label class="col-md-3 col-form-label">รหัสผ่าน</label>
							<div class="col-md-9">
								<input class="form-control" id="password" name="password"  type="password" placeholder="รหัสผ่าน" required>
							</div>
						</div>
						<div class="form-group col-sm-12 row">
							<label class="col-md-3 col-form-label">ยืนยันรหัสผ่าน</label>
							<div class="col-md-9">
								<input class="form-control" id="password2" name="password2"  type="password" placeholder="รหัสผ่าน" required>
							</div>
						</div>
					</div>
                  </div>
                  <div class="modal-footer">
					<button class="btn btn-primary" type="submit" onclick="return confirm('ยืนยันการแก้ไข?')" id="user_setting_return">แก้ไข</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                  </div>
                </div>
                <!-- /.modal-content-->
              </div>
              <!-- /.modal-dialog-->
            </div>
            <!-- /.modal-->
		