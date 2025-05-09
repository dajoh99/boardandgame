-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2025 at 04:40 PM
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
-- Database: `labdb`
--
CREATE DATABASE IF NOT EXISTS `labdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `labdb`;

-- --------------------------------------------------------

--
-- Table structure for table `employeeprojects`
--

CREATE TABLE `employeeprojects` (
  `EmployeeID` int(11) DEFAULT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employeeprojects`
--

INSERT INTO `employeeprojects` (`EmployeeID`, `ProjectID`, `Role`) VALUES
(2, 101, 'Developer'),
(3, 103, 'Analyst'),
(5, 102, 'Consultant'),
(6, 104, 'Security Analyst'),
(7, 105, 'Project Lead'),
(8, 106, 'HR Specialist'),
(10, 108, 'Data Engineer'),
(1, 109, 'Security Consultant');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Department` varchar(50) DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `HireDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `FirstName`, `LastName`, `Department`, `Salary`, `HireDate`) VALUES
(1, 'Alice', 'Johnson', 'HR', '60000.00', '2015-06-22'),
(2, 'Bob', 'Smith', 'IT', '75000.00', '2018-09-10'),
(3, 'Charlie', 'Brown', 'Finance', '80000.00', '2020-01-15'),
(4, 'David', 'Lee', 'IT', '72000.00', '2017-11-05'),
(5, 'Emma', 'Davis', 'HR', '65000.00', '2016-04-30'),
(6, 'Frank', 'Wilson', 'Marketing', '55000.00', '2019-08-20'),
(7, 'Grace', 'Hall', 'IT', '78000.00', '2015-03-10'),
(8, 'Hannah', 'Young', 'Finance', '72000.00', '2016-12-11'),
(9, 'Ian', 'King', 'HR', '67000.00', '2017-05-18'),
(10, 'Jack', 'Wright', 'Marketing', '52000.00', '2021-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ProjectID` int(11) NOT NULL,
  `ProjectName` varchar(100) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ProjectID`, `ProjectName`, `StartDate`, `EndDate`) VALUES
(101, 'AI Development', '2023-01-01', '2023-12-31'),
(102, 'Cloud Migration', '2022-06-15', '2023-06-15'),
(103, 'Financial Analysis', '2021-07-01', '2022-12-31'),
(104, 'Cybersecurity Enhancement', '2020-05-10', '2021-09-30'),
(105, 'E-commerce Platform', '2019-11-20', '2020-12-15'),
(106, 'HR System Upgrade', '2021-03-05', '2022-06-10'),
(107, 'Marketing Strategy Overhaul', '2023-02-14', '2023-10-30'),
(108, 'Data Warehousing', '2020-07-07', '2021-12-01'),
(109, 'Cloud Security Assessment', '2021-01-20', '2022-07-25'),
(110, 'Network Infrastructure Revamp', '2018-09-12', '2019-11-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employeeprojects`
--
ALTER TABLE `employeeprojects`
  ADD KEY `EmployeeID` (`EmployeeID`),
  ADD KEY `ProjectID` (`ProjectID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employeeprojects`
--
ALTER TABLE `employeeprojects`
  ADD CONSTRAINT `employeeprojects_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`),
  ADD CONSTRAINT `employeeprojects_ibfk_2` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`);
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
(1, 'Monopoly', 'Perry Hall, MD', 'images/monopolyboard.png', 'Buy, sell, dream, and scheme the way to riches with the Monopoly board game! Select a favorite Monopoly token, place it on Go, and roll the dice to own it all! Featuring classic Monopoly gameplay, this favorite family board game is all about buying, selling, and trading properties to win. Chance or Community cards can be a game changer. They can make a player richer--or send someone to Jail! Looking for games for Family Game Night? The Monopoly game is a Family Game Night staple. It’s a fun indoor activity for kids ages 8 and up and a great family gift', 'Family', NULL),
(2, 'Sorry', 'Nottingham, MD', 'images/sorrygame.png', 'Slide, collide and score to win the Sorry! game! Who knows what will happen next as players chase their opponents around the board, trying to get their 3 pawns from start to home first? Will a player draw a card that tells them to move ahead 2 spaces or back 6?', 'Family', NULL),
(3, 'Chess Board', 'Perry Hall, MD', 'images/chessboard.png', 'Desc placeholder', 'Strategy', NULL),
(4, 'CLUE', 'Parkville, MD', 'images/clueboard.png', 'Desc placeholder', 'Mystery', NULL),
(5, 'Monopoly', 'Parkville, MD', 'images/monopolyboard.png', 'Desc placeholder', 'Family', NULL),
(8, 'Monopoly D&D', 'Washington, D.C.', 'images/dndboard.png', 'Desc placeholder', 'Role Playing', NULL),
(9, 'Dungeons And Dragons', 'Nottingham, MD', 'images/dndboard2.png', 'Desc placeholder', 'Role Playing', NULL),
(10, 'The Game of Life', 'Baltimore, MD', 'images/lifegame.png', 'Desc placeholder', 'Family', NULL),
(11, 'Backgammon', 'Silver Spring, MD', 'images/backgammon.png', 'This is an additional description for the game.', 'Strategy', NULL),
(15, 'Candy Land', 'Testing', 'images/candyland.png', 'This is an additional description for the game.', 'Family', 'projecttester'),
(17, 'Checkers', 'Baltimore, Maryland', 'images/checkers.png', 'This is an additional description for the game.', 'Strategy', 'jaysontatoom');

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
(2, '{\"Sorry\": {\"image\": \"images/sorrygame.png\", \"description\": \"Nottingham, MD\"}, \"Monopoly\": {\"image\": \"images/monopolyboard.png\", \"description\": \"Perry Hall, MD\"}}', '2025-05-09 16:04:26'),
(3, '{\"CLUE\": {\"image\": \"images/clueboard.png\", \"description\": \"Parkville, MD\"}, \"Monopoly\": {\"image\": \"images/monopolyboard.png\", \"description\": \"Perry Hall, MD\"}}', '2025-05-09 16:18:53');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Database: `schoolatab`
--
CREATE DATABASE IF NOT EXISTS `schoolatab` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `schoolatab`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(100) NOT NULL,
  `Credits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `CourseName`, `Credits`) VALUES
