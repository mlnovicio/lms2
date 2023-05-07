-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2023 at 12:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
(4, 13, 20000, '2023-04-02 21:00:56'),
(7, 4, 500, '2023-04-06 20:28:55');

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
(59, '879998', 5, 5, 50000, 12, 2, '2023-02-02 13:34:15', '2023-02-02 13:28:51', 45083, 1, 0),
(60, '982812', 6, 5, 30000, 13, 2, '2023-02-02 13:43:36', '2023-02-02 13:42:01', 26999, 0, 0),
(61, '325557', 3, 4, 2000, 10, 0, '0000-00-00 00:00:00', '2023-02-06 12:18:08', 2000, 0, 0),
(62, '895356', 9, 4, 30000, 14, 0, '0000-00-00 00:00:00', '2023-02-06 12:42:33', 30000, 0, 0),
(63, '364546', 9, 4, 30000, 14, 0, '0000-00-00 00:00:00', '2023-02-06 12:51:00', 30000, 0, 0),
(88, '639365', 3, 7, 5000, 10, 2, '2023-03-31 09:42:54', '2023-03-30 20:32:40', 3429, 0, 500),
(113, '437290', 19, 8, 500, 10, 2, '2023-03-31 15:27:02', '2023-03-31 14:00:05', 527, 0, 50),
(114, '290423', 20, 15, 6000, 10, 0, '0000-00-00 00:00:00', '2023-04-23 12:50:18', 6000, 0, 600);

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
(14, 113, 7),
(15, 114, 1),
(16, 114, 4);

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
(20, 'Emergency Loan', '', 6000, 6000),
(21, 'Short Term Loan', '', 12000, 12000);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membership_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `bday` varchar(1000) DEFAULT NULL,
  `bplace` varchar(100) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `gender` varchar(1000) DEFAULT NULL,
  `civil_status` varchar(1000) DEFAULT NULL,
  `married_info` varchar(1000) DEFAULT NULL,
  `education` varchar(1000) DEFAULT NULL,
  `department` varchar(1000) DEFAULT NULL,
  `postion` varchar(1000) DEFAULT NULL,
  `salary` varchar(1000) DEFAULT NULL,
  `other_source` varchar(1000) DEFAULT NULL,
  `monthly_income` text DEFAULT NULL,
  `nearest_relative` text DEFAULT NULL,
  `relation` varchar(100) NOT NULL,
  `dependents` text DEFAULT NULL,
  `religion` text DEFAULT NULL,
  `name_dependents` text DEFAULT NULL,
  `tin` text DEFAULT NULL,
  `input1` text DEFAULT NULL,
  `input2` text DEFAULT NULL,
  `input3` text DEFAULT NULL,
  `input4` text DEFAULT NULL,
  `secretaty` text DEFAULT NULL,
  `amount1` text DEFAULT NULL,
  `amount2` text DEFAULT NULL,
  `date1` text DEFAULT NULL,
  `date2` text DEFAULT NULL,
  `date3` text DEFAULT NULL,
  `printed_name` varchar(1000) DEFAULT NULL,
  `date` varchar(1000) DEFAULT NULL,
  `status` int(11) DEFAULT 1 COMMENT '0 no status 1 approved 2 declined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membership_id`, `name`, `email`, `address`, `bday`, `bplace`, `age`, `gender`, `civil_status`, `married_info`, `education`, `department`, `postion`, `salary`, `other_source`, `monthly_income`, `nearest_relative`, `relation`, `dependents`, `religion`, `name_dependents`, `tin`, `input1`, `input2`, `input3`, `input4`, `secretaty`, `amount1`, `amount2`, `date1`, `date2`, `date3`, `printed_name`, `date`, `status`) VALUES
