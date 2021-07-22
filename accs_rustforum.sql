-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Lip 2021, 00:01
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `accs_rustforum`
--
CREATE DATABASE IF NOT EXISTS `accs_rustforum` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `accs_rustforum`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accs_articles`
--

CREATE TABLE `accs_articles` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_polish_ci NOT NULL,
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `category` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `accs_articles`
--

INSERT INTO `accs_articles` (`id`, `title`, `content`, `category`) VALUES
(1, 'TRC is looking for more members', 'I am the Leader of the TRC clan, we are a new clan with veteran players that are looking to dominate any server we log into. if you are interested in joining then please fill out this quick questionnaire...', 'general'),
(2, 'Voice Props DLC Pack', 'This DLC pack includes a range of new items that allow you to record, stream, project and playback audio, as well as accessorize your base with some disco themed props. It also includes three new dance gestures and 7 achievements to unlock.', 'general'),
(3, 'Looking for 1 more person', 'Looking for one more to join our existing trio/quad. We range from 4 to 8k hours so we expect somone in that range. No one under the age of 18.\r\nWe play mainly vanilla and sometimes 2x.', 'general'),
(4, 'PVP RIGHT HERE - Join for instant action', '- PVP RIGHT HERE - Join for instant action\r\n- NEW PVP ARENA - NEW discord members get free vip\r\n\r\nJoin our Battlefield server for Instant action - Easy for new players.\r\nGood loot, Pvp, sethome, Bgrade, kits, No Elektricity, Pvp Arena, good commnity, Vip rank\'s for most play time, active admins to prevent cheaters', ''),
(5, 'BANG ROOM X3|PVE|Raidable Bases| [NLC]', 'Hey Guys,\r\nI did a thing and created a Modded PVE server. This is geared towards NEW players and we are a build friendly server. Enjoy Monthly Wipes, No Decay, TruePVE, Raidable Bases , X3 Gather Rates, Better Loot, Homes, Teleports , and more....\r\nServer Wipe Aug. 5th 20201', 'servers'),
(6, 'RustZ/Hardcore Survival | WIPED 7/15', 'What is Hardcore Survival? This is a server where crafting is very limited. You must find most important items in Barrels, Containers, and Bodies. It\'s a DayZ style game mode. It elevates the survival aspect, and makes items and resources much more precious. You can still harvest resources like Wood, or the occasional Ore Node you may find. Not only does this server focus on the normal PvP aspect, but it also incorporates a fun PvE aspect to the game as well. Have what it takes? Join it and try something different!', 'servers'),
(7, 'Scrap bounties', 'Essentially if you go around killing a bunch of random nakeds and people for no reason within a certain period of time you will have a scrap bounty placed on you to deter you from gunning down the whole server it also gives other players a chance to contest for bounties could be fun.', 'tips'),
(8, 'third person view', 'There already is if you\'re admin, there is never going to be a third person view for players, never! - It would let people see players hiding behind all sorts of cover. Imagine raiding, defending against a raid, counter raiding, when you can see the players hiding around corners, under the floor or behind some object for cover ready for a surprise attack, lol.', 'tips'),
(9, 'Wipe idea', 'I don\'t know the specifics, that\'s up to facepunch.\r\nWhat if Rust were to add in a nuke whenever there was a wipe? If you farmed all wipe and were lucky enough to find some uranium (or something of the sort) you could do some science with it, add some isotopes etc and get it activated. You could then create a nuke and it\'d take some plane to fly it high up into the sky and drop it down.\r\nThis could add in lots of new pvp and goals for rust players.', 'tips'),
(10, 'Beepers Not Allowing Entry', 'This new wipe my rust beepers are not working. Can the server host turn those off? Are they glitched out for some reaason?', 'help'),
(11, 'If anyone can fix this I am willing to pay', 'Crash upon server join Tried all available troubleshooting. Tried all available troubleshooting. driver to newest version. I\'m pretty lost at this point. this has only started occurring since the DLC3 small hotfix went out. I have over 1500 hours so its not like I am new or anything or it never worked I have played for years and never had a problem till now.', 'help'),
(12, 'Crash upon server join', 'Tried all available troubleshooting. Even updating 466 nvidia driver to newest version. I\'m pretty lost at this point. My launch options have no overlay. I have Ryzen 5 1500X and 1070ti 16GB of TridentZ clocked at 2666mhz - this has only started occurring since the DLC3 small hotfix went out.\r\n-high -gc.buffer 4096 -maxMem=12000 -malloc=system -force-feature-level-11-0 -cpuCount=8 -exThreads=16 -force-d3d11-no-singlethreaded -physics.steps 60', 'help'),
(13, 'Expected specs', 'Hi! I am just wondering, does anyone have any idea of the expected minimum specs, as my pc is kinda bad running an intel core i5 4500u at 1.9Ghz, and Integrated graphics, so i am worried i cannot s', 'general');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accs_ranks`
--

CREATE TABLE `accs_ranks` (
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `permission` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `accs_ranks`
--

INSERT INTO `accs_ranks` (`login`, `permission`) VALUES
('root', 'root'),
('user', 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accs_users`
--

CREATE TABLE `accs_users` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `accs_users`
--

INSERT INTO `accs_users` (`id`, `login`, `password`) VALUES
(1, 'root', '$2y$10$wkRgILmbL3u0XFFZQI5t4u01t4v0.9RxZqkxPXwpKXD8sbClv/FX.'), --- password: rootpassword
(2, 'user', '$2y$10$23mqGicHLz4DibOEz6L3HOXw0goE4rJrPYO29SmYyQkxjCWvD9b6S'); --- password: userpassword

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accs_articles`
--
ALTER TABLE `accs_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `accs_users`
--
ALTER TABLE `accs_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `accs_articles`
--
ALTER TABLE `accs_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `accs_users`
--
ALTER TABLE `accs_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
