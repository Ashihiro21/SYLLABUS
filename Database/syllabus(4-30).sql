-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 11:24 AM
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
(2, ' College of Business Administration and Accountancy ', ' CBAA', '  Elma L. Mallorca PhD', '', ''),
(3, ' College of Criminal Justice Education ', ' CCJE ', '  Rodel G. Esmillia, PhD', '', 'uploads/Picture1.png'),
(4, '  College of Education  ', '  COEd  ', 'Jose Arvin I. Gacelo, PhD', '', ''),
(5, ' College of Engineering, Architecture and Technology ', ' CEAT ', 'Engr. Ma Estrella Natalie B. Pineda MSME', '', ''),
(6, '  College of Liberal Arts and Communication  ', ' CEATGS ', 'Constantino T. Ballena, PhD', '', ''),
(7, '   College of Science and Computer Studies   ', '   CSCS   ', 'Rubie M. Causaren, PhD', 'Dean', 'uploads/Picture1.png'),
(8, '   College of Tourism and Hospitality Management   ', '   CTHM ', 'Paul Anthony C. Notorio, MBA', 'Dean', 'uploads/Picture1.png');

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
(6, 2, '  Bachelor of Science in Management Accounting  ', '   BSA ', '  Accountancy Department ', '   Mary May C. Eulogio, MBA, CPA ', '  Chair', ''),
(7, 2, ' Bachelor of Science in Entrepreneurship with Specialization in Food Entrepreneurship    ', 'ABD', ' Allied Business Department ', ' Renz S. Mercado, MBA ', ' Chair  ', ''),
(8, 2, ' Bachelor of Science in Entrepreneurship with Specialization in Agripreneurship ', 'ABD', 'Allied Business Department', 'Renz S. Mercado, MBA', 'Chair', ''),
(9, 2, ' Bachelor of Science Business Administration Major in Business and Operations Management with Specialization Track in Business Analytics ', 'BMD  ', 'Business Management Department', 'Ruel D. Elias, MM  ', 'Chair', ''),
(10, 2, ' Business Administration Major in Bachelor of Science Business Economics ', 'BMD  ', 'Business Management Department', 'Ruel D. Elias, MM  ', 'Chair', ''),
(11, 2, ' Bachelor of Science in Business Administration Major in Human Resource Development with Specialization Track in Business Analytics ', 'BMD  ', 'Business Management Department', 'Ruel D. Elias, MM  ', 'Chair', ''),
(12, 2, ' Bachelor of Science in Business Administration Major in Marketing Management with Specialization in Business Analytics ', 'MD', 'Marketing Department  ', 'Anna Liza P. Atterrado, DBA', '  Chair', ''),
(13, 2, ' Bachelor of Science in Business Administration major in Marketing Management with Specialization in Integrated Marketing Communications ', 'MD', 'Marketing Department  ', 'Anna Liza P. Atterrado, DBA', 'Chair', ''),
(14, 3, '   BS in Criminology   ', ' CCJE ', ' College of Criminal Justice Education ', '  Rodel G. Esmillia PhD   ', '  Chair  ', 'uploads/Picture1.png'),
(15, 3, '  Bachelor of Forensic Science  ', 'CCJE', 'College of Criminal Justice Education', ' Rodel G. Esmillia PhD  ', ' Chair ', ''),
(16, 4, ' Bachelor of Early Childhood Education ', 'PED', 'Professional Education Department', 'Cristina M. Padiila, MAEd', 'Chair', ''),
(17, 4, ' Bachelor of Special Needs Education ', 'PED', 'Professional Education Department', 'Cristina M. Padiila, MAEd', 'Chair', ''),
(18, 4, ' Bachelor of Secondary Education ', 'PED', 'Professional Education Department', 'Cristina M. Padiila, MAEd', '  Chair', ''),
(19, 4, ' Certificate in Teaching Program ', 'PED', 'Professional Education Department', 'Cristina M. Padiila, MAEd', 'Chair', ''),
(20, 4, ' Certificate in Teaching Values Education ', 'RED ', 'Religious Education Department', 'Gladiolus M. Gatdula, PhD', 'Chair', ''),
(21, 4, ' Certificate in Sign Language ', 'PED', 'Professional Education Department', 'Cristina M. Padiila, MAEd', 'Chair', ''),
(22, 4, ' Certificate in Teaching Early Childhood Learners ', 'PED', 'Professional Education Department', 'Cristina M. Padiila, MAEd', '  Chair', ''),
(23, 5, ' Bachelor of Science in Architecture ', 'AD', 'Architecture Department', 'Ar. Joselito B. Cillo, MUMP', 'Chair', ''),
(24, 5, ' Bachelor of Science in Civil Engineering ', 'ED', 'Engineering Department', ' Engr. Conrado D. Monzon, MECE ', 'Chair', ''),
(25, 5, ' Bachelor of Science in Computer Engineering ', 'ED', 'Engineering Department', 'Engr. Conrado D. Monzon, MECE', 'Chair', ''),
(26, 5, ' Bachelor of Science in Electrical Engineering ', 'ED ', 'Engineering Department', 'Engr. Conrado D. Monzon, MECE', 'Chair', ''),
(27, 5, ' Bachelor of Science in Electronics Engineering ', 'ED', 'Engineering Department', 'Engr. Conrado D. Monzon, MECE', 'Chair', ''),
(28, 5, '   Bachelor of Science in Industrial Engineering   ', ' ED ', ' Engineering Department ', ' Engr. Conrado D. Monzon, MECE ', ' Chair   ', ''),
(29, 5, ' Bachelor of Science in Mechanical Engineering ', 'ED', 'Engineering Department', 'Engr. Conrado D. Monzon, MECE', '  Chair', ''),
(30, 5, ' Bachelor of Multimedia Arts ', 'DSMD', 'Graphics Design and Multimedia Department', 'Eduardo M. Rubi II, MGT', '  Chair', ''),
(31, 6, ' Bachelor of Arts in Communication ', '  CJD', '  Communication and Journalism Department', ' Isolde E. Valera, MAComm', '  Chair', ''),
(32, 6, ' Bachelor of Arts in Digital and Multimedia Journalism ', '  CJD', '  Communication and Journalism Department', 'Isolde E. Valera, Macomm', '  Chair', ''),
(33, 6, '  Bachelor of Arts in Political Science  ', ' SHD ', ' Social and Humanities Department ', ' Chealyn J. Rudio, PhD ', '   Chair ', ''),
(34, 6, '  Bachelor of Arts in International Development  ', ' LLD ', ' Languages and Literature Department ', ' Lourdes C. Rudio, PhD ', '   Chair ', ''),
(35, 6, '  Bachelor of Arts in Psychology  ', ' SHD ', ' Social and Humanities Department ', ' Chealyn J. Rudio, PhD ', '   Chair ', ''),
(36, 6, ' Bachelor of Science in Psychology ', 'SHD', 'Social and Humanities Department', 'Chealyn J. Rudio, PhD', '  Chair', ''),
(37, 7, '  Bachelor of Science in Biology with specialization in Medical Biology (3 year compressed program)  ', '   BSD ', ' Biological Sciences Department ', '   Ronaldo D. Lagat, PhD   ', '   Chair ', ''),
(38, 7, '   Bachelor of Science in Biology with specialization in Medical Biology   ', '    BSD  ', '  Biological Sciences Department  ', '    Ronaldo D. Lagat, PhD  ', '    Chair  ', ''),
(39, 7, '    Bachelor of Science in Biology with specialization in Microbiology    ', '     BSD   ', '  Biological Sciences Department  ', '   Ronaldo D. Lagat, PhD', '     Chair   ', ''),
(40, 7, '     Bachelor of Science in Biology with specialization in Cell and Molecular Biology     ', '    BSD    ', '    Biological Sciences Department    ', '    Ronaldo D. Lagat, PhD', ' Chair  ', ''),
(41, 7, '   Bachelor of Science in Biology with specialization in Plant Biology   ', '    BSD  ', '  Biological Sciences Department  ', '    Ronaldo D. Lagat, PhD   ', '    Chair  ', ''),
(42, 7, '   Bachelor of Science in Biology with specialization in Animal Biology   ', '    BSD  ', '  Biological Sciences Department  ', '    Ronaldo D. Lagat, PhD', '  Chair  ', ''),
(43, 7, '  Bachelor of Science in Biology with specialization in Environmental Science  ', '   PSD ', '   Physical Sciences Department ', '   Susan T. Sta Ana ', '  Chair', ''),
(44, 7, '  Bachelor of Science in Applied Mathematics  ', ' MSD ', ' Mathematics and Statistics Department ', ' Sharon P. Lubag, MSAM ', '  Chair', ''),
(45, 7, '   Bachelor of Science in Computer Science   ', '  CSD   ', '   Computer Science Department  ', '    Josephine T. Eduardo, MSCS  ', '   Chair ', ''),
(46, 7, 'BS Information Technology', 'ITD', 'Information Technology Department', 'Marivic Mitschek', 'Chair', 'uploads/Picture1.png'),
(47, 8, ' Bachelor of Science Hospitality Management ', 'HMD', 'Hospitality Management Department', 'Fullepro A;berto G. Madrilejos, MSHRM', 'Chair', 'uploads/Picture1.png'),
(48, 8, '     Bachelor of Science in in Tourism Management     ', '    TMD    ', '      Tourism Management Department    ', '      Grace Cella R. Mejia, DMB    ', '   Chair ', ''),
(56, 2, ' Bachelor of Science in Accountancy ', ' ACD ', '  Accountancy Department ', ' Mary May C. Eulogio, MBA, CPA ', ' Chair ', '');

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
  `topic_learn_out` varchar(1000) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_leaning`
--

INSERT INTO `course_leaning` (`id`, `comlab`, `learn_out`, `topic_learn_out`, `department`) VALUES
(6, 'CLO2', 'Design effective database schemas using Entity Relationship Diagram (ERD). ', 'TLO4. State reasons why many system developers believe that data modeling is the most important part of the systems development process\r\n\r\nTLO5. Write good names and definitions for entities, relationships, and attributes. \r\n\r\nTLO6. Draw an E-R diagram to represent common business situations. \r\n\r\nTLO7. Recognize when to use supertype/subtype relationships in data modeling. \r\n\r\nTLO8. Develop a supertype/subtype hierarchy for a realistic business situation. \r\n\r\nTLO9. Develop an entity cluster to simplify presentation of an E-R diagram. ', ''),
(7, 'CLO3', 'Convert conceptual model into relational schema.', '', ''),
(8, 'CLO4', 'Perform effective data management procedures. ', '', ''),
(9, 'CLO5', 'Perform effective logical database design.', '', ''),
(15, 'CLO1', 'Understand data models, schemas, instances, and their applications in the real world. ', 'TLO1. Effectively explains the basic concepts of databases and data models. \r\n \r\nTLO2.Explains the features of database management systems, architecture of database systems, and the role of database users. \r\n \r\nTLO3. Defines the basics of the relational data model. \r\n', '3'),
(16, 'CLO1', 'Understand data models, schemas, instances, and their applications in the real world. ', 'TLO1. Effectively explains the basic concepts of databases and data models. \r\n \r\nTLO2.Explains the features of database management systems, architecture of database systems, and the role of database users. \r\n \r\nTLO3. Defines the basics of the relational data model. ', '8');

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
  `email` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_syllabus`
