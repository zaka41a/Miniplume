<?php $title='Startseite'; ?>

<!-- Hero Section -->
<section class="home-hero">
  <div class="home-hero-bg">
    <div class="home-hero-gradient"></div>
    <div class="home-hero-mesh"></div>
    <!-- Floating Orbs -->
    <div class="home-hero-orbs">
      <div class="home-orb home-orb-1"></div>
      <div class="home-orb home-orb-2"></div>
      <div class="home-orb home-orb-3"></div>
      <div class="home-orb home-orb-4"></div>
    </div>
  </div>

  <div class="home-hero-content">
    <div class="home-hero-badge">
      <span class="home-badge-dot"></span>
      <span>Premium Technik-Blog</span>
      <div class="home-badge-glow"></div>
    </div>

    <h1 class="home-hero-title">
      <span class="home-title-line">Willkommen bei</span>
      <span class="home-title-gradient">
        <span class="home-title-word" style="--char-index: 0">M</span>
        <span class="home-title-word" style="--char-index: 1">i</span>
        <span class="home-title-word" style="--char-index: 2">n</span>
        <span class="home-title-word" style="--char-index: 3">i</span>
        <span class="home-title-word" style="--char-index: 4">p</span>
        <span class="home-title-word" style="--char-index: 5">l</span>
        <span class="home-title-word" style="--char-index: 6">u</span>
        <span class="home-title-word" style="--char-index: 7">m</span>
        <span class="home-title-word" style="--char-index: 8">e</span>
      </span>
    </h1>

    <p class="home-hero-subtitle">
      Entdecken Sie prägnante und technische Artikel über PHP, moderne Webentwicklung und Best Practices. Werden Sie Teil unserer Experten-Community.
    </p>

    <div class="home-hero-actions">
      <a href="#articles" class="home-btn home-btn-primary">
        <span class="home-btn-content">
          <span class="home-btn-text">Artikel erkunden</span>
          <svg class="home-btn-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M5 12h14"></path>
            <path d="m12 5 7 7-7 7"></path>
          </svg>
        </span>
        <span class="home-btn-bg"></span>
      </a>

      <?php if (!class_exists('Auth') || !\Auth::check()): ?>
        <a href="/login" class="home-btn home-btn-secondary">
          <span class="home-btn-content">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
              <polyline points="10 17 15 12 10 7"></polyline>
              <line x1="15" y1="12" x2="3" y2="12"></line>
            </svg>
            <span class="home-btn-text">Anmelden</span>
          </span>
          <span class="home-btn-border"></span>
        </a>
      <?php endif; ?>
    </div>

    <div class="home-hero-stats">
      <div class="home-stat">
        <div class="home-stat-visual">
          <div class="home-stat-ring"></div>
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
          </svg>
        </div>
        <div class="home-stat-info">
          <div class="home-stat-value"><?= count($posts) ?></div>
          <div class="home-stat-label">Artikel</div>
        </div>
      </div>

      <div class="home-stat-separator"></div>

      <div class="home-stat">
        <div class="home-stat-visual">
          <div class="home-stat-ring"></div>
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
            <line x1="7" y1="7" x2="7.01" y2="7"></line>
          </svg>
        </div>
        <div class="home-stat-info">
          <div class="home-stat-value">
            <?php
              $allTags = [];
              foreach($posts as $p) {
                if(!empty($p['tags'])) {
                  foreach($p['tags'] as $t) {
                    $allTags[$t['id']] = true;
                  }
                }
              }
              echo count($allTags);
            ?>
          </div>
          <div class="home-stat-label">Kategorien</div>
        </div>
      </div>

      <div class="home-stat-separator"></div>

      <div class="home-stat">
        <div class="home-stat-visual">
          <div class="home-stat-ring"></div>
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
        </div>
        <div class="home-stat-info">
          <div class="home-stat-value">
            <?php
              $authors = [];
              foreach($posts as $p) {
                if(!empty($p['author'])) {
                  $authors[$p['author']] = true;
                }
              }
              echo count($authors);
            ?>
          </div>
          <div class="home-stat-label">Autoren</div>
        </div>
      </div>
    </div>
  </div>

  <div class="home-hero-scroll">
    <a href="#articles" class="home-scroll-btn">
      <span class="home-scroll-text">Entdecken</span>
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 5v14m0 0 7-7m-7 7-7-7"></path>
      </svg>
    </a>
  </div>
</section>

