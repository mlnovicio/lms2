-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 08:35 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `capital_share`
--

CREATE TABLE `capital_share` (
  `capital_share_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `capital_share`
--

INSERT INTO `capital_share` (`capital_share_id`, `user_id`, `amount`, `date_created`) VALUES
(1, 8, 5000, '2023-04-02 20:53:21'),
(2, 8, 10000, '2023-04-02 20:56:11'),
(3, 8, 5000, '2023-04-02 20:59:53'),
(4, 13, 20000, '2023-04-02 21:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `ltype_id` int(30) NOT NULL,
  `borrower_id` int(30) NOT NULL,
  `amount` double NOT NULL,
  `lplan_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=request, 1=confirmed, 2=released, 3=completed, 4=denied',
  `date_released` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `balance` int(30) NOT NULL,
  `paymentNumber` tinyint(4) NOT NULL,
  `loan_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_id`, `ref_no`, `ltype_id`, `borrower_id`, `amount`, `lplan_id`, `status`, `date_released`, `date_created`, `balance`, `paymentNumber`, `loan_rate`) VALUES
(57, '900859', 3, 3, 100000, 10, 2, '2023-01-18 12:51:29', '2023-01-18 12:17:27', 100000, 0, 0),
(58, '242416', 5, 4, 200000, 12, 2, '2023-02-02 13:33:16', '2023-02-02 10:56:12', 182999, 0, 0),
(59, '879998', 5, 5, 50000, 12, 2, '2023-02-02 13:34:15', '2023-02-02 13:28:51', 50000, 0, 0),
(60, '982812', 6, 5, 30000, 13, 2, '2023-02-02 13:43:36', '2023-02-02 13:42:01', 26999, 0, 0),
(61, '325557', 3, 4, 2000, 10, 0, '0000-00-00 00:00:00', '2023-02-06 12:18:08', 2000, 0, 0),
(62, '895356', 9, 4, 30000, 14, 0, '0000-00-00 00:00:00', '2023-02-06 12:42:33', 30000, 0, 0),
(63, '364546', 9, 4, 30000, 14, 0, '0000-00-00 00:00:00', '2023-02-06 12:51:00', 30000, 0, 0),
(88, '639365', 3, 7, 5000, 10, 2, '2023-03-31 09:42:54', '2023-03-30 20:32:40', 3429, 0, 500),
(113, '437290', 19, 8, 500, 10, 2, '2023-03-31 15:27:02', '2023-03-31 14:00:05', 527, 0, 50);

-- --------------------------------------------------------

--
-- Table structure for table `loan_comaker`
--

