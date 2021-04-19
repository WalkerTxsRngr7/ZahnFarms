-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 05:38 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zahnfarms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catID` int(11) NOT NULL,
  `catName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catID`, `catName`, `image`, `hide`) VALUES
(41, 'Beef', 'beef.jpg', 0),
(42, 'Chicken', 'chicken.jpg', 0),
(43, 'Pork', 'pork.jpg', 0),
(44, 'Eggs', 'eggs.jpg', 0),
(45, 'Vegetables', 'Carrots.jpg', 0),
(46, 'Fruit', 'Tomato.jpg', 0),
(47, 'Berries', 'strawberry.jpg', 0),
(48, 'Mushrooms', 'shiitake_mushroom.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `lName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressLine1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressLine2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `lName`, `fName`, `phone`, `addressLine1`, `addressLine2`, `city`, `state`, `postal`, `email`) VALUES
(1, 'Doe', 'John', '4175555555', '123 This St', NULL, 'Springfield', 'MO', '65804', 'thisemail@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `sizeID` int(10) DEFAULT NULL,
  `quantityOrdered` int(11) NOT NULL,
  `priceEach` int(11) NOT NULL,
  `orderLineNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderID`, `productID`, `sizeID`, `quantityOrdered`, `priceEach`, `orderLineNumber`) VALUES
