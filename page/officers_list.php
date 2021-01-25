<?php 
if(!($_SESSION['admin']))
	header("Location: index");	
?>
<?php
	if(isset($_POST['entervalue']))
	{
		$id = $_REQUEST['idp'];
		$Email = $_REQUEST['Email'];
		$Name = $_REQUEST['Name'];
		$LastName = $_REQUEST['LastName'];
		
		$msg = '';
		switch ($functions->EditInfoOfficers($id,$Email,$Name,$LastName)) {
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
		switch ($functions->DeleteOfficers($_GET['remid'])) {
		  case 0:
			$msg = 'ไม่สำเร็จ';
			break;
		  case 1:
			$msg = 'ลบผู้ใช้เรียบร้อย';
			break;
		  default:
			$msg = 'ไม่สำเร็จ';
		}
		echo "<script type='text/javascript'>alert('$msg');location='index?p=officers_list'</script>";
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
					<div class="col-lg-12 col-xl-12">
						<div class="card">
							<div class="card-header"> 
								Container
							</div>
							<div class="card-body">
								<button class="btn mb-3 btn-primary" type="button" data-toggle="collapse" data-target="#viewofficers" aria-expanded="true">ดูรายชื่อ/แก้ไข</button>
								<button class="btn mb-3 btn-primary" type="button" data-toggle="collapse" data-target="#addofficers" aria-expanded="false" aria-controls="addofficers">เพิ่มข้อมูลเจ้าหน้าที่</button>
								
								
								<div class="collapse" id="addofficers">
									<div class="card card-body">
										<form id="frmadd" action="ajax/adduser.php" method="post">
											<div class="row">
												<div class="form-group col-sm-6">
													 <label for="name">ชื่อ</label>
													<input class="form-control" type="text" name="name" id="name" autocomplete="off" required>
												</div>
												<div class="form-group col-sm-6">
													 <label for="name">นามสกุล</label>
													<input class="form-control" type="text" name="lastname" id="lastname" autocomplete="off" required>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-sm-6">
													 <label for="name">อีเมล</label>
													<input class="form-control" type="email" name="email" id="email" autocomplete="off" required>
												</div>
												<div class="form-group col-sm-4">
													 <label for="name">รหัสผ่าน</label>
													<input class="form-control" type="password" name="password" id="password" autocomplete="off" required>
												</div>
												<div class="form-group col-sm-2">
													<label for="name">ระดับเข้าใช้งาน</label>
													<select class="form-control" name="grade" id="grade" required>
														<option value="0" selected>ผู้ใช้งานทั่วไป</option>
														<option value="1">ผู้ดูแลระบบ</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-lg-12">
													<button type="submit" class="form-control btn- btn-outline-dark">เพิ่มข้อมูลเจ้าหน้าที่</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								
								<div class="collapse" id="viewofficers">
									<div class="card card-body">
										<table class="table table-responsive-sm table-hover table-outline mb-0" id="bodyforadd">
										<thead class="thead-light">
										  <tr>
											<th>ชื่อ นามสกุล</th>
											<th>อีเมลย์</th>
											<th class="text-center">เข้าใช้งานล่าสุด</th>
											<th class="text-center">สถานะ</th>
											<th></th>
											<th></th>
										  </tr>
										</thead>
										<tbody>
											<?php
												$result_list = $functions->Gettinglist('officers');
												foreach ($result_list['result'] as $row) 
												{
											?>
											<tr>
												<td>
													<?php echo $row['Officer_Name']." ".$row['Officer_Lastname'];  ?>
												</td>
												<td>
													<?php 
														echo $row['Email']; 
													?>
												</td>
												<td class="text-center">
													<?php echo $functions->time_elapsed_string($row['Last_Login']);  ?>
												</td>
												<td class="text-center">
													<?php echo $functions->getAdmin($row['isAdmin']); ?>
												</td>
												<td>
													<a href="index?p=officers_list&id=<?php echo $row["Id"];?>"><button class="form-control" type="button">EDIT</button></a>
												</td>
												<td>
													<?php 
													if($_SESSION['token'] != $row['Token'])
													{
													?>
													<a href="index?p=officers_list&remid=<?php echo $row["Id"];?>" onclick="return confirm('ยืนยันการลบผู้ใช้นี้?')">
														<button class="btn btn-danger" type="button">
															DELETE
														</button>
													</a>
													<?php
													}
													?>
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
            </div>
          </div>
		  
		  <?php 
			if(isset($_REQUEST['id']))
			{
				$result_list = $functions->GetSelectForEditOfficers($_REQUEST['id']);
		  ?>
		  <!--MODAL DIALOG-->
		  <form action="index?p=officers_list" method="post">
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
										<span class="help-block">Email</span>
										<input class="form-control" id="Email" name="Email" value="<?php echo $result_list['Email']; ?>" type="text" placeholder="Email" required>
									</div>
									<div class="col-md-6">
										<span class="help-block">Password</span>
										<input class="form-control" id="Password" name="Password" disabled value="<?php echo md5('jk2x*ssz'.$result_list['Password']); ?>" type="password" placeholder="Password" required>
									</div>
									<div class="col-md-6">
										<span class="help-block">Name</span>
										<input class="form-control" id="Name" name="Name"  value="<?php echo $result_list['Officer_name']; ?>" type="text" placeholder="Name" required>
									</div>
									<div class="col-md-6">
										<span class="help-block">LastName</span>
										<input class="form-control" id="LastName" name="LastName"  value="<?php echo $result_list['Officer_lastname']; ?>" type="text" placeholder="LastName" required>
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