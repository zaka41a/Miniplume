<?php
namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Comment;

class AdminHomeController {
  public function index() {
    \requireRole(['admin']);

    $pdo = \db();

    // Récupérer les statistiques
    $totalPosts = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
    $publishedPosts = $pdo->query("SELECT COUNT(*) FROM posts WHERE published_at IS NOT NULL")->fetchColumn();
    $draftPosts = $pdo->query("SELECT COUNT(*) FROM posts WHERE published_at IS NULL")->fetchColumn();

    $totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $totalTags = $pdo->query("SELECT COUNT(*) FROM tags")->fetchColumn();
    $totalComments = $pdo->query("SELECT COUNT(*) FROM comments")->fetchColumn();
    $pendingComments = $pdo->query("SELECT COUNT(*) FROM comments WHERE status = 'pending'")->fetchColumn();

    // Articles récents
    $recentPosts = $pdo->query("
      SELECT p.*, u.name AS author
      FROM posts p
      JOIN users u ON u.id = p.user_id
      ORDER BY p.created_at DESC
      LIMIT 5
    ")->fetchAll(\PDO::FETCH_ASSOC);

    // Commentaires récents
    $recentComments = $pdo->query("
      SELECT c.*, p.title AS post_title, p.slug AS post_slug
      FROM comments c
      JOIN posts p ON p.id = c.post_id
      ORDER BY c.created_at DESC
      LIMIT 5
    ")->fetchAll(\PDO::FETCH_ASSOC);

    \render('home-admin', [
      'totalPosts' => $totalPosts,
      'publishedPosts' => $publishedPosts,
      'draftPosts' => $draftPosts,
      'totalUsers' => $totalUsers,
      'totalTags' => $totalTags,
      'totalComments' => $totalComments,
      'pendingComments' => $pendingComments,
      'recentPosts' => $recentPosts,
      'recentComments' => $recentComments,
    ]);
  }
}
