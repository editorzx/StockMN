<?php 
session_start();
if(!isset($_SESSION["token"])) 
	exit(0);
// Include the main TCPDF library (search for installation path).
require_once('report_function.php');
include ('../config/lang.php');
//




$url_ajax = "http://$_SERVER[HTTP_HOST]/report";
$html = file_get_contents('http://kdxr.xyz/stockmn/api/report_outstock');
generatePDF(GOBAL_NAME, $html, 'report_outstock'.date("Ymdhis").'.pdf', 
					MINGOBAL_NAME);


?>
