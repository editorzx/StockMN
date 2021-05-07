<?php 
session_start();
if(!isset($_SESSION["token"])) 
	exit(0);
// Include the main TCPDF library (search for installation path).
require_once('report_function.php');
include ('../config/lang.php');
//




$url_ajax = "http://$_SERVER[HTTP_HOST]/report";
$html = file_get_contents('http://kdxr.xyz/stockmn/api/report_instock?type=herbal');

$html_medical = file_get_contents('http://kdxr.xyz/stockmn/api/report_instock?type=medical');

generatePDF_2Page(GOBAL_NAME, $html, $html_medical, 'report_instock'.date("Ymdhis").'.pdf', 
					MINGOBAL_NAME);


?>
