-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 05:57 AM
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
  `name` varchar(255) DEFAULT NULL
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
(5, 'CLO1', 'Understand data models, schemas, instances, and their applications in the real world', 'TLO1. Effectively explains the basic concepts of databases and data models. \r\n\r\n\r\nTLO2.Explains the features of database management systems, architecture of database systems, and the role of database users. '),
(6, 'CLO2', 'Design effective database schemas using Entity Relationship Diagram (ERD). ', 'TLO4. State reasons why many system developers believe that data modeling is the most important part of the systems development process');

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
(1, 'S-ITPC 121', 'Fundamentals of Database Systems', 'Laboratory', '3 Units', 'Fully Onsite', 'None', 'S-ITPC 121LA', 'Ms. Azenith R. Mojica', 'Monday and Tuesday 2:00-5:00', 'COS 100-C', '(046) 4811900 local 3134', 'armojica@dlsud.edu.ph', 'This course prepares the students to acquire the skills on creating, analyzing, and designing databases. This will help increase their understanding of the essentials of database modelling and design, the languages and facilities provided by the database');

-- --------------------------------------------------------

--
-- Table structure for table `decriptors`
--

CREATE TABLE `decriptors` (
  `id` int(11) NOT NULL,
  `program_learn` varchar(255) NOT NULL,
  `rate1` varchar(255) NOT NULL,
  `rate2` varchar(255) NOT NULL,
  `rate3` varchar(255) NOT NULL,
  `rate4` varchar(255) NOT NULL,
  `rate5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `decriptors`
--

INSERT INTO `decriptors` (`id`, `program_learn`, `rate1`, `rate2`, `rate3`, `rate4`, `rate5`) VALUES
(1, '1. Apply concepts of computing in different domains of \r\ninformation technology.', '', '', '', '/', '/');

-- --------------------------------------------------------

--
-- Table structure for table `laerning_final`
--

CREATE TABLE `laerning_final` (
  `id` int(11) NOT NULL,
  `final_learning_out` varchar(255) NOT NULL,
  `final_topic_leaning_out` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laerning_final`
--

INSERT INTO `laerning_final` (`id`, `final_learning_out`, `final_topic_leaning_out`) VALUES
(7, 'CLO3. Convert conceptual model into relational schema. ', 'TLO10. List properties of relations \r\n \r\nTLO11. Transform an E-R (or EER) diagram into a logically equivalent set of relations. \r\n \r\nTLO12. Create relational tables that incorporate entity integrity and referential integrity constraints. ');

-- --------------------------------------------------------

--
-- Table structure for table `mapping_table`
--

CREATE TABLE `mapping_table` (
  `id` int(11) NOT NULL,
  `learn_out_mapping` varchar(255) NOT NULL,
  `pl1` varchar(255) NOT NULL,
  `pl2` varchar(255) NOT NULL,
  `pl3` varchar(255) NOT NULL,
  `pl4` varchar(255) NOT NULL,
  `pl5` varchar(255) NOT NULL,
  `pl6` varchar(255) NOT NULL,
  `pl7` varchar(255) NOT NULL,
  `pl8` varchar(255) NOT NULL,
  `pl9` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapping_table`
--

INSERT INTO `mapping_table` (`id`, `learn_out_mapping`, `pl1`, `pl2`, `pl3`, `pl4`, `pl5`, `pl6`, `pl7`, `pl8`, `pl9`) VALUES
(1, 'Understand data models, schemas, \r\ninstances, and their applications in \r\nthe real world. ', '/', '/', '/', '', '/', '/', '/', '/', ''),
(4, 'Design effective database \r\nschemas using Entity \r\nRelationship Diagram (ERD). ', '/', '/', '/', '', '/', '/', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `module_learning`
--

CREATE TABLE `module_learning` (
  `id` int(11) NOT NULL,
  `module_no` varchar(255) NOT NULL,
  `week` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `teaching_activities` varchar(255) NOT NULL,
  `technology` varchar(255) NOT NULL,
  `onsite` varchar(255) NOT NULL,
  `asy` varchar(255) NOT NULL,
  `hours` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_learning`
--

INSERT INTO `module_learning` (`id`, `module_no`, `week`, `date`, `teaching_activities`, `technology`, `onsite`, `asy`, `hours`) VALUES
(11, 'Module 0', 'Week 1', 'Feb 13-18', '•	Gospel and Reflection\r\n\r\n•	Presentation of Module 1: The Database Environment and Developmental Process\r\n', 'Schoolbook PowerPoint', '1', '', '2'),
(13, 'Module 2\r\n\r\nCLO 2\r\n\r\nTLO4\r\nTLO5\r\nTLO6\r\n', 'Week 5', 'Mar 13-18', '•	Activity 3: Enabling Assessment \r\n \r\n•	A 10-Item Short Quiz about Modeling Data in the Organization\r\n\r\n\r\n(RECORDED DISCUSSION)\r\n', 'Schoolbook', '1', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `module_learning_final`
--

CREATE TABLE `module_learning_final` (
  `id` int(11) NOT NULL,
  `module_no` varchar(255) NOT NULL,
  `week` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `teaching_activities` varchar(255) NOT NULL,
  `technology` varchar(255) NOT NULL,
  `onsite` varchar(255) NOT NULL,
  `asy` varchar(255) NOT NULL,
  `hours` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_learning_final`
--

INSERT INTO `module_learning_final` (`id`, `module_no`, `week`, `date`, `teaching_activities`, `technology`, `onsite`, `asy`, `hours`) VALUES
(1, 'Module 4\r\n\r\nCLO 3\r\n\r\nTLO10\r\nTLO11\r\nTLO12\r\n', 'Week 12', 'May 1-6', '•	Gospel and Reflection\r\n\r\n•	Giving of Midterm Grades\r\n\r\n•	Presentation of Module 4: Relational Model\r\n\r\n•	Activity 1: Class Participation\r\n', 'Schoolbook\r\nPowerPoint', '1', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `online_refference`
--

CREATE TABLE `online_refference` (
  `id` int(11) NOT NULL,
  `e_provider` varchar(255) NOT NULL,
  `refference_material` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `online_refference`
--

INSERT INTO `online_refference` (`id`, `e_provider`, `refference_material`) VALUES
(1, 'E-book\r\nAccession \r\nNumber: \r\n2490091', 'Bush, J. 2020. Learn SQL Database Programming: Query and Manipulate Databases from Popular\r\nRelational Database Servers Using SQL. (Birmingham): Packt Publishing');

-- --------------------------------------------------------

--
-- Table structure for table `onsite_reffence`
--

CREATE TABLE `onsite_reffence` (
  `id` int(11) NOT NULL,
  `Provider` varchar(255) NOT NULL,
  `Reference_Material` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `onsite_reffence`
--

INSERT INTO `onsite_reffence` (`id`, `Provider`, `Reference_Material`) VALUES
(1, 'QA 76.9. D3. Si32 2020', 'Silberschatz, A. 2020. Database System Concepts. 7th ed. (New York): \r\nMcGraw-Hill Education');

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
(3, 'Dean'),
(4, 'curriculum_committee');

-- --------------------------------------------------------

--
-- Table structure for table `semestral`
--

CREATE TABLE `semestral` (
  `id` int(11) NOT NULL,
  `term` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semestral`
--

INSERT INTO `semestral` (`id`, `term`, `year`) VALUES
(1, '2nd Semester', '2022-2023');

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
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `department`, `courses`, `phone_number`, `email`, `password`, `position`) VALUES
(7, 'Marivic', 'Mitscheck', '7', 'Bachelor of Science in Information Technology', '09505934815', 'Marivic.Mitscheck@lassalle.edu.ph', '$2y$10$oIV/VlCsi11.aqeaHP1Bie.lCjq7ZAMF0AdsO8iCUppBPvq511i36', '1'),
(8, 'Elexis', 'Falceso', '2', 'Bachelor of Science in Management Accounting', '09505934815', 'elexis.falceso@cvsu.edu.ph', '$2y$10$quJ9CH423wq5qfwPBK89qugSXJ.oSRgNlW9GQMbjTk4Pq7z5H/yCW', '2'),
(9, 'Louise', 'Garcia', '5', 'Bachelor of Science in Civil Engineering', '09505934815', 'louisegarcia@gmail.com', '$2y$10$UAwOAFHbQxt4xj.U99myd.r9guurcSGSD3IYbcNQSfchG2d51L.gm', '3'),
(11, 'Jenesis', 'Falceso', '6', 'Bachelor of Arts in Political Science', '09505934815', 'jenesis.falceso.dit.cvsu@gmail.com', '$2y$10$hZIILQ0F9oW/YznvSTvgI.eIn9YkB7jIZOMdLD/ZopLjWQg/yQtga', '4');

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
-- Indexes for table `decriptors`
--
ALTER TABLE `decriptors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laerning_final`
--
ALTER TABLE `laerning_final`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapping_table`
--
ALTER TABLE `mapping_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_learning`
--
ALTER TABLE `module_learning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_learning_final`
--
ALTER TABLE `module_learning_final`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_refference`
--
ALTER TABLE `online_refference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onsite_reffence`
--
ALTER TABLE `onsite_reffence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semestral`
--
ALTER TABLE `semestral`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_syllabus`
--
ALTER TABLE `course_syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `decriptors`
--
ALTER TABLE `decriptors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laerning_final`
--
ALTER TABLE `laerning_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mapping_table`
--
ALTER TABLE `mapping_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module_learning`
--
ALTER TABLE `module_learning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `module_learning_final`
--
ALTER TABLE `module_learning_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `online_refference`
--
ALTER TABLE `online_refference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `onsite_reffence`
--
ALTER TABLE `onsite_reffence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semestral`
--
ALTER TABLE `semestral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
