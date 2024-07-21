-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 29 2024 г., 11:41
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `prudik`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lang`
--

CREATE TABLE `lang` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `open` varchar(50) NOT NULL,
  `creator` varchar(50) NOT NULL,
  `descr` text NOT NULL,
  `img` text NOT NULL,
  `creatorid` int NOT NULL
);

--
-- Дамп данных таблицы `lang`
--

INSERT INTO `lang` (`id`, `name`, `open`, `creator`, `descr`, `img`, `creatorid`) VALUES
(1, 'Английский', 'yes', 'Глава проекта', 'Английский для чайников от чайника.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Flag_of_the_United_Kingdom_%283-5%29.svg/800px-Flag_of_the_United_Kingdom_%283-5%29.svg.png', 4),
(2, 'Тест', 'yes', 'Voeka', 'Тест1', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Test-Logo.svg/783px-Test-Logo.svg.png', 4),
(3, 'TEST2', 'TEST2', '1111', 'TEST2TEST2TEST2TEST2', '111', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `learner`
--

CREATE TABLE `learner` (
  `id` int NOT NULL,
  `iduser` int NOT NULL,
  `idlang` int NOT NULL
);

--
-- Дамп данных таблицы `learner`
--

INSERT INTO `learner` (`id`, `iduser`, `idlang`) VALUES
(1, 4, 1),
(3, 4, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id` int NOT NULL,
  `langid` int NOT NULL,
  `creatorid` int NOT NULL,
  `author` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `Descr` text NOT NULL,
  `video` text NOT NULL,
  `img` text NOT NULL,
  `DateCreate` date NOT NULL,
  `DateChange` date NOT NULL,
  `types` varchar(50) NOT NULL
);

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id`, `langid`, `creatorid`, `author`, `name`, `heading`, `Descr`, `video`, `img`, `DateCreate`, `DateChange`, `types`) VALUES
(1, 1, 4, 'Глава проекта', 'Вступление', 'Начало пути', 'Это тестовый урок для понимания, работает ли2', '', 'https://cdn-icons-png.flaticon.com/512/1531/1531126.png', '2024-05-26', '2024-05-26', 'Открытый'),
(2, 1, 4, 'Глава проекта', 'Вступление2', 'Начало пути2', 'Это тестовый урок для понимания, работает ли2', '', 'https://cdn-icons-png.flaticon.com/512/1531/1531126.png', '2024-05-26', '2024-05-26', 'Открытый'),
(3, 1, 4, 'Глава проекта', 'Вступление3', 'Начало пути2', 'Это тестовый урок для понимания, работает ли2', '', 'https://cdn-icons-png.flaticon.com/512/1531/1531126.png', '2024-05-26', '2024-05-26', 'Открытый'),
(4, 1, 4, 'admin1', 'Тест', 'Тест ', 'Тест ', '', 'https://organicwoman.ru/wp-content/uploads/2017/09/%D1%82%D0%B5%D1%81%D1%82.jpg', '2024-05-28', '2024-05-28', 'Открытый'),
(5, 2, 4, 'admin1', 'Test', 'TEST TEST TEST', 'TEST for TEST where TEST is TEST', '', '...', '2024-05-28', '2024-05-28', '1'),
(6, 3, 1, '1111', 'TEST2', 'TEST2', 'TEST2', '', '', '2024-05-28', '2024-05-28', 'TEST2');

-- --------------------------------------------------------

--
-- Структура таблицы `progress`
--

CREATE TABLE `progress` (
  `id` int NOT NULL,
  `iduser` int NOT NULL,
  `idlesson` int NOT NULL
);

--
-- Дамп данных таблицы `progress`
--

INSERT INTO `progress` (`id`, `iduser`, `idlesson`) VALUES
(2, 4, 1),
(3, 4, 2),
(4, 4, 1),
(5, 4, 1),
(6, 4, 3),
(7, 4, 1),
(8, 4, 1),
(9, 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE `question` (
  `id` int NOT NULL,
  `lessonID` int NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
);

--
-- Дамп данных таблицы `question`
--

INSERT INTO `question` (`id`, `lessonID`, `question`, `answer`) VALUES
(1, 1, '1 равен 1?Да или Нет', 'Да'),
(2, 1, '1 равен 0?Да или Нет?', 'Нет'),
(3, 2, 'Да или нет?(Да)', 'Да');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL,
  `iduser` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `reviews` text NOT NULL
);

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `iduser`, `name`, `reviews`) VALUES
(2, 4, 'admin1', 'TEST TEST');

-- --------------------------------------------------------

--
-- Структура таблицы `Subs`
--

CREATE TABLE `Subs` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `dateduy` date NOT NULL,
  `dateend` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
);

--
-- Дамп данных таблицы `Subs`
--

INSERT INTO `Subs` (`id`, `userid`, `dateduy`, `dateend`, `status`, `type`) VALUES
(1, 4, '2024-05-21', '2024-06-21', 'Оплачено', 'Единаразовый');

-- --------------------------------------------------------

--
-- Структура таблицы `support`
--

CREATE TABLE `support` (
  `id` int NOT NULL,
  `iduser` int NOT NULL,
  `selected` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` text NOT NULL
);

--
-- Дамп данных таблицы `support`
--

INSERT INTO `support` (`id`, `iduser`, `selected`, `message`, `status`, `description`) VALUES
(1, 4, 'Проблема с платформой', 'Проверка', 'В обработке', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
);

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `role`) VALUES
(1, '1111', 'admin@admin.ru', '1111', 'teacher'),
(4, 'admin1', 'admin@admin.ru', '1111', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `learner`
--
ALTER TABLE `learner`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Subs`
--
ALTER TABLE `Subs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `learner`
--
ALTER TABLE `learner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `question`
--
ALTER TABLE `question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Subs`
--
ALTER TABLE `Subs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `support`
--
ALTER TABLE `support`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
