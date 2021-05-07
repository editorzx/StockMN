		 <?php 
			if(isset($_REQUEST['id']))
			{
				$result_list = $functions->gettingLotInfoForEdit($_REQUEST['id']);
		 ?>
		  <!--MODAL DIALOG-->
		  <form action="index?p=lot-info" method="post">
			  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title">แก้ไขล็อต</h4>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					  </div>
					  <div class="modal-body">
							<div class="form-group col-sm-12">
								<div class="row">
									<div class="col-md-6">
										<span class="help-block">Name</span>
										<input class="form-control" id="Name" name="Name" value="<?php echo $result_list['Name']; ?>" type="text" placeholder="Name" required>
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
		
		<form method="post" action="ajax/add_lot">
		<div class="modal fade" id="addlot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">เพิ่มล็อต</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			  </div>
			  <div class="modal-body">
					<div class="form-group col-sm-12">
						<div class="row">
							<div class="col-md-6">
								<span class="help-block">ชื่อล็อต</span>
								<input class="form-control" id="Name" name="Name" type="text" placeholder="ชื่อล็อต" required>
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