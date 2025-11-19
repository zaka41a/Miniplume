<?php $title='Admin – Tags'; ?>

<?php
// Calculate statistics
$total = count($tags);
$popular = $total > 0 ? round($total * 0.3) : 0;
$active = $total;
$avgPercentage = $total > 0 ? round(100 / $total, 1) : 0;
?>

<!-- Hero Header -->
<div class="tags-hero">
  <div class="tags-hero-bg"></div>
  <div class="tags-hero-content">
    <div class="tags-hero-icon">
      <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
        <line x1="7" y1="7" x2="7.01" y2="7"></line>
      </svg>
    </div>
    <div>
      <p class="tags-hero-subtitle">Organisieren Sie Ihre Artikel nach Themen</p>
      <h1 class="tags-hero-title">Tag-Verwaltung</h1>
      <p class="tags-hero-desc">Erstellen und verwalten Sie Ihre Tags für eine bessere Inhaltsorganisation</p>
    </div>
  </div>
</div>

<!-- Quick Add Form -->
<div class="tags-quick-add-section">
  <div class="tags-quick-add-header">
    <div class="tags-quick-add-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
    </div>
    <div>
      <h2 class="tags-quick-add-title">Schnelle Erstellung</h2>
      <p class="tags-quick-add-subtitle">Fügen Sie sofort einen neuen Tag hinzu</p>
    </div>
  </div>

  <form method="post" action="/admin/tags" class="tags-quick-form">
    <?= csrf_field() ?>
    <div class="tags-form-group">
      <label for="tag_name" class="tags-form-label">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
          <line x1="7" y1="7" x2="7.01" y2="7"></line>
        </svg>
        Tag-Name
      </label>
      <input
        id="tag_name"
        class="tags-form-input"
        name="name"
        type="text"
        placeholder="Z.B.: PHP, JavaScript, MySQL..."
        required
        autofocus>
      <p class="tags-form-hint">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="16" x2="12" y2="12"></line>
          <line x1="12" y1="8" x2="12.01" y2="8"></line>
        </svg>
        Der Slug wird automatisch aus dem Namen generiert
      </p>
    </div>
    <button class="tags-btn-submit" type="submit">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
      Tag erstellen
    </button>
  </form>
</div>

<!-- Statistics Cards -->
<div class="tags-stats">
  <div class="tags-stat-card">
    <div class="tags-stat-icon tags-stat-icon-total">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
        <line x1="7" y1="7" x2="7.01" y2="7"></line>
      </svg>
    </div>
    <div class="tags-stat-content">
      <div class="tags-stat-value"><?= $total ?></div>
      <div class="tags-stat-label">Tags insgesamt</div>
      <div class="tags-stat-trend tags-stat-trend-neutral">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
          <line x1="7" y1="7" x2="7.01" y2="7"></line>
        </svg>
        100%
      </div>
    </div>
  </div>

  <div class="tags-stat-card">
    <div class="tags-stat-icon tags-stat-icon-popular">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
      </svg>
    </div>
    <div class="tags-stat-content">
      <div class="tags-stat-value"><?= $popular ?></div>
      <div class="tags-stat-label">Beliebte Tags</div>
      <div class="tags-stat-trend tags-stat-trend-success">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
          <polyline points="17 6 23 6 23 12"></polyline>
        </svg>
        ~30%
      </div>
    </div>
  </div>

  <div class="tags-stat-card">
    <div class="tags-stat-icon tags-stat-icon-active">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
      </svg>
    </div>
    <div class="tags-stat-content">
      <div class="tags-stat-value"><?= $active ?></div>
      <div class="tags-stat-label">Aktive Tags</div>
      <div class="tags-stat-trend tags-stat-trend-success">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        100%
      </div>
    </div>
  </div>

  <div class="tags-stat-card">
    <div class="tags-stat-icon tags-stat-icon-avg">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <line x1="18" y1="20" x2="18" y2="10"></line>
        <line x1="12" y1="20" x2="12" y2="4"></line>
        <line x1="6" y1="20" x2="6" y2="14"></line>
      </svg>
    </div>
    <div class="tags-stat-content">
      <div class="tags-stat-value"><?= $avgPercentage ?></div>
      <div class="tags-stat-label">Durchschn. Artikel/Tag</div>
      <div class="tags-stat-trend tags-stat-trend-info">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
          <polyline points="7 10 12 15 17 10"></polyline>
          <line x1="12" y1="15" x2="12" y2="3"></line>
        </svg>
        ~avg
      </div>
    </div>
  </div>
