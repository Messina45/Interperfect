-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 05, 2024 alle 18:33
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interperfect`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `dettagli_ordine`
--

CREATE TABLE `dettagli_ordine` (
  `Num_Ordine` int(11) NOT NULL,
  `Cod_Prodotto` int(11) NOT NULL,
  `Quantità` int(11) DEFAULT NULL,
  `PrezzoProdotti` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendente`
--

CREATE TABLE `dipendente` (
  `ID_Dipendente` int(11) NOT NULL,
  `ID_Utente` int(11) DEFAULT NULL,
  `Ruolo` enum('CEO','Responsabile','Dipendente') DEFAULT NULL,
  `Permessi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dump dei dati per la tabella `dipendente`
--

INSERT INTO `dipendente` (`ID_Dipendente`, `ID_Utente`, `Ruolo`, `Permessi`) VALUES
(1, 1, 'CEO', 'Gestire Tabelle\r\nModifica Sito\r\nModifica Linee Prod'),
(2, 2, 'Responsabile', 'Linee Prod.'),
(3, 4, 'Dipendente', 'Lavoratore'),
(4, 3, 'Dipendente', 'Lavoratore');

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendente_linea`
--

CREATE TABLE `dipendente_linea` (
  `Linea_Prod` varchar(10) NOT NULL,
  `ID_Dipendente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dump dei dati per la tabella `dipendente_linea`
--

INSERT INTO `dipendente_linea` (`Linea_Prod`, `ID_Dipendente`) VALUES
('L1', 3),
('L2', 4),
('L3', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `linea_produzione`
--

CREATE TABLE `linea_produzione` (
  `Linea_Prod` varchar(10) NOT NULL,
  `Descrizione` varchar(255) DEFAULT NULL,
  `Cod_Prodotto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dump dei dati per la tabella `linea_produzione`
--

INSERT INTO `linea_produzione` (`Linea_Prod`, `Descrizione`, `Cod_Prodotto`) VALUES
('L1', 'Acquisto', 2),
('L2', 'Assemblaggio/Produzione', 1),
('L3', 'Imballaggio/Spedizione', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `Num_Ordine` int(11) NOT NULL,
  `Data_Ordine` date DEFAULT NULL,
  `Data_Spedizione` date DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  `ID_Utente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `pagamenti`
--

CREATE TABLE `pagamenti` (
  `Checknumber` int(11) NOT NULL,
  `Data_Pagamento` datetime NOT NULL,
  `Totale` int(11) NOT NULL,
  `ID_Utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `Cod_Prodotto` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Prezzo` decimal(10,2) DEFAULT NULL,
  `Descrizione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`Cod_Prodotto`, `Nome`, `Prezzo`, `Descrizione`) VALUES
(1, 'Woody', 999.99, 'Felpa, bellissima, spettacolare.'),
(2, 'Braghe', 499.99, 'Semplici Pantaloni, bellissimi, \"pazzurdi\"'),
(3, 'Magliets', 299.99, 'Magliettina, semplice, facile, veloce, \"spettacolo\"');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID_Utente` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `PW` varchar(25) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Cognome` varchar(20) NOT NULL,
  `Citta` varchar(50) NOT NULL,
  `Via` varchar(50) NOT NULL,
  `Cod_Postale` int(11) NOT NULL,
  `Telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID_Utente`, `Username`, `PW`, `Nome`, `Cognome`, `Citta`, `Via`, `Cod_Postale`, `Telefono`) VALUES
(1, 'Diego', '12345', 'Diego', 'Pra', 'Monteforte D\'Alpone', 'Località Peraro', 37032, '3503456788'),
(2, 'Gigio', '12345', 'Davide', 'Dalla Libera', 'Sossano', 'Sossania', 45095, '8357928374'),
(3, 'Pippo', '12345', 'Pippo', 'Pippino', 'Pippolandia', 'Pippania', 99999, '1234567890'),
(4, 'Fragola86', '12345', 'Fragola', '86', 'Web', 'Weblandia', 11111, '1111111111');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `dettagli_ordine`
--
ALTER TABLE `dettagli_ordine`
  ADD PRIMARY KEY (`Num_Ordine`,`Cod_Prodotto`),
  ADD KEY `Cod_Prodotto` (`Cod_Prodotto`);

--
-- Indici per le tabelle `dipendente`
--
ALTER TABLE `dipendente`
  ADD PRIMARY KEY (`ID_Dipendente`),
  ADD KEY `ID_Utente` (`ID_Utente`);

--
-- Indici per le tabelle `dipendente_linea`
--
ALTER TABLE `dipendente_linea`
  ADD PRIMARY KEY (`Linea_Prod`,`ID_Dipendente`),
  ADD KEY `ID_Dipendente` (`ID_Dipendente`);

--
-- Indici per le tabelle `linea_produzione`
--
ALTER TABLE `linea_produzione`
  ADD PRIMARY KEY (`Linea_Prod`),
  ADD KEY `Cod_Prodotto` (`Cod_Prodotto`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`Num_Ordine`),
  ADD KEY `ID_Utente` (`ID_Utente`);

--
-- Indici per le tabelle `pagamenti`
--
ALTER TABLE `pagamenti`
  ADD PRIMARY KEY (`Checknumber`),
  ADD KEY `ID_Utente` (`ID_Utente`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`Cod_Prodotto`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID_Utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `dipendente`
--
ALTER TABLE `dipendente`
  MODIFY `ID_Dipendente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `Num_Ordine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `pagamenti`
--
ALTER TABLE `pagamenti`
  MODIFY `Checknumber` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `Cod_Prodotto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID_Utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `dettagli_ordine`
--
ALTER TABLE `dettagli_ordine`
  ADD CONSTRAINT `dettagli_ordine_ibfk_1` FOREIGN KEY (`Num_Ordine`) REFERENCES `ordine` (`Num_Ordine`),
  ADD CONSTRAINT `dettagli_ordine_ibfk_2` FOREIGN KEY (`Cod_Prodotto`) REFERENCES `prodotto` (`Cod_Prodotto`);

--
-- Limiti per la tabella `dipendente`
--
ALTER TABLE `dipendente`
  ADD CONSTRAINT `dipendente_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID_Utente`);

--
-- Limiti per la tabella `dipendente_linea`
--
ALTER TABLE `dipendente_linea`
  ADD CONSTRAINT `dipendente_linea_ibfk_1` FOREIGN KEY (`Linea_Prod`) REFERENCES `linea_produzione` (`Linea_Prod`),
  ADD CONSTRAINT `dipendente_linea_ibfk_2` FOREIGN KEY (`ID_Dipendente`) REFERENCES `dipendente` (`ID_Dipendente`);

--
-- Limiti per la tabella `linea_produzione`
--
ALTER TABLE `linea_produzione`
  ADD CONSTRAINT `linea_produzione_ibfk_1` FOREIGN KEY (`Cod_Prodotto`) REFERENCES `prodotto` (`Cod_Prodotto`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID_Utente`);

--
-- Limiti per la tabella `pagamenti`
--
ALTER TABLE `pagamenti`
  ADD CONSTRAINT `pagamenti_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID_Utente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
