-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2022 at 05:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heaven kitchen`
--
CREATE DATABASE IF NOT EXISTS `heaven kitchen` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `heaven kitchen`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(100) NOT NULL,
  `cart_price` int(30) NOT NULL,
  `cart_qty` int(50) NOT NULL,
  `menu_ID` int(100) NOT NULL,
  `order_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_ID` int(100) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_username` varchar(100) NOT NULL,
  `customer_password` varchar(100) NOT NULL,
  `customer_address` varchar(200) NOT NULL,
  `customer_phone` int(15) NOT NULL,
  `customer_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_ID`, `customer_name`, `customer_username`, `customer_password`, `customer_address`, `customer_phone`, `customer_email`) VALUES
(20, '', 'hello', '12345', '', 0, 'hello@a.com.my'),
(21, '', 'ddd', '123456', '', 0, '1201201299@student.mmu.edu.my'),
(22, 'sooo', 'gg', '123456', 'No11, blah blah blah', 182858615, 'gg@gg.com'),
(23, 'sooo', 'admin', '123456', 'No11, blah blah blah', 182858615, 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_ID` int(100) NOT NULL,
  `delivery_time` time NOT NULL,
  `delivery_date` date NOT NULL,
  `order_ID` int(100) NOT NULL,
  `staff_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_ID` int(100) NOT NULL,
  `feedback_rating` int(5) NOT NULL,
  `feedback_comment` varchar(200) NOT NULL,
  `customer_ID` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_ID` int(100) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `menu_price` int(20) NOT NULL,
  `menu_quantity` int(30) NOT NULL,
  `staff_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_ID`, `menu_name`, `menu_price`, `menu_quantity`, `staff_ID`) VALUES
(1, 'lalala', 11, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_ID` int(100) NOT NULL,
  `order_total_price` int(100) NOT NULL,
  `order_qty` int(30) NOT NULL,
  `customer_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_ID` int(100) NOT NULL,
  `payment_method` varchar(40) NOT NULL,
  `payment_amount` int(100) NOT NULL,
  `payment_receipt` text NOT NULL,
  `order_ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_ID` int(100) NOT NULL,
  `customer_name` text NOT NULL,
  `reservation_date_time` datetime NOT NULL,
  `reservation_ppl_qty` int(30) NOT NULL,
  `reservation_msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `reward_ID` int(100) NOT NULL,
  `reward_discount_code` varchar(100) NOT NULL,
  `customer_ID` int(100) NOT NULL,
  `order_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` int(100) NOT NULL,
  `staff_name` varchar(100) NOT NULL,
  `staff_username` varchar(100) NOT NULL,
  `staff_password` int(11) NOT NULL,
  `staff_phone` int(11) NOT NULL,
  `staff_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_ID`, `staff_name`, `staff_username`, `staff_password`, `staff_phone`, `staff_email`) VALUES
(0, 'admin', 'admin', 123456, 123456789, 'admin@admin.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`),
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `menu_ID` (`menu_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_ID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_ID`),
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `staff_ID` (`staff_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_ID`),
  ADD UNIQUE KEY `customer_ID` (`customer_ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_ID`),
  ADD KEY `staff_ID` (`staff_ID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `customer_ID` (`customer_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_ID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_ID`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`reward_ID`),
  ADD KEY `customer_ID` (`customer_ID`),
  ADD KEY `order_ID` (`order_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `reward_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `order` (`order_ID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`menu_ID`) REFERENCES `menu` (`menu_ID`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_ID`) REFERENCES `customer` (`customer_ID`);

--
-- Constraints for table `reward`
--
ALTER TABLE `reward`
  ADD CONSTRAINT `reward_ibfk_1` FOREIGN KEY (`customer_ID`) REFERENCES `customer` (`customer_ID`),
  ADD CONSTRAINT `reward_ibfk_3` FOREIGN KEY (`order_ID`) REFERENCES `order` (`order_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
