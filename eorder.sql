-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 02:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `TotalAmount` decimal(18,2) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `Status`, `TotalAmount`, `CreatedAt`) VALUES
(1, 'Not Shipped', 150.00, '2025-01-01 10:00:00'),
(2, 'Delivered', 200.00, '2025-01-02 11:30:00'),
(3, 'Cancelled', 75.50, '2025-01-03 14:15:00'),
(4, 'Shipped', 300.00, '2025-01-04 16:45:00'),
(5, 'Pending', NULL, '2025-01-26 14:00:09'),
(6, 'Pending', NULL, '2025-01-26 14:02:46'),
(7, 'Pending', NULL, '2025-01-26 14:02:51'),
(8, 'Pending', NULL, '2025-01-26 14:03:13'),
(9, 'Not Shipped', NULL, '2025-01-26 14:07:09'),
(10, 'Not Shipped', NULL, '2025-01-26 14:12:32'),
(11, 'Cancelled', 7200.00, '2025-01-26 14:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `ItemID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ItemName` varchar(100) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`ItemID`, `OrderID`, `ItemName`, `Quantity`, `Price`) VALUES
(1, 1, 'Computer', 2, 50.00),
(2, 1, 'Tablet', 1, 50.00),
(3, 2, 'Chocolate', 4, 50.00),
(4, 3, 'Widget', 1, 75.50),
(5, 4, 'Laptop', 3, 100.00),
(6, 5, 'Chocolate', 9, 90.00),
(7, 6, 'Phone', 3, 2400.00),
(8, 7, 'Phone', 3, 2400.00),
(9, 8, 'Widget', 2, 100.00),
(10, 9, 'Phone', 2, 1600.00),
(11, 11, 'Phone', 3, 2400.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
