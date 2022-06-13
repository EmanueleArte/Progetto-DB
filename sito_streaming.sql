-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Giu 13, 2022 alle 17:19
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
(6, 'Molly', 'micia@sium.it', '$2y$10$WCuwQF.JFT8q5nDG4rLIE.l/AtFYINoTa7gQ5Qq0ThniLMpiCnrbC', 1, 0),
(7, 'Lollo', 'boh@alaal.com', '$2y$10$d/E5CvjfXB20YzZhFm0zIeqsB8gHZgwJ/r7X17fyiqVo79Hq51up.', 1, 0),
(8, 'provini', 'prova@provini.it', '$2y$10$tOjZhA8hACnFkz2MX2w0OOx0CDMRkLLqh7Bek387b97tUTk7NBo06', 0, NULL),
(9, 'drake', 'drake@drake.com', '$2y$10$nQfbweQ4MWwmSgUZ/hAJzutFUpWokyL/WMlqLmAOtJaXvrUKHs5LS', 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `appartenenze_gruppi`
--

CREATE TABLE `appartenenze_gruppi` (
  `IdGruppo` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `categorizzazioni_video`
--

CREATE TABLE `categorizzazioni_video` (
  `IdEtichetta` int(11) NOT NULL,
  `IdVideo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 6, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

CREATE TABLE `commenti` (
  `IdCommento` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `TestoCommento` varchar(200) NOT NULL,
  `DataCommento` date NOT NULL,
  `IdPost` int(11) DEFAULT NULL,
  `IdVideo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(4, 2),
(6, 2),
(3, 3),
(4, 3),
(3, 4),
(4, 4),
(4, 7),
(5, 7),
(6, 7),
(4, 8),
(5, 8),
(6, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `etichette`
--

CREATE TABLE `etichette` (
  `IdEtichetta` int(11) NOT NULL,
  `NomeEtichetta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppi`
--

CREATE TABLE `gruppi` (
  `IdGruppo` int(11) NOT NULL,
  `NomeGruppo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(9, 6, '2022-06-13 19:18:15');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `IdMessaggio` int(11) NOT NULL,
  `TestoMessaggio` varchar(200) NOT NULL,
  `DataInvio` date NOT NULL,
  `IdChat` int(11) DEFAULT NULL,
  `IdGruppo` int(11) DEFAULT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `messaggi`
--

INSERT INTO `messaggi` (`IdMessaggio`, `TestoMessaggio`, `DataInvio`, `IdChat`, `IdGruppo`, `IdAccount`) VALUES
(1, 'Ciao Molly', '2022-06-09', 2, NULL, 9);

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
(8, 0, NULL, 2, 9);

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
(2, 'Prova1', '2022-06-09 12:08:31', 'Dovrebbe andare tutto direi.', 6),
(3, 'Questo va!', '2022-06-09 12:09:44', 'Ne sono sicuro', 6),
(4, 'Prova1', '2022-06-09 12:32:10', 'ciao', 6),
(5, 'Tutto bello', '2022-06-11 11:43:56', 'Il sito vaaaaaa', 6),
(6, 'ewfa', '2022-06-11 11:54:31', 'dfkjndskjdsnkdsk kasc.', 6),
(7, 'Non sono Molly', '2022-06-13 10:38:41', 'siam', 7);

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
(3, 'Believer - Imagine Dragons', '7wtfhZwyrcc', '2022-06-09 18:50:43', 1, 2, 6),
(4, 'Sweet but psycho - Ava Max', 'WXBHCQYxwr0', '2022-06-11 10:48:27', 3, 3, 6),
(5, ' Forget me too - Machine Gun Kelly ft. Halsey', '0tn6nWYNK3Q', '2022-06-13 10:35:37', 1, 2, 6),
(6, 'Miao', 'z3U0udLH974', '2022-06-13 15:26:37', 2, 2, 9);

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
(6, 5, 58),
(6, 6, 33),
(7, 3, 80),
(7, 4, 0),
(9, 4, 18),
(9, 5, 0),
(9, 6, 18);

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
  MODIFY `IdAccount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `chats`
--
ALTER TABLE `chats`
  MODIFY `IdChat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `commenti`
--
ALTER TABLE `commenti`
  MODIFY `IdCommento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `etichette`
--
ALTER TABLE `etichette`
  MODIFY `IdEtichetta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `gruppi`
--
ALTER TABLE `gruppi`
  MODIFY `IdGruppo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `IdMessaggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `playlists`
--
ALTER TABLE `playlists`
  MODIFY `IdPlaylist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `post_scritti`
--
ALTER TABLE `post_scritti`
  MODIFY `IdPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `video`
--
ALTER TABLE `video`
  MODIFY `IdVideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Limiti per la tabella `iscrizioni`
--
ALTER TABLE `iscrizioni`
  ADD CONSTRAINT `IdCanale` FOREIGN KEY (`IdCanale`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdIscritto` FOREIGN KEY (`IdIscritto`) REFERENCES `accounts` (`IdAccount`) ON UPDATE CASCADE;

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