-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2017 at 08:29 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `phone`, `email`, `password`, `status`) VALUES
(1, 'Palash Roy', 'palash', '01723156121', 'palash.cmt@gmail.com', '123456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `daily_date` date NOT NULL,
  `entry_time` time NOT NULL,
  `exit_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `daily_date`, `entry_time`, `exit_time`) VALUES
(1, 2, '2017-05-10', '16:58:49', '00:00:00'),
(2, 2, '2017-05-11', '08:39:09', '08:10:26'),
(3, 2, '2017-05-12', '07:36:06', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `joining_date` date NOT NULL DEFAULT '0000-00-00',
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `user_role` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = User, 1 = Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='phone';

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `designation`, `address`, `phone`, `joining_date`, `email`, `username`, `password`, `status`, `user_role`) VALUES
(1, 'Sujon', 'IT', 'badda', '01227843', '0000-00-00', 'sujon@gmail.com', 'sujon', '123456', 1, 0),
(2, 'Palash', 'IT', 'mirpur', '01227843', '0000-00-00', 'palash.cmt@gmail.com', 'palash', '123456', 0, 0),
(3, 'MD. SUTAN MAHMUD', 'SEO', 'Gulshan', '021144', '0000-00-00', 'sultan@gmail.com', 'sultan', '123456', 1, 0),
(4, 'Sujon', 'SEO', 'Gulshan', '01227843', '0000-00-00', 'sultan@gmail.com', 'sultan', '123456', 1, 0),
(5, 'MD. SUTAN MAHMUD', 'IT', 'kkk', '8865', '0000-00-00', 'abuchalek1@gmail.com', 'sultan', '7554', 1, 0),
(6, 'sultan', 'SEO', 'mirpur', '01227843', '0000-00-00', 'palash.cmt@gmail.com', 'sultan2', '45567', 1, 0),
(7, 'Sujon', 'IT', 'badda', '021144', '0000-00-00', 'palash.cmt@gmail.com', 'sujon', '765', 1, 0),
(8, 'Sujon', 'IT', 'mirpur', '021144', '0000-00-00', 'abuchalek1@gmail.com', 'sultan', 'loooi', 1, 0),
(9, 'sagor', 'SEO', 'kkk', '021144', '2017-04-17', 'abuchalek1@gmail.com', 'sagor', '12345', 1, 0),
(10, 'sultan', 'SEO', 'mirpur', '01227843', '2017-04-20', 'palash.cmt@gmail.com', 'sultan', '1234556', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE `leave` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `reason` text NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `total_date` int(11) NOT NULL,
  `granted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 = Granted, 2 = Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date_times` datetime NOT NULL,
  `file` varchar(50) NOT NULL,
  `message_read` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 = Read, 2 = Unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `body`, `date_times`, `file`, `message_read`) VALUES
(1, 2, 3, 'HTML Part1', 'jklk', '2017-04-22 12:29:41', '', 1),
(2, 2, 6, 'Test', 'ghhk', '2017-04-22 12:43:08', '', 2),
(3, 1, 2, 'PHP Project OMS Login Sestem all OK.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...', '2017-04-22 12:59:51', '', 1),
(4, 9, 7, 'Leave Application form.', 'Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.Leave Application form.', '2017-04-24 19:41:55', '', 2),
(5, 1, 2, 'New Project', 'New project work start.', '2017-04-27 15:10:18', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_logo` varchar(50) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `office_start_time` time NOT NULL,
  `office_end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `company_name`, `company_logo`, `company_address`, `office_start_time`, `office_end_time`) VALUES
(1, 'PCR', '1494083589.', 'Mirpur-6, Pollobi, Dhaka-1216.', '09:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `task_details` varchar(255) NOT NULL,
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `completion` int(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = Not Started, 1 = Pending, 2 = In Progress, 3 = Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `employee_id`, `task_name`, `task_details`, `start_date`, `end_date`, `completion`, `status`) VALUES
(1, 3, 'Complete the Font Page.', 'Complete the Font Page. Complete the Font Page.', '2017-04-20', '2017-04-22', 35, 1),
(2, 4, 'Complete the Login Page.', 'Complete the Login Page.', '2017-05-16', '2017-05-18', 100, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designation`
--

CREATE TABLE `tbl_designation` (
  `id` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_designation`
--

INSERT INTO `tbl_designation` (`id`, `designation`) VALUES
(1, 'IT'),
(2, 'SEO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_type`
--

CREATE TABLE `tbl_leave_type` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_leave_type`
--

INSERT INTO `tbl_leave_type` (`id`, `leave_type`) VALUES
(1, 'Casual Leave 1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave`
--
ALTER TABLE `leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leave_type`
--
ALTER TABLE `tbl_leave_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `leave`
--
ALTER TABLE `leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_leave_type`
--
ALTER TABLE `tbl_leave_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
