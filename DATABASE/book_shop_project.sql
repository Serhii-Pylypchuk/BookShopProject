-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 12 2019 г., 11:45
-- Версия сервера: 5.7.14
-- Версия PHP: 7.3.2RC1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `book_shop_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `writers`
--

CREATE TABLE `writers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `src` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `writers`
--

INSERT INTO `writers` (`id`, `name`, `src`) VALUES
(5, 'Эрнест Хемингуэй', 'hem.jpg'),
(6, 'Анжей Сапковский', 'sapkowski.jpg'),
(8, 'Джоан Роулинг', 'dr.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `writer_id5`
--

CREATE TABLE `writer_id5` (
  `id` int(11) NOT NULL,
  `book_name` varchar(200) NOT NULL,
  `writer_name` varchar(50) NOT NULL,
  `book_src` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `writer_id5`
--

INSERT INTO `writer_id5` (`id`, `book_name`, `writer_name`, `book_src`) VALUES
(1, 'По ком звонит колокол', 'Эрнест Хемингуэй', 'rrr.jpg'),
(3, 'Старик и море', 'Эрнест Хемингуэй', 'Oldmansea.jpg'),
(6, 'И солнце сходит', 'Эрнест Хемингуэй', 'tsar.jpg'),
(7, 'Прощай оружие', 'Эрнест Хемингуэй', 'fta.jpg'),
(8, 'Праздник, который всегда с тобой', 'Эрнест Хемингуэй', 'mf.jpg'),
(9, 'Зеленые холмы африки', 'Эрнест Хемингуэй', 'zha.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `writer_id6`
--

CREATE TABLE `writer_id6` (
  `id` int(11) NOT NULL,
  `book_name` varchar(200) NOT NULL,
  `writer_name` varchar(50) NOT NULL,
  `book_src` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `writer_id6`
--

INSERT INTO `writer_id6` (`id`, `book_name`, `writer_name`, `book_src`) VALUES
(1, 'Ведьмак. Последнее желание', 'Анжей Сапковский', 'v1.jpg'),
(2, 'Ведьмак. Меч предназначения', 'Анжей Сапковский', 'v2.jpg'),
(3, 'Ведьмак. Кровь эльфов', 'Анжей Сапковский', 'v3.jpg'),
(4, 'Ведьмак. Час презрения', 'Анжей Сапковский', 'v4.jpg'),
(5, 'Ведьмак. Крещение огнем', 'Анжей Сапковский', 'v5.jpg'),
(6, 'Ведьмак. Башня ласточки', 'Анжей Сапковский', 'v6.jpg'),
(7, 'Ведьмак. Владычица озера', 'Анжей Сапковский', 'v7.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `writer_id8`
--

CREATE TABLE `writer_id8` (
  `id` int(11) NOT NULL,
  `book_name` varchar(200) NOT NULL,
  `writer_name` varchar(50) NOT NULL,
  `book_src` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `writer_id8`
--

INSERT INTO `writer_id8` (`id`, `book_name`, `writer_name`, `book_src`) VALUES
(1, 'Гарри Поттер и философский камень ', 'Джоан Роилинг', 'hp1.jpg'),
(2, 'Гарри Поттер и Тайная комната', 'Джоан Роилинг', 'hp2.jpg'),
(3, 'Гарри Поттер и Узник Азкабана', 'Джоан Роилинг', 'hp3.jpg'),
(4, 'Гарри Поттер и Кубок Oгня', 'Джоан Роилинг', 'hp4.jpg'),
(5, 'Гарри Поттер  и Орден Феникса', 'Джоан Роилинг', 'hp5.jpg'),
(6, 'Гарри Поттер и Принц-полукровка', 'Джоан Роилинг', 'hp6.jpg'),
(7, 'Гарри Поттер и Дары Смерти', 'Джоан Роилинг', 'hp7.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `writers`
--
ALTER TABLE `writers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `writer_id5`
--
ALTER TABLE `writer_id5`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `writer_id6`
--
ALTER TABLE `writer_id6`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `writer_id8`
--
ALTER TABLE `writer_id8`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `writers`
--
ALTER TABLE `writers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `writer_id5`
--
ALTER TABLE `writer_id5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `writer_id6`
--
ALTER TABLE `writer_id6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `writer_id8`
--
ALTER TABLE `writer_id8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
