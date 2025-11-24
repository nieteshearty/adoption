-- Database schema for Pet Adoption website
-- You can import this file in phpMyAdmin or using the MySQL client.

-- 1. Create database
CREATE DATABASE IF NOT EXISTS pet_adoption CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pet_adoption;

-- 2. Users table (for normal users and admin)
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Pets table
CREATE TABLE IF NOT EXISTS pets (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    age INT UNSIGNED NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Optional: Adoption requests table (contact form submissions)
CREATE TABLE IF NOT EXISTS adoption_requests (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    pet_name VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_adoption_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Seed admin user (password not hashed here; you should replace with a hashed password in real use)
INSERT INTO users (username, password, role)
VALUES ('admin', 'admin123', 'admin')
ON DUPLICATE KEY UPDATE username = username;

-- 6. Seed sample pets
INSERT INTO pets (name, type, age, description) VALUES
('Bella', 'Dog', 2, 'Friendly and playful mixed-breed dog looking for an active family.'),
('Milo', 'Cat', 3, 'Calm indoor cat who loves sunny windowsills and quiet homes.'),
('Luna', 'Dog', 1, 'Energetic puppy who is learning basic commands and loves toys.')
ON DUPLICATE KEY UPDATE name = VALUES(name);
