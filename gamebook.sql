-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 11 okt 2018 kl 11:17
-- Serverversion: 10.1.29-MariaDB
-- PHP-version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `gamebook`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `story`
--

CREATE TABLE `story` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `story`
--

INSERT INTO `story` (`id`, `text`) VALUES
(1, 'Your name is Alfredo, you are currently at a party hosted by your love interest; Violetta.'),
(2, 'Are you going to ask Violetta out, or do you just want to go home?'),
(3, 'Violetta gives you a flower and tells you to return when it dies.'),
(4, 'It\'s now been three months since you and Violetta got together.\r\nThere is only one problem... Violeta has no money.\r\nWill you help her?'),
(5, 'UH OH, LOOKS LIKE SHE WANTS TO LEAVE YOU ALL OF A SUDDEN.\r\nSHE HAS PROBABLY BEEN CHEATING ON YOU ALL THIS TIME, STUPID THOT!\r\nWHAT ARE YOU GONNA DO ABOUT IT?'),
(6, 'You decide to call her out publicly in the middle of a party she is going to.\r\nYou call for the attention of everyone at the party. What do you say?'),
(7, 'Violetta says that she still loves you and wants to get back together.\r\nDo you accept?'),
(8, 'You and Violetta live happily ever after.\r\n(Except not really because she dies from an illness)'),
(9, 'You go home and continue living your boring life.\r\nCongrats! You messed up on the first choice!\r\n\r\nThe End?'),
(10, 'You throw the flower in a trash can and forget about it.\r\nYour life continues like normal.\r\n\r\nThe End?'),
(11, 'You decide to not give Violetta any money, leaving her in povety.\r\nServes her right.\r\n\r\nThe End?'),
(12, 'You set out to find a way to impress Violetta. After about a day of searching you see something strange. It\'s a big purple man with some kind of strange gauntlet. Could it be? FORTNITE THANOS?!\r\nWhat do you do?'),
(13, '*Thanos snaps his fingers*\r\n\"I don\'t feel so good\"\r\n\r\nThe End?'),
(14, 'ITS A CRITICAL HIT!\r\nThanos got scared and ran away...\r\nWhat do you want to do?');

-- --------------------------------------------------------

--
-- Tabellstruktur `storylinks`
--

CREATE TABLE `storylinks` (
  `id` int(10) UNSIGNED NOT NULL,
  `storyid` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `text` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `storylinks`
--

INSERT INTO `storylinks` (`id`, `storyid`, `target`, `text`) VALUES
(1, 1, 2, 'Next'),
(2, 2, 3, 'Ask her out'),
(3, 2, 9, 'Go home'),
(4, 3, 4, 'Do as she says'),
(5, 3, 10, 'Throw away the flower'),
(6, 4, 5, 'Help Violetta get money.'),
(7, 4, 11, 'Of course not! She is just trying to use me!'),
(8, 5, 6, 'Call her out in public'),
(9, 6, 7, '\"VIOLETTA IS A STUPID THOT\"'),
(10, 6, 0, '\"VIOLETTA ONLY WANTS YOUR MONEY!\"'),
(11, 7, 8, 'Yes'),
(12, 7, 0, 'No'),
(13, 5, 12, 'Find a way to impress Violetta and win her back'),
(14, 12, 13, 'Tell him to snap his fingers'),
(15, 12, 14, 'Attack him'),
(16, 14, 7, 'Flex on Violetta'),
(17, 14, 15, 'Run after him and apologize');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `storylinks`
--
ALTER TABLE `storylinks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `story`
--
ALTER TABLE `story`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT för tabell `storylinks`
--
ALTER TABLE `storylinks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
