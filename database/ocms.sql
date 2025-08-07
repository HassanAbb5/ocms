-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 12:38 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_firstname` varchar(255) NOT NULL,
  `admin_lastname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_firstname`, `admin_lastname`, `admin_email`, `admin_password`) VALUES
(1, 'hassan', 'bala', 'bala@gmail.com', '12345'),
(2, 'titilayo', 'abbati', 'titiabba@yahoo.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_firstname` varchar(255) NOT NULL,
  `sender_lastname` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `sender_username` varchar(255) NOT NULL,
  `complaint_type` varchar(255) NOT NULL,
  `complaint_subject` varchar(255) NOT NULL,
  `complaint_message` varchar(255) NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_response` varchar(255) NOT NULL,
  `response_date` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `responded` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `sender_id`, `sender_firstname`, `sender_lastname`, `sender_email`, `sender_username`, `complaint_type`, `complaint_subject`, `complaint_message`, `date_sent`, `admin_response`, `response_date`, `responded`) VALUES
(1, 2, 'factorial', 'jombo', 'jombo@gmail.com', 'jombofactorial', 'general', 'database issue', 'please and please we need a better and reliable database for storing our data and we need it as soon as possible', '2022-05-13 00:33:26', 'giucduchhc8ehoicdscndiusg icbudbsc uchuoec', '2022-06-13 18:45:40', 1),
(3, 1, 'hassan', 'abba', 'abbah@gmail.com', 'abbahassanuser', 'personal', 'coding issue', 'col d-flex justify-content-center align-items-centercol d-flex justify-content-center align-items-center', '2022-05-14 10:16:44', 'iuccnioeucnoeic  xeybgcubyegcyeiucbeucbeiu\r\njbiycbgver8cg83rghcf87c\r\nerirh8ygbr', '2022-05-23 17:08:25', 1),
(4, 1, 'hassan', 'abba', 'abbah@gmail.com', 'abbahassanuser', 'personal', 'typing experience', 'typing experience is really badtyping experience is really badtyping experience is really badtyping experience is really bad', '2022-05-14 18:11:11', '', '0000-00-00 00:00:00', 0),
(5, 1, 'hassan', 'abba', 'abbah@gmail.com', 'abbahassanuser', 'personal', 'nothing serious', 'loremddxctyuijopiuytrse criojjh tfg tydfyu  tyui uytfihop iyt', '2022-05-17 19:20:27', '', '0000-00-00 00:00:00', 0),
(7, 2, 'factorial', 'jombo', 'jombo@gmail.com', 'jombofactorial', 'general', 'nothing serious', 'loremloremloremloremloremloremloremloremloremloremloremlorem', '2022-05-20 21:41:27', 'emloremloremloremloremloremloremlorem', '2022-05-20 21:42:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pic_name` varchar(255) NOT NULL,
  `pic_location` varchar(255) NOT NULL,
  `blocked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `pic_name`, `pic_location`, `blocked`) VALUES
(1, 'abbahassanuser', 'hassan', 'abba', 'abbah@gmail.com', '1234', '$62822237b862e4.61177352.jpg', 'profile_files/62822237b862e4.61177352.jpg', 0),
(2, 'jombofactorial', 'factorial', 'jombo', 'jombo@gmail.com', '1234', '$628774ccb3d586.82454106.png', 'profile_files/628774ccb3d586.82454106.png', 0),
(3, 'chichi', 'chi', 'chi', 'chichi@gmail.com', '1234', '62e8f0bb474452.65266961.jpeg', 'profile_files/62e8f0bb474452.65266961.jpeg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
