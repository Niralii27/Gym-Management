-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 07:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fox`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_membership`
--

CREATE TABLE `admin_membership` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_membership`
--

INSERT INTO `admin_membership` (`Id`, `Name`, `Amount`, `Image`, `Description`, `Date`) VALUES
(12, 'bhakti', 10000.00, 'categotylogo1.jpg', 'abjshkjf', '2024-09-25'),
(27, 'abc', 4500.00, 'bg3.jpg', 'jnjefnc e newjfnk  newbjf', '0000-00-00'),
(28, 'dddddddddddddddd', 2222222.00, 'arrow1.jpg', '22222222222222', '2024-09-26');

-- --------------------------------------------------------

--
-- Table structure for table `admin_plan`
--

CREATE TABLE `admin_plan` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Weight` int(11) DEFAULT NULL,
  `Goal` varchar(255) DEFAULT NULL,
  `Skill` varchar(255) DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL,
  `Days` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `Name`, `description`, `img`) VALUES
(1, 'Bhakti Patel', 'hvh cjdh  vau svueb kdfya fjdnd c nedfsb d', '1728472120_bg1.jpg'),
(2, 'class_1', 'hvbs sljadh cclkhvad clkkhfgcvd oiufctvhbjnm ', '1728472138_admin2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Message` text DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Number` varchar(20) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Rating` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `Name`, `Email`, `Number`, `Message`, `Rating`) VALUES
(2, 'bhakti bhut ', 'bhakti26@gmail.com', '278493748893', 'helloo i am bhakti here ', 5),
(3, 'priya busa', 'priya@123gmial.com', '328043780', 'HEYYYY', 3);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Phone_Number` varchar(20) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Extra_Class` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `Name`, `Email`, `Password`, `Phone_Number`, `Gender`, `Extra_Class`) VALUES
(5, 'priya busaaaaaaaa', 'admin@admin.com', 'admin123', '01997568729', 'female', '11213'),
(6, 'Bhakti Patel', 'admin12@admin.com', 'admin123', '07016370260', 'female', '11213'),
(7, 'dharmik', 'd@gmail.com', 'admin123', '53287973835273673638', 'make', '4612872'),
(8, 'priya busa', 'priybusaaaaaaaa@gmail.com', 'admin123', '01997568729', 'f', '12');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Contact` varchar(20) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Experience` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `Name`, `Image`, `Contact`, `City`, `Address`, `Experience`) VALUES
(1, 'Bhakti Patel', '1728401281_admin1.jpg', '1234567890', 'Rajkot', 'Kotecha chowk, kalavad road, Rajkot', 2),
(2, 'priya busa', '1728401702_admin2.jpg', '7016370260', 'RALEIGH', '93 SUN TOWN STREET', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `Email`, `Password`) VALUES
(13, 'GANVAY', 'admin123@admin.com', '123456'),
(14, 'Bhakti', 'admin@gmail.com', 'admin'),
(16, 'nnnnnnnnnnnn', 'nirali@gmail.com', '1111222233'),
(17, 'ggggggggggg', 'admin123@admin.com', '222222222');

-- --------------------------------------------------------

--
-- Table structure for table `user_membership`
--

CREATE TABLE `user_membership` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Information` text DEFAULT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_plan`
--

CREATE TABLE `user_plan` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Number` varchar(20) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Rating` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_plan`
--

INSERT INTO `user_plan` (`id`, `Name`, `Email`, `Number`, `Message`, `Rating`) VALUES
(2, 'Bhakti Patel', 'ganvartons923@gmail.com', '23243454643', 'helloo i am bhakti here ', 3),
(3, 'Bhakti Patel', 'ganvartons923@gmail.com', '23243454643', 'helloo i am bhakti here ', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_membership`
--
ALTER TABLE `admin_membership`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `admin_plan`
--
ALTER TABLE `admin_plan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_membership`
--
ALTER TABLE `user_membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_plan`
--
ALTER TABLE `user_plan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_membership`
--
ALTER TABLE `admin_membership`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_plan`
--
ALTER TABLE `user_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
