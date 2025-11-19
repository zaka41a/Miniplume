<?php
namespace App\Controllers;

use App\Models\Comment;

class CommentController {
  /** Depuis /post/{slug} */
  // app/Controllers/CommentController.php
public function store($slug)
{
    \csrf_check();

    // 1) Post existant & publié
    $pdo = \db();
    $s = $pdo->prepare("SELECT id,slug FROM posts WHERE slug=? AND published_at IS NOT NULL LIMIT 1");
    $s->execute([$slug]);
    $post = $s->fetch();
    if (!$post) { http_response_code(404); exit('Artikel nicht gefunden'); }

    // 2) Seuls les lecteurs et admins peuvent commenter
    if (!class_exists('Auth') || !\Auth::roleIn(['reader', 'admin'])) {
        $_SESSION['intended'] = '/post/'.$slug;
        $_SESSION['flash'] = ['type'=>'error','msg'=>'Sie müssen angemeldet sein, um zu kommentieren.'];
        return \redirect('/login');
    }

    // 3) Récupérer les informations de l'utilisateur connecté
    $userId = $_SESSION['uid'] ?? null;
    $userStmt = $pdo->prepare("SELECT name, email FROM users WHERE id=? LIMIT 1");
    $userStmt->execute([$userId]);
    $user = $userStmt->fetch();
    if (!$user) {
        $_SESSION['flash'] = ['type'=>'error','msg'=>'Benutzer nicht gefunden.'];
        return \redirect('/login');
    }
    $name  = $user['name'];
    $email = $user['email'];

    // 4) Validation du message
    $body  = trim($_POST['body'] ?? '');
    if ($body === '') {
      $_SESSION['flash']=['type'=>'error','msg'=>'Die Nachricht ist erforderlich.'];
      return \redirect('/post/'.$slug);
    }

    // 5) La colonne user_id existe ?
    $hasUserId = (bool)$pdo->query("
        SELECT COUNT(*) FROM information_schema.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = 'comments'
          AND COLUMN_NAME = 'user_id'
    ")->fetchColumn();

    if ($hasUserId) {
        $ins = $pdo->prepare("
          INSERT INTO comments(post_id,user_id,author_name,author_email,body,status,created_at)
          VALUES(?,?,?,?,?,'pending',NOW())
        ");
        $ins->execute([$post['id'], $_SESSION['uid'] ?? null, $name, $email, $body]);
    } else {
        $ins = $pdo->prepare("
          INSERT INTO comments(post_id,author_name,author_email,body,status,created_at)
          VALUES(?,?,?,?, 'pending', NOW())
        ");
        $ins->execute([$post['id'], $name, $email, $body]);
    }

    $_SESSION['flash']=['type'=>'success','msg'=>'Kommentar gesendet (wartet auf Genehmigung).'];
    return \redirect('/post/'.$slug);
}



  /** Page reader : mes commentaires */
  public function mine() {
    if (empty($_SESSION['uid'])) { $_SESSION['intended']='/me/comments'; return \redirect('/login'); }
    $comments=(new Comment())->mine((int)$_SESSION['uid']);
    \render('me-comments', compact('comments'));
  }

  /** Supprimer un de MES commentaires */
  public function destroyMine($id) {
    \csrf_check();
    if (empty($_SESSION['uid'])) return \redirect('/login');
    $ok=(new Comment())->deleteByIdAndUser((int)$id,(int)$_SESSION['uid']);
    $_SESSION['flash']=['type'=>$ok?'success':'error','msg'=>$ok?'Kommentar gelöscht':'Löschen nicht möglich'];
    return \redirect('/me/comments');
  }
}
