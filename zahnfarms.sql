-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2021 at 07:47 PM
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
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catID`, `catName`, `image`) VALUES
(41, 'Beef', 'beef.jpg'),
(42, 'Chicken', ''),
(43, 'Pork', 'pork.jpg'),
(44, 'Eggs', ''),
(45, 'Vegetables', ''),
(46, 'Fruit', 'Tomato.jpg'),
(47, 'Berries', ''),
(48, 'Mushrooms', 'shiitake_mushroom.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `lName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `addressLine1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressLine2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
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
('products.php/pork', 'Pork'),
('products.php/eggs', 'Eggs'),
('products.php/mushrooms', 'Mushrooms'),
('products.php/fruit', 'Fruits'),
('products.php/berries', 'Berries'),
('products.php/vegetables', 'Vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantityOrdered` int(11) NOT NULL,
  `priceEach` int(11) NOT NULL,
  `orderLineNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `status` int(11) NOT NULL,
  `deliveryDate` date NOT NULL,
  `deliveryTime` time NOT NULL,
  `deliveryLocation` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(50, 'Bunches', '/ bunch'),
(51, 'Individual', NULL),
(52, 'Pint', '/ pint'),
(53, 'Quart', '/ quart'),
(54, 'KnownPounds', '/ lb'),
(55, 'UnknownPounds', '/ lb'),
(56, 'Dozen', '/ dozen');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `portionsID` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `shortDesc` varchar(255) DEFAULT NULL,
  `fullDesc` varchar(255) DEFAULT NULL,
  `catID` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sizeID` int(11) NOT NULL,
  `outOfSeason` tinyint(1) NOT NULL,
  `hide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `portionsID`, `price`, `qty`, `shortDesc`, `fullDesc`, `catID`, `image`, `sizeID`, `outOfSeason`, `hide`) VALUES
(1, 'Porkchop', 55, '3.99', '100.00', 'Pork chops short description.', 'Pork chops full description.', 43, 'Porkchop.jpg', 1, 0, 0),
(2, 'Pork', 55, '3.99', '100.00', 'Pork short description.', 'Pork  full description.', 43, 'pork.jpg', 1, 0, 0),
(3, 'Bacon', 55, '3.99', '100.00', 'Bacon short description.', 'Bacon full description.', 43, 'Bacon.jpg', 1, 0, 0),
(4, 'Beef', 55, '3.99', '100.00', 'Steak short description.', 'Steak full description.', 41, 'beef.jpg', 1, 0, 0),
(14, 'Ground Beef', 55, '3.99', '100.00', 'Ground Beef short description.', 'Ground beef description.', 41, 'Ground_beef.jpg', 1, 0, 0),
(5, 'Bratwurst', 55, '3.99', '100.00', 'Bratwurst short description.', 'Bratwurst full description.', 41, 'Bratwurst.jpg', 1, 0, 0),
(6, 'Cabbage', 55, '3.99', '100.00', 'Cabbage short description.', 'Cabbage full description.', 45, 'Cabbage.jpg', 1, 0, 0),
(7, 'Shiitake Mushrooms Dried', 55, '3.99', '100.00', 'Shiitake Mushrooms Dried short description.', 'Shiitake Mushrooms Dried full description.', 45, 'shiitake_mushroom.jpg', 1, 0, 0),
(8, 'Shiitake Mushrooms Fresh', 55, '3.99', '100.00', 'Shiitake Mushrooms Fresh short description.', 'Shiitake Mushrooms Fresh full description.', 45, 'Shiitake_Mushrooms_Fresh.jpg', 1, 0, 0),
(9, 'Okra', 55, '3.99', '100.00', 'Okra short description.', 'Okra full description.', 45, 'pork.jpg', 1, 0, 0),
(11, 'Green Beens', 55, '3.99', '100.00', 'Green Beens short description.', 'Green Beens full description.', 45, 'Green_Peppers.jpg', 1, 0, 0),
(12, 'Red pepper', 55, '3.99', '100.00', 'Red pepper short description.', 'Red pepper full description.', 45, 'Red_Peppers.jpg', 1, 0, 0),
(13, 'Green onion', 55, '3.99', '100.00', 'Green onion short description.', 'Green onion full description.', 45, 'Green_Onions.jpg', 1, 0, 0),
(15, 'Onions', 55, '3.99', '100.00', 'Onions short description.', 'Onions full description.', 45, 'Onions.jpg', 1, 0, 0),
(16, 'Dill', 55, '3.99', '100.00', 'Dill short description.', 'Dill full description.', 45, 'Dill.jpg', 1, 0, 0),
(16, 'Carrots', 55, '3.99', '100.00', 'Carrots short description.', 'Carrots full description.', 45, '.jpg', 1, 0, 0),
(17, 'Cherry Tomatoes (red)', 55, '3.99', '100.00', 'Cherry Tomatoes (red) short description.', 'Cherry Tomatoes (red) full description.', 46, 'Cherry_Tomatoes.jpg', 1, 0, 0),
(18, 'Cucumbers Pickled', 55, '3.99', '100.00', 'Cucumbers Pickled short description.', 'Cucumbers Pickled full description.', 46, 'Pickled_Cucumbers.jpg', 1, 0, 0),
(19, 'Cucumbers Sliced', 55, '3.99', '100.00', 'Cucumbers Sliced short description.', 'Cucumbers Sliced full description.', 46, 'Cucumber.jpg', 1, 0, 0),
(20, 'Yellow Squash', 55, '3.99', '100.00', 'Yellow Squash short description.', 'Yellow Squash full description.', 46, 'Yellow_Squash.jpg', 1, 0, 0),
(21, 'Table Tomatoes', 55, '3.99', '100.00', 'Table Tomatoes short description.', 'Table Tomatoes full description.', 46, 'Tomato.jpg', 1, 0, 0),
(22, 'Zucchini', 55, '3.99', '100.00', 'Zucchini short description.', 'Zucchini description.', 46, 'Zucchini.jpg', 1, 0, 0),

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `sizeID` int(11) NOT NULL,
  `sizeName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`sizeID`, `sizeName`) VALUES
(2, 'Medium (1-1.5 lbs)'),
(1, 'Small (0.5-1 lbs)');

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
  ADD PRIMARY KEY (`sizeID`),
  ADD KEY `sizeNameFK` (`sizeName`) USING BTREE;

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
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `sizeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
