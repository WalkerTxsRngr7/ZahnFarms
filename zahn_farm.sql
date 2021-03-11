-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2021 at 07:33 PM
-- Server version: 8.0.20
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teaching`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int NOT NULL,
  `CategoryName` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(41, 'Beef'),
(42, 'Chicken'),
(43, 'Pork'),
(44,'Eggs'),
(45,'Vegetables'),
(46,'Fruit'),
(47,'Berries'),
(48,'Mushrooms');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int NOT NULL,
  `LName` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FName` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` int NOT NULL,
  `AdressLine1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AdressLine2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `City` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `State` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Postal` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `URL` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Text` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`URL`, `Text`) VALUES
('products.php/beef', 'Beef'),
('products.php/chicken', 'Chicken'),
('products.php/pork', 'Pork');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderID` int NOT NULL,
  `ProductID` int NOT NULL,
  `QuantityOrdered` int NOT NULL,
  `PriceEach` int NOT NULL,
  `OrderLineNumber` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int NOT NULL,
  `CustomerID` int NOT NULL,
  `OrderDate` date NOT NULL,
  `Status` int NOT NULL,
  `DeliveryDate` date NOT NULL,
  `DeliveryTime` time NOT NULL,
  `DeliveryLocation` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TotalPrice` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `CheckNumber` int NOT NULL,
  `CustomerID` int NOT NULL,
  `OrderID` int NOT NULL,
  `PaymentDate` date NOT NULL,
  `TotalPrice` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portions`
--

CREATE TABLE `portions` (
  `portionsID` int NOT NULL,
  `portionsName` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
  /*`portionsSize` int NOT NULL*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

INSERT INTO `portions` (`portionsID`, `portionsName`) VALUES
(50, 'bunches'),
(51, 'Individual'),
(52, 'Pint'),
(53, 'Quart'),
(54, 'KnownPounds'),
(55, 'UnknownPounds'),
(56,'Dozen');

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int DEFAULT NULL,
  `PortionsID` int NOT NULL,
  `sizeID` int DEFAULT NULL,
  `ProductName` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` int NOT NULL,
  'Quantity' int NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CategoryID` int NOT NULL,
  `InSeason` tinyint(1) NOT NULL,
  `Image` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
 /*
INSERT INTO `portions` (`ProductID`, `PortionsID`,'sizeID','ProductName','Price','Quanitity','Description','CategoryID','InSeason','Image') VALUES
('products.php/beef', 'Beef' ,'Beef'),
('products.php/chicken', 'Chicken','Chicken'),
('products.php/pork', 'Pork', 'Pork');
*/
--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `sizeID` int NOT NULL,
  `sizeName` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`URL`),
  ADD UNIQUE KEY `links_Text_uindex` (`Text`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`sizeID`),
  ADD KEY `sizeNameFK` (`sizeName`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
