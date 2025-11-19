<?php
/** @var array $posts */
$title = 'Admin – Artikel';

// Calculer les statistiques
$total = count($posts);
$published = count(array_filter($posts, fn($p) => !empty($p['published_at'])));
$drafts = $total - $published;
$withCover = count(array_filter($posts, fn($p) => !empty($p['cover_path'])));
$publishRate = $total > 0 ? round(($published / $total) * 100) : 0;
?>

<!-- Hero Header -->
<div class="posts-hero">
  <div class="posts-hero-bg"></div>
  <div class="posts-hero-content">
    <div class="posts-hero-icon">
      <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
        <line x1="16" y1="13" x2="8" y2="13"></line>
        <line x1="16" y1="17" x2="8" y2="17"></line>
        <polyline points="10 9 9 9 8 9"></polyline>
      </svg>
    </div>
    <div>
      <p class="posts-hero-subtitle">Verwalten Sie Ihren redaktionellen Inhalt</p>
      <h1 class="posts-hero-title">Artikel</h1>
      <p class="posts-hero-desc">Erstellen, bearbeiten und veröffentlichen Sie Ihre Artikel</p>
    </div>
  </div>
  <div class="posts-hero-actions">
    <a class="posts-btn-create" href="/admin/posts/create">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      Neuer Artikel
    </a>
  </div>
</div>

<!-- Statistics Cards -->
<div class="posts-stats">
  <div class="posts-stat-card">
    <div class="posts-stat-icon posts-stat-icon-total">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
      </svg>
    </div>
    <div class="posts-stat-content">
      <div class="posts-stat-value"><?= $total ?></div>
      <div class="posts-stat-label">Insgesamt Artikel</div>
      <div class="posts-stat-bar">
        <div class="posts-stat-bar-fill" style="width: 100%"></div>
      </div>
    </div>
  </div>

  <div class="posts-stat-card posts-stat-card-highlight">
    <div class="posts-stat-icon posts-stat-icon-published">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
        <polyline points="22 4 12 14.01 9 11.01"></polyline>
      </svg>
    </div>
    <div class="posts-stat-content">
      <div class="posts-stat-value"><?= $published ?></div>
      <div class="posts-stat-label">Veröffentlicht</div>
      <div class="posts-stat-bar">
        <div class="posts-stat-bar-fill posts-stat-bar-fill-published" style="width: <?= $publishRate ?>%"></div>
      </div>
      <div class="posts-stat-trend">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
        </svg>
        <?= $publishRate ?>% Rate
      </div>
    </div>
  </div>

  <div class="posts-stat-card">
    <div class="posts-stat-icon posts-stat-icon-drafts">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
        <line x1="12" y1="18" x2="12" y2="12"></line>
        <line x1="9" y1="15" x2="15" y2="15"></line>
      </svg>
    </div>
    <div class="posts-stat-content">
      <div class="posts-stat-value"><?= $drafts ?></div>
      <div class="posts-stat-label">Entwürfe</div>
      <div class="posts-stat-bar">
        <div class="posts-stat-bar-fill posts-stat-bar-fill-draft" style="width: <?= $total > 0 ? (100 - $publishRate) : 0 ?>%"></div>
      </div>
      <div class="posts-stat-trend">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
        </svg>
        Zu veröffentlichen
      </div>
    </div>
  </div>

  <div class="posts-stat-card">
    <div class="posts-stat-icon posts-stat-icon-covers">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
        <circle cx="8.5" cy="8.5" r="1.5"></circle>
        <polyline points="21 15 16 10 5 21"></polyline>
      </svg>
    </div>
    <div class="posts-stat-content">
      <div class="posts-stat-value"><?= $withCover ?></div>
      <div class="posts-stat-label">Mit Bild</div>
      <div class="posts-stat-bar">
        <div class="posts-stat-bar-fill posts-stat-bar-fill-cover" style="width: <?= $total > 0 ? round(($withCover / $total) * 100) : 0 ?>%"></div>
      </div>
      <div class="posts-stat-trend">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
        </svg>
        Illustriert
      </div>
    </div>
  </div>
</div>

<!-- Posts List -->
<?php if (empty($posts)): ?>
  <div class="posts-empty">
    <div class="posts-empty-icon">
      <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
        <line x1="16" y1="13" x2="8" y2="13"></line>
        <line x1="16" y1="17" x2="8" y2="17"></line>
      </svg>
    </div>
    <h3 class="posts-empty-title">Keine Artikel erstellt</h3>
    <p class="posts-empty-desc">Erstellen Sie Ihren ersten Artikel, um Ihren Inhalt zu teilen</p>
    <a class="posts-empty-btn" href="/admin/posts/create">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      Meinen ersten Artikel erstellen
    </a>
  </div>
