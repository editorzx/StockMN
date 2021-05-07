<?php
session_start();
if(!isset($_SESSION["token"])) 
	exit(0);

include("../function/kdxr_function.php");


	

$functions = new kdxr_function();
	
$result = $functions->getTopSellingHerbal_Month(date('m'));
$output = array();

foreach ($result['result'] as $key => $row) 
{
	array_push($output,array('herbalName' => $row['herbalName'], 'sellQuantity' => $row['val_sum']));
}

array_push($output, array('totalQuantity' => $result['totalQuantity']));

echo json_encode($output, JSON_UNESCAPED_UNICODE );
?>