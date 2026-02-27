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

 Date: 04/05/2024 17:20:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ay_semesters
-- ----------------------------
DROP TABLE IF EXISTS `ay_semesters`;
CREATE TABLE `ay_semesters`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `acad_year_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ay_semesters_ay_semester_id_foreign`(`acad_year_id` ASC) USING BTREE,
  CONSTRAINT `ay_semesters_ay_semester_id_foreign` FOREIGN KEY (`acad_year_id`) REFERENCES `acad_years` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ay_semesters
-- ----------------------------
INSERT INTO `ay_semesters` VALUES (1, '1st Semester', 1, '2023-08-14 17:58:51', '2023-08-14 17:58:51');
INSERT INTO `ay_semesters` VALUES (2, '2nd Semester', 1, '2024-01-08 17:59:08', '2024-01-08 17:59:08');

SET FOREIGN_KEY_CHECKS = 1;
