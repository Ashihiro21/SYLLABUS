-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 05:25 AM
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
-- Database: `syllabus`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, 'College of Business Administration and Accountancy'),
(3, 'College of Criminal Justice Education'),
(4, 'College of Education'),
(5, 'College of Engineering, Architecture and Technology'),
(6, 'College of Liberal Arts and Communication'),
(7, 'College of Science and Computer Studies'),
(8, 'College of Tourism and Hospitality Management');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `cname` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `catid`, `cname`) VALUES
(5, 2, 'Bachelor of Science in Accountancy'),
(6, 2, 'Bachelor of Science in Management Accounting'),
(7, 2, 'Bachelor of Science in Entrepreneurship with Specialization in Food Entrepreneurship'),
(8, 2, 'Bachelor of Science in Entrepreneurship with Specialization in Agripreneurship'),
(9, 2, 'Bachelor of Science Business Administration Major in Business and Operations Management with Specialization Track in Business Analytics'),
(10, 2, 'Business Administration Major in Bachelor of Science Business Economics'),
(11, 2, 'Bachelor of Science in Business Administration Major in Human Resource Development with Specialization Track in Business Analytics'),
(12, 2, 'Bachelor of Science in Business Administration Major in Marketing Management with Specialization in Business Analytics'),
(13, 2, 'Bachelor of Science in Business Administration major in Marketing Management with Specialization in Integrated Marketing Communications'),
(14, 3, 'BS in Criminology'),
(15, 3, 'Bachelor of Forensic Science'),
(16, 4, 'Bachelor of Early Childhood Education'),
(17, 4, 'Bachelor of Special Needs Education'),
(18, 4, 'Bachelor of Secondary Education'),
(19, 4, 'Certificate in Teaching Program'),
(20, 4, 'Certificate in Teaching Values Education'),
(21, 4, 'Certificate in Sign Language'),
(22, 4, 'Certificate in Teaching Early Childhood Learners'),
(23, 5, 'Bachelor of Science in Architecture'),
(24, 5, 'Bachelor of Science in Civil Engineering\r\n'),
(25, 5, 'Bachelor of Science in Computer Engineering\r\n'),
(26, 5, 'Bachelor of Science in Electrical Engineering\r\n'),
(27, 5, 'Bachelor of Science in Electronics Engineering\r\n'),
(28, 5, 'Bachelor of Science in Industrial Engineering\r\n'),
(29, 5, 'Bachelor of Science in Mechanical Engineering\r\n'),
(30, 5, 'Bachelor of Multimedia Arts'),
(31, 6, 'Bachelor of Arts in Communication\r\n\r\n'),
(32, 6, 'Bachelor of Arts in Digital and Multimedia Journalism\r\n'),
(33, 6, 'Bachelor of Arts in Political Science\r\n'),
(34, 6, 'Bachelor of Arts in International Development\r\n'),
(35, 6, 'Bachelor of Arts in Psychology\r\n'),
(36, 6, 'Bachelor of Science in Psychology'),
(37, 7, 'Bachelor of Science in Biology with specialization in Medical Biology (3 year compressed program)\r\n'),
(38, 7, 'Bachelor of Science in Biology with specialization in Medical Biology'),
(39, 7, 'Bachelor of Science in Biology with specialization in Microbiology'),
(40, 7, 'Bachelor of Science in Biology with specialization in Cell and Molecular Biology'),
(41, 7, 'Bachelor of Science in Biology with specialization in Plant Biology'),
(42, 7, 'Bachelor of Science in Biology with specialization in Animal Biology'),
(43, 7, 'Bachelor of Science in Biology with specialization in Environmental Science'),
(44, 7, 'Bachelor of Science in Applied Mathematics'),
(45, 7, 'Bachelor of Science in Computer Science'),
(46, 7, 'Bachelor of Science in Information Technology'),
(47, 8, 'Bachelor of Science Hospitality Management\r\n'),
(48, 8, 'Bachelor of Science in in Tourism Management');

-- --------------------------------------------------------

--
-- Table structure for table `course_description`
--

