<?php $title='Accueil'; ?>

<section class="hero">
  <div class="kicker">Blog technique</div>
  <h1>Bienvenue sur Miniplume</h1>
  <p class="subtitle">
    Articles concis en PHP natif + PDO. Parcours par tags, commentaires et flux RSS.
  </p>
</section>

<?php if (empty($posts)): ?>
  <div class="card">
    <h2>Aucun article pour le moment</h2>
    <p class="excerpt">Connectez-vous pour en créer depuis l’admin.</p>
  </div>
<?php else: ?>
  <div class="grid">
    <?php foreach ($posts as $p): ?>
      <article class="card">
        <?php if (!empty($p['cover_path'])): ?>
          <img src="/uploads/<?= esc($p['cover_path']) ?>" alt="">
        <?php endif; ?>
        <h2><a href="/post/<?= esc($p['slug']) ?>"><?= esc($p['title']) ?></a></h2>
        <div class="meta">
          Par <?= esc($p['author'] ?? '—') ?> · <?= esc(date('d/m/Y', strtotime($p['published_at'] ?? $p['created_at'] ?? 'now'))) ?>
        </div>
        <p class="excerpt"><?= esc(excerpt($p['body'] ?? '', 220)) ?></p>

        <?php if (!empty($p['tags'])): ?>
          <div class="tags">
            <?php foreach ($p['tags'] as $t): ?>
              <a class="tag" href="/tag/<?= esc($t['slug']) ?>">#<?= esc($t['name']) ?></a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </article>
    <?php endforeach; ?>
  </div>

  <?php require __DIR__.'/components/pagination.php'; ?>
<?php endif; ?>
