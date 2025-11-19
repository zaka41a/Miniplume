<?php
$title = $post ? 'Artikel bearbeiten' : 'Artikel erstellen';
$isEdit = !empty($post);
?>

<!-- Hero Header -->
<div class="form-hero">
  <div class="form-hero-bg"></div>
  <div class="form-hero-content">
    <div class="form-hero-icon">
      <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <?php if ($isEdit): ?>
          <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
          <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
        <?php else: ?>
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="12" y1="11" x2="12" y2="17"></line>
          <line x1="9" y1="14" x2="15" y2="14"></line>
        <?php endif; ?>
      </svg>
    </div>
    <div>
      <div class="form-hero-breadcrumb">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
        </svg>
        <span>Admin</span>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
        <a href="/admin/posts">Artikel</a>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
        <span><?= $isEdit ? 'Bearbeiten' : 'Erstellen' ?></span>
      </div>
      <h1 class="form-hero-title"><?= esc($title) ?></h1>
      <p class="form-hero-desc">
        <?= $isEdit ? 'Bearbeiten Sie Ihren Artikel und veröffentlichen Sie ihn erneut' : 'Schreiben Sie einen neuen Artikel und teilen Sie ihn' ?>
      </p>
    </div>
  </div>
</div>

<form method="post"
      action="<?= $post ? '/admin/posts/'.$post['id'].'/update' : '/admin/posts' ?>"
      enctype="multipart/form-data"
      class="post-form">
  <?= csrf_field() ?>
  <?php if (!empty($post['cover_path'])): ?>
    <input type="hidden" name="existing_cover" value="<?= esc($post['cover_path']) ?>">
  <?php endif; ?>

  <div class="form-grid">
    <!-- Left Column: Main Content -->
    <div class="form-main">
      <div class="form-card">
        <div class="form-card-header">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
          </svg>
          <h2>Artikelinhalt</h2>
        </div>

        <div class="form-group">
          <label for="title" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="17" y1="10" x2="3" y2="10"></line>
              <line x1="21" y1="6" x2="3" y2="6"></line>
              <line x1="21" y1="14" x2="3" y2="14"></line>
              <line x1="17" y1="18" x2="3" y2="18"></line>
            </svg>
            Titre
            <span class="required">*</span>
          </label>
          <input
            id="title"
            class="form-input"
            name="title"
            type="text"
            value="<?= esc($post['title'] ?? '') ?>"
            placeholder="Verlockender Titel Ihres Artikels..."
            required
            autofocus>
        </div>

        <div class="form-group">
          <label for="slug" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
              <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
            </svg>
            Slug (URL)
          </label>
          <input
            id="slug"
            class="form-input"
            name="slug"
            type="text"
            value="<?= esc($post['slug'] ?? '') ?>"
            placeholder="wird-automatisch-generiert">
          <p class="form-hint">Lassen Sie dieses Feld leer, um es automatisch aus dem Titel zu generieren</p>
        </div>

        <div class="form-group">
          <label for="body" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <line x1="16" y1="13" x2="8" y2="13"></line>
              <line x1="16" y1="17" x2="8" y2="17"></line>
              <line x1="12" y1="9" x2="8" y2="9"></line>
            </svg>
            Inhalt
            <span class="required">*</span>
          </label>
          <textarea
            id="body"
            class="form-textarea"
            name="body"
            rows="16"
            placeholder="Schreiben Sie Ihren Artikel hier... (HTML und Markdown werden unterstützt)"
            required><?= esc($post['body'] ?? '') ?></textarea>
          <p class="form-hint">Gefiltertes HTML und Markdown werden unterstützt</p>
        </div>
      </div>
    </div>

    <!-- Right Column: Metadata & Options -->
    <div class="form-sidebar">
      <!-- Publication Settings -->
      <div class="form-card">
        <div class="form-card-header">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <h2>Veröffentlichung</h2>
        </div>

        <div class="form-group">
          <label for="published_at" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Veröffentlichungsdatum
          </label>
          <input
            id="published_at"
            class="form-input"
            name="published_at"
            type="text"
            value="<?= esc($post['published_at'] ?? '') ?>"
            placeholder="2025-09-26 18:30">
          <p class="form-hint">Format: YYYY-MM-DD HH:MM<br>Lassen Sie leer für Entwurf</p>
        </div>
      </div>

      <!-- Cover Image -->
      <div class="form-card">
        <div class="form-card-header">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <circle cx="8.5" cy="8.5" r="1.5"></circle>
            <polyline points="21 15 16 10 5 21"></polyline>
          </svg>
          <h2>Titelbild</h2>
        </div>

        <?php if (!empty($post['cover_path'])): ?>
          <div class="current-cover">
            <img src="/uploads/<?= esc($post['cover_path']) ?>" alt="Aktuelles Titelbild">
            <div class="current-cover-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
              Aktuelles Bild
            </div>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <label for="cover" class="form-label-file">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="17 8 12 3 7 8"></polyline>
              <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <span>Bild wählen</span>
            <input
              id="cover"
              class="form-input-file"
              type="file"
              name="cover"
              accept="image/jpeg,image/png,image/webp">
          </label>
          <p class="form-hint">JPEG, PNG oder WebP (max 5MB)</p>
        </div>
      </div>

      <!-- Tags -->
      <div class="form-card">
        <div class="form-card-header">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
            <line x1="7" y1="7" x2="7.01" y2="7"></line>
          </svg>
          <h2>Tags</h2>
        </div>

        <div class="tags-list">
          <?php if (empty($tags)): ?>
            <p class="form-hint">Keine Tags verfügbar</p>
          <?php else: ?>
            <?php foreach ($tags as $t):
              $sel = in_array($t['id'], $selected ?? [], true);
            ?>
              <label class="tag-checkbox">
                <input
                  type="checkbox"
                  name="tags[]"
                  value="<?= (int)$t['id'] ?>"
                  <?= $sel ? 'checked' : '' ?>>
                <span class="tag-checkbox-label">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                  </svg>
                  <?= esc($t['name']) ?>
                </span>
              </label>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Form Error Display -->
  <?php if (!empty($_SESSION['form_error'])): ?>
    <div class="form-error-banner">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
      </svg>
      <?= esc($_SESSION['form_error']) ?>
    </div>
  <?php endif; ?>

  <!-- Submit Actions -->
  <div class="form-actions">
    <a class="btn-cancel" href="/admin/posts">
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
      <?= $post ? 'Aktualisieren' : 'Artikel erstellen' ?>
    </button>
  </div>
