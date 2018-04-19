/*
Navicat MariaDB Data Transfer

Source Server         : CAP-EXPRESS
Source Server Version : 100131
Source Host           : server.cap-express.co.id:3306
Source Database       : cap_dev

Target Server Type    : MariaDB
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-04-19 17:17:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for log_data
-- ----------------------------
DROP TABLE IF EXISTS `log_data`;
CREATE TABLE `log_data` (
  `CodeID` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Username` varchar(50) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `ItemID` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ItemID`),
  KEY `StatusID` (`StatusID`),
  KEY `CodeID` (`CodeID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
