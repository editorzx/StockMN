<?php 
// Include the main TCPDF library (search for installation path).
require_once('../function/tcpdf/tcpdf.php');

function generatePDF($title, $body, $filename, $headertitle){
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator("KDXR");
	$pdf->SetAuthor('KDXR');
	$pdf->SetTitle($title);
	$pdf->SetFont('freeserif', '', 10, '', true);

	
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, $headertitle);
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	
	//$pdf->SetAutoPageBreak(true, 0);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	$pdf->AddPage();
	$pdf->writeHTML($body, true, false, true, false, '');
	$pdf->lastPage();
	$pdf->Output($filename, 'I');
}


function generatePDF_2Page($title, $body, $body2, $filename, $headertitle){
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator("KDXR");
	$pdf->SetAuthor('KDXR');
	$pdf->SetTitle($title);
	$pdf->SetFont('freeserif', '', 8, '', true);

	
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, $headertitle);
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	
	//$pdf->SetAutoPageBreak(true, 0);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	$pdf->AddPage();
	$pdf->writeHTML($body, true, false, true, false, '');
	
	$pdf->AddPage();
	$pdf->writeHTML($body2, true, false, true, false, '');
	$pdf->lastPage();
	$pdf->Output($filename, 'I');
}
?>