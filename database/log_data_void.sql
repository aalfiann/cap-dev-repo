/*
Navicat MariaDB Data Transfer

Source Server         : CAP-EXPRESS
Source Server Version : 100131
Source Host           : server.cap-express.co.id:3306
Source Database       : cap_dev

Target Server Type    : MariaDB
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-04-20 16:49:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for log_data_void
-- ----------------------------
DROP TABLE IF EXISTS `log_data_void`;
CREATE TABLE `log_data_void` (
  `ItemID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CodeID` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Updated_sys` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ItemID`),
  KEY `StatusID` (`StatusID`),
  KEY `CodeID` (`CodeID`) USING BTREE,
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
