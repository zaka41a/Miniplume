<?php $title='Admin – Utilisateurs'; ?>
<h1>Utilisateurs</h1>
<p><a class="btn btn-primary" href="/admin/users/create">Créer un utilisateur</a></p>
<table>
  <tr><th>ID</th><th>Nom</th><th>Email</th><th>Rôle</th><th></th></tr>
  <?php foreach($users as $u): ?>
  <tr>
    <td><?= (int)$u['id'] ?></td>
    <td><?= esc($u['name']) ?></td>
    <td><?= esc($u['email']) ?></td>
    <td><?= esc($u['role']) ?></td>
    <td>
      <a class="btn-ghost" href="/admin/users/<?= (int)$u['id'] ?>/edit">Éditer</a>
      <form method="post" action="/admin/users/<?= (int)$u['id'] ?>/delete" style="display:inline">
        <?= csrf_field() ?><button class="btn btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
