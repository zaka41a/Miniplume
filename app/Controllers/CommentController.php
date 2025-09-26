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
    if (!$post) { http_response_code(404); exit('Article introuvable'); }

    // 2) Seuls les lecteurs peuvent commenter
    if (!class_exists('Auth') || !\Auth::roleIn(['reader'])) {
        $_SESSION['intended'] = '/post/'.$slug;
        $_SESSION['flash'] = ['type'=>'error','msg'=>'Vous devez être connecté en tant que lecteur pour commenter.'];
        return \redirect('/login');
    }

    // 3) Validation
    $name  = trim($_POST['author_name']  ?? '');
    $email = trim($_POST['author_email'] ?? '');
    $body  = trim($_POST['body']         ?? '');
    if ($name==='' || $email==='' || $body==='') {
      $_SESSION['flash']=['type'=>'error','msg'=>'Tous les champs sont requis.'];
      return \redirect('/post/'.$slug);
    }

    // 4) La colonne user_id existe ?
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

    $_SESSION['flash']=['type'=>'success','msg'=>'Commentaire envoyé (en attente de validation).'];
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
    $_SESSION['flash']=['type'=>$ok?'success':'error','msg'=>$ok?'Commentaire supprimé':'Suppression impossible'];
    return \redirect('/me/comments');
  }
}
