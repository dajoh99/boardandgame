-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2025 at 05:22 AM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_catalog`
--
CREATE DATABASE IF NOT EXISTS `product_catalog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `product_catalog`;

-- --------------------------------------------------------

--
-- Table structure for table `all_games`
--

CREATE TABLE `all_games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `additional_description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `added_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `all_games`
--

INSERT INTO `all_games` (`id`, `name`, `description`, `image_path`, `additional_description`, `category`, `added_by`) VALUES
(1, 'Monopoly', 'Perry Hall, MD', 'images/monopolyboard.png', 'Buy, sell, dream, and scheme the way to riches with the Monopoly board game! Select a favorite Monopoly token, place it on Go, and roll the dice to own it all! Featuring classic Monopoly gameplay, this favorite family board game is all about buying, selling, and trading properties to win. Chance or Community cards can be a game changer. They can make a player richer--or send someone to Jail! Looking for games for Family Game Night? The Monopoly game is a Family Game Night staple. It’s a fun indoor activity for kids ages 8 and up and a great family gift.', 'Family', NULL),
(2, 'Sorry', 'Nottingham, MD', 'images/sorrygame.png', 'Slide, collide and score to win the Sorry! game! Who knows what will happen next as players chase their opponents around the board, trying to get their 3 pawns from start to home first? Will a player draw a card that tells them to move ahead 2 spaces or back 6? ', 'Family', NULL),
(3, 'Chess Board', 'Perry Hall, MD', 'images/chessboard.png', 'Game Desc Placeholder', 'Strategy', NULL),
(4, 'CLUE', 'Parkville, MD', 'images/clueboard.png', 'Game Desc Placeholder', 'Mystery', NULL),
(5, 'Monopoly', 'Parkville, MD', 'images/monopolyboard.png', 'Game Desc Placeholder', 'Family', NULL),
(8, 'Monopoly D&D', 'Washington, D.C.', 'images/dndboard.png', 'Game Desc Placeholder', 'Role Playing', NULL),
(9, 'Dungeons And Dragons', 'Nottingham, MD', 'images/dndboard2.png', 'Game Desc Placeholder', 'Role Playing', NULL),
(10, 'The Game of Life', 'Baltimore, MD', 'images/lifegame.png', 'Game Desc Placeholder', 'Family', NULL),
(11, 'Backgammon', 'Silver Spring, MD', 'images/backgammon.png', 'Game Desc Placeholder', 'Strategy', NULL),
(15, 'Candy Land', 'Middle River, MD', 'images/candyland.png', 'Game Desc Placeholder', 'Family', 'projecttester');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_data` json NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_data`, `created_at`) VALUES
(1, '{\"CLUE\": {\"image\": \"images/clueboard.png\", \"description\": \"Parkville, MD\"}, \"Monopoly\": {\"image\": \"images/monopolyboard.png\", \"description\": \"Parkville,MD\"}, \"Chess Board\": {\"image\": \"images/chessboard.png\", \"description\": \"Perry Hall, MD\"}}', '2025-05-08 03:43:08'),
(2, '{\"CLUE\": {\"image\": \"images/clueboard.png\", \"description\": \"Parkville, MD\"}, \"Sorry\": {\"image\": \"images/sorrygame.png\", \"description\": \"Nottingham, MD\"}}', '2025-05-09 05:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image_path`) VALUES
(1, 'Monopoly', 'Perry Hall, MD', 'images/monopolyboard.png'),
(2, 'Sorry', 'Nottingham, MD', 'images/sorrygame.png'),
(3, 'Chess Board', 'Perry Hall, MD', 'images/chessboard.png'),
(4, 'CLUE', 'Parkville, MD', 'images/clueboard.png'),
(5, 'Monopoly', 'Parkville, MD', 'images/monopolyboard.png');

-- --------------------------------------------------------

--
-- Table structure for table `products2`
--

CREATE TABLE `products2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products2`
--

