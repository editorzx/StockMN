<?php
define("ERROR_LOGIN", "การเข้าสู่ระบบผิดพลาด");
define("ERROR_EMPTY_LOGIN", "กรุณาใส่ข้อมูลให้ครบถ้วน.");
define("IS_ADMIN","ผู้ดูแลระบบ");
define("IS_MEDIC","แพทย์");

define("EXPORTMEDICAL_STRING","คุณ %s ได้ทำการเบิก %s ออกจากคลังเวชภัณฑ์เป็นจำนวน %u %s คิดเป็นเงิน %u บาท");

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
    ['ยาสมุนไพร','*'],
	['เวชภัณฑ์','*'],
	['คลังใน','*'],
	['คลังนอก','*'],
));

define('MENUHEAD2' , 'จัดการคลังใน');
define('MENU_MANAGEMENT2', array(
    ['นำเข้ายาสมุนไพร','imported_Herbalwarehouse'],
    ['จ่ายยาสมุนไพร','*'],
    ['ประวัติการนำเข้ายาสมุนไพร','edit_warehouse'],
    ['นำเข้าเวชภัณฑ์','imported_medical'],
    ['ประวัติการนำเข้าเวชภัณฑ์','edit_medical'],
	['เบิกเวชภัณฑ์','export_medical'],
	['ประวัติการจ่ายเบิกจ่าย','history_list'],
	['ตรวจสอบยาสมุนไพรและเวชภัณฑ์','check_stock'],
));

define('MENU_MANAGEMENT3', array(
    'จัดการคลังนอก',
    'เบิกยาสมุนไพรจากคลังใน',
    'จ่ายยาสมุนไพร',
));

define('MENU_MANAGEMENT4', array(
    ' ตรวจสอบรายการ(REPORT)',
));

?>