-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2023 at 04:22 AM
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
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `product_id`, `size`, `quantity`) VALUES
(6, 1, 23, 'XXL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` tinyint(4) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `title`, `description`) VALUES
(1, 'Gucci', 'This category is for dresses from Gucci brand'),
(2, 'Versace', 'This category is for dresses from Versace brand'),
(4, 'Adidas', 'This category is for dresses from adidas brand'),
(7, 'Nike', 'This category is for dresses from nike brand');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `size` varchar(50) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_paid` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 = not paid, 1 = paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `size`, `quantity`, `subtotal`, `product_id`, `user_id`, `is_paid`) VALUES
(1, 'XXL', 2, '156.00', 22, 2, 1),
(2, 'XXL', 1, '78.00', 23, 2, 1),
(3, 'XXL', 1, '78.00', 23, 1, 0),
(4, 'Small', 1, '78.00', 24, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `thumbnail` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` tinyint(4) NOT NULL,
  `is_featured` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 = yes, 1 = no',
  `is_new` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 = yes, 1 = no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `thumbnail`, `description`, `price`, `category_id`, `is_featured`, `is_new`) VALUES
(22, 'Cartoon Astronaut T-Shirts', 'images/f1.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 1, 0, 0),
(23, 'Cartoon Astronaut T-Shirts', 'images/f2.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 2, 0, 0),
(24, 'Cartoon Astronaut T-Shirts', 'images/f3.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 4, 0, 0),
(28, 'Cartoon Astronaut T-Shirts', 'images/f4.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 7, 0, 0),
(29, 'Island Cotton T-Shirts', 'images/f5.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '188.00', 1, 1, 1),
(30, 'Astronaut T-Shirts Strip', 'images/f6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '107.93', 2, 1, 0),
(34, 'Cartoon Astronaut T-Shirts', 'images/f7.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 4, 0, 0),
(35, 'Cartoon Astronaut T-Shirts', 'images/f8.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 7, 0, 0),
(36, 'T-Shirts Strip', 'images/n1.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '150.00', 1, 0, 1),
(40, 'Cartoon Astronaut T-Shirts', 'images/n2.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 2, 0, 0),
(41, 'Cartoon Astronaut T-Shirts', 'images/n3.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 4, 0, 0),
(42, 'Shorts Astronaut Ultra', 'images/n4.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '118.46', 7, 1, 0),
(46, 'Cartoon Astronaut T-Shirts', 'images/n5.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 1, 0, 0),
(47, 'Cartoon Astronaut T-Shirts', 'images/n6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 2, 0, 0),
(48, 'Ultra Astronaut T-Shirts', 'images/n4.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 4, 0, 0),
(52, 'Cartoon Astronaut T-Shirts', 'images/f2.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 7, 0, 0),
(53, 'Cartoon Astronaut T-Shirts', 'images/f6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 1, 0, 0),
(54, 'Astronaut Short Per', 'images/n6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 2, 0, 0),
(58, 'Cartoon Astronaut T-Shirts', 'images/n7.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 4, 0, 0),
(59, 'Cartoon Astronaut T-Shirts', 'images/f6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 7, 0, 0),
(60, 'Cartoon Free Shirt', 'images/n8.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.99', 1, 1, 0),
(64, 'Cartoon Astronaut T-Shirts', 'images/f2.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 2, 0, 0),
(65, 'Cartoon Astronaut T-Shirts', 'images/f6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 4, 0, 0),
(66, 'White Beauty Shirt', 'images/n3.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '128.14', 7, 0, 1),
(70, 'Cartoon Astronaut T-Shirts', 'images/f2.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 1, 0, 0),
(71, 'Cartoon Astronaut T-Shirts', 'images/f6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 2, 0, 0),
(72, 'Modeled Ultra T-Shirts', 'images/f4.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '150.00', 4, 1, 0),
(73, 'Gildan Ultra T-Shirts', 'images/f5.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '500.00', 7, 0, 1),
(74, 'Brown CartonT-Shirts', 'images/n7.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '50.00', 1, 0, 1),
(76, 'Cartoon Astronaut T-Shirts', 'images/f2.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 2, 0, 0),
(77, 'Cartoon Astronaut T-Shirts', 'images/f6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 4, 0, 0),
(78, 'Cartoon Astronaut T-Shirts', 'images/f5.jpg', 'This is Cartoon Astronaut T-Sh', '78.00', 7, 1, 0),
(82, 'Cartoon Astronaut T-Shirts', 'images/f2.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 1, 0, 0),
(83, 'Cartoon Astronaut T-Shirts', 'images/f6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 2, 0, 0),
(84, 'Gildan Astronaut T-Shirts', 'images/f5.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '278.00', 4, 1, 1),
(85, 'Zion Astronaut T-Shirts', 'images/n6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '150.00', 7, 1, 1),
(86, 'Extreme Astronaut T-Shirts', 'images/n6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '250.50', 1, 1, 1),
(88, 'Cartoon Astronaut T-Shirts', 'images/f2.jpg', 'The Gildan Ultra Cotton T-shirt is made from  substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 2, 0, 0),
(89, 'Cartoon Astronaut T-Shirts', 'images/f6.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '78.00', 4, 0, 0),
(92, 'Cartoon Astronaut T-Shirts', 'images/n7.jpg', 'The Gildan Ultra Cotton T-shirt is made from substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', '50.00', 7, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`) VALUES
(5, 'This is a cool shirt, I got what I ordered for in a clean and well packaged way.', 5, 16, 22, '2023-08-26 01:39:02'),
(6, 'This is a well packaged shirt, I got what I ordered for in a clean and cool  way.', 5, 1, 22, '2023-08-26 01:39:02'),
(7, 'This is a cool shirt, I got what I ordered for in a clean and well packaged way.', 5, 15, 22, '2023-08-26 01:39:02'),
(8, 'This is a well packaged shirt, I got what I ordered for in a clean and cool  way.', 5, 9, 22, '2023-08-26 01:39:02'),
(9, 'This is a cool shirt, I got what I ordered for in a clean and well packaged way.', 5, 16, 23, '2023-08-26 01:54:02'),
(10, 'This is a well packaged shirt, I got what I ordered for in a clean and cool  way.', 5, 1, 22, '2023-08-26 01:59:02'),
(11, 'This is a cool shirt, I got what I ordered for in a clean and well packaged way.', 5, 15, 22, '2023-08-26 01:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `thumbnail` varchar(30) NOT NULL,
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 = no, 1 = yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `thumbnail`, `is_admin`) VALUES
(1, 'Dorcas Samuel', 'samueldorcaseshowokeoghene@gmail.com', '$2y$10$/.8BOL1CGTzXFEX2HT7voOnZfvaELFffzjAx9b/P9.IJwUkNOh.Pq', 'images/Dorcas2.jpg', 0),
(9, 'Jane Doe', 'showokeoghene@gmail.com', '$2y$10$cp/6An74Lj10W1GicpoBfeGYfbsmgOT3q3bM3LS7T1eta0OP8XG7u', 'images/Dorcas7.jpg', 1),
(15, 'Josh Dove', 'John@gmail.com', '$2y$10$VZIp2R.rTFKDmSkrqb8Ihe.W0KFiOZUnT9LyNHWkHqqEkebX0X0LS', 'images/1.png', 0),
(16, 'Steve Harvey', 'Samuel@gmail.com', '$2y$10$byTAYA3oaoFf1TxDrkSy7u9m/pKJ93vajmspvQfGblGvv0MyZBHma', 'images/2.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_ibfk_1` (`category_id`);
ALTER TABLE `products` ADD FULLTEXT KEY `description` (`description`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
