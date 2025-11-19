<?php $title='Meine Kommentare'; ?>

<!-- Header Section -->
<section class="comments-page-header">
  <div class="header-content">
    <div class="header-icon">
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
      </svg>
    </div>
    <div class="header-text">
      <h1 class="page-title">Meine Kommentare</h1>
      <p class="page-subtitle">Verwalten Sie alle Ihre veröffentlichten Kommentare zu Artikeln</p>
    </div>
  </div>
  <div class="header-stats">
    <div class="stat-badge">
      <span class="stat-number"><?= count($comments) ?></span>
      <span class="stat-label">Kommentare</span>
    </div>
  </div>
</section>

<?php if (empty($comments)): ?>
  <!-- Empty State -->
  <div class="empty-state">
    <div class="empty-visual">
      <div class="empty-circle empty-circle-1"></div>
      <div class="empty-circle empty-circle-2"></div>
      <div class="empty-icon">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
          <line x1="9" y1="10" x2="15" y2="10"></line>
          <line x1="9" y1="14" x2="13" y2="14"></line>
        </svg>
      </div>
    </div>
    <h2 class="empty-title">Keine Kommentare</h2>
    <p class="empty-desc">Sie haben noch keine Kommentare zu Artikeln hinterlassen.</p>
    <a href="/" class="empty-btn">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
        <polyline points="9 22 9 12 15 12 15 22"></polyline>
      </svg>
      <span>Artikel entdecken</span>
    </a>
  </div>
<?php else: ?>
  <!-- Comments Grid -->
  <div class="comments-grid">
    <?php foreach($comments as $index => $c): ?>
      <article class="comment-card" style="--card-index: <?= $index ?>">
        <!-- Card Header -->
        <div class="card-header">
          <div class="card-post-info">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
            </svg>
            <a href="/post/<?= esc($c['slug']) ?>" class="card-post-link" target="_blank">
              <?= esc($c['title']) ?>
            </a>
          </div>

          <?php
            $statusColors = [
              'approved' => ['bg' => 'rgba(34, 197, 94, 0.1)', 'border' => '#22c55e', 'text' => '#4ade80', 'label' => 'Genehmigt'],
              'pending' => ['bg' => 'rgba(234, 179, 8, 0.1)', 'border' => '#eab308', 'text' => '#fbbf24', 'label' => 'Ausstehend'],
              'rejected' => ['bg' => 'rgba(239, 68, 68, 0.1)', 'border' => '#ef4444', 'text' => '#f87171', 'label' => 'Abgelehnt']
            ];
            $status = $statusColors[$c['status']] ?? $statusColors['pending'];
          ?>
          <div class="status-badge" style="background: <?= $status['bg'] ?>; border-color: <?= $status['border'] ?>; color: <?= $status['text'] ?>">
            <span class="status-dot" style="background: <?= $status['text'] ?>"></span>
            <span><?= $status['label'] ?></span>
          </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
          <p class="card-excerpt"><?= nl2br(esc($c['body'])) ?></p>
        </div>

        <!-- Card Footer -->
        <div class="card-footer">
          <div class="card-meta">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <span><?= esc(date('d/m/Y à H:i', strtotime($c['created_at']))) ?></span>
          </div>

          <form method="post" action="/me/comments/<?= (int)$c['id'] ?>/delete"
                onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Kommentar löschen möchten?')"
                class="delete-form">
            <?= csrf_field() ?>
            <button type="submit" class="delete-btn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
              </svg>
              <span>Supprimer</span>
            </button>
          </form>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<style>
/* ==================== PAGE HEADER ==================== */
.comments-page-header {
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

.header-stats {
  display: flex;
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

/* ==================== COMMENTS GRID ==================== */
.comments-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
  gap: 2rem;
  padding: 0 2rem;
}

.comment-card {
  position: relative;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(30px) saturate(150%);
  border: 1px solid rgba(139, 92, 246, 0.15);
  border-radius: 20px;
  padding: 1.75rem;
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

.comment-card:hover {
  transform: translateY(-8px);
  border-color: rgba(139, 92, 246, 0.3);
  box-shadow:
    0 25px 60px rgba(0, 0, 0, 0.2),
    0 0 80px rgba(139, 92, 246, 0.2),
    inset 0 1px 0 rgba(255, 255, 255, 0.15);
}

/* ==================== CARD CONTENT ==================== */
.card-header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 1rem;
  margin-bottom: 1.25rem;
  padding-bottom: 1.25rem;
  border-bottom: 1px solid rgba(139, 92, 246, 0.1);
}

.card-post-info {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  flex: 1;
}

.card-post-info svg {
  color: #a78bfa;
  flex-shrink: 0;
}

.card-post-link {
  color: rgba(255, 255, 255, 0.9);
  font-weight: 700;
  font-size: 1.0625rem;
  text-decoration: none;
  transition: all 0.3s;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.card-post-link:hover {
  background: linear-gradient(135deg, #c4b5fd, #a78bfa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.status-badge {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  border: 1px solid;
  border-radius: 100px;
  font-size: 0.8125rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  white-space: nowrap;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.status-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  animation: blink 2s ease-in-out infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.4; }
}

.card-body {
  margin-bottom: 1.25rem;
}

.card-excerpt {
  color: rgba(255, 255, 255, 0.7);
  line-height: 1.7;
  margin: 0;
  font-size: 0.9375rem;
}

.card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  padding-top: 1.25rem;
  border-top: 1px solid rgba(139, 92, 246, 0.1);
}

.card-meta {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: rgba(255, 255, 255, 0.5);
  font-size: 0.8125rem;
  font-weight: 600;
}

.card-meta svg {
  opacity: 0.7;
}

.delete-form {
  margin: 0;
}

.delete-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.625rem 1.25rem;
  background: rgba(239, 68, 68, 0.1);
  border: 1px solid rgba(239, 68, 68, 0.3);
  border-radius: 12px;
  color: #f87171;
  font-weight: 600;
  font-size: 0.875rem;
  font-family: inherit;
  cursor: pointer;
  transition: all 0.3s;
}

.delete-btn:hover {
  background: rgba(239, 68, 68, 0.2);
  border-color: rgba(239, 68, 68, 0.5);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(239, 68, 68, 0.2);
}

.delete-btn svg {
  transition: transform 0.3s;
}

.delete-btn:hover svg {
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 1024px) {
  .comments-grid {
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 1.75rem;
  }
}

@media (max-width: 768px) {
  .comments-page-header {
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

  .header-stats {
    width: 100%;
  }

  .stat-badge {
    flex: 1;
  }

  .comments-grid {
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

  .delete-btn {
    width: 100%;
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
}
</style>
