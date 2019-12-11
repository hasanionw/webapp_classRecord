-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2019 at 07:16 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `class_record`
--
CREATE DATABASE IF NOT EXISTS `class_record` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `class_record`;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `courseCode` varchar(10) NOT NULL,
  `courseDesc` varchar(100) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `courseCode`, `courseDesc`, `teacher_id`) VALUES
(41, 'ICT 141', 'Web App', 4),
(49, 'ICT 146', 'Capstone Project', 2),
(51, 'IT 3301', 'Capstone Proposal', 1),
(52, 'ICT 138', 'Cisco 2', 9),
(53, 'ICT 126', 'Multimedia', 12),
(54, 'ICT 167', 'Operating Systems', 13),
(55, 'ICT 131', 'Database I', 8),
(57, 'ICT 134', 'Oral Communication I', 6);

-- --------------------------------------------------------

--
-- Table structure for table `classlist`
--

CREATE TABLE `classlist` (
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `PMG` decimal(10,1) NOT NULL,
  `MG` decimal(10,1) NOT NULL,
  `PFG` decimal(10,1) NOT NULL,
  `FG` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classlist`
--

INSERT INTO `classlist` (`class_id`, `student_id`, `PMG`, `MG`, `PFG`, `FG`) VALUES
(41, 15101337, '2.4', '2.1', '1.3', '1.9'),
(41, 15101338, '3.4', '5.0', '5.0', '4.5'),
(41, 15101339, '2.4', '2.1', '1.3', '1.9'),
(41, 15101341, '2.9', '3.0', '1.3', '2.4'),
(41, 15101343, '1.0', '1.2', '1.0', '1.1'),
(41, 15101349, '1.0', '1.6', '3.9', '2.2'),
(51, 15101337, '1.0', '1.0', '1.2', '1.1'),
(51, 15101338, '3.6', '3.4', '1.0', '2.7'),
(52, 15101337, '2.1', '2.0', '1.4', '1.8'),
(52, 15101338, '0.0', '0.0', '0.0', '0.0'),
(52, 15101339, '0.0', '0.0', '0.0', '0.0'),
(52, 15101341, '0.0', '0.0', '0.0', '0.0'),
(52, 15101348, '0.0', '0.0', '0.0', '0.0'),
(52, 15101349, '0.0', '0.0', '0.0', '0.0'),
(55, 15101337, '0.0', '0.0', '0.0', '0.0'),
(55, 15101338, '0.0', '0.0', '0.0', '0.0'),
(55, 15101339, '0.0', '0.0', '0.0', '0.0'),
(55, 15101341, '0.0', '0.0', '0.0', '0.0'),
(55, 15101342, '0.0', '0.0', '0.0', '0.0'),
(55, 15101343, '0.0', '0.0', '0.0', '0.0'),
(55, 15101344, '0.0', '0.0', '0.0', '0.0'),
(55, 15101345, '0.0', '0.0', '0.0', '0.0'),
(55, 15101346, '0.0', '0.0', '0.0', '0.0'),
(55, 15101348, '0.0', '0.0', '0.0', '0.0'),
(55, 15101349, '0.0', '0.0', '0.0', '0.0'),
(55, 15101350, '0.0', '0.0', '0.0', '0.0'),
(55, 15101351, '0.0', '0.0', '0.0', '0.0'),
(55, 15101352, '0.0', '0.0', '0.0', '0.0'),
(55, 15101353, '0.0', '0.0', '0.0', '0.0'),
(55, 15101354, '0.0', '0.0', '0.0', '0.0'),
(55, 15101355, '0.0', '0.0', '0.0', '0.0'),
(55, 15101356, '0.0', '0.0', '0.0', '0.0'),
(55, 15101357, '0.0', '0.0', '0.0', '0.0'),
(55, 15101358, '0.0', '0.0', '0.0', '0.0');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id_num` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL DEFAULT 'NULL',
  `lname` varchar(20) NOT NULL DEFAULT 'NULL',
  `course` varchar(10) DEFAULT NULL,
  `yearlvl` int(11) DEFAULT NULL,
  `m_init` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id_num`, `fname`, `lname`, `course`, `yearlvl`, `m_init`) VALUES
(15101337, 'Weinnand', 'Hasanion', 'BSICT', 4, 'A'),
(15101338, 'Romhel', 'Ceniza', 'BSICT', 3, 'M'),
(15101339, 'Michael', 'Antiporta', 'BSICT', 4, 'A'),
(15101340, 'Thomas Rey', 'Barcenas', 'BSICT', 4, 'M'),
(15101341, 'Justine', 'Garcia', 'BSICT', 3, 'V'),
(15101342, 'Jade', 'Tibon', 'BSICT', 4, 'A'),
(15101343, 'Klint  John', 'Cagot', 'BSICT', 4, 'B'),
(15101344, 'Michael Jeffrey', 'Quimbo', 'BSICT', 4, 'C'),
(15101345, 'Ivanne Ray', 'Candano', 'BSICT', 3, 'E'),
(15101346, 'Christian James', 'Nueve', 'BSIS', 1, 'A'),
(15101347, 'Francis Orven', 'Vasquez', 'BSICT', 4, 'D'),
(15101348, 'Michael', 'Mayol', 'BSICT', 4, 'G'),
(15101349, 'Jay', 'Demerin', 'BSICT', 4, 'A'),
(15101350, 'Jove', 'Moralde', 'BSICT', 3, 'P'),
(15101351, 'Chiekko', 'Aliño', 'BSICT', 4, 'G'),
(15101352, 'Wilmar', 'Zaragosa', 'BSICT', 4, 'A'),
(15101353, 'Ray Joseph', 'Villafranca', 'BSICT', 4, 'C'),
(15101354, 'Victor', 'Chiong', 'BSCS', 4, 'C'),
(15101355, 'Glynn', 'Lumasag', 'BSCS', 3, 'G'),
(15101356, 'Bryce', 'Tumapon', 'BSIS', 2, 'P'),
(15101357, 'Jason', 'Vero', 'BSIT', 4, 'D'),
(15101358, 'Gemnil', 'Ruales', 'BSIT', 4, 'C'),
(15101359, 'Wyatt', 'Yap', 'BSIT', 4, 'G');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `fname`, `lname`, `username`, `password`) VALUES
(1, 'Christian', 'Maderazo', '', ''),
(2, 'Angie', 'Ceniza', '', ''),
(3, 'Ean', 'Velayo', '', ''),
(4, 'Patrick', 'Elalto', '', ''),
(5, 'Francisgian', 'Opone', '', ''),
(6, 'Kris', 'Capao', '', ''),
(7, 'Maria Lisa', 'Navarrete', '', ''),
(8, 'Glenn', 'Pepito', '', ''),
(9, 'Godwin', 'Monserate', '', ''),
(10, 'John Rex', 'Paña', '', ''),
(11, 'Christine', 'Peña', '', ''),
(12, 'Khent', 'Dela Paz', '', ''),
(13, 'Archival', 'Sebial', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `classlist`
--
ALTER TABLE `classlist`
  ADD PRIMARY KEY (`class_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_num`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15101360;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

--
-- Constraints for table `classlist`
--
ALTER TABLE `classlist`
  ADD CONSTRAINT `classlist_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `classlist_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
