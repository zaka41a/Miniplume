<?php
require __DIR__.'/../app/Config.php';
require __DIR__.'/../app/Helpers.php';
require __DIR__.'/../app/Router.php';
require __DIR__.'/../app/Auth.php';

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    if (strpos($class, $prefix) !== 0) return;
    $relative = str_replace('\\', '/', substr($class, strlen($prefix)));
    $file = __DIR__ . '/../app/' . $relative . '.php';
    if (is_file($file)) require $file;
});

$router = new Router();

/* --------- Public / Reader ---------- */
$router->get('/',                          [App\Controllers\HomeController::class, 'index']);
$router->get('/post/{slug}',               [App\Controllers\PostController::class, 'show']);
$router->post('/post/{slug}/comments',     [App\Controllers\CommentController::class, 'store']);
$router->get('/tag/{slug}',                [App\Controllers\TagController::class, 'show']);

/* --------- Reader : Mes commentaires ---------- */
$router->get('/me/comments',               [App\Controllers\CommentController::class, 'mine']);
$router->post('/me/comments/{id}/delete',  [App\Controllers\CommentController::class, 'destroyMine']);

/* --------- Auth ---------- */
$router->get('/login',                     [App\Controllers\Admin\DashboardController::class, 'loginForm']);
$router->post('/login',                    [App\Controllers\Admin\DashboardController::class, 'login']);
$router->post('/logout',                   [App\Controllers\Admin\DashboardController::class, 'logout']);

$router->get('/sitemap.xml',               [App\Controllers\HomeController::class, 'sitemap']);
$router->get('/feed.rss',                  [App\Controllers\HomeController::class, 'rss']);

/* --------- Admin (dashboard + CRUD) ---------- */
$router->get('/admin',                     [App\Controllers\Admin\AdminHomeController::class, 'index']);

$router->group('/admin', function($r) {
  // Articles
  $r->get('/posts',               [App\Controllers\Admin\PostAdminController::class, 'index']);
  $r->get('/posts/create',        [App\Controllers\Admin\PostAdminController::class, 'create']);
  $r->post('/posts',              [App\Controllers\Admin\PostAdminController::class, 'store']);
  $r->get('/posts/{id}/edit',     [App\Controllers\Admin\PostAdminController::class, 'edit']);
  $r->post('/posts/{id}/update',  [App\Controllers\Admin\PostAdminController::class, 'update']);
  $r->post('/posts/{id}/delete',  [App\Controllers\Admin\PostAdminController::class, 'destroy']);

  // Tags
  $r->get('/tags',                [App\Controllers\Admin\TagAdminController::class, 'index']);
  $r->post('/tags',               [App\Controllers\Admin\TagAdminController::class, 'store']);
  $r->post('/tags/{id}/delete',   [App\Controllers\Admin\TagAdminController::class, 'destroy']);

  // Commentaires (modération, y compris “supprimés” si tu fais du soft-delete)
  $r->get('/comments',            [App\Controllers\Admin\CommentAdminController::class,'index']);
  $r->post('/comments/{id}/status',[App\Controllers\Admin\CommentAdminController::class,'setStatus']);

  // Utilisateurs
  $r->get('/users',               [App\Controllers\Admin\UserAdminController::class,'index']);
  $r->get('/users/create',        [App\Controllers\Admin\UserAdminController::class,'create']);
  $r->post('/users',              [App\Controllers\Admin\UserAdminController::class,'store']);
  $r->get('/users/{id}/edit',     [App\Controllers\Admin\UserAdminController::class,'edit']);
  $r->post('/users/{id}/update',  [App\Controllers\Admin\UserAdminController::class,'update']);
  $r->post('/users/{id}/delete',  [App\Controllers\Admin\UserAdminController::class,'destroy']);

  // Publicités
  $r->get('/ads',                 [App\Controllers\Admin\AdsAdminController::class,'index']);
  $r->get('/ads/create',          [App\Controllers\Admin\AdsAdminController::class,'create']);
  $r->post('/ads',                [App\Controllers\Admin\AdsAdminController::class,'store']);
  $r->get('/ads/{id}/edit',       [App\Controllers\Admin\AdsAdminController::class,'edit']);
  $r->post('/ads/{id}/update',    [App\Controllers\Admin\AdsAdminController::class,'update']);
  $r->post('/ads/{id}/delete',    [App\Controllers\Admin\AdsAdminController::class,'destroy']);
});

$router->dispatch($_SERVER['REQUEST_METHOD'], strtok($_SERVER['REQUEST_URI'],'?'));
