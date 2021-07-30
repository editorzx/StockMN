<?php 

require_once('../function/kdxr_function.php');
$functions = new kdxr_function();

$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : date("Y-m-d");
$end = isset($_REQUEST['end']) ? $_REQUEST['end'] : date("Y-m-d");

$type = $_REQUEST['type'];
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
<h2 style="text-align:center;">
รายงานรายละเอียดการเบิกยาสมุนไพรและเวชภัณฑ์จากคลังใน <br> <?php echo $functions->thai_date(strtotime($start)) . " ถึง " . $functions->thai_date(strtotime($end));?>
</h3>
<?php
	if($type === 'herbal')
	{
?>
	<h3 style="text-align:center;">ยาสมุนไพร</h3>
	<table>
	<thead>
	  <tr>
		<th style="width:5%;text-align: center;">ลำดับ</th>
		<th style="width:25%;text-align: left;"><b>ผู้เบิก</b></th>
		<th style="width:25%;text-align: left;"><b>ชื่อยาสมุนไพร</b></th>
		<th style="width:20%;text-align: center;">วันที่เบิก</th>
		<th style="text-align: right;width:10%;">จำนวน</th>
		<th style="text-align: left;width:15%;">หน่วยนับ</th>
	  </tr>
	</thead>
	<tbody>
		<?php
			$result_list = $functions->getHerbalIntoout_ForReport($start,$end);
			foreach ($result_list['result'] as $key => $row) 
			{
		?>
		<tr nobr="true">
			<td style="width:5%;text-align: center;">
				<?php echo ++$key;?>
			</td>
			<td style="width:25%;text-align: left;">
				<?php echo $row['FullName'] ?>
			</td>
			<td style="width:25%;text-align: left;">
				<?php echo $row['HerbalName'] ?>
			</td>
			<td style="width:20%;text-align: center;">
				<?php 
					echo $functions->thai_date(strtotime($row['Date'])); 
				?>
			</td>
			<td style="text-align: right;width:10%;">
				<?php echo $row['Quantity'];  ?>
			</td>
			<td style="text-align: left;width:15%;">
				<?php echo $row['CountingName'];  ?>
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
	</table>
<?php
	}else{
?>
	<h3 style="text-align:center;">เวชภัณฑ์</h3>
	<table>
	<thead>
	  <tr>
		<th style="width:5%;text-align: center;">ลำดับ</th>
		<th style="width:25%;text-align: left;"><b>ผู้เบิก</b></th>
		<th style="width:15%;text-align: left;"><b>ชื่อเวชภัณฑ์</b></th>
		<th style="width:20%;text-align: center;">วันที่เบิก</th>
		<th style="text-align: center;width:20%;">สถานะ</th>
		<th style="text-align: right;width:10%;">จำนวน</th>
		<th style="text-align: left;width:10%;">หน่วยนับ</th>
	  </tr>
	</thead>
	<tbody>
		<?php
			$result_list = $functions->getMedicalIntoout_ForReport($start,$end);
			foreach ($result_list['result'] as $key => $row) 
			{
		?>
		<tr nobr="true">
			<td style="width:5%;text-align: center;">
				<?php echo ++$key;?>
			</td>
			<td style="width:25%;text-align: left;">
				<?php echo $row['FullName'] ?>
			</td>
			<td style="width:15%;text-align: left;">
				<?php echo $row['MedicalName'] ?>
			</td>
			<td style="width:20%;text-align: center;">
				<?php 
					echo $functions->thai_date(strtotime($row['Date'])); 
				?>
			</td>
			<td style="text-align: left;width:20%;font-size: 15px;">
				<?php echo $row['status'];  ?>
			</td>
			<td style="text-align: right;width:10%;">
				<?php echo $row['Quantity'];  ?>
			</td>
			<td style="text-align: left;width:10%;">
				<?php echo $row['CountingName'];  ?>
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
	</table>
<?php
	}
?>