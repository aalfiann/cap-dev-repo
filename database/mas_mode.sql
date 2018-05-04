/*
Navicat MariaDB Data Transfer

Source Server         : CAP-EXPRESS
Source Server Version : 100131
Source Host           : server.cap-express.co.id:3306
Source Database       : cap_dev

Target Server Type    : MariaDB
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-05-05 04:27:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mas_mode
-- ----------------------------
DROP TABLE IF EXISTS `mas_mode`;
CREATE TABLE `mas_mode` (
  `ModeID` int(11) NOT NULL AUTO_INCREMENT,
  `Mode` varchar(20) NOT NULL,
  PRIMARY KEY (`ModeID`),
  KEY `ModeID` (`ModeID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mas_mode
-- ----------------------------
INSERT INTO `mas_mode` VALUES ('1', 'Air Freight');
INSERT INTO `mas_mode` VALUES ('2', 'Road Freight');
INSERT INTO `mas_mode` VALUES ('3', 'Sea Freight');
SET FOREIGN_KEY_CHECKS=1;