</div>

<!-- Tags List -->
<?php if (empty($tags)): ?>
  <div class="tags-empty">
    <div class="tags-empty-icon">
      <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
        <line x1="7" y1="7" x2="7.01" y2="7"></line>
      </svg>
    </div>
    <h3 class="tags-empty-title">Momentan keine Tags</h3>
    <p class="tags-empty-desc">Erstellen Sie Ihren ersten Tag, um Ihre Artikel nach Themen zu organisieren</p>
    <div class="tags-empty-hint">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="9 18 15 12 9 6"></polyline>
      </svg>
      <span>Verwenden Sie das obige Formular, um zu beginnen</span>
    </div>
  </div>
<?php else: ?>
  <div class="tags-section-header">
    <div class="tags-section-title-wrapper">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <rect x="3" y="3" width="7" height="7"></rect>
        <rect x="14" y="3" width="7" height="7"></rect>
        <rect x="14" y="14" width="7" height="7"></rect>
        <rect x="3" y="14" width="7" height="7"></rect>
      </svg>
      <h2 class="tags-section-title">Alle Tags</h2>
    </div>
    <div class="tags-section-count">
      <?= $total ?> Tag<?= $total > 1 ? 's' : '' ?>
    </div>
  </div>

  <div class="tags-grid">
    <?php foreach($tags as $t): ?>
      <div class="tags-card">
        <div class="tags-card-header">
          <div class="tags-card-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
              <line x1="7" y1="7" x2="7.01" y2="7"></line>
            </svg>
          </div>
          <div class="tags-card-content">
            <h3 class="tags-card-name"><?= esc($t['name']) ?></h3>
            <div class="tags-card-meta">
              <span class="tags-card-meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                  <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                </svg>
                <?= esc($t['slug']) ?>
              </span>
              <span class="tags-card-meta-divider">•</span>
              <span class="tags-card-meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                  <line x1="16" y1="2" x2="16" y2="6"></line>
                  <line x1="8" y1="2" x2="8" y2="6"></line>
                  <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                ID: <?= (int)$t['id'] ?>
              </span>
            </div>
          </div>
        </div>

        <div class="tags-card-actions">
          <a class="tags-btn-view" href="/tag/<?= esc($t['slug']) ?>" target="_blank">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
            Ansehen
          </a>
          <form method="post" action="/admin/tags/<?= (int)$t['id'] ?>/delete" style="display:inline; flex: 1;" onsubmit="return confirm('Tag « <?= esc($t['name']) ?> » löschen?')">
            <?= csrf_field() ?>
            <button class="tags-btn-delete" type="submit">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
              </svg>
              Löschen
            </button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<style>
/* ========================================================================
   TAGS PAGE - ULTRA PROFESSIONAL ROSE/PINK DESIGN
   ======================================================================== */

