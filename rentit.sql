-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2025 at 03:09 PM
-- Server version: 10.11.10-MariaDB-cll-lve
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentit_rent`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountID` varchar(255) NOT NULL,
  `UName` varchar(255) DEFAULT NULL,
  `PWord` varchar(255) DEFAULT NULL,
  `AccType` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `Approval` varchar(255) DEFAULT NULL,
  `SQuestion` varchar(500) DEFAULT NULL,
  `Answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountID`, `UName`, `PWord`, `AccType`, `Status`, `Approval`, `SQuestion`, `Answer`) VALUES
('37lCi8yH', 'arhonjay', '$2y$10$LBiLN3SgicVyfiOU6jv3gu.8OxtaIS0pQ.2aYBWJi4SMIFfGJHT9u', 'Boarder', '1', 'Approved', NULL, NULL),
('37YksPi6', 'Jang-Fay', '$2y$10$SeP/OOHnG.5urq5ogajrIecufDc1Y.nb7DZzyXZKyP.Uib0XaeUw.', 'Boarder', '1', 'Approved', NULL, NULL),
('3vQAol6o', 'John Christopher', '$2y$10$vkp.J2Z7xwNj7ex.A.THAubBiZFNTiRn9O.lbzv4Z.9kP55l.Izbu', 'Boarder', '1', 'Approved', NULL, NULL),
('4PxCA5mQ', 'doryoblefias', '$2y$10$ukbCfjVIT5t7nE6fGo5ZKemzeIi8pMnG1PlUy5oDLbhC9zY9654.O', 'Owner', '1', 'Approved', NULL, NULL),
('67I1yqIe', 'arvie', '$2y$10$iE1v0ywV2A2wM6j2oVSM8uWM5tdB1wiP6q1/IfQmNzopCmAVmCTN.', 'Boarder', '0', 'Approved', NULL, NULL),
('69bAVQG0', 'Cristian', '$2y$10$Dzc/Hv3/TCXVCRTybBQJqOGiFIA7fuK4mlQAj7SAY4VEWmhnYa/am', 'Boarder', '1', 'Approved', 'What was your childhood nickname?', 'Ian'),
('69PKuJYM', 'CARLAMAE', '$2y$10$bKGNXyaYms7GAGvZ/CTTqeoIdkqiZRTqMVLJ.lHScJcwkQ8XyW2Aa', 'Boarder', '0', 'Approved', NULL, NULL),
('6D4SEyEE', 'Valentina', '$2y$10$d1uDHdb1mgToRsj83c3k7ucS0h4fLBkbh7kZWw4stzn8nBkK4iDF.', 'Owner', '1', 'Approved', NULL, NULL),
('6ZjowKgU', 'CKarlzz', '$2y$10$a/KrVDMxaMOqgMJCmC.FEeTF5ImIfkAIz5ZiqwusnE4xbe3V3DHdW', 'Boarder', '1', 'Approved', 'What is the name of your first pet?', 'Kobe'),
('7kYGxtz6', 'urrizaanne', '$2y$10$Jv0nSG/jXyM6nAWcqNiJoOYv0AMnRUnv4Bag/hoiTEuwxAqsWJ5qy', 'Boarder', '1', 'Approved', 'What is the name of your first pet?', 'paul'),
('8Zw6wTTV', 'kathleenrea', '$2y$10$2G2IJXlI0k8VIezHxLeeleMj3.JrBxJdn7i6yciQ1VTApEndGALrS', 'Boarder', '1', 'Approved', NULL, NULL),
('93NLxUfG', 'tine', '$2y$10$114atPuwoATEvExhCraw5eTUwiWbyhhOIJHvizzTRms/gTugK7MM6', 'Admin', '1', NULL, NULL, NULL),
('B2fdW3f4', 'Criselda', '$2y$10$D6Cjp4iKcf1jV0O/OQhK8OoU/X8ISLL8unkgc9a0MP0pG.8tXGZha', 'Owner', '1', 'Approved', NULL, NULL),
('BSgHwKy9', 'lornaquevedo', '$2y$10$7bKn5p2ZpD6mPJA2/0P6vuGHCNG1aqDfUdgw1sQagOWjSVzqvb7ou', 'Owner', '1', 'Approved', NULL, NULL),
('bVJ9UgMG', 'JEMBoardingHouse', '$2y$10$y0gL8aqHStw36KDbCnq/pO1faNOllbjO0LCK72rpV6S3Tcel/LrDi', 'Owner', '1', 'Approved', NULL, NULL),
('bW26Kl2S', 'rafa', '$2y$10$wu5mpHLd53BPfFoP8FqXLOCfKwRXo9MSaTj.i14GLMIclJbbgc8au', 'Boarder', '1', 'Approved', NULL, NULL),
('CYUDIHQ7', 'princesgonzales032506@gmail.com', '$2y$10$SA48NNZgee0lrzjEKAjNIueSrlTBY6xDIH.eaJxOyiCr4EInS/5P6', 'Boarder', '1', 'Approved', 'What was your childhood nickname?', 'Bon'),
('CzPBR7EO', 'CARLAMAE', '$2y$10$2o6AGvi3Q64WVY7FKgW1BuQNS97Vf6I92bl.YzV5pEuxFkXj/KXYG', 'Boarder', '1', 'Approved', NULL, NULL),
('dBdtuoR6', 'klajoy13', '$2y$10$ESUPcX85s7sUfuQS1W89xuvfS30MfIKOxPUc4IBgywUjtkCWw/QKy', 'Boarder', '1', 'Approved', 'What is the name of your first pet?', 'aj'),
('DCkaOstZ', 'arjaydevilla', '$2y$10$gUngmRkvTfAXyc3TvvA3o.1BjPLuAg8R/YkU9lhhQqwJQ3Yyv37FC', 'Boarder', '1', 'Approved', NULL, NULL),
('dwPvYRzf', 'sharra', '$2y$10$JHS.RFgE7Zpn0gyG7cpz9.JIL/m1qceoeeT6KtOrpaz/Wy.guFOwm', 'Boarder', '1', 'Approved', 'What is the name of your first pet?', 'sky'),
('DZs7sHrJ', 'Sott1717', '$2y$10$BrF59/YxgpjJiw6MINWAC.QdqSltXJ142miNs/V6kQZq9I8lY84RG', 'Boarder', '0', 'Approved', NULL, NULL),
('EmEcAQjm', 'tinaquevedo', '$2y$10$6PbTosig/i11LrKwroS7euAn20PUjc/LW2SUL9d6rk18shnZcwvzW', 'Owner', '1', 'Approved', NULL, NULL),
('EnhW0KJ7', 'jebszzz', '$2y$10$hyBou1zZDtZiIzEYTYqy4uiv0fMv82sSLXMpIj0RT.oIi3GzMwwKW', 'Boarder', '1', 'Approved', 'What is the name of your first pet?', 'ennon'),
('eOeGpg0b', 'ahmari', '$2y$10$UrvlRJ31xvhjWtEU/woIzOEP97BqhCR3Cw/DWKpzzWJpszG4wvExC', 'Boarder', '1', 'Approved', NULL, NULL),
('flFR5aVH', 'Nathan Absalon', '$2y$10$sx/8yNU1utJcFEBaEl7i1.3x3XPwebBW2cV2Ma9jetegHvnVpG3Fu', 'Boarder', '1', 'Approved', NULL, NULL),
('fRLHPxW8', 'carlo22', '$2y$10$pCf2yfIK6hU6WhZ4opxTwOp.m4HW88dL69/E4cuUAsXV7M.BOGTmm', 'Boarder', '1', 'Approved', NULL, NULL),
('G7KCp4TW', 'Jasper', '$2y$10$jxqyvxb7sBxXmNr3YFHLsuh8Cj3jNAFre6/WulpidrFWUkP8hd7Zy', 'Boarder', '1', 'Approved', NULL, NULL),
('GPqavwEJ', 'oliveros.richmon@gmail.com', '$2y$10$O3eTVRsINV6lG5NHoFhTeeQ5QxP0RRW3qiPAo/0gQbxCGLYozh5KG', 'Owner', '1', 'Approved', NULL, NULL),
('Gt9Rnxko', 'eliyah28', '$2y$10$4b4Pkoa.CXjuPEhVM50qg.8bXtSKsTSLQ8nD9UWKO2k8WEv6BuYEC', 'Boarder', '1', 'Approved', NULL, NULL),
('gtb3vvf8', 'jhalmarcastillo@gmail.com', '$2y$10$0WsruFTVfzykR8JA7zpvLuoprKkxFxzT17bDvSGsshXKX3/IoHpj6', 'Owner', '1', 'Approved', NULL, NULL),
('GUTLMo6d', 'Eunice Reynoso', '$2y$10$5JkmFEjFc1SzR72RXZA5TOE12xRjyv2ODCgzTG2pCtkBnttUwjAU2', 'Boarder', '1', 'Approved', NULL, NULL),
('hDdZykB5', 'arvie', '$2y$10$9z./YXypgXQw.19lMep9xOeifHmKYBjF1CJAgbUeieJIPcdRg5ZE.', 'Boarder', '1', 'Approved', NULL, NULL),
('HyoqwPOr', 'Nathan Absalon', '$2y$10$kdREWEl74c2z99Fm4FfrqOa9LN1MAYxcHq0wr6GwYVs/uRH1lyA6S', 'Boarder', '1', 'Approved', NULL, NULL),
('igL7WPhF', 'olenlwrns', '$2y$10$/wz/Dxrs3uor4pZmfjwXYu1zXZEQj0kaeal6onBKx4s3uPlLiOzNW', 'Boarder', '1', 'Approved', NULL, NULL),
('k71SiU9G', 'Mskarentan', '$2y$10$Wznp6gvL54WMpow4j02y/eP48U6/JtMr8pavmYEdMbu7pSyjq9meW', 'Owner', '1', 'Approved', NULL, NULL),
('LCFuGXVe', 'gabb', '$2y$10$tXlAaAgk4PEjPw/SBfic.eTnX8WbohRFMFX769Ey9kBEPazeO.dSW', 'Boarder', '1', 'Approved', NULL, NULL),
('lFx3n977', 'kathleenrea', '$2y$10$MHD73qbjUvBuC1IBP2HUxOBnl/5WOpL/TYUQTvMNdkYpJJNa5/tTq', 'Boarder', '1', 'Approved', NULL, NULL),
('lKVqPngT', 'anthealadines', '$2y$10$C5rIv4C2LKHZdJ.dIKn48OE8Ajrs/26AuUbA562LgCmQE3WDsMare', 'Boarder', '1', 'Approved', NULL, NULL),
('LnPvC9ID', 'Chachai', '$2y$10$4N7HZaRLZ3CjqbCRGjK31.LFKnyrMUD4UY8QIJNP4sGp.eJz7qgQG', 'Boarder', '1', 'Approved', 'What is your mother\'s maiden name?', 'Advincula'),
('Lx0Zy8Wn', 'Justhingszzz', '$2y$10$GjCLdwWKJITCfRsmNTSTY.dn79KH6ug/aiM/lw1HDFpAViSS0R6bK', 'Boarder', '1', 'Approved', 'What is the name of your first pet?', 'Ennon'),
('lYbIZI3f', 'Serviam', '$2y$10$MMrmpgZh1cK6FdkyyLESo.z.jVpitaz8pWrYP9G.sCzhK1/N0fa7e', 'Boarder', '1', 'Approved', NULL, NULL),
('m0QXx2pA', 'redengoddie14', '$2y$10$CKVrUHjIlXu70Aa3qpawIeJ8XTU1Oh3JOhgYL.b8.C9GFZUoeawKO', 'Owner', '1', 'Approved', NULL, NULL),
('MjYM3WVA', 'alyssa_28', '$2y$10$hJ9yZnE8d/MTgkqGdYNzZO4gDaN7F6UnH2d2Ep23x/UhgmybxJuKG', 'Boarder', '1', 'Approved', 'What was your childhood nickname?', 'ally'),
('MsaJFUT7', 'Dory', '$2y$10$sptPG28QQ3oYIPxYwVUnOOq9jNtIPhHkBPGP.xTMP/trIqV9MXU.W', 'Owner', '1', 'Approved', NULL, NULL),
('nHeX7SLL', 'Tessie Comia', '$2y$10$LTDVhxvYveZPtIamz37DyuOCLu1Z1G17p5cJ52tq9m0MbB.Iv9pbK', 'Owner', '1', 'Approved', NULL, NULL),
('nT8N9e0g', 'felicadarah', '$2y$10$pMM4xAVZiL2X6TpoWoAGOu5rf.VYMIdeBDXx9vAOh9As0xVrktmDW', 'Boarder', '1', 'Approved', NULL, NULL),
('nWsnXUTm', 'CARLAMAE', '$2y$10$/Pc9RUiZDVU9QXCRBrmCNexoPrzwF6U02mb5Z1KhiJjqJ6BN9pPK6', 'Boarder', '0', 'Approved', NULL, NULL),
('oGmnMKtt', 'Jewon', '$2y$10$oDH0RBUC9fO2.pNBA75rC.aymVnL80SsmWr23.kLS7PHvl2ycb.Km', 'Boarder', '1', 'Approved', NULL, NULL),
('Oj6d4BwI', 'its_ms.taming', '$2y$10$REQUsBSqYP4tF.m05TRDBOV3q7MS3Xh.2NVUaewCG3H34sQOE.ZEq', 'Boarder', '1', 'Approved', NULL, NULL),
('p275CpPr', 'deveza001', '$2y$10$DxNuoxcG6DpDMntvYrzVCOwKZOuulkewIFtzLC.rte8g5qdA0In62', 'Boarder', '1', 'Approved', 'What was the name of your elementary school?', 'Wakas Elementary School'),
('PHJRSsJD', 'AdamPVito', '$2y$10$XiMO/c.5.CMXif0QJQK7iu5VB6hsIzQBd4pBoJeyl2YHpSFwms00G', 'Boarder', '1', 'Approved', NULL, NULL),
('Pyz0zh3C', 'owner1', '$2y$10$9ZoxcB64CXe7kJcVEPttSeCFxelrlENhRUqS0KFDDD2Bs20CQSrI.', 'Owner', '0', 'Approved', NULL, NULL),
('q7IpeV4o', 'mariella', '$2y$10$K.W0hHhaFU4DafmJGVWf3.aBPwyrgN5I8eSkK9k4qQ6JM99S8T5dC', 'Boarder', '1', 'Approved', 'What is the name of your first pet?', 'toby'),
('rdxdmZP6', 'jenny', '$2y$10$NdfCRU9./cLeGI1BcSYdR.Xp1vOjGeJ9mrcD.WY94iTzgtbKAqE32', 'Boarder', '1', 'Approved', 'What is the name of your first pet?', 'blacky'),
('Rfy55ZLL', 'josheleazar1', '$2y$10$s.dGnvGjTUzbPXUuVTSENuZ1e2AGO8NPAhWvyqg1GcFK0UUmzVC/q', 'Boarder', '1', 'Approved', NULL, NULL),
('rZRXaVGs', 'Erish Nadera', '$2y$10$mLC7anJrDtBh55u5yuabF.7TnZt0oZXKOO9ayuvw7SWhGcL8D8mO.', 'Boarder', '1', 'Approved', NULL, NULL),
('s3vJ6W1u', 'princesgonzales032506@gmail.com', '$2y$10$ye1VatMEipkowVOcNVLVXeJb3n8YZXwqV426A8RT3LXFwRDfv33uK', 'Boarder', '1', 'Approved', 'What was your childhood nickname?', 'Bon'),
('sdfasad2123', 'superadmin', '$2y$10$3hu8KJ49/e4EBH68t6KLBuppNoklJDymN2VByqlRMg5g5OgIEHSwW', 'Super_Admin', '1', NULL, NULL, NULL),
('SHS9V87F', 'majestyalyssa', '$2y$10$mHMt5ME6Ei04wwvUeQFjPOhs3S/CdKWgQ6xQcPcURtcBt.BYkiv3G', 'Boarder', '1', 'Approved', 'What is your mother\'s maiden name?', 'Albay'),
('tSy4UqCA', 'JAYCA', '$2y$10$aUu7p7CzrAAwSxwm65TbEOE4.5yYCpU09COrGebtGzYf.mEr.05Di', 'Boarder', '1', 'Approved', 'What was your childhood nickname?', 'POPOT'),
('tZr7dOQz', 'julie', '$2y$10$VapzI2oxB5NWwo4AlYaLC.KojGwU6ibvUAGBY53nWTyKAPwn6foVG', 'Boarder', '1', 'Approved', 'What was your childhood nickname?', 'ineng'),
('uTA8Cl3I', 'JV', '$2y$10$DET6UXzw1MI1JhdFo6B7UO2j0gM9/gOc4fapdXExjKkj.vFdaeieW', 'Boarder', '1', 'Approved', NULL, NULL),
('V4BqfApB', 'Bingnantes', '$2y$10$h9e15DEpQlBp8FfC/v/GcOb7qmcdShPSMQTckcSxIv6i4ePdLRRDO', 'Owner', '1', 'Approved', NULL, NULL),
('VCMyBty9', 'Sheila', '$2y$10$ZrYRJNdT15Z.B2eamhU6P.IkzLvIxOSfGFCFHvSQ2yeq7Ynk5aQiO', 'Owner', '1', 'Approved', NULL, NULL),
('vjBMT6MB', '@biya.M', '$2y$10$xBk5cbOMpGSPYLpWH6wRYOqqGJPgEeDek39EV8r1FWljHL.Q4Z1Fy', 'Boarder', '1', 'Approved', 'What is the name of your first pet?', 'JP'),
('vOoGseIn', 'owner2', '$2y$10$VOt4E5XJg4OuiuE8l9NA2udJaqP2XX0RvZBEFm0xHvnhd.d.7c6Vy', 'Owner', '0', 'Approved', NULL, NULL),
('VRXeYGfr', 'HAZIELL', '$2y$10$Yk.phV/dLokebzSn9bwT2uLdZZf3hduepZ6sCc5EQntwuBec49WLS', 'Boarder', '1', 'Approved', 'What was the name of your elementary school?', 'PCES'),
('VwHAgbVS', 'CKarlzz', '$2y$10$SWdE6kNTlBwkbU9sAMhOkuUHgXHVSrwk9l3JfSMdWQA2vOkD3gs7i', 'Boarder', '1', 'Approved', 'What is the name of your first pet?', 'Kobe'),
('WB88gea0', 'Ann Margaret ', '$2y$10$MjeWHUxONeQAxKcb6jqBgOy.rVP8s0HEonDcjkVovsLcZdzKKH0BS', 'Boarder', '1', 'Approved', NULL, NULL),
('WSHNvpnF', 'tessiecomia', '$2y$10$0pdY6xjsb7wqPrj5BvOQpOg2CI8YiN/mD0HznUytZqW1zL32ctzge', 'Owner', '1', 'Approved', NULL, NULL),
('WVRnOSwM', 'Sott1717', '$2y$10$lxqBZO7th/ImXkdruRl1Kuf.SAe40cmLwxMMgEls0zZyLhG7XQCPO', 'Boarder', '0', 'Approved', NULL, NULL),
('xqO9pNQZ', 'Jiem', '$2y$10$4OCNQgwvrwrIWw.k3a.H3.yQvPt12N36rKlfJ8dyPUr1y3JKBlVyW', 'Boarder', '1', 'Approved', NULL, NULL),
('xRHJ2MSV', 'ciaragarciadomingo', '$2y$10$4pSAISFL5Zqq35ZjH5QjgespPQOonblJVrvmBecqgR1sl2chcUtPy', 'Boarder', '1', 'Approved', NULL, NULL),
('XYhmKCq7', 'nico buela', '$2y$10$hoqdBX59pi/ea7ILI1uZkeN5/c/SNPZrIY9DDtW6bCJWupBgvVO.G', 'Boarder', '1', 'Approved', NULL, NULL),
('zmOUH7ln', 'razel51', '$2y$10$f8zOdXSKXA/K5WHSm/jKX.OTZwpymBFJuXiKh.85IdK.8rYmA9lhq', 'Boarder', '1', 'Approved', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` varchar(255) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `ContNum` varchar(255) DEFAULT NULL,
  `AccountID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `FullName`, `Department`, `Email`, `ContNum`, `AccountID`) VALUES