<!-- Articles Section -->
<?php if (empty($posts)): ?>
  <div class="home-empty">
    <div class="home-empty-visual">
      <div class="home-empty-circle home-empty-circle-1"></div>
      <div class="home-empty-circle home-empty-circle-2"></div>
      <div class="home-empty-icon">
        <svg width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="16" y1="13" x2="8" y2="13"></line>
          <line x1="16" y1="17" x2="8" y2="17"></line>
        </svg>
      </div>
    </div>
    <h2 class="home-empty-title">Keine veröffentlichten Artikel</h2>
    <p class="home-empty-desc">
      Artikel werden hier angezeigt, sobald sie von unseren Autoren veröffentlicht wurden.
      <?php if (class_exists('Auth') && \Auth::roleIn(['admin', 'author'])): ?>
        Melden Sie sich im Admin-Bereich an, um Ihren ersten Artikel zu erstellen.
      <?php endif; ?>
    </p>
  </div>
<?php else: ?>
  <div id="articles" class="home-section">
    <div class="home-section-header">
      <div class="home-section-tag">
        <span class="home-tag-pulse"></span>
        <span>Neueste Artikel</span>
      </div>
      <h2 class="home-section-title">Aktuelle Veröffentlichungen</h2>
      <p class="home-section-desc">Erkunden Sie die neuesten Inhalte unserer Experten-Community</p>
    </div>

    <div class="home-posts">
      <?php foreach ($posts as $index => $p): ?>
        <article class="home-card" style="--card-index: <?= $index ?>">
          <div class="home-card-glow"></div>

          <div class="home-card-media">
            <?php if (!empty($p['cover_path'])): ?>
              <img src="/uploads/<?= esc($p['cover_path']) ?>" alt="<?= esc($p['title']) ?>" class="home-card-img">
              <div class="home-card-overlay"></div>
            <?php else: ?>
              <div class="home-card-placeholder">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                  <circle cx="8.5" cy="8.5" r="1.5"></circle>
                  <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
                <div class="home-placeholder-shine"></div>
              </div>
            <?php endif; ?>

            <?php if (!empty($p['tags']) && count($p['tags']) > 0): ?>
              <div class="home-card-tag">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                </svg>
                <span><?= esc($p['tags'][0]['name']) ?></span>
              </div>
            <?php endif; ?>
          </div>

          <div class="home-card-body">
            <h3 class="home-card-title">
              <a href="/post/<?= esc($p['slug']) ?>"><?= esc($p['title']) ?></a>
            </h3>

            <p class="home-card-excerpt"><?= esc(excerpt($p['body'] ?? '', 145)) ?></p>

            <div class="home-card-meta">
              <div class="home-card-author">
                <div class="home-author-avatar">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 6v6l4 2"></path>
                  </svg>
                </div>
                <div class="home-author-details">
                  <div class="home-author-name"><?= esc($p['author'] ?? 'Anonym') ?></div>
                  <div class="home-author-date"><?= esc(date('d/m/Y', strtotime($p['published_at'] ?? $p['created_at'] ?? 'now'))) ?></div>
                </div>
              </div>
            </div>

            <?php if (!empty($p['tags']) && count($p['tags']) > 1): ?>
              <div class="home-card-tags">
                <?php foreach (array_slice($p['tags'], 1, 3) as $tagIndex => $t): ?>
                  <a href="/tag/<?= esc($t['slug']) ?>" class="home-tag">
                    <?= esc($t['name']) ?>
                  </a>
                <?php endforeach; ?>
                <?php if (count($p['tags']) > 4): ?>
                  <span class="home-tag-count">+<?= count($p['tags']) - 4 ?></span>
                <?php endif; ?>
              </div>
            <?php endif; ?>

            <a href="/post/<?= esc($p['slug']) ?>" class="home-card-link">
              <span>Artikel lesen</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
              </svg>
              <div class="home-link-wave"></div>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <?php require __DIR__.'/components/pagination.php'; ?>
  </div>
<?php endif; ?>

<style>
/* ==================== MODERN ANIMATIONS ==================== */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(60px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes floatOrb {
  0%, 100% { transform: translate(0, 0) scale(1); }
  25% { transform: translate(30px, -30px) scale(1.1); }
  50% { transform: translate(-20px, 20px) scale(0.9); }
  75% { transform: translate(40px, 10px) scale(1.05); }
}

@keyframes rotateMesh {
  from { transform: rotate(0deg) scale(1); }
  to { transform: rotate(360deg) scale(1.2); }
}

@keyframes glowPulse {
  0%, 100% { opacity: 0.4; transform: scale(1); }
  50% { opacity: 0.8; transform: scale(1.1); }
}

@keyframes shimmerSlide {
  from { transform: translateX(-100%) skewX(-15deg); }
  to { transform: translateX(200%) skewX(-15deg); }
}

@keyframes dotBlink {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.4; transform: scale(0.8); }
}

