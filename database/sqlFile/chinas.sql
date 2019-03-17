/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : mynumbers

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-03-17 22:48:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for chinas
-- ----------------------------
DROP TABLE IF EXISTS `chinas`;
CREATE TABLE `chinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(16) NOT NULL COMMENT '省份',
  `population` int(10) NOT NULL,
  `data_date` year(4) NOT NULL COMMENT '数据年份',
  `created_at` datetime NOT NULL COMMENT '数据创建时间',
  `updated_at` datetime NOT NULL COMMENT '数据更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chinas
-- ----------------------------
INSERT INTO `chinas` VALUES ('1', '广东', '111690000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('2', '山东', '100058300', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('3', '河南', '95591300', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('4', '四川', '83020000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('5', '江苏', '80293000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('6', '河北', '75195200', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('7', '湖南', '68602000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('8', '安徽', '62548000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('9', '湖北', '59020000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('10', '浙江', '56570000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('11', '广西', '48850000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('12', '云南', '48005000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('13', '江西', '46221000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('14', '辽宁', '43689000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('15', '福建', '39110000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('16', '陕西', '38354400', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('17', '黑龙江', '37887000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('18', '山西', '37023500', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('19', '贵州', '35800000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('20', '重庆', '30484300', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('21', '吉林', '27174300', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('22', '甘肃', '26257100', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('23', '内蒙古', '25286000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('24', '新疆', '24446700', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('25', '上海', '24183300', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('26', '台湾', '23690000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('27', '北京', '21707000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('28', '天津', '15568700', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('29', '海南', '9257600', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('30', '香港', '7430000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('31', '宁夏', '6817900', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('32', '青海', '5983800', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('33', '西藏', '3371500', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
INSERT INTO `chinas` VALUES ('34', '澳门', '632000', '2018', '2019-02-27 00:22:17', '2019-02-27 00:22:17');
SET FOREIGN_KEY_CHECKS=1;
