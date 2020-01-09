-- phpMyAdmin SQL Dump
-- version 5.0.0-alpha1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2020 at 10:33 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instly`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(250) NOT NULL,
  `birthdate` date NOT NULL,
  `id_code` varchar(50) NOT NULL,
  `contact_value` varchar(250) NOT NULL,
  `active_employee` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `birthdate`, `id_code`, `contact_value`, `active_employee`, `created_at`) VALUES
(2, 'Daniel L. West\r\n', '1991-01-23', '2211004CF2774', '4676 rue Saint-Antoine\r\nSt Hyacinthe, QC J2S 8R8', 0, '2020-01-01 10:37:02'),
(3, 'Henry J. Martin\r\n', '1982-09-23', '699043147CVV4', '250-240-2705', 1, '2020-01-06 10:37:02'),
(1, 'John Dure', '1987-01-01', '887744CF2223D', 'JohnDoe@gmail.com', 1, '2020-01-05 10:37:02'),
(4, 'Timothy Burke', '1990-01-15', '7700HHFWW11', 'TimothySBurke@dayrep.com\r\n', 1, '2020-01-04 10:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `employees_data`
--

CREATE TABLE `employees_data` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `language` varchar(20) NOT NULL,
  `info_data` text NOT NULL,
  `info_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees_data`
--

INSERT INTO `employees_data` (`id`, `employee_id`, `language`, `info_data`, `info_type`) VALUES
(3, 1, 'English', 'Lorem ipsum dolor sit amet, cu decore constituam usu, dolores vituperatoribus ex pro. Cu nam purto mediocritatem, at ipsum minim est. Id sed laboramus efficiantur. Ei elit commodo postulant vel, veniam dissentiet cu eos. Utinam eruditi ius et, per ex natum pericula.', 'education'),
(1, 1, 'French', 'Lorem ipsum dolor sit amet, cu decore constituam usu, dolores vituperatoribus ex pro. Cu nam purto mediocritatem, at ipsum minim est. Id sed laboramus efficiantur. Ei elit commodo postulant vel, veniam dissentiet cu eos. Utinam eruditi ius et, per ex natum pericula.', 'introduction'),
(4, 1, 'English', 'Lorem ipsum dolor sit amet, cu decore constituam usu, dolores vituperatoribus ex pro. Cu nam purto mediocritatem, at ipsum minim est. Id sed laboramus efficiantur. Ei elit commodo postulant vel, veniam dissentiet cu eos. Utinam eruditi ius et, per ex natum pericula.', 'work_experiences'),
(2, 2, 'Spanish', 'Lorem ipsum dolor sit amet, cu decore constituam usu, dolores vituperatoribus ex pro. Cu nam purto mediocritatem, at ipsum minim est. Id sed laboramus efficiantur. Ei elit commodo postulant vel, veniam dissentiet cu eos. Utinam eruditi ius et, per ex natum pericula.', 'work_experiences');

-- --------------------------------------------------------

--
-- Table structure for table `employees_logs`
--

CREATE TABLE `employees_logs` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `action` varchar(20) NOT NULL,
  `the_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees_logs`
--

INSERT INTO `employees_logs` (`id`, `employee_id`, `action`, `the_time`, `user_id`) VALUES
(1, 1, 'created_at', '2020-01-09 08:32:30', 1),
(4, 3, 'created_at', '2020-01-09 08:32:40', 1),
(3, 1, 'updated_at', '2020-01-09 08:32:30', 1),
(2, 2, 'updated_at', '2020-01-09 08:32:40', 1),
(8, 2, 'update_info', '2020-01-07 22:00:00', 1),
(7, 1, 'update_info', '2020-01-09 08:36:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'Stev McBonnit', 'admin@domain.com', '$2y$12$E8dH8uJgi1FGWsr6oDmt2.dycwnPStsX6AVkBJIjSZ2sid1Cpe1Du\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_name`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `employees_data`
--
ALTER TABLE `employees_data`
  ADD PRIMARY KEY (`info_type`,`employee_id`,`language`) USING BTREE,
  ADD KEY `id` (`id`);

--
-- Indexes for table `employees_logs`
--
ALTER TABLE `employees_logs`
  ADD PRIMARY KEY (`action`,`the_time`,`user_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`fullname`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees_data`
--
ALTER TABLE `employees_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees_logs`
--
ALTER TABLE `employees_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