@keyframes charFloat {
  0%, 100% { transform: translateY(0) rotateX(0deg); }
  50% { transform: translateY(-8px) rotateX(10deg); }
}

@keyframes borderSpin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

@keyframes waveMove {
  0% { transform: translateX(-100%) scaleY(1); }
  100% { transform: translateX(100%) scaleY(1.2); }
}

@keyframes scrollBounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

@keyframes ringExpand {
  0% { transform: scale(0.8); opacity: 0.8; }
  100% { transform: scale(1.2); opacity: 0; }
}

/* ==================== MODERN HERO ==================== */
.home-hero {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 8rem 0 6rem;
  overflow: hidden;
}

.home-hero-bg {
  position: absolute;
  inset: 0;
  overflow: hidden;
}

.home-hero-gradient {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.2) 0%, transparent 50%),
    radial-gradient(circle at 80% 70%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
    radial-gradient(circle at 50% 50%, rgba(124, 58, 237, 0.1) 0%, transparent 70%);
}

.home-hero-mesh {
  position: absolute;
  inset: -50%;
  background-image:
    linear-gradient(rgba(139, 92, 246, 0.03) 2px, transparent 2px),
    linear-gradient(90deg, rgba(139, 92, 246, 0.03) 2px, transparent 2px);
  background-size: 80px 80px;
  animation: rotateMesh 120s linear infinite;
  opacity: 0.5;
}

.home-hero-orbs {
  position: absolute;
  inset: 0;
}

.home-orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(60px);
  opacity: 0.4;
  animation: floatOrb 20s ease-in-out infinite;
}

.home-orb-1 {
  width: 400px;
  height: 400px;
  background: radial-gradient(circle, rgba(139, 92, 246, 0.4), transparent);
  top: 10%;
  left: 10%;
  animation-delay: 0s;
}

.home-orb-2 {
  width: 350px;
  height: 350px;
  background: radial-gradient(circle, rgba(99, 102, 241, 0.3), transparent);
  top: 60%;
  right: 10%;
  animation-delay: 5s;
}

.home-orb-3 {
  width: 300px;
  height: 300px;
  background: radial-gradient(circle, rgba(124, 58, 237, 0.35), transparent);
  bottom: 20%;
  left: 50%;
  animation-delay: 10s;
}

.home-orb-4 {
  width: 280px;
  height: 280px;
  background: radial-gradient(circle, rgba(167, 139, 250, 0.3), transparent);
  top: 30%;
  right: 30%;
  animation-delay: 15s;
}

.home-hero-content {
  position: relative;
  z-index: 10;
  text-align: center;
  max-width: 1000px;
  padding: 0 2rem;
  animation: fadeUp 1s cubic-bezier(0.16, 1, 0.3, 1);
}

.home-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.875rem 1.75rem;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(139, 92, 246, 0.2);
  border-radius: 100px;
  font-size: 0.8125rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: rgba(255, 255, 255, 0.9);
  margin-bottom: 3rem;
  position: relative;
  overflow: hidden;
  box-shadow:
    0 10px 30px rgba(139, 92, 246, 0.15),
    inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.home-badge-dot {
  width: 8px;
  height: 8px;
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  border-radius: 50%;
  animation: dotBlink 2s ease-in-out infinite;
  box-shadow: 0 0 10px rgba(139, 92, 246, 0.8);
}

.home-badge-glow {
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  animation: shimmerSlide 3s infinite;
}

.home-hero-title {
  margin: 0 0 2.5rem;
  font-size: 5rem;
  font-weight: 900;
  line-height: 1.1;
  letter-spacing: -2px;
}

.home-title-line {
  display: block;
  color: rgba(255, 255, 255, 0.9);
  font-size: 2.5rem;
  font-weight: 600;
  margin-bottom: 1rem;
  letter-spacing: -1px;
}

