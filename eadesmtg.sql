-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2017 at 02:08 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eadesmtg`
--

-- --------------------------------------------------------

--
-- Table structure for table `cardeditions`
--

CREATE TABLE `cardeditions` (
  `cardEdID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `cardEdition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cardeditions`
--

INSERT INTO `cardeditions` (`cardEdID`, `productID`, `cardEdition`) VALUES
(3, 4, 'Shadows over Innistrad'),
(4, 5, 'Shadows over Innistrad'),
(5, 6, 'Shadows over Innistrad'),
(6, 7, 'Shadows over Innistrad'),
(7, 8, 'Shadows over Innistrad'),
(8, 9, 'Shadows over Innistrad'),
(9, 10, 'Shadows over Innistrad'),
(10, 11, 'Shadows over Innistrad');

-- --------------------------------------------------------

--
-- Table structure for table `cardtypes`
--

CREATE TABLE `cardtypes` (
  `cardTypeID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `cardType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cardtypes`
--

INSERT INTO `cardtypes` (`cardTypeID`, `productID`, `cardType`) VALUES
(2, 4, 'Enchantment'),
(3, 5, 'Enchantment'),
(4, 6, 'Enchantment'),
(5, 7, 'Enchantment'),
(6, 8, 'Enchantment'),
(7, 9, 'Enchantment'),
(8, 10, 'Enchantment'),
(9, 11, 'Enchantment');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `playerID` int(11) NOT NULL,
  `playerName` varchar(255) NOT NULL,
  `playerLife` int(11) NOT NULL,
  `sessionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playerID`, `playerName`, `playerLife`, `sessionID`) VALUES
(2, 'player', 20, 1),
(3, 'player', 20, 1),
(4, 'player1', 20, 30),
(5, 'player2', 20, 30),
(6, 'player1', 20, 31),
(7, 'player1', 20, 32),
(8, 'player2', 20, 32),
(9, 'player3', 20, 32),
(10, 'player1', 20, 33),
(11, 'player2', 20, 33),
(12, 'player3', 20, 33),
(13, 'player4', 20, 33),
(14, 'player1', 20, 34),
(15, 'Jarrod', 2058, 35),
(17, 'player1', 20, 36),
(18, 'player2', 20, 36),
(19, 'player1', 20, 37),
(20, 'player2', 20, 37),
(21, 'player3', 20, 37),
(22, 'player4', 20, 37),
(23, 'player5', 20, 37),
(24, 'player6', 20, 37),
(25, 'player7', 20, 37),
(26, 'player8', 20, 37),
(27, 'HELLO', 50037, 38),
(28, 'player2', 20, 38),
(29, 'player3', 20, 38),
(31, 'player5', 20, 38),
(32, 'player6', 20, 38),
(33, 'player7', 20, 38),
(34, 'player8', 20, 38);

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE `productimages` (
  `imageID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDescription` varchar(255) NOT NULL,
  `productPrice` decimal(11,2) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `typeID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `productDescription`, `productPrice`, `productQuantity`, `typeID`) VALUES
