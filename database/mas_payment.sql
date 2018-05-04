/*
Navicat MariaDB Data Transfer

Source Server         : CAP-EXPRESS
Source Server Version : 100131
Source Host           : server.cap-express.co.id:3306
Source Database       : cap_dev

Target Server Type    : MariaDB
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-05-05 04:27:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mas_payment
-- ----------------------------
DROP TABLE IF EXISTS `mas_payment`;
CREATE TABLE `mas_payment` (
  `PaymentID` int(11) NOT NULL AUTO_INCREMENT,
  `Payment` varchar(50) NOT NULL,
  PRIMARY KEY (`PaymentID`),
  KEY `PaymentID` (`PaymentID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mas_payment
-- ----------------------------
INSERT INTO `mas_payment` VALUES ('1', 'Cash');
INSERT INTO `mas_payment` VALUES ('2', 'Cheque');
INSERT INTO `mas_payment` VALUES ('3', 'Cod');
INSERT INTO `mas_payment` VALUES ('4', 'Credit');
INSERT INTO `mas_payment` VALUES ('5', 'Transfer Bank');
INSERT INTO `mas_payment` VALUES ('6', 'Transfer Form');
SET FOREIGN_KEY_CHECKS=1;
