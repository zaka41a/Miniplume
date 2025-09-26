<?php $title = 'Articles'; ?>
<section class="hero">
  <div class="kicker">Administration</div>
  <h1>Articles</h1>
  <div class="toolbar">
    <a class="btn btn-primary" href="/admin/posts/create">Créer un article</a>
  </div>
</section>

<?php if (empty($posts)): ?>
  <div class="card">
    Aucun article pour le moment.
    <div style="margin-top:12px">
      <a class="btn" href="/admin/posts/create">Publier le premier article</a>
    </div>
  </div>
<?php else: ?>

  <div class="card table-wrapper">
    <table class="table pretty">
      <thead>
        <tr>
          <th class="col-id">ID</th>
          <th>Titre</th>
          <th>Slug</th>
          <th class="col-pub">Publié</th>
          <th class="col-actions">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($posts as $p): ?>
          <tr>
            <td class="mono"><?= (int)$p['id'] ?></td>
            <td>
              <div class="title-cell">
                <a class="title-link" href="/post/<?= esc($p['slug']) ?>" target="_blank">
                  <?= esc($p['title']) ?>
                </a>
                <?php if (!empty($p['published_at'])): ?>
                  <span class="badge badge-success">Publié</span>
                <?php else: ?>
                  <span class="badge badge-muted">Brouillon</span>
                <?php endif; ?>
              </div>
              <div class="meta">par <?= esc($p['author'] ?? '—') ?></div>
            </td>
            <td class="mono muted"><?= esc($p['slug']) ?></td>
            <td>
              <?= $p['published_at']
                    ? esc(date('d/m/Y H:i', strtotime($p['published_at'])))
                    : '—' ?>
            </td>
            <td class="actions">
              <a class="btn-ghost" href="/admin/posts/<?= (int)$p['id'] ?>/edit">Éditer</a>
              <form method="post"
                    action="/admin/posts/<?= (int)$p['id'] ?>/delete"
                    style="display:inline"
                    onsubmit="return confirm('Supprimer « <?= esc($p['title']) ?> » ?');">
                <?= csrf_field() ?>
                <button class="btn btn-danger" type="submit">Supprimer</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php endif; ?>
