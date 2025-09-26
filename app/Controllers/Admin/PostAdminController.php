<?php
namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\Tag;

class PostAdminController {
  public function index() {
    \requireRole(['admin','author']);
    $posts = (new Post())->allAdmin();
    render('admin/posts-index', compact('posts'));
  }

  public function create() {
    \requireRole(['admin','author']);
    $tags = (new Tag())->all();
    render('admin/posts-form', ['tags'=>$tags, 'post'=>null]);
  }

  public function store() {
    \requireRole(['admin','author']);

    $title = trim($_POST['title'] ?? '');
    if ($title === '') {
      $_SESSION['flash'] = ['type'=>'error','msg'=>'Le titre est requis'];
      $_SESSION['form_error'] = 'Le titre est requis.';
      return redirect('/admin/posts/create');
    }

    $slug = trim($_POST['slug'] ?? '') ?: slugify($title);
    $body = $_POST['body'] ?? '';

    // ✅ Option: publier automatiquement si vide
    $published_at = $_POST['published_at'] ?: date('Y-m-d H:i:s');

    $tagIds = array_map('intval', $_POST['tags'] ?? []);

    // --- Upload cover (optionnel)
    $cover = null;
    if (!empty($_FILES['cover']['tmp_name'])) {
      $max = 2 * 1024 * 1024; // 2 Mo
      $ok  = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];

      if ($_FILES['cover']['size'] > $max) {
        $_SESSION['flash'] = ['type'=>'error','msg'=>'Image trop lourde (> 2 Mo)'];
        $_SESSION['form_error'] = 'Image trop lourde (> 2 Mo).';
        return redirect('/admin/posts/create');
      }
      $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($_FILES['cover']['tmp_name']);
      if (!isset($ok[$mime])) {
        $_SESSION['flash'] = ['type'=>'error','msg'=>'Type d’image non autorisé'];
        $_SESSION['form_error'] = 'Type d’image non autorisé (jpeg/png/webp).';
        return redirect('/admin/posts/create');
      }
      $name = bin2hex(random_bytes(8)).'.'.$ok[$mime];
      $dest = __DIR__.'/../../../public/uploads/'.$name;
      if (!move_uploaded_file($_FILES['cover']['tmp_name'], $dest)) {
        $_SESSION['flash'] = ['type'=>'error','msg'=>'Échec de l’upload'];
        $_SESSION['form_error'] = 'Échec de l’upload de l’image.';
        return redirect('/admin/posts/create');
      }
      $cover = $name;
    }

    (new Post())->create([
      'user_id'      => $_SESSION['uid'],
      'title'        => $title,
      'slug'         => $slug,
      'body'         => $body,
      'cover_path'   => $cover,
      'published_at' => $published_at
    ], $tagIds);

    // Nettoyage message de formulaire si tout est OK
    unset($_SESSION['form_error']);

    $_SESSION['flash'] = ['type'=>'success','msg'=>'Article créé'];
    return redirect('/admin/posts');
  }

  public function edit($id) {
    \requireRole(['admin','author']);
    $m = new Post();
    $post = $m->findById((int)$id);
    if (!$post) { http_response_code(404); exit('Not found'); }

    $tags = (new Tag())->all();
    // Tags associés
    $pdo = \db();
    $rs = $pdo->prepare("SELECT tag_id FROM post_tag WHERE post_id=?");
    $rs->execute([$id]);
    $selected = array_column($rs->fetchAll(), 'tag_id');

    render('admin/posts-form', compact('post','tags','selected'));
  }

  public function update($id) {
    \requireRole(['admin','author']);

    $title = trim($_POST['title'] ?? '');
    if ($title === '') {
      $_SESSION['flash'] = ['type'=>'error','msg'=>'Le titre est requis'];
      $_SESSION['form_error'] = 'Le titre est requis.';
      return redirect('/admin/posts/'.$id.'/edit');
    }

    $slug = trim($_POST['slug'] ?? '') ?: slugify($title);
    $body = $_POST['body'] ?? '';
    // En édition, on respecte la valeur fournie (pas de publication auto)
    $published_at = $_POST['published_at'] ?: null;
    $tagIds = array_map('intval', $_POST['tags'] ?? []);

    // Conserver la cover existante si pas de nouvel upload
    $cover = $_POST['existing_cover'] ?? null;

    if (!empty($_FILES['cover']['tmp_name'])) {
      $max = 2 * 1024 * 1024; // 2 Mo
      $ok  = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];

      if ($_FILES['cover']['size'] > $max) {
        $_SESSION['flash'] = ['type'=>'error','msg'=>'Image trop lourde (> 2 Mo)'];
        $_SESSION['form_error'] = 'Image trop lourde (> 2 Mo).';
        return redirect('/admin/posts/'.$id.'/edit');
      }
      $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($_FILES['cover']['tmp_name']);
      if (!isset($ok[$mime])) {
        $_SESSION['flash'] = ['type'=>'error','msg'=>'Type d’image non autorisé'];
        $_SESSION['form_error'] = 'Type d’image non autorisé (jpeg/png/webp).';
        return redirect('/admin/posts/'.$id.'/edit');
      }
      $name = bin2hex(random_bytes(8)).'.'.$ok[$mime];
      $dest = __DIR__.'/../../../public/uploads/'.$name;
      if (!move_uploaded_file($_FILES['cover']['tmp_name'], $dest)) {
        $_SESSION['flash'] = ['type'=>'error','msg'=>'Échec de l’upload'];
        $_SESSION['form_error'] = 'Échec de l’upload de l’image.';
        return redirect('/admin/posts/'.$id.'/edit');
      }
      $cover = $name;
    }

    (new Post())->updatePost((int)$id, [
      'title'        => $title,
      'slug'         => $slug,
      'body'         => $body,
      'cover_path'   => $cover,
      'published_at' => $published_at,
    ], $tagIds);

    unset($_SESSION['form_error']);

    $_SESSION['flash'] = ['type'=>'success','msg'=>'Article mis à jour'];
    return redirect('/admin/posts');
  }

  public function destroy($id) {
    \requireRole(['admin','author']);
    (new Post())->delete((int)$id);
    $_SESSION['flash'] = ['type'=>'success','msg'=>'Article supprimé'];
    return redirect('/admin/posts');
  }
}
