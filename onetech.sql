-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2020 at 05:40 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onetech`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `user_id`, `table_name`, `action`, `notification`, `executed_at`, `ip_address`) VALUES
(1, 2, 'product', 'Insert', 'Added new Product: MacBook Air 13', '2020-02-15 16:04:09', ''),
(2, 2, 'user', 'Edit', 'Edited User: ', '2020-02-15 17:01:31', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Apple'),
(2, 'Sony'),
(3, 'Samsung'),
(4, 'Huawei'),
(5, 'Nokia'),
(6, 'Xiaomi'),
(7, 'Lenovo'),
(8, 'Toshiba'),
(11, 'Asus'),
(12, 'Amd'),
(13, 'Intel'),
(14, 'Kingston'),
(15, 'Pioneer');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `total_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `color_id`, `quantity`, `total_price`) VALUES
(1, 2, 7, 2, 4, '3280'),
(3, 2, 2, 4, 2, '1600'),
(6, 2, 15, 4, 4, '2400'),
(7, 6, 4, 1, 3, '4800'),
(8, 6, 12, 2, 1, '470'),
(9, 3, 8, 2, 1, '3200');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent_id`) VALUES
(1, 'Computers & Laptops', NULL),
(2, 'Cameras & Photos', NULL),
(3, 'Hardware', NULL),
(4, 'Smartphones & Tablets', NULL),
(5, 'TV & Audio', NULL),
(6, 'Gadgets', NULL),
(7, 'Car Electronics', NULL),
(8, 'Video Games & Consoles', NULL),
(9, 'Accessories', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `name`, `code`) VALUES
(1, 'Tan', '#b19c83'),
(2, 'Black', '#000000'),
(3, 'Grey', '#999999'),
(4, 'Blue', '#0e8ce4'),
(5, 'Red', '#df3b3b'),
(6, 'White', '#e1e1e1');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount` int(3) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `path_big` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_small` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `path_big`, `path_small`, `alt`) VALUES
(1, 'samsunggalaxynotes10plus_velika.jpg', 'samsunggalaxynotes10plus_mala.jpg', 'note10plus'),
(8, 'big_1581717098iphone_11_purple_2_2.jpg', 'small_1581717098iphone_11_purple_2_2.jpg', 'iphone_11_purple_2_2.jpg'),
(11, 'big_1581376158xiaomirn8.jpg', 'small_1581376158xiaomirn8.jpg', 'xiaomirn8.jpg'),
(12, 'big_1581423190lenovo.jpg', 'small_1581423190lenovo.jpg', 'lenovo.jpg'),
(14, 'big_1581515807iphone10.jpg', 'small_1581515807iphone10.jpg', 'iphone10.jpg'),
(15, 'big_1581515852iphone10.jpg', 'small_1581515852iphone10.jpg', 'iphone10.jpg'),
(16, 'big_1581598560sonytv.jpg', 'small_1581598560sonytv.jpg', 'sonytv.jpg'),
(17, 'big_1581599321ryzen.jpg', 'small_1581599321ryzen.jpg', 'ryzen.jpg'),
(18, 'big_1581599638asusgraficka.jpg', 'small_1581599638asusgraficka.jpg', 'asusgraficka.jpg'),
(19, 'big_1581600063rammemorija.jpg', 'small_1581600063rammemorija.jpg', 'rammemorija.jpg'),
(20, 'big_1581600476sonyps4.jpg', 'small_1581600476sonyps4.jpg', 'sonyps4.jpg'),
(21, 'big_1581600967autoradio.jpg', 'small_1581600967autoradio.jpg', 'autoradio.jpg'),
(22, 'big_1581601119sonykamera.jpg', 'small_1581601119sonykamera.jpg', 'sonykamera.jpg'),
(23, 'big_1581635854sonyxz.jpg', 'small_1581635854sonyxz.jpg', 'sonyxz.jpg'),
(24, 'big_1581715538lenovo.jpg', 'small_1581715538lenovo.jpg', 'lenovo.jpg'),
(25, 'big_1581779049macbook.jpg', 'small_1581779049macbook.jpg', 'macbook.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `in_stock`, `brand_id`, `category_id`, `image_id`) VALUES
(2, 'Galaxy Note 10 Plus', 'neki opis', '800', 10, 3, 4, 1),
(4, 'Iphone 11', 'iphone11', '1600', 9, 1, 4, 8),
(7, 'Redmi Note 8', 'njesra', '820', 7, 6, 4, 11),
(8, 'Smart TV KD-85X', 'Sony televizor', '3200', 9, 2, 5, 16),
(9, 'Ryzen 3800X 3.9GHz', 'AMD Ryzen', '460', 17, 12, 3, 17),
(10, 'ROG Strix GeForce RTX 2070', 'ASUS ROG Strix GeForce RTX 2070', '920', 13, 11, 3, 18),
(11, 'HYPERX Predator 4x16GB', 'HYPERX Predator RGB 64GB kit', '410', 20, 14, 3, 19),
(12, 'console PLAYSTATION 4', 'PLAYSTATION 4 PRO 1TB', '470', 22, 2, 8, 20),
(13, 'Auto Radio AVH-290BT', 'Auto radio', '325', 10, 15, 7, 21),
(14, 'Camera HDR-CX240EB', 'Kamera Sony', '220', 22, 2, 2, 22),
(15, 'Xperia XZ', 'Najbolji Sony', '600', 17, 2, 4, 23),
(16, 'Laptop IdeaPad L340', 'Lenovo laptop', '490', 10, 7, 1, 24),
(17, 'MacBook Air 13', 'Apple MacBook', '1550', 13, 1, 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`id`, `product_id`, `color_id`) VALUES
(1, 2, 2),
(2, 2, 4),
(21, 7, 2),
(22, 7, 5),
(23, 8, 2),
(24, 8, 5),
(25, 9, 2),
(26, 10, 2),
(27, 10, 6),
(28, 11, 2),
(29, 11, 3),
(30, 11, 6),
(31, 12, 2),
(32, 13, 6),
(33, 14, 3),
(34, 14, 6),
(35, 15, 2),
(36, 15, 4),
(37, 16, 1),
(38, 16, 3),
(39, 16, 6),
(43, 4, 1),
(44, 4, 2),
(45, 4, 6),
(46, 17, 3),
(47, 17, 6);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `active`, `auth_key`, `role_id`) VALUES
(1, 'Ivan', 'Maksimovic', 'imaksimovic97@gmail.com', '9882ff51cb5470b7a6472fc6dc715eb17749012f', '2020-01-30 19:58:32', 0, '74e6c28861afc006ed6d4753eb867b99', 2),
(2, 'Admin', 'Admin', 'admin@gmail.com', '06e6bc25cb6684c3b2193aaabc54e8acd4772dfe', '2020-02-11 02:40:25', 1, '', 1),
(3, 'Laza', 'Lazic', 'lazalazic123@gmail.com', '8463347f1f739b98f920cdfc65f8896fbc1eff12', '2020-02-12 17:41:54', 1, 'b49af69e09889f04666161718d495c81', 2),
(4, 'Pera', 'Peric', 'peraperic@gmail.com', 'a2b7af05d40eab44a212e20c6b8dfce022f5e298', '2020-02-14 17:27:21', 0, 'ac71dba5c7c773d7695459a45e780c75', 2),
(6, 'Marko', 'Markovic', 'mare123@gmail.com', 'da56c504f27d2e00ab1280ce9f5f3ec270f5d670', '2020-02-15 00:27:24', 1, 'b7285682f8040c70154f299db77a31b7', 2),
(7, 'Mile', 'Kitic', 'milemile123@gmail.com', '6f46399252d1cf2cf88a473353f571813f8d8c6d', '2020-02-15 14:55:56', 1, 'd1167ff4076cc4bdce2c5f06c2021b3c', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `actions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `product_color`
--
ALTER TABLE `product_color`
  ADD CONSTRAINT `product_color_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_color_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
