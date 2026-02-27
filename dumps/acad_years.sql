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

 Date: 04/05/2024 17:20:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for acad_years
-- ----------------------------
DROP TABLE IF EXISTS `acad_years`;
CREATE TABLE `acad_years`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of acad_years
-- ----------------------------
INSERT INTO `acad_years` VALUES (1, '2023-2024', '2023-08-14 17:58:34', '2023-08-14 17:58:34');

SET FOREIGN_KEY_CHECKS = 1;