(101, 'Mathematics', 3),
(102, 'English Literature', 4),
(103, 'Computer Science', 3),
(104, 'History', 3),
(105, 'Physics', 4),
(106, 'Chemistry', 4),
(107, 'Biology', 3),
(108, 'Art', 2),
(109, 'Physical Education', 1),
(110, 'Music', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Email`, `Phone`) VALUES
(1, 'Alice', 'Smith', 'alice.smith@example.com', '555-0101'),
(2, 'Bob', 'Johnson', 'bob.johnson@example.com', '555-0102'),
(3, 'Charlie', 'Williams', 'charlie.williams@example.com', '555-0103'),
(4, 'Diana', 'Jones', 'diana.jones@example.com', '555-0104'),
(5, 'Eve', 'Brown', 'eve.brown@example.com', '555-0105'),
(6, 'Frank', 'Davis', 'frank.davis@example.com', '555-0106'),
(7, 'Grace', 'Miller', 'grace.miller@example.com', '555-0107'),
(8, 'Hank', 'Wilson', 'hank.wilson@example.com', '555-0108'),
(9, 'Ivy', 'Moore', 'ivy.moore@example.com', '555-0109'),
(10, 'Jack', 'Taylor', 'jack.taylor@example.com', '555-0110');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);
--
-- Database: `schooldatab`
--
CREATE DATABASE IF NOT EXISTS `schooldatab` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `schooldatab`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(100) NOT NULL,
  `Credits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `CourseName`, `Credits`) VALUES
