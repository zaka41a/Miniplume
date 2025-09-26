<?php $title='Miniplume'; ?>
<section class="hero">
  <div class="kicker">Blog technique</div>
  <h1>Bienvenue sur Miniplume</h1>
  <p class="subtitle">Articles PHP natif + PDO. Parcours par tags, commentaires et flux RSS.</p>
</section>

<?php if (empty($posts)): ?>
  <div class="card">Aucun article publié.</div>
<?php else: ?>
  <div class="grid">
    <?php foreach($posts as $p): ?>
      <article class="card">
        <?php if (!empty($p['cover_path'])): ?>
          <img src="/uploads/<?= esc($p['cover_path']) ?>" alt="">
        <?php endif; ?>
        <h2><a href="/post/<?= esc($p['slug']) ?>"><?= esc($p['title']) ?></a></h2>
        <div class="meta">Par <?= esc($p['author']) ?> · <?= esc(date('d/m/Y', strtotime($p['published_at']))) ?></div>
        <p class="excerpt"><?= esc(excerpt($p['body'], 160)) ?></p>
        <p><a class="btn-ghost" href="/post/<?= esc($p['slug']) ?>">Lire &amp; commenter</a></p>
      </article>
    <?php endforeach; ?>
  </div>
  <?php require __DIR__.'/components/pagination.php'; ?>
<?php endif; ?>

<?php if (class_exists('Auth') && \Auth::check()): ?>
  <p style="margin-top:16px"><a class="btn" href="/me/comments">Mes commentaires</a></p>
<?php endif; ?>
