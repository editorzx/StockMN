<?php include ('template/left_menu.php'); ?>
<div class="c-wrapper c-fixed-components">
<?php include ('template/top_menu.php'); ?>
 <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
		 
            <div class="fade-in">
              <div class="row">
			  
					<div class="col-lg-12" id="medical">
					  <div class="card">
						<div class="card-header"><strong>ADD</strong> <small>Form</small></div>
						<div class="card-body">
						  <div class="row">
							<div class="form-group col-sm-6">
								<select class="form-control" name="items" id="items" required>
									<?php
										$result_getherballist = $functions->Getmedicalinstock();
										foreach ($result_getherballist['result'] as $row) 
										{
									?>
											<option value="<?php  echo $row['medicalid']; ?>" name-data="<?php  echo $row['Name'];?>" maximum-data="<?php echo $row['value_sum']; ?>" count-data="<?php echo $row['counting_name']; ?>" desc-data="<?php  echo $row['Desc_name']; ?>"><?php  echo $row['Name'] . ' ('.$row['value_sum'].')'; ?> </option>
									<?php 
										}
									?>
							  </select>
							</div>
							<div class="form-group col-sm-4">
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
						  </div>
						   <div class="row">
								<div class="form-group col-sm-12">
									<button class="form-control bg-dark text-white" type="button" id="add_export_medical">เพิ่ม</button>
								</div>
						   </div>
						</div>
					  </div>
					</div>
					
					<div class="col-lg-12">
						<table class="table table-responsive-sm table-hover table-outline mb-0" id="bodyforaddmedical">
                        <thead class="thead-light">
                          <tr>
                            <th>ชื่อผลิตภัณฑ์</th>
                            <th class="text-center">จำนวน</th>
							<th class="text-center">หน่วยนับ</th>
                            <th>ราคา(บาท)</th>
							<th class="text-right"></th>
                          </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                      </table>
					</div>
					
					<div class="col-lg-12" style="margin-top:20px;margin-bottom:30px;">
						<div class="card">
							<div class="card-body">
							  <div class="row">
									<div class="form-group col-sm-12">
										<button class="form-control bg-dark text-white" type="button" id="export_medical">บันทึกลงฐานข้อมูล</button>
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