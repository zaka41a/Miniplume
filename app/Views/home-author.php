<?php $title='Meine Artikel'; ?>

<!-- Header Section -->
<section class="posts-page-header">
  <div class="header-content">
    <div class="header-icon">
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
        <line x1="16" y1="13" x2="8" y2="13"></line>
        <line x1="16" y1="17" x2="8" y2="17"></line>
        <line x1="10" y1="9" x2="8" y2="9"></line>
      </svg>
    </div>
    <div class="header-text">
      <h1 class="page-title">Meine Artikel</h1>
      <p class="page-subtitle">Verwalten und veröffentlichen Sie Ihre technischen Artikel</p>
    </div>
  </div>
  <div class="header-actions">
    <div class="stat-badge">
      <span class="stat-number"><?= count($posts) ?></span>
      <span class="stat-label">Artikel</span>
    </div>
    <a href="/admin/posts/create" class="create-btn">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      <span>Neuer Artikel</span>
    </a>
  </div>
</section>

<?php if (empty($posts)): ?>
  <!-- Empty State -->
  <div class="empty-state">
    <div class="empty-visual">
      <div class="empty-circle empty-circle-1"></div>
      <div class="empty-circle empty-circle-2"></div>
      <div class="empty-icon">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="16" y1="13" x2="8" y2="13"></line>
          <line x1="16" y1="17" x2="8" y2="17"></line>
        </svg>
      </div>
    </div>
    <h2 class="empty-title">Keine Artikel</h2>
    <p class="empty-desc">Teilen Sie Ihr Fachwissen, indem Sie Ihren ersten Artikel veröffentlichen.</p>
    <a href="/admin/posts/create" class="empty-btn">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      <span>Meinen ersten Artikel erstellen</span>
    </a>
  </div>
<?php else: ?>
  <!-- Posts Grid -->
  <div class="posts-grid">
    <?php foreach($posts as $index => $p): ?>
      <article class="post-card" style="--card-index: <?= $index ?>">
        <!-- Card Visual Header -->
        <div class="card-visual-header">
          <?php if (!empty($p['cover_path'])): ?>
            <div class="card-cover">
              <img src="/uploads/<?= esc($p['cover_path']) ?>" alt="<?= esc($p['title']) ?>" class="card-cover-img">
              <div class="card-cover-overlay"></div>
            </div>
          <?php else: ?>
            <div class="card-cover-placeholder">
              <div class="placeholder-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <line x1="10" y1="9" x2="8" y2="9"></line>
                </svg>
              </div>
              <div class="placeholder-pattern"></div>
            </div>
          <?php endif; ?>

          <?php if ($p['published_at']): ?>
            <div class="status-badge-overlay status-published">
              <span class="status-dot"></span>
              <span>Veröffentlicht</span>
            </div>
          <?php else: ?>
            <div class="status-badge-overlay status-draft">
              <span class="status-dot"></span>
              <span>Entwurf</span>
            </div>
          <?php endif; ?>
        </div>

        <!-- Card Content -->
        <div class="card-content">
          <h3 class="card-title">
            <a href="/post/<?= esc($p['slug']) ?>" target="_blank">
              <?= esc($p['title']) ?>
            </a>
          </h3>

          <div class="card-slug">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
              <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
            </svg>
            <span><?= esc($p['slug']) ?></span>
          </div>

          <?php if (!empty($p['tags'])): ?>
            <div class="card-tags">
              <?php foreach (array_slice($p['tags'], 0, 3) as $tag): ?>
                <span class="tag-badge">
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                  </svg>
                  <?= esc($tag['name']) ?>
                </span>
              <?php endforeach; ?>
              <?php if (count($p['tags']) > 3): ?>
                <span class="tag-count">+<?= count($p['tags']) - 3 ?></span>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <div class="card-divider"></div>

          <div class="card-info-grid">
            <div class="info-item">
              <div class="info-label">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>Datum</span>
              </div>
              <div class="info-value">
                <?php if ($p['published_at']): ?>
                  <?= esc(date('d/m/Y', strtotime($p['published_at']))) ?>
                <?php else: ?>
                  <span class="text-muted">Nicht veröffentlicht</span>
                <?php endif; ?>
              </div>
            </div>

            <div class="info-item">
              <div class="info-label">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                  <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                </svg>
                <span>ID</span>
              </div>
              <div class="info-value">#<?= (int)$p['id'] ?></div>
            </div>
          </div>
        </div>

        <!-- Card Actions -->
        <div class="card-actions-footer">
          <a href="/admin/posts/<?= (int)$p['id'] ?>/edit" class="action-btn action-edit">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
            <span>Bearbeiten</span>
          </a>

          <form method="post" action="/admin/posts/<?= (int)$p['id'] ?>/delete"
                onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Artikel löschen möchten?')"
                class="delete-form">
            <?= csrf_field() ?>
            <button type="submit" class="action-btn action-delete">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
              </svg>
              <span>Löschen</span>
            </button>
          </form>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<style>
