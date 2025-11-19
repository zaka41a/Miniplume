<?php
/**
 * Script de création de la table ads
 * Accédez à : http://localhost:8000/create_ads_table.php
 */

require __DIR__.'/../app/Config.php';

header('Content-Type: text/html; charset=utf-8');

echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création table ads</title>
    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #0a0e1a;
            color: #e5e7eb;
        }
        h1 { color: #8b5cf6; }
        .success { color: #10b981; font-weight: bold; }
        .error { color: #ef4444; font-weight: bold; }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 20px;
        }
        .button:hover { opacity: 0.9; }
        pre { background: #1a1f35; padding: 15px; border-radius: 8px; overflow-x: auto; }
    </style>
</head>
<body>';

echo '<h1>🔧 Création de la table "ads"</h1>';

try {
    $pdo = db();

    echo '<h2>Étape 1 : Suppression de la table existante (si elle existe)</h2>';
    try {
        $pdo->exec("DROP TABLE IF EXISTS ads");
        echo '<p class="success">✅ Table supprimée si elle existait</p>';
    } catch (Exception $e) {
        echo '<p>Table n\'existait pas encore</p>';
    }

    echo '<h2>Étape 2 : Création de la nouvelle table</h2>';

    $sql = "CREATE TABLE ads (
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $pdo->exec($sql);
    echo '<p class="success">✅ Table "ads" créée avec succès !</p>';

    echo '<h2>Étape 3 : Insertion d\'exemples de publicités</h2>';

    $stmt = $pdo->prepare("INSERT INTO ads (title, description, url, position, status, views, clicks) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $examples = [
        ['Bannière Sidebar', 'Publicité dans la barre latérale', 'https://example.com/sidebar', 'sidebar', 'active', 150, 12],
        ['Bannière Header', 'Publicité en haut de page', 'https://example.com/header', 'header', 'active', 320, 45],
        ['Bannière Footer', 'Publicité en bas de page', 'https://example.com/footer', 'footer', 'inactive', 80, 5],
    ];

    foreach ($examples as $example) {
        $stmt->execute($example);
    }

    echo '<p class="success">✅ ' . count($examples) . ' exemples de publicités insérés !</p>';

    echo '<h2>Étape 4 : Vérification</h2>';
    $count = $pdo->query("SELECT COUNT(*) FROM ads")->fetchColumn();
    echo '<p>Nombre de publicités dans la base : <strong>' . $count . '</strong></p>';

    $ads = $pdo->query("SELECT * FROM ads")->fetchAll(PDO::FETCH_ASSOC);
    echo '<pre>' . print_r($ads, true) . '</pre>';

    echo '<hr>';
    echo '<p class="success">🎉 Installation terminée avec succès !</p>';
    echo '<a href="/admin/ads" class="button">📊 Aller à la page des publicités</a>';
    echo '<p style="margin-top: 20px;"><em>Vous pouvez supprimer ce fichier maintenant (public/create_ads_table.php)</em></p>';

} catch (PDOException $e) {
    echo '<p class="error">❌ Erreur PDO : ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
} catch (Exception $e) {
    echo '<p class="error">❌ Erreur : ' . htmlspecialchars($e->getMessage()) . '</p>';
}

echo '</body></html>';
