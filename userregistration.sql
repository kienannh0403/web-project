-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2019 at 10:01 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userregistration`
--

-- --------------------------------------------------------

--
-- Table structure for table `limit_textmessage`
--

CREATE TABLE `limit_textmessage` (
  `id` varchar(255) NOT NULL,
  `limit_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `limit_textmessage`
--

INSERT INTO `limit_textmessage` (`id`, `limit_num`) VALUES
('limit', 255);

-- --------------------------------------------------------

--
-- Table structure for table `usermessage`
--

CREATE TABLE `usermessage` (
  `IDfrom` varchar(255) NOT NULL,
  `IDto` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermessage`
--

INSERT INTO `usermessage` (`IDfrom`, `IDto`, `title`, `Message`, `Time`) VALUES
('baohan123@gmail.com', 'thnam123@gmail.com', 'asd', 'qweqweqwe', '2019-05-05 02:52:58'),
('baohan123@gmail.com', 'thnam123@gmail.com', 'ouioiuoui', 'this is mesaagethis is mesaage', '2019-05-05 02:54:26'),
('baohan123@gmail.com', 'thnam123@gmail.com', 'messtitle123', 'czxmbc,zxb,mnczx', '2019-05-05 02:55:00'),
('baohan123@gmail.com', 'thnam123@gmail.com', '', 'qweqweqwewqewqewq', '2019-05-05 02:57:33'),
('baohan123@gmail.com', 'thnam1410@gmail.com', '123123', 'hjgfjfgjfgjfgjfgjfgjgf', '2019-05-05 02:53:49'),
('baohan123@gmail.com', 'thnam1410@gmail.com', 'message', 'this is messageeeeeeeee', '2019-05-05 02:53:59'),
('baohan123@gmail.com', 'thnam1410@gmail.com', 'messtitle123213', 'eqweqweqweqwewqewqewqewqewqewq', '2019-05-05 02:54:46'),
('thnam123@gmail.com', 'baohan123@gmail.com', 'messtitle', 'this is a', '2019-05-05 02:57:55'),
('thnam123@gmail.com', 'baohan123@gmail.com', 'messtitle1', 'this is', '2019-05-05 02:58:03'),
('thnam123@gmail.com', 'thnam1410@gmail.com', 'titlee11', 'message111', '2019-05-05 02:33:41'),
('thnam123@gmail.com', 'thnam1410@gmail.com', 'title2', 'message 2', '2019-05-05 02:50:59'),
('thnam1410@gmail.com', 'baohan123@gmail.com', 'this is a title 5', 'asd this', '2019-05-05 02:58:32'),
('thnam1410@gmail.com', 'baohan123@gmail.com', 'messtitle', 'thisssssss', '2019-05-05 02:58:38'),
('thnam1410@gmail.com', 'baohan123@gmail.com', 'this is a title 3', 'this is a messaaaaagggggeeeeee', '2019-05-05 02:58:49'),
('thnam1410@gmail.com', 'baohan123@gmail.com', 'asdasdasd', 'asdsadsadasdas', '2019-05-05 03:00:51'),
('thnam1410@gmail.com', 'thnam123@gmail.com', 'this is title 1', 'message 2', '2019-05-01 22:27:17'),
('thnam1410@gmail.com', 'thnam123@gmail.com', 'message 2', 'message 2', '2019-05-05 02:31:10'),
('thnam1410@gmail.com', 'thnam123@gmail.com', 'message 3', 'message 3', '2019-05-05 02:31:20'),
('thnam1410@gmail.com', 'thnam123@gmail.com', 'messtitle2', 'message 3', '2019-05-05 02:33:09'),
('thnam1410@gmail.com', 'thnam123@gmail.com', 'message', '21321321321', '2019-05-05 02:33:19'),
('thnam1410@gmail.com', 'thnam1410@gmail.com', 'messtitle', 'message 3', '2019-05-05 02:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`username`, `password`, `Status`) VALUES
('abcxyz_123@gmail.com', '15120612', 'Banned'),
('admin', 'administrator', 'available'),
('baohan123@gmail.com', '15120612', 'available'),
('thnam123@gmail.com', '15120612', 'available'),
('thnam1410@gmail.com', '15120612', 'available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `limit_textmessage`
--
ALTER TABLE `limit_textmessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usermessage`
--
ALTER TABLE `usermessage`
  ADD PRIMARY KEY (`IDfrom`,`IDto`,`Time`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
