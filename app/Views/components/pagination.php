<?php if (!empty($p) && ($p['pages'] ?? 1) > 1): ?>
<nav class="pagination" aria-label="Pagination">
  <?php for($i=1; $i<=($p['pages']??1); $i++): ?>
    <a class="page<?= $i==($p['page']??1) ? ' active':'' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
  <?php endfor; ?>
</nav>
<?php endif; ?>
