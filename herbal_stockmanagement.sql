/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100505
 Source Host           : localhost:3306
 Source Schema         : herbal_stockmanagement

 Target Server Type    : MySQL
 Target Server Version : 100505
 File Encoding         : 65001

 Date: 15/02/2021 22:28:32
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
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of counting_list
-- ----------------------------
INSERT INTO `counting_list` VALUES (1, 'กล่อง');
INSERT INTO `counting_list` VALUES (2, 'ขวด');
INSERT INTO `counting_list` VALUES (3, 'อัน');
INSERT INTO `counting_list` VALUES (4, 'ถุง');
INSERT INTO `counting_list` VALUES (5, 'กระปุก');
INSERT INTO `counting_list` VALUES (6, 'ชิ้น');
INSERT INTO `counting_list` VALUES (7, 'ผืน');
INSERT INTO `counting_list` VALUES (8, 'ตัว');
INSERT INTO `counting_list` VALUES (9, 'หลอด');

-- ----------------------------
-- Table structure for exported_herbal_intoout_data
-- ----------------------------
DROP TABLE IF EXISTS `exported_herbal_intoout_data`;
CREATE TABLE `exported_herbal_intoout_data`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exported_herbal_intoout_data
-- ----------------------------
INSERT INTO `exported_herbal_intoout_data` VALUES (1, '2021-02-03 15:21:44');
INSERT INTO `exported_herbal_intoout_data` VALUES (2, '2021-02-03 15:23:35');
INSERT INTO `exported_herbal_intoout_data` VALUES (3, '2021-02-03 15:24:16');
INSERT INTO `exported_herbal_intoout_data` VALUES (4, '2021-02-03 15:24:23');
INSERT INTO `exported_herbal_intoout_data` VALUES (5, '2021-02-03 15:24:44');
INSERT INTO `exported_herbal_intoout_data` VALUES (6, '2021-02-03 15:25:09');
INSERT INTO `exported_herbal_intoout_data` VALUES (7, '2021-02-03 15:25:14');
INSERT INTO `exported_herbal_intoout_data` VALUES (8, '2021-02-03 15:26:06');
INSERT INTO `exported_herbal_intoout_data` VALUES (9, '2021-02-03 15:27:41');
INSERT INTO `exported_herbal_intoout_data` VALUES (10, '2021-02-03 15:28:16');
INSERT INTO `exported_herbal_intoout_data` VALUES (11, '2021-02-03 15:37:31');
INSERT INTO `exported_herbal_intoout_data` VALUES (12, '2021-02-03 15:37:51');
INSERT INTO `exported_herbal_intoout_data` VALUES (13, '2021-02-03 19:08:31');
INSERT INTO `exported_herbal_intoout_data` VALUES (14, '2021-02-03 19:31:57');

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exported_herbal_intoout_info
-- ----------------------------
INSERT INTO `exported_herbal_intoout_info` VALUES (1, 9, 31, 128);
INSERT INTO `exported_herbal_intoout_info` VALUES (2, 10, 28, 9);
INSERT INTO `exported_herbal_intoout_info` VALUES (3, 11, 26, 0);
INSERT INTO `exported_herbal_intoout_info` VALUES (4, 12, 27, 250);
INSERT INTO `exported_herbal_intoout_info` VALUES (5, 13, 30, 12);
INSERT INTO `exported_herbal_intoout_info` VALUES (6, 14, 31, 118);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exported_herbal_sell_info
-- ----------------------------
DROP TABLE IF EXISTS `exported_herbal_sell_info`;
CREATE TABLE `exported_herbal_sell_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_data` int(11) NOT NULL,
  `id_outstock` int(11) NOT NULL,
  `pending_quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(10, 2) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_data`(`id_data`) USING BTREE,
  INDEX `id_outstock`(`id_outstock`) USING BTREE,
  CONSTRAINT `exported_herbal_sell_info_ibfk_1` FOREIGN KEY (`id_data`) REFERENCES `exported_herbal_sell_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `exported_herbal_sell_info_ibfk_2` FOREIGN KEY (`id_outstock`) REFERENCES `outstock_herbal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exported_medical_data
