-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 01:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogging-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `images` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `category`, `images`, `content`) VALUES
(3, 'Latest in Clothing\n', 'Clothes', 'images/demo/cloths1.jpg', 'Explore the newest fashion trends and styles for every season. From casual wear to formal attire, we\'ve got you covered.'),
(10, 'Sports Gear\n', 'Sports', 'images/demo/sports1.jpg', 'Discover the best in sports equipment and gear to elevate your game. Whether you\'re into football, tennis, or basketball, find the essentials here.'),
(14, 'Electronics', 'Electronics', 'images/demo/electronics1.jpg', 'Stay up-to-date with the latest gadgets and electronics. From smartphones to laptops, find tech reviews and recommendations.'),
(17, 'Books for All\n', 'Books', 'images/demo/books1.jpg', 'Whether you\'re a fiction lover or a non-fiction enthusiast, find book reviews and recommendations on all genres and authors.\n\n'),
(21, 'Furniture Trends\n', 'Furniture', 'images/demo/furniture1.jpg', 'From modern designs to classic looks, explore the latest trends in home and office furniture that suit your space and style.\n\n'),
(24, 'Accessories', 'Accessories', 'images/demo/accsessories1.jpg', 'Accessorize your life with the latest in fashion, tech, and home decor. Find the perfect items to complement your look and lifestyle.\n\n'),
(37, 'Manjot\'s First Post', 'books', 'uploads/1728541462.jpeg', '<p>I\'ve spent so much time builiding this project.......i hope everyone likes it</p>'),
(39, 'afdba', 'furniture', 'uploads/1728557753.jpeg', '<p>arbr</p>'),
(40, 'anujj', 'books', 'uploads/1728557966.jpg', '<p>arhgrbrea</p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
