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

 Date: 04/05/2024 17:23:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for student_tenants
-- ----------------------------
DROP TABLE IF EXISTS `student_tenants`;
CREATE TABLE `student_tenants`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `institutional_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sex` int NOT NULL,
  `guardian_id` bigint NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `permanent_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_tenants_program_id_foreign`(`program_id` ASC) USING BTREE,
  CONSTRAINT `student_tenants_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 86 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of student_tenants
-- ----------------------------
INSERT INTO `student_tenants` VALUES (1, '2020303027', 's.bado.nicoleanne@cmu.edu.ph', 'NICOLE ANNE', 'Z', 'BADO', '', 0, 1, 46, 'Daplin Highway', '9123456789', NULL, NULL);
INSERT INTO `student_tenants` VALUES (2, '2019302543', 's.bajao.nonette@cmu.edu.ph', 'NONETTE', 'D', 'BAJAO', '', 0, 2, 46, 'Cacacho Subdivision', '9123456789', NULL, NULL);
INSERT INTO `student_tenants` VALUES (3, '2020300477', 's.baysa.arniljhun@cmu.edu.ph', 'Arnil Jhun', 'L', 'Baysa', 'null', 1, 3, 46, 'Highway Road', '9123456789', NULL, '2024-05-03 17:04:49');
INSERT INTO `student_tenants` VALUES (4, '2020301348', 's.betanio.rynhart@cmu.edu.ph', 'RYNHART', 'T', 'BETANIO', '', 1, 4, 46, 'Unahan Lang', '9123456789', NULL, NULL);
INSERT INTO `student_tenants` VALUES (5, '2020300477', 's.demegillo.kervyclyde@cmu.edu.ph', 'KERVY CLYDE', 'B', 'DEMEGILLO', '', 1, 5, 46, 'Kanto', '9096743922', NULL, NULL);
INSERT INTO `student_tenants` VALUES (6, '2019301540', 's.duran.patrishacarenmae@cmu.edu.ph', 'PATRISHA CAREN MAE', 'G', 'DURAN', '', 0, 6, 46, 'Crossing', '9091234567', NULL, NULL);
INSERT INTO `student_tenants` VALUES (7, '2020301317', 's.durotan.mark@cmu.edu.ph', 'MARK', 'D', 'DUROTAN', '', 1, 7, 46, 'Daplin Highway', '9089509303', NULL, NULL);
INSERT INTO `student_tenants` VALUES (8, '2020303468', 's.hermo.frenchmike@cmu.edu.ph', 'FRENCH MIKE', 'Z', 'HERMO', '', 1, 8, 46, 'Fatima West Plains Subdivision', '9082616454', NULL, NULL);
INSERT INTO `student_tenants` VALUES (9, '2020303519', 's.japitana.royceyvanvir@cmu.edu.ph', 'ROYCE YVAN VIR', 'B', 'JAPITANA', '', 1, 9, 46, 'Daplin Highway', '9075723605', NULL, NULL);
INSERT INTO `student_tenants` VALUES (10, '2019303907', 's.jumawid.aidanace@cmu.edu.ph', 'AIDAN ACE', 'R', 'JUMAWID', '', 1, 10, 46, 'Cacacho Subdivision', '9068830756', NULL, NULL);
INSERT INTO `student_tenants` VALUES (11, '2020301540', 's.lastra.jovan@cmu.edu.ph', 'JOVAN', 'T', 'LASTRA', '', 1, 11, 46, 'Highway Road', '9061937908', NULL, NULL);
INSERT INTO `student_tenants` VALUES (12, '2020301078', 's.ledesma.crystal@cmu.edu.ph', 'CRYSTAL', 'G', 'LEDESMA', '', 0, 12, 46, 'Unahan Lang', '9055045059', NULL, NULL);
INSERT INTO `student_tenants` VALUES (13, '2020302505', 's.lesamos.leonardo@cmu.edu.ph', 'LEONARDO', 'D', 'LESAMOS', 'JR.', 1, 13, 46, 'Kanto', '9048152210', NULL, NULL);
INSERT INTO `student_tenants` VALUES (14, '2020301225', 's.mante.johndeere@cmu.edu.ph', 'JOHN DEERE', 'P', 'MANTE', '', 1, 14, 46, 'Crossing', '9041259361', NULL, NULL);
INSERT INTO `student_tenants` VALUES (15, '2020302401', 's.ortencio.aprileunice@cmu.edu.ph', 'APRIL EUNICE', 'D', 'ORTENCIO', '', 0, 15, 46, 'Daplin Highway', '9034366512', NULL, NULL);
INSERT INTO `student_tenants` VALUES (16, '2019300789', 's.pamotongan.jeamay@cmu.edu.ph', 'JEA MAY', 'S', 'PAMOTONGAN', '', 0, 16, 46, 'Fatima West Plains Subdivision', '9027473663', NULL, NULL);
INSERT INTO `student_tenants` VALUES (17, '2020301544', 's.rebandulla.ivandave@cmu.edu.ph', 'IVAN DAVE', 'S', 'REBANDULLA', '', 1, 17, 46, 'Daplin Highway', '9020580814', NULL, NULL);
INSERT INTO `student_tenants` VALUES (18, '2020300919', 's.rivera.brian@cmu.edu.ph', 'BRIAN', 'G', 'RIVERA', '', 1, 18, 46, 'Cacacho Subdivision', '9013687965', NULL, NULL);
INSERT INTO `student_tenants` VALUES (19, '2019303702', 's.santa cruz.johnpaul@cmu.edu.ph', 'JOHN PAUL', 'B', 'SANTA CRUZ', '', 1, 19, 46, 'Highway Road', '9006795116', NULL, NULL);
INSERT INTO `student_tenants` VALUES (20, '2020300371', 's.simbajon.vincereynard@cmu.edu.ph', 'VINCE REYNARD', 'D', 'SIMBAJON', '', 1, 20, 46, 'Unahan Lang', '8999902268', NULL, NULL);
INSERT INTO `student_tenants` VALUES (21, '2020303741', 's.soriano.charlzjerone@cmu.edu.ph', 'CHARLZ JERONE', 'G', 'SORIANO', '', 1, 21, 46, 'Kanto', '8993009419', NULL, NULL);
INSERT INTO `student_tenants` VALUES (22, '2020300228', 's.tejano.ryan@cmu.edu.ph', 'RYAN', 'A', 'TEJANO', '', 1, 22, 46, 'Crossing', '8986116570', NULL, NULL);
INSERT INTO `student_tenants` VALUES (23, '2020302638', 's.trases.irisjoy@cmu.edu.ph', 'IRIS JOY', 'J', 'TRASES', '', 0, 23, 46, 'Daplin Highway', '8979223721', NULL, NULL);
INSERT INTO `student_tenants` VALUES (24, '2020300228', 's.valdez.nonerdave@cmu.edu.ph', 'NONER DAVE', 'F', 'VALDEZ', '', 1, 24, 46, 'Cacacho Subdivision', '8972330872', NULL, NULL);
INSERT INTO `student_tenants` VALUES (25, '2019301016', 's.acero.marclawrence@cmu.edu.ph', 'MARC LAWRENCE ', 'B', 'ACERO', '', 1, 25, 46, 'Highway Road', '8965438023', NULL, NULL);
INSERT INTO `student_tenants` VALUES (26, '2020303474', 's.bacon.ruthlouise@cmu.edu.ph', 'RUTH LOUISE ', 'N', 'BACON', '', 0, 26, 46, 'Unahan Lang', '8958545174', NULL, NULL);
INSERT INTO `student_tenants` VALUES (27, '2020302119', 's.baluran.jamesalfred@cmu.edu.ph', 'JAMES ALFRED', '', 'BALURAN', '', 1, 27, 46, 'Daplin Highway', '8951652325', NULL, NULL);
INSERT INTO `student_tenants` VALUES (28, '2020303923', 's.behing.francis@cmu.edu.ph', 'FRANCIS', '', 'BEHING', '', 1, 28, 46, 'Cacacho Subdivision', '8944759476', NULL, NULL);
INSERT INTO `student_tenants` VALUES (29, '2020303667', 's.cabahit.elezahmay@cmu.edu.ph', 'ELEZAH MAY ', 'S', 'CABAHIT', '', 0, 29, 46, 'Highway Road', '8937866628', NULL, NULL);
INSERT INTO `student_tenants` VALUES (30, '2020301910', 's.camello.jelvszemmanuel@cmu.edu.ph', 'JELVSZ EMMANUEL', '', 'CAMELLO', '', 1, 30, 46, 'Unahan Lang', '8930973779', NULL, NULL);
INSERT INTO `student_tenants` VALUES (31, '2020302141', 's.cellan.verliefeagrace@cmu.edu.ph', 'VERLIE FEA GRACE ', 'P', 'CELLAN', '', 0, 31, 46, 'Kanto', '8924080930', NULL, NULL);
INSERT INTO `student_tenants` VALUES (32, '2020300949', 's.dinopol.dashiel@cmu.edu.ph', 'DASHIEL ', 'Q', 'DINOPOL', '', 1, 32, 46, 'Crossing', '8917188081', NULL, NULL);
INSERT INTO `student_tenants` VALUES (33, '2020300440', 's.dormal.jessamae@cmu.edu.ph', 'JESSA MAE', 'M', 'DORMAL', '', 0, 33, 46, 'Daplin Highway', '8910295232', NULL, NULL);
INSERT INTO `student_tenants` VALUES (34, '2020302355', 's.estabas.gilmark@cmu.edu.ph', 'GILMARK ', 'C', 'ESTABAS', '', 1, 34, 46, 'Cacacho Subdivision', '8903402383', NULL, NULL);
INSERT INTO `student_tenants` VALUES (35, '2020300793', 's.gomonit.ma.danicaluz@cmu.edu.ph', 'MA. DANICA LUZ', 'J', 'GOMONIT', '', 0, 35, 46, 'Highway Road', '8896509534', NULL, NULL);
INSERT INTO `student_tenants` VALUES (36, '2020302932', 's.gulayao.jegg@cmu.edu.ph', 'JEGG ', 'B', 'GULAYAO', '', 1, 36, 46, 'Unahan Lang', '8889616685', NULL, NULL);
INSERT INTO `student_tenants` VALUES (37, '2020300607', 's.lazanas.christianeleazar@cmu.edu.ph', 'CHRISTIAN ELEAZAR', 'C', 'LAZANAS', '', 1, 37, 46, 'Daplin Highway', '8882723836', NULL, NULL);
INSERT INTO `student_tenants` VALUES (38, '2020301367', 's.lomongo.danlloyd@cmu.edu.ph', 'DAN LLOYD', '', 'LOMONGO', '', 1, 38, 46, 'Cacacho Subdivision', '8875830988', NULL, NULL);
INSERT INTO `student_tenants` VALUES (39, '2020300676', 's.malinab.aeroncloyd@cmu.edu.ph', 'AERON CLOYD ', 'C', 'MALINAB', '', 1, 39, 46, 'Highway Road', '8868938139', NULL, NULL);
INSERT INTO `student_tenants` VALUES (40, '2020302354', 's.maximo.rommelkent@cmu.edu.ph', 'ROMMEL KENT ', 'G', 'MAXIMO', '', 1, 40, 46, 'Unahan Lang', '8862045290', NULL, NULL);
INSERT INTO `student_tenants` VALUES (41, '2020302078', 's.montalla.alyannakristinajen@cmu.edu.ph', 'ALYANNA KRISTINA JEN ', 'F', 'MONTALLA', '', 0, 41, 46, 'Kanto', '8855152441', NULL, NULL);
INSERT INTO `student_tenants` VALUES (42, '2020302626', 's.omalde.gabrielcjay@cmu.edu.ph', 'GABRIEL CJAY ', 'R', 'OMALDE', '', 1, 42, 46, 'Crossing', '8848259592', NULL, NULL);
INSERT INTO `student_tenants` VALUES (43, '2020300261', 's.ondoy.ivantfred@cmu.edu.ph', 'IVANT FRED ', 'T', 'ONDOY', '', 1, 43, 46, 'Daplin Highway', '8841366743', NULL, NULL);
INSERT INTO `student_tenants` VALUES (44, '2020301061', 's.saballa.myrrhdaphne@cmu.edu.ph', 'MYRRH DAPHNE ', 'G', 'SABALLA', '', 0, 44, 46, 'Cacacho Subdivision', '8834473894', NULL, NULL);
INSERT INTO `student_tenants` VALUES (45, '2020302269', 's.aradillos.allenkeith@cmu.edu.ph', 'ALLEN KEITH ', 'A', 'ARADILLOS', '', 1, 45, 46, 'Highway Road', '8827581045', NULL, NULL);
INSERT INTO `student_tenants` VALUES (46, '2020300836', 's.bahay.queen@cmu.edu.ph', 'QUEEN ', 'R', 'BAHAY', '', 0, 46, 46, 'Unahan Lang', '8820688197', NULL, NULL);
INSERT INTO `student_tenants` VALUES (47, '2020302065', 's.balinas.vhinzjohn@cmu.edu.ph', 'VHINZ JOHN ', 'H', 'BALINAS', '', 1, 47, 46, 'Daplin Highway', '8813795348', NULL, NULL);
INSERT INTO `student_tenants` VALUES (48, '2019301451', 's.battung.anthonymarkduane@cmu.edu.ph', 'ANTHONY MARK DUANE ', 'R', 'BATTUNG', '', 1, 48, 46, 'Cacacho Subdivision', '8806902499', NULL, NULL);
INSERT INTO `student_tenants` VALUES (49, '2020301243', 's.bayarcal.ian@cmu.edu.ph', 'IAN ', 'S', 'BAYARCAL', '', 1, 49, 46, 'Highway Road', '8800009650', NULL, NULL);
INSERT INTO `student_tenants` VALUES (50, '2020301143', 's.bermejo.kein@cmu.edu.ph', 'KEIN ', 'T', 'BERMEJO', '', 1, 50, 46, 'Unahan Lang', '8793116801', NULL, NULL);
INSERT INTO `student_tenants` VALUES (51, '2019301022', 's.betalac.joylynjane@cmu.edu.ph', 'JOYLYN JANE ', 'G', 'BETALAC', '', 0, 51, 46, 'Kanto', '8786223952', NULL, NULL);
INSERT INTO `student_tenants` VALUES (52, '2020303757', 's.blancia.kurtbernstein@cmu.edu.ph', 'KURT BERNSTEIN ', 'P', 'BLANCIA', '', 1, 52, 46, 'Crossing', '8779331103', NULL, NULL);
INSERT INTO `student_tenants` VALUES (53, '2020302806', 's.buison.danicagrace@cmu.edu.ph', 'DANICA GRACE ', 'Y', 'BUISON', '', 1, 53, 46, 'Daplin Highway', '8772438254', NULL, NULL);
INSERT INTO `student_tenants` VALUES (54, '2020300939', 's.cabanilla.shannahandrea@cmu.edu.ph', 'SHANNAH ANDREA ', 'M', 'CABANILLA', '', 1, 54, 46, 'Cacacho Subdivision', '8765545405', NULL, NULL);
INSERT INTO `student_tenants` VALUES (55, '2019302267', 's.casa.princegenesis@cmu.edu.ph', 'PRINCE GENESIS', 'G', 'CASA', '', 0, 55, 46, 'Highway Road', '8758652557', NULL, NULL);
INSERT INTO `student_tenants` VALUES (56, '2020301210', 's.catague.johnpaul@cmu.edu.ph', 'JOHN PAUL ', 'S', 'CATAGUE', '', 1, 56, 46, 'Unahan Lang', '8751759708', NULL, NULL);
INSERT INTO `student_tenants` VALUES (57, '2020303388', 's.digal.denmarkniño@cmu.edu.ph', 'DENMARK NIÑO ', 'B', 'DIGAL', '', 1, 57, 46, 'Daplin Highway', '8744866859', NULL, NULL);
INSERT INTO `student_tenants` VALUES (58, '2020302261', 's.directo.phoebegrace@cmu.edu.ph', 'PHOEBE GRACE ', 'M', 'DIRECTO', '', 0, 58, 46, 'Cacacho Subdivision', '8737974010', NULL, NULL);
INSERT INTO `student_tenants` VALUES (59, '2019301640', 's.gamao.avessamae@cmu.edu.ph', 'AVESSA MAE ', 'B', 'GAMAO', '', 0, 59, 46, 'Highway Road', '8731081161', NULL, NULL);
INSERT INTO `student_tenants` VALUES (60, '2019300689', 's.garcia.azarel@cmu.edu.ph', 'AZAREL', 'B', 'GARCIA', '', 1, 60, 46, 'Unahan Lang', '8724188312', NULL, NULL);
INSERT INTO `student_tenants` VALUES (61, '2020303726', 's.garcia.robinson@cmu.edu.ph', 'ROBINSON ', 'O', 'GARCIA', '', 1, 61, 46, 'Kanto', '8717295463', NULL, NULL);
INSERT INTO `student_tenants` VALUES (62, '2020304229', 's.gonzales.asherjeff@cmu.edu.ph', 'ASHER JEFF ', 'B', 'GONZALES', '', 1, 62, 46, 'Crossing', '8710402614', NULL, NULL);
INSERT INTO `student_tenants` VALUES (63, '2019303851', 's.hebia.joedavince@cmu.edu.ph', 'JOE DAVINCE ', 'E', 'HEBIA', '', 1, 63, 46, 'Daplin Highway', '8703509765', NULL, NULL);
INSERT INTO `student_tenants` VALUES (64, '2020301837', 's.hontanosas.fritzeibelle@cmu.edu.ph', 'FRITZEIBELLE ', 'S', 'HONTANOSAS', '', 0, 64, 46, 'Cacacho Subdivision', '8696616917', NULL, NULL);
INSERT INTO `student_tenants` VALUES (65, '2020300832', 's.japson.johnjay@cmu.edu.ph', 'JOHN JAY', 'P', 'JAPSON', '', 1, 65, 46, 'Highway Road', '8689724068', NULL, NULL);
INSERT INTO `student_tenants` VALUES (66, '2020302087', 's.labadan.kier@cmu.edu.ph', 'KIER', 'A', 'LABADAN', '', 1, 66, 46, 'Unahan Lang', '8682831219', NULL, NULL);
INSERT INTO `student_tenants` VALUES (67, '2020302110', 's.maquipoten.catherine@cmu.edu.ph', 'CATHERINE', 'V', 'MAQUIPOTEN', '', 0, 67, 46, 'Daplin Highway', '8675938370', NULL, NULL);
INSERT INTO `student_tenants` VALUES (68, '2020301634', 's.monicit.alyannaclaire@cmu.edu.ph', 'ALYANNA CLAIRE', 'KAAMIÑO', 'MONICIT', '', 0, 68, 46, 'Cacacho Subdivision', '8669045521', NULL, NULL);
INSERT INTO `student_tenants` VALUES (69, '2020302000', 's.millado.glemerlloyd@cmu.edu.ph', 'GLEMER LLOYD ', 'N', 'MILLADO', '', 1, 69, 46, 'Highway Road', '8662152672', NULL, NULL);
INSERT INTO `student_tenants` VALUES (70, '2020303256', 's.nacional.ianjames@cmu.edu.ph', 'IAN JAMES ', 'S', 'NACIONAL', '', 1, 70, 46, 'Unahan Lang', '8655259823', NULL, NULL);
INSERT INTO `student_tenants` VALUES (71, '2019302186', 's.ocaña.louiecesar@cmu.edu.ph', 'LOUIE CESAR ', 'G', 'OCAÑA', '', 1, 71, 46, 'Kanto', '8648366974', NULL, NULL);
INSERT INTO `student_tenants` VALUES (72, '2020300936', 's.ocoy.junellefrancis@cmu.edu.ph', 'JUNELLE FRANCIS ', 'O', 'OCOY', '', 1, 72, 46, 'Crossing', '8641474125', NULL, NULL);
INSERT INTO `student_tenants` VALUES (73, '2019302215', 's.orale.thresialynjean@cmu.edu.ph', 'THRESIA LYN JEAN ', 'R', 'ORALE', '', 0, 73, 46, 'Daplin Highway', '8634581277', NULL, NULL);
INSERT INTO `student_tenants` VALUES (74, '2020301072', 's.pamisa.jerricho@cmu.edu.ph', 'JERRICHO', 'B', 'PAMISA', '', 1, 74, 46, 'Cacacho Subdivision', '8627688428', NULL, NULL);
INSERT INTO `student_tenants` VALUES (75, '2018300993', 's.paulite.james@cmu.edu.ph', 'JAMES ', 'B', 'PAULITE', '', 1, 75, 46, 'Highway Road', '8620795579', NULL, NULL);
INSERT INTO `student_tenants` VALUES (76, '2020303521', 's.perez.ramylljiro@cmu.edu.ph', 'RAMYLL JIRO ', 'D', 'PEREZ', '', 1, 76, 46, 'Unahan Lang', '8613902730', NULL, NULL);
INSERT INTO `student_tenants` VALUES (77, '2020301384', 's.quilaton.johnlyndon@cmu.edu.ph', 'JOHN LYNDON ', 'O', 'QUILATON', '', 1, 77, 46, 'Daplin Highway', '8607009881', NULL, NULL);
INSERT INTO `student_tenants` VALUES (78, '2020300620', 's.quintero.alphalyn@cmu.edu.ph', 'ALPHALYN ', 'P', 'QUINTERO', '', 0, 78, 46, 'Cacacho Subdivision', '8600117032', NULL, NULL);
INSERT INTO `student_tenants` VALUES (79, '2020301181', 's.rasonabe.apriledriane@cmu.edu.ph', 'APRIL EDRIANE ', 'L', 'RASONABE', '', 1, 79, 46, 'Highway Road', '8593224183', NULL, NULL);
INSERT INTO `student_tenants` VALUES (80, '2020301704', 's.sabanpan.chrisjun@cmu.edu.ph', 'CHRISJUN', 'P', 'SABANPAN', 'null', 1, 80, 46, 'Unahan Lang', '8586331334', NULL, '2024-05-04 10:57:45');
INSERT INTO `student_tenants` VALUES (81, '2019301653', 's.santosidad.raymund@cmu.edu.ph', 'RAYMUND ', 'B', 'SANTOSIDAD', '', 1, 81, 46, 'Kanto', '8579438486', NULL, NULL);
INSERT INTO `student_tenants` VALUES (82, '2020301814', 's.taladro.frankray@cmu.edu.ph', 'FRANK RAY ', 'P', 'TALADRO', '', 1, 82, 46, 'Crossing', '8572545637', NULL, NULL);
INSERT INTO `student_tenants` VALUES (83, '2020301802', 's.teves.ailamae@cmu.edu.ph', 'AILA MAE ', 'C', 'TEVES', '', 0, 83, 46, 'Daplin Highway', '8565652788', NULL, NULL);
INSERT INTO `student_tenants` VALUES (84, '2019303984', 's.villela.mattandrey@cmu.edu.ph', 'MATT ANDREY ', 'S', 'VILLELA', '', 1, 84, 46, 'Cacacho Subdivision', '8558759939', NULL, NULL);
INSERT INTO `student_tenants` VALUES (85, '2020302121', 's.yap.viamae@cmu.edu.ph', 'VIA MAE ', 'C', 'YAP', '', 0, 85, 46, 'Highway Road', '8551867090', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
