<?php include ('template/left_menu.php'); ?>
<div class="c-wrapper c-fixed-components">
<?php include ('template/top_menu.php'); ?>
 <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
		 
            <div class="fade-in">
              <div class="row">
			  
					<div class="col-lg-12 mb-3" id="herbal">
					  <div class="card">
						<div class="card-header"><strong>ADD</strong> <small>Form</small></div>
						<div class="card-body">
						  <div class="row">
							<div class="form-group col-sm-2">
								<select class="form-control" name="items" id="items" required>
									<?php
										$result_getherballist = $functions->GettingHerbalInfo('asc');
										foreach ($result_getherballist['result'] as $row) 
										{
											//foreach ($row as $element)
											//{
									?>
												<option value="<?php  echo $row['Id']; ?>" count-data="<?php echo $row['Counting'] ?>" desc-data="<?php  echo $row['Desc_name']; ?>"><?php  echo $row['Name']; ?></option>
									<?php 
											//}
										}
									?>
									
							  </select>
							  <span class="help-block">ยาสมุนไพร</span>
							</div>
							<div class="form-group col-sm-2">
								<select class="form-control" name="partner" id="partner" required>
									<?php
										$result_getherballist = $functions->Gettinglist('partner_list');
										foreach ($result_getherballist['result'] as $row) 
										{
											//foreach ($row as $element)
											//{
									?>
												<option value="<?php  echo $row['id']; ?>"><?php  echo $row['name']; ?></option>
									<?php 
											//}
										}
									?>
							  </select>
							  <span class="help-block">คู่ค้า</span>
							</div>
							<div class="form-group col-sm-2">
								<div class="col-md-12">
									<input class="form-control" id="quantity" name="quantity" min="1" value="1" type="number" placeholder="จำนวน" required>
									<span class="help-block">จำนวน</span>
								</div>
							</div>
							<div class="form-group col-sm-2">
								<div class="col-md-12">
									<input class="form-control" id="price" name="price" min="1" value="1" type="number" placeholder="ราคา" required>
									<span class="help-block">ราคา(บาท)</span>
								</div>
							</div>
							<div class="form-group col-sm-4">
								<div class="col-md-12">
									<input class="form-control" id="expiredate" type="date" name="expiredate" required>
									<span class="help-block">วันหมดอายุ</span>
								</div>
							</div>
							<!--
							<div class="form-group col-sm-2">
								<div class="col-md-12">
									<input class="form-control required" id="expiretime" type="time" name="expiretime" required>
									<span class="help-block">เวลาหมดอายุ</span>
								</div>
							</div>
							-->
						  </div>
						   <div class="row">
								<div class="form-group col-sm-12">
									<button class="form-control bg-dark text-white" type="button" id="adddrug">เพิ่ม</button>
								</div>
						   </div>
						</div>
					  </div>
					</div>
					
					<div class="col-lg-12 mb-3">
						<table class="table table-responsive-sm table-hover table-outline mb-0" id="bodyforadd">
                        <thead class="thead-light">
                          <tr>
                            <th>ชื่อผลิตภัณฑ์</th>
                            <th class="text-center">จำนวน</th>
							<th class="text-center">หน่วยนับ</th>
                            <th>ราคา(บาท)</th>
                            <th class="text-right">วันหมดอายุ</th>
							<th class="text-right"></th>
                          </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                      </table>
					</div>
					
					<div class="col-lg-12 mb-3" style="margin-top:20px;margin-bottom:30px;">
						<div class="card">
							<div class="card-body">
							  <div class="row">
									<div class="form-group col-sm-12">
										<button class="form-control bg-dark text-white" type="button" id="addsql">บันทึกลงฐานข้อมูล</button>
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