-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2017 at 12:56 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mess-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `mm_user`
--

CREATE TABLE `mm_user` (
  `mm_user_id` int(11) NOT NULL,
  `mm_user_name` varchar(45) NOT NULL,
  `mm_user_email` varchar(45) NOT NULL,
  `mm_user_mobile` varchar(45) NOT NULL,
  `mm_user_pass` varchar(100) NOT NULL,
  `mm_user_created_at` date NOT NULL,
  `mm_user_role` int(11) NOT NULL,
  `mm_user_status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mm_user`
--

INSERT INTO `mm_user` (`mm_user_id`, `mm_user_name`, `mm_user_email`, `mm_user_mobile`, `mm_user_pass`, `mm_user_created_at`, `mm_user_role`, `mm_user_status`) VALUES
(1, 'john', 'johns@gmail.com', '01683130603', '81dc9bdb52d04dc20036dbd8313ed055', '2017-04-27', 1, '1'),
(2, 'shakib', 'shakib@gmail.com', '12345678912', '202cb962ac59075b964b07152d234b70', '2017-04-28', 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `mm_user_diposit`
--

CREATE TABLE `mm_user_diposit` (
  `mm_ud_id` int(11) NOT NULL,
  `mm_ud_rent` int(11) NOT NULL,
  `mm_ud_utility` int(11) NOT NULL,
  `mm_ud_meal` int(11) NOT NULL,
  `mm_ud_total` int(11) NOT NULL,
  `mm_ud_user` int(11) NOT NULL,
  `mm_ud_diposited` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mm_user_diposit`
--

INSERT INTO `mm_user_diposit` (`mm_ud_id`, `mm_ud_rent`, `mm_ud_utility`, `mm_ud_meal`, `mm_ud_total`, `mm_ud_user`, `mm_ud_diposited`) VALUES
(1, 3000, 600, 1500, 5100, 2, '2017-04-28'),
(2, 3500, 700, 1200, 5400, 2, '2017-05-31'),
(3, 4000, 500, 1500, 6000, 1, '2017-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `mm_user_meal`
--

CREATE TABLE `mm_user_meal` (
  `mm_um_id` int(11) NOT NULL,
  `mm_um_time` varchar(45) NOT NULL,
  `mm_um_user` int(11) NOT NULL,
  `mm_um_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mm_user_meal`
--

INSERT INTO `mm_user_meal` (`mm_um_id`, `mm_um_time`, `mm_um_user`, `mm_um_date`) VALUES
(1, 'breakfast,lunch,dinner', 2, '2017-04-28'),
(2, 'lunch', 1, '2017-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `mm_user_role`
--

CREATE TABLE `mm_user_role` (
  `mm_ur_id` int(11) NOT NULL,
  `mm_ur_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mm_user_role`
--

INSERT INTO `mm_user_role` (`mm_ur_id`, `mm_ur_name`) VALUES
(1, 'Admin'),
(2, 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mm_user`
--
ALTER TABLE `mm_user`
  ADD PRIMARY KEY (`mm_user_id`),
  ADD KEY `user_role_idx` (`mm_user_role`);

--
-- Indexes for table `mm_user_diposit`
--
ALTER TABLE `mm_user_diposit`
  ADD PRIMARY KEY (`mm_ud_id`),
  ADD KEY `user_diposit_idx` (`mm_ud_user`);

--
-- Indexes for table `mm_user_meal`
--
ALTER TABLE `mm_user_meal`
  ADD PRIMARY KEY (`mm_um_id`),
  ADD KEY `user_meal_idx` (`mm_um_user`);

--
-- Indexes for table `mm_user_role`
--
ALTER TABLE `mm_user_role`
  ADD PRIMARY KEY (`mm_ur_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mm_user`
--
ALTER TABLE `mm_user`
  MODIFY `mm_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mm_user_diposit`
--
ALTER TABLE `mm_user_diposit`
  MODIFY `mm_ud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mm_user_meal`
--
ALTER TABLE `mm_user_meal`
  MODIFY `mm_um_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mm_user_role`
--
ALTER TABLE `mm_user_role`
  MODIFY `mm_ur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mm_user`
--
ALTER TABLE `mm_user`
  ADD CONSTRAINT `user_role` FOREIGN KEY (`mm_user_role`) REFERENCES `mm_user_role` (`mm_ur_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mm_user_diposit`
--
ALTER TABLE `mm_user_diposit`
  ADD CONSTRAINT `user_diposit` FOREIGN KEY (`mm_ud_user`) REFERENCES `mm_user` (`mm_user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mm_user_meal`
--
ALTER TABLE `mm_user_meal`
  ADD CONSTRAINT `user_meal` FOREIGN KEY (`mm_um_user`) REFERENCES `mm_user` (`mm_user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
