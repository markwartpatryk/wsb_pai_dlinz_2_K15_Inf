-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Cze 2023, 13:56
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wsb_register`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cities`
--

CREATE TABLE `cities` (
  `id` int(11) UNSIGNED NOT NULL,
  `state_id` int(10) UNSIGNED NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `city`) VALUES
(1, 1, 'Poznań'),
(2, 2, 'Kołobrzeg'),
(3, 3, 'Katowice');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `countries`
--

INSERT INTO `countries` (`id`, `country`) VALUES
(1, 'Polska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logi`
--

CREATE TABLE `logi` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `address_ip` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `logi`
--

INSERT INTO `logi` (`id`, `user_id`, `status`, `address_ip`, `created_at`) VALUES
(6, 3, 1, '::1', '2023-06-07 10:43:19'),
(7, 3, 1, '::1', '2023-06-07 10:44:10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `id` tinyint(4) NOT NULL,
  `role` enum('user','moderator','administrator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'user'),
(2, 'moderator'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `states`
--

INSERT INTO `states` (`id`, `country_id`, `state`) VALUES
(1, 1, 'Wielkopolskie'),
(2, 1, 'Zachodniopomorskie'),
(3, 1, 'Śląskie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `additional_email` varchar(100) DEFAULT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT 1,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `avatar` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `additional_email`, `city_id`, `role_id`, `firstName`, `lastName`, `birthday`, `gender`, `avatar`, `password`, `created_at`) VALUES
(3, 'admin@op.pl', 'admin@op.pl', 1, 3, 'Janusz', 'Nowak', '2023-05-06', 'man', '../../img/man.png', '$argon2id$v=19$m=65536,t=4,p=1$QWNYa1hFckJWdjQ5aUNzVQ$92S0kKbc2/baJRhlBg6YuiXLW61cGKCvdo+EokCbUsw', '2023-05-24 10:42:58'),
(4, 'user@op.pl', 'user@op.pl', 3, 1, 'Grzesio', 'Nowal', '2023-06-15', 'man', '../../img/man.png', '$argon2id$v=19$m=65536,t=4,p=1$MHNRcElZZDVOWTcvOTNjMQ$Vxso6vh043XX+AhKJP62PFA/uRzIXmMvFi9ldHG7wnk', '2023-06-07 09:53:29');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indeksy dla tabeli `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `logi`
--
ALTER TABLE `logi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `logi`
--
ALTER TABLE `logi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `role`
--
ALTER TABLE `role`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Ograniczenia dla tabeli `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
