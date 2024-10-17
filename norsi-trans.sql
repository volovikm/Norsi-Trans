-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 17 2024 г., 12:38
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `norsi-trans`
--

-- --------------------------------------------------------

--
-- Структура таблицы `assembly`
--

CREATE TABLE `assembly` (
  `id` int(10) UNSIGNED NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `assembly`
--

INSERT INTO `assembly` (`id`, `added_at`, `updated_at`, `name`, `status`) VALUES
(25, '2024-10-17 11:52:02', '2024-10-17 12:04:00', 'ПК Дом', 1),
(26, '2024-10-17 13:07:35', '2024-10-17 12:12:00', 'ПК Офис', 1),
(27, '2024-10-17 13:27:48', NULL, 'Сборка 1', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `assembly_item`
--

CREATE TABLE `assembly_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `assembly_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `count` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `assembly_item`
--

INSERT INTO `assembly_item` (`id`, `added_at`, `updated_at`, `assembly_id`, `item_id`, `count`, `status`) VALUES
(81, '2024-10-17 11:52:14', NULL, 25, 2, 1, 1),
(82, '2024-10-17 11:52:49', NULL, 25, 4, 1, 1),
(83, '2024-10-17 11:52:58', NULL, 25, 31, 1, 1),
(84, '2024-10-17 11:53:08', NULL, 25, 17, 4, 2),
(85, '2024-10-17 11:53:30', NULL, 25, 52, 1, 1),
(86, '2024-10-17 11:53:59', NULL, 25, 12, 2, 2),
(87, '2024-10-17 11:54:08', NULL, 25, 10, 2, 2),
(88, '2024-10-17 11:54:18', NULL, 25, 10, 1, 1),
(89, '2024-10-17 12:00:28', NULL, 25, 14, 4, 1),
(90, '2024-10-17 12:01:09', NULL, 25, 17, 1, 2),
(91, '2024-10-17 13:00:51', NULL, 25, 17, 1, 1),
(92, '2024-10-17 13:03:39', NULL, 25, 11, 1, 2),
(93, '2024-10-17 13:04:56', NULL, 25, 36, 1, 2),
(94, '2024-10-17 13:07:39', NULL, 26, 1, 1, 1),
(95, '2024-10-17 13:12:00', NULL, 26, 3, 1, 1),
(96, '2024-10-17 13:12:16', NULL, 26, 8, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `item`
--

CREATE TABLE `item` (
  `id` int(10) UNSIGNED NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `item_type_id` int(10) UNSIGNED NOT NULL,
  `in_stock` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `item`
--

INSERT INTO `item` (`id`, `added_at`, `updated_at`, `name`, `item_type_id`, `in_stock`, `status`) VALUES
(1, '2024-01-01 10:01:47', '2024-10-17 10:16:00', 'Корпус белый', 1, 1, 1),
(2, '2024-01-01 10:01:47', '2024-10-16 23:36:00', 'Корпус чёрный', 1, 0, 1),
(3, '2024-01-01 10:01:47', NULL, 'Intel', 2, 1, 1),
(4, '2024-01-01 10:01:47', NULL, 'AMD', 2, 1, 1),
(5, '2024-01-01 10:01:47', NULL, 'arm64', 2, 1, 2),
(8, '2024-01-01 10:01:47', NULL, 'GIGABYTE', 3, 1, 1),
(9, '2024-01-01 10:01:47', NULL, 'MSI', 3, 1, 1),
(10, '2024-01-01 10:01:47', NULL, 'ASUS', 3, 1, 1),
(11, '2024-01-01 10:01:47', NULL, 'MSI', 4, 1, 1),
(12, '2024-01-01 10:01:47', NULL, 'ASUS', 4, 1, 1),
(13, '2024-01-01 10:01:47', NULL, 'GIGABYTE', 4, 1, 1),
(14, '2024-01-01 10:01:47', NULL, 'Kingston', 5, 1, 1),
(15, '2024-01-01 10:01:47', NULL, 'Crucial', 5, 1, 1),
(16, '2024-01-01 10:01:47', '2024-01-18 10:02:23', 'Corsair', 5, 1, 1),
(17, '2024-01-01 10:01:47', NULL, 'DEEPCOOL', 6, 1, 1),
(18, '2024-01-01 10:01:47', NULL, 'ZALMAN', 6, 1, 1),
(19, '2024-01-01 10:01:47', NULL, 'Chieftec', 6, 1, 1),
(20, '2024-01-01 10:01:47', NULL, 'DEEPCOOL', 7, 1, 1),
(21, '2024-01-01 10:01:47', NULL, 'ID-COOLING', 7, 1, 1),
(22, '2024-01-01 10:01:47', '2024-01-18 10:02:29', 'AeroCool', 7, 1, 1),
(23, '2024-01-01 10:01:47', NULL, 'Kingston 512ГБ', 8, 1, 1),
(24, '2024-01-01 10:01:47', NULL, 'Samsung 512ГБ', 8, 1, 1),
(29, '2024-01-01 10:01:47', NULL, 'Intel 480ГБ', 8, 1, 1),
(30, '2024-01-01 10:01:47', NULL, 'Intel 512ГБ', 8, 0, 1),
(31, '2024-01-01 10:01:47', NULL, 'Toshiba 1TB', 9, 1, 1),
(32, '2024-01-18 10:01:47', NULL, 'WD Blue 2TB', 9, 1, 1),
(33, '2024-01-18 10:01:47', NULL, 'Seagate BarraCuda 2TB', 9, 1, 1),
(34, '2024-01-18 10:01:47', NULL, 'WD Red 2TB', 9, 0, 1),
(35, '2024-01-18 10:01:47', NULL, 'Корпус красный', 1, 0, 1),
(36, '2024-01-18 10:01:47', NULL, 'Baikal', 2, 0, 1),
(51, '2024-10-17 11:17:04', NULL, 'STM32', 2, 1, 1),
(52, '2024-10-17 11:17:55', NULL, 'RTX 4080 ti', 4, 0, 1),
(53, '2024-10-17 13:19:21', NULL, 'ESP32', 2, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `item_type`
--

CREATE TABLE `item_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `item_type`
--

INSERT INTO `item_type` (`id`, `name`) VALUES
(1, 'Корпус'),
(2, 'Процессор'),
(3, 'Материнская плата'),
(4, 'Видеокарта'),
(5, 'Оперативная память'),
(6, 'Блок питания'),
(7, 'Кулер для процессора'),
(8, 'Твердотельный накопитель'),
(9, 'Жесткий диск');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `assembly`
--
ALTER TABLE `assembly`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `assembly_item`
--
ALTER TABLE `assembly_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`) USING BTREE,
  ADD KEY `assembly_id` (`assembly_id`) USING BTREE;

--
-- Индексы таблицы `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_type_id` (`item_type_id`);

--
-- Индексы таблицы `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `assembly`
--
ALTER TABLE `assembly`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `assembly_item`
--
ALTER TABLE `assembly_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT для таблицы `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `item_type`
--
ALTER TABLE `item_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `assembly_item`
--
ALTER TABLE `assembly_item`
  ADD CONSTRAINT `assembly_item_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `assembly_item_ibfk_4` FOREIGN KEY (`assembly_id`) REFERENCES `assembly` (`id`);

--
-- Ограничения внешнего ключа таблицы `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`item_type_id`) REFERENCES `item_type` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
