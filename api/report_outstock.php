<?php 
require_once('../function/kdxr_function.php');
$functions = new kdxr_function();
?>

<style>


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
	font-size: 17px;
}

table{
	border: 1px solid #ddd;
	padding: 0 0;
}

</style>
	<h3 style="text-align:center;">รายงานยาสมุนไพรคงเหลือคลังนอก <br><?php echo $functions->thai_date(strtotime(date('Y-m-d')));?></h3>
	<h3 style="text-align:center;">ยาสมุนไพร</h3>
	<table>
	<thead>
	  <tr>
		<th style="width:10%;text-align: center;">ลำดับ</th>
		<th style="width:50%;text-align: left;"><b>ชื่อยาสมุนไพร</b></th>
		<th style="width:20%;text-align: right;">จำนวนคงเหลือ</th>
		<th style="width:20%;text-align: left;"><b>หน่วยนับ</b></th>
	  </tr>
	</thead>
	<tbody>
		<?php
			$result_list = $functions->getViewCheckOutStockHerbal_ForReport();
			foreach ($result_list['result'] as $key => $row) 
			{
		?>
		<tr nobr="true">
			<td style="width:10%;text-align: center;">
				<?php echo ++$key;?>
			</td>
			<td style="width:50%;text-align: left;">
				<?php echo $row['herbalName'] ?>
			</td>
			<td style="width:20%;text-align: right;">
				<?php 
					echo $row['quantity']; 
				?>
			</td>
			<td style="width:20%;text-align: left;">
				<?php echo $row['Counting'] ?>
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
	</table>