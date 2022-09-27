-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2022 at 05:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bes_acd`
--

-- --------------------------------------------------------

--
-- Table structure for table `std`
--

CREATE TABLE `std` (
  `s_id` int(255) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `s_cntct` varchar(50) NOT NULL,
  `s_address` varchar(50) NOT NULL,
  `s_gender` varchar(50) NOT NULL,
  `s_religion` varchar(50) NOT NULL,
  `s_city` varchar(50) NOT NULL,
  `s_class` varchar(50) NOT NULL,
  `s_courses` varchar(50) NOT NULL,
  `s_doa` varchar(50) NOT NULL,
  `s_dou` varchar(50) NOT NULL,
  `Active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `std`
--

INSERT INTO `std` (`s_id`, `s_name`, `f_name`, `s_cntct`, `s_address`, `s_gender`, `s_religion`, `s_city`, `s_class`, `s_courses`, `s_doa`, `s_dou`, `Active`) VALUES
(19, 'Hello I Am Changed', 'Hello I Am Changed', '9999999999999999999999', '999999999999999999999', 'Female', 'Hindu', 'Peshawar', 'XII (Biology)', 'DCBM', '19-Aug-2022', '29-Aug-2022', 1),
(20, '1', '2', '3', '5', 'Male', 'Islam', 'Karachi', 'IX (Computer Science)', 'DCBM', '19-Aug-2022', '29-Aug-2022', 1),
(21, '23232323232323', '3', '3', '3', 'Male', 'Islam', 'Balochistan', 'IX (Computer Science)', 'CIT', '19-Aug-2022', '29-Aug-2022', 1),
(22, '2', '2', '2', '2', 'Female', 'Cristian', 'Peshawar', 'X (Computer Science)', 'DCBM', '19-Aug-2022', '29-Aug-2022', 1),
(23, '1', '2', '3', '5', 'Male', 'Islam', 'Karachi', 'IX (Biology)', 'C Sharp Programming', '20-Aug-2022', 'No - Update', 1),
(24, 'Ali', 'Ahmed', '123', 'Hyderbad Sindh', 'Male', 'Islam', 'Hyderabad', 'IX (Computer Science)', 'CIT', '29-Aug-2022', '29-Aug-2022', 1),
(25, 'hammadtest', 'alitest', '123', 'address test', 'Male', 'Islam', 'Hyderabad', 'IX (Computer Science)', 'CIT', '29-Aug-2022', '29-Aug-2022', 1),
(26, 'Hassan', 'Ali', '03181332380', 'Hyderbad', 'Male', 'Islam', 'Hyderabad', 'IX (Computer Science)', 'No-Selection', '29-Aug-2022', '29-Aug-2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_fee`
--

CREATE TABLE `std_fee` (
  `id` int(255) NOT NULL,
  `s_id` int(50) NOT NULL,
  `s_fee_pay_date` varchar(50) NOT NULL,
  `s_fee` int(50) NOT NULL,
  `s_fee_status` tinyint(1) NOT NULL,
  `s_fee_month` varchar(100) NOT NULL,
  `s_fee_year` varchar(100) NOT NULL,
  `Active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `std_fee`
--

INSERT INTO `std_fee` (`id`, `s_id`, `s_fee_pay_date`, `s_fee`, `s_fee_status`, `s_fee_month`, `s_fee_year`, `Active`) VALUES
(20, 19, '0009-09-09', 2147483647, 0, 'February', '2023', 1),
(21, 20, '2022-10-06', 4, 1, 'October', '2022', 1),
(22, 21, '2022-02-28', 2000, 0, 'February', '2022', 1),
(23, 22, '0002-02-02', 2, 1, 'May', '2023', 1),
(24, 23, '0005-05-05', 4, 1, 'June', '2022', 1),
(26, 19, '0009-09-09', 2147483647, 0, 'February', '2023', 1),
(27, 19, '0009-09-09', 2147483647, 0, 'February', '2023', 1),
(28, 19, '0009-09-09', 2147483647, 0, 'February', '2023', 1),
(29, 19, '0009-09-09', 2147483647, 0, 'February', '2023', 1),
(30, 19, '0009-09-09', 2147483647, 0, 'February', '2023', 1),
(31, 24, '2022-01-01', 2000, 0, 'January', '2022', 1),
(32, 24, '2022-02-22', 2000, 0, '1', '1', 1),
(33, 24, '2022-01-01', 2131231232, 0, '1', '1', 1),
(34, 19, '0009-09-09', 2147483647, 0, 'February', '2023', 1),
(35, 24, '0001-11-11', 2147483647, 0, '1', '1', 1),
(36, 24, '0001-01-01', 2147483647, 1, 'February', '2022', 1),
(37, 24, '0001-01-01', 189, 1, 'March', '2022', 1),
(38, 24, '0001-01-01', 1111, 1, 'April', '2022', 1),
(39, 25, '2022-01-01', 2000, 0, 'January', '2022', 1),
(41, 26, '2022-05-01', 2000, 1, 'January', '2022', 1),
(42, 26, '2022-02-01', 2000, 1, 'February', '2022', 1),
(43, 26, '2022-03-12', 2000, 1, 'March', '2022', 1),
(44, 26, '2022-04-12', 2000, 1, 'April', '2022', 1),
(45, 26, '2022-05-14', 2000, 1, 'May', '2022', 1),
(46, 26, '2022-06-01', 2000, 1, 'June', '2022', 1),
(47, 26, '2022-08-01', 2000, 1, 'August', '2022', 1),
(48, 26, '2022-09-01', 2022, 1, 'September', '2022', 1),
(49, 26, '2022-11-01', 2000, 1, 'November', '2022', 1),
(50, 26, '2022-12-01', 2000, 1, 'December', '2022', 1),
(51, 22, '2022-06-01', 2000, 1, 'June', '2022', 1),
(52, 22, '2022-06-01', 2000, 1, 'June', '2022', 1),
(53, 22, '2022-06-01', 2000, 1, 'June', '2022', 1),
(54, 22, '2022-06-01', 2000, 1, 'June', '2022', 1),
(55, 22, '2022-06-12', 2000, 1, 'June', '2022', 1),
(56, 23, '2022-07-01', 2000, 1, 'July', '2022', 1),
(57, 23, '2022-08-01', 2000, 1, 'August', '2022', 1),
(58, 23, '2022-09-01', 2000, 1, 'September', '2022', 1),
(59, 26, '2022-06-01', 2000, 1, 'July', '2022', 1),
(60, 26, '2022-07-01', 2022, 1, 'July', '2022', 1),
(61, 26, '2022-10-01', 2000, 1, 'October', '2022', 1),
(62, 20, '2022-11-01', 2000, 1, 'November', '2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `s_data`
--

CREATE TABLE `s_data` (
  `id` int(255) NOT NULL,
  `doa` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `w_no` int(255) NOT NULL,
  `a_fee` int(255) NOT NULL,
  `m_fee` int(255) NOT NULL,
  `january` int(255) NOT NULL,
  `february` int(255) NOT NULL,
  `march` int(255) NOT NULL,
  `april` int(255) NOT NULL,
  `may` int(255) NOT NULL,
  `june` int(255) NOT NULL,
  `july` int(255) NOT NULL,
  `august` int(255) NOT NULL,
  `september` int(255) NOT NULL,
  `october` int(255) NOT NULL,
  `november` int(255) NOT NULL,
  `december` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `std`
--
ALTER TABLE `std`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `std_fee`
--
ALTER TABLE `std_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_data`
--
ALTER TABLE `s_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `std`
--
ALTER TABLE `std`
  MODIFY `s_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `std_fee`
--
ALTER TABLE `std_fee`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `s_data`
--
ALTER TABLE `s_data`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
