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

 Date: 04/05/2024 17:21:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for programs
-- ----------------------------
DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `college_id` int NOT NULL,
  `program_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of programs
-- ----------------------------
INSERT INTO `programs` VALUES (1, 1, 'BS Agriculture Major in AgriBio Sciences', NULL, NULL);
INSERT INTO `programs` VALUES (2, 1, 'BS Agriculture Major in Agricultural Economics', NULL, NULL);
INSERT INTO `programs` VALUES (3, 1, 'BS Agriculture Major in Agricultural Extension', NULL, NULL);
INSERT INTO `programs` VALUES (4, 1, 'BS Agriculture Major in Animal Science', NULL, NULL);
INSERT INTO `programs` VALUES (5, 1, 'BS Agriculture Major in Soil Science', NULL, NULL);
INSERT INTO `programs` VALUES (6, 1, 'BS Agriculture Major in Crop Protection', NULL, NULL);
INSERT INTO `programs` VALUES (7, 1, 'BS Agriculture Major in Crop Science', NULL, NULL);
INSERT INTO `programs` VALUES (9, 1, 'BS Agribusiness Management', NULL, NULL);
INSERT INTO `programs` VALUES (10, 1, 'BS Development Communication', NULL, NULL);
INSERT INTO `programs` VALUES (11, 2, 'BA English and Language Studies', NULL, NULL);
INSERT INTO `programs` VALUES (12, 2, 'BA History', NULL, NULL);
INSERT INTO `programs` VALUES (13, 2, 'BA Political Science', NULL, NULL);
INSERT INTO `programs` VALUES (14, 2, 'BS Psychology', NULL, NULL);
INSERT INTO `programs` VALUES (15, 2, 'BA Sociology', NULL, NULL);
INSERT INTO `programs` VALUES (16, 2, 'BS Biology', NULL, NULL);
INSERT INTO `programs` VALUES (17, 2, 'BS Chemistry', NULL, NULL);
INSERT INTO `programs` VALUES (18, 2, 'BS Mathematics', NULL, NULL);
INSERT INTO `programs` VALUES (19, 2, 'BS Physics', NULL, NULL);
INSERT INTO `programs` VALUES (20, 3, 'BS Accountancy', NULL, NULL);
INSERT INTO `programs` VALUES (21, 3, 'BS Accounting Information System', NULL, NULL);
INSERT INTO `programs` VALUES (22, 3, 'BS Internal Auditing', NULL, NULL);
INSERT INTO `programs` VALUES (23, 3, 'BS Management Accounting', NULL, NULL);
INSERT INTO `programs` VALUES (27, 3, 'BS Office Administration', NULL, NULL);
INSERT INTO `programs` VALUES (28, 3, 'BS Business Administration Major in Marketing Management', NULL, NULL);
INSERT INTO `programs` VALUES (29, 3, 'BS Business Administration Major in Financial Management', NULL, NULL);
INSERT INTO `programs` VALUES (30, 3, 'BS Business Administration Major in Operations Management', NULL, NULL);
INSERT INTO `programs` VALUES (31, 4, 'Bachelor of Physical Education', NULL, NULL);
INSERT INTO `programs` VALUES (32, 4, 'BSEd English', NULL, NULL);
INSERT INTO `programs` VALUES (33, 4, 'BSEd Filipino', NULL, NULL);
INSERT INTO `programs` VALUES (34, 4, 'BSEd Sciences', NULL, NULL);
INSERT INTO `programs` VALUES (35, 4, 'BSEd Mathematics', NULL, NULL);
INSERT INTO `programs` VALUES (36, 5, 'BS Agriculture and Biosystems Engineering', NULL, NULL);
INSERT INTO `programs` VALUES (37, 5, 'BS Electrical Engineering', NULL, NULL);
INSERT INTO `programs` VALUES (38, 5, 'BS Civil Engineering', NULL, NULL);
INSERT INTO `programs` VALUES (39, 5, 'BS Mechanical Engineering', NULL, NULL);
INSERT INTO `programs` VALUES (40, 6, 'BS Environmental Science', NULL, NULL);
INSERT INTO `programs` VALUES (41, 6, 'BS Forestry', NULL, NULL);
INSERT INTO `programs` VALUES (42, 7, 'BS Home Economics', NULL, NULL);
INSERT INTO `programs` VALUES (43, 7, 'BS Food Technology', NULL, NULL);
INSERT INTO `programs` VALUES (44, 7, 'BS Nutrition and Dietetics', NULL, NULL);
INSERT INTO `programs` VALUES (45, 7, 'BS Hospitality Management', NULL, NULL);
INSERT INTO `programs` VALUES (46, 8, 'BS Information Technology', NULL, NULL);
INSERT INTO `programs` VALUES (47, 9, 'BS Nursing', NULL, NULL);
INSERT INTO `programs` VALUES (48, 10, 'Doctor of Veterinary Medicine', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
