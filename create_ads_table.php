<?php
/**
 * Script pour créer la table ads
 * Exécutez ce fichier via : http://localhost:8000/create_ads_table.php
 */

require __DIR__.'/app/Config.php';

try {
    $pdo = db();

    echo "<h2>Création de la table 'ads'...</h2>";

    $sql = "CREATE TABLE IF NOT EXISTS ads (
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
    echo "<p style='color: green; font-weight: bold;'>✅ Table 'ads' créée avec succès !</p>";

    // Insérer quelques exemples
    echo "<h2>Insertion d'exemples de publicités...</h2>";

    $stmt = $pdo->prepare("INSERT INTO ads (title, description, url, position, status) VALUES (?, ?, ?, ?, ?)");

    $examples = [
        ['Bannière Test 1', 'Première publicité de test', 'https://example.com', 'sidebar', 'active'],
        ['Bannière Test 2', 'Deuxième publicité de test', 'https://example.com/promo', 'header', 'active'],
    ];

    foreach ($examples as $example) {
        $stmt->execute($example);
    }

    echo "<p style='color: green; font-weight: bold;'>✅ Exemples de publicités insérés !</p>";

    echo "<h2>Vérification...</h2>";
    $count = $pdo->query("SELECT COUNT(*) FROM ads")->fetchColumn();
    echo "<p>Nombre de publicités dans la base : <strong>{$count}</strong></p>";

    echo "<hr>";
    echo "<p><a href='/admin/ads' style='padding: 10px 20px; background: #8b5cf6; color: white; text-decoration: none; border-radius: 8px;'>Aller à la page des publicités</a></p>";
    echo "<p><em>Vous pouvez supprimer ce fichier (create_ads_table.php) après utilisation.</em></p>";

} catch (PDOException $e) {
    echo "<p style='color: red; font-weight: bold;'>❌ Erreur : " . $e->getMessage() . "</p>";
}
?>

<style>
    body {
        font-family: system-ui, -apple-system, sans-serif;
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background: #0a0e1a;
        color: #e5e7eb;
    }
    h2 {
        color: #8b5cf6;
    }
</style>
