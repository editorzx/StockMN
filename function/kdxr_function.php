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
	
	public function insertmedical($pkid,$medicalid,$partnerid,$quan,$price){ //นำเข้าเวชภัณฑ์
		$conn = self::connectDb();
		$sql = "insert into imported_medical_info (id_import_data,id_medical,id_partner,import_quantity,import_price) values ('$pkid','$medicalid','$partnerid','$quan','$price')";
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

	public function insertDrug($pkid,$herbalid,$partnerid,$quan,$price,$expire){ //นำเข้ายาสมุนไพร
		$conn = self::connectDb();
		$sql = "insert into imported_herbal_info (id_import_data,id_herbal,id_partner,quantity,price,expire_date) values ('$pkid','$herbalid','$partnerid','$quan','$price','$expire')";
		$query = mysqli_query($conn, $sql);
		self::insertStock(mysqli_insert_id($conn),$quan);
		return $query;
	}
	
	public function insertDrugData($officerid){ //เพิ่มข้อมูลการนำเข้า
		$conn = self::connectDb();
		$sql = "insert into imported_herbal_data (id_officers,date) values ('$officerid','".date("Y-m-d H:i:s")."')";
		$query = mysqli_query($conn, $sql);
		return mysqli_insert_id($conn);
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
	
	public function exportmedical($pkid,$id,$need){ //บันทึกการจ่ายจากเวชภัณฑ์
		$result_list = self::getupdateMedicalStock($id);
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
					if($getvl >= $need)
					{
						$vl = $getvl + $vl;
						$newx = 0;
						if($vl >= $need){
							$newx = $vl - $need;
							$vl = $vl - $newx;
							self::updateMedicalStock($idx,$newx);
						}
						self::exportMedicalInfo($pkid,$idx);
					}
					else{
						$vl = $getvl + $vl;
						$newx = 0;
						if($vl >= $need){
							$newx = $vl - $need;
							$vl = $vl - $newx;
							self::updateMedicalStock($idx,$newx);
						}else{
							self::deleteMedicalStock($idx);
						}
						self::exportMedicalInfo($pkid,$idx);
						
					}
				}
			}
			else{
				break;
			}
		}
		
		return header("Refresh:0");;
	}
	
	public function exportMedicalInfo ($pkid,$pkid2){ //บันทึกการจ่ายจากเวชภัณฑ์
		$conn = self::connectDb();
		$sql = "insert into exported_medical_info (id_export_data,id_instock) values ('$pkid','$pkid2')";
		$query = mysqli_query($conn, $sql);
	}
	
	
	public function exportMedicalData($officerid,$quan,$price){ //บันทึกการจ่ายจากเวชภัณฑ์
		$conn = self::connectDb();
		$sql = "insert into exported_medical_data (id_officers,quantity,out_price,out_date) values ('$officerid','$quan','$price','".date("Y-m-d H:i:s")."')";
		$query = mysqli_query($conn, $sql);
		return mysqli_insert_id($conn);
	}
	
	public function updateMedicalStock($id,$quan){ //บันทึกค่าเวชภัณฑ์ล่าสุด ยังไม่เสร็จ
		$conn = self::connectDb();
		$sql = "update instock_medical  set quantity = '$quan' where id = '$id'";
		$query = mysqli_query($conn, $sql);
	}
	
	public function deleteMedicalStock($id){ //บันทึกค่าเวชภัณฑ์ล่าสุด ยังไม่เสร็จ
		$conn = self::connectDb();
		$sql = "update instock_medical set quantity = 0 where id = '$id'";
		$query = mysqli_query($conn, $sql);
	}
	
	public function getupdateMedicalStock($id){ //บันทึกค่าเวชภัณฑ์ล่าสุด ยังไม่เสร็จ
		$conn = self::connectDb();
		$sql = "SELECT a.quantity AS value_sum,a.id_import_info as IDs, a.id as IDx
				FROM instock_medical a
				INNER JOIN imported_medical_info b ON b.id = a.id_import_info
				where b.id_medical = '$id'
				";
		$result = mysqli_query($conn, $sql);
		$posts = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
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
		$post = array();
		$sql = "SELECT * FROM ". $dbname ."";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	
	public function GetminimumHerbal(){ //ดึงค่ายาสมุนไพรเหลือน้อยจากสต๊อกใน
		$conn = self::selfconnectDb();
		$post = array();
		$sql = "SELECT SUM(c.quantity) AS value_sum, a.name as Name
				FROM herbal_list a
				LEFT JOIN imported_herbal_info b ON a.id=b.id_herbal
				LEFT JOIN instock_herbal c ON c.id_import_info=b.id
				GROUP BY a.Name
				ORDER BY a.id
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
		$post = array();
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
	
	public function Getherbalinstock(){
		$conn = self::selfconnectDb();
		$post = array();
		$sql = "SELECT SUM(c.quantity) AS value_sum, a.name as Name, d.name as counting_name, b.id_herbal as IDHERBAL
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
		$post = array();
		$sql = "SELECT a.name as Name, d.name as counting_name, b.id_herbal as IDHERBAL, b.expire_date as Expire, b.price as Price, b.quantity as Quantity, e.Name as Type
				,b2.Date as Date
				FROM herbal_list a
				JOIN imported_herbal_info b ON a.id=b.id_herbal
				LEFT JOIN imported_herbal_data b2 ON b.id_import_data = b2.id
				LEFT JOIN instock_herbal c ON c.id_import_info=b.id
				LEFT JOIN counting_list d ON d.id=a.id_counting
				LEFT JOIN type_herbal e ON e.id=a.id_type_herbal
				WHERE a.Id = '$id'
				ORDER BY a.Name
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function GetViewReSultMedical(){
		$conn = self::selfconnectDb();
		$post = array();
		$sql = "SELECT SUM(c.quantity) AS value_sum, a.name as Name, d.name as counting_name
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
	
	public function Getmedicalinstock(){
		$conn = self::selfconnectDb();
		$post = array();
		$sql = "SELECT SUM(a.Quantity) AS value_sum, c.Name as Name , d.name as counting_name, c.id as medicalid, c.Desc as Desc_name
				FROM instock_medical a
				INNER JOIN imported_medical_info b ON b.id=a.id_import_info
				INNER JOIN medical_list c ON c.id=b.id_medical
				JOIN counting_list d ON d.id=c.id_counting
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
	
	public function Getmedicalexport(){
		$conn = self::selfconnectDb();
		$post = array();
		$sql = "SELECT e.Name as Name, f.Name as Counting, c.Officer_name as OFName, a.quantity as Quantity, a.out_price as Price, a.out_date as Date
				FROM exported_medical_data a
				INNER JOIN exported_medical_info b on b.id_export_data = a.id
				INNER JOIN officers c ON c.id=a.id_officers
				INNER JOIN instock_medical d ON d.id=b.id_instock
				INNER JOIN imported_medical_info g ON g.id=d.id_import_info
				JOIN medical_list e ON e.id=g.id_medical
				JOIN counting_list f ON f.id=e.id_counting
				GROUP BY b.id_export_data
				ORDER BY a.out_date DESC
				";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$posts[] = $row;
		}
		return ['result' => $posts];
	}
	
	public function Getimportlist(){
		$conn = self::selfconnectDb();
		$post = array();
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
		$post = array();
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
		$post = array();
		$sql = "SELECT price,quantity,expire_date
				FROM imported_herbal_info 
				where id = '$id'
				";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	public function GetSelectForEditMedical($id){
		$conn = self::selfconnectDb();
		$post = array();
		$sql = "SELECT import_price,import_quantity
				FROM imported_medical_info 
				where id = '$id'
				";
		$result = mysqli_query($conn, $sql);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	public function GetSelectForEditOfficers($id){
		$conn = self::selfconnectDb();
		$post = array();
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
}
?>