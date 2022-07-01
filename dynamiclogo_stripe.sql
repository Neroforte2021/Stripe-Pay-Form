-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2021 at 12:41 PM
-- Server version: 10.0.38-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dynamiclogo_stripe`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `item_number` varchar(150) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `currency_code` varchar(50) NOT NULL,
  `txn_id` varchar(200) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_response` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `email`, `item_number`, `amount`, `currency_code`, `txn_id`, `payment_status`, `payment_response`) VALUES
(1, 'try@gmail.com', 'PHPPOTEG#1', '80', 'gbp', 'txn_1IOQIdBUEJ6gffWGewObGxOA', 'succeeded', '{\"id\":\"ch_1IOQIdBUEJ6gffWGhYAZhrMe\",\"object\":\"char'),
(2, 'fgf@gmail.com', 'PHPPOTEG#1', '77', 'gbp', 'txn_1IOQUFBUEJ6gffWGq6arUSMj', 'succeeded', '{\"id\":\"ch_1IOQUEBUEJ6gffWGB7UZIkOl\",\"object\":\"char'),
(3, 'try@gmail.com', 'PHPPOTEG#1', '55', 'gbp', 'txn_1IOQwIBUEJ6gffWGnQmwxdA4', 'succeeded', '{\"id\":\"ch_1IOQwIBUEJ6gffWGFKa3L4Hx\",\"object\":\"char'),
(4, 'sdf@gmail.com', 'PHPPOTEG#1', '88', 'gbp', 'txn_1IOQxmBUEJ6gffWGMK9r6pPF', 'succeeded', '{\"id\":\"ch_1IOQxmBUEJ6gffWG3iCV4rHl\",\"object\":\"char'),
(5, 'try@gmail.com', 'PHPPOTEG#1', '77', 'gbp', 'txn_1IOQyQBUEJ6gffWGLYnHf02e', 'succeeded', '{\"id\":\"ch_1IOQyQBUEJ6gffWGBrqsD0S7\",\"object\":\"char'),
(6, 'try@gmail.com', 'PHPPOTEG#1', '11', 'gbp', 'txn_1IOQz8BUEJ6gffWGOD7pdpHs', 'succeeded', '{\"id\":\"ch_1IOQz8BUEJ6gffWG53rvyVTK\",\"object\":\"char'),
(7, 'find@gmail.com', 'PHPPOTEG#1', '55', 'gbp', 'txn_1IOR8cBUEJ6gffWGI4L5RU81', 'succeeded', '{\"id\":\"ch_1IOR8bBUEJ6gffWGEWVNd3Ks\",\"object\":\"char'),
(8, 'khurramshahzad12334@gmail.com', 'PHPPOTEG#1', '69', 'gbp', 'txn_1IORA7BUEJ6gffWGom7VzvBX', 'succeeded', '{\"id\":\"ch_1IORA7BUEJ6gffWGPrv0y89d\",\"object\":\"char'),
(9, 'test@gmail.com', 'PHPPOTEG#1', '1500', 'gbp', 'txn_1IOREBBUEJ6gffWGKuJkCP9D', 'succeeded', '{\"id\":\"ch_1IOREBBUEJ6gffWG0nfXpDZJ\",\"object\":\"char');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
