/*
Navicat MariaDB Data Transfer

Source Server         : CAP-EXPRESS
Source Server Version : 100131
Source Host           : server.cap-express.co.id:3306
Source Database       : cap_dev

Target Server Type    : MariaDB
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-04-09 11:16:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mas_insurance
-- ----------------------------
DROP TABLE IF EXISTS `mas_insurance`;
CREATE TABLE `mas_insurance` (
  `InsuranceID` int(11) NOT NULL AUTO_INCREMENT,
  `Insurance` varchar(255) NOT NULL,
  `Premium` decimal(10,0) NOT NULL,
  `Min_Premium` decimal(10,0) NOT NULL,
  PRIMARY KEY (`InsuranceID`),
  KEY `InsuranceID` (`InsuranceID`),
  KEY `Insurance` (`Insurance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