<?php else: ?>
  <div class="posts-grid">
    <?php foreach ($posts as $p): ?>
      <?php
        $isPublished = !empty($p['published_at']);
        $hasCover = !empty($p['cover_path']);
      ?>
      <div class="post-card <?= $isPublished ? 'post-card-published' : 'post-card-draft' ?>">
        <!-- Cover -->
        <?php if ($hasCover): ?>
          <div class="post-card-cover">
            <img src="/uploads/<?= esc($p['cover_path']) ?>" alt="<?= esc($p['title']) ?>">
            <div class="post-card-cover-overlay">
              <span class="post-badge <?= $isPublished ? 'post-badge-published' : 'post-badge-draft' ?>">
                <?php if ($isPublished): ?>
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="10"></circle>
                  </svg>
                  Veröffentlicht
                <?php else: ?>
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="10"></circle>
                  </svg>
                  Entwurf
                <?php endif; ?>
              </span>
            </div>
          </div>
        <?php else: ?>
          <div class="post-card-placeholder">
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <circle cx="8.5" cy="8.5" r="1.5"></circle>
              <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
            <span class="post-badge <?= $isPublished ? 'post-badge-published' : 'post-badge-draft' ?>">
              <?php if ($isPublished): ?>
                <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                  <circle cx="12" cy="12" r="10"></circle>
                </svg>
                Publié
              <?php else: ?>
                <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                  <circle cx="12" cy="12" r="10"></circle>
                </svg>
                Brouillon
              <?php endif; ?>
            </span>
          </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="post-card-content">
          <div class="post-card-header">
            <h3 class="post-card-title">
              <a href="/post/<?= esc($p['slug']) ?>" target="_blank" rel="noopener">
                <?= esc($p['title']) ?>
              </a>
            </h3>
            <div class="post-card-meta">
              <span class="post-card-id">ID: <?= (int)$p['id'] ?></span>
            </div>
          </div>

          <div class="post-card-info">
            <div class="post-card-info-item">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              <span><?= esc($p['author'] ?? 'Unbekannt') ?></span>
            </div>
            <div class="post-card-info-item">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
              <span>
                <?= $p['published_at']
                      ? esc(date('d/m/Y', strtotime($p['published_at'])))
                      : 'Nicht veröffentlicht' ?>
              </span>
            </div>
          </div>

          <div class="post-card-slug">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
              <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
            </svg>
            <span><?= esc($p['slug']) ?></span>
          </div>

          <div class="post-card-actions">
            <a class="post-card-btn post-card-btn-edit" href="/admin/posts/<?= (int)$p['id'] ?>/edit">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
              </svg>
              Bearbeiten
            </a>
            <a class="post-card-btn post-card-btn-view" href="/post/<?= esc($p['slug']) ?>" target="_blank">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
              Ansehen
            </a>
            <form method="post"
                  action="/admin/posts/<?= (int)$p['id'] ?>/delete"
                  style="display:inline;flex:1;"
                  onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Artikel löschen möchten? « <?= esc($p['title']) ?> »')">
              <?= csrf_field() ?>
              <button class="post-card-btn post-card-btn-delete" type="submit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="3 6 5 6 21 6"></polyline>
                  <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                </svg>
                Löschen
              </button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<style>
/* ==================== ANIMATIONS ==================== */
@keyframes posts-float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  33% { transform: translateY(-12px) rotate(3deg); }
  66% { transform: translateY(-6px) rotate(-3deg); }
}

@keyframes posts-pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.85; transform: scale(1.05); }
}

@keyframes posts-slideUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes posts-shimmer {
  0% { background-position: -200% 0; }
  100% { background-position: 200% 0; }
}

