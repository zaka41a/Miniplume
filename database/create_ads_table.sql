-- Création de la table ads pour le système de publicités
USE minicms;

CREATE TABLE IF NOT EXISTS ads (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT NULL,
    url VARCHAR(500) NOT NULL,
    image_path VARCHAR(255) NULL,
    position ENUM('sidebar','header','footer','content') NOT NULL DEFAULT 'sidebar',
    status ENUM('active','inactive') NOT NULL DEFAULT 'active',
    clicks INT UNSIGNED NOT NULL DEFAULT 0,
    views INT UNSIGNED NOT NULL DEFAULT 0,
    start_date DATE NULL,
    end_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_ads_status_position (status, position)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insérer quelques exemples de publicités pour tester (optionnel)
INSERT INTO ads (title, description, url, position, status) VALUES
('Bannière Test 1', 'Première publicité de test', 'https://example.com', 'sidebar', 'active'),
('Bannière Test 2', 'Deuxième publicité de test', 'https://example.com/promo', 'header', 'active');
