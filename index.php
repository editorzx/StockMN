<?php
session_start();
#include ('config/connect.php');
include ('config/lang.php');
include ('function/kdxr_function.php');
$functions = new kdxr_function();

?>
<html lang="en">
  <head>
  <?php include("template/header.php"); ?>
  </head>
   <body class="c-app c-dark-theme c-no-layout-transition">
   
	<?php 
		if(!isset($_SESSION["token"]) ) 
		{ 
			header("Location: Login");	
		}else{
			if(isset($_GET['p'])){
			  if(file_exists("page/".trim($_GET['p']).".php")); else include("page/404.php");
				{
					require_once("page/".trim($_GET['p']).".php");
				}
			  }else{ 
			  
			  if($functions->GetOfficerStatusByToken($_SESSION["token"])['result'] == 0){
				  echo "<script type='text/javascript'>alert('พบการเข้าสู่ระบบซ้ำซ้อน');location='index?p=logout'</script>";
			  }
			  
	?>	
		
		<?php include ('template/left_menu.php'); ?>
		<div class="c-wrapper c-fixed-components">
		<?php include ('template/top_menu.php'); ?>
      <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
            <div class="fade-in">
				<!--INFO-->
              <div class="row">
                <div class="col-sm-6 col-lg-6">
                  <div class="card text-white bg-gradient-info">
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                      <div>
                        <div class="text-value-lg"><?php echo $functions->GetCountDB('herbal_list');?></div>
                        <div>ยาสมุนไพร</div>
                      </div>
                      <div class="btn-group">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="c-icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                      </div>
                    </div>
                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
						<canvas class="chart" id="card-chart1" height="70"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-6">
                  <div class="card text-white bg-gradient-dark">
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                      <div>
                        <div class="text-value-lg"><?php echo $functions->GetCountDB('medical_list');?></div>
                        <div>เวชภัณฑ์</div>
                      </div>
                      <div class="btn-group">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="c-icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                      </div>
                    </div>
                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"></div>
                  </div>
                </div>
                <!-- /.col-->
                <!--<div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-gradient-dark">
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                      <div>
                        <div class="text-value-lg"><?php echo $functions->GetCountDB('history_disbursement');?></div>
                        <div>การจ่าย</div>
                      </div>
                      <div class="btn-group">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="c-icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                      </div>
                    </div>
                    <div class="c-chart-wrapper mt-3 " style="height:70px;"></div>
                  </div>
                </div>-->
                <!-- /.col-->
                <!--<div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-gradient-dark">
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                      <div>
                        <div class="text-value-lg"><?php echo $functions->GetCountDB('imported');?></div>
                        <div>การนำเข้า</div>
                      </div>
                      <div class="btn-group">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="c-icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                      </div>
                    </div>
                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"></div>
                  </div>
                </div>-->
                <!-- /.col-->
            <!--  </div> -->
              <!-- /.row-->
             
			 <!--
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">Traffic &amp; Sales</div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-12">
                        
                          
                          <div class="progress-group mb-4">
                            <div class="progress-group-prepend"><span class="progress-group-text">Monday</span></div>
                            <div class="progress-group-bars">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                          <div class="progress-group mb-4">
                            <div class="progress-group-prepend"><span class="progress-group-text">Tuesday</span></div>
                            <div class="progress-group-bars">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 94%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                          <div class="progress-group mb-4">
                            <div class="progress-group-prepend"><span class="progress-group-text">Wednesday</span></div>
                            <div class="progress-group-bars">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                          <div class="progress-group mb-4">
                            <div class="progress-group-prepend"><span class="progress-group-text">Thursday</span></div>
                            <div class="progress-group-bars">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 91%" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                          <div class="progress-group mb-4">
                            <div class="progress-group-prepend"><span class="progress-group-text">Friday</span></div>
                            <div class="progress-group-bars">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 73%" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                          <div class="progress-group mb-4">
                            <div class="progress-group-prepend"><span class="progress-group-text">Saturday</span></div>
                            <div class="progress-group-bars">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                          <div class="progress-group mb-4">
                            <div class="progress-group-prepend"><span class="progress-group-text">Sunday</span></div>
                            <div class="progress-group-bars">
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 69%" aria-valuenow="69" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <hr class="mt-0">
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div> -->
			  
              <!-- /.row-->
            </div>
          </div>
        </main>
		
		<?php include ('template/ending.php'); ?>
      </div>
    </div>
	<?php
			  }
		}
	?>
  
  <?php include("template/footer.php"); ?>
  </body>
</html>