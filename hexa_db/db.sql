/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 100411
Source Host           : localhost:3306
Source Database       : hexasuite_db

Target Server Type    : MYSQL
Target Server Version : 100411
File Encoding         : 65001

Date: 2021-05-26 10:45:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for address_list
-- ----------------------------
DROP TABLE IF EXISTS `address_list`;
CREATE TABLE `address_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT '',
  `city_municipality` varchar(255) DEFAULT '',
  `province` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of address_list
-- ----------------------------
INSERT INTO `address_list` VALUES ('1', 'c1921889-c4cd-46b1-918b-b79b4f2b6666', 'Barangay 1', 'MANILA', 'METRO MANILA', 'NCR - National Capital Region', 'Philippines', '1000', '2020-07-27 14:17:05', '2020-09-16 09:19:36', null);
INSERT INTO `address_list` VALUES ('2', '40b50570-06d6-4658-9334-3c51fd8b577f', 'Barangay 2', 'MANILA', 'METRO MANILA', 'NCR - National Capital Region', 'Philippines', '1000', '2020-07-27 14:20:31', '2020-09-16 09:19:47', null);
INSERT INTO `address_list` VALUES ('4', '69bc1dba-d005-469c-9853-6e69eecbcb74', 'Agusan', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '1000', '2020-08-09 05:43:25', '2020-09-16 09:19:55', null);
INSERT INTO `address_list` VALUES ('5', '84b20a2d-4575-49d2-a33d-3b7f95d7bfb9', 'Camuayan', 'BALINGASAG', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9005', '2020-08-09 05:44:17', '2020-08-09 05:44:17', null);
INSERT INTO `address_list` VALUES ('6', 'a658e426-eb41-41bd-bf38-5c5cc0e63c54', 'Baikingon', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:48:22', '2020-09-16 08:48:22', null);
INSERT INTO `address_list` VALUES ('7', '10560cb7-0f74-4b7e-b6cc-ec6045a9ef3a', 'Bulua', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:48:51', '2020-09-16 08:48:51', null);
INSERT INTO `address_list` VALUES ('8', 'd9307b55-58a3-452b-bea4-f6bb6090c1ab', 'Balubal', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:49:16', '2020-09-16 08:49:16', null);
INSERT INTO `address_list` VALUES ('9', '5d703211-0499-497a-8cc9-93b392f968ec', 'Balulang', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:49:42', '2020-09-16 08:49:42', null);
INSERT INTO `address_list` VALUES ('10', '3cb15a43-2835-4ce8-9434-2d62b422cd4f', 'Barangay 10 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:50:10', '2020-09-16 08:50:10', null);
INSERT INTO `address_list` VALUES ('11', '662b18d4-1c97-41cd-a8fa-c07c30985e64', 'Barangay 11 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:50:33', '2020-09-16 08:50:33', null);
INSERT INTO `address_list` VALUES ('12', 'cb1d7073-7b12-4ba7-92c6-9fd4b3b6826e', 'Barangay 12 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:51:39', '2020-09-16 08:51:39', null);
INSERT INTO `address_list` VALUES ('13', '023b9281-fce3-4fa5-acba-ae99a500bdf0', 'Barangay 13 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:52:03', '2020-09-16 08:52:03', null);
INSERT INTO `address_list` VALUES ('14', '1035813d-c252-40a8-a8ed-cefe46da30fd', 'Barangay 14 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:52:23', '2020-09-16 08:52:23', null);
INSERT INTO `address_list` VALUES ('15', '50c56435-3add-41ef-9525-ff63595934d3', 'Barangay 15 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:52:44', '2020-09-16 08:52:44', null);
INSERT INTO `address_list` VALUES ('16', 'bc98dbf2-fa73-4680-8c6c-abe485077e65', 'Barangay 16 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:53:16', '2020-09-16 08:53:16', null);
INSERT INTO `address_list` VALUES ('17', '57732d8e-2760-4cab-970e-826862159d12', 'Barangay 17 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:53:43', '2020-09-16 08:53:43', null);
INSERT INTO `address_list` VALUES ('18', 'f01aa77e-d9cc-40d8-a65e-df9569a9e141', 'Barangay 18 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:54:09', '2020-09-16 08:54:09', null);
INSERT INTO `address_list` VALUES ('19', 'c5e6fb92-f48e-4f86-93ee-e414d71107f6', 'Barangay 19 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:54:36', '2020-09-16 08:54:36', null);
INSERT INTO `address_list` VALUES ('20', 'e0939c4c-e198-47fd-9bb7-3bd02316fb14', 'Barangay 2 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:54:59', '2020-09-16 08:54:59', null);
INSERT INTO `address_list` VALUES ('21', '74f30ea6-302a-42ac-9a7d-d61d640a15e5', 'Barangay 21 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:55:24', '2020-09-16 08:55:24', null);
INSERT INTO `address_list` VALUES ('22', '468109cd-77e9-41b1-96e2-e40a7390c047', 'Barangay 22 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:55:47', '2020-09-16 08:55:47', null);
INSERT INTO `address_list` VALUES ('23', '329423be-762a-4da2-8db9-667802934db2', 'Barangay 23 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:56:12', '2020-09-16 08:56:12', null);
INSERT INTO `address_list` VALUES ('24', '4ab5f1f1-fc49-4738-a864-c498b06b52e9', 'Barangay 24 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:56:34', '2020-09-16 08:56:34', null);
INSERT INTO `address_list` VALUES ('25', '369ff62a-eff1-4f3c-92c8-c858284096c3', 'Barangay 26 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:56:58', '2020-09-16 08:56:58', null);
INSERT INTO `address_list` VALUES ('26', 'bf6639f6-db92-4c19-b665-b467060ac715', 'Barangay 27 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:57:44', '2020-09-16 08:57:44', null);
INSERT INTO `address_list` VALUES ('27', 'ee5b0876-1467-4f6a-837a-35b22c482624', 'Barangay 28 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:58:04', '2020-09-16 08:58:04', null);
INSERT INTO `address_list` VALUES ('28', 'c992c741-56e3-418d-960c-a1e2719a91a9', 'Barangay 3 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:58:32', '2020-09-16 08:58:32', null);
INSERT INTO `address_list` VALUES ('29', '1b6f05a4-06ca-4291-b68c-e7c1fa4af09e', 'Barangay 30 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:59:20', '2020-09-16 08:59:20', null);
INSERT INTO `address_list` VALUES ('30', 'e3456018-0608-401f-8161-eb7715c7650a', 'Barangay 32 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 08:59:41', '2020-09-16 08:59:41', null);
INSERT INTO `address_list` VALUES ('31', '96208b99-2556-4807-8c4a-904c184e3738', 'Barangay 33 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:00:00', '2020-09-16 09:00:00', null);
INSERT INTO `address_list` VALUES ('32', '4d3f5b54-bafd-4ba0-b5f8-ba5275fc414c', 'Barangay 34 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:00:43', '2020-09-16 09:00:43', null);
INSERT INTO `address_list` VALUES ('33', '980c1cc2-378e-495b-90f8-8fb3e7e3e557', 'Barangay 38 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:01:09', '2020-09-16 09:01:09', null);
INSERT INTO `address_list` VALUES ('34', '2be3d8ce-3275-4076-ad37-02063813cdae', 'Barangay 39 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:01:29', '2020-09-16 09:01:29', null);
INSERT INTO `address_list` VALUES ('35', '6e2a607f-d1d6-471b-a539-099fa0c6a99e', 'Barangay 4 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:02:01', '2020-09-16 09:02:01', null);
INSERT INTO `address_list` VALUES ('36', 'b29faf74-3872-4ec1-9343-d1a012645d8a', 'Barangay 40 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:02:23', '2020-09-16 09:02:23', null);
INSERT INTO `address_list` VALUES ('37', '490f9f0b-a3a2-4b03-82ad-e596493fcdaa', 'Barangay 6 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:02:43', '2020-09-16 09:02:43', null);
INSERT INTO `address_list` VALUES ('38', '5b1b33bf-89c9-4b3b-929a-b406b39ce048', 'Barangay 8 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:03:22', '2020-09-16 09:03:22', null);
INSERT INTO `address_list` VALUES ('39', 'eaf3d504-f4e8-4b88-8263-bf6a51a5a882', 'Barangay 9 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:03:46', '2020-09-16 09:03:46', null);
INSERT INTO `address_list` VALUES ('40', '0a150295-600e-4999-ab49-7e300c87c064', 'Barangay 5 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:04:08', '2020-09-16 09:04:08', null);
INSERT INTO `address_list` VALUES ('41', '0b6016ac-9d7d-44ce-8cdb-9e069e7edfbe', 'Barangay 1 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:04:43', '2020-09-16 09:04:43', null);
INSERT INTO `address_list` VALUES ('42', '988b794b-dcbf-4221-acb5-182db61c772f', 'Barangay 7 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:05:09', '2020-09-16 09:05:09', null);
INSERT INTO `address_list` VALUES ('43', '5c4d246b-816d-452b-a2f0-edd1934b8a3e', 'Barangay 20 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:05:30', '2020-09-16 09:05:30', null);
INSERT INTO `address_list` VALUES ('44', '988f03d4-8127-48dc-9db8-986603d10b16', 'Barangay 25 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:05:55', '2020-09-16 09:05:55', null);
INSERT INTO `address_list` VALUES ('45', 'ae83dddd-9ef3-44d4-b8dd-ffabbe1a8ebf', 'Barangay 29 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:06:16', '2020-09-16 09:06:16', null);
INSERT INTO `address_list` VALUES ('46', '77bdc532-9ce2-4123-a00a-a7bcad9c7070', 'Barangay 31 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:06:35', '2020-09-16 09:06:35', null);
INSERT INTO `address_list` VALUES ('47', '20204a22-cdc6-4730-bd3f-4820099fa35a', 'Barangay 35 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:07:02', '2020-09-16 09:07:02', null);
INSERT INTO `address_list` VALUES ('48', 'f3a37dc4-8a62-40b7-b206-710c2750c74a', 'Barangay 36 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:07:25', '2020-09-16 09:07:25', null);
INSERT INTO `address_list` VALUES ('49', '5e2a1b8b-dbcf-4afc-9ed8-28c03a77010a', 'Barangay 37 (Pob.)', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:07:46', '2020-09-16 09:07:46', null);
INSERT INTO `address_list` VALUES ('50', '1f443ae6-8a88-4ea4-9d4f-14ed3397975a', 'Bayabas', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:08:43', '2020-09-16 09:08:43', null);
INSERT INTO `address_list` VALUES ('51', 'eac8f7bc-5b82-4d93-a58d-f8bf4dcfa107', 'Bayanga', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:09:05', '2020-09-16 09:09:05', null);
INSERT INTO `address_list` VALUES ('52', 'ddf57572-b7e8-482a-abf9-4aedb3cf35b7', 'Besigan', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:09:24', '2020-09-16 09:09:24', null);
INSERT INTO `address_list` VALUES ('53', 'a1500afe-7c60-4ee2-b31d-f81121dfc12e', 'Bonbon', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:09:44', '2020-09-16 09:09:44', null);
INSERT INTO `address_list` VALUES ('54', '6a494d00-5994-4eac-a191-638f7295025a', 'Bugo', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:10:05', '2020-09-16 09:10:05', null);
INSERT INTO `address_list` VALUES ('55', '67da8a1b-38fe-4a43-8dc5-7735607ea7d0', 'Camaman-an', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:10:26', '2020-09-16 09:10:26', null);
INSERT INTO `address_list` VALUES ('56', 'e95872ed-d881-4746-8603-34568c931b67', 'Canito-an', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:10:47', '2020-09-16 09:10:47', null);
INSERT INTO `address_list` VALUES ('57', '367dc3c1-cee9-4cc5-a0d0-405fe3c9cb91', 'Carmen', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:11:14', '2020-09-16 09:11:14', null);
INSERT INTO `address_list` VALUES ('58', '22590cac-8c20-4f62-b348-6ac00956d5d1', 'Consolacion', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:11:41', '2020-09-16 09:11:41', null);
INSERT INTO `address_list` VALUES ('59', 'db1f9620-f2c8-46ee-961b-0887344ef11a', 'Cugman', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:12:01', '2020-09-16 09:12:01', null);
INSERT INTO `address_list` VALUES ('60', '2f6751ca-6873-47ae-8480-16825c104702', 'Dansolihon', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:12:24', '2020-09-16 09:12:24', null);
INSERT INTO `address_list` VALUES ('61', 'd3c8610d-1538-48b7-bc7e-eedb12e05105', 'F. S. Catanico', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:12:58', '2020-09-16 09:12:58', null);
INSERT INTO `address_list` VALUES ('62', '60c1b32d-7eb0-482c-a73a-6502478a1e93', 'Gusa', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:13:18', '2020-09-16 09:13:18', null);
INSERT INTO `address_list` VALUES ('63', '2ed183f6-3b88-49e7-9954-cef2a68bef40', 'Indahag', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:13:44', '2020-09-16 09:13:44', null);
INSERT INTO `address_list` VALUES ('64', '84448961-d5c2-4cbd-84de-46e7e2036de1', 'Iponan', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:14:15', '2020-09-16 09:14:15', null);
INSERT INTO `address_list` VALUES ('65', '64c00b87-8049-4df4-96f3-5dfdae33f3e3', 'Kauswagan', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:14:41', '2020-09-16 09:14:41', null);
INSERT INTO `address_list` VALUES ('66', 'e5529d1c-9dea-43f1-a134-9c2f32b1b14f', 'Lapasan', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:15:05', '2020-09-16 09:15:05', null);
INSERT INTO `address_list` VALUES ('67', 'b8ba1501-2849-4ec8-8e3e-b1b9ee4658e2', 'Lumbia', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:15:26', '2020-09-16 09:15:26', null);
INSERT INTO `address_list` VALUES ('68', 'a662a89f-2845-4d5d-bd6f-5dcf8b42f35e', 'Macabalan', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:15:48', '2020-09-16 09:15:48', null);
INSERT INTO `address_list` VALUES ('69', '4d65be31-3ab7-4a56-9821-448514fcf852', 'Macasandig', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:16:09', '2020-09-16 09:16:09', null);
INSERT INTO `address_list` VALUES ('70', 'ab9f9a03-6276-4984-968a-ab79d72b56d5', 'Mambuaya', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:16:28', '2020-09-16 09:16:28', null);
INSERT INTO `address_list` VALUES ('71', '0b6976dc-c6a1-4560-90cd-b7f846bf88cc', 'Nazareth', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:16:49', '2020-09-16 09:16:49', null);
INSERT INTO `address_list` VALUES ('72', 'f1e2bed4-7876-4841-8df0-93a2eba7c578', 'Pagalungan', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:17:13', '2020-09-16 09:17:13', null);
INSERT INTO `address_list` VALUES ('73', 'cef9939f-4608-488b-a236-cfea9be846bb', 'Pagatpat', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:17:39', '2020-09-16 09:17:39', null);
INSERT INTO `address_list` VALUES ('74', '3378e15f-d377-4de1-8e54-c88e45c3f795', 'Patag', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:17:58', '2020-09-16 09:17:58', null);
INSERT INTO `address_list` VALUES ('75', 'f06f18fe-7637-4e4b-a1d3-b1c4c318fc95', 'Pigsag-an', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:18:20', '2020-09-16 09:18:20', null);
INSERT INTO `address_list` VALUES ('76', '497f3281-4e15-449d-9b2f-887452cc28c2', 'Puerto', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:18:40', '2020-09-16 09:18:40', null);
INSERT INTO `address_list` VALUES ('77', '9e83dee9-41d6-4110-8c76-d62fef15fad5', 'Puntod', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:19:01', '2020-09-16 09:19:01', null);
INSERT INTO `address_list` VALUES ('78', 'aa9336bf-1468-4814-852b-8954a0d5ab8e', 'San Simon', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:19:23', '2020-09-16 09:19:23', null);
INSERT INTO `address_list` VALUES ('79', '195ba526-957e-48f4-97e6-3fc24234aca3', 'Tablon', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:20:23', '2020-09-16 09:20:23', null);
INSERT INTO `address_list` VALUES ('80', 'ba9c350a-6c9d-439c-9b18-b190ce755ce3', 'Taglimao', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:20:47', '2020-09-16 09:20:47', null);
INSERT INTO `address_list` VALUES ('81', '36c1b0b9-5d55-4ebb-806e-751058c6e2ed', 'Tagpangi', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:21:21', '2020-09-16 09:21:21', null);
INSERT INTO `address_list` VALUES ('82', '2135e831-2518-4a2d-b134-427d39f8234a', 'Tignapoloan', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:21:43', '2020-09-16 09:21:43', null);
INSERT INTO `address_list` VALUES ('83', '8b632da0-b3fe-4ba3-9d99-3157d8ee3b3f', 'Tuburan', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:22:04', '2020-09-16 09:22:04', null);
INSERT INTO `address_list` VALUES ('84', '53a91236-5a3f-497c-9564-a66ed2839328', 'Tumpagon', 'CAGAYAN DE ORO CITY (Capital)', 'MISAMIS ORIENTAL', 'REGION X (Northern Mindanao)', 'Philippines', '9000', '2020-09-16 09:22:23', '2020-09-16 09:22:23', null);

-- ----------------------------
-- Table structure for bd_group_suppliers
-- ----------------------------
DROP TABLE IF EXISTS `bd_group_suppliers`;
CREATE TABLE `bd_group_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `supplier_uuid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bd_group_suppliers
-- ----------------------------

-- ----------------------------
-- Table structure for bd_group_supplier_discounts
-- ----------------------------
DROP TABLE IF EXISTS `bd_group_supplier_discounts`;
CREATE TABLE `bd_group_supplier_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `bd_group_supplier_uuid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bd_group_supplier_discounts
-- ----------------------------

-- ----------------------------
-- Table structure for bd_group_supplier_discount_excluded_items
-- ----------------------------
DROP TABLE IF EXISTS `bd_group_supplier_discount_excluded_items`;
CREATE TABLE `bd_group_supplier_discount_excluded_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `bd_group_supplier_discount_uuid` varchar(255) NOT NULL,
  `item_uuid` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bd_group_supplier_discount_excluded_items
-- ----------------------------

-- ----------------------------
-- Table structure for company_accounting_period
-- ----------------------------
DROP TABLE IF EXISTS `company_accounting_period`;
CREATE TABLE `company_accounting_period` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `year_name` year(4) DEFAULT NULL,
  `jan_is_open` int(11) DEFAULT NULL,
  `feb_is_open` int(11) DEFAULT NULL,
  `mar_is_open` int(11) DEFAULT NULL,
  `apr_is_open` int(11) DEFAULT NULL,
  `may_is_open` int(11) DEFAULT NULL,
  `jun_is_open` int(11) DEFAULT NULL,
  `jul_is_open` int(11) DEFAULT NULL,
  `aug_is_open` int(11) DEFAULT NULL,
  `sep_is_open` int(11) DEFAULT NULL,
  `oct_is_open` int(11) DEFAULT NULL,
  `nov_is_open` int(11) DEFAULT NULL,
  `dec_is_open` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_accounting_period
