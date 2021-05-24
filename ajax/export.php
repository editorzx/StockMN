<?php
session_start();
if(!isset($_SESSION["token"])) 
	exit(0);

include("../function/kdxr_function.php");



if(isset($_REQUEST['data'])){
	
	$data = json_decode($_REQUEST['data']);
	$functions = new kdxr_function();
	

	if(isset($_REQUEST['type'])){
		if($_REQUEST['type'] == "herbal"){
			$officer_id = $functions->GetOffierStatusForInsert($_SESSION['token'])['result']['Id'];
			$pkid = $functions->exportHerbalData($officer_id);
			foreach($data as $value){
				$result = $functions->exportHerbal($pkid,$value->id,$value->quantity);
			}
		}
		else{
			$pkid = $functions->exportMedicalData($functions->GetOffierStatusForInsert($_SESSION['token'])['result']['Id']);
			foreach($data as $value){
				$result = $functions->exportmedical($pkid, $value->id, $value->quantity, $value->price);
			}
		}
		
		echo "success";
	}
	
}
?>