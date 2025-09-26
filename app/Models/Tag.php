<?php
namespace App\Models;
class Tag extends BaseModel {
  public function all(): array {
    return $this->pdo->query("SELECT * FROM tags ORDER BY name")->fetchAll();
  }
  public function create(string $name,string $slug): int {
    $s=$this->pdo->prepare("INSERT INTO tags(name,slug) VALUES(?,?)"); $s->execute([$name,$slug]);
    return (int)$this->pdo->lastInsertId();
  }
  public function delete(int $id): void {
    $this->pdo->prepare("DELETE FROM tags WHERE id=?")->execute([$id]);
  }
  public function findBySlug(string $slug): ?array {
    $s = $this->pdo->prepare("SELECT * FROM tags WHERE slug = ? LIMIT 1");
    $s->execute([$slug]);
    return $s->fetch() ?: null;
}


}
