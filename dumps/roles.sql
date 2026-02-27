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

 Date: 04/05/2024 17:22:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 'Admin', NULL, NULL);
INSERT INTO `roles` VALUES (2, 'operator', 'Operator', NULL, NULL);
INSERT INTO `roles` VALUES (3, 'dorm_manager', 'Dorm Manager', NULL, NULL);
INSERT INTO `roles` VALUES (4, 'uhrc', 'UHRC', NULL, NULL);
INSERT INTO `roles` VALUES (5, 'osa', 'OSA', NULL, NULL);
INSERT INTO `roles` VALUES (6, 'assoc', 'Assoc', NULL, NULL);
INSERT INTO `roles` VALUES (7, 'employee', 'Employee', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