INSERT INTO `products2` (`id`, `name`, `description`, `image_path`) VALUES
(1, 'Monopoly D&D', 'Washington, D.C.', 'images/dndboard.png'),
(2, 'Dungeons And Dragons', 'Nottingham, MD', 'images/dndboard2.png'),
(3, 'The Game of Life', 'Baltimore, MD', 'images/lifegame.png'),
(4, 'Backgammon', 'Silver Spring, MD', 'images/backgammon.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_games`
--
ALTER TABLE `all_games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products2`
--
ALTER TABLE `products2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_games`
--
ALTER TABLE `all_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products2`
--
ALTER TABLE `products2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Database: `user_registration`
--
CREATE DATABASE IF NOT EXISTS `user_registration` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `user_registration`;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `game_name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `username`, `city`, `state`, `game_name`, `comment`, `created_at`) VALUES
(1, 'projecttester', 'East Orange', 'New Jersey', 'Dungeons And Dragons', 'Love this game! My entire friend group enjoyed playing this, I\'d almost say its a must buy!', '2025-05-04 21:55:39'),
(2, 'sofaygo', 'Houston', 'Texas', 'CLUE', 'And I just wanna know, oh (oh)\r\nAnd I just wanna know how it goes (wanna know how it goes)', '2025-05-04 22:08:58'),
(3, 'projecttester', 'East Orange', 'New Jersey', 'Sorry', 'Would not recommend; didn\'t have all the pieces, 1/10', '2025-05-05 01:00:16'),
(7, 'projecttester', 'East Orange', 'New Jersey', 'Dungeons And Dragons', 'This game fye', '2025-05-09 04:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `street_address`, `city`, `state`, `created_at`) VALUES
(1, 'testuser1', 'test@example.com', '$2y$10$Hed8K1sMbdpVdBDYAKIvc.Hg7jUgh19bn5BfsyBuU/kU1ruwVzmXm', '485 North Grove Street', 'East Orange', 'New Jersey', '2025-04-16 02:43:20'),
(3, 'testuser2', 'test2@example.com', '$2y$10$MyFuuAPgLFZg/cz8LEcZbuCWsqQ.cOW4vrbCcjvp98bP.VW/4RLcq', '4405 Marble Road', 'Baltimore', 'Maryland', '2025-04-16 02:46:24'),
(4, 'dajoh99', 'dajoh99@morgan.edu', '$2y$10$4xKVAcOwhIvNBsFS83M5L.QMA3ueJBoccGY3WQC6IHr4xhKP/DAeq', '8200 Featherhill Road', 'Perry Hall', 'Maryland', '2025-04-16 02:47:43'),
(5, 'kyrie', 'knowles@tidal.com', '$2y$10$2a4jxXyAhXWlgBkeaimo5uIj.DJ22kGOavBiGjJVBUPz0yflIEbGG', '35 Winans St', 'East Orange', 'New Jersey', '2025-04-16 02:53:52'),
(6, 'micheal', 'mbj@gmail.com', '$2y$10$3oV7D5zGIWRxV7XHHa9RUOlDCT1mLxHLWfl77qT8jM3aqG.r8Uzki', '550 Dr Martin Luther King Jr Blvd', 'Newark', 'New Jersey', '2025-04-16 02:54:50'),
(7, 'testuser5', 'test5@example.com', '$2y$10$CMyHHk5sOkH.iRds0c7RpODmWH.AACOVrY4epXJnb.DOrEVLvGW0K', 'we\'re gonna come back to this', 'Sacremento', 'California', '2025-04-16 02:56:09'),
(8, 'testuser6', 'test6@example.com', '$2y$10$z0WMqHaqcHSq3a.argq2.eaQYqRIIUhBRU2VPeDM5gvuuscCvoYx2', 'Im running out of valid addresses', 'Miami', 'Florida', '2025-04-16 02:58:40'),
(9, 'testuser4', 'test4@example.com', '$2y$10$Q4NJjFvhkaZL/H9sDTLabOCRC/uG3cjGyXblloo2ZmNe4fASdcAQq', '1105 Hillen Road', 'Baltimore', 'Maryland', '2025-04-16 02:59:54'),
(10, 'testmorgan', 'testuser@morgan.edu', '$2y$10$ci1XQFyZIDQBa7MYkp6nAOolchnWp.QWYUEMXf2Vbi8GP/l8zh0UO', '1700 E Cold Spring Ln', 'Baltimore', 'Maryland', '2025-04-16 03:06:30'),
(11, 'juicewrld', 'jarad999@gmail.com', '$2y$10$ofc/BU4NO2nvT6CxsYVHnerPovhNM/7pfMI2pdVVs23zxBLW0sQh.', '4757 White Oak Ave', 'Encino', 'California', '2025-04-16 03:07:20'),
(12, 'mickeymouse', 'mickster@disney.com', '$2y$10$3bgP6OR8c21zFldy2xwgfe1DVtMWZQQAupa.Wl8zLWIIkoYJihxBq', '1180 Seven Seas Dr', 'Orlando', 'Florida', '2025-04-26 01:28:58'),
(13, 'projecttester', 'testinguser@gmail.com', '$2y$10$/OIk05LBw4.OPjahj8Szm.eQ0ccmkeV5OBDLSU.IPZZhepogQFB8y', '485 North Grove Street', 'East Orange', 'New Jersey', '2025-05-04 17:02:58'),
(15, 'sofaygo', 'gothegeneral@gmail.com', '$2y$10$wgFNr7AoNDWJOmdU0Dl2oeZRtcYNTh42AHEaGk6aRQ9KDf4aTmk16', 'Cactus Jack', 'Houston', 'Texas', '2025-05-04 22:06:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
