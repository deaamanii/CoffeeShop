-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 28, 2025 at 08:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee_bean`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_by`, `created_at`) VALUES
(1, 'Espresso', 'Rich and bold espresso', 1.20, 'images/Espresso.jpg', 1, '2025-01-28 13:44:38'),
(2, 'Americano', 'A simple espresso diluted with hot water', 1.50, 'images/americano.jpg', 1, '2025-01-28 13:44:38'),
(3, 'Cappuccino', 'A perfect mix of espresso and steamed milk', 2.00, 'images/cappuccino.jpg', 1, '2025-01-28 13:44:38'),
(4, 'Mocha', 'A shot of espresso is combined with chocolate powder', 2.80, 'images/mocha.jpg', 1, '2025-01-28 18:34:46'),
(5, 'Turkish Coffee', 'Finely ground coffee with a bittersweet taste', 2.50, 'images/turkish-coffee.jpg', 1, '2025-01-28 18:34:46'),
(6, 'Cafe de Olla', 'Mexican coffee spiced with cinnamon cloves, star anise, and sweetened with piloncillo', 4.60, 'images/cafe-de-olla.webp', 1, '2025-01-28 18:34:46'),
(7, 'Kentucky Coffee', 'Very earthy and rich and somewhat similar to black coffee', 5.80, 'images/Kentucky Coffee.jpg', 1, '2025-01-28 18:34:46'),
(8, 'Cortado', 'A Spanish beverage consisting of espresso with warm milk', 4.20, 'images/cortado.jpg', 1, '2025-01-28 18:34:46'),
(9, 'Ristretto', 'A short shot of espresso made with finely ground beans and less water', 2.00, 'images/ristretto.jpg', 1, '2025-01-28 18:34:46'),
(10, 'Café Bombon', 'Made with a shot of espresso and roughly equal amount of sweetened condensed milk', 2.00, 'images/bombon.jpg', 1, '2025-01-28 18:34:46'),
(11, 'Vanilla Tea Latte', 'It calls for real, healthy ingredients', 3.80, 'images/Vanilla Tea Latte.jpg', 1, '2025-01-28 18:34:46'),
(12, 'Affogato', 'A big scoop of vanilla ice cream with a hot espresso shot', 5.50, 'images/affogato-coffee.jpg', 1, '2025-01-28 18:34:46'),
(13, 'Black Coffee', 'Normally brewed without additives such as sugar', 2.00, 'images/black-coffee.jpg', 1, '2025-01-28 18:34:46'),
(14, 'Irish Coffee', 'A caffeinated alcoholic drink consisting of Irish whiskey', 6.00, 'images/irish-coffee.jpg', 1, '2025-01-28 18:34:46'),
(15, 'Iced Mocha Frappuccino', 'A cold coffee drink flavored with chocolate', 4.50, 'images/Iced Mocha Frappuccino.jpg', 1, '2025-01-28 18:34:46'),
(16, 'Iced Coffee', 'A cold version of your favorite coffee', 3.50, 'images/iced-coffee.jpg', 1, '2025-01-28 18:34:46'),
(17, 'Latte', 'Milk coffee that boasts a silky layer of foam', 2.80, 'images/latte.jpg', 1, '2025-01-28 18:34:46'),
(18, 'Nitro Cold Brew', 'Infused with nitrogen gas similar to a Guinness stout beer', 4.80, 'images/nitrocoldbrew.jpg', 1, '2025-01-28 18:34:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
