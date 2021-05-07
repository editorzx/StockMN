		 <?php 
			if(isset($_REQUEST['id']))
			{
				$result_list = $functions->GettingHerbalInfoForEdit($_REQUEST['id']);
		 ?>
		  <!--MODAL DIALOG-->
		  <form action="index?p=herbal-info" method="post">
			  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title">แก้ไขยาสมุนไพร</h4>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					  </div>
					  <div class="modal-body">
							<div class="form-group col-sm-12">
								<div class="row">
									<div class="col-md-6">
										<span class="help-block">Name</span>
										<input class="form-control" id="Name" name="Name" value="<?php echo $result_list['Name']; ?>" type="text" placeholder="Name" required>
									</div>
									<div class="col-md-6">
										<span class="help-block">Desc_name</span>
										<input class="form-control" id="Desc_name" name="Desc_name" value="<?php echo $result_list['Desc_name']; ?>" type="text" placeholder="Desc_name" required>
									</div>
								</div>
							</div>
							<input type="hidden" name="idp" value="<?php echo $_REQUEST['id']; ?>">
					  </div>
					  <div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
						<button class="btn btn-primary" type="submit" onclick="return confirm('ยืนยันการแก้ไข?')" name="entervalue">แก้ไข</button>
					  </div>
					</div>
				  </div>
				</div>
			</form>
		<?php
			}
		?>	
		
		<form method="post" action="ajax/add_herbal">
		<div class="modal fade" id="addherbal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">เพิ่มยาสมุนไพร</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			  </div>
			  <div class="modal-body">
					<div class="form-group col-sm-12">
						<div class="row">
							<div class="col-md-6">
								<span class="help-block">ชื่อยาสมุนไพร</span>
								<input class="form-control" id="Name" name="Name" type="text" placeholder="ชื่อยาสมุนไพร" required>
							</div>
							<div class="col-md-6">
								<span class="help-block">รายละเอียด</span>
								<input class="form-control" id="Desc_name" name="Desc_name" type="text" placeholder="รายละเอียด" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<span class="help-block">หน่วยนับ</span>
								<select class="form-control" name="couting" id="couting" required>
									<?php $result_getherballist = $functions->Gettinglist('counting_list');
									foreach ($result_getherballist['result'] as $row)
									{
									?>
									<option value="<?php  echo $row['Id']; ?>">
										<?php echo $row['Name' ]; ?>
									</option>
									<?php 
									}
									?>
								</select>
							</div>
							<div class="col-md-6">
								<span class="help-block">ประเภท</span>
								<select class="form-control" name="type" id="type" required>
									<?php $result_getherballist = $functions->Gettinglist('type_herbal');
									foreach ($result_getherballist['result'] as $row)
									{
									?>
									<option value="<?php  echo $row['Id']; ?>">
										<?php echo $row['Name' ]; ?>
									</option>
									<?php 
									}
									?>
								</select>
							</div>
						</div>
					</div>
			  </div>
			  <div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
				<button class="btn btn-primary" type="submit" onclick="return confirm('ยืนยันการทำสิ่งนี้?')">เพิ่ม</button>
			  </div>
			</div>
		  </div>
		</div>
		</form>