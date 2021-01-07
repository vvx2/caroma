-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 04:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caromanew`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_nickname` varchar(45) NOT NULL,
  `user_status` int(11) NOT NULL,
  `date_created` varchar(45) NOT NULL,
  `date_modified` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `user_name`, `user_password`, `user_type`, `user_nickname`, `user_status`, `date_created`, `date_modified`) VALUES
(1, 'admin', 'c2RzSWNlUzIrQkozTTNoLytJMStzUT09', 1, 'Admin', 1, '2020-01-06 22:33:09', '2020-01-06 22:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `qty`, `customer_id`, `date_created`, `date_modified`) VALUES
(85, 3, 13, 3, '2020-12-08 15:30:54', '2020-12-20 09:46:18'),
(86, 5, 3, 3, '2020-12-08 15:30:55', '2020-12-20 09:46:18'),
(94, 0, 1, 3, '2020-12-20 09:40:36', '2020-12-20 09:40:36'),
(95, 0, 1, 3, '2020-12-20 09:40:36', '2020-12-20 09:40:36'),
(96, 0, 1, 3, '2020-12-20 09:40:36', '2020-12-20 09:40:36'),
(97, 0, 1, 3, '2020-12-20 09:40:36', '2020-12-20 09:40:36'),
(98, 0, 1, 3, '2020-12-20 09:40:36', '2020-12-20 09:40:36'),
(99, 0, 1, 3, '2020-12-20 09:44:18', '2020-12-20 09:44:18'),
(100, 0, 1, 3, '2020-12-20 09:44:18', '2020-12-20 09:44:18'),
(101, 0, 1, 3, '2020-12-20 09:44:18', '2020-12-20 09:44:18'),
(102, 0, 1, 3, '2020-12-20 09:44:18', '2020-12-20 09:44:18'),
(103, 0, 1, 3, '2020-12-20 09:44:18', '2020-12-20 09:44:18'),
(104, 0, 1, 3, '2020-12-20 09:45:12', '2020-12-20 09:45:12'),
(105, 0, 1, 3, '2020-12-20 09:45:12', '2020-12-20 09:45:12'),
(106, 0, 1, 3, '2020-12-20 09:45:12', '2020-12-20 09:45:12'),
(107, 2, 1, 3, '2020-12-20 09:46:18', '2020-12-20 09:46:18'),
(108, 6, 1, 3, '2020-12-20 09:46:18', '2020-12-20 09:46:18'),
(109, 7, 1, 3, '2020-12-20 09:46:18', '2020-12-20 09:46:18'),
(121, 3, 1, 6, '2021-01-04 15:36:17', '2021-01-04 15:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) UNSIGNED NOT NULL,
  `status` int(1) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `status`, `date_created`, `date_modified`) VALUES
(1, 1, '2020-09-28 13:48:54', '2020-09-29 06:53:44'),
(2, 1, '2020-09-29 06:41:09', '2020-09-29 06:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `category_translation`
--

CREATE TABLE `category_translation` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `language` varchar(55) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_translation`
--

INSERT INTO `category_translation` (`id`, `name`, `description`, `language`, `category_id`) VALUES
(1, 'test category2', '', 'en', 1),
(2, '的撒大2', '', 'cn', 1),
(3, 'hhahaha222', '', 'my', 1),
(4, 'test21', '', 'en', 2),
(5, '啊飒飒1', '', 'cn', 2),
(6, 'dsatu1', '', 'my', 2),
(7, 'testdelete', '', 'en', 3),
(8, 'deelte', '', 'cn', 3),
(9, 'delete', '', 'my', 3);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) UNSIGNED NOT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1=amount, 2 =percentage',
  `amt` decimal(12,4) NOT NULL,
  `percentage` int(11) NOT NULL,
  `min_spend` decimal(12,4) UNSIGNED NOT NULL,
  `capped` decimal(12,4) UNSIGNED NOT NULL,
  `user_per_coupon` int(11) NOT NULL,
  `usage_limit` int(11) NOT NULL,
  `total_usage_limit` int(11) NOT NULL,
  `total_times_used` int(11) NOT NULL,
  `free_delivery` int(11) NOT NULL,
  `code` varchar(155) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `start`, `end`, `type`, `amt`, `percentage`, `min_spend`, `capped`, `user_per_coupon`, `usage_limit`, `total_usage_limit`, `total_times_used`, `free_delivery`, `code`, `status`, `date_created`, `date_modified`) VALUES
(2, '2019-12-11 16:00:00', '2021-01-20 16:00:00', 2, '12.0000', 10, '1.0000', '20.0000', 1, 1, 520, 1, 0, 'DERQDW', 1, '2020-10-17 10:44:44', '2020-10-18 11:25:33'),
(3, '2019-12-11 16:00:00', '2020-10-06 16:00:00', 1, '0.0000', 0, '0.0000', '0.0000', 1, 1, 1, 0, 0, 'HAHAHA123', 0, '2020-10-17 10:54:07', '2020-11-14 13:57:33'),
(5, '2019-12-11 16:00:00', '2019-12-23 16:00:00', 1, '0.0000', 0, '0.0000', '0.0000', 1, 1, 1, 0, 0, 'TEST', 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(6, '2020-10-05 16:00:00', '2020-10-19 16:00:00', 2, '10.0000', 20, '50.0000', '10.0000', 1, 1, 80, 1, 0, 'QQWERT', 1, '2020-10-17 14:24:15', '2020-10-18 11:02:31'),
(7, '2020-10-05 16:00:00', '2021-02-03 16:00:00', 1, '4.0000', 0, '10.0000', '0.0000', 1, 1, 50, 4, 0, 'GGSDFF', 1, '2020-11-14 13:54:22', '2020-11-14 13:54:22'),
(8, '2020-10-04 16:00:00', '2020-12-24 16:00:00', 1, '12.0000', 0, '1000.0000', '0.0000', 1, 1, 1, 0, 0, 'WF7K2F33', 1, '2020-11-14 13:59:25', '2020-11-14 13:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_code`
--

CREATE TABLE `coupon_code` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` text NOT NULL,
  `times_used` int(11) NOT NULL,
  `coupon_id` int(11) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon_code`
--

INSERT INTO `coupon_code` (`id`, `code`, `times_used`, `coupon_id`, `status`, `date_created`, `date_modified`) VALUES
(1, 'CPTVC6QIN', 0, 3, 1, '2020-10-17 10:54:07', '2020-10-17 10:54:07'),
(2, 'CPWOH5TOD', 0, 4, 1, '2020-10-17 10:55:03', '2020-10-17 10:55:03'),
(3, 'CP27CW4HI', 0, 4, 1, '2020-10-17 10:55:03', '2020-10-17 10:55:03'),
(4, 'CPXUSA33C', 0, 4, 1, '2020-10-17 10:55:03', '2020-10-17 10:55:03'),
(5, 'CP8Z2VLBN', 0, 4, 1, '2020-10-17 10:55:03', '2020-10-17 10:55:03'),
(6, 'CPD72QD8X', 0, 4, 1, '2020-10-17 10:55:03', '2020-10-17 10:55:03'),
(7, 'CP4YFC05E', 0, 4, 1, '2020-10-17 10:55:03', '2020-10-17 10:55:03'),
(8, 'CPU0VRQTA', 0, 4, 1, '2020-10-17 10:55:03', '2020-10-17 10:55:03'),
(9, 'CP5T3VDCW', 0, 4, 1, '2020-10-17 10:55:03', '2020-10-17 10:55:03'),
(10, 'CPIJXEI6T', 0, 4, 1, '2020-10-17 10:55:03', '2020-10-17 10:55:03'),
(11, 'CPBXIKF5H', 0, 4, 1, '2020-10-17 10:55:03', '2020-10-17 10:55:03'),
(12, 'CPDMEURYE', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(13, 'CPVQOQ52H', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(14, 'CPVJ4FIVA', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(15, 'CPDQCJYEL', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(16, 'CPTN242EE', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(17, 'CPIPGF183', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(18, 'CP3T5Q21G', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(19, 'CPV3N1HDF', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(20, 'CP8GIZ5TT', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(21, 'CPZOD46VA', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(22, 'CP1GKHY4S', 0, 5, 1, '2020-10-17 11:01:56', '2020-10-17 11:01:56'),
(23, 'CP2ZK547X', 0, 6, 1, '2020-10-17 14:24:15', '2020-10-17 14:24:15'),
(24, 'CPOTWFYJZ', 0, 6, 1, '2020-10-17 14:24:15', '2020-10-17 14:24:15'),
(25, 'CPQ4OWJKI', 0, 6, 1, '2020-10-17 14:24:15', '2020-10-17 14:24:15'),
(26, 'CPR25J0U2', 0, 6, 1, '2020-10-17 14:24:15', '2020-10-17 14:24:15'),
(27, 'CPT7DIHO7', 0, 2, 1, '2020-10-18 11:22:49', '2020-10-18 11:22:49'),
(28, 'CPMUNYTSZ', 0, 2, 1, '2020-10-18 11:22:49', '2020-10-18 11:22:49'),
(29, 'CPEDFMJJ9', 0, 2, 1, '2020-10-18 11:22:49', '2020-10-18 11:22:49'),
(30, 'CPF94VVTO', 0, 2, 1, '2020-10-18 11:22:49', '2020-10-18 11:22:49'),
(31, 'CPDFQEUI5', 0, 2, 1, '2020-10-18 11:22:49', '2020-10-18 11:22:49'),
(32, 'CPJXSU7CW', 0, 2, 1, '2020-10-18 11:23:38', '2020-10-18 11:23:38'),
(33, 'CPAGRS71D', 0, 2, 1, '2020-10-18 11:23:38', '2020-10-18 11:23:38'),
(34, 'CPJFVTO5X', 0, 2, 1, '2020-10-18 11:23:38', '2020-10-18 11:23:38'),
(35, 'CPB3H6JOS', 0, 2, 1, '2020-10-18 11:23:38', '2020-10-18 11:23:38'),
(36, 'CPBUK8E5Y', 0, 2, 1, '2020-10-18 11:23:38', '2020-10-18 11:23:38'),
(37, 'CPST1EBM9', 0, 2, 1, '2020-10-18 11:25:33', '2020-10-18 11:25:33'),
(38, 'CPFDEGXXK', 0, 2, 1, '2020-10-18 11:25:33', '2020-10-18 11:25:33'),
(39, 'CPV1U7FQZ', 0, 2, 1, '2020-10-18 11:25:33', '2020-10-18 11:25:33'),
(40, 'CPD19WERL', 0, 2, 1, '2020-10-18 11:25:33', '2020-10-18 11:25:33'),
(41, 'CPO3P3J3J', 0, 2, 1, '2020-10-18 11:25:33', '2020-10-18 11:25:33'),
(42, 'CPQ8IC7FJ', 0, 2, 1, '2020-10-18 11:25:33', '2020-10-18 11:25:33'),
(43, 'CP8WMSHM5', 0, 2, 1, '2020-10-18 11:25:33', '2020-10-18 11:25:33'),
(44, 'CPCUT58O9', 0, 2, 1, '2020-10-18 11:25:33', '2020-10-18 11:25:33'),
(45, 'CPYRT3XX8', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(46, 'CP03KXD50', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(47, 'CP7XNHIQE', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(48, 'CP9QWRBM9', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(49, 'CPUYWGCIW', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(50, 'CPDI92Q7J', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(51, 'CP1T0ZJMB', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(52, 'CPJ4J2HZ8', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(53, 'CPY6HI5T9', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(54, 'CPPDISANX', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(55, 'CPFE625MI', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(56, 'CP0J783AR', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(57, 'CPD2ZZOAF', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33'),
(58, 'CPX50W7VN', 0, 3, 1, '2020-10-18 11:26:33', '2020-10-18 11:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_product`
--

CREATE TABLE `coupon_product` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `coupon_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon_product`
--

INSERT INTO `coupon_product` (`id`, `product_id`, `coupon_id`) VALUES
(5, 2, 4),
(6, 3, 4),
(7, 2, 5),
(8, 3, 5),
(9, 2, 6),
(10, 3, 6),
(16, 2, 2),
(17, 3, 2),
(18, 2, 7),
(19, 3, 7),
(20, 2, 3),
(21, 3, 3),
(22, 2, 8),
(23, 3, 8),
(24, 2, 9),
(25, 3, 9),
(26, 5, 9),
(27, 6, 9),
(28, 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_translation`
--

CREATE TABLE `coupon_translation` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `language` varchar(55) NOT NULL,
  `coupon_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon_translation`
--

INSERT INTO `coupon_translation` (`id`, `name`, `description`, `language`, `coupon_id`) VALUES
(4, 'test couponte edit', 'eeqwewedasdsd edit', 'en', 2),
(5, '测试则扣edit', '我打算打色edit', 'cn', 2),
(6, 'malay couponedit', 'malacopupiodas dodedit', 'my', 2),
(7, 'test2eew', 'eqweqewq', 'en', 3),
(8, '123234', '12ewqeqweqw', 'cn', 3),
(9, 'awdw1', '32131dqwdasd', 'my', 3),
(10, '1234444', 'wdwqeqww', 'en', 4),
(11, '12fdhby6', 'fterg23t34', 'cn', 4),
(12, '412312d', 'ewf4t4t5', 'my', 4),
(13, 'sgssf', 'qerwqe2', 'en', 5),
(14, 'asd12eedwqdsa', '1234eededf', 'cn', 5),
(15, '12edqadas', '212ewde', 'my', 5),
(16, 'ABC Coupon!! edit', 'this is testing coupon, hahahahha edit', 'en', 6),
(17, '甲乙丙折扣 edit', '这个是测试， 哈哈哈哈哈 edit', 'cn', 6),
(18, 'ABCMalay coupon edit', 'int testing hhahahahaa edit', 'my', 6),
(19, 'TEST2', 'dasdwqe124dfe', 'en', 7),
(20, 'test chionese', 'test chisnese disctption', 'cn', 7),
(21, 'test malay 2', 'maly  desctripron test12', 'my', 7),
(22, 'test1', '123', 'en', 8),
(23, 'haha2', 'haha2', 'cn', 8),
(24, 'hhe1', 'hehe1', 'my', 8),
(25, 'test', 'test', 'en', 9),
(26, 'test', 'test', 'cn', 9),
(27, 'test', 'test', 'my', 9);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_user`
--

CREATE TABLE `coupon_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `coupon_code_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `distributor_product`
--

CREATE TABLE `distributor_product` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `distributor_product`
--

INSERT INTO `distributor_product` (`id`, `user_id`, `product_id`, `stock`, `status`, `date_created`, `date_modified`) VALUES
(3, 3, 7, 10, 1, '2020-11-26 17:04:53', '2020-11-26 17:04:53'),
(4, 3, 5, 23, 0, '2020-11-26 17:18:04', '2020-11-26 17:18:17'),
(5, 3, 3, 95, 1, '2020-11-26 17:25:21', '2020-11-26 17:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `distributor_wallet_transaction`
--

CREATE TABLE `distributor_wallet_transaction` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `amount` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `reason` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `distributor_id` int(10) UNSIGNED NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `distributor_wallet_transaction`
--

INSERT INTO `distributor_wallet_transaction` (`id`, `status`, `amount`, `reason`, `image`, `distributor_id`, `date_created`, `date_modified`) VALUES
(1, 2, '50.0000', NULL, 'REF1606840618.jpg', 3, '2020-11-28 12:48:04', '2020-12-01 16:36:57'),
(2, 3, '58.0000', 'test reject reasontest reject reasontest reject reasontest reject reasontest reject reasontest reject reason', NULL, 3, '2020-12-02 15:00:50', '2020-12-02 15:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `distributor_wallet_transaction_history`
--

CREATE TABLE `distributor_wallet_transaction_history` (
  `id` int(11) NOT NULL,
  `amount` decimal(12,4) NOT NULL,
  `current_amount` decimal(12,4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `distributor_id` int(11) UNSIGNED NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `distributor_wallet_transaction_history`
--

INSERT INTO `distributor_wallet_transaction_history` (`id`, `amount`, `current_amount`, `description`, `distributor_id`, `date_created`, `date_modified`) VALUES
(1, '229.0000', '229.0000', 'Sale. Order Id: 1605439268', 3, '2020-11-28 16:51:29', '2020-11-28 16:51:29'),
(2, '229.0000', '458.0000', 'Sale. Order Id: 1605439268', 3, '2020-11-28 16:56:54', '2020-11-28 16:56:54'),
(3, '-50.0000', '408.0000', 'Refund Request. Date: 2020-11-28 20:48:04', 3, '2020-12-01 16:36:57', '2020-12-01 16:36:57'),
(5, '131.6000', '539.6000', 'Sale. Order Id: 1608377194', 3, '2020-12-19 15:33:42', '2020-12-19 15:33:42'),
(6, '131.6000', '671.2000', 'Sale. Order Id: 1608377194(testing)', 3, '2020-12-19 15:35:30', '2020-12-19 15:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `geo_zone`
--

CREATE TABLE `geo_zone` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL COMMENT '0= admin',
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `geo_zone`
--

INSERT INTO `geo_zone` (`id`, `name`, `description`, `admin_id`, `status`, `date_created`, `date_modified`) VALUES
(1, 'Test Geo', 'This  is testing geo zone', 3, 1, '2020-11-28 18:12:21', '2020-12-06 10:41:09'),
(2, 'test222', 'This  is testing geo zone2222222', 3, 1, '2020-11-28 18:14:33', '2020-11-28 18:14:33'),
(4, 'admin geo zone', 'this is admin all zone', 0, 1, '2020-12-06 08:28:56', '2020-12-08 15:08:42'),
(8, 'tt', 'ttt', 0, 1, '2020-12-06 08:46:08', '2020-12-06 08:46:08'),
(15, 'kl selangor', 'This  is testing geo zone2222222', 0, 1, '2020-12-06 09:30:42', '2020-12-08 15:06:46'),
(16, 'admin geo testedit', 'this is admin all zone', 0, 1, '2020-12-06 10:29:50', '2020-12-08 15:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `geo_zone_list`
--

CREATE TABLE `geo_zone_list` (
  `id` int(11) NOT NULL,
  `geo_zone_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `geo_zone_list`
--

INSERT INTO `geo_zone_list` (`id`, `geo_zone_id`, `state_id`) VALUES
(2, 2, 3),
(3, 2, 14),
(4, 2, 4),
(5, 2, 6),
(9, 3, 12),
(20, 8, 0),
(53, 1, 0),
(55, 15, 12),
(56, 15, 14),
(57, 4, 14),
(58, 16, 1),
(59, 16, 2),
(60, 16, 3),
(61, 16, 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `status` int(1) NOT NULL,
  `customer_name` varchar(155) NOT NULL,
  `customer_email` varchar(155) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_postcode` varchar(155) NOT NULL,
  `customer_city` varchar(155) NOT NULL,
  `customer_state` varchar(155) NOT NULL,
  `customer_contact` varchar(11) NOT NULL,
  `total_price` decimal(12,4) NOT NULL,
  `coupon_code` varchar(11) DEFAULT NULL,
  `discount_percent` decimal(12,4) DEFAULT 0.0000,
  `discount_amount` decimal(12,4) DEFAULT 0.0000,
  `discount_reward` decimal(12,4) DEFAULT 0.0000,
  `shipping_fee` decimal(12,4) DEFAULT 0.0000,
  `total_payment` decimal(12,4) NOT NULL,
  `track_code` varchar(55) DEFAULT NULL,
  `consignment_number` varchar(155) DEFAULT NULL,
  `gateway_order_id` varchar(155) DEFAULT NULL,
  `payment_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=online pay, 2= cash/other',
  `reason` text DEFAULT NULL COMMENT 'cancel reason',
  `users_id` int(11) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1 COMMENT 'order type, 1- normal, 2= distributor self order',
  `admin_id` int(11) NOT NULL DEFAULT 0 COMMENT '0=admin, other id= distributor id',
  `reward_point` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `customer_name`, `customer_email`, `customer_address`, `customer_postcode`, `customer_city`, `customer_state`, `customer_contact`, `total_price`, `coupon_code`, `discount_percent`, `discount_amount`, `discount_reward`, `shipping_fee`, `total_payment`, `track_code`, `consignment_number`, `gateway_order_id`, `payment_type`, `reason`, `users_id`, `type`, `admin_id`, `reward_point`, `date_created`, `date_modified`) VALUES
(1, 1, 'test1', 'cba@gmail.com', '36,Jalan Seroja', '83700', 'YONG PENG', '2', '+6012306150', '0.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 'CAUWK3CQKM', NULL, NULL, 1, 'Payment Fail', 1, 1, 0, 0, '2020-10-25 12:41:40', '2020-10-25 12:41:40'),
(2, 1, 'test1', 'cba@gmail.com', '36,Jalan Seroja', '83700', 'YONG PENG', '5', '+6012306150', '0.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 'CA0FH5NALR', NULL, NULL, 1, 'Payment Fail', 1, 1, 0, 0, '2020-10-25 12:42:05', '2020-10-25 12:42:05'),
(3, 1, 'test1', 'cba@gmail.com', '36,Jalan Seroja', '83700', 'YONG PENG', '5', '+6012306150', '0.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 'CARIKPDHI4', NULL, NULL, 1, 'Payment Fail', 1, 1, 0, 0, '2020-10-25 12:44:48', '2020-10-25 12:44:48'),
(4, 1, 'test1', 'cba@gmail.com', '36,Jalan Seroja', '83700', 'YONG PENG', '4', '+6012306150', '0.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 'CAQ5NJAHB9', NULL, NULL, 1, 'Payment Fail', 1, 1, 0, 0, '2020-10-25 12:45:25', '2020-10-25 12:45:25'),
(5, 1, 'test1', 'cba@gmail.com', '36,Jalan Seroja', '83700', 'YONG PENG', '6', '+6012306150', '0.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 'CA82EIX6HP', NULL, NULL, 1, 'Payment Fail', 1, 1, 0, 0, '2020-10-25 12:45:52', '2020-10-25 12:45:52'),
(6, 1, 'test1', 'cba@gmail.com', '36,Jalan Seroja', '83700', 'YONG PENG', '7', '+6012306150', '121.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '121.5000', 'CATARI1TME', NULL, NULL, 1, 'Payment Fail', 1, 1, 0, 0, '2020-10-25 12:46:24', '2020-10-25 12:46:24'),
(7, 1, 'test1', 'cba@gmail.com', '36,Jalan Seroja', '83700', 'YONG PENG', '8', '+6012306150', '121.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '121.5000', 'CA53ZXYZIW', NULL, NULL, 1, 'Payment Fail', 5, 1, 0, 0, '2020-10-25 12:50:01', '2020-10-25 12:50:01'),
(8, 1, 'puah wee wee', 'PUAHWEEWEE@gmail.COM', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', '3', '+6016904302', '243.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '243.0000', 'CANVZ2CIJJ', NULL, '1651654894', 1, 'Payment Fail', 6, 1, 0, 0, '2020-10-25 12:52:30', '2020-10-25 12:52:30'),
(9, 1, 'test222111', 'puahweewe11e@gmail.com', '12345', '12345', '12334', '2', '+4401637237', '40.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '40.5000', 'CAIV45ZTZS', NULL, NULL, 1, 'Payment Fail', 1, 1, 0, 0, '2020-10-29 07:04:26', '2020-10-29 07:04:26'),
(10, 1, 'test222111', 'puahweewe11e@gmail.com', '12345', '12345', '12334', '2', '+4401637237', '40.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '40.5000', 'CAPZTJHDD2', NULL, NULL, 1, 'Payment Fail', 6, 1, 0, 0, '2020-10-29 07:08:53', '2020-10-29 07:08:53'),
(11, 1, 'test222111', 'puahweewe11e@gmail.com', '12345', '12345', '12334', '2', '+4401637237', '283.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '283.5000', 'CAMBB9NRA2', NULL, NULL, 1, 'Payment Fail', 6, 1, 0, 0, '2020-10-29 07:10:00', '2020-10-29 07:10:00'),
(12, 1, 'test222111', 'puahweewe11e@gmail.com', '12345', '12345', '12334', '2', '+4401637237', '40.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '40.5000', 'CAB0NLPNM4', NULL, '1603956372', 1, 'Payment Fail', 6, 1, 0, 0, '2020-10-29 07:26:15', '2020-10-29 07:26:15'),
(13, 1, 'test222111', 'puahweewe11e@gmail.com', '12345', '12345', '12334', '2', '+4401637237', '40.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '40.5000', 'CAE16RKSYI', 'TESTFREEBIESMAIL', '1603956408', 2, 'Payment Fail', 6, 1, 3, 0, '2020-10-29 07:26:50', '2020-11-28 06:44:41'),
(14, 4, 'Wayne Test', 'puahweewee@gmail.com', '12345', '12345', '12334', '2', '+4401637237', '40.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '40.5000', 'CALDP3TYRC', 'TESTFREEBIESMAIL', '1603957644', 1, 'Payment Fail', 6, 1, 3, 0, '2020-10-29 07:47:28', '2020-12-19 15:50:33'),
(15, 2, 'Wayne Test', 'puahweewee@gmail.com', '12345', '12345', '12334', '2', '+4401637237', '40.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '40.5000', 'CAXCPYGFTN', NULL, '1603957778', 1, 'Payment Fail', 6, 1, 0, 0, '2020-10-29 07:49:40', '2020-10-29 07:49:46'),
(16, 1, 'Wayne Test', 'puahweewee@gmail.com', '12345', '12345', '12334', '2', '+4401637237', '60.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '60.5000', 'CAZK8MS036', NULL, '1603957999', 1, 'Payment Fail', 6, 1, 0, 0, '2020-10-29 07:53:22', '2020-10-29 07:53:22'),
(17, 1, 'Wayne Test', 'puahweewee@gmail.com', '12345', '12345', '12334', '2', '+4401637237', '302.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '302.5000', 'CAKFQ4JKEJ', NULL, '1603960442', 1, 'Payment Fail', 6, 1, 0, 0, '2020-10-29 08:34:08', '2020-10-29 08:34:08'),
(18, 2, 'Wayne Test', 'puahweewee@gmail.com', '12345', '12345', '12334', '2', '+4401637237', '302.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '302.5000', 'CALBCDO0X4', NULL, '1603960493', 1, 'Payment Fail', 6, 1, 0, 0, '2020-10-29 08:40:01', '2020-10-29 08:40:10'),
(19, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '3', '+4401637237', '20.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '20.0000', 'CA7VN95UBL', NULL, '1603963404', 1, 'Payment Fail', 6, 1, 0, 0, '2020-10-29 09:24:38', '2020-10-29 09:24:38'),
(20, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '22.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '22.0000', 'CAMKNRI8P5', NULL, '1605101383', 1, 'Payment Fail', 6, 1, 0, 0, '2020-11-11 13:29:45', '2020-11-11 13:29:45'),
(21, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '22.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '22.0000', 'CA78RV7LBR', NULL, '1605101482', 1, 'Payment Fail', 6, 1, 0, 0, '2020-11-11 13:32:15', '2020-11-11 13:32:15'),
(22, 3, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '22.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '22.0000', 'CAEB8CSV25', 'DQWR21FR4', '1605101611', 1, 'Payment Fail', 6, 1, 0, 0, '2020-11-11 13:33:49', '2020-11-12 15:18:07'),
(23, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '22.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '22.0000', 'CALJ0LJ69H', 'dasdwwe', '1605101675', 1, 'Payment Fail', 6, 1, 0, 0, '2020-11-11 13:34:38', '2020-11-12 15:18:22'),
(24, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '305.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '305.5000', 'CAYLN89FAN', NULL, '1605429732', 1, 'Payment Fail', 6, 1, 0, 0, '2020-11-15 08:43:03', '2020-11-15 08:43:03'),
(25, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '305.5000', 'DERQDW', '10.0000', '20.0000', '0.0000', '0.0000', '285.5000', 'CAVC83X8BF', NULL, '1605430804', 1, 'Payment Fail', 6, 1, 0, 0, '2020-11-15 09:00:14', '2020-11-15 09:01:14'),
(26, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '305.5000', 'DERQDW', '0.0000', '0.0000', '0.0000', '0.0000', '305.5000', 'CAHFXPUYLI', NULL, '1605431099', 1, 'Payment Fail', 6, 1, 0, 0, '2020-11-15 09:06:16', '2020-11-15 09:06:16'),
(27, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '305.5000', 'QQWERT', '20.0000', '10.0000', '0.0000', '0.0000', '295.5000', 'CAP04FOZBO', NULL, '1605438787', 1, 'Payment Fail', 6, 1, 0, 0, '2020-11-15 11:14:02', '2020-11-15 11:14:07'),
(28, 1, 'Wayne Test test2', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '50.5000', 'test', '0.0000', '4.0000', '0.0000', '0.0000', '46.5000', 'CA54VMV0N9', NULL, '1605438877', 1, 'test normal user cancel', 6, 1, 0, 0, '2020-11-15 11:16:05', '2020-12-19 15:48:52'),
(29, 4, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '233.0000', 'GGSDFF', '0.0000', '4.0000', '0.0000', '0.0000', '229.0000', 'CA4J8681A1', 'thisistest', '1605439268', 1, 'Payment Fail', 6, 1, 3, 0, '2020-11-15 11:23:55', '2020-11-28 16:56:54'),
(30, 1, 'nicky', 'nickyz111406@gmail.com', 'testing', '81100', 'JB', '1', '0123456789', '173.5000', 'test1', '0.0000', '0.0000', '0.0000', '0.0000', '173.5000', 'CAPG4L658R', NULL, '1605509164', 1, 'Payment Fail', 17, 1, 0, 0, '2020-11-16 06:46:38', '2020-11-16 06:46:38'),
(31, 2, 'nicky', 'nickyz111406@gmail.com', 'testing', '81100', 'JB', '1', '0123456789', '173.5000', 'GGSDFF', '0.0000', '4.0000', '0.0000', '0.0000', '169.5000', 'CA0GQOV066', NULL, '1605509211', 1, 'Payment Fail', 17, 1, 0, 0, '2020-11-16 06:47:19', '2020-11-16 06:47:28'),
(32, 2, 'test', 'dealer@gmail.com', 'kampung baru abc', '12345', 'hahacity', '1', '016372372', '251.5000', 'GGSDFF', '0.0000', '4.0000', '0.0000', '0.0000', '247.5000', 'CAS20GU9NC', NULL, '1605509674', 2, 'Payment Fail', 5, 1, 0, 0, '2020-11-16 06:54:43', '2020-11-16 06:54:50'),
(33, 4, 'test3', 'test@gmail.com', 'abcaddresss', '73200', 'tampin', '4', '0163723721', '1808.5500', '', '0.0000', '0.0000', '0.0000', '0.0000', '1808.5500', 'CA9YHQ4V9P', NULL, 'self order - no id', 1, 'Payment Fail', 3, 2, 3, 0, '2020-11-27 17:24:49', '2020-11-27 17:24:49'),
(34, 1, 'new name', 'test@gmail.com', '1023 kamoung abc, jalan hahaa', '73200', 'johor bahru', '4', '0163723123', '245.5000', '', '0.0000', '0.0000', '0.0000', '0.0000', '245.5000', 'CAUTIPDNSK', NULL, '1606663692', 1, 'Payment Fail', 3, 1, 0, 0, '2020-11-29 15:52:58', '2020-11-29 15:52:58'),
(35, 1, 'new namehaha', 'test@gmail.com', '1023 kamoung abc, jalan hahaa', '73200', 'johor bahru', '4', '0163723123', '294.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '294.0000', 'CA2PBBOM6B', NULL, '1606665547', 2, 'i want cancel            \r\n<br>\r\napprove cancel', 3, 1, 0, 0, '2020-11-29 15:59:33', '2020-12-19 16:28:29'),
(36, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '016372372', '305.5000', 'GGSDFF', '0.0000', '4.0000', '0.0000', '1.6500', '303.1500', 'CAOYRNF21J', NULL, '1608046218', 1, 'UnPaid', 6, 1, 0, 0, '2020-12-15 15:31:16', '2020-12-15 15:31:16'),
(37, 4, 'new name1', 'test@gmail.com', '1023 kamoung abc, jalan hahaa', '73200', 'johor bahru', '4', '0163723123', '150.0000', '', '0.0000', '0.0000', '0.0000', '0.0000', '150.0000', 'CA0I7MU7SH', NULL, 'self order - no id', 1, NULL, 3, 2, 3, 0, '2020-12-19 11:18:36', '2020-12-19 11:18:36'),
(38, 4, 'new name1', 'test@gmail.com', '1023 kamoung abc, jalan hahaa', '73200', 'johor bahru', '4', '0163723123', '250.2200', '', '0.0000', '0.0000', '0.0000', '0.0000', '250.2200', 'CAMR5PKMZY', NULL, 'self order - no id', 1, NULL, 3, 2, 3, 0, '2020-12-19 11:21:52', '2020-12-19 11:21:52'),
(39, 4, 'Test Dealer', 'dealer@gmail.com', 'kampung baru abc', '12345', 'hahacity', '1', '01637237223', '131.6000', '', '0.0000', '0.0000', '0.0000', '0.0000', '131.6000', 'CACC1BS71R', 'testcomplete', '1608377194', 1, 'test cancel reason                     \r\n\r\n<br>to test cancel reason. approve this cancel', 5, 1, 3, 0, '2020-12-19 11:26:59', '2020-12-19 15:35:30'),
(40, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '740.0000', '', '0.0000', '0.0000', '0.0000', '2.5800', '740.0000', 'CAEAD2TNP3', NULL, '1609672632', 1, 'UnPaid', 6, 1, 0, 0, '2021-01-03 11:27:14', '2021-01-03 11:27:14'),
(41, 4, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '740.0000', '', '0.0000', '0.0000', '0.0000', '2.5800', '740.0000', 'CAD2XBSHST', 'test point', '1609673555', 1, 'UnPaid', 6, 1, 0, 114, '2021-01-03 11:33:29', '2021-01-03 12:36:55'),
(42, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '740.0000', '', '0.0000', '0.0000', '1.1400', '2.5800', '738.8600', 'CAA0WQ6L2Y', NULL, '1609764692', 1, 'UnPaid', 6, 1, 0, 114, '2021-01-04 12:51:44', '2021-01-04 12:51:51'),
(43, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '72.5000', '', '0.0000', '0.0000', '0.4200', '1.0300', '72.0800', 'CAXTERRKLS', NULL, '1609768605', 1, 'UnPaid', 6, 1, 0, 42, '2021-01-04 13:57:04', '2021-01-04 13:57:18'),
(44, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '72.5000', '', '0.0000', '0.0000', '0.0000', '1.0300', '72.5000', 'CAAO74FICA', NULL, '1609768665', 1, 'UnPaid', 6, 1, 0, 42, '2021-01-04 13:57:51', '2021-01-04 13:58:01'),
(45, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '128.0000', '', '0.0000', '0.0000', '0.1700', '0.4100', '127.8300', 'CA0JHU9ACK', NULL, '1609768745', 1, 'UnPaid', 6, 1, 0, 17, '2021-01-04 14:00:19', '2021-01-04 14:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(12,4) NOT NULL COMMENT 'single price',
  `point` int(20) NOT NULL,
  `rate` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `qty`, `price`, `point`, `rate`, `order_id`, `date_created`, `date_modified`) VALUES
(1, 0, 0, '0.0000', 0, 3, 7, '2020-10-25 12:50:01', '2020-10-25 12:50:01'),
(2, 0, 0, '0.0000', 0, 0, 7, '2020-10-25 12:50:01', '2020-10-25 12:50:01'),
(3, 2, 2, '20.0000', 0, 0, 8, '2020-10-25 12:52:30', '2020-10-25 12:52:30'),
(4, 3, 6, '40.5000', 0, 5, 8, '2020-10-25 12:52:30', '2020-10-25 12:52:30'),
(5, 2, 1, '20.0000', 0, 0, 9, '2020-10-29 07:04:26', '2020-10-29 07:04:26'),
(6, 3, 1, '40.5000', 0, 5, 9, '2020-10-29 07:04:26', '2020-10-29 07:04:26'),
(7, 2, 1, '20.0000', 0, 0, 10, '2020-10-29 07:08:53', '2020-10-29 07:08:53'),
(8, 3, 1, '40.5000', 0, 0, 10, '2020-10-29 07:08:53', '2020-10-29 07:08:53'),
(9, 2, 2, '20.0000', 0, 4, 11, '2020-10-29 07:10:00', '2020-10-29 07:10:00'),
(10, 3, 7, '40.5000', 0, 0, 11, '2020-10-29 07:10:00', '2020-10-29 07:10:00'),
(11, 2, 1, '20.0000', 0, 2, 12, '2020-10-29 07:26:15', '2020-10-29 07:26:15'),
(12, 3, 1, '40.5000', 0, 1, 12, '2020-10-29 07:26:15', '2020-10-29 07:26:15'),
(13, 2, 1, '20.0000', 0, 3, 13, '2020-10-29 07:26:50', '2020-10-29 07:26:50'),
(14, 3, 1, '40.5000', 0, 0, 13, '2020-10-29 07:26:50', '2020-10-29 07:26:50'),
(15, 2, 1, '20.0000', 0, 5, 14, '2020-10-29 07:47:28', '2020-12-20 11:16:55'),
(16, 3, 1, '40.5000', 0, 4, 14, '2020-10-29 07:47:28', '2020-12-20 11:16:55'),
(17, 2, 1, '20.0000', 0, 0, 15, '2020-10-29 07:49:40', '2020-10-29 07:49:40'),
(18, 3, 1, '40.5000', 0, 0, 15, '2020-10-29 07:49:40', '2020-10-29 07:49:40'),
(19, 2, 1, '20.0000', 0, 0, 16, '2020-10-29 07:53:22', '2020-10-29 07:53:22'),
(20, 3, 1, '40.5000', 0, 0, 16, '2020-10-29 07:53:22', '2020-10-29 07:53:22'),
(21, 2, 5, '20.0000', 0, 0, 17, '2020-10-29 08:34:08', '2020-10-29 08:34:08'),
(22, 3, 5, '40.5000', 0, 0, 17, '2020-10-29 08:34:08', '2020-10-29 08:34:08'),
(23, 2, 5, '20.0000', 0, 0, 18, '2020-10-29 08:40:01', '2020-10-29 08:40:01'),
(24, 3, 5, '40.5000', 0, 0, 18, '2020-10-29 08:40:01', '2020-10-29 08:40:01'),
(25, 2, 1, '20.0000', 0, 0, 19, '2020-10-29 09:24:38', '2020-10-29 09:24:38'),
(26, 2, 1, '22.0000', 0, 0, 20, '2020-11-11 13:29:45', '2020-11-11 13:29:45'),
(27, 2, 1, '22.0000', 0, 0, 21, '2020-11-11 13:32:15', '2020-11-11 13:32:15'),
(28, 2, 1, '22.0000', 0, 0, 22, '2020-11-11 13:33:49', '2020-11-11 13:33:49'),
(29, 2, 1, '22.0000', 0, 0, 23, '2020-11-11 13:34:38', '2020-11-11 13:34:38'),
(30, 2, 1, '22.0000', 0, 0, 24, '2020-11-15 08:43:03', '2020-11-15 08:43:03'),
(31, 3, 1, '50.5000', 0, 0, 24, '2020-11-15 08:43:03', '2020-11-15 08:43:03'),
(32, 5, 1, '233.0000', 0, 0, 24, '2020-11-15 08:43:03', '2020-11-15 08:43:03'),
(33, 2, 1, '22.0000', 0, 0, 25, '2020-11-15 09:00:14', '2020-11-15 09:00:14'),
(34, 3, 1, '50.5000', 0, 0, 25, '2020-11-15 09:00:14', '2020-11-15 09:00:14'),
(35, 5, 1, '233.0000', 0, 0, 25, '2020-11-15 09:00:14', '2020-11-15 09:00:14'),
(36, 2, 1, '22.0000', 0, 0, 26, '2020-11-15 09:06:16', '2020-11-15 09:06:16'),
(37, 3, 1, '50.5000', 0, 0, 26, '2020-11-15 09:06:16', '2020-11-15 09:06:16'),
(38, 5, 1, '233.0000', 0, 0, 26, '2020-11-15 09:06:16', '2020-11-15 09:06:16'),
(39, 2, 1, '22.0000', 0, 0, 27, '2020-11-15 11:14:02', '2020-11-15 11:14:02'),
(40, 3, 1, '50.5000', 0, 0, 27, '2020-11-15 11:14:02', '2020-11-15 11:14:02'),
(41, 5, 1, '233.0000', 0, 0, 27, '2020-11-15 11:14:02', '2020-11-15 11:14:02'),
(42, 3, 1, '50.5000', 0, 0, 28, '2020-11-15 11:16:05', '2020-11-15 11:16:05'),
(43, 5, 1, '233.0000', 0, 5, 29, '2020-11-15 11:23:55', '2020-12-20 11:17:11'),
(44, 2, 1, '22.0000', 0, 0, 30, '2020-11-16 06:46:38', '2020-11-16 06:46:38'),
(45, 3, 3, '50.5000', 0, 0, 30, '2020-11-16 06:46:38', '2020-11-16 06:46:38'),
(46, 2, 1, '22.0000', 0, 0, 31, '2020-11-16 06:47:19', '2020-11-16 06:47:19'),
(47, 3, 3, '50.5000', 0, 0, 31, '2020-11-16 06:47:19', '2020-11-16 06:47:19'),
(48, 3, 1, '40.5000', 0, 0, 32, '2020-11-16 06:54:43', '2020-11-16 06:54:43'),
(49, 5, 1, '211.0000', 0, 0, 32, '2020-11-16 06:54:43', '2020-11-16 06:54:43'),
(50, 3, 22, '11.0000', 0, 0, 33, '2020-11-27 17:24:49', '2020-11-27 17:24:49'),
(51, 7, 33, '44.0000', 0, 0, 33, '2020-11-27 17:24:49', '2020-11-27 17:24:49'),
(52, 5, 1, '155.0000', 0, 0, 34, '2020-11-29 15:52:58', '2020-11-29 15:52:58'),
(53, 6, 1, '50.5000', 0, 0, 34, '2020-11-29 15:52:58', '2020-11-29 15:52:58'),
(54, 7, 1, '40.0000', 0, 0, 34, '2020-11-29 15:52:58', '2020-11-29 15:52:58'),
(55, 2, 1, '18.0000', 0, 0, 35, '2020-11-29 15:59:33', '2020-11-29 15:59:33'),
(56, 3, 1, '30.5000', 0, 0, 35, '2020-11-29 15:59:33', '2020-11-29 15:59:33'),
(57, 5, 1, '155.0000', 0, 0, 35, '2020-11-29 15:59:33', '2020-11-29 15:59:33'),
(58, 6, 1, '50.5000', 0, 0, 35, '2020-11-29 15:59:33', '2020-11-29 15:59:33'),
(59, 7, 1, '40.0000', 0, 0, 35, '2020-11-29 15:59:33', '2020-11-29 15:59:33'),
(60, 2, 1, '22.0000', 0, 0, 36, '2020-12-15 15:31:16', '2020-12-15 15:31:16'),
(61, 3, 1, '50.5000', 0, 0, 36, '2020-12-15 15:31:16', '2020-12-15 15:31:16'),
(62, 5, 1, '233.0000', 0, 0, 36, '2020-12-15 15:31:16', '2020-12-15 15:31:16'),
(63, 3, 5, '12.0000', 0, 0, 37, '2020-12-19 11:18:36', '2020-12-19 11:18:36'),
(64, 3, 5, '33.0000', 0, 0, 37, '2020-12-19 11:18:36', '2020-12-19 11:18:36'),
(65, 3, 1, '11.0000', 0, 0, 38, '2020-12-19 11:21:52', '2020-12-19 11:21:52'),
(66, 5, 2, '22.0000', 0, 0, 38, '2020-12-19 11:21:52', '2020-12-19 11:21:52'),
(67, 3, 2, '40.5000', 0, 0, 39, '2020-12-19 11:26:59', '2020-12-19 11:26:59'),
(68, 7, 1, '50.6000', 0, 0, 39, '2020-12-19 11:26:59', '2020-12-19 11:26:59'),
(69, 2, 1, '22.0000', 22, 0, 40, '2021-01-03 11:27:14', '2021-01-03 11:27:14'),
(70, 6, 3, '73.0000', 12, 0, 40, '2021-01-03 11:27:14', '2021-01-03 11:27:14'),
(71, 3, 2, '50.5000', 20, 0, 40, '2021-01-03 11:27:14', '2021-01-03 11:27:14'),
(72, 7, 3, '55.0000', 5, 0, 40, '2021-01-03 11:27:14', '2021-01-03 11:27:14'),
(73, 5, 1, '233.0000', 1, 0, 40, '2021-01-03 11:27:14', '2021-01-03 11:27:14'),
(74, 2, 1, '22.0000', 22, 0, 41, '2021-01-03 11:33:29', '2021-01-03 11:33:29'),
(75, 6, 3, '73.0000', 12, 0, 41, '2021-01-03 11:33:29', '2021-01-03 11:33:29'),
(76, 3, 2, '50.5000', 20, 0, 41, '2021-01-03 11:33:29', '2021-01-03 11:33:29'),
(77, 7, 3, '55.0000', 5, 0, 41, '2021-01-03 11:33:29', '2021-01-03 11:33:29'),
(78, 5, 1, '233.0000', 1, 0, 41, '2021-01-03 11:33:29', '2021-01-03 11:33:29'),
(79, 2, 1, '22.0000', 22, 0, 42, '2021-01-04 12:51:44', '2021-01-04 12:51:44'),
(80, 6, 3, '73.0000', 12, 0, 42, '2021-01-04 12:51:44', '2021-01-04 12:51:44'),
(81, 3, 2, '50.5000', 20, 0, 42, '2021-01-04 12:51:44', '2021-01-04 12:51:44'),
(82, 7, 3, '55.0000', 5, 0, 42, '2021-01-04 12:51:44', '2021-01-04 12:51:44'),
(83, 5, 1, '233.0000', 1, 0, 42, '2021-01-04 12:51:44', '2021-01-04 12:51:44'),
(84, 2, 1, '22.0000', 22, 0, 43, '2021-01-04 13:57:04', '2021-01-04 13:57:04'),
(85, 3, 1, '50.5000', 20, 0, 43, '2021-01-04 13:57:04', '2021-01-04 13:57:04'),
(86, 2, 1, '22.0000', 22, 0, 44, '2021-01-04 13:57:51', '2021-01-04 13:57:51'),
(87, 3, 1, '50.5000', 20, 0, 44, '2021-01-04 13:57:51', '2021-01-04 13:57:51'),
(88, 7, 1, '55.0000', 5, 0, 45, '2021-01-04 14:00:19', '2021-01-04 14:00:19'),
(89, 6, 1, '73.0000', 12, 0, 45, '2021-01-04 14:00:19', '2021-01-04 14:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `point_transaction`
--

CREATE TABLE `point_transaction` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_point_id` int(11) UNSIGNED NOT NULL,
  `amount` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `point` int(11) UNSIGNED NOT NULL,
  `point_allow_discount` int(11) UNSIGNED NOT NULL,
  `stock` int(11) UNSIGNED NOT NULL,
  `category` int(11) NOT NULL,
  `length` decimal(12,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `width` decimal(12,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `height` decimal(12,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `weight` decimal(12,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `image` varchar(55) NOT NULL,
  `is_point_deduct` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `point`, `point_allow_discount`, `stock`, `category`, `length`, `width`, `height`, `weight`, `image`, `is_point_deduct`, `status`, `date_created`, `date_modified`) VALUES
(2, 22, 33, 98, 1, '1.0000', '2.0000', '3.0000', '4.0000', 'PROD1601370391.jpg', 1, 1, '2020-09-29 09:06:31', '2021-01-04 13:58:01'),
(3, 20, 50, 181, 2, '0.0500', '0.0600', '0.0150', '1.0000', 'PROD1603465905.jpg', 1, 1, '2020-09-29 09:13:19', '2021-01-04 13:58:01'),
(5, 1, 44, 2215, 1, '1.0000', '1.0000', '1.0000', '5.0000', 'PROD1605375001.jpg', 1, 1, '2020-11-14 17:30:01', '2021-01-04 12:51:51'),
(6, 12, 52, 49, 2, '0.0130', '0.0110', '0.0050', '1.0030', 'PROD1606405413.jpg', 1, 1, '2020-11-26 15:43:32', '2021-01-04 15:28:28'),
(7, 5, 66, 15, 1, '0.0120', '0.0150', '0.0060', '0.0620', 'PROD1606405907.jpg', 1, 1, '2020-11-26 15:51:47', '2021-01-04 14:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_role_price`
--

CREATE TABLE `product_role_price` (
  `id` int(11) UNSIGNED NOT NULL,
  `price` double(12,4) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT 'user type',
  `product_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_role_price`
--

INSERT INTO `product_role_price` (`id`, `price`, `type`, `product_id`) VALUES
(1, 12.0000, 1, 1),
(2, 10.0000, 2, 1),
(3, 10.0000, 3, 1),
(4, 22.0000, 1, 2),
(5, 18.0000, 2, 2),
(6, 20.0000, 3, 2),
(7, 50.5000, 1, 3),
(8, 30.5000, 2, 3),
(9, 40.5000, 3, 3),
(10, 11.0000, 1, 4),
(11, 11.0000, 2, 4),
(12, 11.0000, 3, 4),
(13, 233.0000, 1, 5),
(14, 155.0000, 2, 5),
(15, 211.0000, 3, 5),
(16, 73.0000, 1, 6),
(17, 50.5000, 2, 6),
(18, 66.6600, 3, 6),
(19, 55.0000, 1, 7),
(20, 40.0000, 2, 7),
(21, 50.6000, 3, 7),
(22, 33.0000, 1, 8),
(23, 12.0000, 2, 8),
(24, 21.0000, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `product_translation`
--

CREATE TABLE `product_translation` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `language` varchar(55) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_translation`
--

INSERT INTO `product_translation` (`id`, `name`, `description`, `language`, `product_id`) VALUES
(1, 'te\'s\'t', 'test', 'en', 1),
(2, 'test', 'test', 'cn', 1),
(3, 'test', 'test', 'my', 1),
(4, 'Fresh Food ABC', 'test3321321313dasdwd d asd ds', 'en', 2),
(5, 'test2', 'dw', 'cn', 2),
(6, 'test2', 'dwqqe', 'my', 2),
(7, 'english product 1', 'this is englsih description', 'en', 3),
(8, '华语货物1', '这个是华语注释', 'cn', 3),
(9, 'Melayu Barang 1', 'inilah isi barang ahahah', 'my', 3),
(10, '3123', '32132', 'en', 4),
(11, '3213', '3213', 'cn', 4),
(12, 'wqewqe', '312', 'my', 4),
(13, 'New Product1', 'new descript 1', 'en', 5),
(14, '阿萨适当的', '这是哈哈哈哈哈哈啊实打实哦配合', 'cn', 5),
(15, 'malay anemi', 'maly descipt ghahah apdsn', 'my', 5),
(16, 'test new', 'this  is new prodcuct', 'en', 6),
(17, '华语产品', '哈哈哈 华语解释', 'cn', 6),
(18, 'malay name', 'malay descrption', 'my', 6),
(19, 'other product', 'test', 'en', 7),
(20, '测试', 'test', 'cn', 7),
(21, 'test maly', 'test malay', 'my', 7),
(22, 'test reduce point', '<p>test reduce point<br></p>', 'en', 8),
(23, 'test reduce point', '<p>test reduce point<br></p>', 'cn', 8),
(24, 'test reduce point', '<p>test reduce point<br></p>', 'my', 8);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) UNSIGNED NOT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1=amt, 2=percentage',
  `amt` decimal(12,4) NOT NULL,
  `percentage` int(11) NOT NULL,
  `capped` decimal(12,4) UNSIGNED NOT NULL,
  `free_delivery` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_product`
--

CREATE TABLE `promotion_product` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `promotion_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_translation`
--

CREATE TABLE `promotion_translation` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `language` varchar(55) NOT NULL,
  `promotion_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reward_point_value`
--

CREATE TABLE `reward_point_value` (
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL COMMENT '1 = 1sen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reward_point_value`
--

INSERT INTO `reward_point_value` (`id`, `value`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `geo_zone` int(11) NOT NULL,
  `first_weight` decimal(12,4) NOT NULL,
  `first_price` decimal(12,4) NOT NULL,
  `next_weight` decimal(12,4) NOT NULL,
  `next_price` decimal(12,4) NOT NULL,
  `charge` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL COMMENT '0=admin',
  `status` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `name`, `geo_zone`, `first_weight`, `first_price`, `next_weight`, `next_price`, `charge`, `admin_id`, `status`, `date_created`, `date_modified`) VALUES
(5, 'test', 1, '1.0050', '2.0000', '1.0000', '1.0000', 0, 3, 1, '2020-11-29 09:21:45', '2020-12-06 12:05:22'),
(6, 'test admin shipping 22222', 16, '2.0000', '0.4100', '2.0000', '0.3100', 0, 0, 1, '2020-12-06 11:54:09', '2020-12-06 12:05:28'),
(10, 'KL and Selangor', 15, '1.0000', '1.0000', '1.5000', '2.0000', 0, 0, 1, '2020-12-08 15:07:39', '2020-12-08 15:07:39');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `name` varchar(245) NOT NULL,
  `name_cn` varchar(245) DEFAULT NULL,
  `state_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='State of Malaysia';

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`, `name_cn`, `state_status`) VALUES
(1, 'JOHOR', '柔佛', 1),
(2, 'KEDAH', '吉打', 1),
(3, 'KELANTAN', '吉兰丹', 1),
(4, 'MELAKA', '马六甲', 1),
(5, 'NEGERI SEMBILAN', '森美兰', 1),
(6, 'PAHANG', '彭亨', 1),
(7, 'PERAK', '霹雳', 1),
(8, 'PERLIS', '玻璃市', 1),
(9, 'PENANG', '槟城', 1),
(10, 'SABAH', '沙巴', 1),
(11, 'SARAWAK', '沙捞越', 1),
(12, 'SELANGOR', '雪兰莪', 1),
(13, 'TERANGGANU', '登嘉楼', 1),
(14, 'KUALA LUMPUR', '吉隆坡', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` int(1) NOT NULL COMMENT '1=customer, 2=distributor, 3=dealer',
  `status` int(1) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `type`, `status`, `date_created`, `date_modified`) VALUES
(3, 'new name1', 'test@gmail.com', 'eGJvanZhUkhPbGl3VU03Z0pUMWwydz09', 'USER1606553276.jpg', 2, 1, '2020-10-04 09:30:11', '2020-12-06 12:18:00'),
(5, 'Test Dealer', 'dealer@gmail.com', 'c2RzSWNlUzIrQkozTTNoLytJMStzUT09', 'USER1608119130.jpg', 3, 1, '2020-10-04 12:44:40', '2020-12-19 11:25:04'),
(6, 'Wayne Test', 'puahweewee@gmail.com', 'c2RzSWNlUzIrQkozTTNoLytJMStzUT09', NULL, 1, 1, '2020-10-04 12:53:42', '2020-12-19 15:47:49'),
(7, 'Test USer 1', 'puah@gmail.com1', 'c2RzSWNlUzIrQkozTTNoLytJMStzUT09', NULL, 1, 1, '2020-10-15 14:00:15', '2020-10-15 14:17:46'),
(9, 'test register', '12345', 'RXp4MSs5R1hHMERmRVdqMDM2YjV3Zz09', NULL, 1, 1, '2020-10-15 14:41:16', '2020-10-15 14:41:16'),
(10, 'dasdsa', 'eqwew', 'dTVFNjRicmhnR0xUUGFJSUkwbC9YQT09', NULL, 1, 1, '2020-10-17 05:44:23', '2020-10-17 05:44:23'),
(11, 'test', 'test', 'M3JVTm1wc0ZpSnpVWXU3ZmtVbitBZz09', NULL, 1, 1, '2020-10-17 05:46:35', '2020-10-17 05:46:35'),
(12, 'test name', 'testcp', 'YUJEK1RZSWtwSktkSVVBbXlKeWxKdz09', NULL, 1, 1, '2020-10-17 05:48:12', '2020-10-17 05:48:12'),
(13, 'tet', 'qian1474@gmail.com', 'cEF3VDBqMXpiRFNxY2hTM3NkY0Rrdz09', NULL, 1, 1, '2020-10-17 06:30:09', '2020-10-17 06:30:09'),
(14, 'CHIE XHI QIAN', 'qian1411174@gmail.com', 'cEF3VDBqMXpiRFNxY2hTM3NkY0Rrdz09', NULL, 1, 1, '2020-10-17 06:34:16', '2020-10-17 06:34:16'),
(15, 'puah wee wee', 'PUAHWEEW11EE@gmail.COM', 'RXp4MSs5R1hHMERmRVdqMDM2YjV3Zz09', NULL, 1, 1, '2020-10-17 09:23:56', '2020-10-17 09:23:56'),
(16, 'puah wee wee', 'PUAHWEEW11EE11@gmail.COM', 'RXp4MSs5R1hHMERmRVdqMDM2YjV3Zz09', NULL, 1, 1, '2020-10-17 09:25:14', '2020-10-17 09:25:14'),
(17, 'nicky', 'nickyz111406@gmail.com', 'R2VDa2tMZWtQMi9vajZMclhoY1VqUT09', NULL, 1, 1, '2020-11-16 06:43:58', '2020-12-06 12:18:34'),
(18, 'dealer2', 'dealer2@gmail.com', 'c2RzSWNlUzIrQkozTTNoLytJMStzUT09', NULL, 3, 1, '2020-12-16 11:59:43', '2020-12-16 11:59:43'),
(19, 'register yest', 'register@gmail.com', 'R2VDa2tMZWtQMi9vajZMclhoY1VqUT09', NULL, 1, 1, '2021-01-04 14:35:20', '2021-01-04 14:35:20'),
(20, 'register test two', 'register2@gmail.com', 'R2VDa2tMZWtQMi9vajZMclhoY1VqUT09', NULL, 1, 1, '2021-01-04 14:40:37', '2021-01-04 14:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(55) DEFAULT NULL,
  `address` text NOT NULL,
  `postcode` varchar(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `name`, `contact`, `address`, `postcode`, `city`, `state`, `status`, `user_id`, `date_created`, `date_modified`) VALUES
(1, '-', '0169043022', 'abc kampung', '73255', 'klang', 1, 1, 1, '2020-10-04 09:25:05', '2020-10-04 09:25:05'),
(2, '-', '016372372', '12345', '12345', '12334', 1, 1, 2, '2020-10-04 09:27:20', '2020-10-04 09:27:20'),
(3, '-', '0163723123', '1023 kamoung abc, jalan hahaa', '73200', 'johor bahru', 4, 1, 3, '2020-10-04 09:30:11', '2020-12-06 12:18:00'),
(4, '-', '01637237223', 'kampung baru abc', '12345', 'hahacity', 1, 1, 5, '2020-10-04 12:44:40', '2020-12-19 11:25:04'),
(5, '-', '0169032551', 'thsis is tester address', '12345', 'testcity', 2, 1, 6, '2020-10-04 12:53:42', '2020-12-19 15:47:49'),
(6, '-', '01694887519', 'test suer address kampung1', '76522', 'testuser vi11', 1, 1, 7, '2020-10-15 14:00:15', '2020-10-15 14:17:46'),
(7, '-', '+60169043022', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 4, 1, 8, '2020-10-15 14:18:29', '2020-10-15 14:18:29'),
(8, '-', '+60169043022', 'Harry\'s Place Lakes Road', '3666', '4600', 2, 1, 9, '2020-10-15 14:41:16', '2020-10-15 14:41:16'),
(9, '-', '', '', '', '', 0, 1, 10, '2020-10-17 05:44:23', '2020-10-17 05:44:23'),
(10, '-', 'test', 'test', 'test', 'test', 1, 1, 11, '2020-10-17 05:46:35', '2020-10-17 05:46:35'),
(11, '-', 'testcon', 'testadd', 'test12344', 'testcity', 1, 1, 12, '2020-10-17 05:48:12', '2020-10-17 05:48:12'),
(12, '-', '0123061506', '456 TAMAN SEMARAK FASA 1', '73200', 'GEMENCHEH', 2, 1, 13, '2020-10-17 06:30:09', '2020-10-17 06:30:09'),
(13, '-', '+60169043022', '456 TAMAN SEMARAK FASA 1', '73200', 'GEMENCHEH', 5, 1, 14, '2020-10-17 06:34:16', '2020-10-17 06:34:16'),
(14, '-', '+60169043022', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 1, 1, 15, '2020-10-17 09:23:56', '2020-10-17 09:23:56'),
(15, '-', '+60169043022', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 1, 1, 16, '2020-10-17 09:25:14', '2020-10-17 09:25:14'),
(16, '-', '0123456789', 'testing', '81100', 'JB', 1, 1, 17, '2020-11-16 06:43:58', '2020-12-06 12:18:34'),
(17, '-', '016372372', '12345', '12345', '12334', 1, 1, 18, '2020-12-16 11:59:43', '2020-12-16 11:59:43'),
(18, '-', '01612365478', 'register address 123', '12345', 'kota tinggi', 1, 1, 19, '2021-01-04 14:35:20', '2021-01-04 14:35:20'),
(19, '-', '0163723722', 'hhaaha road 333', '75244', 'johor bahru', 1, 1, 20, '2021-01-04 14:40:37', '2021-01-04 14:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_dealer`
--

CREATE TABLE `user_dealer` (
  `id` int(11) UNSIGNED NOT NULL,
  `under_distributor` int(11) UNSIGNED NOT NULL COMMENT 'distributor id',
  `user_id` int(11) UNSIGNED NOT NULL COMMENT 'dealer_id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_dealer`
--

INSERT INTO `user_dealer` (`id`, `under_distributor`, `user_id`) VALUES
(1, 3, 5),
(2, 3, 6),
(3, 3, 18);

-- --------------------------------------------------------

--
-- Table structure for table `user_distributor`
--

CREATE TABLE `user_distributor` (
  `id` int(11) NOT NULL,
  `distributor_code` varchar(155) NOT NULL,
  `distributor_wallet` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_distributor`
--

INSERT INTO `user_distributor` (`id`, `distributor_code`, `distributor_wallet`, `bank_name`, `bank_account`, `user_id`) VALUES
(1, 'DISTV8UPZ8Y', '0.0000', NULL, NULL, 1),
(2, 'DIST6O77JCE', '0.0000', NULL, NULL, 2),
(3, 'DISTR8BHSU4', '671.2000', 'CIMB', '6154779896', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_point`
--

CREATE TABLE `user_point` (
  `id` int(10) UNSIGNED NOT NULL,
  `point` int(12) UNSIGNED NOT NULL DEFAULT 0,
  `checked` int(11) NOT NULL,
  `check_date` date DEFAULT NULL,
  `day_continue` int(11) NOT NULL DEFAULT 1,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_point`
--

INSERT INTO `user_point` (`id`, `point`, `checked`, `check_date`, `day_continue`, `user_id`, `date_modified`) VALUES
(1, 0, 0, '2021-01-03', 1, 7, NULL),
(2, 55224, 1, '2021-01-03', 3, 6, '2021-01-04 14:00:35'),
(3, 0, 0, NULL, 1, 8, NULL),
(4, 0, 0, NULL, 1, 9, NULL),
(5, 0, 0, NULL, 1, 10, NULL),
(6, 12, 0, NULL, 1, 11, NULL),
(7, 0, 0, NULL, 1, 12, NULL),
(8, 0, 0, NULL, 1, 13, NULL),
(9, 0, 0, NULL, 1, 14, NULL),
(10, 0, 0, NULL, 1, 15, NULL),
(11, 0, 0, NULL, 1, 16, NULL),
(12, 0, 0, NULL, 1, 17, NULL),
(13, 0, 0, NULL, 1, 19, NULL),
(14, 0, 0, NULL, 1, 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_point_transaction_history`
--

CREATE TABLE `user_point_transaction_history` (
  `id` int(11) NOT NULL,
  `point` int(12) NOT NULL,
  `current_point` int(12) NOT NULL,
  `description` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_point_transaction_history`
--

INSERT INTO `user_point_transaction_history` (`id`, `point`, `current_point`, `description`, `user_id`, `date_created`, `date_modified`) VALUES
(1, 114, 55114, 'testing', 6, '2021-01-03 12:29:09', '2021-01-03 12:29:09'),
(2, 114, 55228, 'Sale. Order Id: 1609673555', 6, '2021-01-03 12:36:55', '2021-01-03 12:36:55'),
(3, 2, 55230, 'Checkin. Day: 2', 6, '2021-01-03 14:10:16', '2021-01-03 14:10:16'),
(4, 4, 55234, 'Checkin. Day: 3', 6, '2021-01-03 14:16:06', '2021-01-03 14:16:06'),
(5, 1, 55235, 'Checkin. Day: 4', 6, '2021-01-03 14:24:12', '2021-01-03 14:24:12'),
(6, 2, 55237, 'Checkin. Day: 1', 6, '2021-01-03 14:27:56', '2021-01-03 14:27:56'),
(7, 3, 55240, 'Checkin. Day: 2', 6, '2021-01-03 14:29:06', '2021-01-03 14:29:06'),
(8, 4, 55244, 'Checkin. Day: 4', 6, '2021-01-03 14:35:20', '2021-01-03 14:35:20'),
(9, 5, 55249, 'Checkin. Day: 5', 6, '2021-01-03 14:36:45', '2021-01-03 14:36:45'),
(10, 6, 55255, 'Checkin. Day: 5', 6, '2021-01-03 14:39:28', '2021-01-03 14:39:28'),
(11, 6, 55261, 'Checkin. Day: 6', 6, '2021-01-03 14:42:42', '2021-01-03 14:42:42'),
(12, 7, 55268, 'Checkin. Day: 7', 6, '2021-01-03 14:43:08', '2021-01-03 14:43:08'),
(13, 8, 55276, 'Checkin. Day: 8', 6, '2021-01-03 14:43:54', '2021-01-03 14:43:54'),
(14, 1, 55277, 'Checkin. Day: 1', 6, '2021-01-03 14:44:35', '2021-01-03 14:44:35'),
(15, 1, 55278, 'Checkin. Day: 1', 6, '2021-01-03 14:47:27', '2021-01-03 14:47:27'),
(16, 2, 55280, 'Checkin. Day: 2', 6, '2021-01-03 14:47:48', '2021-01-03 14:47:48'),
(17, 1, 55281, 'Checkin. Day: 1', 6, '2021-01-03 14:48:26', '2021-01-03 14:48:26'),
(19, 2, 55283, 'Checkin. Day: 2', 6, '2021-01-03 14:52:42', '2021-01-03 14:52:42'),
(20, -42, 55241, 'Purchase Point Discount. Order ID: 43', 6, '2021-01-04 13:57:18', '2021-01-04 13:57:18'),
(21, 0, 55241, 'Purchase Point Discount. Order ID: 44', 6, '2021-01-04 13:58:01', '2021-01-04 13:58:01'),
(22, -17, 55224, 'Purchase Point Discount. Order ID: 45', 6, '2021-01-04 14:00:35', '2021-01-04 14:00:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translation`
--
ALTER TABLE `category_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_product`
--
ALTER TABLE `coupon_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_translation`
--
ALTER TABLE `coupon_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributor_product`
--
ALTER TABLE `distributor_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributor_wallet_transaction`
--
ALTER TABLE `distributor_wallet_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributor_wallet_transaction_history`
--
ALTER TABLE `distributor_wallet_transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `geo_zone`
--
ALTER TABLE `geo_zone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `geo_zone_list`
--
ALTER TABLE `geo_zone_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_transaction`
--
ALTER TABLE `point_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_role_price`
--
ALTER TABLE `product_role_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_translation`
--
ALTER TABLE `product_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion_product`
--
ALTER TABLE `promotion_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion_translation`
--
ALTER TABLE `promotion_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward_point_value`
--
ALTER TABLE `reward_point_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_dealer`
--
ALTER TABLE `user_dealer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_distributor`
--
ALTER TABLE `user_distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_point`
--
ALTER TABLE `user_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_point_transaction_history`
--
ALTER TABLE `user_point_transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_translation`
--
ALTER TABLE `category_translation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `coupon_product`
--
ALTER TABLE `coupon_product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `coupon_translation`
--
ALTER TABLE `coupon_translation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `coupon_user`
--
ALTER TABLE `coupon_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distributor_product`
--
ALTER TABLE `distributor_product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `distributor_wallet_transaction`
--
ALTER TABLE `distributor_wallet_transaction`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `distributor_wallet_transaction_history`
--
ALTER TABLE `distributor_wallet_transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `geo_zone`
--
ALTER TABLE `geo_zone`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `geo_zone_list`
--
ALTER TABLE `geo_zone_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `point_transaction`
--
ALTER TABLE `point_transaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_role_price`
--
ALTER TABLE `product_role_price`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_translation`
--
ALTER TABLE `product_translation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotion_product`
--
ALTER TABLE `promotion_product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotion_translation`
--
ALTER TABLE `promotion_translation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reward_point_value`
--
ALTER TABLE `reward_point_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_dealer`
--
ALTER TABLE `user_dealer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_distributor`
--
ALTER TABLE `user_distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_point`
--
ALTER TABLE `user_point`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_point_transaction_history`
--
ALTER TABLE `user_point_transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
