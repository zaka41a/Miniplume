<?php $title = $post ? 'Éditer article' : 'Créer article'; ?>
<h1><?= esc($title) ?></h1>

<form method="post"
      action="<?= $post ? '/admin/posts/'.$post['id'].'/update' : '/admin/posts' ?>"
      enctype="multipart/form-data">
  <?= csrf_field() ?>
  <?php if (!empty($post['cover_path'])): ?>
    <input type="hidden" name="existing_cover" value="<?= esc($post['cover_path']) ?>">
  <?php endif; ?>

  <table style="width:100%;max-width:900px;border-collapse:separate;border-spacing:0 10px">
    <tbody>
      <tr>
        <td style="width:260px" class="label">Titre</td>
        <td><input class="input" name="title" value="<?= esc($post['title'] ?? '') ?>" required></td>
      </tr>

      <tr>
        <td class="label">Slug <div class="meta">auto si vide</div></td>
        <td><input class="input" name="slug" value="<?= esc($post['slug'] ?? '') ?>" placeholder="auto si vide"></td>
      </tr>

      <tr>
        <td class="label">Contenu (HTML/Markdown filtré)</td>
        <td><textarea class="input" name="body" rows="12"><?= esc($post['body'] ?? '') ?></textarea></td>
      </tr>

      <tr>
        <td class="label">Publier à (YYYY-mm-dd HH:ii)</td>
        <td><input class="input" name="published_at" value="<?= esc($post['published_at'] ?? '') ?>" placeholder="2025-09-26 18:30"></td>
      </tr>

      <tr>
        <td class="label">Image de couverture</td>
        <td>
          <input class="input" type="file" name="cover" accept="image/jpeg,image/png,image/webp">
          <?php if (!empty($post['cover_path'])): ?>
            <div class="meta" style="margin-top:6px">Actuelle : /uploads/<?= esc($post['cover_path']) ?></div>
          <?php endif; ?>
        </td>
      </tr>

      <tr>
        <td class="label">Tags</td>
        <td>
          <div class="tags" style="gap:12px">
            <?php foreach ($tags as $t): $sel = in_array($t['id'], $selected ?? [], true); ?>
              <label>
                <input type="checkbox" name="tags[]" value="<?= (int)$t['id'] ?>" <?= $sel?'checked':'' ?>>
                #<?= esc($t['name']) ?>
              </label>
            <?php endforeach; ?>
          </div>
        </td>
      </tr>

      <!-- Message d’erreur de formulaire (sous les champs) -->
      <?php if (!empty($_SESSION['form_error'])): ?>
      <tr>
        <td></td>
        <td>
          <div class="flash error"><?= esc($_SESSION['form_error']) ?></div>
        </td>
      </tr>
      <?php endif; ?>

      <tr>
        <td></td>
        <td>
          <button class="btn btn-primary" type="submit"><?= $post ? 'Mettre à jour' : 'Créer' ?></button>
        </td>
      </tr>
    </tbody>
  </table>
</form>

<?php if (!empty($_SESSION['form_error'])) unset($_SESSION['form_error']); ?>