/* ==================== PAGE HEADER ==================== */
.posts-page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
  padding: 3rem 2rem;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(99, 102, 241, 0.03));
  border: 1px solid rgba(139, 92, 246, 0.15);
  border-radius: 24px;
  margin-bottom: 3rem;
  position: relative;
  overflow: hidden;
}

.header-content {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  flex: 1;
}

.header-icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  box-shadow:
    0 10px 30px rgba(139, 92, 246, 0.4),
    inset 0 1px 0 rgba(255, 255, 255, 0.3);
  flex-shrink: 0;
  transition: transform 0.3s;
}

.header-icon:hover {
  transform: rotate(5deg);
}

.header-text {
  flex: 1;
}

.page-title {
  margin: 0 0 0.5rem;
  font-size: 2.5rem;
  font-weight: 900;
  background: linear-gradient(135deg, #e9d5ff, #c4b5fd, #a78bfa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: -1px;
}

.page-subtitle {
  margin: 0;
  color: rgba(255, 255, 255, 0.7);
  font-size: 1.0625rem;
  line-height: 1.6;
}

.header-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.stat-badge {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 1.25rem 2rem;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(139, 92, 246, 0.2);
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s;
}

.stat-badge:hover {
  transform: translateY(-5px);
}

.stat-number {
  font-size: 2.5rem;
  font-weight: 900;
  background: linear-gradient(135deg, #c4b5fd, #8b5cf6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  line-height: 1;
}

.stat-label {
  margin-top: 0.5rem;
  font-size: 0.875rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.6);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.create-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.75rem;
  padding: 1rem 2rem;
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  border-radius: 16px;
  color: white;
  font-weight: 700;
  font-size: 1rem;
  text-decoration: none;
  transition: all 0.3s;
  box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.create-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 40px rgba(139, 92, 246, 0.5);
}

.create-btn svg {
  transition: transform 0.3s;
}

.create-btn:hover svg {
  transform: rotate(90deg);
}

/* ==================== EMPTY STATE ==================== */
.empty-state {
  text-align: center;
  padding: 5rem 2rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(30px);
  border: 2px dashed rgba(139, 92, 246, 0.2);
  border-radius: 32px;
  max-width: 700px;
  margin: 0 auto;
}

.empty-visual {
  position: relative;
  display: inline-block;
  margin-bottom: 2.5rem;
}

.empty-circle {
  position: absolute;
  border-radius: 50%;
  border: 2px solid rgba(139, 92, 246, 0.2);
}

.empty-circle-1 {
  width: 180px;
  height: 180px;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: pulse 3s ease-in-out infinite;
}

.empty-circle-2 {
  width: 140px;
  height: 140px;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: pulse 3s ease-in-out infinite 1.5s;
}

@keyframes pulse {
  0%, 100% { opacity: 0.4; transform: translate(-50%, -50%); }
  50% { opacity: 0.8; transform: translate(-50%, -50%); }
}

.empty-icon {
  position: relative;
  width: 120px;
  height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(99, 102, 241, 0.05));
  border-radius: 50%;
  color: rgba(139, 92, 246, 0.5);
  box-shadow: 0 15px 40px rgba(139, 92, 246, 0.15);
}

