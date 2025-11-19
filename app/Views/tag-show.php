<?php $title = 'Tag #'.esc($tag['name']); ?>

<section class="hero">
  <div class="kicker">Nach Tag</div>
  <h1>#<?= esc($tag['name']) ?></h1>
  <p class="subtitle">Veröffentlichte Artikel mit dem Tag "<?= esc($tag['name']) ?>".</p>
</section>

<?php if (empty($posts)): ?>
  <div class="card"><p>Keine Artikel für diesen Tag.</p></div>
<?php else: ?>
  <div class="grid">
    <?php foreach ($posts as $p): ?>
      <article class="card">
        <?php if (!empty($p['cover_path'])): ?>
          <img src="/uploads/<?= esc($p['cover_path']) ?>" alt="">
        <?php endif; ?>
        <h2><a href="/post/<?= esc($p['slug']) ?>"><?= esc($p['title']) ?></a></h2>
        <div class="meta">
          Von <?= esc($p['author'] ?? '—') ?> · <?= esc(date('d/m/Y', strtotime($p['published_at'] ?? $p['created_at']))) ?>
        </div>
        <p class="excerpt"><?= esc(excerpt($p['body'] ?? '', 220)) ?></p>
      </article>
    <?php endforeach; ?>
  </div>

  <?php require __DIR__.'/components/pagination.php'; ?>
<?php endif; ?>
