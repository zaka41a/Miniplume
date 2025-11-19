<?php $title='Verwaltung'; ?>
<section class="hero">
  <div class="kicker">Dashboard</div>
  <h1>Verwaltung</h1>
</section>

<div class="grid-cards">
  <a class="tile" href="/admin/users">
    <div class="tile-title">Benutzer</div>
    <div class="tile-sub">Erstellen / bearbeiten / löschen</div>
  </a>

  <a class="tile" href="/admin/posts">
    <div class="tile-title">Artikel</div>
    <div class="tile-sub">Alle Artikel verwalten</div>
  </a>

  <a class="tile" href="/admin/tags">
    <div class="tile-title">Tags</div>
    <div class="tile-sub">Themen organisieren</div>
  </a>

  <a class="tile" href="/admin/comments">
    <div class="tile-title">Kommentare</div>
    <div class="tile-sub">Moderation & gelöschte</div>
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
