<?php
$title = $ad ? 'Werbung bearbeiten' : 'Werbung erstellen';
$isEdit = !empty($ad);
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
      <a href="/admin/ads">Werbung</a>
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
          <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
          <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
        <?php endif; ?>
      </svg>
      <?= esc($title) ?>
    </h1>
    <p class="admin-subtitle">
      <?= $isEdit ? 'Bearbeiten Sie Ihre Werbung' : 'Erstellen Sie einen neuen Werbebanner' ?>
    </p>
  </div>
</div>

<form method="post"
      action="<?= $ad ? '/admin/ads/'.$ad['id'].'/update' : '/admin/ads' ?>"
      enctype="multipart/form-data"
      class="ads-form">
  <?= csrf_field() ?>
  <?php if (!empty($ad['image_path'])): ?>
    <input type="hidden" name="existing_image" value="<?= esc($ad['image_path']) ?>">
  <?php endif; ?>

  <div class="form-grid">
    <!-- Main Content -->
    <div class="form-main">
      <div class="form-card">
        <div class="form-card-header">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
          </svg>
          <h2>Werbe-Informationen</h2>
        </div>

        <div class="form-group">
          <label for="title" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="17" y1="10" x2="3" y2="10"></line>
              <line x1="21" y1="6" x2="3" y2="6"></line>
              <line x1="21" y1="14" x2="3" y2="14"></line>
              <line x1="17" y1="18" x2="3" y2="18"></line>
            </svg>
            Titel
            <span class="required">*</span>
          </label>
          <input
            id="title"
            class="form-input"
            name="title"
            type="text"
            value="<?= esc($ad['title'] ?? '') ?>"
            placeholder="Name der Werbekampagne..."
            required
            autofocus>
        </div>

        <div class="form-group">
          <label for="description" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <line x1="16" y1="13" x2="8" y2="13"></line>
              <line x1="16" y1="17" x2="8" y2="17"></line>
              <line x1="12" y1="9" x2="8" y2="9"></line>
            </svg>
            Beschreibung
          </label>
          <textarea
            id="description"
            class="form-textarea"
            name="description"
            rows="4"
            placeholder="Werbebeschreibung (optional)..."><?= esc($ad['description'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
          <label for="url" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
              <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
            </svg>
            Ziel-URL
            <span class="required">*</span>
          </label>
          <input
            id="url"
            class="form-input"
            name="url"
            type="url"
            value="<?= esc($ad['url'] ?? '') ?>"
            placeholder="https://example.com"
            required>
          <p class="form-hint">Die URL, auf die die Anzeige umleitet</p>
        </div>
      </div>
    </div>

    <!-- Sidebar: Settings -->
    <div class="form-sidebar">
      <!-- Image -->
      <div class="form-card">
        <div class="form-card-header">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <circle cx="8.5" cy="8.5" r="1.5"></circle>
            <polyline points="21 15 16 10 5 21"></polyline>
          </svg>
          <h2>Bild</h2>
        </div>

        <?php if (!empty($ad['image_path'])): ?>
          <div class="current-ad-image">
            <img src="/uploads/<?= esc($ad['image_path']) ?>" alt="Image actuelle">
            <div class="current-ad-image-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
              Aktuelles Bild
            </div>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <label for="image" class="form-label-file">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="17 8 12 3 7 8"></polyline>
              <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <span>Ein Bild auswahlen</span>
            <input
              id="image"
              class="form-input-file"
              type="file"
              name="image"
              accept="image/jpeg,image/png,image/webp,image/gif">
          </label>
          <p class="form-hint">JPEG, PNG, WebP oder GIF (max 5MB)</p>
        </div>
      </div>

      <!-- Position & Status -->
      <div class="form-card">
        <div class="form-card-header">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <h2>Einstellungen</h2>
        </div>

        <div class="form-group">
          <label for="position" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            Position
            <span class="required">*</span>
          </label>
          <select
            id="position"
            class="form-select"
            name="position"
            required>
            <option value="sidebar" <?= ($ad['position'] ?? 'sidebar') === 'sidebar' ? 'selected' : '' ?>>
              Seitenleiste
            </option>
            <option value="header" <?= ($ad['position'] ?? '') === 'header' ? 'selected' : '' ?>>
              Kopfzeile
            </option>
            <option value="footer" <?= ($ad['position'] ?? '') === 'footer' ? 'selected' : '' ?>>
              Fusszeile
            </option>
            <option value="content" <?= ($ad['position'] ?? '') === 'content' ? 'selected' : '' ?>>
              Inhalt
            </option>
          </select>
          <p class="form-hint">Position der Anzeige auf der Website</p>
        </div>

        <div class="form-group">
          <label for="status" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="9 11 12 14 22 4"></polyline>
              <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            Status
            <span class="required">*</span>
          </label>
          <div class="status-options">
            <label class="status-option">
              <input
                type="radio"
                name="status"
                value="active"
                <?= ($ad['status'] ?? 'active') === 'active' ? 'checked' : '' ?>
                required>
              <span class="status-option-content">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                  <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>Aktiv</span>
              </span>
            </label>
            <label class="status-option">
              <input
                type="radio"
                name="status"
                value="inactive"
                <?= ($ad['status'] ?? '') === 'inactive' ? 'checked' : '' ?>
                required>
              <span class="status-option-content">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="15" y1="9" x2="9" y2="15"></line>
                  <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <span>Inaktiv</span>
              </span>
            </label>
          </div>
        </div>
      </div>

      <!-- Dates -->
      <div class="form-card">
        <div class="form-card-header">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
          <h2>Planung</h2>
        </div>

        <div class="form-group">
          <label for="start_date" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            Startdatum
          </label>
          <input
            id="start_date"
            class="form-input"
            name="start_date"
            type="date"
            value="<?= esc($ad['start_date'] ?? '') ?>">
          <p class="form-hint">Leer lassen, um sofort zu aktivieren</p>
        </div>

        <div class="form-group">
          <label for="end_date" class="form-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="12" y1="8" x2="12" y2="12"></line>
              <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            Enddatum
          </label>
          <input
            id="end_date"
            class="form-input"
            name="end_date"
            type="date"
            value="<?= esc($ad['end_date'] ?? '') ?>">
          <p class="form-hint">Leer lassen, um kein Enddatum festzulegen</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Submit Actions -->
  <div class="form-actions">
    <a class="btn-cancel" href="/admin/ads">
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
      <?= $ad ? 'Aktualisieren' : 'Werbung erstellen' ?>
    </button>
  </div>
</form>

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

/* ========= Ads Form Layout ========= */
.ads-form {
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

.form-input,
.form-textarea,
.form-select {
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

.form-input::placeholder,
.form-textarea::placeholder {
  color: var(--text-muted);
  opacity: 0.6;
}

.form-input:hover,
.form-textarea:hover,
.form-select:hover {
  border-color: rgba(139, 92, 246, 0.3);
  background: rgba(255, 255, 255, 0.05);
}

.form-input:focus,
.form-textarea:focus,
.form-select:focus {
  outline: none;
  border-color: var(--primary);
  background: rgba(255, 255, 255, 0.06);
  box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
}

.form-textarea {
  resize: vertical;
  min-height: 100px;
  line-height: 1.6;
}

.form-select {
  cursor: pointer;
}

.form-hint {
  margin: 0.5rem 0 0;
  font-size: 0.8125rem;
  color: var(--text-muted);
  line-height: 1.4;
}

/* ========= File Upload ========= */
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

/* ========= Current Image ========= */
.current-ad-image {
  position: relative;
  margin-bottom: 1rem;
  border-radius: var(--radius-md);
  overflow: hidden;
  border: 1px solid var(--border-subtle);
}

.current-ad-image img {
  width: 100%;
  height: auto;
  display: block;
}

.current-ad-image-label {
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

/* ========= Status Options ========= */
.status-options {
  display: flex;
  gap: 1rem;
}

.status-option {
  flex: 1;
  position: relative;
  cursor: pointer;
}

.status-option input[type="radio"] {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.status-option-content {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 0.875rem;
  background: rgba(255, 255, 255, 0.02);
  border: 2px solid var(--border-subtle);
  border-radius: var(--radius-md);
  font-weight: 600;
  transition: all var(--transition-fast);
}

.status-option:hover .status-option-content {
  background: rgba(139, 92, 246, 0.05);
  border-color: var(--border-default);
}

.status-option input:checked ~ .status-option-content {
  border-color: var(--primary);
  background: rgba(139, 92, 246, 0.1);
  color: var(--primary);
}

.status-option-content svg {
  color: var(--primary);
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

  .status-options {
    flex-direction: column;
  }
}
</style>