:root {
  --tags-primary: #ec4899;
  --tags-primary-light: #f472b6;
  --tags-primary-dark: #db2777;
  --tags-secondary: #d946ef;
  --tags-accent: #a855f7;
  --tags-gradient: linear-gradient(135deg, #ec4899 0%, #d946ef 50%, #a855f7 100%);
  --tags-gradient-reverse: linear-gradient(135deg, #a855f7 0%, #d946ef 50%, #ec4899 100%);
}

/* ====================
   HERO HEADER SECTION
   ==================== */

.tags-hero {
  position: relative;
  margin-bottom: 2.5rem;
  padding: 3rem 2.5rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(30px);
  border: 1px solid rgba(236, 72, 153, 0.15);
  border-radius: 24px;
  overflow: hidden;
  box-shadow:
    0 8px 32px rgba(0, 0, 0, 0.12),
    0 0 0 1px rgba(236, 72, 153, 0.1) inset;
  animation: tags-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.tags-hero-bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(
    ellipse 800px 600px at 50% -20%,
    rgba(236, 72, 153, 0.08),
    transparent
  );
  animation: tags-pulse 8s ease-in-out infinite;
}

.tags-hero-content {
  position: relative;
  display: flex;
  align-items: center;
  gap: 2rem;
}

.tags-hero-icon {
  position: relative;
  width: 80px;
  height: 80px;
  background: var(--tags-gradient);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  color: white;
  box-shadow:
    0 20px 40px rgba(236, 72, 153, 0.5),
    0 0 60px rgba(236, 72, 153, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.1),
    inset 0 1px 2px rgba(255, 255, 255, 0.3);
  animation: tags-float 6s ease-in-out infinite;
}

.tags-hero-icon::before {
  content: '';
  position: absolute;
  inset: -4px;
  background: var(--tags-gradient);
  border-radius: 24px;
  opacity: 0.6;
  filter: blur(12px);
  z-index: -1;
  animation: tags-pulse 4s ease-in-out infinite;
}

.tags-hero-subtitle {
  font-size: 0.9375rem;
  font-weight: 600;
  color: var(--tags-primary);
  margin: 0 0 0.5rem 0;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.tags-hero-title {
  font-size: 2.5rem;
  font-weight: 800;
  background: var(--tags-gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin: 0 0 0.5rem 0;
  line-height: 1.2;
}

.tags-hero-desc {
  font-size: 1rem;
  color: var(--text-muted);
  margin: 0;
  line-height: 1.6;
}

/* ====================
   QUICK ADD SECTION
   ==================== */

.tags-quick-add-section {
  margin-bottom: 2.5rem;
  padding: 2rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(236, 72, 153, 0.1);
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  animation: tags-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.1s backwards;
}

.tags-quick-add-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.75rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid rgba(236, 72, 153, 0.1);
}

.tags-quick-add-icon {
  width: 56px;
  height: 56px;
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
  box-shadow:
    0 8px 24px rgba(16, 185, 129, 0.35),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}

.tags-quick-add-title {
  font-size: 1.375rem;
  font-weight: 700;
  color: var(--text-primary);
  margin: 0 0 0.25rem 0;
}

.tags-quick-add-subtitle {
  font-size: 0.875rem;
  color: var(--text-muted);
  margin: 0;
}

.tags-quick-form {
  display: flex;
  gap: 1rem;
  align-items: flex-end;
}

.tags-form-group {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 0.625rem;
}

.tags-form-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.9375rem;
  font-weight: 600;
  color: var(--text-primary);
}

.tags-form-label svg {
  color: var(--tags-primary);
}

.tags-form-input {
  padding: 1rem 1.25rem;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(10px);
  border: 2px solid rgba(236, 72, 153, 0.15);
  border-radius: 12px;
  color: var(--text-primary);
  font-size: 1rem;
  font-family: inherit;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.tags-form-input::placeholder {
  color: var(--text-muted);
  opacity: 0.5;
}

.tags-form-input:hover {
  border-color: rgba(236, 72, 153, 0.3);
  background: rgba(255, 255, 255, 0.05);
}

.tags-form-input:focus {
  outline: none;
  border-color: var(--tags-primary);
  background: rgba(255, 255, 255, 0.06);
  box-shadow:
    0 0 0 4px rgba(236, 72, 153, 0.15),
    0 8px 24px rgba(236, 72, 153, 0.2);
  transform: translateY(-1px);
}

.tags-form-hint {
  display: flex;
  align-items: center;
  gap: 0.375rem;
  font-size: 0.8125rem;
  color: var(--text-muted);
  margin: 0;
}

.tags-form-hint svg {
  opacity: 0.6;
  flex-shrink: 0;
}

.tags-btn-submit {
  padding: 1rem 2rem;
  background: var(--tags-gradient);
  border: none;
  border-radius: 12px;
  color: white;
  font-weight: 600;
  font-size: 1rem;
  font-family: inherit;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  box-shadow:
    0 8px 24px rgba(236, 72, 153, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  white-space: nowrap;
  position: relative;
  overflow: hidden;
}

.tags-btn-submit::before {
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

.tags-btn-submit:hover::before {
  width: 300px;
  height: 300px;
}

.tags-btn-submit:hover {
  transform: translateY(-2px);
  box-shadow:
    0 12px 32px rgba(236, 72, 153, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.2) inset;
}

.tags-btn-submit:active {
  transform: translateY(0);
}

.tags-btn-submit svg {
  position: relative;
  z-index: 1;
}

/* ====================
   STATISTICS CARDS
   ==================== */

.tags-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.tags-stat-card {
  position: relative;
  display: flex;
  align-items: center;
  gap: 1.25rem;
  padding: 1.75rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(236, 72, 153, 0.1);
  border-radius: 18px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  animation: tags-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) backwards;
}

.tags-stat-card:nth-child(1) { animation-delay: 0.2s; }
.tags-stat-card:nth-child(2) { animation-delay: 0.3s; }
.tags-stat-card:nth-child(3) { animation-delay: 0.4s; }
.tags-stat-card:nth-child(4) { animation-delay: 0.5s; }

.tags-stat-card:hover {
  transform: translateY(-4px);
  border-color: rgba(236, 72, 153, 0.3);
  box-shadow:
    0 12px 36px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(236, 72, 153, 0.2) inset;
}

.tags-stat-icon {
  width: 64px;
  height: 64px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
  position: relative;
}

.tags-stat-icon::before {
  content: '';
  position: absolute;
  inset: -2px;
  background: inherit;
  border-radius: 18px;
  opacity: 0.4;
  filter: blur(12px);
  z-index: -1;
}

.tags-stat-icon-total {
  background: linear-gradient(135deg, #ec4899 0%, #d946ef 100%);
  box-shadow:
    0 10px 30px rgba(236, 72, 153, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}

.tags-stat-icon-popular {
  background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
  box-shadow:
    0 10px 30px rgba(245, 158, 11, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}

.tags-stat-icon-active {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  box-shadow:
    0 10px 30px rgba(16, 185, 129, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}

.tags-stat-icon-avg {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  box-shadow:
    0 10px 30px rgba(59, 130, 246, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}

.tags-stat-content {
  flex: 1;
  min-width: 0;
}

.tags-stat-value {
  font-size: 2.25rem;
  font-weight: 800;
  color: var(--text-primary);
  line-height: 1;
  margin-bottom: 0.5rem;
}

.tags-stat-label {
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--text-muted);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 0.5rem;
  display: block;
}

.tags-stat-trend {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.375rem 0.75rem;
  border-radius: 20px;
  font-size: 0.8125rem;
  font-weight: 700;
  backdrop-filter: blur(10px);
}

.tags-stat-trend-neutral {
  background: rgba(168, 85, 247, 0.15);
  color: #a855f7;
  border: 1px solid rgba(168, 85, 247, 0.2);
}

.tags-stat-trend-success {
  background: rgba(16, 185, 129, 0.15);
  color: #10b981;
  border: 1px solid rgba(16, 185, 129, 0.2);
}

.tags-stat-trend-info {
  background: rgba(59, 130, 246, 0.15);
  color: #3b82f6;
  border: 1px solid rgba(59, 130, 246, 0.2);
}

/* ====================
   SECTION HEADER
   ==================== */

.tags-section-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1.5rem;
  padding: 1.25rem 1.5rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(236, 72, 153, 0.1);
  border-radius: 16px;
  animation: tags-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.6s backwards;
}

.tags-section-title-wrapper {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.tags-section-title-wrapper svg {
  color: var(--tags-primary);
  flex-shrink: 0;
}

.tags-section-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--text-primary);
  margin: 0;
}

.tags-section-count {
  padding: 0.5rem 1rem;
  background: rgba(236, 72, 153, 0.15);
  border: 1px solid rgba(236, 72, 153, 0.2);
  border-radius: 20px;
  font-size: 0.875rem;
  font-weight: 700;
  color: var(--tags-primary);
  backdrop-filter: blur(10px);
}

/* ====================
   TAGS GRID
   ==================== */

.tags-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 1.5rem;
}

.tags-card {
  position: relative;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(236, 72, 153, 0.1);
  border-radius: 18px;
  padding: 1.75rem;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  animation: tags-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) backwards;
  animation-delay: calc(0.7s + var(--delay, 0s));
}

.tags-card:nth-child(n) {
  --delay: calc(0.05s * (var(--i, 0)));
}

.tags-card:hover {
  transform: translateY(-6px);
  border-color: rgba(236, 72, 153, 0.3);
  box-shadow:
    0 16px 48px rgba(0, 0, 0, 0.2),
    0 0 0 1px rgba(236, 72, 153, 0.3) inset;
}

.tags-card-header {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.tags-card-icon {
  width: 52px;
  height: 52px;
  background: var(--tags-gradient);
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
  box-shadow:
    0 8px 24px rgba(236, 72, 153, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
  transition: transform 0.3s ease;
}

.tags-card:hover .tags-card-icon {
  transform: scale(1.1) rotate(5deg);
}

.tags-card-content {
  flex: 1;
  min-width: 0;
}

.tags-card-name {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--text-primary);
  margin: 0 0 0.625rem 0;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.tags-card-meta {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 0.625rem;
  font-size: 0.8125rem;
  color: var(--text-muted);
}

.tags-card-meta-item {
  display: flex;
  align-items: center;
  gap: 0.375rem;
}

.tags-card-meta-item svg {
  opacity: 0.6;
  flex-shrink: 0;
}

.tags-card-meta-divider {
  opacity: 0.3;
}

.tags-card-actions {
  display: flex;
  gap: 0.75rem;
  padding-top: 1.25rem;
  border-top: 1px solid rgba(236, 72, 153, 0.1);
}

.tags-btn-view,
.tags-btn-delete {
  flex: 1;
  height: 44px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  border-radius: 12px;
  border: 2px solid;
  background: transparent;
  font-size: 0.9375rem;
  font-weight: 600;
  text-decoration: none;
  cursor: pointer;
  font-family: inherit;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  backdrop-filter: blur(10px);
}

.tags-btn-view {
  color: #3b82f6;
  border-color: rgba(59, 130, 246, 0.25);
}

.tags-btn-view:hover {
  background: rgba(59, 130, 246, 0.15);
  border-color: #3b82f6;
  transform: translateY(-2px);
  box-shadow:
    0 8px 24px rgba(59, 130, 246, 0.3),
    0 0 0 1px rgba(59, 130, 246, 0.1) inset;
}

.tags-btn-delete {
  color: #ef4444;
  border-color: rgba(239, 68, 68, 0.25);
  width: 100%;
}

.tags-btn-delete:hover {
  background: rgba(239, 68, 68, 0.15);
  border-color: #ef4444;
  transform: translateY(-2px);
  box-shadow:
    0 8px 24px rgba(239, 68, 68, 0.3),
    0 0 0 1px rgba(239, 68, 68, 0.1) inset;
}

.tags-btn-view:active,
.tags-btn-delete:active {
  transform: translateY(0);
}

/* ====================
   EMPTY STATE
   ==================== */

.tags-empty {
  text-align: center;
  padding: 5rem 2rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 2px dashed rgba(236, 72, 153, 0.2);
  border-radius: 20px;
  animation: tags-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.6s backwards;
}

.tags-empty-icon {
  margin: 0 auto 2rem;
  width: 120px;
  height: 120px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: radial-gradient(
    circle at center,
    rgba(236, 72, 153, 0.15),
    rgba(217, 70, 239, 0.05)
  );
  color: var(--tags-primary);
  animation: tags-pulse 3s ease-in-out infinite;
}

.tags-empty-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--text-primary);
  margin: 0 0 0.75rem 0;
}

.tags-empty-desc {
  font-size: 1.0625rem;
  color: var(--text-muted);
  margin: 0 0 1.5rem 0;
  line-height: 1.6;
}

.tags-empty-hint {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.625rem 1.25rem;
  background: rgba(236, 72, 153, 0.1);
  border: 1px solid rgba(236, 72, 153, 0.2);
  border-radius: 20px;
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--tags-primary);
  backdrop-filter: blur(10px);
}

/* ====================
   ANIMATIONS
   ==================== */

@keyframes tags-slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes tags-float {
  0%, 100% {
    transform: translateY(0px) rotate(0deg);
  }
  33% {
    transform: translateY(-12px) rotate(3deg);
  }
  66% {
    transform: translateY(-6px) rotate(-3deg);
  }
}

@keyframes tags-pulse {
  0%, 100% {
    opacity: 1;
    transform: scale(1);
  }
  50% {
    opacity: 0.8;
    transform: scale(1.05);
  }
}

/* ====================
   RESPONSIVE DESIGN
   ==================== */

@media (max-width: 1024px) {
  .tags-stats {
    grid-template-columns: repeat(2, 1fr);
  }

  .tags-grid {
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  }
}

@media (max-width: 768px) {
  .tags-hero {
    padding: 2rem 1.5rem;
  }

  .tags-hero-content {
    flex-direction: column;
    align-items: flex-start;
    gap: 1.5rem;
  }

  .tags-hero-icon {
    width: 64px;
    height: 64px;
  }

  .tags-hero-icon svg {
    width: 36px;
    height: 36px;
  }

  .tags-hero-title {
    font-size: 2rem;
  }

  .tags-quick-add-section {
    padding: 1.5rem;
  }

  .tags-quick-form {
    flex-direction: column;
  }

  .tags-btn-submit {
    width: 100%;
  }

  .tags-stats {
    grid-template-columns: 1fr;
  }

  .tags-stat-card {
    padding: 1.5rem;
  }

  .tags-stat-icon {
    width: 56px;
    height: 56px;
  }

  .tags-stat-icon svg {
    width: 24px;
    height: 24px;
  }

  .tags-stat-value {
    font-size: 2rem;
  }

  .tags-section-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  .tags-grid {
    grid-template-columns: 1fr;
  }

  .tags-card {
    padding: 1.5rem;
  }

  .tags-card:hover {
    transform: translateY(-4px);
  }

  .tags-empty {
    padding: 3.5rem 1.5rem;
  }

  .tags-empty-icon {
    width: 96px;
    height: 96px;
  }

  .tags-empty-icon svg {
    width: 48px;
    height: 48px;
  }
}

@media (max-width: 480px) {
  .tags-hero {
    padding: 1.5rem 1.25rem;
  }

  .tags-hero-title {
    font-size: 1.75rem;
  }

  .tags-hero-desc {
    font-size: 0.9375rem;
  }

  .tags-quick-add-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.75rem;
  }

  .tags-stat-card {
    flex-direction: column;
    align-items: flex-start;
  }

  .tags-card-header {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .tags-card-name {
    white-space: normal;
  }

  .tags-card-meta {
    flex-direction: column;
    align-items: center;
  }

  .tags-card-actions {
    flex-direction: column;
  }

  .tags-btn-view,
  .tags-btn-delete {
    width: 100%;
  }
}
</style>
