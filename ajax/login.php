<?php
session_start();
include("../function/kdxr_function.php");
require_once "../function/sql_inject.php";
$bDestroy_session = TRUE;
$url_redirect = '../index.php';
$sqlinject = new sql_inject('../log_file_sql.log',$bDestroy_session,$url_redirect);

$Email = $_POST['email'];
//$Pass = md5($_POST['pass']);
$Pass = md5('jk2x*ssz'.$_POST['pass']);

if(isset($Email) && isset($Pass)){
	
	$functions = new kdxr_function();
	
	$sqlinject->test($Email);
	$sqlinject->test($Pass);
	
	$result = $functions->checkuser($Email,$Pass);
	if($result['state']){
		$_SESSION['admin'] = $result['state']['isAdmin'];
		$_SESSION['token'] = $result['state']['Token'];
		header ('Location: ../index');
	}else{
			$_SESSION['statement'] = $result['code'];
			header ('Location: ../index');	
	}
}
elseif( empty($Email) || empty($Pass) ){
		$_SESSION['statement'] = 300;
		header ('Location: ../index');	
}else{
	header ('Location: ../index');
}

?>