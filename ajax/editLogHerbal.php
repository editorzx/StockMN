<?php
session_start();
if(!isset($_SESSION["token"])) 
	exit(0);
include("../function/kdxr_function.php");

if(isset($_GET['id'])){
	
	$functions = new kdxr_function();
	$id = $_GET['id'];
	$data = $functions->getInfoLogHerbal($id);
	$output = array('code' => 200,'success' => array('message'=> $data));
	echo json_encode($output);
	exit(0);
}elseif(isset($_POST['id']) && isset($_POST['priceHerbal']) && isset($_POST['quantityHerbal']) && isset($_POST['expireDate'])){
	
	$functions = new kdxr_function();
	$id = $_POST['id'];
	$priceHerbal = $_POST['priceHerbal'];
	$quantityHerbal = $_POST['quantityHerbal'];
	$expireDate = $_POST['expireDate'];
	
	$data = $functions->updateInfoLogHerbal($id, $priceHerbal, $quantityHerbal, $expireDate);
	$output = array('code' => 200,'success' => array('message'=> $data));
	echo json_encode($output);
	exit(0);
}else{
	$output = array('code' => 400,'error' => array('message'=> 'bad request'));
	echo json_encode($output);
	exit(0);
}
?>