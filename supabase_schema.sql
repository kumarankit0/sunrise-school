-- ==============================================================================
-- Sun Rise Sr. Sec. School, Dobhi - Supabase (PostgreSQL) Database Schema
-- Paste this script directly into Supabase Dashboard -> SQL Editor and click RUN
-- ==============================================================================

-- 1. Table: admins
-- Stores superuser credentials with bcrypt hashes and brute-force tracking
CREATE TABLE IF NOT EXISTS admins (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    failed_attempts INT NOT NULL DEFAULT 0,
    locked_until TIMESTAMP NULL DEFAULT NULL,
    last_login TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 2. Table: site_content
-- Stores editable text blocks (plain text or rich HTML)
CREATE TABLE IF NOT EXISTS site_content (
    id SERIAL PRIMARY KEY,
    page_key VARCHAR(50) NOT NULL,
    section_key VARCHAR(100) NOT NULL,
    content_type VARCHAR(10) NOT NULL DEFAULT 'text',
    content_value TEXT NOT NULL,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT uq_page_section UNIQUE (page_key, section_key)
);

CREATE INDEX IF NOT EXISTS idx_page_key ON site_content(page_key);

-- 3. Table: site_images
-- Stores editable image file paths and alt text
CREATE TABLE IF NOT EXISTS site_images (
    id SERIAL PRIMARY KEY,
    page_key VARCHAR(50) NOT NULL,
    image_key VARCHAR(100) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    alt_text VARCHAR(255) NOT NULL DEFAULT '',
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT uq_page_image UNIQUE (page_key, image_key)
);

CREATE INDEX IF NOT EXISTS idx_page_image_key ON site_images(page_key);

-- 4. Initial Seed Data: Default Superuser Admin Account
-- Default Username: admin
-- Default Password: Admin@12345
INSERT INTO admins (username, password_hash)
VALUES ('admin', '$2y$10$bZEYkVY6KfaaFQ53EY2CZei9vUNbRMH63AqxyTcwI5U9Ua/3zcNbq')
ON CONFLICT (username) DO NOTHING;

-- Disable RLS so the backend PHP PDO connection can read and write freely
ALTER TABLE admins DISABLE ROW LEVEL SECURITY;
ALTER TABLE site_content DISABLE ROW LEVEL SECURITY;
ALTER TABLE site_images DISABLE ROW LEVEL SECURITY;
