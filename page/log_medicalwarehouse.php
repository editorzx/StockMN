<?php
if(!isset($_SESSION["token"])) 
	exit(0);

	if (isset($_GET['page'])) {
		$currentPage = $_GET['page'];
	} else {
		$currentPage = 1;
	}
	
	if (isset($_GET['show'])) {
		$perPage = $_GET['show'];
	} else {
		$perPage = 10;
	}
	$total_items = $functions->getImportMedicalData($currentPage, $perPage)['totalItems'];
	
	if(isset($_POST['entervalue']))
	{
		$id = $_REQUEST['idp'];
		$price = $_REQUEST['price'];
		$quantity = $_REQUEST['quantity'];
		$expire = $_REQUEST['expire'];
		
		$msg = '';
		switch ($functions->EditInfoWarehouse($id,$quantity,$price,$expire)) {
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
						<div class="card">
							<div class="card-header">
								<i class="fa fa-align-justify"></i> รายการนำเข้าเวชภัณฑ์
								<div class="card-header-actions">
									<span class="card-header-action">
										<small class="text-muted">Total items : <?php echo $total_items;?></small>
									</span>
								</div>
							</div>
							<div class="card-body">
								<div class="btn-toolbar mb-1 justify-content-end" role="toolbar">
									<div class="btn-group mr-1" role="group" aria-label="First group">
										<button class="btn btn-sm btn-secondary dropdown-toggle" id="btnShowing" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo $perPage;?>
										</button>
										<div class="dropdown-menu" aria-labelledby="btnShowing">
											<a class="dropdown-item" id="showdatabtn" data="5">5</a>
											<a class="dropdown-item" id="showdatabtn" data="10">10</a>
											<a class="dropdown-item" id="showdatabtn" data="15">15</a>
											<a class="dropdown-item" id="showdatabtn" data="20">20</a>
										</div>
									</div>
								</div>
								<table class="table table-responsive-sm table-bordered table-striped table-sm">
									<thead>
										<tr class="text-center">
											<th>#</th>
											<th>ชื่อ - นามสกุล</th>
											<th>วันที่</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$result_list = $functions->getImportMedicalData($currentPage, $perPage);
										$total_pages = $result_list['counting'];
										foreach ($result_list['result'] as $key=>$row) 
										{
										?>
										<tr class="text-center">
											<td><?php echo $key+1;?></td>
											<td><?php echo $row['FullName'] ?></td>
											<td>
												<?php echo $functions->thai_date_and_time(strtotime($row['date'])); ?>
											</td>
											<td>
												<span class="badge badge-success" id="viewResultLogMedical" data-id="<?php echo $row['Id'] ?>">ดูรายละเอียด</span>
											</td>
										</tr>
										<?php
										}
										?>
									</tbody>
								</table>
								<nav>
									<ul class="pagination justify-content-end">
										<li class="page-item <?php if($currentPage <= 1){ echo 'disabled'; } ?>">
											<a class="page-link" id="paginateButton" data="<?php echo ($currentPage - 1); ?>">Prev</a>
										</li>
										<?php
											for($int = 1; $int <= $total_pages; $int++)
											{
										?>
											<li class="page-item <?php if($int == $currentPage) echo "active" ?>">
												<a class="page-link" id="paginateButton" data="<?php echo ($int); ?>"><?php echo $int;?></a>
											</li>
										<?php
											}
										?>
										<li class="page-item <?php if($currentPage >= $total_pages){ echo 'disabled'; } ?>">
											<a class="page-link" id="paginateButton" data="<?php echo ($currentPage + 1); ?>">Next</a>
										</li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
            </div>
          </div>
		</div>
	   </main>
	   <?php include ('template/ending.php'); ?>
	  </div>
	 </div>