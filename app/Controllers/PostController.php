<?php
namespace App\Controllers; use App\Models\Post; use App\Models\Comment;
class PostController {
public function show($slug)
{
  $post = (new \App\Models\Post())->findBySlug($slug);
  if (!$post || empty($post['published_at'])) {
    http_response_code(404); exit('Artikel nicht gefunden');
  }

  $comments = (new \App\Models\Comment())->approvedForPost((int)$post['id']);
  $canComment = class_exists('Auth') && \Auth::roleIn(['reader']);

  \render('post-show', compact('post','comments','canComment'));
}

}