<?php 
if(!isset($_REQUEST['date']))
	exit(0);

require_once('../function/kdxr_function.php');
$functions = new kdxr_function();



$date = $_REQUEST['date'];
?>

<style>

*{
	
}

th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #3f4240;
  color: white;
  font-weight: bold;
  font-size: 1.3em;
}

td{
	border: 1px solid #ddd;
	border-collapse: collapse;
	margin: 10px;
	font-size: 14px;
	line-height: 20px;
	text-align: center;
}

table{
	border: 1px solid #ddd;
	padding: 0 0;
}

</style>

<h3 style="text-align:center;">
รายงานยอดขายประจำวันที่ <br><?php echo $functions->thai_date(strtotime($date));?>
</h3>
<table>
<thead>
  <tr>
	<th style="width:6%;text-align: center;">ลำดับ</th>
	<th style="width:20%;text-align: left;"><b>ผู้จ่าย</b></th>
	<th style="width:10%;text-align: left;">ชื่อยา</th>
	<th style="width:15%;text-align: left;">สถานะ</th>
	<th style="width:10%;text-align: right;">จำนวน</th>
	<th style="width:10%;text-align: left;">หน่วยนับ</th>
	<th style="width:10%;text-align: right;font-size:13px !important;">ราคา/หน่วย</th>
	<th style="width:10%;text-align: right">ราคารวม</th>
	<th style="width:15%;text-align: center;">หมายเหตุ</th>
  </tr>
</thead>
<tbody>
	<?php
		$result_list = $functions->getViewSelledHerbal_ForReport($date);
		$sumQuantity = 0;
		$sumPrice = 0;
		foreach ($result_list['result'] as $key => $row) 
		{
			$sumQuantity += $row['Quantityonly'];
			$sumPrice += $row['sumQuantity'];
	?>
	<tr nobr="true">
		<td style="width:6%;text-align: center;">
			<?php echo ++$key;?>
		</td>
		<td style="width:20%;text-align: left;">
			<?php echo $row['FullName']; ?>
		</td>
		<td style="width:10%;text-align: left;">
			<?php echo $row['HerbalName']; ?>
		</td>
		<td style="width:15%;text-align: left;">
			<?php echo $row['Status']; ?>
		</td>
		<td style="width:10%;text-align: right;">
			<?php echo $row['Quantity']; ?>
		</td>
		<td style="width:10%;text-align: left;">
			<?php echo $row['Counting']; ?>
		</td>
		<td style="width:10%;text-align: right;">
			<?php echo $row['Price']; ?>
		</td>
		<td style="width:10%;text-align: right;">
			<?php echo $row['sumQuantity']; ?>
		</td>
		<td style="width:15%;text-align: center;">
			<?php 
				echo " จากคลัง  <b>" . $row['lotName']." </b>"; //$functions->thai_date_and_time(strtotime($row['outDate']))
			?>
		</td>
	</tr>
	<?php
		}
	?>
	
	<tr>
		<td style="text-align: center;" colspan="4">
		</td>
		<td style="text-align: right;" colspan="1">
			<b><?php echo $sumQuantity;?></b> 
		</td>
		<td></td>
		<td style="text-align: right;" colspan="2">
			<b><?php echo number_format((float)$sumPrice, 2, '.', '');;?></b>
		</td>
	</tr>
</tbody>
</table>