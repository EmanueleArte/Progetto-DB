-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 14, 2022 alle 20:16
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

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
(6, 'Molly', 'micia@sium.it', '$2y$10$WCuwQF.JFT8q5nDG4rLIE.l/AtFYINoTa7gQ5Qq0ThniLMpiCnrbC', 1, 0),
(7, 'Lollo', 'boh@alaal.com', '$2y$10$d/E5CvjfXB20YzZhFm0zIeqsB8gHZgwJ/r7X17fyiqVo79Hq51up.', 1, 0),
(8, 'provini', 'prova@provini.it', '$2y$10$tOjZhA8hACnFkz2MX2w0OOx0CDMRkLLqh7Bek387b97tUTk7NBo06', 0, NULL),
(9, 'drake', 'drake@drake.com', '$2y$10$nQfbweQ4MWwmSgUZ/hAJzutFUpWokyL/WMlqLmAOtJaXvrUKHs5LS', 1, 1),
(10, 'Cocco', 'cocchiddu@mi.cio', '$2y$10$5HZTo0lsP.BorVArloJpCuzxwFBbRTJoKHZ/ayHL2qh0mOWeBAUaq', 0, NULL);

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
(1, 9),
(1, 10);

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
(14, 9);

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
(5, 10, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

CREATE TABLE `commenti` (
  `IdCommento` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `TestoCommento` varchar(200) NOT NULL,
  `DataCommento` datetime NOT NULL DEFAULT current_timestamp(),
  `IdPost` int(11) DEFAULT NULL,
  `IdVideo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `commenti`
--

INSERT INTO `commenti` (`IdCommento`, `IdAccount`, `TestoCommento`, `DataCommento`, `IdPost`, `IdVideo`) VALUES
(1, 9, 'I gatti conquisteranno il mondo', '2022-06-14 18:07:09', NULL, 6),
(2, 9, 'Questa ssssong sssspacca', '2022-06-14 18:18:21', NULL, 4),
(3, 10, 'w i gatti, anche se a me piace solo dormire e mangiare', '2022-06-14 18:30:37', NULL, 6);

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
(3, 3),
(3, 4),
(3, 7),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 7),
(4, 8),
(5, 1),
(5, 7),
(5, 8),
(6, 7),
(6, 8),
(6, 9),
(6, 10),
(9, 7);

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
(1, 'Pesci');

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizioni`
--

CREATE TABLE `iscrizioni` (
  `IdCanale` int(11) NOT NULL,
  `IdIscritto` int(11) NOT NULL,
  `DataIscrizione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `iscrizioni`
--

INSERT INTO `iscrizioni` (`IdCanale`, `IdIscritto`, `DataIscrizione`) VALUES
(6, 9, '2022-06-13 21:47:27'),
(9, 6, '2022-06-13 19:18:15'),
(9, 10, '2022-06-14 18:30:02');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `IdMessaggio` int(11) NOT NULL,
  `TestoMessaggio` varchar(200) NOT NULL,
  `DataInvio` datetime NOT NULL DEFAULT current_timestamp(),
  `IdChat` int(11) DEFAULT NULL,
  `IdGruppo` int(11) DEFAULT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `messaggi`
--

INSERT INTO `messaggi` (`IdMessaggio`, `TestoMessaggio`, `DataInvio`, `IdChat`, `IdGruppo`, `IdAccount`) VALUES
(1, 'Ciao Molly', '2022-06-09 00:00:00', 2, NULL, 9),
(2, 'prova', '2022-06-14 12:44:05', 2, NULL, 9),
(3, 'messaggio', '2022-06-14 13:09:54', 2, NULL, 9),
(4, 'heihei', '2022-06-14 13:51:04', 2, NULL, 9),
(5, 'cosa succede se scrivo un messaggio moooooooooooooooolto lungo?', '2022-06-14 13:51:24', 2, NULL, 9),
(6, 'e se scrivo un messaggio ancora più lungo, tipo davvero tanto che magari non ci sta tutto in una riga e tocca spezzarlo', '2022-06-14 14:06:42', 2, NULL, 9),
(7, 'questo messaggio è in un gruppo', '2022-06-14 16:10:58', NULL, 1, 9),
(8, 'Ciao umano', '2022-06-14 16:21:22', 3, NULL, 10),
(9, 'Ciao cocchiddu', '2022-06-14 16:21:52', 3, NULL, 9),
(10, 'Dammi del cibo', '2022-06-14 16:22:20', 3, NULL, 10),
(11, ':/', '2022-06-14 16:23:06', 3, NULL, 9),
(12, 'Ehi anche io sono nel gruppo!', '2022-06-14 16:24:34', NULL, 1, 10),
(13, 'Ciauuuu', '2022-06-14 16:25:41', NULL, 1, 9),
(14, 'Comunque forse potremmo pensare di aumentare le dimensioni massime di un messaggio, mi sembra avessimo messo 200 caratteri ma non sono poi così tanti, soprattutto se scrivi un messaggio così', '2022-06-14 16:27:43', NULL, 1, 9);

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
(4, 0, NULL, 2, 7),
(5, 0, NULL, 1, 8),
(6, 0, NULL, 2, 8),
(7, 0, NULL, 1, 9),
(8, 0, NULL, 2, 9),
(9, 0, NULL, 1, 10),
(10, 0, NULL, 2, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `post_scritti`
--

CREATE TABLE `post_scritti` (
  `IdPost` int(11) NOT NULL,
  `Titolo` varchar(40) NOT NULL,
  `DataPubblicazione` datetime NOT NULL DEFAULT current_timestamp(),
  `TestoPost` varchar(400) NOT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `post_scritti`
--

INSERT INTO `post_scritti` (`IdPost`, `Titolo`, `DataPubblicazione`, `TestoPost`, `IdAccount`) VALUES
(2, 'Prova1', '2022-06-09 12:08:31', 'Dovrebbe andare tutto direi.', 6),
(3, 'Questo va!', '2022-06-09 12:09:44', 'Ne sono sicuro', 6),
(4, 'Prova1', '2022-06-09 12:32:10', 'ciao', 6),
(5, 'Tutto bello', '2022-06-11 11:43:56', 'Il sito vaaaaaa', 6),
(6, 'ewfa', '2022-06-11 11:54:31', 'dfkjndskjdsnkdsk kasc.', 6),
(7, 'Non sono Molly', '2022-06-13 10:38:41', 'siam', 7),
(8, 'Sofferenza', '2022-06-14 18:27:37', 'Non ho voglia di fare la creazione dei gruppi\r\nCiaooooooo <3', 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `video`
--

CREATE TABLE `video` (
  `IdVideo` int(11) NOT NULL,
  `Titolo` varchar(100) NOT NULL,
  `SorgenteVideo` varchar(300) NOT NULL,
  `DataPubblicazione` datetime NOT NULL DEFAULT current_timestamp(),
  `NumeroLike` int(11) NOT NULL DEFAULT 0,
  `NumeroVisualizzazioni` int(11) NOT NULL DEFAULT 0,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `video`
--

INSERT INTO `video` (`IdVideo`, `Titolo`, `SorgenteVideo`, `DataPubblicazione`, `NumeroLike`, `NumeroVisualizzazioni`, `IdAccount`) VALUES
(3, 'Believer - Imagine Dragons', '7wtfhZwyrcc', '2022-06-09 18:50:43', 1, 3, 6),
(4, 'Sweet but psycho - Ava Max', 'WXBHCQYxwr0', '2022-06-11 10:48:27', 3, 3, 6),
(5, ' Forget me too - Machine Gun Kelly ft. Halsey', '0tn6nWYNK3Q', '2022-06-13 10:35:37', 1, 2, 6),
(6, 'Miao', 'z3U0udLH974', '2022-06-13 15:26:37', 2, 2, 9),
(8, 'Ferrari SF-90', 'lJcNhqdFo9M', '2022-06-14 16:24:30', 0, 1, 6),
(9, 'Dentro la sede di Apple', 'UoYPP4fjN2c', '2022-06-14 17:07:45', 0, 2, 6);

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
(6, 3, 71),
(6, 4, 130),
(6, 5, 0),
(7, 3, 80),
(7, 4, 0),
(9, 3, 6),
(9, 4, 44),
(9, 5, 3),
(9, 6, 10),
(9, 9, 2),
(10, 6, 40);

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
  MODIFY `IdAccount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `chats`
--
ALTER TABLE `chats`
  MODIFY `IdChat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `commenti`
--
ALTER TABLE `commenti`
  MODIFY `IdCommento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `etichette`
--
ALTER TABLE `etichette`
  MODIFY `IdEtichetta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `gruppi`
--
ALTER TABLE `gruppi`
  MODIFY `IdGruppo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `IdMessaggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `playlists`
--
ALTER TABLE `playlists`
  MODIFY `IdPlaylist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `post_scritti`
--
ALTER TABLE `post_scritti`
  MODIFY `IdPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `video`
--
ALTER TABLE `video`
  MODIFY `IdVideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
