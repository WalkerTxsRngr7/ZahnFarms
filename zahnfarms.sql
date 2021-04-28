-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 09:36 PM
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
  `taxRate` decimal(4,3) NOT NULL DEFAULT '0.000',
  `hide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catID`, `catName`, `image`, `taxRate`, `hide`) VALUES
(41, 'Beef', 'beef.jpg', '0.000', 0),
(42, 'Chicken', 'chicken.jpg', '0.000', 0),
(43, 'Pork', 'pork.jpg', '0.000', 0),
(44, 'Eggs', 'eggs.jpg', '0.000', 0),
(45, 'Vegetables', 'Carrots.jpg', '0.000', 0),
(46, 'Fruit', 'Tomato.jpg', '0.000', 0),
(47, 'Berries', 'strawberry.jpg', '0.000', 0),
(48, 'Mushrooms', 'shiitake_mushroom.jpg', '0.000', 0),
(49, 'Seasonings and Mixes', '.jpg', '0.000', 1),
(50, 'Crafts', '.jpg', '0.000', 1),
(51, 'Lip Balms', '.jpg', '0.000', 1);

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
  `postal` int(5) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `lName`, `fName`, `phone`, `addressLine1`, `addressLine2`, `city`, `state`, `postal`, `email`) VALUES
(1, 'Doe', 'John', '2147483647', '123 This St', NULL, 'Springfield', 'MO', 65804, 'thisemail@email.com'),
(10, 'Bob', 'Billy', '3425434234', '123 Main St', 'C101', 'Tulsa', 'OK', 42345, 'billybob@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderID` int(11) NOT NULL,
  `productID` int(5) NOT NULL,
  `sizeName` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantityOrdered` int(5) NOT NULL,
  `priceEach` decimal(10,2) NOT NULL,
  `orderLineNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderID`, `productID`, `sizeName`, `quantityOrdered`, `priceEach`, `orderLineNumber`) VALUES
(1, 3, NULL, 15, '4.00', 1),
(1, 4, 'Medium (1-1.5 lbs)', 3, '5.00', 2),
(15, 19, 'Small (0.5-1 lbs)', 4, '2.00', 1),
(15, 9, '', 6, '4.00', 2),
(15, 4, 'Small (0.5-1 lbs)', 3, '2.00', 3),
(16, 4, 'Medium (1-1.5 lbs)', 3, '5.00', 1),
(17, 5, '', 34, '4.00', 1),
(17, 7, '', 2, '4.00', 2),
(17, 18, '', 12, '4.00', 3),
(18, 4, 'Small (0.5-1 lbs)', 32, '2.00', 1),
(18, 3, '', 3, '4.00', 2),
(19, 5, '', 3, '4.00', 1),
(20, 9, '', 32, '4.00', 1),
(21, 5, '', 32, '4.00', 1),
(22, 4, 'Small (0.5-1 lbs)', 3, '2.00', 1),
(23, 17, '', 34, '4.00', 1),
(23, 5, '', 21, '4.00', 2),
(23, 21, 'Medium (1-1.5 lbs)', 3, '5.00', 3),
(24, 5, '', 10, '4.00', 1),
(25, 6, 'Medium (1-1.5 lbs)', 15, '5.00', 1),
(26, 6, 'Medium (1-1.5 lbs)', 15, '5.00', 1),
(27, 6, 'Medium (1-1.5 lbs)', 15, '5.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `deliveryDate` date NOT NULL,
  `deliveryLocation` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `deliveryFee` decimal(4,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(5,2) NOT NULL DEFAULT '0.00',
  `totalPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `customerID`, `orderDate`, `status`, `deliveryDate`, `deliveryLocation`, `subtotal`, `deliveryFee`, `tax`, `totalPrice`) VALUES
