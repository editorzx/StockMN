<?php
define("ERROR_LOGIN", "การเข้าสู่ระบบผิดพลาด");
define("ERROR_EMPTY_LOGIN", "กรุณาใส่ข้อมูลให้ครบถ้วน.");
define("IS_ADMIN","ผู้ดูแลระบบ");
define("IS_MEDIC","แพทย์");

define("EXPORTMEDICAL_STRING","คุณ %s ได้ทำการเบิก %s ออกจากคลังเวชภัณฑ์เป็นจำนวน %u %s คิดเป็นเงิน %u บาท");
define("DETAIL_MEDICAL","เวชภัณฑ์ <font color=\"#bf9e0b\"> %s </font> อยู่ในคลัง <font color=\"red\"> %u </font> %s ราคานำจ่ายคือ  <font color=\"#6cff03\"> %s </font> บาท");

define("DETAIL_HERBAL","ยาสมุนไพร <font color=\"#bf9e0b\"> %s </font> อยู่ในคลัง <font color=\"red\"> %u </font> %s อยู่ในยาสมุดไพรชนิด  <font color=\"#6cff03\"> %s </font>");

define("MINIMUM_HERBAL_DESC", array(
	["ยาสมุนไพรคลังในกำลังจะหมด","ยาสมุนไพรคลังในคงเหลือน้อยหลายรายการ กรุณารีบไปตรวจสอบเพื่อทำการสั่งยาสมุนไพรใหม่"],
	["ยาสมุนไพรคลังในกำลังจะหมดอายุ","ยาสมุนไพรคลังในใกล้จะหมดอายุหลายรายการ กรุณารีบไปตรวจสอบเพื่อทำการสั่งยาสมุนไพรใหม่"],
	["ยาสมุนไพรคลังนอกเหลือน้อย", "มียาสมุนไพรบางรายการกำลังจะหมดจากคลังสินค้าด้านนอก กรุณารีบเบิกจากคลังนอก"],
	["ยาสมุนไพรคลังนอกกำลังจะหมดอายุ", "มีรายการยาสมุนไพรจากคลังนอกใกล้จะหมดอายุกรุณาเร่งรัดการเบิกจ่าย จากคลังนอก"],
	["เวชภัณฑ์คงเหลือน้อย", "มีรายการเวชภัณฑ์ในคลังในบางรายการคงเหลือน้อยกรุณาเร่งรัดไปตรวจสอบ"],
));

define("ALERT_MAXIMUM", -1);


///REPORT
define("REPORT_INTOOUT_NAME", "รายงานการเบิกจ่ายยาสมุนไพรระหว่างวันที่ ");
define("REPORT_INSTOCK_NAME", "รายงานยาสมุนไพรและเวชภัณฑ์คงเหลือสต๊อกใน ");
define("REPORT_SELLHERBAL_NAME", "รายงานยาสมุนไพรและเวชภัณฑ์คงเหลือสต๊อกใน ");
define("REPORT_IMPORTINSTOCK_NAME", "รายงานรายละเอียดการนำเข้ายาสมุนไพรและเวชภัณฑ์ ");
define("REPORT_OUTSTOCK_NAME", "รายงานยาสมุนไพรคงเหลือสตีอกนอก ");

define("GOBAL_NAME", "สำนักงานสาธารณสุขจังหวัดปราจีนบุรี");
define("MINGOBAL_NAME", "ศูนย์ส่งเสริมสุขภาพแพทย์แผนไทย กลุ่มงานการแพทย์แผนไทยและการแพทย์ทางเลือก");
//

////////////////////////////////======MENU==========///////////////////////////
define("MENU_LOGOUT","ออกจากระบบ");
define('MENUHEAD' , 'จัดการ');
define('MENU_MANAGEMENT', array(
    ['ผู้ใช้','officers_list'],
    ['ข้อมูลยาสมุนไพร','herbal-info'],
	['ข้อมูลเวชภัณฑ์','medical-info'],
	['ข้อมูลคู่ค้า', 'partner-info'],
	['ข้อมูลประเภทยา', 'type-info'],
	['ข้อมูลล็อต', 'lot-info'],
	['ข้อมูลหน่วยนับ', 'counting-info'],
	//['คลังใน','*'],
	//['คลังนอก','*'],
));

define('MENUHEAD2' , 'จัดการคลังใน');
////////Name,List or link, icon///////
define('MENU_MANAGEMENT2', array(
	['ยาสมุนไพร', array(
		['นำเข้ายาสมุนไพร', 'imported_Herbalwarehouse'],
		['ข้อมูลการนำเข้ายาสมุนไพร', 'log_herbalwarehoure'],
	), 'cil-drop'],
	['เวชภัณฑ์', array(
		['นำเข้าเวชภัณฑ์','imported_medical'],
		['ประวัติการนำเข้าเวชภัณฑ์','log_medicalwarehouse'],
		['เบิกเวชภัณฑ์','export_medical'],
		['ประวัติการเบิกจ่ายเวชภัณฑ์', 'history_list', 'cil-library'],
	), 'cil-healing'],
	['ตรวจสอบยาสมุนไพรและเวชภัณฑ์', 'check_stock', 'cil-list'], 
));

define('MENUHEAD3' , 'จัดการคลังนอก');
define('MENU_MANAGEMENT3', array(
	['ยาสมุนไพร', array(
		['เบิกยาสมุนไพรจากคลังใน', 'export_herbal'],
		['จ่ายยาสมุนไพร', 'selling_herbal'],
	), 'cil-leaf'],
    ['ตรวจสอบยาสมุนไพร', 'check_outstock', 'cil-list'], 
));

define('MENUHEAD4' , 'รายงานข้อมูล');
define('MENU_MANAGEMENT4', array(
	['รายงานทั้งหมด', 'report_all', 'cil-leaf'],
));

?>