-- ----------------------------
DROP TABLE IF EXISTS `exported_medical_data`;
CREATE TABLE `exported_medical_data`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_officers` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `out_price` decimal(10, 2) UNSIGNED NOT NULL,
  `out_date` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_officers`(`id_officers`) USING BTREE,
  CONSTRAINT `exported_medical_data_ibfk_1` FOREIGN KEY (`id_officers`) REFERENCES `officers` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exported_medical_data
-- ----------------------------
INSERT INTO `exported_medical_data` VALUES (40, 1, 1, 1.00, '2020-11-03 15:29:34');
INSERT INTO `exported_medical_data` VALUES (41, 1, 1, 1.00, '2020-11-03 15:29:59');
INSERT INTO `exported_medical_data` VALUES (42, 1, 8, 1.00, '2020-11-03 15:30:04');
INSERT INTO `exported_medical_data` VALUES (43, 1, 1, 1.00, '2020-11-03 15:30:08');
INSERT INTO `exported_medical_data` VALUES (44, 1, 1, 1.00, '2020-11-03 15:30:14');
INSERT INTO `exported_medical_data` VALUES (45, 1, 1, 1.00, '2020-11-03 15:30:52');
INSERT INTO `exported_medical_data` VALUES (46, 1, 1, 1.00, '2020-11-03 15:31:09');
INSERT INTO `exported_medical_data` VALUES (47, 1, 0, 1.00, '2020-11-03 15:31:12');
INSERT INTO `exported_medical_data` VALUES (48, 1, 1, 1.00, '2020-11-03 15:31:21');
INSERT INTO `exported_medical_data` VALUES (49, 1, 1, 1.00, '2020-11-03 15:31:48');
INSERT INTO `exported_medical_data` VALUES (50, 1, 1, 1.00, '2020-11-03 15:32:43');
INSERT INTO `exported_medical_data` VALUES (51, 1, 1, 1.00, '2020-11-03 15:33:15');
INSERT INTO `exported_medical_data` VALUES (52, 1, 40, 1.00, '2020-11-03 15:33:58');
INSERT INTO `exported_medical_data` VALUES (53, 1, 88, 1.00, '2020-11-03 15:58:48');
INSERT INTO `exported_medical_data` VALUES (54, 1, 49, 1.00, '2020-11-03 15:58:48');
INSERT INTO `exported_medical_data` VALUES (55, 1, 2, 100.00, '2020-11-03 16:00:08');
INSERT INTO `exported_medical_data` VALUES (56, 1, 9, 120.00, '2020-11-03 16:00:08');
INSERT INTO `exported_medical_data` VALUES (57, 1, 1, 3.50, '2020-11-23 10:07:37');
INSERT INTO `exported_medical_data` VALUES (58, 1, 2, 10.00, '2020-11-30 10:14:00');

-- ----------------------------
-- Table structure for exported_medical_info
-- ----------------------------
DROP TABLE IF EXISTS `exported_medical_info`;
CREATE TABLE `exported_medical_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_export_data` int(11) NOT NULL,
  `id_instock` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_export_data`(`id_export_data`) USING BTREE,
  INDEX `id_instock`(`id_instock`) USING BTREE,
  CONSTRAINT `exported_medical_info_ibfk_1` FOREIGN KEY (`id_export_data`) REFERENCES `exported_medical_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `exported_medical_info_ibfk_2` FOREIGN KEY (`id_instock`) REFERENCES `instock_medical` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exported_medical_info
