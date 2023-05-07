-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2023 at 05:59 AM
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
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `loan_id` int(11) NOT NULL,
  `is_new` text DEFAULT NULL,
  `lastname` text DEFAULT NULL,
  `firstname` text DEFAULT NULL,
  `middlename` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `type_of_loan` text DEFAULT NULL,
  `term_of_payment` text DEFAULT NULL,
  `input1` text DEFAULT NULL,
  `comaker1` text DEFAULT NULL,
  `comaker2` text DEFAULT NULL,
  `home1` text DEFAULT NULL,
  `home2` text DEFAULT NULL,
  `compute1` text DEFAULT NULL,
  `compute2` text DEFAULT NULL,
  `compute3` text DEFAULT NULL,
  `compute4` text DEFAULT NULL,
  `compute5` text DEFAULT NULL,
  `processor1` text DEFAULT NULL,
  `processor2` text DEFAULT NULL,
  `admin1` text DEFAULT NULL,
  `admin2` text DEFAULT NULL,
  `status` text DEFAULT 'PENDING',
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `payments` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`loan_id`, `is_new`, `lastname`, `firstname`, `middlename`, `address`, `contact_no`, `type_of_loan`, `term_of_payment`, `input1`, `comaker1`, `comaker2`, `home1`, `home2`, `compute1`, `compute2`, `compute3`, `compute4`, `compute5`, `processor1`, `processor2`, `admin1`, `admin2`, `status`, `date`, `user_id`, `payments`) VALUES
(18, 'New Loan', 'DISUAMAL', 'JEROME', 'L', '123', '123', '6000', '6', 'JEROME DISUAMAL', '31', '31', '123 ASDASDAS', '123 ASDSADSA', '60', '360', 'June-December 2023', '1060', '530', '', '', 'JEROME', 'JEROME', 'Approved', '2023-05-04 09:21:59', 31, 6360),
(19, 'New Loan', 'DISUAMAL', 'JEROME', 'L', '123', '123', '6000', '6', 'JEROME DISUAMAL', '31', '31', '123 ASDASDAS', '123 ASDSADSA', '60', '360', 'June-December 2023', '1060', '530', '', '', 'JER', 'JERERE', 'Approved', '2023-05-04 09:21:59', 31, 6360),
(20, 'New Loan', 'EWQE', 'QWE', 'E', 'EWQEQWE', '', '6000', '6', 'QWE EWQE', '49', '49', 'EWQEWQe', 'QWEWQEWQEWQ', '60', '360', 'June-December 2023', '1060', '530', '', '', '', '', 'PENDING', '2023-05-04 11:01:02', 49, 6360),
(21, 'New Loan', 'EWQE', 'QWE', 'E', 'EWQEQWE', '', '6000', '6', 'QWE EWQE', '49', '49', 'EWQEWQe', 'QWEWQEWQEWQ', '60', '360', 'June-December 2023', '1060', '530', '', '', '', '', 'PENDING', '2023-05-04 11:01:26', 49, 6360),
(22, 'New Loan', 'DISUMALA', 'QWEQW', 'E', 'QWEQWEQE', '12321312', '6000', '6', 'QWEQW DISUMALA', '32', '32', '312312', '123123', '60', '360', 'June-December 2023', '1060', '530', '', '', '', '', 'PENDING', '2023-05-04 11:24:45', 31, 0);

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
(19, 18, 31),
(20, 18, 31),
(21, 19, 31),
(22, 19, 31),
(23, 21, 49),
(24, 21, 49),
(25, 22, 32),
(26, 22, 32);

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
  `secretary` text DEFAULT NULL,
  `amount1` text DEFAULT NULL,
  `amount2` text DEFAULT NULL,
  `date1` text DEFAULT NULL,
  `date2` text DEFAULT NULL,
  `date3` text DEFAULT NULL,
  `printed_name` varchar(1000) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 1 COMMENT '0 no status 1 approved 2 declined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membership_id`, `name`, `email`, `address`, `bday`, `bplace`, `age`, `gender`, `civil_status`, `married_info`, `education`, `department`, `postion`, `salary`, `other_source`, `monthly_income`, `nearest_relative`, `relation`, `dependents`, `religion`, `name_dependents`, `tin`, `input1`, `input2`, `input3`, `input4`, `secretary`, `amount1`, `amount2`, `date1`, `date2`, `date3`, `printed_name`, `date`, `status`) VALUES
