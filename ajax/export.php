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
		if($_REQUEST['type'] == "herbal"){
			foreach($data as $value){
				$pkid = $functions->exportHerbalData();
				$result = $functions->exportHerbal($pkid,$value->id,$value->quantity);
				
				//$rs2 = $functions->importHerbalOutstock($pkid, $value->quantity);
			}
		}
		else{
			foreach($data as $value){
				$pkid = $functions->exportMedicalData($functions->GetOffierStatusForInsert($_SESSION['token'])['result']['Id'],$value->quantity,$value->price);
				$result = $functions->exportmedical($pkid,$value->id,$value->quantity);
			}
		}
	}
	
}
?>