-- ----------------------------
INSERT INTO `exported_medical_info` VALUES (24, 40, 3);
INSERT INTO `exported_medical_info` VALUES (25, 40, 4);
INSERT INTO `exported_medical_info` VALUES (26, 41, 3);
INSERT INTO `exported_medical_info` VALUES (27, 41, 4);
INSERT INTO `exported_medical_info` VALUES (28, 42, 5);
INSERT INTO `exported_medical_info` VALUES (29, 43, 5);
INSERT INTO `exported_medical_info` VALUES (30, 44, 3);
INSERT INTO `exported_medical_info` VALUES (31, 44, 4);
INSERT INTO `exported_medical_info` VALUES (32, 45, 3);
INSERT INTO `exported_medical_info` VALUES (33, 45, 4);
INSERT INTO `exported_medical_info` VALUES (34, 46, 3);
INSERT INTO `exported_medical_info` VALUES (35, 46, 4);
INSERT INTO `exported_medical_info` VALUES (36, 48, 3);
INSERT INTO `exported_medical_info` VALUES (37, 48, 4);
INSERT INTO `exported_medical_info` VALUES (38, 49, 3);
INSERT INTO `exported_medical_info` VALUES (39, 49, 4);
INSERT INTO `exported_medical_info` VALUES (40, 50, 5);
INSERT INTO `exported_medical_info` VALUES (41, 51, 5);
INSERT INTO `exported_medical_info` VALUES (42, 52, 3);
INSERT INTO `exported_medical_info` VALUES (43, 53, 3);
INSERT INTO `exported_medical_info` VALUES (44, 53, 4);
INSERT INTO `exported_medical_info` VALUES (45, 54, 5);
INSERT INTO `exported_medical_info` VALUES (46, 55, 5);
INSERT INTO `exported_medical_info` VALUES (47, 56, 4);
INSERT INTO `exported_medical_info` VALUES (48, 57, 4);
INSERT INTO `exported_medical_info` VALUES (49, 58, 8);

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
  PRIMARY KEY (`Id`) USING BTREE,
  INDEX `Fk_Id_Type_Herbal`(`Id_Type_Herbal`) USING BTREE,
  INDEX `Id_Counting`(`Id_Counting`) USING BTREE,
  CONSTRAINT `Fk_Id_Type_Herbal` FOREIGN KEY (`Id_Type_Herbal`) REFERENCES `type_herbal` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `herbal_list_ibfk_1` FOREIGN KEY (`Id_Counting`) REFERENCES `counting_list` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of herbal_list
