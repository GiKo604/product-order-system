-- Active: 1759388908017@@127.0.0.1@3306@integraf_db
-- jednoduchý dump, žádné magie
CREATE DATABASE IF NOT EXISTS integraf_db;

DROP DATABASE IF EXISTS integraf_db;
USE integraf_db;

-- Users
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'grafik', 'uživatel') NOT NULL DEFAULT 'uživatel',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Customers
CREATE TABLE IF NOT EXISTS customers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    client_code VARCHAR(100) DEFAULT NULL,
    email VARCHAR(150) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Approval statuses
CREATE TABLE IF NOT EXISTS approval_statuses (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE -- schváleno / neschváleno / v procesu / pracuje grafik / chyba
);

-- Order statuses
CREATE TABLE IF NOT EXISTS order_statuses (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE -- grafik / schválení / pozastaveno / hotovo / chyba
);

-- Products
CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id INT UNSIGNED DEFAULT NULL,
    our_code VARCHAR(100) NOT NULL,
    client_code VARCHAR(100) NOT NULL,
    size VARCHAR(100) DEFAULT NULL,
    cut_name VARCHAR(255) DEFAULT NULL,       -- číslo výseku / kód montáže / ks na TA (klidně to pak rozsekej)
    foil_type VARCHAR(255) DEFAULT NULL,
    color_coverage DECIMAL(5,2) DEFAULT NULL, -- procenta
    ean_code VARCHAR(50) DEFAULT NULL,
    preview_file VARCHAR(255) DEFAULT NULL,   -- cesta k souboru
    approval_status_id INT UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
    FOREIGN KEY (approval_status_id) REFERENCES approval_statuses(id) ON DELETE SET NULL,
    UNIQUE KEY uniq_product_codes (our_code, client_code)
);

-- Orders
CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id INT UNSIGNED DEFAULT NULL,
    status_id INT UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
    FOREIGN KEY (status_id) REFERENCES order_statuses(id) ON DELETE SET NULL
);

-- Order items
CREATE TABLE IF NOT EXISTS order_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED DEFAULT 0,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Order statistics
CREATE TABLE IF NOT EXISTS order_statistics (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id INT UNSIGNED NOT NULL,
    order_date DATE NOT NULL,
    quantity INT UNSIGNED DEFAULT 0,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
