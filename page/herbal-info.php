<?php 
if(!isset($_SESSION["token"])) 
	exit(0);
if(!($_SESSION['admin']))
	header("Location: index");	
?>
<?php
	if(isset($_POST['entervalue']))
	{
		$id = $_REQUEST['idp'];
		$Desc = $_REQUEST['Desc_name'];
		$Name = $_REQUEST['Name'];
		$Counting = $_REQUEST['Counting'];
		$Type = $_REQUEST['Type'];
		
		$msg = '';
		switch ($functions->EditInfoHerbal($id,$Name,$Desc,$Counting,$Type)) {
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
			$msg = 'ลบข้อมูลยาสมุนไพรเรียบร้อย';
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
								<div class="row justify-content-end">
									<div class="col-md-auto dropdown">
										<button class="btn btn-secondary dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">มุมมองการดู</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
										  <a class="dropdown-item" href="?p=herbal-info&sort=asc">ก-ฮ</a>
										  <a class="dropdown-item" href="?p=herbal-info&sort=desc">ฮ-ก</a>
										</div>
									</div>
									<div class="col-md-auto mb-1">
										<button class="btn btn-sm btn-square btn-behance" data-toggle="modal" data-target="#addherbal" type="button">
											<svg class="c-icon mr-2">
											<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-thick-top"></use>
											</svg>
											<span>เพิ่มยาสมุนไพร</span>
										</button>
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
												<a href="index?p=herbal-info&id=<?php echo $row["Id"];?>"><button class="form-control" type="button">แก้ไข</button></a>
											</td>
											<td>
												<a href="index?p=herbal-info&remid=<?php echo $row["Id"];?>" onclick="return confirm('ยืนยันการลบ?')">
													<button class="btn btn-danger" type="button">
														ลบ
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
        </main>
      </div>
	  </div>
	 </div>
	