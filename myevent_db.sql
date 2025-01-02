-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2025 at 09:15 AM
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
-- Database: `myevent_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events_request`
--

CREATE TABLE `tbl_events_request` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `days` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_events_request`
--

INSERT INTO `tbl_events_request` (`id`, `title`, `description`, `location`, `type`, `date_from`, `date_to`, `days`, `created_at`) VALUES
(2, 'KL Tech Conference 2025', 'Tech trends and innovations in Malaysia', 'Kuala Lumpur', 'Conference', '2025-01-02', '2025-01-04', 3, '2025-01-01 18:32:51'),
(3, 'Penang Art Workshop', 'Hands-on art and painting', 'George Town, Penang', 'Workshop', '2025-02-04', '2025-02-19', 16, '2025-01-01 18:33:50'),
(4, 'Health Seminar Malaysia', 'Updates on public health in Malaysia', 'Putrajaya', 'Seminar', '2025-04-03', '2025-04-06', 4, '2025-01-01 18:34:36'),
(5, 'Business Forum Johor', 'Business networking opportunities', 'Johor Bahru', 'Conference', '2025-02-06', '2025-02-07', 2, '2025-01-01 18:35:50'),
(6, 'Malacca Culinary Workshop', 'Traditional Malaysian cooking', 'Malacca', 'Workshop', '2025-01-26', '2025-01-31', 6, '2025-01-01 18:36:33'),
(7, 'Science Seminar Kuching', 'STEM updates for Sarawak professionals', 'Kuching, Sarawak', 'Seminar', '2025-01-03', '2025-01-04', 2, '2025-01-01 18:37:43'),
(8, 'Sabah Eco Conference', 'Environmental conservation insights', 'Kota Kinabalu, Sabah', 'Conference', '2025-03-02', '2025-03-08', 7, '2025-01-01 18:38:47'),
(9, 'KL Dance Workshop', 'Modern dance training', 'Kuala Lumpur', 'Workshop', '2025-04-10', '2025-04-19', 10, '2025-01-01 18:42:48'),
(10, 'Finance Seminar Penang', 'Personal finance and investment tips', 'George Town, Penang', 'Seminar', '2025-05-02', '2025-05-08', 7, '2025-01-01 18:44:20'),
(11, 'AI & Robotics Conference', 'Future of AI in Malaysia', 'Cyberjaya', 'Conference', '2025-01-21', '2025-01-22', 2, '2025-01-01 18:45:27'),
(12, 'Writing Workshop KL', 'Advanced creative writing techniques', 'Kuala Lumpur', 'Workshop', '2025-02-01', '2025-02-23', 23, '2025-01-01 18:46:06'),
(13, 'Marketing Seminar Melaka', 'Digital marketing strategies', 'Malacca', 'Seminar', '2025-01-06', '2025-01-22', 17, '2025-01-01 18:46:54'),
(14, 'Leadership Forum KL', 'Executive leadership development', 'Kuala Lumpur', 'Conference', '2025-03-12', '2025-04-01', 21, '2025-01-01 18:47:30'),
(15, 'Photography Workshop', 'Mastering photography skills', 'Kota Kinabalu, Sabah', 'Workshop', '2025-05-21', '2025-06-02', 13, '2025-01-02 06:49:05'),
(16, 'Wellness Seminar Selangor', 'Mental health and wellness awareness', 'Petaling Jaya', 'Seminar', '2025-02-04', '2025-02-06', 3, '2025-01-02 06:52:44'),
(17, 'Retail Innovation Forum', 'Retail trends and tech innovations', 'Johor Bahru', 'Conference', '2025-03-11', '2025-03-13', 3, '2025-01-02 06:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `fullname`, `email`, `password`, `created_at`) VALUES
(1, 'Fakhrul', 'mhakimy4@gmail.com', '$2y$10$rkXTCES0ZbpE8ltc3eutNura8E1I61nBJNjvNvdDPIn6lSFtJyJXm', '2025-01-01 17:34:30'),
(2, '1', 'arif@gmail.com', '$2y$10$MejfAgXnd72zQqfRMSKzMepRCH7.coB8quNQH7tHTqol8AVvDnvLm', '2025-01-01 17:37:30'),
(4, 'Fakhrul', 'mhakimy@gmail.com', '$2y$10$9p2M6.7utNFFGUa8cD2UC.U.jNMn5ICOIqqw5FpYCnJahlXJUcIbi', '2025-01-01 17:39:14'),
(6, 'arif', 'arifhakimi0528@gmail.com', '$2y$10$fH39cWk9ooy4fxusc.kIrOe3Ebl4T2cw6REx5xLweqB6GwKZipsXG', '2025-01-02 07:44:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_events_request`
--
ALTER TABLE `tbl_events_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_events_request`
--
ALTER TABLE `tbl_events_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
