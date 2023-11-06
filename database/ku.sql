-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 05:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ku`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--
CREATE DATABASE 'ku';
use 'ku';
CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `deg_id` int(11) NOT NULL,
  `deg_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`deg_id`, `deg_name`) VALUES
(5, 'دوکتورا'),
(3, 'لیسانس'),
(4, 'ماستری'),
(1, 'پزده پاس'),
(2, 'چهارده پاس');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `pname` varchar(64) NOT NULL,
  `plname` varchar(64) NOT NULL,
  `fname` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `birth_date` varchar(32) NOT NULL,
  `hire_date` varchar(32) NOT NULL,
  `positions` varchar(128) NOT NULL,
  `en_positions` varchar(64) NOT NULL,
  `role` varchar(2) DEFAULT NULL,
  `faculty_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `degree_id` int(11) DEFAULT NULL,
  `province_id` int(11) NOT NULL,
  `rotba_id` int(11) DEFAULT NULL,
  `photo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fac_id` int(11) NOT NULL,
  `fac_name` varchar(128) NOT NULL,
  `fac_en_name` varchar(128) NOT NULL,
  `fac_abr` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fac_id`, `fac_name`, `fac_en_name`, `fac_abr`) VALUES
(1, ' پوهنحٔی کمپیوترساینس', 'Computer Science Faculty', 'CS'),
(2, 'پوهنحٔی ساختمانی', 'Construction Faculty', 'CO'),
(3, 'پوهنحٔی ترانسپورت', 'Transport Enginerring Faculty', 'TE'),
(4, 'پوهنحٔی تکنالوژی کیمیاوی', 'Chemical Technology Faculty', 'CT'),
(5, 'پوهنحٔی جیولوجی و معدن', 'Geology & Mines Faculty', 'GM'),
(6, 'پوهنحٔی جیوماتیک و کدستر', 'Geomatic & Cadaster Faculty', 'GC'),
(7, 'پوهنحٔی الکترومیخانیک', 'Electromechanic Faculty', 'EL'),
(8, 'پوهنحٔی انجنیری آب و محیط زیست', 'Water & Environmental Engineering Faculty', 'WEE');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_name`) VALUES
(1, 'افتخاری'),
(2, 'دایمی'),
(3, 'قراردادی'),
(4, 'موقتی');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`pro_id`, `pro_name`) VALUES
(6, 'ارزگان'),
(8, 'بادغیس'),
(9, 'بامیان'),
(10, 'بدخشان'),
(11, 'بغلان'),
(7, 'بلخ'),
(12, 'تخار'),
(13, 'جوزجان'),
(14, 'خوست'),
(15, 'دایکندی'),
(16, 'زابل'),
(17, 'سرپل'),
(18, 'سمنگان'),
(19, 'غزنی'),
(20, 'غور'),
(21, 'فاریاب'),
(22, 'فراه'),
(23, 'لغمان'),
(24, 'لوگر'),
(25, 'میدان وردک'),
(26, 'ننگرهار'),
(27, 'نورستان'),
(28, 'نیمروز'),
(29, 'هرات'),
(30, 'هلمند'),
(31, 'پروان'),
(32, 'پنجشیر'),
(33, 'پکتیا'),
(34, 'پکتیکا'),
(1, 'کابل'),
(4, 'کاپیسا'),
(3, 'کندز'),
(2, 'کندهار'),
(5, 'کنر');

-- --------------------------------------------------------

--
-- Table structure for table `rotba`
--

CREATE TABLE `rotba` (
  `rot_id` int(11) NOT NULL,
  `rot_name` varchar(64) NOT NULL,
  `rot_abr` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rotba`
--

INSERT INTO `rotba` (`rot_id`, `rot_name`, `rot_abr`) VALUES
(1, 'پوهاند', 'Prof.'),
(2, 'پوهنیار', 'Assist.'),
(3, 'پوهنمل', 'Assist.'),
(4, 'پوهندوی', 'Assist.'),
(5, 'پوهنوال', 'Asst.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_type` varchar(20) NOT NULL,
  `photo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_type`, `photo`) VALUES
(1, 'admin', '9a52eb33f379c4ab4006cb629d24975f424d8e39', 'superadmin', 0x646973742f696d672f757365722e706e67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`deg_id`),
  ADD UNIQUE KEY `deg_name` (`deg_name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `province_id` (`province_id`),
  ADD KEY `rotba_id` (`rotba_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `degree_id` (`degree_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fac_id`),
  ADD UNIQUE KEY `fac_name` (`fac_name`),
  ADD UNIQUE KEY `fac_en_name` (`fac_en_name`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `job_name` (`job_name`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`pro_id`),
  ADD UNIQUE KEY `pro_name` (`pro_name`);

--
-- Indexes for table `rotba`
--
ALTER TABLE `rotba`
  ADD PRIMARY KEY (`rot_id`),
  ADD UNIQUE KEY `rot_name` (`rot_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `deg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `rotba`
--
ALTER TABLE `rotba`
  MODIFY `rot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `province` (`pro_id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`rotba_id`) REFERENCES `rotba` (`rot_id`),
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`fac_id`),
  ADD CONSTRAINT `employees_ibfk_4` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`),
  ADD CONSTRAINT `employees_ibfk_5` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`deg_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