/* ==================== HERO HEADER ==================== */
.posts-hero {
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
  animation: posts-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.posts-hero-bg {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
    radial-gradient(circle at 80% 70%, rgba(99, 102, 241, 0.12) 0%, transparent 50%),
    radial-gradient(circle at 40% 80%, rgba(124, 58, 237, 0.08) 0%, transparent 50%);
  opacity: 0.6;
  animation: posts-pulse 8s ease-in-out infinite;
}

.posts-hero-content {
  position: relative;
  display: flex;
  align-items: center;
  gap: 1.75rem;
  margin-bottom: 1.5rem;
}

.posts-hero-icon {
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
  animation: posts-float 6s ease-in-out infinite;
  position: relative;
}

.posts-hero-icon::before {
  content: '';
  position: absolute;
  inset: -4px;
  background: linear-gradient(135deg, #a78bfa, #6366f1);
  border-radius: 24px;
  opacity: 0.6;
  filter: blur(12px);
  z-index: -1;
  animation: posts-pulse 4s ease-in-out infinite;
}

.posts-hero-icon svg {
  color: white;
  filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
}

.posts-hero-subtitle {
  margin: 0 0 0.375rem 0;
  font-size: 0.8125rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  color: #a78bfa;
  opacity: 0.9;
}

.posts-hero-title {
  margin: 0 0 0.5rem 0;
  font-size: 2.5rem;
  font-weight: 800;
  line-height: 1.1;
  background: linear-gradient(135deg, #a78bfa 0%, #818cf8 50%, #6366f1 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: -0.5px;
}

.posts-hero-desc {
  margin: 0;
  font-size: 0.9375rem;
  color: rgba(255, 255, 255, 0.65);
  line-height: 1.5;
}

.posts-hero-actions {
  position: relative;
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.posts-btn-create {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 1rem 2rem;
  background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
  border: none;
  border-radius: 12px;
  color: white;
  font-weight: 700;
  font-size: 0.9375rem;
  text-decoration: none;
  box-shadow:
    0 8px 24px rgba(139, 92, 246, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.2);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
}

.posts-btn-create::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transform: translateX(-100%);
  transition: transform 0.6s;
}

.posts-btn-create:hover {
  transform: translateY(-2px);
  box-shadow:
    0 12px 32px rgba(139, 92, 246, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.2),
    inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.posts-btn-create:hover::before {
  transform: translateX(100%);
}

.posts-btn-create:active {
  transform: translateY(0);
}

/* ==================== STATISTICS CARDS ==================== */
.posts-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1.25rem;
  margin-bottom: 2rem;
  animation: posts-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.1s backwards;
}

.posts-stat-card {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(139, 92, 246, 0.15);
  border-radius: 16px;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1.25rem;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.posts-stat-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.03), rgba(99, 102, 241, 0.02));
  opacity: 0;
  transition: opacity 0.3s;
}

.posts-stat-card:hover {
  transform: translateY(-4px);
  border-color: rgba(139, 92, 246, 0.3);
  box-shadow:
    0 12px 24px rgba(0, 0, 0, 0.15),
    0 0 32px rgba(139, 92, 246, 0.15);
}

.posts-stat-card:hover::before {
  opacity: 1;
}

.posts-stat-icon {
  width: 64px;
  height: 64px;
  min-width: 64px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.posts-stat-card:hover .posts-stat-icon {
  transform: scale(1.05) rotate(-5deg);
}

.posts-stat-icon::before {
  content: '';
  position: absolute;
  inset: -2px;
  border-radius: 16px;
  opacity: 0.5;
  filter: blur(10px);
  z-index: -1;
}

.posts-stat-icon-total {
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  box-shadow: 0 8px 24px rgba(139, 92, 246, 0.35);
}

.posts-stat-icon-total::before {
  background: linear-gradient(135deg, #a78bfa, #6366f1);
}

.posts-stat-icon-published {
  background: linear-gradient(135deg, #10b981, #059669);
  box-shadow: 0 8px 24px rgba(16, 185, 129, 0.35);
}

.posts-stat-icon-published::before {
  background: linear-gradient(135deg, #34d399, #059669);
}

.posts-stat-icon-drafts {
  background: linear-gradient(135deg, #f59e0b, #d97706);
  box-shadow: 0 8px 24px rgba(245, 158, 11, 0.35);
}

.posts-stat-icon-drafts::before {
  background: linear-gradient(135deg, #fbbf24, #d97706);
}

.posts-stat-icon-covers {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  box-shadow: 0 8px 24px rgba(59, 130, 246, 0.35);
}

.posts-stat-icon-covers::before {
  background: linear-gradient(135deg, #60a5fa, #2563eb);
}

.posts-stat-icon svg {
  color: white;
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
}

.posts-stat-content {
  flex: 1;
  position: relative;
}

.posts-stat-value {
  font-size: 2rem;
  font-weight: 800;
  line-height: 1;
  background: linear-gradient(135deg, #a78bfa, #818cf8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 0.375rem;
}

.posts-stat-label {
  font-size: 0.8125rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.5);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 0.625rem;
}

.posts-stat-bar {
  width: 100%;
  height: 6px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 10px;
  overflow: hidden;
  margin-bottom: 0.5rem;
}

.posts-stat-bar-fill {
  height: 100%;
  border-radius: 10px;
  background: linear-gradient(90deg, #8b5cf6, #6366f1);
  transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(139, 92, 246, 0.5);
}

.posts-stat-bar-fill::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.3),
    transparent
  );
  animation: posts-shimmer 2s infinite;
}

.posts-stat-bar-fill-published {
  background: linear-gradient(90deg, #10b981, #059669);
  box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
}

.posts-stat-bar-fill-draft {
  background: linear-gradient(90deg, #f59e0b, #d97706);
  box-shadow: 0 0 10px rgba(245, 158, 11, 0.5);
}

.posts-stat-bar-fill-cover {
  background: linear-gradient(90deg, #3b82f6, #2563eb);
  box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
}

.posts-stat-card-highlight {
  border-color: rgba(139, 92, 246, 0.25);
  background: rgba(139, 92, 246, 0.03);
}

.posts-stat-card-highlight:hover {
  border-color: rgba(139, 92, 246, 0.4);
  box-shadow:
    0 12px 24px rgba(0, 0, 0, 0.15),
    0 0 40px rgba(139, 92, 246, 0.2);
}

.posts-stat-trend {
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
  margin-top: 0.25rem;
  padding: 0.25rem 0.5rem;
  background: rgba(139, 92, 246, 0.1);
  border-radius: 6px;
  font-size: 0.6875rem;
  font-weight: 700;
  color: #a78bfa;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}

.posts-stat-trend svg {
  color: #8b5cf6;
}

/* ==================== POSTS GRID ==================== */
.posts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
  gap: 1.5rem;
  animation: posts-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards;
}

.post-card {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(139, 92, 246, 0.12);
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  display: flex;
  flex-direction: column;
  position: relative;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.post-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), transparent);
  opacity: 0;
  transition: opacity 0.3s;
  pointer-events: none;
}

.post-card:hover {
  transform: translateY(-6px);
  border-color: rgba(139, 92, 246, 0.3);
  box-shadow:
    0 16px 32px rgba(0, 0, 0, 0.15),
    0 0 48px rgba(139, 92, 246, 0.12);
}

.post-card:hover::before {
  opacity: 1;
}

.post-card-published {
  border-color: rgba(16, 185, 129, 0.2);
}

.post-card-draft {
  opacity: 0.85;
}

/* ==================== POST CARD COVER ==================== */
.post-card-cover {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.08), rgba(99, 102, 241, 0.05));
}

.post-card-cover img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.post-card:hover .post-card-cover img {
  transform: scale(1.05);
}

.post-card-cover-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.4));
  display: flex;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 1rem;
  opacity: 0;
  transition: opacity 0.3s;
}

.post-card:hover .post-card-cover-overlay {
  opacity: 1;
}

.post-card-placeholder {
  width: 100%;
  height: 200px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1rem;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(99, 102, 241, 0.03));
  color: rgba(255, 255, 255, 0.3);
  position: relative;
  overflow: hidden;
}

.post-card-placeholder::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(139, 92, 246, 0.05),
    transparent
  );
  background-size: 200% 100%;
  animation: posts-shimmer 3s infinite;
}

