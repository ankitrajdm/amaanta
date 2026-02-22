-- Amaanta CMS Database Schema
-- Created: February 19, 2026

-- Users Table
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Roles Table
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL UNIQUE,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Role User Pivot Table
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pages Table
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `meta_title` varchar(255) NULL DEFAULT NULL,
  `meta_description` varchar(255) NULL DEFAULT NULL,
  `is_active` boolean DEFAULT TRUE,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Page Sections Table
CREATE TABLE IF NOT EXISTS `page_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `page_id` bigint unsigned NOT NULL,
  `section_key` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` longtext NULL DEFAULT NULL,
  `meta` json NULL DEFAULT NULL,
  `position` int unsigned DEFAULT 1,
  `is_active` boolean DEFAULT TRUE,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`page_id`) REFERENCES `pages`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Website Settings Table
CREATE TABLE IF NOT EXISTS `website_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `key` varchar(255) NOT NULL UNIQUE,
  `value` longtext NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Menus Table
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL UNIQUE,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Menu Items Table
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `menu_id` bigint unsigned NOT NULL,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `position` int unsigned DEFAULT 1,
  `is_active` boolean DEFAULT TRUE,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`menu_id`) REFERENCES `menus`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Posts Table
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `category` varchar(255) NULL DEFAULT NULL,
  `excerpt` varchar(255) NULL DEFAULT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) NULL DEFAULT NULL,
  `is_published` boolean DEFAULT FALSE,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Testimonials Table
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `author_name` varchar(255) NOT NULL,
  `author_title` varchar(255) NULL DEFAULT NULL,
  `quote` longtext NOT NULL,
  `is_active` boolean DEFAULT TRUE,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Gallery Images Table
CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `event_name` varchar(255) NULL DEFAULT NULL,
  `is_active` boolean DEFAULT TRUE,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact Enquiries Table
CREATE TABLE IF NOT EXISTS `contact_enquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NULL DEFAULT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
-- Uncomment the INSERT statements below if you want to add sample data
-- Make sure the tables are empty before inserting

-- INSERT INTO `roles` (`name`, `created_at`, `updated_at`) VALUES 
-- ('admin', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
-- ('editor', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
-- ('user', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- INSERT INTO `users` (`name`, `email`, `password`, `created_at`, `updated_at`) VALUES 
-- ('Admin User', 'admin@amaanta.local', '$2y$12$abcdefghijklmnopqrstuvwxyz', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (1, 1);

-- INSERT INTO `pages` (`title`, `slug`, `meta_title`, `meta_description`, `is_active`, `created_at`, `updated_at`) VALUES 
-- ('Home', 'home', 'Amaanta - Home', 'Welcome to Amaanta', TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
-- ('About', 'about', 'About Amaanta', 'Learn more about us', TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
-- ('Contact', 'contact', 'Contact Us', 'Get in touch with us', TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- INSERT INTO `website_settings` (`key`, `value`, `created_at`, `updated_at`) VALUES 
-- ('site_name', 'Amaanta', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
-- ('site_description', 'Professional Website & CMS', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
-- ('company_email', 'info@amaanta.local', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
-- ('company_phone', '+1-800-000-0000', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- INSERT INTO `menus` (`name`, `location`, `created_at`, `updated_at`) VALUES 
-- ('Main Menu', 'header', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
-- ('Footer Menu', 'footer', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- INSERT INTO `menu_items` (`menu_id`, `label`, `url`, `position`, `is_active`, `created_at`, `updated_at`) VALUES 
-- (1, 'Home', '/', 1, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
-- (1, 'About', '/about', 2, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
-- (1, 'Contact', '/contact', 3, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