-- ----------------------------
INSERT INTO `herbal_list` VALUES (1, 3, 2, 'ลูกประคบสมุนไพร', ' ใช้สำหรับประคบอาการปวดเมื่อย1 ');
INSERT INTO `herbal_list` VALUES (2, 5, 1, 'หญ้าปักกิ่ง', 'ยาสมุนไพรใช้สำหรับรักษามะเร็ง');
INSERT INTO `herbal_list` VALUES (3, 5, 1, 'บัวบก', 'ยาสมุนไพรช่วยแก้อาการร้อนใน');
INSERT INTO `herbal_list` VALUES (4, 5, 1, 'เพชรสังฆาต', 'ยาสมุนไพรรักษาริดสีดวง');
INSERT INTO `herbal_list` VALUES (5, 5, 1, 'ฟ้าทะลายโจร', 'ยาสมุนไพรรักษาโรคติดเชื้อเฉียบพลันของระบบทางเดินหายใจ');
INSERT INTO `herbal_list` VALUES (6, 5, 1, 'ยอ', 'ยาสมุนไพรช่วยแก้อาการคลื่นไส้อาเจียน');
INSERT INTO `herbal_list` VALUES (7, 5, 1, 'เถาวัลย์เปรียง', 'ยาสมุนไพรช่วยแก้เหน็บชา');
INSERT INTO `herbal_list` VALUES (8, 5, 1, 'บอระเพ็ด', 'ยาสมุนไพรช่วยแก้อาการไข้จับสั่น');
INSERT INTO `herbal_list` VALUES (9, 5, 1, 'ขมิ้นชัน1', 'ยาสมุนไพรช่วยแก้อาการปวดและป้องกันอาการปวดข้ออักเสบ');
INSERT INTO `herbal_list` VALUES (10, 5, 1, 'มะระ', 'ยาสมุนไพรช่วยลดน้ำตาลในเลือด');
INSERT INTO `herbal_list` VALUES (11, 5, 1, 'ปราบชมพูทวีป', 'ยาสมุนไพรช่วยปรับสมดุลธาตุน้ำ และธาตุลม ส่งผลให้ร่างกายกลับสู่ภาวะปกติ');
INSERT INTO `herbal_list` VALUES (12, 5, 1, 'สหัสธารา', 'ยาสมุนไพรรักษาอาการปวดเมื่อยร่างกาย');
INSERT INTO `herbal_list` VALUES (13, 5, 1, 'จันทลีลา', 'ยาสมุนไพรแก้ไข้ตัวร้อน ไข้เปลี่ยนฤดู');
INSERT INTO `herbal_list` VALUES (14, 5, 1, 'ห้าราก', 'ยาสมุนไพรช่วยบรรเทาอาการไข้');
INSERT INTO `herbal_list` VALUES (15, 5, 1, 'รางจืด', 'ยาสมุนไพรช่วยแก้ร้อนในกระหายน้ำ ถอนพิษไข้ ลดไข้');
INSERT INTO `herbal_list` VALUES (16, 5, 1, 'ขิง', 'ยาสมุนไพรลดอาการท้องอืด ช่วยขับลม');
INSERT INTO `herbal_list` VALUES (17, 2, 1, 'ยาน้ำมะขามป้อม', 'ยาสมุนไพรบรรเทาอาการไอ ขับเสมหะ ช่วยให้ชุ่มคอ');
INSERT INTO `herbal_list` VALUES (18, 5, 1, 'ยาอมมะขามป้อม', 'ยาสมุนไพรบรรเทาอาการไอ ขับเสมหะ ช่วยให้ชุ่มคอ');
INSERT INTO `herbal_list` VALUES (19, 5, 1, 'มะขามแขก', 'ยาสมุนไพรยาระบาย ยาถ่าย');
INSERT INTO `herbal_list` VALUES (20, 9, 2, 'ครีมแขก', 'ยาสมุนไพรบรรเทาอาการปวดเมื่อยตามร่างกาย เคล็ดขัดยอก');
INSERT INTO `herbal_list` VALUES (21, 9, 2, 'ครีมเสลดพังพอน', 'ยาสมุนไพรช่วยรักษาแผลโรคผิวหนัง');
INSERT INTO `herbal_list` VALUES (22, 2, 2, 'คาลาไมน์พญายอ', 'ยาสมุนไพรแก้อาการผดผื่นคัน ตุ่มคัน');
INSERT INTO `herbal_list` VALUES (23, 2, 2, 'ยาหม่องเสลดพังพอน', 'ยาสมุนไพรบรรเทาอาการวิงเวียนศรีษระ หน้ามืด');
INSERT INTO `herbal_list` VALUES (24, 2, 1, 'เพชรสังฆาต(ลูกกลอน)1', 'ยาสมุนไพรรักษาริดสีดวงทวารหนัก');
INSERT INTO `herbal_list` VALUES (25, 2, 2, 'น้ำมันไพล', 'ยาสมุนไพรรักษาอาการกล้ามเนื้อ และกระดูก');
INSERT INTO `herbal_list` VALUES (26, 2, 2, 'ยาหม่องไพล', 'ยาสมุนไพรบรรเทาอาการปวดเมื่อยตามร่างกาย เคล็ดขัดยอก');
INSERT INTO `herbal_list` VALUES (27, 2, 2, 'ยาหอม', 'ยาสมุนไพรเพิ่มการทำงานของธาตุลม');
INSERT INTO `herbal_list` VALUES (28, 5, 1, 'เพกา', 'ยาสมุนไพรรักษาอาการพกช้ำ ปวดบวม อักเสบ');

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
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of imported_herbal_data
-- ----------------------------
INSERT INTO `imported_herbal_data` VALUES (14, 1, '2020-11-01 21:00:05');
INSERT INTO `imported_herbal_data` VALUES (15, 1, '2020-11-01 21:02:42');
INSERT INTO `imported_herbal_data` VALUES (16, 1, '2020-11-01 21:19:00');
INSERT INTO `imported_herbal_data` VALUES (17, 1, '2020-11-01 21:29:38');
INSERT INTO `imported_herbal_data` VALUES (18, 1, '2020-11-09 13:47:07');
INSERT INTO `imported_herbal_data` VALUES (19, 1, '2020-11-24 08:32:13');
INSERT INTO `imported_herbal_data` VALUES (20, 1, '2020-11-24 08:33:38');
INSERT INTO `imported_herbal_data` VALUES (21, 1, '2020-11-30 10:03:30');
INSERT INTO `imported_herbal_data` VALUES (22, 1, '2020-11-30 10:04:35');
INSERT INTO `imported_herbal_data` VALUES (23, 1, '2020-12-08 09:57:01');