CREATE TABLE `loan_comaker` (
  `lc_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `comaker_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_comaker`
--

INSERT INTO `loan_comaker` (`lc_id`, `loan_id`, `comaker_id`) VALUES
(13, 113, 5),
(14, 113, 7);

-- --------------------------------------------------------

--
-- Table structure for table `loan_plan`
--

CREATE TABLE `loan_plan` (
  `lplan_id` int(11) NOT NULL,
  `lplan_month` int(11) NOT NULL,
  `lplan_interest` float NOT NULL,
  `lplan_penalty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loan_plan`
--

INSERT INTO `loan_plan` (`lplan_id`, `lplan_month`, `lplan_interest`, `lplan_penalty`) VALUES
(10, 24, 10, 0),
(11, 12, 5, 0),
(12, 12, 2, 0),
(13, 12, 20, 0),
(14, 3, 2, 10),
(16, 8, 1, 0),
(17, 1, 1, 0),
(18, 2, 1, 0),
(19, 4, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedule`
--

CREATE TABLE `loan_schedule` (
  `loan_sched_id` int(50) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `due_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(10, 60, '01'),
(11, 88, '30'),
(12, 113, '30');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`ltype_id`, `ltype_name`, `ltype_desc`, `minloan`, `maxloan`) VALUES
(3, 'Application for Allowance Loan', 'Allowance Loan', 2000, 5000),
(4, 'Application of Bonus Loan', 'Bonus Loan', 10000, 50000),
(5, 'Application of Loan for Loan Travel', 'Loan Travel', 65000, 100000),
(6, 'buimbay', '20 perecent interest with free helmet', 1500, 3500),
(7, 'Calamity', 'tester', 1999, 2000),
(8, 'tester', 'testing', 9000, 12000),
(19, 'Salary Loan', '', 500, 1000);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `user_id`, `sent`, `message`, `message_date`) VALUES
(31, 8, 'user', 'hoy panget', '2022-11-06 22:13:18'),
(32, 8, 'admin', 'aaaaaaaaaaaaaaaaaaaaaaa', '2022-11-06 22:13:40'),
(34, 8, 'admin', 'test', '2023-03-30 13:12:38'),
(35, 8, 'user', 'awd', '2023-03-30 14:50:45'),
(36, 8, 'admin', 'awtsuu', '2023-03-30 23:35:47'),
(37, 8, 'user', 'aaa', '2023-03-30 23:35:51');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `loan_id`, `payee`, `pay_amount`, `penalty`, `overdue`, `date_created`) VALUES
(29, 88, 'Corocoto, Mark Kevin .', 230, 0, 0, '2023-03-31 10:10:19'),
(30, 88, 'Corocoto, Mark Kevin .', 230, 0, 0, '2023-03-31 11:02:19'),
(31, 88, 'Corocoto, Mark Kevin .', 230, 0, 0, '2023-03-31 15:27:34'),
(32, 88, 'Corocoto, Mark Kevin .', 230, 0, 0, '2023-03-31 11:02:59'),
(33, 88, 'Corocoto, Mark .', 230, 0, 0, '2023-03-31 14:47:25'),
(34, 88, 'Corocoto, Mark .', 230, 0, 0, '2023-03-31 14:47:38'),
(35, 88, 'Corocoto, Mark .', 230, 0, 0, '2023-03-31 14:47:45'),
(36, 88, 'Corocoto, Mark .', 230, 0, 0, '2023-03-31 14:47:50'),
(37, 113, 'Cor, Mark C.', 23, 0, 0, '2023-03-31 15:27:34'),
(38, 88, 'Corocoto, Mark .', 231, 0, 0, '2023-03-31 15:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `saving`
--

CREATE TABLE `saving` (
  `savings_id` int(11) NOT NULL,
  `saving_account_id` int(11) NOT NULL,
  `tx_type` tinyint(1) NOT NULL COMMENT '1=deposit\r\n0=withdraw',
  `amount` decimal(10,0) NOT NULL,
  `tx_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saving`
--

INSERT INTO `saving` (`savings_id`, `saving_account_id`, `tx_type`, `amount`, `tx_date`) VALUES
(1, 1, 0, '100', '2023-04-01 18:18:48'),
(2, 1, 0, '100', '2023-04-01 18:18:56'),
(3, 1, 0, '50', '2023-04-01 18:19:03'),
(4, 1, 0, '-50', '2023-04-01 18:19:46'),
(5, 2, 1, '100', '2023-04-01 18:32:11'),
(6, 2, 1, '1000', '2023-04-01 18:45:32'),
(7, 2, 0, '-100', '2023-04-01 18:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `savings_account`
--

CREATE TABLE `savings_account` (
  `saving_account_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `account_name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active\r\n0=inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savings_account`
--

INSERT INTO `savings_account` (`saving_account_id`, `owner_id`, `account_name`, `status`, `date_created`) VALUES
(1, 8, 'MK Savings I', 0, '2023-04-01 17:42:47'),
(2, 8, 'MK Savings II', 1, '2023-04-01 18:31:51'),
(3, 5, 'Daryl Savings Account', 1, '2023-04-04 21:08:53');

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
  `tax_id` varchar(20) NOT NULL,
  `is_mem_fee_paid` tinyint(1) NOT NULL COMMENT '1=yes\r\n0=no',
  `registration_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `user_type`, `contact_no`, `address`, `email`, `tax_id`, `is_mem_fee_paid`, `registration_date`) VALUES
(1, 'admin', 'admin', 'user', '', 'user', 1, '', '', '', '', 0, '2023-04-02 15:53:00'),
(4, 'test', 'test', 'user', '', 'user', 0, '', '', '', '', 0, '2023-04-02 15:53:00'),
(5, 'daryl', '12345', 'daryl', 'Rodriguez', 'morana', 0, '09461581717', 'San Isidro', 'joysanangel7@gmail.c', '', 1, '2023-04-02 15:53:00'),
(7, 'mk', '123', 'Mark', '', 'CC', 0, '', '', '', '', 1, '2023-04-02 15:53:00'),
(8, 'mk2', '123', 'mark', 'cer', 'cor', 0, '95683222222', 'Nagcarlan, Laguna, Philippines', 'm@m.co', '', 1, '2023-04-02 15:53:00'),
(10, 'staff1', '1234', 'mk', '', 'staff', 2, '', '', '', '', 1, '2023-04-02 15:53:00'),
(11, 'staff2', '123', 'MK', '', 'CC', 2, '', '', '', '', 0, '2023-04-02 15:53:00'),
(12, 'staff3', '123', 'mk', '', 'staff', 2, '', '', '', '', 0, '2023-04-02 15:53:00'),
(13, 'mk3', '123', 'MM', '', 'KK', 0, '', '', '', '', 0, '2023-04-02 16:12:37'),
(14, 'mk4', '123', 'MM', 'CC', 'KK', 0, '9568322222', 'purok 6', 'mk@mk.com', '', 0, '2023-04-04 13:05:56'),
(15, 'lovely', '123', 'll', 'dd', 'cc', 0, '9178659874', 'Nagcarlan, Laguna, Philippines', 'ldc@aa.com', '', 0, '2023-04-04 14:57:37'),
(16, 'staff2', '123', 'cc', '', 'vv', 2, '', '', '', '', 0, '2023-04-04 21:04:59');

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
-- Indexes for table `capital_share`
--
ALTER TABLE `capital_share`
  ADD PRIMARY KEY (`capital_share_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `loan_comaker`
--
ALTER TABLE `loan_comaker`
  ADD PRIMARY KEY (`lc_id`);

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
-- Indexes for table `saving`
--
ALTER TABLE `saving`
  ADD PRIMARY KEY (`savings_id`);

--
-- Indexes for table `savings_account`
--
ALTER TABLE `savings_account`
  ADD PRIMARY KEY (`saving_account_id`);

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
-- AUTO_INCREMENT for table `capital_share`
--
ALTER TABLE `capital_share`
  MODIFY `capital_share_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `loan_comaker`
--
ALTER TABLE `loan_comaker`
  MODIFY `lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `loan_plan`
--
ALTER TABLE `loan_plan`
  MODIFY `lplan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  MODIFY `loan_sched_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `ltype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `saving`
--
ALTER TABLE `saving`
  MODIFY `savings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `savings_account`
--
ALTER TABLE `savings_account`
  MODIFY `saving_account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
