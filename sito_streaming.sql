-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Giu 21, 2022 alle 09:52
-- Versione del server: 5.7.34
-- Versione PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sito_streaming`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `accounts`
--

CREATE TABLE `accounts` (
  `IdAccount` int(11) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Mail` varchar(40) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Canale` tinyint(1) NOT NULL,
  `NumeroIscritti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `accounts`
--

INSERT INTO `accounts` (`IdAccount`, `Username`, `Mail`, `Password`, `Canale`, `NumeroIscritti`) VALUES
(6, 'Emanuele', 'ema.arte@gmail.com', '$2y$10$WCuwQF.JFT8q5nDG4rLIE.l/AtFYINoTa7gQ5Qq0ThniLMpiCnrbC', 1, 3),
(7, 'Lollo', 'boh@lollo.com', '$2y$10$d/E5CvjfXB20YzZhFm0zIeqsB8gHZgwJ/r7X17fyiqVo79Hq51up.', 1, 0),
(8, 'Spettatore', 'prova@prova.it', '$2y$10$tOjZhA8hACnFkz2MX2w0OOx0CDMRkLLqh7Bek387b97tUTk7NBo06', 0, NULL),
(9, 'Roberto', 'drake@drake.com', '$2y$10$nQfbweQ4MWwmSgUZ/hAJzutFUpWokyL/WMlqLmAOtJaXvrUKHs5LS', 1, 3),
(10, 'Cocco', 'cocchiddu@mi.cio', '$2y$10$5HZTo0lsP.BorVArloJpCuzxwFBbRTJoKHZ/ayHL2qh0mOWeBAUaq', 0, NULL),
(11, 'Baghera', 'baghi@black.cat', '$2y$10$HO3WMMHkKUdIp9Z4ZdeUCeoY2ODKQD69BqVyt9EdvZkfolAuqxMyW', 0, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `appartenenze_gruppi`
--

CREATE TABLE `appartenenze_gruppi` (
  `IdGruppo` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `appartenenze_gruppi`
--

INSERT INTO `appartenenze_gruppi` (`IdGruppo`, `IdAccount`) VALUES
(1, 6),
(13, 6),
(14, 6),
(14, 7),
(1, 9),
(9, 9),
(13, 9),
(1, 10),
(9, 10),
(13, 10),
(14, 10),
(9, 11),
(13, 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `categorizzazioni_video`
--

CREATE TABLE `categorizzazioni_video` (
  `IdEtichetta` int(11) NOT NULL,
  `IdVideo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `categorizzazioni_video`
--

INSERT INTO `categorizzazioni_video` (`IdEtichetta`, `IdVideo`) VALUES
(1, 3),
(1, 4),
(1, 5),
(2, 6),
(4, 8),
(6, 9),
(14, 9),
(11, 11),
(14, 11),
(10, 12),
(11, 13),
(13, 13),
(9, 21),
(1, 22),
(3, 23),
(3, 24),
(5, 25),
(6, 25),
(5, 26),
(8, 26),
(6, 27),
(8, 27),
(13, 27),
(2, 28),
(8, 28);

-- --------------------------------------------------------

--
-- Struttura della tabella `chats`
--

CREATE TABLE `chats` (
  `IdChat` int(11) NOT NULL,
  `IdAccount1` int(11) NOT NULL,
  `IdAccount2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `chats`
--

INSERT INTO `chats` (`IdChat`, `IdAccount1`, `IdAccount2`) VALUES
(2, 6, 9),
(3, 9, 10),
(5, 10, 6),
(8, 10, 7),
(11, 11, 9),
(12, 6, 7),
(13, 8, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

CREATE TABLE `commenti` (
  `IdCommento` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `TestoCommento` varchar(200) NOT NULL,
  `DataCommento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IdPost` int(11) DEFAULT NULL,
  `IdVideo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `commenti`
--

INSERT INTO `commenti` (`IdCommento`, `IdAccount`, `TestoCommento`, `DataCommento`, `IdPost`, `IdVideo`) VALUES
(7, 6, 'Bella canzone', '2022-06-17 17:41:14', NULL, 3),
(11, 6, 'ciaoo', '2022-06-17 17:49:59', NULL, 3),
(24, 9, 'Questa canzone spacca :)', '2022-06-20 21:30:40', NULL, 4),
(25, 9, 'o.o', '2022-06-20 22:19:19', NULL, 21),
(26, 6, 'Molto bene', '2022-06-21 09:38:33', 9, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `composizioni_playlists`
--

CREATE TABLE `composizioni_playlists` (
  `IdVideo` int(11) NOT NULL,
  `IdPlaylist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `composizioni_playlists`
--

INSERT INTO `composizioni_playlists` (`IdVideo`, `IdPlaylist`) VALUES
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(11, 1),
(21, 1),
(25, 1),
(4, 2),
(11, 2),
(3, 3),
(4, 3),
(21, 3),
(23, 3),
(24, 3),
(27, 3),
(3, 4),
(4, 4),
(3, 5),
(3, 6),
(3, 7),
(4, 7),
(5, 7),
(6, 7),
(8, 7),
(9, 7),
(11, 7),
(12, 7),
(13, 7),
(21, 7),
(22, 7),
(4, 8),
(5, 8),
(6, 8),
(21, 8),
(22, 8),
(6, 9),
(6, 10),
(6, 11),
(6, 12),
(3, 15),
(6, 15),
(6, 16),
(3, 17),
(4, 17),
(5, 17),
(22, 17),
(23, 18),
(24, 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `etichette`
--

CREATE TABLE `etichette` (
  `IdEtichetta` int(11) NOT NULL,
  `NomeEtichetta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `etichette`
--

INSERT INTO `etichette` (`IdEtichetta`, `NomeEtichetta`) VALUES
(1, 'Musica'),
(2, 'Animali'),
(3, 'Sport'),
(4, 'Motori'),
(5, 'Viaggi'),
(6, 'Vlog'),
(7, 'Azione'),
(8, 'Curiosità'),
(9, 'Giochi'),
(10, 'Trailer'),
(11, 'Tutorial'),
(12, 'Avventura'),
(13, 'Cibo'),
(14, 'Tecnologia');

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppi`
--

CREATE TABLE `gruppi` (
  `IdGruppo` int(11) NOT NULL,
  `NomeGruppo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `gruppi`
--

INSERT INTO `gruppi` (`IdGruppo`, `NomeGruppo`) VALUES
(1, 'Friends'),
(9, 'Gruppo Prova'),
(13, 'aMici'),
(14, 'Er club');

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizioni`
--

CREATE TABLE `iscrizioni` (
  `IdCanale` int(11) NOT NULL,
  `IdIscritto` int(11) NOT NULL,
  `DataIscrizione` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `iscrizioni`
--

INSERT INTO `iscrizioni` (`IdCanale`, `IdIscritto`, `DataIscrizione`) VALUES
(6, 7, '2022-06-21 11:42:42'),
(6, 8, '2022-06-21 09:31:20'),
(6, 9, '2022-06-20 17:42:27'),
(9, 6, '2022-06-13 19:18:15'),
(9, 10, '2022-06-14 18:30:02'),
(9, 11, '2022-06-15 00:21:41');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `IdMessaggio` int(11) NOT NULL,
  `TestoMessaggio` varchar(200) NOT NULL,
  `DataInvio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IdChat` int(11) DEFAULT NULL,
  `IdGruppo` int(11) DEFAULT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `messaggi`
--

INSERT INTO `messaggi` (`IdMessaggio`, `TestoMessaggio`, `DataInvio`, `IdChat`, `IdGruppo`, `IdAccount`) VALUES
(7, 'questo messaggio è in un gruppo', '2022-06-14 16:10:58', NULL, 1, 9),
(12, 'Ehi anche io sono nel gruppo!', '2022-06-14 16:24:34', NULL, 1, 10),
(17, 'Ciao', '2022-06-15 00:09:09', 8, NULL, 10),
(27, 'Prova', '2022-06-16 16:10:36', 12, NULL, 6),
(28, 'Bene', '2022-06-17 17:19:15', 12, NULL, 7),
(29, 'Ciao Baghera :)', '2022-06-20 21:48:26', 11, NULL, 9),
(30, 'Ciao come va?', '2022-06-20 21:48:52', 3, NULL, 9),
(31, 'Questo è un gruppo di prova', '2022-06-20 21:49:14', NULL, 9, 9),
(32, 'Un altro gruppo', '2022-06-20 21:50:36', NULL, 13, 9),
(35, 'Ciao', '2022-06-21 09:32:56', 13, NULL, 8),
(36, 'Ciao, ti piacciono i miei video?', '2022-06-21 09:33:37', 13, NULL, 6),
(37, 'Si molto', '2022-06-21 09:33:47', 13, NULL, 8),
(40, 'Ci sono anche ioooo', '2022-06-21 11:27:17', NULL, 1, 6),
(41, 'Di amanti dei gatttttttiiiiii', '2022-06-21 11:32:12', NULL, 13, 6),
(42, 'Ciao', '2022-06-21 11:32:59', NULL, 14, 6),
(43, 'Chi tifate nella partita di stasera?', '2022-06-21 11:33:23', NULL, 14, 6),
(44, 'Roma, ovviamente', '2022-06-21 11:33:42', NULL, 14, 7),
(45, 'Io Lazio invece', '2022-06-21 11:35:08', NULL, 14, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `playlists`
--

CREATE TABLE `playlists` (
  `IdPlaylist` int(11) NOT NULL,
  `Pubblica` tinyint(1) NOT NULL,
  `NomePlaylist` varchar(40) DEFAULT NULL,
  `TipoPlaylist` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `playlists`
--

INSERT INTO `playlists` (`IdPlaylist`, `Pubblica`, `NomePlaylist`, `TipoPlaylist`, `IdAccount`) VALUES
(1, 0, NULL, 1, 6),
(2, 0, NULL, 2, 6),
(3, 0, NULL, 1, 7),
(4, 1, NULL, 2, 7),
(5, 0, NULL, 1, 8),
(6, 0, NULL, 2, 8),
(7, 0, NULL, 1, 9),
(8, 0, NULL, 2, 9),
(9, 0, NULL, 1, 10),
(10, 0, NULL, 2, 10),
(11, 0, NULL, 1, 11),
(12, 0, NULL, 2, 11),
(15, 1, 'La mia prima playlist pubblica', 0, 6),
(16, 0, 'Privatissima', 0, 6),
(17, 1, 'Musica', 0, 9),
(18, 1, 'Highlights', 0, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `post_scritti`
--

CREATE TABLE `post_scritti` (
  `IdPost` int(11) NOT NULL,
  `Titolo` varchar(40) NOT NULL,
  `DataPubblicazione` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TestoPost` varchar(400) NOT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `post_scritti`
--

INSERT INTO `post_scritti` (`IdPost`, `Titolo`, `DataPubblicazione`, `TestoPost`, `IdAccount`) VALUES
(9, 'Questo è un post scritto', '2022-06-20 21:32:12', 'E qui posso scrivere qualunque cosa', 9),
(10, 'Novità!!!', '2022-06-21 11:42:25', 'Ho pubblicato nuovi video per gli amanti dei viaggi.', 6),
(11, 'Tutti a tifare Roma!', '2022-06-21 11:49:12', 'Forza Roma sempre', 7),
(12, 'Visitate il mio canale', '2022-06-21 11:50:49', 'Nel mio canale troverete tanti bellissimi video per voi!\r\n;)', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `video`
--

CREATE TABLE `video` (
  `IdVideo` int(11) NOT NULL,
  `Titolo` varchar(100) NOT NULL,
  `SorgenteVideo` varchar(300) NOT NULL,
  `DataPubblicazione` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NumeroLike` int(11) NOT NULL DEFAULT '0',
  `NumeroVisualizzazioni` int(11) NOT NULL DEFAULT '0',
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `video`
--

INSERT INTO `video` (`IdVideo`, `Titolo`, `SorgenteVideo`, `DataPubblicazione`, `NumeroLike`, `NumeroVisualizzazioni`, `IdAccount`) VALUES
(3, 'Believer - Imagine Dragons', '7wtfhZwyrcc', '2022-06-09 18:50:43', 2, 4, 6),
(4, 'Sweet but psycho - Ava Max', 'WXBHCQYxwr0', '2022-06-11 10:48:27', 3, 3, 6),
(5, 'Forget me too - Machine Gun Kelly ft. Halsey', '0tn6nWYNK3Q', '2022-06-13 10:35:37', 1, 2, 6),
(6, 'Miao', 'z3U0udLH974', '2022-06-13 15:26:37', 3, 4, 9),
(8, 'Ferrari SF-90', 'lJcNhqdFo9M', '2022-06-14 16:24:30', 0, 2, 6),
(9, 'Dentro la sede di Apple', 'UoYPP4fjN2c', '2022-06-14 17:07:45', 0, 2, 6),
(11, 'MySQL in 10 minutes', '2bW3HuaAUcY', '2022-06-20 21:40:46', 1, 2, 9),
(12, 'Thor: Love and Thunder Trailer', '5mKjfZHDn_M', '2022-06-20 21:46:07', 0, 1, 9),
(13, '4 ricette ', 'WEDndTCyGgU', '2022-06-20 22:01:09', 0, 1, 9),
(21, 'Apex luck', 'YJoeKkNxdDM', '2022-06-20 22:17:51', 1, 3, 9),
(22, 'Hall of fame - The Script ft. will.i.am', 'mk48xRzuNvA', '2022-06-20 22:26:00', 1, 1, 9),
(23, 'Highlights City - Real Madrid Champions league', 'M6ilVXRQbVk', '2022-06-21 11:38:14', 0, 1, 7),
(24, 'Bodo 6 - Roma 1 highlights', 'iN7AVxT4GOQ', '2022-06-21 11:39:46', 0, 1, 7),
(25, '2 settimane in Italia', '4Pcv-66-dR8', '2022-06-21 11:41:07', 0, 1, 6),
(26, 'Cose da sapere prima di visitare Malta', 'Mka4AjU4vrc', '2022-06-21 11:41:44', 0, 0, 6),
(27, 'Roma food tour', '5SJlbeGeJ4w', '2022-06-21 11:44:32', 0, 1, 7),
(28, '15 curiosità sui cani', 'RtW2Uc1ZpdY', '2022-06-21 11:47:48', 0, 0, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `visualizzazioni`
--

CREATE TABLE `visualizzazioni` (
  `IdAccount` int(11) NOT NULL,
  `IdVideo` int(11) NOT NULL,
  `TempoVisualizzazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `visualizzazioni`
--

INSERT INTO `visualizzazioni` (`IdAccount`, `IdVideo`, `TempoVisualizzazione`) VALUES
(6, 3, 25),
(6, 4, 130),
(6, 5, 0),
(6, 6, 6),
(6, 11, 6),
(6, 21, 6),
(6, 25, 1),
(7, 3, 80),
(7, 4, 0),
(7, 21, 8),
(7, 23, 0),
(7, 24, 0),
(7, 27, 0),
(8, 3, 45),
(9, 3, 11),
(9, 4, 28),
(9, 5, 20),
(9, 6, 10),
(9, 8, 17),
(9, 9, 7),
(9, 11, 13),
(9, 12, 0),
(9, 13, 0),
(9, 21, 21),
(9, 22, 74),
(10, 6, 40),
(11, 6, 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`IdAccount`);

--
-- Indici per le tabelle `appartenenze_gruppi`
--
ALTER TABLE `appartenenze_gruppi`
  ADD PRIMARY KEY (`IdGruppo`,`IdAccount`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indici per le tabelle `categorizzazioni_video`
--
ALTER TABLE `categorizzazioni_video`
  ADD PRIMARY KEY (`IdEtichetta`,`IdVideo`),
  ADD KEY `IdVideo` (`IdVideo`);

--
-- Indici per le tabelle `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`IdChat`),
  ADD KEY `IdAccount1` (`IdAccount1`),
  ADD KEY `IdAccount2` (`IdAccount2`);

--
-- Indici per le tabelle `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`IdCommento`),
  ADD KEY `IdPost` (`IdPost`),
  ADD KEY `IdVideoC` (`IdVideo`),
  ADD KEY `IdAccountC` (`IdAccount`);

--
-- Indici per le tabelle `composizioni_playlists`
--
ALTER TABLE `composizioni_playlists`
  ADD PRIMARY KEY (`IdVideo`,`IdPlaylist`),
  ADD KEY `IdPlaylist` (`IdPlaylist`);

--
-- Indici per le tabelle `etichette`
--
ALTER TABLE `etichette`
  ADD PRIMARY KEY (`IdEtichetta`);

--
-- Indici per le tabelle `gruppi`
--
ALTER TABLE `gruppi`
  ADD PRIMARY KEY (`IdGruppo`);

--
-- Indici per le tabelle `iscrizioni`
--
ALTER TABLE `iscrizioni`
  ADD PRIMARY KEY (`IdCanale`,`IdIscritto`),
  ADD KEY `IdIscritto` (`IdIscritto`);

--
-- Indici per le tabelle `messaggi`
--
ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`IdMessaggio`),
  ADD KEY `IdChat` (`IdChat`),
  ADD KEY `IdGruppo` (`IdGruppo`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indici per le tabelle `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`IdPlaylist`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indici per le tabelle `post_scritti`
--
ALTER TABLE `post_scritti`
  ADD PRIMARY KEY (`IdPost`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indici per le tabelle `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`IdVideo`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indici per le tabelle `visualizzazioni`
--
ALTER TABLE `visualizzazioni`
  ADD PRIMARY KEY (`IdAccount`,`IdVideo`),
  ADD KEY `IdVideo` (`IdVideo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `accounts`
--
ALTER TABLE `accounts`
  MODIFY `IdAccount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `chats`
--
ALTER TABLE `chats`
  MODIFY `IdChat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `commenti`
--
ALTER TABLE `commenti`
  MODIFY `IdCommento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `etichette`
--
ALTER TABLE `etichette`
  MODIFY `IdEtichetta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `gruppi`
--
ALTER TABLE `gruppi`
  MODIFY `IdGruppo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `IdMessaggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT per la tabella `playlists`
--
ALTER TABLE `playlists`
  MODIFY `IdPlaylist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `post_scritti`
--
ALTER TABLE `post_scritti`
  MODIFY `IdPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `video`
--
ALTER TABLE `video`
  MODIFY `IdVideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `appartenenze_gruppi`
--
ALTER TABLE `appartenenze_gruppi`
  ADD CONSTRAINT `IdAccount` FOREIGN KEY (`IdAccount`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdGruppo` FOREIGN KEY (`IdGruppo`) REFERENCES `gruppi` (`IdGruppo`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `categorizzazioni_video`
--
ALTER TABLE `categorizzazioni_video`
  ADD CONSTRAINT `IdEtichetta` FOREIGN KEY (`IdEtichetta`) REFERENCES `etichette` (`IdEtichetta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdVideo` FOREIGN KEY (`IdVideo`) REFERENCES `video` (`IdVideo`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `IdAccount1` FOREIGN KEY (`IdAccount1`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdAccount2` FOREIGN KEY (`IdAccount2`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `commenti`
--
ALTER TABLE `commenti`
  ADD CONSTRAINT `IdAccountC` FOREIGN KEY (`IdAccount`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdPost` FOREIGN KEY (`IdPost`) REFERENCES `post_scritti` (`IdPost`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdVideoC` FOREIGN KEY (`IdVideo`) REFERENCES `video` (`IdVideo`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `composizioni_playlists`
--
ALTER TABLE `composizioni_playlists`
  ADD CONSTRAINT `IdPlaylist` FOREIGN KEY (`IdPlaylist`) REFERENCES `playlists` (`IdPlaylist`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdVideoP` FOREIGN KEY (`IdVideo`) REFERENCES `video` (`IdVideo`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  ADD CONSTRAINT `IdAccountM` FOREIGN KEY (`IdAccount`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdChatM` FOREIGN KEY (`IdChat`) REFERENCES `chats` (`IdChat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdGruppoM` FOREIGN KEY (`IdGruppo`) REFERENCES `gruppi` (`IdGruppo`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `IdAccountP` FOREIGN KEY (`IdAccount`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `post_scritti`
--
ALTER TABLE `post_scritti`
  ADD CONSTRAINT `IdAccountS` FOREIGN KEY (`IdAccount`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `IdAccountV` FOREIGN KEY (`IdAccount`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `visualizzazioni`
--
ALTER TABLE `visualizzazioni`
  ADD CONSTRAINT `IdAccountVis` FOREIGN KEY (`IdAccount`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdVideoVis` FOREIGN KEY (`IdVideo`) REFERENCES `video` (`IdVideo`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
