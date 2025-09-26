<?php
/** @var array $post */
/** @var array $comments */
$title = esc($post['title']);
$canComment = class_exists('Auth') && \Auth::roleIn(['reader']);
?>

<article class="post card card--soft">
  <?php if (!empty($post['cover_path'])): ?>
    <img src="/uploads/<?= esc($post['cover_path']) ?>" alt="" class="cover">
  <?php endif; ?>

  <h1 class="post-title"><?= esc($post['title']) ?></h1>
  <div class="meta">Par <?= esc($post['author'] ?? '—') ?> ·
    <?= esc(date('d/m/Y H:i', strtotime($post['published_at']))) ?>
  </div>

  <div class="content">
    <?= $post['body'] /* déjà filtré côté admin */ ?>
  </div>

  <?php if (!empty($post['tags'])): ?>
    <div class="tags">
      <?php foreach ($post['tags'] as $t): ?>
        <a class="chip" href="/tag/<?= esc($t['slug']) ?>">#<?= esc($t['name']) ?></a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</article>

<section class="card card--soft" style="margin-top:16px">
  <h2 class="h2">Commentaires</h2>

  <?php if (empty($comments)): ?>
    <p class="muted">Aucun commentaire pour l’instant.</p>
  <?php else: ?>
    <ul class="comments">
      <?php foreach($comments as $c): ?>
        <li class="comment">
          <div class="comment-avatar" aria-hidden="true">
            <?= strtoupper(mb_substr($c['author_name'],0,1,'UTF-8')) ?>
          </div>
          <div class="comment-body">
            <div class="comment-header">
              <strong><?= esc($c['author_name']) ?></strong>
              <span class="dot">•</span>
              <span class="muted"><?= esc(date('d/m/Y H:i', strtotime($c['created_at']))) ?></span>
            </div>
            <p><?= nl2br(esc($c['body'])) ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</section>

<section class="card card--soft" style="margin-top:16px">
  <h3 class="h3">Laisser un commentaire</h3>

  <?php if ($canComment): ?>
    <form class="comment-form" method="post" action="/post/<?= esc($post['slug']) ?>/comments">
      <?= csrf_field() ?>
      <div class="row">
        <label>
          <span>Nom</span>
          <input type="text" name="author_name" required>
        </label>
        <label>
          <span>Email</span>
          <input type="email" name="author_email" required>
        </label>
      </div>

      <label class="block">
        <span>Message</span>
        <textarea name="body" rows="5" required></textarea>
      </label>

      <div class="actions">
        <button class="btn" type="submit">Publier</button>
      </div>
    </form>
  <?php else: ?>
    <div class="callout">
      <div class="callout-text">
        <div class="callout-title">Connexion requise</div>
        <div class="muted">Connectez-vous en tant que <strong>lecteur</strong> pour commenter.</div>
      </div>
      <a class="btn btn-primary" href="/login">Se connecter</a>
    </div>
  <?php endif; ?>
</section>

<style>
/* Conteneurs doux */
.card--soft{padding:18px 20px}

/* Titre & meta */
.post-title{margin:2px 0 6px 0}
.meta{opacity:.8;margin-bottom:12px}
.h2{margin:0 0 8px}
.h3{margin:0 0 8px}

/* Image & tags */
.cover{max-width:100%;border-radius:12px;margin-bottom:12px}
.tags{margin-top:8px}
.chip{display:inline-block;padding:4px 10px;border-radius:999px;border:1px solid rgba(255,255,255,.12);margin:0 6px 6px 0;font-size:.85rem}

/* Liste des commentaires */
.comments{list-style:none;margin:0;padding:0}
.comment{display:flex; gap:12px; padding:12px 0; border-bottom:1px solid rgba(255,255,255,.08)}
.comment:last-child{border-bottom:0}
.comment-avatar{
  width:36px;height:36px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  background:rgba(255,255,255,.08);font-weight:700;
}
.comment-header{margin-bottom:6px}
.dot{opacity:.6;margin:0 6px}
.muted{opacity:.7}

/* Formulaire */
.comment-form .row{display:grid; grid-template-columns:1fr 1fr; gap:12px}
.comment-form label span{display:block; font-size:.9rem; opacity:.85; margin-bottom:6px}
.comment-form input, .comment-form textarea{
  width:100%; padding:10px 12px; border-radius:10px;
  border:1px solid rgba(255,255,255,.12); background:transparent; color:inherit;
}
.comment-form .block{display:block; margin-top:10px}
.comment-form .actions{margin-top:12px; text-align:right}

/* Callout login */
.callout{
  display:flex; align-items:center; justify-content:space-between; gap:14px;
  padding:14px 16px; border-radius:12px;
  border:1px dashed rgba(255,255,255,.22); background:rgba(255,255,255,.03);
}
.callout-title{font-weight:600;margin-bottom:4px}
@media (max-width:720px){
  .comment-form .row{grid-template-columns:1fr}
  .callout{flex-direction:column; align-items:flex-start}
}
</style>
