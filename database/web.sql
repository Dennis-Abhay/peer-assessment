-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2020 at 03:52 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `username`, `password`) VALUES
(1, 'abhay', 'abhay@gmail.com', 'abhay', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_student`
--

CREATE TABLE IF NOT EXISTS `assigned_student` (
  `assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`assign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `assigned_student`
--

INSERT INTO `assigned_student` (`assign_id`, `student_id`, `group_id`) VALUES
(1, '1', 1),
(2, '2', 1),
(3, '4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `student_id`, `report_id`, `comments`, `date`) VALUES
(1, 2, 1, 'yes goo of you', '2020/04/15'),
(2, 2, 2, 'good', '2020/04/15'),
(3, 2, 1, 'wow', '2020/04/15'),
(4, 1, 3, 'good job bros', '2020/04/15');

-- --------------------------------------------------------

--
-- Table structure for table `course_work`
--

CREATE TABLE IF NOT EXISTS `course_work` (
  `course_work_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `work` text NOT NULL,
  PRIMARY KEY (`course_work_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `course_work`
--

INSERT INTO `course_work` (`course_work_id`, `group_id`, `work`) VALUES
(1, 1, 'WEB APPLICATION TO ACCESS PEER ASSESMENT IN GROUP PROJECT');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `report` text NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `student_id`, `group_id`, `report`, `date`) VALUES
(1, 1, 1, 'i andbbdbbdbdb', '2020/04/15'),
(2, 2, 1, 'yes it is', '2020/04/15'),
(3, 2, 1, 'i made it', '2020/04/15');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `matric_no` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `matric_no`, `username`, `email`, `password`) VALUES
(1, 'bashir', '15101', 'ybm', 'ybm@gmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 'Anas', '15102', 'anas', 'anas@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'ilyas', '15103', 'ilya', 'ilya@gm.com', '202cb962ac59075b964b07152d234b70'),
(4, 'isah aliyu', '151020', 'isah', 'isah@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `uploads_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `image` varchar(300) NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`uploads_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`uploads_id`, `student_id`, `group_id`, `image`, `date`) VALUES
(1, 1, 1, 'uploads/578913.png', '2020/04/15'),
(2, 2, 1, 'uploads/745037.png', '2020/04/15'),
(3, 2, 1, 'uploads/20450.png', '2020/04/15');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
