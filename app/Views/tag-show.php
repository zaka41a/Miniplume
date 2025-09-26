<?php $title = 'Tag #'.esc($tag['name']); ?>

<section class="hero">
  <div class="kicker">Par tag</div>
  <h1>#<?= esc($tag['name']) ?></h1>
  <p class="subtitle">Articles publiés avec le tag “<?= esc($tag['name']) ?>”.</p>
</section>

<?php if (empty($posts)): ?>
  <div class="card"><p>Aucun article pour ce tag.</p></div>
<?php else: ?>
  <div class="grid">
    <?php foreach ($posts as $p): ?>
      <article class="card">
        <?php if (!empty($p['cover_path'])): ?>
          <img src="/uploads/<?= esc($p['cover_path']) ?>" alt="">
        <?php endif; ?>
        <h2><a href="/post/<?= esc($p['slug']) ?>"><?= esc($p['title']) ?></a></h2>
        <div class="meta">
          Par <?= esc($p['author'] ?? '—') ?> · <?= esc(date('d/m/Y', strtotime($p['published_at'] ?? $p['created_at']))) ?>
        </div>
        <p class="excerpt"><?= esc(excerpt($p['body'] ?? '', 220)) ?></p>
      </article>
    <?php endforeach; ?>
  </div>

  <?php require __DIR__.'/components/pagination.php'; ?>
<?php endif; ?>
