<?php $title = 'Anmeldung'; ?>

<div class="auth-container">
  <div class="auth-card">
    <div class="auth-header">
      <div class="auth-icon">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
          <polyline points="10 17 15 12 10 7"></polyline>
          <line x1="15" y1="12" x2="3" y2="12"></line>
        </svg>
      </div>
      <h1 class="auth-title">Anmeldung</h1>
      <p class="auth-subtitle">Greifen Sie auf Ihren Miniplume-Bereich zu</p>
    </div>

    <form method="post" action="/login" class="auth-form" novalidate>
      <?= csrf_field() ?>

      <div class="form-group">
        <label for="email" class="form-label">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          Email
        </label>
        <input
          id="email"
          class="form-input"
          type="email"
          name="email"
          required
          autofocus
          autocomplete="username"
          placeholder="vous@exemple.com"
          value="<?= esc($_POST['email'] ?? '') ?>">
      </div>

      <div class="form-group">
        <label for="password" class="form-label">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          Passwort
        </label>
        <div class="password-wrapper">
          <input
            id="password"
            class="form-input"
            type="password"
            name="password"
            required
            autocomplete="current-password">
          <button class="password-toggle" type="button" id="togglePwd" aria-label="Passwort anzeigen/verbergen">
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
      </div>

      <div class="form-actions">
        <button class="btn-submit" type="submit">
          <span>Anmelden</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </button>
        <a class="btn-back" href="/">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
          <span>Zurück zur Startseite</span>
        </a>
      </div>
    </form>

    <div class="auth-footer">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"></circle>
        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
        <line x1="12" y1="17" x2="12.01" y2="17"></line>
      </svg>
      <span>Ihre Anmeldedaten sind durch moderne Verschlüsselung gesichert</span>
    </div>
  </div>

  <div class="auth-bg-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
  </div>
</div>

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
/* ========= Auth Container ========= */
.auth-container {
  min-height: calc(100vh - 180px);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 1rem;
  position: relative;
  overflow: hidden;
}

/* ========= Auth Card ========= */
.auth-card {
  width: 100%;
  max-width: 460px;
  background: linear-gradient(145deg, rgba(26, 31, 53, 0.95), rgba(21, 25, 41, 0.95));
  backdrop-filter: blur(20px);
  border: 1px solid rgba(139, 92, 246, 0.15);
  border-radius: 24px;
  padding: 2.5rem;
  box-shadow:
    0 20px 60px rgba(0, 0, 0, 0.3),
    0 0 80px rgba(139, 92, 246, 0.15);
  position: relative;
  z-index: 1;
  animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.auth-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #8b5cf6, #6366f1, #8b5cf6);
  background-size: 200% 100%;
  border-radius: 24px 24px 0 0;
  animation: shimmer 3s linear infinite;
}

@keyframes shimmer {
  0% { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

/* ========= Auth Header ========= */
.auth-header {
  text-align: center;
  margin-bottom: 2rem;
}

.auth-icon {
  width: 72px;
  height: 72px;
  margin: 0 auto 1.5rem;
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  box-shadow: 0 8px 24px rgba(139, 92, 246, 0.4);
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
}

.auth-title {
  font-size: 1.875rem;
  margin: 0 0 0.5rem;
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.auth-subtitle {
  color: var(--text-muted);
  font-size: 0.95rem;
  margin: 0;
}

/* ========= Auth Form ========= */
.auth-form {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--text-primary);
}

.form-label svg {
  color: var(--primary);
}

.form-input {
  width: 100%;
  padding: 0.875rem 1rem;
  background: rgba(255, 255, 255, 0.03);
  border: 2px solid rgba(139, 92, 246, 0.15);
  border-radius: 12px;
  color: var(--text-primary);
  font-size: 0.95rem;
  font-family: inherit;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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

/* ========= Form Actions ========= */
.form-actions {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  margin-top: 0.5rem;
}

.btn-submit {
  width: 100%;
  padding: 1rem 1.5rem;
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  border: none;
  border-radius: 12px;
  color: white;
  font-weight: 600;
  font-size: 1rem;
  font-family: inherit;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  box-shadow: 0 4px 16px rgba(139, 92, 246, 0.4);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.btn-submit::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  transform: translate(-50%, -50%);
  transition: width 0.6s, height 0.6s;
}

.btn-submit:hover::before {
  width: 300px;
  height: 300px;
}

.btn-submit:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(139, 92, 246, 0.5);
}

.btn-submit:active {
  transform: translateY(0);
}

.btn-submit span,
.btn-submit svg {
  position: relative;
  z-index: 1;
}

.btn-back {
  width: 100%;
  padding: 0.75rem 1.5rem;
  background: transparent;
  border: 2px solid rgba(139, 92, 246, 0.15);
  border-radius: 12px;
  color: var(--text-muted);
  font-weight: 600;
  font-size: 0.9rem;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-back:hover {
  border-color: var(--primary);
  color: var(--primary);
  background: rgba(139, 92, 246, 0.05);
  transform: translateY(-1px);
}

/* ========= Auth Footer ========= */
.auth-footer {
  margin-top: 2rem;
  padding-top: 1.5rem;
  border-top: 1px solid rgba(139, 92, 246, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  color: var(--text-muted);
  font-size: 0.85rem;
}

.auth-footer svg {
  color: var(--primary);
  flex-shrink: 0;
}

/* ========= Background Shapes ========= */
.auth-bg-shapes {
  position: absolute;
  inset: 0;
  overflow: hidden;
  pointer-events: none;
  z-index: 0;
}

.shape {
  position: absolute;
  border-radius: 50%;
  filter: blur(60px);
  opacity: 0.15;
  animation: float 20s ease-in-out infinite;
}

.shape-1 {
  width: 400px;
  height: 400px;
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  top: -200px;
  right: -200px;
  animation-delay: 0s;
}

.shape-2 {
  width: 350px;
  height: 350px;
  background: linear-gradient(135deg, #6366f1, #3b82f6);
  bottom: -175px;
  left: -175px;
  animation-delay: 5s;
}

.shape-3 {
  width: 300px;
  height: 300px;
  background: linear-gradient(135deg, #ec4899, #8b5cf6);
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation-delay: 10s;
}

/* ========= Responsive ========= */
@media (max-width: 520px) {
  .auth-card {
    padding: 2rem 1.5rem;
    border-radius: 20px;
  }

  .auth-title {
    font-size: 1.5rem;
  }

  .auth-icon {
    width: 60px;
    height: 60px;
  }

  .auth-icon svg {
    width: 36px;
    height: 36px;
  }
}
</style>
