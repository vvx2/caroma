-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2021 at 11:25 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(127, 8, 1, 17, '2021-01-06 20:29:57', '2021-01-06 20:29:57'),
(139, 13, 1, 6, '2021-01-10 08:28:31', '2021-01-10 08:28:31'),
(140, 14, 1, 6, '2021-01-10 08:28:31', '2021-01-10 08:28:31'),
(141, 15, 1, 6, '2021-01-10 08:28:32', '2021-01-10 08:28:32');

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
(4, 1, '2021-01-06 18:01:24', '2021-01-07 18:04:20'),
(5, 1, '2021-01-06 18:01:58', '2021-01-07 18:04:13'),
(6, 1, '2021-01-06 18:03:22', '2021-01-06 18:03:22'),
(7, 1, '2021-01-06 18:04:00', '2021-01-07 18:03:32'),
(8, 1, '2021-01-06 18:04:48', '2021-01-06 18:16:26'),
(9, 1, '2021-01-06 18:05:16', '2021-01-07 18:04:25');

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
(9, 'delete', '', 'my', 3),
(10, 'GINGER SERIES', '', 'en', 4),
(11, '姜茶系列', '', 'cn', 4),
(12, 'GINGER SERIES', '', 'my', 4),
(13, 'CHOCOLATE', '', 'en', 5),
(14, '巧克力饮品', '', 'cn', 5),
(15, 'CHOCOLATE', '', 'my', 5),
(16, 'MATCHA SERIES', '', 'en', 6),
(17, '抹茶系列', '', 'cn', 6),
(18, 'MATCHA SERIES', '', 'my', 6),
(19, 'SOY / MALT', '', 'en', 7),
(20, '大豆/麦芽饮品', '', 'cn', 7),
(21, 'SOY / MALT', '', 'my', 7),
(22, 'COCONUT SERIES', '', 'en', 8),
(23, '低糖系列', '', 'cn', 8),
(24, 'COCONUT SERIES', '', 'my', 8),
(25, 'COFFEE SERIES', '', 'en', 9),
(26, '咖啡系列', '', 'cn', 9),
(27, 'COFFEE SERIES', '', 'my', 9);

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
(7, '2020-10-05 16:00:00', '2021-02-03 16:00:00', 1, '4.0000', 0, '10.0000', '0.0000', 1, 1, 50, 6, 0, 'GGSDFF', 1, '2020-11-14 13:54:22', '2020-11-14 13:54:22'),
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
(5, 3, 3, 95, 1, '2020-11-26 17:25:21', '2020-11-26 17:25:21'),
(6, 3, 36, 99, 1, '2021-01-09 08:10:11', '2021-01-09 08:10:11'),
(7, 3, 32, 22, 1, '2021-01-09 08:10:49', '2021-01-09 08:10:49');

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
(4, 'All Zone', 'for All State', 0, 1, '2020-12-06 08:28:56', '2021-01-10 11:38:59'),
(8, 'Kuala Lumpur and Selangor', 'Only for KL and Selangor', 0, 1, '2020-12-06 08:46:08', '2021-01-10 11:38:25'),
(15, 'Penang and Perlis', 'North Area', 0, 1, '2020-12-06 09:30:42', '2021-01-10 11:40:18'),
(16, 'Johor only', 'only for Johor', 0, 1, '2020-12-06 10:29:50', '2021-01-10 11:39:36');

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
(53, 1, 0),
(62, 8, 14),
(63, 8, 12),
(65, 4, 0),
(66, 16, 1),
(67, 15, 9),
(68, 15, 8);

-- --------------------------------------------------------

--
-- Table structure for table `new_arrival`
--