--

INSERT INTO `course_syllabus` (`id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department`) VALUES
(9, 'S-ITPC 121', 'Fundamentals of Database Systems ', 'Lecture', '2 Units ', 'Traditional', 'None', 'S-ITPC 121LA', 'Ms. Azenith R. Mojica', 'Monday and Tuesday 2:00-5:00 ', 'COS 100-C', 'armojica@dlsud.edu.ph', '(046) 4811900 local 3134', 'This course prepares the students to acquire the skills on creating, analyzing, and designing databases. This will help increase their understanding of the essentials of database modelling and design, the languages and facilities provided by the database management systems and system implementation techniques.  ', '', '3'),
(11, 'S-ITPC 121', 'Fundamentals of Database Systems', 'Lecture', '2 Units ', 'Traditional', 'None', 'S-ITPC 121LA', 'Ms. Azenith R. Mojica', 'Monday and Tuesday 2:00-5:00 ', 'COS 100-C', '(046) 4811900 local 3134', 'armojica@dlsud.edu.ph', 'This course prepares the students to acquire the skills on creating, analyzing, and designing databases. This will help increase their understanding of the essentials of database modelling and design, the languages and facilities provided by the database management systems and system implementation techniques. ', '', '8');

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
  `rate5` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `decriptors`
--

