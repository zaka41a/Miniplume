<?php $title = 'Connexion'; ?>

<div class="auth">
  <div class="auth-card card">
    <h1 class="auth-title">Connexion</h1>

    <?php if (!empty($_SESSION['form_error'])): ?>
      <div class="flash error"><?= esc($_SESSION['form_error']); ?></div>
      <?php unset($_SESSION['form_error']); ?>
    <?php endif; ?>

    <form method="post" action="/login" novalidate>
      <?= csrf_field() ?>

      <label class="field">
        <span>Email</span>
        <input class="input" type="email" name="email" required autofocus autocomplete="username"
               placeholder="vous@exemple.com" value="<?= esc($_POST['email'] ?? '') ?>">
      </label>

      <label class="field">
        <span>Mot de passe</span>
        <div class="password">
          <input class="input" type="password" name="password" required autocomplete="current-password" id="pwd">
          <button class="btn-ghost sm" type="button" id="togglePwd" aria-label="Afficher le mot de passe">Afficher</button>
        </div>
      </label>

      <div class="actions">
        <button class="btn primary" type="submit">Se connecter</button>
        <a class="btn-ghost" href="/">← Retour</a>
      </div>
    </form>

  </div>
</div>

<script>
  (function(){
    const btn = document.getElementById('togglePwd');
    const inp = document.getElementById('pwd');
    if(btn && inp){
      btn.addEventListener('click', function(){
        const isPwd = inp.type === 'password';
        inp.type = isPwd ? 'text' : 'password';
        btn.textContent = isPwd ? 'Masquer' : 'Afficher';
      });
    }
  })();
</script>

<style>
  /* ——— Layout ——— */
  .auth{
    min-height: calc(100vh - 160px); /* header+footer approx */
    display:flex; align-items:center; justify-content:center;
  }
  .auth-card{
    width:100%; max-width:420px; padding:28px;
  }
  .auth-title{
    margin:0 0 18px; font-size:1.6rem; font-weight:700;
    letter-spacing:.3px;
  }

  /* ——— Form ——— */
  .field{ display:block; margin:14px 0; }
  .field > span{ display:block; font-size:.95rem; opacity:.9; margin-bottom:6px; }
  .input{
    width:100%; padding:10px 12px; border-radius:10px;
    border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.03);
    color:inherit; outline:none;
  }
  .input:focus{ border-color: rgba(99,155,255,.55); box-shadow: 0 0 0 3px rgba(99,155,255,.15); }

  .password{ position:relative; display:flex; gap:8px; align-items:center; }
  .password .input{ flex:1; }
  .btn-ghost.sm{ font-size:.85rem; padding:8px 10px; border-radius:10px; }

  .actions{ display:flex; gap:10px; align-items:center; margin-top:14px; }
  .btn.primary{
    background:linear-gradient(135deg,#3b82f6,#2563eb);
    border:none; color:#fff;
  }

  .hint{
    margin-top:12px; font-size:.85rem; opacity:.65;
    text-align:center;
  }

  /* ——— Card & flash (s’appuie sur ton thème existant) ——— */
  .card{
    background: radial-gradient(1200px 400px at 10% 0%, rgba(59,130,246,.08), transparent 60%),
                rgba(255,255,255,.03);
    border:1px solid rgba(255,255,255,.06);
    border-radius:16px;
    box-shadow: 0 10px 30px rgba(0,0,0,.25);
  }
  .flash.error{
    background: rgba(239,68,68,.15);
    border: 1px solid rgba(239,68,68,.35);
    color: #fecaca;
    padding:10px 12px; border-radius:10px; margin-bottom:8px;
  }

  @media (max-width: 520px){
    .auth-card{ padding:22px; border-radius:14px; }
  }
</style>
