-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2018 at 10:29 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `nominees`
--

CREATE TABLE `nominees` (
  `id` int(11) NOT NULL,
  `org` varchar(60) NOT NULL,
  `pos` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `employee_id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nominees`
--

INSERT INTO `nominees` (`id`, `org`, `pos`, `name`, `employee_id`) VALUES
(1, 'RAS Cégcsoport', 'Az Innovátor', 'Balogh Gyula', '10001'),
(2, 'RAS Cégcsoport', 'Az Innovátor', 'Herczku Beatrix', '10002'),
(3, 'RAS Cégcsoport', 'Az Innovátor', 'Kiss Erika', '10003'),
(4, 'RAS Cégcsoport', 'Az Innovátor', 'Tóth Császár Gergely', '10004'),
(5, 'RAS Cégcsoport', 'Az Innovátor', 'Bokor Klára', '10005'),
(6, 'RAS Cégcsoport', 'A Történetmesélő', 'Fekete Lajos', '10006'),
(7, 'RAS Cégcsoport', 'A Történetmesélő', 'B. Tier Noémi', '10007'),
(8, 'RAS Cégcsoport', 'A Történetmesélő', 'Forró Gábor Zoltán', '10008'),
(9, 'RAS Cégcsoport', 'A Történetmesélő', 'Katymári Vanda', '10009'),
(10, 'RAS Cégcsoport', 'A Történetmesélő', 'Koszó-Stammberger Kinga', '10010'),
(11, 'RAS Cégcsoport', 'A Történetmesélő', 'Rácz Zita', '10011'),
(12, 'RAS Cégcsoport', 'A Történetmesélő', 'Veres Gábor', '10012'),
(13, 'RAS Cégcsoport', 'A Kolléga', 'Jelen Szilvia', '10013'),
(14, 'RAS Cégcsoport', 'A Kolléga', 'Cserép Tamás', '10014'),
(15, 'RAS Cégcsoport', 'A Kolléga', 'Demeter Csilla', '10015'),
(16, 'RAS Cégcsoport', 'A Kolléga', 'Fekete Lajos', '10016'),
(17, 'RAS Cégcsoport', 'A Kolléga', 'Fekésháziné Balog Marianna', '10017'),
(18, 'RAS Cégcsoport', 'A Kolléga', 'Goron Margó', '10018'),
(19, 'RAS Cégcsoport', 'A Kolléga', 'Györkös László', '10019'),
(20, 'RAS Cégcsoport', 'A Kolléga', 'Hídváry Péter', '10020'),
(21, 'RAS Cégcsoport', 'A Kolléga', 'Kincses Erika', '10021'),
(22, 'RAS Cégcsoport', 'A Kolléga', 'Kun Krisztina', '10022'),
(23, 'RAS Cégcsoport', 'A Kolléga', 'Loványi Kata', '10023'),
(24, 'RAS Cégcsoport', 'A Kolléga', 'Dr. Marunák Istvánné', '10024'),
(25, 'RAS Cégcsoport', 'A Kolléga', 'Moharos Andrea', '10025'),
(26, 'RAS Cégcsoport', 'A Kolléga', 'Nagy Franciska', '10026'),
(27, 'RAS Cégcsoport', 'A Kolléga', 'Pataky Éva', '10027'),
(28, 'RAS Cégcsoport', 'A Kolléga', 'Schwang László', '10028'),
(29, 'RAS Cégcsoport', 'A Kolléga', 'Sódar József', '10029'),
(30, 'RAS Cégcsoport', 'A Kolléga', 'Szabó István', '10030'),
(31, 'RAS Cégcsoport', 'A Kolléga', 'Szászváryné Kormány Ildikó', '10031'),
(32, 'RAS Cégcsoport', 'A Kolléga', 'Szira Krisztina', '10032'),
(33, 'RAS Cégcsoport', 'A Kolléga', 'Tóth-Császár Gergely', '10033'),
(34, 'RAS Cégcsoport', 'A Kolléga', 'Winkler Péter', '10034'),
(35, 'RAS Cégcsoport', 'A Kolléga', 'Szilágyi Gábor', '10035'),
(36, 'RAS Cégcsoport', 'A Kolléga', 'Bokor Klára', '10036'),
(37, 'RAS Cégcsoport', 'A Csapat', 'A Blikk.hu homepage managereinek csapata', '10037'),
(38, 'RAS Cégcsoport', 'A Csapat', 'Az IT webfejlesztő csapat', '10038'),
(39, 'RAS Cégcsopor', 'A Csapat', 'A kis gasztro lapok hátterében dolgozók csapata', '10039'),
(40, 'RAS Cégcsoport', 'A Csapat', 'A Glamour csapata', '10040'),
(41, 'RAS Cégcsoport', 'A Csapat', 'A műsorújságok szerkesztősége', '10041'),
(42, 'RAS Cégcsoport', 'A Csapat', 'A gasztro szerkesztőség', '10042'),
(43, 'RAS Cégcsoport', 'A Csapat', 'Kiskegyed szerkesztősége', '10043'),
(44, 'RAS Cégcsoport', 'A Csapat', 'A Blikk fotórovata', '10044'),
(45, 'RAS Cégcsoport', 'A Csapat', 'Marketing', '10045'),
(46, 'RAS Cégcsoport', 'A Csapat', 'A Női Lapok Szerkesztőségének gyártási csoportja', '10046'),
(47, 'PROFESSION.HU', 'Az Innovátor', 'Balogh Eleonóra', '10047'),
(48, 'PROFESSION.HU', 'Az Innovátor', 'dr. Andavölgyi Vivien', '10048'),
(49, 'PROFESSION.HU', 'Az Innovátor', 'Eikel Roland', '10049'),
(50, 'PROFESSION.HU', 'Az Innovátor', 'Gergely Borbála', '10050'),
(51, 'PROFESSION.HU', 'Az Innovátor', 'Laczkó-Angi Ibolya', '10051'),
(52, 'PROFESSION.HU', 'Az Innovátor', 'Lénárt Dorottya', '10052'),
(53, 'PROFESSION.HU', 'Az Innovátor', 'Sipiczki György', '10053'),
(54, 'PROFESSION.HU', 'Az Innovátor', 'Varga Ádám', '10054'),
(55, 'PROFESSION.HU', 'Az Ügyfélélmény-építő', 'Beke Fruzsina', '10055'),
(56, 'PROFESSION.HU', 'Az Ügyfélélmény-építő', 'Gergely Borbála', '10056'),
(57, 'PROFESSION.HU', 'Az Ügyfélélmény-építő', 'Győri Annamária', '10057'),
(58, 'PROFESSION.HU', 'Az Ügyfélélmény-építő', 'Laczkó-Angi Ibolya', '10058'),
(59, 'PROFESSION.HU', 'Az Ügyfélélmény-építő', 'Nagy Orsolya', '10059'),
(60, 'PROFESSION.HU', 'Az Ügyfélélmény-építő', 'Speiser Tamara', '10060'),
(61, 'PROFESSION.HU', 'Az Ügyfélélmény-építő', 'Szauer Renáta', '10061'),
(62, 'PROFESSION.HU', 'Az Ügyfélélmény-építő', 'Torma Orsolya', '10062'),
(63, 'PROFESSION.HU', 'A Csapat', 'Elemzők', '10063'),
(64, 'PROFESSION.HU', 'A Csapat', 'GDPR team', '10064'),
(65, 'PROFESSION.HU', 'A Csapat', 'HR', '10065'),
(66, 'PROFESSION.HU', 'A Csapat', 'KAM', '10066'),
(67, 'PROFESSION.HU', 'A Csapat', 'Marketing', '10067'),
(68, 'PROFESSION.HU', 'A Csapat', 'Pénzügy', '10068'),
(69, 'PROFESSION.HU', 'A Csapat', 'Régió', '10069'),
(70, 'PROFESSION.HU', 'A Csapat', 'Support', '10070'),
(71, 'PROFESSION.HU', 'A Csapat', 'Ügyfélkapcsolatok', '10071'),
(72, 'PROFESSION.HU', 'A Csapat', 'Üzletfejlesztés', '10072');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nominees`
--
ALTER TABLE `nominees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nominees`
--
ALTER TABLE `nominees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