.empty-title {
  font-size: 2rem;
  font-weight: 800;
  margin: 0 0 1rem;
  background: linear-gradient(135deg, #a78bfa, #818cf8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.empty-desc {
  font-size: 1.125rem;
  line-height: 1.8;
  color: rgba(255, 255, 255, 0.65);
  max-width: 500px;
  margin: 0 auto 2.5rem;
}

.empty-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.75rem;
  padding: 1rem 2rem;
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  border-radius: 16px;
  color: white;
  font-weight: 700;
  text-decoration: none;
  transition: all 0.3s;
  box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
}

.empty-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 40px rgba(139, 92, 246, 0.4);
}

.empty-btn svg {
  transition: transform 0.3s;
}

.empty-btn:hover svg {
  transform: rotate(90deg);
}

/* ==================== POSTS GRID ==================== */
.posts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
  gap: 2rem;
  padding: 0 2rem;
}

.post-card {
  position: relative;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(30px) saturate(150%);
  border: 1px solid rgba(139, 92, 246, 0.15);
  border-radius: 24px;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) backwards;
  animation-delay: calc(var(--card-index) * 0.1s);
  box-shadow:
    0 15px 40px rgba(0, 0, 0, 0.12),
    inset 0 1px 0 rgba(255, 255, 255, 0.08);
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.post-card:hover {
  transform: translateY(-8px);
  border-color: rgba(139, 92, 246, 0.3);
  box-shadow:
    0 25px 60px rgba(0, 0, 0, 0.2),
    0 0 80px rgba(139, 92, 246, 0.2),
    inset 0 1px 0 rgba(255, 255, 255, 0.15);
}

/* ==================== VISUAL HEADER ==================== */
.card-visual-header {
  position: relative;
  height: 200px;
  overflow: hidden;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(99, 102, 241, 0.05));
}

.card-cover {
  width: 100%;
  height: 100%;
  position: relative;
}

.card-cover-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.post-card:hover .card-cover-img {
  transform: rotate(2deg);
}

.card-cover-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(10, 14, 26, 0.8) 0%, transparent 60%);
}

.card-cover-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

.placeholder-icon {
  position: relative;
  z-index: 2;
  color: rgba(139, 92, 246, 0.4);
}

.placeholder-pattern {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(45deg, rgba(139, 92, 246, 0.03) 25%, transparent 25%),
    linear-gradient(-45deg, rgba(139, 92, 246, 0.03) 25%, transparent 25%),
    linear-gradient(45deg, transparent 75%, rgba(139, 92, 246, 0.03) 75%),
    linear-gradient(-45deg, transparent 75%, rgba(139, 92, 246, 0.03) 75%);
  background-size: 40px 40px;
  background-position: 0 0, 0 20px, 20px -20px, -20px 0px;
}

.status-badge-overlay {
  position: absolute;
  top: 1rem;
  right: 1rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  border: 1px solid;
  border-radius: 100px;
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  backdrop-filter: blur(12px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
  z-index: 3;
}

.status-badge-overlay.status-published {
  background: rgba(34, 197, 94, 0.2);
  border-color: #22c55e;
  color: #4ade80;
}

.status-badge-overlay.status-draft {
  background: rgba(234, 179, 8, 0.2);
  border-color: #eab308;
  color: #fbbf24;
}

.status-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: currentColor;
  animation: blink 2s ease-in-out infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.4; }
}

/* ==================== CARD CONTENT ==================== */
.card-content {
  padding: 1.5rem;
}

.card-title {
  margin: 0 0 0.75rem;
  font-size: 1.5rem;
  font-weight: 800;
  line-height: 1.3;
  letter-spacing: -0.5px;
}

