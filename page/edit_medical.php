<?php
if(!isset($_SESSION["token"])) 
	exit(0);

if(isset($_POST['entervalue']))
{
	$id = $_REQUEST['idp'];
	$price = $_REQUEST['price'];
	$quantity = $_REQUEST['quantity'];
	
	$msg = '';
	switch ($functions->EditInfoMedical($id,$quantity,$price)) {
	  case 0:
		$msg = 'ไม่สำเร็จ';
		break;
	  case 1:
		$msg = 'แก้ไขข้อมูลเรียบร้อย';
		break;
	  default:
		$msg = 'ไม่สำเร็จ';
	}
	echo "<script type='text/javascript'>alert('$msg');</script>";
	unset($_REQUEST['id']);
}elseif(isset($_GET['del_id'])){
	$msg = '';
	switch ($functions->DeleteInfoMedical($_GET['del_id'])) {
	  case 0:
		$msg = 'ไม่สำเร็จ';
		break;
	  case 1:
		$msg = 'แก้ไขข้อมูลเรียบร้อย';
		break;
	  default:
		$msg = 'ไม่สำเร็จ';
	}
	echo "<script type='text/javascript'>alert('$msg');</script>";
	header("Location: index?p=edit_medical");
}

?>
<?php include ('template/left_menu.php'); ?>
<div class="c-wrapper c-fixed-components">
<?php include ('template/top_menu.php'); ?>
 <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
		 
            <div class="fade-in">
              <div class="row">
					<div class="col-lg-12">
						<table class="table table-responsive-sm table-hover table-outline mb-0" id="bodyforadd">
                        <thead class="thead-light">
                          <tr>
							<th>ผู้บันทึกเข้า</th>
                            <th>ชื่อผลิตภัณฑ์</th>
                            <th class="text-center">จำนวน</th>
							<th class="text-center">หน่วยนับ</th>
                            <th>ราคา</th>
							<th class="text-center">วันที่นำเข้า</th>
							<th class="text-center"></th>
							<th class="text-center"></th>
                          </tr>
                        </thead>
                        <tbody>
							<?php
								$result_list = $functions->Getimportlist_medical();
								foreach ($result_list['result'] as $row) 
								{
							?>
							<tr>
								<td>
									<?php 
										echo $row['OFName'] . " " . $row['OFLName']; 
									?>
								</td>
								<td>
									<?php 
										echo $row['MedicName']; 
									?>
								</td>
								<td class="text-center">
									<?php echo $row['Quantity']; ?>
								</td>
								<td class="text-center">
									<?php echo $row['CName']; ?>
								</td>
								<td class="text-center">
									<?php echo $row['price']; ?>
								</td>
								<td class="text-center">
									<?php echo $row['date']; ?>
								</td>
								<td>
									<a href="index?p=edit_medical&id=<?php echo $row["ID"];?>"><button class="form-control" type="button">EDIT</button></a>
								</td>
								<td>
								<!--

								<a href="index?p=edit_medical&del_id=<?php echo $row["ID"];?>"><button class="form-control" type="button">REMOVE</button></a>
								
								-->
								</td>
							</tr>
							<?php
								}
							?>
                        </tbody>
                      </table>
					</div>
            </div>
          </div>
		  
		  <?php 
			if(isset($_REQUEST['id']))
			{
				$result_list = $functions->GetSelectForEditMedical($_REQUEST['id']);
		  ?>
		  <!--MODAL DIALOG-->
		  <form action="index?p=edit_medical" method="post">
			  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title">แก้ไขประวัติการรับเข้า</h4>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					  </div>
					  <div class="modal-body">
							<div class="form-group col-sm-12">
								<div class="row">
									<div class="col-md-6">
										<span class="help-block">จำนวน</span>
										<input class="form-control" id="quantity" name="quantity" min="1" value="<?php echo $result_list['import_quantity']; ?>" type="number" placeholder="จำนวน" required>
									</div>
									<div class="col-md-6">
										<span class="help-block">ราคา</span>
										<input class="form-control" id="price" name="price" min="1" value="<?php echo $result_list['import_price']; ?>" step="any" type="number" placeholder="ราคา" required>
									</div>
								</div>
							</div>
							<input type="hidden" name="idp" value="<?php echo $_REQUEST['id']; ?>">
					  </div>
					  <div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
						<button class="btn btn-primary" type="submit" name="entervalue">บันทึกผล</button>
					  </div>
					</div>
				  </div>
				</div>
			</form>
		<?php
			}
		?>
        </main>
      </div>
	  </div>
	 </div>