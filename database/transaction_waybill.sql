/*
Navicat MariaDB Data Transfer

Source Server         : CAP-EXPRESS
Source Server Version : 100131
Source Host           : server.cap-express.co.id:3306
Source Database       : cap_dev

Target Server Type    : MariaDB
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-04-16 15:31:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for transaction_waybill
-- ----------------------------
DROP TABLE IF EXISTS `transaction_waybill`;
CREATE TABLE `transaction_waybill` (
  `Waybill` varchar(20) NOT NULL,
  `BranchID` varchar(10) NOT NULL,
  `CustomerID` varchar(20) DEFAULT NULL,
  `Consignor_name` varchar(50) NOT NULL,
  `Consignor_alias` varchar(50) DEFAULT NULL,
  `Consignor_address` varchar(255) NOT NULL,
  `Consignor_phone` varchar(15) NOT NULL,
  `Consginor_fax` varchar(15) DEFAULT NULL,
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
  `Goods_value` decimal(10,2) NOT NULL,
  `Weight` decimal(7,2) NOT NULL,
  `Weight_real` decimal(7,2) NOT NULL,
  `Origin` varchar(50) NOT NULL,
  `Destination` varchar(50) NOT NULL,
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
  `Shipping_estimation` varchar(7) NOT NULL,
  `Tariff_kgp` decimal(10,0) NOT NULL,
  `Tariff_kgs` decimal(10,0) NOT NULL,
  `Tariff_hkgp` decimal(10,0) NOT NULL,
  `Tariff_hkgs` decimal(10,0) NOT NULL,
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
  KEY `Origin` (`Origin`),
  KEY `Destination` (`Destination`),
  KEY `PaymentID` (`PaymentID`),
  KEY `StatusID` (`StatusID`),
  KEY `Created_at` (`Created_at`),
  KEY `Created_by` (`Created_by`),
  KEY `BranchID` (`BranchID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
