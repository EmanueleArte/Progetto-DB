-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Giu 13, 2022 alle 10:13
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
-- Struttura della tabella `Accounts`
--

CREATE TABLE `Accounts` (
  `IdAccount` int(11) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Mail` varchar(40) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Canale` tinyint(1) NOT NULL,
  `NumeroIscritti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Accounts`
--

INSERT INTO `Accounts` (`IdAccount`, `Username`, `Mail`, `Password`, `Canale`, `NumeroIscritti`) VALUES
(6, 'Molly', 'micia@sium.it', '$2y$10$WCuwQF.JFT8q5nDG4rLIE.l/AtFYINoTa7gQ5Qq0ThniLMpiCnrbC', 1, 0),
(7, 'Lollo', 'boh@alaal.com', '$2y$10$d/E5CvjfXB20YzZhFm0zIeqsB8gHZgwJ/r7X17fyiqVo79Hq51up.', 1, 0),
(8, 'provini', 'prova@provini.it', '$2y$10$tOjZhA8hACnFkz2MX2w0OOx0CDMRkLLqh7Bek387b97tUTk7NBo06', 0, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `Appartenenze_gruppi`
--

CREATE TABLE `Appartenenze_gruppi` (
  `IdGruppo` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Categorizzazioni_Video`
--

CREATE TABLE `Categorizzazioni_Video` (
  `IdEtichetta` int(11) NOT NULL,
  `IdVideo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Chats`
--

CREATE TABLE `Chats` (
  `IdChat` int(11) NOT NULL,
  `IdAccount1` int(11) NOT NULL,
  `IdAccount2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Commenti`
--

CREATE TABLE `Commenti` (
  `IdCommento` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `TestoCommento` varchar(200) NOT NULL,
  `DataCommento` date NOT NULL,
  `IdPost` int(11) DEFAULT NULL,
  `IdVideo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Composizioni_Playlists`
--

CREATE TABLE `Composizioni_Playlists` (
  `IdVideo` int(11) NOT NULL,
  `IdPlaylist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Composizioni_Playlists`
--

INSERT INTO `Composizioni_Playlists` (`IdVideo`, `IdPlaylist`) VALUES
(3, 1),
(4, 1),
(5, 1),
(4, 2),
(3, 3),
(4, 3),
(3, 4),
(4, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `Etichette`
--

CREATE TABLE `Etichette` (
  `IdEtichetta` int(11) NOT NULL,
  `NomeEtichetta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Gruppi`
--

CREATE TABLE `Gruppi` (
  `IdGruppo` int(11) NOT NULL,
  `NomeGruppo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Iscrizioni`
--

CREATE TABLE `Iscrizioni` (
  `IdCanale` int(11) NOT NULL,
  `IdIscritto` int(11) NOT NULL,
  `DataIscrizione` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Messaggi`
--

CREATE TABLE `Messaggi` (
  `IdMessaggio` int(11) NOT NULL,
  `TestoMessaggio` varchar(200) NOT NULL,
  `DataInvio` date NOT NULL,
  `IdChat` int(11) DEFAULT NULL,
  `IdGruppo` int(11) DEFAULT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Playlists`
--

CREATE TABLE `Playlists` (
  `IdPlaylist` int(11) NOT NULL,
  `Pubblica` tinyint(1) NOT NULL,
  `NomePlaylist` varchar(40) DEFAULT NULL,
  `TipoPlaylist` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Playlists`
--

INSERT INTO `Playlists` (`IdPlaylist`, `Pubblica`, `NomePlaylist`, `TipoPlaylist`, `IdAccount`) VALUES
(1, 0, NULL, 1, 6),
(2, 0, NULL, 2, 6),
(3, 0, NULL, 1, 7),
(4, 0, NULL, 2, 7),
(5, 0, NULL, 1, 8),
(6, 0, NULL, 2, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `Post_Scritti`
--

CREATE TABLE `Post_Scritti` (
  `IdPost` int(11) NOT NULL,
  `Titolo` varchar(40) NOT NULL,
  `DataPubblicazione` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TestoPost` varchar(400) NOT NULL,
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Post_Scritti`
--

INSERT INTO `Post_Scritti` (`IdPost`, `Titolo`, `DataPubblicazione`, `TestoPost`, `IdAccount`) VALUES
(2, 'Prova1', '2022-06-09 12:08:31', 'Dovrebbe andare tutto direi.', 6),
(3, 'Questo va!', '2022-06-09 12:09:44', 'Ne sono sicuro', 6),
(4, 'Prova1', '2022-06-09 12:32:10', 'ciao', 6),
(5, 'Tutto bello', '2022-06-11 11:43:56', 'Il sito vaaaaaa', 6),
(6, 'ewfa', '2022-06-11 11:54:31', 'dfkjndskjdsnkdsk kasc.', 6),
(7, 'Non sono Molly', '2022-06-13 10:38:41', 'siam', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `Video`
--

CREATE TABLE `Video` (
  `IdVideo` int(11) NOT NULL,
  `Titolo` varchar(100) NOT NULL,
  `SorgenteVideo` varchar(300) NOT NULL,
  `DataPubblicazione` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NumeroLike` int(11) NOT NULL DEFAULT '0',
  `NumeroVisualizzazioni` int(11) NOT NULL DEFAULT '0',
  `IdAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Video`
--

INSERT INTO `Video` (`IdVideo`, `Titolo`, `SorgenteVideo`, `DataPubblicazione`, `NumeroLike`, `NumeroVisualizzazioni`, `IdAccount`) VALUES
(3, 'Believer - Imagine Dragons', '7wtfhZwyrcc', '2022-06-09 18:50:43', 1, 2, 6),
(4, 'Sweet but psycho - Ava Max', 'WXBHCQYxwr0', '2022-06-11 10:48:27', 2, 2, 6),
(5, ' Forget me too - Machine Gun Kelly ft. Halsey', '0tn6nWYNK3Q', '2022-06-13 10:35:37', 0, 1, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `Visualizzazioni`
--

CREATE TABLE `Visualizzazioni` (
  `IdAccount` int(11) NOT NULL,
  `IdVideo` int(11) NOT NULL,
  `TempoVisualizzazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Visualizzazioni`
--

INSERT INTO `Visualizzazioni` (`IdAccount`, `IdVideo`, `TempoVisualizzazione`) VALUES
(6, 3, 71),
(6, 4, 130),
(6, 5, 0),
(7, 3, 80),
(7, 4, 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Accounts`
--
ALTER TABLE `Accounts`
  ADD PRIMARY KEY (`IdAccount`);

--
-- Indici per le tabelle `Appartenenze_gruppi`
--
ALTER TABLE `Appartenenze_gruppi`
  ADD PRIMARY KEY (`IdGruppo`,`IdAccount`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indici per le tabelle `Categorizzazioni_Video`
--
ALTER TABLE `Categorizzazioni_Video`
  ADD PRIMARY KEY (`IdEtichetta`,`IdVideo`),
  ADD KEY `IdVideo` (`IdVideo`);

--
-- Indici per le tabelle `Chats`
--
ALTER TABLE `Chats`
  ADD PRIMARY KEY (`IdChat`),
  ADD KEY `IdAccount1` (`IdAccount1`),
  ADD KEY `IdAccount2` (`IdAccount2`);

--
-- Indici per le tabelle `Commenti`
--
ALTER TABLE `Commenti`
  ADD PRIMARY KEY (`IdCommento`),
  ADD KEY `IdPost` (`IdPost`),
  ADD KEY `IdVideoC` (`IdVideo`),
  ADD KEY `IdAccountC` (`IdAccount`);

--
-- Indici per le tabelle `Composizioni_Playlists`
--
ALTER TABLE `Composizioni_Playlists`
  ADD PRIMARY KEY (`IdVideo`,`IdPlaylist`),
  ADD KEY `IdPlaylist` (`IdPlaylist`);

--
-- Indici per le tabelle `Etichette`
--
ALTER TABLE `Etichette`
  ADD PRIMARY KEY (`IdEtichetta`);

--
-- Indici per le tabelle `Gruppi`
--
ALTER TABLE `Gruppi`
  ADD PRIMARY KEY (`IdGruppo`);

--
-- Indici per le tabelle `Iscrizioni`
--
ALTER TABLE `Iscrizioni`
  ADD PRIMARY KEY (`IdCanale`,`IdIscritto`),
  ADD KEY `IdIscritto` (`IdIscritto`);

--
-- Indici per le tabelle `Messaggi`
--
ALTER TABLE `Messaggi`
  ADD PRIMARY KEY (`IdMessaggio`),
  ADD KEY `IdChat` (`IdChat`),
  ADD KEY `IdGruppo` (`IdGruppo`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indici per le tabelle `Playlists`
--
ALTER TABLE `Playlists`
  ADD PRIMARY KEY (`IdPlaylist`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indici per le tabelle `Post_Scritti`
--
ALTER TABLE `Post_Scritti`
  ADD PRIMARY KEY (`IdPost`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indici per le tabelle `Video`
--
ALTER TABLE `Video`
  ADD PRIMARY KEY (`IdVideo`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indici per le tabelle `Visualizzazioni`
--
ALTER TABLE `Visualizzazioni`
  ADD PRIMARY KEY (`IdAccount`,`IdVideo`),
  ADD KEY `IdVideo` (`IdVideo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Accounts`
--
ALTER TABLE `Accounts`
  MODIFY `IdAccount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `Chats`
--
ALTER TABLE `Chats`
  MODIFY `IdChat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Commenti`
--
ALTER TABLE `Commenti`
  MODIFY `IdCommento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Etichette`
--
ALTER TABLE `Etichette`
  MODIFY `IdEtichetta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Gruppi`
--
ALTER TABLE `Gruppi`
  MODIFY `IdGruppo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Messaggi`
--
ALTER TABLE `Messaggi`
  MODIFY `IdMessaggio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Playlists`
--
ALTER TABLE `Playlists`
  MODIFY `IdPlaylist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `Post_Scritti`
--
ALTER TABLE `Post_Scritti`
  MODIFY `IdPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `Video`
--
ALTER TABLE `Video`
  MODIFY `IdVideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Appartenenze_gruppi`
--
ALTER TABLE `Appartenenze_gruppi`
  ADD CONSTRAINT `IdAccount` FOREIGN KEY (`IdAccount`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdGruppo` FOREIGN KEY (`IdGruppo`) REFERENCES `Gruppi` (`IdGruppo`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Categorizzazioni_Video`
--
ALTER TABLE `Categorizzazioni_Video`
  ADD CONSTRAINT `IdEtichetta` FOREIGN KEY (`IdEtichetta`) REFERENCES `Etichette` (`IdEtichetta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdVideo` FOREIGN KEY (`IdVideo`) REFERENCES `Video` (`IdVideo`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Chats`
--
ALTER TABLE `Chats`
  ADD CONSTRAINT `IdAccount1` FOREIGN KEY (`IdAccount1`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdAccount2` FOREIGN KEY (`IdAccount2`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Commenti`
--
ALTER TABLE `Commenti`
  ADD CONSTRAINT `IdAccountC` FOREIGN KEY (`IdAccount`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdPost` FOREIGN KEY (`IdPost`) REFERENCES `post_scritti` (`IdPost`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdVideoC` FOREIGN KEY (`IdVideo`) REFERENCES `Video` (`IdVideo`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Composizioni_Playlists`
--
ALTER TABLE `Composizioni_Playlists`
  ADD CONSTRAINT `IdPlaylist` FOREIGN KEY (`IdPlaylist`) REFERENCES `Playlists` (`IdPlaylist`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdVideoP` FOREIGN KEY (`IdVideo`) REFERENCES `Video` (`IdVideo`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Iscrizioni`
--
ALTER TABLE `Iscrizioni`
  ADD CONSTRAINT `IdCanale` FOREIGN KEY (`IdCanale`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdIscritto` FOREIGN KEY (`IdIscritto`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Messaggi`
--
ALTER TABLE `Messaggi`
  ADD CONSTRAINT `IdAccountM` FOREIGN KEY (`IdAccount`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdChatM` FOREIGN KEY (`IdChat`) REFERENCES `Chats` (`IdChat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdGruppoM` FOREIGN KEY (`IdGruppo`) REFERENCES `Gruppi` (`IdGruppo`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Playlists`
--
ALTER TABLE `Playlists`
  ADD CONSTRAINT `IdAccountP` FOREIGN KEY (`IdAccount`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Post_Scritti`
--
ALTER TABLE `Post_Scritti`
  ADD CONSTRAINT `IdAccountS` FOREIGN KEY (`IdAccount`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Video`
--
ALTER TABLE `Video`
  ADD CONSTRAINT `IdAccountV` FOREIGN KEY (`IdAccount`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Visualizzazioni`
--
ALTER TABLE `Visualizzazioni`
  ADD CONSTRAINT `IdAccountVis` FOREIGN KEY (`IdAccount`) REFERENCES `Accounts` (`IdAccount`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IdVideoVis` FOREIGN KEY (`IdVideo`) REFERENCES `Video` (`IdVideo`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
