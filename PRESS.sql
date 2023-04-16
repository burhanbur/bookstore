CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `username` varchar(255),
  `email` varchar(255) UNIQUE,
  `email_verified_at` datetime,
  `password` varchar(255),
  `remember_token` varchar(255),
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP()
);

-- CREATE TABLE `roles` (
--   `id` int PRIMARY KEY AUTO_INCREMENT,
--   `name` varchar(255),
--   `alias` varchar(255),
--   `guard_name` varchar(255),
--   `created_at` datetime DEFAULT CURRENT_TIMESTAMP(),
--   `updated_at` datetime DEFAULT CURRENT_TIMESTAMP()
-- );

-- CREATE TABLE `model_has_roles` (
--   `role_id` bigInt,
--   `model_type` varchar(255),
--   `model_id` bigInt,
--   PRIMARY KEY (`role_id`, `model_type`, `model_id`)
-- );

CREATE TABLE `types` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE `categories` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE `pub_cat` (
  `publication_id` int,
  `category_id` int,
  PRIMARY KEY (`publication_id`, `category_id`)
);

CREATE TABLE `publications` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `author_id` int,
  `ref_type_id` int,
  `serial_number` varchar(255) UNIQUE,
  `slug` varchar(255) UNIQUE,
  `cover` varchar(255),
  `name` varchar(255),
  `year` smallint,
  `publisher` varchar(255),
  `is_public` boolean,
  `description` longtext,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE `files` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `publication_id` int,
  `name` varchar(255),
  `file_path` varchar(255),
  `created_by` varchar(255),
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP()
);

ALTER TABLE `pub_cat` ADD FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`);

ALTER TABLE `pub_cat` ADD FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

ALTER TABLE `publications` ADD FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

ALTER TABLE `publications` ADD FOREIGN KEY (`ref_type_id`) REFERENCES `types` (`id`);

ALTER TABLE `files` ADD FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`);
