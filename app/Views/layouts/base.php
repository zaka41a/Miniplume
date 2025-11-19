<!doctype html>
<html lang="de"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc(($title ?? 'Miniplume').' · Miniplume') ?></title>
  <link rel="icon" type="image/svg+xml" href="/favicon.svg">
  <link rel="apple-touch-icon" href="/favicon.svg">
  <meta name="theme-color" content="#8b5cf6">
  <link rel="stylesheet" href="/assets/app.css">
</head><body>

<header class="header">
  <div class="header-inner container">
    <a class="brand" href="/">
      <img src="/assets/logo.svg" alt="Miniplume" class="brand-logo">
    </a>
    <nav class="nav">
      <?php if (class_exists('Auth') && \Auth::check()): ?>
        <!-- Admin/Author Links -->
        <?php if (\Auth::roleIn(['admin'])): ?>
          <a class="nav-link" href="/admin">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
              <path d="M2 17l10 5 10-5"></path>
              <path d="M2 12l10 5 10-5"></path>
            </svg>
            <span>Admin</span>
          </a>
        <?php elseif (\Auth::roleIn(['author'])): ?>
          <a class="nav-link" href="/">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
            </svg>
            <span>Meine Artikel</span>
          </a>
        <?php endif; ?>

        <!-- Reader Link -->
        <?php if (\Auth::roleIn(['reader'])): ?>
          <a class="nav-link" href="/me/comments">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <span>Meine Kommentare</span>
          </a>
        <?php endif; ?>

        <!-- User Profile Badge -->
        <div class="nav-user">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          <span class="nav-user-name">
            <?php
              $roleNames = [
                'admin' => 'Administrator',
                'author' => 'Autor',
                'reader' => 'Leser'
              ];
              echo $roleNames[$_SESSION['role']] ?? 'Benutzer';
            ?>
          </span>
        </div>

        <!-- Logout Button -->
        <form method="post" action="/logout" class="nav-logout-form">
          <?= csrf_field() ?>
          <button class="nav-btn-logout" type="submit">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
              <polyline points="16 17 21 12 16 7"></polyline>
              <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            <span>Abmelden</span>
          </button>
        </form>
      <?php else: ?>
        <!-- Login Button -->
        <a class="nav-btn-login" href="/login">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
            <polyline points="10 17 15 12 10 7"></polyline>
            <line x1="15" y1="12" x2="3" y2="12"></line>
          </svg>
          <span>Anmelden</span>
        </a>
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
  <div class="container">© <?= date('Y') ?> Miniplume • Technische Blog-Plattform</div>
</footer>

</body></html>
