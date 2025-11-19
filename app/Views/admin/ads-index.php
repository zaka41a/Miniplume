<?php
/** @var array $ads */
/** @var array $stats */
$title = 'Admin – Werbung';

$total = $stats['total'] ?? 0;
$active = $stats['active'] ?? 0;
$inactive = $stats['inactive'] ?? 0;
$totalViews = $stats['total_views'] ?? 0;
$totalClicks = $stats['total_clicks'] ?? 0;
$avgCTR = $totalViews > 0 ? round(($totalClicks / $totalViews) * 100, 2) : 0;
?>

<!-- Hero Header -->
<div class="ads-hero">
  <div class="ads-hero-bg"></div>
  <div class="ads-hero-content">
    <div class="ads-hero-icon">
      <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
        <line x1="7" y1="11" x2="17" y2="11"></line>
        <line x1="7" y1="15" x2="13" y2="15"></line>
      </svg>
    </div>
    <div>
      <p class="ads-hero-subtitle">Verwalten Sie Ihre Werbeeinnahmen</p>
      <h1 class="ads-hero-title">Werbung</h1>
      <p class="ads-hero-desc">Erstellen und optimieren Sie Ihre Werbebanner</p>
    </div>
  </div>
  <div class="ads-hero-actions">
    <a class="ads-btn-create" href="/admin/ads/create">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      Neue Werbung
    </a>
  </div>
</div>

<!-- Statistics Cards -->
<div class="ads-stats">
  <div class="ads-stat-card">
    <div class="ads-stat-icon ads-stat-icon-total">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
      </svg>
    </div>
    <div class="ads-stat-content">
      <div class="ads-stat-value"><?= $total ?></div>
      <div class="ads-stat-label">Gesamtwerbung</div>
    </div>
  </div>

  <div class="ads-stat-card">
    <div class="ads-stat-icon ads-stat-icon-active">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
        <polyline points="22 4 12 14.01 9 11.01"></polyline>
      </svg>
    </div>
    <div class="ads-stat-content">
      <div class="ads-stat-value"><?= $active ?></div>
      <div class="ads-stat-label">Aktiv</div>
      <div class="ads-stat-trend">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
        </svg>
        Online
      </div>
    </div>
  </div>

  <div class="ads-stat-card">
    <div class="ads-stat-icon ads-stat-icon-views">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
        <circle cx="12" cy="12" r="3"></circle>
      </svg>
    </div>
    <div class="ads-stat-content">
      <div class="ads-stat-value"><?= number_format($totalViews) ?></div>
      <div class="ads-stat-label">Gesamtaufrufe</div>
      <div class="ads-stat-trend">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
        </svg>
        Impressionen
      </div>
    </div>
  </div>

  <div class="ads-stat-card">
    <div class="ads-stat-icon ads-stat-icon-clicks">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 11l3 3L22 4"></path>
        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
      </svg>
    </div>
    <div class="ads-stat-content">
      <div class="ads-stat-value"><?= number_format($totalClicks) ?></div>
      <div class="ads-stat-label">Gesamtklicks</div>
      <div class="ads-stat-trend">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <line x1="12" y1="1" x2="12" y2="23"></line>
          <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
        </svg>
        CTR: <?= $avgCTR ?>%
      </div>
    </div>
  </div>
</div>

<!-- Ads List -->
<?php if (empty($ads)): ?>
  <div class="ads-empty">
    <div class="ads-empty-icon">
      <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
        <line x1="7" y1="11" x2="17" y2="11"></line>
        <line x1="7" y1="15" x2="13" y2="15"></line>
      </svg>
    </div>
    <h3 class="ads-empty-title">Keine Werbung erstellt</h3>
    <p class="ads-empty-desc">Erstellen Sie Ihren ersten Werbebanner, um Einnahmen zu generieren</p>
    <a class="ads-empty-btn" href="/admin/ads/create">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      Meine erste Werbung erstellen
    </a>
  </div>