(1, 1, '2021-04-02', 2, '2021-04-21', 'Farm', '12.00', '4.00', '1.24', '27.00'),
(2, 1, '2021-04-02', 2, '2021-04-20', 'Farm', '18.45', '0.00', '0.00', '46.00'),
(15, 10, '0000-00-00', 0, '0000-00-00', 'Springfield', '48.00', '10.00', '0.00', '48.00'),
(16, 10, '0000-00-00', 2, '0000-00-00', 'Marshfield', '15.00', '0.00', '0.00', '15.00'),
(17, 10, '0000-00-00', 1, '0000-00-00', 'Marshfield', '192.00', '0.00', '0.00', '192.00'),
(18, 10, '0000-00-00', 0, '0000-00-00', 'Springfield', '86.00', '10.00', '0.00', '86.00'),
(19, 10, '0000-00-00', 2, '0000-00-00', 'Springfield', '22.00', '10.00', '0.00', '22.00'),
(20, 10, '2021-04-23', 2, '2021-04-29', 'Springfield', '138.00', '10.00', '0.00', '138.00'),
(21, 10, '2021-04-23', 1, '2021-05-05', 'Springfield', '138.00', '10.00', '0.00', '138.00'),
(22, 10, '2021-04-23', 0, '2021-05-07', 'Marshfield', '6.00', '0.00', '0.00', '6.00'),
(23, 10, '2021-04-23', 1, '0000-00-00', 'Farm', '235.00', '0.00', '0.00', '235.00'),
(27, 10, '2021-04-23', 2, '0000-00-00', 'Farm', '75.00', '0.00', '0.00', '75.00');

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
  `qty` int(10) DEFAULT NULL,
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
(1, 'Porkchop', 2, NULL, NULL, 'Pork chops short description.', 'Pork chops full description.', 43, 'Porkchop.jpg', 1, 0, 0),
(2, 'Pork', 6, '4.00', 100, 'Pork short description.', 'Pork  full description.', 43, 'pork.jpg', NULL, 0, 0),
(3, 'Bacon', 2, '4.00', 97, 'Bacon short description.', 'Bacon full description.', 43, 'Bacon.jpg', NULL, 0, 0),
(4, 'Steak test', 6, NULL, NULL, 'short test', 'full test', 41, 'beef2.jpg', 1, 1, 0),
(5, 'Bratwurst test', 2, '4.34', 23, 'short', 'full', 41, 'Bratwurst.jpg', NULL, 0, 0),
(6, 'Cabbage', 2, NULL, NULL, 'Cabbage short description.', 'Cabbage full description.', 45, 'Cabbage.jpg', 1, 0, 0),
(7, 'Shiitake Mushrooms Dried', 3, '4.00', 98, 'Shiitake Mushrooms Dried short description.', 'Shiitake Mushrooms Dried full description.', 45, 'shiitake_mushroom.jpg', NULL, 0, 0),
(8, 'Shiitake Mushrooms Fresh', 4, '4.00', 100, 'Shiitake Mushrooms Fresh short description.', 'Shiitake Mushrooms Fresh full description.', 45, 'Shiitake_Mushrooms_Fresh.jpg', NULL, 0, 0),
(9, 'Okra', 4, '4.00', 14, 'Okra short description.', 'Okra full description.', 45, 'Okra.jpg', NULL, 0, 0),
(11, 'Green Beans', 1, '4.00', 100, 'Green Beens short description.', 'Green Beens full description.', 45, 'Green_Beans.jpg', NULL, 1, 0),
(12, 'Red pepper', 2, '4.00', 100, 'Red pepper short description.', 'Red pepper full description.', 45, 'Red_Peppers.jpg', NULL, 0, 1),
(13, 'Green onion', 1, '4.00', 0, 'Green onion short description.', 'Green onion full description.', 45, 'Green_Onions.jpg', NULL, 0, 0),
(14, 'Ground Beef', 5, '4.00', 100, 'Ground Beef short description.', 'Ground beef description.', 41, 'Ground_beef.jpg', NULL, 0, 0),
(15, 'Onions', 5, NULL, NULL, '', 'Onions full description.', 45, 'Onions.jpg', 3, 0, 0),
(16, 'Dill', 1, '4.00', 100, 'Dill short description.', 'Dill full description.', 45, 'Dill.jpg', NULL, 0, 0),
(17, 'Carrots', 1, '4.00', 66, 'Carrots short description.', 'Carrots full description.', 45, 'Carrots.jpg', NULL, 0, 0),
(18, 'Cherry Tomatoes (red)', 4, '4.00', 88, 'Cherry Tomatoes (red) short description.', 'Cherry Tomatoes (red) full description.', 46, 'Cherry_Tomatoes.jpg', NULL, 0, 0),
(19, 'Cucumbers (Pickling)', 5, NULL, -36, 'Cucumbers Pickled short description.', 'Cucumbers Pickled full description.', 46, 'Pickled_Cucumbers.jpg', 1, 0, 0),
(20, 'Cucumbers (Slicing)', 2, NULL, NULL, 'Cucumbers Sliced short description.', 'Cucumbers Sliced full description.', 46, 'Cucumber.jpg', 2, 0, 0),
(21, 'Yellow Squash', 2, NULL, -3, 'Yellow Squash short description.', 'Yellow Squash full description.', 46, 'Yellow_Squash.jpg', 1, 0, 0),
(22, 'Table Tomatoes', 2, NULL, NULL, 'Table Tomatoes short description.', 'Table Tomatoes full description.', 46, 'Tomato.jpg', 1, 0, 0),
(23, 'Zucchini', 2, NULL, NULL, 'Zucchini short description.', 'Zucchini description.', 46, 'Zucchini.jpg', 1, 0, 0),
(25, 'Corn', 2, '2.99', 22, 'Corn short desc', 'Corn full desc', 45, 'corn.jpg', NULL, 0, 0),
(26, 'Ribs', 2, NULL, NULL, 'Ribs short desc', 'Ribs full desc', 43, 'ribs.jpg', 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `sizeID` int(11) NOT NULL,
  `sizeName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`sizeID`, `sizeName`, `price`, `qty`) VALUES
(1, 'Medium (1-1.5 lbs) test', '4.99', 15),
(1, 'Small (0.5-1 lbs)', '2.00', 50),
(2, 'Medium (1-1.5 lbs)', '4.99', 30),
(2, 'Small (0.5-1 lbs)', '3.99', 0),
(3, 'Medium (1-1.5 lbs)', '4.99', 0),
(3, 'Small (0.5-1 lbs)', '3.99', 0),
(4, 'Full Rack', '5.99', 35),
(4, 'Half Rack', '3.99', 50);

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
  ADD KEY `sizeID` (`sizeID`);

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
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
