<?php
session_start();
include("../function/kdxr_function.php");
require_once "../function/sql_inject.php";
$bDestroy_session = TRUE;
$url_redirect = '../index.php';
$sqlinject = new sql_inject('../log_file_sql.log',$bDestroy_session,$url_redirect);

$Email = $_POST['email'];
$Pass = md5('jk2x*ssz'.$_POST['password']);
$Name = $_POST['name'];
$Lastname = $_POST['lastname'];
$Grade = $_POST['grade'];

if(isset($Email) && isset($Pass) && isset($Name) && isset($Lastname) && isset($Grade)){
	
	$functions = new kdxr_function();
	
	$sqlinject->test($Email);
	$sqlinject->test($Pass);
	$sqlinject->test($Name);
	$sqlinject->test($Lastname);
	
	$result = $functions->GetExistUser($Email);
	if($result != 0){
		$_SESSION['statement'] = 100; //Exist Email
		header ('Location: ../index?p=officers_list');
	}else{
		$adduser = $functions->insertUser($Email,$Pass,$Grade,$Name,$Lastname);
		$_SESSION['statement'] = $result['code'];
		header ('Location: ../index?p=officers_list');
	}
}
elseif( empty($Email) || empty($Pass) || empty($Name) || empty($Lastname) || empty($Grade) ){
		$_SESSION['statement'] = 300;
		header ('Location: ../index?p=officers_list');
}else{
	header ('Location: ../index');
}

?>