(25, 'ROMs', 'ROM@GMAIL.COM', '123 ROM ROM NATION', 'MAY', 'TONDO', '12', 'MALE', 'SINGLE', '', 'ROM', 'ROm', '', '100000', 'ROM', '10000000', 'ROM', 'ROM', 'ROm', 'ROM', 'ROM', 'ROM', 'ROM', 'ROM', 'ROm', 'ROm', 'rom', 'FIVE HUNDRED', '500', '2', 'SEPTEMBER', '23', 'ROMROM', '2023/04/30 08:44:44', 3),
(26, 'ROM', 'ROM@GMAIL.COM', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ROM', '2023/04/30 08:54:36', 3),
(27, 'JEROME BLABLA', 'JEROME@GMAIL.COM', '123 CALOOCAN ', 'MAY 22', 'TONDO', '23', 'MALE', 'SINGLE', 'N/A', 'COLLEGE', 'MIS', '', '1000000', 'N/A', '1000000000', 'KIM CALOOCAN AREA', 'SISTER', '1', 'CATHOLIC', 'KIM', '0001231', 'BLABLA', '20', 'SEPTERMBER', '123131', '', 'FIVE HUNDRED', '500', '2ND', 'SEPTEMBER', '23', 'JEROME BLABLA', '2023/04/30 16:31:43', 2);

-- --------------------------------------------------------

--
-- Table structure for table `membership_payment_status`
--

CREATE TABLE `membership_payment_status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership_payment_status`
--

INSERT INTO `membership_payment_status` (`id`, `name`) VALUES
(3, 'N/A'),
(1, 'Paid'),
(2, 'Unpaid');

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
(38, 31, 'user', 'test', '2023-04-30 10:12:56'),
(39, 31, 'admin', 'sup', '2023-04-30 10:13:12');

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
(39, 59, 'Morana, Daryl R.', 5000, 83.3333, 1, '2023-04-06 20:18:38');

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
  `middlename` varchar(20) DEFAULT NULL,
  `lastname` text NOT NULL,
  `user_type` int(11) NOT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `email` varchar(20) NOT NULL,
  `tax_id` varchar(20) DEFAULT NULL,
  `is_mem_fee_paid` tinyint(1) NOT NULL COMMENT '1=yes\r\n0=no',
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `user_type`, `contact_no`, `address`, `email`, `tax_id`, `is_mem_fee_paid`, `registration_date`) VALUES
(1, 'admin', 'admin', 'user', '', 'user', 1, '', '', '', '', 0, '2023-04-02 15:53:00'),
(29, 'cashier', 'cashier', 'cashier', 'cashier', 'cashier', 2, NULL, NULL, 'cashier@gmail.com', NULL, 0, '2023-04-30 04:09:37'),
(30, 'treasurer', 'treasurer', 'treasurer', 'treasurer', 'treasurer', 4, NULL, NULL, 'treasurer@gmai.com', NULL, 0, '2023-04-30 04:09:54'),
(31, 'member', 'member', 'member', 'member', 'member', 3, NULL, NULL, 'member@gmai.com', NULL, 1, '2023-04-30 04:10:11'),
(32, 'rom', 'rom', 'rom', '', 'rom', 2, NULL, NULL, '', NULL, 0, '2023-04-30 10:59:11'),
(33, 'romrom', 'romro', 'mro', '', 'rm', 3, NULL, NULL, '', NULL, 0, '2023-04-30 10:59:26'),
(34, 'romrom', 'romro', 'mro', '', 'rm', 3, NULL, NULL, '', NULL, 0, '2023-04-30 10:59:51'),
(35, 'rom123', 'rom', 'rom', '', 'rom', 4, NULL, NULL, '', NULL, 0, '2023-04-30 11:00:05'),
(36, 'user', 'user', 'user', '', 'user', 3, NULL, NULL, '', NULL, 1, '2023-04-30 12:38:44'),
(37, 'user2', 'user2', 'user2', '', 'user2', 4, NULL, NULL, '', NULL, 0, '2023-04-30 12:41:41'),
(38, 'user3', 'user3', 'user3', '', 'user3', 3, NULL, NULL, '', NULL, 0, '2023-04-30 12:43:03'),
(39, 'user4', 'user4', 'user4', '', 'user4', 3, NULL, NULL, '', NULL, 0, '2023-04-30 12:44:04'),
(40, 'try', 'try', 'test', '', 'test', 3, NULL, NULL, '', NULL, 1, '2023-04-30 12:45:07'),
(41, 'try', 'try', 'test', '', 'test', 3, NULL, NULL, '', NULL, 1, '2023-04-30 12:45:12'),
(42, 'try', 'try', 'try', '', 'try', 3, NULL, NULL, '', NULL, 1, '2023-04-30 12:46:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(2, 'Cashier'),
(1, 'General Manager'),
(3, 'Luecco Member'),
(4, 'Treasurer');

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
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `membership_payment_status`
--
ALTER TABLE `membership_payment_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
  MODIFY `capital_share_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `loan_comaker`
--
ALTER TABLE `loan_comaker`
  MODIFY `lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `ltype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `membership_payment_status`
--
ALTER TABLE `membership_payment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
