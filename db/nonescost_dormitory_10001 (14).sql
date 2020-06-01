-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2019 at 04:02 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nonescost_dormitory_10001`
--

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `bed_id` int(11) NOT NULL,
  `bed_no` int(11) NOT NULL,
  `availability` varchar(200) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `barcode` varchar(200) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `bdate` date NOT NULL,
  `gender` set('Male','Female') NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tenant_type` varchar(200) NOT NULL,
  `date_reg` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parent_id` int(11) NOT NULL,
  `mother` varchar(300) NOT NULL,
  `mother_occ` varchar(200) NOT NULL,
  `father` varchar(200) NOT NULL,
  `father_occ` varchar(200) NOT NULL,
  `parent_address` varchar(200) NOT NULL,
  `parent_contact` varchar(20) NOT NULL,
  `parent_email` varchar(50) NOT NULL,
  `cust_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `total_bills` decimal(50,2) NOT NULL,
  `amount` decimal(50,2) NOT NULL,
  `balance` decimal(50,2) NOT NULL,
  `changed` decimal(50,2) NOT NULL,
  `date_payment` date NOT NULL,
  `date` datetime NOT NULL,
  `rentin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rent_amount`
--

CREATE TABLE `rent_amount` (
  `rent_amount_id` int(11) NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rent_in`
--

CREATE TABLE `rent_in` (
  `rentin_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `bed_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datein` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rent_out`
--

CREATE TABLE `rent_out` (
  `rentout_id` int(11) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `dateout` date NOT NULL,
  `cust_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `details` varchar(500) NOT NULL,
  `total_bed` int(11) NOT NULL,
  `student_rate` decimal(50,2) NOT NULL,
  `faculty_rate` decimal(50,2) NOT NULL,
  `other_rate` decimal(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `time_in_out`
--

CREATE TABLE `time_in_out` (
  `time_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `logs` set('in','out') NOT NULL,
  `message` varchar(100) NOT NULL,
  `cust_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_image` varchar(250) NOT NULL,
  `user_fname` varchar(100) NOT NULL,
  `user_lname` varchar(100) NOT NULL,
  `user_address` varchar(200) NOT NULL,
  `user_contact` varchar(20) NOT NULL,
  `user_gender` set('Male','Female') NOT NULL,
  `user_position` varchar(30) NOT NULL,
  `user_bdate` date NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_status` varchar(100) NOT NULL,
  `user_date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_image`, `user_fname`, `user_lname`, `user_address`, `user_contact`, `user_gender`, `user_position`, `user_bdate`, `user_password`, `username`, `user_status`, `user_date_reg`) VALUES
(7, 'picture.jpg', 'admin', 'admin', '', '', 'Male', 'Administrator', '2019-11-11', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Active', '2019-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `logs_id` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `action` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`bed_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `rent_id` (`rentin_id`);

--
-- Indexes for table `rent_amount`
--
ALTER TABLE `rent_amount`
  ADD PRIMARY KEY (`rent_amount_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `rent_in`
--
ALTER TABLE `rent_in`
  ADD PRIMARY KEY (`rentin_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `bed_id` (`bed_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rent_out`
--
ALTER TABLE `rent_out`
  ADD PRIMARY KEY (`rentout_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `time_in_out`
--
ALTER TABLE `time_in_out`
  ADD PRIMARY KEY (`time_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`logs_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rent_amount`
--
ALTER TABLE `rent_amount`
  MODIFY `rent_amount_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rent_in`
--
ALTER TABLE `rent_in`
  MODIFY `rentin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rent_out`
--
ALTER TABLE `rent_out`
  MODIFY `rentout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `time_in_out`
--
ALTER TABLE `time_in_out`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bed`
--
ALTER TABLE `bed`
  ADD CONSTRAINT `bed_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`rentin_id`) REFERENCES `rent_in` (`rentin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rent_amount`
--
ALTER TABLE `rent_amount`
  ADD CONSTRAINT `rent_amount_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_amount_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rent_in`
--
ALTER TABLE `rent_in`
  ADD CONSTRAINT `rent_in_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_in_ibfk_2` FOREIGN KEY (`bed_id`) REFERENCES `bed` (`bed_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_in_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rent_out`
--
ALTER TABLE `rent_out`
  ADD CONSTRAINT `rent_out_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_out_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `time_in_out`
--
ALTER TABLE `time_in_out`
  ADD CONSTRAINT `time_in_out_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
