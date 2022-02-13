-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql106.epizy.com
-- Generation Time: Feb 13, 2022 at 08:20 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_31050318_cartoonpau_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type` varchar(20) NOT NULL,
  `regdate` datetime(6) NOT NULL,
  `lastlogin` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `email`, `name`, `password`, `type`, `regdate`, `lastlogin`) VALUES
(1, 'admin@cartoonpau.com', 'Indah Shoufea', '7110EDA4D09E062AA5E4A390B0A572AC0D2C0220', 'super', '2021-12-03 00:22:36.000000', '2022-02-08 06:09:59.624096');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agent`
--

CREATE TABLE `tbl_agent` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `regdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_agent`
--

INSERT INTO `tbl_agent` (`name`, `email`, `phone`, `address`, `regdate`) VALUES
('Farah Farzana', 'zana@gmail.com', '01110102858', 'Bandar Ampang, Ampang, Kuala Lumpur', '2022-01-19'),
('Laili Izzati', 'laili@gmail.com', '01115744542', 'Petaling Jaya Utama, Petaling Jaya, Selangor', '2022-01-19'),
('Hafizatul Aini', 'aini@gmail.com', '01152783799', 'Rantau Panjang, Klang, Selangor', '2022-01-19'),
('Batrisya Liyana', 'batrisya@gmail.com', '01160875693', 'Kg. Gajah, Teluk Intan, Perak', '2022-01-19'),
('Axzly Juni', 'axzly@gmail.com', '01165585092', 'Puchong Utama, Puchong, Selangor', '2022-01-19'),
('Anuar', 'anuar@gmail.com', '0126947600', 'Subang Jaya, Selangor', '2022-02-13'),
('Farhana Elysha', 'fahana@gmail.com', '0134745448', 'Putra Perdana, Puchong, Selangor', '2022-01-19'),
('Ain Syahindah', 'ain@gmail.com', '0134935615', 'Seksyen 7, Shah Alam, Selangor', '2022-01-19'),
('Sumayyah ', 'maya@gmail.com', '0136546826', 'Kampung Jabi, Segamat, Johor', '2022-01-19'),
('Putri', 'putri@gmail.com', '0147569823', 'Pasir Mas, Kelantan', '2022-02-13'),
('Yasmin', 'yasmin@gmail.com', '0164785412', 'Petaling Jaya, Selangor', '2022-02-13'),
('Zahrah Thohirah', 'zahrah@gmail.com', '0172631617', 'Aman Putra, Puchong, Selangor', '2022-01-19'),
('Ali', 'ali@gmail.com', '0174568521', 'Subang Jaya, Selangor', '2022-02-13'),
('Abu', 'abu@gmail.com', '0174569874', 'Puchong, Selangor', '2022-02-13'),
('Azimah', 'azimah@gmail.com', '0178456985', 'Putra Perdana, Puchong, Selangor', '2022-02-13'),
('Khairul', 'khairul@gmail.com', '01874569824', 'Puchong', '2022-02-13'),
('Farah Liana', 'farah@gmail.com', '0189554982', 'Seri Manjung, Manjung, Perak', '2022-01-19'),
('Nadia', 'nadia@gmail.com', '0196650658', 'Pinggiran USJ, Shah Alam, Selangor', '2022-01-19'),
('Syuhada', 'syu@gmail.com', '0198476255', 'Taman Putra Perdana, Puchong, Selangor', '2022-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `user_email` varchar(255) NOT NULL,
  `pau_id` varchar(10) NOT NULL,
  `cart_qty` int(5) NOT NULL,
  `cart_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`user_email`, `pau_id`, `cart_qty`, `cart_id`) VALUES
('indahsitishoufea@gmail.com', '7', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_receiptid` varchar(10) NOT NULL,
  `order_pauid` varchar(10) NOT NULL,
  `order_qty` varchar(5) NOT NULL,
  `order_custid` varchar(50) NOT NULL,
  `order_paid` varchar(10) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_receiptid`, `order_pauid`, `order_qty`, `order_custid`, `order_paid`, `order_status`, `order_date`) VALUES
('lz55dwxq', '6', '10', 'indah@gmail.com', '160', '', '2022-02-13 01:41:09.973961'),
('lz55dwxq', '10', '2', 'indah@gmail.com', '32', '', '2022-02-13 01:41:09.975489'),
('lz55dwxq', '9', '6', 'indah@gmail.com', '96', '', '2022-02-13 01:41:09.976954'),
('lz55dwxq', '11', '3', 'indah@gmail.com', '48', '', '2022-02-13 01:41:09.977290'),
('yxwzfzw2', '9', '1', 'farahliana@gmail.com', '16', '', '2022-02-13 05:06:14.168076'),
('pftgwfqd', '19', '3', 'syifa@gmail.com', '48', '', '2022-02-13 07:52:09.279016'),
('gdmi6rdp', '19', '3', 'syifa@gmail.com', '48', '', '2022-02-13 07:57:05.426592');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pau`
--

CREATE TABLE `tbl_pau` (
  `pau_id` int(5) NOT NULL,
  `pau_name` varchar(255) NOT NULL,
  `pau_flav` varchar(255) NOT NULL,
  `pau_code` varchar(50) NOT NULL,
  `pau_price` float NOT NULL,
  `pau_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pau`
--

INSERT INTO `tbl_pau` (`pau_id`, `pau_name`, `pau_flav`, `pau_code`, `pau_price`, `pau_date`) VALUES
(6, 'Nemo', 'Coconut Caramel', 'PAU-NEMO', 16, '2022-02-09 20:05:35'),
(7, 'Captain America', 'Macaroni Blackpepper', 'PAU-CA', 16, '2022-02-09 20:05:35'),
(9, 'Smiley', 'Sweet Corn', 'PAU-SMLY', 16, '2022-02-09 20:05:35'),
(10, 'Keroro', 'Kaya', 'PAU-KY', 16, '2022-02-12 01:22:27'),
(11, 'Angry Bird', 'Mocha Walnut', 'PAU-AB', 16, '2022-02-12 14:25:48'),
(12, 'Minion', 'Chocolate', 'PAU-MN', 16, '2022-02-13 04:40:31'),
(13, 'Doraemon', 'Red Bean', 'PAU-DRMN', 16, '2022-02-13 04:42:05'),
(14, 'Hello Kitty', 'Strawberry Pineapple', 'PAU-HK', 16, '2022-02-13 04:44:28'),
(15, 'Panda', 'Peanut Butter', 'PAU-PND', 16, '2022-02-13 04:46:26'),
(16, 'Spiderman', 'Macaroni Blackpepper Chicken', 'PAU-SPDRMN', 16, '2022-02-13 04:48:43'),
(19, 'Tweety', 'Chicken Curry', 'PAU-TWTY', 16, '2022-02-13 07:14:18'),
(20, 'Bear', 'Chicken Carbonara', 'PAU-BR', 16, '2022-02-13 07:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(5) NOT NULL,
  `payment_receipt` varchar(10) NOT NULL,
  `payment_email` varchar(50) NOT NULL,
  `payment_paid` varchar(10) NOT NULL,
  `payment_date` datetime(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `payment_receipt`, `payment_email`, `payment_paid`, `payment_date`) VALUES
(1, 'lz55dwxq', 'indah@gmail.com', '336', '2022-02-13 01:41:09.977554'),
(9, 'yxwzfzw2', 'farahliana@gmail.com', '32', '2022-02-13 05:06:14.169714'),
(10, 'pftgwfqd', 'syifa@gmail.com', '48', '2022-02-13 07:52:09.280738'),
(11, 'gdmi6rdp', 'syifa@gmail.com', '48', '2022-02-13 07:57:05.427072');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_id` int(3) NOT NULL,
  `lastlogin` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `user_regdate` datetime(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_name`, `user_email`, `user_phone`, `user_password`, `user_id`, `lastlogin`, `user_regdate`) VALUES
('indah', 'indah@gmail.com', '0136196076', '7110EDA4D09E062AA5E4A390B0A572AC0D2C0220', 1, '2022-02-12 03:43:26.055588', '2022-02-12 11:43:26.055588'),
('maya', 'maya@gmail.com', '01569845', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, '2022-02-10 16:52:10.653122', '2022-02-11 00:52:10.653122'),
('Farah Liana', 'farahliana@gmail.com', '0154789652', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 5, '2022-02-13 10:13:43.685281', '2022-02-13 05:13:43.685281'),
('indah', 'indahsitishoufea@gmail.com', '01110088545', '8be3c943b1609fffbfc51aad666d0a04adf83c9d', 6, '2022-02-13 09:45:30.107402', '2022-02-13 04:45:30.107402'),
('Syifa', 'syifa@gmail.com', '0147854665', '7d695548f82a9589a5b09da95040ad6930ce8b86', 8, '2022-02-13 12:39:26.573103', '2022-02-13 07:39:26.573103');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  ADD PRIMARY KEY (`phone`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_pau`
--
ALTER TABLE `tbl_pau`
  ADD PRIMARY KEY (`pau_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_pau`
--
ALTER TABLE `tbl_pau`
  MODIFY `pau_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