<?php else: ?>
  <div class="ads-grid">
    <?php foreach ($ads as $ad): ?>
      <?php
        $isActive = $ad['status'] === 'active';
        $hasImage = !empty($ad['image_path']);
        $ctr = $ad['views'] > 0 ? round(($ad['clicks'] / $ad['views']) * 100, 2) : 0;
      ?>
      <div class="ad-card <?= $isActive ? 'ad-card-active' : 'ad-card-inactive' ?>">
        <!-- Image Preview -->
        <?php if ($hasImage): ?>
          <div class="ad-card-image">
            <img src="/uploads/<?= esc($ad['image_path']) ?>" alt="<?= esc($ad['title']) ?>">
            <div class="ad-card-image-overlay">
              <span class="ad-badge <?= $isActive ? 'ad-badge-active' : 'ad-badge-inactive' ?>">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                  <circle cx="12" cy="12" r="10"></circle>
                </svg>
                <?= $isActive ? 'Aktiv' : 'Inaktiv' ?>
              </span>
            </div>
          </div>
        <?php else: ?>
          <div class="ad-card-placeholder">
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
              <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
              <line x1="7" y1="11" x2="17" y2="11"></line>
              <line x1="7" y1="15" x2="13" y2="15"></line>
            </svg>
            <span class="ad-badge <?= $isActive ? 'ad-badge-active' : 'ad-badge-inactive' ?>">
              <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                <circle cx="12" cy="12" r="10"></circle>
              </svg>
              <?= $isActive ? 'Active' : 'Inactive' ?>
            </span>
          </div>
        <?php endif; ?>

        <div class="ad-card-content">
          <!-- Header -->
          <div class="ad-card-header">
            <h3 class="ad-card-title"><?= esc($ad['title']) ?></h3>
            <div class="ad-card-meta">
              <span class="ad-card-position">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <?= esc(ucfirst($ad['position'])) ?>
              </span>
              <span class="ad-card-id">ID: <?= (int)$ad['id'] ?></span>
            </div>
          </div>

          <!-- URL -->
          <div class="ad-card-url">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
              <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
            </svg>
            <a href="<?= esc($ad['url']) ?>" target="_blank" rel="noopener" title="<?= esc($ad['url']) ?>"><?= esc($ad['url']) ?></a>
          </div>

          <!-- Description (if exists) -->
          <?php if (!empty($ad['description'])): ?>
            <div class="ad-card-description">
              <?= esc($ad['description']) ?>
            </div>
          <?php endif; ?>

          <!-- Stats Grid -->
          <div class="ad-card-stats">
            <div class="ad-card-stat">
              <div class="ad-card-stat-icon ad-card-stat-icon-views">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </div>
              <div class="ad-card-stat-content">
                <div class="ad-card-stat-value"><?= number_format($ad['views']) ?></div>
                <div class="ad-card-stat-label">Aufrufe</div>
              </div>
            </div>

            <div class="ad-card-stat">
              <div class="ad-card-stat-icon ad-card-stat-icon-clicks">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M9 11l3 3L22 4"></path>
                  <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
              </div>
              <div class="ad-card-stat-content">
                <div class="ad-card-stat-value"><?= number_format($ad['clicks']) ?></div>
                <div class="ad-card-stat-label">Klicks</div>
              </div>
            </div>

            <div class="ad-card-stat">
              <div class="ad-card-stat-icon ad-card-stat-icon-ctr">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                  <polyline points="17 6 23 6 23 12"></polyline>
                </svg>
              </div>
              <div class="ad-card-stat-content">
                <div class="ad-card-stat-value"><?= $ctr ?>%</div>
                <div class="ad-card-stat-label">CTR</div>
              </div>
            </div>
          </div>

          <!-- Dates (if exists) -->
          <?php if (!empty($ad['start_date']) || !empty($ad['end_date'])): ?>
            <div class="ad-card-dates">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
              <span>
                <?php if (!empty($ad['start_date'])): ?>
                  <?= esc(date('d/m/Y', strtotime($ad['start_date']))) ?>
                <?php endif; ?>
                <?php if (!empty($ad['start_date']) && !empty($ad['end_date'])): ?> - <?php endif; ?>
                <?php if (!empty($ad['end_date'])): ?>
                  <?= esc(date('d/m/Y', strtotime($ad['end_date']))) ?>
                <?php endif; ?>
              </span>
            </div>
          <?php endif; ?>

          <!-- Actions -->
          <div class="ad-card-actions">
            <a class="ad-card-btn ad-card-btn-edit" href="/admin/ads/<?= (int)$ad['id'] ?>/edit">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
              </svg>
              Bearbeiten
            </a>
            <form method="post"
                  action="/admin/ads/<?= (int)$ad['id'] ?>/delete"
                  style="display:inline;flex:1;"
                  onsubmit="return confirm('Loschen \"<?= esc($ad['title']) ?>\" ?')">
              <?= csrf_field() ?>
              <button class="ad-card-btn ad-card-btn-delete" type="submit">
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
@keyframes ads-float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  33% { transform: translateY(-12px) rotate(3deg); }
  66% { transform: translateY(-6px) rotate(-3deg); }
}

