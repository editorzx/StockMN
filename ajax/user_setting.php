<?php
session_start();
include("../function/kdxr_function.php");
require_once "../function/sql_inject.php";
$bDestroy_session = TRUE;
$url_redirect = '../index.php';
$sqlinject = new sql_inject('../log_file_sql.log',$bDestroy_session,$url_redirect);

$Pass = $_POST['password'];
$Pass2 = $_POST['password2'];
//$Pass = md5('jk2x*ssz'.$_POST['pass']);

if(isset($Pass) && isset($Pass2) && isset($_SESSION['token'])){
	
	$functions = new kdxr_function();
	
	$sqlinject->test($Pass);
	$sqlinject->test($Pass2);
	
	if($Pass !== $Pass2){
		$output = array('code' => 100, 'status' => 'error', 'data' => array('message'=> "รหัสผ่านไม่ตรงกัน"));
	}else{
		$result = $functions->updateUser($_SESSION['token'], md5('jk2x*ssz'.$Pass));
		
		if($result){
			$output = array('code' => 200, 'status' => 'success', 'data' => array('message'=> $result));
		}
	}
}
elseif( empty($Pass) || empty($Pass2) ){
	$output = array('code' => 100, 'status' => 'error', 'data' => array('message'=> "กรุณากรอกข้อมูลให้ครบถ้วน หรือ ระบบอาจผิดพลาด"));
}else{
	$output = array('code' => 100, 'status' => 'error', 'data' => array('message'=> "กรุณากรอกข้อมูลให้ครบถ้วน หรือ ระบบอาจผิดพลาด"));
}

echo json_encode($output);
exit(0);
?>