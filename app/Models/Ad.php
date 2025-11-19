<?php
namespace App\Models;

class Ad extends BaseModel
{
    /**
     * Récupérer toutes les publicités
     */
    public function all(): array
    {
        $stmt = $this->pdo->query("
            SELECT * FROM ads
            ORDER BY created_at DESC
        ");
        return $stmt->fetchAll();
    }

    /**
     * Récupérer les publicités actives par position
     */
    public function getActiveByPosition(string $position): array
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM ads
            WHERE status = 'active'
            AND position = ?
            AND (start_date IS NULL OR start_date <= CURDATE())
            AND (end_date IS NULL OR end_date >= CURDATE())
            ORDER BY created_at DESC
        ");
        $stmt->execute([$position]);
        return $stmt->fetchAll();
    }

    /**
     * Trouver une publicité par ID
     */
    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM ads WHERE id=?");
        $stmt->execute([$id]);
        $ad = $stmt->fetch();
        return $ad ?: null;
    }

    /**
     * Créer une nouvelle publicité
     */
    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO ads (title, description, url, image_path, position, status, start_date, end_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['title'],
            $data['description'] ?? null,
            $data['url'],
            $data['image_path'] ?? null,
            $data['position'] ?? 'sidebar',
            $data['status'] ?? 'active',
            $data['start_date'] ?? null,
            $data['end_date'] ?? null,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Mettre à jour une publicité
     */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE ads
            SET title=?, description=?, url=?, image_path=?, position=?, status=?,
                start_date=?, end_date=?, updated_at=NOW()
            WHERE id=?
        ");
        return $stmt->execute([
            $data['title'],
            $data['description'] ?? null,
            $data['url'],
            $data['image_path'] ?? null,
            $data['position'] ?? 'sidebar',
            $data['status'] ?? 'active',
            $data['start_date'] ?? null,
            $data['end_date'] ?? null,
            $id
        ]);
    }

    /**
     * Supprimer une publicité
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM ads WHERE id=?");
        return $stmt->execute([$id]);
    }

    /**
     * Incrémenter les vues
     */
    public function incrementViews(int $id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE ads SET views = views + 1 WHERE id=?");
        return $stmt->execute([$id]);
    }

    /**
     * Incrémenter les clics
     */
    public function incrementClicks(int $id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE ads SET clicks = clicks + 1 WHERE id=?");
        return $stmt->execute([$id]);
    }

    /**
     * Obtenir les statistiques globales
     */
    public function getStats(): array
    {
        $stmt = $this->pdo->query("
            SELECT
                COUNT(*) as total,
                SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as active,
                SUM(CASE WHEN status = 'inactive' THEN 1 ELSE 0 END) as inactive,
                SUM(views) as total_views,
                SUM(clicks) as total_clicks
            FROM ads
        ");
        return $stmt->fetch() ?: [];
    }
}