INSERT INTO `decriptors` (`id`, `program_learn`, `rate1`, `rate2`, `rate3`, `rate4`, `rate5`, `department`) VALUES
(1, '1. Apply concepts of computing in different domains of \r\ninformation technology.', '/', '', '', '', '/', ''),
(5, '<ol><li>&nbsp;Apply concepts of computing in different domains of information technology.&nbsp;</li></ol>', '', '', '', '/', '/', ''),
(6, '<ol><li>Apply concepts of computing in different domains of information technology.&nbsp;</li></ol>', '', '', '', '/', '/', '3'),
(7, '<ol><li>Apply concepts of computing in different domains of information technology.&nbsp;</li></ol>', '', '', '', '/', '/', '8');

-- --------------------------------------------------------

--
-- Table structure for table `graduates_attributes`
--

CREATE TABLE `graduates_attributes` (
  `id` int(11) NOT NULL,
  `graduate_att` varchar(255) NOT NULL,
  `descriptors_learn_out` varchar(999) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `graduates_attributes`
--

INSERT INTO `graduates_attributes` (`id`, `graduate_att`, `descriptors_learn_out`, `department`) VALUES
(10, '1. God-centered', 'a) Creates an environment where the experience of God is lived and shared. \r\n\r\nb) Practices honesty, fairness, truth, and integrity in all aspects of life (personal and professional lives) \r\n\r\nc) Observes and maintains ethical standards in dealing with the different stakeholders. \r\n\r\nd) Integrates Christian perspectives and values in all undertakings. \r\n\r\ne) Manifests humility and respect in relating with other people', ''),
(12, '1.	God-centered', '<p>a)&nbsp;&nbsp;&nbsp;&nbsp;Creates an environment where the experience of God is lived and shared.<br>b)&nbsp;&nbsp;&nbsp;&nbsp;Practices honesty, fairness, truth, and integrity in all aspects of life (personal and professional lives)<br>c)&nbsp;&nbsp;&nbsp;&nbsp;Observes and maintains ethical standards in dealing with the different stakeholders.<br>d)&nbsp;&nbsp;&nbsp;&nbsp;Integrates Christian perspectives and values in all undertakings.<br>e)&nbsp;&nbsp;&nbsp;&nbsp;Manifests humility and respect in relating with other people</p>', ''),
(13, '1.	God-centered', '<p>a)&nbsp;&nbsp;&nbsp;&nbsp;Creates an environment where the experience of God is lived and shared.</p><p><br>b)&nbsp;&nbsp;&nbsp;&nbsp;Practices honesty, fairness, truth, and integrity in all aspects of life (personal and professional lives)</p><p><br>c)&nbsp;&nbsp;&nbsp;&nbsp;Observes and maintains ethical standards in dealing with the different stakeholders.</p><p><br>d)&nbsp;&nbsp;&nbsp;&nbsp;Integrates Christian perspectives and values in all undertakings.</p><p><br>e)&nbsp;&nbsp;&nbsp;&nbsp;Manifests humility and respect in relating with other people</p>', '3'),
(14, '1.	God-centered', 'a)    Creates an environment where the experience of God is lived and shared.\r\n\r\nb)    Practices honesty, fairness, truth, and integrity in all aspects of life (personal and professional lives)\r\n\r\nc)    Observes and maintains ethical standards in dealing with the different stakeholders.\r\n\r\nd)    Integrates Christian perspectives and values in all undertakings.\r\n\r\ne)    Manifests humility and respect in relating with other people ', '8');

-- --------------------------------------------------------

--
-- Table structure for table `laerning_final`
--

CREATE TABLE `laerning_final` (
  `id` int(11) NOT NULL,
  `final_learning_out` varchar(255) NOT NULL,
  `final_topic_leaning_out` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laerning_final`
--

INSERT INTO `laerning_final` (`id`, `final_learning_out`, `final_topic_leaning_out`, `department`) VALUES
(9, 'CLO3. Convert conceptual model into relational schema. ', 'TLO10. List properties of relations  \r\n\r\nTLO11. Transform an E-R (or EER) diagram into a logically equivalent set of relations.  \r\n\r\nTLO12. Create relational tables that incorporate entity integrity and referenti', ''),
(10, 'CLO3. Convert conceptual model into relational schema. ', 'TLO10. List properties of relations\r\n  \r\nTLO11. Transform an E-R (or EER) diagram into a logically equivalent set of relations.  \r\n\r\nTLO12. Create relational tables that incorporate entity integrity and referential integrity constraints', ''),
(11, 'CLO3. Convert conceptual model into relational schema. ', '<p>TLO10. List properties of relations&nbsp;</p><p>&nbsp;</p><p>TLO11. Transform an E-R (or EER) diagram into a logically equivalent set of relations.&nbsp;</p><p>&nbsp;</p><p>TLO12. Create relational tables that incorporate entity integrity and referenti', '3'),
(12, 'CLO3. Convert conceptual model into relational schema', 'TLO10. List properties of relations \r\n\r\nTLO11. Transform an E-R (or EER) diagram into a logically equivalent set of relations. \r\n\r\nTLO12. Create relational tables that incorporate entity integrity and referential integrity constraints', '8');

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
  `pl9` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapping_table`
--

INSERT INTO `mapping_table` (`id`, `learn_out_mapping`, `pl1`, `pl2`, `pl3`, `pl4`, `pl5`, `pl6`, `pl7`, `pl8`, `pl9`, `department`) VALUES
(1, 'Understand data models, schemas, \r\ninstances, and their applications in \r\nthe real world. ', '/', '/', '/', '', '/', '/', '/', '/', '', ''),
(4, 'Design effective database \r\nschemas using Entity \r\nRelationship Diagram (ERD). ', '/', '/', '/', '', '/', '/', '', '', '', ''),
(7, '<p>Understand data models, schemas, instances, and their applications in the real world.&nbsp;</p>', '/', '/', '/', '', '/', '/', '/', '/', '', ''),
(8, '<p>Understand data models, schemas, instances, and their applications in the real world.&nbsp;</p>', '/', '/', '/', '', '/', '/', '/', '/', '', '3'),
(9, '<p>Understand data models, schemas, instances, and their applications in the real world.&nbsp;</p>', '/', '/', '/', '', '/', '/', '/', '', '', '8');

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
  `hours` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_learning`
--

INSERT INTO `module_learning` (`id`, `module_no`, `week`, `date`, `teaching_activities`, `technology`, `onsite`, `asy`, `hours`, `department`) VALUES
(21, 'Module 0', 'Week 1', 'Feb 13-18', '•	Gospel and Reflection\r\n\r\n•	Presentation of the Course Syllabus\r\n\r\n•	Presentation of Module 0: Course Introduction\r\n\r\n•	Activity 1: Class Participation', 'Schoolbook PowerPoint MS Forms', '', '1', '2', ''),
(24, 'Module 1', 'Week 2', 'Feb 13-19', '•    Gospel and Reflection\r\n\r\n\r\n•    Presentation of the Course Syllabus\r\n\r\n\r\n•    Presentation of Module 0: Course Introduction\r\n\r\n\r\n•    Activity 1: Class Participation', 'Schoolbook PowerPoint MS Forms', '', '1', '2', ''),
(25, '<p>Module 0</p>', 'Week 1', 'Feb 13-18', '<p>•&nbsp;&nbsp;&nbsp;&nbsp;Gospel and Reflection</p><p>•&nbsp;&nbsp;&nbsp;&nbsp;Presentation of the Course Syllabus</p><p>•&nbsp;&nbsp;&nbsp;&nbsp;Presentation of Module 0: Course Introduction</p><p>•&nbsp;&nbsp;&nbsp;&nbsp;Activity 1: Class Participatio', 'Schoolbook PowerPoint MS Forms', '1', '', '2', '3'),
(27, 'Module 0', 'Week 1', 'Feb 13-18', '•    Gospel and Reflection\r\n\r\n•    Presentation of the Course Syllabus\r\n\r\n•    Presentation of Module 0: Course Introduction\r\n\r\n•    Activity 1: Class Participation', 'Schoolbook PowerPoint MS Forms', '1', '', '2', '8');

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
  `hours` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_learning_final`
--

INSERT INTO `module_learning_final` (`id`, `module_no`, `week`, `date`, `teaching_activities`, `technology`, `onsite`, `asy`, `hours`, `department`) VALUES
(2, 'Module 4 \r\nCLO3 \r\nTLO10 \r\nTLO11 \r\nTLO12', 'Week 12', 'Feb 13-18', '•    Gospel and Reflection \r\n\r\n•    Giving of Midterm Grades\r\n\r\n•    Presentation of Module 4: Relational Model\r\n\r\n•    Activity 1: Class Participation', 'Schoolbook PowerPoint', '1', '', '2', ''),
(8, 'Module 4\r\n\r\nCLO 3\r\nTLO10\r\nTLO11\r\nTLO12', 'Week 12', 'May 1-6', '•    Gospel and Reflection\r\n\r\n•    Presentation of the Course Syllabus\r\n\r\n•    Presentation of Module 0: Course Introduction\r\n\r\n•    Activity 1: Class Participation', 'Schoolbook PowerPoint', '1', '', '2', ''),
(9, '', 'Week 11', 'Apr 24-29', '<p>Self-care Week</p>', '', '', '', '', '3'),
(10, '', 'Week 11', 'Apr 24-29', '', '', '', '', '', '8');

-- --------------------------------------------------------

--
-- Table structure for table `online_refference`
--

CREATE TABLE `online_refference` (
  `id` int(11) NOT NULL,
  `e_provider` varchar(255) NOT NULL,
  `refference_material` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `online_refference`
--

INSERT INTO `online_refference` (`id`, `e_provider`, `refference_material`, `department`) VALUES
(1, 'E-book\r\nAccession \r\nNumber: \r\n2490091', 'Bush, J. 2020. Learn SQL Database Programming: Query and Manipulate Databases from Popular\r\nRelational Database Servers Using SQL. (Birmingham): Packt Publishing', ''),
(3, 'E-book Accession Number: 2030800', 'Lupeikiene, A. 2019. Databases and Information Systems X: Selected Papers From the Thirteenth International Baltic Conference, DB&IS 2018. (Amsterdam, Netherlands): IOS Press.', ''),
(6, 'E-book Accession Number: 2030800', '<p>Bush, J. 2020. Learn SQL Database Programming: Query and Manipulate Databases from Popular Relational Database Servers Using SQL. (Birmingham): Packt Publishing</p>', ''),
(7, 'E-book Accession Number: 2490091', '<p>Bush, J. 2020. Learn SQL Database Programming: Query and Manipulate Databases from Popular Relational Database Servers Using SQL. (Birmingham): Packt Publishing</p>', '3'),
(8, 'E-book Accession Number: 2490091', '<p>Bush, J. 2020. Learn SQL Database Programming: Query and Manipulate Databases from Popular Relational Database Servers Using SQL. (Birmingham): Packt Publishing</p>', '8');

-- --------------------------------------------------------

--
-- Table structure for table `onsite_reffence`
--

CREATE TABLE `onsite_reffence` (
  `id` int(11) NOT NULL,
  `Provider` varchar(255) NOT NULL,
  `Reference_Material` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `onsite_reffence`
--

INSERT INTO `onsite_reffence` (`id`, `Provider`, `Reference_Material`, `department`) VALUES
(1, 'QA 76.9. D3. Si32 2020', 'Silberschatz, A. 2020. Database System Concepts. 7th ed. (New York): \r\nMcGraw-Hill Education', ''),
(3, 'QA 76.9.D26 .C816 2019', '<p>Coronel, C. 2019. Database Systems: Design, Implementation and Management. 13th ed. Cengage Learning&nbsp;</p>', ''),
(5, 'QA 76.9. D3. Si32 2020', '<p>Silberschatz, A. 2020. Database System Concepts. 7th ed. (New York): McGraw-Hill Education</p>', ''),
(6, 'QA 76.9. D3. Si32 2020', '<p>Silberschatz, A. 2020. Database System Concepts. 7th ed. (New York): McGraw-Hill Education</p>', '3'),
(7, 'QA 76.9. D3. Si32 2020', '<p>Silberschatz, A. 2020. Database System Concepts. 7th ed. (New York): McGraw-Hill Education</p>', '8');

-- --------------------------------------------------------

--
-- Table structure for table `percent`
--

CREATE TABLE `percent` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `percents` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `percent`
--

INSERT INTO `percent` (`id`, `description`, `percents`, `department`) VALUES
(1, 'Class Participation', '20%', ''),
(2, 'Enabling Assessment', '50%', ''),
(4, 'Summative Assessment', '30%', ''),
(5, 'Class Participation', '20%', ''),
(6, 'Enabling Assessment', '50%', ''),
(7, 'Summative Assessment', '30%', ''),
(8, 'Class Participation ', '20', '3'),
(9, 'Enabling Assessment', '50%', '3'),
(10, 'Summative Assessment', '30%', '3'),
(11, 'Class Participation', '20%', '8'),
(12, 'Enabling Assessment', '50%', '8'),
(13, 'Summative Assessment', '30%', '8');

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
  `second_call` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semestral`
--

INSERT INTO `semestral` (`id`, `term`, `year`, `second_call`, `department`) VALUES
(1, '1<sup>st</sup> Semester', '2022-2023', 'second semester ', ''),
(9, '2<sup>nd</sup> Semester', '2023-2024', 'second semester', ''),
(12, '2<sup>nd</sup> Semester', '2023-2024', 'second semester', '3'),
(13, '2<sup>nd</sup> Semester', '2023-2024', 'second semester', '8');

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
(19, 'Jenesis', 'Falceso', '4', '17', '09514781767', 'jenesis@lassalle.edu.ph', '$2y$10$aQOaEN17YPVLcov.G83uOOIlTG.V2WUTMXskFE71yIFLw9lQFJ7IC', '2', 'user'),
(20, 'Rosegine', 'Magdaluyo', '8', '47', '09514781767', 'roseginemagdaluyo282003@gmail.com', '$2y$10$Pf2jmsKpQ..jygABHTlUueuIY2e/RVghX5Uv1xrxMNi9Lywo50RGq', '1', 'user'),
(21, 'jerome', 'oclares', '3', '14', '09514781767', 'jerome.oclares@cvsu.edu.ph', '$2y$10$wxe0CvqG4VKuj0WJ/IeTUeqozzR/0qsMshsIxkcslqhAiLx.Krdnq', '4', 'user'),
(22, 'Elexis', 'Falceso', '7', '46', '09514781767', 'elexis.falceso1@cvsu.edu.ph', '$2y$10$BAN.7kXKyZSwV9sSlnhl/uC9XFnTo/b9khVMkbtsA8XlZHrcDg.cq', '1', 'user'),
(23, 'Elexis', 'Falceso', '7', '41', '09514781767', 'elexis.falceso2@cvsu.edu.ph', '$2y$10$wspIsMancDjvUwXI4JngDe7TyoysTh05XjVsJeAve1biaybrrkO9y', '1', 'user');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `course_description`
--
ALTER TABLE `course_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_leaning`
--
ALTER TABLE `course_leaning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `course_syllabus`
--
ALTER TABLE `course_syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `decriptors`
--
ALTER TABLE `decriptors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `graduates_attributes`
--
ALTER TABLE `graduates_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `laerning_final`
--
ALTER TABLE `laerning_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mapping_table`
--
ALTER TABLE `mapping_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `module_learning`
--
ALTER TABLE `module_learning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `module_learning_final`
--
ALTER TABLE `module_learning_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `online_refference`
--
ALTER TABLE `online_refference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `onsite_reffence`
--
ALTER TABLE `onsite_reffence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `percent`
--
ALTER TABLE `percent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semestral`
--
ALTER TABLE `semestral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
