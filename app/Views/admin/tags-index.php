<?php $title='Admin – Tags'; ?>
<h1>Tags</h1>
<form method="post" action="/admin/tags" class="form"><?= csrf_field() ?>
  <label class="label">Nom <input class="input" name="name" required></label>
  <button class="btn btn-primary">Ajouter</button>
</form>
<table>
  <tr><th>ID</th><th>Nom</th><th>Slug</th><th></th></tr>
  <?php foreach($tags as $t): ?>
  <tr>
    <td><?= (int)$t['id'] ?></td><td><?= esc($t['name']) ?></td><td><?= esc($t['slug']) ?></td>
    <td>
      <form method="post" action="/admin/tags/<?= (int)$t['id'] ?>/delete" style="display:inline">
        <?= csrf_field() ?><button class="btn btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
