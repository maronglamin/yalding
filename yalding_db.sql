-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2021 at 01:21 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yalding_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `adm_no` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `join_date` timestamp NULL DEFAULT current_timestamp(),
  `permission` tinyint(4) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`adm_no`, `full_name`, `email`, `password`, `last_login`, `join_date`, `permission`, `deleted`) VALUES
(1, 'comma admin', 'admin@yalding.edu.gm', '$2y$10$n5.XtAVVbD97i0oxP2XZ4.o59RWzQgMIjY7r6/Rn20FWQmKggLnJi', '2021-05-29 09:34:13', '2021-05-29 09:34:13', 1, 0),
(4, 'modou lamin marong', 'dev@admin.com', '$2y$10$qW1tf2ZbcDnq02vMBtzkgewstLjOcD63wx6paowfWAp9MnPCygiQu', '2021-08-18 13:01:49', '2021-06-19 11:19:41', 1, 0),
(6, 'modou lamin marong', 'ad@yalding.edu.gm', '$2y$10$K0giXOA60B4XkRc09tJ.aeswWjQ5dZ4O5UPG1wWEEeujrae6fLjcm', '2021-08-18 13:09:42', '2021-08-18 12:32:13', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assig_subj_techer`
--

CREATE TABLE `assig_subj_techer` (
  `id` int(11) NOT NULL,
  `stuff_no` varchar(20) NOT NULL,
  `subj_no` varchar(20) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assig_subj_techer`
--

INSERT INTO `assig_subj_techer` (`id`, `stuff_no`, `subj_no`, `class_id`) VALUES
(14, '2', '6', 1),
(15, '1', '5', 6),
(16, '1', '1', 1),
(17, '1', '2', 2),
(18, '1', '1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `class_grade`
--

CREATE TABLE `class_grade` (
  `class_id` int(11) NOT NULL,
  `grade_name` varchar(20) NOT NULL,
  `staff_id` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_grade`
--

INSERT INTO `class_grade` (`class_id`, `grade_name`, `staff_id`) VALUES
(1, 'Grade 7 circle', NULL),
(2, 'Grade 7 Square', NULL),
(3, 'Grade 8 circle', NULL),
(4, 'Grade 8 Square', NULL),
(5, 'Grade 9 circle', NULL),
(6, 'Grade 9 Square', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_name`
--

CREATE TABLE `class_name` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `class_teacher` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `class_teacher`
--

CREATE TABLE `class_teacher` (
  `staff_no` int(11) NOT NULL,
  `class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_data_values`
--

CREATE TABLE `lesson_data_values` (
  `id` int(11) NOT NULL,
  `times` varchar(15) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `general_objective` int(11) NOT NULL,
  `specific_objective` text NOT NULL,
  `procedures` text NOT NULL,
  `activities` text NOT NULL,
  `reference` text NOT NULL,
  `summary` text NOT NULL,
  `evaluation` text NOT NULL DEFAULT current_timestamp(),
  `date_filled` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plan`
--

CREATE TABLE `lesson_plan` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `first_record` text NOT NULL,
  `general_objective` text DEFAULT NULL,
  `specific_objective` text DEFAULT NULL,
  `procedures` text DEFAULT NULL,
  `activities` text DEFAULT NULL,
  `reference` text DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `evaluation` text DEFAULT NULL,
  `permit` tinyint(4) NOT NULL DEFAULT 0,
  `planed_date` varchar(10) NOT NULL,
  `date_filled` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lesson_plan`
--

INSERT INTO `lesson_plan` (`id`, `staff_id`, `class_id`, `first_record`, `general_objective`, `specific_objective`, `procedures`, `activities`, `reference`, `summary`, `evaluation`, `permit`, `planed_date`, `date_filled`) VALUES
(1, 1, 6, '{\"staff\":\"1\",\"subject\":\"English language\",\"start-time\":\"12:45\",\"end-time\":\"13:45\",\"period\":\"5\",\"unit-topic\":\"Grammer\",\"specific-topic\":\"Nouns\"}', 'mfmgg ,mdbmb mf,bdfnjkldfjru kjfbjkburg kljnjbrj jkdkjujb', 'kvdkjvvbkjvbdjvb', 'kvdkjvvbkjvbdjvb', 'kvdkjvvbkjvbdjvb', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente itaque magnam enim ea possimus ex delectus quibusdam reiciendis rerum obcaecati ipsa maiores officia facilis perspiciatis quod commodi reprehenderit, labore modi!\r\n', 'kvdkjvvbkjvbdjvb', 'kvdkjvvbkjvbdjvb', 0, '2021-07-02', '2021-07-02 12:47:18'),
(2, 1, 2, '{\"staff\":\"1\",\"subject\":\"mathematics\",\"start-time\":\"14:40\",\"end-time\":\"16:40\",\"period\":\"4\",\"unit-topic\":\"geometry\",\"specific-topic\":\"triangle\"}', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente itaque magnam enim ea possimus ex delectus quibusdam reiciendis rerum obcaecati ipsa maiores officia facilis perspiciatis quod commodi reprehenderit, labore modi!\r\n', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente itaque magnam enim ea possimus ex delectus quibusdam reiciendis rerum obcaecati ipsa maiores officia facilis perspiciatis quod commodi reprehenderit, labore modi!\r\n', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente itaque magnam enim ea possimus ex delectus quibusdam reiciendis rerum obcaecati ipsa maiores officia facilis perspiciatis quod commodi reprehenderit, labore modi!\r\n', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente itaque magnam enim ea possimus ex delectus quibusdam reiciendis rerum obcaecati ipsa maiores officia facilis perspiciatis quod commodi reprehenderit, labore modi!\r\n', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente itaque magnam enim ea possimus ex delectus quibusdam reiciendis rerum obcaecati ipsa maiores officia facilis perspiciatis quod commodi reprehenderit, labore modi!\r\n', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente itaque magnam enim ea possimus ex delectus quibusdam reiciendis rerum obcaecati ipsa maiores officia facilis perspiciatis quod commodi reprehenderit, labore modi!\r\n', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente itaque magnam enim ea possimus ex delectus quibusdam reiciendis rerum obcaecati ipsa maiores officia facilis perspiciatis quod commodi reprehenderit, labore modi!\r\n', 1, '2021-07-10', '2021-07-09 22:33:47'),
(3, 1, 1, '{\"staff\":\"1\",\"subject\":\"ses\",\"class\":\"1\",\"start-time\":\"13:40\",\"end-time\":\"14:41\",\"period\":\"2\",\"unit-topic\":\"geometry\",\"specific-topic\":\"nvvjnkfvnfj\"}', 'kjnlr,ngbnkj;nlkb;nbr', 'm,bn,fnboijitjt', 'kj;nlkfbnklni', 'kbfgbnlfkbnbfljk', 'jgjnjnfbjnbjbnjfbnjfbnbjbjfbnjfb', 'jnbmfnbm,fnbmfbnm,', 'nm,fnbfbnm,fnbnb', 0, '2021-09-07', '2021-08-17 11:39:15'),
(5, 1, 3, '{\"staff\":\"1\",\"subject\":\"ses\",\"start-time\":\"12:54\",\"end-time\":\"10:52\",\"period\":\"2\",\"unit-topic\":\"hfhfhf\",\"specific-topic\":\"jfjfjfjf\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-12', '2021-08-19 22:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `date_join` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` varchar(20) DEFAULT '0000 00 00 00:00:00',
  `role` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `permitted` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `full_name`, `email`, `password`, `date_join`, `last_login`, `role`, `status`, `permitted`, `deleted`) VALUES
(1, 'comma lastName', 'comma@yalding.edu.gm', '$2y$10$hSvA3uxnQfB4NVPMjp8L2uIfb6pdQ7dDwe4seCQe06JgXjNwhw61y', '2021-05-16 14:40:47', '2021-05-29 11:16:38', '0', 0, 1, 0),
(2, 'marong', 'admin@yalding.edu.gm', '$2y$10$ANeDjF6Fr4JBx44FDTChRefvtNnfX6vtXTKnD.eCTft4vkWk7hkQq', '2021-07-14 01:03:33', '0000 00 00 00:00:00', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stud_adm_info`
--

CREATE TABLE `stud_adm_info` (
  `stud_id` int(11) NOT NULL,
  `stud_fname` varchar(50) DEFAULT NULL,
  `stud_lname` varchar(50) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `new_email` varchar(75) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `gender` tinyint(11) DEFAULT NULL,
  `tele` varchar(15) DEFAULT NULL,
  `stud_parent_name` varchar(100) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `eth` varchar(100) DEFAULT NULL,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `stud_place_birth` varchar(50) DEFAULT NULL,
  `pschool` varchar(50) DEFAULT NULL,
  `path` varchar(200) NOT NULL,
  `enrolled` tinyint(4) NOT NULL DEFAULT 0,
  `date_form_filled` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stud_adm_info`
--

INSERT INTO `stud_adm_info` (`stud_id`, `stud_fname`, `stud_lname`, `email`, `new_email`, `password`, `gender`, `tele`, `stud_parent_name`, `address`, `eth`, `date_of_birth`, `stud_place_birth`, `pschool`, `path`, `enrolled`, `date_form_filled`, `status`) VALUES
(13, 'modou lamin', 'marong', 'mlmarong14036@gmail.com', 'mlm210001@yalding.edu.gm', '$2y$10$LXERdFA1/5v.FxkqdMymm.m584k3Mn0oLE/RQXy5BOYabf4Fla7Di', 1, '1847843', 'comma', 'brikama', 'mandinka', '', 'kiang karantaba', 'jamisa upper basic school', '/stud_passImage/Screenshot (7).png', 1, '2021-07-11 13:37:44', 1),
(14, 'jvbvbfnbvbfv', 'kjvbbfkdbdkufbjfkb', 'comma@yalding.edu.gm', 'comma@yalding.edu.gm', '$2y$10$aOj46A.0qY/hDRX.6Mh5TOFD4x78Qe2F/K.4yNTzk.oypiUceCLbS', 1, '757558', 'jjgjbnbjbn', 'jjgjbnm,r', 'jgjgugnigitg', '', 'vbvvjkfhfgud', 'jkj8thjrhi', '/stud_passImage/Screenshot (6).png', 1, '2021-07-11 14:19:20', 1),
(15, 'name', 'last name', 'email@mail.com', NULL, '$2y$10$h5WjR5r9SiQUGC1lK2vS8umbCFBJI5RGjS3.9.oVbnTbRndsBjkre', 1, '1847843', 'parent', 'brikama', 'mandinka', '', 'place birth', 'previous school', '/stud_passImage/Screenshot (8).png', 0, '2021-07-27 18:09:16', 0),
(16, 'mcnn', 'kjj nc njnvnf', 'mlm@gmail.com', 'mlm@yalding.edu.gm', '$2y$10$VduLMeo/dHOQlX2pWFeQd.2HV8UC5Vd36rvhMdD20Rhj9U/Zfoa52', 1, '7675757', 'nbnnbn', 'jb knbjb', 'bnbnbn', '', 'v,,,bvvbu', 'vnvnfbijffuv', '/stud_passImage/Screenshot (5).png', 1, '2021-08-17 11:26:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stud_class`
--

CREATE TABLE `stud_class` (
  `id` int(11) NOT NULL,
  `stud_number` varchar(10) NOT NULL,
  `stud_class` varchar(20) NOT NULL,
  `stud_adm_no` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stud_class`
--

INSERT INTO `stud_class` (`id`, `stud_number`, `stud_class`, `stud_adm_no`, `status`) VALUES
(5, 'SN210001', '3', 13, 1),
(6, 'SN21003', '3', 14, 1),
(7, 'SN21004', '3', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stud_reports`
--

CREATE TABLE `stud_reports` (
  `id` int(11) NOT NULL,
  `stud_no` int(11) NOT NULL,
  `stud_class` varchar(15) NOT NULL,
  `subj` int(11) NOT NULL,
  `test1` int(11) NOT NULL,
  `test2` int(11) NOT NULL,
  `exam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stud_reports`
--

INSERT INTO `stud_reports` (`id`, `stud_no`, `stud_class`, `subj`, `test1`, `test2`, `exam`) VALUES
(5, 13, '3', 1, 23, 23, 40),
(6, 14, '3', 1, 21, 21, 20);

-- --------------------------------------------------------

--
-- Table structure for table `subject_junior`
--

CREATE TABLE `subject_junior` (
  `subj_no` int(11) NOT NULL,
  `subj_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_junior`
--

INSERT INTO `subject_junior` (`subj_no`, `subj_name`) VALUES
(1, 'English Language'),
(2, 'Mathematics'),
(3, 'General Science'),
(5, 'Agricultural sceince'),
(6, 'French');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`adm_no`);

--
-- Indexes for table `assig_subj_techer`
--
ALTER TABLE `assig_subj_techer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_grade`
--
ALTER TABLE `class_grade`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_name`
--
ALTER TABLE `class_name`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `lesson_data_values`
--
ALTER TABLE `lesson_data_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_plan`
--
ALTER TABLE `lesson_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stud_adm_info`
--
ALTER TABLE `stud_adm_info`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `stud_class`
--
ALTER TABLE `stud_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stud_reports`
--
ALTER TABLE `stud_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_junior`
--
ALTER TABLE `subject_junior`
  ADD PRIMARY KEY (`subj_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `adm_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assig_subj_techer`
--
ALTER TABLE `assig_subj_techer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `class_grade`
--
ALTER TABLE `class_grade`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class_name`
--
ALTER TABLE `class_name`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lesson_data_values`
--
ALTER TABLE `lesson_data_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson_plan`
--
ALTER TABLE `lesson_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stud_adm_info`
--
ALTER TABLE `stud_adm_info`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stud_class`
--
ALTER TABLE `stud_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stud_reports`
--
ALTER TABLE `stud_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subject_junior`
--
ALTER TABLE `subject_junior`
  MODIFY `subj_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
