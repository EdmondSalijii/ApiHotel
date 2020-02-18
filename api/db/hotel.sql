-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2020 at 06:44 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Id` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `RoomId` int(11) NOT NULL,
  `GuestId` int(11) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Id`, `StartDate`, `EndDate`, `RoomId`, `GuestId`, `AddedBy`, `Price`) VALUES
(2, '2019-07-14', '2019-07-24', 1, 1, 1, 600),
(19, '2020-01-16', '2020-01-20', 1, 1, 1, 500),
(26, '2020-01-07', '2020-01-09', 1, 1, 1, 500),
(32, '2020-01-07', '2020-01-12', 1, 10, 1, 750),
(33, '2020-01-15', '2020-01-20', 1, 10, 1, 750),
(34, '2020-01-25', '2020-01-30', 1, 10, 1, 750),
(35, '2020-01-25', '2020-01-30', 1, 11, 2, 750),
(37, '2020-01-25', '2020-01-30', 1, 11, 2, 750),
(38, '2020-01-25', '2020-01-30', 1, 11, 2, 750),
(39, '2020-01-25', '2020-01-30', 1, 11, 2, 750),
(40, '2020-01-25', '2020-01-30', 1, 11, 2, 750),
(41, '2020-01-25', '2020-01-30', 1, 11, 2, 750),
(42, '2020-01-25', '2020-01-30', 1, 11, 2, 750);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `Salary` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`Id`, `Name`, `Surname`, `Username`, `Password`, `RoleId`, `Salary`, `Status`) VALUES
(1, 'Test', 'Administrator', 'test_administrator@h', '123456789', 1, 800, 1),
(2, 'Freskim', 'Elmazi', 'freskim.elmazi', '25f9e794323b453885f5181f1b624d0b', 1, 123, 1);

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Address` varchar(20) NOT NULL,
  `City` varchar(10) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `PersonalID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`Id`, `Name`, `Surname`, `Username`, `PhoneNumber`, `Address`, `City`, `Country`, `PersonalID`) VALUES
(1, 'Test', 'Guest', 'test_guest@email.com', '+38970618968', '15 Example', 'Skopje', 'North Macedonia', '1905992473009'),
(8, 'Freskim', 'Elmazi', 'felmazi', '+38972625879', 'Ilindenska bb', 'Gostivar', 'Macedonia', '1905922654789'),
(10, 'Edmond', 'Saliji', 'Esaliji', '+38971249627', 'Ilindenska bb', 'Gostivar', 'Macedonia', '2193129382193'),
(11, 'Ezan', 'Iljazi', 'asdasdsa', '+38971249627', 'Ilindenska bb', 'Gostivar', 'Macedonia', 'asdasdad654654');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `floor` int(11) DEFAULT NULL,
  `is_available` bit(1) DEFAULT NULL,
  `people` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `room_number` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `Id` int(11) NOT NULL,
  `RoleName` varchar(10) NOT NULL,
  `RoleNameDisplay` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Id`, `RoleName`, `RoleNameDisplay`) VALUES
(1, 'ADMIN', 'Administrator'),
(2, 'MANAGER', 'Manager'),
(3, 'RECEPTION', 'Receptionist');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `Id` int(11) NOT NULL,
  `RoomNumber` int(11) NOT NULL,
  `Floor` int(11) NOT NULL,
  `People` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `IsAvailable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`Id`, `RoomNumber`, `Floor`, `People`, `Price`, `IsAvailable`) VALUES
(1, 333, 333, 333, 333, 1),
(4, 202, 2, 2, 10, 1),
(5, 203, 2, 2, 10, 1),
(8, 1, 1, 2, 25, 1),
(21, 3, 333, 55, 35, 1),
(22, 45, 45, 45, 45, 0),
(23, 11, 233, 65, 25, 1),
(24, 111, 133, 65, 25, 1),
(25, 211, 133, 65, 25, 0),
(26, 212, 12, 4, 35, 1),
(27, 213, 12, 4, 35, 1),
(28, 214, 12, 4, 35, 1),
(29, 215, 12, 4, 35, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `RoomId` (`RoomId`),
  ADD KEY `GuestId` (`GuestId`),
  ADD KEY `AddedBy` (`AddedBy`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `RoleId` (`RoleId`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `PersonalID` (`PersonalID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `RoleName` (`RoleName`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `RoomNumber` (`RoomNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`RoomId`) REFERENCES `rooms` (`Id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`GuestId`) REFERENCES `guests` (`Id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`AddedBy`) REFERENCES `employees` (`Id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`RoleId`) REFERENCES `roles` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
