<?php
namespace App\Models;

class Comment extends BaseModel
{
  public function listByStatus(string $status='pending'): array {
    $s=$this->pdo->prepare("
      SELECT c.*, p.title, p.slug
      FROM comments c JOIN posts p ON p.id=c.post_id
      WHERE c.status=? ORDER BY c.created_at DESC
    ");
    $s->execute([$status]); return $s->fetchAll();
  }

  public function setStatus(int $id,string $status): void {
    $s=$this->pdo->prepare("UPDATE comments SET status=? WHERE id=?");
    $s->execute([$status,$id]);
  }

  /** Vérifie si la colonne user_id existe dans comments */
  private function hasUserId(): bool {
    $s = $this->pdo->prepare("
      SELECT COUNT(*) FROM information_schema.COLUMNS
      WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME='comments' AND COLUMN_NAME='user_id'
    ");
    $s->execute();
    return (int)$s->fetchColumn() > 0;
  }

  /** Mes commentaires (fonctionne même si comments.user_id n'existe pas) */
  public function mine(int $userId): array {
    if ($this->hasUserId()) {
      $s=$this->pdo->prepare("
        SELECT c.*, p.title, p.slug
        FROM comments c JOIN posts p ON p.id=c.post_id
        WHERE c.user_id=? ORDER BY c.created_at DESC
      ");
      $s->execute([$userId]); return $s->fetchAll();
    }

    // Fallback : match via l'email de l'utilisateur
    $u = $this->pdo->prepare("SELECT email FROM users WHERE id=? LIMIT 1");
    $u->execute([$userId]);
    $email = $u->fetchColumn();
    if (!$email) return [];

    $s=$this->pdo->prepare("
      SELECT c.*, p.title, p.slug
      FROM comments c JOIN posts p ON p.id=c.post_id
      WHERE c.author_email=? ORDER BY c.created_at DESC
    ");
    $s->execute([$email]); return $s->fetchAll();
  }

  /** Suppression par l'auteur (fallback sans user_id : via email) */
  public function deleteByIdAndUser(int $id,int $userId): bool {
    if ($this->hasUserId()) {
      $s=$this->pdo->prepare("DELETE FROM comments WHERE id=? AND user_id=?");
      return $s->execute([$id,$userId]);
    }
    $u = $this->pdo->prepare("SELECT email FROM users WHERE id=? LIMIT 1");
    $u->execute([$userId]);
    $email = $u->fetchColumn();
    if (!$email) return false;

    $s=$this->pdo->prepare("DELETE FROM comments WHERE id=? AND author_email=?");
    return $s->execute([$id,$email]);
  }
  public function approvedForPost(int $postId): array {
    $s = $this->pdo->prepare("
      SELECT id, post_id, author_name, author_email, body, status, created_at
      FROM comments
      WHERE post_id = ? AND status = 'approved'
      ORDER BY created_at ASC
    ");
    $s->execute([$postId]);
    return $s->fetchAll();
  }
}
