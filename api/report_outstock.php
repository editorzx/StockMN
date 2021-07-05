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
	<h2 style="text-align:center;">รายงานยาสมุนไพรคงเหลือคลังนอก <?php echo $functions->thai_date(strtotime(date('Y-m-d')));?></h2>
	<h3 style="text-align:center;">ยาสมุนไพร</h3>
	<table>
	<thead>
	  <tr>
		<th style="width:5%;text-align: center;"></th>
		<th style="width:55%;text-align: center;"><b>ชื่อยาสมุนไพร</b></th>
		<th style="width:40%;text-align: center;">จำนวนคงเหลือ</th>
	  </tr>
	</thead>
	<tbody>
		<?php
			$result_list = $functions->getViewCheckOutStockHerbal_ForReport();
			foreach ($result_list['result'] as $key => $row) 
			{
		?>
		<tr nobr="true">
			<td style="width:5%;text-align: center;">
				<?php echo ++$key;?>
			</td>
			<td style="width:55%;text-align: center;">
				<?php echo $row['herbalName'] ?>
			</td>
			<td style="width:40%;text-align: center;">
				<?php 
					echo $row['quantity']; 
				?>
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
	</table>