(4, 'Gorgons Watching', 'Nontoken creatures you control get +1/+1 and have deathtouch.', '5.00', 5, 2),
(5, 'Always Watching', 'Nontoken creatures you control get +1/+1 and have vigilance.', '55.00', 5, 2),
(6, 'Always Watching', 'Nontoken creatures you control get +1/+1 and have vigilance.', '1.00', 12, 2),
(7, 'Always Watching', 'Nontoken creatures you control get +1/+1 and have vigilance.', '44.00', 4, 2),
(8, 'Always Watching', 'Nontoken creatures you control get +1/+1 and have vigilance.', '5.00', 12, 2),
(9, 'Always Watching', 'Nontoken creatures you control get +1/+1 and have vigilance.', '3.00', 3, 2),
(10, 'Always Watching', 'Nontoken creatures you control get +1/+1 and have vigilance.', '1.00', 1, 2),
(11, 'Always Watching', 'Nontoken creatures you control get +1/+1 and have vigilance.', '1.00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `producttypes`
--

CREATE TABLE `producttypes` (
  `typeID` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producttypes`
--

INSERT INTO `producttypes` (`typeID`, `type`) VALUES
(1, 'Binder'),
(2, 'Card'),
(3, 'Deckbox'),
(4, 'Dice'),
(5, 'Life Counter'),
(6, 'Playmat'),
(7, 'Sleeves');

-- --------------------------------------------------------

--
-- Table structure for table `receiptproducts`
--

CREATE TABLE `receiptproducts` (
  `receiptProductsID` int(11) NOT NULL,
  `receiptID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` decimal(11,2) NOT NULL,
  `productQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `receiptID` int(11) NOT NULL,
  `purchasedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `sessionID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`sessionID`, `email`, `password`, `salt`) VALUES
(1, 'jarrod.eades@hotmail.com', 'hello', '5d41402abc4b2a76b9719d911017c592'),
(2, 'jarrod.eades@hotmail.com', 'pass', '$2y$10$Qdalp1OgTA3tToda9aFqZ.HHZ0y4JOPrVmybAZyUx7/LQZ/NcXWQW'),
(3, 'jarrod.eades@hotmail.com', 'pass', '$2y$10$bmqmHzpRn7m1wnS0PtMTmOD.FL8c5U6HiBwdz/kcxbv4YSp0P5epu'),
(4, 'jarrod.eades@hotmail.com', '12', '$2y$10$er8jUgqR2d8X/NcupTkknuxnU8Lzgo7WPY2IXrLdI7m6sbRo39N6W'),
(5, 'jarrod.eades@hotmail.com', '2', '$2y$10$mt0lzrnXWMFhQp1ruJFoJuoF9b2AfoUSlEbU76.avsMidsNuC07xC'),
(6, 'jarrod.eades@hotmail.com', '12', '$2y$10$kqs7ZpemYg5eU2/bMvBCDO.XtvqNY0ckuVCYMJ8hzT6ZfcO/wLIyy'),
(7, 'jarrod.eades@hotmail.com', '12', '$2y$10$l/vO5popIZlpevjMnSjizu9QCDGcUFIOqOomZODug5CNqdnd6Ab/u'),
(8, 'jarrod.eades@hotmail.com', '12', '$2y$10$NrFaXDHQ7pRDuPt4f./Goeh74vrWZhAoDB181ciNbpiHIouK3E.0a'),
(9, 'jarrod.eades@hotmail.com', '12', '$2y$10$MBVvpF/aSTLwsHwxkhttbObbc3RmADIDr0LiUBR.HrcApv2k3GIO.'),
(10, 'jarrod.eades@hotmail.com', '1', '$2y$10$G9sRD1xvsqUWq5BHK8wtf.hF57SLMn2sc7O7zXXZ3hPmgsQTRtytO'),
(11, 'jarrod.eades@hotmail.com', '12', '$2y$10$eUTl5E2uYFIF26MUN7jE5.L28gNrtqZMQ/v4LSW1jvuneEeiAwm6W'),
(12, 'jarrod.eades@hotmail.com', '2', '$2y$10$5WdhntViB7WGmieusm/sxudA8CKYPodZxIR4Mk1KIbh2rC5aBs98W'),
(13, 'jarrod.eades@hotmail.com', '12', '$2y$10$3FGJ8pJOMrmD/zDGQGx9oey6w.LMiwOF7ke6NX2hjkxCVeKllGMF2'),
(14, 'jarrod.eades@hotmail.com', '12', '$2y$10$ZQYPwtl1P4HpWkZur/z5lujYh/Bq/9EgmL3bVWtgx5ZBaB1oh2DTG'),
(15, 'jarrod.eades@hotmail.com', '2', '$2y$10$jksMocOo5vMYpPV3HBtJhu0340psl82Ndh18Ctmcjc.yc6coemJ0W'),
(16, 'jarrod.eades@hotmail.com', '12', '$2y$10$1Q44ueS9EMYB6tBkpjA7A.4OKj9OfGDDa.kovgaYnSsDJRtEUekZS'),
(17, 'jarrod.eades@hotmail.com', '12', '$2y$10$stXPTpTtPaE3EpqDzwycpu62RjF.va62xV8ZCVaKX0myd1Xw82m0K'),
(18, 'jarrod.eades@hotmail.com', '12', '$2y$10$NiON2IwCRtCTaXR3mHtOF.ldKMwtUEdja435LD4fpxO0bKEg0fPTy'),
(19, 'jarrod.eades@hotmail.com', '12', '$2y$10$UV/1ajG5gvEkOUjzsBCjlOD8.pqsLSprv9/DHebICCsOmzyCqiWYm'),
(20, 'jarrod.eades@hotmail.com', '12', '$2y$10$HvfFTLdV7p1zgdPh4HFvkO38VmbjVmeOVeoZlFBnfyu1ElnUgHII6'),
(21, 'jarrod.eades@hotmail.com', '12', '$2y$10$LB4AKBMY5FR9g/fMuQjQ8eoCSB9zrMBtXq3otAxxb5ehjIFwnriru'),
(22, 'jarrod.eades@hotmail.com', '1', '$2y$10$eMYGCH3rAP4O49eH6qx46.aOL5RQGQza.wgIi6PNrdOrdfj/q9SIG'),
(23, 'jarrod.eades@hotmail.com', '1', '$2y$10$0Ur1x3dPHy.UYz5cqurVSuECx3CmtQM4djdGx0ZF3RB9FTDsDC7RW'),
(24, 'jarrod.eades@hotmail.com', '1', '$2y$10$9Hj0ijSNYkCdR5jntBYT6ezUxYDOVNolvfIU8NU5N4jp3TkQy6OvS'),
(25, 'jarrod.eades@hotmail.com', '1', '$2y$10$Bj7fPKjaOzcx5jG/n4/.zuLdcspXBNNbDHYoLu.YKCBva7k.N2z56'),
(26, 'jarrod.eades@hotmail.com', '1', '$2y$10$UfTQ/2AlB4Gw4a0Fu5Z0nOJdQseB44ppx1LqvUMyydLXxRkQ7/bHq'),
(27, 'jarrod.eades@hotmail.com', '1', '$2y$10$80lN5tHsqfJ0iK8i07QIRuEh7GqvFXv7/kwskB27zLvzmWNFcbF2K'),
(28, 'jarrod.eades@hotmail.com', '12', '$2y$10$o4ChRUwJudGdS3SxWBCA1uO0fj026J3S8bFUas91VEspsn.Za8o1.'),
(29, 'jarrod.eades@hotmail.com', '1', '$2y$10$DRfAgOU/0wDMZbu5SIPNGOscVS3gn/ayFfHEpzml6ZGa.pliLsryu'),
(30, 'jarrod.eades@hotmail.com', '2', '$2y$10$nhEetZtnE5krOmuhJ1cgXuOcbQS8gWNFg3ZUpB2dJe.J20dEuYl32'),
(31, 'jarrod.eades@hotmail.com', '1', '$2y$10$DLQFGY0HhfMTfUEaz1/rm.zlqu2fbRA3LJdhTJa..oZ8kQddk1hwW'),
(32, 'jarrod.eades@hotmail.com', '3', '$2y$10$MnNtcoOplLxQXSRzR5P3x.tkGZYpBy76SsWptFjxPdOURLYOqgxBq'),
(33, 'jarrod.eades@hotmail.com', '4', '$2y$10$IYXgM5/PBpCUmM1xDVIAYew/F0W0Ce1uMJnm5iB/rHselSXa/3Y4a'),
(34, 'jarrod.eades@hotmail.com', '1', '$2y$10$n7QcQq1kJOroOndVWE89VO3CCAQ4qTkLCfILQBL3RkgPs86.OE4N2'),
(35, 'jarrod.eades@hotmail.com', '2', '$2y$10$2Wmf.OXUc2od7weHw8PE8evr9tEFVwwj74.i0NSa9ho/8fhIlO7lO'),
(36, 'jarrod.eades@hotmail.com', '2', '$2y$10$bVqq6Ea1G/HaWko3lD9H/e60paDqwqvPHAQ8FYMbTIlRZZyOrHQMO'),
(37, 'jarrod.eades@hotmail.com', '12', '$2y$10$z3qgzRPxuXyl6KYWPkXcr.oa0YqIk7JvCjCXI.6e92b.nqc3WHeGC'),
(38, 'someeamil@email.com', '123', '$2y$10$funyJQFR1vlyz.BpthfTbOZbaXRcbew0DPtS6O/hrFt2l2Ets2rgu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardeditions`
--
ALTER TABLE `cardeditions`
  ADD PRIMARY KEY (`cardEdID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `cardtypes`
--
ALTER TABLE `cardtypes`
  ADD PRIMARY KEY (`cardTypeID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`playerID`),
  ADD KEY `sessionID` (`sessionID`);

--
-- Indexes for table `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `typeID` (`typeID`);

--
-- Indexes for table `producttypes`
--
ALTER TABLE `producttypes`
  ADD PRIMARY KEY (`typeID`);

--
-- Indexes for table `receiptproducts`
--
ALTER TABLE `receiptproducts`
  ADD PRIMARY KEY (`receiptProductsID`),
  ADD KEY `receiptID` (`receiptID`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`receiptID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sessionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cardeditions`
--
ALTER TABLE `cardeditions`
  MODIFY `cardEdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cardtypes`
--
ALTER TABLE `cardtypes`
  MODIFY `cardTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `playerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `productimages`
--
ALTER TABLE `productimages`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `producttypes`
--
ALTER TABLE `producttypes`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `receiptproducts`
--
ALTER TABLE `receiptproducts`
  MODIFY `receiptProductsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `receiptID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `sessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cardeditions`
--
ALTER TABLE `cardeditions`
  ADD CONSTRAINT `ProductIDonEdition` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cardtypes`
--
ALTER TABLE `cardtypes`
  ADD CONSTRAINT `ProductIDonTypes` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `SessionIdonPlayers` FOREIGN KEY (`sessionID`) REFERENCES `sessions` (`sessionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productimages`
--
ALTER TABLE `productimages`
  ADD CONSTRAINT `ProductIDonImage` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `typeIDForeignKey` FOREIGN KEY (`typeID`) REFERENCES `producttypes` (`typeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receiptproducts`
--
ALTER TABLE `receiptproducts`
  ADD CONSTRAINT `receiptIDonReceiptProd` FOREIGN KEY (`receiptID`) REFERENCES `receipts` (`receiptID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
