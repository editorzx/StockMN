/*
 Navicat Premium Data Transfer

 Source Server         : kdxr.xyz_3306
 Source Server Type    : MySQL
 Source Server Version : 100505
 Source Host           : 154.202.3.61:3306
 Source Schema         : herbal_stockmanagement

 Target Server Type    : MySQL
 Target Server Version : 100505
 File Encoding         : 65001

 Date: 30/07/2021 18:08:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for counting_list
-- ----------------------------
DROP TABLE IF EXISTS `counting_list`;
CREATE TABLE `counting_list`  (
  `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of counting_list
-- ----------------------------
INSERT INTO `counting_list` VALUES (1, 'กล่อง', 1);
INSERT INTO `counting_list` VALUES (2, 'ขวด', 1);
INSERT INTO `counting_list` VALUES (3, 'อัน', 1);
INSERT INTO `counting_list` VALUES (4, 'ถุง', 1);
INSERT INTO `counting_list` VALUES (5, 'กระปุก', 1);
INSERT INTO `counting_list` VALUES (6, 'ชิ้น', 1);
INSERT INTO `counting_list` VALUES (7, 'ผืน', 1);
INSERT INTO `counting_list` VALUES (8, 'ตัว', 1);
INSERT INTO `counting_list` VALUES (9, 'หลอด', 1);
INSERT INTO `counting_list` VALUES (11, 'กพิเศษ', 0);

-- ----------------------------
-- Table structure for exported_herbal_intoout_data
-- ----------------------------
DROP TABLE IF EXISTS `exported_herbal_intoout_data`;
CREATE TABLE `exported_herbal_intoout_data`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_officers` int(11) NOT NULL DEFAULT 1,
  `date` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_officers`(`id_officers`) USING BTREE,
  CONSTRAINT `exported_herbal_intoout_data_ibfk_1` FOREIGN KEY (`id_officers`) REFERENCES `officers` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exported_herbal_intoout_data
-- ----------------------------
INSERT INTO `exported_herbal_intoout_data` VALUES (1, 1, '2021-07-05 13:27:51');
INSERT INTO `exported_herbal_intoout_data` VALUES (2, 1, '2021-07-05 13:43:07');

-- ----------------------------
-- Table structure for exported_herbal_intoout_info
-- ----------------------------
DROP TABLE IF EXISTS `exported_herbal_intoout_info`;
CREATE TABLE `exported_herbal_intoout_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_data` int(11) NOT NULL,
  `id_instock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_data`(`id_data`) USING BTREE,
  INDEX `id_instock`(`id_instock`) USING BTREE,
  CONSTRAINT `exported_herbal_intoout_info_ibfk_1` FOREIGN KEY (`id_data`) REFERENCES `exported_herbal_intoout_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `exported_herbal_intoout_info_ibfk_2` FOREIGN KEY (`id_instock`) REFERENCES `instock_herbal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exported_herbal_intoout_info
-- ----------------------------
INSERT INTO `exported_herbal_intoout_info` VALUES (1, 1, 1, 50);
INSERT INTO `exported_herbal_intoout_info` VALUES (2, 2, 3, 450);

-- ----------------------------
-- Table structure for exported_herbal_sell_data
-- ----------------------------
DROP TABLE IF EXISTS `exported_herbal_sell_data`;
CREATE TABLE `exported_herbal_sell_data`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_officer` int(11) NOT NULL,
  `pending_date` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_officer`(`id_officer`) USING BTREE,
  CONSTRAINT `exported_herbal_sell_data_ibfk_1` FOREIGN KEY (`id_officer`) REFERENCES `officers` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exported_herbal_sell_data
-- ----------------------------
INSERT INTO `exported_herbal_sell_data` VALUES (1, 1, '2021-07-05 13:29:29');
INSERT INTO `exported_herbal_sell_data` VALUES (2, 1, '2021-07-05 13:43:28');

-- ----------------------------
-- Table structure for exported_herbal_sell_info
-- ----------------------------
DROP TABLE IF EXISTS `exported_herbal_sell_info`;
CREATE TABLE `exported_herbal_sell_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_data` int(11) NOT NULL,
  `id_outstock` int(11) NOT NULL,
  `status_id` int(10) NOT NULL DEFAULT 0,
  `pending_quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(10, 2) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_data`(`id_data`) USING BTREE,
  INDEX `id_outstock`(`id_outstock`) USING BTREE,
  INDEX `status_id`(`status_id`) USING BTREE,
  CONSTRAINT `exported_herbal_sell_info_ibfk_1` FOREIGN KEY (`id_data`) REFERENCES `exported_herbal_sell_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `exported_herbal_sell_info_ibfk_2` FOREIGN KEY (`id_outstock`) REFERENCES `outstock_herbal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `exported_herbal_sell_info_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `sell_status_list` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exported_herbal_sell_info
-- ----------------------------
INSERT INTO `exported_herbal_sell_info` VALUES (1, 1, 1, 2, 25, 45.00);
INSERT INTO `exported_herbal_sell_info` VALUES (2, 2, 2, 1, 300, 45.00);

-- ----------------------------
-- Table structure for exported_medical_data
-- ----------------------------
DROP TABLE IF EXISTS `exported_medical_data`;
CREATE TABLE `exported_medical_data`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_officers` int(11) NOT NULL,
  `out_date` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_officers`(`id_officers`) USING BTREE,
  CONSTRAINT `exported_medical_data_ibfk_1` FOREIGN KEY (`id_officers`) REFERENCES `officers` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exported_medical_info
-- ----------------------------
DROP TABLE IF EXISTS `exported_medical_info`;
CREATE TABLE `exported_medical_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_export_data` int(11) NOT NULL,
  `id_instock` int(11) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT 0,
  `out_price` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `status_id` int(11) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_export_data`(`id_export_data`) USING BTREE,
  INDEX `id_instock`(`id_instock`) USING BTREE,
  INDEX `status_id`(`status_id`) USING BTREE,
  CONSTRAINT `exported_medical_info_ibfk_1` FOREIGN KEY (`id_export_data`) REFERENCES `exported_medical_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `exported_medical_info_ibfk_2` FOREIGN KEY (`id_instock`) REFERENCES `instock_medical` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `exported_medical_info_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `sell_status_list` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for herbal_list
-- ----------------------------
DROP TABLE IF EXISTS `herbal_list`;
CREATE TABLE `herbal_list`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Counting` int(11) UNSIGNED NOT NULL,
  `Id_Type_Herbal` int(11) NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Desc` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE,
  INDEX `Fk_Id_Type_Herbal`(`Id_Type_Herbal`) USING BTREE,
  INDEX `Id_Counting`(`Id_Counting`) USING BTREE,
  CONSTRAINT `Fk_Id_Type_Herbal` FOREIGN KEY (`Id_Type_Herbal`) REFERENCES `type_herbal` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `herbal_list_ibfk_1` FOREIGN KEY (`Id_Counting`) REFERENCES `counting_list` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of herbal_list
-- ----------------------------
INSERT INTO `herbal_list` VALUES (1, 3, 2, 'ลูกประคบสมุนไพร', ' ใช้สำหรับประคบอาการปวดเมื่อย1 ', 1);
INSERT INTO `herbal_list` VALUES (2, 5, 1, 'หญ้าปักกิ่ง', 'ยาสมุนไพรใช้สำหรับรักษามะเร็ง', 1);
INSERT INTO `herbal_list` VALUES (3, 5, 1, 'บัวบก', 'ยาสมุนไพรช่วยแก้อาการร้อนใน', 1);
INSERT INTO `herbal_list` VALUES (4, 5, 1, 'เพชรสังฆาต', 'ยาสมุนไพรรักษาริดสีดวง', 1);
INSERT INTO `herbal_list` VALUES (5, 5, 1, 'ฟ้าทะลายโจร', 'ยาสมุนไพรรักษาโรคติดเชื้อเฉียบพลันของระบบทางเดินหายใจ', 1);
INSERT INTO `herbal_list` VALUES (6, 5, 1, 'ยอ', 'ยาสมุนไพรช่วยแก้อาการคลื่นไส้อาเจียน', 1);
INSERT INTO `herbal_list` VALUES (7, 5, 1, 'เถาวัลย์เปรียง', 'ยาสมุนไพรช่วยแก้เหน็บชา', 1);
INSERT INTO `herbal_list` VALUES (8, 5, 1, 'บอระเพ็ด', 'ยาสมุนไพรช่วยแก้อาการไข้จับสั่น', 1);
INSERT INTO `herbal_list` VALUES (9, 2, 4, 'ขมิ้นชัน', 'ยาสมุนไพรช่วยแก้อาการปวดและป้องกันอาการปวดข้ออักเสบ', 1);
INSERT INTO `herbal_list` VALUES (10, 5, 1, 'มะระ', 'ยาสมุนไพรช่วยลดน้ำตาลในเลือด', 1);
INSERT INTO `herbal_list` VALUES (11, 5, 1, 'ปราบชมพูทวีป', 'ยาสมุนไพรช่วยปรับสมดุลธาตุน้ำ และธาตุลม ส่งผลให้ร่างกายกลับสู่ภาวะปกติ', 1);
INSERT INTO `herbal_list` VALUES (12, 5, 1, 'สหัสธารา', 'ยาสมุนไพรรักษาอาการปวดเมื่อยร่างกาย', 1);
INSERT INTO `herbal_list` VALUES (13, 5, 1, 'จันทลีลา', 'ยาสมุนไพรแก้ไข้ตัวร้อน ไข้เปลี่ยนฤดู', 1);
INSERT INTO `herbal_list` VALUES (14, 5, 1, 'ห้าราก', 'ยาสมุนไพรช่วยบรรเทาอาการไข้', 1);
INSERT INTO `herbal_list` VALUES (15, 5, 1, 'รางจืด', 'ยาสมุนไพรช่วยแก้ร้อนในกระหายน้ำ ถอนพิษไข้ ลดไข้', 1);
INSERT INTO `herbal_list` VALUES (16, 5, 1, 'ขิง', 'ยาสมุนไพรลดอาการท้องอืด ช่วยขับลม', 1);
INSERT INTO `herbal_list` VALUES (17, 2, 1, 'ยาน้ำมะขามป้อม', 'ยาสมุนไพรบรรเทาอาการไอ ขับเสมหะ ช่วยให้ชุ่มคอ', 1);
INSERT INTO `herbal_list` VALUES (18, 5, 1, 'ยาอมมะขามป้อม', 'ยาสมุนไพรบรรเทาอาการไอ ขับเสมหะ ช่วยให้ชุ่มคอ', 1);
INSERT INTO `herbal_list` VALUES (19, 5, 1, 'มะขามแขก', 'ยาสมุนไพรยาระบาย ยาถ่าย', 1);
INSERT INTO `herbal_list` VALUES (20, 9, 2, 'ครีมแขก', 'ยาสมุนไพรบรรเทาอาการปวดเมื่อยตามร่างกาย เคล็ดขัดยอก', 1);
INSERT INTO `herbal_list` VALUES (21, 9, 2, 'ครีมเสลดพังพอน', 'ยาสมุนไพรช่วยรักษาแผลโรคผิวหนัง', 1);
INSERT INTO `herbal_list` VALUES (22, 2, 2, 'คาลาไมน์พญายอ', 'ยาสมุนไพรแก้อาการผดผื่นคัน ตุ่มคัน', 1);
INSERT INTO `herbal_list` VALUES (23, 2, 2, 'ยาหม่องเสลดพังพอน', 'ยาสมุนไพรบรรเทาอาการวิงเวียนศรีษระ หน้ามืด', 1);
INSERT INTO `herbal_list` VALUES (24, 2, 1, 'เพชรสังฆาต(ลูกกลอน)', 'ยาสมุนไพรรักษาริดสีดวงทวารหนัก', 1);
INSERT INTO `herbal_list` VALUES (25, 2, 2, 'น้ำมันไพล', 'ยาสมุนไพรรักษาอาการกล้ามเนื้อ และกระดูก', 1);
INSERT INTO `herbal_list` VALUES (26, 2, 2, 'ยาหม่องไพล', 'ยาสมุนไพรบรรเทาอาการปวดเมื่อยตามร่างกาย เคล็ดขัดยอก', 1);
INSERT INTO `herbal_list` VALUES (27, 2, 2, 'ยาหอม', 'ยาสมุนไพรเพิ่มการทำงานของธาตุลม', 1);
INSERT INTO `herbal_list` VALUES (28, 5, 1, 'เพกา', 'ยาสมุนไพรรักษาอาการพกช้ำ ปวดบวม อักเสบ', 1);
INSERT INTO `herbal_list` VALUES (30, 9, 2, 'ทดสอบเพิ่มยาสมุนไพร', 'ทดสอบ', 0);
INSERT INTO `herbal_list` VALUES (31, 1, 1, 'xxx', 'sss', 0);

-- ----------------------------
-- Table structure for imported_herbal_data
-- ----------------------------
DROP TABLE IF EXISTS `imported_herbal_data`;
CREATE TABLE `imported_herbal_data`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_officers` int(11) NOT NULL,
  `date` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_officers`(`id_officers`) USING BTREE,
  CONSTRAINT `imported_herbal_data_ibfk_1` FOREIGN KEY (`id_officers`) REFERENCES `officers` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of imported_herbal_data
-- ----------------------------
INSERT INTO `imported_herbal_data` VALUES (1, 1, '2021-07-05 13:25:51');
INSERT INTO `imported_herbal_data` VALUES (2, 1, '2021-07-05 13:26:29');
INSERT INTO `imported_herbal_data` VALUES (3, 1, '2021-07-05 13:42:49');

-- ----------------------------
-- Table structure for imported_herbal_info
-- ----------------------------
DROP TABLE IF EXISTS `imported_herbal_info`;
CREATE TABLE `imported_herbal_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_import_data` int(11) NOT NULL,
  `id_herbal` int(11) NOT NULL,
  `id_partner` int(11) NOT NULL,
  `id_lot` int(11) NOT NULL,
  `price` decimal(10, 2) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `expire_date` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_import_data`(`id_import_data`) USING BTREE,
  INDEX `id_herbal`(`id_herbal`) USING BTREE,
  INDEX `id_partner`(`id_partner`) USING BTREE,
  INDEX `id_lot`(`id_lot`) USING BTREE,
  CONSTRAINT `imported_herbal_info_ibfk_1` FOREIGN KEY (`id_import_data`) REFERENCES `imported_herbal_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `imported_herbal_info_ibfk_2` FOREIGN KEY (`id_herbal`) REFERENCES `herbal_list` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `imported_herbal_info_ibfk_3` FOREIGN KEY (`id_partner`) REFERENCES `partner_list` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `imported_herbal_info_ibfk_4` FOREIGN KEY (`id_lot`) REFERENCES `lot_list` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of imported_herbal_info
-- ----------------------------
INSERT INTO `imported_herbal_info` VALUES (1, 1, 9, 1, 1, 790.00, 150, '2021-07-22 00:00:00');
INSERT INTO `imported_herbal_info` VALUES (2, 2, 13, 2, 2, 500.00, 150, '2021-07-15 00:00:00');
INSERT INTO `imported_herbal_info` VALUES (3, 3, 8, 1, 5, 1500.00, 500, '2021-07-23 00:00:00');

-- ----------------------------
-- Table structure for imported_medical_data
-- ----------------------------
DROP TABLE IF EXISTS `imported_medical_data`;
CREATE TABLE `imported_medical_data`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_officer` int(11) NOT NULL,
  `import_date` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_officer`(`id_officer`) USING BTREE,
  CONSTRAINT `imported_medical_data_ibfk_1` FOREIGN KEY (`id_officer`) REFERENCES `officers` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for imported_medical_info
-- ----------------------------
DROP TABLE IF EXISTS `imported_medical_info`;
CREATE TABLE `imported_medical_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_import_data` int(11) NOT NULL,
  `id_medical` int(11) NOT NULL,
  `id_partner` int(11) NOT NULL,
  `id_lot` int(11) NOT NULL,
  `import_quantity` int(11) NOT NULL DEFAULT 0,
  `import_price` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_medical`(`id_medical`) USING BTREE,
  INDEX `id_partner`(`id_partner`) USING BTREE,
  INDEX `id_import_data`(`id_import_data`) USING BTREE,
  INDEX `id_lot`(`id_lot`) USING BTREE,
  CONSTRAINT `imported_medical_info_ibfk_2` FOREIGN KEY (`id_medical`) REFERENCES `medical_list` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `imported_medical_info_ibfk_3` FOREIGN KEY (`id_partner`) REFERENCES `partner_list` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `imported_medical_info_ibfk_4` FOREIGN KEY (`id_import_data`) REFERENCES `imported_medical_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `imported_medical_info_ibfk_5` FOREIGN KEY (`id_lot`) REFERENCES `lot_list` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for instock_herbal
-- ----------------------------
DROP TABLE IF EXISTS `instock_herbal`;
CREATE TABLE `instock_herbal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_import_info` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_import_info`(`id_import_info`) USING BTREE,
  CONSTRAINT `instock_herbal_ibfk_1` FOREIGN KEY (`id_import_info`) REFERENCES `imported_herbal_info` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of instock_herbal
-- ----------------------------
INSERT INTO `instock_herbal` VALUES (1, 1, 100);
INSERT INTO `instock_herbal` VALUES (2, 2, 150);
INSERT INTO `instock_herbal` VALUES (3, 3, 50);

-- ----------------------------
-- Table structure for instock_medical
-- ----------------------------
DROP TABLE IF EXISTS `instock_medical`;
CREATE TABLE `instock_medical`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_import_info` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_import_info`(`id_import_info`) USING BTREE,
  CONSTRAINT `instock_medical_ibfk_1` FOREIGN KEY (`id_import_info`) REFERENCES `imported_medical_info` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lot_list
-- ----------------------------
DROP TABLE IF EXISTS `lot_list`;
CREATE TABLE `lot_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lot_list
-- ----------------------------
INSERT INTO `lot_list` VALUES (1, 'ล็อตที่ 1', 1);
INSERT INTO `lot_list` VALUES (2, 'ล็อตที่ 2', 1);
INSERT INTO `lot_list` VALUES (4, 'ล็อต พิเศษ วันที่ 22', 1);
INSERT INTO `lot_list` VALUES (5, 'ล็อตที่ 3', 1);

-- ----------------------------
-- Table structure for medical_list
-- ----------------------------
DROP TABLE IF EXISTS `medical_list`;
CREATE TABLE `medical_list`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Counting` int(11) UNSIGNED NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Desc` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE,
  INDEX `Id_Counting`(`Id_Counting`) USING BTREE,
  CONSTRAINT `medical_list_ibfk_1` FOREIGN KEY (`Id_Counting`) REFERENCES `counting_list` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of medical_list
-- ----------------------------
INSERT INTO `medical_list` VALUES (1, 8, 'เสื้อคนไข้', 'ใช้สำหรับเปลี่ยนเข้ารับการรักษา', 1);
INSERT INTO `medical_list` VALUES (2, 8, 'กางเกงคนไข้', 'ใช้สำหรับเปลี่ยนเข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (3, 1, 'ยงสาหร่าย', 'ใช้สำหรับผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (4, 2, 'ครีมนวดหน้า', 'ใช้สำหรับนวดหน้าผู้เข้ารับการรักษา', 1);
INSERT INTO `medical_list` VALUES (5, 2, 'Cleansing milk', 'ใช้สำหรับผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (6, 3, 'ฟองน้ำเช็ดหน้า', 'ใช้สำหรับเช็ดหน้าผู้เข้ารับการรักษา', 1);
INSERT INTO `medical_list` VALUES (7, 4, 'สำลีแผ่น', 'ใช้สำหรับเช็ดหน้าผู้เข้ารับการรักษา', 1);
INSERT INTO `medical_list` VALUES (8, 4, 'สำลีก้อน', 'ใช้สำหรับผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (9, 4, 'ผงขมิ้น', 'ใช้สำหรับผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (10, 2, 'แป้งเด็ก', 'ใช้สำหรับผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (11, 2, 'Baby Oil', 'ใช้สำหรับผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (12, 5, 'ครีมนวดเท้า', 'ใช้สำหรับนวดเท้าผู้เข้ารับการรักษา', 1);
INSERT INTO `medical_list` VALUES (13, 6, 'แมสก์', 'ใช้สำหรับเจ้าหน้าที่นวด', 1);
INSERT INTO `medical_list` VALUES (14, 2, 'แอลกอฮอล์(ชนิดน้ำ)', 'ใช้สำหรับทำความสะอาด', 1);
INSERT INTO `medical_list` VALUES (15, 7, 'ผ้าขนหนูผืนเล็ก', 'ใช้สำหรับผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (16, 7, 'ผ้าขนหนูผืนใหญ่', 'ใช้สำหรับผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (17, 3, 'ปลอกหมอน', 'ใช้สำหรับเปลี่ยนกับปลอกหมอนที่ใช้งานแล้ว', 1);
INSERT INTO `medical_list` VALUES (18, 3, 'ผ้าปูที่นอน', 'ใช้สำหรับเปลี่ยนกับผ้าปูที่นอนที่ใช้งานแล้ว', 1);
INSERT INTO `medical_list` VALUES (19, 3, 'ผ้าขวาง(นวดตัว)', 'ใช้สำหรับนวดตัวผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (20, 3, 'ผ้าขวาง(นวดหน้า)', 'ใช้สำหรับนวดหน้าผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (21, 7, 'ผ้าห่ม', 'ใช้สำหรับผู้เข้าการรับษา', 1);
INSERT INTO `medical_list` VALUES (22, 1, 'ทดสอบเพิ่มเวชภัณฑ์', '555', 0);
INSERT INTO `medical_list` VALUES (23, 6, 'ทดสอบรอบสอง', 'ฟหดฟหด', 0);

-- ----------------------------
-- Table structure for officers
-- ----------------------------
DROP TABLE IF EXISTS `officers`;
CREATE TABLE `officers`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `isAdmin` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `Officer_Name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Officer_Lastname` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Last_Login` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of officers
-- ----------------------------
INSERT INTO `officers` VALUES (1, 'admin@admin.admin', '64c92c5c3ba68347283cc112ebc49220', 1, 'สายธาร ', 'อ้นประเสริฐ', 'bc6bdda8a167b93f9b93ed192c9c9508', '2021-07-30 18:05:44', 1);
INSERT INTO `officers` VALUES (11, 'test@gmail.com', 'a6bee2d042a111261f3e4af3e95db5cd', 0, 'สายธาร', 'อ้นประเสริฐ', 'ff26bd7da6d83ff5c1a8acb01e6c38b5', '2021-06-04 13:37:28', 1);

-- ----------------------------
-- Table structure for outstock_herbal
-- ----------------------------
DROP TABLE IF EXISTS `outstock_herbal`;
CREATE TABLE `outstock_herbal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_exported_info` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_exported_info`(`id_exported_info`) USING BTREE,
  CONSTRAINT `outstock_herbal_ibfk_1` FOREIGN KEY (`id_exported_info`) REFERENCES `exported_herbal_intoout_info` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of outstock_herbal
-- ----------------------------
INSERT INTO `outstock_herbal` VALUES (1, 1, 25);
INSERT INTO `outstock_herbal` VALUES (2, 2, 150);

-- ----------------------------
-- Table structure for partner_list
-- ----------------------------
DROP TABLE IF EXISTS `partner_list`;
CREATE TABLE `partner_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of partner_list
-- ----------------------------
INSERT INTO `partner_list` VALUES (1, 'อภัยภูเบศ', 1);
INSERT INTO `partner_list` VALUES (2, 'กระต่ายบิน', 1);

-- ----------------------------
-- Table structure for sell_status_list
-- ----------------------------
DROP TABLE IF EXISTS `sell_status_list`;
CREATE TABLE `sell_status_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `isRemove` tinyint(255) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sell_status_list
-- ----------------------------
INSERT INTO `sell_status_list` VALUES (1, 'สนับสนุนใช้ในคลีนิค', 0);
INSERT INTO `sell_status_list` VALUES (2, 'สถานะพิเศษ', 0);

-- ----------------------------
-- Table structure for transaction_log_herbal
-- ----------------------------
DROP TABLE IF EXISTS `transaction_log_herbal`;
CREATE TABLE `transaction_log_herbal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_herbal_data` int(11) NOT NULL,
  `log_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_herbal_data`(`id_herbal_data`) USING BTREE,
  CONSTRAINT `transaction_log_herbal_ibfk_1` FOREIGN KEY (`id_herbal_data`) REFERENCES `imported_herbal_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaction_log_herbal
-- ----------------------------
INSERT INTO `transaction_log_herbal` VALUES (4, 1, 'พนักงานทำการเพิ่มยาสมุนไพร ขมิ้นชัน ลงในคลังจำนวน 150', '2021-07-05 13:25:51');
INSERT INTO `transaction_log_herbal` VALUES (5, 2, 'พนักงานทำการเพิ่มยาสมุนไพร จันทลีลา ลงในคลังจำนวน 150', '2021-07-05 13:26:29');
INSERT INTO `transaction_log_herbal` VALUES (6, 3, 'พนักงานทำการเพิ่มยาสมุนไพร บอระเพ็ด ลงในคลังจำนวน 500', '2021-07-05 13:42:49');

-- ----------------------------
-- Table structure for type_herbal
-- ----------------------------
DROP TABLE IF EXISTS `type_herbal`;
CREATE TABLE `type_herbal`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of type_herbal
-- ----------------------------
INSERT INTO `type_herbal` VALUES (1, 'ยาใช้ภายใน', 1);
INSERT INTO `type_herbal` VALUES (2, 'ยาใช้ภายนอก', 1);
INSERT INTO `type_herbal` VALUES (4, 'เพิ่มประเภทยา', 1);

-- ----------------------------
-- Table structure for web_settings
-- ----------------------------
DROP TABLE IF EXISTS `web_settings`;
CREATE TABLE `web_settings`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_name` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `minstockAlert` int(11) NULL DEFAULT 99,
  `mindateAlert` int(11) NULL DEFAULT 5,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of web_settings
-- ----------------------------
INSERT INTO `web_settings` VALUES (1, 'จัดการคลังยา', 100, 1500);

SET FOREIGN_KEY_CHECKS = 1;
