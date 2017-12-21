-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 21. 12 2017 kl. 15:02:20
-- Serverversion: 10.1.29-MariaDB
-- PHP-version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `migmiger`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `brugere`
--

CREATE TABLE `brugere` (
  `id` int(30) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(128) NOT NULL,
  `profilepic` varchar(128) NOT NULL DEFAULT 'default-profile.png',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `brugere`
--

INSERT INTO `brugere` (`id`, `username`, `password`, `profilepic`, `created`, `modified`) VALUES
(1, 'felix', '123', 'default-profile.png', '2017-12-19 10:53:56', '2017-12-19 10:53:56'),
(3, 'danny', 'gemme', '1513859156.jpg', '2017-12-20 08:57:40', '2017-12-20 08:57:40');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `comments`
--

CREATE TABLE `comments` (
  `id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `post_id` int(30) NOT NULL,
  `bruger_id` int(30) NOT NULL,
  `votes` int(60) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `comments`
--

INSERT INTO `comments` (`id`, `comment`, `post_id`, `bruger_id`, `votes`, `created`) VALUES
(5, 'gemme', 15, 3, 0, '2017-12-21 11:32:59'),
(6, 'hej med dig', 15, 3, 0, '2017-12-21 11:34:28'),
(7, 'gemme2', 15, 3, 0, '2017-12-21 11:35:14'),
(8, 'fafaf', 16, 3, 0, '2017-12-21 11:39:50'),
(12, 'kdahd', 15, 3, 0, '2017-12-21 14:18:50'),
(13, 'hdifue', 16, 3, 0, '2017-12-21 14:19:30'),
(14, 'haoirjrpa', 15, 1, 0, '2017-12-21 14:49:04'),
(15, 'tjsgpkaspd', 16, 1, 0, '2017-12-21 14:56:47');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `posts`
--

CREATE TABLE `posts` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `billede` varchar(128) NOT NULL,
  `bruger_id` int(60) NOT NULL,
  `votes` int(60) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `posts`
--

INSERT INTO `posts` (`id`, `title`, `billede`, `bruger_id`, `votes`) VALUES
(15, 'Gems', '1513848135.jpg', 3, 2),
(16, 'gem2', '1513852610.jpg', 3, 0);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `votes`
--

CREATE TABLE `votes` (
  `post_id` int(60) NOT NULL,
  `bruger_id` int(60) NOT NULL,
  `vote` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `votes`
--

INSERT INTO `votes` (`post_id`, `bruger_id`, `vote`) VALUES
(15, 3, 1),
(16, 3, 1),
(15, 1, 1),
(16, 1, -1);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `brugere`
--
ALTER TABLE `brugere`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bruger_id` (`bruger_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indeks for tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Bruger_Link` (`bruger_id`);

--
-- Indeks for tabel `votes`
--
ALTER TABLE `votes`
  ADD KEY `Postlink` (`post_id`),
  ADD KEY `brugerLink` (`bruger_id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `brugere`
--
ALTER TABLE `brugere`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tilføj AUTO_INCREMENT i tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`bruger_id`) REFERENCES `brugere` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Begrænsninger for tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `Bruger_Link` FOREIGN KEY (`bruger_id`) REFERENCES `brugere` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Begrænsninger for tabel `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `Postlink` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `brugerLink` FOREIGN KEY (`bruger_id`) REFERENCES `brugere` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
