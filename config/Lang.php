<?php
define("ERROR_LOGIN", "การเข้าสู่ระบบผิดพลาด");
define("ERROR_EMPTY_LOGIN", "กรุณาใส่ข้อมูลให้ครบถ้วน.");
define("IS_ADMIN","ผู้ดูแลระบบ");
define("IS_MEDIC","แพทย์");

define("EXPORTMEDICAL_STRING","คุณ %s ได้ทำการเบิก %s ออกจากคลังเวชภัณฑ์เป็นจำนวน %u %s คิดเป็นเงิน %u บาท");
define("DETAIL_MEDICAL","เวชภัณฑ์ <font color=\"#bf9e0b\"> %s </font> อยู่ในคลัง <font color=\"red\"> %u </font> %s ราคานำจ่ายคือ  <font color=\"#6cff03\"> %s </font> บาท");

define("DETAIL_HERBAL","ยาสมุนไพร <font color=\"#bf9e0b\"> %s </font> อยู่ในคลัง <font color=\"red\"> %u </font> %s อยู่ในยาสมุดไพรชนิด  <font color=\"#6cff03\"> %s </font>");

define("MINIMUM_HERBAL", 15);
define("ALERT_MAXIMUM", 3);

define("MINIMUM_MEDICAL", 15);
/*define("","");
define("","");
define("","");
define("","");
define("","");
define("","");
define("","");
define("","");
define("","");*/

////////////////////////////////======MENU==========///////////////////////////
define("MENU_LOGOUT","ออกจากระบบ");
define('MENUHEAD' , 'จัดการ');
define('MENU_MANAGEMENT', array(
    ['ผู้ใช้','officers_list'],
    ['ข้อมูลยาสมุนไพร','herbal-info'],
	['ข้อมูลเวชภัณฑ์','medical-info'],
	//['คลังใน','*'],
	//['คลังนอก','*'],
));

define('MENUHEAD2' , 'จัดการคลังใน');
define('MENU_MANAGEMENT2', array(
    ['นำเข้ายาสมุนไพร','imported_Herbalwarehouse'],
    //['จ่ายยาสมุนไพร','*'],
    ['ประวัติการนำเข้ายาสมุนไพร','edit_warehouse'],
	['',''],
    ['นำเข้าเวชภัณฑ์','imported_medical'],
    ['ประวัติการนำเข้าเวชภัณฑ์','edit_medical'],
	['เบิกเวชภัณฑ์','export_medical'],
	['ประวัติการเบิกจ่าย','history_list'],
	['ตรวจสอบยาสมุนไพรและเวชภัณฑ์','check_stock'],
));

define('MENUHEAD3' , 'จัดการคลังนอก');
define('MENU_MANAGEMENT3', array(
    ['เบิกยาสมุนไพรจากคลังใน', 'improveherbal'],
    ['เบิกยาสมุนไพรจากคลังใน', 'improveherbal'],
));

define('MENU_MANAGEMENT4', array(
    ' ตรวจสอบรายการ(REPORT)',
));

?>