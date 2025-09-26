<?php
namespace App\Models;

class Post extends BaseModel
{
  public function countPublished(): int {
    return (int)$this->pdo->query("SELECT COUNT(*) FROM posts WHERE published_at IS NOT NULL")->fetchColumn();
  }

  public function paginatedPublished(int $limit,int $offset): array {
    $s=$this->pdo->prepare("
      SELECT p.*, u.name AS author
      FROM posts p JOIN users u ON u.id=p.user_id
      WHERE p.published_at IS NOT NULL
      ORDER BY p.published_at DESC
      LIMIT :l OFFSET :o
    ");
    $s->bindValue(':l',$limit,\PDO::PARAM_INT);
    $s->bindValue(':o',$offset,\PDO::PARAM_INT);
    $s->execute(); return $s->fetchAll();
  }

  /** Liste complète pour l'admin */
  public function allAdmin(): array {
    return $this->pdo->query("
      SELECT p.*, u.name AS author
      FROM posts p JOIN users u ON u.id=p.user_id
      ORDER BY p.created_at DESC
    ")->fetchAll();
  }

  public function findById(int $id): ?array {
    $s=$this->pdo->prepare("SELECT * FROM posts WHERE id=?");
    $s->execute([$id]);
    return $s->fetch() ?: null;
  }

  /** Trouver par slug (utilisé par PostController::show) */
  public function findBySlug(string $slug): ?array {
    $s=$this->pdo->prepare("
      SELECT p.*, u.name AS author
      FROM posts p JOIN users u ON u.id=p.user_id
      WHERE p.slug=? LIMIT 1
    ");
    $s->execute([$slug]);
    $post = $s->fetch();
    if (!$post) return null;

    // tags associés (optionnel mais utile)
    $ts = $this->pdo->prepare("
      SELECT t.id,t.name,t.slug
      FROM tags t JOIN post_tag pt ON pt.tag_id=t.id
      WHERE pt.post_id=?
      ORDER BY t.name
    ");
    $ts->execute([$post['id']]);
    $post['tags'] = $ts->fetchAll();

    return $post;
  }

  public function create(array $data,array $tagIds): int {
    $this->pdo->beginTransaction();
    $s=$this->pdo->prepare("
      INSERT INTO posts(user_id,title,slug,body,cover_path,published_at)
      VALUES (?,?,?,?,?,?)
    ");
    $s->execute([
      $data['user_id'],$data['title'],$data['slug'],$data['body'],
      $data['cover_path']??null,$data['published_at']??null
    ]);
    $id=(int)$this->pdo->lastInsertId();

    if (!empty($tagIds)) {
      $pt=$this->pdo->prepare("INSERT INTO post_tag(post_id,tag_id) VALUES(?,?)");
      foreach($tagIds as $tid){ $pt->execute([$id,(int)$tid]); }
    }
    $this->pdo->commit(); return $id;
  }

  public function updatePost(int $id,array $data,array $tagIds): void {
    $s=$this->pdo->prepare("
      UPDATE posts SET title=?, slug=?, body=?, cover_path=?, published_at=?, updated_at=NOW()
      WHERE id=?
    ");
    $s->execute([
      $data['title'],$data['slug'],$data['body'],$data['cover_path']??null,
      $data['published_at']??null,$id
    ]);

    $this->pdo->prepare("DELETE FROM post_tag WHERE post_id=?")->execute([$id]);
    if (!empty($tagIds)) {
      $pt=$this->pdo->prepare("INSERT INTO post_tag(post_id,tag_id) VALUES(?,?)");
      foreach($tagIds as $tid){ $pt->execute([$id,(int)$tid]); }
    }
  }

  public function delete(int $id): void {
    $this->pdo->prepare("DELETE FROM posts WHERE id=?")->execute([$id]);
  }

  /* ---- pour /tag/{slug} ---- */

  public function countPublishedByTag(string $tagSlug): int {
    $s = $this->pdo->prepare("
      SELECT COUNT(*)
      FROM posts p
      JOIN post_tag pt ON pt.post_id = p.id
      JOIN tags t ON t.id = pt.tag_id
      WHERE t.slug = ? AND p.published_at IS NOT NULL
    ");
    $s->execute([$tagSlug]);
    return (int)$s->fetchColumn();
  }

  public function paginatedPublishedByTag(string $tagSlug, int $limit, int $offset): array {
    $s = $this->pdo->prepare("
      SELECT p.*, u.name AS author
      FROM posts p
      JOIN users u ON u.id = p.user_id
      JOIN post_tag pt ON pt.post_id = p.id
      JOIN tags t ON t.id = pt.tag_id
      WHERE t.slug = ? AND p.published_at IS NOT NULL
      ORDER BY p.published_at DESC
      LIMIT :l OFFSET :o
    ");
    $s->bindValue(':l', $limit, \PDO::PARAM_INT);
    $s->bindValue(':o', $offset, \PDO::PARAM_INT);
    $s->execute([$tagSlug]);
    return $s->fetchAll();
  }

  /** Pour l'accueil auteur */
  public function byUser(int $userId): array {
    $s=$this->pdo->prepare("
      SELECT p.*, u.name AS author
      FROM posts p JOIN users u ON u.id=p.user_id
      WHERE p.user_id=? ORDER BY p.created_at DESC
    ");
    $s->execute([$userId]); return $s->fetchAll();
  }
}
