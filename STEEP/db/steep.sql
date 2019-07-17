-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2019 at 05:10 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `steep`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `c_id` varchar(50) NOT NULL,
  `id` varchar(50) NOT NULL,
  `question` mediumtext NOT NULL,
  `due` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`c_id`, `id`, `question`, `due`) VALUES
('C1', 'C1_1', 'this is the first question', '2019-04-12'),
('C1', 'C1_2', 'second question', '2019-04-12'),
('C3', 'C3_1', 'this is the third question', '2019-04-26'),
('C55', 'C55_1', 'find net id , first address last address,?', '2019-04-17'),
('C', 'C_1', 'jsacbjcvbhjvh', '2019-04-17'),
('C', 'C_2', 'acesac', '2019-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `c_id` varchar(50) NOT NULL,
  `a_id` varchar(50) NOT NULL,
  `roll` varchar(50) NOT NULL,
  `file_id` int(11) NOT NULL,
  `file_type` varchar(225) NOT NULL,
  `submit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file` varchar(225) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'not yet evaluated',
  `marks` varchar(255) NOT NULL DEFAULT '0',
  `file_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment_submissions`
--

INSERT INTO `assignment_submissions` (`c_id`, `a_id`, `roll`, `file_id`, `file_type`, `submit_date`, `file`, `status`, `marks`, `file_name`) VALUES
('C1', 'C1_1', '1602-16-733-001', 14, 'txt', '2019-04-10 04:26:36', '791170.txt', 'not yet evaluated', '0', 'My Solution'),
('C1', 'C1_2', '1602-16-733-001', 17, 'txt', '2019-04-10 04:53:03', '938608.txt', 'not yet evaluated', '0', 'My Solution'),
('C3', 'C3_1', '1602-16-733-001', 18, 'txt', '2019-04-10 12:14:19', '630303.txt', 'Approved', '0', 'My Solution'),
('C', 'C_1', '1602-16-733-001', 21, 'txt', '2019-04-11 03:09:35', '460087.txt', 'Approved', '3', 'My Solution');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `c_name` varchar(50) NOT NULL,
  `c_id` varchar(50) NOT NULL,
  `c_start` date NOT NULL,
  `c_end` date NOT NULL,
  `c_year` int(11) NOT NULL,
  `c_stream` varchar(50) NOT NULL,
  `c_section` varchar(50) NOT NULL,
  `faculty_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`c_name`, `c_id`, `c_start`, `c_end`, `c_year`, `c_stream`, `c_section`, `faculty_id`) VALUES
('EFE', 'C', '2019-04-06', '2019-04-25', 1, 'CSE', 'A', '1970'),
('WPS', 'C1', '2019-04-02', '2019-04-18', 1, 'CSE', 'A', '1970'),
('AI', 'C10', '2019-04-12', '2019-04-20', 1, 'CSE', 'A', '1970'),
('CC', 'C2', '2019-04-02', '2019-04-18', 1, 'CSE', 'A', '1970'),
('IP', 'C3', '2019-04-09', '2019-04-26', 1, 'CSE', 'A', '1970'),
('SE', 'C4', '2019-04-01', '2019-04-03', 1, 'CSE', 'A', '1970'),
('WPS2', 'C5', '2019-04-10', '2019-04-20', 2, 'CSE', 'A', '1970'),
('cisco', 'C55', '2019-04-10', '2019-04-27', 1, 'ECE', 'A', '1586');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `department` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`username`, `email`, `id`, `gender`, `dob`, `phone`, `department`, `role`, `password`) VALUES
('Abhiram dk', 'kallu.12345@gmail.com', '1586', 'male', '1991-04-20', '9485638899', 'ECE', 'Hod', '140f191a4b1e70e80404b061d8f3caec'),
('Abhiram', 'aditya.abhi123@gmail.com', '1970', 'male', '2019-04-17', '9704959277', 'CSE', 'Hod', '296e35b976f125c05f715776f1d719a1'),
('Aditya', 'aditya.andukuri3333@gmail.com', '1971', 'male', '2017-04-04', '9704959277', 'CSE', 'Assistant Professor', '296e35b976f125c05f715776f1d719a1');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `c_id` varchar(50) NOT NULL,
  `id` varchar(50) NOT NULL,
  `qno` int(11) NOT NULL,
  `due` date NOT NULL,
  `question_1` mediumtext NOT NULL,
  `choice_1_1` text NOT NULL,
  `choice_1_2` text NOT NULL,
  `choice_1_3` text NOT NULL,
  `choice_1_4` text NOT NULL,
  `correct_1` varchar(1) NOT NULL,
  `question_2` mediumtext NOT NULL,
  `choice_2_1` text NOT NULL,
  `choice_2_2` text NOT NULL,
  `choice_2_3` text NOT NULL,
  `choice_2_4` text NOT NULL,
  `correct_2` varchar(1) NOT NULL,
  `question_3` mediumtext NOT NULL,
  `choice_3_1` text NOT NULL,
  `choice_3_2` text NOT NULL,
  `choice_3_3` text NOT NULL,
  `choice_3_4` text NOT NULL,
  `correct_3` varchar(1) NOT NULL,
  `question_4` mediumtext NOT NULL,
  `choice_4_1` text NOT NULL,
  `choice_4_2` text NOT NULL,
  `choice_4_3` text NOT NULL,
  `choice_4_4` text NOT NULL,
  `correct_4` varchar(1) NOT NULL,
  `question_5` mediumtext NOT NULL,
  `choice_5_1` text NOT NULL,
  `choice_5_2` text NOT NULL,
  `choice_5_3` text NOT NULL,
  `choice_5_4` text NOT NULL,
  `correct_5` varchar(1) NOT NULL,
  `question_6` mediumtext NOT NULL,
  `choice_6_1` text NOT NULL,
  `choice_6_2` text NOT NULL,
  `choice_6_3` text NOT NULL,
  `choice_6_4` text NOT NULL,
  `correct_6` varchar(1) NOT NULL,
  `question_7` mediumtext NOT NULL,
  `choice_7_1` text NOT NULL,
  `choice_7_2` text NOT NULL,
  `choice_7_3` text NOT NULL,
  `choice_7_4` text NOT NULL,
  `correct_7` varchar(1) NOT NULL,
  `question_8` mediumtext NOT NULL,
  `choice_8_1` text NOT NULL,
  `choice_8_2` text NOT NULL,
  `choice_8_3` text NOT NULL,
  `choice_8_4` text NOT NULL,
  `correct_8` varchar(1) NOT NULL,
  `question_9` mediumtext NOT NULL,
  `choice_9_1` text NOT NULL,
  `choice_9_2` text NOT NULL,
  `choice_9_3` text NOT NULL,
  `choice_9_4` text NOT NULL,
  `correct_9` varchar(1) NOT NULL,
  `question_10` mediumtext NOT NULL,
  `choice_10_1` text NOT NULL,
  `choice_10_2` text NOT NULL,
  `choice_10_3` text NOT NULL,
  `choice_10_4` text NOT NULL,
  `correct_10` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`c_id`, `id`, `qno`, `due`, `question_1`, `choice_1_1`, `choice_1_2`, `choice_1_3`, `choice_1_4`, `correct_1`, `question_2`, `choice_2_1`, `choice_2_2`, `choice_2_3`, `choice_2_4`, `correct_2`, `question_3`, `choice_3_1`, `choice_3_2`, `choice_3_3`, `choice_3_4`, `correct_3`, `question_4`, `choice_4_1`, `choice_4_2`, `choice_4_3`, `choice_4_4`, `correct_4`, `question_5`, `choice_5_1`, `choice_5_2`, `choice_5_3`, `choice_5_4`, `correct_5`, `question_6`, `choice_6_1`, `choice_6_2`, `choice_6_3`, `choice_6_4`, `correct_6`, `question_7`, `choice_7_1`, `choice_7_2`, `choice_7_3`, `choice_7_4`, `correct_7`, `question_8`, `choice_8_1`, `choice_8_2`, `choice_8_3`, `choice_8_4`, `correct_8`, `question_9`, `choice_9_1`, `choice_9_2`, `choice_9_3`, `choice_9_4`, `correct_9`, `question_10`, `choice_10_1`, `choice_10_2`, `choice_10_3`, `choice_10_4`, `correct_10`) VALUES
('C1', 'C1_1', 0, '2019-04-16', 'hello', 'one', 'two', 'three', 'four', 'b', 'world', 'mnb', 'vcx', 'xzj', 'fdt', 'c', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('C1', 'C1_2', 0, '2019-04-06', 'vhjvgh', 'hgcghc', 'hggcgh', 'c', 'cghc', 'a', 'cccghv', 'hh', 'gghch', 'jcgh', 'hjv', 'a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('C1', 'C1_3', 0, '2019-04-11', 'sc', 'jkjk', 'hh', 'jh', 'fhg', 'a', 'jh', 'hj', 'jhv', 'gh', 'jkkb', 'a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('C3', 'C3_1', 0, '2019-04-11', 'ss', 'eee', 'ggg', 'cgc', 'gc', 'a', 'ch', 'ch', 'ch', 'ch', 'ch', 'b', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('C', 'C_1', 0, '2019-04-10', 'hgc', 'ghhg', 'gh', 'cgh', 'cgh', 'b', 'c', 'cgh', 'cgh', 'cgh', 'cgh', 'b', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_submissions`
--

CREATE TABLE `quiz_submissions` (
  `c_id` varchar(50) NOT NULL,
  `a_id` varchar(50) NOT NULL,
  `roll` varchar(50) NOT NULL,
  `marks` varchar(10) NOT NULL,
  `submit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_submissions`
--

INSERT INTO `quiz_submissions` (`c_id`, `a_id`, `roll`, `marks`, `submit_date`, `id`) VALUES
('C', 'C_1', '1602-16-733-001', '2', '2019-04-10 13:40:08', 33);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `roll` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `doa` date NOT NULL,
  `year` int(10) NOT NULL,
  `stream` varchar(30) NOT NULL,
  `section` varchar(5) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`username`, `email`, `roll`, `gender`, `dob`, `phone`, `doa`, `year`, `stream`, `section`, `password`) VALUES
('Aditya', 'aditya.abhi123@gmail.com', '1602-16-733-001', 'male', '2019-04-08', '9704959277', '2019-04-01', 1, 'CSE', 'A', '296e35b976f125c05f715776f1d719a1'),
('sm krishna', 'murralisai55@gmail.com', '1602-16-733-002', 'male', '1997-06-20', '9494863397', '2019-04-10', 1, 'ECE', 'A', '02dcdbefdc98e61c39c462dc49c8a92f');

-- --------------------------------------------------------

--
-- Table structure for table `student_takes_course`
--

CREATE TABLE `student_takes_course` (
  `c_id` varchar(50) NOT NULL,
  `s_roll` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_takes_course`
--

INSERT INTO `student_takes_course` (`c_id`, `s_roll`) VALUES
('C1', '1602-16-733-001'),
('C2', '1602-16-733-001'),
('C3', '1602-16-733-001'),
('C4', '1602-16-733-001'),
('C10', '1602-16-733-001'),
('C', '1602-16-733-001'),
('C55', '1602-16-733-002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `a_id` (`a_id`),
  ADD KEY `roll` (`roll`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `a_id` (`a_id`),
  ADD KEY `roll` (`roll`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`roll`);

--
-- Indexes for table `student_takes_course`
--
ALTER TABLE `student_takes_course`
  ADD KEY `c_id` (`c_id`),
  ADD KEY `s_roll` (`s_roll`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`);

--
-- Constraints for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD CONSTRAINT `assignment_submissions_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`),
  ADD CONSTRAINT `assignment_submissions_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `assignments` (`id`),
  ADD CONSTRAINT `assignment_submissions_ibfk_3` FOREIGN KEY (`roll`) REFERENCES `students` (`roll`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`);

--
-- Constraints for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  ADD CONSTRAINT `quiz_submissions_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`),
  ADD CONSTRAINT `quiz_submissions_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `quiz_submissions_ibfk_3` FOREIGN KEY (`roll`) REFERENCES `students` (`roll`);

--
-- Constraints for table `student_takes_course`
--
ALTER TABLE `student_takes_course`
  ADD CONSTRAINT `student_takes_course_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_takes_course_ibfk_2` FOREIGN KEY (`s_roll`) REFERENCES `students` (`roll`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
