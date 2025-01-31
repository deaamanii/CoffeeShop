-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 31, 2025 at 07:45 PM
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
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `name`, `email`, `message`, `submission_date`) VALUES
(1, 'Marigona', 'gona@gmail.com', 'I want to know do you have any other location open?', '2025-01-31 17:23:35'),
(2, 'Rina', 'rina@gmail.com', 'Do you offer part-time jobs for students?', '2025-01-31 17:46:00'),
(3, 'lisi', 'lisi@gmail.com', 'Will you have an opening for a job competition soon?\r\n', '2025-01-31 17:49:37'),
(12, 'olsa', 'olsabytyciii@gmail.com', 'I am particularly interested in learning more about your specialty blends and whether you provide any wholesale or bulk purchasing options.', '2025-01-31 18:17:24'),
(13, 'Drini', 'drin@gmail.com', 'Do you offer any loyalty programs or promotions for frequent customers.', '2025-01-31 18:19:00'),
(14, 'Ron', 'ronmani@gmail.com', 'I am a big fan of your coffee and would love to know if you currently offer any discounts or special offers.\r\n\r\n\r\n', '2025-01-31 18:23:59'),
(15, 'Ron', 'ronmani@gmail.com', 'I am a big fan of your coffee and would love to know if you currently offer any discounts or special offers.\r\n\r\n\r\n', '2025-01-31 18:28:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
