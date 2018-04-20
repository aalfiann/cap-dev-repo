/*
Navicat MariaDB Data Transfer

Source Server         : CAP-EXPRESS
Source Server Version : 100131
Source Host           : server.cap-express.co.id:3306
Source Database       : cap_dev

Target Server Type    : MariaDB
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-04-20 16:49:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mas_relation
-- ----------------------------
DROP TABLE IF EXISTS `mas_relation`;
CREATE TABLE `mas_relation` (
  `RelationID` int(11) NOT NULL AUTO_INCREMENT,
  `Relation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`RelationID`),
  KEY `RelationID` (`RelationID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
