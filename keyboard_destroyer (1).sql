-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 09:09 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keyboard_destroyer`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lessonmodules`
--

CREATE TABLE `lessonmodules` (
  `ModuleID` int(11) NOT NULL,
  `ModuleName` varchar(255) DEFAULT NULL,
  `DifficultyLevel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessonmodules`
--

INSERT INTO `lessonmodules` (`ModuleID`, `ModuleName`, `DifficultyLevel`) VALUES
(1, 'Module 1', 1),
(2, 'Module 2', 2),
(3, 'Module 3', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lessons`
--

CREATE TABLE `lessons` (
  `LessonID` int(11) NOT NULL,
  `ModuleID` int(11) DEFAULT NULL,
  `LessonName` varchar(255) DEFAULT NULL,
  `TextContent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`LessonID`, `ModuleID`, `LessonName`, `TextContent`) VALUES
(1, 1, 'Lesson 1', 'abcde fghij klmno'),
(2, 1, 'Lesson 2', 'pqrst uvwxy z'),
(3, 1, 'Lesson 3', '12345 67890'),
(4, 2, 'Lesson 1', 'abcdef ghijk lmnop'),
(5, 2, 'Lesson 2', 'qrst uvwxyz'),
(6, 2, 'Lesson 3', '54321 09876'),
(7, 3, 'Lesson 1', 'xyz abc def'),
(8, 3, 'Lesson 2', 'lmno pqrst uv'),
(9, 3, 'Lesson 3', '98765 43210');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `userprogress`
--

CREATE TABLE `userprogress` (
  `ProgressID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `LessonID` int(11) DEFAULT NULL,
  `CurrentModuleID` int(11) DEFAULT NULL,
  `CompletionStatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprogress`
--

INSERT INTO `userprogress` (`ProgressID`, `UserID`, `LessonID`, `CurrentModuleID`, `CompletionStatus`) VALUES
(2, 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`) VALUES
(1, 'user', 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `userstatistics`
--

CREATE TABLE `userstatistics` (
  `StatsID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `LessonID` int(11) DEFAULT NULL,
  `TypingSpeed` int(11) DEFAULT NULL,
  `WordsPerMinute` int(11) DEFAULT NULL,
  `Accuracy` float DEFAULT NULL,
  `CorrectKeyCount` int(11) DEFAULT NULL,
  `IncorrectKeyCount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userstatistics`
--

INSERT INTO `userstatistics` (`StatsID`, `UserID`, `LessonID`, `TypingSpeed`, `WordsPerMinute`, `Accuracy`, `CorrectKeyCount`, `IncorrectKeyCount`) VALUES
(1, 1, 1, 0, 0, 90, 15, 2),
(2, 1, 2, 0, 0, 85, 11, 2),
(3, 1, 3, 0, 0, 92, 10, 1),
(4, 1, 4, 0, 0, 88, 15, 3),
(5, 1, 5, 0, 0, 95, 10, 1),
(6, 1, 6, 0, 0, 80, 8, 3),
(7, 1, 7, 0, 0, 94, 10, 1),
(8, 1, 8, 0, 0, 82, 10, 3),
(9, 1, 9, 0, 0, 91, 10, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `lessonmodules`
--
ALTER TABLE `lessonmodules`
  ADD PRIMARY KEY (`ModuleID`);

--
-- Indeksy dla tabeli `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`LessonID`),
  ADD KEY `ModuleID` (`ModuleID`);

--
-- Indeksy dla tabeli `userprogress`
--
ALTER TABLE `userprogress`
  ADD PRIMARY KEY (`ProgressID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `LessonID` (`LessonID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indeksy dla tabeli `userstatistics`
--
ALTER TABLE `userstatistics`
  ADD PRIMARY KEY (`StatsID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `LessonID` (`LessonID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`ModuleID`) REFERENCES `lessonmodules` (`ModuleID`);

--
-- Constraints for table `userprogress`
--
ALTER TABLE `userprogress`
  ADD CONSTRAINT `userprogress_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `userprogress_ibfk_2` FOREIGN KEY (`LessonID`) REFERENCES `lessons` (`LessonID`);

--
-- Constraints for table `userstatistics`
--
ALTER TABLE `userstatistics`
  ADD CONSTRAINT `userstatistics_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `userstatistics_ibfk_2` FOREIGN KEY (`LessonID`) REFERENCES `lessons` (`LessonID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
