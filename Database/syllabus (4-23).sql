-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 07:49 AM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `role`) VALUES
(2, 'Admin', '$2y$10$rjyEn.BgKkWAF3jb6DSVx.EtHRfW8AP8jiiEwsvRLoNTby.BSy1Iq', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `initial` varchar(255) NOT NULL,
  `dean_name` varchar(255) NOT NULL,
  `dean_position` varchar(255) NOT NULL,
  `dean_signature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `initial`, `dean_name`, `dean_position`, `dean_signature`) VALUES
(2, 'College of Business Administration and Accountancy', 'CBAA', '', '', ''),
(3, 'College of Criminal Justice Education', 'CCJE', '', '', ''),
(4, 'College of Education', 'CE', '', '', ''),
(5, 'College of Engineering, Architecture and Technology', 'CEAT', '', '', ''),
(6, 'College of Liberal Arts and Communication', 'CLAC', '', '', ''),
(7, '  College of Science and Computer Studies  ', '  CSCS  ', '  Dr. Mario Torres', 'Dean', 'uploads/Picture1.png'),
(8, '  College of Tourism and Hospitality Management  ', '  CTHM', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `cname` text DEFAULT NULL,
  `initial` varchar(255) NOT NULL,
  `course_department` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_position` varchar(255) NOT NULL,
  `dept_signature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `catid`, `cname`, `initial`, `course_department`, `department_name`, `department_position`, `dept_signature`) VALUES
(5, 3, 'Bachelor of Science in Accountancy', 'BAAD', 'Business Administration and Accountancy Department', '', '', ''),
(6, 2, 'Bachelor of Science in Management Accounting', '', '', '', '', ''),
(7, 2, 'Bachelor of Science in Entrepreneurship with Specialization in Food Entrepreneurship', '', '', '', '', ''),
(8, 2, 'Bachelor of Science in Entrepreneurship with Specialization in Agripreneurship', '', '', '', '', ''),
(9, 2, 'Bachelor of Science Business Administration Major in Business and Operations Management with Specialization Track in Business Analytics', '', '', '', '', ''),
(10, 2, 'Business Administration Major in Bachelor of Science Business Economics', '', '', '', '', ''),
(11, 2, 'Bachelor of Science in Business Administration Major in Human Resource Development with Specialization Track in Business Analytics', '', '', '', '', ''),
(12, 2, 'Bachelor of Science in Business Administration Major in Marketing Management with Specialization in Business Analytics', '', '', '', '', ''),
(13, 2, 'Bachelor of Science in Business Administration major in Marketing Management with Specialization in Integrated Marketing Communications', '', '', '', '', ''),
(14, 3, 'BS in Criminology', '', '', '', '', ''),
(15, 3, 'Bachelor of Forensic Science', '', '', '', '', ''),
(16, 4, 'Bachelor of Early Childhood Education', '', '', '', '', ''),
(17, 4, 'Bachelor of Special Needs Education', '', '', '', '', ''),
(18, 4, 'Bachelor of Secondary Education', '', '', '', '', ''),
(19, 4, 'Certificate in Teaching Program', '', '', '', '', ''),
(20, 4, 'Certificate in Teaching Values Education', '', '', '', '', ''),
(21, 4, 'Certificate in Sign Language', '', '', '', '', ''),
(22, 4, 'Certificate in Teaching Early Childhood Learners', '', '', '', '', ''),
(23, 5, 'Bachelor of Science in Architecture', '', '', '', '', ''),
(24, 5, 'Bachelor of Science in Civil Engineering\r\n', '', '', '', '', ''),
(25, 5, 'Bachelor of Science in Computer Engineering\r\n', '', '', '', '', ''),
(26, 5, 'Bachelor of Science in Electrical Engineering\r\n', '', '', '', '', ''),
(27, 5, 'Bachelor of Science in Electronics Engineering\r\n', '', '', '', '', ''),
(28, 5, 'Bachelor of Science in Industrial Engineering\r\n', '', '', '', '', ''),
(29, 5, 'Bachelor of Science in Mechanical Engineering\r\n', '', '', '', '', ''),
(30, 5, 'Bachelor of Multimedia Arts', '', '', '', '', ''),
(31, 6, 'Bachelor of Arts in Communication\r\n\r\n', '', '', '', '', ''),
(32, 6, 'Bachelor of Arts in Digital and Multimedia Journalism\r\n', '', '', '', '', ''),
(33, 6, 'Bachelor of Arts in Political Science\r\n', '', '', '', '', ''),
(34, 6, 'Bachelor of Arts in International Development\r\n', '', '', '', '', ''),
(35, 6, 'Bachelor of Arts in Psychology\r\n', '', '', '', '', ''),
(36, 6, 'Bachelor of Science in Psychology', '', '', '', '', ''),
(37, 7, 'Bachelor of Science in Biology with specialization in Medical Biology (3 year compressed program)\r\n', '', '', '', '', ''),
(38, 7, 'Bachelor of Science in Biology with specialization in Medical Biology', '', '', '', '', ''),
(39, 7, 'Bachelor of Science in Biology with specialization in Microbiology', '', '', '', '', ''),
(40, 7, 'Bachelor of Science in Biology with specialization in Cell and Molecular Biology', '', '', '', '', ''),
(41, 7, 'Bachelor of Science in Biology with specialization in Plant Biology', '', '', '', '', ''),
(42, 7, 'Bachelor of Science in Biology with specialization in Animal Biology', '', '', '', '', ''),
(43, 7, 'Bachelor of Science in Biology with specialization in Environmental Science', '', '', '', '', ''),
(44, 7, 'Bachelor of Science in Applied Mathematics', '', '', '', '', ''),
(45, 7, 'Bachelor of Science in Computer Science', 'SCSD', '', '', '', ''),
(46, 7, 'BS Information Technology', 'ITD', 'Information Technology Department', 'Marivic Mitschek', 'Chair', 'uploads/Picture1.png'),
(47, 8, 'Bachelor of Science Hospitality Management\r\n', 'DOM', '', '', '', ''),
(48, 8, 'Bachelor of Science in in Tourism Management', 'DOM', '', '', '', '');

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
  `topic_learn_out` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_leaning`
--

INSERT INTO `course_leaning` (`id`, `comlab`, `learn_out`, `topic_learn_out`) VALUES
(5, 'CLO1', 'Understand data models, schemas, instances, and their applications in the real world', 'TLO1. Effectively explains the basic concepts of databases and data models. \r\n\r\n\r\nTLO2.Explains the features of database management systems, architecture of database systems, and the role of database users. '),
(6, 'CLO2', 'Design effective database schemas using Entity Relationship Diagram (ERD). ', 'TLO4. State reasons why many system developers believe that data modeling is the most important part of the systems development process\r\n\r\nTLO5. Write good names and definitions for entities, relationships, and attributes. \r\n\r\nTLO6. Draw an E-R diagram to represent common business situations. \r\n\r\nTLO7. Recognize when to use supertype/subtype relationships in data modeling. \r\n\r\nTLO8. Develop a supertype/subtype hierarchy for a realistic business situation. \r\n\r\nTLO9. Develop an entity cluster to simplify presentation of an E-R diagram. '),
(7, 'CLO3', 'Convert conceptual model into relational schema.', ''),
(8, 'CLO4', 'Perform effective data management procedures. ', ''),
(9, 'CLO5', 'Perform effective logical database design.', ''),
(10, 'CLO6', 'Demonstrate 21st century skills in all learning activities.', '');

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
  `course_description` varchar(555) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_syllabus`
--

INSERT INTO `course_syllabus` (`id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`) VALUES
(1, 'S-ITPC 121 ', 'Fundamentals of Database Systems ', 'Lecture', '2 Units ', 'Traditional', 'None', 'S-ITPC 121LA', 'Ms. Azenith R. Mojica', 'Monday and Tuesday 2:00-5:00 ', 'COS 100-C', '(046) 4811900 local 3134', 'armojica@dlsud.edu.ph', '                  This course prepares the students to acquire the skills on creating, analyzing, and designing databases. This will help increase their understanding of the essentials of database modelling and design, the languages and facilities provided by the database management systems and system implementation techniques.  ', '');

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
(1, '1. Apply concepts of computing in different domains of \r\ninformation technology.', '/', '', '', '', '/');

-- --------------------------------------------------------

--
-- Table structure for table `graduates_attributes`
--

CREATE TABLE `graduates_attributes` (
  `id` int(11) NOT NULL,
  `graduate_att` varchar(255) NOT NULL,
  `descriptors_learn_out` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `graduates_attributes`
--

INSERT INTO `graduates_attributes` (`id`, `graduate_att`, `descriptors_learn_out`) VALUES
(10, '1. God-centered', '<p>a) Creates an environment where the experience of God is lived and shared.&nbsp;</p><p>b) Practices honesty, fairness, truth, and integrity in all aspects of life (personal and professional lives)&nbsp;</p><p>c) Observes and maintains ethical standards in dealing with the different stakeholders.&nbsp;</p><p>d) Integrates Christian perspectives and values in all undertakings.&nbsp;</p><p>e) Manifests humility and respect in relating with other people</p>');

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
(8, 'CLO3. Convert conceptual model into relational schema. ', '<p>TLO10. List properties of relations&nbsp;</p><p>&nbsp;</p><p>TLO11. Transform an E-R (or EER) diagram into a logically equivalent set of relations.&nbsp;</p><p>&nbsp;</p><p>TLO12. Create relational tables that incorporate entity integrity and referenti');

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
(21, '', 'Week 11', 'Apr 24-29', 'Self-care Week', '', '', '', '2');

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
(2, '<p>Module 4</p><p>CLO 3</p><p>TLO10<br>TLO11<br>TLO12</p>', 'Week 12', 'Feb 13-18', '<p>•&nbsp;&nbsp;&nbsp;&nbsp;Gospel and Reflection</p><p>•&nbsp;&nbsp;&nbsp;&nbsp;Giving of Midterm Grades</p><p>•&nbsp;&nbsp;&nbsp;&nbsp;Presentation of Module 4: Relational Model</p><p>•&nbsp;&nbsp;&nbsp;&nbsp;Activity 1: Class Participation</p>', 'Schoolbook PowerPoint', '', '1', '2');

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
(1, 'QA 76.9. D3. Si32 2020', 'Silberschatz, A. 2020. Database System Concepts. 7th ed. (New York): \r\nMcGraw-Hill Education'),
(3, 'QA 76.9.D26 .C816 2019', '<p>Coronel, C. 2019. Database Systems: Design, Implementation and Management. 13th ed. Cengage Learning&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `percent`
--

CREATE TABLE `percent` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `percents` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `percent`
--

INSERT INTO `percent` (`id`, `description`, `percents`) VALUES
(1, 'Class Participation', '20%'),
(2, 'Enabling Assessment', '50%'),
(4, 'Summative Assessment', '30%');

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
(4, ' Curriculum Committee ');

-- --------------------------------------------------------

--
-- Table structure for table `semestral`
--

CREATE TABLE `semestral` (
  `id` int(11) NOT NULL,
  `term` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `second_call` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semestral`
--

INSERT INTO `semestral` (`id`, `term`, `year`, `second_call`) VALUES
(1, '2<sup>nd</sup> Semester', '2022-2023', 'second semester ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `catid` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `department`, `catid`, `phone_number`, `email`, `password`, `position`, `role`) VALUES
(7, 'Marivic', 'Mitscheck', '7', '46', '09505934815', 'Marivic.Mitscheck@lassalle.edu.ph', '$2y$10$oIV/VlCsi11.aqeaHP1Bie.lCjq7ZAMF0AdsO8iCUppBPvq511i36', '1', 'user'),
(15, 'John', 'Falceso', '7', '46', '09505934815', 'john.falceso@cvsu.edu.ph', '$2y$10$hlIweTu04suMdSk/PqOJteSAAkqM9kfqGxWkvhiZghAFpPMDL4A3q', '1', 'user'),
(17, 'rosegine      ', 'magdaluyo     ', '2', '7', ' 09505934815   ', 'rosegine@gmail.com      ', '$2y$10$oFR/PUHqI2cCCINmJ5R8luAHHoOlAiKdt4oP7vobEKAdbUNJuNxjC', '3', 'user'),
(19, 'Jenesis', 'Falceso', '4', '17', '09514781767', 'jenesis@lassalle.edu.ph', '$2y$10$aQOaEN17YPVLcov.G83uOOIlTG.V2WUTMXskFE71yIFLw9lQFJ7IC', '2', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `graduates_attributes`
--
ALTER TABLE `graduates_attributes`
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
-- Indexes for table `percent`
--
ALTER TABLE `percent`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `course_description`
--
ALTER TABLE `course_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_leaning`
--
ALTER TABLE `course_leaning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_syllabus`
--
ALTER TABLE `course_syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `decriptors`
--
ALTER TABLE `decriptors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `graduates_attributes`
--
ALTER TABLE `graduates_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laerning_final`
--
ALTER TABLE `laerning_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mapping_table`
--
ALTER TABLE `mapping_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module_learning`
--
ALTER TABLE `module_learning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `module_learning_final`
--
ALTER TABLE `module_learning_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `online_refference`
--
ALTER TABLE `online_refference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `onsite_reffence`
--
ALTER TABLE `onsite_reffence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `percent`
--
ALTER TABLE `percent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semestral`
--
ALTER TABLE `semestral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
