<?php $title='Dashboard - Verwaltung'; ?>

<!-- Hero Header -->
<div class="admin-hero">
  <div class="admin-hero-bg"></div>
  <div class="admin-hero-content">
    <div class="admin-hero-icon">
      <svg width="56" height="56" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Outer Ring -->
        <circle cx="32" cy="32" r="28" stroke="url(#gradient1)" stroke-width="2.5" opacity="0.3"/>

        <!-- Middle Hexagon -->
        <path d="M32 8 L48 18 L48 38 L32 48 L16 38 L16 18 Z"
              stroke="url(#gradient2)"
              stroke-width="2.5"
              fill="none"
              stroke-linejoin="round"/>

        <!-- Inner Diamond -->
        <path d="M32 18 L40 28 L32 38 L24 28 Z"
              fill="url(#gradient3)"
              opacity="0.85"/>

        <!-- Center Spark -->
        <circle cx="32" cy="28" r="3" fill="white" opacity="0.9"/>

        <!-- Accent Lines -->
        <line x1="32" y1="8" x2="32" y2="14" stroke="white" stroke-width="2" opacity="0.6" stroke-linecap="round"/>
        <line x1="32" y1="42" x2="32" y2="48" stroke="white" stroke-width="2" opacity="0.6" stroke-linecap="round"/>
        <line x1="16" y1="18" x2="20" y2="21" stroke="white" stroke-width="2" opacity="0.6" stroke-linecap="round"/>
        <line x1="48" y1="18" x2="44" y2="21" stroke="white" stroke-width="2" opacity="0.6" stroke-linecap="round"/>

        <!-- Gradients -->
        <defs>
          <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#a78bfa;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#6366f1;stop-opacity:1" />
          </linearGradient>
          <linearGradient id="gradient2" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#ffffff;stop-opacity:1" />
            <stop offset="50%" style="stop-color:#c4b5fd;stop-opacity:0.95" />
            <stop offset="100%" style="stop-color:#a78bfa;stop-opacity:1" />
          </linearGradient>
          <linearGradient id="gradient3" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#c4b5fd;stop-opacity:0.9" />
            <stop offset="100%" style="stop-color:#8b5cf6;stop-opacity:0.8" />
          </linearGradient>
        </defs>
      </svg>
    </div>
    <div>
      <p class="admin-hero-subtitle">WILLKOMMEN IM</p>
      <h1 class="admin-hero-title">Dashboard</h1>
      <p class="admin-hero-desc">Verwalten Sie Ihren Blog ganz einfach</p>
    </div>
  </div>
</div>

<?php
// Calculate percentages for better visuals
$publishedPercentage = $totalPosts > 0 ? round(($publishedPosts / $totalPosts) * 100) : 0;
$draftPercentage = $totalPosts > 0 ? round(($draftPosts / $totalPosts) * 100) : 0;
$approvedPercentage = $totalComments > 0 ? round((($totalComments - $pendingComments) / $totalComments) * 100) : 100;
?>