('GZcsmCBc', NULL, NULL, NULL, NULL, '93NLxUfG'),
('zfvd1wq4csS3', 'Super Admin', NULL, 'superadmin@gmail.com', 'Super Admin', 'sdfasad2123');

-- --------------------------------------------------------

--
-- Table structure for table `boarder`
--

CREATE TABLE `boarder` (
  `BoarderID` varchar(255) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `Contact_No` varchar(255) DEFAULT NULL,
  `YearLvl` varchar(255) DEFAULT NULL,
  `Course` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `COR` varchar(255) DEFAULT NULL,
  `M_Name` varchar(255) DEFAULT NULL,
  `F_Name` varchar(255) DEFAULT NULL,
  `M_Cont` varchar(255) DEFAULT NULL,
  `F_Cont` varchar(255) DEFAULT NULL,
  `AccountID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boarder`
--

INSERT INTO `boarder` (`BoarderID`, `FullName`, `Contact_No`, `YearLvl`, `Course`, `Email`, `COR`, `M_Name`, `F_Name`, `M_Cont`, `F_Cont`, `AccountID`) VALUES
('04qHCKUu', 'Deveza, Jhade Mclin C.', '09687391434', '1st', 'BSEd Science', 'jhademclin@gmail.com', '../cor/04qHCKUu/66a09f8f0f2fb_', 'Caalaman, Rosalind E.', 'Deveza, Manuel L.', '09120893900', '09561242612', 'p275CpPr'),
('0KAGYjNq', 'Cristian Z. Jardio', '09511203441', '1st', 'BS Accountancy ', 'jardiocristian@gmail.com', '../cor/0KAGYjNq/66a8cceb6cc3b_CamScanner 07-30-2024 18.31_01~2.jpg', 'Marcelina Z. Jardio', 'Eduardo C. Jardio Sr.', '09989773896', 'N/A', '69bAVQG0'),
('1WvogtEO', 'Nico James C. Buela', '09291660259', '1st', 'BSIE', 'nicobuela1717@gmail.com', '../cor/1WvogtEO/669f628b96065_', 'Ginalyn C. Buela', 'Nicanor U. Buela', '09285318844', '09991501000', 'WVRnOSwM'),
('4NZmADaD', 'Arvie Canencia Dayoha ', '09518686394', '4th', 'BSIT-CPT', 'arviecanencia627@gmail.com ', '../cor/4NZmADaD/669de0612a973_inbound5017048128711152684.jpg', 'Eva Dayoha', 'Ariel Dayoha', '', '09270619255', '67I1yqIe'),
('5Jyup4cZ', 'arhon jay regalario', '09853862894', '1st', 'bs agriculture', 'arhonjayregalario@gmail.com', '../cor/5Jyup4cZ/669dd7e6ab7ff_', 'rhona rose regalario', 'jay regalario', '09853862894', '09853862894', '37lCi8yH'),
('7fq3qdtL', 'Nico James C. Buela', '09291660259', '1st', 'BSIE', 'nicobuela1717@gmail.com', '../cor/7fq3qdtL/669f63b1c2cc7_', 'Ginalyn C. Buela', 'Nicanor U. Buela', '09285318844', '09991501000', 'XYhmKCq7'),
('7HrHISr6', 'Princess Ciara Maine Garcia Domingo ', '09813025162 ', '1st', 'BS FORESTRY', 'nephicia2006@gmail.com', '../cor/7HrHISr6/669dd9c7716bb_', 'Michelle Garcia ', 'Noel Domingo', '09637958682', '09515502175', 'xRHJ2MSV'),
('8JLZ9NI6', 'Jebrel Esa Roguel', '09811651301', '4th', 'bsit-cpt', 'jesa@gmail.com', '../cor/8JLZ9NI6/66b198fa95fba_', 'Girlie Roguel', 'n/a', 'n/a', 'n/a', 'EnhW0KJ7'),
('8WnjZA95', 'Princes J. Gonzales', '09508304368', '1st', 'Bachelor of Arts in Communication ', 'princesgonzales032506@gmail.com', '../cor/8WnjZA95/66cff70cf142c_', 'Marife J. Gonzales ', 'Roberto E. Gonzales ', '09077486988', '09306720775', 'CYUDIHQ7'),
('BmdOWcOo', 'Nathan V. Absalon', '09481140631', '1st', 'BS Rad Tech', 'absalonnathanvidal@gmail.com', '../cor/BmdOWcOo/669e19cadf796_', 'Jocelyn V. Absalon', 'Donato V. Absalon', '09565207949', '0912 651 0672', 'flFR5aVH'),
('bONDnZ4p', 'Serviam Luis V. Maza', '09126584874', '1st', 'bs agriculture', 'serviamluismaza@gmail.com', '../cor/bONDnZ4p/669e093737863_', 'Dewi V. Maza', 'Nonato S. Maza', '', '09213504414', 'lYbIZI3f'),
('bw00EWga', 'Arvie Dayoha', '09518686394', '4th', 'BSIT-CPT', 'arviecanencia627@gmail.com ', '../cor/bw00EWga/669de1ff93a05_inbound1592076585668395255.jpg', 'Eva Dayoha', 'Ariel Dayoha', '', '09270619255', 'hDdZykB5'),
('C01tpkN2', 'Carlo James Musa Del Valle', '09213674812', '1st', 'bsit', 'carlojamesdelvalle30@gmail.com', '../cor/C01tpkN2/669cedeb00b44_', 'Carlo James M. Del Valle', 'Carlo James M. Del Valle', '09462200047', '09462200047', 'fRLHPxW8'),
('Dqk4htDg', 'kathleen rea u. daelo', '09277330252', '1st', 'industrial', 'daelokathleenrea@gmail.com', '../cor/Dqk4htDg/669f55092d810_', 'virginia u. daelo ', 'n/a', '09924649827', 'n/a', 'lFx3n977'),
('Dvdjiddb', 'Erich Suziette Nadera', '09300837302', '1st', 'BSIE', 'erichsuziettenadera@gmail.com', '../cor/Dvdjiddb/669f61920bc81_', 'Edelyn Nadera', 'Richard Nadera', '09123464883', '09069770578', 'rZRXaVGs'),
('e5IYQct2', 'CARLA MAE C. CARIEL', '09222199168', '1st', 'BA COMM', 'carielcarlamae@gmail.com', '../cor/e5IYQct2/669dc7d674fbd_', 'jocelyn', '', '', '', 'CzPBR7EO'),
('eFjLuZNZ', 'Carl Jasper Abina ', '09944962389', '1st', 'BS Information Technology', 'jasperabina31@gmail.com', '../cor/eFjLuZNZ/669f4e2b60a08_', 'Maria Rosita S. Abina', 'Jef Chris R. Abina', 'N/a', '0907 538 5342', 'G7KCp4TW'),
('EkPqqm5U', 'Fortunado', '09317625316', '1st', 'BSEE', 'jangfayfortunado@gmail.com', '../cor/EkPqqm5U/669f2a9b5ff7e_', 'Jinky Fortunado', 'Francisco P. Fortunado', '09516970427', 'n/a', '37YksPi6'),
('EqaEeeji', 'ALYSSA D. DE LEON', '09155400302', '1st', 'BS ACCOUNTANCY', 'deleon.alyssa.@gmail.com', '../cor/EqaEeeji/66a09a7f47eef_', 'LEONISA DE LEON', 'ARNOLD DE LEON', '09270089966', '09151327986', 'MjYM3WVA'),
('ESUWkCj7', 'Klariz Joy Ortiz', '09813018656', '1st', 'BS Accountancy', 'klarizjoyortiz@gmail.com', '../cor/ESUWkCj7/66a09ba4c7870_', 'Leonora Ortiz', 'Esperidion Ortiz', '09514222492', '09911805047', 'dBdtuoR6'),
('exzvUXi0', 'Justine ', '09811651301', '3rd', 'BSIT-CPT', 'jpsarmiento@slsu.edu.ph', '../cor/exzvUXi0/669708ca17900_inbound8868835460067123849.jpg', 'Lora Sarmiento', 'Amorsolo Sarmiento', '09811651301', '09811651301', 'Lx0Zy8Wn'),
('F2aWYld2', 'Lawrence P. Ariola', '09538347356', '1st', 'BA COMM', 'olenlwrns@gmail.com', '../cor/F2aWYld2/66a0c7fee344e_C09AE7A2-7C6A-4256-8C3E-11A8A17E0D66.jpeg', 'Fortunata Ariola', 'Alberto Ariola', '09655294861', '09655294863', 'igL7WPhF'),
('HDB0m1tQ', 'Karylle Vegamora', '09300455579', '1st', 'BS Accountancy ', 'vegamorakarylleclare@gmail.com', '../cor/HDB0m1tQ/66acd91db6fdb_', 'Regina Vegamora', 'Carlos Vegamora', '09914658761', '09184189113', 'VwHAgbVS'),
('ikVgq4xm', 'Gabriel Laguerta', '09707550244', '1st', 'BSIT Automotive', 'laguertagabriel5@gmail.com', '../cor/ikVgq4xm/669f494cd692a_', 'Annabel Laguerta', 'Marlon Laguerta', '09197803263', 'n/a', 'LCFuGXVe'),
('jrbTIKLq', 'Lawrence Ahmari N. Pakingan', '09474389519', '1st', 'BSME', 'lawrenceahm@gmail.com', '../cor/jrbTIKLq/669f51261e535_', 'Lavenia N. Pakingan', 'Angelo O. Pakingan', '09195085583', '09777999868', 'eOeGpg0b'),
('JTHuXtFU', 'Maria Elaine Marculita Bon', '09073919128', '1st', 'BSME', 'bonmariaelaine@gmail.com', '../cor/JTHuXtFU/66a08b02a355f_CamScanner 07-24-2024 11.15_2.jpg', 'Ma. Evelyn Marculita Bon', 'Nelson Maramag Bon', '09518600064', '09518600064', 'Gt9Rnxko'),
('kxjukyWN', 'Adam Joaquin P. Vito', '09268434796', '1st', 'BS-ME', 'adampvito06@gmail.com', '../cor/kxjukyWN/669f50232a8a2_', 'Sarah P. Vito', 'Warren G. Vito', 'none', '09917273868', 'PHJRSsJD'),
('mTvMI7Kk', 'mariella lauron', '09064774304', '1st', 'BSBA', 'mariellalaurontradio@gmail.com', '../cor/mTvMI7Kk/66a0c033418f5_', 'marilou tradio', 'celestino tradio', '09489480162', 'na', 'q7IpeV4o'),
('nFE7gqA0', 'Jude Vincent C. Asia', '09911810821', '1st', 'BSCE', 'asiajude89@gmail.com', '../cor/nFE7gqA0/669f4cb8302d8_', 'Girly C. Asia', 'Ramoncito B. Asia', '09942003755', '09942003755', 'uTA8Cl3I'),
('o3B37nBs', 'Majesty Alyssa A. Almajar', '09765787541', '1st', 'BSEd Mathematics', 'almajarmajesty@gmail.com', '../cor/o3B37nBs/66a08f1fb6e78_', 'Marife A. Almajar', 'Ronnel R. Almajar', '09303499048', '09633947414', 'SHS9V87F'),
('oJj7zi2b', 'Felica Darah Encanto', '09384459885', '1st', 'BS Nursing', 'darahencanto@gmail.com', '../cor/oJj7zi2b/669e17f0c9b7a_', 'Daria D. Encanto', 'Feliciano T. Encanto', '09106930351', '', 'nT8N9e0g'),
('ou94s82k', 'Cherubim Advincula', '09455616252', '1st', 'BEEd', 'ramendua@gmail.com', '../cor/ou94s82k/66b0a9de46015_', 'Riza Mendua', 'Not Applicable', '09455616252', '0', 'LnPvC9ID'),
('Pb92YQuA', 'Nico James C. Buela', '09291660259', '1st', 'BSIE', 'nicobuela1717@gmail.com', '../cor/Pb92YQuA/669f628b4d620_', 'Ginalyn C. Buela', 'Nicanor U. Buela', '09285318844', '09991501000', 'DZs7sHrJ'),
('Py9pybs5', 'Princes J. Gonzales ', '09508304368', '1st', 'Bachelor of Arts in Communication ', 'princesgonzales032506@gmail.com', '../cor/Py9pybs5/66cffaef5c6f0_', 'Marife J. Gonzales ', 'Roberto E. Gonzales ', '09077486988', '09306720775', 's3vJ6W1u'),
('QdAMkZm5', 'Jenny Rose C. Prado', '09102685333', '1st', 'bsba marketing', 'jennyroseprado60@gmail.com', '../cor/QdAMkZm5/66a0beecad6f8_', 'Armalyn C. Prado', 'Salvador Prado Jr.', '09285306864', '09285306864', 'rdxdmZP6'),
('QmwZrVwM', 'sharra castanas', '09636910440', '1st', 'BSED FILIPINO', 'itzmilkshakee@gmail.com', '../cor/QmwZrVwM/66a0959d73a14_', 'Maylin A. Castanas', 'Marvin P. Castanas', 'n/a', 'n/a', 'dwPvYRzf'),
('qoACEbrh', 'Nathan V. Absalon', '09481140631', '1st', 'BS Rad Tech', 'absalonnathanvidal@gmail.com', '../cor/qoACEbrh/669e19c8a6e6f_', 'Jocelyn V. Absalon', 'Donato V. Absalon', '09565207949', '0912 651 0672', 'HyoqwPOr'),
('qTVn27Af', 'Anne Jhie Urriza', '09266528039', '1st', 'BS Nursing', 'urrizaannejhie@gmail.com', '../cor/qTVn27Af/66a0adf2a996f_', 'Jane Urriza', 'Amando Urriza', '09651847121', '09279482318', '7kYGxtz6'),
('Rj9nsN0J', 'Rafaela Paglinawan', '09679936851', '4th', 'BSIT CPT ', 'rafapaglinawan02@gmail.com', '../cor/Rj9nsN0J/669ddfbed2bad_', 'Marivic Paglinawan', 'Rufo Paglinawan', '09759462576', '09759462576', 'bW26Kl2S'),
('rycAR04P', 'CARLA MAE C. CARIEL', '09222199168', '1st', 'BA COMM', 'carielcarlamae@gmail.com', '../cor/rycAR04P/669dc7d70459f_', 'jocelyn', '', '', '', 'nWsnXUTm'),
('S3wGstG0', 'JAYCA M. ABRAHAM', '09650666938', '1st', 'BSE FILIPINO', 'ABRAHAMJAYCA9307@GMAIL.COM', '../cor/S3wGstG0/66a06a9660a44_', 'GEMMA ABRAHAM ', 'CARLOS ABRAHAM', '09360943594', 'N/A', 'tSy4UqCA'),
('sFBAJHj6', 'john christopher Guevarra Magtibay', ' 09663870888', '1st', 'BA COMM', 'johnchristophermagtibay@gmail.com', '../cor/sFBAJHj6/669e062dc48f6_', 'Wennie Magtibay', 'Jon Erik Magtibay', '09157963889', '', '3vQAol6o'),
('TiYvLNFN', 'Bealyn P. Marcelino', '09662756609', '1st', 'BSED FILIPINO', 'bealynmarcelino@gmail.com', '../cor/TiYvLNFN/66a09e3c4ef6b_', 'Gemma P. Marcelino', 'Reynaldo P. Marcelino', '09810509180', 'N\\A', 'vjBMT6MB'),
('UEzsuAZk', 'Eleazar, Josh Gabriel F.', '09206017076', '1st', 'BSCPE', 'josheleazar0@gmail.com', '../cor/UEzsuAZk/669f26ea4bb69_', 'Lina F. Eleazar', 'Rodel A. Eleazar', '09998279180', 'N/A', 'Rfy55ZLL'),
('UpsjK3N1', 'Ann Margaret P. Millares', '0992526690', '1st', 'BA COMM', 'annmargaretpmillares@gmail.com', '../cor/UpsjK3N1/669e074c6e0b7_', 'Rosila Millares', '', '', '', 'WB88gea0'),
('uUTEL0kl', 'Arjay B. De Villa', '09514253622', '1st', 'BS Environmetal Science', 'devillaarjay02@gmail.com', '../cor/uUTEL0kl/669dd8c9e4641_', 'Maribel B. De Villa', 'Arnel B. De Villa', '09451670395', '09451670395', 'DCkaOstZ'),
('vLuxkhPk', 'Haziell L. Ocana', '09518582135', '1st', 'CABHA-BA', 'haziellocana@gmail.com', '../cor/vLuxkhPk/66a065ac7d2e6_', 'Theresa Ocana', 'Howel Ocana', '09152063608', 'N/a', 'VRXeYGfr'),
('VrweXApV', 'Prin Cess Weng A. Taming', '09935079382', '1st', 'BS Nursing', 'princesstaming@gmail.com', '../cor/VrweXApV/669e20e21d149_', 'Lizyl A. Taming', '.', '09089808042', '.', 'Oj6d4BwI'),
('wkGzTR4m', 'Julie Ann C. Ayala ', '09754061061', '1st', 'BS Accountancy', 'ayalajulie2812@gmail.com', '../cor/wkGzTR4m/66a08b8183e18_', 'Jannette C. Ayala', 'Leandro R. Ayala', 'n/a', '09268446573', 'tZr7dOQz'),
('Wlk7JmZQ', 'Karylle Vegamora', '09300455579', '1st', 'BS Accountancy ', 'vegamorakarylleclare@gmail.com', '../cor/Wlk7JmZQ/66acd91ed02c1_', 'Regina Vegamora', 'Carlos Vegamora', '09914658761', '09184189113', '6ZjowKgU'),
('WLQiz3ee', 'Razel M. Rubio', '09954166744', '1st', 'BS Civil Engineering', 'razelrubio51@gmail.com', '../cor/WLQiz3ee/669f4d4894ac5_', 'Sarah M. Rubio', 'Bernabe P. Rubio', '09207993216', '09207993216', 'zmOUH7ln'),
('wuZllGXK', 'kathleen rea u. daelo', '09277330252', '1st', 'industrial', 'daelokathleenrea@gmail.com', '../cor/wuZllGXK/669f55098f495_', 'virginia u. daelo ', 'n/a', '09924649827', 'n/a', '8Zw6wTTV'),
('Y0Xmcoqb', 'Anthea Chynette S. Ladines', '09369457842', '1st', 'BSME', 'anthealadines3@gmail.com', '../cor/Y0Xmcoqb/669f18b7c08c1_', 'Maricynth S. Ladines', 'Renante A. Ladines', '09386188640', '0964791223', 'lKVqPngT'),
('yCrUqXnm', 'Jowen Valenzuela', '09918417238', '1st', 'BSIE', 'watanabejwn28@gmail.com', '../cor/yCrUqXnm/669f5d0648234_', 'Nenale R. Valenzuela', 'N/A', '09918417238', 'N/A', 'oGmnMKtt'),
('yqvb0iEl', 'Eunice Reynoso', '09674309957', '1st', 'BSCE', 'eunicereynoso.605@gmail.com', '../cor/yqvb0iEl/669f60782f7d3_', 'Rozaida Reynoso', 'Eduardo Reynoso', '09459680424', '09459680424', 'GUTLMo6d'),
('yu8NxFxa', 'CARLA MAE C. CARIEL', '09222199168', '1st', 'BA COMM', 'carielcarlamae@gmail.com', '../cor/yu8NxFxa/669dc7d6bb08f_', 'Jocelyn C. Cariel', 'Renato J. Cariel', '09641839114', 'N/A', '69PKuJYM'),
('zvWuaqlW', 'John Mark V. Pureza', '09911525436', '1st', 'BSIE', 'markpureza421@gmail.com', '../cor/zvWuaqlW/669f5c0aebe45_', 'Imelda V. Pureza', 'Melchor R. Pureza', 'n/a', '09281924344', 'xqO9pNQZ');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BookID` varchar(255) NOT NULL,
  `BookDate` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `RoomID` varchar(255) DEFAULT NULL,
  `PropertyID` varchar(255) DEFAULT NULL,
  `BoarderID` varchar(255) DEFAULT NULL,
  `OwnerID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BookID`, `BookDate`, `Status`, `RoomID`, `PropertyID`, `BoarderID`, `OwnerID`) VALUES
('2OTgORWb', '2024-07-24 07:06:05', 'Accepted', 'NoMJcMOr', '69fUzWvd', 'ESUWkCj7', '83OpHArs'),
('fcXC0yzj', '2024-07-22 02:33:22', 'Pending', 'iyG0k7aR', '8JSvzw7E', 'exzvUXi0', 'YwUh9rwS'),
('J3jurqcH', '2024-08-05 06:21:07', 'Accepted', 'OpxSJ0ke', '69fUzWvd', 'JTHuXtFU', '83OpHArs');

-- --------------------------------------------------------

--
-- Table structure for table `book_log`
--

CREATE TABLE `book_log` (
  `LogID` varchar(255) NOT NULL,
  `Activity` varchar(255) DEFAULT NULL,
  `LogDate` varchar(255) DEFAULT NULL,
  `RoomID` varchar(255) DEFAULT NULL,
  `PropertyID` varchar(255) DEFAULT NULL,
  `BoarderID` varchar(255) DEFAULT NULL,
  `OwnerID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_log`
--

INSERT INTO `book_log` (`LogID`, `Activity`, `LogDate`, `RoomID`, `PropertyID`, `BoarderID`, `OwnerID`) VALUES
('bKp12zPf', 'Check-in', '2024-07-31 02:26:55', 'NoMJcMOr', '69fUzWvd', 'ESUWkCj7', '83OpHArs'),
('vAuBieqD', 'Check-in', '2024-08-13 05:04:57', 'OpxSJ0ke', '69fUzWvd', 'JTHuXtFU', '83OpHArs');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `InfoID` int(11) NOT NULL,
  `About` varchar(5000) DEFAULT NULL,
  `FB` varchar(500) DEFAULT NULL,
  `ContNum` varchar(255) DEFAULT NULL,
  `Address` varchar(500) DEFAULT NULL,
  `Gmail` varchar(255) DEFAULT NULL,
  `P` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`InfoID`, `About`, `FB`, `ContNum`, `Address`, `Gmail`, `P`) VALUES
(1, 'Welcome to Rent IT, your trusted partner for seamless dorm and apartment bookings. We specialize in connecting boarders with comfortable and affordable accommodations tailored to their needs. Whether you\'re a student looking for a convenient dormitory or a professional seeking a cozy apartment, our platform offers a diverse range of options to suit every lifestyle and budget.\r\n\r\n\r\nOur mission is to simplify the booking process, providing a user-friendly platform where you can easily find, book, and manage your stay. With a focus on quality, security, and customer satisfaction, we ensure that every property listed meets our high standards. Our dedicated support team is always here to assist you, making your experience as smooth and enjoyable as possible.\r\n\r\n\r\nAt Rent IT, we\'re not just about finding you a place to stay; we\'re about helping you find your home away from home.', 'Rent IT', '+63 981 1651 301', 'Brgy. Kulapi, Lucban, Quezon (Main Campus) , Philippines', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` varchar(255) NOT NULL,
  `SenderID` varchar(255) DEFAULT NULL,
  `ReceiverID` varchar(255) DEFAULT NULL,
  `MessageText` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Seen` int(1) DEFAULT 0,
  `Hide` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MessageID`, `SenderID`, `ReceiverID`, `MessageText`, `Timestamp`, `Seen`, `Hide`) VALUES
