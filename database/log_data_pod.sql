/*
Navicat MariaDB Data Transfer

Source Server         : CAP-EXPRESS
Source Server Version : 100131
Source Host           : server.cap-express.co.id:3306
Source Database       : cap_dev

Target Server Type    : MariaDB
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-04-20 16:49:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for log_data_pod
-- ----------------------------
DROP TABLE IF EXISTS `log_data_pod`;
CREATE TABLE `log_data_pod` (
  `ItemID` bigint(20) NOT NULL AUTO_INCREMENT,
  `BranchID` varchar(10) DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `WayBill` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Recipient` varchar(50) DEFAULT NULL,
  `Relation` varchar(255) DEFAULT NULL,
  `DeliveryID` varchar(15) DEFAULT NULL,
  `StatusID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Updated_sys` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ItemID`),
  KEY `StatusID` (`StatusID`),
  KEY `ItemID` (`ItemID`),
  KEY `WayBill` (`WayBill`) USING BTREE,
  KEY `BranchID` (`BranchID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