<!-- Statistics Grid -->
<div class="admin-stats">
  <!-- Posts Card -->
  <div class="admin-stat-card admin-stat-card-posts">
    <div class="admin-stat-header">
      <div class="admin-stat-icon admin-stat-icon-posts">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="16" y1="13" x2="8" y2="13"></line>
          <line x1="16" y1="17" x2="8" y2="17"></line>
        </svg>
      </div>
      <div class="admin-stat-badge admin-stat-badge-posts">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <?= $publishedPercentage ?>%
      </div>
    </div>

    <div class="admin-stat-main">
      <div class="admin-stat-value"><?= $totalPosts ?></div>
      <div class="admin-stat-label">Artikel insgesamt</div>
    </div>

    <div class="admin-stat-breakdown">
      <div class="admin-stat-breakdown-item">
        <div class="admin-stat-breakdown-bar">
          <div class="admin-stat-breakdown-fill admin-stat-breakdown-fill-published" style="width: <?= $publishedPercentage ?>%"></div>
        </div>
        <div class="admin-stat-breakdown-text">
          <span class="admin-stat-breakdown-label">
            <span class="admin-stat-breakdown-dot admin-stat-breakdown-dot-published"></span>
            Veröffentlicht
          </span>
          <span class="admin-stat-breakdown-value"><?= $publishedPosts ?></span>
        </div>
      </div>

      <div class="admin-stat-breakdown-item">
        <div class="admin-stat-breakdown-bar">
          <div class="admin-stat-breakdown-fill admin-stat-breakdown-fill-draft" style="width: <?= $draftPercentage ?>%"></div>
        </div>
        <div class="admin-stat-breakdown-text">
          <span class="admin-stat-breakdown-label">
            <span class="admin-stat-breakdown-dot admin-stat-breakdown-dot-draft"></span>
            Entwürfe
          </span>
          <span class="admin-stat-breakdown-value"><?= $draftPosts ?></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Users Card -->
  <div class="admin-stat-card admin-stat-card-users">
    <div class="admin-stat-header">
      <div class="admin-stat-icon admin-stat-icon-users">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="9" cy="7" r="4"></circle>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
      </div>
      <div class="admin-stat-badge admin-stat-badge-users">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
          <polyline points="17 6 23 6 23 12"></polyline>
        </svg>
        100%
      </div>
    </div>

    <div class="admin-stat-main">
      <div class="admin-stat-value"><?= $totalUsers ?></div>
      <div class="admin-stat-label">Benutzer</div>
    </div>

    <div class="admin-stat-progress-ring">
      <svg width="120" height="120" class="admin-stat-ring-svg">
        <circle cx="60" cy="60" r="52" class="admin-stat-ring-bg"></circle>
        <circle cx="60" cy="60" r="52" class="admin-stat-ring-fill admin-stat-ring-fill-users" style="stroke-dasharray: 327; stroke-dashoffset: 0"></circle>
      </svg>
      <div class="admin-stat-ring-text">
        <div class="admin-stat-ring-label">Aktiv</div>
      </div>
    </div>
  </div>

  <!-- Comments Card -->
  <div class="admin-stat-card admin-stat-card-comments">
    <div class="admin-stat-header">
      <div class="admin-stat-icon admin-stat-icon-comments">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
      </div>
      <div class="admin-stat-badge <?= $pendingComments > 0 ? 'admin-stat-badge-warning' : 'admin-stat-badge-comments' ?>">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <?php if ($pendingComments > 0): ?>
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
          <?php else: ?>
            <polyline points="20 6 9 17 4 12"></polyline>
          <?php endif; ?>
        </svg>
        <?= $approvedPercentage ?>%
      </div>
    </div>

    <div class="admin-stat-main">
      <div class="admin-stat-value"><?= $totalComments ?></div>
      <div class="admin-stat-label">Kommentare</div>
    </div>

    <div class="admin-stat-meters">
      <div class="admin-stat-meter">
        <div class="admin-stat-meter-label">
          <span>Genehmigt</span>
          <span class="admin-stat-meter-count"><?= $totalComments - $pendingComments ?></span>
        </div>
        <div class="admin-stat-meter-bar">
          <div class="admin-stat-meter-fill admin-stat-meter-fill-approved" style="width: <?= $approvedPercentage ?>%"></div>
        </div>
      </div>

      <?php if ($pendingComments > 0): ?>
      <div class="admin-stat-meter">
        <div class="admin-stat-meter-label">
          <span>Ausstehend</span>
          <span class="admin-stat-meter-count admin-stat-meter-count-pending"><?= $pendingComments ?></span>
        </div>
        <div class="admin-stat-meter-bar">
          <div class="admin-stat-meter-fill admin-stat-meter-fill-pending" style="width: <?= 100 - $approvedPercentage ?>%"></div>
        </div>
      </div>
      <?php else: ?>
      <div class="admin-stat-status-all-approved">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <span>Alle Kommentare sind moderiert</span>
      </div>
      <?php endif; ?>
    </div>
  </div>

</div>

