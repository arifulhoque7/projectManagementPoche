-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2021 at 07:18 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectmanagementpoche`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `user_type` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `notification` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `mobile`, `designation`, `user_type`, `password`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `notification`, `status`) VALUES
(1, 'Rakibul Hasan', 'rakib@drawhousedhaka.com', '01917039169', 'Manager IT', 2, '$2y$10$iKNGOdVjEHdt.nv9ZmnuUuvziTOESd3gqkZv2yfsCUWRx2NRnsaXa', '2021-07-29 01:34:25', 1, '2021-07-29 01:44:07', 1, 0, 1),
(2, 'Ariful Hoque', 'arif@drawhousedhaka.com', '01010101010', 'Intern IT', 2, '$2y$10$kmE0LEIaHb7r/PRCmBWUv.vFpS5lwedC24gZnKkxtA0yzDCpF0h7W', '2021-07-29 02:39:58', 1, '2021-08-03 00:54:11', 1, 0, 1),
(7, 'amar dfs', 'gomal@gmail.com', '123456', 'dsbfhdsfsf', 4, '$2y$10$fxDWzeqsBiimrF.TlO/nf.c8PTy5.QKfQSEcsIIPUTddecsfu/VW6', '2021-08-03 01:05:17', 1, NULL, 0, 0, 1),
(8, 'sdd', 'k@j.gogo', '01254', 'sajkhdajk', 3, '$2y$10$kQo0bAM5hwBv2VpGMJ1.v.U2I4dj7xi7JHXtTMhvVM2g7pbpzSfcy', '2021-08-03 01:06:02', 1, NULL, 0, 0, 1),
(9, 'sadjks', 'hh@hmaol.com', '123456777', 'kdjfjks', 4, '$2y$10$laau6WUwttHz2NaoHV4.9.3aVMPCV9p7bc3EJRqZ9jhYTd4PxlGHm', '2021-08-03 01:06:57', 1, NULL, 0, 0, 1),
(10, 'sdfsf', 'hhi@hmak.cpm', '012189', 'jfkk', 4, '$2y$10$FPd/pzeq9N0QzdUwTHGY5e6WAh3LkZfNE/5K9pxl6sMk3/VtxZ4RW', '2021-08-03 01:07:40', 1, NULL, 0, 0, 1),
(11, 'adas', 'dfs@hhh', '1221', 'sfdfs', 4, '$2y$10$gksBh6y2lbk5y2XMMEWomO9/.VT3uhkTEzpJSpzgdn66OU1uB31cG', '2021-08-03 01:08:20', 1, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `adminusertype`
--

CREATE TABLE `adminusertype` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminusertype`
--

INSERT INTO `adminusertype` (`id`, `name`, `created_by`, `created_at`, `deleted_by`, `deleted_at`, `status`) VALUES
(1, 'Super Admin', 0, '2021-07-29 06:27:35', 0, NULL, 1),
(2, 'Admin', 0, '2021-07-29 06:27:35', 0, NULL, 1),
(3, 'Manager', 0, '2021-07-29 06:27:35', 0, NULL, 1),
(4, 'Accounts', 0, '2021-07-29 06:27:35', 0, NULL, 1),
(5, 'User', 0, '2021-07-29 06:27:35', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `total_projects` int(11) NOT NULL DEFAULT 0,
  `total_projects_value` float NOT NULL DEFAULT 0,
  `total_paid_amount` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `notification` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `total_projects`, `total_projects_value`, `total_paid_amount`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `notification`, `status`) VALUES
