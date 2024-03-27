-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 01:21 AM
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
-- Database: `syllabus`
--

-- --------------------------------------------------------

--
-- Table structure for table `course_syllabus`
--

CREATE TABLE `course_syllabus` (
  `id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_tittle` varchar(255) NOT NULL,
  `course_type` varchar(255) NOT NULL,
  `course_credit` varchar(255) NOT NULL,
  `learning_modality` varchar(255) NOT NULL,
  `pre_requisit` varchar(255) NOT NULL,
  `co_pre_requisit` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `consultation_hours` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_syllabus`
--
ALTER TABLE `course_syllabus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_syllabus`
--
ALTER TABLE `course_syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