(101, 'Mathematics', 3),
(102, 'English Literature', 4),
(103, 'Computer Science', 3),
(104, 'History', 3),
(105, 'Physics', 4),
(106, 'Chemistry', 4),
(107, 'Biology', 3),
(108, 'Art', 2),
(109, 'Physical Education', 1),
(110, 'Music', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Email`, `Phone`) VALUES
(1, 'Alice', 'Smith', 'alice.smith@example.com', '555-0101'),
(2, 'Bob', 'Johnson', 'bob.johnson@example.com', '555-0102'),
(3, 'Charlie', 'Williams', 'charlie.williams@example.com', '555-0103'),
(4, 'Diana', 'Jones', 'diana.jones@example.com', '555-0104'),
(5, 'Eve', 'Brown', 'eve.brown@example.com', '555-0105'),
(6, 'Frank', 'Davis', 'frank.davis@example.com', '555-0106'),
(7, 'Grace', 'Miller', 'grace.miller@example.com', '555-0107'),
(8, 'Hank', 'Wilson', 'hank.wilson@example.com', '555-0108'),
(9, 'Ivy', 'Moore', 'ivy.moore@example.com', '555-0109'),
(10, 'Jack', 'Taylor', 'jack.taylor@example.com', '555-0110');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);
--
-- Database: `schooldb`
--
CREATE DATABASE IF NOT EXISTS `schooldb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `schooldb`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(100) NOT NULL,
  `Credits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `CourseName`, `Credits`) VALUES
(101, 'Mathematics', 3),
(102, 'English Literature', 4),
(103, 'Computer Science', 3),
(104, 'History', 3),
(105, 'Physics', 4),
(106, 'Chemistry', 4),
(107, 'Biology', 3),
(108, 'Art', 2),
(109, 'Physical Education', 1),
(110, 'Music', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Email`, `Phone`) VALUES
(1, 'Alice', 'Smith', 'alice.smith@example.com', '555-0101'),
(2, 'Bob', 'Johnson', 'bob.johnson@example.com', '555-0102'),
(3, 'Charlie', 'Williams', 'charlie.williams@example.com', '555-0103'),
(4, 'Diana', 'Jones', 'diana.jones@example.com', '555-0104'),
(5, 'Eve', 'Brown', 'eve.brown@example.com', '555-0105'),
(6, 'Frank', 'Davis', 'frank.davis@example.com', '555-0106'),
(7, 'Grace', 'Miller', 'grace.miller@example.com', '555-0107'),
(8, 'Hank', 'Wilson', 'hank.wilson@example.com', '555-0108'),
(9, 'Ivy', 'Moore', 'ivy.moore@example.com', '555-0109'),
(10, 'Jack', 'Taylor', 'jack.taylor@example.com', '555-0110');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);
--
-- Database: `testdb`
--
CREATE DATABASE IF NOT EXISTS `testdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `testdb`;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `age`) VALUES
(1, 'John', 21),
(2, 'Jane', 22),
(3, 'David', 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
(3, 'projecttester', 'East Orange', 'New Jersey', 'Sorry', 'Would not recommend; didn\'t have all the pieces, 1/10', '2025-05-05 01:00:16');

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
(4, 'dajoh99', 'dajoh99@morgan.edu', '$2y$10$4xKVAcOwhIvNBsFS83M5L.QMA3ueJBoccGY3WQC6IHr4xhKP/DAeq', '8200 Featherhill Road', 'Perry Hall', 'Maryland', '2025-04-16 02:47:43'),
(5, 'kyrie', 'knowles@tidal.com', '$2y$10$2a4jxXyAhXWlgBkeaimo5uIj.DJ22kGOavBiGjJVBUPz0yflIEbGG', '35 Winans St', 'East Orange', 'New Jersey', '2025-04-16 02:53:52'),
(6, 'micheal', 'mbj@gmail.com', '$2y$10$3oV7D5zGIWRxV7XHHa9RUOlDCT1mLxHLWfl77qT8jM3aqG.r8Uzki', '550 Dr Martin Luther King Jr Blvd', 'Newark', 'New Jersey', '2025-04-16 02:54:50'),
(7, 'testuser5', 'test5@example.com', '$2y$10$CMyHHk5sOkH.iRds0c7RpODmWH.AACOVrY4epXJnb.DOrEVLvGW0K', 'we\'re gonna come back to this', 'Sacremento', 'California', '2025-04-16 02:56:09'),
(8, 'testuser6', 'test6@example.com', '$2y$10$z0WMqHaqcHSq3a.argq2.eaQYqRIIUhBRU2VPeDM5gvuuscCvoYx2', 'Im running out of valid addresses', 'Miami', 'Florida', '2025-04-16 02:58:40'),
(10, 'testmorgan', 'testuser@morgan.edu', '$2y$10$ci1XQFyZIDQBa7MYkp6nAOolchnWp.QWYUEMXf2Vbi8GP/l8zh0UO', '1700 E Cold Spring Ln', 'Baltimore', 'Maryland', '2025-04-16 03:06:30'),
(11, 'juicewrld', 'jarad999@gmail.com', '$2y$10$ofc/BU4NO2nvT6CxsYVHnerPovhNM/7pfMI2pdVVs23zxBLW0sQh.', '4757 White Oak Ave', 'Encino', 'California', '2025-04-16 03:07:20'),
(12, 'mickeymouse', 'mickster@disney.com', '$2y$10$3bgP6OR8c21zFldy2xwgfe1DVtMWZQQAupa.Wl8zLWIIkoYJihxBq', '1180 Seven Seas Dr', 'Orlando', 'Florida', '2025-04-26 01:28:58'),
(13, 'projecttester', 'testinguser@gmail.com', '$2y$10$/OIk05LBw4.OPjahj8Szm.eQ0ccmkeV5OBDLSU.IPZZhepogQFB8y', '485 North Grove Street', 'Newark', 'New Jersey', '2025-05-04 17:02:58'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
