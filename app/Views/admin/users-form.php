<?php
$title = $user ? 'Benutzer bearbeiten' : 'Benutzer erstellen';
$isEdit = !empty($user);

$roleColors = [
  'admin'  => 'role-admin',
  'author' => 'role-author',
  'reader' => 'role-reader',
];

$roleIcons = [
  'admin'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>',
  'author' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>',
  'reader' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>',
];
?>

<div class="admin-header">
  <div class="admin-header-content">
    <div class="admin-breadcrumb">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
      </svg>
      <span>Admin</span>
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="9 18 15 12 9 6"></polyline>
      </svg>
      <a href="/admin/users">Benutzer</a>
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="9 18 15 12 9 6"></polyline>
      </svg>
      <span><?= $isEdit ? 'Bearbeiten' : 'Erstellen' ?></span>
    </div>
    <h1 class="admin-title">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <?php if ($isEdit): ?>
          <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
          <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
        <?php else: ?>
          <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="8.5" cy="7" r="4"></circle>
          <line x1="20" y1="8" x2="20" y2="14"></line>
          <line x1="23" y1="11" x2="17" y2="11"></line>
        <?php endif; ?>
      </svg>
      <?= esc($title) ?>
    </h1>
    <p class="admin-subtitle">
      <?= $isEdit ? 'Ändern Sie die Benutzerinformationen' : 'Fügen Sie einen neuen Benutzer zum System hinzu' ?>
    </p>
  </div>
</div>

<form method="post"
      action="<?= $user ? '/admin/users/'.$user['id'].'/update' : '/admin/users' ?>"
      class="user-form">
  <?= csrf_field() ?>

  <div class="form-container">
    <div class="form-card">
      <div class="form-card-header">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
        <h2>Persönliche Informationen</h2>
      </div>

      <div class="form-group">
        <label for="name" class="form-label">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          Vollständiger Name
          <span class="required">*</span>
        </label>
        <input
          id="name"
          class="form-input"
          name="name"
          type="text"
          value="<?= esc($user['name'] ?? '') ?>"
          placeholder="Max Müller"
          required
          autofocus>
      </div>

      <div class="form-group">
        <label for="email" class="form-label">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          E-Mail-Adresse
          <span class="required">*</span>
        </label>
        <input
          id="email"
          class="form-input"
          name="email"
          type="email"
          value="<?= esc($user['email'] ?? '') ?>"
          placeholder="max.mueller@beispiel.de"
          required>
      </div>
    </div>

    <div class="form-card">
      <div class="form-card-header">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
        <h2>Sicherheit</h2>
      </div>

      <div class="form-group">
        <label for="password" class="form-label">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          Passwort
          <?php if (!$isEdit): ?>
            <span class="required">*</span>
          <?php endif; ?>
        </label>
        <div class="password-wrapper">
          <input
            id="password"
            class="form-input"
            name="password"
            type="password"
            placeholder="<?= $isEdit ? 'Leer lassen um nicht zu ändern' : 'Mindestens 6 Zeichen' ?>"
            <?= $user ? '' : 'required' ?>>
          <button class="password-toggle" type="button" id="togglePwd" aria-label="Anzeigen/Verbergen">
            <svg class="eye-open" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
            <svg class="eye-closed" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none">
              <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
              <line x1="1" y1="1" x2="23" y2="23"></line>
            </svg>
          </button>
        </div>
        <?php if ($isEdit): ?>
          <p class="form-hint">Lassen Sie dieses Feld leer, wenn Sie das Passwort nicht ändern möchten</p>
        <?php else: ?>
          <p class="form-hint">Das Passwort muss mindestens 6 Zeichen enthalten</p>
        <?php endif; ?>
      </div>
    </div>

    <div class="form-card">
      <div class="form-card-header">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
          <polyline points="2 17 12 22 22 17"></polyline>
          <polyline points="2 12 12 17 22 12"></polyline>
        </svg>
        <h2>Berechtigungen</h2>
      </div>

      <div class="form-group">
        <label class="form-label">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          Benutzerrolle
          <span class="required">*</span>
        </label>
        <p class="form-hint" style="margin-bottom: 1rem;">Wählen Sie die Zugriffsstufe für diesen Benutzer</p>

        <div class="role-options">
          <label class="role-option <?= (($user['role'] ?? 'reader')==='admin') ? 'selected' : '' ?>">
            <input type="radio" name="role" value="admin" <?= (($user['role'] ?? 'reader')==='admin')?'checked':'' ?> required>
            <div class="role-option-content">
              <div class="role-option-icon role-admin">
                <?= $roleIcons['admin'] ?>
              </div>
              <div class="role-option-info">
                <div class="role-option-name">Administrator</div>
                <div class="role-option-desc">Vollständiger Zugriff auf alle Funktionen</div>
              </div>
            </div>
          </label>

          <label class="role-option <?= (($user['role'] ?? 'reader')==='author') ? 'selected' : '' ?>">
            <input type="radio" name="role" value="author" <?= (($user['role'] ?? 'reader')==='author')?'checked':'' ?> required>
            <div class="role-option-content">
              <div class="role-option-icon role-author">
                <?= $roleIcons['author'] ?>
              </div>
              <div class="role-option-info">
                <div class="role-option-name">Autor</div>
                <div class="role-option-desc">Kann eigene Artikel erstellen und verwalten</div>
              </div>
            </div>
          </label>

          <label class="role-option <?= (($user['role'] ?? 'reader')==='reader') ? 'selected' : '' ?>">
            <input type="radio" name="role" value="reader" <?= (($user['role'] ?? 'reader')==='reader')?'checked':'' ?> required>
            <div class="role-option-content">
              <div class="role-option-icon role-reader">
                <?= $roleIcons['reader'] ?>
              </div>
              <div class="role-option-info">
                <div class="role-option-name">Leser</div>
                <div class="role-option-desc">Kann Artikel lesen und kommentieren</div>
              </div>
            </div>
          </label>
        </div>
      </div>
    </div>
  </div>

  <div class="form-actions">
    <a class="btn-cancel" href="/admin/users">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
      Abbrechen
    </a>
    <button class="btn-submit" type="submit">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <?php if ($isEdit): ?>
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
          <polyline points="17 21 17 13 7 13 7 21"></polyline>
          <polyline points="7 3 7 8 15 8"></polyline>
        <?php else: ?>
          <polyline points="20 6 9 17 4 12"></polyline>
        <?php endif; ?>
      </svg>
      <?= $user ? 'Aktualisieren' : 'Benutzer erstellen' ?>
    </button>
  </div>
