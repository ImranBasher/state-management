-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2024 at 02:42 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boq`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblboqcategory`
--

CREATE TABLE `tblboqcategory` (
  `BoqCategoryID` int NOT NULL,
  `BoqCategoryUUID` varchar(100) DEFAULT NULL,
  `CategoryName` varchar(255) DEFAULT NULL,
  `BoqCategoryIsActive` int DEFAULT NULL,
  `BoqCategoryIsDisplay` int DEFAULT NULL,
  `UserIDInserted` int NOT NULL DEFAULT '0',
  `UserIDUpdated` int NOT NULL DEFAULT '0',
  `UserIDLocked` int NOT NULL DEFAULT '0',
  `DateInserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DateLocked` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ProjectID` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tblboqcategory`
--

INSERT INTO `tblboqcategory` (`BoqCategoryID`, `BoqCategoryUUID`, `CategoryName`, `BoqCategoryIsActive`, `BoqCategoryIsDisplay`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`, `ProjectID`) VALUES
(1, NULL, 'PLERIMINARY WORKS', NULL, NULL, 0, 0, 0, '2024-11-11 16:06:37', '2024-11-11 16:07:43', '2024-11-11 16:06:37', 1),
(2, NULL, 'FOUNDATION', NULL, NULL, 0, 0, 0, '2024-11-11 16:15:50', '2024-11-11 16:16:12', '2024-11-11 16:15:50', 1),
(3, NULL, 'RCC WORKS IN SUPERSTRUCTURE', NULL, NULL, 0, 0, 0, '2024-11-11 17:07:16', '2024-11-11 17:08:01', '2024-11-11 17:07:16', 2),
(4, NULL, 'ELEVATION', NULL, NULL, 0, 0, 0, '2024-11-11 17:14:23', '2024-11-11 18:47:32', '2024-11-11 17:14:23', 2),
(8, NULL, 'hggy', NULL, NULL, 0, 0, 0, '2024-11-22 00:45:28', '2024-11-22 00:45:32', '2024-11-22 00:45:28', 7),
(9, NULL, 'ggg', NULL, NULL, 0, 0, 0, '2024-11-22 00:46:18', '2024-11-22 00:46:34', '2024-11-22 00:46:18', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tblboqsubcategory`
--

CREATE TABLE `tblboqsubcategory` (
  `BoqSubcategoryID` int NOT NULL,
  `BoqCategoryID` int NOT NULL,
  `BoqSubcategoryUUID` varchar(100) DEFAULT NULL,
  `SubcategoryName` varchar(255) DEFAULT NULL,
  `SubcategoryUnit` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `SubcategoryQty` decimal(10,2) DEFAULT NULL,
  `SubcategoryRate` decimal(10,2) DEFAULT NULL,
  `SubcategoryCost` decimal(15,4) DEFAULT NULL,
  `BoqSubcategoryIsActive` int DEFAULT NULL,
  `BoqSubcategoryIsDisplay` int DEFAULT NULL,
  `UserIDInserted` int NOT NULL DEFAULT '0',
  `UserIDUpdated` int NOT NULL DEFAULT '0',
  `UserIDLocked` int NOT NULL DEFAULT '0',
  `DateInserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateLocked` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tblboqsubcategory`
--

INSERT INTO `tblboqsubcategory` (`BoqSubcategoryID`, `BoqCategoryID`, `BoqSubcategoryUUID`, `SubcategoryName`, `SubcategoryUnit`, `SubcategoryQty`, `SubcategoryRate`, `SubcategoryCost`, `BoqSubcategoryIsActive`, `BoqSubcategoryIsDisplay`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES
(1, 1, NULL, 'Site installation', 'ff', '1.00', '800000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:06:37', '2024-11-11 16:06:37', '2024-11-11 16:06:37'),
(2, 1, NULL, 'Excavations in site', 'm^3', '206.65', '5000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:09:03', '2024-11-11 16:09:03', '2024-11-11 16:09:03'),
(3, 1, NULL, 'Demolition of existing infastructure and transprtaion  of demolished materials', 'ff', '1.00', '1000000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:13:16', '2024-11-11 16:13:16', '2024-11-11 16:13:16'),
(4, 1, NULL, 'Anti-termite treatment', 'm^2', '90.81', '500.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:14:25', '2024-11-11 16:14:25', '2024-11-11 16:14:25'),
(5, 2, NULL, 'Excavations in foundation', 'm^3', '36.30', '5000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:15:50', '2024-11-11 16:15:50', '2024-11-11 16:15:50'),
(6, 2, NULL, 'Blinding concrete', 'm^3', '27.20', '90000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:17:48', '2024-11-11 16:17:48', '2024-11-11 16:17:48'),
(7, 2, NULL, 'Foundation in stone masonry with motar mixed at  300kg', 'm^3', '32.69', '50000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:18:38', '2024-11-11 16:18:38', '2024-11-11 16:18:38'),
(8, 2, NULL, 'Plain conrete on foundation (Chape)', 'm^3', '0.87', '90000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:18:40', '2024-11-11 16:18:40', '2024-11-11 16:18:40'),
(9, 2, NULL, 'Damp proof course (Roofing)', 'm3', '36.32', '1000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:18:43', '2024-11-11 16:18:43', '2024-11-11 16:18:43'),
(10, 2, NULL, 'RCC footings, mix ratio 350kg/m3', 'm3', '2.05', '250000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:18:45', '2024-11-11 16:18:45', '2024-11-11 16:18:45'),
(11, 2, NULL, 'RCC starter columns, mix ratio 350kg/m3', 'm3', '1.04', '300000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:18:46', '2024-11-11 16:18:46', '2024-11-11 16:18:46'),
(12, 2, NULL, 'Stone hardcore', 'm3', '167.00', '2500.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:18:52', '2024-11-11 16:18:52', '2024-11-11 16:18:52'),
(13, 2, NULL, 'RCC ground slab, 7cm thick, reinforced with 6mm  dia bars', 'm3', '3.79', '220000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 16:18:54', '2024-11-11 16:18:54', '2024-11-11 16:18:54'),
(14, 3, NULL, 'RCC Columns mix ratio 350kg/m3', 'm3', '2.80', '300000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 17:07:16', '2024-11-11 17:07:16', '2024-11-11 17:07:16'),
(15, 4, NULL, 'Masonry elevation with Superior quality concrete  blocs, mix ratio 300kg/m3', 'm3', '39.70', '60000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 17:14:23', '2024-11-11 17:14:23', '2024-11-11 17:14:23'),
(22, 3, NULL, 'RCC Lintels, mix ration 350kg/m3', 'm3', '3.79', '250000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 18:42:39', '2024-11-11 18:42:39', '2024-11-11 18:42:39'),
(21, 3, NULL, 'RC Slab structure mix ratio 350kg/m3 reinforced  with 12 and 10 mm dia bars', 'm3', '5.10', '250000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 18:42:39', '2024-11-11 18:42:39', '2024-11-11 18:42:39'),
(20, 3, NULL, 'RCC Beams, mix ratio 350kg/m3 (Tie beam)', 'm3', '17.90', '270000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 18:42:16', '2024-11-11 18:42:16', '2024-11-11 18:42:16'),
(23, 3, NULL, 'RCC in stairs', 'm3', '5.30', '270000.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-11 18:43:20', '2024-11-11 18:43:20', '2024-11-11 18:43:20'),
(32, 4, NULL, 'jjjj', 'm3', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '2024-11-13 00:41:00', '2024-11-13 00:41:00', '2024-11-13 00:41:00'),
(33, 8, NULL, 'nnu', 'ff', '3.00', '30.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-22 00:45:28', '2024-11-22 00:45:28', '2024-11-22 00:45:28'),
(34, 8, NULL, 'jjh', 'ff', '55.00', '100.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-22 00:45:48', '2024-11-22 00:45:48', '2024-11-22 00:45:48'),
(35, 9, NULL, 'yy', 'hh', '77.00', '100.00', NULL, NULL, NULL, 0, 0, 0, '2024-11-22 00:46:18', '2024-11-22 00:46:18', '2024-11-22 00:46:18'),
(36, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '2024-11-22 00:47:12', '2024-11-22 00:47:12', '2024-11-22 00:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblproject`
--

CREATE TABLE `tblproject` (
  `ProjectID` int NOT NULL,
  `ProjectUUID` char(36) DEFAULT NULL,
  `ProjectName` varchar(255) DEFAULT NULL,
  `BOQTitle` varchar(255) DEFAULT NULL,
  `ProjectIsActive` tinyint(1) DEFAULT NULL,
  `ProjectIsDisplay` tinyint(1) DEFAULT NULL,
  `UserIDInserted` int DEFAULT NULL,
  `UserIDUpdated` int DEFAULT NULL,
  `UserIDLocked` int DEFAULT NULL,
  `DateInserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DateLocked` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tblproject`
--

INSERT INTO `tblproject` (`ProjectID`, `ProjectUUID`, `ProjectName`, `BOQTitle`, `ProjectIsActive`, `ProjectIsDisplay`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES
(1, NULL, 'Project A', 'Floor 1', NULL, NULL, NULL, NULL, NULL, '2024-11-11 16:06:17', '2024-11-11 16:06:36', NULL),
(2, NULL, 'Project A', 'Floor 2', NULL, NULL, NULL, NULL, NULL, '2024-11-11 17:07:00', '2024-11-11 17:07:16', NULL),
(7, NULL, 'ff', 'ff', NULL, NULL, NULL, NULL, NULL, '2024-11-22 00:45:23', '2024-11-22 00:45:25', NULL),
(6, NULL, 'hel', NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-12 10:58:35', '2024-11-12 10:58:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblboqcategory`
--
ALTER TABLE `tblboqcategory`
  ADD PRIMARY KEY (`BoqCategoryID`),
  ADD KEY `fk_project` (`ProjectID`);

--
-- Indexes for table `tblboqsubcategory`
--
ALTER TABLE `tblboqsubcategory`
  ADD PRIMARY KEY (`BoqSubcategoryID`);

--
-- Indexes for table `tblproject`
--
ALTER TABLE `tblproject`
  ADD PRIMARY KEY (`ProjectID`),
  ADD UNIQUE KEY `ProjectUUID` (`ProjectUUID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblboqcategory`
--
ALTER TABLE `tblboqcategory`
  MODIFY `BoqCategoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblboqsubcategory`
--
ALTER TABLE `tblboqsubcategory`
  MODIFY `BoqSubcategoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblproject`
--
ALTER TABLE `tblproject`
  MODIFY `ProjectID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
