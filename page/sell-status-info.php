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
		$Name = $_REQUEST['Name'];
		
		$msg = '';
		switch ($functions->editStatusList($id,$Name)) {
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
		switch ($functions->deleteStatusList($_GET['remid'])) {
		  case 0:
			$msg = 'ไม่สำเร็จ';
			break;
		  case 1:
			$msg = 'ลบเรียบร้อย';
			break;
		  default:
			$msg = 'ไม่สำเร็จ';
		}
		echo "<script type='text/javascript'>alert('$msg');location='index?p=sell-status-info'</script>";
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
							<div class="card-header"><small>ข้อมูลสถานะการเบิกจ่าย/ขาย</small></div>
							<div class="card-body">
								<div class="row justify-content-end">
									<div class="col-md-auto mb-1">
										<button class="btn btn-sm btn-square btn-behance" data-toggle="modal" data-target="#addstatus" type="button">
											<svg class="c-icon mr-2">
											<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-thick-top"></use>
											</svg>
											<span>เพิ่มรายการ</span>
										</button>
									</div>
								</div>
								<table class="table table-responsive-sm table-hover table-outline mb-0">
									<thead class="thead-light">
									  <tr>
										<th></th>
										<th class="text-center">ชื่อสถานะ</th>
										<th class="text-right"></th>
									  </tr>
									</thead>
									<tbody>
										<?php
											$result_list = $functions->getStatusList();
											foreach ($result_list as $key=>$row) 
											{
										?>
										<tr>
											<td>
												<?php echo $key+1;?>
											</td>
											<td class="text-center">
												<?php echo $row['name'];  ?>
											</td>
											<td class="text-right">
												<a href="index?p=sell-status-info&id=<?php echo $row["id"];?>">
													<button class="btn btn-secondary" type="button">แก้ไข</button>
												</a>
												<a href="index?p=sell-status-info&remid=<?php echo $row["id"];?>" onclick="return confirm('ยืนยันการลบ?')">
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
	