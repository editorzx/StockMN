<?php
session_start();
if(!isset($_SESSION["token"])) 
	exit(0);
include("../function/kdxr_function.php");

if(isset($_GET['id'])){
	
	$functions = new kdxr_function();
	$id = $_GET['id'];
	$data = $functions->getInfoLogMedical($id);
	$output = array('code' => 200,'success' => array('message'=> $data));
	echo json_encode($output);
	exit(0);
}elseif(isset($_POST['id']) && isset($_POST['price_mdc']) && isset($_POST['quan_mdc'])){
	
	$functions = new kdxr_function();
	$id = $_POST['id'];
	$price = $_POST['price_mdc'];
	$quan = $_POST['quan_mdc'];
	
	$data = $functions->updateInfoLogMdc($id, $price, $quan);
	$output = array('code' => 200,'success' => array('message'=> $data));
	echo json_encode($output);
	exit(0);
}else{
	$output = array('code' => 400,'error' => array('message'=> 'bad request'));
	echo json_encode($output);
	exit(0);
}
?>