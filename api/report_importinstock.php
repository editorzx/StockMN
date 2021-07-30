<?php 
if(!isset( $_REQUEST['type']))
	exit(0);

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
	font-size: 14px;
}

table{
	border: 1px solid #ddd;
	padding: 0 0;
}

</style>

<?php
	if($type === 'herbal')
	{
?>
	<h3 style="text-align:center;">รายงานรายละเอียดการนำเข้ายาสมุนไพรและเวชภัณฑ์<br>ระหว่างวันที่ <?php echo $functions->thai_date(strtotime($start)) . " ถึง " . $functions->thai_date(strtotime($end)) ;?></h3>
	<h3 style="text-align:center;">ยาสมุนไพร</h3>
	<table>
	<thead>
	  <tr>
		<th style="width:5%;text-align: center;">ลำดับ</th>
		<th style="width:20%;text-align: left;">ชื่อผู้นำเข้า</th>
		<th style="width:15%;text-align: left;"><b>ชื่อยาสมุนไพร</b></th>
		<th style="width:15%;text-align: left;"><b>ประเภท</b></th>
		<th style="width:10%;text-align: right;"><b>ราคา(บาท)</b></th>
		<th style="width:10%;text-align: right;">จำนวน</th>
		<th style="width:15%;text-align: center;">วันที่นำเข้า</th>
		<th style="width:15%;text-align: center;">วันหมดอายุ</th>
	  </tr>
	</thead>
	<tbody>
		<?php
			$result_list = $functions->getViewImportedHerbal_ForReport($start,$end);
			foreach ($result_list['result'] as $key => $row) 
			{
		?>
		<tr nobr="true">
			<td style="width:5%;text-align: center;">
				<?php echo ++$key;?>
			</td>
			<td style="width:20%;text-align: left;">
				<?php echo $row['FullName'] ?>
			</td>
			<td style="width:15%;text-align: left;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
				<?php echo $row['herbalName'] ?>
			</td>
			<td style="width:15%;text-align: left;">
				<?php echo $row['typeName'] ?>
			</td>
			<td style="width:10%;text-align: right;">
				<?php echo $row['price'] ?>
			</td>
			<td style="width:10%;text-align: right;">
				<?php echo $row['quantity'] ?>
			</td>
			<td style="width:15%;font-size:12px;text-align: center; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
				<?php echo $functions->thai_date(strtotime($row['importDate'])); ?>
			</td>
			<td style="width:15%;font-size:12px;text-align: center; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
				<?php echo $functions->thai_date(strtotime($row['expireDate'])); ?>
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
		<th style="width:15%;text-align: left;"></th>
		<th style="width:30%;text-align: left;"><b>ชื่อเวชภัณฑ์</b></th>
		<th style="width:15%;text-align: right;"><b>ราคา</b></th>
		<th style="width:15%;text-align: left;">จำนวน</th>
		<th style="width:20%;text-align: center;">วันที่นำเข้า</th>
	  </tr>
	</thead>
	<tbody>
		<?php
			$result_list = $functions->getViewImportedMedical_ForReport($start,$end);
			foreach ($result_list['result'] as $key => $row) 
			{
		?>
		<tr nobr="true">
			<td style="width:5%;text-align: center;">
				<?php echo ++$key;?>
			</td>
			<td style="width:15%;text-align: left;">
				<?php echo $row['FullName'];?>
			</td>
			<td style="width:30%;text-align: left;">
				<?php echo $row['name'] ?>
			</td>
			<td style="width:15%;text-align: right;">
				<?php echo $row['price'] ?>
			</td>
			<td style="width:15%;text-align: left;">
				<?php echo $row['quantity'] ?>
			</td>
			<td style="width:20%;text-align: center;">
				<?php echo $functions->thai_date(strtotime($row['importDate'])); ?>
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