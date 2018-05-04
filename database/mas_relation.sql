/*
Navicat MariaDB Data Transfer

Source Server         : CAP-EXPRESS
Source Server Version : 100131
Source Host           : server.cap-express.co.id:3306
Source Database       : cap_dev

Target Server Type    : MariaDB
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-05-05 04:27:00
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

-- ----------------------------
-- Records of mas_relation
-- ----------------------------
INSERT INTO `mas_relation` VALUES ('1', 'YBS');
INSERT INTO `mas_relation` VALUES ('2', 'AYAH');
INSERT INTO `mas_relation` VALUES ('3', 'IBU');
INSERT INTO `mas_relation` VALUES ('4', 'ANAK');
INSERT INTO `mas_relation` VALUES ('5', 'KAKAK');
INSERT INTO `mas_relation` VALUES ('6', 'ADIK');
INSERT INTO `mas_relation` VALUES ('7', 'KAKEK');
INSERT INTO `mas_relation` VALUES ('8', 'NENEK');
INSERT INTO `mas_relation` VALUES ('9', 'SAUDARA');
INSERT INTO `mas_relation` VALUES ('10', 'PEMBANTU');
INSERT INTO `mas_relation` VALUES ('11', 'SECURITY');
INSERT INTO `mas_relation` VALUES ('12', 'TETANGGA');
INSERT INTO `mas_relation` VALUES ('13', 'SUAMI');
INSERT INTO `mas_relation` VALUES ('14', 'ISTRI');
INSERT INTO `mas_relation` VALUES ('15', 'TEMAN');
INSERT INTO `mas_relation` VALUES ('16', 'CS');
INSERT INTO `mas_relation` VALUES ('17', 'STAFF');
INSERT INTO `mas_relation` VALUES ('18', 'FO');
SET FOREIGN_KEY_CHECKS=1;
