-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 11:52 AM
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
  `username` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `images` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `username`, `title`, `category`, `images`, `content`, `status`) VALUES
(3, 'Manjot Singh', 'Latest in Clothing\n', 'Clothes', 'images/demo/cloths1.jpg', 'Explore the newest fashion trends and styles for every season. From casual wear to formal attire, we\'ve got you covered.', 1),
(10, 'Manjot Singh', 'Sports Gear\n', 'Sports', 'images/demo/sports1.jpg', 'Discover the best in sports equipment and gear to elevate your game. Whether you\'re into football, tennis, basketball, or any other sport, you\'ll find all the essentials you need right here. From high-performance shoes that give you the perfect grip and support, to durable apparel designed to keep you comfortable and cool, we offer a wide range of products tailored to every athlete\'s needs. Explore a vast selection of cutting-edge technology, including innovative equipment that enhances your performance, improves your training, and takes your game to the next level. Whether you\'re a beginner, a seasoned athlete, or somewhere in between, you\'ll find everything from protective gear and accessories to professional-grade equipment trusted by champions. No matter your sport, no matter your skill level, we have the perfect gear to help you perform at your best, stay safe, and enjoy the thrill of the game with confidence. Dive into our collection and start gearing up today!', 1),
(14, 'Manjot Singh', 'Electronics', 'Electronics', 'images/demo/electronics1.jpg', 'Stay up-to-date with the latest gadgets and electronics. From smartphones to laptops, find tech reviews and recommendations.', 1),
(17, 'Manjot Singh', 'Books for All\n', 'Books', 'images/demo/books1.jpg', 'Whether you\'re a fiction lover or a non-fiction enthusiast, find book reviews and recommendations on all genres and authors.\n\n', 1),
(21, 'Manjot Singh', 'Furniture Trends\n', 'Furniture', 'images/demo/furniture1.jpg', 'From modern designs to classic looks, explore the latest trends in home and office furniture that suit your space and style.\n\n', 1),
(24, '', 'Accessories', 'Accessories', 'images/demo/accsessories1.jpg', 'Accessorize your life with the latest in fashion, tech, and home decor. Find the perfect items to complement your look and lifestyle.\n\n', 1),
(54, 'Manjot Singh', '2024’s Hottest Streetwear Trends', 'clothes', 'uploads/1729241741.jpg', '<p>Streetwear has evolved from urban subculture to a global fashion phenomenon, and 2024 is shaping up to be its boldest year yet. Oversized jackets, graphic tees, and utility pants are dominating the streets. Vibrant color palettes and unconventional patterns are taking over, while collaborations between high fashion brands and streetwear labels continue to thrive. Sneakers remain a key staple, with retro designs making a big comeback. Streetwear now isn&rsquo;t just about style; it&rsquo;s also about making a statement, blending comfort with individuality, and reflecting the wearer&rsquo;s personal expression.</p>', 1),
(55, 'Manjot Singh', 'Wardrobe Essentials', 'clothes', 'uploads/1729242009.jpg', '<p>While trends come and go, some wardrobe staples remain timeless. A well-fitted pair of jeans, a classic white shirt, and a little black dress are must-haves for any closet. These pieces provide versatility, allowing women to dress up or down for any occasion. A neutral blazer and a leather jacket are also great investments, offering a polished look. Accessories like scarves, belts, and quality handbags can elevate any outfit. Investing in high-quality basics ensures longevity, giving women a solid foundation to build on with seasonal trends.</p>', 1),
(56, 'Manjot Singh', 'Athleisure', 'clothes', 'uploads/1729242181.jpg', '<p>Athleisure has become a fashion revolution, seamlessly blending athletic wear with everyday clothing. What began as a fitness trend has now infiltrated every corner of fashion, with leggings, joggers, and stylish hoodies becoming wardrobe essentials. The rise of this trend speaks to the desire for comfort without compromising on style. Whether you\'re heading to the gym or brunch, athleisure provides a versatile, functional outfit. The trend shows no signs of slowing down, as designers continue to innovate with performance fabrics that work for both the treadmill and the city streets.</p>\r\n<p>&nbsp;</p>', 1),
(57, 'Manjot Singh', 'Fast Fashion vs. Slow Fashion', 'clothes', 'uploads/1729242360.jpg', '<p>In today&rsquo;s fashion world, consumers are faced with the choice between fast fashion and slow fashion. Fast fashion offers affordable, trend-driven clothing at the expense of environmental sustainability. Brands produce garments quickly to meet demand, but this often leads to poor working conditions and textile waste. On the other hand, slow fashion emphasizes quality, sustainability, and ethical production. Consumers are encouraged to invest in timeless pieces made from sustainable materials. Choosing slow fashion helps reduce environmental impact and supports fair labor practices, promoting a more thoughtful approach to clothing consumption.</p>\r\n<p>&nbsp;</p>', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