-- ----------------------------
INSERT INTO `company_accounting_period` VALUES ('1', 'dc0efc5c-58dd-4079-bfe0-79307d16d737', '2020', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2021-01-09 06:01:55', '2021-04-17 09:14:36', null);

-- ----------------------------
-- Table structure for company_branch
-- ----------------------------
DROP TABLE IF EXISTS `company_branch`;
CREATE TABLE `company_branch` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT '',
  `branch_shortname` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_branch
-- ----------------------------
INSERT INTO `company_branch` VALUES ('1', 'fcb19987-8559-462e-ad2d-2b096910508c', 'Main Branch', 'Main', '2020-07-25 15:42:01', '2020-07-25 15:42:13', null);
INSERT INTO `company_branch` VALUES ('2', 'f224cc74-a36c-4f60-b5c3-28ac5caf5373', 'Cagayan de Oro', 'CDO', '2020-07-25 16:41:01', '2020-11-06 10:41:33', null);
INSERT INTO `company_branch` VALUES ('3', 'e2497736-fad0-49a9-90ac-6b2186c705ba', 'Branch 2', 'BR2', '2020-08-02 05:06:39', '2020-09-09 14:08:48', null);

-- ----------------------------
-- Table structure for company_branch_location
-- ----------------------------
DROP TABLE IF EXISTS `company_branch_location`;
CREATE TABLE `company_branch_location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `branch_uuid` varchar(255) DEFAULT '',
  `location_name` varchar(255) DEFAULT '',
  `location_shortname` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_branch_location
-- ----------------------------
INSERT INTO `company_branch_location` VALUES ('1', '8f4bb063-f058-4d6e-85c5-0e7dcac11fc1', '1', 'f224cc74-a36c-4f60-b5c3-28ac5caf5373', 'Main Warehouse', 'MW', '2020-07-25 16:45:16', '2020-11-06 10:44:50', null);
INSERT INTO `company_branch_location` VALUES ('2', 'a92a6b99-eac3-4299-982f-2b0d56ce301a', '1', 'e2497736-fad0-49a9-90ac-6b2186c705ba', 'Branch 2 Gusa', 'BRG', '2020-08-02 05:10:14', '2020-09-09 14:08:16', null);
INSERT INTO `company_branch_location` VALUES ('3', 'fd21314d-a2a0-431e-bfb7-45cf1cc6cdc2', '1', 'f224cc74-a36c-4f60-b5c3-28ac5caf5373', 'Main Warehouse 2', 'MW2', '2020-09-09 14:07:21', '2020-11-06 10:44:37', null);
INSERT INTO `company_branch_location` VALUES ('4', '7f7fa04b-c75c-4c6d-8251-a4efd357e4c9', '1', 'e2497736-fad0-49a9-90ac-6b2186c705ba', 'Branch 2 Bulua', 'BRB', '2020-09-09 14:07:44', '2020-09-09 14:07:44', null);

-- ----------------------------
-- Table structure for company_chart_of_accounts
-- ----------------------------
DROP TABLE IF EXISTS `company_chart_of_accounts`;
CREATE TABLE `company_chart_of_accounts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `coa_group_uuid` varchar(255) DEFAULT '',
  `is_default_expense` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_chart_of_accounts
-- ----------------------------
INSERT INTO `company_chart_of_accounts` VALUES ('19', 'a62503d1-caf4-4b4c-8702-d2ff13a7a811', '1000', 'Cash on Hand', '32f072ac-8dd5-4fa1-b2ea-32dc916ea622', '0', '2020-09-16 13:28:33', '2021-03-16 05:18:01', null);
INSERT INTO `company_chart_of_accounts` VALUES ('20', 'c17821a5-3622-4677-80b9-54660ce14020', '1005', 'Undeposited Cash', '32f072ac-8dd5-4fa1-b2ea-32dc916ea622', '0', '2020-09-16 13:28:52', '2020-09-16 13:28:52', null);
INSERT INTO `company_chart_of_accounts` VALUES ('21', 'b934fb01-5af6-4078-9845-6fbecdb0df29', '1010', 'Cash Funds', '32f072ac-8dd5-4fa1-b2ea-32dc916ea622', '0', '2020-09-16 13:29:06', '2020-09-16 13:29:06', null);
INSERT INTO `company_chart_of_accounts` VALUES ('22', 'e1b6f8ec-71f5-41d9-a71f-47d0ae9a5730', '1020', 'Cash in Bank', '32f072ac-8dd5-4fa1-b2ea-32dc916ea622', '0', '2020-09-16 13:29:22', '2020-09-16 13:29:22', null);
INSERT INTO `company_chart_of_accounts` VALUES ('23', '0d94b076-3cab-4006-a86a-96910d0c8009', '1100', 'Accounts Receivable', 'c3196ef4-abc1-43f3-a31b-5cec95044519', '0', '2020-09-16 13:29:40', '2021-03-04 17:24:30', null);
INSERT INTO `company_chart_of_accounts` VALUES ('24', '652ce708-9cea-44d0-a7c5-cc63887d4bfb', '1110', 'Allowance for Bad Debt', 'c3196ef4-abc1-43f3-a31b-5cec95044519', '0', '2020-09-16 13:30:00', '2021-03-04 17:24:40', null);
INSERT INTO `company_chart_of_accounts` VALUES ('25', 'b4a27b03-3967-4682-90e0-a702ad6341d9', '1120', 'Inventory Fulfilled Not Invoiced', 'c3196ef4-abc1-43f3-a31b-5cec95044519', '0', '2020-09-16 13:30:17', '2021-03-04 17:24:48', null);
INSERT INTO `company_chart_of_accounts` VALUES ('26', '24a9cb58-0032-464a-985f-1cb185010587', '1300', 'Inventory', '0ff067d4-6493-43ba-a891-1c1451933287', '0', '2020-09-16 13:30:37', '2020-09-16 13:30:37', null);
INSERT INTO `company_chart_of_accounts` VALUES ('27', '690d75ac-0ead-4dc3-9e44-2555b908596a', '1310', 'Allowance for Obsolesence', '0ff067d4-6493-43ba-a891-1c1451933287', '0', '2020-09-16 13:30:51', '2020-09-16 13:30:51', null);
INSERT INTO `company_chart_of_accounts` VALUES ('28', '231dabd8-a9f4-4558-ab5a-590a78fa381e', '1400', 'Other Current Assets', '2630e25b-eb19-4814-825d-f7c1789ef29c', '0', '2020-09-16 13:31:15', '2020-09-16 13:31:15', null);
INSERT INTO `company_chart_of_accounts` VALUES ('29', '055b293b-1c3b-4fd8-8b54-b0ba75414494', '1401', 'Prepaid Expenses', '2630e25b-eb19-4814-825d-f7c1789ef29c', '1', '2020-09-16 13:31:30', '2021-03-16 05:04:10', null);
INSERT INTO `company_chart_of_accounts` VALUES ('30', '8f012b0f-a9cf-4f17-8a24-5878ea7baf71', '1500', 'Motor Vehicle', '1050c03c-e718-4f6a-9ae6-58f23dd616ca', '0', '2020-09-16 13:31:50', '2020-09-16 13:31:50', null);
INSERT INTO `company_chart_of_accounts` VALUES ('31', '9133572a-de0a-4551-996e-d5032e59bacd', '1510', 'Accumulated Depreciation - Motor Vehicle', '1050c03c-e718-4f6a-9ae6-58f23dd616ca', '0', '2020-09-16 13:32:08', '2020-09-16 13:32:08', null);
INSERT INTO `company_chart_of_accounts` VALUES ('32', '49a8535e-feca-445b-a456-d652c29882ae', '1520', 'Office Equipment', '1050c03c-e718-4f6a-9ae6-58f23dd616ca', '0', '2020-09-16 13:32:24', '2020-09-16 13:32:24', null);
INSERT INTO `company_chart_of_accounts` VALUES ('33', '70db100c-c48a-4b97-a8a9-3895f604a9b0', '1530', 'Accumulated Depreciation - Office Equipment', '1050c03c-e718-4f6a-9ae6-58f23dd616ca', '0', '2020-09-16 13:32:38', '2020-09-16 13:32:38', null);
INSERT INTO `company_chart_of_accounts` VALUES ('34', '9b779a08-791c-4edc-83d3-3639f1739622', '1540', 'Furniture and Fixture', '1050c03c-e718-4f6a-9ae6-58f23dd616ca', '0', '2020-09-16 13:32:54', '2020-09-16 13:32:54', null);
INSERT INTO `company_chart_of_accounts` VALUES ('35', 'a01720af-8da4-4be4-b5df-6d2055b48b54', '1550', 'Accumulated Depreciation - Furniture and Fixture', '1050c03c-e718-4f6a-9ae6-58f23dd616ca', '0', '2020-09-16 13:33:09', '2020-09-16 13:33:09', null);
INSERT INTO `company_chart_of_accounts` VALUES ('36', '05589d63-80c4-4cd1-a714-9d741dd30837', '1560', 'Asset Received Not Billed', '1050c03c-e718-4f6a-9ae6-58f23dd616ca', '0', '2020-09-16 13:33:23', '2020-09-16 13:33:23', null);
INSERT INTO `company_chart_of_accounts` VALUES ('37', '0f45f489-d2b4-473c-a8ea-86439c41b69e', '1600', 'Other Asset', '10d9646e-44e9-4c14-9919-03e887e507e2', '0', '2020-09-16 13:33:48', '2020-09-16 13:33:48', null);
INSERT INTO `company_chart_of_accounts` VALUES ('38', '0ea6c313-dad5-4c12-8812-f38b5f0ea3ef', '2000', 'Progress Billings', '10bef38c-76a2-4d45-ad9d-03aa03f6f5e7', '0', '2020-09-16 13:34:08', '2021-03-04 17:25:03', null);
INSERT INTO `company_chart_of_accounts` VALUES ('39', '076cb76b-1165-4c77-82d7-8ac6682f118c', '2010', 'Accounts Payable', '10bef38c-76a2-4d45-ad9d-03aa03f6f5e7', '0', '2020-09-16 13:34:19', '2021-03-04 17:25:15', null);
INSERT INTO `company_chart_of_accounts` VALUES ('40', 'af4b1d33-b78e-4618-967f-a11fe7302f1c', '2020', 'Inventory Received Not Billed', '10bef38c-76a2-4d45-ad9d-03aa03f6f5e7', '0', '2020-09-16 13:34:37', '2021-03-04 17:25:27', null);
INSERT INTO `company_chart_of_accounts` VALUES ('41', '06baa749-f783-4114-8c61-07eb666564db', '2100', 'Accrued Liabilities', 'ee1f2117-de6e-47dd-8a68-f98d7df483b7', '0', '2020-09-16 13:34:57', '2020-09-16 13:34:57', null);
INSERT INTO `company_chart_of_accounts` VALUES ('42', '753d8a23-57ba-4377-af60-e62e544be7d4', '2110', 'SSS/PHIC/HDMF Liabilities', 'ee1f2117-de6e-47dd-8a68-f98d7df483b7', '0', '2020-09-16 13:35:40', '2020-09-16 13:35:40', null);
INSERT INTO `company_chart_of_accounts` VALUES ('43', '5b9c2725-6784-42c6-94a1-4b83ad32afe1', '2200', 'Municipal Tax Payable', 'ccbed9d2-c34c-4e75-9d97-29bf2cd1c5f5', '0', '2020-09-16 13:35:59', '2020-09-16 13:35:59', null);
INSERT INTO `company_chart_of_accounts` VALUES ('44', 'a2722190-32b5-4965-bf2f-6a8f2efdb671', '2210', 'Withholding Tax Payable', 'ccbed9d2-c34c-4e75-9d97-29bf2cd1c5f5', '0', '2020-09-16 13:36:15', '2020-09-16 13:36:15', null);
INSERT INTO `company_chart_of_accounts` VALUES ('45', '9a94a799-136c-4e05-a099-c97b919e045e', '2220', 'Expanded Withholding Tax Payable', 'ccbed9d2-c34c-4e75-9d97-29bf2cd1c5f5', '0', '2020-09-16 13:36:29', '2020-09-16 13:36:29', null);
INSERT INTO `company_chart_of_accounts` VALUES ('46', '9f6604c5-edc9-4aad-a40b-9250d3f5e0f2', '2230', 'Input Tax', 'ccbed9d2-c34c-4e75-9d97-29bf2cd1c5f5', '0', '2020-09-16 13:36:41', '2020-09-16 13:36:41', null);
INSERT INTO `company_chart_of_accounts` VALUES ('47', 'a613d0aa-68f2-479a-876f-037eb542d7dd', '2240', 'Output Tax', 'ccbed9d2-c34c-4e75-9d97-29bf2cd1c5f5', '0', '2020-09-16 13:36:56', '2020-09-16 13:36:56', null);
INSERT INTO `company_chart_of_accounts` VALUES ('48', 'ae058be2-b097-418d-93bf-045cd4991f97', '2250', 'Income Tax Payable', 'ccbed9d2-c34c-4e75-9d97-29bf2cd1c5f5', '0', '2020-09-16 13:37:20', '2020-09-16 13:37:20', null);
INSERT INTO `company_chart_of_accounts` VALUES ('49', '64422b76-dd1d-4f38-9351-cdaf914d1f8c', '2300', 'Other Liabilities', '48aedb78-8034-485d-b2c0-08c2e8e0ed99', '0', '2020-09-16 13:37:42', '2020-09-16 13:37:42', null);
INSERT INTO `company_chart_of_accounts` VALUES ('50', '8c8b28da-1a3a-4a14-876e-d0f0119ce354', '2310', 'Loans Payable', '48aedb78-8034-485d-b2c0-08c2e8e0ed99', '0', '2020-09-16 13:38:13', '2020-09-16 13:38:13', null);
INSERT INTO `company_chart_of_accounts` VALUES ('51', '8ae4a845-d596-4630-856d-1f8f0c2c775d', '3000', 'Retained Earnings', 'e31a2c62-073a-424d-8387-e7aec2400859', '0', '2020-09-16 13:38:28', '2020-09-16 13:39:12', null);
INSERT INTO `company_chart_of_accounts` VALUES ('52', '2676f4eb-39da-49eb-b4a4-7bd1d4b0e4ec', '3010', 'Share Capital', 'e31a2c62-073a-424d-8387-e7aec2400859', '0', '2020-09-16 13:38:59', '2020-09-16 13:38:59', null);
INSERT INTO `company_chart_of_accounts` VALUES ('53', '8439f5c6-6b35-495b-a776-b18d30d704e1', '4000', 'Revenue', '00cb4c7a-3aed-4669-9a57-fcc0f4f9c039', '0', '2020-09-16 13:39:36', '2021-03-04 17:25:40', null);
INSERT INTO `company_chart_of_accounts` VALUES ('54', 'd647dd28-3563-4f08-9a81-7afebe6451bd', '5000', 'Labor - COS', 'e0f35f15-5f5a-429b-a48c-0a066a06885a', '0', '2020-09-16 13:39:56', '2021-03-04 17:25:55', null);
INSERT INTO `company_chart_of_accounts` VALUES ('55', '4c4a99c0-6f5d-4343-a726-765e23c59223', '5010', 'Materials - COS', 'e0f35f15-5f5a-429b-a48c-0a066a06885a', '0', '2020-09-16 13:40:09', '2021-03-04 17:26:15', null);
INSERT INTO `company_chart_of_accounts` VALUES ('56', '5999a5a4-71cd-471b-a4dd-0b93ebce7b40', '5020', 'Other - COS', 'e0f35f15-5f5a-429b-a48c-0a066a06885a', '0', '2020-09-16 13:40:24', '2021-03-04 17:26:24', null);
INSERT INTO `company_chart_of_accounts` VALUES ('57', '4471e92d-3e25-4038-b182-0f0cdafe0008', '5030', 'Overhead - COS', 'e0f35f15-5f5a-429b-a48c-0a066a06885a', '0', '2020-09-16 13:40:42', '2021-03-04 17:26:33', null);
INSERT INTO `company_chart_of_accounts` VALUES ('58', '0bad9f76-9417-4aa8-8f70-ae753096540e', '5040', 'Work In Progress', 'e0f35f15-5f5a-429b-a48c-0a066a06885a', '0', '2020-09-16 13:40:56', '2021-03-04 17:26:41', null);
INSERT INTO `company_chart_of_accounts` VALUES ('59', '58e1a793-3042-48bc-9d11-bf477a2929fa', '4010', 'Sales', '00cb4c7a-3aed-4669-9a57-fcc0f4f9c039', '0', '2020-09-16 13:41:14', '2021-03-13 12:09:44', null);
INSERT INTO `company_chart_of_accounts` VALUES ('60', 'd0dc6304-d978-41c7-9580-eccea73d1aca', '5050', 'Cost of Sales', 'e0f35f15-5f5a-429b-a48c-0a066a06885a', '0', '2020-09-16 13:41:31', '2021-03-04 17:27:04', null);
INSERT INTO `company_chart_of_accounts` VALUES ('61', '12736ee9-5d5f-4668-9207-5fb9b7bdd846', '4020', 'Other Income', '678bb988-1cdb-4a91-8b55-a35551d91040', '0', '2020-09-16 13:41:49', '2020-09-16 13:41:49', null);
INSERT INTO `company_chart_of_accounts` VALUES ('62', '282a2d9e-9a12-481b-b1ac-34b41ffd74fb', '5100', 'Salaries and Wages', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:42:11', '2021-04-24 08:51:03', null);
INSERT INTO `company_chart_of_accounts` VALUES ('63', 'e52d5c59-9a98-40e1-80b3-38ebedea948d', '5110', 'Contractual Services', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:42:24', '2021-04-24 08:52:08', null);
INSERT INTO `company_chart_of_accounts` VALUES ('64', '08246c29-06db-4738-bd33-a16e171809c9', '5120', 'Bonuses', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:42:35', '2021-04-24 08:52:47', null);
INSERT INTO `company_chart_of_accounts` VALUES ('65', '363f366c-cb16-4ffd-a835-ad6f01d9ae26', '5130', 'Employee Benefits and Allowances', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:42:50', '2021-04-24 08:53:17', null);
INSERT INTO `company_chart_of_accounts` VALUES ('66', '0039deec-be79-488f-9c7d-9e620d418c48', '5140', 'Meals Expense', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:43:02', '2021-04-24 08:53:42', null);
INSERT INTO `company_chart_of_accounts` VALUES ('67', 'ca32dfe6-9422-4d50-88ca-1c3242228cdd', '5150', 'Incentives and Commissions', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:43:12', '2021-04-24 08:54:02', null);
INSERT INTO `company_chart_of_accounts` VALUES ('68', 'ea3e9966-60b8-4621-892e-4250e8efba12', '5160', 'SSS/Med/Pag-ibig Contribution', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:43:25', '2021-04-24 08:54:17', null);
INSERT INTO `company_chart_of_accounts` VALUES ('69', '0ce30798-4d4a-4e1f-9776-5ab66e10b494', '5170', 'Hotel and Lodging', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:43:38', '2021-04-24 08:54:34', null);
INSERT INTO `company_chart_of_accounts` VALUES ('70', '5477e3a9-cdb8-41d1-af64-ab87460a82a7', '5180', 'Training/Meeting Expenses', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:43:51', '2021-04-24 08:54:53', null);
INSERT INTO `company_chart_of_accounts` VALUES ('71', 'd9a83547-db23-4bd3-a0b3-0e0b927572a0', '5190', 'Transportation Expense', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:44:01', '2021-04-24 08:55:13', null);
INSERT INTO `company_chart_of_accounts` VALUES ('72', 'b1d8a0af-00e4-42ae-87c9-c780e1316a2c', '5200', 'Depreciation - Motor Vehicle', '9c620461-7af0-416f-910d-0b59ad33445c', '0', '2020-09-16 13:44:12', '2021-04-24 08:55:43', null);
INSERT INTO `company_chart_of_accounts` VALUES ('73', '271ea37e-da1c-4c16-9f67-d724ab2502d2', '5210', 'Depreciation - Office Equipment', '9c620461-7af0-416f-910d-0b59ad33445c', '0', '2020-09-16 13:44:24', '2021-04-24 08:56:04', null);
INSERT INTO `company_chart_of_accounts` VALUES ('74', '9533ff72-c393-4529-a7a7-894c6afed441', '5220', 'Depreciation - Furniture and Fixture', '9c620461-7af0-416f-910d-0b59ad33445c', '0', '2020-09-16 13:44:36', '2021-04-24 08:56:20', null);
INSERT INTO `company_chart_of_accounts` VALUES ('75', '81aee138-066a-4e48-852c-a8c5677b17c6', '5230', 'Fuel and Oil', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:44:48', '2021-04-24 08:56:46', null);
INSERT INTO `company_chart_of_accounts` VALUES ('76', 'ba79fb12-1c36-4273-ae9b-729b3d5eb39d', '5240', 'Repairs and Maintenance', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:45:00', '2021-04-24 08:57:04', null);
INSERT INTO `company_chart_of_accounts` VALUES ('77', 'b29eb209-9ac9-4477-a4ad-98da65d24be4', '5250', 'Rent Expense', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:45:13', '2021-04-24 08:57:29', null);
INSERT INTO `company_chart_of_accounts` VALUES ('78', 'e7d696eb-6fd4-4c68-8dd8-dc9da015f34a', '5260', 'Transportation and Handling Fee', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:45:26', '2021-04-24 08:57:52', null);
INSERT INTO `company_chart_of_accounts` VALUES ('79', 'a7c3fd1e-eb56-4fa8-89a4-7df4eeebf9a5', '5270', 'Licenses and Registration Fees', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:45:41', '2021-04-24 09:12:20', null);
INSERT INTO `company_chart_of_accounts` VALUES ('80', '1d7878d9-3bbb-4ebf-bd1c-07232cf5b7f8', '5280', 'Insurance Expense', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:45:56', '2021-04-24 09:20:38', null);
INSERT INTO `company_chart_of_accounts` VALUES ('81', 'fef76060-3965-41d4-9686-bda3c4b8cafb', '5290', 'Municipal Tax Expense', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:46:07', '2021-04-24 09:20:56', null);
INSERT INTO `company_chart_of_accounts` VALUES ('82', 'f88da01f-cc2b-4ba5-907e-bbcf328c6f46', '5300', 'Supplies Expense', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:46:22', '2021-04-24 09:21:22', null);
INSERT INTO `company_chart_of_accounts` VALUES ('83', '9fffc4e7-c4c4-4208-95a0-aef4f4f3e904', '5310', 'Telecommunication Expenses', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:46:35', '2021-04-24 09:21:39', null);
INSERT INTO `company_chart_of_accounts` VALUES ('84', '9f61014f-3941-4523-96af-4e42b17492cc', '5320', 'Light and Power', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:46:48', '2021-04-24 09:22:24', null);
INSERT INTO `company_chart_of_accounts` VALUES ('85', 'b400c729-013d-4d34-995e-5ce53752554e', '5330', 'Water', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:47:03', '2021-04-24 09:22:43', null);
INSERT INTO `company_chart_of_accounts` VALUES ('86', 'f505a61e-cf6e-4b92-baf1-31d263ffbc38', '5340', 'Representation Expense', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2020-09-16 13:47:20', '2021-04-24 09:23:01', null);
INSERT INTO `company_chart_of_accounts` VALUES ('87', '1a08785a-ca96-45fe-95bb-05cfade797c1', '5350', 'Professional Fees', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2021-04-24 09:23:29', '2021-04-24 09:23:29', null);
INSERT INTO `company_chart_of_accounts` VALUES ('88', 'e36b6110-09ce-475c-977d-49a1d169a084', '5360', 'Security Services', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2021-04-24 09:23:57', '2021-04-24 09:23:57', null);
INSERT INTO `company_chart_of_accounts` VALUES ('89', 'c98356e4-bbf6-4835-bbfe-13d1b77c337a', '5370', 'Merchandising and Promotions', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2021-04-24 09:24:17', '2021-04-24 09:24:17', null);
INSERT INTO `company_chart_of_accounts` VALUES ('90', 'f11594bd-42b9-4945-9e55-f0f9bb993136', '5380', 'Doubtful Accounts Expense', '9c620461-7af0-416f-910d-0b59ad33445c', '0', '2021-04-24 09:24:37', '2021-04-24 09:24:37', null);
INSERT INTO `company_chart_of_accounts` VALUES ('91', 'b75958ff-ba99-4106-a0c4-d273719a75c6', '5390', 'Software Expense', '9c620461-7af0-416f-910d-0b59ad33445c', '1', '2021-04-24 09:24:53', '2021-04-24 09:24:53', null);
INSERT INTO `company_chart_of_accounts` VALUES ('92', '5cd29b1d-99f9-42f6-bd97-59f6c1321567', '5400', 'Other Expenses', '2d297ebc-8082-4a4c-aef2-248623884592', '1', '2021-04-24 09:25:11', '2021-04-24 09:26:01', null);
INSERT INTO `company_chart_of_accounts` VALUES ('93', 'bc733ffa-1a93-4f13-a7e0-a5a776b53bab', '5410', 'Bank and Other Charges', '0da49e61-0ae1-4e32-adc8-06295514c173', '1', '2021-04-24 09:25:43', '2021-04-24 09:25:43', null);
INSERT INTO `company_chart_of_accounts` VALUES ('94', '7d6a338d-b270-4551-bb8a-c52245101177', '5420', 'Interest Expense', '0da49e61-0ae1-4e32-adc8-06295514c173', '1', '2021-04-24 09:26:21', '2021-04-24 09:26:21', null);
INSERT INTO `company_chart_of_accounts` VALUES ('95', '3a49897a-b021-4c07-b17f-ab4942cb5f37', '5430', 'Income Tax Expense', 'def041a5-5263-4354-9fbe-a845f997e675', '1', '2021-04-24 09:26:42', '2021-04-24 09:26:42', null);

-- ----------------------------
-- Table structure for company_chart_of_accounts_account_group
-- ----------------------------
DROP TABLE IF EXISTS `company_chart_of_accounts_account_group`;
CREATE TABLE `company_chart_of_accounts_account_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `coa_report_uuid` varchar(255) DEFAULT NULL,
  `account_group` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_chart_of_accounts_account_group
-- ----------------------------
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('14', '32f072ac-8dd5-4fa1-b2ea-32dc916ea622', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Cash', '2020-09-16 13:24:05', '2020-09-16 13:24:05', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('15', 'c3196ef4-abc1-43f3-a31b-5cec95044519', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Receivable', '2020-09-16 13:24:17', '2020-09-16 13:24:17', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('16', '0ff067d4-6493-43ba-a891-1c1451933287', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Inventory', '2020-09-16 13:24:30', '2020-09-16 13:24:30', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('17', '2630e25b-eb19-4814-825d-f7c1789ef29c', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Other Current Asset', '2020-09-16 13:24:59', '2020-09-16 13:24:59', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('18', '1050c03c-e718-4f6a-9ae6-58f23dd616ca', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Fixed Asset', '2020-09-16 13:25:10', '2020-09-16 13:25:10', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('19', '10d9646e-44e9-4c14-9919-03e887e507e2', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Other Asset', '2020-09-16 13:25:29', '2020-09-16 13:25:29', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('20', '10bef38c-76a2-4d45-ad9d-03aa03f6f5e7', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Accounts Payable', '2020-09-16 13:25:43', '2020-09-16 13:25:43', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('21', 'ee1f2117-de6e-47dd-8a68-f98d7df483b7', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Current Liability', '2020-09-16 13:25:52', '2020-09-16 13:25:52', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('22', 'ccbed9d2-c34c-4e75-9d97-29bf2cd1c5f5', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Taxes and Govermental Liability', '2020-09-16 13:26:02', '2020-09-16 13:26:02', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('23', '48aedb78-8034-485d-b2c0-08c2e8e0ed99', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Other Liability', '2020-09-16 13:26:14', '2020-09-16 13:26:14', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('24', 'e31a2c62-073a-424d-8387-e7aec2400859', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Owners Equity', '2020-09-16 13:26:28', '2020-09-16 13:26:28', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('25', '00cb4c7a-3aed-4669-9a57-fcc0f4f9c039', 'e9ed7560-a02f-479b-81b2-80a000a5f241', 'Income', '2020-09-16 13:26:44', '2020-09-16 13:26:44', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('26', 'e0f35f15-5f5a-429b-a48c-0a066a06885a', 'e9ed7560-a02f-479b-81b2-80a000a5f241', 'Cost of Sales', '2020-09-16 13:26:56', '2020-09-16 13:53:56', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('27', '678bb988-1cdb-4a91-8b55-a35551d91040', 'e9ed7560-a02f-479b-81b2-80a000a5f241', 'Other Income', '2020-09-16 13:27:30', '2020-09-16 13:27:30', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('28', '9c620461-7af0-416f-910d-0b59ad33445c', 'e9ed7560-a02f-479b-81b2-80a000a5f241', 'Operating Expense', '2020-09-16 13:27:44', '2021-04-24 08:44:26', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('29', '2d297ebc-8082-4a4c-aef2-248623884592', 'e9ed7560-a02f-479b-81b2-80a000a5f241', 'Other Expense', '2021-04-24 08:45:08', '2021-04-24 08:45:08', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('30', '0da49e61-0ae1-4e32-adc8-06295514c173', 'e9ed7560-a02f-479b-81b2-80a000a5f241', 'Finance Charge', '2021-04-24 08:45:23', '2021-04-24 08:45:23', null);
INSERT INTO `company_chart_of_accounts_account_group` VALUES ('31', 'def041a5-5263-4354-9fbe-a845f997e675', 'e9ed7560-a02f-479b-81b2-80a000a5f241', 'Income Tax', '2021-04-24 08:45:34', '2021-04-24 08:45:34', null);

-- ----------------------------
-- Table structure for company_chart_of_accounts_report_group
-- ----------------------------
DROP TABLE IF EXISTS `company_chart_of_accounts_report_group`;
CREATE TABLE `company_chart_of_accounts_report_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `coa_report_name` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_chart_of_accounts_report_group
-- ----------------------------
INSERT INTO `company_chart_of_accounts_report_group` VALUES ('5', '146190a2-a63a-4163-8dd5-6c5a345b4d5b', 'Balance Sheet', '2020-09-16 13:23:02', '2020-09-16 13:23:02', null);
INSERT INTO `company_chart_of_accounts_report_group` VALUES ('6', 'e9ed7560-a02f-479b-81b2-80a000a5f241', 'Profit and Loss', '2020-09-16 13:23:16', '2020-09-16 13:23:16', null);

-- ----------------------------
-- Table structure for company_department
-- ----------------------------
DROP TABLE IF EXISTS `company_department`;
CREATE TABLE `company_department` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT '',
  `cost_center_uuid` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_department
-- ----------------------------
INSERT INTO `company_department` VALUES ('10', 'fac9b625-f5e3-4cec-aabb-f00045c86e01', 'Administration', 'c59bad9d-73c9-43b2-9668-b489e0afaee8', '2020-10-16 09:16:05', '2020-10-16 09:16:05', null);
INSERT INTO `company_department` VALUES ('11', '75133e1d-c477-4af3-8302-3db0b47ecaf0', 'Sales', 'ce84e6a2-8a36-472a-8842-8c195b4dc334', '2020-10-16 09:23:23', '2020-10-16 09:23:23', null);

-- ----------------------------
-- Table structure for company_list
-- ----------------------------
DROP TABLE IF EXISTS `company_list`;
CREATE TABLE `company_list` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortname` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `tagline` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `website` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `global_address_uuid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of company_list
-- ----------------------------
INSERT INTO `company_list` VALUES ('1', 'ThinkOrion', 'Orion', 'Upper Nazareth, Cagayan de Oro City', 'One Happy Team', 'ThinkOrion@gmail', '09177029292', '123456', 'TH', 'c1921889-c4cd-46b1-918b-b79b4f2b6666', '2020-07-07 17:42:12', '2020-07-07 17:42:12', null);
INSERT INTO `company_list` VALUES ('4', 'HEXA.ph Corp.', 'HEXA.ph Corp.', 'Elevating OME\'s. Empowering Entrepreneurs.', 'https://www.hexa.ph', 'kb.castillo@hexa.ph', '09088188165', '000-000-000-000', 'HC', '5d703211-0499-497a-8cc9-93b392f968ec', '2020-09-17 09:52:46', '2020-09-17 09:52:46', null);
INSERT INTO `company_list` VALUES ('5', 'tret', 'ertret', 'wer', null, null, null, null, null, 'c1921889-c4cd-46b1-918b-b79b4f2b6666', '2020-11-14 13:54:58', '2020-11-14 13:54:58', null);
INSERT INTO `company_list` VALUES ('6', 'tret', 'ertret', 'wer', null, null, null, null, null, 'c1921889-c4cd-46b1-918b-b79b4f2b6666', '2020-11-14 13:55:11', '2020-11-14 13:55:11', null);

-- ----------------------------
-- Table structure for company_payment_term
-- ----------------------------
DROP TABLE IF EXISTS `company_payment_term`;
CREATE TABLE `company_payment_term` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_payment_term
-- ----------------------------
INSERT INTO `company_payment_term` VALUES ('11', '506c0f74-1623-4d6c-ac47-6bcad8ea9d2b', 'COD', '2020-09-16 14:45:39', '2020-09-16 14:45:39', null);
INSERT INTO `company_payment_term` VALUES ('12', '9d4ad586-6bdf-42f5-8249-9937118fc7a0', '1 Day', '2020-09-16 14:45:49', '2020-09-16 14:45:49', null);
INSERT INTO `company_payment_term` VALUES ('13', 'b93ce949-b062-4945-b584-7e8c3e15c559', '2 Days', '2020-09-16 14:45:59', '2020-09-16 14:45:59', null);
INSERT INTO `company_payment_term` VALUES ('14', 'f11666e5-aee5-4bd1-9183-0e548615ebfe', '3 Days', '2020-09-16 14:46:08', '2020-09-16 14:46:08', null);
INSERT INTO `company_payment_term` VALUES ('15', 'd46f6426-fbce-4b50-8a29-2d33b9aa41b6', '4 Days', '2020-09-16 14:46:20', '2020-09-16 14:46:20', null);
INSERT INTO `company_payment_term` VALUES ('16', '24b6602c-3428-4d58-a4b2-28db98888562', '5 Days', '2020-09-16 14:46:29', '2020-09-16 14:46:29', null);
INSERT INTO `company_payment_term` VALUES ('17', '64923cca-ea13-4ebe-ae81-61bdf0c5f88b', '6 Days', '2020-09-16 14:46:39', '2020-09-16 14:46:39', null);
INSERT INTO `company_payment_term` VALUES ('18', '40159d80-872a-4d63-b8b0-fede70bbc752', '7 Days', '2020-09-16 14:46:51', '2020-09-16 14:46:51', null);
INSERT INTO `company_payment_term` VALUES ('19', 'ba5a30a6-909a-4a9a-b1d7-6a483ae4ca7a', '14 Days', '2020-09-16 14:47:02', '2020-09-16 14:47:02', null);
INSERT INTO `company_payment_term` VALUES ('20', '7a68d013-3404-4860-985d-0860c6711c9f', '21 Days', '2020-09-16 14:47:14', '2020-09-16 14:47:14', null);
INSERT INTO `company_payment_term` VALUES ('21', '2da5250d-98ee-46c3-ab62-596c96432ba9', '30 Days', '2020-09-16 14:47:24', '2020-09-16 14:47:24', null);
INSERT INTO `company_payment_term` VALUES ('22', '0b71eeb6-3f03-41f2-afbe-5db3a304609d', '60 Days', '2020-09-16 14:47:41', '2020-09-16 14:47:41', null);
INSERT INTO `company_payment_term` VALUES ('23', 'ebf59667-1317-4709-bf0c-58b9bb26f336', '90 Days', '2020-09-16 14:47:50', '2020-09-16 14:47:50', null);
INSERT INTO `company_payment_term` VALUES ('24', 'd87af212-2392-4f35-90b6-95210375d3d6', '120 Days', '2020-09-16 14:47:59', '2020-09-16 14:47:59', null);
INSERT INTO `company_payment_term` VALUES ('25', 'd395e970-fc5f-42ba-882b-086d4ec51ab1', '150 Days', '2020-09-16 14:48:08', '2020-09-16 14:48:08', null);
INSERT INTO `company_payment_term` VALUES ('26', 'b8400286-dbce-48ae-af06-22493198dcc0', '180 Days', '2020-09-16 14:48:16', '2020-09-16 14:48:16', null);

-- ----------------------------
-- Table structure for company_taxation
-- ----------------------------
DROP TABLE IF EXISTS `company_taxation`;
CREATE TABLE `company_taxation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `tax_type` varchar(255) DEFAULT '',
  `tax_name` varchar(255) DEFAULT NULL,
  `tax_rate` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_taxation
-- ----------------------------
INSERT INTO `company_taxation` VALUES ('4', 'c61515f6-5706-4d1a-8adb-dac4d5f5637f', 'VAT', '0% Non-VAT', '0', '2020-09-16 14:36:39', '2021-03-13 11:40:42', null);
INSERT INTO `company_taxation` VALUES ('5', '1e1fc3e0-6431-4597-a811-c4895057667d', 'VAT', '12% VAT', '12', '2020-09-16 14:38:36', '2020-09-16 14:57:00', null);
INSERT INTO `company_taxation` VALUES ('6', 'f000df6e-745d-4ad3-9a04-124e9ea0dc93', 'EWT', '1% EWT on Goods', '1', '2020-09-16 14:39:17', '2020-09-16 14:57:12', null);
INSERT INTO `company_taxation` VALUES ('7', '88eea581-40bd-4fb2-b538-ef43679a1076', 'EWT', '2% EWT on Services', '2', '2020-09-16 14:41:12', '2020-09-16 14:57:24', null);
INSERT INTO `company_taxation` VALUES ('8', '90decbf4-d367-43af-99ae-f2c07120a91c', 'EWT', '5% EWT on Rental', '5', '2020-09-16 14:41:32', '2020-09-16 14:57:38', null);
INSERT INTO `company_taxation` VALUES ('9', 'a4cb9445-92b0-4819-8a35-b7f358745ea0', 'EWT', '10% EWT on Others', '10', '2020-09-16 14:41:59', '2020-09-16 14:57:49', null);

-- ----------------------------
-- Table structure for company_taxation_item
-- ----------------------------
DROP TABLE IF EXISTS `company_taxation_item`;
CREATE TABLE `company_taxation_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `tax_type` varchar(255) DEFAULT '',
  `tax_name` varchar(255) DEFAULT NULL,
  `shortname` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_taxation_item
-- ----------------------------
INSERT INTO `company_taxation_item` VALUES ('19', 'e6d858d0-869e-4db4-b61c-32304cf29047', 'VAT', 'VAT Sales', 'V', '2021-03-16 12:09:34', '2021-03-16 12:09:34', null);
INSERT INTO `company_taxation_item` VALUES ('20', '0280ee9d-cc92-4824-a738-25f953fd60b9', 'VAT', 'VAT Exempt Sales', 'X', '2021-03-16 12:11:03', '2021-03-16 12:11:03', null);
INSERT INTO `company_taxation_item` VALUES ('21', '0a834bb7-8e7e-41dd-be6e-22ae7cc858c2', 'VAT', 'VAT Zero-Rated Sales', 'Z', '2021-03-16 12:11:58', '2021-03-16 12:11:58', null);

-- ----------------------------
-- Table structure for cost_center
-- ----------------------------
DROP TABLE IF EXISTS `cost_center`;
CREATE TABLE `cost_center` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `cost_center_name` varchar(255) DEFAULT NULL,
  `cost_center_shortname` varchar(255) DEFAULT '',
  `is_group` int(11) DEFAULT NULL,
  `cost_center_group` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cost_center
-- ----------------------------
INSERT INTO `cost_center` VALUES ('2', 'c59bad9d-73c9-43b2-9668-b489e0afaee8', 'Administration', 'ADM', '1', 'Administration', '2020-09-16 09:40:30', '2020-10-15 11:42:16', null);
INSERT INTO `cost_center` VALUES ('3', '6eecfbe4-1d62-4a79-92f6-1c5018399f7d', 'Finance & Accounting', 'F&A', '1', 'Finance & Accounting', '2020-09-16 09:40:52', '2020-09-16 09:40:52', null);
INSERT INTO `cost_center` VALUES ('4', '146e104f-f97e-4d77-b135-9bd9948b30c7', 'Information Technology', 'IT', '1', 'Information Technology', '2020-09-16 09:41:11', '2020-09-16 09:41:11', null);
INSERT INTO `cost_center` VALUES ('5', 'e5cc65be-1f65-499e-b788-efbb50232d11', 'Supply Chain', 'SC', '1', 'Supply Chain', '2020-09-16 09:41:26', '2020-09-16 09:41:26', null);
INSERT INTO `cost_center` VALUES ('6', 'ce84e6a2-8a36-472a-8842-8c195b4dc334', 'Sales', 'SA', '1', 'Sales', '2020-09-16 09:41:46', '2020-09-16 09:41:46', null);
INSERT INTO `cost_center` VALUES ('7', '1d0a1e1a-477c-468f-a59d-808cc30262dd', 'Audit', 'AU', '1', 'Audit', '2020-09-16 09:42:03', '2020-09-16 09:42:03', null);
INSERT INTO `cost_center` VALUES ('8', 'b84f8ca4-58e7-44f9-a520-10e35c630568', 'Human Resource', 'HR', '1', 'Human Resource', '2020-09-16 09:42:24', '2020-09-16 09:42:24', null);
INSERT INTO `cost_center` VALUES ('9', '1f1c7fc2-36aa-4b15-9871-c1e2b6739402', 'Engineering', 'ENG', '1', 'Engineering', '2020-09-16 09:42:44', '2020-09-16 09:42:44', null);

-- ----------------------------
-- Table structure for customer_branch
-- ----------------------------
DROP TABLE IF EXISTS `customer_branch`;
CREATE TABLE `customer_branch` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `customer_uuid` varchar(255) DEFAULT '',
  `customer_name` varchar(255) DEFAULT '',
  `contact_person` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address_uuid` varchar(255) DEFAULT '',
  `email_address` varchar(255) DEFAULT '',
  `contact_no` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of customer_branch
-- ----------------------------

-- ----------------------------
-- Table structure for customer_chain
-- ----------------------------
DROP TABLE IF EXISTS `customer_chain`;
CREATE TABLE `customer_chain` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `chain` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of customer_chain
-- ----------------------------
INSERT INTO `customer_chain` VALUES ('12', '64d9d72a-3b58-4e20-ad31-957367c34e99', '7-ELEVEN', '2020-09-16 09:29:04', '2020-09-16 09:29:04', null);
INSERT INTO `customer_chain` VALUES ('13', 'a7a0cacc-8539-4518-8df2-da47e4ae2694', 'AFPCES', '2020-09-16 09:29:16', '2020-09-16 09:29:16', null);
INSERT INTO `customer_chain` VALUES ('14', '4b037a76-10de-405e-a378-87641742de35', 'ALLHOME CORP', '2020-09-16 09:29:31', '2020-09-16 09:29:31', null);
INSERT INTO `customer_chain` VALUES ('15', '427dc7c3-4a82-41dd-a77a-0e337faff1eb', 'CALTEX MARTS', '2020-09-16 09:29:51', '2020-09-16 09:29:51', null);
INSERT INTO `customer_chain` VALUES ('16', '7a8d4f67-816d-4e2b-a39e-14976eb8d6fd', 'GAISANO BROS-CDO', '2020-09-16 09:30:22', '2020-09-16 09:30:22', null);
INSERT INTO `customer_chain` VALUES ('17', '124940f2-df39-4177-b6e5-316452d4bf9c', 'GAISANO BROS-DSG', '2020-09-16 09:30:29', '2020-09-16 09:30:29', null);
INSERT INTO `customer_chain` VALUES ('18', '28103bbd-17d5-4ce2-8dbf-d1a829b923fb', 'GAISANO BROTHERS', '2020-09-16 09:30:37', '2020-09-16 09:30:37', null);
INSERT INTO `customer_chain` VALUES ('19', 'faf4f07b-3547-4db6-af7d-cab1fc3f8201', 'GAISANO CAPITAL', '2020-09-16 09:30:44', '2020-09-16 09:30:44', null);
INSERT INTO `customer_chain` VALUES ('20', 'd5485273-0513-4573-9539-866fb0f97524', 'GAISANO GRAND', '2020-09-16 09:30:52', '2020-09-16 09:30:52', null);
INSERT INTO `customer_chain` VALUES ('21', '03ccada5-1e77-466a-936d-2ccd17d9b9a5', 'KCC', '2020-09-16 09:31:08', '2020-09-16 09:31:08', null);
INSERT INTO `customer_chain` VALUES ('22', 'e9ec8540-7e4c-4dd9-9da4-28056e0ee283', 'MERCURY DRUG CORP.', '2020-09-16 09:31:27', '2020-09-16 09:31:27', null);
INSERT INTO `customer_chain` VALUES ('23', 'd1c4868e-63ae-4bba-829f-4dee13ba6ec1', 'MERRYMART GROCERY', '2020-09-16 09:31:39', '2020-09-16 09:31:39', null);
INSERT INTO `customer_chain` VALUES ('24', 'b2d3f6b9-7968-4124-83f5-28b0f8c500b1', 'METRO GAISANO', '2020-09-16 09:31:47', '2020-09-16 09:31:47', null);
INSERT INTO `customer_chain` VALUES ('25', '42dc0606-7b09-4f6d-bb50-806c482074e6', 'NCCC', '2020-09-16 09:31:58', '2020-09-16 09:31:58', null);
INSERT INTO `customer_chain` VALUES ('26', '160c0944-c464-420f-b4ff-e4175049412d', 'ORORAMA', '2020-09-16 09:32:06', '2020-09-16 09:32:06', null);
INSERT INTO `customer_chain` VALUES ('27', '988a024b-5756-4cd6-8270-5f083ab59c5e', 'PRINCE RETAIL GROUP', '2020-09-16 09:32:19', '2020-09-16 09:32:19', null);
INSERT INTO `customer_chain` VALUES ('28', '1da9724d-525d-49f8-aa1b-31bd047f4394', 'PUREGOLD (w/ AYAGOLD,EUNI,PARCO,NE,BUDGETLANE)', '2020-09-16 09:32:30', '2020-09-16 09:32:30', null);
INSERT INTO `customer_chain` VALUES ('29', '35a294f0-e1b5-4f99-b17c-19f1cf790937', 'ROBINSON\'S DEPT STORE', '2020-09-16 09:32:46', '2020-09-16 09:32:46', null);
INSERT INTO `customer_chain` VALUES ('30', '359a322a-015e-49a4-a1d3-8acfe6c91393', 'ROBINSON\'S SUPERMARKET CORP (w/ EZ,JAYNITH)', '2020-09-16 09:32:54', '2020-09-16 09:32:54', null);
INSERT INTO `customer_chain` VALUES ('31', '08bb4432-5ff4-4763-8b8f-d71ddb7d915a', 'ROSE PHARMACY INC.', '2020-09-16 09:33:16', '2020-09-16 09:33:16', null);
INSERT INTO `customer_chain` VALUES ('32', 'c599654a-b14a-40b5-bcb0-fccb8edc125c', 'SHELL MARTS', '2020-09-16 09:33:28', '2020-09-16 09:33:28', null);
INSERT INTO `customer_chain` VALUES ('33', '5805e8ea-9cad-4c54-bfe9-d18a02bd218b', 'SHOPPE24 CONVENIENCE STORE', '2020-09-16 09:33:40', '2020-09-16 09:33:40', null);
INSERT INTO `customer_chain` VALUES ('34', '665dfca6-9071-4f68-ba20-5cd1d216cd5e', 'SHOPWISE/RUSTAN\'S/WELLCOME', '2020-09-16 09:33:48', '2020-09-16 09:33:48', null);
INSERT INTO `customer_chain` VALUES ('35', '21e0ef75-79ad-4236-ae9e-6cc88bb883de', 'SM SNACK EX', '2020-09-16 09:33:59', '2020-09-16 09:33:59', null);
INSERT INTO `customer_chain` VALUES ('36', '9016bd2f-fb4a-4060-959e-12ba572ca4ed', 'SOUTHSTAR DRUG INC.', '2020-09-16 09:34:13', '2020-09-16 09:34:13', null);
INSERT INTO `customer_chain` VALUES ('37', '5e87bc06-e14c-4fa6-8cdc-f091b56de167', 'SUPERVALUE INC/SANFORD (SVI)', '2020-09-16 09:34:24', '2020-09-16 09:34:24', null);
INSERT INTO `customer_chain` VALUES ('38', '70b403b7-1738-438d-b4d5-482ff4c16735', 'SUY SING', '2020-09-16 09:34:31', '2020-09-16 09:34:31', null);
INSERT INTO `customer_chain` VALUES ('39', '3b0a5045-25d8-4a83-b330-5aabd1379c53', 'WALTERMART', '2020-09-16 09:34:45', '2020-09-16 09:34:45', null);
INSERT INTO `customer_chain` VALUES ('40', 'c2017de6-7dd6-4e04-a58c-5b589d25a389', 'WATSONS', '2020-09-16 09:34:51', '2020-09-16 09:34:51', null);
INSERT INTO `customer_chain` VALUES ('41', '6827f56e-68cb-41d7-81d7-d50d602649c7', 'LANDMARK', '2020-09-16 09:35:12', '2020-09-16 09:35:12', null);
INSERT INTO `customer_chain` VALUES ('42', '40a119d5-3b13-4c3e-9d9d-259d251c59eb', 'test2', '2021-03-17 10:09:35', '2021-03-17 10:09:48', null);

-- ----------------------------
-- Table structure for customer_channel
-- ----------------------------
DROP TABLE IF EXISTS `customer_channel`;
CREATE TABLE `customer_channel` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `channel` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of customer_channel
-- ----------------------------
INSERT INTO `customer_channel` VALUES ('6', '53a869a8-e373-44a6-9ba1-e39ecbc91214', 'Supermarket', '2020-09-16 09:37:32', '2020-09-16 09:37:32', null);
INSERT INTO `customer_channel` VALUES ('7', 'b3968b64-8519-4eae-92bc-b2f7a9c47709', 'Sari-sari Store', '2020-09-16 09:37:41', '2020-09-16 09:37:41', null);
INSERT INTO `customer_channel` VALUES ('8', '39a745d8-2469-4db3-8aa9-70f993821091', 'Convenience', '2020-09-16 09:37:47', '2020-09-16 09:37:47', null);
INSERT INTO `customer_channel` VALUES ('9', '088f5a86-a384-49f0-8d18-08ea9a6d627c', 'Household', '2020-09-16 09:37:52', '2020-09-16 09:37:52', null);
INSERT INTO `customer_channel` VALUES ('10', '383c8417-f9cb-4ac7-8fd9-9d79d978cff7', 'Construction', '2020-09-16 09:38:13', '2020-09-16 09:38:13', null);
INSERT INTO `customer_channel` VALUES ('11', '354131e7-da51-428f-a663-1e8c1c247a5c', 'test3', '2021-03-17 10:10:00', '2021-03-17 10:10:07', null);

-- ----------------------------
-- Table structure for customer_discount_regular
-- ----------------------------
DROP TABLE IF EXISTS `customer_discount_regular`;
CREATE TABLE `customer_discount_regular` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `customer_uuid` varchar(255) DEFAULT NULL,
  `discount_name` varchar(255) DEFAULT '',
  `discount_rate` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of customer_discount_regular
-- ----------------------------

-- ----------------------------
-- Table structure for customer_group
-- ----------------------------
DROP TABLE IF EXISTS `customer_group`;
CREATE TABLE `customer_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT '',
  `markup_rate` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of customer_group
-- ----------------------------
INSERT INTO `customer_group` VALUES ('3', '140e6a36-662a-478b-a6c3-b0ac9ff591d3', 'Supermarket', '2.00', '2021-03-06 01:31:25', '2021-03-06 01:33:12', null);
INSERT INTO `customer_group` VALUES ('4', 'cae7088f-0489-4554-81ff-32986edd3f3d', 'Wholesale', '1.00', '2021-03-06 01:32:14', '2021-03-06 01:33:21', null);
INSERT INTO `customer_group` VALUES ('5', '9a2509db-ceb6-450e-b7ef-34684d58f03a', 'Hardware', '3.00', '2021-03-06 01:32:58', '2021-03-06 01:32:58', null);
INSERT INTO `customer_group` VALUES ('6', '41ccee77-be8e-4510-a868-25433d8a6f24', 'Construction', '5.00', '2021-03-06 01:33:34', '2021-03-06 01:33:34', null);

-- ----------------------------
-- Table structure for customer_list
-- ----------------------------
DROP TABLE IF EXISTS `customer_list`;
CREATE TABLE `customer_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT '',
  `business_shortname` varchar(255) DEFAULT '',
  `tax_id_no` varchar(255) DEFAULT '',
  `customer_group_uuid` varchar(255) DEFAULT NULL,
  `customer_chain_uuid` varchar(255) DEFAULT '',
  `customer_channel_uuid` varchar(255) DEFAULT '',
  `customer_type_uuid` varchar(255) DEFAULT '',
  `cost_center_uuid` varchar(255) DEFAULT '',
  `vat_uuid` varchar(255) DEFAULT NULL,
  `payment_term_uuid` varchar(255) DEFAULT '',
  `coa_receivable_account_uuid` varchar(255) DEFAULT '',
  `is_applied_vat` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `email` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `address_uuid` varchar(255) DEFAULT '',
  `address1` varchar(255) DEFAULT NULL,
  `base_discount` decimal(10,0) DEFAULT NULL,
  `logistic_discount` decimal(10,0) DEFAULT NULL,
  `term_discount` decimal(10,0) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of customer_list
-- ----------------------------
INSERT INTO `customer_list` VALUES ('8', 'e53e1a09-d818-48a2-9336-23c08e087775', 'UNIPACE CORPORATION', 'UNIPACE CORPORATION', '000-000-000-000', '140e6a36-662a-478b-a6c3-b0ac9ff591d3', '7a8d4f67-816d-4e2b-a39e-14976eb8d6fd', '53a869a8-e373-44a6-9ba1-e39ecbc91214', '01dcb9da-a987-492e-88e9-e26f34e4e4c2', 'ce84e6a2-8a36-472a-8842-8c195b4dc334', '1e1fc3e0-6431-4597-a811-c4895057667d', '2da5250d-98ee-46c3-ab62-596c96432ba9', '0d94b076-3cab-4006-a86a-96910d0c8009', null, '1', 'accounting@unipace.com', 'Miss A', '09101234567', '3cb15a43-2835-4ce8-9434-2d62b422cd4f', 'Corrales ext.', '1', '1', '1', '2021-04-05 23:48:00', '2021-04-05 23:48:00', null);
INSERT INTO `customer_list` VALUES ('9', '1c90f826-c679-4cd7-8e64-26d3ebba9392', 'ORORAMA SUPERCENTER, INC.', 'ORORAMA', '000-000-000-000', '140e6a36-662a-478b-a6c3-b0ac9ff591d3', '160c0944-c464-420f-b4ff-e4175049412d', '53a869a8-e373-44a6-9ba1-e39ecbc91214', '01dcb9da-a987-492e-88e9-e26f34e4e4c2', 'ce84e6a2-8a36-472a-8842-8c195b4dc334', '1e1fc3e0-6431-4597-a811-c4895057667d', '2da5250d-98ee-46c3-ab62-596c96432ba9', '0d94b076-3cab-4006-a86a-96910d0c8009', null, '1', 'accounting@ororama.com', 'Miss J', '09124563214', '662b18d4-1c97-41cd-a8fa-c07c30985e64', 'Jr borja st., cogon', '1', null, null, '2021-04-06 01:14:32', '2021-04-06 01:14:32', null);
INSERT INTO `customer_list` VALUES ('10', '3beb2900-1cfd-4189-9008-994edc51cba7', 'AFPCES', 'AFPCES', '000-000-000-000', '140e6a36-662a-478b-a6c3-b0ac9ff591d3', 'a7a0cacc-8539-4518-8df2-da47e4ae2694', '53a869a8-e373-44a6-9ba1-e39ecbc91214', '01dcb9da-a987-492e-88e9-e26f34e4e4c2', 'ce84e6a2-8a36-472a-8842-8c195b4dc334', null, '0b71eeb6-3f03-41f2-afbe-5db3a304609d', '0d94b076-3cab-4006-a86a-96910d0c8009', null, '1', 'cdo@afpces.gov.ph', 'Lt Gen', '09123654789', 'c1921889-c4cd-46b1-918b-b79b4f2b6666', null, null, null, null, '2021-04-06 01:17:13', '2021-04-06 01:17:13', null);

-- ----------------------------
-- Table structure for customer_type
-- ----------------------------
DROP TABLE IF EXISTS `customer_type`;
CREATE TABLE `customer_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `customer_type` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of customer_type
-- ----------------------------
INSERT INTO `customer_type` VALUES ('5', '01dcb9da-a987-492e-88e9-e26f34e4e4c2', 'Retail', '2020-09-16 09:38:55', '2020-09-16 09:38:55', null);
INSERT INTO `customer_type` VALUES ('6', 'd5ef7c49-f54c-4273-8c34-4681741e0fc2', 'Wholesale', '2020-09-16 09:39:02', '2020-09-16 09:39:02', null);
INSERT INTO `customer_type` VALUES ('7', '32abf4c4-aac0-48fd-8b41-2689d6732a72', 'Walk-in', '2020-09-16 09:39:09', '2020-09-16 09:39:09', null);
INSERT INTO `customer_type` VALUES ('8', '184ffc65-15ef-4b3c-bed6-d76707bcd5f3', 'test4', '2021-03-17 10:10:17', '2021-03-17 10:10:24', null);

-- ----------------------------
-- Table structure for employee_employment_status
-- ----------------------------
DROP TABLE IF EXISTS `employee_employment_status`;
CREATE TABLE `employee_employment_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `employment_status` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of employee_employment_status
-- ----------------------------
INSERT INTO `employee_employment_status` VALUES ('9', '6c472412-fada-4f08-8323-52de5844133c', 'Regular', '2020-10-16 08:33:02', '2020-10-16 08:33:02', null);
INSERT INTO `employee_employment_status` VALUES ('10', '47a1e439-fb92-4c56-94c9-c26f04f5f352', 'Probationary', '2020-10-16 08:34:09', '2020-10-16 08:34:09', null);
INSERT INTO `employee_employment_status` VALUES ('11', '91ad81dc-8258-40c8-9e52-0badf660e472', 'Contractual', '2020-10-16 08:34:20', '2020-10-16 08:34:20', null);
INSERT INTO `employee_employment_status` VALUES ('12', '37966a7e-cf1c-49b4-b72c-0d500f35604d', 'On Call', '2020-10-16 08:34:33', '2020-10-16 08:34:33', null);

-- ----------------------------
-- Table structure for employee_employment_type
-- ----------------------------
DROP TABLE IF EXISTS `employee_employment_type`;
CREATE TABLE `employee_employment_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `employment_type` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of employee_employment_type
-- ----------------------------
INSERT INTO `employee_employment_type` VALUES ('8', '10fd00fd-ccef-40ee-9311-527c1c77dfeb', 'Direct Hire', '2020-10-14 14:43:45', '2020-10-16 08:33:40', null);
INSERT INTO `employee_employment_type` VALUES ('9', '55018c6f-0e69-42d5-9b42-e42fd87490aa', 'Agency', '2020-10-16 08:33:50', '2020-10-16 08:33:50', null);

-- ----------------------------
-- Table structure for employee_list
-- ----------------------------
DROP TABLE IF EXISTS `employee_list`;
CREATE TABLE `employee_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `emp_id` varchar(255) DEFAULT '',
  `first_name` varchar(255) DEFAULT '',
  `middle_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) DEFAULT '',
  `ext` varchar(255) DEFAULT NULL,
  `branch_uuid` varchar(255) DEFAULT NULL,
  `branch_location_uuid` varchar(255) DEFAULT '',
  `is_custodian` int(11) DEFAULT NULL,
  `is_driver` int(11) DEFAULT NULL,
  `is_system_user` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT '',
  `contact_no` varchar(255) DEFAULT '',
  `emergency_contact` varchar(255) DEFAULT '',
  `contact_relation` varchar(255) DEFAULT '',
  `emergency_contact_no` varchar(255) DEFAULT '',
  `employment_type_uuid` varchar(255) DEFAULT '',
  `date_hired` date DEFAULT NULL,
  `date_regularized` date DEFAULT NULL,
  `date_separated` date DEFAULT NULL,
  `is_min_wage` varchar(255) DEFAULT '',
  `daily_wage` varchar(255) DEFAULT '',
  `cost_center_uuid` varchar(255) DEFAULT '',
  `tax_id` varchar(255) DEFAULT NULL,
  `sss_id` varchar(255) DEFAULT NULL,
  `phic_id` varchar(255) DEFAULT NULL,
  `hdmf_id` varchar(255) DEFAULT NULL,
  `address_uuid` varchar(255) DEFAULT '',
  `address1` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `department_uuid` varchar(255) DEFAULT '',
  `is_supervisor` int(11) DEFAULT NULL,
  `supervisor_emp_uuid` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `employment_status_uuid` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of employee_list
-- ----------------------------
INSERT INTO `employee_list` VALUES ('7', '823410bb-ebcc-4bb1-ba39-ec7e295d1c13', '1', '10001', 'KENNETH', '', 'CASTILLO', '', 'f224cc74-a36c-4f60-b5c3-28ac5caf5373', 'fd21314d-a2a0-431e-bfb7-45cf1cc6cdc2', '0', '0', '1', '1', 'account@hexa.ph', '09088188165', '', '', '', '55018c6f-0e69-42d5-9b42-e42fd87490aa', '2021-03-31', '0000-00-00', '0000-00-00', '0', 'null', 'c59bad9d-73c9-43b2-9668-b489e0afaee8', '', '', '', '', 'c1921889-c4cd-46b1-918b-b79b4f2b6666', 'MOUNTAIN VIEW HOMES', 'ACCOUNTANT', 'fac9b625-f5e3-4cec-aabb-f00045c86e01', '1', 'undefined', '0000-00-00', '91ad81dc-8258-40c8-9e52-0badf660e472', 'MALE', '823410bb-ebcc-4bb1-ba39-ec7e295d1c13.jpg', '2021-03-05 08:55:35', '2021-05-12 19:12:36', null);
INSERT INTO `employee_list` VALUES ('9', '929ade5d-2791-456a-93a2-1348ebf43524', '1', '1', 'SILVESTERS', 'ROLLORATA', 'AMPER', '', 'f224cc74-a36c-4f60-b5c3-28ac5caf5373', '8f4bb063-f058-4d6e-85c5-0e7dcac11fc1', '1', '1', '1', '1', 'paul.amper@hexa.ph', '09088188165', '', '', '', '55018c6f-0e69-42d5-9b42-e42fd87490aa', '0000-00-00', '0000-00-00', '0000-00-00', '1', '123', 'c59bad9d-73c9-43b2-9668-b489e0afaee8', '', '', '', '', '69bc1dba-d005-469c-9853-6e69eecbcb74', '', 'SALES', 'fac9b625-f5e3-4cec-aabb-f00045c86e01', '1', '823410bb-ebcc-4bb1-ba39-ec7e295d1c13', '2021-03-13', '91ad81dc-8258-40c8-9e52-0badf660e472', 'MALE', null, '2021-03-13 08:07:16', '2021-05-05 06:13:28', null);

-- ----------------------------
-- Table structure for employee_system_invitations
-- ----------------------------
DROP TABLE IF EXISTS `employee_system_invitations`;
CREATE TABLE `employee_system_invitations` (
  `id` bigint(20) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `employee_uuid` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of employee_system_invitations
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for global_uom
-- ----------------------------
DROP TABLE IF EXISTS `global_uom`;
CREATE TABLE `global_uom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of global_uom
-- ----------------------------
INSERT INTO `global_uom` VALUES ('1', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', 'Pc', 'Base', '2020-09-02 04:33:04', '2020-09-02 04:33:04', null);
INSERT INTO `global_uom` VALUES ('2', 'a8186e47-9028-4ade-90bc-aad2c66d0c7b', 'Kg', 'Base', '2020-09-02 04:34:06', '2020-09-02 04:34:06', null);
INSERT INTO `global_uom` VALUES ('3', '294eb0c0-bede-414e-8d59-d17b7293c424', 'Liters', 'Base', '2020-09-02 04:34:45', '2020-09-02 04:34:45', null);
INSERT INTO `global_uom` VALUES ('4', '29ac13a3-edd0-4575-8bea-85e5a5b6abad', 'Cs', 'Pack', '2020-09-02 12:38:50', '2020-09-02 04:42:42', null);
INSERT INTO `global_uom` VALUES ('5', '20575c31-a69f-48fc-96ae-38057748b76b', 'Box', 'Pack', '2020-09-02 04:35:42', '2020-09-02 04:35:42', null);

-- ----------------------------
-- Table structure for item_asset_group
-- ----------------------------
DROP TABLE IF EXISTS `item_asset_group`;
CREATE TABLE `item_asset_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `asset_group` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_asset_group
-- ----------------------------
INSERT INTO `item_asset_group` VALUES ('5', '6edd5ecd-67e1-42b7-8225-664f59f75264', 'Motor Vehicle', '2020-09-16 15:45:14', '2020-09-16 15:45:14', null);
INSERT INTO `item_asset_group` VALUES ('6', '0d9f4dad-d0ac-4051-9589-745aeb17362b', 'Office Equipment', '2020-09-16 15:45:23', '2020-09-16 15:45:23', null);
INSERT INTO `item_asset_group` VALUES ('7', '0a71c324-9566-40c8-afc9-86317c6590e5', 'Furniture and Fixture', '2020-09-16 15:45:32', '2020-09-16 15:45:32', null);

-- ----------------------------
-- Table structure for item_cat_brand
-- ----------------------------
DROP TABLE IF EXISTS `item_cat_brand`;
CREATE TABLE `item_cat_brand` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_cat_brand
-- ----------------------------
INSERT INTO `item_cat_brand` VALUES ('9', '5dc21b7b-95a0-4de4-821a-a87e777e202b', 'Ariel', '2020-10-13 05:23:17', '2020-10-13 05:23:17', null);
INSERT INTO `item_cat_brand` VALUES ('10', 'a271f458-59ab-419a-8c1f-8bc0779724cf', 'Tide', '2020-10-13 05:23:24', '2020-10-13 05:23:24', null);
INSERT INTO `item_cat_brand` VALUES ('11', '175a486a-f2d2-41e2-bae9-87f5639a7c7e', 'M&M\'s', '2020-10-13 05:23:34', '2020-10-13 05:23:34', null);
INSERT INTO `item_cat_brand` VALUES ('12', 'a0ab0577-e45b-4083-b34d-87a76093a29d', 'Snickers', '2020-10-13 05:23:44', '2020-10-13 05:23:44', null);
INSERT INTO `item_cat_brand` VALUES ('13', 'a0c99f01-8c2e-43cd-90b9-8f45df65b9ad', 'Doublemint', '2020-10-13 05:23:52', '2020-10-13 05:23:52', null);

-- ----------------------------
-- Table structure for item_cat_category
-- ----------------------------
DROP TABLE IF EXISTS `item_cat_category`;
CREATE TABLE `item_cat_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_cat_category
-- ----------------------------
INSERT INTO `item_cat_category` VALUES ('9', '3719ac20-b7ec-4386-b386-81300d034037', 'Laundry', '2020-10-13 05:20:55', '2020-10-13 05:20:55', null);
INSERT INTO `item_cat_category` VALUES ('10', '431e96b1-88eb-412e-8518-90d2d09cc31b', 'Haircare', '2020-10-13 05:21:03', '2020-10-13 05:21:03', null);
INSERT INTO `item_cat_category` VALUES ('11', 'ad7ece9d-51b2-4c69-8711-be894ed45202', 'Bakery', '2020-10-13 05:21:12', '2020-10-13 05:21:12', null);
INSERT INTO `item_cat_category` VALUES ('12', 'dc379d91-b0e0-4451-bd0c-f9617feb8a33', 'Ladies', '2020-10-13 05:21:22', '2020-10-13 05:21:22', null);
INSERT INTO `item_cat_category` VALUES ('13', 'a0ad2163-c9bc-483d-ac24-c692bb01436e', 'Mens', '2020-10-13 05:21:33', '2020-10-13 05:21:33', null);
INSERT INTO `item_cat_category` VALUES ('14', '5b8c0177-a6f7-4d08-a936-5c1887a29be2', 'Infants', '2020-10-13 05:21:43', '2020-10-13 05:21:43', null);
INSERT INTO `item_cat_category` VALUES ('15', 'e55d1bad-051b-4249-8302-ed71dbd31717', 'Kids', '2020-10-13 05:21:51', '2020-10-13 05:21:51', null);
INSERT INTO `item_cat_category` VALUES ('16', '394c1ef1-9ebe-4d81-9ad1-515153151120', 'Teens', '2020-10-13 05:21:59', '2020-10-13 05:21:59', null);

-- ----------------------------
-- Table structure for item_cat_department
-- ----------------------------
DROP TABLE IF EXISTS `item_cat_department`;
CREATE TABLE `item_cat_department` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_cat_department
-- ----------------------------
INSERT INTO `item_cat_department` VALUES ('9', '381a54eb-7940-47ae-b031-818a833b9cb0', 'Department Store', '2020-10-13 05:16:28', '2020-10-13 05:16:28', null);
INSERT INTO `item_cat_department` VALUES ('10', '9e0520d5-6800-4f91-929d-4a4d7176a55f', 'Supermarket', '2020-10-13 05:16:37', '2020-10-13 05:16:37', null);
INSERT INTO `item_cat_department` VALUES ('11', 'dac2b5c8-1e3a-44ac-8271-92e2a65e8d5c', 'Hardware', '2020-10-13 05:19:30', '2020-10-13 05:19:30', null);
INSERT INTO `item_cat_department` VALUES ('12', '10bf87f0-9a5f-4021-a73c-0d9e17e55e27', 'School Supply', '2020-10-13 05:19:38', '2020-10-13 05:19:38', null);

-- ----------------------------
-- Table structure for item_cat_form
-- ----------------------------
DROP TABLE IF EXISTS `item_cat_form`;
CREATE TABLE `item_cat_form` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `form` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_cat_form
-- ----------------------------
INSERT INTO `item_cat_form` VALUES ('9', 'b15d8c98-7089-4f02-ba47-4824a31123a2', 'Powder', '2020-10-13 05:24:02', '2020-10-13 05:24:02', null);
INSERT INTO `item_cat_form` VALUES ('10', '4438301b-d073-4859-8867-7f874d4dfc99', 'Bar', '2020-10-13 05:24:10', '2020-10-13 05:24:10', null);
INSERT INTO `item_cat_form` VALUES ('11', 'cc97382d-aab6-443a-94cb-76839e5b3d6f', 'Chocolate', '2020-10-13 05:24:17', '2020-10-13 05:24:17', null);
INSERT INTO `item_cat_form` VALUES ('12', '478ca56b-c3e2-42da-938a-1ef15f5e3c8c', 'Gums', '2020-10-13 05:24:27', '2020-10-13 05:24:27', null);

-- ----------------------------
-- Table structure for item_cat_item_type
-- ----------------------------
DROP TABLE IF EXISTS `item_cat_item_type`;
CREATE TABLE `item_cat_item_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `item_type` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_cat_item_type
-- ----------------------------
INSERT INTO `item_cat_item_type` VALUES ('9', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', 'Regular', '2020-10-13 05:22:48', '2020-10-13 05:22:48', null);
INSERT INTO `item_cat_item_type` VALUES ('10', '41b943db-187b-4311-b2b3-8f1fb591f443', 'Promotional', '2020-10-13 05:22:56', '2020-10-13 05:22:56', null);
INSERT INTO `item_cat_item_type` VALUES ('11', 'd3887d83-e760-442e-aae6-9904a6c73e06', 'Seasonal', '2020-10-13 05:23:04', '2020-10-13 05:23:04', null);

-- ----------------------------
-- Table structure for item_cat_manufacturer
-- ----------------------------
DROP TABLE IF EXISTS `item_cat_manufacturer`;
CREATE TABLE `item_cat_manufacturer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_cat_manufacturer
-- ----------------------------
INSERT INTO `item_cat_manufacturer` VALUES ('9', '8be85200-2ec9-4b79-98b9-1fa34184e8f0', 'P&G', '2020-10-13 05:22:12', '2020-10-13 05:22:12', null);
INSERT INTO `item_cat_manufacturer` VALUES ('10', '76b053ad-ee24-4264-9ef2-35f8fefbec89', 'Unilever', '2020-10-13 05:22:22', '2020-10-13 05:22:22', null);
INSERT INTO `item_cat_manufacturer` VALUES ('11', '018dd910-4af4-46d8-90c2-dac2d285c0d7', 'Mars', '2020-10-13 05:22:31', '2020-10-13 05:22:31', null);
INSERT INTO `item_cat_manufacturer` VALUES ('12', 'c318702c-acc1-4b85-adee-67f23acef014', 'Wrigley', '2020-10-13 05:22:38', '2020-10-13 05:22:38', null);

-- ----------------------------
-- Table structure for item_cat_packing_type
-- ----------------------------
DROP TABLE IF EXISTS `item_cat_packing_type`;
CREATE TABLE `item_cat_packing_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `packing_type` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_cat_packing_type
-- ----------------------------
INSERT INTO `item_cat_packing_type` VALUES ('9', '3fc3e8ac-1e31-4dda-9291-fd61b46a4702', 'Bag', '2020-10-13 05:24:46', '2020-10-13 05:24:46', null);
INSERT INTO `item_cat_packing_type` VALUES ('10', '9b4a187e-8877-4c73-893c-cddb0ddde403', 'Bottles', '2020-10-13 05:24:54', '2020-10-13 05:24:54', null);
INSERT INTO `item_cat_packing_type` VALUES ('11', '0dbfbfbd-c167-460d-9f98-e002d5316f7f', 'Sachet', '2020-10-13 05:25:02', '2020-10-13 05:25:02', null);
INSERT INTO `item_cat_packing_type` VALUES ('12', '4ba87a2e-35fe-423a-8b98-001eb50504c3', 'Sack', '2020-10-13 05:25:09', '2020-10-13 05:25:09', null);

-- ----------------------------
-- Table structure for item_cat_section
-- ----------------------------
DROP TABLE IF EXISTS `item_cat_section`;
CREATE TABLE `item_cat_section` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_cat_section
-- ----------------------------
INSERT INTO `item_cat_section` VALUES ('9', 'a5fd5c1e-2419-4f17-9f95-69b0e01a1608', 'Dry Goods', '2020-10-13 05:19:52', '2020-10-13 05:19:52', null);
INSERT INTO `item_cat_section` VALUES ('10', 'cb7df288-ef34-49e3-8b2f-0e1f72abf33f', 'Sports Equipment', '2020-10-13 05:20:04', '2020-10-13 05:20:04', null);
INSERT INTO `item_cat_section` VALUES ('11', '4606de22-5c3d-4e07-9be0-0bcab3c5109d', 'Food', '2020-10-13 05:20:14', '2020-10-13 05:20:14', null);
INSERT INTO `item_cat_section` VALUES ('12', 'b992035f-1b18-4c04-bbdc-255eb909eb58', 'Non-Food', '2020-10-13 05:20:23', '2020-10-13 05:20:23', null);
INSERT INTO `item_cat_section` VALUES ('13', '5e9aa710-d7d2-4f24-8c12-3981a75d6fe1', 'Imported', '2020-10-13 05:20:31', '2020-10-13 05:20:31', null);
INSERT INTO `item_cat_section` VALUES ('14', '3cd2f698-ae2b-4ce7-b65a-ebffcb0e556d', 'Construction Materials', '2020-10-13 05:20:40', '2020-10-13 05:20:40', null);

-- ----------------------------
-- Table structure for item_group
-- ----------------------------
DROP TABLE IF EXISTS `item_group`;
CREATE TABLE `item_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `item_group` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_group
-- ----------------------------
INSERT INTO `item_group` VALUES ('7', '71a97981-c6ad-4d84-a360-b881991a5818', 'Inventory', '2020-09-16 15:44:32', '2020-09-16 15:44:32', null);
INSERT INTO `item_group` VALUES ('8', '08f9498a-8aa3-447a-90df-c7b78fb22a5c', 'Asset', '2020-09-16 15:44:41', '2020-09-16 15:44:41', null);
INSERT INTO `item_group` VALUES ('9', '6049a693-c7e1-4559-aab5-3153dcab8509', 'Service', '2020-09-16 15:44:56', '2020-09-16 15:44:56', null);

-- ----------------------------
-- Table structure for item_list
-- ----------------------------
DROP TABLE IF EXISTS `item_list`;
CREATE TABLE `item_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `item_group_uuid` varchar(255) DEFAULT '',
  `item_code` varchar(255) DEFAULT '',
  `item_barcode` varchar(255) DEFAULT NULL,
  `global_base_uom_uuid` varchar(255) DEFAULT '',
  `item_description` varchar(255) DEFAULT '',
  `item_shortname` varchar(255) DEFAULT NULL,
  `is_purchase_item` int(11) DEFAULT NULL,
  `is_sales_item` int(11) DEFAULT NULL,
  `sales_price` decimal(10,2) DEFAULT NULL,
  `is_expiry` int(11) DEFAULT NULL,
  `is_maintain_stock` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `coa_income_account_uuid` varchar(255) DEFAULT NULL,
  `coa_cos_account_uuid` varchar(255) DEFAULT NULL,
  `ico` int(11) DEFAULT NULL,
  `item_asset_group_uuid` varchar(255) DEFAULT '',
  `vat_uuid` varchar(255) DEFAULT NULL,
  `cat_department_uuid` varchar(255) DEFAULT '',
  `cat_section_uuid` varchar(255) DEFAULT '',
  `cat_category_uuid` varchar(255) DEFAULT '',
  `cat_manufacturer_uuid` varchar(255) DEFAULT '',
  `cat_item_type_uuid` varchar(255) DEFAULT '',
  `cat_brand_uuid` varchar(255) DEFAULT NULL,
  `cat_form_uuid` varchar(255) DEFAULT NULL,
  `cat_packing_type_uuid` varchar(255) DEFAULT NULL,
  `cat_size` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_list
-- ----------------------------
INSERT INTO `item_list` VALUES ('52', '212df508-0c94-41c7-892d-74a50fc4e3d4', '71a97981-c6ad-4d84-a360-b881991a5818', '1', '1111111111111', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', 'Snickers Classic Singles 51gx24x8', 'Snickers Singles 51g', '1', '1', '1.00', '1', '1', '1', '58e1a793-3042-48bc-9d11-bf477a2929fa', 'd0dc6304-d978-41c7-9580-eccea73d1aca', '24', null, null, '9e0520d5-6800-4f91-929d-4a4d7176a55f', '5e9aa710-d7d2-4f24-8c12-3981a75d6fe1', 'ad7ece9d-51b2-4c69-8711-be894ed45202', '018dd910-4af4-46d8-90c2-dac2d285c0d7', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', 'a0ab0577-e45b-4083-b34d-87a76093a29d', 'cc97382d-aab6-443a-94cb-76839e5b3d6f', '3fc3e8ac-1e31-4dda-9291-fd61b46a4702', '', '2021-03-06 01:49:55', '2021-03-06 02:01:29', null);
INSERT INTO `item_list` VALUES ('53', '6df69b3b-2aa8-467b-a9af-25a99332a681', '71a97981-c6ad-4d84-a360-b881991a5818', '2', '2222222222222', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', 'SKITTLES Single Original Tube 30g 12sx10', 'SKITTLES Orig Tube 30g', '1', '1', '10.00', '1', '1', '1', '58e1a793-3042-48bc-9d11-bf477a2929fa', 'd0dc6304-d978-41c7-9580-eccea73d1aca', '12', null, null, '9e0520d5-6800-4f91-929d-4a4d7176a55f', '5e9aa710-d7d2-4f24-8c12-3981a75d6fe1', 'ad7ece9d-51b2-4c69-8711-be894ed45202', 'c318702c-acc1-4b85-adee-67f23acef014', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', 'a0c99f01-8c2e-43cd-90b9-8f45df65b9ad', '478ca56b-c3e2-42da-938a-1ef15f5e3c8c', '9b4a187e-8877-4c73-893c-cddb0ddde403', '', '2021-03-06 02:03:23', '2021-03-06 02:08:06', null);
INSERT INTO `item_list` VALUES ('54', '189d97c8-25db-4121-9ffe-55472a1a40ea', '71a97981-c6ad-4d84-a360-b881991a5818', '3', '3333333333333', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', 'Ariel Powder Matic 100gx10x10', 'Ariel Powder Matic 100g', '1', '1', '10.00', '0', '1', '1', '58e1a793-3042-48bc-9d11-bf477a2929fa', 'd0dc6304-d978-41c7-9580-eccea73d1aca', '100', null, null, '381a54eb-7940-47ae-b031-818a833b9cb0', 'b992035f-1b18-4c04-bbdc-255eb909eb58', '3719ac20-b7ec-4386-b386-81300d034037', '8be85200-2ec9-4b79-98b9-1fa34184e8f0', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', '5dc21b7b-95a0-4de4-821a-a87e777e202b', 'b15d8c98-7089-4f02-ba47-4824a31123a2', '3fc3e8ac-1e31-4dda-9291-fd61b46a4702', '', '2021-03-06 02:08:30', '2021-03-06 02:29:38', null);
INSERT INTO `item_list` VALUES ('55', '30c792d9-d658-46aa-b5c8-7fb0035634fc', '71a97981-c6ad-4d84-a360-b881991a5818', '4', '44444444444444', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', 'Tide Powder Jumbo 80gx100', 'Tide Pwd Jumbo 80g', '1', '1', '1.00', '0', '1', '1', '58e1a793-3042-48bc-9d11-bf477a2929fa', 'd0dc6304-d978-41c7-9580-eccea73d1aca', '100', null, null, '381a54eb-7940-47ae-b031-818a833b9cb0', 'b992035f-1b18-4c04-bbdc-255eb909eb58', '3719ac20-b7ec-4386-b386-81300d034037', '8be85200-2ec9-4b79-98b9-1fa34184e8f0', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', 'a271f458-59ab-419a-8c1f-8bc0779724cf', 'b15d8c98-7089-4f02-ba47-4824a31123a2', '3fc3e8ac-1e31-4dda-9291-fd61b46a4702', '', '2021-03-06 02:37:12', '2021-03-06 02:40:15', null);
INSERT INTO `item_list` VALUES ('56', '95346bc5-37e3-446f-a653-013dc646a052', '71a97981-c6ad-4d84-a360-b881991a5818', '5', '5555555555555', 'a8186e47-9028-4ade-90bc-aad2c66d0c7b', 'Rice Premium 50g', 'Rice Premium 50g', '1', '1', '50.00', '0', '1', '1', '58e1a793-3042-48bc-9d11-bf477a2929fa', 'd0dc6304-d978-41c7-9580-eccea73d1aca', '50', null, null, '9e0520d5-6800-4f91-929d-4a4d7176a55f', '4606de22-5c3d-4e07-9be0-0bcab3c5109d', 'ad7ece9d-51b2-4c69-8711-be894ed45202', '76b053ad-ee24-4264-9ef2-35f8fefbec89', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', '5dc21b7b-95a0-4de4-821a-a87e777e202b', 'b15d8c98-7089-4f02-ba47-4824a31123a2', '3fc3e8ac-1e31-4dda-9291-fd61b46a4702', '', '2021-03-06 02:40:59', '2021-03-06 02:47:09', null);
INSERT INTO `item_list` VALUES ('57', '0030611b-fcac-4ef6-96bf-c4f1dbfe0f9a', '71a97981-c6ad-4d84-a360-b881991a5818', '6', '6666666666666', 'a8186e47-9028-4ade-90bc-aad2c66d0c7b', 'Rice NFA 25kg', 'Rice NFA 25kg', '1', '1', '20.00', '0', '1', '1', '58e1a793-3042-48bc-9d11-bf477a2929fa', 'd0dc6304-d978-41c7-9580-eccea73d1aca', '25', null, null, '9e0520d5-6800-4f91-929d-4a4d7176a55f', '4606de22-5c3d-4e07-9be0-0bcab3c5109d', '3719ac20-b7ec-4386-b386-81300d034037', '8be85200-2ec9-4b79-98b9-1fa34184e8f0', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', '5dc21b7b-95a0-4de4-821a-a87e777e202b', 'b15d8c98-7089-4f02-ba47-4824a31123a2', '3fc3e8ac-1e31-4dda-9291-fd61b46a4702', '', '2021-03-06 02:47:30', '2021-03-06 02:49:27', null);
INSERT INTO `item_list` VALUES ('58', '7b421504-e18d-4dac-891f-3aba84fbc2f8', '71a97981-c6ad-4d84-a360-b881991a5818', '7', '7777777777777', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', 'M&M Milk Singles 40g', 'M&M Milk Singles 40g', '1', '1', '12.00', '1', '1', '1', '58e1a793-3042-48bc-9d11-bf477a2929fa', 'd0dc6304-d978-41c7-9580-eccea73d1aca', '24', null, null, '381a54eb-7940-47ae-b031-818a833b9cb0', 'a5fd5c1e-2419-4f17-9f95-69b0e01a1608', '3719ac20-b7ec-4386-b386-81300d034037', '8be85200-2ec9-4b79-98b9-1fa34184e8f0', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', '5dc21b7b-95a0-4de4-821a-a87e777e202b', 'b15d8c98-7089-4f02-ba47-4824a31123a2', '3fc3e8ac-1e31-4dda-9291-fd61b46a4702', '', '2021-03-13 08:24:28', '2021-03-13 08:28:46', null);
INSERT INTO `item_list` VALUES ('59', 'b9dc1fa9-1b4c-4ba2-a8e2-59e1f2a04fbb', '71a97981-c6ad-4d84-a360-b881991a5818', '8', '8888888888888', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', 'Doublemint Peppermint Pellet 10s', 'DM Pprmnt Pellet 10s', '1', '1', '2.00', '1', '1', '1', '8439f5c6-6b35-495b-a776-b18d30d704e1', 'd0dc6304-d978-41c7-9580-eccea73d1aca', '10', null, null, '381a54eb-7940-47ae-b031-818a833b9cb0', 'a5fd5c1e-2419-4f17-9f95-69b0e01a1608', '3719ac20-b7ec-4386-b386-81300d034037', '8be85200-2ec9-4b79-98b9-1fa34184e8f0', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', '5dc21b7b-95a0-4de4-821a-a87e777e202b', 'b15d8c98-7089-4f02-ba47-4824a31123a2', '3fc3e8ac-1e31-4dda-9291-fd61b46a4702', '', '2021-03-13 08:28:59', '2021-03-13 08:32:12', null);
INSERT INTO `item_list` VALUES ('60', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', '71a97981-c6ad-4d84-a360-b881991a5818', '9', '9999999999999', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', 'Anmum Plain 30g', 'Anmum Plain 30g', '1', '1', '15.00', '1', '1', '1', '58e1a793-3042-48bc-9d11-bf477a2929fa', 'd0dc6304-d978-41c7-9580-eccea73d1aca', '10', null, null, '381a54eb-7940-47ae-b031-818a833b9cb0', 'a5fd5c1e-2419-4f17-9f95-69b0e01a1608', '3719ac20-b7ec-4386-b386-81300d034037', '8be85200-2ec9-4b79-98b9-1fa34184e8f0', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', '5dc21b7b-95a0-4de4-821a-a87e777e202b', 'b15d8c98-7089-4f02-ba47-4824a31123a2', '3fc3e8ac-1e31-4dda-9291-fd61b46a4702', null, '2021-03-13 08:32:39', '2021-05-26 02:24:43', null);
INSERT INTO `item_list` VALUES ('61', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', '71a97981-c6ad-4d84-a360-b881991a5818', '10', '1000000000000', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', 'Anchor UHT 50ml', 'Anchor UHT 50ml', '1', '1', '12.00', '0', '0', '1', '8439f5c6-6b35-495b-a776-b18d30d704e1', 'd647dd28-3563-4f08-9a81-7afebe6451bd', '10', null, null, '381a54eb-7940-47ae-b031-818a833b9cb0', 'a5fd5c1e-2419-4f17-9f95-69b0e01a1608', '3719ac20-b7ec-4386-b386-81300d034037', '8be85200-2ec9-4b79-98b9-1fa34184e8f0', '548d5c32-c8f2-4aba-9b6d-bd7c2ee6dec9', '5dc21b7b-95a0-4de4-821a-a87e777e202b', 'b15d8c98-7089-4f02-ba47-4824a31123a2', '3fc3e8ac-1e31-4dda-9291-fd61b46a4702', null, '2021-03-13 08:37:56', '2021-05-25 07:18:11', null);

-- ----------------------------
-- Table structure for item_suppliers
-- ----------------------------
DROP TABLE IF EXISTS `item_suppliers`;
CREATE TABLE `item_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `item_uuid` varchar(255) NOT NULL,
  `supplier_uuid` varchar(255) NOT NULL,
  `bd_group_supplier_uuid` varchar(255) DEFAULT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_suppliers
-- ----------------------------
INSERT INTO `item_suppliers` VALUES ('1', '8c3061bc-f3db-4b2a-97f5-9cb8cddfdf92', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', '57fc0388-caf3-40a1-99c8-b5de0481493b', null, '29.00', '2021-05-25 07:18:11', '2021-05-25 07:18:11', null);
INSERT INTO `item_suppliers` VALUES ('2', '7a67c16d-7b96-4142-92ab-b09e98d9e6cf', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', '259d1fce-f549-4484-865d-004e1c3fd3da', null, '25.00', '2021-05-25 07:32:43', '2021-05-25 07:32:43', null);
INSERT INTO `item_suppliers` VALUES ('3', '5dbb9617-e142-4a63-bbde-0febfb75353b', 'f27b2cdf-08bf-4b7e-b00a-7c75726b5bee', '5d5d24b3-f48d-44e9-a8d0-e70d2d6e4106', null, '40.00', '2021-05-26 02:26:04', '2021-05-26 02:26:04', null);

-- ----------------------------
-- Table structure for item_uom
-- ----------------------------
DROP TABLE IF EXISTS `item_uom`;
CREATE TABLE `item_uom` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `item_uuid` varchar(255) DEFAULT '',
  `global_uom_uuid` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `packing_qtty` int(11) NOT NULL DEFAULT 0,
  `sales_description` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of item_uom
-- ----------------------------
INSERT INTO `item_uom` VALUES ('110', '618a94cc-ed6e-4562-8dbb-0fbaf85d9b72', '212df508-0c94-41c7-892d-74a50fc4e3d4', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', '1111111111111', '1', 'Snickers Singles 51gx1s', null, '2021-03-06 02:01:29', '2021-03-06 02:01:29', null);
INSERT INTO `item_uom` VALUES ('111', '0a5aecfa-abe3-4b48-ab64-3575b02c1d8c', '212df508-0c94-41c7-892d-74a50fc4e3d4', '20575c31-a69f-48fc-96ae-38057748b76b', '11111111111112', '24', 'Snickers Singles 51gx24 Box', null, '2021-03-06 02:01:29', '2021-03-06 02:01:29', null);
INSERT INTO `item_uom` VALUES ('112', '295c55b8-054a-49ad-b347-f46993ddb6ab', '212df508-0c94-41c7-892d-74a50fc4e3d4', '29ac13a3-edd0-4575-8bea-85e5a5b6abad', '11111111111113', '192', 'Snickers Singles 51gx192 Cs', null, '2021-03-06 02:01:29', '2021-03-06 02:01:29', null);
INSERT INTO `item_uom` VALUES ('113', 'cd6c7ae2-4fd9-4a7b-bd94-d25eb2161900', '6df69b3b-2aa8-467b-a9af-25a99332a681', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', '2222222222222', '1', 'SKITTLES Orig Tube 30g 1s', null, '2021-03-06 02:08:06', '2021-03-06 02:08:06', null);
INSERT INTO `item_uom` VALUES ('114', '8496b879-ad2e-48d9-a98d-cad149e9a6a3', '6df69b3b-2aa8-467b-a9af-25a99332a681', '20575c31-a69f-48fc-96ae-38057748b76b', '2222222222223', '12', 'SKITTLES Orig Tube 30g 12s', null, '2021-03-06 02:08:06', '2021-03-06 02:08:06', null);
INSERT INTO `item_uom` VALUES ('115', '6c19b811-1de6-44cf-8f05-d69bdb57ee7c', '189d97c8-25db-4121-9ffe-55472a1a40ea', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', '3333333333333', '10', 'Ariel Powder Matic 100g 10s', null, '2021-03-06 02:29:38', '2021-03-06 02:35:29', null);
INSERT INTO `item_uom` VALUES ('116', 'c4a7a877-bf44-4aee-a0fc-369b8697b90e', '189d97c8-25db-4121-9ffe-55472a1a40ea', '29ac13a3-edd0-4575-8bea-85e5a5b6abad', '3333333333334', '100', 'Ariel Powder Matic 100g x100', null, '2021-03-06 02:29:38', '2021-03-06 02:35:29', null);
INSERT INTO `item_uom` VALUES ('117', 'b86077f6-4118-47ed-ac29-9a08e5c83940', '30c792d9-d658-46aa-b5c8-7fb0035634fc', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', '44444444444444', '1', 'Tide Pwd Jumbo 80g 1s', null, '2021-03-06 02:40:15', '2021-03-06 02:40:15', null);
INSERT INTO `item_uom` VALUES ('118', '5ceb7b58-7345-4faf-a2ec-006b1c456f1e', '30c792d9-d658-46aa-b5c8-7fb0035634fc', '29ac13a3-edd0-4575-8bea-85e5a5b6abad', '44444444444445', '100', 'Tide Pwd Jumbo 80gx100', null, '2021-03-06 02:40:15', '2021-03-06 02:40:15', null);
INSERT INTO `item_uom` VALUES ('119', 'd915d419-7145-4538-9078-ed0bbd117dff', '95346bc5-37e3-446f-a653-013dc646a052', 'a8186e47-9028-4ade-90bc-aad2c66d0c7b', '5555555555555', '1', 'Rice Premium 50g 1kg', null, '2021-03-06 02:45:52', '2021-03-06 02:47:09', null);
INSERT INTO `item_uom` VALUES ('120', '53f33f2c-9af6-444f-9d80-5b27ee716303', '95346bc5-37e3-446f-a653-013dc646a052', '29ac13a3-edd0-4575-8bea-85e5a5b6abad', '5555555555556', '50', 'Rice Premium 50g Sack', null, '2021-03-06 02:45:52', '2021-03-06 02:47:09', null);
INSERT INTO `item_uom` VALUES ('121', '71e07741-1e04-47fc-ac25-a2b186799a1c', '0030611b-fcac-4ef6-96bf-c4f1dbfe0f9a', 'a8186e47-9028-4ade-90bc-aad2c66d0c7b', '6666666666666', '1', 'Rice NFA 1kg', null, '2021-03-06 02:49:27', '2021-03-06 02:49:27', null);
INSERT INTO `item_uom` VALUES ('122', '17c77b78-f68f-41b1-8981-c4d0033631a6', '0030611b-fcac-4ef6-96bf-c4f1dbfe0f9a', '29ac13a3-edd0-4575-8bea-85e5a5b6abad', '6666666666667', '1', 'Rice NFA 25kg', null, '2021-03-06 02:49:27', '2021-03-06 02:49:27', null);
INSERT INTO `item_uom` VALUES ('123', 'dbf15a37-d063-463c-bdc5-7fa6b6832140', '7b421504-e18d-4dac-891f-3aba84fbc2f8', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', '7777777777777', '1', 'M&M Milk Singles 40g', 'Piece', '2021-03-13 08:28:46', '2021-03-13 08:28:46', null);
INSERT INTO `item_uom` VALUES ('124', '4055e628-d5e2-4756-bfda-33781e5e3bed', '7b421504-e18d-4dac-891f-3aba84fbc2f8', '20575c31-a69f-48fc-96ae-38057748b76b', '7777777777778', '24', 'M&M Milk Singles 40g Box', 'Inner Box', '2021-03-13 08:28:46', '2021-03-13 08:28:46', null);
INSERT INTO `item_uom` VALUES ('125', '03d129ab-0b10-4f84-887f-23706e3a7f3f', 'b9dc1fa9-1b4c-4ba2-a8e2-59e1f2a04fbb', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', '8888888888888', '1', 'DM Pprmnt Pellet 10s', 'Piece', '2021-03-13 08:32:12', '2021-03-13 08:32:12', null);
INSERT INTO `item_uom` VALUES ('126', '458d41eb-7f61-475b-ba4f-ae39f0e83e9f', 'b9dc1fa9-1b4c-4ba2-a8e2-59e1f2a04fbb', '20575c31-a69f-48fc-96ae-38057748b76b', '8888888888889', '10', 'DM Pprmnt Pellet 10s Box', 'Inner Box', '2021-03-13 08:32:12', '2021-03-13 08:32:12', null);
INSERT INTO `item_uom` VALUES ('127', 'd58db103-13cd-4f6a-8eea-5d9555b11bee', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', '1000000000000', '10', 'Anmum Plain 30g 10s', 'Tie', '2021-03-13 08:37:12', '2021-03-13 08:41:57', '2021-03-13 08:41:57');
INSERT INTO `item_uom` VALUES ('128', 'cc9dba96-9e70-4f2a-8797-aa7a9554836f', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', '29ac13a3-edd0-4575-8bea-85e5a5b6abad', '1000000000001', '100', 'Anmum Plain 30gx100', 'Case', '2021-03-13 08:37:12', '2021-03-13 08:41:57', '2021-03-13 08:41:57');
INSERT INTO `item_uom` VALUES ('129', 'f6903122-8bbb-4e15-9a9c-26a07f49d5be', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', '1100000000000', '1', 'Anchor UHT 50ml', 'Piece', '2021-03-13 08:40:17', '2021-03-13 08:42:59', '2021-03-13 08:42:59');
INSERT INTO `item_uom` VALUES ('130', '74a3466c-5620-4b12-89ba-bba161ab1898', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', '20575c31-a69f-48fc-96ae-38057748b76b', '1100000000001', '1', 'Anchor UHT 50mlx10', 'Box', '2021-03-13 08:40:17', '2021-03-13 08:42:59', '2021-03-13 08:42:59');
INSERT INTO `item_uom` VALUES ('131', 'be6c6f5f-3729-49aa-aa05-4852d982db61', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', '9999999999999', '10', 'Anmum Plain 30g 10s', 'Tie', '2021-03-13 08:41:57', '2021-03-13 08:41:57', null);
INSERT INTO `item_uom` VALUES ('132', 'b7b21d46-5d96-4857-bc37-53adeb5b4fdc', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', '29ac13a3-edd0-4575-8bea-85e5a5b6abad', '9999999999990', '100', 'Anmum Plain 30gx100', 'Case', '2021-03-13 08:41:57', '2021-03-13 08:41:57', null);
INSERT INTO `item_uom` VALUES ('133', '1dc83b9e-e860-4176-8f55-0a904ec89f89', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', 'da4b8fa8-be99-4141-af17-a2f27c4f4533', '1000000000000', '1', 'Anchor UHT 50ml', 'Piece', '2021-03-13 08:42:59', '2021-03-13 08:42:59', null);
INSERT INTO `item_uom` VALUES ('134', '046b6a29-255d-43d1-b680-00d2ba4d8a30', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', '20575c31-a69f-48fc-96ae-38057748b76b', '1000000000001', '1', 'Anchor UHT 50mlx10', 'Box', '2021-03-13 08:42:59', '2021-03-13 08:42:59', null);
INSERT INTO `item_uom` VALUES ('135', '55553ee7-2014-49d6-9618-4219e375c9b4', 'f27b2cdf-08bf-4b7e-b00a-7c75726b5bee', '294eb0c0-bede-414e-8d59-d17b7293c424', '4324', '12', 'tets', 'testre', '2021-05-26 02:26:04', '2021-05-26 02:26:04', null);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2016_06_01_000001_create_oauth_auth_codes_table', '1');
INSERT INTO `migrations` VALUES ('3', '2016_06_01_000002_create_oauth_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('4', '2016_06_01_000003_create_oauth_refresh_tokens_table', '1');
INSERT INTO `migrations` VALUES ('5', '2016_06_01_000004_create_oauth_clients_table', '1');
INSERT INTO `migrations` VALUES ('6', '2016_06_01_000005_create_oauth_personal_access_clients_table', '1');
INSERT INTO `migrations` VALUES ('7', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('8', '2020_06_29_083406_create_companies_table', '1');
INSERT INTO `migrations` VALUES ('10', '2020_07_07_115213_create_master_locations_table', '2');
INSERT INTO `migrations` VALUES ('11', '2020_07_07_154219_create_master_location_groups_table', '3');

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
INSERT INTO `oauth_access_tokens` VALUES ('0039c962840c4aa1e41a0b6e39726d0f030d7bd33c9e7624ee54d42310746b859539fcaa3baa1418', '2', '5', 'authToken', '[]', '1', '2020-10-11 23:14:16', '2020-10-11 23:14:16', '2021-10-11 05:14:16');
INSERT INTO `oauth_access_tokens` VALUES ('04f9d659e0038850b98fe6c147926b460c697b35577674abe5f8097b8720330eea3d9af3c0fc5e93', '1', '5', 'authToken', '[]', '0', '2020-11-17 00:06:21', '2020-11-17 00:06:21', '2021-11-16 17:06:21');
INSERT INTO `oauth_access_tokens` VALUES ('0695bb65d4d836f0b558b25f58efcabdfd93c2bf5278433f6f4a1dfb295b084cf0469d884ce45ca8', '3', '5', 'authToken', '[]', '1', '2020-09-17 14:51:37', '2020-09-17 14:51:37', '2021-09-16 14:51:37');
INSERT INTO `oauth_access_tokens` VALUES ('0726fcf806ff491c006b2eb423d10e753815039f542413a6ff9ec121b33dea70e778a404262cc71c', '1', '3', 'authToken', '[]', '0', '2020-09-04 08:29:21', '2020-09-04 08:29:21', '2021-09-03 14:29:21');
INSERT INTO `oauth_access_tokens` VALUES ('0903360f345bc8a478cc70089828626a92d396900712c35868e024ca60b9ebd092ccde01914417a9', '1', '5', 'authToken', '[]', '1', '2020-10-19 16:31:59', '2020-10-19 16:31:59', '2021-10-19 04:31:59');
INSERT INTO `oauth_access_tokens` VALUES ('0b62b1a5981814dd784d7c1c2caf9c9f4770a28ef362f5abd1ca08d3962d6dc1ac231f5d8e497362', '3', '5', 'authToken', '[]', '1', '2020-09-17 14:26:59', '2020-09-17 14:26:59', '2021-09-16 14:26:59');
INSERT INTO `oauth_access_tokens` VALUES ('0dba948792ca090c422e15a8363bbb4cb31d5de9f3306f19761ecb5d8fffb66858c95bb3e5a09d06', '1', '3', 'authToken', '[]', '1', '2020-08-30 21:58:03', '2020-08-30 21:58:03', '2021-08-30 03:58:03');
INSERT INTO `oauth_access_tokens` VALUES ('108c185ddd4e22a022a82f34a7eac4c36864ea1c06b3b572333808129ccf82f32d0dc911f8920cab', '3', '5', 'authToken', '[]', '1', '2020-09-17 13:21:43', '2020-09-17 13:21:43', '2021-09-16 13:21:43');
INSERT INTO `oauth_access_tokens` VALUES ('10b263ac0b66c51c57feed518132ad885eb19f75ec62150a3bbf9a14e75c360719d76b17d92be005', '2', '7', 'authToken', '[]', '1', '2021-04-19 17:04:53', '2021-04-19 17:04:53', '2022-04-19 09:04:53');
INSERT INTO `oauth_access_tokens` VALUES ('132c458d19fe6355c8b95e597901ee5a6e154697e96af5f1fd270086ba412e9b8e90c984e733c1e5', '1', '5', 'authToken', '[]', '0', '2020-10-22 00:07:05', '2020-10-22 00:07:05', '2021-10-21 12:07:05');
INSERT INTO `oauth_access_tokens` VALUES ('17734f927259dfb4defc2379368af1c12db6f434c7d43f2ad7d2303e36b028bb12cf3497ff4e9674', '1', '5', 'authToken', '[]', '0', '2020-10-17 10:35:37', '2020-10-17 10:35:37', '2021-10-16 16:35:37');
INSERT INTO `oauth_access_tokens` VALUES ('185030fd42d40386900b37ffba0296eb9510b3f62ad406c313534d65c2baddfb4a1c366571090924', '3', '5', 'authToken', '[]', '1', '2020-09-17 14:24:18', '2020-09-17 14:24:18', '2021-09-16 14:24:18');
INSERT INTO `oauth_access_tokens` VALUES ('1dc1c9f1383036c1c75fdbcc3537d293524183550bd5efd4d4ce98484430fb7ef3380f8b14f8ed83', '2', '5', 'authToken', '[]', '1', '2020-10-18 00:27:13', '2020-10-18 00:27:13', '2021-10-17 06:27:13');
INSERT INTO `oauth_access_tokens` VALUES ('2240729fe48c422443dc8b131e2444a954aab83b59b16fdb22fcf0e990b17ccc5e1e637b8ded67c5', '3', '5', 'authToken', '[]', '1', '2020-09-17 14:12:50', '2020-09-17 14:12:50', '2021-09-16 14:12:50');
INSERT INTO `oauth_access_tokens` VALUES ('230ab3d4c66f984723bd7dce7bb8802bae2f0f5188f75ff5b2b19a85a4e80c5978de44f595783231', '1', '5', 'authToken', '[]', '0', '2020-11-16 16:44:27', '2020-11-16 16:44:27', '2021-11-16 09:44:27');
INSERT INTO `oauth_access_tokens` VALUES ('2326390f17875586d720717482997a137815d395a6604c1addff39c83f1bed9ef2ddb170fe63ce86', '2', '5', 'authToken', '[]', '1', '2020-10-13 07:33:33', '2020-10-13 07:33:33', '2021-10-12 13:33:33');
INSERT INTO `oauth_access_tokens` VALUES ('24a236c6bd0898eedc8059fee30ac17707b7bd806735492f0ac2ee6f9c05ff28795d6e5f0ff11da4', '1', '5', 'authToken', '[]', '1', '2020-09-17 08:40:17', '2020-09-17 08:40:17', '2021-09-16 08:40:17');
INSERT INTO `oauth_access_tokens` VALUES ('253a140560a4a5cc13ce96ed7066798166bd09760aa48631ce78c238c6af4e7c327660c33f433cc8', '1', '1', 'authToken', '[]', '1', '2020-08-02 16:14:12', '2020-08-02 16:14:12', '2021-08-01 16:14:12');
INSERT INTO `oauth_access_tokens` VALUES ('2552d275344830e5aab08c393ad1ebc96014e598d1a1ffae1b5bd2cab18d29202005063e7ac8617a', '1', '7', 'authToken', '[]', '0', '2021-03-31 22:25:07', '2021-03-31 22:25:07', '2022-03-31 14:25:07');
INSERT INTO `oauth_access_tokens` VALUES ('263748105ed346f8f0cd6a8552a907af1f377b8d1bc27d9a45e56df9afe2f0048a9e0cecc462ff0f', '1', '5', 'authToken', '[]', '0', '2020-09-16 10:40:34', '2020-09-16 10:40:34', '2021-09-15 10:40:34');
INSERT INTO `oauth_access_tokens` VALUES ('29fedc38fe164b620d033773aa6f7e128902e9bcb2a5c72c98edccebe896c11baec841e4eb01c90e', '2', '7', 'authToken', '[]', '1', '2021-04-30 15:43:48', '2021-04-30 15:43:48', '2022-04-30 07:43:48');
INSERT INTO `oauth_access_tokens` VALUES ('2bc1c8e50ab890c762bbb367d5a8883514d44bdbb830eb4f81b371f1954a884a81e4ab79e66804df', '1', '5', 'authToken', '[]', '1', '2020-09-19 17:11:37', '2020-09-19 17:11:37', '2021-09-18 23:11:37');
INSERT INTO `oauth_access_tokens` VALUES ('2bc4bd5066e9d2dc448da2044762eebb89a1236d802fc61b5a59494d4df824180f2d85bfc89bdf3f', '2', '3', 'authToken', '[]', '0', '2020-09-10 09:07:01', '2020-09-10 09:07:01', '2021-09-09 15:07:01');
INSERT INTO `oauth_access_tokens` VALUES ('2db99e67529f3f5e97e0cc05d45e414275e0419cb7a1146fd0173ecb46f6e301b67928603f08da0a', '1', '5', 'authToken', '[]', '0', '2020-09-17 14:27:06', '2020-09-17 14:27:06', '2021-09-16 14:27:06');
INSERT INTO `oauth_access_tokens` VALUES ('2e81ed778a2a055a0353c6625e691dd425c0c4e855b1f4ba0bf99c0bdea18aefef43982ec2d1e0f0', '1', '5', 'authToken', '[]', '1', '2020-09-17 03:32:01', '2020-09-17 03:32:01', '2021-09-16 03:32:01');
INSERT INTO `oauth_access_tokens` VALUES ('2f6460f1de7ab8766065aa333d63324bfe92df006a3785b698edf4fdc813e86e0b1ebf70ec44dea0', '2', '7', 'authToken', '[]', '0', '2021-05-01 20:50:59', '2021-05-01 20:50:59', '2022-05-01 12:50:59');
INSERT INTO `oauth_access_tokens` VALUES ('35e214f7479ae4361b00e9a0b01f659c37f8a90332ea5e514808125e2fdbf14b2839df9643fa86ee', '1', '5', 'authToken', '[]', '1', '2020-09-17 14:25:05', '2020-09-17 14:25:05', '2021-09-16 14:25:05');
INSERT INTO `oauth_access_tokens` VALUES ('365f971a6abfbf1b700d87c10e116c987b0607bb11579a66ba52a7aa42ff0cf668f97b6c216a36a6', '2', '5', 'authToken', '[]', '0', '2020-09-17 15:36:18', '2020-09-17 15:36:18', '2021-09-16 15:36:18');
INSERT INTO `oauth_access_tokens` VALUES ('39d4af0eb38574ead31d44bc040ac7f6405fb92ac506a982396500ba9d7059c617c8786d0838f89c', '2', '5', 'authToken', '[]', '0', '2020-10-11 16:38:48', '2020-10-11 16:38:48', '2021-10-10 22:38:48');
INSERT INTO `oauth_access_tokens` VALUES ('3aa95a7ba05b361075923a7c647c73c3f2d21d5eeb1b1c548b24e82a2e1e3608aea4410f568b3710', '1', '1', 'authToken', '[]', '1', '2020-07-31 15:19:22', '2020-07-31 15:19:22', '2021-07-30 15:19:22');
INSERT INTO `oauth_access_tokens` VALUES ('3d56ddc9309ab6350af3a73f94ddd33ccafd68d60605592ce3ca5cd22fd1bccbd28077671bf3b8aa', '3', '5', 'authToken', '[]', '1', '2020-09-17 14:28:10', '2020-09-17 14:28:10', '2021-09-16 14:28:10');
INSERT INTO `oauth_access_tokens` VALUES ('3d6002795a22076302c3ab964e19d658a69eb058cae3d5722e422b080ee4e1671627ccdc9bde63b6', '1', '5', 'authToken', '[]', '0', '2020-09-16 13:52:35', '2020-09-16 13:52:35', '2021-09-15 13:52:35');
INSERT INTO `oauth_access_tokens` VALUES ('3dea54d66bf03128a00f0fcfce4254f29e0f09c59b69fb4df5424da1937d526b793455093df0c73f', '2', '5', 'authToken', '[]', '1', '2020-10-14 19:14:11', '2020-10-14 19:14:11', '2021-10-14 01:14:11');
INSERT INTO `oauth_access_tokens` VALUES ('407fd7b0fcf2fb569cd0d548df0a9ab5d296fcf1e5f1ec779fd18d2f89416c0a7613ca942d3a5fce', '3', '5', 'authToken', '[]', '1', '2020-09-17 11:41:43', '2020-09-17 11:41:43', '2021-09-16 11:41:43');
INSERT INTO `oauth_access_tokens` VALUES ('48bfc53c51d2bb66f81c8003e857c6004f20793d60a0987c286d5038a21213d4c5654e1a06b543ca', '2', '5', 'authToken', '[]', '1', '2021-03-05 16:35:56', '2021-03-05 16:35:56', '2022-03-05 09:35:56');
INSERT INTO `oauth_access_tokens` VALUES ('49df3a63bafb450a1fad1e57c6bb5f7db3649772edd5e28252958b644d1558bdeef120e9a13600fe', '1', '5', 'authToken', '[]', '0', '2020-09-17 03:31:11', '2020-09-17 03:31:11', '2021-09-16 03:31:11');
INSERT INTO `oauth_access_tokens` VALUES ('4c32aeab3618fcc43440c47df500e74f0f14e53b9ace1f2af87ad368535287d9243efdcb27c4d27b', '2', '5', 'authToken', '[]', '1', '2020-09-17 10:44:13', '2020-09-17 10:44:13', '2021-09-16 10:44:13');
INSERT INTO `oauth_access_tokens` VALUES ('4c7b5d6a51c0199689b217ff5e4ddfe5ef596b74efe3ea7031d304589f613f261e68e6b685546b01', '2', '5', 'authToken', '[]', '1', '2020-09-17 14:02:47', '2020-09-17 14:02:47', '2021-09-16 14:02:47');
INSERT INTO `oauth_access_tokens` VALUES ('5177ac8e2c2ca27e0772509e970a6023df6a9aa6b33eff9fef4b7732fe89ee868a38750269f131fc', '2', '5', 'authToken', '[]', '1', '2020-09-17 08:01:09', '2020-09-17 08:01:09', '2021-09-16 08:01:09');
INSERT INTO `oauth_access_tokens` VALUES ('549ec282ada49e1c43a47d82ce24ab81a12f29c40b3f4660fb205097564ea279edb03ab205540cda', '2', '5', 'authToken', '[]', '1', '2020-09-17 03:47:36', '2020-09-17 03:47:36', '2021-09-16 03:47:36');
INSERT INTO `oauth_access_tokens` VALUES ('57874d3a16dbe8164ff88d4fca683688bb5c8f658937b7c96022abafdb45e9a77c9c102cd72b721e', '1', '3', 'authToken', '[]', '0', '2020-08-31 08:40:20', '2020-08-31 08:40:20', '2021-08-30 14:40:20');
INSERT INTO `oauth_access_tokens` VALUES ('5f40c89c96ba9d7e4537ff37ee3340a617eaaab9a08d7fcc48aab0df883271af21741734d205f8b5', '2', '5', 'authToken', '[]', '1', '2020-10-19 02:14:22', '2020-10-19 02:14:22', '2021-10-18 08:14:22');
INSERT INTO `oauth_access_tokens` VALUES ('5f8c77ee0c0451536f2b1daee9cbbb2661b86d37c398289745c72c8b4056a0efde156bc3492d9738', '2', '5', 'authToken', '[]', '0', '2020-10-14 07:46:35', '2020-10-14 07:46:35', '2021-10-13 13:46:35');
INSERT INTO `oauth_access_tokens` VALUES ('602234811b075559d11699146870b6e2a30c97f632e2ab6cb960c07de575959a1979ec268aa6d1c4', '2', '3', 'authToken', '[]', '1', '2020-09-06 07:48:33', '2020-09-06 07:48:33', '2021-09-05 07:48:33');
INSERT INTO `oauth_access_tokens` VALUES ('621d1b02b7ea1836981cadaa2b893fa9eae0656cfce1ae30672f329701e0406f3c939aff9438f367', '1', '1', 'authToken', '[]', '0', '2020-07-08 13:30:00', '2020-07-08 13:30:00', '2021-07-07 13:30:00');
INSERT INTO `oauth_access_tokens` VALUES ('63a4cc5d2a72d29afdb37980c197fc5337368ca8a3108350cf60655614fe08e1e9fd5ba5d50fc7dd', '1', '3', 'authToken', '[]', '1', '2020-09-14 00:32:20', '2020-09-14 00:32:20', '2021-09-13 06:32:20');
INSERT INTO `oauth_access_tokens` VALUES ('64d5eb10833704849cc4c6e088c04fc9e69e781cb73d574bbd52287ab643abbbdb8eb182b45b6b8c', '1', '7', 'authToken', '[]', '0', '2021-05-25 07:15:06', '2021-05-25 07:15:06', '2022-05-25 07:15:06');
INSERT INTO `oauth_access_tokens` VALUES ('6a366f7c017175a4d860e47f31d00281c6605909774fa9bd5d9508c172eaab8315913e2adc93f2ad', '1', '7', 'authToken', '[]', '0', '2021-03-12 00:03:08', '2021-03-12 00:03:08', '2022-03-11 16:03:08');
INSERT INTO `oauth_access_tokens` VALUES ('6c69df53030a9f8a3d8c2bc688b5ed8c1d3fc70d692b0a701178c3a74d46a046d16c172336b3d849', '2', '5', 'authToken', '[]', '1', '2020-09-17 03:36:35', '2020-09-17 03:36:35', '2021-09-16 03:36:35');
INSERT INTO `oauth_access_tokens` VALUES ('6f804dd2143fc7fc6db92cd7be8a1b3967fdd979a8213169ae7aae87f232eb56d75030023fa5cc83', '1', '1', 'authToken', '[]', '0', '2020-07-07 17:46:37', '2020-07-07 17:46:37', '2021-07-06 17:46:37');
INSERT INTO `oauth_access_tokens` VALUES ('7f2bc2cd093dbe1d358c5bbe9e04a3fc6deb786df7226d28e4955d7131b5d1ee9eb2e46b25db2c8a', '2', '5', 'authToken', '[]', '0', '2020-09-17 14:58:07', '2020-09-17 14:58:07', '2021-09-16 14:58:07');
INSERT INTO `oauth_access_tokens` VALUES ('7f422649b5eca79aff328e264ab5dc566b7825fa2a1f4ef78ea625091a72434afdd8662aa5b0e1d8', '1', '5', 'authToken', '[]', '0', '2020-10-22 10:07:02', '2020-10-22 10:07:02', '2021-10-22 04:07:02');
INSERT INTO `oauth_access_tokens` VALUES ('7f5c443ccf444093697f3b2bb710fb24d8ff1d18668377fb93ba4539de1920f1b02b66b8151feb4e', '2', '5', 'authToken', '[]', '1', '2020-10-12 03:43:34', '2020-10-12 03:43:34', '2021-10-11 09:43:34');
INSERT INTO `oauth_access_tokens` VALUES ('80dbcef91e3e19740a8648b092638eace548034e212108f48151a9e75954f3e9486aa7cb58f7da3e', '2', '5', 'authToken', '[]', '1', '2020-09-16 12:43:25', '2020-09-16 12:43:25', '2021-09-15 12:43:25');
INSERT INTO `oauth_access_tokens` VALUES ('81d31ef4281b7222d74ebf7bea2daf5dcad8599dee2c12d6b6508d8be7e025e6f59a4916158380b9', '3', '3', 'authToken', '[]', '1', '2020-09-10 08:06:44', '2020-09-10 08:06:44', '2021-09-09 14:06:44');
INSERT INTO `oauth_access_tokens` VALUES ('866d929a2916811efb347c9cd6831ace2672dd6c3c1504ca5de2deb6f16c79be7821985b364264d7', '1', '7', 'authToken', '[]', '0', '2021-04-20 00:22:39', '2021-04-20 00:22:39', '2022-04-19 16:22:39');
INSERT INTO `oauth_access_tokens` VALUES ('89dbe77d54707598b404a1deee67f6b1b9851c20a6258dbba47d1e3fc60841964d85b5fd9b559a30', '1', '7', 'authToken', '[]', '0', '2021-03-31 22:26:20', '2021-03-31 22:26:20', '2022-03-31 14:26:20');
INSERT INTO `oauth_access_tokens` VALUES ('8d0ed0e4107daa9af1b482c2772964bce8754606145ab66ff450943c5377597e9a5381880c59fd6b', '3', '5', 'authToken', '[]', '1', '2020-09-17 10:41:50', '2020-09-17 10:41:50', '2021-09-16 10:41:50');
INSERT INTO `oauth_access_tokens` VALUES ('8e8f72d1da6cace0ef24f83b4b34678d62aa630b0e3e50b99b98c415315143c4a4d5cad78b9e3ae6', '1', '1', 'authToken', '[]', '0', '2020-08-09 09:38:45', '2020-08-09 09:38:45', '2021-08-08 09:38:45');
INSERT INTO `oauth_access_tokens` VALUES ('916e1b652689a67dcea79347e6ca12eb352e91f3510977c1de0af5dae5909d4170ee9c1c75e3addc', '2', '5', 'authToken', '[]', '1', '2020-10-16 02:02:36', '2020-10-16 02:02:36', '2021-10-15 08:02:36');
INSERT INTO `oauth_access_tokens` VALUES ('93a217466caf18ed1d03eb7ae045abfdc08e53935b811d9ce6d26c17cc1c5b57d95b3ed5d8d4e911', '2', '5', 'authToken', '[]', '0', '2020-10-12 00:29:44', '2020-10-12 00:29:44', '2021-10-11 06:29:44');
INSERT INTO `oauth_access_tokens` VALUES ('95d3089b1c61e55a6346b043dbb329febc55ba07ea180bf9061498a06f224b74c7bc85bc8eaa372d', '1', '1', 'authToken', '[]', '1', '2020-07-31 15:20:24', '2020-07-31 15:20:24', '2021-07-30 15:20:24');
INSERT INTO `oauth_access_tokens` VALUES ('9a13d58061ef9746e16073024e706060662dbb43823ed5886f2f90bea723c981117936ecbbd95439', '1', '1', 'authToken', '[]', '1', '2020-07-31 15:26:39', '2020-07-31 15:26:39', '2021-07-30 15:26:39');
INSERT INTO `oauth_access_tokens` VALUES ('9cc6e3c6ea2bee42c95ef092db5757060065178d8ef18510664aeac53f7a3b650ed988d40edb7891', '1', '7', 'authToken', '[]', '0', '2021-03-31 22:25:34', '2021-03-31 22:25:34', '2022-03-31 14:25:34');
INSERT INTO `oauth_access_tokens` VALUES ('9d3d3107255e7b8ea9cc86284dc3f79016a3d6b35d8d6047158fb31fb2636c59271d8dc37ee70e79', '2', '5', 'authToken', '[]', '0', '2020-09-17 01:14:13', '2020-09-17 01:14:13', '2021-09-16 01:14:13');
INSERT INTO `oauth_access_tokens` VALUES ('9d9502c1ea01f5acd51d736c365d37ebbd5f1f861ab889de3bf7e21e992d44ed1499e086894aad99', '1', '7', 'authToken', '[]', '1', '2021-03-12 00:32:00', '2021-03-12 00:32:00', '2022-03-11 16:32:00');
INSERT INTO `oauth_access_tokens` VALUES ('9db9f2ac117a184b292e6239af3ff9f121c293a175a970988afeed3ff66f7f3933cb2f8e26e6a35b', '1', '1', 'authToken', '[]', '0', '2020-08-22 22:45:41', '2020-08-22 22:45:41', '2021-08-21 22:45:41');
INSERT INTO `oauth_access_tokens` VALUES ('9e576405c43af9d16e939b1652031616eb3fc3ef98465bbf0e7ae2a6cb3af95090dc717070655ce3', '1', '3', 'authToken', '[]', '0', '2020-09-06 07:47:55', '2020-09-06 07:47:55', '2021-09-05 07:47:55');
INSERT INTO `oauth_access_tokens` VALUES ('a140aab8a070371de45bf47753d87f01fb578d24a9200b14f3a90a4c5a40e6a64ae9864f4cbc190a', '1', '7', 'authToken', '[]', '0', '2021-03-12 16:09:26', '2021-03-12 16:09:26', '2022-03-12 08:09:26');
INSERT INTO `oauth_access_tokens` VALUES ('a69ed1d2b86daf6bd747def4d524163d179f22dfed53709a0b4a0787e22fd2e41c57895848e4586f', '1', '1', 'authToken', '[]', '1', '2020-07-31 15:22:05', '2020-07-31 15:22:05', '2021-07-30 15:22:05');
INSERT INTO `oauth_access_tokens` VALUES ('a81e9f494a861e368f2a3ca8f1868f3f00466047eabff61a75944e7c0cc1fdaa5bc890eefe445f17', '1', '3', 'authToken', '[]', '0', '2020-09-06 07:44:50', '2020-09-06 07:44:50', '2021-09-05 07:44:50');
INSERT INTO `oauth_access_tokens` VALUES ('a93a4854d17c54f044ad6114b9e5b5a99d6096bb28762a8f411f8593d1be9b9b53c695f71c5a62de', '1', '3', 'authToken', '[]', '1', '2020-09-06 07:41:38', '2020-09-06 07:41:38', '2021-09-05 07:41:38');
INSERT INTO `oauth_access_tokens` VALUES ('a9caca2f32a4b13240c2e5aebe332ecbb1dc938793080578cdaf21cb455831b4b026bac60fc58e49', '2', '3', 'authToken', '[]', '1', '2020-09-08 07:21:29', '2020-09-08 07:21:29', '2021-09-07 07:21:29');
INSERT INTO `oauth_access_tokens` VALUES ('ade938849608e7384f0e69cc64e0fb94d26b360cfb8b28b877bf1c423ee159920e5f79af5aedc1bf', '3', '5', 'authToken', '[]', '1', '2020-09-17 13:53:23', '2020-09-17 13:53:23', '2021-09-16 13:53:23');
INSERT INTO `oauth_access_tokens` VALUES ('b54552da72f8db505f8eb2befab7fff31141203dab6e35ff6feda94a29d558595fbd3a65671ecf6e', '2', '7', 'authToken', '[]', '1', '2021-05-03 11:03:25', '2021-05-03 11:03:25', '2022-05-03 03:03:25');
INSERT INTO `oauth_access_tokens` VALUES ('b5979fded87fd291c9a5512b6c52932443b20be19094103da00f733502412806e9d32c34dbf0fcda', '1', '5', 'authToken', '[]', '0', '2021-03-05 00:36:55', '2021-03-05 00:36:55', '2022-03-04 17:36:55');
INSERT INTO `oauth_access_tokens` VALUES ('b62e1c523cfed13c296b7b4fc194cc008572881a710aef09b18808f768b363662f8e59185eeba3e3', '2', '3', 'authToken', '[]', '1', '2020-09-08 02:22:35', '2020-09-08 02:22:35', '2021-09-07 02:22:35');
INSERT INTO `oauth_access_tokens` VALUES ('b6e1669503bd74836b9574123b4692a2d9b8ef8e73ce742d22595060ee94fa772bdbee2d1a1adc90', '1', '5', 'authToken', '[]', '0', '2020-10-15 06:26:53', '2020-10-15 06:26:53', '2021-10-14 12:26:53');
INSERT INTO `oauth_access_tokens` VALUES ('b74c3ee1883bb4d691fd55352963dd0886eedfd958ddc7fa5511e404a2122bc313ae1f4a6289db6c', '1', '5', 'authToken', '[]', '0', '2020-10-22 00:06:44', '2020-10-22 00:06:44', '2021-10-21 12:06:44');
INSERT INTO `oauth_access_tokens` VALUES ('b9652489f9f1e381de8476bc93c9b36a521ee993de13110b223e1472538bff93a643e9da92b2eb74', '1', '1', 'authToken', '[]', '1', '2020-07-31 15:11:53', '2020-07-31 15:11:53', '2021-07-30 15:11:53');
INSERT INTO `oauth_access_tokens` VALUES ('baba54951b5c8efd493bddbc1f0c9a73c793f19ae4a0092d6a9f0ebe6a7b39e485dfcfa771e3aeb0', '2', '7', 'authToken', '[]', '1', '2021-04-30 14:03:58', '2021-04-30 14:03:58', '2022-04-30 06:03:58');
INSERT INTO `oauth_access_tokens` VALUES ('bc6f530757813ab5ce628c305749c995bd87dfe1634e87d71786507a69796967b0113dd5cbd38765', '2', '5', 'authToken', '[]', '0', '2020-09-19 17:12:18', '2020-09-19 17:12:18', '2021-09-18 23:12:18');
INSERT INTO `oauth_access_tokens` VALUES ('bfc8da37e89e55175976cea4f568a06b8ba1ca7c251451785432a2ecce1b88756d5a02abeb13cdd7', '1', '1', 'authToken', '[]', '1', '2020-07-31 15:13:34', '2020-07-31 15:13:34', '2021-07-30 15:13:34');
INSERT INTO `oauth_access_tokens` VALUES ('c0db29ab56626d5cda301b9059432ce9a7c3d87746572eb1f2053eb5ad3b9836e7b8c40ea514efbb', '2', '5', 'authToken', '[]', '1', '2020-09-17 03:50:17', '2020-09-17 03:50:17', '2021-09-16 03:50:17');
INSERT INTO `oauth_access_tokens` VALUES ('c56aa43dfc0667d123298ab4ea5f1e8521606f28495136503d839ff818018fd81382c28501b31149', '2', '5', 'authToken', '[]', '1', '2020-09-17 01:14:42', '2020-09-17 01:14:42', '2021-09-16 01:14:42');
INSERT INTO `oauth_access_tokens` VALUES ('c704f61b8954df7fbad97565a9745a915a43c94f4ddc1a42e3fa64faedc5a3c6f88dc673db40b66e', '2', '3', 'authToken', '[]', '0', '2020-09-06 08:01:25', '2020-09-06 08:01:25', '2021-09-05 08:01:25');
INSERT INTO `oauth_access_tokens` VALUES ('c9c1cccce18d2e3d9946cfe1d675d3c28170419dc324808ac94fe5990291001bf504cc7c21f5d8f4', '2', '5', 'authToken', '[]', '1', '2020-10-12 16:48:42', '2020-10-12 16:48:42', '2021-10-11 22:48:42');
INSERT INTO `oauth_access_tokens` VALUES ('ca01a1d48321f0e836f73233b256d59ff89bf0e41f1aa24b0850b6235bc75ba1bc74008e34ae434b', '2', '5', 'authToken', '[]', '1', '2020-09-17 11:46:05', '2020-09-17 11:46:05', '2021-09-16 11:46:05');
INSERT INTO `oauth_access_tokens` VALUES ('ca6087f4e91ae52a1c4b0af3db941e21b1de68eecdd3dd75f0ad58caa989b99599f370ed753309f7', '1', '3', 'authToken', '[]', '1', '2020-09-08 11:07:55', '2020-09-08 11:07:55', '2021-09-07 17:07:55');
INSERT INTO `oauth_access_tokens` VALUES ('cbb0ca81471a8b9958a122c16fc6118168848fc2b9a682fbade9e195164fa496e94446a0b638fe19', '1', '5', 'authToken', '[]', '1', '2020-10-13 04:54:15', '2020-10-13 04:54:15', '2021-10-12 10:54:15');
INSERT INTO `oauth_access_tokens` VALUES ('cd349ad609314074d2ec4db031ce3e2c62f856cbef25864d2c40da82d051fd8b0338cc61eae72c14', '1', '3', 'authToken', '[]', '0', '2020-09-06 07:42:24', '2020-09-06 07:42:24', '2021-09-05 07:42:24');
INSERT INTO `oauth_access_tokens` VALUES ('d089215a3b13bef6086b47e0749907dee1ea78487e855a9454f2e93bc2c23a7d57e8f1e0914a2c03', '1', '1', 'authToken', '[]', '1', '2020-08-20 10:19:14', '2020-08-20 10:19:14', '2021-08-19 10:19:14');
INSERT INTO `oauth_access_tokens` VALUES ('d3733ca6c5852bfc5ee7184bfbe1c1226ede7ed4231fc66d4abcbd92b5b6803701921ef4fe48ac14', '1', '3', 'authToken', '[]', '0', '2020-08-28 07:18:23', '2020-08-28 07:18:23', '2021-08-27 13:18:23');
INSERT INTO `oauth_access_tokens` VALUES ('d4c247738cd90b5aa488121a0d941f4c968d6b0a571377b59faaf0331f84a4c2f4d2933e91c7619a', '1', '7', 'authToken', '[]', '0', '2021-03-12 01:34:24', '2021-03-12 01:34:24', '2022-03-11 17:34:24');
INSERT INTO `oauth_access_tokens` VALUES ('d5b3fbfda541ee28945248bb76a7901e28cf9de5f264aad9b8d3f98b123fc89b4c95c656e514273b', '2', '5', 'authToken', '[]', '1', '2020-10-15 21:25:53', '2020-10-15 21:25:53', '2021-10-15 03:25:53');
INSERT INTO `oauth_access_tokens` VALUES ('d8f60f2c278174c28dae701670e01ca7a5910b981738fe05f7d7d6e7106cffe1d7d29dcda710a389', '1', '3', 'authToken', '[]', '1', '2020-09-06 07:48:10', '2020-09-06 07:48:10', '2021-09-05 07:48:10');
INSERT INTO `oauth_access_tokens` VALUES ('d9f0d784f2415cb6a8daad44d28dd2b5c4490dd464c0701f688fc6c96923c72e5a280dfc406d6fda', '2', '3', 'authToken', '[]', '1', '2020-09-08 10:25:14', '2020-09-08 10:25:14', '2021-09-07 16:25:14');
INSERT INTO `oauth_access_tokens` VALUES ('da83c1eee6a5e4a6784c6067a5f297fa2206ba80ea24714fd75dafabfe06c4dbcbbb7880635e8b25', '1', '5', 'authToken', '[]', '0', '2020-10-13 12:21:38', '2020-10-13 12:21:38', '2021-10-12 18:21:38');
INSERT INTO `oauth_access_tokens` VALUES ('dbc08bf0cc586ef95778e477b80aeb27e2ac5c6fb0c453439b3c9af5c235a8b6232c63c75d406c10', '1', '5', 'authToken', '[]', '0', '2020-10-15 06:26:43', '2020-10-15 06:26:43', '2021-10-14 12:26:43');
INSERT INTO `oauth_access_tokens` VALUES ('dcd686604ac62ae5a2abd38718eb62023d65df1380dad5bd93e117500ece1e8ac39c3b3982aa54e6', '1', '3', 'authToken', '[]', '0', '2020-09-06 07:43:55', '2020-09-06 07:43:55', '2021-09-05 07:43:55');
INSERT INTO `oauth_access_tokens` VALUES ('dcf7e7c069fa258b20742a1cc77d3086eee4e8a0940a88b8808d3cdffc6d4615a7ef6323a598cb24', '1', '5', 'authToken', '[]', '1', '2020-09-17 03:31:12', '2020-09-17 03:31:12', '2021-09-16 03:31:12');
INSERT INTO `oauth_access_tokens` VALUES ('dec8fe60ca98a543829726d29e9ce23dc0a625df370e287d62a47f85c9865bdc44665dafcfc98c67', '1', '5', 'authToken', '[]', '0', '2020-09-16 10:40:35', '2020-09-16 10:40:35', '2021-09-15 10:40:35');
INSERT INTO `oauth_access_tokens` VALUES ('e04e1930a439032b0e85ea71facd35843732fb447bd6714b98fcdbd6ead73dfd5c13d814f1687533', '2', '5', 'authToken', '[]', '1', '2020-10-16 22:43:40', '2020-10-16 22:43:40', '2021-10-16 04:43:40');
INSERT INTO `oauth_access_tokens` VALUES ('e2f474e8c9af1b2bf3f96d1490bc64b0260e8afd37105b60670dc1377f028a8ffd26ead5567a5e59', '2', '3', 'authToken', '[]', '0', '2020-09-06 07:50:40', '2020-09-06 07:50:40', '2021-09-05 07:50:40');
INSERT INTO `oauth_access_tokens` VALUES ('e4eda92f0c39ac71d23a209c8ece44f18a644311ecb0d71ba760d7cd0627dba748e3a11b72ce0083', '1', '1', 'authToken', '[]', '1', '2020-07-08 14:08:18', '2020-07-08 14:08:18', '2021-07-07 14:08:18');
INSERT INTO `oauth_access_tokens` VALUES ('e6b056f414cb1c955853b12f2de3ea76cae90fce425fc08388147425181ae302ed8712b85838966b', '2', '5', 'authToken', '[]', '1', '2020-09-17 14:48:57', '2020-09-17 14:48:57', '2021-09-16 14:48:57');
INSERT INTO `oauth_access_tokens` VALUES ('ec5db6ccb4a87180effad2bc41081d66e33fc3acff784edcde475f591ddd9d8aa471657d9737eb50', '1', '1', 'authToken', '[]', '1', '2020-08-02 19:50:22', '2020-08-02 19:50:22', '2021-08-01 19:50:22');
INSERT INTO `oauth_access_tokens` VALUES ('ed0acfed73a7480b5d1c8885fad347ddebd07a4ebbb93b038c3a55246e5c0dc1dd90761fefb355bf', '2', '7', 'authToken', '[]', '1', '2021-04-29 17:34:27', '2021-04-29 17:34:27', '2022-04-29 09:34:27');
INSERT INTO `oauth_access_tokens` VALUES ('ee5176a02ece9f8a3c97a449d5e1d0601e38c8eb9f98f74facd5bcf0a8edc1c73568f012cc4c93aa', '1', '7', 'authToken', '[]', '0', '2021-03-31 22:25:27', '2021-03-31 22:25:27', '2022-03-31 14:25:27');
INSERT INTO `oauth_access_tokens` VALUES ('ee6bdfd76f2f2b373367c97a60418c959c3eb9476f6db04bf7ae830c6286856692e93355053570ed', '2', '5', 'authToken', '[]', '0', '2020-09-17 07:05:10', '2020-09-17 07:05:10', '2021-09-16 07:05:10');
INSERT INTO `oauth_access_tokens` VALUES ('ef9f7c90455bba339463ee5b987d6e84561f7d99427774eaa4ebee0382b41658dda560b5e80c2196', '2', '7', 'authToken', '[]', '1', '2021-05-06 11:21:26', '2021-05-06 11:21:26', '2022-05-06 03:21:26');
INSERT INTO `oauth_access_tokens` VALUES ('f3db06f27ad1a717aabca2740ec0ad494c069d07f8a27e0f3f1160a099577927c1317b50c9570e81', '2', '5', 'authToken', '[]', '0', '2020-10-15 22:17:10', '2020-10-15 22:17:10', '2021-10-15 04:17:10');
INSERT INTO `oauth_access_tokens` VALUES ('f5bab72382ce23ddfc6cc96eb64412c9ba5bc48496140094e7ff2ef2eb72a3b437c2cf6c9c282a8b', '2', '5', 'authToken', '[]', '1', '2020-09-17 13:48:00', '2020-09-17 13:48:00', '2021-09-16 13:48:00');
INSERT INTO `oauth_access_tokens` VALUES ('f9163edae86470acf6ee618d670d44c4d35409259de4a48b4d5b587bc95c0dd21095a55bd8699076', '3', '5', 'authToken', '[]', '1', '2020-09-17 03:36:52', '2020-09-17 03:36:52', '2021-09-16 03:36:52');
INSERT INTO `oauth_access_tokens` VALUES ('fa7ab8a722cffae6dffac8b0398fd63a21cbbbde4a737bd7ab2afffa978f6ce5270e6fff0052034f', '1', '5', 'authToken', '[]', '0', '2020-10-17 10:35:21', '2020-10-17 10:35:21', '2021-10-16 16:35:21');
INSERT INTO `oauth_access_tokens` VALUES ('fbdd22eeaa2b5a1f0298f123c9567a6cf6920c34028583d2c4c77a3486d6d53e985ee70f817a3ca0', '1', '5', 'authToken', '[]', '0', '2020-10-13 06:50:51', '2020-10-13 06:50:51', '2021-10-12 12:50:51');

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_auth_codes
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES ('1', null, 'Laravel Personal Access Client', 'vDOFd2SoRdwt1kAlN5DSViRFmRYO5HQ4QgrYNmwA', null, 'http://localhost', '1', '0', '0', '2020-07-07 17:45:50', '2020-07-07 17:45:50');
INSERT INTO `oauth_clients` VALUES ('2', null, 'Laravel Password Grant Client', 'LvsDGYe4IS2uIGg6bWaneBzojmmEtEDI1OvinpAa', 'users', 'http://localhost', '0', '1', '0', '2020-07-07 17:45:50', '2020-07-07 17:45:50');
INSERT INTO `oauth_clients` VALUES ('3', null, 'Laravel Personal Access Client', 'b3KdSCiU2H6ANI776dfuzgC2J4stG4I7ii1zKE7q', null, 'http://localhost', '1', '0', '0', '2020-08-28 07:17:32', '2020-08-28 07:17:32');
INSERT INTO `oauth_clients` VALUES ('4', null, 'Laravel Password Grant Client', 'tIvy1WwELrfJLk2RKVWmzuecXqLachJYta4qWca8', 'users', 'http://localhost', '0', '1', '0', '2020-08-28 07:17:32', '2020-08-28 07:17:32');
INSERT INTO `oauth_clients` VALUES ('5', null, 'Laravel Personal Access Client', 'UV4JjMuC4zntIU2gC9b75diQHzSYwJy0025HJTHi', null, 'http://localhost', '1', '0', '0', '2020-09-16 10:39:09', '2020-09-16 10:39:09');
INSERT INTO `oauth_clients` VALUES ('6', null, 'Laravel Password Grant Client', 'jc8Y91C6TjsIYONXXaFr6HWTmtC1fcCRUF5GdEHY', 'users', 'http://localhost', '0', '1', '0', '2020-09-16 10:39:09', '2020-09-16 10:39:09');
INSERT INTO `oauth_clients` VALUES ('7', null, 'Laravel Personal Access Client', 'K6jrWIcq4s5CERkN1LezQzJM8ORzocyxTO06lnCI', null, 'http://localhost', '1', '0', '0', '2021-03-12 00:02:41', '2021-03-12 00:02:41');
INSERT INTO `oauth_clients` VALUES ('8', null, 'Laravel Password Grant Client', 'Fjn0vqJ8UEr11K9uBw24dsu90jIF8mHUT31VlSNO', 'users', 'http://localhost', '0', '1', '0', '2021-03-12 00:02:41', '2021-03-12 00:02:41');

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES ('1', '1', '2020-07-07 17:45:50', '2020-07-07 17:45:50');
INSERT INTO `oauth_personal_access_clients` VALUES ('2', '3', '2020-08-28 07:17:32', '2020-08-28 07:17:32');
INSERT INTO `oauth_personal_access_clients` VALUES ('3', '5', '2020-09-16 10:39:09', '2020-09-16 10:39:09');
INSERT INTO `oauth_personal_access_clients` VALUES ('4', '7', '2021-03-12 00:02:41', '2021-03-12 00:02:41');

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_refresh_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for pobd_group_suppliers
-- ----------------------------
DROP TABLE IF EXISTS `pobd_group_suppliers`;
CREATE TABLE `pobd_group_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `reference_uuid` varchar(255) DEFAULT NULL,
  `purchase_order_uuid` varchar(255) DEFAULT NULL,
  `supplier_uuid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pobd_group_suppliers
-- ----------------------------

-- ----------------------------
-- Table structure for pobd_group_supplier_discounts
-- ----------------------------
DROP TABLE IF EXISTS `pobd_group_supplier_discounts`;
CREATE TABLE `pobd_group_supplier_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `reference_uuid` varchar(255) DEFAULT NULL,
  `purchase_order_uuid` varchar(255) DEFAULT NULL,
  `pobd_group_supplier_uuid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pobd_group_supplier_discounts
-- ----------------------------

-- ----------------------------
-- Table structure for pobd_group_supplier_discount_excluded_items
-- ----------------------------
DROP TABLE IF EXISTS `pobd_group_supplier_discount_excluded_items`;
CREATE TABLE `pobd_group_supplier_discount_excluded_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `purchase_order_uuid` varchar(255) DEFAULT NULL,
  `reference_uuid` varchar(255) DEFAULT NULL,
  `pobd_group_supplier_discount_uuid` varchar(255) NOT NULL,
  `item_uuid` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pobd_group_supplier_discount_excluded_items
-- ----------------------------

-- ----------------------------
-- Table structure for price_rules
-- ----------------------------
DROP TABLE IF EXISTS `price_rules`;
CREATE TABLE `price_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `supplier_uuid` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `mechanics` varchar(255) NOT NULL,
  `applicable_to` varchar(255) NOT NULL,
  `is_used` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of price_rules
-- ----------------------------
INSERT INTO `price_rules` VALUES ('1', '59987030-666b-4a52-a8d6-4143879bea2a', '57fc0388-caf3-40a1-99c8-b5de0481493b', 'New Year Special', '2.00', '2021-08-01', '2021-08-30', 'mechaniko', 'Buying', '0', '2021-03-29 15:38:37', '2021-03-29 15:38:37', null);
INSERT INTO `price_rules` VALUES ('4', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', null, 'Supermarket Mania', '2.00', '2021-04-01', '2021-04-30', 'mechaniko', 'Selling', '0', '2021-03-29 16:22:19', '2021-03-29 16:36:31', null);
INSERT INTO `price_rules` VALUES ('5', 'd2eb9ecf-2a38-4d0c-acc6-3160ef8b25ac', '816b908b-b8e6-43f4-a0fd-a7376bcb95a8', 'Boxes', '2.00', '2021-05-01', '2021-05-31', 'mechaniko', 'Buying', '0', '2021-03-29 22:54:08', '2021-03-29 22:54:08', null);
INSERT INTO `price_rules` VALUES ('6', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', null, '2-Day Sale', '30.00', '2021-05-06', '2021-05-08', '30% Off on all items', 'Selling', '0', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);

-- ----------------------------
-- Table structure for price_rule_customers
-- ----------------------------
DROP TABLE IF EXISTS `price_rule_customers`;
CREATE TABLE `price_rule_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `price_rule_uuid` varchar(255) NOT NULL,
  `customer_uuid` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of price_rule_customers
-- ----------------------------
INSERT INTO `price_rule_customers` VALUES ('1', '46b194b0-f23e-4593-ad60-d3030d6b010e', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', 'dbfcf281-49f0-4979-85c2-b21fd279da46', '2021-03-29 16:22:19', '2021-03-29 16:36:31', null);
INSERT INTO `price_rule_customers` VALUES ('2', '03fa4a21-8504-4aa0-8e3e-dc37d3922390', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', '94cd891c-336a-4ac9-9b4c-91e41a9c58e6', '2021-03-29 16:22:19', '2021-03-29 16:36:31', null);

-- ----------------------------
-- Table structure for price_rule_items
-- ----------------------------
DROP TABLE IF EXISTS `price_rule_items`;
CREATE TABLE `price_rule_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `price_rule_uuid` varchar(255) NOT NULL,
  `item_uuid` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of price_rule_items
-- ----------------------------
INSERT INTO `price_rule_items` VALUES ('1', '515315c5-f5ca-41b1-806e-7b97fd6f4bb4', '59987030-666b-4a52-a8d6-4143879bea2a', '7b421504-e18d-4dac-891f-3aba84fbc2f8', '2021-03-29 15:38:37', '2021-03-29 16:11:57', '2021-03-29 16:11:57');
INSERT INTO `price_rule_items` VALUES ('2', '6d64149a-f107-4a8b-9a0a-f4bde831b1f5', '59987030-666b-4a52-a8d6-4143879bea2a', 'b9dc1fa9-1b4c-4ba2-a8e2-59e1f2a04fbb', '2021-03-29 15:38:37', '2021-03-29 16:11:57', '2021-03-29 16:11:57');
INSERT INTO `price_rule_items` VALUES ('3', '335a8bad-0285-4576-a8f2-af79e576760b', '59987030-666b-4a52-a8d6-4143879bea2a', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', '2021-03-29 15:38:37', '2021-03-29 16:11:57', '2021-03-29 16:11:57');
INSERT INTO `price_rule_items` VALUES ('4', '59b7797b-6d9a-4d2c-bb9b-fa8f41b7bc2f', '59987030-666b-4a52-a8d6-4143879bea2a', '212df508-0c94-41c7-892d-74a50fc4e3d4', '2021-03-29 16:03:40', '2021-03-29 23:03:43', null);
INSERT INTO `price_rule_items` VALUES ('9', '1eff26c9-5c48-492d-9279-7985f2c3f35b', '59987030-666b-4a52-a8d6-4143879bea2a', '6df69b3b-2aa8-467b-a9af-25a99332a681', '2021-03-29 16:11:57', '2021-03-29 23:03:43', null);
INSERT INTO `price_rule_items` VALUES ('10', '57418ca9-cd56-4c43-a2d3-490b619fb90d', '0efc796a-7167-4d6f-af7f-8a8bd1fbd490', '212df508-0c94-41c7-892d-74a50fc4e3d4', '2021-03-29 16:21:44', '2021-03-29 16:21:44', null);
INSERT INTO `price_rule_items` VALUES ('11', 'd00b0105-34e3-4339-a6af-c4fdb1792b96', '0efc796a-7167-4d6f-af7f-8a8bd1fbd490', '6df69b3b-2aa8-467b-a9af-25a99332a681', '2021-03-29 16:21:44', '2021-03-29 16:21:44', null);
INSERT INTO `price_rule_items` VALUES ('12', 'e768cb62-d14f-47e7-8b01-6f0d26b1c5bc', '0efc796a-7167-4d6f-af7f-8a8bd1fbd490', '189d97c8-25db-4121-9ffe-55472a1a40ea', '2021-03-29 16:21:44', '2021-03-29 16:21:44', null);
INSERT INTO `price_rule_items` VALUES ('13', '8593e16a-e1bc-448d-8fbd-9e454c06684c', '0efc796a-7167-4d6f-af7f-8a8bd1fbd490', '30c792d9-d658-46aa-b5c8-7fb0035634fc', '2021-03-29 16:21:44', '2021-03-29 16:21:44', null);
INSERT INTO `price_rule_items` VALUES ('14', '3e7271fc-db3d-4a6b-b98f-f696a30050f6', '0efc796a-7167-4d6f-af7f-8a8bd1fbd490', '95346bc5-37e3-446f-a653-013dc646a052', '2021-03-29 16:21:44', '2021-03-29 16:21:44', null);
INSERT INTO `price_rule_items` VALUES ('15', 'd0e797d4-a1ff-45df-87ff-a3fcc6f64784', '0efc796a-7167-4d6f-af7f-8a8bd1fbd490', '0030611b-fcac-4ef6-96bf-c4f1dbfe0f9a', '2021-03-29 16:21:44', '2021-03-29 16:21:44', null);
INSERT INTO `price_rule_items` VALUES ('16', '374c9084-fc57-4198-9517-4364076deca2', '0efc796a-7167-4d6f-af7f-8a8bd1fbd490', '7b421504-e18d-4dac-891f-3aba84fbc2f8', '2021-03-29 16:21:44', '2021-03-29 16:21:44', null);
INSERT INTO `price_rule_items` VALUES ('17', 'e9a4966e-748d-474a-916f-02fc4178e676', '0efc796a-7167-4d6f-af7f-8a8bd1fbd490', 'b9dc1fa9-1b4c-4ba2-a8e2-59e1f2a04fbb', '2021-03-29 16:21:44', '2021-03-29 16:21:44', null);
INSERT INTO `price_rule_items` VALUES ('18', '754ebe8f-5451-4976-84bc-dbb3c18dc2dc', '0efc796a-7167-4d6f-af7f-8a8bd1fbd490', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', '2021-03-29 16:21:44', '2021-03-29 16:21:44', null);
INSERT INTO `price_rule_items` VALUES ('19', 'f3c291c0-bc52-4443-9f50-ae5a9402006b', '0efc796a-7167-4d6f-af7f-8a8bd1fbd490', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', '2021-03-29 16:21:44', '2021-03-29 16:21:44', null);
INSERT INTO `price_rule_items` VALUES ('20', '307f3b76-2c6a-4138-8a27-1e3da75c86a8', 'dfd81e61-b6b1-47b2-b487-58bc0e266f60', '212df508-0c94-41c7-892d-74a50fc4e3d4', '2021-03-29 16:21:50', '2021-03-29 16:21:50', null);
INSERT INTO `price_rule_items` VALUES ('21', 'a81e6286-12bf-4bd9-9529-9f76d38a5ef6', 'dfd81e61-b6b1-47b2-b487-58bc0e266f60', '6df69b3b-2aa8-467b-a9af-25a99332a681', '2021-03-29 16:21:50', '2021-03-29 16:21:50', null);
INSERT INTO `price_rule_items` VALUES ('22', '0078d329-7ef0-4678-942d-5b2036eb0ff7', 'dfd81e61-b6b1-47b2-b487-58bc0e266f60', '189d97c8-25db-4121-9ffe-55472a1a40ea', '2021-03-29 16:21:50', '2021-03-29 16:21:50', null);
INSERT INTO `price_rule_items` VALUES ('23', 'c574a12f-51a0-4886-a66b-95c32e4915ab', 'dfd81e61-b6b1-47b2-b487-58bc0e266f60', '30c792d9-d658-46aa-b5c8-7fb0035634fc', '2021-03-29 16:21:50', '2021-03-29 16:21:50', null);
INSERT INTO `price_rule_items` VALUES ('24', '7380fcf6-19b3-4e97-97e1-b43d7fd0d38d', 'dfd81e61-b6b1-47b2-b487-58bc0e266f60', '95346bc5-37e3-446f-a653-013dc646a052', '2021-03-29 16:21:50', '2021-03-29 16:21:50', null);
INSERT INTO `price_rule_items` VALUES ('25', '826ad326-c632-42ad-956f-6c2840180c54', 'dfd81e61-b6b1-47b2-b487-58bc0e266f60', '0030611b-fcac-4ef6-96bf-c4f1dbfe0f9a', '2021-03-29 16:21:50', '2021-03-29 16:21:50', null);
INSERT INTO `price_rule_items` VALUES ('26', '7e64e603-1f56-40ba-b20b-44e5d8bbb6cf', 'dfd81e61-b6b1-47b2-b487-58bc0e266f60', '7b421504-e18d-4dac-891f-3aba84fbc2f8', '2021-03-29 16:21:50', '2021-03-29 16:21:50', null);
INSERT INTO `price_rule_items` VALUES ('27', '7982d631-48fc-447d-9c48-cf98432fbcef', 'dfd81e61-b6b1-47b2-b487-58bc0e266f60', 'b9dc1fa9-1b4c-4ba2-a8e2-59e1f2a04fbb', '2021-03-29 16:21:50', '2021-03-29 16:21:50', null);
INSERT INTO `price_rule_items` VALUES ('28', 'f911419f-17fd-427b-9371-0028467dda06', 'dfd81e61-b6b1-47b2-b487-58bc0e266f60', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', '2021-03-29 16:21:50', '2021-03-29 16:21:50', null);
INSERT INTO `price_rule_items` VALUES ('29', '4d06ecca-17e3-4a16-b5ba-344a4c36443f', 'dfd81e61-b6b1-47b2-b487-58bc0e266f60', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', '2021-03-29 16:21:50', '2021-03-29 16:21:50', null);
INSERT INTO `price_rule_items` VALUES ('30', '881de53c-e8fa-4aff-8a5d-8ea8ebc993bf', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', '212df508-0c94-41c7-892d-74a50fc4e3d4', '2021-03-29 16:22:19', '2021-03-29 16:36:31', null);
INSERT INTO `price_rule_items` VALUES ('31', '2ea824fe-855f-4e74-b643-618e817a181b', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', '6df69b3b-2aa8-467b-a9af-25a99332a681', '2021-03-29 16:22:19', '2021-03-29 16:36:31', null);
INSERT INTO `price_rule_items` VALUES ('32', 'bb514e2f-715c-4d67-8605-bbbc2f9655e5', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', '189d97c8-25db-4121-9ffe-55472a1a40ea', '2021-03-29 16:22:19', '2021-03-29 16:36:31', '2021-03-29 16:36:31');
INSERT INTO `price_rule_items` VALUES ('33', '09fd0554-ae34-4061-a6ae-c90d736c5b39', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', '30c792d9-d658-46aa-b5c8-7fb0035634fc', '2021-03-29 16:22:19', '2021-03-29 16:36:31', '2021-03-29 16:36:31');
INSERT INTO `price_rule_items` VALUES ('34', '074caefc-496e-40d3-8996-461be1fe2a6d', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', '95346bc5-37e3-446f-a653-013dc646a052', '2021-03-29 16:22:19', '2021-03-29 16:36:31', '2021-03-29 16:36:31');
INSERT INTO `price_rule_items` VALUES ('35', '8a71ef65-585a-49c9-a1fc-8dac8f52e740', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', '0030611b-fcac-4ef6-96bf-c4f1dbfe0f9a', '2021-03-29 16:22:19', '2021-03-29 16:36:31', '2021-03-29 16:36:31');
INSERT INTO `price_rule_items` VALUES ('36', 'd01645cb-a62c-4c68-aaee-f3c5ea0834ef', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', '7b421504-e18d-4dac-891f-3aba84fbc2f8', '2021-03-29 16:22:19', '2021-03-29 16:36:31', '2021-03-29 16:36:31');
INSERT INTO `price_rule_items` VALUES ('37', '89a17052-7846-481a-8e47-d59f9b36fb82', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', 'b9dc1fa9-1b4c-4ba2-a8e2-59e1f2a04fbb', '2021-03-29 16:22:19', '2021-03-29 16:36:31', '2021-03-29 16:36:31');
INSERT INTO `price_rule_items` VALUES ('38', '7adbd246-d95f-48b1-8aa6-3c07f684a68e', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', '2021-03-29 16:22:19', '2021-03-29 16:36:31', '2021-03-29 16:36:31');
INSERT INTO `price_rule_items` VALUES ('39', 'fd5fdc9f-3cbc-440d-b5df-3318bb477ab3', 'cc85934d-e674-46c0-ab61-d1e1ebfba567', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', '2021-03-29 16:22:19', '2021-03-29 16:36:31', '2021-03-29 16:36:31');
INSERT INTO `price_rule_items` VALUES ('40', '48570030-b100-4dd5-b8e2-8d8f00a6f27e', 'd2eb9ecf-2a38-4d0c-acc6-3160ef8b25ac', '7b421504-e18d-4dac-891f-3aba84fbc2f8', '2021-03-29 22:54:08', '2021-03-29 22:54:08', null);
INSERT INTO `price_rule_items` VALUES ('41', 'aa159fe6-da89-4266-b6ef-f8f2222c28f1', 'd2eb9ecf-2a38-4d0c-acc6-3160ef8b25ac', 'b9dc1fa9-1b4c-4ba2-a8e2-59e1f2a04fbb', '2021-03-29 22:54:08', '2021-03-29 22:54:08', null);
INSERT INTO `price_rule_items` VALUES ('42', '09b94179-3d76-45f8-bd94-838c08a329f6', 'd2eb9ecf-2a38-4d0c-acc6-3160ef8b25ac', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', '2021-03-29 22:54:08', '2021-03-29 22:54:08', null);
INSERT INTO `price_rule_items` VALUES ('43', 'c14e8e59-abbf-4636-9fed-820c11a8de86', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', '212df508-0c94-41c7-892d-74a50fc4e3d4', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);
INSERT INTO `price_rule_items` VALUES ('44', '0ba76fab-0744-44a5-86e0-81dff339f285', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', '6df69b3b-2aa8-467b-a9af-25a99332a681', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);
INSERT INTO `price_rule_items` VALUES ('45', 'bbb333de-0858-4b01-9d64-3be1c1d7549d', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', '189d97c8-25db-4121-9ffe-55472a1a40ea', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);
INSERT INTO `price_rule_items` VALUES ('46', 'fca7ab6b-4512-4f0f-9d70-74a17d2f2c49', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', '30c792d9-d658-46aa-b5c8-7fb0035634fc', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);
INSERT INTO `price_rule_items` VALUES ('47', '4179a1a0-11ff-4b76-a244-c0880449cabc', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', '95346bc5-37e3-446f-a653-013dc646a052', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);
INSERT INTO `price_rule_items` VALUES ('48', 'f8633c25-d124-4f3d-a074-703758c0c7ef', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', '0030611b-fcac-4ef6-96bf-c4f1dbfe0f9a', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);
INSERT INTO `price_rule_items` VALUES ('49', '4f42e4d8-8e54-4925-9ff8-07ec9480e08d', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', '7b421504-e18d-4dac-891f-3aba84fbc2f8', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);
INSERT INTO `price_rule_items` VALUES ('50', '0b953b1a-c2e2-430b-a3b5-4659823bcde3', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', 'b9dc1fa9-1b4c-4ba2-a8e2-59e1f2a04fbb', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);
INSERT INTO `price_rule_items` VALUES ('51', '395a5b78-781f-4aa4-af54-7a980b5390ff', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', 'e27d1deb-f851-4b6a-b9a9-c1c9bd9f4b63', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);
INSERT INTO `price_rule_items` VALUES ('52', '7cba2f06-ac7a-474d-a4e5-4a07c9fd5390', '4adb2875-613d-4f63-b2f4-f76287d4b5e9', '2b53a24e-0225-4bc6-a93e-5c4f86ba5da3', '2021-05-06 03:33:50', '2021-05-06 03:33:50', null);

-- ----------------------------
-- Table structure for project_list
-- ----------------------------
DROP TABLE IF EXISTS `project_list`;
CREATE TABLE `project_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `project_code` varchar(255) DEFAULT '',
  `project_name` varchar(255) DEFAULT NULL,
  `project_shortname` varchar(255) DEFAULT NULL,
  `project_type_uuid` varchar(255) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `profit` decimal(10,2) DEFAULT NULL,
  `ocm` decimal(10,2) DEFAULT NULL,
  `tax_charge` decimal(10,2) DEFAULT NULL,
  `other` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of project_list
-- ----------------------------
INSERT INTO `project_list` VALUES ('1', '6b92773d-e8c5-43ed-ae82-6b1f387445c7', 'PR_TH2021050800001', 'John House Project', 'Prj-1', 'cf90019a-9c83-44f1-832d-63a359eedecd', '2021-05-08', null, '200000.00', '0.00', '0.00', '0.00', '0.00', '2021-05-01 12:36:05', '2021-05-08 03:56:59', null);
INSERT INTO `project_list` VALUES ('2', '51512bf4-f940-460e-85bb-7f6a2cb9e2cf', 'PR_TH2021050800001', 'CDO Bridge Project', 'Prj-2', 'e4d39874-0b2b-4396-8296-b07729daaf78', '2021-05-08', null, '500000.00', '0.00', '0.00', '0.00', '0.00', '2021-05-08 04:12:44', '2021-05-08 04:13:28', null);

-- ----------------------------
-- Table structure for project_scope
-- ----------------------------
DROP TABLE IF EXISTS `project_scope`;
CREATE TABLE `project_scope` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `scope_of_work` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of project_scope
-- ----------------------------
INSERT INTO `project_scope` VALUES ('1', '2d3808ef-de83-4c9d-9bfa-6c2aba978d75', 'Facilities For The Engineer', '2021-04-27 03:29:25', '2021-04-27 03:29:25', null);
INSERT INTO `project_scope` VALUES ('2', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', 'Earthwork', '2021-04-27 03:31:24', '2021-04-27 03:31:24', null);
INSERT INTO `project_scope` VALUES ('3', '966d274e-d4c2-4a65-9fac-0dceb351fdf2', 'Piling Work', '2021-04-27 03:32:23', '2021-04-27 03:32:23', null);
INSERT INTO `project_scope` VALUES ('4', '60bb545c-0d34-402f-87be-258621dc8012', 'Finishing and Other Civil Work', '2021-04-27 03:42:22', '2021-04-27 03:42:22', null);

-- ----------------------------
-- Table structure for project_scope_details
-- ----------------------------
DROP TABLE IF EXISTS `project_scope_details`;
CREATE TABLE `project_scope_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `project_scope_uuid` varchar(255) DEFAULT '',
  `detail` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of project_scope_details
-- ----------------------------
INSERT INTO `project_scope_details` VALUES ('1', '6af6102a-863e-47c8-b60c-dd8d839a051f', '2d3808ef-de83-4c9d-9bfa-6c2aba978d75', 'Office and Laboratory', '2021-04-27 03:29:25', '2021-04-27 03:29:25', null);
INSERT INTO `project_scope_details` VALUES ('2', '4d7a4bbd-8f5f-436f-a06d-14d4c1ced94c', '2d3808ef-de83-4c9d-9bfa-6c2aba978d75', 'Vehicles', '2021-04-27 03:29:25', '2021-04-27 03:29:25', null);
INSERT INTO `project_scope_details` VALUES ('3', 'cb8a78d4-a77e-4909-9b0c-258f5bf3197b', '2d3808ef-de83-4c9d-9bfa-6c2aba978d75', 'Staff and Equipment Assistance', '2021-04-27 03:29:25', '2021-04-27 03:29:25', null);
INSERT INTO `project_scope_details` VALUES ('4', '437388c3-04da-42b0-9854-4cf875cb8f0a', '2d3808ef-de83-4c9d-9bfa-6c2aba978d75', 'Photographs/Documentation', '2021-04-27 03:29:25', '2021-04-27 03:29:25', null);
INSERT INTO `project_scope_details` VALUES ('5', 'a5fe9a08-2c16-4ad6-a630-0f14b78c3fc2', '2d3808ef-de83-4c9d-9bfa-6c2aba978d75', 'Communication Facility', '2021-04-27 03:29:25', '2021-04-27 03:29:25', null);
INSERT INTO `project_scope_details` VALUES ('6', 'd5687d3f-6624-42c1-841a-55dd98e85cf3', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', 'Clearing and Grubbing', '2021-04-27 03:31:24', '2021-04-27 03:31:24', null);
INSERT INTO `project_scope_details` VALUES ('7', '0683aa9c-324e-4d21-95a0-c870e69186ad', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', 'Removal of Structures and Obstructions', '2021-04-27 03:31:24', '2021-04-27 03:31:24', null);
INSERT INTO `project_scope_details` VALUES ('8', '50604622-11c3-44e7-8f51-1f7273d4fd3d', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', 'Excavation', '2021-04-27 03:31:24', '2021-04-27 03:31:24', null);
INSERT INTO `project_scope_details` VALUES ('9', 'cb451caf-2aaa-4a27-888f-f9b67b9d084a', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', 'Structure Excavation', '2021-04-27 03:31:24', '2021-04-27 03:31:24', null);
INSERT INTO `project_scope_details` VALUES ('10', '887fdee2-fc1f-422b-b267-df3af4c0526b', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', 'Embankment', '2021-04-27 03:31:24', '2021-04-27 03:31:24', null);
INSERT INTO `project_scope_details` VALUES ('11', '57ee58fe-3b5d-460d-8cc1-4f7102658b74', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', 'Subgrade Preparation', '2021-04-27 03:31:24', '2021-04-27 03:31:24', null);
INSERT INTO `project_scope_details` VALUES ('12', '27ee41d2-afe4-4b04-a870-5848ee3cf914', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', 'Compaction Equipment and Density Control Strips', '2021-04-27 03:31:24', '2021-04-27 03:31:24', null);
INSERT INTO `project_scope_details` VALUES ('13', '5fb33e1d-3c1d-494e-be40-4d4eb991a3ed', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', 'Overhaul', '2021-04-27 03:31:24', '2021-04-27 03:31:24', null);
INSERT INTO `project_scope_details` VALUES ('14', '3cd06df8-55e6-4f37-a550-175cce1c37f2', '966d274e-d4c2-4a65-9fac-0dceb351fdf2', 'Piling', '2021-04-27 03:32:23', '2021-04-27 03:32:23', null);
INSERT INTO `project_scope_details` VALUES ('15', '181a7f51-f9d1-46fe-a582-2d14871e7f95', '60bb545c-0d34-402f-87be-258621dc8012', 'Termite Control Work', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('16', '360d5049-25a5-446b-bbd5-b2a6e9c5efd8', '60bb545c-0d34-402f-87be-258621dc8012', 'Storm Drainage and Sewerage System', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('17', 'c45727ca-1bed-49ae-bd42-b5dc03629696', '60bb545c-0d34-402f-87be-258621dc8012', 'Plumbing Works', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('18', '68e50c5b-64fb-4ea7-ab39-8eb510befac9', '60bb545c-0d34-402f-87be-258621dc8012', 'Carpentry and Joinery Works', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('19', '9b1b54f2-9cb7-4206-9e2c-c429b0ae21f5', '60bb545c-0d34-402f-87be-258621dc8012', 'Hardware', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('20', '25e9e462-4e95-41ec-9793-857b9fe4423f', '60bb545c-0d34-402f-87be-258621dc8012', 'Steel Windows', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('21', '1fdcfe87-b401-4448-b570-7fce166e81d7', '60bb545c-0d34-402f-87be-258621dc8012', 'Steel Doors and Frames', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('22', '001ce72f-49be-46af-a979-768fe6065706', '60bb545c-0d34-402f-87be-258621dc8012', 'Aluminum Framed Glass Doors', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('23', '1815b0c1-fdb2-4c5b-be0f-fe06efc2cbe9', '60bb545c-0d34-402f-87be-258621dc8012', 'Aluminum Glass Windows', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('24', 'd9cc23dd-2a7a-4b68-8436-30119ee1a307', '60bb545c-0d34-402f-87be-258621dc8012', 'Jalousie Windows', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('25', 'f523ce77-5808-4024-b810-8d79ab383934', '60bb545c-0d34-402f-87be-258621dc8012', 'Wooden Doors and Windows', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('26', 'b675e69a-e9ea-4b32-b763-ef3df338bf33', '60bb545c-0d34-402f-87be-258621dc8012', 'Roll-up Doors', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('27', '18f4a712-8020-4b90-a60b-387926741dbd', '60bb545c-0d34-402f-87be-258621dc8012', 'Glass and Glazing', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('28', 'edb9d876-daad-41d3-8e40-9db43c9203fb', '60bb545c-0d34-402f-87be-258621dc8012', 'Corrugated Metal Roofing', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('29', '15a7dc5e-fc61-4f14-b602-2aaa103a37a8', '60bb545c-0d34-402f-87be-258621dc8012', 'Corrugated Asphalt Roofing', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('30', '66ff2295-fe58-4448-a56b-ea480a2c6c15', '60bb545c-0d34-402f-87be-258621dc8012', 'Prepainted Metal Sheets', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('31', '0584f9df-1dd6-40d5-a2e0-34cc6b51f45f', '60bb545c-0d34-402f-87be-258621dc8012', 'Clay Roof Tile', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('32', 'f84e6d4a-4a11-475a-b981-cf7e153201ea', '60bb545c-0d34-402f-87be-258621dc8012', 'Waterproofing', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('33', '6aea119b-fbe5-406f-8b1a-ffa111e056a8', '60bb545c-0d34-402f-87be-258621dc8012', 'Roof Drains With Strainer', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('34', 'b5fbcd70-93d5-4fa8-9417-3d4fad770bcb', '60bb545c-0d34-402f-87be-258621dc8012', 'Ceramic/Granite Tiles', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('35', 'c978d92b-7eb7-4b77-9538-1deb49694641', '60bb545c-0d34-402f-87be-258621dc8012', 'Wood Tiles', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('36', '25bebe70-3b9a-41a5-9ac9-195fce7130cf', '60bb545c-0d34-402f-87be-258621dc8012', 'Vinyl Floor Tiles', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('37', '54388c61-cbdf-4033-bf4e-80fbf887da6e', '60bb545c-0d34-402f-87be-258621dc8012', 'Cement Floor Finish', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('38', 'ab830819-59f1-4a6b-b13f-0d4f8678ae7d', '60bb545c-0d34-402f-87be-258621dc8012', 'Stucco Finish', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('39', 'd37e13fa-58d1-4cc4-bbea-0ce2c1fb2376', '60bb545c-0d34-402f-87be-258621dc8012', 'Granolithic Marble Work', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('40', '88ecf8f4-b008-4ad9-833d-02a201f12ce1', '60bb545c-0d34-402f-87be-258621dc8012', 'Pea Gravel Wshout Finish', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('41', 'fc654299-a0c5-4737-9b5e-8a9d8df03f15', '60bb545c-0d34-402f-87be-258621dc8012', 'Bush Hammered Finish', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('42', '602732db-786c-499c-978c-dd0b3f7b4d14', '60bb545c-0d34-402f-87be-258621dc8012', 'Pebble Washout Finish', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('43', 'a963b6ff-16bc-4ce9-8ec4-d1e8e74c05f4', '60bb545c-0d34-402f-87be-258621dc8012', 'Cement Plaster Finish', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('44', 'a8c5074c-bc70-431b-a703-d439ea00d927', '60bb545c-0d34-402f-87be-258621dc8012', 'Syntetic Adobe', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('45', 'b4ffd73e-60bc-49fa-937d-b92b5915431b', '60bb545c-0d34-402f-87be-258621dc8012', 'Granatite Washout Finish', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('46', '48c1776d-f6ab-4730-8c12-3796ca39cf66', '60bb545c-0d34-402f-87be-258621dc8012', 'Acoustical Ceiling', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('47', '0586ed30-7530-4976-8fa1-9f5386b4bcb5', '60bb545c-0d34-402f-87be-258621dc8012', 'Acoustical Treatment', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('48', 'b9665f50-5ce5-40bb-8f68-4faf010b6fe8', '60bb545c-0d34-402f-87be-258621dc8012', 'Painting, Varnishing and Other Related Works', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('49', '46363f96-2f3c-4450-8d40-072995c83a9b', '60bb545c-0d34-402f-87be-258621dc8012', 'Metal Deck', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('50', '4fe50f2e-7aa6-4e83-9ba9-2b8f294ec99f', '60bb545c-0d34-402f-87be-258621dc8012', 'Damp Proofing', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('51', 'c39092a3-faef-40c8-94d0-d84ef70ddbb1', '60bb545c-0d34-402f-87be-258621dc8012', 'Non-Structural Metal Framing', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('52', 'a2a54a43-9cbf-4e23-bb67-f8354d11e779', '60bb545c-0d34-402f-87be-258621dc8012', 'Polycarbonate Sheets/Panels', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('53', 'bb3383d3-75a8-49c1-a6c7-a6a307a37d7c', '60bb545c-0d34-402f-87be-258621dc8012', 'Concrete Roof Tile', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('54', '76332fa9-0c29-4b34-9de3-d89875289edd', '60bb545c-0d34-402f-87be-258621dc8012', 'Reflective Insulation', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('55', '9a292d6c-832d-4cb1-b0ed-863ba2840258', '60bb545c-0d34-402f-87be-258621dc8012', 'Aluminum Cladding', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('56', 'b2f8385d-2b7c-40e3-9b59-2c9a6806e639', '60bb545c-0d34-402f-87be-258621dc8012', 'Metal Lath and Accessories', '2021-04-27 03:42:23', '2021-04-27 03:42:23', null);
INSERT INTO `project_scope_details` VALUES ('100', 'd8c0ddd1-220a-465e-a3bb-6b1ad30898d3', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', 'Dredging', '2021-05-01 12:37:13', '2021-05-01 12:37:13', null);

-- ----------------------------
-- Table structure for project_types
-- ----------------------------
DROP TABLE IF EXISTS `project_types`;
CREATE TABLE `project_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of project_types
-- ----------------------------
INSERT INTO `project_types` VALUES ('1', '1cc03247-9f5e-40c7-b564-cb5635fd227d', 'Highway', '2021-04-27 03:20:21', '2021-04-27 03:20:21', null);
INSERT INTO `project_types` VALUES ('2', 'e4d39874-0b2b-4396-8296-b07729daaf78', 'Bridges', '2021-04-27 03:22:17', '2021-04-27 03:22:17', null);
INSERT INTO `project_types` VALUES ('3', 'ff1fe61e-cdf3-4a90-9470-c27c91af13a5', 'Airports', '2021-04-27 03:22:32', '2021-04-27 03:22:32', null);
INSERT INTO `project_types` VALUES ('4', 'cf90019a-9c83-44f1-832d-63a359eedecd', 'Buildings', '2021-04-27 03:22:49', '2021-04-27 03:22:49', null);
INSERT INTO `project_types` VALUES ('5', 'eb39aca2-25c0-45cd-b592-4b64b1bef5d1', 'Ports and Harbors', '2021-04-27 03:23:06', '2021-04-27 03:23:06', null);
INSERT INTO `project_types` VALUES ('6', '38105635-d2ca-4b1b-842c-ca5d610e26eb', 'Flood Control and Drainage Structures', '2021-04-27 03:23:27', '2021-04-27 03:23:27', null);
INSERT INTO `project_types` VALUES ('7', '0e406128-ca54-479c-a1ea-27ca95bb26aa', 'Water Supply Systems', '2021-04-27 03:23:41', '2021-04-27 03:23:41', null);

-- ----------------------------
-- Table structure for project_type_scopes
-- ----------------------------
DROP TABLE IF EXISTS `project_type_scopes`;
CREATE TABLE `project_type_scopes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `project_type_uuid` varchar(255) DEFAULT '',
  `project_scope_uuid` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of project_type_scopes
-- ----------------------------
INSERT INTO `project_type_scopes` VALUES ('1', '39c84f03-fc0d-4646-b2fc-e3740524d12c', 'eb39aca2-25c0-45cd-b592-4b64b1bef5d1', '966d274e-d4c2-4a65-9fac-0dceb351fdf2', '2021-04-27 03:33:25', '2021-04-27 03:33:25', null);
INSERT INTO `project_type_scopes` VALUES ('2', '72449f99-9e1c-4912-8b8c-9df89f7580c6', 'cf90019a-9c83-44f1-832d-63a359eedecd', '2d3808ef-de83-4c9d-9bfa-6c2aba978d75', '2021-04-30 19:00:59', '2021-05-08 12:40:07', null);
INSERT INTO `project_type_scopes` VALUES ('3', '7ee353d8-124c-4555-aae8-9c6e9be38bce', 'e4d39874-0b2b-4396-8296-b07729daaf78', '60bb545c-0d34-402f-87be-258621dc8012', '2021-05-08 04:12:38', '2021-05-08 04:12:38', null);
INSERT INTO `project_type_scopes` VALUES ('4', '3a56ff13-8695-4a7d-954d-3a17ab6f5d37', 'e4d39874-0b2b-4396-8296-b07729daaf78', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', '2021-05-08 04:12:38', '2021-05-08 04:12:38', null);
INSERT INTO `project_type_scopes` VALUES ('5', '56b64e24-b85f-4109-98df-fcdcb3a2321e', 'e4d39874-0b2b-4396-8296-b07729daaf78', '2d3808ef-de83-4c9d-9bfa-6c2aba978d75', '2021-05-08 04:12:38', '2021-05-08 04:12:38', null);
INSERT INTO `project_type_scopes` VALUES ('6', 'c9d30684-87f3-4f4e-9f1a-6f988db41ff4', 'e4d39874-0b2b-4396-8296-b07729daaf78', '966d274e-d4c2-4a65-9fac-0dceb351fdf2', '2021-05-08 04:12:38', '2021-05-08 04:12:38', null);
INSERT INTO `project_type_scopes` VALUES ('7', 'bf3e6759-b076-4583-931d-6ecc524fda95', 'cf90019a-9c83-44f1-832d-63a359eedecd', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', '2021-05-08 12:40:07', '2021-05-08 12:40:07', null);
INSERT INTO `project_type_scopes` VALUES ('8', '04dfc94d-b642-438f-8817-69cb25f8382c', 'cf90019a-9c83-44f1-832d-63a359eedecd', '60bb545c-0d34-402f-87be-258621dc8012', '2021-05-08 12:40:07', '2021-05-08 12:40:07', null);

-- ----------------------------
-- Table structure for purchase_billings
-- ----------------------------
DROP TABLE IF EXISTS `purchase_billings`;
CREATE TABLE `purchase_billings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `transaction_no` varchar(255) NOT NULL,
  `supplier_uuid` varchar(255) NOT NULL,
  `branch_uuid` varchar(255) NOT NULL,
  `branch_location_uuid` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of purchase_billings
-- ----------------------------
INSERT INTO `purchase_billings` VALUES ('1', '53f36b6f-388f-4587-a3db-487dd98de6b5', 'BL_TH2021051200001', '57fc0388-caf3-40a1-99c8-b5de0481493b', 'f224cc74-a36c-4f60-b5c3-28ac5caf5373', 'fd21314d-a2a0-431e-bfb7-45cf1cc6cdc2', '2000.00', 'Expenses', '2021-05-12', 'To Pay', '2021-05-12 19:33:55', '2021-05-12 19:33:55', null);

-- ----------------------------
-- Table structure for purchase_billing_expenses
-- ----------------------------
DROP TABLE IF EXISTS `purchase_billing_expenses`;
CREATE TABLE `purchase_billing_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `purchase_billing_uuid` varchar(255) NOT NULL,
  `coa_uuid` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `memo_1` varchar(255) DEFAULT NULL,
  `memo_2` varchar(255) DEFAULT NULL,
  `memo_3` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of purchase_billing_expenses
-- ----------------------------

-- ----------------------------
-- Table structure for purchase_billing_projects
-- ----------------------------
DROP TABLE IF EXISTS `purchase_billing_projects`;
CREATE TABLE `purchase_billing_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `purchase_billing_uuid` varchar(255) NOT NULL,
  `project_uuid` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of purchase_billing_projects
-- ----------------------------
INSERT INTO `purchase_billing_projects` VALUES ('1', '7c7d2620-7df2-43cf-b516-4741873e91bc', '53f36b6f-388f-4587-a3db-487dd98de6b5', '6b92773d-e8c5-43ed-ae82-6b1f387445c7', '2021-05-12 19:33:55', '2021-05-12 19:33:55', null);
INSERT INTO `purchase_billing_projects` VALUES ('2', '547c7318-ebed-418f-b6e6-2dd4b2175445', '53f36b6f-388f-4587-a3db-487dd98de6b5', '51512bf4-f940-460e-85bb-7f6a2cb9e2cf', '2021-05-12 19:33:55', '2021-05-12 19:33:55', null);

-- ----------------------------
-- Table structure for purchase_billing_project_expenses
-- ----------------------------
DROP TABLE IF EXISTS `purchase_billing_project_expenses`;
CREATE TABLE `purchase_billing_project_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `purchase_billing_uuid` varchar(255) NOT NULL,
  `coa_uuid` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `project_uuid` varchar(255) DEFAULT NULL,
  `project_scope_uuid` varchar(255) DEFAULT '',
  `scope_details_uuid` varchar(255) DEFAULT '',
  `memo_1` varchar(255) DEFAULT '',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of purchase_billing_project_expenses
-- ----------------------------
INSERT INTO `purchase_billing_project_expenses` VALUES ('1', 'e2057c06-7fc3-45d5-adc1-4e79fa8173b4', '53f36b6f-388f-4587-a3db-487dd98de6b5', 'd9a83547-db23-4bd3-a0b3-0e0b927572a0', '200', '6b92773d-e8c5-43ed-ae82-6b1f387445c7', 'f25a7b53-de1a-4349-98eb-f073fcb35c79', '57ee58fe-3b5d-460d-8cc1-4f7102658b74', null, '2021-05-12 19:33:55', '2021-05-12 19:33:55', null);
INSERT INTO `purchase_billing_project_expenses` VALUES ('2', '9c956974-0d93-46a7-8c17-02ed6eb9e35d', '53f36b6f-388f-4587-a3db-487dd98de6b5', 'd9a83547-db23-4bd3-a0b3-0e0b927572a0', '1585.71', '51512bf4-f940-460e-85bb-7f6a2cb9e2cf', '2d3808ef-de83-4c9d-9bfa-6c2aba978d75', '437388c3-04da-42b0-9854-4cf875cb8f0a', null, '2021-05-12 19:33:55', '2021-05-12 19:33:55', null);

-- ----------------------------
-- Table structure for purchase_orders
-- ----------------------------
DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE `purchase_orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `po_no` varchar(255) DEFAULT '',
  `po_revision` int(11) DEFAULT NULL,
  `receiving_no` varchar(255) DEFAULT '',
  `billing_no` varchar(255) DEFAULT '',
  `item_group_uuid` varchar(255) DEFAULT NULL,
  `asset_group_uuid` varchar(255) DEFAULT NULL,
  `item_discount_group_uuid` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT '',
  `date_purchased` date DEFAULT NULL,
  `date_expected` date DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `date_billed` date DEFAULT NULL,
  `date_due` date DEFAULT NULL,
  `date_cancelled` date DEFAULT NULL,
  `memo` varchar(255) DEFAULT NULL,
  `memo_po` varchar(255) DEFAULT NULL,
  `memo_receiving` varchar(255) DEFAULT NULL,
  `supplier_uuid` varchar(255) DEFAULT NULL,
  `supplier_tax_rate` decimal(10,2) DEFAULT NULL,
  `po_status` varchar(255) DEFAULT '',
  `receiving_status` varchar(255) DEFAULT NULL,
  `billing_status` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `orders_reason_code_uuid` varchar(255) DEFAULT '',
  `receiving_reason_code` varchar(255) DEFAULT '',
  `bills_reason_code_uuid` varchar(255) DEFAULT NULL,
  `is_apply_tax` int(11) DEFAULT NULL,
  `branch_uuid` varchar(255) DEFAULT NULL,
  `branch_locations_uuid` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `billing_type` varchar(0) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of purchase_orders
-- ----------------------------

-- ----------------------------
-- Table structure for purchase_order_additional_discounts
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order_additional_discounts`;
CREATE TABLE `purchase_order_additional_discounts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `bp_order_uuid` varchar(255) DEFAULT '',
  `discount_type` varchar(255) DEFAULT NULL,
  `discount_name` varchar(255) DEFAULT NULL,
  `discount_rate` decimal(10,2) DEFAULT NULL,
  `discount_fixed` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of purchase_order_additional_discounts
-- ----------------------------

-- ----------------------------
-- Table structure for purchase_order_items
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order_items`;
CREATE TABLE `purchase_order_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `bp_order_uuid` varchar(255) DEFAULT '',
  `item_uuid` varchar(255) DEFAULT '',
  `barcode` varchar(255) DEFAULT NULL,
  `order_qty` int(11) DEFAULT NULL,
  `accepted_qty` int(11) DEFAULT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `gross_amount` decimal(10,2) DEFAULT NULL,
  `discount_rate` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `net_amount` decimal(10,2) DEFAULT NULL,
  `vat_amount` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `ir_gross_amount` decimal(10,2) DEFAULT NULL,
  `ir_discount_rate` decimal(10,2) DEFAULT NULL,
  `ir_discount_amount` decimal(10,2) DEFAULT NULL,
  `ir_net_amount` decimal(10,2) DEFAULT NULL,
  `ir_vat_amount` decimal(10,2) DEFAULT NULL,
  `ir_total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of purchase_order_items
-- ----------------------------

-- ----------------------------
-- Table structure for reason_codes
-- ----------------------------
DROP TABLE IF EXISTS `reason_codes`;
CREATE TABLE `reason_codes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) DEFAULT '',
  `details` varchar(255) DEFAULT '',
  `type` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of reason_codes
-- ----------------------------
INSERT INTO `reason_codes` VALUES ('1', '6e38c865-ed39-4b68-ac1b-1de8207f3140', 'IP', 'In-Process', 'Purchase Order', '2021-02-20 09:05:35', '2021-02-20 09:05:35', null);
INSERT INTO `reason_codes` VALUES ('2', '8a709d93-fba4-4386-9f00-ca329d393c88', 'TR', 'In-Transit', 'Purchase Order', '2021-02-20 09:07:05', '2021-02-20 09:07:05', null);
INSERT INTO `reason_codes` VALUES ('3', '8cb92d85-a063-49c2-af40-e81a5d21bf80', 'OH', 'Arrived but Put On Hold', 'Purchase Order', '2021-02-20 09:07:26', '2021-02-20 09:07:26', null);
INSERT INTO `reason_codes` VALUES ('4', '4f02b3f7-9982-466c-99af-de2579299d22', 'LT', 'Late Delivery ~ Trucking Issue', 'Purchase Order', '2021-02-20 09:07:46', '2021-02-20 09:07:46', null);
INSERT INTO `reason_codes` VALUES ('5', '96c219f8-406c-4802-a81d-415c2557d828', 'LF', 'Late Delivery ~ Force Majeur', 'Purchase Order', '2021-02-20 09:08:07', '2021-02-20 09:08:07', null);
INSERT INTO `reason_codes` VALUES ('6', '1f23ebf8-8c86-461c-ba0d-f28f6a9e2746', 'LO', 'Late Delivery ~ Others', 'Purchase Order', '2021-02-20 09:08:23', '2021-02-20 09:08:23', null);
INSERT INTO `reason_codes` VALUES ('7', 'bddecb5b-1afc-476a-93be-0ff60101da25', 'AP', 'Valid AP', 'Billing', '2021-02-20 09:15:05', '2021-02-20 09:15:05', null);
INSERT INTO `reason_codes` VALUES ('8', '21a2c238-fefa-4d03-b905-d05fd2bef365', 'CH', 'Deductions Issue ~ Charges', 'Billing', '2021-02-20 09:16:02', '2021-02-20 10:04:22', null);
INSERT INTO `reason_codes` VALUES ('9', '811f1082-46f7-49db-8d35-49a273b08456', 'IR', 'Deductions Issue ~ Inventory Returns', 'Billing', '2021-02-20 09:16:29', '2021-02-20 09:16:29', null);
INSERT INTO `reason_codes` VALUES ('10', 'ee03897f-aa63-4870-8d1d-6801ea9b51b6', 'PR', 'Deductions Issue ~ Promos', 'Billing', '2021-02-20 09:16:52', '2021-02-20 09:16:52', null);
INSERT INTO `reason_codes` VALUES ('11', 'd1f0eacc-0859-43a1-80bf-ae3371d2102d', 'OS', 'Over(Short) Payment', 'Billing', '2021-02-20 09:17:17', '2021-02-20 09:17:17', null);
INSERT INTO `reason_codes` VALUES ('12', 'ddc1a691-d3dc-42f1-af94-094ba4f3ef1f', 'WR', 'Write-Off', 'Billing', '2021-02-20 09:17:34', '2021-02-20 09:17:34', null);
INSERT INTO `reason_codes` VALUES ('13', 'be9055e4-480a-4501-9a3a-873b130bb723', 'BO', 'Damages and Bad Orders', 'Debit Memo', '2021-02-20 10:00:11', '2021-02-20 10:00:11', null);
INSERT INTO `reason_codes` VALUES ('14', '58fb7d83-fc5f-4530-ad9b-b0cd5bb65822', 'SR', 'Stock Returns', 'Debit Memo', '2021-02-20 10:01:14', '2021-02-20 10:01:14', null);
INSERT INTO `reason_codes` VALUES ('15', '308ec366-f039-4a2f-aa13-1f6782c77c03', 'OT', 'Other Adjustments', 'Debit Memo', '2021-02-20 10:01:56', '2021-02-20 10:01:56', null);
INSERT INTO `reason_codes` VALUES ('16', '522381fc-0d3b-4d00-83fc-6f1048bf2874', 'IP', 'In-Process', 'Sales Order', '2021-02-20 15:23:23', '2021-02-20 15:23:23', null);
INSERT INTO `reason_codes` VALUES ('17', 'e056206b-7fc6-45c8-9559-fb9d34249656', 'AR', 'Valid AR', 'Invoicing', '2021-02-20 15:58:05', '2021-02-20 15:58:05', null);
INSERT INTO `reason_codes` VALUES ('18', '2f217523-eb0b-4be2-919f-9d7a5d50f9d6', 'PD', 'Post Dated Check', 'Invoicing', '2021-02-20 15:58:40', '2021-02-20 15:58:40', null);
INSERT INTO `reason_codes` VALUES ('19', 'a648eed5-c8df-4953-857d-96437446f608', 'RC', 'Returned Check', 'Invoicing', '2021-02-20 15:59:21', '2021-02-20 15:59:21', null);
INSERT INTO `reason_codes` VALUES ('20', '7dea2cf6-e4ee-4684-9938-8d3a7ef62ab0', 'CH', 'Deductions Issue ~ Charges', 'Invoicing', '2021-02-20 15:59:41', '2021-02-20 15:59:41', null);
INSERT INTO `reason_codes` VALUES ('21', '53df68ed-4a0e-40d2-bc79-d33f0de075f8', 'TX', 'Deductions Issue ~ Creditable WT', 'Invoicing', '2021-02-20 15:59:58', '2021-02-20 15:59:58', null);
INSERT INTO `reason_codes` VALUES ('22', '47ab554c-691e-42b0-80fc-47d5621792ad', 'PR', 'Deductions Issue ~ Promos', 'Invoicing', '2021-02-20 16:00:19', '2021-02-20 16:00:19', null);
INSERT INTO `reason_codes` VALUES ('23', 'c2209473-665c-4b7a-8722-12aa72bab381', 'OS', 'Over(Short) Payment', 'Invoicing', '2021-02-20 16:00:34', '2021-02-20 16:00:34', null);
INSERT INTO `reason_codes` VALUES ('24', '8521986f-582f-4ff2-9b72-f12697006a93', 'WR', 'Write-Off', 'Invoicing', '2021-02-20 16:01:01', '2021-02-20 16:01:01', null);
INSERT INTO `reason_codes` VALUES ('25', '1b0840d7-bef6-4cba-9ac6-c46b90d277c5', 'BO', 'Damages and Bad Orders', 'Credit Memo', '2021-02-20 16:01:53', '2021-02-20 16:01:53', null);
INSERT INTO `reason_codes` VALUES ('26', 'ab8cf68f-ab19-4e3b-b698-cf8c4c74f088', 'SR', 'Stock Returns', 'Credit Memo', '2021-02-20 16:02:12', '2021-02-20 16:02:12', null);
INSERT INTO `reason_codes` VALUES ('27', 'c935d527-0622-42b2-a3dc-4ba750fa16fc', 'OT', 'Other Adjustments', 'Credit Memo', '2021-02-20 16:02:28', '2021-02-20 16:02:28', null);

-- ----------------------------
-- Table structure for supplier_check_payees
-- ----------------------------
DROP TABLE IF EXISTS `supplier_check_payees`;
CREATE TABLE `supplier_check_payees` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `supplier_uuid` varchar(255) DEFAULT NULL,
  `check_payee` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of supplier_check_payees
-- ----------------------------
INSERT INTO `supplier_check_payees` VALUES ('1', 'bc833b51-847a-4511-a0ab-4fd9747d69c7', '57fc0388-caf3-40a1-99c8-b5de0481493b', 'HEXA.ph Corp.', '2021-03-05 12:08:15', '2021-03-05 12:08:15', null);
INSERT INTO `supplier_check_payees` VALUES ('2', '8a9dc662-9e58-4971-8e8c-a93c087d05ae', '5d5d24b3-f48d-44e9-a8d0-e70d2d6e4106', 'Oro Grande Distributors, Inc.', '2021-03-05 12:21:56', '2021-03-05 12:21:56', null);
INSERT INTO `supplier_check_payees` VALUES ('3', '7ece2de0-c72d-4337-b60e-de4a8441be59', '259d1fce-f549-4484-865d-004e1c3fd3da', 'SAIGEE TRADING', '2021-03-05 12:32:25', '2021-03-06 02:46:40', null);
INSERT INTO `supplier_check_payees` VALUES ('4', '72d558c0-ef53-42b6-bd98-2c6546680766', 'ae782cbd-63bd-4ce4-b374-ba7012e55521', 'AMPER BROS. BUILDERS AND CONSTRUCTION SUPPLY', '2021-03-05 12:39:25', '2021-03-05 12:39:25', null);
INSERT INTO `supplier_check_payees` VALUES ('5', '1405b946-1901-4e23-956f-653dbdbb2c84', '46bac19f-5a5b-47b2-b3ac-f4bb26b7210e', 'test payee', '2021-03-11 17:25:47', '2021-03-11 17:27:21', '2021-03-11 17:27:21');
INSERT INTO `supplier_check_payees` VALUES ('6', '70026991-0704-4cfb-964f-06b9c8822dbe', '46bac19f-5a5b-47b2-b3ac-f4bb26b7210e', 'test', '2021-03-11 17:33:28', '2021-03-11 17:36:08', '2021-03-11 17:36:08');
INSERT INTO `supplier_check_payees` VALUES ('7', '684ca0fc-6934-49d8-8681-60256a0a9c63', 'db3e659a-4191-4e6b-8247-4afced13a481', 'ertet', '2021-03-12 03:52:24', '2021-03-12 03:53:47', '2021-03-12 03:53:47');
INSERT INTO `supplier_check_payees` VALUES ('8', 'dcc65977-fa3d-4db2-af54-0aa66994132f', '816b908b-b8e6-43f4-a0fd-a7376bcb95a8', 'BOX & BASICS', '2021-03-13 08:22:10', '2021-03-13 08:22:10', null);

-- ----------------------------
-- Table structure for supplier_contacts
-- ----------------------------
DROP TABLE IF EXISTS `supplier_contacts`;
CREATE TABLE `supplier_contacts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `supplier_uuid` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT '',
  `position` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of supplier_contacts
-- ----------------------------
INSERT INTO `supplier_contacts` VALUES ('10', '9f1e5730-95b1-4252-be4e-ea449842bbbe', '816b908b-b8e6-43f4-a0fd-a7376bcb95a8', 'KENNETH JOSEPH CASTILLO', 'PRESIDENT', 'kbcastillo@hexa.ph', '09101234567', '2021-03-23 17:16:08', '2021-03-23 17:28:37', null);
INSERT INTO `supplier_contacts` VALUES ('11', 'ddd567d4-d876-4d7b-ad00-fc8d4eeea114', '816b908b-b8e6-43f4-a0fd-a7376bcb95a8', 'SILVESTER AMPER', 'SALES REPRESENTATIVE', 'sramper@hexa.ph', '09101234567', '2021-03-23 17:33:32', '2021-03-23 17:33:32', null);

-- ----------------------------
-- Table structure for supplier_group
-- ----------------------------
DROP TABLE IF EXISTS `supplier_group`;
CREATE TABLE `supplier_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of supplier_group
-- ----------------------------
INSERT INTO `supplier_group` VALUES ('21', '1681e70e-b5bd-4c27-a00c-411f00183f41', 'Principal', '2021-03-05 11:45:39', '2021-03-05 11:45:39', null);
INSERT INTO `supplier_group` VALUES ('22', '483e475e-6524-4a37-9fac-c9c40b6d23b8', 'Distributor', '2021-03-05 11:45:54', '2021-03-05 11:45:54', null);
INSERT INTO `supplier_group` VALUES ('23', '15362c9b-24d4-4592-9dfe-fd4865ca686a', 'Local', '2021-03-05 11:46:06', '2021-03-05 11:46:06', null);
INSERT INTO `supplier_group` VALUES ('24', '434b3b7c-9b2c-4ed2-b108-deed9175d0b1', 'Hardware', '2021-03-05 12:35:19', '2021-03-05 12:35:19', null);

-- ----------------------------
-- Table structure for supplier_list
-- ----------------------------
DROP TABLE IF EXISTS `supplier_list`;
CREATE TABLE `supplier_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `supplier_name` varchar(255) DEFAULT '',
  `supplier_shortname` varchar(255) DEFAULT '',
  `tax_identification_no` varchar(255) DEFAULT '',
  `supplier_group_uuid` varchar(255) DEFAULT NULL,
  `lead_time` varchar(255) DEFAULT NULL,
  `is_transporter` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `vat_uuid` varchar(255) DEFAULT NULL,
  `ewt_uuid` varchar(255) DEFAULT NULL,
  `payment_term_uuid` varchar(255) DEFAULT NULL,
  `coa_payable_account_uuid` varchar(255) DEFAULT '',
  `coa_expense_account_uuid` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT '',
  `address_uuid` varchar(255) DEFAULT '',
  `address1` varchar(255) DEFAULT '',
  `cost_center_uuid` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of supplier_list
-- ----------------------------
INSERT INTO `supplier_list` VALUES ('24', '57fc0388-caf3-40a1-99c8-b5de0481493b', 'HEXA.ph Corp.', 'HEXA', '000-000-000-000', '1681e70e-b5bd-4c27-a00c-411f00183f41', '7', null, '1', '1e1fc3e0-6431-4597-a811-c4895057667d', 'f000df6e-745d-4ad3-9a04-124e9ea0dc93', '2da5250d-98ee-46c3-ab62-596c96432ba9', '076cb76b-1165-4c77-82d7-8ac6682f118c', 'd9a83547-db23-4bd3-a0b3-0e0b927572a0', 'support@hexa.ph', '09101234567', '5d703211-0499-497a-8cc9-93b392f968ec', 'mountain view', null, '2021-03-05 08:24:38', '2021-03-15 11:33:55', null);
INSERT INTO `supplier_list` VALUES ('25', '5d5d24b3-f48d-44e9-a8d0-e70d2d6e4106', 'Oro Grande Distributors, Inc.', 'OGDI', '000-000-000-000', '1681e70e-b5bd-4c27-a00c-411f00183f41', '7', '1', '1', '1e1fc3e0-6431-4597-a811-c4895057667d', null, '506c0f74-1623-4d6c-ac47-6bcad8ea9d2b', '076cb76b-1165-4c77-82d7-8ac6682f118c', null, 'sales@orogrande.com.ph', '09123456789', 'c1921889-c4cd-46b1-918b-b79b4f2b6666', 'warehouse 2 Montecarlo bldg', null, '2021-03-05 12:15:24', '2021-03-05 12:40:56', null);
INSERT INTO `supplier_list` VALUES ('26', '259d1fce-f549-4484-865d-004e1c3fd3da', 'SAIGEE TRADING', 'SAIGEE', '000-000-000-000', '15362c9b-24d4-4592-9dfe-fd4865ca686a', '3', '1', '1', null, null, '506c0f74-1623-4d6c-ac47-6bcad8ea9d2b', '076cb76b-1165-4c77-82d7-8ac6682f118c', null, 'sales@saigee.ph', '09134567890', 'c1921889-c4cd-46b1-918b-b79b4f2b6666', null, null, '2021-03-05 12:23:47', '2021-03-06 02:46:50', null);
INSERT INTO `supplier_list` VALUES ('27', 'ae782cbd-63bd-4ce4-b374-ba7012e55521', 'AMPER BROS. BUILDERS AND CONSTRUCTION SUPPLY', 'AMPER BROS.', '000-000-000-000', '1681e70e-b5bd-4c27-a00c-411f00183f41', '30', '1', '1', null, null, '506c0f74-1623-4d6c-ac47-6bcad8ea9d2b', '0ea6c313-dad5-4c12-8812-f38b5f0ea3ef', null, 'sales@amperbros.ph', '09876543210', 'c1921889-c4cd-46b1-918b-b79b4f2b6666', 'ORO CHAIN VILLAGE, ZONE 2', null, '2021-03-05 12:35:29', '2021-03-05 12:40:42', null);
INSERT INTO `supplier_list` VALUES ('30', '816b908b-b8e6-43f4-a0fd-a7376bcb95a8', 'BOX & BASICS', 'BOX & BASICS', '000-000-000-000', '483e475e-6524-4a37-9fac-c9c40b6d23b8', '7', '1', '1', '1e1fc3e0-6431-4597-a811-c4895057667d', 'f000df6e-745d-4ad3-9a04-124e9ea0dc93', '2da5250d-98ee-46c3-ab62-596c96432ba9', '076cb76b-1165-4c77-82d7-8ac6682f118c', null, 'aaa@aaa.ph', '09012345678', 'c1921889-c4cd-46b1-918b-b79b4f2b6666', 'Cugman', '6eecfbe4-1d62-4a79-92f6-1c5018399f7d', '2021-03-12 03:53:27', '2021-03-23 15:51:07', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `confirmation_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `is_verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Super Admin', 'kenjimagto@gmail.com', '$2y$10$ngu74aHEyZ87.Qkagtf9EebGvzTDfmMgfYxk6ISV1yhtklbXqAqA2', null, 'Kenji', 'Magto', '09171234567', null, null, '0', '2020-07-08 05:42:12', '2020-07-08 05:42:12', null);
INSERT INTO `users` VALUES ('2', 'User', 'user@hexa.ph', '$2y$10$ngu74aHEyZ87.Qkagtf9EebGvzTDfmMgfYxk6ISV1yhtklbXqAqA2', null, 'Chrolo', 'Chrolo', '101010100', null, 'CONF-c2472207-87dc-4f58-b5c6-302db3ec9254', '0', '2020-08-30 20:35:18', '2020-08-30 20:35:18', null);
INSERT INTO `users` VALUES ('3', 'Admin', 'admin@hexa.ph', '$2y$10$ngu74aHEyZ87.Qkagtf9EebGvzTDfmMgfYxk6ISV1yhtklbXqAqA2', null, 'Chrolo', 'Chrolo', '101010100', null, 'CONF-9d0db4bf-db17-46d0-b87d-9b5a641b85e8', '0', '2020-08-30 20:37:30', '2020-08-30 20:37:30', null);
INSERT INTO `users` VALUES ('4', 'Admin', 'kb.castillo@hexa.ph', '$2y$10$YMMP5pDY486TcMJX54mOkup9imV2snIqXfkrRSXJ84pJnBkyU9ADe', null, 'Kenneth Joseph', 'Castillo', '09088111700', '', 'CONF-c062f2a4-57b3-4c3a-8e2d-a527ee237035', '0', '2020-09-17 09:52:46', '2020-09-17 09:54:03', null);
