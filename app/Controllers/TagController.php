<?php
namespace App\Controllers;

use App\Models\Post;
use App\Models\Tag;
use function paginate;

class TagController {
    public function show($slug) {
        $tag = (new Tag())->findBySlug($slug);
        if (!$tag) { http_response_code(404); exit('Tag introuvable'); }

        $page = max(1, (int)($_GET['page'] ?? 1));
        $per  = 10;

        $m = new Post();
        $total = $m->countPublishedByTag($slug);
        $p = paginate($page, $per, $total);
        $posts = $m->paginatedPublishedByTag($slug, $p['perPage'], $p['offset']);

        render('tag-show', compact('tag','posts','p'));
    }
}
