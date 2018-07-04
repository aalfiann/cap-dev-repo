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

-- ----------------------------
-- Table structure for mas_relation
-- ----------------------------
DROP TABLE IF EXISTS `mas_relation`;
CREATE TABLE `mas_relation` (
  `RelationID` int(11) NOT NULL AUTO_INCREMENT,
  `Relation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`RelationID`),
  KEY `RelationID` (`RelationID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- ----------------------------
-- Table structure for transaction_waybill
-- ----------------------------
DROP TABLE IF EXISTS `transaction_waybill`;
CREATE TABLE `transaction_waybill` (
  `Waybill` varchar(20) NOT NULL,
  `BranchID` varchar(10) NOT NULL,
  `DestID` varchar(10) NOT NULL,
  `CustomerID` varchar(20) DEFAULT NULL,
  `Consignor_name` varchar(50) NOT NULL,
  `Consignor_alias` varchar(50) DEFAULT NULL,
  `Consignor_address` varchar(255) NOT NULL,
  `Consignor_phone` varchar(15) NOT NULL,
  `Consignor_fax` varchar(15) DEFAULT NULL,
  `Consignor_email` varchar(50) DEFAULT NULL,
  `ReferenceID` varchar(20) DEFAULT NULL,
  `Consignee_name` varchar(50) NOT NULL,
  `Consignee_attention` varchar(50) DEFAULT NULL,
  `Consignee_address` varchar(255) NOT NULL,
  `Consignee_phone` varchar(15) NOT NULL,
  `Consignee_fax` varchar(15) DEFAULT NULL,
  `ModeID` int(11) NOT NULL,
  `Instruction` varchar(255) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `Goods_data` varchar(1000) NOT NULL,
  `Goods_koli` decimal(5,0) NOT NULL,
  `Goods_value` decimal(10,0) NOT NULL,
  `Weight` decimal(7,2) NOT NULL,
  `Weight_real` decimal(7,2) NOT NULL,
  `Origin` varchar(50) NOT NULL,
  `Destination` varchar(50) NOT NULL,
  `Estimation` varchar(7) NOT NULL,
  `Insurance_rate` decimal(7,2) NOT NULL,
  `Shipping_cost` decimal(10,0) NOT NULL,
  `Shipping_insurance` decimal(10,0) NOT NULL,
  `Shipping_packing` decimal(10,0) NOT NULL,
  `Shipping_forward` decimal(10,0) NOT NULL,
  `Shipping_handling` decimal(10,0) NOT NULL,
  `Shipping_surcharge` decimal(10,0) NOT NULL,
  `Shipping_admin` decimal(10,0) NOT NULL,
  `Shipping_discount` decimal(10,0) NOT NULL,
  `Shipping_cost_total` decimal(10,0) NOT NULL,
  `Tariff_kgp` decimal(10,0) NOT NULL,
  `Tariff_kgs` decimal(10,0) NOT NULL,
  `Tariff_kgp_min` decimal(4,0) NOT NULL,
  `Tariff_hkgp` decimal(10,0) NOT NULL,
  `Tariff_hkgs` decimal(10,0) NOT NULL,
  `Tariff_hkgp_min` decimal(4,0) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Created_by` varchar(20) NOT NULL,
  `Updated_at` datetime DEFAULT NULL,
  `Updated_by` varchar(20) DEFAULT NULL,
  `Updated_sys` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Waybill`),
  KEY `Waybill` (`Waybill`),
  KEY `CustomerID` (`CustomerID`),
  KEY `Consignor_name` (`Consignor_name`),
  KEY `Consignor_phone` (`Consignor_phone`),
  KEY `ReferenceID` (`ReferenceID`),
  KEY `Consignee_name` (`Consignee_name`),
  KEY `Consignee_phone` (`Consignee_phone`),
  KEY `ModeID` (`ModeID`),
  KEY `Destination` (`Destination`),
  KEY `PaymentID` (`PaymentID`),
  KEY `StatusID` (`StatusID`),
  KEY `Created_at` (`Created_at`),
  KEY `Created_by` (`Created_by`),
  KEY `BranchID` (`BranchID`),
  KEY `DestID` (`DestID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Add new core_status data
-- ----------------------------
INSERT INTO core_status (StatusID, Status)
SELECT * FROM (SELECT '53', 'return') AS tmp
WHERE NOT EXISTS (
    SELECT StatusID,Status FROM core_status WHERE StatusID ='53'
) LIMIT 1;
SET FOREIGN_KEY_CHECKS=1;
