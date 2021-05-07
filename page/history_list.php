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
$total_items = $functions->getImportHerbalData($currentPage, $perPage)['totalItems'];
	
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
							<div class="card-header"><small>ประวัติการเบิกจ่าย เวชภัณฑ์</small></div>
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
								<div class="list-group">
									<?php
										$result_list = $functions->getHistoryMedical($currentPage, $perPage);
										$total_pages = $result_list['counting'];
										foreach ($result_list['result'] as $row) 
										{

									?>
									<div class="list-group-item list-group-item-action flex-column align-items-start">
									  <p class="mb-1">
										<?php echo sprintf(EXPORTMEDICAL_STRING,$row['OFName'],$row['Name'],$row['Quantity'],$row['Counting'],$row['Price']);?> 
									  </p>
									 <small class="text-muted"><?php echo $functions->time_elapsed_string($row['Date']);?></small>
									</div>
									<?php
										}
									?>
								</div>
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
        </main>
		 <?php include ('template/ending.php'); ?>
      </div>
	  </div>
	 </div>
	