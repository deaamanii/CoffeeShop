-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 24, 2025 at 06:06 PM
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
-- Database: `coffee_bean`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Dea', 'deamani@gmail.com', '$2y$10$tLQSMAulVXk7nh1WjbS6de3S79s3Wm4F8as.JI/zAVLjsZvcjYoKm', 'admin', '2025-01-24 15:46:00'),
(2, 'Jona', 'jona@gmail.com', '$2y$10$UTyXh1jrwpPyWxo7cmGGXu069/HNOGW8GzFHQxOh9Ijlp8K.SfiYq', 'user', '2025-01-24 15:46:45'),
(3, 'Ron', 'ronmani@gmail.com', '$2y$10$qAs7ohT2I7qgO0dnf0VYq.dsaiXLIW.G1VWTcZPPh0i67N.WceZrG', 'user', '2025-01-24 15:49:42'),
(4, 'Rina', 'rina@gmail.com', '$2y$10$OmfgEB7mxVhK9cgasfCbqO3v8X277rADygpjHWVSsPheoZ8Sg8XyS', 'user', '2025-01-24 16:17:36'),
(5, 'Jon', 'jon@gmail.com', '$2y$10$XsO46S562rrWBafH7ONk3e2EyePxkVW4./.cH4FDAuScGU9/hXy96', 'user', '2025-01-24 16:19:28'),
(6, 'Olsa', 'olsabytyqi@gmail.com', '$2y$10$4zj5yIVssWAuytTBVI3I4uGhxATN2NjLzdU.8IYnOEVOQKU97/snO', 'user', '2025-01-24 16:20:29'),
(7, 'Riga ', 'rigakorqa@gmail.com', '$2y$10$UMwcbRRgq0aNisv3q0A4qOeGZtFxooiGYMNuJGjQa/ySG7SM0TxJW', 'user', '2025-01-24 16:23:42'),
(8, 'Rineta', 'rineta@gmail.com', '$2y$10$cf3Qdqu6.YFEFeFRTfbfM.frYJDsfdqUwxfH1vm3sgmX.KME7YK0G', 'user', '2025-01-24 16:25:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
