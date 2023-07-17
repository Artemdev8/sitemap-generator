-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 17 2023 г., 21:06
-- Версия сервера: 8.0.30
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sitemap`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sitemap_test`
--

CREATE TABLE `sitemap_test` (
  `id` int NOT NULL,
  `loc` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastmod` date NOT NULL,
  `changefreq` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sitemap_test`
--

INSERT INTO `sitemap_test` (`id`, `loc`, `lastmod`, `changefreq`, `priority`) VALUES
(1, 'https://site.ru', '2023-06-25', 'hourly', 1),
(2, 'https://good-site.ru', '2023-06-25', 'weekly', 0.9),
(3, 'https://sitemap.php', '2023-07-09', 'weekly', 0.85);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `sitemap_test`
--
ALTER TABLE `sitemap_test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `sitemap_test`
--
ALTER TABLE `sitemap_test`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