@keyframes ads-pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.85; transform: scale(1.05); }
}

@keyframes ads-slideUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes ads-shimmer {
  0% { background-position: -200% 0; }
  100% { background-position: 200% 0; }
}

/* ==================== HERO HEADER ==================== */
.ads-hero {
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
  animation: ads-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.ads-hero-bg {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(circle at 20% 30%, rgba(245, 158, 11, 0.15) 0%, transparent 50%),
    radial-gradient(circle at 80% 70%, rgba(251, 146, 60, 0.12) 0%, transparent 50%),
    radial-gradient(circle at 40% 80%, rgba(249, 115, 22, 0.08) 0%, transparent 50%);
  opacity: 0.6;
  animation: ads-pulse 8s ease-in-out infinite;
}

.ads-hero-content {
  position: relative;
  display: flex;
  align-items: center;
  gap: 1.75rem;
  margin-bottom: 1.5rem;
}

.ads-hero-icon {
  width: 80px;
  height: 80px;
  min-width: 80px;
  background: linear-gradient(135deg, #f59e0b 0%, #fb923c 50%, #f97316 100%);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow:
    0 20px 40px rgba(245, 158, 11, 0.5),
    0 0 60px rgba(245, 158, 11, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.1),
    inset 0 1px 2px rgba(255, 255, 255, 0.3);
  animation: ads-float 6s ease-in-out infinite;
  position: relative;
}

.ads-hero-icon::before {
  content: '';
  position: absolute;
  inset: -4px;
  background: linear-gradient(135deg, #fbbf24, #fb923c);
  border-radius: 24px;
  opacity: 0.6;
  filter: blur(12px);
  z-index: -1;
  animation: ads-pulse 4s ease-in-out infinite;
}

.ads-hero-icon svg {
  color: white;
  filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
}

.ads-hero-subtitle {
  margin: 0 0 0.375rem 0;
  font-size: 0.8125rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  color: #fb923c;
  opacity: 0.9;
}

.ads-hero-title {
  margin: 0 0 0.5rem 0;
  font-size: 2.5rem;
  font-weight: 800;
  line-height: 1.1;
  background: linear-gradient(135deg, #fbbf24 0%, #fb923c 50%, #f97316 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: -0.5px;
  position: relative;
}

.ads-hero-desc {
  margin: 0;
  font-size: 0.9375rem;
  color: rgba(255, 255, 255, 0.65);
  line-height: 1.5;
}

.ads-hero-actions {
  position: relative;
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.ads-btn-create {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 1rem 2rem;
  background: linear-gradient(135deg, #f59e0b 0%, #fb923c 100%);
  border: none;
  border-radius: 12px;
  color: white;
  font-weight: 700;
  font-size: 0.9375rem;
  text-decoration: none;
  box-shadow:
    0 8px 24px rgba(245, 158, 11, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.2);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
}

.ads-btn-create::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transform: translateX(-100%);
  transition: transform 0.6s;
}

.ads-btn-create:hover {
  transform: translateY(-2px);
  box-shadow:
    0 12px 32px rgba(245, 158, 11, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.2),
    inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.ads-btn-create:hover::before {
  transform: translateX(100%);
}

.ads-btn-create:active {
  transform: translateY(0);
}

/* ==================== STATISTICS CARDS ==================== */
.ads-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1.25rem;
  margin-bottom: 2rem;
  animation: ads-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.1s backwards;
}

.ads-stat-card {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(245, 158, 11, 0.15);
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

.ads-stat-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.03), rgba(251, 146, 60, 0.02));
  opacity: 0;
  transition: opacity 0.3s;
}

.ads-stat-card:hover {
  transform: translateY(-4px);
  border-color: rgba(245, 158, 11, 0.3);
  box-shadow:
    0 12px 24px rgba(0, 0, 0, 0.15),
    0 0 32px rgba(245, 158, 11, 0.15);
}

.ads-stat-card:hover::before {
  opacity: 1;
}

.ads-stat-icon {
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

.ads-stat-card:hover .ads-stat-icon {
  transform: scale(1.05) rotate(-5deg);
}

.ads-stat-icon::before {
  content: '';
  position: absolute;
  inset: -2px;
  border-radius: 16px;
  opacity: 0.5;
  filter: blur(10px);
  z-index: -1;
}

.ads-stat-icon-total {
  background: linear-gradient(135deg, #f59e0b, #fb923c);
  box-shadow: 0 8px 24px rgba(245, 158, 11, 0.35);
}

.ads-stat-icon-total::before {
  background: linear-gradient(135deg, #fbbf24, #fb923c);
}

.ads-stat-icon-active {
  background: linear-gradient(135deg, #10b981, #059669);
  box-shadow: 0 8px 24px rgba(16, 185, 129, 0.35);
}

.ads-stat-icon-active::before {
  background: linear-gradient(135deg, #34d399, #059669);
}

.ads-stat-icon-views {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  box-shadow: 0 8px 24px rgba(59, 130, 246, 0.35);
}

.ads-stat-icon-views::before {
  background: linear-gradient(135deg, #60a5fa, #2563eb);
}

.ads-stat-icon-clicks {
  background: linear-gradient(135deg, #a855f7, #9333ea);
  box-shadow: 0 8px 24px rgba(168, 85, 247, 0.35);
}

.ads-stat-icon-clicks::before {
  background: linear-gradient(135deg, #c084fc, #9333ea);
}

.ads-stat-icon svg {
  color: white;
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
}

.ads-stat-content {
  flex: 1;
  position: relative;
}

.ads-stat-value {
  font-size: 2rem;
  font-weight: 800;
  line-height: 1;
  background: linear-gradient(135deg, #fbbf24, #fb923c);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 0.375rem;
}

.ads-stat-label {
  font-size: 0.8125rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.5);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.ads-stat-trend {
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
  margin-top: 0.375rem;
  padding: 0.25rem 0.5rem;
  background: rgba(245, 158, 11, 0.1);
  border-radius: 6px;
  font-size: 0.6875rem;
  font-weight: 700;
  color: #fb923c;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}

.ads-stat-trend svg {
  color: #f59e0b;
}

/* ==================== ADS GRID ==================== */
.ads-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
  gap: 1.5rem;
  animation: ads-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards;
}

.ad-card {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(245, 158, 11, 0.12);
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  display: flex;
  flex-direction: column;
  position: relative;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.ad-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.05), transparent);
  opacity: 0;
  transition: opacity 0.3s;
  pointer-events: none;
}

.ad-card:hover {
  transform: translateY(-6px);
  border-color: rgba(245, 158, 11, 0.3);
  box-shadow:
    0 16px 32px rgba(0, 0, 0, 0.15),
    0 0 48px rgba(245, 158, 11, 0.12);
}

.ad-card:hover::before {
  opacity: 1;
}

.ad-card-active {
  border-color: rgba(16, 185, 129, 0.2);
}

.ad-card-inactive {
  opacity: 0.75;
}

/* ==================== AD CARD IMAGE ==================== */
.ad-card-image {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.08), rgba(251, 146, 60, 0.05));
}

.ad-card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.ad-card:hover .ad-card-image img {
  transform: scale(1.05);
}

.ad-card-image-overlay {
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

.ad-card:hover .ad-card-image-overlay {
  opacity: 1;
}

.ad-card-placeholder {
  width: 100%;
  height: 200px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1rem;
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.05), rgba(251, 146, 60, 0.03));
  color: rgba(255, 255, 255, 0.3);
  position: relative;
  overflow: hidden;
}

.ad-card-placeholder::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(245, 158, 11, 0.05),
    transparent
  );
  background-size: 200% 100%;
  animation: ads-shimmer 3s infinite;
}

/* ==================== STATUS BADGE ==================== */
.ad-badge {
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

.ad-badge-active {
  background: rgba(16, 185, 129, 0.95);
  color: white;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.ad-badge-inactive {
  background: rgba(107, 114, 128, 0.95);
  color: rgba(255, 255, 255, 0.9);
  border: 1px solid rgba(255, 255, 255, 0.15);
}

.ad-badge svg {
  width: 8px;
  height: 8px;
}

/* ==================== AD CARD CONTENT ==================== */
.ad-card-content {
  padding: 1.75rem;
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
  flex: 1;
  position: relative;
}

.ad-card-header {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid rgba(245, 158, 11, 0.1);
}

.ad-card-title {
  margin: 0;
  font-size: 1.1875rem;
  font-weight: 700;
  color: rgba(255, 255, 255, 0.95);
  line-height: 1.3;
  background: linear-gradient(135deg, #fbbf24, #fb923c);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.ad-card-meta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
}

.ad-card-position {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.3125rem 0.75rem;
  background: rgba(245, 158, 11, 0.08);
  border-radius: 8px;
  font-size: 0.75rem;
  font-weight: 700;
  color: #fb923c;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border: 1px solid rgba(245, 158, 11, 0.15);
}

.ad-card-position svg {
  color: #f59e0b;
}

.ad-card-id {
  font-size: 0.75rem;
  color: rgba(255, 255, 255, 0.35);
  font-family: 'SF Mono', Monaco, monospace;
  font-weight: 600;
}

.ad-card-url {
  display: flex;
  align-items: center;
  gap: 0.625rem;
  padding: 0.875rem;
  background: rgba(245, 158, 11, 0.04);
  border-radius: 10px;
  border-left: 3px solid #f59e0b;
  transition: all 0.3s;
}

.ad-card-url:hover {
  background: rgba(245, 158, 11, 0.08);
  border-left-width: 4px;
}

.ad-card-url svg {
  color: #fb923c;
  flex-shrink: 0;
}

.ad-card-url a {
  color: rgba(255, 255, 255, 0.6);
  text-decoration: none;
  font-size: 0.8125rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  transition: color 0.3s;
}

.ad-card-url a:hover {
  color: #fb923c;
}

.ad-card-description {
  padding: 0.875rem;
  background: rgba(255, 255, 255, 0.02);
  border-radius: 10px;
  font-size: 0.875rem;
  line-height: 1.6;
  color: rgba(255, 255, 255, 0.65);
  border: 1px solid rgba(255, 255, 255, 0.05);
}

/* ==================== AD CARD STATS ==================== */
.ad-card-stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
  padding: 1rem;
  background: rgba(255, 255, 255, 0.02);
  border-radius: 12px;
  border: 1px solid rgba(245, 158, 11, 0.08);
}

.ad-card-stat {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem;
  background: rgba(255, 255, 255, 0.02);
  border-radius: 10px;
  transition: all 0.3s;
}

.ad-card-stat:hover {
  background: rgba(245, 158, 11, 0.05);
  transform: translateY(-2px);
}

.ad-card-stat-icon {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.ad-card-stat-icon-views {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
}

.ad-card-stat-icon-clicks {
  background: linear-gradient(135deg, #10b981, #059669);
}

.ad-card-stat-icon-ctr {
  background: linear-gradient(135deg, #a855f7, #9333ea);
}

.ad-card-stat-icon svg {
  color: white;
}

.ad-card-stat-content {
  text-align: center;
}

.ad-card-stat-value {
  font-size: 1.25rem;
  font-weight: 800;
  color: rgba(255, 255, 255, 0.95);
  line-height: 1;
}

.ad-card-stat-label {
  font-size: 0.6875rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.45);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-top: 0.25rem;
}

/* ==================== AD CARD DATES ==================== */
.ad-card-dates {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem;
  background: rgba(245, 158, 11, 0.04);
  border-radius: 10px;
  font-size: 0.8125rem;
  color: rgba(255, 255, 255, 0.6);
  font-family: 'SF Mono', Monaco, monospace;
  border: 1px solid rgba(245, 158, 11, 0.1);
}

.ad-card-dates svg {
  color: #fb923c;
  flex-shrink: 0;
}

/* ==================== AD CARD ACTIONS ==================== */
.ad-card-actions {
  display: flex;
  gap: 0.75rem;
  padding-top: 1rem;
  border-top: 1px solid rgba(245, 158, 11, 0.1);
  margin-top: auto;
}

.ad-card-btn {
  flex: 1;
  height: 44px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  border-radius: 10px;
  border: 1px solid rgba(245, 158, 11, 0.2);
  background: rgba(245, 158, 11, 0.05);
  color: rgba(255, 255, 255, 0.7);
  font-size: 0.875rem;
  font-weight: 700;
  text-decoration: none;
  cursor: pointer;
  font-family: inherit;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.ad-card-btn-edit:hover {
  background: rgba(245, 158, 11, 0.15);
  border-color: #fb923c;
  color: #fb923c;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(245, 158, 11, 0.2);
}

.ad-card-btn-delete:hover {
  background: rgba(239, 68, 68, 0.12);
  border-color: #ef4444;
  color: #ef4444;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(239, 68, 68, 0.2);
}

.ad-card-btn:active {
  transform: translateY(0);
}

/* ==================== EMPTY STATE ==================== */
.ads-empty {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 4rem 2rem;
  text-align: center;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 2px dashed rgba(245, 158, 11, 0.2);
  border-radius: 20px;
  animation: ads-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards;
}

.ads-empty-icon {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(251, 146, 60, 0.05));
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
  animation: ads-pulse 3s ease-in-out infinite;
}

.ads-empty-icon svg {
  color: rgba(245, 158, 11, 0.5);
}

.ads-empty-title {
  margin: 0 0 0.75rem 0;
  font-size: 1.5rem;
  font-weight: 700;
  background: linear-gradient(135deg, #fbbf24, #fb923c);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.ads-empty-desc {
  margin: 0 0 2rem 0;
  font-size: 0.9375rem;
  color: rgba(255, 255, 255, 0.5);
  max-width: 400px;
  line-height: 1.6;
}

.ads-empty-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 1rem 2rem;
  background: linear-gradient(135deg, #f59e0b, #fb923c);
  border: none;
  border-radius: 12px;
  color: white;
  font-weight: 700;
  font-size: 0.9375rem;
  text-decoration: none;
  box-shadow:
    0 8px 24px rgba(245, 158, 11, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.ads-empty-btn:hover {
  transform: translateY(-2px);
  box-shadow:
    0 12px 32px rgba(245, 158, 11, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.2);
}

.ads-empty-btn:active {
  transform: translateY(0);
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 1024px) {
  .ads-stats {
    grid-template-columns: repeat(2, 1fr);
  }

  .ads-grid {
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  }
}

@media (max-width: 768px) {
  .ads-hero {
    padding: 2rem 1.5rem;
  }

  .ads-hero-content {
    flex-direction: column;
    align-items: flex-start;
    gap: 1.25rem;
  }

  .ads-hero-icon {
    width: 64px;
    height: 64px;
    min-width: 64px;
  }

  .ads-hero-icon svg {
    width: 36px;
    height: 36px;
  }

  .ads-hero-title {
    font-size: 2rem;
  }

  .ads-hero-actions {
    width: 100%;
  }

  .ads-btn-create {
    width: 100%;
    justify-content: center;
  }

  .ads-stats {
    grid-template-columns: 1fr;
  }

  .ads-grid {
    grid-template-columns: 1fr;
  }

  .ad-card-stats {
    grid-template-columns: 1fr;
  }

  .ad-card-actions {
    flex-direction: column;
  }

  .ad-card-btn {
    width: 100%;
  }
}

@media (max-width: 480px) {
  .ads-hero-title {
    font-size: 1.75rem;
  }

  .ads-stat-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
  }

  .ads-stat-icon svg {
    width: 22px;
    height: 22px;
  }

  .ads-stat-value {
    font-size: 1.5rem;
  }
}
</style>