<!-- Quick Actions Section -->
<div class="admin-section">
  <div class="admin-section-header">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
      <circle cx="12" cy="12" r="10"></circle>
      <polyline points="12 6 12 12 16 14"></polyline>
    </svg>
    <h2 class="admin-section-title">Schnellaktionen</h2>
  </div>

  <div class="admin-actions-grid">
    <a class="admin-action-card" href="/admin/posts/create">
      <div class="admin-action-icon admin-action-icon-create">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="12" y1="5" x2="12" y2="19"></line>
          <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
      </div>
      <div class="admin-action-content">
        <h3 class="admin-action-title">Neuer Artikel</h3>
        <p class="admin-action-desc">Einen neuen Artikel erstellen</p>
      </div>
      <div class="admin-action-arrow">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </div>
    </a>

    <a class="admin-action-card" href="/admin/posts">
      <div class="admin-action-icon admin-action-icon-posts">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
        </svg>
      </div>
      <div class="admin-action-content">
        <h3 class="admin-action-title">Artikel verwalten</h3>
        <p class="admin-action-desc">Bearbeiten und veröffentlichen</p>
      </div>
      <div class="admin-action-arrow">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </div>
    </a>

    <a class="admin-action-card" href="/admin/users">
      <div class="admin-action-icon admin-action-icon-users">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="9" cy="7" r="4"></circle>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
      </div>
      <div class="admin-action-content">
        <h3 class="admin-action-title">Benutzer</h3>
        <p class="admin-action-desc">Konten verwalten</p>
      </div>
      <div class="admin-action-arrow">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </div>
    </a>

    <a class="admin-action-card" href="/admin/comments">
      <div class="admin-action-icon admin-action-icon-comments">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
      </div>
      <div class="admin-action-content">
        <h3 class="admin-action-title">Kommentare</h3>
        <p class="admin-action-desc">Moderation</p>
      </div>
      <div class="admin-action-arrow">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </div>
    </a>

    <a class="admin-action-card" href="/admin/tags">
      <div class="admin-action-icon admin-action-icon-tags">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
          <line x1="7" y1="7" x2="7.01" y2="7"></line>
        </svg>
      </div>
      <div class="admin-action-content">
        <h3 class="admin-action-title">Tags</h3>
        <p class="admin-action-desc">Themen organisieren</p>
      </div>
      <div class="admin-action-arrow">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </div>
    </a>

    <a class="admin-action-card" href="/admin/ads">
      <div class="admin-action-icon admin-action-icon-ads">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
          <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
        </svg>
      </div>
      <div class="admin-action-content">
        <h3 class="admin-action-title">Werbung</h3>
        <p class="admin-action-desc">Anzeigen verwalten</p>
      </div>
      <div class="admin-action-arrow">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </div>
    </a>
  </div>
</div>

