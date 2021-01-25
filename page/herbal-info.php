<?php 
if(!($_SESSION['admin']))
	header("Location: index");	
?>
<?php
	if(isset($_POST['entervalue']))
	{
		$id = $_REQUEST['idp'];
		$Desc = $_REQUEST['Desc_name'];
		$Name = $_REQUEST['Name'];
		
		$msg = '';
		switch ($functions->EditInfoHerbal($id,$Name,$Desc)) {
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
	}elseif(isset($_GET['remid'])){
		
		$msg = '';
		switch ($functions->DeleteHerbalInfo($_GET['remid'])) {
		  case 0:
			$msg = 'ไม่สำเร็จ';
			break;
		  case 1:
			$msg = 'ลบผู้ใช้เรียบร้อย';
			break;
		  default:
			$msg = 'ไม่สำเร็จ';
		}
		echo "<script type='text/javascript'>alert('$msg');location='index?p=herbal-info'</script>";
		unset($_REQUEST['remid']);
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
					<div class="col-lg-12" id="herbal">
						<div class="card">
							<div class="card-header"><small>ข้อมูลยาสมุนไพร</small></div>
							<div class="card-body">
								<div class="dropdown">
									<button class="btn btn-secondary dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View Sorting</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
									  <a class="dropdown-item" href="?p=herbal-info&sort=asc">ก-ฮ</a>
									  <a class="dropdown-item" href="?p=herbal-info&sort=desc">ฮ-ก</a>
									</div>
								</div>
								<table class="table table-responsive-sm table-hover table-outline mb-0">
									<thead class="thead-light">
									  <tr>
										<th></th>
										<th>ชื่อยาสมุนไพร</th>
										<th>คำอธิบาย</th>
										<th class="text-center">หน่วยนับ</th>
										<th class="text-center">หมวดหมู่</th>
										<th></th>
										<th></th>
									  </tr>
									</thead>
									<tbody>
										<?php
											$sorting = (isset($_GET['sort'])) ? $_GET['sort'] : "";
											$result_list = $functions->GettingHerbalInfo($sorting);
											foreach ($result_list['result'] as $key=>$row) 
											{
										?>
										<tr>
											<td>
											<?php echo $key+1;?>
											</td>
											<td>
												<?php echo $row['Name'];  ?>
											</td>
											<td>
												<?php 
													echo $row['Desc_name']; 
												?>
											</td>
											<td class="text-center">
												<?php echo $row['Counting'];   ?>
											</td>
											<td class="text-center">
												<?php echo $row['Type'];  ?>
											</td>
											<td>
												<a href="index?p=herbal-info&id=<?php echo $row["Id"];?>"><button class="form-control" type="button">EDIT</button></a>
											</td>
											<td>
												<a href="index?p=herbal-info&remid=<?php echo $row["Id"];?>" onclick="return confirm('ยืนยันการลบ?')">
													<button class="btn btn-danger" type="button">
														DELETE
													</button>
												</a>
											</td>
										</tr>
										<?php
											}
											unset($_SESSION['statement']);
										?>
									</tbody>
									</table>
							</div>
					    </div>
					</div>
            </div>
          </div>
		  
		  
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
						<h4 class="modal-title">แก้ไขผู้ใช้งาน</h4>
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
		  
        </main>
      </div>
	  </div>
	 </div>
	