(25, 'ROMs', 'ROM@GMAIL.COM', '123 ROM ROM NATION', 'MAY', 'TONDO', '12', 'MALE', 'SINGLE', '', 'ROM', 'ROm', '', '100000', 'ROM', '10000000', 'ROM', 'ROM', 'ROm', 'ROM', 'ROM', 'ROM', 'ROM', 'ROM', 'ROm', 'ROm', 'rom', 'FIVE HUNDRED', '500', '2', 'SEPTEMBER', '23', 'ROMROM', '2023-04-30 08:44:44', 3),
(26, 'ROM', 'ROM@GMAIL.COM', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ROM', '2023-04-30 08:54:36', 3),
(27, 'JEROME BLABLA', 'jerome.disumala0522@gmail.com', '123 CALOOCAN ', 'MAY 22', 'TONDO', '23', 'MALE', 'SINGLE', 'N/A', 'COLLEGE', 'MIS', '', '1000000', 'N/A', '1000000000', 'KIM CALOOCAN AREA', 'SISTER', '1', 'CATHOLIC', 'KIM', '0001231', 'BLABLA', '20', 'SEPTERMBER', '123131', '', 'FIVE HUNDRED', '500', '2ND', 'SEPTEMBER', '23', 'JEROME BLABLA', '2023-04-30 16:31:43', 3),
(28, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2023-05-02 10:31:34', 3),
(29, 'JAY', 'JAYRCASTILUMALI01@GMAIL.COM', '123', '123', '123', '12', '123', '12312', '32131', '23131', '312313', '1231231', '3123', '1233', '131', '31313', '31313', '3123', '1231', '131', '1231', '12321', '313', '31231', '123', 'JAI', 'FIVE HUNDRED', '500', '2', 'SETP', '23', 'JAY', '2023-05-04 11:50:08', 3);

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
(39, 31, 'admin', 'sup', '2023-04-30 10:13:12'),
(40, 31, 'admin', 'bonak', '2023-05-02 10:39:33');

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

-- --------------------------------------------------------

--
-- Table structure for table `payment_list`
--

CREATE TABLE `payment_list` (
  `payment_id` int(11) NOT NULL,
  `ref_no` text DEFAULT NULL,
  `type_of_payment` text DEFAULT NULL,
  `payee_id` text DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment_list`
--

INSERT INTO `payment_list` (`payment_id`, `ref_no`, `type_of_payment`, `payee_id`, `amount`, `date`, `status`) VALUES
(6, '363148', 'CAPITAL SHARE', '31', 10000, '2023-05-01 00:01:34', '2'),
(7, '595074', 'MEMBERSHIP FEE', '31', 1000, '2023-05-01 09:36:57', '2'),
(8, '267566', 'CAPITAL SHARE', '31', 1500, '2023-05-01 12:01:42', '2'),
(9, '209703', 'CAPITAL SHARE', '31', 20000, '2023-05-01 12:55:01', '2'),
(10, '173676', 'LOAN', '31', 500, '2023-05-02 14:19:08', '1'),
(11, '811624', 'LOAN', '31', 1000, '2023-05-02 14:19:26', '1'),
(13, '707316', 'LOAN', '31', 1000, '2023-05-02 14:19:39', '1'),
(14, '754632', 'LOAN', '31', 1000, '2023-05-02 14:20:31', '1'),
(15, '606702', 'LOAN', '31', 500, '2023-05-02 14:22:17', '1'),
(16, '470497', 'LOAN', '31', 12000, '2023-05-02 19:00:58', '1'),
(17, '385921', 'LOAN', '31', 12000, '2023-05-02 19:05:16', '1'),
(18, '111582', '', '', 0, '2023-05-02 19:07:53', '1'),
(19, '791333', 'LOAN', '31', 12000, '2023-05-02 19:08:13', '1'),
(20, '836779', 'LOAN', '31', 120000, '2023-05-02 19:10:15', '2'),
(21, '365736', 'LOAN', '31', 5000, '2023-05-02 19:10:52', '2'),
(22, '279766', 'LOAN', '31', 7000, '2023-05-02 19:11:17', '1'),
(23, '791874', 'CAPITAL SHARE', '31', 50000, '2023-05-04 09:18:33', '1'),
(24, '924024', 'CAPITAL SHARE', '49', 50000, '2023-05-04 10:59:39', '1');

-- --------------------------------------------------------

--
-- Table structure for table `remitted_det`
--

CREATE TABLE `remitted_det` (
  `remitted_det_id` int(11) NOT NULL,
  `remitted_id` int(11) NOT NULL,
  `type_of_payment` text DEFAULT NULL,
  `payee_id` text DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `remitted_det`
--

INSERT INTO `remitted_det` (`remitted_det_id`, `remitted_id`, `type_of_payment`, `payee_id`, `amount`, `date`) VALUES
(15, 16, 'CAPITAL SHARE', '38', 1000, '2023/04/30 23:39:32'),
(16, 16, 'CAPITAL SHARE', '38', 1000, '2023/04/30 23:45:38'),
(17, 16, 'MEMBERSHIP FEE', '39', 1000, '2023/04/30 23:50:16'),
(18, 17, 'CAPITAL SHARE', '31', 1500, '2023/05/01 12:01:42'),
(19, 17, 'CAPITAL SHARE', '31', 20000, '2023/05/01 12:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `remitted_header`
--

CREATE TABLE `remitted_header` (
  `remitted_id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `remitted_header`
--

INSERT INTO `remitted_header` (`remitted_id`, `amount`, `date`) VALUES
(16, 3000, '2023/05/01 10:41:02'),
(17, 21500, '2023/05/01 12:55:05');

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
  `email` varchar(200) NOT NULL,
  `tax_id` varchar(20) DEFAULT NULL,
  `is_mem_fee_paid` tinyint(1) NOT NULL COMMENT '1=yes\r\n0=no',
  `registration_date` datetime DEFAULT current_timestamp(),
  `otp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `user_type`, `contact_no`, `address`, `email`, `tax_id`, `is_mem_fee_paid`, `registration_date`, `otp`) VALUES
(1, 'admin', '123', 'user', '', 'user', 1, '', '', '', '', 0, '2023-04-02 15:53:00', ''),
(29, 'cashier', '123', 'cashier', 'cashier', 'cashier', 2, NULL, NULL, 'cashier@gmail.com', NULL, 0, '2023-04-30 04:09:37', ''),
(30, 'treasurer', '123', 'treasurer', 'treasurer', 'treasurer', 4, NULL, NULL, 'treasurer@gmai.com', NULL, 0, '2023-04-30 04:09:54', ''),
(31, 'member', '123', 'member', 'member', 'member', 3, NULL, NULL, 'jerome.disumala0522@gmail.com', NULL, 1, '2023-04-30 04:10:11', ''),
(32, 'member', '123', 'member12', 'member123', 'member12345', 3, NULL, NULL, 'jerome.disumala0522@gmail.com', NULL, 1, '2023-04-30 04:10:11', ''),
(49, 'jerome.disumala0522@gmail.com', '123', 'JEROME BLABLA', '', '', 3, NULL, NULL, 'jerome.disumala0522@gmail.com', NULL, 1, '2023-05-04 10:38:49', ''),
(50, 'JAYRCASTILUMALI01@GMAIL.COM', '123', 'JAY', '', '', 3, NULL, NULL, 'JAYRCASTILUMALI01@GMAIL.COM', NULL, 1, '2023-05-04 11:50:34', '');

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
-- Indexes for table `loans`
--
ALTER TABLE `loans`
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
-- Indexes for table `payment_list`
--
ALTER TABLE `payment_list`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `remitted_det`
--
ALTER TABLE `remitted_det`
  ADD PRIMARY KEY (`remitted_det_id`);

--
-- Indexes for table `remitted_header`
--
ALTER TABLE `remitted_header`
  ADD PRIMARY KEY (`remitted_id`);

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
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `loan_comaker`
--
ALTER TABLE `loan_comaker`
  MODIFY `lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `membership_payment_status`
--
ALTER TABLE `membership_payment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `payment_list`
--
ALTER TABLE `payment_list`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `remitted_det`
--
ALTER TABLE `remitted_det`
  MODIFY `remitted_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `remitted_header`
--
ALTER TABLE `remitted_header`
  MODIFY `remitted_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
