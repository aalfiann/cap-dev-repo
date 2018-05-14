/*
Navicat MariaDB Data Transfer

Source Server         : CAP-EXPRESS
Source Server Version : 100131
Source Host           : server.cap-express.co.id:3306
Source Database       : cap_dev

Target Server Type    : MariaDB
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-05-14 13:40:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tariff_data
-- ----------------------------
DROP TABLE IF EXISTS `tariff_data`;
CREATE TABLE `tariff_data` (
  `BranchID` varchar(10) NOT NULL,
  `Kabupaten` varchar(255) NOT NULL,
  `ModeID` int(11) NOT NULL,
  `KGP` decimal(10,0) NOT NULL,
  `KGS` decimal(10,0) NOT NULL,
  `Min_Kg` decimal(5,0) NOT NULL,
  `Estimasi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`BranchID`,`Kabupaten`,`ModeID`),
  KEY `BranchID` (`BranchID`),
  KEY `Kabupaten` (`Kabupaten`),
  KEY `ModeID` (`ModeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tariff_handling
-- ----------------------------
DROP TABLE IF EXISTS `tariff_handling`;
CREATE TABLE `tariff_handling` (
  `Kabupaten` varchar(50) NOT NULL,
  `ModeID` int(11) NOT NULL,
  `KGP` decimal(10,0) NOT NULL,
  `KGS` decimal(10,0) NOT NULL,
  `Min_Kg` decimal(5,0) NOT NULL,
  PRIMARY KEY (`Kabupaten`,`ModeID`),
  KEY `Kabupaten` (`Kabupaten`),
  KEY `ModeID` (`ModeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