('00wOMTG0', 'dBdtuoR6', 'GPqavwEJ', 'Hello po, magkano po ang rent', '2024-08-03 06:22:40', 0, NULL),
('0jguVwAC', 'bVJ9UgMG', 'dBdtuoR6', '1,400 po per month, \r\nmalawak po ang room\r\nnsa loob na po ang CR, Shower, Lababo, Cabinet.\r\nFREE WIFI\r\nWALA pong additional na bayad sa laptop, plantsa, electricfan\r\nkayo po ang magbabayad ng electric bill 50-100 po per month\r\n20-30 po ang water bill per month', '2024-07-25 09:50:37', 1, NULL),
('141Cq8bI', 'GPqavwEJ', 'uTA8Cl3I', '2,000 po monthly, kasama na ang tubig, kuryente, WiFi, double deck with foam, stove and lockers.', '2024-07-24 07:56:49', 0, NULL),
('1PIhxots', 'dBdtuoR6', 'bVJ9UgMG', 'hello po ask ko lang po kung magkano po ang rent per month ', '2024-07-24 11:12:53', 1, NULL),
('1VmprOPx', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:34', 0, NULL),
('1yOu9N8H', '4PxCA5mQ', 'Gt9Rnxko', 'Good Day po! 1,500 per month kasama na po doon yung sa wifi,tubig,at kuryente. Salamat', '2024-08-06 05:33:16', 1, NULL),
('2fyWJT3Z', 'eOeGpg0b', '4PxCA5mQ', 'how many occupants po? ', '2024-07-23 08:30:01', 1, NULL),
('2oH9RwgW', 'dBdtuoR6', 'B2fdW3f4', 'Hello po, ask kolang po sana if magkano po yung rent ng pang apatan na room, thankyou po', '2024-07-24 07:48:21', 1, NULL),
('3AcNv3Xo', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:39', 0, NULL),
('3KxVEPa5', 'B2fdW3f4', 'MjYM3WVA', '1500 per month kasama tubig, kuryente, and wifi', '2024-07-25 02:47:18', 0, NULL),
('3tNfQsbp', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:38', 0, NULL),
('42M6wnyD', '4PxCA5mQ', 'igL7WPhF', 'Hi Sir! for female occupants lang po, salamat.', '2024-08-05 07:45:39', 0, NULL),
('4W0oXTQ2', 'xqO9pNQZ', 'GPqavwEJ', 'Hello po?', '2024-07-30 04:24:18', 0, NULL),
('4W5vXD31', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:46', 0, NULL),
('5Dljmu4p', '6D4SEyEE', 'dBdtuoR6', '09662755379 ito po contact number ', '2024-07-24 08:13:01', 1, NULL),
('6VOZJZy8', 'xqO9pNQZ', 'GPqavwEJ', 'hello po ask kolang po if magkano monthly?\r\n', '2024-07-29 03:25:34', 0, NULL),
('6Yv7MGsB', 'xqO9pNQZ', '4PxCA5mQ', 'hello po ask kolang kung magkano and ilan kaysa sa isang room? ty po.', '2024-07-29 03:18:27', 1, NULL),
('7207NE0l', 'igL7WPhF', 'VCMyBty9', 'Good morning po! About po sa dorm', '2024-07-23 00:24:29', 1, NULL),
('7CRQ5QrH', 'B2fdW3f4', 'dBdtuoR6', 'Hi! Good Afternoon ', '2024-07-24 08:15:26', 1, NULL),
('8AZhl0nz', '4PxCA5mQ', 'dBdtuoR6', '1500 per month', '2024-07-26 10:16:23', 1, NULL),
('8B2IDBuw', '6D4SEyEE', 'dBdtuoR6', 'Bed frame lang po kasama ,yes po, dun sa bookshop', '2024-07-24 09:20:56', 1, NULL),
('8j3FJTNs', '6D4SEyEE', 'dBdtuoR6', 'opo per room may cr at kitchen', '2024-07-24 09:24:19', 1, NULL),
('8LLdXbc7', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:21:09', 1, NULL),
('8PWXDcCw', 'igL7WPhF', '4PxCA5mQ', 'Hello po, magkano po ang sa dorm nyo?', '2024-07-24 09:33:47', 1, NULL),
('8r4dzWHM', '6D4SEyEE', 'Gt9Rnxko', '09662755379 Valentina Cube', '2024-08-08 06:05:57', 1, NULL),
('8zZ8jLMX', 'dBdtuoR6', 'GPqavwEJ', 'Pwede po kayang makuha number nyo? ', '2024-08-03 06:32:51', 0, NULL),
('9BkBwkGT', '6D4SEyEE', 'dBdtuoR6', 'dito po pagkalagpas ng police station', '2024-07-24 09:22:21', 1, NULL),
('9NBSErGF', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:20:52', 1, NULL),
('a5XWFjqk', '6D4SEyEE', 'dBdtuoR6', 'opo, pwede po kayong 3 lang ', '2024-07-24 09:25:30', 1, NULL),
('AaSsINEj', 'B2fdW3f4', 'dBdtuoR6', '09281568159 ito po contact number ko', '2024-07-24 08:16:20', 1, NULL),
('ahgc8bHD', 'dBdtuoR6', '4PxCA5mQ', 'hello po, magkano po ang rent per month?', '2024-07-24 11:00:05', 1, NULL),
('aiBpLPS6', 'zmOUH7ln', 'VCMyBty9', 'How much po ang monthly?', '2024-07-23 10:43:48', 1, NULL),
('ALqfEK1L', 'Gt9Rnxko', '6D4SEyEE', 'Pede po mahingi fb acc nyo po?', '2024-08-06 06:13:52', 1, NULL),
('ALwX7skh', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:39', 0, NULL),
('aPCo46iU', 'dBdtuoR6', '6D4SEyEE', 'Hindi po ba sa may jollibee ang pandayan? Hehe meron din po bang pandayan sa miramonte? ', '2024-07-24 09:21:31', 1, NULL),
('bbddwcOc', 'dBdtuoR6', '6D4SEyEE', 'Ah edi may pandayan din po pala dyan sa miramonte', '2024-07-24 09:22:26', 1, NULL),
('BCtym0mE', '4PxCA5mQ', 'xqO9pNQZ', 'Hi Sir! for female occupants lang po, salamat.', '2024-08-05 07:45:52', 0, NULL),
('BkkloZBb', '6D4SEyEE', 'dBdtuoR6', '1400 isa po dun', '2024-07-24 09:33:10', 1, NULL),
('BwssAmVw', '6D4SEyEE', 'dBdtuoR6', 'sa barangay 2 lang po kami', '2024-07-24 09:21:59', 1, NULL),
('c7Z4ZvUE', 'VRXeYGfr', '6D4SEyEE', 'Magkano po per month? And ano po inclusions?', '2024-07-24 11:31:51', 1, NULL),
('c8QRBVcY', 'igL7WPhF', 'VCMyBty9', 'Hello po, about po sa dorm.', '2024-07-23 00:40:39', 1, NULL),
('cMSKInH9', '4PxCA5mQ', 'LnPvC9ID', 'Meron naman po na bakante pero may kasama pong iba sa room usually po ay nasa 8 po per room ', '2024-08-06 05:35:01', 0, NULL),
('csOwKlJW', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:21:01', 1, NULL),
('cWPaglSf', '6D4SEyEE', 'Gt9Rnxko', 'yes po, may vaccant pa po', '2024-08-06 05:28:31', 1, NULL),
('CWZhXzja', 'VCMyBty9', 'igL7WPhF', 'hello po! for female occupants po ito.salamat', '2024-07-24 08:14:01', 1, NULL),
('d155gWQb', 'uTA8Cl3I', 'GPqavwEJ', 'Ask ko lang po kung magkano po monthly ', '2024-07-23 06:26:52', 1, NULL),
('D2j27lOC', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:21:03', 1, NULL),
('DKY4Mwss', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:45', 0, NULL),
('Eh2GqSHO', 'dBdtuoR6', 'B2fdW3f4', 'Mga ilang minutes po ang lakad pa school? ', '2024-07-24 09:30:54', 1, NULL),
('eLAsT7Ex', '6D4SEyEE', 'dBdtuoR6', 'karamihan naman po ay bedframe lang ang kasama', '2024-07-24 09:21:16', 1, NULL),
('En9HZy2U', '6D4SEyEE', 'dBdtuoR6', '09662755379', '2024-07-25 02:29:42', 1, NULL),
('EqSfgVkb', 'igL7WPhF', 'VCMyBty9', 'Sige po, sorry po sa repeated messages. ', '2024-07-24 09:29:18', 1, NULL),
('ErdByIOo', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po ang room?', '2024-07-23 00:46:17', 1, NULL),
('ErKMRS11', 'B2fdW3f4', 'dBdtuoR6', '1,500 per month kasama na ang electricity, water, & wifi.', '2024-07-24 08:15:48', 1, NULL),
('EtNUFXsQ', 'LnPvC9ID', '4PxCA5mQ', 'Hello po. Room for 2 or 5? Meron po kaya. With own CR po sana.', '2024-08-05 10:34:49', 1, NULL),
('fcx6ZBUR', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:21:09', 1, NULL),
('fgQS4VPR', 'dBdtuoR6', '6D4SEyEE', 'Magkano po ang isang room maam? Yung apatan po', '2024-07-24 09:30:01', 1, NULL),
('fOnOQolw', 'GPqavwEJ', 'uTA8Cl3I', 'Hello,', '2024-07-24 07:56:01', 0, NULL),
('FoZbOg0B', '6D4SEyEE', 'dBdtuoR6', 'salamat po', '2024-07-24 08:13:07', 1, NULL),
('fr2ug5tk', 'CYUDIHQ7', 'VCMyBty9', 'Hello good evening po, how much po sa rent and can I ask for your facebook account po. Thank you.', '2024-08-29 15:09:49', 0, NULL),
('FseeY4va', 'igL7WPhF', 'VCMyBty9', 'Hello po, about po sa dorm.', '2024-07-24 09:24:49', 1, NULL),
('g9tYi58D', '6D4SEyEE', 'dBdtuoR6', 'malayo po sa jollibee', '2024-07-24 09:22:05', 1, NULL),
('gCDFZ9o1', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:40', 0, NULL),
('gFFIff1v', 'igL7WPhF', 'VCMyBty9', 'Hello po, about po sa dorm.', '2024-07-23 00:34:14', 1, NULL),
('GhVYLykA', '37lCi8yH', 'bVJ9UgMG', 'Available po ba sa male boarder and kung available po magkano thank you po', '2024-07-22 05:25:38', 1, NULL),
('H1k63ezg', 'CYUDIHQ7', 'bVJ9UgMG', 'Hello, good noon po! Pwede pong makita yung loob po?', '2024-08-29 04:22:43', 0, NULL),
('H215LqCW', 'igL7WPhF', 'VCMyBty9', 'Hello po, about po sa dorm.', '2024-07-23 12:56:15', 1, NULL),
('HFoYZ3vQ', '6D4SEyEE', 'Gt9Rnxko', 'pwede pong phone number na lang po', '2024-08-08 06:05:25', 1, NULL),
('hPHiwhDP', '6D4SEyEE', 'dBdtuoR6', 'Good Day!', '2024-07-24 08:09:56', 1, NULL),
('HPQTvffQ', 'Gt9Rnxko', '4PxCA5mQ', 'Magkano po bed space ma\'am? And ano po sana inclusions? Thank you po ', '2024-08-05 09:48:28', 1, NULL),
('iFKQsWAc', '6D4SEyEE', 'bW26Kl2S', 'hi', '2024-07-24 08:10:35', 0, NULL),
('IjtIGQr7', '6D4SEyEE', 'dBdtuoR6', 'malapit po kami sa pandayan ', '2024-07-24 09:11:45', 1, NULL),
('IND4crzX', 'bVJ9UgMG', 'dBdtuoR6', 'https://www.facebook.com/reel/451017744372959', '2024-07-25 02:31:05', 1, NULL),
('intFTWYR', 'VRXeYGfr', 'B2fdW3f4', 'Available pa po ba? Magkano po per month and ano po inclusions?', '2024-08-21 08:10:40', 0, NULL),
('IPzo9kQT', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po sa room?', '2024-07-23 00:44:16', 1, NULL),
('iQJ2KRuD', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po sa room?', '2024-07-23 00:45:26', 1, NULL),
('IxFKK3oh', 'igL7WPhF', 'VCMyBty9', 'Good morning po! About po sa dorm', '2024-07-23 00:24:06', 1, NULL),
('J1e7uiSZ', 'igL7WPhF', 'VCMyBty9', 'Hello po, about po sa dorm.', '2024-07-23 00:33:53', 1, NULL),
('k5KN7gMB', 'VRXeYGfr', 'bVJ9UgMG', 'Available pa po ba? Magkano po per month and ano po inclusions?', '2024-08-21 08:20:23', 0, NULL),
('KGDedZtU', 'igL7WPhF', 'VCMyBty9', 'Hello po, about po sa dorm.', '2024-07-23 12:55:32', 1, NULL),
('KjLt8vhD', '6D4SEyEE', 'dBdtuoR6', 'per floor*', '2024-07-24 09:24:26', 1, NULL),
('KqKAQWCP', 'flFR5aVH', 'GPqavwEJ', 'Hello po how many vacant slots are open pa po?', '2024-08-01 15:53:59', 0, NULL),
('KScNedqF', '4PxCA5mQ', '37lCi8yH', 'Good Day! for female occupants lang po,salamat', '2024-07-24 08:20:09', 0, NULL),
('KsX9DcDn', 'VRXeYGfr', '6D4SEyEE', 'Magkano po per month? And ano po inclusions?', '2024-07-24 11:31:17', 1, NULL),
('KTKObxEg', 'igL7WPhF', 'GPqavwEJ', 'Magkano po ang rent?', '2024-07-24 09:36:19', 1, NULL),
('KXnNsGXJ', 'igL7WPhF', 'VCMyBty9', 'Hello po, about po sa dorm.', '2024-07-23 13:13:36', 1, NULL),
('LDpyIJxF', 'igL7WPhF', 'VCMyBty9', 'Hello po, about po sa dorm.', '2024-07-23 00:35:03', 1, NULL),
('lIbSBzG5', 'CYUDIHQ7', 'VCMyBty9', 'Hello good evening po, how much po sa rent and can I ask for your facebook account po. Thank you.', '2024-08-29 15:18:20', 0, NULL),
('ltoI7Z3C', 'MjYM3WVA', 'B2fdW3f4', 'Good evening po! Interested po kami na mag inquire sa dorm nyo. Magkano po kaya monthly and ano po mga included? Tatlo po sana kaming uupa, incoming college students po ng SLSU LUCBAN. Please reply asap, thank you.', '2024-07-24 11:22:27', 1, NULL),
('lYjvA7Bg', '6D4SEyEE', 'dBdtuoR6', '1,400 per month po, kasama na po ang tubig, wifi & electricity ', '2024-07-24 08:11:58', 1, NULL),
('MbXXvOLM', 'zmOUH7ln', 'VCMyBty9', 'How much po ang monthly?', '2024-07-23 10:39:27', 1, NULL),
('md5XZgp5', 'CYUDIHQ7', 'VCMyBty9', 'Hello good evening po, how much po sa rent and can I ask for your facebook account po. Thank you.', '2024-08-29 15:09:49', 0, NULL),
('Mmvp3ZvI', 'dBdtuoR6', '6D4SEyEE', 'Ilan po kayang minuto pag lalakadin po pa school? ', '2024-07-24 08:59:22', 1, NULL),
('mpbV3Jne', '37lCi8yH', '4PxCA5mQ', 'Available po ba for male border kung available po magkano thank you po', '2024-07-22 05:23:18', 1, NULL),
('Mrdxj7Ia', '6D4SEyEE', 'dBdtuoR6', 'wala po kasamang foam ', '2024-07-24 09:21:24', 1, NULL),
('MUtuQUag', '6D4SEyEE', 'dBdtuoR6', 'yung boarding house po ay sa may likod ng lavander malapit lang sa SLSU', '2024-07-24 08:12:29', 1, NULL),
('Mxd2WdK4', 'Gt9Rnxko', '4PxCA5mQ', 'Hello po, may available po kayong solo room? If meron po, magkano po sana?', '2024-08-05 00:44:05', 1, NULL),
('N5xQKsom', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:40', 0, NULL),
('NBFbHptb', '6D4SEyEE', 'dBdtuoR6', 'Call po muna kay mam Valentina for confirmation po ng booking. Salamat', '2024-07-25 02:30:43', 1, NULL),
('nC9ShSVT', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:44', 0, NULL),
('ncP9zTSj', 'CYUDIHQ7', 'B2fdW3f4', 'hello po, hm po ang rent?', '2024-08-29 07:29:37', 0, NULL),
('NirntLOn', 'igL7WPhF', 'VCMyBty9', 'Good morning po! About po sa dorm', '2024-07-23 00:26:00', 1, NULL),
('nzX87AhI', 'igL7WPhF', '4PxCA5mQ', 'Hello po, available pa po ba ang bedspace? Magkano po? ', '2024-07-29 08:34:11', 1, NULL),
('O7afIOzH', 'MjYM3WVA', '6D4SEyEE', 'Hello po! Gusto po sana namin mag inquire ng mga kasama ko sa dormitory nyo, pwede po kaya makahing ng karagdagang picture sa loob ng dorm? Tsaka pakibanggit na din po ng kasama sa babayaran at magkano lahat. Incoming slsu student po ito.', '2024-07-24 10:39:29', 1, NULL),
('O8IS6DnG', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:39', 0, NULL),
('OBMfvqxK', 'dBdtuoR6', '6D4SEyEE', 'Hello po, ask kolang po sana if magkano po ang rent? Thankupo', '2024-07-24 06:35:22', 1, NULL),
('OnG7YGEE', '6ZjowKgU', 'bVJ9UgMG', 'Available pa po ba ang room?', '2024-08-02 13:04:41', 1, NULL),
('OwbBwRqL', '4PxCA5mQ', 'Gt9Rnxko', 'may available pa po na bed pero may kasama po sa room', '2024-08-05 07:44:45', 1, NULL),
('p8Uz3dtP', '6D4SEyEE', 'dBdtuoR6', 'sigii po, pwede nyo po ako tawagan sa number ko kapag gusto nyo macheck ang apartment', '2024-07-24 09:24:06', 1, NULL),
('pku4Pute', 'igL7WPhF', '4PxCA5mQ', 'Maâ€™am, Iâ€™ve sent you messages sa messenger po. Need ko po kase maka-hanap ng dorm bago mag pasukan. Salamat po!', '2024-08-03 08:32:35', 1, NULL),
('PvtHcn6M', 'dBdtuoR6', '6D4SEyEE', 'May foam po yan maam? San pong pandayan? Bookshop po? ', '2024-07-24 09:19:43', 1, NULL),
('PwNs8TPB', '4PxCA5mQ', 'eOeGpg0b', 'Good Day! for female occupants lang po,salamat', '2024-07-24 08:20:17', 0, NULL),
('pZIcZUtv', 'dBdtuoR6', '6D4SEyEE', 'Ay maam tatlo lang pi kasi kami pede po kayang i occupy ang apatan? ', '2024-07-24 09:23:55', 1, NULL),
('Q3lhtIbl', 'CYUDIHQ7', 'VCMyBty9', 'Hello po, hm po ang rent?', '2024-08-29 04:46:01', 0, NULL),
('QHhJPZjz', '6D4SEyEE', 'dBdtuoR6', 'kaniya kaniya na po yun', '2024-07-24 09:21:30', 1, NULL),
('qPBFPZku', 'Lx0Zy8Wn', 'Pyz0zh3C', 'fgtshtbgdf', '2024-07-22 06:36:08', 0, NULL),
('qpQrajw5', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:21:00', 1, NULL),
('qPtca9eW', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:46', 0, NULL),
('QRWXvLuA', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:40', 0, NULL),
('qTXTUQKW', 'VRXeYGfr', '6D4SEyEE', 'Available pa po ba?', '2024-08-21 07:58:57', 0, NULL),
('r1qNCpIZ', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:21:03', 1, NULL),
('RbWlsffy', '6D4SEyEE', 'Gt9Rnxko', '1500 per month po', '2024-08-06 05:28:40', 1, NULL),
('rEBFtuEL', 'B2fdW3f4', 'dBdtuoR6', 'salamat', '2024-07-24 08:16:38', 1, NULL),
('rFVSvUqW', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:21:01', 1, NULL),
('RNLg9m2Q', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:17:38', 1, NULL),
('s27kae5p', '37lCi8yH', 'bVJ9UgMG', 'Available po ba sa male boarder and kung available po magkano thank you po', '2024-07-22 05:25:38', 1, NULL),
('saGTtbs4', '6D4SEyEE', 'dBdtuoR6', '09662755379 Valentina', '2024-07-24 09:27:10', 1, NULL),
('siQOgGv2', 'dBdtuoR6', '6D4SEyEE', 'Ano po yun maam double deck po? ', '2024-07-24 09:21:45', 1, NULL),
('sljKS3q5', 'uTA8Cl3I', 'GPqavwEJ', 'Ask ko lang po kung magkano po monthly ', '2024-07-23 06:27:18', 1, NULL),
('sROtWGJ8', 'GPqavwEJ', 'igL7WPhF', '2k monthly, kasama na po ang kuryente, tubig, wifi, double deck with foam at lockers. ', '2024-07-25 05:04:14', 1, NULL),
('t2dqU2bj', 'dBdtuoR6', '6D4SEyEE', 'Per room naman po ay may cr? ', '2024-07-24 09:24:07', 1, NULL),
('tbms7pjx', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:17:43', 1, NULL),
('ThE5ia60', 'CYUDIHQ7', '6D4SEyEE', 'hello po, hm po ang rent?', '2024-08-29 06:55:31', 0, NULL),
('TI0Urd8z', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:43', 0, NULL),
('TnQQKMrq', '6D4SEyEE', 'MjYM3WVA', '1400 per nonth kasama na tubig, wifi and electricity. Pero kanya kanyang provide po ng bed foam', '2024-07-25 02:04:46', 0, NULL),
('TqcmyA2K', '6D4SEyEE', 'dBdtuoR6', '3-5 minutes po', '2024-07-24 09:11:17', 1, NULL),
('TrKePYfz', '6D4SEyEE', 'VRXeYGfr', '1400 per month kasama na water, wifi and electricity pero kanya kanyang provide po ng bed foam.', '2024-07-25 02:05:50', 1, NULL),
('twt9sJdr', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:21:08', 1, NULL),
('TXoovYMV', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:35', 0, NULL),
('tXutfkRJ', 'zmOUH7ln', 'VCMyBty9', 'How much po this dorm?', '2024-07-23 09:05:10', 1, NULL),
('UAhe044f', 'fRLHPxW8', 'Pyz0zh3C', 'asd', '2024-07-21 11:24:16', 1, NULL),
('UELfQ54v', '6D4SEyEE', 'Gt9Rnxko', 'may wifi,electricity,at tubig na rin po', '2024-08-06 05:28:56', 1, NULL),
('uItcB9Zb', 'xqO9pNQZ', '4PxCA5mQ', 'Hello po?', '2024-07-30 04:24:08', 1, NULL),
('Ulq7qo9F', '6D4SEyEE', 'dBdtuoR6', 'malapit po kami sa school', '2024-07-24 09:22:12', 1, NULL),
('UPE1lRnn', 'CYUDIHQ7', 'B2fdW3f4', 'Good evening po, how much po ang rent?\r\n', '2024-08-29 15:20:39', 0, NULL),
('UrtnypVo', 'VCMyBty9', 'zmOUH7ln', 'Hi Sir! for female occupants po ito,salamat', '2024-07-24 08:14:28', 0, NULL),
('uY47PEym', '6D4SEyEE', 'dBdtuoR6', 'pwede nyo po ako tawagan sa number para po masagot ko lahat ng tanong nyo', '2024-07-24 09:26:36', 1, NULL),
('UZlRq186', 'B2fdW3f4', 'dBdtuoR6', 'Pear\'s boarding house po ang name', '2024-07-24 08:16:36', 1, NULL),
('vk6w0wCs', '4PxCA5mQ', 'Gt9Rnxko', 'dory oblefias po ', '2024-08-08 06:07:29', 1, NULL),
('vmJJlDTx', 'Gt9Rnxko', '6D4SEyEE', 'Good Morning po, May I ask po if meron pa pong available room or bed space po? and how much po sana?', '2024-08-05 09:09:42', 1, NULL),
('w2EGLJ42', 'xqO9pNQZ', 'GPqavwEJ', 'hello po ask kolang po if magkano monthly?\r\n', '2024-07-29 03:25:34', 0, NULL),
('W3hXKRLV', 'B2fdW3f4', 'dBdtuoR6', 'Mga 10 mins. po pag lakad pa slsu po. Salamat po', '2024-07-24 10:58:31', 1, NULL),
('wGAd1wxc', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:21:09', 1, NULL),
('wl8NKdTd', 'dBdtuoR6', '6D4SEyEE', 'Ay ayun thankupo ', '2024-07-24 09:23:33', 1, NULL),
('wRYdbVjy', 'Gt9Rnxko', '4PxCA5mQ', 'Pede po mahingi fb nyo po??', '2024-08-06 06:14:47', 1, NULL),
('WXWRvEvq', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:20:54', 1, NULL),
('x8oB7GYD', 'VRXeYGfr', 'VCMyBty9', 'Magkano po per month and ano-ano po inclusions?', '2024-08-21 08:05:53', 0, NULL),
('xe5h8u42', '6D4SEyEE', 'dBdtuoR6', 'iisa lang po pandayan, DIY po ung nasa JOllibee', '2024-07-24 09:22:48', 1, NULL),
('Xjavc58U', 'dBdtuoR6', '6D4SEyEE', 'Edi isang cr lang po kada floor? May ilang room po sa isang floor? ', '2024-07-24 09:24:56', 1, NULL),
('XmbNgxgB', '6D4SEyEE', 'dBdtuoR6', 'kaso kapag pang apatan po un for 4 ang babayaran', '2024-07-24 09:26:07', 1, NULL),
('Y1uPj7zh', '6D4SEyEE', 'Gt9Rnxko', '1400*', '2024-08-06 05:30:16', 1, NULL),
('YbEQKOAf', 'bW26Kl2S', '6D4SEyEE', 'Hello po', '2024-07-22 04:30:15', 1, NULL),
('ycMPL5to', 'bVJ9UgMG', '6ZjowKgU', 'taas na lng po ng double deck ang available', '2024-08-04 12:44:50', 0, NULL),
('Z203lE58', 'bVJ9UgMG', '37lCi8yH', 'female lang po kami', '2024-07-22 05:50:40', 0, NULL),
('z2br5KQW', '6D4SEyEE', 'dBdtuoR6', 'salamat po', '2024-07-24 09:28:15', 1, NULL),
('Z2rQSz14', '4PxCA5mQ', 'LnPvC9ID', 'may CR na rin po at kitchen', '2024-08-06 05:35:18', 0, NULL),
('ZcsvE1oF', 'dBdtuoR6', 'B2fdW3f4', 'Hello po, ask kolang po if magkano po ang rent? ', '2024-07-24 07:42:59', 1, NULL),
('zdGxODck', 'dBdtuoR6', '6D4SEyEE', 'Ang wifi po ay isang gadget lang po? ', '2024-07-24 09:24:34', 1, NULL),
('ZPMWW3Lj', 'igL7WPhF', 'VCMyBty9', 'About po sa dorm, magkano po?', '2024-07-23 05:20:59', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `NotifID` varchar(255) NOT NULL,
  `Message` varchar(255) DEFAULT NULL,
  `Time_stamp` varchar(255) DEFAULT NULL,
  `AccountID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`NotifID`, `Message`, `Time_stamp`, `AccountID`) VALUES
('3YpL2wAJ', 'Dear Klariz Joy Ortiz,\r\n\r\n        We are pleased to inform you that your booking has been accepted! Your room is now ready for check-in. Please proceed to the property at your earliest convenience.\r\n        \r\n        Thank you for choosing our services. W', '2024-07-31 02:26:55', 'dBdtuoR6'),
('EnmTuGP2', 'Dear Maria Elaine Marculita Bon,\r\n\r\n        We are pleased to inform you that your booking has been accepted! Your room is now ready for check-in. Please proceed to the property at your earliest convenience.\r\n        \r\n        Thank you for choosing our s', '2024-08-13 05:04:57', 'Gt9Rnxko');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `OwnerID` varchar(255) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `ContNum` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `L_Name` varchar(255) DEFAULT NULL,
  `L_Email` varchar(255) DEFAULT NULL,
  `L_Num` varchar(255) DEFAULT NULL,
  `AccountID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`OwnerID`, `FullName`, `ContNum`, `Address`, `Email`, `L_Name`, `L_Email`, `L_Num`, `AccountID`) VALUES
('04Cqemkc', 'Escelle Janece Deapera Magnaye', '09085529996', 'JEM Bldg. Irene St.', 'ellecse@yahoo.com', 'Escelle Janece Magnaye', 'ellecse@yahoo.com', '0908 552 9996', 'bVJ9UgMG'),
('40Q5oGfW', 'Karen dealino', '09173047447', 'Quirino st mira monte subdivision', 'Ktdealino@gmail.com', '', '', '', 'k71SiU9G'),
('6NjUasSm', 'Jhalmar Perez Castillo ', '09706614851', 'Miramonte Subdivision Brgy. Tinamnam Lucban Quezon ', 'jhalmarcastillo@gmail.com', 'Richmon Calubayan Oliveros ', 'oliveros.richmon@gmail.com', '09706614851', 'gtb3vvf8'),
('83OpHArs', 'Valentina Cube', '09297635337', 'Racelis St.Barangay 2 Lucban, Quezon', '.', '', '', '', '6D4SEyEE'),
('92WC22xn', 'Sheila Pabella Tanaka', '0922-840-6920', 'Miramonte circle Brgy.Tinamnan Lucban Wuezon', 'sheila_tanaka@yahoo.com', 'Irene Villanueva ', '.', '.', 'VCMyBty9'),
('bL01YVeg', 'Dory Oblefias', '09301335356', 'Yrene st., brgy tinamnam miramonte subdivision lucban quezon', 'doryoblefias@gmail.com', '', '', '', '4PxCA5mQ'),
('DIWSK92S', 'Girlie', '09477403030', '9018 Miramonte Subdivision Lucban Quezon', 'girlie04@gmail.com', '', '', '', 'V4BqfApB'),
('FlfiC8Cv', 'Redentor Datinguinoo', '09478435763', 'Belmar St. Miramonte Subd. Brgy. Tinamnan Lucban Quezon', 'jared_0522@yahoo.com', '', '', '', 'm0QXx2pA'),
('kvTYkuxy', 'Teresita C. Comia', '09688536449', 'Miramonte Sub Circle (kanan) L Q.', 'comiatessie1227@gmail .com', '', '', '', 'nHeX7SLL'),
('nohdGjVO', 'Lorna Advincula Quevedo', '09202279900', 'Quirino cor Irene St. Brgy. Tinamnam Lucban, Quezon', 'quevedolorna@yahoo.com', '', '', '', 'BSgHwKy9'),
('NsA94zk7', 'Owner 2', '09172833518', 'Brgy. 1 Lucban Quezon', 'len@gmail.com', '', '', '', 'vOoGseIn'),
('rLm5KlGF', 'Criselda Abuel', '3626', 'Balintawak St. Barangay 10 Lucban Quezon', '.', 'Catherine ValeÃ±a', 'catherinevalena3@gmail.com', '09281568159', 'B2fdW3f4'),
('thgEZwR7', 'Vanne Christian Del Mundo Astrera', '09706614851', 'Brgy. Tinamnam Miramonte Subdivision Lucban, Quezon', 'vannechristianastrera@gmail.com', 'Richmon Calubayan Oliveros', 'oliveros.richmon@gmail.com', '09706614851', 'GPqavwEJ'),
('tUR4Gkwt', 'Dory Noriel', '09301335356', 'Yrene st.brgy tinamnan miramonte lucban Quezon', 'dory@gmail.com', '', '', '', 'MsaJFUT7'),
('u6n7mloy', 'Justina O. Quevedo', '09696333848', 'Yrene Street. Miramonte Subd. Brgy. Tinamnan', 'justinaquevedo34@gmail.com', '', '', '', 'EmEcAQjm'),
('YwUh9rwS', 'Owner 1', '09213674812', 'owner1', 'owner1@gmail.com', '', '', '', 'Pyz0zh3C'),
('zCJbzQKZ', 'Teresita C. Comia', '09688536449', 'Miramonte Subd Circle(kanan) L. Q.', 'comiatessie1227@gmail.com', '', '', '', 'WSHNvpnF');

-- --------------------------------------------------------

--
-- Table structure for table `permit`
--

CREATE TABLE `permit` (
  `FileID` varchar(255) NOT NULL,
  `File_Name` varchar(255) DEFAULT NULL,
  `File_Type` varchar(255) DEFAULT NULL,
  `File_Path` varchar(255) DEFAULT NULL,
  `OwnerID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permit`
--

INSERT INTO `permit` (`FileID`, `File_Name`, `File_Type`, `File_Path`, `OwnerID`) VALUES
('3iMJnFMV', 'Screenshot_20240719_182428_Messenger.jpg', 'image/jpeg', '../permits/YwUh9rwS/669b31ffe3d6b_Screenshot_20240719_182428_Messenger.jpg', 'YwUh9rwS'),
('3Kl1eSyx', '17214493925046710281542761011199.jpg', 'image/jpeg', '../permits/nohdGjVO/669b3bc746ad1_17214493925046710281542761011199.jpg', 'nohdGjVO'),
('4Sojdok0', 'inbound1932548748196996964.jpg', 'image/jpeg', '../permits/kvTYkuxy/66988f2f87c67_inbound1932548748196996964.jpg', 'kvTYkuxy'),
('9T9RfKkG', 'IMG_1122.jpeg', 'image/jpeg', '../permits/83OpHArs/6699f22ec64af_IMG_1122.jpeg', '83OpHArs'),
('beNeIYPM', 'inbound6278483920846844219.jpg', 'image/jpeg', '../permits/6NjUasSm/669b59795746c_inbound6278483920846844219.jpg', '6NjUasSm'),
('de9AjxKV', 'inbound2379556772895349354.jpg', 'image/jpeg', '../permits/zCJbzQKZ/66988fdcdc413_inbound2379556772895349354.jpg', 'zCJbzQKZ'),
('H1X3k84x', 'mayors permit.jpeg', 'image/jpeg', '../permits/04Cqemkc/669b4a590fb20_mayors permit.jpeg', '04Cqemkc'),
('I5Dk5C7O', '17214445592495779727537349680122.jpg', 'image/jpeg', '../permits/rLm5KlGF/669b28e373024_17214445592495779727537349680122.jpg', 'rLm5KlGF'),
('JaHnuBaX', 'inbound3521640732612358506.jpg', 'image/jpeg', '../permits/DIWSK92S/6698763257d34_inbound3521640732612358506.jpg', 'DIWSK92S'),
('nYxU22NP', 'inbound3728219607074508985.jpg', 'image/jpeg', '../permits/bL01YVeg/6698a1ba96fa8_inbound3728219607074508985.jpg', 'bL01YVeg'),
('pDW8r3Qi', 'IMG_4743.jpeg', 'image/jpeg', '../permits/FlfiC8Cv/6698821b075ff_IMG_4743.jpeg', 'FlfiC8Cv'),
('U7XEScD7', 'inbound4090845409129423701.jpg', 'image/jpeg', '../permits/thgEZwR7/669b57a8a221f_inbound4090845409129423701.jpg', 'thgEZwR7'),
('UbFQB5UQ', 'IMG_2333.jpeg', 'image/jpeg', '../permits/92WC22xn/669a20805a8cf_IMG_2333.jpeg', '92WC22xn'),
('ygjcz0Lc', 'inbound8108021560349749540.jpg', 'image/jpeg', '../permits/u6n7mloy/66989af0dc446_inbound8108021560349749540.jpg', 'u6n7mloy');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `PropertyID` varchar(255) NOT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `Location` varchar(1000) DEFAULT NULL,
  `Total_Room` int(11) DEFAULT NULL,
  `ImgURL` varchar(10000) DEFAULT NULL,
  `OwnerID` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`PropertyID`, `Type`, `Category`, `Location`, `Total_Room`, `ImgURL`, `OwnerID`, `Description`) VALUES
('5AZKnWZS', 'dormitory', 'Female', 'Miramonte, Tinamnan, Lucban, Calabarzon, 4328, Philippines', 1, '../gallery/04Cqemkc/05.jpeg,../gallery/04Cqemkc/04.jpg,../gallery/04Cqemkc/02.jpg,../gallery/04Cqemkc/01.jpg', '04Cqemkc', NULL),
('69fUzWvd', 'dormitory', 'Female', 'Armando Racellis Avenue, Miramonte, Tinamnan, Lucban, Calabarzon, 4328, Philippines', 3, '../gallery/83OpHArs/669d952c2fa64_451409774_474729085278139_5780811388717075494_n.jpg', '83OpHArs', 'Cube\'s Boarding House\r\n\r\nWith WiFi\r\nElectricity\r\nWater\r\n3-5 mins. away from SLSU\r\n'),
('8JSvzw7E', 'dormitory', 'Both', 'Yakal Street, Ibabang Iyam, Lucena, 2nd District, Calabarzon, 4301, Philippines', 3, '../gallery/YwUh9rwS/66951e7fd84e5_Purple and Green Colorful Marathon Run Sports Event Poster_20231018_170721_0000 (1).png,../gallery/YwUh9rwS/66951e8033b90_PXL_20231117_010819189 (1).jpg,../gallery/YwUh9rwS/66951e80bab73_PXL_20231117_010801018 (1).jpg,../gallery/YwUh9rwS/66951e813d86c_PXL_20231117_010733107 (1).jpg', 'YwUh9rwS', 'aaaa'),
('A5CFdcbl', 'dormitory', 'Female', 'Eleazar Street, Miramonte, Tinamnan, Lucban, Calabarzon, 4328, Philippines', 1, '../gallery/92WC22xn/669c84e0734e3_IMG_2334.JPG,../gallery/92WC22xn/669c84e0e9d59_IMG_2336.JPG,../gallery/92WC22xn/669c84e147b1e_IMG_2337.JPG', '92WC22xn', 'air-conditioned\r\nwith laundry shop'),
('GyHmylQ8', 'dormitory', 'Female', 'Eleazar Street, Miramonte, Tinamnan, Lucban, Calabarzon, 4328, Philippines', 2, '../gallery/92WC22xn/669c85c51c6cd_IMG_1257.JPG,../gallery/92WC22xn/669c85c586373_IMG_2339.JPG,../gallery/92WC22xn/669c85c5e5f87_IMG_2340.JPG,../gallery/92WC22xn/669c85c63bf75_IMG_2341.JPG', '92WC22xn', 'air-conditioned'),
('IqfLarf3', 'dormitory', 'Female', 'Eleazar Street, Miramonte, Tinamnan, Lucban, Calabarzon, 4328, Philippines', 2, '../gallery/92WC22xn/669c8689c1f16_IMG_1257.JPG,../gallery/92WC22xn/669c868a38548_IMG_2342.JPG,../gallery/92WC22xn/669c868aa3894_IMG_2344.JPG,../gallery/92WC22xn/669c868ad63ba_IMG_2345.JPG', '92WC22xn', 'air-conditioned\r\nwith laundry shop'),
('n5VWqDDY', 'dormitory', 'Male', 'Tayabas - Lucban Road, Miramonte, Tinamnan, Lucban, Quezon, Calabarzon, 4328, Philippines', 1, '../gallery/thgEZwR7/669c7bb85fcd8_FB_IMG_1721531000592.jpg,../gallery/thgEZwR7/669c7bb860569_FB_IMG_1721530993566.jpg,../gallery/thgEZwR7/669c7bb860a77_FB_IMG_1721530986827.jpg,../gallery/thgEZwR7/669c7bb860efe_FB_IMG_1721530981324.jpg,../gallery/thgEZwR7/669c7bb861318_FB_IMG_1721530978916.jpg,../gallery/thgEZwR7/669c7bb861741_FB_IMG_1721530970994.jpg,../gallery/thgEZwR7/669c7bb861b50_FB_IMG_1721530976416.jpg,../gallery/thgEZwR7/669c7bb861fe3_FB_IMG_1721530968410.jpg,../gallery/thgEZwR7/669c7bb862463_FB_IMG_1721530965955.jpg,../gallery/thgEZwR7/669c7bb8628aa_FB_IMG_1721530959289.jpg,../gallery/thgEZwR7/669c7bb862cec_FB_IMG_1721530963002.jpg,../gallery/thgEZwR7/669c7bb86318c_FB_IMG_1721530955023.jpg,../gallery/thgEZwR7/669c7bb8636b4_FB_IMG_1721530948718.jpg', 'thgEZwR7', NULL),
('Qe6KZwLw', 'dormitory', 'Female', 'Abcede\'s Resto, Balintawak Street, Gamzat, Tinamnan, Lucban, Calabarzon, 4328, Philippines', 3, '../gallery/rLm5KlGF/669c9c54bb8c8_IMG_1241.JPG', 'rLm5KlGF', 'With WiFi\r\nCCTV\r\nLaundry Area\r\nStudy Area\r\n5-10 mins away from SLSU'),
('QfOmYx9s', 'dormitory', 'Female', 'Abcede\'s Resto, Balintawak Street, Gamzat, Tinamnan, Lucban, Calabarzon, 4328, Philippines', 3, '../gallery/rLm5KlGF/669c9e2fac734_IMG_1193.JPG,../gallery/rLm5KlGF/669c9e30184cb_IMG_1205.JPG,../gallery/rLm5KlGF/669c9e30608b5_IMG_1206.JPG,../gallery/rLm5KlGF/669c9e30b09ff_IMG_1207.JPG,../gallery/rLm5KlGF/669c9e311a443_IMG_1208.JPG,../gallery/rLm5KlGF/669c9e3145293_IMG_1209 2.JPG,../gallery/rLm5KlGF/669c9e3170236_IMG_1210 2.JPG,../gallery/rLm5KlGF/669c9e31a4df1_IMG_1211.JPG,../gallery/rLm5KlGF/669c9e31dfce5_IMG_1212.JPG,../gallery/rLm5KlGF/669c9e3210a6f_IMG_1214.JPG,../gallery/rLm5KlGF/669c9e3258b85_IMG_1216.JPG,../gallery/rLm5KlGF/669c9e3281b67_IMG_1217.JPG,../gallery/rLm5KlGF/669c9e32ba5eb_IMG_1218.JPG,../gallery/rLm5KlGF/669c9e331269c_IMG_1219.JPG,../gallery/rLm5KlGF/669c9e335e96a_IMG_1220.JPG,../gallery/rLm5KlGF/669c9e33ba618_IMG_1221.JPG', 'rLm5KlGF', 'With WiFi\r\nCCTV\r\nLaundry Area\r\nStudy Area\r\n5-10 mins away from SLSU'),
('spcSk6Bt', 'dormitory', 'Female', 'Abcede\'s Resto, Balintawak Street, Gamzat, Tinamnan, Lucban, Calabarzon, 4328, Philippines', 3, '../gallery/rLm5KlGF/669cb3bb830fd_IMG_1239.JPG', 'rLm5KlGF', 'With WiFi\r\nCCTV\r\nLaundry Area\r\nStudy Area\r\n5-10 mins away from SLSU');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` varchar(255) NOT NULL,
  `Review` varchar(5000) DEFAULT NULL,
  `RevDate` varchar(255) DEFAULT NULL,
  `PropertyID` varchar(255) DEFAULT NULL,
  `BoarderID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomID` varchar(255) NOT NULL,
  `Room_Flr` varchar(255) DEFAULT NULL,
  `Room_No` varchar(255) DEFAULT NULL,
  `Bed` varchar(255) DEFAULT NULL,
  `Kitchen` varchar(255) DEFAULT NULL,
  `Liv_Room` varchar(255) DEFAULT NULL,
  `Rest_Room` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `PropertyID` varchar(255) DEFAULT NULL,
  `OwnerID` varchar(255) DEFAULT NULL,
  `BoarderID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomID`, `Room_Flr`, `Room_No`, `Bed`, `Kitchen`, `Liv_Room`, `Rest_Room`, `Status`, `PropertyID`, `OwnerID`, `BoarderID`) VALUES
('2CFnOqHr', '2', '21', '1', '1', '1', '1', 'Vacant', 'QfOmYx9s', 'rLm5KlGF', NULL),
('8WY2R4vB', '2', '1', '1', '1', '1', '1', 'Vacant', 'GyHmylQ8', '92WC22xn', NULL),
('aKAmlj1B', 'Groundfloor ', '1', '6', '2', '0', '1', 'Vacant', 'n5VWqDDY', 'thgEZwR7', NULL),
('bfUl6Gl4', '3', '32', '2', '1', '1', '4', 'Vacant', 'spcSk6Bt', 'rLm5KlGF', NULL),
('Bn32f9Rx', '1', '14', '2', '', '', '1', 'Vacant', 'Qe6KZwLw', 'rLm5KlGF', NULL),
('F4MRshWC', '3', '34', '2', '', '', '4', 'Vacant', 'spcSk6Bt', 'rLm5KlGF', NULL),
('iyG0k7aR', '1', '12', '1', '1', '1', '1', 'Vacant', '8JSvzw7E', 'YwUh9rwS', 'exzvUXi0'),
('J3qbTV9h', '3', '31', '4', '', '', '4', 'Vacant', 'spcSk6Bt', 'rLm5KlGF', NULL),
('jIHw6Nb5', '3', '1', '3', '1', '1', '1', 'Vacant', '69fUzWvd', '83OpHArs', NULL),
('LWO2F6Ia', '1', '12', '2', '', '', '1', 'Vacant', 'Qe6KZwLw', 'rLm5KlGF', NULL),
('MesloniF', '2', '1', '1', '1', '1', '1', 'Vacant', 'GyHmylQ8', '92WC22xn', NULL),
('N85sA8hA', '2', '22', '1', '', '', '1', 'Vacant', 'QfOmYx9s', 'rLm5KlGF', NULL),
('NkFuBJxh', '3', '1', '1', '1', '1', '1', 'Vacant', 'IqfLarf3', '92WC22xn', NULL),
('NoMJcMOr', '2', '1', '4', '1', '1', '1', 'Booked', '69fUzWvd', '83OpHArs', 'ESUWkCj7'),
('nVD0C6wx', '1', '1', '1', '1', '1', '1', 'Vacant', 'A5CFdcbl', '92WC22xn', NULL),
('o8lLehul', '3', '1', '1', '1', '1', '1', 'Vacant', 'IqfLarf3', '92WC22xn', NULL),
('OpxSJ0ke', '3', '1', '6', '1', '1', '1', 'Booked', '69fUzWvd', '83OpHArs', 'JTHuXtFU'),
('tETaYWR5', '1', '2', '1', '1', '1', '1', 'Vacant', '8JSvzw7E', 'YwUh9rwS', NULL),
('vpPfY8FQ', '2', '23', '1', '', '', '1', 'Vacant', 'QfOmYx9s', 'rLm5KlGF', NULL),
('W9wB7EOO', '1', 'A1', '1', '1', '0', '2', 'Vacant', '5AZKnWZS', '04Cqemkc', NULL),
('XCeMFCEF', '1', '13', '2', '1', '1', '1', 'Vacant', 'Qe6KZwLw', 'rLm5KlGF', NULL),
('YqJQiDBv', '1', '1', '1', '1', '1', '1', 'Vacant', '8JSvzw7E', 'YwUh9rwS', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD KEY `AccountID` (`AccountID`);

--
-- Indexes for table `boarder`
--
ALTER TABLE `boarder`
  ADD PRIMARY KEY (`BoarderID`),
  ADD KEY `AccountID` (`AccountID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `RoomID` (`RoomID`),
  ADD KEY `PropertyID` (`PropertyID`),
  ADD KEY `BoarderID` (`BoarderID`),
  ADD KEY `FK_OwnerID` (`OwnerID`);

--
-- Indexes for table `book_log`
--
ALTER TABLE `book_log`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `RoomID` (`RoomID`),
  ADD KEY `PropertyID` (`PropertyID`),
  ADD KEY `BoarderID` (`BoarderID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`InfoID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `SenderID` (`SenderID`),
  ADD KEY `ReceiverID` (`ReceiverID`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`NotifID`),
  ADD KEY `AccountID` (`AccountID`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`OwnerID`),
  ADD KEY `AccountID` (`AccountID`);

--
-- Indexes for table `permit`
--
ALTER TABLE `permit`
  ADD PRIMARY KEY (`FileID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`PropertyID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `PropertyID` (`PropertyID`),
  ADD KEY `BoarderID` (`BoarderID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomID`),
  ADD KEY `PropertyID` (`PropertyID`),
  ADD KEY `OwnerID` (`OwnerID`),
  ADD KEY `fk_boarder` (`BoarderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `InfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `account` (`AccountID`);

--
-- Constraints for table `boarder`
--
ALTER TABLE `boarder`
  ADD CONSTRAINT `boarder_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `account` (`AccountID`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_OwnerID` FOREIGN KEY (`OwnerID`) REFERENCES `owner` (`OwnerID`),
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`PropertyID`) REFERENCES `property` (`PropertyID`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`BoarderID`) REFERENCES `boarder` (`BoarderID`);

--
-- Constraints for table `book_log`
--
ALTER TABLE `book_log`
  ADD CONSTRAINT `book_log_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`),
  ADD CONSTRAINT `book_log_ibfk_2` FOREIGN KEY (`PropertyID`) REFERENCES `property` (`PropertyID`),
  ADD CONSTRAINT `book_log_ibfk_3` FOREIGN KEY (`BoarderID`) REFERENCES `boarder` (`BoarderID`),
  ADD CONSTRAINT `book_log_ibfk_4` FOREIGN KEY (`OwnerID`) REFERENCES `owner` (`OwnerID`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`SenderID`) REFERENCES `account` (`AccountID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ReceiverID`) REFERENCES `account` (`AccountID`);

--
-- Constraints for table `notif`
--
ALTER TABLE `notif`
  ADD CONSTRAINT `notif_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `account` (`AccountID`);

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `account` (`AccountID`);

--
-- Constraints for table `permit`
--
ALTER TABLE `permit`
  ADD CONSTRAINT `permit_ibfk_1` FOREIGN KEY (`OwnerID`) REFERENCES `owner` (`OwnerID`);

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`OwnerID`) REFERENCES `owner` (`OwnerID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`PropertyID`) REFERENCES `property` (`PropertyID`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`BoarderID`) REFERENCES `boarder` (`BoarderID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_boarder` FOREIGN KEY (`BoarderID`) REFERENCES `boarder` (`BoarderID`),
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`PropertyID`) REFERENCES `property` (`PropertyID`),
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`OwnerID`) REFERENCES `owner` (`OwnerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
