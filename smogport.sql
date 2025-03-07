-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2025 at 01:45 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smogport`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounts`
--

CREATE TABLE `accounts` (
  `Id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Id`, `Email`, `Password`) VALUES
(3, 'name@example.com', '$2y$10$Uk3saRVEoxlrvvoVg7w6KOMlMf8EchhCN4tjj/UVrrvimDsOo9gc.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `flights`
--

CREATE TABLE `flights` (
  `Id` int(11) NOT NULL,
  `DepartureTime` datetime NOT NULL,
  `ArrivalTime` datetime NOT NULL,
  `Airline` varchar(100) NOT NULL,
  `Cost` decimal(10,2) NOT NULL,
  `Departure` varchar(100) NOT NULL,
  `DepartureCountry` varchar(10) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `DestinationCountry` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`Id`, `DepartureTime`, `ArrivalTime`, `Airline`, `Cost`, `Departure`, `DepartureCountry`, `Destination`, `DestinationCountry`) VALUES
(1, '2025-03-08 21:44:39', '2025-03-25 08:44:39', 'Easy Jet', 500.00, 'Gorzów Wielkopolski', '🇵🇱', 'Berlin', '🇩🇪'),
(2, '2025-03-06 21:53:14', '2025-03-06 21:53:14', 'LOT', 300.00, 'Gorzów Wielkopolski', '🇵🇱', 'Frankfurt', '🇩🇪');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservedflights`
--

CREATE TABLE `reservedflights` (
  `Id` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `FlightId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `thelastplanescores`
--

CREATE TABLE `thelastplanescores` (
  `Id` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `Score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thelastplanescores`
--

INSERT INTO `thelastplanescores` (`Id`, `AccountId`, `Score`) VALUES
(12, 3, 0),
(13, 3, 0),
(14, 3, 2),
(15, 3, 6),
(16, 3, 0),
(17, 3, 2),
(19, 3, 27),
(20, 3, 23);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indeksy dla tabeli `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `reservedflights`
--
ALTER TABLE `reservedflights`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `AccountId` (`AccountId`),
  ADD KEY `FlightId` (`FlightId`);

--
-- Indeksy dla tabeli `thelastplanescores`
--
ALTER TABLE `thelastplanescores`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `AccountId` (`AccountId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservedflights`
--
ALTER TABLE `reservedflights`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `thelastplanescores`
--
ALTER TABLE `thelastplanescores`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservedflights`
--
ALTER TABLE `reservedflights`
  ADD CONSTRAINT `reservedflights_ibfk_1` FOREIGN KEY (`AccountId`) REFERENCES `accounts` (`Id`),
  ADD CONSTRAINT `reservedflights_ibfk_2` FOREIGN KEY (`FlightId`) REFERENCES `flights` (`Id`);

--
-- Constraints for table `thelastplanescores`
--
ALTER TABLE `thelastplanescores`
  ADD CONSTRAINT `thelastplanescores_ibfk_1` FOREIGN KEY (`AccountId`) REFERENCES `accounts` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
