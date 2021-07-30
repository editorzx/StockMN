<?php 
require_once('../function/kdxr_function.php');
$functions = new kdxr_function();



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
รายงานผลรายละเอียดยาสมุนไพร
</h3>
<table>
<thead>
  <tr>
	<th style="width:10%;text-align: center;">ลำดับ</th>
	<th style="width:30%;text-align: left;">ชื่อยาสมุนไพร</th>
	<th style="width:30%;text-align: left;">หน่วยนับ</th>
	<th style="width:30%;text-align: left;">ประเภท</th>
  </tr>
</thead>
<tbody>
	<?php
		$result_list = $functions->getDetailHerbal();
		foreach ($result_list['result'] as $key => $row) 
		{
	?>
	<tr nobr="true">
		<td style="width:10%;text-align: center;">
			<?php echo ++$key;?>
		</td>
		<td style="width:30%;text-align: left;">
			<?php echo $row['herbalName']; ?>
		</td>
		<td style="width:30%;text-align: left;">
			<?php echo $row['countingName']; ?>
		</td>
		<td style="width:30%;text-align: left;">
			<?php echo $row['typeName']; ?>
		</td>
	</tr>
	<?php
		}
	?>
</tbody>
</table>