CREATE TABLE `course_description` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_description`
--

INSERT INTO `course_description` (`id`, `description`) VALUES
(1, 'This course prepares the students to acquire the skills on creating, analyzing, and designing databases. This will help increase their understanding of the essentials of database modelling and design, the languages and facilities provided by the database ');

-- --------------------------------------------------------

--
-- Table structure for table `course_leaning`
--

CREATE TABLE `course_leaning` (
  `id` int(11) NOT NULL,
  `comlab` varchar(255) NOT NULL,
  `learn_out` varchar(255) NOT NULL,
  `topic_learn_out` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_leaning`
--

INSERT INTO `course_leaning` (`id`, `comlab`, `learn_out`, `topic_learn_out`) VALUES
(1, 'CLO1', 'Understand data models, schemas, instances, and their applications in the real world', 'TLO1. Effectively explains the basic concepts of databases and data models. ');

-- --------------------------------------------------------

--
-- Table structure for table `course_syllabus`
--

CREATE TABLE `course_syllabus` (
  `id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_tittle` varchar(255) NOT NULL,
  `course_Type` varchar(255) NOT NULL,
  `course_credit` varchar(255) NOT NULL,
  `learning_modality` varchar(255) NOT NULL,
  `pre_requisit` varchar(255) NOT NULL,
  `co_pre_requisit` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `consultation_hours_date` varchar(255) NOT NULL,
  `consultation_hours_room` varchar(255) NOT NULL,
  `consultation_hours_email` varchar(255) NOT NULL,
  `consultation_hours_number` varchar(255) NOT NULL,
  `course_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_syllabus`
--

INSERT INTO `course_syllabus` (`id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`) VALUES
(1, 'S-ITPC 121', 'Fundamentals of Database Systems', 'Laboratory', '3 Units', 'Fully Onsite', 'None', 'S-ITPC 121LA', 'Ms. Azenith R. Mojica', 'Monday and Tuesday 2:00-5:00', 'COS 100-C', 'armojica@dlsud.edu.ph', '(046) 4811900 local 3134', 'This course prepares the students to acquire the skills on creating, analyzing, and designing databases. This will help increase their understanding of the essentials of database modelling and design, the languages and facilities provided by the database');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `name`) VALUES
(1, 'Department Chair'),
(2, 'Faculty'),
(3, 'Dean');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `courses` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` enum('faculty','curriculum_committee','department_chair','dean') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `department`, `courses`, `phone_number`, `email`, `password`, `position`) VALUES
(1, 'Louise', 'Garcia', '2', 'Bachelor of Science in Accountancy', '09505934815', 'louise_garcia@gmail.com', '$2y$10$p.f0LU3w1ddJEhrctwcTMuBaniY/UnK9qcwpjDmPB8o0ETszsf2YG', 'faculty'),
(2, 'Louise', 'Garcia', '2', 'Bachelor of Science in Accountancy', '09505934815', 'louise_garcia@gmail.com', '$2y$10$YUNF8YdXumbZSyr2DJVIquz131xh0xUPy.xTvRX4E7cfPxExU3F0C', 'faculty'),
(3, 'Louise', 'Garcia', '2', 'Bachelor of Science in Accountancy', '09505934815', 'louise_garcia@gmail.com', '$2y$10$xfmeCQM9IfbPXNwXHO30Ou.p5cujUodMgq8L/4DY1ODhPT9DA6cbm', 'faculty'),
(5, 'Elexis                         ', 'Falceso       ', '3', 'BS in Criminology', '09505934815', 'elexis.falceso.dit.cvsu@gmail.com', '$2y$10$giwY74OfTynhkm6YtCJ4guMwVzjJck/9yA6RmTZBfDyVY3Oq4Mvmi', 'faculty'),
(6, 'Elexis', 'Falceso', '3', 'BS in Criminology', '09505934815', 'elexis.falceso@cvsu.edu.ph', '$2y$10$R5C8CVDUvI.Y5yA1xmpP7OsheuxCf4tIp2Th8u93boAb/tZ.cMwzm', 'curriculum_committee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_description`
--
ALTER TABLE `course_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_leaning`
--
ALTER TABLE `course_leaning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_syllabus`
--
ALTER TABLE `course_syllabus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `course_description`
--
ALTER TABLE `course_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_leaning`
--
ALTER TABLE `course_leaning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_syllabus`
--
ALTER TABLE `course_syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