/* ==================== STATUS BADGE ==================== */
.post-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.4375rem 0.875rem;
  border-radius: 20px;
  font-size: 0.6875rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  backdrop-filter: blur(12px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  transition: all 0.3s;
}

.post-badge-published {
  background: rgba(16, 185, 129, 0.95);
  color: white;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.post-badge-draft {
  background: rgba(245, 158, 11, 0.95);
  color: white;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.post-badge svg {
  width: 8px;
  height: 8px;
}

/* ==================== POST CARD CONTENT ==================== */
.post-card-content {
  padding: 1.75rem;
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
  flex: 1;
  position: relative;
}

.post-card-header {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid rgba(139, 92, 246, 0.1);
}

.post-card-title {
  margin: 0;
  font-size: 1.1875rem;
  font-weight: 700;
  line-height: 1.3;
}

.post-card-title a {
  color: rgba(255, 255, 255, 0.95);
  text-decoration: none;
  transition: color 0.3s;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.post-card-title a:hover {
  background: linear-gradient(135deg, #a78bfa, #818cf8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.post-card-meta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
}

.post-card-id {
  font-size: 0.75rem;
  color: rgba(255, 255, 255, 0.35);
  font-family: 'SF Mono', Monaco, monospace;
  font-weight: 600;
}

.post-card-info {
  display: flex;
  flex-wrap: wrap;
  gap: 1.25rem;
  padding: 0.875rem;
  background: rgba(255, 255, 255, 0.02);
  border-radius: 10px;
  border: 1px solid rgba(139, 92, 246, 0.08);
}

.post-card-info-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.8125rem;
  color: rgba(255, 255, 255, 0.6);
  font-weight: 600;
}

.post-card-info-item svg {
  color: #a78bfa;
}

.post-card-slug {
  display: flex;
  align-items: center;
  gap: 0.625rem;
  padding: 0.875rem;
  background: rgba(139, 92, 246, 0.04);
  border-radius: 10px;
  border-left: 3px solid #8b5cf6;
  transition: all 0.3s;
  font-size: 0.8125rem;
  color: rgba(255, 255, 255, 0.6);
  font-family: 'SF Mono', Monaco, monospace;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.post-card-slug:hover {
  background: rgba(139, 92, 246, 0.08);
  border-left-width: 4px;
}

.post-card-slug svg {
  color: #a78bfa;
  flex-shrink: 0;
}

/* ==================== POST CARD ACTIONS ==================== */
.post-card-actions {
  display: flex;
  gap: 0.75rem;
  padding-top: 1rem;
  border-top: 1px solid rgba(139, 92, 246, 0.1);
  margin-top: auto;
}

.post-card-btn {
  flex: 1;
  height: 44px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  border-radius: 10px;
  border: 1px solid rgba(139, 92, 246, 0.2);
  background: rgba(139, 92, 246, 0.05);
  color: rgba(255, 255, 255, 0.7);
  font-size: 0.875rem;
  font-weight: 700;
  text-decoration: none;
  cursor: pointer;
  font-family: inherit;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.post-card-btn-edit:hover {
  background: rgba(139, 92, 246, 0.15);
  border-color: #a78bfa;
  color: #a78bfa;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(139, 92, 246, 0.2);
}

.post-card-btn-view:hover {
  background: rgba(59, 130, 246, 0.12);
  border-color: #60a5fa;
  color: #60a5fa;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(59, 130, 246, 0.2);
}

.post-card-btn-delete:hover {
  background: rgba(239, 68, 68, 0.12);
  border-color: #ef4444;
  color: #ef4444;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(239, 68, 68, 0.2);
}

.post-card-btn:active {
  transform: translateY(0);
}

/* ==================== EMPTY STATE ==================== */
.posts-empty {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 4rem 2rem;
  text-align: center;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 2px dashed rgba(139, 92, 246, 0.2);
  border-radius: 20px;
  animation: posts-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards;
}

.posts-empty-icon {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(99, 102, 241, 0.05));
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
  animation: posts-pulse 3s ease-in-out infinite;
}

.posts-empty-icon svg {
  color: rgba(139, 92, 246, 0.5);
}

.posts-empty-title {
  margin: 0 0 0.75rem 0;
  font-size: 1.5rem;
  font-weight: 700;
  background: linear-gradient(135deg, #a78bfa, #818cf8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.posts-empty-desc {
  margin: 0 0 2rem 0;
  font-size: 0.9375rem;
  color: rgba(255, 255, 255, 0.5);
  max-width: 400px;
  line-height: 1.6;
}

.posts-empty-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 1rem 2rem;
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  border: none;
  border-radius: 12px;
  color: white;
  font-weight: 700;
  font-size: 0.9375rem;
  text-decoration: none;
  box-shadow:
    0 8px 24px rgba(139, 92, 246, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.posts-empty-btn:hover {
  transform: translateY(-2px);
  box-shadow:
    0 12px 32px rgba(139, 92, 246, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.2);
}

.posts-empty-btn:active {
  transform: translateY(0);
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 1024px) {
  .posts-stats {
    grid-template-columns: repeat(2, 1fr);
  }

  .posts-grid {
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  }
}

@media (max-width: 768px) {
  .posts-hero {
    padding: 2rem 1.5rem;
  }

  .posts-hero-content {
    flex-direction: column;
    align-items: flex-start;
    gap: 1.25rem;
  }

  .posts-hero-icon {
    width: 64px;
    height: 64px;
    min-width: 64px;
  }

  .posts-hero-icon svg {
    width: 36px;
    height: 36px;
  }

  .posts-hero-title {
    font-size: 2rem;
  }

  .posts-hero-actions {
    width: 100%;
  }

  .posts-btn-create {
    width: 100%;
    justify-content: center;
  }

  .posts-stats {
    grid-template-columns: 1fr;
  }

  .posts-grid {
    grid-template-columns: 1fr;
  }

  .post-card-actions {
    flex-direction: column;
  }

  .post-card-btn {
    width: 100%;
  }
}

@media (max-width: 480px) {
  .posts-hero-title {
    font-size: 1.75rem;
  }

  .posts-stat-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
  }

  .posts-stat-icon svg {
    width: 22px;
    height: 22px;
  }

  .posts-stat-value {
    font-size: 1.5rem;
  }
}
</style>
