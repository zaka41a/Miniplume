<?php $title = $user ? 'Éditer utilisateur' : 'Créer utilisateur'; ?>
<h1><?= esc($title) ?></h1>
<form class="form" method="post" action="<?= $user ? '/admin/users/'.$user['id'].'/update' : '/admin/users' ?>">
  <?= csrf_field() ?>
  <label class="label">Nom <input class="input" name="name" value="<?= esc($user['name'] ?? '') ?>" required></label>
  <label class="label">Email <input class="input" type="email" name="email" value="<?= esc($user['email'] ?? '') ?>" required></label>
  <label class="label">Mot de passe <?= $user ? '(laisser vide pour ne pas changer)' : '' ?>
    <input class="input" type="password" name="password" <?= $user ? '' : 'required' ?>>
  </label>
  <label class="label">Rôle
    <select class="input" name="role" required>
      <?php foreach (['admin','author','reader'] as $r): ?>
        <option value="<?= $r ?>" <?= (($user['role'] ?? '')===$r)?'selected':'' ?>><?= $r ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <button class="btn btn-primary"><?= $user?'Mettre à jour':'Créer' ?></button>
</form>
