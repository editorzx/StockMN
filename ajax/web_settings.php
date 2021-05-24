<?php
session_start();
include("../function/kdxr_function.php");
require_once "../function/sql_inject.php";
$bDestroy_session = TRUE;
$url_redirect = '../index.php';
$sqlinject = new sql_inject('../log_file_sql.log',$bDestroy_session,$url_redirect);

$web_name = $_POST['web_name'];
$minimum = $_POST['minimum'];
$minimum_date = $_POST['minimum_date'];


if(isset($web_name) && isset($minimum) && isset($minimum_date) && isset($_SESSION['token'])){
	
	$functions = new kdxr_function();
	
	$sqlinject->test($web_name);
	$sqlinject->test($minimum);
	$sqlinject->test($minimum_date);
	
	$result = $functions->updateWebSettings($web_name,$minimum,$minimum_date);
	
	if($result){
		$output = array('code' => 200, 'status' => 'success', 'data' => array('message'=> $result));
	}else{
		$output = array('code' => 100, 'status' => 'error', 'data' => array('message'=> "ผิดพลาดทางระบบ"));
	}
}
else{
	$output = array('code' => 100, 'status' => 'error', 'data' => array('message'=> "ระบบผิดพลาด"));
}

echo json_encode($output);
exit(0);
?>