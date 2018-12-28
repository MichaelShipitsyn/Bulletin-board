-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 05 2018 г., 22:25
-- Версия сервера: 5.7.24-0ubuntu0.18.04.1
-- Версия PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_avito`
--

-- --------------------------------------------------------

--
-- Структура таблицы `advert_adverts`
--

CREATE TABLE `advert_adverts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reject_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `advert_adverts`
--

INSERT INTO `advert_adverts` (`id`, `user_id`, `region_id`, `title`, `price`, `address`, `content`, `status`, `reject_reason`, `created_at`, `updated_at`, `published_at`, `expires_at`) VALUES
(1, 1, 3, 'Advert 1', 40, 'ул. звёздная 45, кв. 108', 'Content of article№1', 'active', NULL, '2018-11-07 20:00:00', '2018-11-08 08:19:02', '2018-11-07 20:00:00', '2018-11-22 20:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `advert_advert_photos`
--

CREATE TABLE `advert_advert_photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `advert_id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `advert_advert_photos`
--

INSERT INTO `advert_advert_photos` (`id`, `advert_id`, `file`) VALUES
(1, 1, 'adverts/GRAV9hFq6WYcHg6xQeTOdvFK28tD21i42Q5EsBhn.png'),
(2, 2, 'adverts/J4zokMHYNEfKuyfYUsnqd1ri1PHLTB00YDv4MDUV.png');

-- --------------------------------------------------------

--
-- Структура таблицы `advert_advert_values`
--

CREATE TABLE `advert_advert_values` (
  `advert_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `banner_banners`
--

CREATE TABLE `banner_banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) DEFAULT NULL,
  `limit` int(11) NOT NULL,
  `clicks` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_11_06_181915_add_user_verification', 2),
(4, '2018_11_07_132831_add_user_role', 3),
(5, '2018_11_07_155315_create_regions_table', 4),
(6, '2018_11_07_172230_add_user_last_name', 5),
(7, '2018_11_07_185056_create_adverts_tables', 6),
(9, '2018_11_11_141107_create_banners_table', 7),
(10, '2018_11_12_171607_create_tickets_tables', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `name`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Регион 1', 'Регион 1', NULL, '2018-11-07 12:59:07', '2018-11-07 12:59:07'),
(2, 'Регион 2', 'Регион 2', NULL, '2018-11-07 20:00:00', '2018-11-07 20:00:00'),
(3, 'Регион 3', 'Регион 3', 1, '2018-11-09 20:00:00', '2018-11-09 20:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_messages`
--

CREATE TABLE `ticket_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ticket_messages`
--

INSERT INTO `ticket_messages` (`id`, `ticket_id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Это ты прост еблан', '2018-11-12 13:40:52', '2018-11-12 13:40:52');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_statuses`
--

CREATE TABLE `ticket_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ticket_statuses`
--

INSERT INTO `ticket_statuses` (`id`, `ticket_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'open', '2018-11-12 13:39:14', '2018-11-12 13:39:14'),
(2, 1, 3, 'approved', '2018-11-12 13:41:58', '2018-11-12 13:41:58'),
(3, 1, 3, 'closed', '2018-11-12 13:42:05', '2018-11-12 13:42:05'),
(4, 1, 3, 'approved', '2018-11-12 13:42:09', '2018-11-12 13:42:09');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_tickets`
--

CREATE TABLE `ticket_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ticket_tickets`
--

INSERT INTO `ticket_tickets` (`id`, `user_id`, `subject`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Олибка в ларавел', 'Ну пиздец ребят, ошибка всю систему наебнула, Тейлор ебанат', 'approved', '2018-11-12 13:39:14', '2018-11-12 13:42:09');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `verify_token`, `role`) VALUES
(1, 'test', 'sdh', 'test@mail.ru', NULL, '$2y$10$9JU9us3mf86CFx9LqOwZbeuKEw4iopRMk6zOtMnshXzkc/Np./hny', 'qyrEQ355xgBW7aXPy5Pe9CiWWA9gKYcumAVX3RWGuKtDTg3wPNkU7BJpfyof', '2018-11-01 03:33:14', '2018-11-08 08:22:38', 'active', NULL, 'user'),
(3, 'test1', 'Шипицын', 'test1@mail.ru', NULL, '$2y$10$arAiDjx7iyXku2trVQuNV.4N58eC85..fgFcqKUlGYHQbpFkjqrMK', 'y4nqVREvinOByPkfgcAm6FRd0UCKNzUbm0dF9pFkhR8pieqqBRGNW0mjRsft', '2018-11-06 14:59:34', '2018-11-07 13:28:43', 'active', NULL, 'admin'),
(4, 'test2', NULL, 'test2@mail.ru', NULL, '$2y$10$3c0W1ehbWrorekvNLZfrN.MiDdn.Jggjkrg6Y3QCH8RZrVwkJEwWa', 'DA7cWVJ5LqEn5FCVOhElR5PaGsR6ivZyXRGcARJ6h6IYOf6N5lUfHoLjdhpX', '2018-11-07 07:10:42', '2018-11-07 07:10:42', 'active', NULL, 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `advert_adverts`
--
ALTER TABLE `advert_adverts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `advert_advert_photos`
--
ALTER TABLE `advert_advert_photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `advert_advert_values`
--
ALTER TABLE `advert_advert_values`
  ADD PRIMARY KEY (`advert_id`);

--
-- Индексы таблицы `banner_banners`
--
ALTER TABLE `banner_banners`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_parent_id_slug_unique` (`parent_id`,`slug`),
  ADD UNIQUE KEY `regions_parent_id_name_unique` (`parent_id`,`name`),
  ADD KEY `regions_name_index` (`name`);

--
-- Индексы таблицы `ticket_messages`
--
ALTER TABLE `ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ticket_tickets`
--
ALTER TABLE `ticket_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_verify_token_unique` (`verify_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `advert_adverts`
--
ALTER TABLE `advert_adverts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `advert_advert_photos`
--
ALTER TABLE `advert_advert_photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `banner_banners`
--
ALTER TABLE `banner_banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `ticket_messages`
--
ALTER TABLE `ticket_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `ticket_tickets`
--
ALTER TABLE `ticket_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
