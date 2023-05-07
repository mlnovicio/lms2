-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 06:19 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `announcement_details` text NOT NULL,
  `announcement_created` datetime NOT NULL DEFAULT current_timestamp(),
  `announcement_date` date NOT NULL DEFAULT current_timestamp(),
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `announcement_details`, `announcement_created`, `announcement_date`, `img`) VALUES
(11, 'The Schedule of the Release of Loan will be on the 15th and 30th of every month., We would like to announce that a new work schedule has been drafted. The details for the new schedule have been given below. We request your full cooperation to ensure smooth operations. ', '2023-01-16 11:49:24', '2023-01-16', 'Image899.png'),
(12, 'Announcement', '2023-01-16 11:51:14', '2023-01-16', 'Image543.jpg'),
(13, 'Advisory', '2023-01-16 11:51:28', '2023-01-16', 'Image262.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `borrower_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `tax_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `ltype_id` int(30) NOT NULL,
  `borrower_id` int(30) NOT NULL,
  `purpose` text NOT NULL,
  `amount` double NOT NULL,
  `lplan_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=request, 1=confirmed, 2=released, 3=completed, 4=denied',
  `date_released` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL DEFAULT current_timestamp(),
  `comakerName` text NOT NULL,
  `comakerEmail` text NOT NULL,
  `comakerStatus` int(11) NOT NULL,
  `comakerUid` text NOT NULL,
  `balance` int(30) NOT NULL,
  `paymentNumber` tinyint(4) NOT NULL,
  `cmname2` text NOT NULL,
  `cmemail2` text NOT NULL,
  `cmuid2` text NOT NULL,
  `cm2status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_id`, `ref_no`, `ltype_id`, `borrower_id`, `purpose`, `amount`, `lplan_id`, `status`, `date_released`, `date_created`, `date`, `comakerName`, `comakerEmail`, `comakerStatus`, `comakerUid`, `balance`, `paymentNumber`, `cmname2`, `cmemail2`, `cmuid2`, `cm2status`) VALUES
(57, '900859', 3, 3, 'education', 100000, 10, 2, '2023-01-18 12:51:29', '2023-01-18 12:17:27', '2023-01-18', 'joysanangel', 'joysanangel7@gmail.com', 1, '900859', 100000, 0, 'jerome', 'architecturesource08@gmail.com', '267456', 1),
(58, '242416', 5, 4, 'travel', 200000, 12, 2, '2023-02-02 13:33:16', '2023-02-02 10:56:12', '2023-02-02', 'joysanangel', 'joysanangel7@gmail.com', 1, '242416', 182999, 1, 'Arlene Joy San Angel', 'architecturesource08@gmail.com', '721796', 1),
(59, '879998', 5, 5, 'education', 50000, 12, 2, '2023-02-02 13:34:15', '2023-02-02 13:28:51', '2023-02-02', 'joysanangel', 'joysanangel7@gmail.com', 1, '879998', 50000, 0, 'Arlene Joy San Angel', 'architecturesource08@gmail.com', '447979', 1),
(60, '982812', 6, 5, 'education', 30000, 13, 2, '2023-02-02 13:43:36', '2023-02-02 13:42:01', '2023-02-02', 'joysanangel', 'joysanangel7@gmail.com', 1, '982812', 26999, 1, 'Arlene Joy San Angel', 'architecturesource08@gmail.com', '339113', 1),
(61, '325557', 3, 4, 'asd', 2000, 10, 0, '0000-00-00 00:00:00', '2023-02-06 12:18:08', '2023-02-06', 'asd', 'asd@asd.com', 0, '325557', 2000, 0, 'asd', 'asd@asd.com', '371568', 0),
(62, '895356', 9, 4, 'ewan', 30000, 14, 0, '0000-00-00 00:00:00', '2023-02-06 12:42:33', '2023-02-06', 'dummy1stapador@gmail.com', 'dummy1stapador@gmail.com', 0, '895356', 30000, 0, 'dummy1stapador@gmail.com', 'mr.ephraiel@gmail.com', '145087', 0),
(63, '364546', 9, 4, 'ewan', 30000, 14, 0, '0000-00-00 00:00:00', '2023-02-06 12:51:00', '2023-02-06', 'dummy1stapador@gmail.com', 'dummy1stapador@gmail.com', 0, '364546', 30000, 0, 'dummy1stapador@gmail.com', 'mr.ephraiel@gmail.com', '798653', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_plan`
--

CREATE TABLE `loan_plan` (
  `lplan_id` int(11) NOT NULL,
  `lplan_month` int(11) NOT NULL,
  `lplan_interest` float NOT NULL,
  `lplan_penalty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_plan`
--

INSERT INTO `loan_plan` (`lplan_id`, `lplan_month`, `lplan_interest`, `lplan_penalty`) VALUES
(10, 24, 10, 0),
(11, 12, 5, 0),
(12, 12, 2, 0),
(13, 12, 20, 0),
(14, 3, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedule`
--

CREATE TABLE `loan_schedule` (
  `loan_sched_id` int(50) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `due_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_schedule`
--

INSERT INTO `loan_schedule` (`loan_sched_id`, `loan_id`, `due_date`) VALUES
(1, 32, '09'),
(2, 36, '08'),
(3, 38, '15'),
(4, 40, '15'),
(5, 42, '15'),
(6, 47, '17'),
(7, 57, '17'),
(8, 58, '01'),
(9, 59, '01'),
(10, 60, '01');

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `ltype_id` int(11) NOT NULL,
  `ltype_name` text NOT NULL,
  `ltype_desc` text NOT NULL,
  `minloan` int(11) NOT NULL,
  `maxloan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`ltype_id`, `ltype_name`, `ltype_desc`, `minloan`, `maxloan`) VALUES
(3, 'Application for Allowance Loan', 'Allowance Loan', 2000, 5000),
(4, 'Application of Bonus Loan', 'Bonus Loan', 10000, 50000),
(5, 'Application of Loan for Loan Travel', 'Loan Travel', 65000, 100000),
(6, 'buimbay', '20 perecent interest with free helmet', 1500, 3500),
(7, 'test', 'tester', 1000, 5000),
(8, 'tester', 'testing', 9000, 12000),
(9, 'tttt', 'sda', 30000, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sent` varchar(20) NOT NULL DEFAULT 'user',
  `message` text NOT NULL,
  `message_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `user_id`, `sent`, `message`, `message_date`) VALUES
(26, 3, 'admin', 'qqqqqqqqqq', '2022-11-06 20:34:36'),
(27, 3, 'admin', 'q', '2022-11-06 20:34:52'),
(28, 3, 'user', 'pa approve ng utang ko salamat', '2022-11-06 20:59:59'),
(29, 3, 'admin', 'ok', '2022-11-06 21:00:24'),
(30, 3, 'admin', 'na approve ko na ', '2022-11-06 21:00:44'),
(31, 8, 'user', 'hoy panget', '2022-11-06 22:13:18'),
(32, 8, 'admin', 'aaaaaaaaaaaaaaaaaaaaaaa', '2022-11-06 22:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `payee` text NOT NULL,
  `pay_amount` float NOT NULL,
  `penalty` float NOT NULL,
  `overdue` tinyint(1) NOT NULL COMMENT '0=no, 1=yes',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `loan_id`, `payee`, `pay_amount`, `penalty`, `overdue`, `date_created`) VALUES
(27, 58, 'User, User .', 17001, 0, 0, '2023-02-03 13:58:38'),
(28, 60, 'Morana, Daryl R.', 3001, 0, 0, '2023-02-06 10:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` text NOT NULL,
  `user_type` int(11) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `tax_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `user_type`, `contact_no`, `address`, `email`, `tax_id`) VALUES
(1, 'admin', 'admin', 'user', '', 'user', 1, '', '', '', ''),
(4, 'test', 'test', 'user', '', 'user', 0, '', '', '', ''),
(5, 'daryl', '12345', 'daryl', 'Rodriguez', 'morana', 0, '09461581717', 'San Isidro', 'joysanangel7@gmail.c', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`borrower_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `loan_plan`
--
ALTER TABLE `loan_plan`
  ADD PRIMARY KEY (`lplan_id`);

--
-- Indexes for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  ADD PRIMARY KEY (`loan_sched_id`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`ltype_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `borrower`
--
ALTER TABLE `borrower`
  MODIFY `borrower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `loan_plan`
--
ALTER TABLE `loan_plan`
  MODIFY `lplan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  MODIFY `loan_sched_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `ltype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
