-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2021 at 07:27 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rpnk_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `dania`
--

CREATE TABLE `dania` (
  `id` int(10) UNSIGNED NOT NULL,
  `typ` int(10) UNSIGNED DEFAULT NULL,
  `nazwa` text DEFAULT NULL,
  `cena` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dania`
--

INSERT INTO `dania` (`id`, `typ`, `nazwa`, `cena`) VALUES
(1, 1, 'Gazpacho', 20),
(2, 1, 'Krem z warzyw', 25),
(3, 1, 'Gulaszowa ostra', 30),
(4, 2, 'Kaczka i owoc', 30),
(5, 2, 'Kurczak pieczony', 40),
(6, 2, 'wieprzowy przysmak', 35),
(7, 2, 'Mintaj w panierce', 30),
(8, 2, 'Alle kotlet', 30),
(9, 3, 'Owoce morza', 20),
(10, 3, 'Grzybki, warzywka, sos', 15),
(11, 3, 'Orzechy i chipsy', 10),
(12, 3, 'Suchy chleb', 300),
(13, 3, 'Bukiet warzyw', 10),
(14, 4, 'Sok porzeczkowy', 3),
(15, 4, 'Cola', 5),
(16, 4, 'Woda', 2),
(17, 2, 'Spagetti po Bolo?sku', 24),
(21, 2, 'Jab?ko', 3);

-- --------------------------------------------------------

--
-- Table structure for table `klienci`
--

CREATE TABLE `klienci` (
  `id` int(10) UNSIGNED NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `telefon` text NOT NULL,
  `email` text DEFAULT NULL,
  `haslo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`id`, `imie`, `nazwisko`, `telefon`, `email`, `haslo`) VALUES
(1, 'Bronisław', 'Andrzejewski', '111111111', 'bronislaw.andrzejewski@gmail.com', 'Bronislaw123'),
(2, 'Edward', 'Kozłowski', '222222222', 'edward.kozlowski@gmail.com', 'Edward123'),
(3, 'Katarzyna', 'Nowak', '333333333', 'katarzyna.nowak@gmail.com', 'Katarzyna123'),
(4, 'Irena', 'Brzezińska', '444444444', 'irena.brzezinska@gmail.com', 'Irena123'),
(5, 'filip', 'krakowiak', '536369383', 'filipkrakowiak@gmail.com', 'Haslo113'),
(6, 'Artur', 'Nizio', '785415843', 'artur.nizio@gmail.com', 'Artur123'),
(8, 'Jakub', 'Rząd', '113113113', 'jakub.rzad@gmail.com', 'Jakub123'),
(10, 'Aleksander', 'Kwiatkowski', '999999999', 'aleksander.kwiatkowski@gmail.com', 'Aleksander123');

-- --------------------------------------------------------

--
-- Table structure for table `pracownicy`
--

CREATE TABLE `pracownicy` (
  `id` int(10) UNSIGNED NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `stanowisko` int(11) NOT NULL,
  `haslo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pracownicy`
--

INSERT INTO `pracownicy` (`id`, `imie`, `nazwisko`, `stanowisko`, `haslo`) VALUES
(1, 'Anna', 'Kowalska', 1, 'Anna123'),
(2, 'Monika', 'Nowak', 2, 'Monika123'),
(3, 'Ewelina', 'Nowakowska', 2, 'Ewelina123'),
(10, 'Aleksander', 'Zalewski', 1, 'Aleksander123'),
(11, 'Roman', 'Sikora', 2, 'Roman123'),
(12, 'Julian', 'Jaworski', 3, 'Julian123'),
(13, 'Filip', 'Krakowiak', 1, 'Haslo113');

-- --------------------------------------------------------

--
-- Table structure for table `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(5) NOT NULL,
  `klient_id` int(5) NOT NULL,
  `danie_id` int(5) NOT NULL,
  `status_zam` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `klient_id`, `danie_id`, `status_zam`) VALUES
(24, 1, 3, 2),
(25, 8, 6, 3),
(26, 8, 1, 1),
(27, 8, 10, 2),
(28, 8, 10, 1),
(29, 8, 13, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dania`
--
ALTER TABLE `dania`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dania`
--
ALTER TABLE `dania`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