</form>

<script>
(function(){
  const btn = document.getElementById('togglePwd');
  const inp = document.getElementById('password');
  const eyeOpen = btn?.querySelector('.eye-open');
  const eyeClosed = btn?.querySelector('.eye-closed');

  if(btn && inp && eyeOpen && eyeClosed){
    btn.addEventListener('click', function(){
      const isPwd = inp.type === 'password';
      inp.type = isPwd ? 'text' : 'password';
      eyeOpen.style.display = isPwd ? 'none' : 'block';
      eyeClosed.style.display = isPwd ? 'block' : 'none';
    });
  }
})();
</script>

<style>
/* ========= Breadcrumb Link ========= */
.admin-breadcrumb a {
  color: var(--text-muted);
  text-decoration: none;
  transition: color var(--transition-fast);
}

.admin-breadcrumb a:hover {
  color: var(--primary);
}

/* ========= User Form Layout ========= */
.user-form {
  max-width: 800px;
  margin: 0 auto;
}

.form-container {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  margin-bottom: 2rem;
}

/* ========= Form Card ========= */
.form-card {
  background: var(--surface);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-lg);
  padding: 2rem;
  box-shadow: var(--shadow-md);
}

.form-card-header {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid var(--border-subtle);
}

.form-card-header svg {
  color: var(--primary);
}

.form-card-header h2 {
  margin: 0;
  font-size: 1.125rem;
  font-weight: 700;
  color: var(--text-primary);
}

/* ========= Form Groups ========= */
.form-group {
  margin-bottom: 1.5rem;
}

.form-group:last-child {
  margin-bottom: 0;
}