</form>

<?php if (!empty($_SESSION['form_error'])) unset($_SESSION['form_error']); ?>

<style>
/* ==================== ANIMATIONS ==================== */
@keyframes form-float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  33% { transform: translateY(-10px) rotate(2deg); }
  66% { transform: translateY(-5px) rotate(-2deg); }
}

@keyframes form-pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.85; transform: scale(1.05); }
}

@keyframes form-slideUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ==================== HERO HEADER ==================== */
.form-hero {
  position: relative;
  background: linear-gradient(135deg, #1a1f35 0%, #0f1420 100%);
  border-radius: 20px;
  padding: 2.5rem;
  margin-bottom: 2rem;
  overflow: hidden;
  box-shadow:
    0 20px 60px rgba(0, 0, 0, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.05),
    inset 0 1px 0 rgba(255, 255, 255, 0.1);
  animation: form-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.form-hero-bg {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
    radial-gradient(circle at 80% 70%, rgba(99, 102, 241, 0.12) 0%, transparent 50%);
  opacity: 0.6;
  animation: form-pulse 8s ease-in-out infinite;
}

.form-hero-content {
  position: relative;
  display: flex;
  align-items: center;
  gap: 1.5rem;
}

.form-hero-icon {
  width: 80px;
  height: 80px;
  min-width: 80px;
  background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 50%, #7c3aed 100%);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow:
    0 20px 40px rgba(139, 92, 246, 0.5),
    0 0 60px rgba(139, 92, 246, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.1),
    inset 0 1px 2px rgba(255, 255, 255, 0.3);
  animation: form-float 6s ease-in-out infinite;
  position: relative;
}

.form-hero-icon::before {
  content: '';
  position: absolute;
  inset: -4px;
  background: linear-gradient(135deg, #a78bfa, #6366f1);
  border-radius: 24px;
  opacity: 0.6;
  filter: blur(12px);
  z-index: -1;
  animation: form-pulse 4s ease-in-out infinite;
}

.form-hero-icon svg {
  color: white;
  filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
}

.form-hero-breadcrumb {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0.625rem;
  font-size: 0.8125rem;
  color: rgba(255, 255, 255, 0.5);
  font-weight: 600;
}

.form-hero-breadcrumb svg {
  color: #a78bfa;
}

.form-hero-breadcrumb a {
  color: rgba(255, 255, 255, 0.6);
  text-decoration: none;
  transition: color 0.3s;
}

.form-hero-breadcrumb a:hover {
  color: #a78bfa;
}

.form-hero-title {
  margin: 0 0 0.5rem 0;
  font-size: 2.25rem;
  font-weight: 800;
  line-height: 1.1;
  background: linear-gradient(135deg, #a78bfa 0%, #818cf8 50%, #6366f1 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: -0.5px;
}

.form-hero-desc {
  margin: 0;
  font-size: 0.9375rem;
  color: rgba(255, 255, 255, 0.65);
  line-height: 1.5;
}

/* ========= Post Form Layout ========= */
.post-form {
  max-width: 1400px;
  margin: 0 auto;
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 380px;
  gap: 2rem;
  margin-bottom: 2rem;
}

.form-main {
  min-width: 0;
}

.form-sidebar {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

/* ========= Form Card ========= */
.form-card {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(139, 92, 246, 0.15);
  border-radius: 16px;
  padding: 2rem;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  animation: form-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.1s backwards;
}

.form-card:hover {
  border-color: rgba(139, 92, 246, 0.25);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
}

.form-card-header {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid rgba(139, 92, 246, 0.1);
}

.form-card-header svg {
  color: #a78bfa;
  filter: drop-shadow(0 2px 4px rgba(139, 92, 246, 0.3));
}

.form-card-header h2 {
  margin: 0;
  font-size: 1.125rem;
  font-weight: 700;
  background: linear-gradient(135deg, #a78bfa, #818cf8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
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
  color: rgba(255, 255, 255, 0.9);
  margin-bottom: 0.625rem;
}

.form-label svg {
  color: #a78bfa;
}

.required {
  color: #f87171;
  font-weight: 800;
}

.form-input,
.form-textarea {
  width: 100%;
  padding: 0.875rem 1.125rem;
  background: rgba(255, 255, 255, 0.04);
  border: 2px solid rgba(139, 92, 246, 0.15);
  border-radius: 12px;
  color: rgba(255, 255, 255, 0.95);
  font-size: 0.95rem;
  font-family: inherit;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.form-input::placeholder,
.form-textarea::placeholder {
  color: rgba(255, 255, 255, 0.4);
  opacity: 0.7;
}

.form-input:hover,
.form-textarea:hover {
  border-color: rgba(139, 92, 246, 0.3);
  background: rgba(255, 255, 255, 0.06);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.form-input:focus,
.form-textarea:focus {
  outline: none;
  border-color: #8b5cf6;
  background: rgba(255, 255, 255, 0.07);
  box-shadow:
    0 0 0 4px rgba(139, 92, 246, 0.15),
    0 4px 16px rgba(0, 0, 0, 0.15);
}

.form-textarea {
  resize: vertical;
  min-height: 200px;
  line-height: 1.6;
  font-family: 'Consolas', 'Monaco', monospace;
}

.form-hint {
  margin: 0.625rem 0 0;
  font-size: 0.8125rem;
  color: rgba(255, 255, 255, 0.45);
  line-height: 1.5;
  font-weight: 500;
}

/* ========= File Input ========= */
.form-label-file {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.625rem;
  padding: 1rem;
  background: rgba(139, 92, 246, 0.05);
  border: 2px dashed var(--border-default);
  border-radius: var(--radius-md);
  color: var(--text-primary);
  font-weight: 600;
  cursor: pointer;
  transition: all var(--transition-fast);
}

.form-label-file:hover {
  border-color: var(--primary);
  background: rgba(139, 92, 246, 0.1);
  color: var(--primary);
}

.form-label-file svg {
  color: var(--primary);
}

.form-input-file {
  display: none;
}

/* ========= Current Cover Display ========= */
.current-cover {
  position: relative;
  margin-bottom: 1rem;
  border-radius: var(--radius-md);
  overflow: hidden;
  border: 1px solid var(--border-subtle);
}

.current-cover img {
  width: 100%;
  height: auto;
  display: block;
}

.current-cover-label {
  position: absolute;
  top: 0.75rem;
  right: 0.75rem;
  display: flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.375rem 0.75rem;
  background: rgba(16, 185, 129, 0.9);
  color: white;
  font-size: 0.75rem;
  font-weight: 700;
  border-radius: var(--radius-full);
  backdrop-filter: blur(10px);
}

/* ========= Tags List ========= */
.tags-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.tag-checkbox {
  display: flex;
  align-items: center;
  padding: 0.75rem;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-md);
  cursor: pointer;
  transition: all var(--transition-fast);
}

.tag-checkbox:hover {
  background: rgba(139, 92, 246, 0.05);
  border-color: var(--border-default);
}

.tag-checkbox input[type="checkbox"] {
  margin: 0;
  margin-right: 0.75rem;
  width: 18px;
  height: 18px;
  cursor: pointer;
  accent-color: var(--primary);
}

.tag-checkbox-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--text-primary);
}

.tag-checkbox-label svg {
  color: var(--primary);
  opacity: 0.7;
}

.tag-checkbox:has(input:checked) {
  background: rgba(139, 92, 246, 0.1);
  border-color: var(--primary);
}

.tag-checkbox:has(input:checked) .tag-checkbox-label {
  color: var(--primary);
}

/* ========= Form Error Banner ========= */
.form-error-banner {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 1rem 1.5rem;
  background: rgba(239, 68, 68, 0.1);
  border: 1px solid rgba(239, 68, 68, 0.3);
  border-radius: var(--radius-md);
  color: #ef4444;
  font-weight: 600;
  margin-bottom: 2rem;
}

.form-error-banner svg {
  flex-shrink: 0;
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
  gap: 0.625rem;
  padding: 1rem 1.875rem;
  background: rgba(255, 255, 255, 0.03);
  border: 2px solid rgba(239, 68, 68, 0.2);
  border-radius: 12px;
  color: rgba(255, 255, 255, 0.6);
  font-weight: 600;
  font-size: 0.95rem;
  text-decoration: none;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.btn-cancel:hover {
  border-color: #ef4444;
  color: #ef4444;
  background: rgba(239, 68, 68, 0.08);
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(239, 68, 68, 0.2);
}

.btn-cancel:active {
  transform: translateY(0);
}

.btn-submit {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 1rem 2.25rem;
  background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
  border: none;
  border-radius: 12px;
  color: white;
  font-weight: 700;
  font-size: 0.9375rem;
  font-family: inherit;
  cursor: pointer;
  box-shadow:
    0 8px 24px rgba(139, 92, 246, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.2);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
}

.btn-submit::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transform: translateX(-100%);
  transition: transform 0.6s;
}

.btn-submit:hover {
  transform: translateY(-2px);
  box-shadow:
    0 12px 32px rgba(139, 92, 246, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.2),
    inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.btn-submit:hover::before {
  transform: translateX(100%);
}

.btn-submit:active {
  transform: translateY(0);
}

/* ========= Responsive ========= */
@media (max-width: 1024px) {
  .form-grid {
    grid-template-columns: 1fr;
  }

  .form-sidebar {
    order: -1;
  }
}

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
}
</style>
