-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2024 at 03:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WB2`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `numero_proprio` varchar(10) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `nom_contact` varchar(10) NOT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `numero_proprio`, `contact`, `nom_contact`, `date_enregistrement`) VALUES
(1, '0903341906', '0818247176', 'Mr Kany', '2024-07-06 00:00:00'),
(2, '0903341906', '0000000000', 'verite', '2024-07-07 00:00:00'),
(3, '0818247176', '0903341906', 'autre', '2024-07-07 13:47:04'),
(4, '0000000000', '0903341906', 'emmanuel', '2024-07-07 23:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `expediteur` varchar(10) NOT NULL,
  `receveur` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `date_envoie` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `expediteur`, `receveur`, `message`, `date_envoie`) VALUES
(1, '0903341906', '0818247176', 'bonjour a tous !!!', '2024-07-07 00:18:28'),
(2, '0903341906', '0818247176', 'bonjour a tous !!!', '2024-07-07 02:29:47'),
(3, '0818247176', '0903341906', 'bonjour l\'ami ca va ?', '2024-07-07 05:32:41'),
(4, '0818247176', '0903341906', 'comment emmanuel evolue ?', '2024-07-07 16:05:28'),
(5, '0903341906', '0818247176', 'ouais ca roule pour lui', '2024-07-07 16:08:17'),
(6, '0903341906', '0000000000', 'hello homoculus!!', '2024-07-07 16:09:01'),
(7, '0818247176', '0903341906', 'hello!', '2024-07-07 23:24:17'),
(8, '0818247176', '0903341906', 'tu es la ?', '2024-07-07 23:29:20'),
(9, '0903341906', '0000000000', 'bonjour bro', '2024-07-07 23:40:35'),
(10, '0000000000', '0903341906', 'comment tu vas ?', '2024-07-07 23:42:15'),
(11, '0000000000', '0903341906', 'ca fait vraiment longtemps', '2024-07-07 23:42:29'),
(12, '0000000000', '0903341906', 'jjgjfjffffufu', '2024-07-07 23:43:02'),
(13, '0000000000', '0903341906', 'hello?', '2024-07-07 23:48:13'),
(14, '0000000000', '0903341906', 'comment tu vas?', '2024-07-07 23:48:24'),
(15, '0000000000', '0903341906', 'comment ca se passe ?', '2024-07-07 23:52:58'),
(16, '0903341906', '0000000000', 'comment ca se passe ?', '2024-07-08 00:13:20'),
(17, '0903341906', '0000000000', 'comment tu vas?', '2024-07-08 01:29:01'),
(18, '0903341906', '0000000000', 'moi cava hein', '2024-07-08 01:29:17'),
(19, '0903341906', '0818247176', 'salut bro', '2024-07-08 01:29:34'),
(20, '0903341906', '0818247176', 'comment tu vas ?', '2024-07-08 01:29:43'),
(21, '0903341906', '0818247176', 'salut bro', '2024-07-08 01:40:30'),
(22, '0000000000', '0903341906', 'comment se passe les examens ?', '2024-07-08 01:48:07'),
(23, '0903341906', '0000000000', 'ouais ca va hein ca se passe super bien et de ton cote ?', '2024-07-08 01:48:35'),
(24, '0000000000', '0903341906', 'super aussi en tout cas', '2024-07-08 01:48:56'),
(25, '0000000000', '0903341906', 'bon a plus!', '2024-07-08 01:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `numero_telephone` varchar(10) NOT NULL,
  `nom_utilisateur` varchar(255) NOT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp(),
  `about` text DEFAULT NULL,
  `photo` varchar(1000) DEFAULT NULL,
  `mot_de_passe` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`numero_telephone`, `nom_utilisateur`, `date_enregistrement`, `about`, `photo`, `mot_de_passe`) VALUES
('0000000000', 'verite', '2024-07-07 02:50:32', 'fullmetal', '../IMAGES/IMG_2405.JPG', '$2y$10$I2MWQT4ijTNomChHaaoJ3.ZWRLg07CiO.s4ymmrUshXlD8Tf.tY/W'),
('0818247176', 'Kanny', '2024-07-06 20:39:57', 'indisponible pour le moment ', '../IMAGES/kanye.JPG', '$2y$10$LWQH/FWFHI1EdkRHnv8MtuwGfZQjUU/2FFp8PVViT/e.H21wzvP3a'),
('0903341906', 'walter white', '2024-07-06 19:35:02', 'Disponible', '../IMAGES/IMG_2429.JPG', '$2y$10$E7qMtZDLmrWbZrgl0mCARuc3fQspzzSo4qQ4OBh49xUegF1B0ualO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expediteur` (`expediteur`),
  ADD KEY `receveur` (`receveur`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`numero_telephone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`expediteur`) REFERENCES `utilisateur` (`numero_telephone`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receveur`) REFERENCES `utilisateur` (`numero_telephone`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