(1, 3, NULL, 15, 4, 1),
(1, 4, 1, 3, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `status` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryDate` date NOT NULL,
  `deliveryTime` time NOT NULL,
  `deliveryLocation` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `customerID`, `orderDate`, `status`, `deliveryDate`, `deliveryTime`, `deliveryLocation`, `totalPrice`) VALUES
(1, 1, '2021-04-02', '1', '2021-04-09', '15:30:00', 'Farm', 26),
(2, 1, '2021-04-02', '1', '2021-04-09', '15:30:00', 'Farm', 26);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `checkNumber` int(11) DEFAULT NULL,
  `customerID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `paymentDate` date NOT NULL,
  `totalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portions`
--

CREATE TABLE `portions` (
  `portionsID` int(11) NOT NULL,
  `portionsName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portionsDesc` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portions`
--

INSERT INTO `portions` (`portionsID`, `portionsName`, `portionsDesc`) VALUES
(1, 'Bunches', '/ bunch'),
(2, 'Individual', NULL),
(3, 'Pint', '/ pint'),
(4, 'Quart', '/ quart'),
(5, 'KnownPounds', '/ lb'),
(6, 'UnknownPounds', '/ lb'),
(7, 'Dozen', '/ dozen');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `portionsID` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` decimal(10,1) DEFAULT NULL,
  `shortDesc` varchar(255) DEFAULT NULL,
  `fullDesc` varchar(255) DEFAULT NULL,
  `catID` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sizeID` int(11) DEFAULT NULL,
  `outOfSeason` tinyint(1) NOT NULL,
  `hide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `portionsID`, `price`, `qty`, `shortDesc`, `fullDesc`, `catID`, `image`, `sizeID`, `outOfSeason`, `hide`) VALUES
(1, 'Porkchop', 2, '4.00', '100.0', 'Pork chops short description.', 'Pork chops full description.', 43, 'Porkchop.jpg', 1, 0, 0),
(2, 'Pork', 6, '4.00', '100.0', 'Pork short description.', 'Pork  full description.', 43, 'pork.jpg', NULL, 0, 0),
(3, 'Bacon', 2, '4.00', '100.0', 'Bacon short description.', 'Bacon full description.', 43, 'Bacon.jpg', NULL, 0, 0),
(4, 'Steak', 6, '4.00', '100.0', 'Steak short description.', 'Steak full description.', 41, 'beef.jpg', 1, 0, 0),
(5, 'Bratwurst', 2, '4.00', '100.0', 'Bratwurst short description.', 'Bratwurst full description.', 41, 'Bratwurst.jpg', NULL, 0, 0),
(6, 'Cabbage', 2, '4.00', '100.0', 'Cabbage short description.', 'Cabbage full description.', 45, 'Cabbage.jpg', 1, 0, 0),
(7, 'Shiitake Mushrooms Dried', 3, '4.00', '100.0', 'Shiitake Mushrooms Dried short description.', 'Shiitake Mushrooms Dried full description.', 45, 'shiitake_mushroom.jpg', NULL, 0, 0),
(8, 'Shiitake Mushrooms Fresh', 4, '4.00', '100.0', 'Shiitake Mushrooms Fresh short description.', 'Shiitake Mushrooms Fresh full description.', 45, 'Shiitake_Mushrooms_Fresh.jpg', NULL, 0, 0),
(9, 'Okra', 4, '4.00', '100.0', 'Okra short description.', 'Okra full description.', 45, 'pork.jpg', NULL, 0, 0),
(11, 'Green Beans', 1, '4.00', '100.0', 'Green Beens short description.', 'Green Beens full description.', 45, 'Green_Beans.jpg', NULL, 0, 0),
(12, 'Red pepper', 2, '4.00', '100.0', 'Red pepper short description.', 'Red pepper full description.', 45, 'Red_Peppers.jpg', NULL, 0, 0),
(13, 'Green onion', 1, '4.00', '100.0', 'Green onion short description.', 'Green onion full description.', 45, 'Green_Onions.jpg', NULL, 0, 0),
(14, 'Ground Beef', 5, '4.00', '100.0', 'Ground Beef short description.', 'Ground beef description.', 41, 'Ground_beef.jpg', NULL, 0, 0),
(15, 'Onions', 5, '4.00', '100.0', '', 'Onions full description.', 45, 'Onions.jpg', 1, 0, 0),
(16, 'Dill', 1, '4.00', '100.0', 'Dill short description.', 'Dill full description.', 45, 'Dill.jpg', NULL, 0, 0),
(17, 'Carrots', 1, '4.00', '100.0', 'Carrots short description.', 'Carrots full description.', 45, 'Carrots.jpg', NULL, 0, 0),
(18, 'Cherry Tomatoes (red)', 4, '4.00', '100.0', 'Cherry Tomatoes (red) short description.', 'Cherry Tomatoes (red) full description.', 46, 'Cherry_Tomatoes.jpg', NULL, 0, 0),
(19, 'Cucumbers (Pickling)', 5, NULL, NULL, 'Cucumbers Pickled short description.', 'Cucumbers Pickled full description.', 46, 'Pickled_Cucumbers.jpg', 1, 0, 0),
(20, 'Cucumbers (Slicing)', 2, NULL, NULL, 'Cucumbers Sliced short description.', 'Cucumbers Sliced full description.', 46, 'Cucumber.jpg', 1, 0, 0),
(21, 'Yellow Squash', 2, NULL, NULL, 'Yellow Squash short description.', 'Yellow Squash full description.', 46, 'Yellow_Squash.jpg', 1, 0, 0),
(22, 'Table Tomatoes', 2, NULL, NULL, 'Table Tomatoes short description.', 'Table Tomatoes full description.', 46, 'Tomato.jpg', 1, 0, 0),
(23, 'Zucchini', 2, NULL, NULL, 'Zucchini short description.', 'Zucchini description.', 46, 'Zucchini.jpg', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `sizeID` int(11) NOT NULL,
  `sizeName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`sizeID`, `sizeName`, `price`, `qty`) VALUES
(1, 'Medium (1-1.5 lbs)', '5.00', '25.0'),
(1, 'Small (0.5-1 lbs)', '2.00', '50.0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderID`,`orderLineNumber`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `portions`
--
ALTER TABLE `portions`
  ADD PRIMARY KEY (`portionsID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `sizeID` (`sizeID`),
  ADD KEY `sizeID_2` (`sizeID`),
  ADD KEY `sizeID_3` (`sizeID`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`sizeID`,`sizeName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