(1, 'Demo Company 1', 'Dhaka', 9, 346253000, 345531, '2021-08-04 06:23:57', 1, NULL, 0, 0, 1),
(2, 'Demo Company 2', 'Dhaka North', 3, 13981, 0, '2021-08-04 06:25:58', 1, NULL, 0, 0, 1),
(3, 'Demo Company 3', 'this is a big company address for demo purpose only', 0, 0, 0, '2021-08-04 06:26:46', 1, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `starting_date` timestamp NULL DEFAULT NULL,
  `ending_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `full_day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `starting_date`, `ending_date`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`, `full_day`) VALUES
(1, 'Demo meeting 1', 'Demo meeting 1 Description', '2021-09-14 09:15:33', '2021-10-20 09:14:05', '2021-09-13 03:09:49', 1, '2021-09-13 03:42:52', 1, 1, 0),
(2, 'Demo Meeting 2', 'cvvfdfvfdvf', '2021-09-14 09:42:18', '2021-09-15 09:42:22', '2021-09-13 03:42:27', 1, NULL, 0, 1, 1),
(3, 'Demo meeting 3', 'tflklklksfd', '2021-09-15 11:31:57', '2021-09-15 11:32:05', '2021-09-13 05:32:11', 1, NULL, 0, 1, 0),
(4, 'Demo Event 1', 'dakjscjknjfkcdv', '2021-09-16 12:18:12', '2021-09-16 12:18:15', '2021-09-13 06:18:30', 1, NULL, 0, 1, 0),
(5, 'event 2', 'sdfdfdg', '2021-09-17 04:21:19', '2021-09-19 04:21:22', '2021-09-13 22:21:31', 1, NULL, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `extra`
--

CREATE TABLE `extra` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `value` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `extra`
--

INSERT INTO `extra` (`id`, `name`, `value`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`) VALUES
(1, 'perDayCost', '1000', '2021-08-05 04:21:37', 2, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paymentmethods`
--

INSERT INTO `paymentmethods` (`id`, `name`, `details`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`) VALUES
(1, 'Bank Account', 'Bank Name: Islami Bank, Bangladesh LTD.\r\nAccount No.:248788467\r\nBranch: Gulshan 2, Dhaka\r\n\r\n\r\n', '2021-08-08 05:14:08', 0, NULL, 0, 1),
(2, 'Card', 'Card No:0213239494\n', '2021-08-08 05:15:20', 0, NULL, 0, 1),
(3, 'SLL Ecommerce', 'Nagad Account No:0138289329', '2021-08-08 05:15:55', 0, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_methods_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL DEFAULT 0,
  `received_by` int(11) NOT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `paid_amount` float NOT NULL,
  `due_before_payment` float NOT NULL,
  `due_after_payment` float NOT NULL,
  `cheque_number` varchar(200) DEFAULT NULL,
  `cheque_bank` varchar(200) DEFAULT NULL,
  `card_number` varchar(200) DEFAULT NULL,
  `transaction_number` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_methods_id`, `company_id`, `project_id`, `phase_id`, `received_by`, `payment_date`, `paid_amount`, `due_before_payment`, `due_after_payment`, `cheque_number`, `cheque_bank`, `card_number`, `transaction_number`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`) VALUES
