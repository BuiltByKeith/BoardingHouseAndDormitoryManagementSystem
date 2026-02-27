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

 Date: 04/05/2024 17:21:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for colleges
-- ----------------------------
DROP TABLE IF EXISTS `colleges`;
CREATE TABLE `colleges`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `college_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of colleges
-- ----------------------------
INSERT INTO `colleges` VALUES (1, 'College of Agriculture', NULL, NULL);
INSERT INTO `colleges` VALUES (2, 'College of Arts and Sciences', NULL, NULL);
INSERT INTO `colleges` VALUES (3, 'College of Business and Management', NULL, NULL);
INSERT INTO `colleges` VALUES (4, 'College of Education', NULL, NULL);
INSERT INTO `colleges` VALUES (5, 'College of Engineering', NULL, NULL);
INSERT INTO `colleges` VALUES (6, 'College of Forestry and Environmental Science', NULL, NULL);
INSERT INTO `colleges` VALUES (7, 'College of Human Ecology', NULL, NULL);
INSERT INTO `colleges` VALUES (8, 'College of Information Sciences and Computing', NULL, NULL);
INSERT INTO `colleges` VALUES (9, 'College of Nursing', NULL, NULL);
INSERT INTO `colleges` VALUES (10, 'College of Veterinary Medicine', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
