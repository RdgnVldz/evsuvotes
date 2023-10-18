-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 04:55 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v-practice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `user_role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`, `user_role`) VALUES
(1, '1', '$2y$10$CngM/zBKo0IvJ.VsjiHKtObQu5Mp40FSe2Rz.g/xT5N3UCGGiVxr2', 'Genesis', 'Urmeneta', 'pic.jpg', '2023-03-23', 'super_admin'),
(2, 'admin2', '$2y$10$ojpg8RyfAQh3oFMfN8F3reYczqC25yV.HmpQRUvMpxDhQLTSVlRAq', 'Kristel', 'Longno', 'Untitled design.png', '2023-03-23', 'admin'),
(12, 'test', '$2y$10$NY.LKbJrr6nLYbnbY/Dow.7DRBO5KRBAuOPJtE4OtLpr55TG.TQ6.', 'Shyr', 'Urmeneta', 'profile.png', '2023-09-21', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `archive_votes`
--

CREATE TABLE `archive_votes` (
  `id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `date_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `position_id`, `firstname`, `lastname`, `photo`) VALUES
(24, 8, 'Ferdinand', 'Marcos Jr.', 'bongbong.jpeg'),
(25, 8, 'Leni', 'Robredo', 'Leni_Robredo_Portrait.png'),
(26, 8, 'Isko', 'Moreno', 'IskoMorenoOfficialPortrait.jpg'),
(27, 8, 'Manny', 'Pacquiao', '03095417-manny-pacquiao_cover_1201x1800.png'),
(28, 9, 'Sara', 'Duterte', 'VPSDPortrait_(cropped)_(3).jpg'),
(29, 9, 'Kiko', 'Pangilinan', 'Senkikopangilinan.jpg'),
(30, 9, 'Willie', 'Ong', 'Willie_Ong,_2018.jpg'),
(31, 9, 'Lito', 'Atienza', 'Rep._Lito_Atienza,_Jr_(18th_Congress_PH).jpg'),
(32, 11, 'Gaylord', 'Balcom', ''),
(33, 11, 'Kacy', 'Poplar', ''),
(34, 11, 'Brant', 'Dipaola', ''),
(35, 11, 'Vera', 'Fuselier', ''),
(36, 11, 'Darlene', 'Mund', ''),
(37, 11, 'Terrell', 'Metzer', 'profile.png'),
(61, 11, 'Jerry', 'Smith', ''),
(65, 11, 'Morty', 'Smith', ''),
(67, 11, 'Beth', 'Smith', ''),
(69, 9, 'Summer', 'Smith', ''),
(70, 8, 'Gen', 'Sanchez', '');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `max_vote` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `description`, `max_vote`, `priority`) VALUES
(8, 'President', 1, 1),
(9, 'Vice-President', 1, 2),
(11, 'First Year Representatives', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `studentid` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `course` varchar(15) NOT NULL,
  `year` int(10) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `studentid`, `password`, `firstname`, `middlename`, `lastname`, `course`, `year`, `date`) VALUES
(97, '1', '$2y$10$zg52n5Snc3zyPE/viYVteegrM4KXbX.N78lUJzIY6oDqdTZ3uGXFq', 'Genesis', 'Cobacha', 'Urmeneta', 'BSIT', 1, '2023-09-20'),
(130, '2020-35008', '$2y$10$kvMHMFp9FDYE3EHCeijjn.OwCiKrnOX8judRFKK/0QR5XB6gcZJGu', 'Rick', 'Sanchez', 'Blake', 'BSIT', 4, '2023-09-21'),
(132, '2020-20001', '$2y$10$QndyDwgTF2ESEjp2s6viTOpoIt9yC1na0EH5msW5uyN8.8wu7/y7e', 'Lois', 'Sanchez', 'Griffin', 'BSCE', 4, '2023-09-21'),
(133, '2020-20002', '$2y$10$iEA4Wbg8ITExoShqeWdAkeuWqwbA5wC9SwYiCLRKBIhGKGbmTUwqa', 'Meg', 'Sanchez', 'Griffin', 'BSCS', 2, '2023-09-21'),
(134, '2020-35003', '$2y$10$wTRD1TIzECm535cSQwlqY.FkLY8GEGVgY/04OigOk/CC3gkcZQThq', 'Stewie', 'Sanchez', 'Griffin', 'BS Ind. Tech.', 1, '2023-09-21'),
(135, '2020-35004', '$2y$10$6hNDhN9U5wv.UATU2y0M1uhHy9N5K7WNB26xSTBKifEcb0cYiGadC', 'Chris', 'Sanchez', 'Griffin', 'BSA', 3, '2023-09-21'),
(136, '2020-35007', '$2y$10$25M9fZzNqjdhvgbQYBg7SemifrY0jQ2DSDXrqd1vJEDK4Zr4gPk4e', 'Brian', 'Sanchez', 'Griffin', 'BSE', 2, '2023-09-21'),
(137, '2020-20000', '$2y$10$DN5ZrH5Fw5JORabOwrwsBuRCrCVDzX7rT1ziR.3TzbZ0cnNNWhwv2', 'Petter', 'Sanchez', 'Griffin', 'BSED', 4, '2023-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `date_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voters_id`, `candidate_id`, `position_id`, `date_time`) VALUES
(410, 97, 24, 8, '2023-09-22'),
(411, 97, 28, 9, '2023-09-22'),
(412, 97, 61, 11, '2023-09-22'),
(413, 97, 65, 11, '2023-09-22'),
(414, 97, 67, 11, '2023-09-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive_votes`
--
ALTER TABLE `archive_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `archive_votes`
--
ALTER TABLE `archive_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=415;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