.card-title a {
  color: rgba(255, 255, 255, 0.95);
  text-decoration: none;
  transition: all 0.3s;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.card-title a:hover {
  background: linear-gradient(135deg, #c4b5fd, #a78bfa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.card-slug {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: rgba(255, 255, 255, 0.45);
  font-size: 0.8125rem;
  font-family: 'Monaco', 'Courier New', monospace;
  font-weight: 500;
  margin-bottom: 1rem;
}

.card-slug svg {
  opacity: 0.6;
  flex-shrink: 0;
}

.card-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 1.25rem;
}

.tag-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.375rem 0.75rem;
  background: rgba(139, 92, 246, 0.08);
  border: 1px solid rgba(139, 92, 246, 0.15);
  border-radius: 100px;
  color: #c4b5fd;
  font-size: 0.75rem;
  font-weight: 600;
  transition: all 0.3s;
}

.tag-badge:hover {
  background: rgba(139, 92, 246, 0.15);
  border-color: rgba(139, 92, 246, 0.3);
}

.tag-badge svg {
  opacity: 0.7;
}

.tag-count {
  padding: 0.375rem 0.625rem;
  background: rgba(255, 255, 255, 0.03);
  border-radius: 100px;
  font-size: 0.6875rem;
  font-weight: 700;
  color: rgba(255, 255, 255, 0.4);
}

.card-divider {
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.2), transparent);
  margin: 1.25rem 0;
}

.card-info-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}

.info-item {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  padding: 1rem;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(139, 92, 246, 0.08);
  border-radius: 12px;
  transition: all 0.3s;
}

.info-item:hover {
  background: rgba(255, 255, 255, 0.04);
  border-color: rgba(139, 92, 246, 0.15);
}

.info-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: rgba(255, 255, 255, 0.5);
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.info-label svg {
  opacity: 0.7;
}

.info-value {
  color: rgba(255, 255, 255, 0.9);
  font-size: 0.9375rem;
  font-weight: 700;
  letter-spacing: -0.2px;
}

.text-muted {
  color: rgba(255, 255, 255, 0.4);
  font-style: italic;
}

/* ==================== CARD ACTIONS ==================== */
.card-actions-footer {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0;
  border-top: 1px solid rgba(139, 92, 246, 0.1);
}

.delete-form {
  margin: 0;
}

.action-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.625rem;
  padding: 1rem;
  font-weight: 600;
  font-size: 0.875rem;
  font-family: inherit;
  text-decoration: none;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  cursor: pointer;
  border: none;
  position: relative;
}

.action-btn::before {
  content: '';
  position: absolute;
  inset: 0;
  background: currentColor;
  opacity: 0;
  transition: opacity 0.3s;
}

.action-btn:hover::before {
  opacity: 0.05;
}

.action-btn svg {
  transition: transform 0.3s;
  position: relative;
  z-index: 1;
}

.action-btn span {
  position: relative;
  z-index: 1;
}

.action-edit {
  color: #a78bfa;
  border-right: 1px solid rgba(139, 92, 246, 0.1);
}

.action-edit:hover {
  color: #c4b5fd;
}

.action-delete {
  color: #f87171;
}

.action-delete:hover {
  color: #fca5a5;
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 1024px) {
  .posts-grid {
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 1.75rem;
  }

  .card-visual-header {
    height: 180px;
  }
}

@media (max-width: 768px) {
  .posts-page-header {
    flex-direction: column;
    align-items: flex-start;
    padding: 2rem 1.5rem;
  }

  .header-content {
    width: 100%;
  }

  .header-icon {
    width: 60px;
    height: 60px;
  }

  .page-title {
    font-size: 2rem;
  }

  .page-subtitle {
    font-size: 0.9375rem;
  }

  .header-actions {
    width: 100%;
    flex-direction: column;
  }

  .stat-badge,
  .create-btn {
    width: 100%;
    justify-content: center;
  }

  .posts-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
    padding: 0 1rem;
  }

  .card-header {
    flex-direction: column;
    align-items: flex-start;
  }

  .status-badge {
    align-self: flex-start;
  }

  .card-footer {
    flex-direction: column;
    align-items: flex-start;
  }

  .card-actions {
    width: 100%;
  }

  .edit-btn,
  .delete-btn {
    flex: 1;
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .page-title {
    font-size: 1.75rem;
  }

  .stat-number {
    font-size: 2rem;
  }

  .card-meta {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }
}
</style>
