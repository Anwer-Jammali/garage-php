-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 03:14 PM
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
-- Database: `sayarat_3amek_faouzi`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `Account_name` varchar(25) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Account_Password` varchar(25) NOT NULL,
  `Account_Role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `Account_name`, `Email`, `Account_Password`, `Account_Role`) VALUES
(3, 'awwwww', 'awww@gmail.com', '1234', 'Admin'),
(12, 'aazze', 'azzz@gmail.com', '1234', 'User'),
(13, 'aaaaaz', 'awwwzze@gmail.com', '1234', 'User'),
(14, 'aaaaaaaaa', 'aaa99@gmail.com', '1234', 'User'),
(15, 'Anwar', 'anwarjammeli4@gmail.com', 'anwar', 'Admin'),
(16, 'Adem', 'adem.alshili@gmail.com', 'adem', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `country`) VALUES
(1, 'Toyota', 'Japan'),
(2, 'Ford', 'USA'),
(3, 'BMW', 'Germany');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `Engine` varchar(25) NOT NULL,
  `hp` int(4) NOT NULL,
  `Description` text NOT NULL,
  `year` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `model`, `brand_id`, `Engine`, `hp`, `Description`, `year`, `price`, `image`) VALUES
(1, 'Camry', 1, '3.5L V6', 301, 'The Toyota Camry 2022 offers two engine options: a fuel-efficient 2.5L inline-4 for daily driving and a more powerful 3.5L V6 for enhanced performance. Both engines deliver smooth acceleration and reliability, making the Camry a versatile sedan suitable for comfort, efficiency, and spirited driving.', 2022, 25000.00, 'images/camry2022.png'),
(2, 'Mustang', 2, '5.0L V8', 450, 'The Ford Mustang offers a range of engines, from the efficient and punchy 2.3L EcoBoost to the iconic 5.0L V8 that delivers exhilarating power. Known for its muscular performance and dynamic handling, the Mustang is a timeless sports car designed to thrill on every drive.', 2021, 55000.00, 'images/mustang2021.jpg'),
(3, 'X5', 3, '4.4L Twin-Turbocharged V8', 523, 'This powerful engine is designed for thrilling performance, featuring advanced turbocharging technology and precision engineering. It delivers smooth acceleration, high-speed capability, and responsiveness, making it a standout choice for luxury and performance vehicles like the BMW X5 M50i and X5 M Competition.', 2023, 70000.00, 'images/x52023.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sell_contracts`
--

CREATE TABLE `sell_contracts` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `buyer_email` varchar(100) DEFAULT NULL,
  `sale_date` date NOT NULL,
  `sale_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sell_contracts`
--

INSERT INTO `sell_contracts` (`id`, `car_id`, `buyer_name`, `buyer_email`, `sale_date`, `sale_price`) VALUES
(1, 1, 'John Doe', 'john.doe@example.com', '2024-10-15', 24000.00),
(2, 2, 'Jane Smith', 'jane.smith@example.com', '2024-11-10', 54000.00),
(31, 1, 'awwwww', 'awww@gmail.com', '2024-12-02', 25000.00),
(32, 2, 'awwwww', 'awww@gmail.com', '2024-12-02', 55000.00),
(33, 1, 'awwwww', 'awww@gmail.com', '2024-12-02', 25000.00),
(34, 3, 'awwwww', 'awww@gmail.com', '2024-12-02', 70000.00),
(35, 2, 'aazze', 'azzz@gmail.com', '2024-12-02', 55000.00),
(36, 2, 'awwwww', 'awww@gmail.com', '2024-12-02', 55000.00),
(37, 1, 'awwwww', 'awww@gmail.com', '2024-12-02', 25000.00),
(41, 1, '', '', '2024-12-03', 25000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `sell_contracts`
--
ALTER TABLE `sell_contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sell_contracts`
--
ALTER TABLE `sell_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Constraints for table `sell_contracts`
--
ALTER TABLE `sell_contracts`
  ADD CONSTRAINT `sell_contracts_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
