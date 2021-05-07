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
			$pkid = $functions->sellHerbalData($functions->GetOffierStatusForInsert($_SESSION['token'])['result']['Id']);
			foreach($data as $value){
				$result = $functions->sellHerbal($pkid,$value->id,$value->quantity,$value->price,$value->status);
			}
			echo "Success";
		}
	}
	
}
?>