<?php
/** @var array $comments */
/** @var string $status */
$title = 'Modération des commentaires';
$tab = $status ?? ($_GET['status'] ?? 'pending');
$tabs = [
  'pending'  => 'En attente',
  'approved' => 'Approuvés',
  'spam'     => 'Spam',
];
?>
<section class="moderation">
  <header class="mod-header">
    <div>
      <div class="eyebrow">TABLEAU</div>
      <h1>Modération des commentaires</h1>
    </div>
    <nav class="tabs">
      <?php foreach ($tabs as $key => $label): ?>
        <a class="tab <?= $tab===$key?'active':'' ?>" href="/admin/comments?status=<?= esc($key) ?>"><?= esc($label) ?></a>
      <?php endforeach; ?>
    </nav>
  </header>

  <?php if (empty($comments)): ?>
    <div class="empty card">
      <h3>Aucun commentaire dans « <?= esc($tabs[$tab] ?? $tab) ?> »</h3>
      <p>Quand des lecteurs publieront, ils apparaîtront ici pour validation.</p>
    </div>
  <?php else: ?>
    <div class="table">
      <div class="thead">
        <div class="th col-post">Post</div>
        <div class="th col-author">Auteur</div>
        <div class="th col-excerpt">Extrait</div>
        <div class="th col-date">Date</div>
        <div class="th col-action">Action</div>
      </div>

      <?php foreach ($comments as $c): ?>
        <div class="trow card">
          <div class="td col-post">
            <a class="post-link" href="/post/<?= esc($c['slug']) ?>" target="_blank" rel="noopener">
              <?= esc($c['title']) ?>
            </a>
          </div>

          <div class="td col-author">
            <div class="author">
              <strong><?= esc($c['author_name']) ?></strong>
              <?php if (!empty($c['author_email'])): ?>
                <span class="badge"><?= esc($c['author_email']) ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="td col-excerpt">
            <?= esc(mb_strimwidth(trim($c['body']), 0, 120, '…', 'UTF-8')) ?>
          </div>

          <div class="td col-date">
            <time datetime="<?= esc(date('c', strtotime($c['created_at']))) ?>">
              <?= esc(date('Y-m-d H:i', strtotime($c['created_at']))) ?>
            </time>
          </div>

          <div class="td col-action">
            <form class="action" method="post" action="/admin/comments/<?= (int)$c['id'] ?>/status">
              <?= csrf_field() ?>
              <select name="status" class="select">
                <option value="approved" <?= $tab==='approved'?'selected':'' ?>>Approuver</option>
                <option value="pending"  <?= $tab==='pending'?'selected':'' ?>>Remettre en attente</option>
                <option value="spam"     <?= $tab==='spam'?'selected':'' ?>>Marquer spam</option>
              </select>
              <button class="btn primary" type="submit">OK</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<style>
/* ——— Layout général ——— */
.moderation { padding-top: 8px; }
.mod-header{ display:flex; align-items:flex-end; justify-content:space-between; gap:18px; margin-bottom:18px; }
.eyebrow{ font-size:.78rem; letter-spacing:.18em; text-transform:uppercase; opacity:.65; margin-bottom:6px; }
.mod-header h1{ font-size:1.9rem; margin:0; }

/* ——— Tabs ——— */
.tabs{ display:flex; gap:10px; }
.tab{
  padding:8px 12px; border-radius:999px;
  border:1px solid rgba(255,255,255,.10);
  background:rgba(255,255,255,.03); text-decoration:none;
}
.tab.active{
  border-color: rgba(99,155,255,.45);
  box-shadow: 0 0 0 3px rgba(99,155,255,.15) inset;
}

/* ——— Table responsive en cartes ——— */
.table{ display:flex; flex-direction:column; gap:10px; }
.thead{
  display:grid; grid-template-columns: 2fr 1.3fr 2fr 1fr 1.1fr;
  gap:12px; padding:6px 12px; opacity:.7; font-size:.9rem;
}
.trow{
  display:grid; grid-template-columns: 2fr 1.3fr 2fr 1fr 1.1fr;
  gap:12px; padding:14px; align-items:center;
  border:1px solid rgba(255,255,255,.06);
  border-radius:14px;
  background: radial-gradient(900px 300px at 6% 0%, rgba(59,130,246,.07), transparent 60%),
              rgba(255,255,255,.03);
}
.th{ font-weight:600; }
.post-link{ color:inherit; text-decoration:none; border-bottom:1px dashed rgba(255,255,255,.2); }
.post-link:hover{ border-color: rgba(99,155,255,.6); }

.author{ display:flex; flex-direction:column; gap:4px; }
.badge{
  align-self:flex-start;
  font-size:.82rem; padding:2px 8px; border-radius:999px;
  border:1px solid rgba(255,255,255,.12); opacity:.85;
}

.action{ display:flex; gap:8px; align-items:center; justify-content:flex-end; }
.select{
  padding:8px 10px; border-radius:10px; background:rgba(255,255,255,.04);
  border:1px solid rgba(255,255,255,.12); color:inherit;
}
.btn.primary{
  padding:8px 12px; border-radius:10px; border:0;
  background: linear-gradient(135deg,#3b82f6,#2563eb); color:#fff;
}

/* ——— Empty state ——— */
.empty.card{
  padding:22px;
  border:1px solid rgba(255,255,255,.06);
  border-radius:16px;
  background: rgba(255,255,255,.03);
}
.empty h3{ margin:0 0 6px; }

/* ——— Cards base ——— */
.card{ box-shadow: 0 10px 30px rgba(0,0,0,.22); }

/* ——— Mobile ——— */
@media (max-width: 900px){
  .thead{ display:none; }
  .trow{
    grid-template-columns: 1fr;
    gap:8px;
  }
  .col-action{ justify-self: stretch; }
  .action{ justify-content: flex-start; }
}
</style>

<script>
// Option : auto-soumission en changeant le select (plus rapide)
document.addEventListener('change', (e)=>{
  const sel = e.target.closest('select[name="status"]');
  if (!sel) return;
  const form = sel.closest('form');
  if (form) form.submit();
});
</script>
