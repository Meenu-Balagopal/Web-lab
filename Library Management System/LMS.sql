-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2021 at 10:19 PM
-- Server version: 8.0.23-0ubuntu0.20.10.1
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `admin_user` varchar(20) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_mob` bigint NOT NULL,
  `admin_pwd` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`admin_user`, `admin_name`, `admin_email`, `admin_mob`, `admin_pwd`) VALUES
('Admin', 'Henry Cavill', 'administer@gmail.com', 7907470887, 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `Book`
--

CREATE TABLE `Book` (
  `book_id` varchar(20) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `book_author` varchar(30) NOT NULL,
  `book_editn` varchar(10) NOT NULL,
  `book_publish` varchar(30) NOT NULL,
  `issued` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Book`
--

INSERT INTO `Book` (`book_id`, `book_title`, `book_author`, `book_editn`, `book_publish`, `issued`) VALUES
('ISBN001', 'Oliver Twist', 'Dickens', '', 'Penguin Classics', 1),
('ISBN002', 'Macbeth', 'William Shakespeare', '', 'Dover', 0),
('ISBN003', 'Sun Also Rises', 'Hemingway', '', 'Scribner', 0),
('ISBN004', 'David Cooperfield', 'Dickens', '', 'Penguin Classics', 0),
('ISBN005', 'Farewell to Arms', 'Hemingway', '', 'Scribner', 0),
('ISBN006', 'Oliver Twist', 'Dickens', '', 'Penguin Classics', 0),
('ISBN007', 'Macbeth', 'William Shakespeare', '', 'Dover', 0),
('ISBN008', 'Sun Also Rises', 'Hemingway', '', 'Scribner', 0),
('ISBN009', 'David Cooperfield', 'Dickens', '', 'Penguin Classics', 0),
('ISBN010', 'Farewell to Arms', 'Hemingway', '', 'Scribner', 1);

-- --------------------------------------------------------

--
-- Table structure for table `BookIssue`
--

CREATE TABLE `BookIssue` (
  `book_id` varchar(20) NOT NULL,
  `stud_rollno` varchar(20) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `BookIssue`
--

INSERT INTO `BookIssue` (`book_id`, `stud_rollno`, `issue_date`, `return_date`) VALUES
('ISBN001', 'CET20MCA064', '2021-03-15', NULL),
('ISBN002', 'CET20MCA064', '2021-03-14', '2021-03-25'),
('ISBN010', 'CET20MCA064', '2021-03-13', NULL),
('ISBN008', 'CET20MCA009', '2021-03-15', '2021-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `stud_rollno` varchar(20) NOT NULL,
  `stud_name` varchar(30) NOT NULL,
  `stud_email` varchar(50) NOT NULL,
  `stud_mob` bigint NOT NULL,
  `stud_pwd` varchar(15) NOT NULL,
  `approval_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`stud_rollno`, `stud_name`, `stud_email`, `stud_mob`, `stud_pwd`, `approval_status`) VALUES
('CET20MCA009', 'Amaya Vinod', 'amayavinod333@gmail.com', 9633002124, 'amaya@123', 1),
('CET20MCA010', 'Aneeta Shalvin', 'aneetashalvin@gmail.com', 7012378099, 'aneeta@123', 0),
('CET20MCA040', 'Meenu Balagopal', 'meenub40@gmail.com', 9608562299, 'meenu@123', 0),
('CET20MCA045', 'Navya', 'navya47@gmail.com', 7907563229, 'navya@123', 1),
('CET20MCA061', 'Theertha T', 'theerthana2206@gmail.com', 7907997334, 'theertha@123', 1),
('CET20MCA064', 'Vineeth Kumar', 'vineethkumar6469@gmail.com', 8138880789, 'vineeth@123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`admin_user`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`stud_rollno`),
  ADD UNIQUE KEY `stud_email` (`stud_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
