<?php
class kdxr_function {
	
	public function checkuser($email , $password){ //ตรวจสอบว่าผู้ใช้ถูกต้องหรือไม่
		$conn = self::connectDb();
		
		$sql = "SELECT * FROM officers where email = '".$email."' and password= '".$password."'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		switch ($row) {
		  case true:
			$code = 100;
			self::updateLogin($row['Id']); //อัพเดตการเข้าสู่ระบบโดย อัพเดต Token และ เวลาการเข้า
			$row['Token'] = self::GetToken($row['Id'])['Token']; //เก็บค่า Token ล่าสุดเพื่อใช้ในระบบ
			break;
		  case false:
			$code = 200;
			break;
		  default:
			$code = 200;
		}
		return ['code' => $code, 'state' => $row];
	}
	
	public function GetExistUser($email){ //ไม่ได้ใช้
		$conn = self::selfconnectDb();
		$sql = "SELECT * FROM officers where Email = '$email'";
		$result = mysqli_query($conn, $sql);
		$row_cnt = mysqli_num_rows($result);
		mysqli_free_result($result);
		return $row_cnt;
	}
	
	public function insertUser($email,$pass,$is,$name,$lastname){ //เพิ่มผู้ใช้
		$conn = self::connectDb();
		$sql = "insert into officers (Email,Password,isAdmin,Officer_name,Officer_lastname,Last_Login) values ('$email','$pass','$is','$name','$lastname','".date("Y-m-d H:i:s")."')";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function insertmedical($pkid,$medicalid,$partnerid,$quan,$price,$loter){ //นำเข้าเวชภัณฑ์
		$conn = self::connectDb();
		$sql = "insert into imported_medical_info (id_import_data,id_medical,id_partner,id_lot,import_quantity,import_price) values ('$pkid','$medicalid','$partnerid','$loter','$quan','$price')";
		$query = mysqli_query($conn, $sql);
		self::insertMedicalStock(mysqli_insert_id($conn),$quan);
		return $query;
	}
	
	public function insertMedicalData($officerid){ //เพิ่มข้อมูลการนำเข้า
		$conn = self::connectDb();
		$sql = "insert into imported_medical_data (id_officer,import_date) values ('$officerid','".date("Y-m-d H:i:s")."')";
		$query = mysqli_query($conn, $sql);
		return mysqli_insert_id($conn);
	}
	
	public function insertDrugData($officerid){ //เพิ่มข้อมูลการนำเข้า
		$conn = self::connectDb();
		$sql = "insert into imported_herbal_data (id_officers,date) values ('$officerid','".date("Y-m-d H:i:s")."')";
		$query = mysqli_query($conn, $sql);
		return mysqli_insert_id($conn);
	}
	
	public function insertDrug($pkid,$herbalid,$partnerid,$quan,$price,$expire,$lotter){ //นำเข้ายาสมุนไพร
		$conn = self::connectDb();
		$sql = "insert into imported_herbal_info (id_import_data,id_herbal,id_partner,id_lot,quantity,price,expire_date) values ('$pkid','$herbalid','$partnerid','$lotter','$quan','$price','$expire')";
		$query = mysqli_query($conn, $sql);
		self::insertStock(mysqli_insert_id($conn),$quan);
		return $query;
	}
	
	public function insetLog($pkid,$id_herbal,$quan){
		$conn = self::connectDb();
					
		$sql = "SELECT * FROM herbal_list where Id = '".$id_herbal."'";
		$result = mysqli_query($conn, $sql);
		$herbal_data = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$desc = "พนักงานทำการเพิ่มยาสมุนไพร ".$herbal_data['Name']." ลงในคลังจำนวน " . $quan;
		$sql = "insert into transaction_log_herbal (id_herbal_data,log_desc,date) values ('$pkid','$desc','".date("Y-m-d H:i:s")."')";
		$query = mysqli_query($conn, $sql);
	}
	
	private function insertStock($id,$quan){ //นำเข้ายาสมุนไพร ไปในสต๊อกใน
		$conn = self::connectDb();
		$sql = "insert into instock_herbal (id_import_info,quantity) values ('$id','$quan')";
		$query = mysqli_query($conn, $sql);
	}
	
	private function insertMedicalStock($id,$quan){ //นำเข้าเวชภัณฑ์ ไปสต๊อกใน
		$conn = self::connectDb();
		$sql = "insert into instock_medical (id_import_info,quantity) values ('$id','$quan')";
		$query = mysqli_query($conn, $sql);
	}
	
	public function getupdateMedicalStock($id){ //บันทึกค่าเวชภัณฑ์ล่าสุด ยังไม่เสร็จ
		$conn = self::connectDb();
		$sql = "SELECT a.quantity AS value_sum,a.id_import_info as IDs, a.id as IDx
				FROM instock_medical a
				INNER JOIN imported_medical_info b ON b.id = a.id_import_info
				where b.id_medical = '$id' and a.quantity > 0
				";
		$result = mysqli_query($conn, $sql);
		$posts = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
		
	public function exportMedicalData($officerid){ //บันทึกการจ่ายจากเวชภัณฑ์
		$conn = self::connectDb();
		$sql = "insert into exported_medical_data (id_officers,out_date) values ('$officerid','".date("Y-m-d H:i:s")."')";
		$query = mysqli_query($conn, $sql);
		return mysqli_insert_id($conn);
	}
	
	public function exportmedical($pkid,$id,$need,$price){ //บันทึกการจ่ายจากเวชภัณฑ์
		$result_list = self::getupdateMedicalStock($id);
		$vl = 0;
		$test = "";
		foreach ($result_list['result'] as $row) 
		{	
			$getvl = $row['value_sum'];
			$ids = $row['IDs'];
			$idx = $row['IDx'];
			if($vl < $need)
			{
				if($getvl >= 1)
				{
					$newx = 0; //new value
					if($getvl >= $need)
					{
						$vl = $getvl + $vl;
						if($vl >= $need){
							$newx = $vl - $need;
							//$vl = $vl - $newx;
							$vl = $getvl - $newx;
							
							if($newx > 0)
								self::updateMedicalStock($idx,$newx);
							else
								self::deleteMedicalStock($idx);
						}
						self::exportMedicalInfo($pkid,$idx,$vl,$price);
					}
					else{						
						$vl = $getvl + $vl;
						if($vl >= $need){
							$newx = $vl - $need;
							//$vl = $vl - $newx;
							$vl = $getvl - $newx;
							if($newx > 0)
								self::updateMedicalStock($idx,$newx);
							else
								self::deleteMedicalStock($idx);
						}else{
							$vl = $getvl; //forward value to GetVL
							self::deleteMedicalStock($idx);
						}
						
						self::exportMedicalInfo($pkid,$idx,$vl,$price);
					}
				}
			}
			else{
				break;
			}
		}
		
		return header("Refresh:0");
	}
	
	public function exportMedicalInfo ($pkid,$pkid2,$quantity,$price){ //บันทึกการจ่ายจากเวชภัณฑ์
		$conn = self::connectDb();
		$sql = "insert into exported_medical_info (id_export_data,id_instock,quantity,out_price) values ('$pkid','$pkid2','$quantity','$price')";
		$query = mysqli_query($conn, $sql);
	}

	
	public function updateMedicalStock($id,$quan){ 
		$conn = self::connectDb();
		$sql = "update instock_medical  set quantity = '$quan' where id = '$id'";
		$query = mysqli_query($conn, $sql);
	}
	
	public function deleteMedicalStock($id){
		$conn = self::connectDb();
		$sql = "update instock_medical  set quantity = -1 where id = '$id'"; //can not delete becuase is FK
		$query = mysqli_query($conn, $sql);
	}
	
	
	////////////////
	public function exportHerbalData(){
		$conn = self::connectDb();
		$sql = "insert into exported_herbal_intoout_data (date) values ('".date("Y-m-d H:i:s")."')";
		$query = mysqli_query($conn, $sql);
		return mysqli_insert_id($conn);
	}
	
	public function getupdateHerbalStock($id){
		$conn = self::connectDb();
		$sql = "SELECT a.quantity AS value_sum,a.id_import_info as IDs, a.id as IDx
				FROM instock_herbal a
				INNER JOIN imported_herbal_info b ON b.id = a.id_import_info
				where b.id_herbal = '$id' and a.quantity > 0
				";
		$result = mysqli_query($conn, $sql);
		$posts = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function exportHerbal($pkid,$id,$need){ 
		$result_list = self::getupdateHerbalStock($id);
		$vl = 0;
		foreach ($result_list['result'] as $row) 
		{	
			$getvl = $row['value_sum'];
			$ids = $row['IDs'];
			$idx = $row['IDx'];
			if($vl < $need)
			{
				if($getvl != 0)
				{
					$newx = 0;
					if($getvl >= $need)
					{
						$vl = $getvl + $vl;
						if($vl >= $need){
							$newx = $vl - $need;
							//$vl = $vl - $newx;
							$vl = $getvl - $newx;
							if($newx > 0)
								self::updateHerbalStock($idx,$newx);
							else
								self::deleteHerbalStock($idx);
						}
						
						$info_id = self::exportHerbalInfo($pkid,$idx,$vl);
						self::importHerbalOutstock($info_id,$vl);
					}
					else{
						$vl = $getvl + $vl;
						if($vl >= $need){
							$newx = $vl - $need;
							//$vl = $vl - $newx;
							$vl = $getvl - $newx;
							if($newx > 0)
								self::updateHerbalStock($idx,$newx);
							else
								self::deleteHerbalStock($idx);
						}else{
							$vl = $getvl; //forward value to GetVL
							self::deleteHerbalStock($idx);
						}
						
						$info_id = self::exportHerbalInfo($pkid,$idx,$vl);
						self::importHerbalOutstock($info_id,$vl);
					}
				}
			}
			else{
				break;
			}
		}
		
		return header("Refresh:0");
	}
		
	public function updateHerbalStock($id,$quan){
		$conn = self::connectDb();
		$sql = "update instock_herbal  set quantity = '$quan' where id = '$id'";
		$query = mysqli_query($conn, $sql);
	}
	
	public function deleteHerbalStock($id){
		$conn = self::connectDb();
		$sql = "update instock_herbal set quantity = -1 where id = '$id'";
		$query = mysqli_query($conn, $sql);
	}
	
	public function exportHerbalInfo ($pkid,$pkid2,$quan){ 
		$conn = self::connectDb();
		$sql = "insert into exported_herbal_intoout_info (id_data,id_instock,quantity) values ('$pkid','$pkid2','$quan')";
		$query = mysqli_query($conn, $sql);	
		return mysqli_insert_id($conn);
	}
	
	public function importHerbalOutstock ($pkid,$quan){
		$conn = self::connectDb();
		$sql = "insert into outstock_herbal (id_exported_info,quantity) values ('$pkid','$quan')";
		$query = mysqli_query($conn, $sql);
	}
	///////////////
	
	
	
	////// Selling Herbal //////////
	public function sellHerbalData($officer){
		$conn = self::connectDb();
		$sql = "insert into exported_herbal_sell_data (id_officer,pending_date) values ('$officer','".date("Y-m-d H:i:s")."')";
		$query = mysqli_query($conn, $sql);
		return mysqli_insert_id($conn);
	}
	
	public function getupdateHerlbalOutStock($id){
		$conn = self::connectDb();
		$sql = "SELECT a.quantity as value_sum, a.id as idStock
				FROM outstock_herbal a
				INNER JOIN exported_herbal_intoout_info b ON b.id = a.id_exported_info
				INNER JOIN instock_herbal c on c.id=b.id_instock
				INNER JOIN imported_herbal_info d on d.id=c.id_import_info
				where d.id_herbal = '$id' and a.quantity > 0

				";
		$result = mysqli_query($conn, $sql);
		$posts = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function sellHerbal($pkid,$id,$need,$price,$status){ 
		$result_list = self::getupdateHerlbalOutStock($id);
		$vl = 0;
		
		foreach ($result_list['result'] as $row) 
		{	
			$getvl = $row['value_sum'];
			$idx = $row['idStock'];
			if($vl < $need)
			{
				if($getvl != 0)
				{
					$newx = 0;
					if($getvl >= $need)
					{
						$vl = $getvl + $vl;
						if($vl >= $need){
							$newx = $vl - $need;
							$vl = $getvl - $newx;
							if($newx > 0)
								self::updateHerbalOutStock($idx,$newx);
							else
								self::deleteHerbalOutStock($idx);
						}
						
						self::sellingHerbalInfo($pkid,$idx,$vl,$price,$status);
					}
					else{
						$vl = $getvl + $vl;
						$finallyVL = 0;
						if($vl >= $need){
							$newx = $vl - $need;
							$vl = $getvl - $newx;
							$finallyVL = $vl; //
							if($newx > 0)
								self::updateHerbalOutStock($idx,$newx);
							else
								self::deleteHerbalOutStock($idx);
							
							self::sellingHerbalInfo($pkid,$idx,$finallyVL,$price,$status);
							break;
						}else{
							$finallyVL = $getvl; //forward value to GetVL
							self::deleteHerbalOutStock($idx);
						}
						
						self::sellingHerbalInfo($pkid,$idx,$finallyVL,$price,$status);
					}
				}
			}
			else{
				break;
			}
		}
		
		return header("Refresh:0");
	}
	
	public function updateHerbalOutStock($id,$quan){
		$conn = self::connectDb();
		$sql = "update outstock_herbal  set quantity = '$quan' where id = '$id'";
		$query = mysqli_query($conn, $sql);
	}
	
	public function deleteHerbalOutStock($id){
		$conn = self::connectDb();
		$sql = "update outstock_herbal set quantity = -1 where id = '$id'";
		$query = mysqli_query($conn, $sql);
	}
	
	public function sellingHerbalInfo ($pkid,$pkid2,$quan,$price,$status){ 
		$conn = self::connectDb();
		$sql = "insert into exported_herbal_sell_info (id_data,id_outstock,pending_quantity,price,status) values ('$pkid','$pkid2','$quan','$price','$status')";
		$query = mysqli_query($conn, $sql);	
	}
	
	//////////////////////////////////
	
	public function GettingCount($id,$table){ 
		$conn = self::selfconnectDb();
		
		$sql = "SELECT * FROM ".$table." where id = '".$id."'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		return $row;
	}
	
	public function GetToken($id){ //ดึง โทเค็น
		$conn = self::connectDb();
		
		$sql = "SELECT Token FROM officers where id = '".$id."'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		return $row;
	}
	
	private function updateLogin($id){ 
		$conn = self::connectDb();
		$sql = "UPDATE officers SET Last_Login='".date("Y-m-d H:i:s")."' , Token = '".bin2hex(random_bytes(16))."' WHERE id = '".$id."'";
		$query = mysqli_query($conn, $sql);
	}
	
	public function GetOfficerStatusByToken($token){ //ดึงข้อมูลจาก Token
		$conn = self::selfconnectDb();
		
		$sql = "SELECT * FROM officers where Token = '".$token."'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		return ['result' => $row];
	}
	
	public function GetOfficerStatusByID($id){ //ไม่ได้ใช้
		$conn = self::selfconnectDb();
		
		$sql = "SELECT * FROM officers where Id = '".$id."'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		return ['result' => $row];
	}
	
	public function GetOffierStatusForInsert($token){
		$conn = self::connectDb();
		
		$sql = "SELECT * FROM officers where Token = '".$token."'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		return ['result' => $row];
	}

	
	public function GetHerbalStatus($id){
		$conn = self::selfconnectDb();
		
		$sql = "SELECT * FROM herbal_list where Id = '".$id."'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		return ['result' => $row];
	}

	public function GetMedicalStatus($id){
		$conn = self::selfconnectDb();
		
		$sql = "SELECT * FROM medical_list where Id = '".$id."'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		return ['result' => $row];
	}
	
	public function Gettinglist($dbname){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT * FROM ". $dbname ."";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function GettingHerbalInfo($sort){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT a.Id , a.Name as Name , a.Desc as Desc_name , b.Name as Counting , c.Name as Type
				FROM herbal_list a 
				JOIN counting_list b on a.Id_Counting=b.Id
				JOIN type_herbal c on a.Id_Type_Herbal=c.Id
				ORDER BY a.Name $sort
		";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function GettingMedicalInfo($sort){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT a.Id , a.Name as Name , a.Desc as Desc_name , b.Name as Counting
				FROM medical_list a 
				JOIN counting_list b on a.Id_Counting=b.Id
				ORDER BY a.Name $sort
		";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function gettingPartnerInfo(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT id , name as Name
				FROM partner_list 
				ORDER BY name ASC
		";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function gettingPartnerInfoForEdit($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT id , name as Name
				FROM partner_list 
				where id = '$id'
		";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	
	public function gettingTypeInfo(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT id , Name as Name
				FROM type_herbal 
				ORDER BY Name ASC
		";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	
	public function gettingCountingInfo(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT id , Name as Name
				FROM counting_list 
				ORDER BY Name ASC
		";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function gettingLotInfo(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT id , Name as Name
				FROM lot_list 
				ORDER BY Name ASC
		";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function gettingTypeInfoForEdit($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT id , Name as Name
				FROM type_herbal 
				where id = '$id'
		";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	public function gettingCountingInfoForEdit($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT id , Name as Name
				FROM counting_list 
				where id = '$id'
		";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	public function gettingLotInfoForEdit($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT id , Name as Name
				FROM lot_list 
				where id = '$id'
		";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	
	public function GettingHerbalInfoForEdit($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT a.Id , a.Name as Name , a.Desc as Desc_name , b.Name as Counting , c.Name as Type
				FROM herbal_list a 
				JOIN counting_list b on a.Id_Counting=b.Id
				JOIN type_herbal c on a.Id_Type_Herbal=c.Id
				where a.Id = '$id'
		";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	public function GettingMedicalInfoForEdit($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT a.Id , a.Name as Name , a.Desc as Desc_name , b.Name as Counting
				FROM medical_list a 
				JOIN counting_list b on a.Id_Counting=b.Id
				where a.Id = '$id'
		";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	
	public function GetminimumHerbal(){ //ดึงค่ายาสมุนไพรเหลือน้อยจากสต๊อกใน
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT SUM(GREATEST(c.quantity, 0)) AS value_sum, a.name as Name
				FROM herbal_list a
				LEFT JOIN imported_herbal_info b ON a.id=b.id_herbal
				LEFT JOIN instock_herbal c ON c.id_import_info=b.id
				GROUP BY a.Name
				order by value_sum ASC
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	
	public function getMinimumHerbalOutStock(){ //ดึงค่ายาสมุนไพรเหลือน้อยจากสต๊อกใน
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "	SELECT SUM(GREATEST(a.quantity, 0)) as value_sum, e.Name as Name, e.`Desc` as herbalDesc,f.`Name` as countingName, e.id as herbalId
					FROM outstock_herbal a
					INNER JOIN exported_herbal_intoout_info b ON b.id=a.id_exported_info
					INNER JOIN instock_herbal c on c.id=b.id_instock
					INNER JOIN imported_herbal_info d on d.id=c.id_import_info
					RIGHT JOIN herbal_list e ON e.id=d.id_herbal
					JOIN counting_list f ON f.id=e.id_Counting
					GROUP BY e.id 
					ORDER BY value_sum asc
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getExpireHerbalOutStock(){ //ดึงค่ายาสมุนไพรเหลือน้อยจากสต๊อกใน
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT  CONCAT_WS(\" Stock_number \", e.Name, a.id) AS `fullDesc`,	e.`Name` as Name , d.expire_date as Expire, a.id as StockNumber , f.date as Import_date
				FROM outstock_herbal a
				JOIN exported_herbal_intoout_info b ON a.id_exported_info=b.id
				JOIN instock_herbal c ON b.id_instock = c.id
				JOIN imported_herbal_info d on c.id_import_info = d.id
				JOIN herbal_list e on d.id_herbal = e.id
				JOIN imported_herbal_data f on d.id_import_data = f.id
				WHERE a.quantity > 0
				GROUP BY d.id 											-- GROUP BY d.ID เพราะว่า 1 สต็อค มีวันหมดอายุวันเดียวกัน
				ORDER BY d.expire_date ASC
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function GetExpireHerbal(){ //ดึงค่ายาสมุนไพรหมดอายุ
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT b.expire_date as expire, a.name as Name
				FROM herbal_list a
				JOIN imported_herbal_info b ON a.id=b.id_herbal
				JOIN instock_herbal c ON c.id_import_info=b.id
				GROUP BY a.id
				ORDER BY b.expire_date ASC
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getViewCheckStockHerbal(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT SUM(GREATEST(c.quantity, 0)) AS value_sum, a.name as Name, d.name as counting_name, b.id_herbal as IDHERBAL
				FROM herbal_list a
				LEFT JOIN imported_herbal_info b ON a.id=b.id_herbal
				LEFT JOIN instock_herbal c ON c.id_import_info=b.id
				LEFT JOIN counting_list d ON d.id=a.id_counting
				LEFT JOIN type_herbal e ON e.id=a.id_type_herbal
				GROUP BY a.Name
				ORDER BY a.Name
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function GetHerbaldetail($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT a.name as Name, d.name as counting_name, b.id_herbal as IDHERBAL, b.expire_date as Expire, b.price as Price, b.quantity as Quantity, e.Name as Type
				,b2.Date as Date
				FROM herbal_list a
				JOIN imported_herbal_info b ON a.id=b.id_herbal
				LEFT JOIN imported_herbal_data b2 ON b.id_import_data = b2.id
				LEFT JOIN instock_herbal c ON c.id_import_info=b.id
				LEFT JOIN counting_list d ON d.id=a.id_counting
				LEFT JOIN type_herbal e ON e.id=a.id_type_herbal
				WHERE a.Id = '$id' and c.Quantity > 0
				ORDER BY a.Name
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function GetMedicalDetail($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT a.name as Name, d.name as counting_name, a.id as idmedical, b.import_price as Price, b.import_quantity as Quantity
				FROM medical_list a
				LEFT JOIN imported_medical_info b ON a.id=b.id_medical
				LEFT JOIN instock_medical c ON c.id_import_info=b.id
				LEFT JOIN counting_list d ON d.id=a.id_counting
				where a.Id = '$id' and c.Quantity > 0
				ORDER BY a.Name
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getViewCheckStockMedical(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT SUM(GREATEST(c.quantity, 0)) AS value_sum, a.name as Name, d.name as counting_name, a.id as idmedical
				FROM medical_list a
				LEFT JOIN imported_medical_info b ON a.id=b.id_medical
				LEFT JOIN instock_medical c ON c.id_import_info=b.id
				LEFT JOIN counting_list d ON d.id=a.id_counting
				GROUP BY a.Name
				ORDER BY a.Name
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getResultHerbal_OutStock_ForCheck(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT SUM(e.quantity) AS value_sum, a.name as Name, f.name as counting_name, b.id_herbal as IDHERBAL
				FROM herbal_list a
				LEFT JOIN imported_herbal_info b ON a.id=b.id_herbal
				LEFT JOIN instock_herbal c ON c.id_import_info=b.id
				LEFT JOIN exported_herbal_intoout_info d ON d.id_instock=c.id
				LEFT JOIN outstock_herbal e ON e.id_exported_info=d.id
				LEFT JOIN counting_list f ON f.id=a.id_counting
				LEFT JOIN type_herbal g ON g.id=a.id_type_herbal
				WHERE e.quantity > 0 or ISNULL(e.quantity)
				GROUP BY a.Name
				ORDER BY a.Name ASC
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getHerbalOutStock_ForSelling(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT SUM(a.quantity) as value_sum, e.Name as herbalName, e.`Desc` as herbalDesc,f.`Name` as countingName, e.id as herbalId
				FROM outstock_herbal a
				INNER JOIN exported_herbal_intoout_info b ON b.id=a.id_exported_info
				INNER JOIN instock_herbal c on c.id=b.id_instock
				INNER JOIN imported_herbal_info d on d.id=c.id_import_info
				INNER JOIN herbal_list e ON e.id=d.id_herbal
				JOIN counting_list f ON f.id=e.id_Counting
				WHERE a.quantity > 0
				GROUP BY e.id 
				ORDER BY e.Name asc
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getHerbalInStock_ForExport(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT SUM(a.Quantity) AS value_sum, c.Name as Name , d.name as counting_name, c.id as herbalId, c.Desc as Desc_name
				FROM instock_herbal a
				INNER JOIN imported_herbal_info b ON b.id=a.id_import_info
				INNER JOIN herbal_list c ON c.id=b.id_herbal
				JOIN counting_list d ON d.id=c.id_Counting
				WHERE a.quantity > 0
				GROUP BY c.id 
				ORDER BY c.id
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function Getmedicalinstock(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT SUM(a.Quantity) AS value_sum, c.Name as Name , d.name as counting_name, c.id as medicalid, c.Desc as Desc_name, (b.import_price/b.import_quantity) as UnitPrice
				FROM instock_medical a
				INNER JOIN imported_medical_info b ON b.id=a.id_import_info
				INNER JOIN medical_list c ON c.id=b.id_medical
				JOIN counting_list d ON d.id=c.id_counting
				WHERE a.quantity > 0
				GROUP BY c.id 
				ORDER BY c.id
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getHistoryMedical($currentPage, $perPage){
		$conn = self::selfconnectDb();
		$posts = array();
		$offset = ($currentPage-1) * $perPage;
		$sql = "SELECT e.Name as Name, f.Name as Counting, c.Officer_name as OFName, b.quantity as Quantity, b.out_price as Price, a.out_date as Date
				FROM exported_medical_data a
				INNER JOIN exported_medical_info b on b.id_export_data = a.id
				INNER JOIN officers c ON c.id=a.id_officers
				INNER JOIN instock_medical d ON d.id=b.id_instock
				INNER JOIN imported_medical_info g ON g.id=d.id_import_info
				JOIN medical_list e ON e.id=g.id_medical
				JOIN counting_list f ON f.id=e.id_counting
				GROUP BY b.id_export_data
				ORDER BY a.out_date DESC
				LIMIT $offset,$perPage
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		
		$sql = "SELECT COUNT(*)
				FROM exported_medical_data a
				ORDER BY a.out_date DESC
				";
		$result = mysqli_query($conn, $sql);
		$total_rows = mysqli_fetch_array($result)[0];
		$total_pages = ceil($total_rows / $perPage);
		mysqli_close($conn);
		
		return ['result' => $posts, 'counting' => $total_pages, 'totalItems' => $total_rows];
	}
	
	public function getImportHerbalData($currentPage, $perPage){
		$conn = self::selfconnectDb();
		$posts = array();
		$offset = ($currentPage-1) * $perPage;
		$sql = "SELECT CONCAT_WS(\" \", b.Officer_name, b.Officer_lastname) AS `FullName`,a.date as date, a.id as Id
				FROM imported_herbal_data a
				JOIN officers b ON b.id=a.id_officers
				ORDER BY a.date DESC
				LIMIT $offset,$perPage
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		
		$sql = "SELECT COUNT(*), CONCAT_WS(\" \", b.Officer_name, b.Officer_lastname) AS `FullName`,a.date as date
				FROM imported_herbal_data a
				JOIN officers b ON b.id=a.id_officers
				ORDER BY a.date DESC
				";
		$result = mysqli_query($conn, $sql);
		$total_rows = mysqli_fetch_array($result)[0];
		$total_pages = ceil($total_rows / $perPage);
		
		mysqli_close($conn);
		return ['result' => $posts, 'counting' => $total_pages, 'totalItems' => $total_rows];
	}
	
	public function getLogHerbal_Data($id){
		$conn = self::connectDb();
		$posts = array();
		$sql = "SELECT b.Name as herbalName,  
				c.`name` as partnerName, 
				a.price as price , 
				CONCAT_WS(\" \", a.quantity, d.name) as quantity, 
				a.expire_date as expireDate,
				a.id_herbal as idHerbal,
				a.id as id
				FROM imported_herbal_info a
				JOIN herbal_list b on a.id_herbal = b.id
				JOIN partner_list c on a.id_partner = c.id
				JOIN counting_list d on b.Id_Counting = d.id
				WHERE a.id_import_data = '$id'
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return $posts;
	}
	
	public function getInfoLogHerbal($id){
		$conn = self::connectDb();
		$posts = array();
		$sql = "select a.price as Price , a.quantity as Quantity, a.expire_date as ExpireDate, b.quantity as StockQuantity,
				CASE
						WHEN a.quantity <> b.quantity THEN 0
						ELSE 1
				END as `status`,
				c.Name as herbalName
				from imported_herbal_info a
				join instock_herbal b on a.id = b.id_import_info
				join herbal_list c on a.id_herbal = c.id
				where a.id = '$id'
				";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	public function updateInfoLogHerbal($id, $priceHerbal, $quantityHerbal, $expireDate){
		$conn = self::connectDb();
		$sql = "update imported_herbal_info  set quantity = '$quantityHerbal', price = '$priceHerbal' , expire_date = '$expireDate' where id = '$id'";
		$query = mysqli_query($conn, $sql);
		
		$sql = "update instock_herbal  set quantity = '$quantityHerbal' where id_import_info = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function getLogMedical_Data($id){
		$conn = self::connectDb();
		$posts = array();
		$sql = "SELECT b.Name as medicalName,  
				c.`name` as partnerName, 
				a.import_price as price , 
				CONCAT_WS(\" \", a.import_quantity, d.name) as quantity
				FROM imported_medical_info a
				JOIN medical_list b on a.id_medical = b.id
				JOIN partner_list c on a.id_partner = c.id
				JOIN counting_list d on b.Id_Counting = d.id
				WHERE a.id_import_data = '$id'
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return $posts;
	}
	
	public function getImportMedicalData($currentPage, $perPage){
		$conn = self::selfconnectDb();
		$posts = array();
		$offset = ($currentPage-1) * $perPage;
		$sql = "SELECT CONCAT_WS(\" \", b.Officer_name, b.Officer_lastname) AS `FullName`,a.import_date as date, a.id as Id
				FROM imported_medical_data a
				JOIN officers b ON b.id=a.id_officer
				ORDER BY a.import_date DESC
				LIMIT $offset,$perPage
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		
		$sql = "SELECT COUNT(*), CONCAT_WS(\" \", b.Officer_name, b.Officer_lastname) AS `FullName`,a.import_date as date
				FROM imported_medical_data a
				JOIN officers b ON b.id=a.id_officer
				ORDER BY a.import_date DESC
				";
		$result = mysqli_query($conn, $sql);
		$total_rows = mysqli_fetch_array($result)[0];
		$total_pages = ceil($total_rows / $perPage);
		
		mysqli_close($conn);
		return ['result' => $posts, 'counting' => $total_pages, 'totalItems' => $total_rows];
	}
	
	public function Getimportlist(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT d.Officer_name as OFName,d.Officer_lastname as OFLName,e.Name as HerbalName,b.quantity as Quantity,f.Name as CName,b.price as price,
				c.date as date,b.expire_date as expire,b.id as ID
				FROM instock_herbal a
				INNER JOIN imported_herbal_info b ON b.id=a.id_import_info
				JOIN imported_herbal_data c ON c.id=b.id_import_data
				JOIN officers d ON d.id=c.id_officers
				JOIN herbal_list e ON e.id=b.id_herbal
				JOIN counting_list f ON f.id=e.id_counting
				ORDER BY c.date DESC
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}

	public function Getimportlist_medical(){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT d.Officer_name as OFName,d.Officer_lastname as OFLName,e.Name as MedicName,b.import_quantity as Quantity,f.Name as CName,b.import_price as price,
				c.import_date as date,b.id as ID
				FROM instock_medical a
				INNER JOIN imported_medical_info b ON b.id=a.id_import_info
				JOIN imported_medical_data c ON c.id=b.id_import_data
				JOIN officers d ON d.id=c.id_officer
				JOIN medical_list e ON e.id=b.id_medical
				JOIN counting_list f ON f.id=e.id_counting
				ORDER BY c.import_date DESC
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function GetSelectForEditHerbal($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT price,quantity,expire_date
				FROM imported_herbal_info 
				where id = '$id'
				";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	public function GetSelectForEditMedical($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT import_price,import_quantity
				FROM imported_medical_info 
				where id = '$id'
				";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	public function GetSelectForEditOfficers($id){
		$conn = self::selfconnectDb();
		$posts = array();
		$sql = "SELECT Email,Password,Officer_name,Officer_lastname,isAdmin
				FROM officers 
				where Id = '$id'
				";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	
	public function GetCountDB($dbname){
		$conn = self::selfconnectDb();
		$sql = "SELECT * FROM ". $dbname ."";
		$result = mysqli_query($conn, $sql);
		$row_cnt = mysqli_num_rows($result);
		mysqli_free_result($result);
		return $row_cnt;
	}
	
	private function connectDb()
	{
		include_once  ('../config/connect.php');
		$conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		return $conn;
	}
	
	private function selfconnectDb()
	{
		include_once  ('./config/connect.php');
		$conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		return $conn;
	}
	
	public function getAdmin($isAdmin){
		$admin = '';
		switch ($isAdmin) {
		  case 0:
			$admin = 'ผู้ใช้งานทั่วไป';
			break;
		  case 1:
			$admin = 'ผู้ดูแลระบบ';
			break;
		  default:
			$admin = 'ผู้ใช้งานทั่วไป';
		}
		return $admin;
	}
	
	public function EditInfoWarehouse($id,$quan,$price,$expire){ //แก้ไขค่าการนำเข้ายาสมุนไพร
		$conn = self::selfconnectDb();
		$sql = "update imported_herbal_info  set quantity = '$quan', price = '$price' , expire_date = '$expire' where id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function EditInfoMedical($id,$quan,$price){ //แก้ไขค่าการนำเข้ายาสมุนไพร
		$conn = self::selfconnectDb();
		$sql = "update imported_medical_info  set import_quantity = '$quan', import_price = '$price' where id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function DeleteInfoMedical($id){ //บันทึกค่าเวชภัณฑ์ล่าสุด ยังไม่เสร็จ
		$conn = self::connectDb();
		$sql = "delete from imported_medical_info id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function EditInfoOfficers($id,$Email,$Name,$LastName){ 
		$conn = self::selfconnectDb();
		$sql = "update officers set Email = '$Email', Officer_name = '$Name', Officer_lastname = '$LastName' where Id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function DeleteOfficers($id){ 
		$conn = self::selfconnectDb();
		$sql = "delete from Officers where Id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function EditInfoHerbal($id,$Name,$Desc){ 
		$conn = self::selfconnectDb();
		$sql = "update herbal_list set Name = '$Name', `Desc` = '$Desc' where Id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function EditInfoPartnerList($id,$Name){ 
		$conn = self::selfconnectDb();
		$sql = "update partner_list set name = '$Name' where id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function EditInfoTypeList($id,$Name){ 
		$conn = self::selfconnectDb();
		$sql = "update type_herbal set Name = '$Name' where id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function EditInfoCountingList($id,$Name){ 
		$conn = self::selfconnectDb();
		$sql = "update counting_list set Name = '$Name' where id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function EditInfoLotList($id,$Name){ 
		$conn = self::selfconnectDb();
		$sql = "update lot_list set Name = '$Name' where id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function EditInfoMedicalList($id,$Name,$Desc){ 
		$conn = self::selfconnectDb();
		$sql = "update medical_list set Name = '$Name', `Desc` = '$Desc' where Id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function DeleteMedicalInfo($id){ 
		$conn = self::selfconnectDb();
		$sql = "delete from medical_list where Id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function DeleteHerbalInfo($id){ 
		$conn = self::selfconnectDb();
		$sql = "delete from herbal_list where Id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function deletepartnerInfo($id){ 
		$conn = self::selfconnectDb();
		$sql = "delete from partner_list where id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function deleteTypeInfo($id){ 
		$conn = self::selfconnectDb();
		$sql = "delete from type_herbal where id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function deleteCountingInfo($id){ 
		$conn = self::selfconnectDb();
		$sql = "delete from counting_list where id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function deleteLotInfo($id){ 
		$conn = self::selfconnectDb();
		$sql = "delete from lot_list where id = '$id'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function getHerbalIntoout_ForReport($start, $end){
		$conn = self::connectDb();
		$sql = "SELECT  e.`Name` as HerbalName, a.date as Date, Sum(b.quantity) as Quantity, f.`Name` as CountingName
				from exported_herbal_intoout_data a
				JOIN exported_herbal_intoout_info b on b.id_data=a.id
				JOIN instock_herbal c on c.id=b.id_instock
				JOIN imported_herbal_info d on d.id=c.id_import_info
				JOIN herbal_list e on e.id=d.id_herbal
				JOIN counting_list f on f.id=e.Id_Counting
				-- WHERE b.quantity > 0 and (a.Date BETWEEN '$start' AND '$end')
				WHERE  b.quantity > 0
						and (MONTH(a.Date) BETWEEN MONTH('$start') and MONTH('$end')) 
						and (DAY(a.Date) BETWEEN DAY('$start') and DAY('$end'))
						and (YEAR(a.Date) BETWEEN YEAR('$start') and YEAR('$end'))
				GROUP BY b.id
				ORDER BY a.date ASC
				-- LIMIT 30
				";
		$result = mysqli_query($conn, $sql);
		$posts = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getMedicalIntoout_ForReport($start, $end){
		$conn = self::connectDb();
		$sql = "SELECT  d.`Name` as MedicalName, a.out_date as Date, Sum(b.quantity) as Quantity, e.`Name` as CountingName, 
				CONCAT_WS(\" \", f.Officer_name, f.Officer_lastname) AS `FullName`
				from exported_medical_data a
				JOIN exported_medical_info b on b.id_export_data=a.id
				JOIN instock_medical c on c.id=b.id_instock
				JOIN imported_medical_info c2 on c2.id=c.id_import_info
				JOIN medical_list d on d.id = c2.id_medical
				JOIN counting_list e on e.id = d.Id_Counting
				JOIN officers f on f.id = a.id_officers
				-- WHERE b.quantity > 0 and (a.out_date BETWEEN '$start' AND '$end')
				WHERE  b.quantity > 0
						and (MONTH(a.out_date) BETWEEN MONTH('$start') and MONTH('$end')) 
						and (DAY(a.out_date) BETWEEN DAY('$start') and DAY('$end'))
						and (YEAR(a.out_date) BETWEEN YEAR('$start') and YEAR('$end'))
				GROUP BY b.id
				ORDER BY a.out_date ASC
				-- LIMIT 30
				";
		$result = mysqli_query($conn, $sql);
		$posts = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	
	public function getViewCheckStockHerbal_ForReport(){
		$conn = self::connectDb();
		$posts = array();
		$sql = "SELECT SUM(GREATEST(c.quantity, 0)) AS value_sum, a.name as Name, d.name as counting_name, b.id_herbal as IDHERBAL
				FROM herbal_list a
				LEFT JOIN imported_herbal_info b ON a.id=b.id_herbal
				LEFT JOIN instock_herbal c ON c.id_import_info=b.id
				LEFT JOIN counting_list d ON d.id=a.id_counting
				LEFT JOIN type_herbal e ON e.id=a.id_type_herbal
				GROUP BY a.Name
				ORDER BY a.Name
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getViewCheckStockMedical_ForReport(){
		$conn = self::connectDb();
		$posts = array();
		$sql = "SELECT SUM(GREATEST(c.quantity, 0)) AS value_sum, a.name as Name, d.name as counting_name, a.id as idmedical
				FROM medical_list a
				LEFT JOIN imported_medical_info b ON a.id=b.id_medical
				LEFT JOIN instock_medical c ON c.id_import_info=b.id
				LEFT JOIN counting_list d ON d.id=a.id_counting
				GROUP BY a.Name
				ORDER BY a.Name
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getViewImportedHerbal_ForReport(){
		$conn = self::connectDb();
		$posts = array();
		$sql = "SELECT b.`Name` as herbalName , c.`Name` as typeName, a.price as price, a.quantity as quantity, a.expire_date as expireDate, d.date as importDate
				FROM imported_herbal_info a
				JOIN herbal_list b on a.id_herbal = b.id
				JOIN type_herbal c on c.id = b.Id_Type_Herbal
				JOIN imported_herbal_data d on d.id = a.id_import_data
				ORDER BY d.date asc
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getViewImportedMedical_ForReport(){
		$conn = self::connectDb();
		$posts = array();
		$sql = "SELECT b.name as name, a.import_quantity as quantity, a.import_price as price, c.import_date as importDate
				FROM imported_medical_info a
				JOIN medical_list b on b.id = a.id_medical
				JOIN imported_medical_data c on c.id = a.id_import_data
				ORDER BY c.import_date asc
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getViewCheckOutStockHerbal_ForReport(){
		$conn = self::connectDb();
		$posts = array();
		$sql = "SELECT 
				e.name as herbalName,
				CASE
									WHEN ISNULL(SUM(GREATEST(a.quantity, 0))) THEN CONCAT_WS(\" \", 0, f.`Name`) 
									ELSE CONCAT_WS(\" \",  SUM(GREATEST(a.quantity, 0)), f.`Name`) 
				END as `quantity`
				FROM outstock_herbal a
				JOIN exported_herbal_intoout_info b on b.id = a.id_exported_info
				JOIN instock_herbal c on c.id = b.id_instock
				JOIN imported_herbal_info d on d.id = c.id_import_info
				RIGHT JOIN herbal_list e on e.id = d.id_herbal
				JOIN counting_list f on f.id = e.Id_Counting
				GROUP BY e.Id
				ORDER BY e.Name
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getViewSelledHerbal_ForReport($date){
		$conn = self::connectDb();
		$posts = array();
		$sql = "SELECT CONCAT_WS(\" \", c.Officer_name, c.Officer_lastname) AS `FullName`, 
				h.`Name` as HerbalName,
				j.`name` as PartnerName,
				k.`Name` as TypeName,
				CASE
					WHEN a.status = 0 THEN \"สนับสนุนใช้ในคลีนิค\"
					ELSE \"ออกหน่วยบริการ\"
				END as `Status`,
				CONCAT_WS(\" \", a.pending_quantity, i.`Name`)  as Quantity,
				a.price as Price,
				b.pending_date as outDate,
				l.name as lotName,
				a.price * a.pending_quantity as sumQuantity,
				a.pending_quantity as Quantityonly
				FROM exported_herbal_sell_info a
				JOIN exported_herbal_sell_data b on a.id_data = b .id
				JOIN officers c on c.id = b.id_officer
				JOIN outstock_herbal d on d.id = a.id_outstock
				JOIN exported_herbal_intoout_info e on e.id = d.id_exported_info
				JOIN instock_herbal f on f.id = e.id_instock
				JOIN imported_herbal_info g on g.id = f.id_import_info
				JOIN herbal_list h on h.id = g.id_herbal
				JOIN counting_list i on i.Id = h.Id_Counting
				JOIN partner_list j on j.id = g.id_partner
				JOIN type_herbal k on k.id = h.Id_Type_Herbal
				JOIN lot_list l on l.id = g.id_lot
				WHERE b.pending_date LIKE '$date%'
				ORDER BY b.pending_date DESC
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	
	public function getViewSelledHerbalDateRange_ForReport($start,$end){
		$conn = self::connectDb();
		$posts = array();
		$sql = "SELECT CONCAT_WS(\" \", c.Officer_name, c.Officer_lastname) AS `FullName`, 
				h.`Name` as HerbalName,
				j.`name` as PartnerName,
				k.`Name` as TypeName,
				CASE
					WHEN a.status = 0 THEN \"สนับสนุนใช้ในคลีนิค\"
					ELSE \"ออกหน่วยบริการ\"
				END as `Status`,
				CONCAT_WS(\" \", a.pending_quantity, i.`Name`)  as Quantity,
				a.price as Price,
				b.pending_date as outDate,
				l.name as lotName,
				a.price * a.pending_quantity as sumQuantity,
				a.pending_quantity as Quantityonly
				FROM exported_herbal_sell_info a
				JOIN exported_herbal_sell_data b on a.id_data = b .id
				JOIN officers c on c.id = b.id_officer
				JOIN outstock_herbal d on d.id = a.id_outstock
				JOIN exported_herbal_intoout_info e on e.id = d.id_exported_info
				JOIN instock_herbal f on f.id = e.id_instock
				JOIN imported_herbal_info g on g.id = f.id_import_info
				JOIN herbal_list h on h.id = g.id_herbal
				JOIN counting_list i on i.Id = h.Id_Counting
				JOIN partner_list j on j.id = g.id_partner
				JOIN type_herbal k on k.id = h.Id_Type_Herbal
				JOIN lot_list l on l.id = g.id_lot
				WHERE (b.pending_date BETWEEN '$start' and '$end') 
				ORDER BY b.pending_date DESC
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function getTopSellingHerbal_Month($month){
		$conn = self::connectDb();
		$posts = array();
		$sql = "SELECT g.name as herbalName, SUM(a.pending_quantity) as val_sum
				FROM exported_herbal_sell_info a
				JOIN exported_herbal_sell_data b on a.id_data = b.id
				JOIN outstock_herbal c on a.id_outstock = c.id
				JOIN exported_herbal_intoout_info d on c.id_exported_info = d.id
				JOIN instock_herbal e on e.id = d.id_instock
				JOIN imported_herbal_info f on f.id = e.id_import_info
				JOIN herbal_list g on f.id_herbal = g.id
				where month(b.pending_date) = '$month'
				GROUP BY g.Id
				ORDER BY val_sum DESC
				LIMIT 5
				";
		$result = mysqli_query($conn, $sql);
		$totalQuantity = 0;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
			$totalQuantity += $row['val_sum'];
		}
		return ['result' => $posts, 'totalQuantity' => $totalQuantity];
	}
	
	public function insertHerbal($Name,$Desc_name,$couting,$type){
		$conn = self::connectDb();
		$sql = "insert into herbal_list (Id_Counting,Id_Type_Herbal,`Name`,`Desc`) values ('$couting','$type','$Name','$Desc_name')";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function insertMedical_list($Name,$Desc_name,$couting){
		$conn = self::connectDb();
		$sql = "insert into medical_list (Id_Counting,`Name`,`Desc`) values ('$couting','$Name','$Desc_name')";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function insertPartner_list($Name){ 
		$conn = self::connectDb();
		$sql = "insert into partner_list (`Name`) values ('$Name')";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function insertTypeList($Name){ 
		$conn = self::connectDb();
		$sql = "insert into type_herbal (`Name`) values ('$Name')";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function insertCountingList($Name){ 
		$conn = self::connectDb();
		$sql = "insert into counting_list (`Name`) values ('$Name')";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	public function insertLotList($Name){ 
		$conn = self::connectDb();
		$sql = "insert into lot_list (`Name`) values ('$Name')";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	
	public function updateUser($token,$pass){ 
		$conn = self::connectDb();
		$sql = "update officers  set Password = '$pass' where Token = '$token'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
	
	
	function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'ปี',
			'm' => 'เดือน',
			'w' => 'สัปดาห์',
			'd' => 'วัน',
			'h' => 'ชั่วโมง',
			'i' => 'นาที',
			's' => 'วินาที',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 'ที่ผ่านมา' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ?  ' เมื่อ ' . implode(', ', $string) : 'เดี๋ยวนี้';
	}
	
	
	function thai_date_and_time($time){
		//global $dayTH,$monthTH;   
		$dayTH = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
		$monthTH = [null,'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
		$monthTH_brev = [null,'ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
		$thai_date_return = date("j",$time);   
		$thai_date_return.=" ".$monthTH[date("n",$time)];   
		$thai_date_return.= " ".(date("Y",$time)+543);   
		$thai_date_return.= " เวลา ".date("H:i:s",$time);
		return $thai_date_return;   
	} 
	
	function thai_date($time){ 
		$dayTH = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
		$monthTH = [null,'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
		$monthTH_brev = [null,'ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
		$thai_date_return = date("j",$time);   
		$thai_date_return.=" ".$monthTH[date("n",$time)];   
		$thai_date_return.= " ".(date("Y",$time)+543);   
		return $thai_date_return;   
	} 
	
	function kdxrFormatDate($date,$type){
		$thai_date_return = "";
		$monthTH = [null,'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
		if($type == "m"){
			$thai_date_return.=" ".$monthTH[date("n",$date)];   
		}
		return $thai_date_return;   
	} 
}
?>