<!-- Recent Activity -->
<div class="admin-activity">
  <!-- Recent Posts -->
  <div class="admin-activity-section">
    <div class="admin-section-header">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
      </svg>
      <h2 class="admin-section-title">Neueste Artikel</h2>
    </div>

    <?php if (empty($recentPosts)): ?>
      <div class="admin-activity-empty">
        <div class="admin-activity-empty-icon">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
          </svg>
        </div>
        <p>Keine neuesten Artikel</p>
      </div>
    <?php else: ?>
      <div class="admin-activity-list">
        <?php foreach ($recentPosts as $post): ?>
          <div class="admin-activity-item">
            <div class="admin-activity-icon admin-activity-icon-post">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
              </svg>
            </div>
            <div class="admin-activity-content">
              <a href="/admin/posts/<?= (int)$post['id'] ?>/edit" class="admin-activity-title">
                <?= esc($post['title']) ?>
              </a>
              <div class="admin-activity-meta">
                <span>Von <?= esc($post['author']) ?></span>
                <span class="admin-activity-divider">•</span>
                <span><?= date('d/m/Y à H:i', strtotime($post['created_at'])) ?></span>
                <span class="admin-activity-divider">•</span>
                <?php if ($post['published_at']): ?>
                  <span class="admin-activity-status admin-activity-status-published">Veröffentlicht</span>
                <?php else: ?>
                  <span class="admin-activity-status admin-activity-status-draft">Entwurf</span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Recent Comments -->
  <div class="admin-activity-section">
    <div class="admin-section-header">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
      </svg>
      <h2 class="admin-section-title">Neueste Kommentare</h2>
    </div>

    <?php if (empty($recentComments)): ?>
      <div class="admin-activity-empty">
        <div class="admin-activity-empty-icon">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
          </svg>
        </div>
        <p>Keine neuesten Kommentare</p>
      </div>
    <?php else: ?>
      <div class="admin-activity-list">
        <?php foreach ($recentComments as $comment): ?>
          <div class="admin-activity-item">
            <div class="admin-activity-icon admin-activity-icon-comment">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
              </svg>
            </div>
            <div class="admin-activity-content">
              <div class="admin-activity-comment-header">
                <span class="admin-activity-author"><?= esc($comment['author_name']) ?></span>
                <span>hat kommentiert zu</span>
                <a href="/post/<?= esc($comment['post_slug']) ?>" class="admin-activity-post-link">
                  <?= esc($comment['post_title']) ?>
                </a>
              </div>
              <p class="admin-activity-comment-body">
                <?= esc(mb_substr($comment['body'], 0, 120)) ?><?= mb_strlen($comment['body']) > 120 ? '...' : '' ?>
              </p>
              <div class="admin-activity-meta">
                <span><?= date('d/m/Y à H:i', strtotime($comment['created_at'])) ?></span>
                <span class="admin-activity-divider">•</span>
                <span class="admin-activity-status admin-activity-status-<?= esc($comment['status']) ?>">
                  <?= ucfirst(esc($comment['status'])) ?>
                </span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
/* ========================================================================
   ADMIN DASHBOARD - UNIFIED PROFESSIONAL THEME
   ======================================================================== */

:root {
  --admin-primary: #8b5cf6;
  --admin-secondary: #6366f1;
  --admin-gradient: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
}

/* ====================
   HERO HEADER
   ==================== */

.admin-hero {
  position: relative;
  margin-bottom: 2.5rem;
  padding: 3rem 2.5rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(30px);
  border: 1px solid rgba(139, 92, 246, 0.15);
  border-radius: 24px;
  overflow: hidden;
  box-shadow:
    0 8px 32px rgba(0, 0, 0, 0.12),
    0 0 0 1px rgba(139, 92, 246, 0.1) inset;
  animation: admin-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.admin-hero-bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(
    ellipse 800px 600px at 50% -20%,
    rgba(139, 92, 246, 0.08),
    transparent
  );
  animation: admin-pulse 8s ease-in-out infinite;
}

.admin-hero-content {
  position: relative;
  display: flex;
  align-items: center;
  gap: 2rem;
}

