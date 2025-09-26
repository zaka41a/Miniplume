<?php
namespace App\Controllers;

use App\Models\Post;
use function paginate;
use function render;
use function baseUrl;
use function esc;

class HomeController
{
    /** Accueil par rôle */
   public function index()
{
    $role = $_SESSION['role'] ?? 'guest';

    if ($role === 'admin') {
        return redirect('/admin');
    }

    if ($role === 'author') {
        \requireRole(['author','admin']);
        $posts = (new \App\Models\Post())->byUser((int)($_SESSION['uid'] ?? 0));
        return render('home-author', compact('posts'));
    }

    $page = max(1, (int)($_GET['page'] ?? 1));
    $per  = 10;
    $m = new Post();
    $total = $m->countPublished();
    $p = paginate($page, $per, $total);
    $posts = $m->paginatedPublished($p['perPage'], $p['offset']);
    return render('home-reader', compact('posts','p'));
}

    /* --------- sitemap / rss (tes versions cache OK) --------- */
    public function sitemap(){ /* ta version cache actuelle */ }

}