(1, 1, 1, 1, 1, 1, '2021-08-12 08:38:52', 344567, 64565.9, 32787.8, '1332242524', 'BRAC Bank', '438835897875', 'EFDV34343545', '2021-08-08 05:18:11', 0, NULL, 0, 1),
(2, 3, 1, 11, 7, 1, '2021-08-04 08:38:47', 324455, 3454.67, 44563.9, '364632436767', 'Islami Bank', '87837486477', 'RFR4783874', '2021-08-08 05:19:55', 0, NULL, 0, 1),
(3, 2, 1, 11, 8, 1, '2021-08-17 18:00:00', 222231, 1024200, 801969, '0', '0', '3243434', '0', '2021-08-17 02:46:29', 0, '2021-08-17 23:10:39', 1, 0),
(4, 1, 1, 11, 8, 1, '2021-08-11 18:00:00', 454, 1024200, 1023750, 'fb bNK', '433545', '0', '0', '2021-08-17 02:51:44', 0, '2021-08-17 23:09:59', 1, 0),
(5, 1, 1, 14, 11, 7, '2021-08-17 18:00:00', 123300, 1024200, 900900, '5565667676', '56566767', '0', '0', '2021-08-17 05:04:34', 1, NULL, 0, 1),
(6, 2, 1, 11, 12, 1, '2021-08-18 18:00:00', 222231, 900900, 678669, '0', '0', '233234', '0', '2021-08-17 21:59:40', 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `phase`
--

CREATE TABLE `phase` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `expected_complete_date` timestamp NULL DEFAULT NULL,
  `milestone_value` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phase`
--

INSERT INTO `phase` (`id`, `company_id`, `project_id`, `name`, `expected_complete_date`, `milestone_value`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`) VALUES
(1, 1, 1, 'Phase 1', '2021-08-14 05:25:07', 35000, '2021-08-08 05:27:02', 2, NULL, 0, 1),
(2, 1, 1, 'Phase 2', '2021-09-16 02:25:07', 20000, '2021-08-08 05:27:02', 2, NULL, 0, 1),
(5, 1, 11, 'Phase 01', '2021-08-12 18:00:00', 50000, '2021-08-12 01:03:36', 1, '2021-08-12 01:32:30', 1, 0),
(6, 1, 11, 'phase d1', '2021-08-12 18:00:00', 1234, '2021-08-12 01:40:05', 1, '2021-08-17 21:58:39', 1, 0),
(7, 1, 11, 'phase 2', '2021-08-19 18:00:00', 234353000000, '2021-08-12 03:41:38', 1, '2021-08-16 00:39:43', 1, 0),
(8, 1, 11, 'phase 1', '2021-08-18 18:00:00', 2323, '2021-08-16 00:58:08', 1, NULL, 0, 1),
(9, 1, 12, 'phase 01', '2021-08-17 18:00:00', 123456, '2021-08-17 04:29:48', 1, NULL, 0, 1),
(10, 1, 13, 'akash', '2021-08-11 18:00:00', 123, '2021-08-17 05:00:00', 1, NULL, 0, 1),
(11, 1, 14, 'p1', '2021-08-19 18:00:00', 4500, '2021-08-17 05:03:40', 1, NULL, 0, 1),
(12, 1, 11, 'okla phase', '2021-08-18 18:00:00', 2332, '2021-08-17 21:59:17', 1, '2021-08-17 21:59:52', 1, 0),
(13, 1, 11, 'Phase 2', '2021-11-03 18:00:00', 250000, '2021-08-23 00:28:38', 1, '2021-08-24 23:44:03', 1, 0),
(14, 1, 22, 'Phase 1', '2021-10-19 18:00:00', 10000, '2021-09-02 00:21:58', 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `phasedetails`
--

CREATE TABLE `phasedetails` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `expected_complete_date` timestamp NULL DEFAULT NULL,
  `milestone_value` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phasedetails`
--

INSERT INTO `phasedetails` (`id`, `company_id`, `project_id`, `phase_id`, `name`, `expected_complete_date`, `milestone_value`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`) VALUES
(8, 1, 11, 5, 'phase d1', '2021-08-12 18:00:00', 10000, '2021-08-12 01:04:07', 1, NULL, 0, 1),
(9, 1, 11, 5, 'phase d2', '2021-08-13 18:00:00', 12000, '2021-08-12 01:05:19', 1, NULL, 0, 1),
(10, 1, 11, 5, 'phase d2', '2021-08-13 18:00:00', 12000, '2021-08-12 01:05:28', 1, NULL, 0, 1),
(11, 1, 11, 5, 'pd3', '2021-08-19 18:00:00', 12222, '2021-08-12 01:07:41', 1, '2021-08-12 01:27:29', 1, 0),
(12, 1, 11, 6, 'ph1  d1', '2021-08-12 18:00:00', 1200, '2021-08-12 01:40:33', 1, '2021-08-12 03:39:28', 1, 0),
(13, 1, 11, 6, 'ph d2', '2021-08-20 18:00:00', 34, '2021-08-12 01:40:57', 1, '2021-08-12 01:41:28', 1, 0),
(14, 1, 11, 6, 'ph d1', '2021-08-12 18:00:00', 21, '2021-08-12 03:43:30', 1, '2021-08-12 03:43:42', 1, 0),
(15, 1, 11, 6, 'ph d1', '2021-08-26 18:00:00', 234, '2021-08-12 03:51:37', 1, NULL, 0, 1),
(16, 1, 11, 7, 'ph d3', '2021-08-19 18:00:00', 342243, '2021-08-12 04:27:42', 1, NULL, 0, 1),
(17, 1, 12, 9, 'phase details 1', '2021-08-18 18:00:00', 152, '2021-08-17 04:30:12', 1, NULL, 0, 1),
(18, 1, 14, 11, 'hh', '2021-08-18 18:00:00', 78, '2021-08-17 05:04:03', 1, NULL, 0, 1),
(19, 1, 11, 8, 'okay final phase', '2021-08-17 18:00:00', 77, '2021-08-17 22:02:44', 1, '2021-08-17 22:36:11', 1, 0),
(20, 1, 11, 8, 'okay final phase', '2021-08-19 18:00:00', 90, '2021-08-18 21:38:18', 1, NULL, 0, 1),
(21, 1, 11, 13, 'phase 2', '2021-08-18 18:00:00', 1223, '2021-08-23 00:55:51', 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `phasedetailsfiles`
--

CREATE TABLE `phasedetailsfiles` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `phase_details_id` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phasedetailsfiles`
--

INSERT INTO `phasedetailsfiles` (`id`, `company_id`, `project_id`, `phase_id`, `phase_details_id`, `file_name`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`) VALUES
(4, 1, 11, 8, 20, 'poche1629633054.jpg', '2021-08-22 05:50:54', 1, NULL, 0, 1),
(5, 1, 11, 8, 20, 'poche1629633188.png', '2021-08-22 05:53:08', 1, NULL, 0, 1),
(6, 1, 11, 8, 20, 'poche1629633197.png', '2021-08-22 05:53:17', 1, NULL, 0, 1),
(7, 1, 11, 8, 20, 'poche1629633199.png', '2021-08-22 05:53:19', 1, NULL, 0, 1),
(8, 1, 11, 8, 20, 'poche1629633209.png', '2021-08-22 05:53:29', 1, NULL, 0, 1),
(9, 1, 11, 8, 20, 'poche1629633336.svg', '2021-08-22 05:55:36', 1, NULL, 0, 1),
(10, 1, 11, 8, 20, 'poche1629633414.png', '2021-08-22 05:56:54', 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `phasefiles`
--

CREATE TABLE `phasefiles` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phasefiles`
--

INSERT INTO `phasefiles` (`id`, `company_id`, `project_id`, `phase_id`, `file_name`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`) VALUES
(36, 1, 11, 8, 'poche1629869958.jpg', '2021-08-24 23:39:18', 1, NULL, 0, 1),
(37, 1, 11, 13, 'poche1629869968.jpg', '2021-08-24 23:39:28', 1, NULL, 0, 1),
(38, 1, 11, 8, 'poche1629869979.jpg', '2021-08-24 23:39:39', 1, NULL, 0, 1),
(39, 1, 11, 8, 'poche1629869993.jpg', '2021-08-24 23:39:53', 1, NULL, 0, 1),
(40, 1, 11, 13, 'poche1629870009.jpg', '2021-08-24 23:40:09', 1, NULL, 0, 1),
(41, 1, 11, 13, 'poche1629870018.jpg', '2021-08-24 23:40:18', 1, NULL, 0, 1),
(42, 1, 11, 8, 'poche1629870027.jpg', '2021-08-24 23:40:27', 1, '2021-08-24 23:40:56', 1, 0),
(43, 1, 11, 13, 'poche1629870037.jpg', '2021-08-24 23:40:37', 1, NULL, 0, 1),
(44, 1, 11, 8, 'poche1629870046.jpg', '2021-08-24 23:40:46', 1, NULL, 0, 1),
(45, 1, 22, 14, 'poche1630563838.png', '2021-09-02 00:22:26', 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `project_location` varchar(200) NOT NULL,
  `project_value` float NOT NULL,
  `standard_days` float NOT NULL,
  `contract_sign_date` timestamp NULL DEFAULT NULL,
  `starting_date` timestamp NULL DEFAULT NULL,
  `project_duration` float NOT NULL,
  `finishing_date` timestamp NULL DEFAULT NULL,
  `total_hours_of_work` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `show_in_front` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `company_id`, `name`, `project_location`, `project_value`, `standard_days`, `contract_sign_date`, `starting_date`, `project_duration`, `finishing_date`, `total_hours_of_work`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`, `show_in_front`) VALUES
(11, 1, 'demo project 1', 'demo location 23', 345557000, 0, '2021-08-04 18:00:00', '2021-08-11 18:00:00', 42567, '2021-08-18 18:00:00', 435, '2021-08-11 03:09:54', 0, NULL, 0, 4, 0),
(12, 1, 'Demo Company 1 Project 2', 'demo location 2', 13, 0, '2021-08-11 18:00:00', '2021-08-12 18:00:00', 424, '2021-08-11 18:00:00', 435, '2021-08-11 03:59:46', 0, NULL, 0, 4, 0),
(13, 1, 'Demo Company 1 Project 3', 'banani', 10, 0.01, '2021-08-12 18:00:00', '2021-08-20 18:00:00', 424, '2021-08-18 18:00:00', 435, '2021-08-11 04:01:55', 0, NULL, 0, 1, 0),
(14, 1, 'Demo Company 1 Project 3', 'rfrre', 10, 0.01, '2021-08-17 18:00:00', '2021-08-20 18:00:00', 42456, '2021-08-18 18:00:00', 43555, '2021-08-11 04:05:50', 0, NULL, 0, 1, 0),
(15, 1, 'Demo Company 1 Project 3', 'rfrre', 10, 0.01, '2021-08-17 18:00:00', '2021-08-20 18:00:00', 42456, '2021-08-18 18:00:00', 43555, '2021-08-11 04:06:12', 0, NULL, 0, 1, 0),
(16, 1, 'Demo Company 1 Project 2', 'banani', 13123, 13.123, '2021-08-16 18:00:00', '2021-09-01 18:00:00', 12, '2021-08-30 18:00:00', 45, '2021-08-11 04:10:04', 0, NULL, 0, 1, 0),
(17, 1, 'dsfr', 'easdg', 124123, 124.123, '2021-08-16 18:00:00', '2021-08-24 18:00:00', 1323, '2021-08-10 18:00:00', 123243, '2021-08-11 04:20:25', 0, NULL, 0, 1, 0),
(19, 2, 'asdfas', 'dfs', 234, 0.234, '2021-08-17 18:00:00', '2021-08-12 18:00:00', 1234, '2021-08-10 18:00:00', 1234, '2021-08-11 04:25:27', 0, NULL, 0, 1, 0),
(20, 2, 'qw', 'sdf', 1324, 1.324, '2002-01-21 18:00:00', '2020-01-15 18:00:00', 234, '2034-01-29 18:00:00', 234, '2021-08-11 04:31:19', 0, '2021-08-25 23:40:43', 1, 0, 0),
(22, 1, 'Demo Name 1', 'Gulshan', 15000, 15, '2021-09-14 18:00:00', '2021-10-12 18:00:00', 30, '2021-11-12 18:00:00', 100, '2021-09-02 00:20:28', 0, NULL, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `user_type` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `company_id`, `name`, `designation`, `mobile`, `email`, `user_type`, `password`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`) VALUES
(1, 1, 'akash', 'dmanager', '1234', 'akash@gmail.com', 1, '$2y$10$zzN8p7sQLtIkGjBhOp0P9OQrY4huu/HrK/v6b3tIHLGlqn/SrBh3q', '2021-09-29 02:55:11', 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `name`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `status`) VALUES
(1, 'Manager', '2021-08-03 08:19:14', 0, NULL, 0, 1),
(2, 'Accounts', '2021-08-03 08:19:14', 0, NULL, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminusertype`
--
ALTER TABLE `adminusertype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra`
--
ALTER TABLE `extra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phase`
--
ALTER TABLE `phase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phasedetails`
--
ALTER TABLE `phasedetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phasedetailsfiles`
--
ALTER TABLE `phasedetailsfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phasefiles`
--
ALTER TABLE `phasefiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `adminusertype`
--
ALTER TABLE `adminusertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `extra`
--
ALTER TABLE `extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `phase`
--
ALTER TABLE `phase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `phasedetails`
--
ALTER TABLE `phasedetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `phasedetailsfiles`
--
ALTER TABLE `phasedetailsfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `phasefiles`
--
ALTER TABLE `phasefiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
