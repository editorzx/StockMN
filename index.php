<?php
session_start();
#include ('config/connect.php');
include ('config/lang.php');
include ('function/kdxr_function.php');
$functions = new kdxr_function();
$web_settings = $functions->getWebSettings();
define("MINIMUM_HERBAL", $web_settings['minstockAlert']);
define("MINIMUM_MEDICAL", $web_settings['minstockAlert']);
define("MINIMUM_DATE_ALERT", $web_settings['mindateAlert']);
define("WEB_NAME", $web_settings['web_name']);
	
header('Content-Type: text/html; charset=utf-8');
?>
<html lang="en">
  <head>
  <?php include("template/header.php"); ?>
  </head>
   <body class="c-app c-dark-theme c-no-layout-transition">
   
	<?php 
		if(!isset($_SESSION["token"]) ) 
		{ 
			header("Location: login");	
			//echo '<script language="javascript">window.location.href = "./Login"</script>';
			exit();
		}else{
			include("controller/web_settings.php");
			if($functions->GetOfficerStatusByToken($_SESSION["token"])['result'] == 0){
				echo "<script type='text/javascript'>alert('พบการเข้าสู่ระบบซ้ำซ้อน');location='index?p=logout'</script>";
				//exit();
			}
			if(isset($_GET['p'])){
				if(file_exists("page/".trim($_GET['p']).".php"))
				{
					require_once("page/".trim($_GET['p']).".php");
					///Require controller
					if(file_exists("controller/".trim($_GET['p']).".php"))
					{
						include("controller/".trim($_GET['p']).".php");
					}
				}
				else include("page/404.php");
			}else{ 
				
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
                        <div>ข้อมูลยาสมุนไพร</div>
                      </div>
                      <div class="btn-group">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="c-icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                          </svg>
                        </button>
                       <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="index?p=herbal-info">แก้ไขยาสมุนไพร</a></div>
                      </div>
                    </div>
                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
						<canvas class="chart" id="card-chart1" height="70"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-6">
                  <div class="card text-white bg-gradient-warning">
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                      <div>
                        <div class="text-value-lg"><?php echo $functions->GetCountDB('medical_list');?></div>
                        <div>ข้อมูลเวชภัณฑ์</div>
                      </div>
                      <div class="btn-group">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="c-icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                          </svg>
                        </button>
                       <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="index?p=medical-info">แก้ไขเวชภัณฑ์</a></div>
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
             </div>
			 
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
					กราฟยอดขายประจำเดือน 
					<?php 
						echo "<b>".$functions->kdxrFormatDate(strtotime(date("Y/m/d H:i:s")), "m")."</b>"
					?>
					</div>
                    <div class="card-body">
                      <div class="row content-center">
                        <div class="col-sm-12">
                          <div class="c-chart-wrapper">
								<canvas id="sellherbal_monthly"></canvas>
							</div>
                        </div>
                        <hr class="mt-0">
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div> 
			  
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