.form-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--text-primary);
  margin-bottom: 0.5rem;
}

.form-label svg {
  color: var(--primary);
}

.required {
  color: #ef4444;
  font-weight: 700;
}

.form-input {
  width: 100%;
  padding: 0.875rem 1rem;
  background: rgba(255, 255, 255, 0.03);
  border: 2px solid var(--border-default);
  border-radius: var(--radius-md);
  color: var(--text-primary);
  font-size: 0.95rem;
  font-family: inherit;
  transition: all var(--transition-fast);
}

.form-input::placeholder {
  color: var(--text-muted);
  opacity: 0.6;
}

.form-input:hover {
  border-color: rgba(139, 92, 246, 0.3);
  background: rgba(255, 255, 255, 0.05);
}

.form-input:focus {
  outline: none;
  border-color: var(--primary);
  background: rgba(255, 255, 255, 0.06);
  box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
}

.form-hint {
  margin: 0.5rem 0 0;
  font-size: 0.8125rem;
  color: var(--text-muted);
  line-height: 1.4;
}

/* ========= Password Toggle ========= */
.password-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.password-wrapper .form-input {
  padding-right: 3rem;
}

.password-toggle {
  position: absolute;
  right: 0.75rem;
  background: transparent;
  border: none;
  color: var(--text-muted);
  cursor: pointer;
  padding: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  transition: all 0.2s;
}

.password-toggle:hover {
  color: var(--primary);
  background: rgba(139, 92, 246, 0.1);
}

/* ========= Role Options ========= */
.role-options {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.role-option {
  position: relative;
  cursor: pointer;
  display: block;
}

.role-option input[type="radio"] {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.role-option-content {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1.25rem;
  background: rgba(255, 255, 255, 0.02);
  border: 2px solid var(--border-subtle);
  border-radius: var(--radius-md);
  transition: all var(--transition-fast);
}

.role-option:hover .role-option-content {
  background: rgba(139, 92, 246, 0.05);
  border-color: var(--border-default);
  transform: translateX(4px);
}

.role-option.selected .role-option-content,
.role-option input:checked ~ .role-option-content {
  border-color: var(--primary);
  background: rgba(139, 92, 246, 0.1);
  box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
}

.role-option-icon {
  width: 48px;
  height: 48px;
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
}

.role-option-icon.role-admin {
  background: linear-gradient(135deg, #f59e0b, #d97706);
  box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.role-option-icon.role-author {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.role-option-icon.role-reader {
  background: linear-gradient(135deg, #10b981, #059669);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.role-option-info {
  flex: 1;
}

.role-option-name {
  font-size: 1rem;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 0.25rem;
}

.role-option-desc {
  font-size: 0.875rem;
  color: var(--text-muted);
  line-height: 1.4;
}

/* ========= Form Actions ========= */
.form-actions {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 1rem;
  padding-top: 2rem;
  border-top: 1px solid var(--border-subtle);
}

.btn-cancel {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.875rem 1.75rem;
  background: transparent;
  border: 2px solid var(--border-default);
  border-radius: var(--radius-md);
  color: var(--text-muted);
  font-weight: 600;
  font-size: 0.95rem;
  text-decoration: none;
  transition: all var(--transition-fast);
}

.btn-cancel:hover {
  border-color: #ef4444;
  color: #ef4444;
  background: rgba(239, 68, 68, 0.05);
  transform: translateY(-1px);
}

.btn-submit {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 0.875rem 2rem;
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  border: none;
  border-radius: var(--radius-md);
  color: white;
  font-weight: 600;
  font-size: 0.95rem;
  font-family: inherit;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
  transition: all var(--transition-fast);
}

.btn-submit:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
}

.btn-submit:active {
  transform: translateY(0);
}

/* ========= Responsive ========= */
@media (max-width: 768px) {
  .form-card {
    padding: 1.5rem;
  }

  .form-actions {
    flex-direction: column-reverse;
  }

  .btn-cancel,
  .btn-submit {
    width: 100%;
    justify-content: center;
  }

  .role-option-content {
    flex-direction: column;
    text-align: center;
  }

  .role-option-info {
    text-align: center;
  }
}
</style>