-- ----------------------------
-- Table structure for imported_herbal_info
-- ----------------------------
DROP TABLE IF EXISTS `imported_herbal_info`;
CREATE TABLE `imported_herbal_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_import_data` int(11) NOT NULL,
  `id_herbal` int(11) NOT NULL,
  `id_partner` int(11) NOT NULL,
  `price` decimal(10, 2) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `expire_date` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_import_data`(`id_import_data`) USING BTREE,
  INDEX `id_herbal`(`id_herbal`) USING BTREE,
  INDEX `id_partner`(`id_partner`) USING BTREE,
  CONSTRAINT `imported_herbal_info_ibfk_1` FOREIGN KEY (`id_import_data`) REFERENCES `imported_herbal_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `imported_herbal_info_ibfk_2` FOREIGN KEY (`id_herbal`) REFERENCES `herbal_list` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `imported_herbal_info_ibfk_3` FOREIGN KEY (`id_partner`) REFERENCES `partner_list` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of imported_herbal_info
-- ----------------------------
INSERT INTO `imported_herbal_info` VALUES (6, 16, 1, 1, 7.09, 50, '2020-11-04 00:00:00');
INSERT INTO `imported_herbal_info` VALUES (7, 17, 1, 1, 1.00, 5, '2020-11-19 00:00:00');
INSERT INTO `imported_herbal_info` VALUES (8, 17, 16, 1, 90.00, 98, '2020-11-19 00:00:00');
INSERT INTO `imported_herbal_info` VALUES (9, 17, 16, 2, 90.00, 100, '2020-11-19 23:28:00');
INSERT INTO `imported_herbal_info` VALUES (10, 18, 13, 1, 1.00, 2, '2020-11-09 17:46:00');
INSERT INTO `imported_herbal_info` VALUES (11, 19, 10, 1, 150.00, 3, '2020-11-03 08:37:00');
INSERT INTO `imported_herbal_info` VALUES (12, 20, 14, 1, 13232.00, 294, '2020-11-11 08:35:00');
INSERT INTO `imported_herbal_info` VALUES (13, 21, 5, 1, 500.00, 10, '2020-11-10 00:01:00');
INSERT INTO `imported_herbal_info` VALUES (14, 22, 24, 1, 130.00, 10, '2020-11-10 00:01:00');
INSERT INTO `imported_herbal_info` VALUES (15, 22, 6, 1, 250.00, 14, '2020-11-10 00:01:00');
INSERT INTO `imported_herbal_info` VALUES (16, 22, 2, 1, 1030.00, 130, '2020-11-10 00:01:00');
INSERT INTO `imported_herbal_info` VALUES (17, 23, 9, 1, 1.00, 1, '2020-12-19 00:00:00');

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of imported_medical_data
-- ----------------------------
INSERT INTO `imported_medical_data` VALUES (1, 1, '2020-11-03 13:46:40');
INSERT INTO `imported_medical_data` VALUES (2, 1, '2020-11-03 13:47:24');
INSERT INTO `imported_medical_data` VALUES (3, 1, '2020-11-03 13:49:05');
INSERT INTO `imported_medical_data` VALUES (4, 1, '2020-11-24 08:30:57');
INSERT INTO `imported_medical_data` VALUES (5, 1, '2020-11-30 10:09:14');

-- ----------------------------
-- Table structure for imported_medical_info
-- ----------------------------
DROP TABLE IF EXISTS `imported_medical_info`;
CREATE TABLE `imported_medical_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_import_data` int(11) NOT NULL,
  `id_medical` int(11) NOT NULL,
  `id_partner` int(11) NOT NULL,
  `import_quantity` int(11) NOT NULL DEFAULT 0,
  `import_price` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_medical`(`id_medical`) USING BTREE,
  INDEX `id_partner`(`id_partner`) USING BTREE,
  INDEX `id_import_data`(`id_import_data`) USING BTREE,
  CONSTRAINT `imported_medical_info_ibfk_2` FOREIGN KEY (`id_medical`) REFERENCES `medical_list` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `imported_medical_info_ibfk_3` FOREIGN KEY (`id_partner`) REFERENCES `partner_list` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `imported_medical_info_ibfk_4` FOREIGN KEY (`id_import_data`) REFERENCES `imported_medical_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of imported_medical_info