.admin-hero-icon {
  position: relative;
  width: 80px;
  height: 80px;
  background: var(--admin-gradient);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  color: white;
  box-shadow:
    0 20px 40px rgba(139, 92, 246, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
  animation: admin-float 6s ease-in-out infinite;
}

.admin-hero-icon::before {
  content: '';
  position: absolute;
  inset: -2px;
  background: var(--admin-gradient);
  border-radius: 22px;
  opacity: 0.5;
  filter: blur(20px);
  z-index: -1;
  animation: admin-pulse 3s ease-in-out infinite;
}

.admin-hero-subtitle {
  font-size: 0.9375rem;
  font-weight: 600;
  color: var(--admin-primary);
  margin: 0 0 0.5rem 0;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.admin-hero-title {
  font-size: 2.5rem;
  font-weight: 800;
  background: var(--admin-gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin: 0 0 0.5rem 0;
  line-height: 1.2;
}

.admin-hero-desc {
  font-size: 1rem;
  color: var(--text-muted);
  margin: 0;
  line-height: 1.6;
}

/* ====================
   STATISTICS CARDS
   ==================== */

.admin-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.admin-stat-card {
  position: relative;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  padding: 2rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(139, 92, 246, 0.1);
  border-radius: 20px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  animation: admin-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) backwards;
  overflow: hidden;
}

.admin-stat-card:nth-child(1) { animation-delay: 0.1s; }
.admin-stat-card:nth-child(2) { animation-delay: 0.2s; }
.admin-stat-card:nth-child(3) { animation-delay: 0.3s; }
.admin-stat-card:nth-child(4) { animation-delay: 0.4s; }

.admin-stat-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  opacity: 0;
  transition: opacity 0.4s ease;
}

.admin-stat-card-posts::before {
  background: linear-gradient(90deg, #8b5cf6, #7c3aed);
}

.admin-stat-card-users::before {
  background: linear-gradient(90deg, #3b82f6, #2563eb);
}

.admin-stat-card-comments::before {
  background: linear-gradient(90deg, #10b981, #059669);
}

.admin-stat-card-tags::before {
  background: linear-gradient(90deg, #ec4899, #d946ef);
}

.admin-stat-card:hover {
  transform: translateY(-6px);
  border-color: rgba(139, 92, 246, 0.3);
  box-shadow:
    0 16px 48px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(139, 92, 246, 0.2) inset;
}

.admin-stat-card:hover::before {
  opacity: 1;
}

/* Card Header */
.admin-stat-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.admin-stat-icon {
  width: 56px;
  height: 56px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
  position: relative;
}

.admin-stat-icon::before {
  content: '';
  position: absolute;
  inset: -2px;
  background: inherit;
  border-radius: 16px;
  opacity: 0.4;
  filter: blur(12px);
  z-index: -1;
}

.admin-stat-icon-posts {
  background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
  box-shadow:
    0 8px 24px rgba(139, 92, 246, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}

.admin-stat-icon-users {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  box-shadow:
    0 8px 24px rgba(59, 130, 246, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}

.admin-stat-icon-comments {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  box-shadow:
    0 8px 24px rgba(16, 185, 129, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}

.admin-stat-icon-tags {
  background: linear-gradient(135deg, #ec4899 0%, #d946ef 100%);
  box-shadow:
    0 8px 24px rgba(236, 72, 153, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}

.admin-stat-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.5rem 0.875rem;
  border-radius: 20px;
  font-size: 0.8125rem;
  font-weight: 700;
  backdrop-filter: blur(10px);
}

.admin-stat-badge-posts {
  background: rgba(139, 92, 246, 0.15);
  color: #8b5cf6;
  border: 1px solid rgba(139, 92, 246, 0.2);
}

.admin-stat-badge-users {
  background: rgba(59, 130, 246, 0.15);
  color: #3b82f6;
  border: 1px solid rgba(59, 130, 246, 0.2);
}

.admin-stat-badge-comments {
  background: rgba(16, 185, 129, 0.15);
  color: #10b981;
  border: 1px solid rgba(16, 185, 129, 0.2);
}

.admin-stat-badge-warning {
  background: rgba(245, 158, 11, 0.15);
  color: #f59e0b;
  border: 1px solid rgba(245, 158, 11, 0.2);
}

.admin-stat-badge-tags {
  background: rgba(236, 72, 153, 0.15);
  color: #ec4899;
  border: 1px solid rgba(236, 72, 153, 0.2);
}

/* Card Main Content */
.admin-stat-main {
  margin-bottom: 0.5rem;
}

.admin-stat-value {
  font-size: 2.75rem;
  font-weight: 800;
  color: var(--text-primary);
  line-height: 1;
  margin-bottom: 0.5rem;
  background: linear-gradient(135deg, #ffffff, #e0e7ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.admin-stat-label {
  font-size: 0.9375rem;
  font-weight: 600;
  color: var(--text-muted);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Breakdown Bars (Posts) */
.admin-stat-breakdown {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.admin-stat-breakdown-item {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.admin-stat-breakdown-bar {
  height: 8px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 20px;
  overflow: hidden;
  position: relative;
}

.admin-stat-breakdown-fill {
  height: 100%;
  border-radius: 20px;
  transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.admin-stat-breakdown-fill::after {
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
  animation: admin-shimmer 2s infinite;
}

.admin-stat-breakdown-fill-published {
  background: linear-gradient(90deg, #8b5cf6, #7c3aed);
  box-shadow: 0 0 10px rgba(139, 92, 246, 0.5);
}

.admin-stat-breakdown-fill-draft {
  background: linear-gradient(90deg, #6366f1, #4f46e5);
  box-shadow: 0 0 10px rgba(99, 102, 241, 0.5);
}

.admin-stat-breakdown-text {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 0.8125rem;
}

.admin-stat-breakdown-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: var(--text-secondary);
  font-weight: 600;
}

.admin-stat-breakdown-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  flex-shrink: 0;
}

.admin-stat-breakdown-dot-published {
  background: linear-gradient(135deg, #8b5cf6, #7c3aed);
  box-shadow: 0 0 6px rgba(139, 92, 246, 0.6);
}

.admin-stat-breakdown-dot-draft {
  background: linear-gradient(135deg, #6366f1, #4f46e5);
  box-shadow: 0 0 6px rgba(99, 102, 241, 0.6);
}

.admin-stat-breakdown-value {
  color: var(--text-primary);
  font-weight: 700;
}

/* Progress Ring (Users) */
.admin-stat-progress-ring {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto;
}

.admin-stat-ring-svg {
  transform: rotate(-90deg);
}

.admin-stat-ring-bg {
  fill: none;
  stroke: rgba(255, 255, 255, 0.05);
  stroke-width: 8;
}

.admin-stat-ring-fill {
  fill: none;
  stroke-width: 8;
  stroke-linecap: round;
  transition: stroke-dashoffset 1.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.admin-stat-ring-fill-users {
  stroke: url(#gradient-users);
  filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.6));
}

.admin-stat-ring-text {
  position: absolute;
  text-align: center;
}

.admin-stat-ring-label {
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--text-primary);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Meters (Comments) */
.admin-stat-meters {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.admin-stat-meter {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.admin-stat-meter-label {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 0.8125rem;
  font-weight: 600;
  color: var(--text-secondary);
}

.admin-stat-meter-count {
  color: var(--text-primary);
  font-weight: 700;
}

.admin-stat-meter-count-pending {
  color: #f59e0b;
}

.admin-stat-meter-bar {
  height: 6px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 20px;
  overflow: hidden;
}

.admin-stat-meter-fill {
  height: 100%;
  border-radius: 20px;
  transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.admin-stat-meter-fill::after {
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
  animation: admin-shimmer 2s infinite;
}

.admin-stat-meter-fill-approved {
  background: linear-gradient(90deg, #10b981, #059669);
  box-shadow: 0 0 8px rgba(16, 185, 129, 0.5);
}

.admin-stat-meter-fill-pending {
  background: linear-gradient(90deg, #f59e0b, #f97316);
  box-shadow: 0 0 8px rgba(245, 158, 11, 0.5);
}

.admin-stat-status-all-approved {
  display: flex;
  align-items: center;
  gap: 0.625rem;
  padding: 0.75rem 1rem;
  background: rgba(16, 185, 129, 0.1);
  border: 1px solid rgba(16, 185, 129, 0.2);
  border-radius: 12px;
  font-size: 0.8125rem;
  font-weight: 600;
  color: #10b981;
  backdrop-filter: blur(10px);
}

.admin-stat-status-all-approved svg {
  flex-shrink: 0;
}

/* Visual Grid (Tags) */
.admin-stat-visual {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.admin-stat-visual-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 0.75rem;
  padding: 1rem;
  background: rgba(255, 255, 255, 0.03);
  border-radius: 12px;
  border: 1px solid rgba(236, 72, 153, 0.1);
}

.admin-stat-visual-dot {
  width: 100%;
  aspect-ratio: 1;
  background: linear-gradient(135deg, #ec4899, #d946ef);
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
  animation: admin-dotPulse 2s ease-in-out infinite;
  position: relative;
}

.admin-stat-visual-dot::before {
  content: '';
  position: absolute;
  inset: -2px;
  background: linear-gradient(135deg, #ec4899, #d946ef);
  border-radius: 12px;
  opacity: 0.3;
  filter: blur(6px);
  z-index: -1;
}

.admin-stat-visual-more {
  width: 100%;
  aspect-ratio: 1;
  background: rgba(236, 72, 153, 0.15);
  border: 2px dashed rgba(236, 72, 153, 0.3);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.875rem;
  font-weight: 700;
  color: #ec4899;
}

.admin-stat-visual-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.8125rem;
  font-weight: 600;
  color: var(--text-muted);
}

.admin-stat-visual-label svg {
  color: #ec4899;
  flex-shrink: 0;
}

@keyframes admin-shimmer {
  0% {
    transform: translateX(-100%);
  }
  100% {
    transform: translateX(100%);
  }
}

@keyframes admin-dotPulse {
  0%, 100% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(0.95);
    opacity: 0.8;
  }
}

/* ====================
   SECTION HEADER
   ==================== */

.admin-section {
  margin-bottom: 2.5rem;
}

.admin-section-header {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 1.5rem;
}

.admin-section-header svg {
  color: var(--admin-primary);
  flex-shrink: 0;
}

.admin-section-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--text-primary);
  margin: 0;
}

/* ====================
   QUICK ACTIONS GRID
   ==================== */

.admin-actions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 1.25rem;
}

.admin-action-card {
  display: flex;
  align-items: center;
  gap: 1.25rem;
  padding: 1.5rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(139, 92, 246, 0.1);
  border-radius: 18px;
  text-decoration: none;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
}

.admin-action-card:hover {
  transform: translateX(6px);
  border-color: rgba(139, 92, 246, 0.3);
  box-shadow:
    0 12px 36px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(139, 92, 246, 0.2) inset;
}

.admin-action-icon {
  width: 52px;
  height: 52px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
}

.admin-action-icon::before {
  content: '';
  position: absolute;
  inset: -2px;
  background: inherit;
  border-radius: 16px;
  opacity: 0.3;
  filter: blur(10px);
  z-index: -1;
}

.admin-action-icon-create {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.admin-action-icon-posts {
  background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
}

.admin-action-icon-users {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

.admin-action-icon-comments {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.admin-action-icon-tags {
  background: linear-gradient(135deg, #ec4899 0%, #d946ef 100%);
}

.admin-action-icon-ads {
  background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
}

.admin-action-content {
  flex: 1;
  min-width: 0;
}

.admin-action-title {
  font-size: 1.0625rem;
  font-weight: 700;
  color: var(--text-primary);
  margin: 0 0 0.25rem 0;
}

.admin-action-desc {
  font-size: 0.875rem;
  color: var(--text-muted);
  margin: 0;
}

.admin-action-arrow {
  color: var(--admin-primary);
  opacity: 0.6;
  transition: all 0.3s ease;
  flex-shrink: 0;
}

.admin-action-card:hover .admin-action-arrow {
  opacity: 1;
  transform: translateX(4px);
}

/* ====================
   ACTIVITY SECTIONS
   ==================== */

.admin-activity {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(480px, 1fr));
  gap: 2rem;
}

.admin-activity-section {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(139, 92, 246, 0.1);
  border-radius: 20px;
  padding: 2rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.admin-activity-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.admin-activity-item {
  display: flex;
  gap: 1rem;
  padding: 1.25rem;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(139, 92, 246, 0.08);
  border-radius: 14px;
  transition: all 0.3s ease;
}

.admin-activity-item:hover {
  background: rgba(139, 92, 246, 0.05);
  border-color: rgba(139, 92, 246, 0.2);
  transform: translateX(4px);
}

.admin-activity-icon {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
}

.admin-activity-icon-post {
  background: linear-gradient(135deg, #8b5cf6, #7c3aed);
  box-shadow: 0 6px 20px rgba(139, 92, 246, 0.35);
}

.admin-activity-icon-comment {
  background: linear-gradient(135deg, #10b981, #059669);
  box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
}

.admin-activity-content {
  flex: 1;
  min-width: 0;
}

.admin-activity-title {
  font-size: 0.9375rem;
  font-weight: 600;
  color: var(--text-primary);
  text-decoration: none;
  display: block;
  margin-bottom: 0.5rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  transition: color 0.2s ease;
}

.admin-activity-title:hover {
  color: var(--admin-primary);
}

.admin-activity-comment-header {
  font-size: 0.875rem;
  color: var(--text-secondary);
  margin-bottom: 0.5rem;
}

.admin-activity-author {
  font-weight: 600;
  color: var(--text-primary);
}

.admin-activity-post-link {
  color: var(--admin-primary);
  text-decoration: none;
  font-weight: 600;
  transition: color 0.2s ease;
}

.admin-activity-post-link:hover {
  text-decoration: underline;
}

.admin-activity-comment-body {
  font-size: 0.875rem;
  color: var(--text-secondary);
  margin: 0 0 0.5rem 0;
  line-height: 1.5;
}

.admin-activity-meta {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.8125rem;
  color: var(--text-muted);
}

.admin-activity-divider {
  opacity: 0.4;
}

.admin-activity-status {
  font-weight: 600;
  padding: 0.25rem 0.625rem;
  border-radius: 20px;
  font-size: 0.75rem;
  backdrop-filter: blur(10px);
}

.admin-activity-status-published {
  background: rgba(16, 185, 129, 0.15);
  color: #10b981;
  border: 1px solid rgba(16, 185, 129, 0.2);
}

.admin-activity-status-draft {
  background: rgba(139, 92, 246, 0.15);
  color: #8b5cf6;
  border: 1px solid rgba(139, 92, 246, 0.2);
}

.admin-activity-status-approved {
  background: rgba(16, 185, 129, 0.15);
  color: #10b981;
  border: 1px solid rgba(16, 185, 129, 0.2);
}

.admin-activity-status-pending {
  background: rgba(245, 158, 11, 0.15);
  color: #f59e0b;
  border: 1px solid rgba(245, 158, 11, 0.2);
}

.admin-activity-status-spam,
.admin-activity-status-rejected {
  background: rgba(239, 68, 68, 0.15);
  color: #ef4444;
  border: 1px solid rgba(239, 68, 68, 0.2);
}

.admin-activity-empty {
  text-align: center;
  padding: 3rem 1.5rem;
}

.admin-activity-empty-icon {
  margin: 0 auto 1rem;
  width: 80px;
  height: 80px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: radial-gradient(
    circle at center,
    rgba(139, 92, 246, 0.15),
    rgba(99, 102, 241, 0.05)
  );
  color: var(--admin-primary);
  animation: admin-pulse 3s ease-in-out infinite;
}

.admin-activity-empty p {
  margin: 0;
  font-size: 0.9375rem;
  color: var(--text-muted);
}

/* ====================
   ANIMATIONS
   ==================== */

@keyframes admin-slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes admin-float {
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

@keyframes admin-pulse {
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
  .admin-stats {
    grid-template-columns: repeat(2, 1fr);
  }

  .admin-actions-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .admin-activity {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .admin-hero {
    padding: 2rem 1.5rem;
  }

  .admin-hero-content {
    flex-direction: column;
    align-items: flex-start;
    gap: 1.5rem;
  }

  .admin-hero-icon {
    width: 64px;
    height: 64px;
  }

  .admin-hero-icon svg {
    width: 36px;
    height: 36px;
  }

  .admin-hero-title {
    font-size: 2rem;
  }

  .admin-stats {
    grid-template-columns: 1fr;
  }

  .admin-stat-card {
    padding: 1.5rem;
  }

  .admin-stat-icon {
    width: 56px;
    height: 56px;
  }

  .admin-stat-icon svg {
    width: 24px;
    height: 24px;
  }

  .admin-stat-value {
    font-size: 2rem;
  }

  .admin-actions-grid {
    grid-template-columns: 1fr;
  }

  .admin-action-card:hover {
    transform: translateY(-4px);
  }

  .admin-activity-section {
    padding: 1.5rem;
  }
}

@media (max-width: 480px) {
  .admin-hero {
    padding: 1.5rem 1.25rem;
  }

  .admin-hero-title {
    font-size: 1.75rem;
  }

  .admin-stat-card {
    flex-direction: column;
    align-items: flex-start;
  }
}
</style>
