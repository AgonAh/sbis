-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2019 at 04:58 PM
-- Server version: 5.6.24-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sbis`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`) VALUES
(1, 'CSE'),
(2, 'Ekonomi');

-- --------------------------------------------------------

--
-- Table structure for table `generations`
--

CREATE TABLE `generations` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `generations`
--

INSERT INTO `generations` (`id`, `name`) VALUES
(1, '2017/2018'),
(2, '2018/2019'),
(3, '2019/2020');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `staff_id`) VALUES
(1, 1),
(2, 4),
(3, 10),
(4, 13),
(5, 14),
(6, 15),
(7, 16),
(8, 18);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`id`, `staff_id`) VALUES
(1, 2),
(2, 3),
(3, 5),
(4, 6),
(5, 7),
(6, 8),
(7, 9),
(8, 11),
(9, 12),
(10, 17);

-- --------------------------------------------------------

--
-- Table structure for table `professor_subject`
--

CREATE TABLE `professor_subject` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `professor_subject`
--

INSERT INTO `professor_subject` (`id`, `professor_id`, `subject_id`) VALUES
(1, 2, 3),
(2, 1, 3),
(3, 2, 1),
(4, 2, 2),
(5, 7, 5),
(6, 2, 4),
(7, 9, 1),
(8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'manager'),
(2, 'professor');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `username`, `password`, `role_id`, `created_at`) VALUES
(1, 'admin', 'admin', '92092e04f29bfb6a92327e7cb64a2a16', 1, '2019-11-01 14:09:07'),
(2, 'Professor one', 'professor1', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '2019-11-01 14:09:07'),
(3, 'Professor two', 'professor2', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '2019-11-01 14:09:07'),
(9, 'test1', 'test1', '5a105e8b9d40e1329780d62ea2265d8a', 2, '2019-11-01 15:23:38'),
(10, 'test2', 'test2', 'ad0234829205b9033196ba818f7a872b', 1, '2019-11-01 15:24:23'),
(11, 'test3', 'test3', '8ad8757baa8564dc136c1e07507f4a98', 2, '2019-11-01 15:26:32'),
(12, 'test4', 'test4', '86985e105f79b95d6bc918fb45ec7727', 2, '2019-11-01 15:27:32'),
(13, 'test5', 'test5', 'e3d704f3542b44a621ebed70dc0efe13', 1, '2019-11-01 15:27:45'),
(14, 'test6', 'test6', '4cfad7076129962ee70c36839a1e3e15', 1, '2019-11-01 15:28:21'),
(15, 'test7', 'test7', 'b04083e53e242626595e2b8ea327e525', 1, '2019-11-01 15:30:09'),
(16, 'test9', 'test9', '739969b53246b2c727850dbb3490ede6', 1, '2019-11-01 15:31:53'),
(17, 'test10', 'test10', 'c1a8e059bfd1e911cf10b626340c9a54', 2, '2019-11-01 15:32:03'),
(18, 'agon', 'agon', 'e07217d0fcb0d5594b59c37ff0a6f483', 1, '2019-11-04 09:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `generation_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `username`, `password`, `generation_id`, `branch_id`, `created_at`) VALUES
(1, 'Student1', 'Student1', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 14:09:56'),
(2, 'Student 2', 'student2', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 14:09:56'),
(3, 'Professor3', 'professor3', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 2, '2019-11-01 14:09:56'),
(4, 'Validation test', 'validationtest', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 14:09:56'),
(5, 'test1', 'tset1', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 14:46:38'),
(6, 'test2', 'test2', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 14:48:02'),
(7, 'test3', 'test3', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 14:49:21'),
(9, 'test4', 'test4', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 14:51:00'),
(10, 'test5', 'test5', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 14:54:15'),
(11, 'test6', 'test6', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 14:54:36'),
(12, 'test7', 'test7', 'b04083e53e242626595e2b8ea327e525', 3, 1, '2019-11-01 14:55:50'),
(13, 'test8', 'test8', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 14:58:15'),
(14, 'test9', 'test9', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2019-11-01 15:00:22'),
(15, 'test10', 'test10', 'c1a8e059bfd1e911cf10b626340c9a54', 3, 1, '2019-11-01 15:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `id` int(11) NOT NULL,
  `professor_subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade` tinyint(3) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`id`, `professor_subject_id`, `student_id`, `subject_id`, `grade`, `active`) VALUES
(1, 3, 1, 1, NULL, 0),
(3, 1, 1, 2, 7, 1),
(4, 3, 2, 1, NULL, 0),
(5, 4, 2, 2, 8, 1),
(6, 2, 2, 3, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ects` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `generation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `ects`, `branch_id`, `generation_id`) VALUES
(1, 'Java 1', 5, 1, 3),
(2, 'Java 2', 7, 1, 3),
(3, 'SQL', 5, 1, 3),
(4, 'Hyrje ne ekonomi', 3, 2, 3),
(5, 'valtest', 5, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generations`
--
ALTER TABLE `generations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professor_subject`
--
ALTER TABLE `professor_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_unique` (`username`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `generations`
--
ALTER TABLE `generations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `professor_subject`
--
ALTER TABLE `professor_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `student_subject`
--
ALTER TABLE `student_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
