<?php
session_start();
if(!isset($_SESSION["token"])) 
	exit(0);
include("../function/kdxr_function.php");

if(isset($_REQUEST['id'])){
	
	$functions = new kdxr_function();
	$id = $_REQUEST['id'];
	$data = $functions->getResultHerbal_Outstock_Detail($id);
	$output = array('code' => 200,'success' => array('message'=> $data));
	echo json_encode($output);
	exit(0);
}else{
	$output = array('code' => 400,'error' => array('message'=> 'bad request'));
	echo json_encode($output);
	exit(0);
}
?>