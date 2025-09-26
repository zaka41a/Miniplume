<?php $title='Administration'; ?>
<section class="hero">
  <div class="kicker">Tableau de bord</div>
  <h1>Administration</h1>
</section>

<div class="grid-cards">
  <a class="tile" href="/admin/users">
    <div class="tile-title">Utilisateurs</div>
    <div class="tile-sub">Créer / éditer / supprimer</div>
  </a>

  <a class="tile" href="/admin/posts">
    <div class="tile-title">Articles</div>
    <div class="tile-sub">Gérer tous les articles</div>
  </a>

  <a class="tile" href="/admin/tags">
    <div class="tile-title">Tags</div>
    <div class="tile-sub">Organiser les sujets</div>
  </a>

  <a class="tile" href="/admin/comments">
    <div class="tile-title">Commentaires</div>
    <div class="tile-sub">Modération & supprimés</div>
  </a>
</div>

<style>
.grid-cards{display:grid;grid-template-columns:repeat(2,minmax(240px,1fr));gap:16px;max-width:850px}
.tile{display:block;padding:16px;border-radius:14px;border:1px solid rgba(255,255,255,.1);
  background:rgba(255,255,255,.03);text-decoration:none}
.tile:hover{background:rgba(255,255,255,.05)}
.tile-title{font-weight:700;margin-bottom:6px}
.tile-sub{opacity:.8}
@media (max-width:720px){.grid-cards{grid-template-columns:1fr}}
</style>
