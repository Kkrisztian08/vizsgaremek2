-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Dec 01. 13:41
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `elethang`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nev` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `jelszo` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `aktivalt_e` tinyint(4) DEFAULT NULL,
  `telefonszam` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `szul_datum` date DEFAULT NULL,
  `lakcim` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`id`, `nev`, `email`, `jelszo`, `aktivalt_e`, `telefonszam`, `szul_datum`, `lakcim`) VALUES
(3, 'Kiss Balázs', 'kisbalazs@gmail.com', '12345', 0, '06302222222', '2021-12-05', 'Valami utca 5'),
(6, 'BambiniBimbó', 'bimbo@example.com', '123ZsakBil', 0, '3463453', '2021-10-14', '0131 Example exampe street 56');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `nev` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `lakcim` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `telefonszam` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `jelszo` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `szul_datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `nev`, `lakcim`, `email`, `telefonszam`, `jelszo`, `szul_datum`) VALUES
(1, 'Nagy Anett', 'Másik utca 8', 'nagyanett@gmail.com', '06302222255', '12355', '2011-12-12'),
(3, 'Izémizéke', ' Izé utca 56', 'izeke@example.com', '3463453', '123Izé3', '2001-05-29');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kepek`
--

CREATE TABLE `kepek` (
  `id` int(11) NOT NULL,
  `nev` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `esemeny_nev` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kutya`
--

CREATE TABLE `kutya` (
  `id` int(11) NOT NULL,
  `nev` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `nem` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `faj` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `kb_szul` datetime DEFAULT NULL,
  `kul_tul` text COLLATE utf8_hungarian_ci DEFAULT NULL,
  `erdeklodes_merete` int(11) DEFAULT NULL,
  `kep` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `orokbefogadas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `macska`
--

CREATE TABLE `macska` (
  `id` int(11) NOT NULL,
  `nev` varchar(45) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `nem` varchar(45) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `kb_szul` date NOT NULL,
  `kul_tul` varchar(45) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `erdeklodes_merete` int(11) NOT NULL,
  `kep` varchar(45) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `macska`
--

INSERT INTO `macska` (`id`, `nev`, `nem`, `kb_szul`, `kul_tul`, `erdeklodes_merete`, `kep`) VALUES
(1, 'Owl Kitty', 'nőstény', '2021-11-01', 'cirmos', 34, 'cica.jpg'),
(4, 'Donna', 'nőstény', '2013-04-14', 'fehér,foltos', 32, 'donna.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orokbefogadas`
--

CREATE TABLE `orokbefogadas` (
  `id` int(11) NOT NULL,
  `orokbefodao_neve` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `orokbefodao_email` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `lakcim` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `telefonszám` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `orokbefog_kezd_datuma` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `orokbefogadas`
--

INSERT INTO `orokbefogadas` (`id`, `orokbefodao_neve`, `orokbefodao_email`, `lakcim`, `telefonszám`, `orokbefog_kezd_datuma`) VALUES
(2, 'Nagy Mari', 'nagymari23@gmail.com', 'Másikutáni utca 80', '0650444455', '2021-06-07'),
(3, 'Kis Éva', 'eva3e4@gmail.com', 'Honanntudjam utca 55', '0650445634', '2015-07-25');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `program_ jelentkezesek`
--

CREATE TABLE `program_ jelentkezesek` (
  `id` int(11) NOT NULL,
  `valasztott_datum` datetime DEFAULT NULL,
  `felhasznalok_id` int(11) NOT NULL,
  `program` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendezmenyek`
--

CREATE TABLE `rendezmenyek` (
  `id` int(11) NOT NULL,
  `nev` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `rendezmenyek`
--

INSERT INTO `rendezmenyek` (`id`, `nev`, `datum`) VALUES
(1, 'Adakozzáá', '2018-07-09'),
(3, 'Új Lehetőség az árva állatoknak', '2012-02-28');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `virtualis_orokbefogadas`
--

CREATE TABLE `virtualis_orokbefogadas` (
  `id` int(11) NOT NULL,
  `orokbefogado_neve` varchar(45) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `orokbefogado_email` varchar(45) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `lakcim` varchar(45) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `telefonszam` int(11) NOT NULL,
  `orokbefog_kezd_datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `virtualis_orokbefogadas`
--

INSERT INTO `virtualis_orokbefogadas` (`id`, `orokbefogado_neve`, `orokbefogado_email`, `lakcim`, `telefonszam`, `orokbefog_kezd_datum`) VALUES
(1, 'Zsakos', 'sda@gmail.com', '0131 Example exampe street 56', 4353245, '2021-11-02'),
(3, 'Zsizsozsaka', 'zsika@gmail.com', '6796 Akármi street 45', 12345678, '2021-04-01');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kepek`
--
ALTER TABLE `kepek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kutya`
--
ALTER TABLE `kutya`
  ADD PRIMARY KEY (`id`,`orokbefogadas_id`),
  ADD KEY `fk_kutya_orokbefogadas` (`orokbefogadas_id`);

--
-- A tábla indexei `macska`
--
ALTER TABLE `macska`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orokbefogadas`
--
ALTER TABLE `orokbefogadas`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `program_ jelentkezesek`
--
ALTER TABLE `program_ jelentkezesek`
  ADD PRIMARY KEY (`id`,`felhasznalok_id`),
  ADD KEY `fk_program_ jelentkezesek_felhasznalok1` (`felhasznalok_id`);

--
-- A tábla indexei `rendezmenyek`
--
ALTER TABLE `rendezmenyek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `virtualis_orokbefogadas`
--
ALTER TABLE `virtualis_orokbefogadas`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `kepek`
--
ALTER TABLE `kepek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kutya`
--
ALTER TABLE `kutya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `macska`
--
ALTER TABLE `macska`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `orokbefogadas`
--
ALTER TABLE `orokbefogadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `program_ jelentkezesek`
--
ALTER TABLE `program_ jelentkezesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `rendezmenyek`
--
ALTER TABLE `rendezmenyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `virtualis_orokbefogadas`
--
ALTER TABLE `virtualis_orokbefogadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `kutya`
--
ALTER TABLE `kutya`
  ADD CONSTRAINT `fk_kutya_orokbefogadas` FOREIGN KEY (`orokbefogadas_id`) REFERENCES `orokbefogadas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `program_ jelentkezesek`
--
ALTER TABLE `program_ jelentkezesek`
  ADD CONSTRAINT `fk_program_ jelentkezesek_felhasznalok1` FOREIGN KEY (`felhasznalok_id`) REFERENCES `felhasznalok` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
