-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 03:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookclubmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `description`, `author`) VALUES
(1, 'The Hunger Games', 'The Hunger Games is a 2008 dystopian young adult novel by the American writer Suzanne Collins. It is written in the perspective of 16-year-old Katniss Everdeen, who lives in the future, post-apocalyptic nation of Panem in North America.', 'Suzanne Collins'),
(2, 'Hunger Games: Catching Fire', 'Catching Fire is a 2009 dystopian young adult fiction novel by the American novelist Suzanne Collins, the second book in The Hunger Games series. As the sequel to the 2008 bestseller The Hunger Games, it continues the story of a now 17 year old Katniss Ev', 'Suzanne Collins'),
(3, 'Hunger Games: Mockingjay', 'Mockingjay is a 2010 dystopian young adult fiction novel by American author Suzanne Collins. It is chronologically the last installment of The Hunger Games series, following 2008\'s The Hunger Games and 2009\'s Catching Fire.', 'Suzanne Collins');

-- --------------------------------------------------------

--
-- Table structure for table `book_clubs`
--

CREATE TABLE `book_clubs` (
  `club_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_clubs`
--

INSERT INTO `book_clubs` (`club_id`, `name`, `description`, `contact_email`) VALUES
(1, 'Hunger Games Lovers', 'Here at the \'Hunger Games Lovers\' we read, watch and discuss all things Hunger Games. Everyone has to bring a snack, contact the email provided to join!!', 'SuzanneCollins@gmail.com'),
(2, 'Book > Movie', 'Here at \'Book > Movie\' we discuss and debate whether our favorite series have a better book or movie! If you love popular series like \'Maze Runner\' or \'Harry Potter\', you will love our club!', 'HarrisonPottery@gmail.com'),
(3, ' The Page Turners Society', 'A lively group of book enthusiasts who meet monthly to discuss a mix of genres, from thrilling mysteries to heartwarming romances. Whether you\'re a casual reader or a literary critic, there\'s always a seat for you in our circle.', 'pageturnersclub@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `club_features`
--

CREATE TABLE `club_features` (
  `element_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club_features`
--

INSERT INTO `club_features` (`element_id`, `book_id`, `club_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `first_name`, `last_name`, `account_type`, `password`) VALUES
(1, 'bookreader101', 'TylerLuvsBooks@gmail.com', 'Tyler', 'White', 'Admin', ''),
(2, 'IEatFruitsnacks', 'Fruitsnacklover@gmail.com', 'Greggory', 'Washington', 'basic', ''),
(3, 'greggorystinks', 'GreggoryStinks@gmail.com', 'Gretchery', 'Washington', 'basic', ''),
(4, 'csking', 'csking@gmail.com', 'chris', 'king', 'basic', '$2y$10$ZpReorgQiCiPnJLeXIpeZeM0FtRls18zG//3qOCvCCh/.SuJZGTuy'),
(5, 'admin2', 'admin@gmail.com', 'ad', 'min', 'Admin', '$2y$10$sXR2smCMtF7203GpvGNGg.mpvDZjSn2PsU36HNOlpBGovK7j1oKVe'),
(6, 'caporusson1', 'caporusson1@gmail.com', 'Dr.', 'Caporusso', 'basic', '$2y$10$3eBYU9VI8odDAQl/3POkVO8WXY0x.aq9BN4G1SWMrHdeph.5jRPvO'),
(7, 'administrator', 'admin1@gmail.com', 'Admin', 'Istrator', 'Admin', '$2y$10$zct4FZeShgHYX5C838tYiOaKpI1xT8ZSQjP.mt5esAitC75mBqh9K');

-- --------------------------------------------------------

--
-- Table structure for table `user_books`
--

CREATE TABLE `user_books` (
  `element_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_books`
--

INSERT INTO `user_books` (`element_id`, `user_id`, `book_id`) VALUES
(1, 1, 2),
(2, 3, 2),
(3, 2, 3),
(20, 3, 3),
(36, 4, 1),
(37, 4, 2),
(38, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_clubs`
--

CREATE TABLE `user_clubs` (
  `element_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_clubs`
--

INSERT INTO `user_clubs` (`element_id`, `user_id`, `club_id`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 2, 1),
(31, 3, 1),
(32, 3, 2),
(36, 3, 3),
(51, 4, 3),
(52, 4, 2),
(53, 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_clubs`
--
ALTER TABLE `book_clubs`
  ADD PRIMARY KEY (`club_id`),
  ADD UNIQUE KEY `contact_email` (`contact_email`);

--
-- Indexes for table `club_features`
--
ALTER TABLE `club_features`
  ADD PRIMARY KEY (`element_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_books`
--
ALTER TABLE `user_books`
  ADD PRIMARY KEY (`element_id`),
  ADD KEY `fk_user_books_user_id` (`user_id`),
  ADD KEY `fk_user_books_book_id` (`book_id`);

--
-- Indexes for table `user_clubs`
--
ALTER TABLE `user_clubs`
  ADD PRIMARY KEY (`element_id`),
  ADD KEY `fk_user_clubs_user_id` (`user_id`),
  ADD KEY `fk_user_clubs_club_id` (`club_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book_clubs`
--
ALTER TABLE `book_clubs`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `club_features`
--
ALTER TABLE `club_features`
  MODIFY `element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_books`
--
ALTER TABLE `user_books`
  MODIFY `element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_clubs`
--
ALTER TABLE `user_clubs`
  MODIFY `element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `club_features`
--
ALTER TABLE `club_features`
  ADD CONSTRAINT `club_features_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `club_features_ibfk_2` FOREIGN KEY (`club_id`) REFERENCES `book_clubs` (`club_id`);

--
-- Constraints for table `user_books`
--
ALTER TABLE `user_books`
  ADD CONSTRAINT `fk_user_books_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_books_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_clubs`
--
ALTER TABLE `user_clubs`
  ADD CONSTRAINT `fk_user_clubs_club_id` FOREIGN KEY (`club_id`) REFERENCES `book_clubs` (`club_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_clubs_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
