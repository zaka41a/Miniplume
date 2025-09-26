<?php

/**
 * Échappe une chaîne pour sortie HTML.
 */
function esc(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
/**
 * Crée un dossier récursivement si nécessaire (droits 0775).
 */
function ensure_dir(string $dir): void {
  if (!is_dir($dir)) @mkdir($dir, 0775, true);
}


/**
 * Rendu d'une vue dans le layout principal.
 */
function render(string $view, array $data = []): void {
  extract($data);
  ob_start();
  require __DIR__ . '/Views/' . $view . '.php';
  $content = ob_get_clean();
  require __DIR__ . '/Views/layouts/base.php';
}

/**
 * Redirection sûre (vide les buffers avant d'envoyer les headers).
 */
function redirect(string $path): void {
  while (ob_get_level() > 0) { ob_end_clean(); }
  header('Location: ' . $path, true, 302);
  flush();
  exit;
}

/**
 * Base URL absolue (gère HTTPS et proxy).
 */
function baseUrl(string $path = '/'): string {
  $scheme = 'http';
  if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') $scheme = 'https';
  if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) $scheme = $_SERVER['HTTP_X_FORWARDED_PROTO'];
  $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
  return $scheme . '://' . $host . $path;
}

/**
 * Extrait textuel raccourci depuis HTML/Markdown.
 */
function excerpt(string $html, int $len = 180): string {
  $t = strip_tags($html);
  return mb_strimwidth($t, 0, $len, '…', 'UTF-8');
}

/* ---------------- CSRF ---------------- */

function csrf_token(): string {
  if (empty($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(32)); }
  return $_SESSION['csrf'];
}

function csrf_field(): string {
  return '<input type="hidden" name="_token" value="' . esc(csrf_token()) . '">';
}

function csrf_check(): void {
  if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $ok = isset($_POST['_token']) && hash_equals($_SESSION['csrf'] ?? '', $_POST['_token']);
    if (!$ok) { http_response_code(419); exit('CSRF token invalide.'); }
  }
}

/* ------------- Pagination ------------- */

function paginate(int $page, int $perPage, int $total): array {
  $pages  = max(1, (int)ceil($total / $perPage));
  $page   = max(1, min($page, $pages));
  $offset = ($page - 1) * $perPage;
  return [
    'page' => $page,
    'perPage' => $perPage,
    'pages' => $pages,
    'offset' => $offset,
    'total' => $total,
  ];
}

/* --------------- Slugify --------------- */

/**
 * Slugifier simple avec fallback si iconv est indisponible.
 */
function slugify(string $title): string {
  $s = $title;
  if (function_exists('iconv')) {
    $tmp = @iconv('UTF-8', 'ASCII//TRANSLIT', $s);
    if ($tmp !== false) $s = $tmp;
  }
  // Remplace tout ce qui n'est pas lettre/chiffre par des tirets
  $s = preg_replace('~[^\pL\d]+~u', '-', $s);
  $s = trim($s, '-');
  $s = strtolower($s);
  // Garde uniquement [a-z0-9-]
  $s = preg_replace('~[^a-z0-9-]+~', '', $s);
  return $s !== '' ? $s : bin2hex(random_bytes(4));
}

/* -------------- Markdown --------------- */

/**
 * Convertit un Markdown léger en HTML, puis applique une whitelist de balises.
 * Support : **gras**, *italique*, `code`, [lien](https://...), titres ##/###, listes -, paragraphes.
 * Anti-XSS : tout est échappé puis on réintroduit des balises autorisées.
 */
function md(string $text): string {
  // Normalisation
  $text = str_replace(["\r\n", "\r"], "\n", $text);
  // On échappe d'abord tout
  $html = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

  // Titres (ordre du plus spécifique au moins spécifique)
  $html = preg_replace('/^###\s*(.+)$/m', '<h3>$1</h3>', $html);
  $html = preg_replace('/^##\s*(.+)$/m',  '<h2>$1</h2>', $html);

  // Gras / italique / code (non-gourmand)
  $html = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $html);
  $html = preg_replace('/\*(.+?)\*/s',      '<em>$1</em>',        $html);
  $html = preg_replace('/`([^`]+)`/',       '<code>$1</code>',    $html);

  // Liens http/https uniquement
  $html = preg_replace_callback('/\[(.+?)\]\((https?:\/\/[^\s)]+)\)/', function ($m) {
    $txt = htmlspecialchars($m[1], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $url = htmlspecialchars($m[2], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    return '<a href="'.$url.'" rel="noopener nofollow" target="_blank">'.$txt.'</a>';
  }, $html);

  // Listes à puces "- "
  $html = preg_replace_callback('/(?:^|\n)-\s.+(?:\n-\s.+)*/', function ($m) {
    $items = preg_split('/\n/', trim($m[0]));
    $lis = '';
    foreach ($items as $it) {
      $lis .= '<li>'.trim(preg_replace('/^-\\s*/', '', $it)).'</li>';
    }
    return '<ul>'.$lis.'</ul>';
  }, $html);

  // Paragraphes sur double saut de ligne
  $parts = preg_split('/\n{2,}/', $html);
  foreach ($parts as &$p) {
    if (!preg_match('/^\s*<(h2|h3|ul|pre|blockquote)/', $p)) {
      $p = '<p>'.preg_replace('/\n/', '<br>', $p).'</p>';
    }
  }
  $html = implode("\n", $parts);

  // Whitelist stricte des balises autorisées
  $allowed = '<p><br><strong><em><code><pre><h2><h3><ul><ol><li><a><blockquote>';
  $html = strip_tags($html, $allowed);

  return $html;
  
}