.home-title-gradient {
  display: block;
  background: linear-gradient(135deg, #c4b5fd 0%, #a78bfa 20%, #8b5cf6 40%, #7c3aed 60%, #6366f1 80%, #818cf8 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  filter: drop-shadow(0 0 40px rgba(139, 92, 246, 0.4));
  position: relative;
}

.home-title-word {
  display: inline-block;
  animation: charFloat 3s ease-in-out infinite;
  animation-delay: calc(var(--char-index) * 0.1s);
}

.home-hero-subtitle {
  font-size: 1.375rem;
  line-height: 1.8;
  color: rgba(255, 255, 255, 0.7);
  max-width: 700px;
  margin: 0 auto 4rem;
  font-weight: 400;
}

.home-hero-actions {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 1.5rem;
  margin-bottom: 5rem;
  flex-wrap: wrap;
}

.home-btn {
  position: relative;
  display: inline-flex;
  align-items: center;
  padding: 1.125rem 2.5rem;
  border-radius: 16px;
  font-weight: 700;
  font-size: 1.0625rem;
  text-decoration: none;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.home-btn-content {
  position: relative;
  z-index: 2;
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.home-btn-primary {
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  color: white;
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow:
    0 20px 50px rgba(139, 92, 246, 0.4),
    inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.home-btn-primary:hover {
  transform: translateY(-4px) scale(1.02);
  box-shadow:
    0 30px 70px rgba(139, 92, 246, 0.5),
    0 0 80px rgba(139, 92, 246, 0.3),
    inset 0 1px 0 rgba(255, 255, 255, 0.4);
}

.home-btn-primary .home-btn-icon {
  transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.home-btn-primary:hover .home-btn-icon {
  transform: translateX(5px);
}

.home-btn-bg {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
  transform: translateX(-100%);
  transition: transform 0.6s;
}

.home-btn-primary:hover .home-btn-bg {
  transform: translateX(100%);
}

.home-btn-secondary {
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(20px);
  color: rgba(255, 255, 255, 0.95);
  border: 2px solid rgba(139, 92, 246, 0.3);
}

.home-btn-secondary:hover {
  transform: translateY(-4px);
  background: rgba(255, 255, 255, 0.08);
  border-color: rgba(139, 92, 246, 0.6);
  box-shadow: 0 20px 50px rgba(139, 92, 246, 0.3);
}

.home-btn-border {
  position: absolute;
  inset: -2px;
  border-radius: 16px;
  background: conic-gradient(from 0deg, transparent, rgba(139, 92, 246, 0.6), transparent);
  opacity: 0;
  transition: opacity 0.4s;
  animation: borderSpin 3s linear infinite;
}

.home-btn-secondary:hover .home-btn-border {
  opacity: 1;
}

.home-hero-stats {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 4rem;
  padding: 3rem 4rem;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(30px) saturate(150%);
  border: 1px solid rgba(139, 92, 246, 0.15);
  border-radius: 28px;
  box-shadow:
    0 30px 70px rgba(0, 0, 0, 0.2),
    inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.home-stat {
  display: flex;
  align-items: center;
  gap: 1.5rem;
}

.home-stat-visual {
  position: relative;
  width: 68px;
  height: 68px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.12), rgba(99, 102, 241, 0.08));
  border-radius: 20px;
  border: 1px solid rgba(139, 92, 246, 0.2);
  box-shadow: 0 10px 25px rgba(139, 92, 246, 0.15);
}

.home-stat-ring {
  position: absolute;
  inset: -4px;
  border: 2px solid rgba(139, 92, 246, 0.3);
  border-radius: 20px;
  animation: ringExpand 2s ease-out infinite;
}

.home-stat-visual svg {
  color: #c4b5fd;
  filter: drop-shadow(0 0 10px rgba(139, 92, 246, 0.5));
}

.home-stat-info {
  display: flex;
  flex-direction: column;
  gap: 0.375rem;
}

.home-stat-value {
  font-size: 2.5rem;
  font-weight: 900;
  line-height: 1;
  background: linear-gradient(135deg, #c4b5fd, #8b5cf6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: -1px;
}

.home-stat-label {
  font-size: 0.9375rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.6);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.home-stat-separator {
  width: 2px;
  height: 68px;
  background: linear-gradient(to bottom, transparent, rgba(139, 92, 246, 0.3), transparent);
}

.home-hero-scroll {
  position: absolute;
  bottom: 3rem;
  left: 50%;
  transform: translateX(-50%);
  z-index: 10;
}

.home-scroll-btn {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.75rem;
  color: rgba(255, 255, 255, 0.7);
  text-decoration: none;
  font-size: 0.875rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  transition: all 0.3s;
  animation: scrollBounce 2s ease-in-out infinite;
}

.home-scroll-btn:hover {
  color: #a78bfa;
}

.home-scroll-btn svg {
  opacity: 0.7;
}

/* ==================== MODERN EMPTY STATE ==================== */
.home-empty {
  text-align: center;
  padding: 8rem 2rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(30px);
  border: 2px dashed rgba(139, 92, 246, 0.2);
  border-radius: 32px;
  margin: 4rem auto;
  max-width: 700px;
}

.home-empty-visual {
  position: relative;
  display: inline-block;
  margin-bottom: 3rem;
}

.home-empty-circle {
  position: absolute;
  border-radius: 50%;
  border: 2px solid rgba(139, 92, 246, 0.2);
}

.home-empty-circle-1 {
  width: 180px;
  height: 180px;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: glowPulse 3s ease-in-out infinite;
}

.home-empty-circle-2 {
  width: 140px;
  height: 140px;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: glowPulse 3s ease-in-out infinite 1.5s;
}

.home-empty-icon {
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

.home-empty-title {
  font-size: 2.25rem;
  font-weight: 800;
  margin: 0 0 1.5rem;
  background: linear-gradient(135deg, #a78bfa, #818cf8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.home-empty-desc {
  font-size: 1.125rem;
  line-height: 1.8;
  color: rgba(255, 255, 255, 0.65);
  max-width: 500px;
  margin: 0 auto;
}

/* ==================== MODERN SECTION ==================== */
.home-section {
  padding: 6rem 0;
}

.home-section-header {
  text-align: center;
  margin-bottom: 5rem;
  animation: fadeUp 1s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards;
}

.home-section-tag {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 0.625rem 1.5rem;
  background: rgba(139, 92, 246, 0.08);
  border: 1px solid rgba(139, 92, 246, 0.2);
  border-radius: 100px;
  font-size: 0.8125rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  color: #a78bfa;
  margin-bottom: 1.75rem;
}

.home-tag-pulse {
  width: 8px;
  height: 8px;
  background: #8b5cf6;
  border-radius: 50%;
  animation: glowPulse 2s ease-in-out infinite;
  box-shadow: 0 0 12px rgba(139, 92, 246, 0.8);
}

.home-section-title {
  font-size: 3rem;
  font-weight: 900;
  margin: 0 0 1.25rem;
  background: linear-gradient(135deg, #e9d5ff, #c4b5fd, #a78bfa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: -1px;
}

.home-section-desc {
  font-size: 1.25rem;
  color: rgba(255, 255, 255, 0.65);
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.7;
}

/* ==================== MODERN CARDS ==================== */
.home-posts {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
  gap: 3rem;
  padding: 0 2rem;
}

.home-card {
  position: relative;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(30px) saturate(150%);
  border: 1px solid rgba(139, 92, 246, 0.15);
  border-radius: 28px;
  overflow: hidden;
  transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
  animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) backwards;
  animation-delay: calc(var(--card-index) * 0.1s);
  box-shadow:
    0 15px 40px rgba(0, 0, 0, 0.12),
    inset 0 1px 0 rgba(255, 255, 255, 0.08);
}

.home-card-glow {
  position: absolute;
  inset: -3px;
  background: conic-gradient(
    from 0deg at 50% 50%,
    transparent 0deg,
    rgba(139, 92, 246, 0.5) 90deg,
    rgba(99, 102, 241, 0.5) 180deg,
    rgba(124, 58, 237, 0.5) 270deg,
    transparent 360deg
  );
  border-radius: 28px;
  opacity: 0;
  transition: opacity 0.5s;
  filter: blur(15px);
  animation: borderSpin 4s linear infinite;
  z-index: -1;
}

.home-card:hover .home-card-glow {
  opacity: 1;
}

.home-card:hover {
  transform: translateY(-16px) scale(1.01);
  border-color: rgba(139, 92, 246, 0.3);
  box-shadow:
    0 40px 80px rgba(0, 0, 0, 0.25),
    0 0 100px rgba(139, 92, 246, 0.2),
    inset 0 1px 0 rgba(255, 255, 255, 0.15);
}

.home-card-media {
  position: relative;
  height: 280px;
  overflow: hidden;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(99, 102, 241, 0.05));
}

.home-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}

.home-card:hover .home-card-img {
  transform: scale(1.15);
}

.home-card-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(10, 14, 26, 0.7) 0%, transparent 60%);
}

.home-card-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(139, 92, 246, 0.4);
  position: relative;
}

.home-placeholder-shine {
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.06), transparent);
  animation: shimmerSlide 3s infinite;
}