-- ----------------------------
INSERT INTO `imported_medical_info` VALUES (1, 2, 1, 1, 2, 2.00);
INSERT INTO `imported_medical_info` VALUES (2, 3, 1, 1, 4, 2.00);
INSERT INTO `imported_medical_info` VALUES (3, 3, 9, 1, 11, 11.00);
INSERT INTO `imported_medical_info` VALUES (4, 4, 13, 1, 6, 10.00);
INSERT INTO `imported_medical_info` VALUES (5, 5, 6, 1, 100, 140.00);
INSERT INTO `imported_medical_info` VALUES (6, 5, 8, 1, 13, 200.00);

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
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of instock_herbal
-- ----------------------------
INSERT INTO `instock_herbal` VALUES (21, 6, 0);
INSERT INTO `instock_herbal` VALUES (22, 7, 0);
INSERT INTO `instock_herbal` VALUES (23, 8, 100);
INSERT INTO `instock_herbal` VALUES (24, 9, 100);
INSERT INTO `instock_herbal` VALUES (25, 10, 1);
INSERT INTO `instock_herbal` VALUES (26, 11, 0);
INSERT INTO `instock_herbal` VALUES (27, 12, 250);
INSERT INTO `instock_herbal` VALUES (28, 13, 9);
INSERT INTO `instock_herbal` VALUES (29, 14, 10);
INSERT INTO `instock_herbal` VALUES (30, 15, 12);
INSERT INTO `instock_herbal` VALUES (31, 16, 118);
INSERT INTO `instock_herbal` VALUES (32, 17, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of instock_medical
-- ----------------------------
INSERT INTO `instock_medical` VALUES (3, 1, 0);
INSERT INTO `instock_medical` VALUES (4, 2, 2);
INSERT INTO `instock_medical` VALUES (5, 3, 0);
INSERT INTO `instock_medical` VALUES (6, 4, 2);
INSERT INTO `instock_medical` VALUES (7, 5, 10);
INSERT INTO `instock_medical` VALUES (8, 6, 11);

-- ----------------------------
-- Table structure for medical_list
-- ----------------------------
DROP TABLE IF EXISTS `medical_list`;
CREATE TABLE `medical_list`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Counting` int(11) UNSIGNED NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Desc` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`Id`) USING BTREE,
  INDEX `Id_Counting`(`Id_Counting`) USING BTREE,
  CONSTRAINT `medical_list_ibfk_1` FOREIGN KEY (`Id_Counting`) REFERENCES `counting_list` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of medical_list
