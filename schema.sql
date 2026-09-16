-- ==============================================================================
-- Sun Rise Sr. Sec. School, Dobhi - Database Schema
-- CMS / Admin Panel Tables and Initial Seed Data
-- ==============================================================================

CREATE DATABASE IF NOT EXISTS `sunrise_school` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sunrise_school`;

-- ------------------------------------------------------------------------------
-- 1. Table: admins
-- Stores superuser credentials with bcrypt hashes and brute-force tracking
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admins` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `failed_attempts` INT UNSIGNED NOT NULL DEFAULT 0,
    `locked_until` DATETIME NULL DEFAULT NULL,
    `last_login` DATETIME NULL DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 2. Table: site_content
-- Stores editable text blocks (plain text or rich HTML)
-- Key naming convention: page_key + section_key (e.g. 'home' + 'hero_title')
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_content` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `page_key` VARCHAR(50) NOT NULL,
    `section_key` VARCHAR(100) NOT NULL,
    `content_type` ENUM('text', 'html') NOT NULL DEFAULT 'text',
    `content_value` MEDIUMTEXT NOT NULL,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `uq_page_section` (`page_key`, `section_key`),
    INDEX `idx_page_key` (`page_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 3. Table: site_images
-- Stores editable image file paths and alt text
-- Key naming convention: page_key + image_key (e.g. 'home' + 'hero_banner')
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_images` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `page_key` VARCHAR(50) NOT NULL,
    `image_key` VARCHAR(100) NOT NULL,
    `file_path` VARCHAR(255) NOT NULL,
    `alt_text` VARCHAR(255) NOT NULL DEFAULT '',
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `uq_page_image` (`page_key`, `image_key`),
    INDEX `idx_page_image_key` (`page_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 4. Initial Seed Data: Superuser Admin Account
-- Default Username: admin
-- Default Password: Admin@12345
-- ------------------------------------------------------------------------------
INSERT INTO `admins` (`username`, `password_hash`)
VALUES ('admin', '$2y$10$bZEYkVY6KfaaFQ53EY2CZei9vUNbRMH63AqxyTcwI5U9Ua/3zcNbq')
ON DUPLICATE KEY UPDATE `username` = VALUES(`username`);
