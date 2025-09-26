<!doctype html>
<html lang="fr"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc(($title ?? 'Miniplume').' · Miniplume') ?></title>
  <link rel="stylesheet" href="/assets/app.css">
</head><body>

<header class="header">
  <div class="header-inner container">
    <a class="brand" href="/"><span class="brand-dot"></span> Miniplume</a>
    <nav class="nav">

  <?php if (class_exists('Auth') && \Auth::check()): ?>
    <?php if (\Auth::roleIn(['admin'])): ?>
      <a class="btn-ghost" href="/admin">Admin</a>
    <?php elseif (\Auth::roleIn(['author'])): ?>
      <a class="btn-ghost" href="/">Mes articles</a>
    <?php endif; ?>

    <?php if (\Auth::roleIn(['reader'])): ?>
  <a class="btn-ghost" href="/me/comments">Mes commentaires</a>
     <?php endif; ?>


    <form method="post" action="/logout" style="display:inline">
      <?= csrf_field() ?>
      <button class="btn btn-danger" type="submit">Logout</button>
    </form>
  <?php else: ?>
    <a class="btn btn-primary" href="/login">Login</a>
  <?php endif; ?>
</nav>

  </div>
</header>

<main class="container">
  <?php if (!empty($_SESSION['flash'])): $f=$_SESSION['flash']; unset($_SESSION['flash']); ?>
    <div class="flash <?= esc($f['type']) ?>"><?= esc($f['msg']) ?></div>
  <?php endif; ?>

  <?= $content ?? '' ?>
</main>

<footer class="footer">
  <div class="container">© 2025 · Miniplume</div>
</footer>

</body></html>
