-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2021 at 04:27 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinetest`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_text` varchar(255) NOT NULL,
  `correct` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `correct`) VALUES
(1, 1, 'Sydney', 0),
(2, 1, 'Melbourne', 0),
(3, 1, 'Canberra', 1),
(4, 1, 'Vancouver', 0),
(5, 1, 'Australia is a continent', 0),
(6, 2, 'Germay', 1),
(7, 2, 'United Kingdom', 0),
(8, 2, 'Italy', 1),
(9, 2, 'Holland', 0),
(10, 2, 'Spain', 0),
(11, 3, 'Hamburg', 0),
(12, 3, 'Munich', 0),
(13, 3, 'Berlin', 1),
(14, 3, 'Cologne', 0),
(15, 4, '2002', 0),
(16, 4, '1999', 1),
(17, 4, '1996', 0),
(18, 5, 'Gelsenkirchen', 0),
(19, 5, 'Rothenburg ob der Tauber', 1),
(20, 5, 'Celle', 0),
(21, 5, 'MÃ¼nster', 0),
(22, 6, '1 (English)', 0),
(23, 6, '3 (English, French, German)', 0),
(24, 6, '5 (English, French, German, Spanish, Italian)', 0),
(25, 6, '24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `display` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `display`) VALUES
(1, 'Which city is the capital of Australia', 'radio'),
(2, 'Which of the following countries are the founders of European Union?', 'checkbox'),
(3, 'What is the largest city in Germany?', 'radio'),
(4, 'When did EU countries adopt the euro?', 'option'),
(5, 'Which small German town is world-famous for its well preserved medieval city center?', 'radio'),
(6, 'How many official languages are there in the EU?', 'checkbox');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `correct_answ` int(11) NOT NULL,
  `correct_answ_user` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `taken_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `user_id`, `points`, `correct_answ`, `correct_answ_user`, `time`, `taken_at`, `updated_at`) VALUES
(1, 2, 100, 7, 7, NULL, '2021-10-20 02:16:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `score` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `is_admin`, `score`, `time`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@onlinetest.com', '$2y$10$Dac7xtFgP5yTvCLRjm6ZGu9UchA19QjtyUmZuDQmyVKQSPcYUeywm', 1, NULL, NULL, '2021-10-18 23:39:47', NULL),
(2, 'Dejan', 'Rajin', 'drajin@gmail.com', '$2y$10$KSkv5WcVJudMaFpp0tbPZeounexsppllB0kDZ8RNoQ/6ZjIcxUcy6', 0, NULL, NULL, '2021-10-19 02:48:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
