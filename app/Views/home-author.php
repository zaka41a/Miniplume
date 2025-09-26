<?php $title='Mes articles'; ?>
<section class="hero">
  <div class="kicker">Auteur</div>
  <h1>Mes articles</h1>
  <p><a class="btn btn-primary" href="/admin/posts/create">Publier un article</a></p>
</section>

<?php if (empty($posts)): ?>
  <div class="card">Aucun article. Cliquez sur “Publier un article”.</div>
<?php else: ?>
  <table class="card" style="width:100%">
    <thead><tr><th>ID</th><th>Titre</th><th>Slug</th><th>Publié</th><th style="width:200px"></th></tr></thead>
    <tbody>
    <?php foreach($posts as $p): ?>
      <tr>
        <td><?= (int)$p['id'] ?></td>
        <td><a href="/post/<?= esc($p['slug']) ?>" target="_blank"><?= esc($p['title']) ?></a></td>
        <td><?= esc($p['slug']) ?></td>
        <td><?= $p['published_at'] ? esc(date('d/m/Y H:i', strtotime($p['published_at']))) : '—' ?></td>
        <td>
          <a class="btn-ghost" href="/admin/posts/<?= (int)$p['id'] ?>/edit">Modifier</a>
          <form method="post" action="/admin/posts/<?= (int)$p['id'] ?>/delete" style="display:inline" onsubmit="return confirm('Supprimer ?')">
            <?= csrf_field() ?><button class="btn btn-danger">Supprimer</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
