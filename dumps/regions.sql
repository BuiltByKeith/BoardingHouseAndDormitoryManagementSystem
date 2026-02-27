/*
 Navicat Premium Data Transfer

 Source Server         : Keith
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3306
 Source Schema         : boardinghousemgmtsystem

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 04/05/2024 17:21:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for regions
-- ----------------------------
DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `psgcCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `regDesc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `regCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of regions
-- ----------------------------
INSERT INTO `regions` VALUES (1, '010000000', 'REGION I (ILOCOS REGION)', '01');
INSERT INTO `regions` VALUES (2, '020000000', 'REGION II (CAGAYAN VALLEY)', '02');
INSERT INTO `regions` VALUES (3, '030000000', 'REGION III (CENTRAL LUZON)', '03');
INSERT INTO `regions` VALUES (4, '040000000', 'REGION IV-A (CALABARZON)', '04');
INSERT INTO `regions` VALUES (5, '170000000', 'REGION IV-B (MIMAROPA)', '17');
INSERT INTO `regions` VALUES (6, '050000000', 'REGION V (BICOL REGION)', '05');
INSERT INTO `regions` VALUES (7, '060000000', 'REGION VI (WESTERN VISAYAS)', '06');
INSERT INTO `regions` VALUES (8, '070000000', 'REGION VII (CENTRAL VISAYAS)', '07');
INSERT INTO `regions` VALUES (9, '080000000', 'REGION VIII (EASTERN VISAYAS)', '08');
INSERT INTO `regions` VALUES (10, '090000000', 'REGION IX (ZAMBOANGA PENINSULA)', '09');
INSERT INTO `regions` VALUES (11, '100000000', 'REGION X (NORTHERN MINDANAO)', '10');
INSERT INTO `regions` VALUES (12, '110000000', 'REGION XI (DAVAO REGION)', '11');
INSERT INTO `regions` VALUES (13, '120000000', 'REGION XII (SOCCSKSARGEN)', '12');
INSERT INTO `regions` VALUES (14, '130000000', 'NATIONAL CAPITAL REGION (NCR)', '13');
INSERT INTO `regions` VALUES (15, '140000000', 'CORDILLERA ADMINISTRATIVE REGION (CAR)', '14');
INSERT INTO `regions` VALUES (16, '150000000', 'AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)', '15');
INSERT INTO `regions` VALUES (17, '160000000', 'REGION XIII (Caraga)', '16');

SET FOREIGN_KEY_CHECKS = 1;