.home-card-tag {
  position: absolute;
  top: 1.5rem;
  right: 1.5rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.625rem 1.125rem;
  background: rgba(10, 14, 26, 0.9);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(139, 92, 246, 0.3);
  border-radius: 100px;
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #c4b5fd;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
  z-index: 2;
}

.home-card-body {
  padding: 2.25rem;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.home-card-title {
  margin: 0;
  font-size: 1.625rem;
  font-weight: 800;
  line-height: 1.3;
  letter-spacing: -0.4px;
}

.home-card-title a {
  color: rgba(255, 255, 255, 0.98);
  text-decoration: none;
  transition: all 0.3s;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.home-card-title a:hover {
  background: linear-gradient(135deg, #c4b5fd, #a78bfa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.home-card-excerpt {
  font-size: 1rem;
  line-height: 1.75;
  color: rgba(255, 255, 255, 0.65);
  margin: 0;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.home-card-meta {
  padding: 1.25rem;
  background: rgba(255, 255, 255, 0.03);
  border-radius: 16px;
  border: 1px solid rgba(139, 92, 246, 0.1);
}

.home-card-author {
  display: flex;
  align-items: center;
  gap: 1.125rem;
}

.home-author-avatar {
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(99, 102, 241, 0.1));
  border-radius: 50%;
  border: 2px solid rgba(139, 92, 246, 0.25);
  box-shadow: 0 6px 18px rgba(139, 92, 246, 0.2);
}

.home-author-avatar svg {
  color: #a78bfa;
}

.home-author-details {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.home-author-name {
  font-size: 0.9375rem;
  font-weight: 700;
  color: rgba(255, 255, 255, 0.95);
}

.home-author-date {
  font-size: 0.8125rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.5);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.home-card-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.home-tag {
  padding: 0.5rem 1rem;
  background: rgba(139, 92, 246, 0.1);
  border: 1px solid rgba(139, 92, 246, 0.2);
  border-radius: 12px;
  font-size: 0.8125rem;
  font-weight: 700;
  color: #c4b5fd;
  text-decoration: none;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.home-tag:hover {
  background: rgba(139, 92, 246, 0.18);
  border-color: rgba(139, 92, 246, 0.4);
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(139, 92, 246, 0.2);
}

.home-tag-count {
  padding: 0.5rem 0.875rem;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 800;
  color: rgba(255, 255, 255, 0.6);
}

.home-card-link {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  padding: 1.125rem 2rem;
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  border-radius: 16px;
  font-weight: 800;
  font-size: 1rem;
  color: white;
  text-decoration: none;
  transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
  box-shadow:
    0 15px 35px rgba(139, 92, 246, 0.35),
    inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.home-card-link:hover {
  transform: translateY(-3px);
  box-shadow:
    0 25px 50px rgba(139, 92, 246, 0.45),
    0 0 80px rgba(139, 92, 246, 0.25),
    inset 0 1px 0 rgba(255, 255, 255, 0.4);
}

.home-card-link svg {
  transition: transform 0.4s;
}

.home-card-link:hover svg {
  transform: translateX(6px);
}

.home-link-wave {
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transform: translateX(-100%);
}

.home-card-link:hover .home-link-wave {
  animation: waveMove 0.8s;
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 1024px) {
  .home-posts {
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2.5rem;
  }
}

@media (max-width: 768px) {
  .home-hero {
    min-height: auto;
    padding: 6rem 0 4rem;
  }

  .home-hero-title {
    font-size: 3.5rem;
  }

  .home-title-line {
    font-size: 2rem;
  }

  .home-hero-subtitle {
    font-size: 1.125rem;
  }

  .home-hero-actions {
    flex-direction: column;
    width: 100%;
  }

  .home-btn {
    width: 100%;
    max-width: 320px;
  }

  .home-hero-stats {
    flex-direction: column;
    gap: 2.5rem;
    padding: 2.5rem 2rem;
  }

  .home-stat-separator {
    width: 100%;
    height: 2px;
  }

  .home-section-title {
    font-size: 2.25rem;
  }

  .home-posts {
    grid-template-columns: 1fr;
    gap: 2rem;
    padding: 0 1rem;
  }
}

@media (max-width: 480px) {
  .home-hero-title {
    font-size: 2.75rem;
  }

  .home-title-line {
    font-size: 1.5rem;
  }

  .home-card-media {
    height: 240px;
  }

  .home-section-title {
    font-size: 1.875rem;
  }
}
</style>