-- ----------------------------
INSERT INTO `medical_list` VALUES (1, 8, 'เสื้อคนไข้', 'ใช้สำหรับเปลี่ยนเข้ารับการรักษา');
INSERT INTO `medical_list` VALUES (2, 8, 'กางเกงคนไข้', 'ใช้สำหรับเปลี่ยนเข้าการรับษา');
INSERT INTO `medical_list` VALUES (3, 1, 'ยงสาหร่าย', 'ใช้สำหรับผู้เข้าการรับษา');
INSERT INTO `medical_list` VALUES (4, 2, 'ครีมนวดหน้า', 'ใช้สำหรับนวดหน้าผู้เข้ารับการรักษา');
INSERT INTO `medical_list` VALUES (5, 2, 'Cleansing milk', 'ใช้สำหรับผู้เข้าการรับษา');
INSERT INTO `medical_list` VALUES (6, 3, 'ฟองน้ำเช็ดหน้า', 'ใช้สำหรับเช็ดหน้าผู้เข้ารับการรักษา');
INSERT INTO `medical_list` VALUES (7, 4, 'สำลีแผ่น', 'ใช้สำหรับเช็ดหน้าผู้เข้ารับการรักษา');
INSERT INTO `medical_list` VALUES (8, 4, 'สำลีก้อน', 'ใช้สำหรับผู้เข้าการรับษา');
INSERT INTO `medical_list` VALUES (9, 4, 'ผงขมิ้น', 'ใช้สำหรับผู้เข้าการรับษา');
INSERT INTO `medical_list` VALUES (10, 2, 'แป้งเด็ก', 'ใช้สำหรับผู้เข้าการรับษา');
INSERT INTO `medical_list` VALUES (11, 2, 'Baby Oil 1', 'ใช้สำหรับผู้เข้าการรับษา');
INSERT INTO `medical_list` VALUES (12, 5, 'ครีมนวดเท้า', 'ใช้สำหรับนวดเท้าผู้เข้ารับการรักษา');
INSERT INTO `medical_list` VALUES (13, 6, 'แมสก์', 'ใช้สำหรับเจ้าหน้าที่นวด');
INSERT INTO `medical_list` VALUES (14, 2, 'แอลกอฮอล์(ชนิดน้ำ)', 'ใช้สำหรับทำความสะอาด');
INSERT INTO `medical_list` VALUES (15, 7, 'ผ้าขนหนูผืนเล็ก', 'ใช้สำหรับผู้เข้าการรับษา');
INSERT INTO `medical_list` VALUES (16, 7, 'ผ้าขนหนูผืนใหญ่', 'ใช้สำหรับผู้เข้าการรับษา');
INSERT INTO `medical_list` VALUES (17, 3, 'ปลอกหมอน', 'ใช้สำหรับเปลี่ยนกับปลอกหมอนที่ใช้งานแล้ว');
INSERT INTO `medical_list` VALUES (18, 3, 'ผ้าปูที่นอน', 'ใช้สำหรับเปลี่ยนกับผ้าปูที่นอนที่ใช้งานแล้ว');
INSERT INTO `medical_list` VALUES (19, 3, 'ผ้าขวาง(นวดตัว)', 'ใช้สำหรับนวดตัวผู้เข้าการรับษา');
INSERT INTO `medical_list` VALUES (20, 3, 'ผ้าขวาง(นวดหน้า)', 'ใช้สำหรับนวดหน้าผู้เข้าการรับษา');
INSERT INTO `medical_list` VALUES (21, 7, 'ผ้าห่ม', 'ใช้สำหรับผู้เข้าการรับษา');

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
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of officers
-- ----------------------------
INSERT INTO `officers` VALUES (1, 'admin@admin.admin', 'add63519531aa5dfed9432911559b492', 1, 'นายสายธาร', 'อ้นประเสริฐ', 'bd08660d279eeff4889c407e6d5470f4', '2021-02-10 22:42:07');
INSERT INTO `officers` VALUES (8, '678familyz@gmail.com', 'a6bee2d042a111261f3e4af3e95db5cd', 0, 'Natdanai ', 'Thannin', NULL, '2020-12-08 10:05:06');

-- ----------------------------
-- Table structure for outstock_herbal
-- ----------------------------
DROP TABLE IF EXISTS `outstock_herbal`;
CREATE TABLE `outstock_herbal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_data` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_data`(`id_data`) USING BTREE,
  CONSTRAINT `outstock_herbal_ibfk_1` FOREIGN KEY (`id_data`) REFERENCES `exported_herbal_intoout_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for partner_list
-- ----------------------------
DROP TABLE IF EXISTS `partner_list`;
CREATE TABLE `partner_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of partner_list
-- ----------------------------
INSERT INTO `partner_list` VALUES (1, 'อภัยภูเบศ');
INSERT INTO `partner_list` VALUES (2, 'ไม่รู้ชื่อ');
INSERT INTO `partner_list` VALUES (3, 'ไม่ทราบชื่อ');

-- ----------------------------
-- Table structure for type_herbal
-- ----------------------------
DROP TABLE IF EXISTS `type_herbal`;
CREATE TABLE `type_herbal`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of type_herbal
-- ----------------------------
INSERT INTO `type_herbal` VALUES (1, 'ยาใช้ภายใน');
INSERT INTO `type_herbal` VALUES (2, 'ยาใช้ภายนอก');

SET FOREIGN_KEY_CHECKS = 1;
