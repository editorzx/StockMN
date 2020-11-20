<?php
session_start();
include("../function/kdxr_function.php");
//require_once "../function/sql_inject.php";
//$bDestroy_session = TRUE;
//$url_redirect = '../index.php';
//$sqlinject = new sql_inject('../log_file_sql.log',$bDestroy_session,$url_redirect);


if(isset($_REQUEST['data'])){
	
	$data = json_decode($_REQUEST['data']);
	$functions = new kdxr_function();
	
	//$sqlinject->test($Email);
	//var_dump($data);
	if(isset($_REQUEST['type'])){
		$pkid = $functions->insertMedicalData($functions->GetOffierStatusForInsert($_SESSION['token'])['result']['Id']);
		foreach($data as $value){
		
			$result = $functions->insertmedical($pkid,$value->id,$value->partner,$value->quantity,$value->price);
		}
	}
	else{
		$pkid = $functions->insertDrugData($functions->GetOffierStatusForInsert($_SESSION['token'])['result']['Id']);
		foreach($data as $value){
		
			$result = $functions->insertDrug($pkid,$value->id,$value->partner,$value->quantity,$value->price,$value->expiredate);
		}
	}
	
}
?>