CREATE TABLE `new_arrival` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_arrival`
--

INSERT INTO `new_arrival` (`id`, `product_id`) VALUES
(41, 15),
(40, 14),
(39, 10),
(38, 9),
(37, 8);

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
(41, 4, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '740.0000', '', '0.0000', '0.0000', '0.0000', '2.5800', '742.5800', 'CAD2XBSHST', 'test point', '1609673555', 1, 'UnPaid', 6, 1, 0, 114, '2021-01-03 11:33:29', '2021-01-03 12:36:55'),
(42, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '740.0000', '', '0.0000', '0.0000', '1.1400', '2.5800', '738.8600', 'CAA0WQ6L2Y', NULL, '1609764692', 1, 'UnPaid', 6, 1, 0, 114, '2021-01-04 12:51:44', '2021-01-04 12:51:51'),
(43, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '72.5000', '', '0.0000', '0.0000', '0.4200', '1.0300', '72.0800', 'CAXTERRKLS', NULL, '1609768605', 1, 'UnPaid', 6, 1, 0, 42, '2021-01-04 13:57:04', '2021-01-04 13:57:18'),
(44, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '72.5000', '', '0.0000', '0.0000', '0.0000', '1.0300', '72.5000', 'CAAO74FICA', NULL, '1609768665', 1, 'UnPaid', 6, 1, 0, 42, '2021-01-04 13:57:51', '2021-01-04 13:58:01'),
(45, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '128.0000', '', '0.0000', '0.0000', '0.1700', '0.4100', '127.8300', 'CA0JHU9ACK', NULL, '1609768745', 1, 'UnPaid', 6, 1, 0, 17, '2021-01-04 14:00:19', '2021-01-04 14:00:35'),
(46, 4, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '305.5000', 'GGSDFF', '0.0000', '4.0000', '1.4800', '1.6500', '301.6700', 'CASJOQG0XN', '3456', '1609775367', 1, 'UnPaid', 6, 1, 0, 43, '2021-01-04 15:49:43', '2021-01-04 20:01:13'),
(47, 1, 'nicky', 'nickyzz111406@gmail.com', 'no test 1', '81000', 'Johor', '1', '0123456789', '94.5000', '', '0.0000', '0.0000', '0.0100', '1.6500', '94.4900', 'CAAARH7M73', NULL, '1609790165', 1, 'UnPaid', 21, 1, 0, 64, '2021-01-04 19:56:36', '2021-01-04 19:56:36'),
(48, 4, 'nicky', 'nickyzz111406@gmail.com', 'no test 1', '81000', 'Johor', '1', '0123456789', '94.5000', '', '0.0000', '0.0000', '0.0100', '1.6500', '94.4900', 'CACFTVP9HP', '123456', '1609790238', 1, 'UnPaid', 21, 1, 0, 64, '2021-01-04 19:57:25', '2021-01-04 20:00:24'),
(49, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '117.6000', 'GGSDFF', '0.0000', '4.0000', '2.9700', '1.6500', '112.2800', 'CADPL1FRP7', NULL, '1610034249', 1, 'UnPaid', 6, 1, 0, 297, '2021-01-07 15:46:05', '2021-01-07 15:46:13'),
(50, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '59.8000', '', '0.0000', '0.0000', '5.9400', '1.9600', '53.8600', 'CAYUAPNK31', NULL, '1610266652', 1, 'UnPaid', 6, 1, 0, 297, '2021-01-10 08:18:24', '2021-01-10 08:18:24'),
(51, 2, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '59.8000', '', '0.0000', '0.0000', '5.9400', '1.9600', '53.8600', 'CAHU9GV6FR', NULL, '1610266803', 1, 'UnPaid', 6, 1, 0, 297, '2021-01-10 08:21:23', '2021-01-10 08:21:29'),
(52, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '19.8000', '', '0.0000', '0.0000', '5.9400', '1.6500', '13.8600', 'CAGCLQBRZN', NULL, '1610267785', 1, 'UnPaid', 6, 1, 0, 297, '2021-01-10 08:37:09', '2021-01-10 08:37:09'),
(53, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '19.8000', '', '0.0000', '0.0000', '5.9400', '1.6500', '13.8600', 'CAVUWNYZRE', NULL, '1610267876', 1, 'UnPaid', 6, 1, 0, 297, '2021-01-10 08:38:07', '2021-01-10 08:38:07'),
(54, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '2', '0169032551', '19.8000', '', '0.0000', '0.0000', '5.9400', '1.6500', '15.5100', 'CAE6ISNHEI', NULL, '1610267896', 1, 'UnPaid', 6, 1, 0, 297, '2021-01-10 08:46:03', '2021-01-10 08:46:03'),
(55, 1, 'Wayne Test', 'puahweewee@gmail.com', 'thsis is tester address', '12345', 'testcity', '1', '0169032551', '19.8000', '', '0.0000', '0.0000', '0.0000', '1.6500', '21.4500', 'CAR3GPACCO', NULL, '1610444632', 1, 'UnPaid', 6, 1, 0, 297, '2021-01-12 09:44:03', '2021-01-12 09:44:03');

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
(89, 6, 1, '73.0000', 12, 0, 45, '2021-01-04 14:00:19', '2021-01-04 14:00:19'),
(90, 2, 1, '22.0000', 22, 0, 46, '2021-01-04 15:49:43', '2021-01-04 15:49:43'),
(91, 3, 1, '50.5000', 20, 0, 46, '2021-01-04 15:49:43', '2021-01-04 15:49:43'),
(92, 5, 1, '233.0000', 1, 0, 46, '2021-01-04 15:49:43', '2021-01-04 15:49:43'),
(93, 2, 2, '22.0000', 22, 0, 47, '2021-01-04 19:56:36', '2021-01-04 19:56:36'),
(94, 3, 1, '50.5000', 20, 0, 47, '2021-01-04 19:56:36', '2021-01-04 19:56:36'),
(95, 2, 2, '22.0000', 22, 2, 48, '2021-01-04 19:57:25', '2021-01-04 20:01:40'),
(96, 3, 1, '50.5000', 20, 5, 48, '2021-01-04 19:57:25', '2021-01-04 20:01:40'),
(97, 9, 1, '84.9000', 99, 0, 49, '2021-01-07 15:46:05', '2021-01-07 15:46:05'),
(98, 12, 1, '12.8000', 99, 0, 49, '2021-01-07 15:46:05', '2021-01-07 15:46:05'),
(99, 22, 1, '19.9000', 99, 0, 49, '2021-01-07 15:46:05', '2021-01-07 15:46:05'),
(100, 8, 1, '34.9000', 99, 0, 50, '2021-01-10 08:18:24', '2021-01-10 08:18:24'),
(101, 10, 1, '16.0000', 99, 0, 50, '2021-01-10 08:18:24', '2021-01-10 08:18:24'),
(102, 11, 1, '8.9000', 99, 0, 50, '2021-01-10 08:18:24', '2021-01-10 08:18:24'),
(103, 8, 1, '34.9000', 99, 0, 51, '2021-01-10 08:21:23', '2021-01-10 08:21:23'),
(104, 10, 1, '16.0000', 99, 0, 51, '2021-01-10 08:21:23', '2021-01-10 08:21:23'),
(105, 11, 1, '8.9000', 99, 0, 51, '2021-01-10 08:21:23', '2021-01-10 08:21:23'),
(106, 13, 1, '10.9000', 99, 0, 52, '2021-01-10 08:37:09', '2021-01-10 08:37:09'),
(107, 14, 1, '8.9000', 99, 0, 52, '2021-01-10 08:37:09', '2021-01-10 08:37:09'),
(108, 15, 1, '0.0000', 99, 0, 52, '2021-01-10 08:37:09', '2021-01-10 08:37:09'),
(109, 13, 1, '10.9000', 99, 0, 53, '2021-01-10 08:38:07', '2021-01-10 08:38:07'),
(110, 14, 1, '8.9000', 99, 0, 53, '2021-01-10 08:38:07', '2021-01-10 08:38:07'),
(111, 15, 1, '0.0000', 99, 0, 53, '2021-01-10 08:38:07', '2021-01-10 08:38:07'),
(112, 13, 1, '10.9000', 99, 0, 54, '2021-01-10 08:46:03', '2021-01-10 08:46:03'),
(113, 14, 1, '8.9000', 99, 0, 54, '2021-01-10 08:46:03', '2021-01-10 08:46:03'),
(114, 15, 1, '0.0000', 99, 0, 54, '2021-01-10 08:46:03', '2021-01-10 08:46:03'),
(115, 13, 1, '10.9000', 99, 0, 55, '2021-01-12 09:44:03', '2021-01-12 09:44:03'),
(116, 14, 1, '8.9000', 99, 0, 55, '2021-01-12 09:44:03', '2021-01-12 09:44:03'),
(117, 15, 1, '0.0000', 99, 0, 55, '2021-01-12 09:44:03', '2021-01-12 09:44:03');

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
(8, 99, 99, 98, 6, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 18:32:51', '2021-01-10 08:21:29'),
(9, 99, 99, 98, 6, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 18:54:16', '2021-01-07 15:46:13'),
(10, 99, 99, 98, 6, '3.0500', '3.0000', '1.7500', '3.8780', 'PROD16101985540.tmp', 1, 1, '2021-01-06 18:58:42', '2021-01-10 08:21:29'),
(11, 99, 99, 98, 8, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:03:59', '2021-01-10 08:21:29'),
(12, 99, 99, 98, 8, '3.5000', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:06:40', '2021-01-07 15:46:13'),
(13, 99, 99, 99, 7, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:11:00', '2021-01-06 19:11:00'),
(14, 99, 99, 99, 7, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:13:05', '2021-01-06 19:13:05'),
(15, 99, 99, 99, 7, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:15:01', '2021-01-06 19:15:01'),
(16, 99, 99, 99, 5, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:17:58', '2021-01-06 19:17:58'),
(17, 99, 99, 99, 4, '0.9000', '0.7000', '1.6000', '1.0000', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:23:04', '2021-01-06 19:23:04'),
(18, 99, 99, 99, 4, '3.0500', '3.0000', '1.7500', '3.7000', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:25:45', '2021-01-06 19:25:45'),
(19, 99, 99, 99, 4, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:27:42', '2021-01-06 19:27:42'),
(20, 99, 99, 99, 4, '2.4000', '1.8500', '1.1500', '2.0900', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:30:08', '2021-01-06 19:30:08'),
(21, 99, 99, 99, 4, '3.0500', '3.0000', '1.7500', '3.3300', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:32:15', '2021-01-06 19:32:15'),
(22, 99, 99, 98, 4, '3.0500', '3.0000', '1.7500', '3.3300', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:34:24', '2021-01-07 15:46:13'),
(23, 99, 99, 99, 4, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:36:20', '2021-01-06 19:36:20'),
(24, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:55:39', '2021-01-06 19:55:39'),
(25, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 19:58:26', '2021-01-06 19:58:26'),
(26, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:00:18', '2021-01-06 20:00:18'),
(27, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:01:43', '2021-01-06 20:01:43'),
(28, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:02:45', '2021-01-06 20:02:45'),
(29, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:04:30', '2021-01-06 20:07:05'),
(30, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:06:50', '2021-01-06 20:06:50'),
(31, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:09:09', '2021-01-06 20:09:09'),
(32, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:11:14', '2021-01-06 20:11:14'),
(33, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:13:28', '2021-01-06 20:23:09'),
(34, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:15:31', '2021-01-06 20:15:31'),
(35, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:17:34', '2021-01-06 20:17:34'),
(36, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:19:58', '2021-01-06 20:19:58'),
(37, 99, 99, 99, 9, '3.0500', '3.0000', '1.7500', '3.3200', 'PROD16101985540.tmp', 1, 1, '2021-01-06 20:21:52', '2021-01-06 20:21:52'),
(39, 122, 23, 100, 4, '0.0020', '0.0020', '0.0020', '0.0050', 'PROD16101985540.tmp', 1, 1, '2021-01-09 13:18:45', '2021-01-09 13:18:45'),
(40, 123, 22, 100, 4, '0.0020', '0.0030', '0.0040', '0.0050', 'PROD16101985543.tmp', 1, 1, '2021-01-09 13:22:34', '2021-01-09 14:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `image` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image`) VALUES
(6, 40, 'PROD16101985540.tmp'),
(8, 40, 'PROD16101985542.tmp'),
(9, 40, 'PROD16101985543.tmp'),
(12, 40, 'PROD16102031020.jpg'),
(13, 40, 'PROD16102031021.jpg'),
(14, 40, 'PROD16102031022.jpg'),
(15, 40, 'PROD16102032050.jpg'),
(16, 40, 'PROD16102032051.jpg');

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
(22, 84.9000, 1, 8),
(23, 75.0000, 2, 8),
(24, 80.0000, 3, 8),
(25, 84.9000, 1, 9),
(26, 75.0000, 2, 9),
(27, 80.0000, 3, 9),
(28, 16.0000, 1, 10),
(29, 10.0000, 2, 10),
(30, 13.0000, 3, 10),
(31, 8.9000, 1, 11),
(32, 8.0000, 2, 11),
(33, 8.5000, 3, 11),
(34, 12.8000, 1, 12),
(35, 12.0000, 2, 12),
(36, 12.5000, 3, 12),
(37, 10.9000, 1, 13),
(38, 10.0000, 2, 13),
(39, 10.5000, 3, 13),
(40, 8.9000, 1, 14),
(41, 8.0000, 2, 14),
(42, 8.5000, 3, 14),
(43, 10.5000, 1, 15),
(44, 10.0000, 2, 15),
(45, 10.2000, 3, 15),
(46, 12.9000, 1, 16),
(47, 12.0000, 2, 16),
(48, 12.5000, 3, 16),
(49, 28.8000, 1, 17),
(50, 25.0000, 2, 17),
(51, 28.0000, 3, 17),
(52, 59.0000, 1, 18),
(53, 59.0000, 2, 18),
(54, 59.0000, 3, 18),
(55, 16.0000, 1, 19),
(56, 16.0000, 2, 19),
(57, 16.0000, 3, 19),
(58, 38.0000, 1, 20),
(59, 38.0000, 2, 20),
(60, 38.0000, 3, 20),
(61, 19.9000, 1, 21),
(62, 19.9000, 2, 21),
(63, 19.9000, 3, 21),
(64, 19.9000, 1, 22),
(65, 19.9000, 2, 22),
(66, 19.9000, 3, 22),
(67, 19.9000, 1, 23),
(68, 19.9000, 2, 23),
(69, 19.9000, 3, 23),
(70, 6.9000, 1, 24),
(71, 6.9000, 2, 24),
(72, 6.9000, 3, 24),
(73, 34.0000, 1, 25),
(74, 34.0000, 2, 25),
(75, 34.0000, 3, 25),
(76, 19.9000, 1, 26),
(77, 19.9000, 2, 26),
(78, 19.9000, 3, 26),
(79, 19.9000, 1, 27),
(80, 19.9000, 2, 27),
(81, 19.9000, 3, 27),
(82, 19.9000, 1, 28),
(83, 19.9000, 2, 28),
(84, 19.9000, 3, 28),
(85, 10.5000, 1, 29),
(86, 10.5000, 2, 29),
(87, 10.5000, 3, 29),
(88, 9.0000, 1, 30),
(89, 9.0000, 2, 30),
(90, 9.0000, 3, 30),
(91, 34.9000, 1, 31),
(92, 34.9000, 2, 31),
(93, 34.9000, 3, 31),
(94, 11.9000, 1, 32),
(95, 11.9000, 2, 32),
(96, 11.9000, 3, 32),
(97, 18.9000, 1, 33),
(98, 18.9000, 2, 33),
(99, 18.9000, 3, 33),
(100, 34.9000, 1, 34),
(101, 34.9000, 2, 34),
(102, 34.9000, 3, 34),
(103, 34.9000, 1, 35),
(104, 34.9000, 2, 35),
(105, 34.9000, 3, 35),
(106, 34.9000, 1, 36),
(107, 34.9000, 2, 36),
(108, 34.9000, 3, 36),
(109, 38.9000, 1, 37),
(110, 38.9000, 2, 37),
(111, 38.9000, 3, 37),
(118, 444.0000, 1, 40),
(119, 222.0000, 2, 40),
(120, 333.6000, 3, 40);

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
(22, 'Premium Imported Japan Hojicha Roasted Green Tea Powder', '<h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">[CAROMA] Premium Imported Japan Hojicha Roasted Green Tea Powder /150g/ Halal /Gluten Free/Ceremonial Grade Quality/ Natural/ Low Caffeine/ Serbuk Green Tea Roasted</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\"><br></font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">CAROMA Hojicha Roasted Green Tea Powder Imported from Yame City, Fukuoka Prefecture Japan, its fragrant aroma and nutty, toasty flavor, Hojicha Roasted Green Tea (also known as houjicha) is a popular tea with plenty of health benefits.</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">In Japan, hojicha’s popularity stems from the fact that this roasted green tea is soothing and low in caffeine. Although it has a distinct and uniquely enjoyable taste, it is hojicha’s health benefits that make this green tea a staple in many homes.</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\"><br></font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">Hojicha Powder is the easiest way to enjoy the sweet taste and the pleasant aroma of Japanese roasted green tea. The superfine Hojicha Powder makes the perfect hojicha latte at the cafe or at home. This green tea powder is highly versatile and can also be used in recipes in addition or as a substitute for matcha green tea.</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\"><br></font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">1)Pure Roasted Green Tea Leaves</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">2)Sugar Free</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">3)Gluten Free</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">4)No Added Preservative</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">5)No Added Colouring</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">6)Low Caffeine</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">7)Certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</font></h5><h5><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\"></font></h5>', 'en', 8),
(23, 'Premium Imported Japan Hojicha Roasted Green Tea Powder', '<h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">[CAROMA] Premium Imported Japan Hojicha Roasted Green Tea Powder /150g/ Halal /Gluten Free/Ceremonial Grade Quality/ Natural/ Low Caffeine/ Serbuk Green Tea Roasted</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\"><br></font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">CAROMA Hojicha Roasted Green Tea Powder Imported from Yame City, Fukuoka Prefecture Japan, its fragrant aroma and nutty, toasty flavor, Hojicha Roasted Green Tea (also known as houjicha) is a popular tea with plenty of health benefits.</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">In Japan, hojicha’s popularity stems from the fact that this roasted green tea is soothing and low in caffeine. Although it has a distinct and uniquely enjoyable taste, it is hojicha’s health benefits that make this green tea a staple in many homes.</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\"><br></font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">Hojicha Powder is the easiest way to enjoy the sweet taste and the pleasant aroma of Japanese roasted green tea. The superfine Hojicha Powder makes the perfect hojicha latte at the cafe or at home. This green tea powder is highly versatile and can also be used in recipes in addition or as a substitute for matcha green tea.</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\"><br></font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">1)Pure Roasted Green Tea Leaves</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">2)Sugar Free</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">3)Gluten Free</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">4)No Added Preservative</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">5)No Added Colouring</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">6)Low Caffeine</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">7)Certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</font></h5><h5 style=\"font-family: \" open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\"></font></h5>', 'cn', 8),
(24, 'Premium Imported Japan Hojicha Roasted Green Tea Powder', '<h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">[CAROMA] Premium Imported Japan Hojicha Roasted Green Tea Powder /150g/ Halal /Gluten Free/Ceremonial Grade Quality/ Natural/ Low Caffeine/ Serbuk Green Tea Roasted</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\"><br></font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">CAROMA Hojicha Roasted Green Tea Powder Imported from Yame City, Fukuoka Prefecture Japan, its fragrant aroma and nutty, toasty flavor, Hojicha Roasted Green Tea (also known as houjicha) is a popular tea with plenty of health benefits.</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">In Japan, hojicha’s popularity stems from the fact that this roasted green tea is soothing and low in caffeine. Although it has a distinct and uniquely enjoyable taste, it is hojicha’s health benefits that make this green tea a staple in many homes.</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\"><br></font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">Hojicha Powder is the easiest way to enjoy the sweet taste and the pleasant aroma of Japanese roasted green tea. The superfine Hojicha Powder makes the perfect hojicha latte at the cafe or at home. This green tea powder is highly versatile and can also be used in recipes in addition or as a substitute for matcha green tea.</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\"><br></font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">1)Pure Roasted Green Tea Leaves</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">2)Sugar Free</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">3)Gluten Free</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">4)No Added Preservative</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">5)No Added Colouring</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">6)Low Caffeine</font></h5><h5 open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\" style=\"font-weight: normal;\">7)Certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</font></h5><h5 style=\"font-family: \" open=\"\" sans\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><font color=\"#2d2a2a\" face=\"Poppins, Arial, Helvetica, sans-serif\"></font></h5>', 'my', 8),
(25, 'Premium Imported Japan Pure Matcha Green Tea Powder', '<p>Matcha Green Tea with High antioxidants including the powerful EGCg:</p><p><br></p><p>1)Boosts metabolism and burns calories</p><p>2)Detoxifies effectively and naturally</p><p>3)Calms the mind and relaxes the body</p><p>4)Is rich in fiber, chlorophyll and vitamins</p><p>5)Enhances mood and aids in concentration</p><p>6)Provides vitamin C, selenium, chromium, zinc and magnesium</p><p>7)Prevents disease</p><p>8)Lowers cholesterol and blood sugar</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>**Preparation in Hot/ Panas:</p><p>Step 1: Scoop 1 or 1 1/2 Teaspoons Matcha Powder into a cup.</p><p>Step 2: Add 10ml 80 °C water + mix thoroughly to remove Matcha Lumps.</p><p>Step 3: Add 120ML- 150ml 80 °C water + stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p>Step 1: Scoop 1 or 1 1/2 Teaspoons Matcha Powder into a cup.</p><p>Step 2: Add 10MLl 80 °C water + mix thoroughly to remove Matcha Lumps.</p><p>Step 3: Add 100ML+ 80 °C water + stir well and enjoy + add ice and enjoy</p><p><br></p><p>**Remarks: Add skimmed milk or fresh milk or sugar if desired.</p><p>**Suitable for: Smoothies, Baking and Latte</p><p>Keep in the cool and dry place.</p><p><br></p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'en', 9),
(26, 'Premium Imported Japan Pure Matcha Green Tea Powder', '<p>Matcha Green Tea with High antioxidants including the powerful EGCg:</p><p><br></p><p>1)Boosts metabolism and burns calories</p><p>2)Detoxifies effectively and naturally</p><p>3)Calms the mind and relaxes the body</p><p>4)Is rich in fiber, chlorophyll and vitamins</p><p>5)Enhances mood and aids in concentration</p><p>6)Provides vitamin C, selenium, chromium, zinc and magnesium</p><p>7)Prevents disease</p><p>8)Lowers cholesterol and blood sugar</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>**Preparation in Hot/ Panas:</p><p>Step 1: Scoop 1 or 1 1/2 Teaspoons Matcha Powder into a cup.</p><p>Step 2: Add 10ml 80 °C water + mix thoroughly to remove Matcha Lumps.</p><p>Step 3: Add 120ML- 150ml 80 °C water + stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p>Step 1: Scoop 1 or 1 1/2 Teaspoons Matcha Powder into a cup.</p><p>Step 2: Add 10MLl 80 °C water + mix thoroughly to remove Matcha Lumps.</p><p>Step 3: Add 100ML+ 80 °C water + stir well and enjoy + add ice and enjoy</p><p><br></p><p>**Remarks: Add skimmed milk or fresh milk or sugar if desired.</p><p>**Suitable for: Smoothies, Baking and Latte</p><p>Keep in the cool and dry place.</p><p><br></p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'cn', 9),
(27, 'Premium Imported Japan Pure Matcha Green Tea Powder', '<p>Matcha Green Tea with High antioxidants including the powerful EGCg:</p><p><br></p><p>1)Boosts metabolism and burns calories</p><p>2)Detoxifies effectively and naturally</p><p>3)Calms the mind and relaxes the body</p><p>4)Is rich in fiber, chlorophyll and vitamins</p><p>5)Enhances mood and aids in concentration</p><p>6)Provides vitamin C, selenium, chromium, zinc and magnesium</p><p>7)Prevents disease</p><p>8)Lowers cholesterol and blood sugar</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>**Preparation in Hot/ Panas:</p><p>Step 1: Scoop 1 or 1 1/2 Teaspoons Matcha Powder into a cup.</p><p>Step 2: Add 10ml 80 °C water + mix thoroughly to remove Matcha Lumps.</p><p>Step 3: Add 120ML- 150ml 80 °C water + stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p>Step 1: Scoop 1 or 1 1/2 Teaspoons Matcha Powder into a cup.</p><p>Step 2: Add 10MLl 80 °C water + mix thoroughly to remove Matcha Lumps.</p><p>Step 3: Add 100ML+ 80 °C water + stir well and enjoy + add ice and enjoy</p><p><br></p><p>**Remarks: Add skimmed milk or fresh milk or sugar if desired.</p><p>**Suitable for: Smoothies, Baking and Latte</p><p>Keep in the cool and dry place.</p><p><br></p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'my', 9),
(28, 'Premium Imported Japan Instant Matcha Green Tea Latte', '<p>Matcha Green Tea with High antioxidants including the powerful EGCg:</p><p><br></p><p>1)High in antioxidants</p><p>2)May help protect the liver</p><p>3)Boosts brain function</p><p>4)May help prevent cancer</p><p>5)May promote heart health</p><p>6)Helps you lose weight</p><p><br></p><p>#Ingredients: Non-dairy creamer, Dextrose, Matcha and Sugar</p><p>#Nutrition Information/25 gram: Calories: 110kcal | Energy: 464kJ</p><p>It is suitable to drink hot or cold.</p><p>Preparation in Hot/ Panas:</p><p>#Add 150ml 80 °C water + 1 Sachets Matcha Latte powder +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p>#Add 100ml 80 °C water + 1 Sachets Matcha Latte powder +stir well +Added some ice and enjoy.</p><p><br></p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'en', 10),
(29, 'Premium Imported Japan Instant Matcha Green Tea Latte', '<p>Matcha Green Tea with High antioxidants including the powerful EGCg:</p><p><br></p><p>1)High in antioxidants</p><p>2)May help protect the liver</p><p>3)Boosts brain function</p><p>4)May help prevent cancer</p><p>5)May promote heart health</p><p>6)Helps you lose weight</p><p><br></p><p>#Ingredients: Non-dairy creamer, Dextrose, Matcha and Sugar</p><p>#Nutrition Information/25 gram: Calories: 110kcal | Energy: 464kJ</p><p>It is suitable to drink hot or cold.</p><p>Preparation in Hot/ Panas:</p><p>#Add 150ml 80 °C water + 1 Sachets Matcha Latte powder +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p>#Add 100ml 80 °C water + 1 Sachets Matcha Latte powder +stir well +Added some ice and enjoy.</p><p><br></p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'cn', 10),
(30, 'Premium Imported Japan Instant Matcha Green Tea Latte', '<p>Matcha Green Tea with High antioxidants including the powerful EGCg:</p><p><br></p><p>1)High in antioxidants</p><p>2)May help protect the liver</p><p>3)Boosts brain function</p><p>4)May help prevent cancer</p><p>5)May promote heart health</p><p>6)Helps you lose weight</p><p><br></p><p>#Ingredients: Non-dairy creamer, Dextrose, Matcha and Sugar</p><p>#Nutrition Information/25 gram: Calories: 110kcal | Energy: 464kJ</p><p>It is suitable to drink hot or cold.</p><p>Preparation in Hot/ Panas:</p><p>#Add 150ml 80 °C water + 1 Sachets Matcha Latte powder +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p>#Add 100ml 80 °C water + 1 Sachets Matcha Latte powder +stir well +Added some ice and enjoy.</p><p><br></p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'my', 10),
(31, 'Low GI Sugar Cane (Gula Tebu )', '<p>[CAROMA] Premium/ Better Sugar Cane (Gula Tebu ) /500g / Low Glycemic (Low-GI) (Halal) / Raw Sugar Cane</p><p><br></p><p>The low-glycemic (low-GI) diet is based on the concept of the glycemic index (GI). Foods with a low-GI value are the preferred choice, as they are slowly digested and absorbed, causing a slower and smaller rise in blood sugar levels.</p><p><br></p><p>1)Supports sugar-reduction</p><p>2)Low-Glycemic</p><p>3)Tastes great and less Sweet</p><p>4)Milled, not refined sugar</p><p>5)All natural</p><p>6)GMO free</p><p>7)NO Chemical</p><p>8)NO Pesticides</p><p>9)NO Synthetic Fertilizer</p><p>10)Certified by HACCP, ISO22000 and HALAL by JAKIM</p>', 'en', 11),
(32, 'Low GI Sugar Cane (Gula Tebu )', '<p>[CAROMA] Premium/ Better Sugar Cane (Gula Tebu ) /500g / Low Glycemic (Low-GI) (Halal) / Raw Sugar Cane</p><p><br></p><p>The low-glycemic (low-GI) diet is based on the concept of the glycemic index (GI). Foods with a low-GI value are the preferred choice, as they are slowly digested and absorbed, causing a slower and smaller rise in blood sugar levels.</p><p><br></p><p>1)Supports sugar-reduction</p><p>2)Low-Glycemic</p><p>3)Tastes great and less Sweet</p><p>4)Milled, not refined sugar</p><p>5)All natural</p><p>6)GMO free</p><p>7)NO Chemical</p><p>8)NO Pesticides</p><p>9)NO Synthetic Fertilizer</p><p>10)Certified by HACCP, ISO22000 and HALAL by JAKIM</p>', 'cn', 11),
(33, 'Low GI Sugar Cane (Gula Tebu )', '<p>[CAROMA] Premium/ Better Sugar Cane (Gula Tebu ) /500g / Low Glycemic (Low-GI) (Halal) / Raw Sugar Cane</p><p><br></p><p>The low-glycemic (low-GI) diet is based on the concept of the glycemic index (GI). Foods with a low-GI value are the preferred choice, as they are slowly digested and absorbed, causing a slower and smaller rise in blood sugar levels.</p><p><br></p><p>1)Supports sugar-reduction</p><p>2)Low-Glycemic</p><p>3)Tastes great and less Sweet</p><p>4)Milled, not refined sugar</p><p>5)All natural</p><p>6)GMO free</p><p>7)NO Chemical</p><p>8)NO Pesticides</p><p>9)NO Synthetic Fertilizer</p><p>10)Certified by HACCP, ISO22000 and HALAL by JAKIM</p>', 'my', 11),
(34, 'Premium Pure Coconut Palm Sugar/Gula Kelapa Halus', '<p>[CAROMA] Premium Pure Coconut Palm Sugar / 250g/ Low GI / Gluten Free / Halal / Gula Kelapa</p><p><br></p><p>Enjoy CAROMA 100% Natural Coconut Palm Sugar as a healthier choice with :</p><p><br></p><p>1)100% Coconut Palm sugar</p><p>2)Gluten Free</p><p>3)NO Chemical</p><p>4)NO Pesticides</p><p>5)NO Synthetic Fertilizer</p><p>6)Low-Glycemic</p><p>7)All natural</p><p>8)Tastes great and less Sweet</p><p>9)Certified by HACCP,ISO22000 and HALAL by JAKIM.</p><p><br></p><p>The low-glycemic (low-GI) diet is based on the concept of the glycemic index (GI). Foods with a low-GI value are the preferred choice, as they are slowly digested and absorbed, causing a slower and smaller rise in blood sugar levels.</p><p><br></p><p># Used for cooking, baking, dessert and beverage.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'en', 12),
(35, 'Premium Pure Coconut Palm Sugar/Gula Kelapa Halus', '<p>[CAROMA] Premium Pure Coconut Palm Sugar / 250g/ Low GI / Gluten Free / Halal / Gula Kelapa</p><p><br></p><p>Enjoy CAROMA 100% Natural Coconut Palm Sugar as a healthier choice with :</p><p><br></p><p>1)100% Coconut Palm sugar</p><p>2)Gluten Free</p><p>3)NO Chemical</p><p>4)NO Pesticides</p><p>5)NO Synthetic Fertilizer</p><p>6)Low-Glycemic</p><p>7)All natural</p><p>8)Tastes great and less Sweet</p><p>9)Certified by HACCP,ISO22000 and HALAL by JAKIM.</p><p><br></p><p>The low-glycemic (low-GI) diet is based on the concept of the glycemic index (GI). Foods with a low-GI value are the preferred choice, as they are slowly digested and absorbed, causing a slower and smaller rise in blood sugar levels.</p><p><br></p><p># Used for cooking, baking, dessert and beverage.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'cn', 12),
(36, 'Premium Pure Coconut Palm Sugar/Gula Kelapa Halus', '<p>[CAROMA] Premium Pure Coconut Palm Sugar / 250g/ Low GI / Gluten Free / Halal / Gula Kelapa</p><p><br></p><p>Enjoy CAROMA 100% Natural Coconut Palm Sugar as a healthier choice with :</p><p><br></p><p>1)100% Coconut Palm sugar</p><p>2)Gluten Free</p><p>3)NO Chemical</p><p>4)NO Pesticides</p><p>5)NO Synthetic Fertilizer</p><p>6)Low-Glycemic</p><p>7)All natural</p><p>8)Tastes great and less Sweet</p><p>9)Certified by HACCP,ISO22000 and HALAL by JAKIM.</p><p><br></p><p>The low-glycemic (low-GI) diet is based on the concept of the glycemic index (GI). Foods with a low-GI value are the preferred choice, as they are slowly digested and absorbed, causing a slower and smaller rise in blood sugar levels.</p><p><br></p><p># Used for cooking, baking, dessert and beverage.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'my', 12),
(37, 'Healthy Malt Milk Drink Powder', '<p>[CAROMA] Malt Milk Drink Powder/250g/Low GI/ Less Sugar/ Less Sweet/Halal/Serbuk Susu Malt/Nutritional/Nutrient/Healthy</p><p><br></p><p>CAROMA Malt Milk Drink- is a premium selection of Malt and Barley Powder with less sweet Low GI Sugar. Enjoy, the real taste of malt milk in anywhere, anytime. CAROMA is your healthier choice!</p><p><br></p><p># Ingredients : Non-Dairy Creamer, Sugar(Low GI), Malt Extract Powder, Barley Powder</p><p># Ramuan: Krimer Bukan Tenusu, Gula(Rendah GI), Serbuk Ekstrak Malt, Serbuk Barli</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 spoon Malt Powder + stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Malt Powder + stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p><br></p><p># Is malted milk powder good for you?</p><p>A heart-healthy mix, malt contains fiber, potassium, folate, and vitamin B6, which together lower cholesterol and decrease the risk of cardiac disease. It is an abundant source of vitamins, minerals, amino acids, dietary silicon (supports bone health), B complex vitamins and micro minerals</p><p><br></p><p># What is malt milk powder?</p><p>Malted milk is a powdered gruel made from a mixture of malted barley, wheat flour, and evaporated whole milk. The powder is used to add its distinctive flavor to beverages and other foods, but it is also used in baking to help dough cook properly. Malt powder comes in two forms: diastatic and non-diastatic.</p><p><br></p><p># Is malted milk the same as powdered milk?</p><p>Malted Milk Powder. Malted milk powder is a fine light-yellow powder with a mellow, nutty flavor and a natural sweetness. The term \"malt\" refers to a grain (usually barley) that has been sprouted and quickly dried. At the supermarket, malted milk powder is sold in the same section as powdered milk.</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'en', 13),
(38, 'Healthy Malt Milk Drink Powder', '<p>[CAROMA] Malt Milk Drink Powder/250g/Low GI/ Less Sugar/ Less Sweet/Halal/Serbuk Susu Malt/Nutritional/Nutrient/Healthy</p><p><br></p><p>CAROMA Malt Milk Drink- is a premium selection of Malt and Barley Powder with less sweet Low GI Sugar. Enjoy, the real taste of malt milk in anywhere, anytime. CAROMA is your healthier choice!</p><p><br></p><p># Ingredients : Non-Dairy Creamer, Sugar(Low GI), Malt Extract Powder, Barley Powder</p><p># Ramuan: Krimer Bukan Tenusu, Gula(Rendah GI), Serbuk Ekstrak Malt, Serbuk Barli</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 spoon Malt Powder + stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Malt Powder + stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p><br></p><p># Is malted milk powder good for you?</p><p>A heart-healthy mix, malt contains fiber, potassium, folate, and vitamin B6, which together lower cholesterol and decrease the risk of cardiac disease. It is an abundant source of vitamins, minerals, amino acids, dietary silicon (supports bone health), B complex vitamins and micro minerals</p><p><br></p><p># What is malt milk powder?</p><p>Malted milk is a powdered gruel made from a mixture of malted barley, wheat flour, and evaporated whole milk. The powder is used to add its distinctive flavor to beverages and other foods, but it is also used in baking to help dough cook properly. Malt powder comes in two forms: diastatic and non-diastatic.</p><p><br></p><p># Is malted milk the same as powdered milk?</p><p>Malted Milk Powder. Malted milk powder is a fine light-yellow powder with a mellow, nutty flavor and a natural sweetness. The term \"malt\" refers to a grain (usually barley) that has been sprouted and quickly dried. At the supermarket, malted milk powder is sold in the same section as powdered milk.</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'cn', 13),
(39, 'Healthy Malt Milk Drink Powder', '<p>[CAROMA] Malt Milk Drink Powder/250g/Low GI/ Less Sugar/ Less Sweet/Halal/Serbuk Susu Malt/Nutritional/Nutrient/Healthy</p><p><br></p><p>CAROMA Malt Milk Drink- is a premium selection of Malt and Barley Powder with less sweet Low GI Sugar. Enjoy, the real taste of malt milk in anywhere, anytime. CAROMA is your healthier choice!</p><p><br></p><p># Ingredients : Non-Dairy Creamer, Sugar(Low GI), Malt Extract Powder, Barley Powder</p><p># Ramuan: Krimer Bukan Tenusu, Gula(Rendah GI), Serbuk Ekstrak Malt, Serbuk Barli</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 spoon Malt Powder + stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Malt Powder + stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p><br></p><p># Is malted milk powder good for you?</p><p>A heart-healthy mix, malt contains fiber, potassium, folate, and vitamin B6, which together lower cholesterol and decrease the risk of cardiac disease. It is an abundant source of vitamins, minerals, amino acids, dietary silicon (supports bone health), B complex vitamins and micro minerals</p><p><br></p><p># What is malt milk powder?</p><p>Malted milk is a powdered gruel made from a mixture of malted barley, wheat flour, and evaporated whole milk. The powder is used to add its distinctive flavor to beverages and other foods, but it is also used in baking to help dough cook properly. Malt powder comes in two forms: diastatic and non-diastatic.</p><p><br></p><p># Is malted milk the same as powdered milk?</p><p>Malted Milk Powder. Malted milk powder is a fine light-yellow powder with a mellow, nutty flavor and a natural sweetness. The term \"malt\" refers to a grain (usually barley) that has been sprouted and quickly dried. At the supermarket, malted milk powder is sold in the same section as powdered milk.</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'my', 13),
(40, 'High Protein Organic Soy Milk Powder (Sachets)', '<p># Ingredients: Organic Soy Powder (Non-GMO), Brown Sugar, Dextrose.</p><p><br></p><p># Ramuan: Serbuk Soya dari Sumber Organk, Dextrose, Gula Perang.</p><p># Nutrition Information (100gram):</p><p><br></p><p>Calories : 390 kcal | Energy: 1638kJ | Carbohydrate: 78.5gram | Protein: 10.8 gram</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 spoon Organic Soy Powder +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Organic Soy Powder +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'en', 14),
(41, 'High Protein Organic Soy Milk Powder (Sachets)', '<p># Ingredients: Organic Soy Powder (Non-GMO), Brown Sugar, Dextrose.</p><p><br></p><p># Ramuan: Serbuk Soya dari Sumber Organk, Dextrose, Gula Perang.</p><p># Nutrition Information (100gram):</p><p><br></p><p>Calories : 390 kcal | Energy: 1638kJ | Carbohydrate: 78.5gram | Protein: 10.8 gram</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 spoon Organic Soy Powder +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Organic Soy Powder +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'cn', 14),
(42, 'High Protein Organic Soy Milk Powder (Sachets)', '<p># Ingredients: Organic Soy Powder (Non-GMO), Brown Sugar, Dextrose.</p><p><br></p><p># Ramuan: Serbuk Soya dari Sumber Organk, Dextrose, Gula Perang.</p><p># Nutrition Information (100gram):</p><p><br></p><p>Calories : 390 kcal | Energy: 1638kJ | Carbohydrate: 78.5gram | Protein: 10.8 gram</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 spoon Organic Soy Powder +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Organic Soy Powder +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'my', 14),
(43, 'High Protein Organic Soy Milk Powder', '<p># Ingredients: Organic Soy Powder (Non-GMO), Brown Sugar, Dextrose.</p><p><br></p><p># Ramuan: Serbuk Soya dari Sumber Organk, Dextrose, Gula Perang.</p><p><br></p><p># Nutrition Information (100gram):</p><p>Calories : 390 kcal | Energy: 1638kJ | Carbohydrate: 78.5gram | Protein: 10.8 gram</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 spoon Organic Soy Powder +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Organic Soy Powder +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'en', 15),
(44, 'High Protein Organic Soy Milk Powder', '<p># Ingredients: Organic Soy Powder (Non-GMO), Brown Sugar, Dextrose.</p><p><br></p><p># Ramuan: Serbuk Soya dari Sumber Organk, Dextrose, Gula Perang.</p><p><br></p><p># Nutrition Information (100gram):</p><p>Calories : 390 kcal | Energy: 1638kJ | Carbohydrate: 78.5gram | Protein: 10.8 gram</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 spoon Organic Soy Powder +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Organic Soy Powder +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'cn', 15),
(45, 'High Protein Organic Soy Milk Powder', '<p># Ingredients: Organic Soy Powder (Non-GMO), Brown Sugar, Dextrose.</p><p><br></p><p># Ramuan: Serbuk Soya dari Sumber Organk, Dextrose, Gula Perang.</p><p><br></p><p># Nutrition Information (100gram):</p><p>Calories : 390 kcal | Energy: 1638kJ | Carbohydrate: 78.5gram | Protein: 10.8 gram</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 spoon Organic Soy Powder +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Organic Soy Powder +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'my', 15),
(46, 'Premium Hot Chocolate Drink', '<p>[CAROMA] Premium Chocolate Drink / Imported Coklat Malt Drink/ 250g / Less Sweet /Halal / Cocoa</p><p><br></p><p># Ingredients : Non-Dairy Creamer, Sugar, Cocoa Powder, Malt Extract Powder</p><p># Ramuan: Krimer Bukan Tenusu, Gula, Serbuk Koko, Serbuk Ekstrak Malt.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 Teaspoons Chocolate Malt +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 Teaspoons Chocolate Malt +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'en', 16),
(47, 'Premium Hot Chocolate Drink', '<p>[CAROMA] Premium Chocolate Drink / Imported Coklat Malt Drink/ 250g / Less Sweet /Halal / Cocoa</p><p><br></p><p># Ingredients : Non-Dairy Creamer, Sugar, Cocoa Powder, Malt Extract Powder</p><p># Ramuan: Krimer Bukan Tenusu, Gula, Serbuk Koko, Serbuk Ekstrak Malt.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 Teaspoons Chocolate Malt +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 Teaspoons Chocolate Malt +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'cn', 16),
(48, 'Premium Hot Chocolate Drink', '<p>[CAROMA] Premium Chocolate Drink / Imported Coklat Malt Drink/ 250g / Less Sweet /Halal / Cocoa</p><p><br></p><p># Ingredients : Non-Dairy Creamer, Sugar, Cocoa Powder, Malt Extract Powder</p><p># Ramuan: Krimer Bukan Tenusu, Gula, Serbuk Koko, Serbuk Ekstrak Malt.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 Teaspoons Chocolate Malt +stir well and enjoy.</p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 Teaspoons Chocolate Malt +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'my', 16),
(49, 'Healthy Snack Dried Slice Ginger / Hirisan Halia Kering', '<p>[CAROMA] Healthy Snack Dried Slice Ginger/Hirisan Halia Kering/ Natural Pure Soilless Bentong /80gram/ Halal/No Sugar</p><p><br></p><p>Healthy Snack Dried Ginger Slice / Snek Hirisan Halia Kering:</p><p># 1 bottle: 80 gram</p><p># Shelf Life : 24 months</p><p># Appearance Colour : Dried sliced ginger</p><p># Colour: Light brown colour</p><p># Taste: Sweet ginger taste, slightly spicy</p><p># Aroma : Light ginger odour, no mouldy smell</p><p>#100% Natural Farming Soilless (Using Coconut Coir Fiber)</p><p># Soilles Bentong Ginger Slice</p><p># NO pesticides</p><p># NO herbicides</p><p># NO added preservative</p><p># No added Sugar</p><p># No added coloring</p><p># Chemical and Residue Free</p><p># Halal</p><p><br></p><p>CAROMA Bentong Ginger are rich in Antioxidants and Potassium to protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p><br></p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA is internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'en', 17),
(50, 'Healthy Snack Dried Slice Ginger / Hirisan Halia Kering', '<p>[CAROMA] Healthy Snack Dried Slice Ginger/Hirisan Halia Kering/ Natural Pure Soilless Bentong /80gram/ Halal/No Sugar</p><p><br></p><p>Healthy Snack Dried Ginger Slice / Snek Hirisan Halia Kering:</p><p># 1 bottle: 80 gram</p><p># Shelf Life : 24 months</p><p># Appearance Colour : Dried sliced ginger</p><p># Colour: Light brown colour</p><p># Taste: Sweet ginger taste, slightly spicy</p><p># Aroma : Light ginger odour, no mouldy smell</p><p>#100% Natural Farming Soilless (Using Coconut Coir Fiber)</p><p># Soilles Bentong Ginger Slice</p><p># NO pesticides</p><p># NO herbicides</p><p># NO added preservative</p><p># No added Sugar</p><p># No added coloring</p><p># Chemical and Residue Free</p><p># Halal</p><p><br></p><p>CAROMA Bentong Ginger are rich in Antioxidants and Potassium to protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p><br></p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA is internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'cn', 17),
(51, 'Healthy Snack Dried Slice Ginger / Hirisan Halia Kering', '<p>[CAROMA] Healthy Snack Dried Slice Ginger/Hirisan Halia Kering/ Natural Pure Soilless Bentong /80gram/ Halal/No Sugar</p><p><br></p><p>Healthy Snack Dried Ginger Slice / Snek Hirisan Halia Kering:</p><p># 1 bottle: 80 gram</p><p># Shelf Life : 24 months</p><p># Appearance Colour : Dried sliced ginger</p><p># Colour: Light brown colour</p><p># Taste: Sweet ginger taste, slightly spicy</p><p># Aroma : Light ginger odour, no mouldy smell</p><p>#100% Natural Farming Soilless (Using Coconut Coir Fiber)</p><p># Soilles Bentong Ginger Slice</p><p># NO pesticides</p><p># NO herbicides</p><p># NO added preservative</p><p># No added Sugar</p><p># No added coloring</p><p># Chemical and Residue Free</p><p># Halal</p><p><br></p><p>CAROMA Bentong Ginger are rich in Antioxidants and Potassium to protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p><br></p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA is internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'my', 17),
(52, 'High Protein Organic Soy with Bentong Ginger Powder', '<p>Ginger are rich in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Rich in vitamins and minerals</p><p>5)Anti-inflammatory property</p><p>6)Promote intestinal absorption of nutrients</p><p>7)Promote blood circulation</p><p>8)Relief stress</p><p>9)Relief nausea</p><p>10)Control blood sugar level</p><p><br></p><p># Ingredients: Soy Source from Organic, , Brown Sugar, Ginger Powder</p><p># Ramuan: Serbuk Soya dari Sumber Organk, Polidextrose, Gula Perang and Serbuk Halia</p><p><br></p><p># Nutrition Information (25gram):</p><p>Calories : 101 kcal | Energy: 424kJ | Carbohydrate: 19.2gram | Protein: 2.9 gram</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'en', 18),
(53, 'High Protein Organic Soy with Bentong Ginger Powder', '<p>Ginger are rich in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Rich in vitamins and minerals</p><p>5)Anti-inflammatory property</p><p>6)Promote intestinal absorption of nutrients</p><p>7)Promote blood circulation</p><p>8)Relief stress</p><p>9)Relief nausea</p><p>10)Control blood sugar level</p><p><br></p><p># Ingredients: Soy Source from Organic, , Brown Sugar, Ginger Powder</p><p># Ramuan: Serbuk Soya dari Sumber Organk, Polidextrose, Gula Perang and Serbuk Halia</p><p><br></p><p># Nutrition Information (25gram):</p><p>Calories : 101 kcal | Energy: 424kJ | Carbohydrate: 19.2gram | Protein: 2.9 gram</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'cn', 18),
(54, 'High Protein Organic Soy with Bentong Ginger Powder', '<p>Ginger are rich in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Rich in vitamins and minerals</p><p>5)Anti-inflammatory property</p><p>6)Promote intestinal absorption of nutrients</p><p>7)Promote blood circulation</p><p>8)Relief stress</p><p>9)Relief nausea</p><p>10)Control blood sugar level</p><p><br></p><p># Ingredients: Soy Source from Organic, , Brown Sugar, Ginger Powder</p><p># Ramuan: Serbuk Soya dari Sumber Organk, Polidextrose, Gula Perang and Serbuk Halia</p><p><br></p><p># Nutrition Information (25gram):</p><p>Calories : 101 kcal | Energy: 424kJ | Carbohydrate: 19.2gram | Protein: 2.9 gram</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'my', 18),
(55, 'Bentong Ginger with Tea', '<p>Ginger are high in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p>#Ingredients: Brown Sugar, Coconut Sugar, Dextrose, Bentong Ginger Powder and Tea Powder.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Bentong Ginger Tea +stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Bentong Ginger Tea +stir well +Added some ice and enjoy.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'en', 19),
(56, 'Bentong Ginger with Tea', '<p>Ginger are high in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p>#Ingredients: Brown Sugar, Coconut Sugar, Dextrose, Bentong Ginger Powder and Tea Powder.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Bentong Ginger Tea +stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Bentong Ginger Tea +stir well +Added some ice and enjoy.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'cn', 19);
INSERT INTO `product_translation` (`id`, `name`, `description`, `language`, `product_id`) VALUES
(57, 'Bentong Ginger with Tea', '<p>Ginger are high in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p>#Ingredients: Brown Sugar, Coconut Sugar, Dextrose, Bentong Ginger Powder and Tea Powder.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Bentong Ginger Tea +stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Bentong Ginger Tea +stir well +Added some ice and enjoy.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'my', 19),
(58, 'Natural Pure Soilless Bentong Ginger Powder/ Halia Asli', '<p>CAROMA Bentong Ginger Powder are rich in Antioxidants and Potassium to protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p>', 'en', 20),
(59, 'Natural Pure Soilless Bentong Ginger Powder/ Halia Asli', '<p>CAROMA Bentong Ginger Powder are rich in Antioxidants and Potassium to protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p>', 'cn', 20),
(60, 'Natural Pure Soilless Bentong Ginger Powder/ Halia Asli', '<p>CAROMA Bentong Ginger Powder are rich in Antioxidants and Potassium to protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p>', 'my', 20),
(61, 'Pure Honey with Bentong Ginger', '<p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p># Ingredients: Honey Powder, Bentong Ginger Powder, Brown Sugar and Dextrose.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Bentong Ginger with Honey+stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Bentong Ginger with Honey +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'en', 21),
(62, 'Pure Honey with Bentong Ginger', '<p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p># Ingredients: Honey Powder, Bentong Ginger Powder, Brown Sugar and Dextrose.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Bentong Ginger with Honey+stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Bentong Ginger with Honey +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'cn', 21),
(63, 'Pure Honey with Bentong Ginger', '<p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p># Ingredients: Honey Powder, Bentong Ginger Powder, Brown Sugar and Dextrose.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Bentong Ginger with Honey+stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Bentong Ginger with Honey +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'my', 21),
(64, 'Pure Honey Lemon with Bentong Ginger', '<p>Ginger are high in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p># Ingredients: Honey Powder, Bentong Ginger Powder, Lemon Powder, Brown Sugar and Dextrose.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Bentong Ginger with Honey Lemon +stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Bentong Ginger with Honey Lemon +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'en', 22),
(65, 'Pure Honey Lemon with Bentong Ginger', '<p>Ginger are high in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p># Ingredients: Honey Powder, Bentong Ginger Powder, Lemon Powder, Brown Sugar and Dextrose.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Bentong Ginger with Honey Lemon +stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Bentong Ginger with Honey Lemon +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'cn', 22),
(66, 'Pure Honey Lemon with Bentong Ginger', '<p>Ginger are high in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice!</p><p><br></p><p># Ingredients: Honey Powder, Bentong Ginger Powder, Lemon Powder, Brown Sugar and Dextrose.</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Bentong Ginger with Honey Lemon +stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Bentong Ginger with Honey Lemon +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'my', 22),
(67, 'Coconut with Bentong Ginger', '<p>Ginger are high in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice</p><p><br></p><p># Ingredients: Coconut Water, Brown Sugar, Dextrose, Bentong Ginger Powder</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Coconut with Bentong Ginger + stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Coconut with Bentong Ginger +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'en', 23),
(68, 'Coconut with Bentong Ginger', '<p>Ginger are high in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice</p><p><br></p><p># Ingredients: Coconut Water, Brown Sugar, Dextrose, Bentong Ginger Powder</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Coconut with Bentong Ginger + stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Coconut with Bentong Ginger +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'cn', 23),
(69, 'Coconut with Bentong Ginger', '<p>Ginger are high in Antioxidants and protect your cells from the effects of free radicals and able to reduce an overabundance of inflammation in your body.</p><p><br></p><p>1)Improve digestive process</p><p>2)Improve blood circulation</p><p>3)Rich in Antioxidant</p><p>4)Anti-inflammatory property</p><p>5)Promote intestinal absorption of nutrients</p><p>6)Promote blood circulation</p><p>7)Relief stress</p><p>8)Relief nausea</p><p>9)Control blood sugar level</p><p>CAROMA Is Your Healthier Choice</p><p><br></p><p># Ingredients: Coconut Water, Brown Sugar, Dextrose, Bentong Ginger Powder</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 1 Sachet Coconut with Bentong Ginger + stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 1 Sachet Coconut with Bentong Ginger +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA are internationally certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'my', 23),
(70, 'Coffee Tea Mate Non-dairy Creamer Powder /250 gram/Halal', '<p>[CAROMA] Coffee Mate Non-dairy Creamer Powder (250g) ( Halal)</p><p><br></p><p>CAROMA Coffee Mate Non-dairy creamers, commonly called tea whiteners or coffee whiteners are liquid or granular substances intended to substitute for milk or cream as an additive to coffee, tea, hot chocolate or other beverages.</p><p><br></p><p>Transform the coffee you like into the coffee you love with Coffee mate The Original coffee creamer. It\'s rich and smooth with a classic taste that is lactose-free, cholesterol-free, and gluten-free. With Coffee mate non-dairy coffee creamer, you can create your perfect cup of velvety goodness by adding the right amount of flavor you want every time.</p><p><br></p><p>1)Lactose-free</p><p>2)Cholesterol-free</p><p>3)Gluten-free</p><p>4)Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p><p><br></p><p>#Ingredients: Non Dairy Creamer.</p><p><br></p><p>#Preparation in Hot/ Panas:</p><p>Spoon powder into prepared coffee, tea of hot chocolate. Stir well and enjoy.</p><p><br></p><p>#Preparation in Cold/ Sejuk:</p><p>Spoon powder into prepared coffee, tea of hot chocolate. Stir well, add some ice and enjoy.</p><p><br></p><p>8 Delicious Uses for Coffee Creamer:</p><p>1) Add to hot chocolate. That\'s right,it is just like sweetened varieties of creamer can flavor coffee, they can also be used to flavor hot chocolate.</p><p>2) Mix into hot cereals. Splash in waffle or pancake batter. ...</p><p>3) Add to mashed potatoes.Make a two-ingredient cake icing. ...</p><p>4) Pour over fresh fruit</p><p>5) Add to cream-based soups.</p><p>6) Can be used in tea.</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA is internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'en', 24),
(71, 'Coffee Tea Mate Non-dairy Creamer Powder /250 gram/Halal', '<p>[CAROMA] Coffee Mate Non-dairy Creamer Powder (250g) ( Halal)</p><p><br></p><p>CAROMA Coffee Mate Non-dairy creamers, commonly called tea whiteners or coffee whiteners are liquid or granular substances intended to substitute for milk or cream as an additive to coffee, tea, hot chocolate or other beverages.</p><p><br></p><p>Transform the coffee you like into the coffee you love with Coffee mate The Original coffee creamer. It\'s rich and smooth with a classic taste that is lactose-free, cholesterol-free, and gluten-free. With Coffee mate non-dairy coffee creamer, you can create your perfect cup of velvety goodness by adding the right amount of flavor you want every time.</p><p><br></p><p>1)Lactose-free</p><p>2)Cholesterol-free</p><p>3)Gluten-free</p><p>4)Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p><p><br></p><p>#Ingredients: Non Dairy Creamer.</p><p><br></p><p>#Preparation in Hot/ Panas:</p><p>Spoon powder into prepared coffee, tea of hot chocolate. Stir well and enjoy.</p><p><br></p><p>#Preparation in Cold/ Sejuk:</p><p>Spoon powder into prepared coffee, tea of hot chocolate. Stir well, add some ice and enjoy.</p><p><br></p><p>8 Delicious Uses for Coffee Creamer:</p><p>1) Add to hot chocolate. That\'s right,it is just like sweetened varieties of creamer can flavor coffee, they can also be used to flavor hot chocolate.</p><p>2) Mix into hot cereals. Splash in waffle or pancake batter. ...</p><p>3) Add to mashed potatoes.Make a two-ingredient cake icing. ...</p><p>4) Pour over fresh fruit</p><p>5) Add to cream-based soups.</p><p>6) Can be used in tea.</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA is internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'cn', 24),
(72, 'Coffee Tea Mate Non-dairy Creamer Powder /250 gram/Halal', '<p>[CAROMA] Coffee Mate Non-dairy Creamer Powder (250g) ( Halal)</p><p><br></p><p>CAROMA Coffee Mate Non-dairy creamers, commonly called tea whiteners or coffee whiteners are liquid or granular substances intended to substitute for milk or cream as an additive to coffee, tea, hot chocolate or other beverages.</p><p><br></p><p>Transform the coffee you like into the coffee you love with Coffee mate The Original coffee creamer. It\'s rich and smooth with a classic taste that is lactose-free, cholesterol-free, and gluten-free. With Coffee mate non-dairy coffee creamer, you can create your perfect cup of velvety goodness by adding the right amount of flavor you want every time.</p><p><br></p><p>1)Lactose-free</p><p>2)Cholesterol-free</p><p>3)Gluten-free</p><p>4)Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p><p><br></p><p>#Ingredients: Non Dairy Creamer.</p><p><br></p><p>#Preparation in Hot/ Panas:</p><p>Spoon powder into prepared coffee, tea of hot chocolate. Stir well and enjoy.</p><p><br></p><p>#Preparation in Cold/ Sejuk:</p><p>Spoon powder into prepared coffee, tea of hot chocolate. Stir well, add some ice and enjoy.</p><p><br></p><p>8 Delicious Uses for Coffee Creamer:</p><p>1) Add to hot chocolate. That\'s right,it is just like sweetened varieties of creamer can flavor coffee, they can also be used to flavor hot chocolate.</p><p>2) Mix into hot cereals. Splash in waffle or pancake batter. ...</p><p>3) Add to mashed potatoes.Make a two-ingredient cake icing. ...</p><p>4) Pour over fresh fruit</p><p>5) Add to cream-based soups.</p><p>6) Can be used in tea.</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p>CAROMA is internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'my', 24),
(73, 'Twin Packs/ [CAROMA] Instant 3 in 1 White Coffee/39g x 15 sachets/Per pack /Halal/ Ipoh White Coffee', '<p>Twin Packs/ [CAROMA] Instant 3 in 1 White Coffee/39g x 15 sachets/Per pack /Halal/ Ipoh White Coffee</p><p><br></p><p>CAROMA Instant Blende White Coffee is a famous coffee among the Malaysians. The roasting process for normal black coffee involves roasting the beans with sugar, margarine and wheat. It is different for white coffee when The coffee beans are roasted with only margarine, without sugar, which gives the coffee a lighter shade.</p><p><br></p><p>When you drink white coffee, you are able to taste different layers of flavor in the coffee, which is thick and aromatic. Caroma Blende White Coffee is a premium selection of the first grade Arabica coffee beans. So you can enjoy the real taste of good coffee anytime, anywhere. Ideal to serve with either hot or cold drink.</p><p><br></p><p>#One Pack : 39g x 15 sachets</p><p>#Twin pack : 2 packs x 39g x 15 sachets</p><p>#Roasted coffee</p><p>#Rich and Creamy</p><p>#Little nutty</p><p>#Sweet</p><p>#Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM</p><p><br></p><p>Preparation in Hot/ Panas:</p><p>#Add 150ml 80 °C water + 1 sachets Instant white coffee powder + stir well and enjoy</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p>#Add 100ml 80 °C water + 1 sachets Instant white coffee powder + + stir well +Added some ice and enjoy.</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'en', 25),
(74, 'Twin Packs/ [CAROMA] Instant 3 in 1 White Coffee/39g x 15 sachets/Per pack /Halal/ Ipoh White Coffee', '<p>Twin Packs/ [CAROMA] Instant 3 in 1 White Coffee/39g x 15 sachets/Per pack /Halal/ Ipoh White Coffee</p><p><br></p><p>CAROMA Instant Blende White Coffee is a famous coffee among the Malaysians. The roasting process for normal black coffee involves roasting the beans with sugar, margarine and wheat. It is different for white coffee when The coffee beans are roasted with only margarine, without sugar, which gives the coffee a lighter shade.</p><p><br></p><p>When you drink white coffee, you are able to taste different layers of flavor in the coffee, which is thick and aromatic. Caroma Blende White Coffee is a premium selection of the first grade Arabica coffee beans. So you can enjoy the real taste of good coffee anytime, anywhere. Ideal to serve with either hot or cold drink.</p><p><br></p><p>#One Pack : 39g x 15 sachets</p><p>#Twin pack : 2 packs x 39g x 15 sachets</p><p>#Roasted coffee</p><p>#Rich and Creamy</p><p>#Little nutty</p><p>#Sweet</p><p>#Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM</p><p><br></p><p>Preparation in Hot/ Panas:</p><p>#Add 150ml 80 °C water + 1 sachets Instant white coffee powder + stir well and enjoy</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p>#Add 100ml 80 °C water + 1 sachets Instant white coffee powder + + stir well +Added some ice and enjoy.</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'cn', 25),
(75, 'Twin Packs/ [CAROMA] Instant 3 in 1 White Coffee/39g x 15 sachets/Per pack /Halal/ Ipoh White Coffee', '<p>Twin Packs/ [CAROMA] Instant 3 in 1 White Coffee/39g x 15 sachets/Per pack /Halal/ Ipoh White Coffee</p><p><br></p><p>CAROMA Instant Blende White Coffee is a famous coffee among the Malaysians. The roasting process for normal black coffee involves roasting the beans with sugar, margarine and wheat. It is different for white coffee when The coffee beans are roasted with only margarine, without sugar, which gives the coffee a lighter shade.</p><p><br></p><p>When you drink white coffee, you are able to taste different layers of flavor in the coffee, which is thick and aromatic. Caroma Blende White Coffee is a premium selection of the first grade Arabica coffee beans. So you can enjoy the real taste of good coffee anytime, anywhere. Ideal to serve with either hot or cold drink.</p><p><br></p><p>#One Pack : 39g x 15 sachets</p><p>#Twin pack : 2 packs x 39g x 15 sachets</p><p>#Roasted coffee</p><p>#Rich and Creamy</p><p>#Little nutty</p><p>#Sweet</p><p>#Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM</p><p><br></p><p>Preparation in Hot/ Panas:</p><p>#Add 150ml 80 °C water + 1 sachets Instant white coffee powder + stir well and enjoy</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p>#Add 100ml 80 °C water + 1 sachets Instant white coffee powder + + stir well +Added some ice and enjoy.</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'my', 25),
(76, 'Drip Pack Coffee Filter -Brazil Coffee Beans (Strong)', '<p>[CAROMA] Drip Pack Coffee Filter - Premium Coffee Bean Species/Strong/Arabica/10g x 6 Bag/Halal/Ground Coffee</p><p>100% Brazil Arabica / Drip Filter Coffee / Ground Coffee</p><p><br></p><p>Imported from Brazil Cerrado Coffee Beans: the highest grade of the famous Brazilian beans, lively and inviting with a smooth, sweet taste.</p><p><br></p><p>Dark roasting brings out an exceptional nutty flavor and enhances the body of the coffee. Our Cerrado is a traditionally natural dry processed coffee. This method creates a complexity of flavors. Brazilian coffees make excellent bases for some very intriguing blends, particularly in espresso.</p>', 'en', 26),
(77, 'Drip Pack Coffee Filter -Brazil Coffee Beans (Strong)', '<p>[CAROMA] Drip Pack Coffee Filter - Premium Coffee Bean Species/Strong/Arabica/10g x 6 Bag/Halal/Ground Coffee</p><p>100% Brazil Arabica / Drip Filter Coffee / Ground Coffee</p><p><br></p><p>Imported from Brazil Cerrado Coffee Beans: the highest grade of the famous Brazilian beans, lively and inviting with a smooth, sweet taste.</p><p><br></p><p>Dark roasting brings out an exceptional nutty flavor and enhances the body of the coffee. Our Cerrado is a traditionally natural dry processed coffee. This method creates a complexity of flavors. Brazilian coffees make excellent bases for some very intriguing blends, particularly in espresso.</p>', 'cn', 26),
(78, 'Drip Pack Coffee Filter -Brazil Coffee Beans (Strong)', '<p>[CAROMA] Drip Pack Coffee Filter - Premium Coffee Bean Species/Strong/Arabica/10g x 6 Bag/Halal/Ground Coffee</p><p>100% Brazil Arabica / Drip Filter Coffee / Ground Coffee</p><p><br></p><p>Imported from Brazil Cerrado Coffee Beans: the highest grade of the famous Brazilian beans, lively and inviting with a smooth, sweet taste.</p><p><br></p><p>Dark roasting brings out an exceptional nutty flavor and enhances the body of the coffee. Our Cerrado is a traditionally natural dry processed coffee. This method creates a complexity of flavors. Brazilian coffees make excellent bases for some very intriguing blends, particularly in espresso.</p>', 'my', 26),
(79, 'Drip Pack Coffee Filter -Guatemala Arabica Bean (Sour)', '<p>[CAROMA] Drip Pack Coffee Filter -Premium Coffee Bean Species/Sour Brew Arabica/10g x 6 Bag/Halal/Ground Coffee</p><p>Guatemala Acatenango 100% Arabica / Drip Filter Coffee / Ground Coffee</p><p><br></p><p>This coffee comes from Los Planes, which is in the well-known Acatenango region of Guatemala. The region produces aromatic, clean and balanced coffees year after year, exhilaratingly intense and intricate floral notes, candied citrus, crisp roasted cacao nib, a hint of moist pipe tobacco in aroma and cup. Balanced, gently bright acidity; silky, buoyant mouthfeel.</p><p><br></p><p>Very sweet, long, juicy finish.&amp;nbsp;Thanks partly to the active and nearby Fuego volcano that keeps replenishing the soil with minerals.</p>', 'en', 27),
(80, 'Drip Pack Coffee Filter -Guatemala Arabica Bean (Sour)', '<p>[CAROMA] Drip Pack Coffee Filter -Premium Coffee Bean Species/Sour Brew Arabica/10g x 6 Bag/Halal/Ground Coffee</p><p>Guatemala Acatenango 100% Arabica / Drip Filter Coffee / Ground Coffee</p><p><br></p><p>This coffee comes from Los Planes, which is in the well-known Acatenango region of Guatemala. The region produces aromatic, clean and balanced coffees year after year, exhilaratingly intense and intricate floral notes, candied citrus, crisp roasted cacao nib, a hint of moist pipe tobacco in aroma and cup. Balanced, gently bright acidity; silky, buoyant mouthfeel.</p><p><br></p><p>Very sweet, long, juicy finish.&amp;nbsp;Thanks partly to the active and nearby Fuego volcano that keeps replenishing the soil with minerals.</p>', 'cn', 27),
(81, 'Drip Pack Coffee Filter -Guatemala Arabica Bean (Sour)', '<p>[CAROMA] Drip Pack Coffee Filter -Premium Coffee Bean Species/Sour Brew Arabica/10g x 6 Bag/Halal/Ground Coffee</p><p>Guatemala Acatenango 100% Arabica / Drip Filter Coffee / Ground Coffee</p><p><br></p><p>This coffee comes from Los Planes, which is in the well-known Acatenango region of Guatemala. The region produces aromatic, clean and balanced coffees year after year, exhilaratingly intense and intricate floral notes, candied citrus, crisp roasted cacao nib, a hint of moist pipe tobacco in aroma and cup. Balanced, gently bright acidity; silky, buoyant mouthfeel.</p><p><br></p><p>Very sweet, long, juicy finish.&amp;nbsp;Thanks partly to the active and nearby Fuego volcano that keeps replenishing the soil with minerals.</p>', 'my', 27),
(82, 'Drip Pack Coffee Filter -Colombia Arabica Bean (Original)', '<p>[CAROMA] Drip Pack Coffee Filter/ Premium Colombia Santander Coffee Bean Species /Original Arabica/10g x 6 Bag/Halal /Ground Coffee/Drip Taste</p><p><br></p><p>Located in the north of the Cordillera Oriental, Santander Colombia, blessed with a rich biodiversity and lots of sunlight, coffee here grows in the shade of native forests giving it exquisite herbal notes, this shade-grown coffee is bright, exhibits medium to full body and is silky smooth with a rich mildly fruity and chocolate flavor due to its ideal weather conditions.</p>', 'en', 28),
(83, 'Drip Pack Coffee Filter -Colombia Arabica Bean (Original)', '<p>[CAROMA] Drip Pack Coffee Filter/ Premium Colombia Santander Coffee Bean Species /Original Arabica/10g x 6 Bag/Halal /Ground Coffee/Drip Taste</p><p><br></p><p>Located in the north of the Cordillera Oriental, Santander Colombia, blessed with a rich biodiversity and lots of sunlight, coffee here grows in the shade of native forests giving it exquisite herbal notes, this shade-grown coffee is bright, exhibits medium to full body and is silky smooth with a rich mildly fruity and chocolate flavor due to its ideal weather conditions.</p>', 'cn', 28),
(84, 'Drip Pack Coffee Filter -Colombia Arabica Bean (Original)', '<p>[CAROMA] Drip Pack Coffee Filter/ Premium Colombia Santander Coffee Bean Species /Original Arabica/10g x 6 Bag/Halal /Ground Coffee/Drip Taste</p><p><br></p><p>Located in the north of the Cordillera Oriental, Santander Colombia, blessed with a rich biodiversity and lots of sunlight, coffee here grows in the shade of native forests giving it exquisite herbal notes, this shade-grown coffee is bright, exhibits medium to full body and is silky smooth with a rich mildly fruity and chocolate flavor due to its ideal weather conditions.</p>', 'my', 28),
(85, 'Instant 3-in-1 Original Ipoh White Coffee Powder', '<p># Ingredients: Non-Dairy Creamer, Dextrose Sugar, Instant Coffee Powder</p><p><br></p><p># Ramuan: Krimer Bukan Tenusu, Dektrosa Sugar, Serbuk Kopi Segera</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 Spoon Ipoh White Coffee Powder +stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Ipoh White Coffee Powder +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p><br></p><p>CAROMA internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'en', 29),
(86, 'Instant 3-in-1 Original Ipoh White Coffee Powder', '<p># Ingredients: Non-Dairy Creamer, Dextrose Sugar, Instant Coffee Powder</p><p><br></p><p># Ramuan: Krimer Bukan Tenusu, Dektrosa Sugar, Serbuk Kopi Segera</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 Spoon Ipoh White Coffee Powder +stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Ipoh White Coffee Powder +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p><br></p><p>CAROMA internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'cn', 29),
(87, 'Instant 3-in-1 Original Ipoh White Coffee Powder', '<p># Ingredients: Non-Dairy Creamer, Dextrose Sugar, Instant Coffee Powder</p><p><br></p><p># Ramuan: Krimer Bukan Tenusu, Dektrosa Sugar, Serbuk Kopi Segera</p><p>It is suitable to drink hot or cold.</p><p><br></p><p>Preparation in Hot/ Panas:</p><p># Add 150ml 80 °C water + 2 Spoon Ipoh White Coffee Powder +stir well and enjoy.</p><p><br></p><p>Preparation in Cold/ Sejuk:</p><p># Add 100ml 80 °C water + 2 spoon Ipoh White Coffee Powder +stir well +Added some ice and enjoy.</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p><p><br></p><p>CAROMA internationally certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p>', 'my', 29),
(88, 'Instant 3-in-1 Original Ipoh White Coffee (sachets)', '<p>[CAROMA] Less Sweet Instant 3-in-1/ Original Ipoh White Coffee/ 8 sachets x 20g/Halal/Low GI/ Instant Kopi Segera</p><p><br></p><p>A taste of Malaysian Authentic all-time favorite \"IPOH WHITE COFFEE\" roasted coffee. Its aromatic, creamy and smooth texture loved by most Malaysian and coffee lovers.</p><p><br></p><p>#Weight: 250gram</p><p>#No Preservative</p><p>#No Artificial Colouring</p><p>#Less Sweet</p><p>#Low GI Sugar</p><p>#Smooth</p><p>#Healthier</p><p>#Creamy and delicious</p><p>#Suitable for Vegetarian</p><p>#Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM</p>', 'en', 30),
(89, 'Instant 3-in-1 Original Ipoh White Coffee (sachets)', '<p>[CAROMA] Less Sweet Instant 3-in-1/ Original Ipoh White Coffee/ 8 sachets x 20g/Halal/Low GI/ Instant Kopi Segera</p><p><br></p><p>A taste of Malaysian Authentic all-time favorite \"IPOH WHITE COFFEE\" roasted coffee. Its aromatic, creamy and smooth texture loved by most Malaysian and coffee lovers.</p><p><br></p><p>#Weight: 250gram</p><p>#No Preservative</p><p>#No Artificial Colouring</p><p>#Less Sweet</p><p>#Low GI Sugar</p><p>#Smooth</p><p>#Healthier</p><p>#Creamy and delicious</p><p>#Suitable for Vegetarian</p><p>#Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM</p>', 'cn', 30),
(90, 'Instant 3-in-1 Original Ipoh White Coffee (sachets)', '<p>[CAROMA] Less Sweet Instant 3-in-1/ Original Ipoh White Coffee/ 8 sachets x 20g/Halal/Low GI/ Instant Kopi Segera</p><p><br></p><p>A taste of Malaysian Authentic all-time favorite \"IPOH WHITE COFFEE\" roasted coffee. Its aromatic, creamy and smooth texture loved by most Malaysian and coffee lovers.</p><p><br></p><p>#Weight: 250gram</p><p>#No Preservative</p><p>#No Artificial Colouring</p><p>#Less Sweet</p><p>#Low GI Sugar</p><p>#Smooth</p><p>#Healthier</p><p>#Creamy and delicious</p><p>#Suitable for Vegetarian</p><p>#Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM</p>', 'my', 30),
(91, 'Medium Roasted Colombia Arabica Coffee Whole Beans', '<p>#What makes this Colombia Santander Coffee special?</p><p>Beyond the wonderfully green and sustainable nature of Java Planet is a truly worthy coffee. This coffee is a great low acid alternative to the typically bright Colombian cup. A mouth watering aroma of cherry and nut leads to a taste of, you guessed it, cherry and nut. These flavor notes are balanced with a pleasing caramel-toned sweetness that doesn\'t overwhelm.</p><p><br></p><p>Benefits of Black Coffee:</p><p>#It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'en', 31),
(92, 'Medium Roasted Colombia Arabica Coffee Whole Beans', '<p>#What makes this Colombia Santander Coffee special?</p><p>Beyond the wonderfully green and sustainable nature of Java Planet is a truly worthy coffee. This coffee is a great low acid alternative to the typically bright Colombian cup. A mouth watering aroma of cherry and nut leads to a taste of, you guessed it, cherry and nut. These flavor notes are balanced with a pleasing caramel-toned sweetness that doesn\'t overwhelm.</p><p><br></p><p>Benefits of Black Coffee:</p><p>#It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'cn', 31),
(93, 'Medium Roasted Colombia Arabica Coffee Whole Beans', '<p>#What makes this Colombia Santander Coffee special?</p><p>Beyond the wonderfully green and sustainable nature of Java Planet is a truly worthy coffee. This coffee is a great low acid alternative to the typically bright Colombian cup. A mouth watering aroma of cherry and nut leads to a taste of, you guessed it, cherry and nut. These flavor notes are balanced with a pleasing caramel-toned sweetness that doesn\'t overwhelm.</p><p><br></p><p>Benefits of Black Coffee:</p><p>#It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'my', 31),
(94, 'French Press Roasted Black Coffee O Mixture Powder', '<p>Benefits of Black Coffee:</p><p># It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p># Ingredients : Coffee Bean, Wheat, Margarine, Sugar</p><p>#Ramuan: Biji Kopi, Gandum, Marjerin dan Gula</p><p><br></p><p>#Preparation: A. Recipe for 1 cup of Kopi using COFFEE BAG:</p><p>Yield: 1 Portion [150ml of Base Brew], Kopi: 20g</p><p>Step 1: Add 2 teaspoon (heaped) of kopi powder to a coffee bag,</p><p>Step 2: Close bag, place in cup (8oz),</p><p>Step3: Fill with water just off the boil,</p><p>Step 4: Wait 5 mins (make sure bag is completely submerged, use a spoon to hold down the bag),</p><p>Step 5: Remove bag</p><p>Step 6: Add condiments of choice, Enjoy!</p><p><br></p><p>#Don\'t have a Coffee Sock Filter at hand? Don\'t worry! The following brew recipe is a good alternative for offices, or other places you may not have your Coffee Sock Filter with you. Whilst not quite as smooth and refined as the traditional sock method, using a French Press still provides a similar experience.</p><p><br></p><p>#Preparation: B. Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p><br></p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p><br></p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p><br></p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'en', 32),
(95, 'French Press Roasted Black Coffee O Mixture Powder', '<p>Benefits of Black Coffee:</p><p># It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p># Ingredients : Coffee Bean, Wheat, Margarine, Sugar</p><p>#Ramuan: Biji Kopi, Gandum, Marjerin dan Gula</p><p><br></p><p>#Preparation: A. Recipe for 1 cup of Kopi using COFFEE BAG:</p><p>Yield: 1 Portion [150ml of Base Brew], Kopi: 20g</p><p>Step 1: Add 2 teaspoon (heaped) of kopi powder to a coffee bag,</p><p>Step 2: Close bag, place in cup (8oz),</p><p>Step3: Fill with water just off the boil,</p><p>Step 4: Wait 5 mins (make sure bag is completely submerged, use a spoon to hold down the bag),</p><p>Step 5: Remove bag</p><p>Step 6: Add condiments of choice, Enjoy!</p><p><br></p><p>#Don\'t have a Coffee Sock Filter at hand? Don\'t worry! The following brew recipe is a good alternative for offices, or other places you may not have your Coffee Sock Filter with you. Whilst not quite as smooth and refined as the traditional sock method, using a French Press still provides a similar experience.</p><p><br></p><p>#Preparation: B. Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p><br></p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p><br></p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p><br></p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'cn', 32),
(96, 'French Press Roasted Black Coffee O Mixture Powder', '<p>Benefits of Black Coffee:</p><p># It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p># Ingredients : Coffee Bean, Wheat, Margarine, Sugar</p><p>#Ramuan: Biji Kopi, Gandum, Marjerin dan Gula</p><p><br></p><p>#Preparation: A. Recipe for 1 cup of Kopi using COFFEE BAG:</p><p>Yield: 1 Portion [150ml of Base Brew], Kopi: 20g</p><p>Step 1: Add 2 teaspoon (heaped) of kopi powder to a coffee bag,</p><p>Step 2: Close bag, place in cup (8oz),</p><p>Step3: Fill with water just off the boil,</p><p>Step 4: Wait 5 mins (make sure bag is completely submerged, use a spoon to hold down the bag),</p><p>Step 5: Remove bag</p><p>Step 6: Add condiments of choice, Enjoy!</p><p><br></p><p>#Don\'t have a Coffee Sock Filter at hand? Don\'t worry! The following brew recipe is a good alternative for offices, or other places you may not have your Coffee Sock Filter with you. Whilst not quite as smooth and refined as the traditional sock method, using a French Press still provides a similar experience.</p><p><br></p><p>#Preparation: B. Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p><br></p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p><br></p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p><br></p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'my', 32),
(97, 'Special Arabica & Robusta Instant Coffee Powder', '<p>[CAROMA] Special Premium House Blend/ Instant Coffee Powder/150g/ Arabica + Robusta Beans Mixed/Halal/No Sugar/ Coffee O/ Black Coffee/Kopi O</p><p><br></p><p>A taste of Malaysian Authentic all-time favorite \"CAROMA Distinctive PREMIUM INSTANT PURE SOLUBLE COFFEE\" roasted coffee.</p><p><br></p><p>#Weight: 150gram</p><p>#Special House Blend Instant Pure Soluble Coffee</p><p>#Premium Selection Arabica + Robusta Beans Mixed Blend</p><p>#Aroma Full Bodied</p><p>#Lively Aroma</p><p>#No Sugar</p><p>#No Preservative</p><p>#No Artificial Colouring</p><p>#Certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'en', 33),
(98, 'Special Arabica & Robusta Instant Coffee Powder', '<p>[CAROMA] Special Premium House Blend/ Instant Coffee Powder/150g/ Arabica + Robusta Beans Mixed/Halal/No Sugar/ Coffee O/ Black Coffee/Kopi O</p><p><br></p><p>A taste of Malaysian Authentic all-time favorite \"CAROMA Distinctive PREMIUM INSTANT PURE SOLUBLE COFFEE\" roasted coffee.</p><p><br></p><p>#Weight: 150gram</p><p>#Special House Blend Instant Pure Soluble Coffee</p><p>#Premium Selection Arabica + Robusta Beans Mixed Blend</p><p>#Aroma Full Bodied</p><p>#Lively Aroma</p><p>#No Sugar</p><p>#No Preservative</p><p>#No Artificial Colouring</p><p>#Certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'cn', 33);
INSERT INTO `product_translation` (`id`, `name`, `description`, `language`, `product_id`) VALUES
(99, 'Special Arabica & Robusta Instant Coffee Powder', '<p>[CAROMA] Special Premium House Blend/ Instant Coffee Powder/150g/ Arabica + Robusta Beans Mixed/Halal/No Sugar/ Coffee O/ Black Coffee/Kopi O</p><p><br></p><p>A taste of Malaysian Authentic all-time favorite \"CAROMA Distinctive PREMIUM INSTANT PURE SOLUBLE COFFEE\" roasted coffee.</p><p><br></p><p>#Weight: 150gram</p><p>#Special House Blend Instant Pure Soluble Coffee</p><p>#Premium Selection Arabica + Robusta Beans Mixed Blend</p><p>#Aroma Full Bodied</p><p>#Lively Aroma</p><p>#No Sugar</p><p>#No Preservative</p><p>#No Artificial Colouring</p><p>#Certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'my', 33),
(100, 'Light-Medium Roast Guatemala Arabica Coffee Beans', '<p>#Ingredients : Whole Coffee Bean</p><p>#Aroma: Floral, Citrus</p><p>#Flavor: Chocolate, Sweet, Nutty (slight)</p><p>#Body: Full, Round</p><p>#Acidity: Bright, Pleasant</p><p>#Milling Process: Washed, Sun-Dried</p><p>#Fragrance: Balanced body and clean lingering finish</p><p><br></p><p>Benefits of Black Coffee:</p><p>#It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p><br></p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'en', 34),
(101, 'Light-Medium Roast Guatemala Arabica Coffee Beans', '<p>#Ingredients : Whole Coffee Bean</p><p>#Aroma: Floral, Citrus</p><p>#Flavor: Chocolate, Sweet, Nutty (slight)</p><p>#Body: Full, Round</p><p>#Acidity: Bright, Pleasant</p><p>#Milling Process: Washed, Sun-Dried</p><p>#Fragrance: Balanced body and clean lingering finish</p><p><br></p><p>Benefits of Black Coffee:</p><p>#It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p><br></p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'cn', 34),
(102, 'Light-Medium Roast Guatemala Arabica Coffee Beans', '<p>#Ingredients : Whole Coffee Bean</p><p>#Aroma: Floral, Citrus</p><p>#Flavor: Chocolate, Sweet, Nutty (slight)</p><p>#Body: Full, Round</p><p>#Acidity: Bright, Pleasant</p><p>#Milling Process: Washed, Sun-Dried</p><p>#Fragrance: Balanced body and clean lingering finish</p><p><br></p><p>Benefits of Black Coffee:</p><p>#It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p><br></p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'my', 34),
(103, 'Medium Roast Brazil Arabica Coffee Whole Beans', '<p>[CAROMA] 250g/Premium Roasted Coffee Whole Beans/Brazil CerradoBean/100% Arabica/(Halal/High Quality/French Press/ Brew Coffee</p><p><br></p><p>#Ingredients : Whole Coffee Bean</p><p>#Roast: Medium-Dark</p><p>#Body: Full, creamy</p><p>#Taste: Rich, notes of walnut &amp;amp; dark chocolate</p><p>#Fragrance: Strong, Chocolate</p><p>#Aroma: Chocolate, nuts</p><p>#Sweetness: Caramel-toned</p><p>#Acidity: Mild</p><p>#Aftertaste: Clean &amp;amp; smooth</p><p><br></p><p>Benefits of Black Coffee:</p><p># It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p><br></p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'en', 35),
(104, 'Medium Roast Brazil Arabica Coffee Whole Beans', '<p>[CAROMA] 250g/Premium Roasted Coffee Whole Beans/Brazil CerradoBean/100% Arabica/(Halal/High Quality/French Press/ Brew Coffee</p><p><br></p><p>#Ingredients : Whole Coffee Bean</p><p>#Roast: Medium-Dark</p><p>#Body: Full, creamy</p><p>#Taste: Rich, notes of walnut &amp;amp; dark chocolate</p><p>#Fragrance: Strong, Chocolate</p><p>#Aroma: Chocolate, nuts</p><p>#Sweetness: Caramel-toned</p><p>#Acidity: Mild</p><p>#Aftertaste: Clean &amp;amp; smooth</p><p><br></p><p>Benefits of Black Coffee:</p><p># It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p><br></p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'cn', 35),
(105, 'Medium Roast Brazil Arabica Coffee Whole Beans', '<p>[CAROMA] 250g/Premium Roasted Coffee Whole Beans/Brazil CerradoBean/100% Arabica/(Halal/High Quality/French Press/ Brew Coffee</p><p><br></p><p>#Ingredients : Whole Coffee Bean</p><p>#Roast: Medium-Dark</p><p>#Body: Full, creamy</p><p>#Taste: Rich, notes of walnut &amp;amp; dark chocolate</p><p>#Fragrance: Strong, Chocolate</p><p>#Aroma: Chocolate, nuts</p><p>#Sweetness: Caramel-toned</p><p>#Acidity: Mild</p><p>#Aftertaste: Clean &amp;amp; smooth</p><p><br></p><p>Benefits of Black Coffee:</p><p># It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p><br></p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p><br></p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'my', 35),
(106, 'Medium Roast Ethiopian Coffee Whole Beans', '<p>#Ingredients : Whole Coffee Bean</p><p>#Aroma: Floral, Slight Woody</p><p>#Flavor: Honeysuckle, Berries, Blueberry, Berry Jam&nbsp;</p><p><br></p><p>Sweetness,Currant</p><p>#Currant Body: Medium, Smooth</p><p>#Milling Process: Fully Washed,Dried on raised beds</p><p>#Acidity: Winey</p><p>#Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p><p>Benefits of Black Coffee:</p><p>#It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p><br></p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p><br></p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'en', 36),
(107, 'Medium Roast Ethiopian Coffee Whole Beans', '<p>#Ingredients : Whole Coffee Bean</p><p>#Aroma: Floral, Slight Woody</p><p>#Flavor: Honeysuckle, Berries, Blueberry, Berry Jam&nbsp;</p><p><br></p><p>Sweetness,Currant</p><p>#Currant Body: Medium, Smooth</p><p>#Milling Process: Fully Washed,Dried on raised beds</p><p>#Acidity: Winey</p><p>#Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p><p>Benefits of Black Coffee:</p><p>#It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p><br></p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p><br></p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'cn', 36),
(108, 'Medium Roast Ethiopian Coffee Whole Beans', '<p>#Ingredients : Whole Coffee Bean</p><p>#Aroma: Floral, Slight Woody</p><p>#Flavor: Honeysuckle, Berries, Blueberry, Berry Jam&nbsp;</p><p><br></p><p>Sweetness,Currant</p><p>#Currant Body: Medium, Smooth</p><p>#Milling Process: Fully Washed,Dried on raised beds</p><p>#Acidity: Winey</p><p>#Certified by HACCP, ISO22000, MeSTI, cGMP and HALAL by JAKIM.</p><p>Benefits of Black Coffee:</p><p>#It improves cardiovascular health</p><p>#It improves your memory</p><p>#It is good for your liver</p><p>#It helps you cleanse your stomach</p><p>#It may help prevent the risk of developing cancer</p><p>#It is rich in antioxidants</p><p><br></p><p>#Preparation: Recipe for FRENCH PRESS</p><p>Yield: 1 Portion [150ml of Base Brew]</p><p>Kopi: 20g</p><p>Water: 200g @ 95-98˚C (plus extra to rinse + pre-heat)</p><p>Kit: French Press, Spoon, Mug, Timer</p><p>Filter Prep: Pre-heated</p><p>Brew Time: 3 minutes approx.</p><p>Step1: Pre-heat mug with hot water</p><p>Step 2: Pre-heat French Press and discard hot water</p><p>Step 3: Add CAROMA Coffee Powder to French Press</p><p>Step 4: Add 200g hot water to CAROMA Coffee Powder</p><p>Step 5: Set a 3 minute timer and stir 10 times in one direction</p><p>Step 6: When the timer is up, stir grounds once more to reintegrate into brew, then press plunger. Take care not to press the actual coffee grounds</p><p>Step 7: Discard water from pre-heated mug and pour in your French Press brew - you should have 150ml approx.</p><p>Step 8: Congrats - you\'ve made your French Press base brew!</p><p><br></p><p>#Examples of what to do with your base brew:</p><p>#Kopi-O Kosong (black coffee, unsweetened) - dilute with 70ml hot water</p><p><br></p><p>#Kopi-O (black coffee) - add 2 tsp sugar to your diluted coffee</p><p><br></p><p>#Adding evaporated or condensed milk? Reduce the amount of water</p><p>Storage Instructions: Keep in a cool, dry place. Avoid exposure to sunlight or excessive heat.</p>', 'my', 36),
(109, 'GOLD Freeze Dried Instant Soluble Coffee Powder', '<p>[CAROMA] GOLD Selection Premium /Freeze Dried /Instant Soluble Coffee Powder/150g/Halal /Colombia Bean Arabica/Coffee o/ Black Coffee/ No sugar</p><p><br></p><p>CAROMA Colombia GOLD Instant 100% Arabica coffee, Freeze Dried Technology Soluble Coffee 150gram. The taste profile of a Fusion Coffee is closer to fresh brewed coffee. There is no such other place for coffee cultivation on the entire planet as Colombia, with its tender climate, fertile volcanic soil and heavy rains.</p><p><br></p><p>Freeze-drying our Colombia coffee ensures that the flavors and nutrients of our beans are preserved, giving you a cup of coffee that is deliciously dark and rich of intense aroma. There is no sugar added and can enjoy closer to fresh brewed coffee.</p><p><br></p><p>Freeze-drying is a key stage in instant coffee production. Coffee beans are first roasted and ground, then dissolved into hot water. After filtration, the coffee extract is dried to get the solid soluble coffee. The liquor is frozen to about -40°C to form a thin layer that is then broken into tiny pieces.</p><p><br></p><p>#Weight: 150gram</p><p>#Premium GOLD Colombian Instant Soluble Coffee</p><p>#Freeze Dried Technology</p><p>#Strong Taste</p><p>#Perfect aroma of natural coffee and a balanced</p><p>#Aroma Brew Coffee</p><p>#No Sugar</p><p>#No Preservative</p><p>#No Artificial Colouring</p><p>#Certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'en', 37),
(110, 'GOLD Freeze Dried Instant Soluble Coffee Powder', '<p>[CAROMA] GOLD Selection Premium /Freeze Dried /Instant Soluble Coffee Powder/150g/Halal /Colombia Bean Arabica/Coffee o/ Black Coffee/ No sugar</p><p><br></p><p>CAROMA Colombia GOLD Instant 100% Arabica coffee, Freeze Dried Technology Soluble Coffee 150gram. The taste profile of a Fusion Coffee is closer to fresh brewed coffee. There is no such other place for coffee cultivation on the entire planet as Colombia, with its tender climate, fertile volcanic soil and heavy rains.</p><p><br></p><p>Freeze-drying our Colombia coffee ensures that the flavors and nutrients of our beans are preserved, giving you a cup of coffee that is deliciously dark and rich of intense aroma. There is no sugar added and can enjoy closer to fresh brewed coffee.</p><p><br></p><p>Freeze-drying is a key stage in instant coffee production. Coffee beans are first roasted and ground, then dissolved into hot water. After filtration, the coffee extract is dried to get the solid soluble coffee. The liquor is frozen to about -40°C to form a thin layer that is then broken into tiny pieces.</p><p><br></p><p>#Weight: 150gram</p><p>#Premium GOLD Colombian Instant Soluble Coffee</p><p>#Freeze Dried Technology</p><p>#Strong Taste</p><p>#Perfect aroma of natural coffee and a balanced</p><p>#Aroma Brew Coffee</p><p>#No Sugar</p><p>#No Preservative</p><p>#No Artificial Colouring</p><p>#Certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'cn', 37),
(111, 'GOLD Freeze Dried Instant Soluble Coffee Powder', '<p>[CAROMA] GOLD Selection Premium /Freeze Dried /Instant Soluble Coffee Powder/150g/Halal /Colombia Bean Arabica/Coffee o/ Black Coffee/ No sugar</p><p><br></p><p>CAROMA Colombia GOLD Instant 100% Arabica coffee, Freeze Dried Technology Soluble Coffee 150gram. The taste profile of a Fusion Coffee is closer to fresh brewed coffee. There is no such other place for coffee cultivation on the entire planet as Colombia, with its tender climate, fertile volcanic soil and heavy rains.</p><p><br></p><p>Freeze-drying our Colombia coffee ensures that the flavors and nutrients of our beans are preserved, giving you a cup of coffee that is deliciously dark and rich of intense aroma. There is no sugar added and can enjoy closer to fresh brewed coffee.</p><p><br></p><p>Freeze-drying is a key stage in instant coffee production. Coffee beans are first roasted and ground, then dissolved into hot water. After filtration, the coffee extract is dried to get the solid soluble coffee. The liquor is frozen to about -40°C to form a thin layer that is then broken into tiny pieces.</p><p><br></p><p>#Weight: 150gram</p><p>#Premium GOLD Colombian Instant Soluble Coffee</p><p>#Freeze Dried Technology</p><p>#Strong Taste</p><p>#Perfect aroma of natural coffee and a balanced</p><p>#Aroma Brew Coffee</p><p>#No Sugar</p><p>#No Preservative</p><p>#No Artificial Colouring</p><p>#Certified by HACCP, ISO22000, cGMP, MeSTI and HALAL by JAKIM.</p>', 'my', 37),
(118, 'testmulti product', '<p>testmulti product<br></p>', 'en', 40),
(119, 'testmulti product', '<p>testmulti product<br></p>', 'cn', 40),
(120, 'testmulti product', '<p>testmulti product<br></p>', 'my', 40);

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
  `priority` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `start`, `end`, `type`, `amt`, `percentage`, `capped`, `free_delivery`, `priority`, `status`, `date_created`, `date_modified`) VALUES
(1, '2020-12-31 16:00:00', '2021-01-30 16:00:00', 1, '50.0000', 0, '0.0000', 0, 0, 1, '2021-01-08 18:47:56', '2021-01-09 09:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_product`
--

CREATE TABLE `promotion_product` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `promotion_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotion_product`
--

INSERT INTO `promotion_product` (`id`, `product_id`, `promotion_id`) VALUES
(42, 8, 1),
(43, 9, 1),
(44, 15, 1),
(45, 16, 1),
(46, 17, 1),
(47, 18, 1);

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

--
-- Dumping data for table `promotion_translation`
--

INSERT INTO `promotion_translation` (`id`, `name`, `description`, `language`, `promotion_id`) VALUES
(1, 'test', '', 'en', 1),
(2, 'test', '', 'cn', 1),
(3, 'test', '', 'my', 1);

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
(1, 2);

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
(6, 'Wayne Test', 'puahweewee@gmail.com', 'eGJvanZhUkhPbGl3VU03Z0pUMWwydz09', NULL, 1, 1, '2020-10-04 12:53:42', '2020-12-19 15:47:49'),
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
(20, 'register test two', 'register2@gmail.com', 'R2VDa2tMZWtQMi9vajZMclhoY1VqUT09', NULL, 1, 1, '2021-01-04 14:40:37', '2021-01-04 14:40:37'),
(21, 'nicky', 'nickyzz111406@gmail.com', 'R2VDa2tMZWtQMi9vajZMclhoY1VqUT09', 'USER1609790100.png', 1, 1, '2021-01-04 19:52:52', '2021-01-04 19:55:00'),
(22, 'nicky', 'TESTnkwservice@gmail.com', 'R2VDa2tMZWtQMi9vajZMclhoY1VqUT09', NULL, 1, 1, '2021-01-06 17:58:28', '2021-01-06 17:58:28'),
(24, 'nicky', 'testnickyzz111406@gmail.com', 'R2VDa2tMZWtQMi9vajZMclhoY1VqUT09', NULL, 1, 1, '2021-01-09 05:49:53', '2021-01-09 05:49:53'),
(25, 'puah wee wee', 'hahhaha@hotmail.COM', 'eGJvanZhUkhPbGl3VU03Z0pUMWwydz09', NULL, 3, 1, '2021-01-09 12:30:46', '2021-01-09 12:30:46'),
(26, 'puah wee wee', 'testtesatetast@hotmail.COM', 'eGJvanZhUkhPbGl3VU03Z0pUMWwydz09', NULL, 3, 1, '2021-01-09 12:42:35', '2021-01-09 12:42:35'),
(27, 'puah wee wee', '123123@hotmail.COM', 'eGJvanZhUkhPbGl3VU03Z0pUMWwydz09', NULL, 3, 1, '2021-01-09 12:46:53', '2021-01-09 12:46:53'),
(28, 'puah wee wee', '321321@hotmail.COM', 'eGJvanZhUkhPbGl3VU03Z0pUMWwydz09', NULL, 3, 1, '2021-01-09 12:50:06', '2021-01-09 12:50:06'),
(29, 'puah wee wee', 'puahweewee@hotmail.com', 'eGJvanZhUkhPbGl3VU03Z0pUMWwydz09', NULL, 3, 1, '2021-01-09 12:55:46', '2021-01-09 12:55:46'),
(30, 'puah wee wee', 'puahweewee23@gmail.com', 'eGJvanZhUkhPbGl3VU03Z0pUMWwydz09', NULL, 3, 1, '2021-01-09 12:56:26', '2021-01-09 12:56:26'),
(32, 'puah wee wee', 'PUAHWEEWEE333@gmail.COM', 'eGJvanZhUkhPbGl3VU03Z0pUMWwydz09', NULL, 1, 0, '2021-01-10 15:01:59', '2021-01-10 15:01:59'),
(33, 'puah wee wee', 'PUAHWEEWEE555@gmail.COM', 'eGJvanZhUkhPbGl3VU03Z0pUMWwydz09', NULL, 1, 1, '2021-01-10 15:15:00', '2021-01-10 15:15:00');

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
(19, '-', '0163723722', 'hhaaha road 333', '75244', 'johor bahru', 1, 1, 20, '2021-01-04 14:40:37', '2021-01-04 14:40:37'),
(20, '-', '0123456789', 'no test 1', '81000', 'Johor', 1, 1, 21, '2021-01-04 19:52:52', '2021-01-04 19:55:00'),
(21, '-', '0123456789', 'sdfdfegewe', '52200', 'KUALA LUMPUR', 12, 1, 22, '2021-01-06 17:58:28', '2021-01-06 17:58:28'),
(22, '-', '+60169043123', '123 KAMPUNG BARU', '73200', 'GEMENCHEH', 3, 1, 23, '2021-01-09 05:47:46', '2021-01-09 05:47:46'),
(23, '-', '+60169043123', '123 KAMPUNG BARU', '73200', 'GEMENCHEH', 2, 1, 24, '2021-01-09 05:49:53', '2021-01-09 05:49:53'),
(24, '-', '+60169043022', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 2, 1, 25, '2021-01-09 12:30:46', '2021-01-09 12:30:46'),
(25, '-', '+60169041234', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 2, 1, 26, '2021-01-09 12:42:35', '2021-01-09 12:42:35'),
(26, '-', '+60169043022', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 3, 1, 27, '2021-01-09 12:46:53', '2021-01-09 12:46:53'),
(27, '-', '+60169043022', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 5, 1, 28, '2021-01-09 12:50:06', '2021-01-09 12:50:06'),
(28, '-', '+60169043022', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 2, 1, 29, '2021-01-09 12:55:46', '2021-01-09 12:55:46'),
(29, '-', '+60169043022', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 1, 1, 30, '2021-01-09 12:56:26', '2021-01-09 12:56:26'),
(31, '-', '+60169043022', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 2, 1, 32, '2021-01-10 15:01:59', '2021-01-10 15:01:59'),
(32, '-', '+60169043022', '108 KAMPUNG BARU', '73200', 'GEMENCHEH', 1, 1, 33, '2021-01-10 15:15:00', '2021-01-10 15:15:00');

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
(3, 3, 18),
(4, 3, 25),
(5, 3, 26),
(6, 3, 27),
(7, 3, 28),
(8, 3, 29),
(9, 3, 30);

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
(2, 53637, 1, '2021-01-04', 4, 6, '2021-01-10 08:21:29'),
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
(14, 0, 0, NULL, 1, 20, NULL),
(15, 64, 1, '2021-01-05', 1, 21, '2021-01-04 19:57:39'),
(16, 0, 0, NULL, 1, 22, NULL),
(17, 0, 0, NULL, 1, 23, NULL),
(18, 0, 0, NULL, 1, 24, NULL),
(20, 0, 0, NULL, 1, 32, NULL),
(21, 0, 0, NULL, 1, 33, NULL);

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
(22, -17, 55224, 'Purchase Point Discount. Order ID: 45', 6, '2021-01-04 14:00:35', '2021-01-04 14:00:35'),
(23, -148, 55076, 'Purchase Point Discount. Order ID: 1609775367', 6, '2021-01-04 15:49:54', '2021-01-04 15:49:54'),
(24, 3, 55079, 'Checkin. Day: 3', 6, '2021-01-04 15:52:50', '2021-01-04 15:52:50'),
(25, 1, 1, 'Checkin. Day: 1', 21, '2021-01-04 19:54:36', '2021-01-04 19:54:36'),
(26, -1, 0, 'Purchase Point Discount. Order ID: 1609790238', 21, '2021-01-04 19:57:39', '2021-01-04 19:57:39'),
(27, 64, 64, 'Sale. Order Id: 1609790238', 21, '2021-01-04 20:00:24', '2021-01-04 20:00:24'),
(28, 43, 55122, 'Sale. Order Id: 1609775367', 6, '2021-01-04 20:01:13', '2021-01-04 20:01:13'),
(29, -297, 54825, 'Purchase Point Discount. Order ID: 1610034249', 6, '2021-01-07 15:46:13', '2021-01-07 15:46:13'),
(30, -1188, 53637, 'Purchase Point Discount. Order ID: 1610266803', 6, '2021-01-10 08:21:29', '2021-01-10 08:21:29');

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
-- Indexes for table `new_arrival`
--
ALTER TABLE `new_arrival`
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
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_translation`
--
ALTER TABLE `category_translation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `new_arrival`
--
ALTER TABLE `new_arrival`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `point_transaction`
--
ALTER TABLE `point_transaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_role_price`
--
ALTER TABLE `product_role_price`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `product_translation`
--
ALTER TABLE `product_translation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promotion_product`
--
ALTER TABLE `promotion_product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `promotion_translation`
--
ALTER TABLE `promotion_translation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_dealer`
--
ALTER TABLE `user_dealer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_distributor`
--
ALTER TABLE `user_distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_point`
--
ALTER TABLE `user_point`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_point_transaction_history`
--
ALTER TABLE `user_point_transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
