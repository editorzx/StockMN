<?php 
session_start();
if(!isset($_SESSION["token"])) 
	exit(0);
// Include the main TCPDF library (search for installation path).
require_once('report_function.php');
include ('../config/lang.php');
//


if(isset($_REQUEST['start']) && isset($_REQUEST['end'])){
	$start_date = $_REQUEST['start'];
	$end_date = $_REQUEST['end'];
	$url_ajax = "http://$_SERVER[HTTP_HOST]/report";
	$html = file_get_contents('http://kdxr.xyz/stockmn/api/report_sell_daterange?start='.$start_date.'&end='.$end_date);

	generatePDF(GOBAL_NAME, $html, 'report_sell'.date("Ymdhis").'.pdf', 
				MINGOBAL_NAME);
}else{
	exit(0);
}
?>
