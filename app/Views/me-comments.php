<?php $title='Mes commentaires'; ?>
<h1>Mes commentaires</h1>

<?php if (empty($comments)): ?>
  <div class="card">Vous n’avez pas encore laissé de commentaires.</div>
<?php else: ?>
  <table class="card" style="width:100%">
    <thead><tr><th>Article</th><th>Extrait</th><th>Statut</th><th>Date</th><th></th></tr></thead>
    <tbody>
      <?php foreach($comments as $c): ?>
        <tr>
          <td><a href="/post/<?= esc($c['slug']) ?>" target="_blank"><?= esc($c['title']) ?></a></td>
          <td><?= esc(excerpt($c['body'], 120)) ?></td>
          <td><?= esc($c['status']) ?></td>
          <td><?= esc($c['created_at']) ?></td>
          <td>
            <form method="post" action="/me/comments/<?= (int)$c['id'] ?>/delete" onsubmit="return confirm('Supprimer ce commentaire ?')" style="display:inline">
              <?= csrf_field() ?><button class="btn btn-danger">Supprimer</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
