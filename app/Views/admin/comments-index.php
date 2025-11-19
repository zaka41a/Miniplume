<?php
/** @var array $comments */
/** @var string $status */
$title = 'Kommentarmoderation';
$tab = $status ?? ($_GET['status'] ?? 'pending');
$tabs = [
  'pending'  => 'Ausstehend',
  'approved' => 'Genehmigt',
  'spam'     => 'Spam',
];

// Calculate counts for each tab
$pendingCount = count(array_filter($comments, fn($c) => ($c['status'] ?? 'pending') === 'pending'));
$approvedCount = count(array_filter($comments, fn($c) => ($c['status'] ?? 'pending') === 'approved'));
$spamCount = count(array_filter($comments, fn($c) => ($c['status'] ?? 'pending') === 'spam'));
$tabCounts = [
  'pending' => $pendingCount,
  'approved' => $approvedCount,
  'spam' => $spamCount,
];
?>

<!-- Modern Header -->
<div class="comments-header">
  <div class="comments-header-main">
    <div class="comments-breadcrumb">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
      </svg>
      <span>Admin</span>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="9 18 15 12 9 6"></polyline>
      </svg>
      <span>Kommentare</span>
    </div>
    <div class="comments-title-section">
      <div class="comments-icon-wrapper">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
      </div>
      <div>
        <h1 class="comments-title">Kommentarmoderation</h1>
        <p class="comments-subtitle">Verwalten und moderieren Sie Leserkommentare</p>
      </div>
    </div>
  </div>
</div>

<!-- Statistics Cards -->
<div class="comments-stats">
  <div class="comments-stat-card comments-stat-pending">
    <div class="comments-stat-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"></circle>
        <polyline points="12 6 12 12 16 14"></polyline>
      </svg>
    </div>
    <div class="comments-stat-content">
      <div class="comments-stat-value"><?= $pendingCount ?></div>
      <div class="comments-stat-label">Ausstehend</div>
    </div>
  </div>

  <div class="comments-stat-card comments-stat-approved">
    <div class="comments-stat-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
    </div>
    <div class="comments-stat-content">
      <div class="comments-stat-value"><?= $approvedCount ?></div>
      <div class="comments-stat-label">Genehmigt</div>
    </div>
  </div>

  <div class="comments-stat-card comments-stat-spam">
    <div class="comments-stat-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
      </svg>
    </div>
    <div class="comments-stat-content">
      <div class="comments-stat-value"><?= $spamCount ?></div>
      <div class="comments-stat-label">Spam</div>
    </div>
  </div>

  <div class="comments-stat-card comments-stat-total">
    <div class="comments-stat-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
      </svg>
    </div>
    <div class="comments-stat-content">
      <div class="comments-stat-value"><?= count($comments) ?></div>
      <div class="comments-stat-label">Total</div>
    </div>
  </div>
</div>

<!-- Tabs Navigation -->
<div class="comments-tabs">
  <?php foreach ($tabs as $key => $label): ?>
    <a class="comments-tab <?= $tab===$key?'active':'' ?>" href="/admin/comments?status=<?= esc($key) ?>">
      <?php
        $tabIcons = [
          'pending' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
          'approved' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>',
          'spam' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>'
        ];
        echo $tabIcons[$key] ?? '';
      ?>
      <span><?= esc($label) ?></span>
      <span class="comments-tab-count"><?= $tabCounts[$key] ?></span>
    </a>
  <?php endforeach; ?>
</div>

<!-- Comments List -->
<?php if (empty($comments)): ?>
  <div class="comments-empty">
    <div class="comments-empty-icon">
      <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
      </svg>
    </div>
    <h3>Keine Kommentare in „<?= esc($tabs[$tab] ?? $tab) ?>"</h3>
    <p>Wenn Leser Kommentare veröffentlichen, werden sie hier zur Validierung angezeigt.</p>
  </div>
<?php else: ?>
  <div class="comments-list">
    <?php foreach ($comments as $c): ?>
      <div class="comments-card">
        <div class="comments-card-header">
          <div class="comments-author-section">
            <div class="comments-avatar">
              <?= strtoupper(mb_substr($c['author_name'], 0, 1, 'UTF-8')) ?>
            </div>
            <div class="comments-author-info">
              <div class="comments-author-name">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <?= esc($c['author_name']) ?>
              </div>
              <?php if (!empty($c['author_email'])): ?>
                <div class="comments-author-email">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                  </svg>
                  <?= esc($c['author_email']) ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="comments-meta-section">
            <div class="comments-date">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
              <?= esc(date('d/m/Y H:i', strtotime($c['created_at']))) ?>
            </div>
          </div>
        </div>

        <div class="comments-post-link">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
          </svg>
          <span class="comments-post-label">Artikel:</span>
          <a href="/post/<?= esc($c['slug']) ?>" target="_blank" rel="noopener">
            <?= esc($c['title']) ?>
          </a>
        </div>

        <div class="comments-body">
          <?= nl2br(esc($c['body'])) ?>
        </div>

        <div class="comments-actions">
          <form method="post" action="/admin/comments/<?= (int)$c['id'] ?>/status" class="comments-action-form">
            <?= csrf_field() ?>
            <div class="comments-action-select-group">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
              </svg>
              <select name="status" class="comments-status-select" onchange="this.form.submit()">
                <option value="pending" <?= $tab==='pending'?'selected':'' ?>>⏳ Ausstehend</option>
                <option value="approved" <?= $tab==='approved'?'selected':'' ?>>✅ Genehmigen</option>
                <option value="spam" <?= $tab==='spam'?'selected':'' ?>>🚫 Als Spam markieren</option>
              </select>
            </div>
          </form>

          <a class="comments-btn-view" href="/post/<?= esc($c['slug']) ?>#comment-<?= (int)$c['id'] ?>" target="_blank">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
            <span>Ansehen</span>
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<style>
/* ========= COMMENTS PAGE - ULTRA PROFESSIONAL DESIGN ========= */

/* Modern Header */
.comments-header {
  margin-bottom: 2rem;
  padding: 2rem;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(99, 102, 241, 0.05));
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-xl);
  backdrop-filter: blur(10px);
}

.comments-header-main {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.comments-breadcrumb {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: var(--text-muted);
}

.comments-breadcrumb svg {
  opacity: 0.6;
}

.comments-breadcrumb span {
  font-weight: 500;
}

.comments-title-section {
  display: flex;
  align-items: center;
  gap: 1.25rem;
}

.comments-icon-wrapper {
  position: relative;
  width: 80px;
  height: 80px;
  border-radius: 20px;
  background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
  box-shadow:
    0 20px 40px rgba(16, 185, 129, 0.5),
    0 0 60px rgba(16, 185, 129, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.1),
    inset 0 1px 2px rgba(255, 255, 255, 0.3);
  animation: float 6s ease-in-out infinite;
}

.comments-icon-wrapper::before {
  content: '';
  position: absolute;
  inset: -4px;
  background: linear-gradient(135deg, #34d399, #059669);
  border-radius: 24px;
  opacity: 0.6;
  filter: blur(12px);
  z-index: -1;
  animation: pulse 4s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  33% { transform: translateY(-10px) rotate(2deg); }
  66% { transform: translateY(-5px) rotate(-2deg); }
}

@keyframes pulse {
  0%, 100% { opacity: 0.6; transform: scale(1); }
  50% { opacity: 0.8; transform: scale(1.05); }
}

.comments-title {
  font-size: 2rem;
  font-weight: 800;
  margin: 0;
  background: linear-gradient(135deg, #10b981, #059669, #047857);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  line-height: 1.2;
}

.comments-subtitle {
  font-size: 0.95rem;
  color: var(--text-muted);
  margin: 0.25rem 0 0 0;
}

/* Statistics Cards */
.comments-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1.25rem;
  margin-bottom: 2rem;
}

.comments-stat-card {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-xl);
  padding: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1.25rem;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.comments-stat-card:hover {
  transform: translateX(6px);
  border-color: var(--border-default);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(139, 92, 246, 0.1);
}

.comments-stat-icon {
  width: 48px;
  height: 48px;
  border-radius: var(--radius-lg);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
}

.comments-stat-pending .comments-stat-icon {
  background: linear-gradient(135deg, #f59e0b, #d97706);
  box-shadow: 0 6px 20px rgba(245, 158, 11, 0.35);
}

.comments-stat-approved .comments-stat-icon {
  background: linear-gradient(135deg, #10b981, #059669);
  box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
}

.comments-stat-spam .comments-stat-icon {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  box-shadow: 0 6px 20px rgba(239, 68, 68, 0.35);
}

.comments-stat-total .comments-stat-icon {
  background: linear-gradient(135deg, #8b5cf6, #6366f1);
  box-shadow: 0 6px 20px rgba(139, 92, 246, 0.35);
}

.comments-stat-content {
  flex: 1;
}

.comments-stat-value {
  font-size: 2rem;
  font-weight: 800;
  color: var(--text-primary);
  line-height: 1;
  margin-bottom: 0.375rem;
}

.comments-stat-label {
  font-size: 0.8125rem;
  font-weight: 600;
  color: var(--text-muted);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Tabs Navigation */
.comments-tabs {
  display: flex;
  gap: 0.75rem;
  margin-bottom: 2rem;
  flex-wrap: wrap;
}

.comments-tab {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 0.875rem 1.5rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-full);
  color: var(--text-muted);
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9375rem;
  transition: all 0.2s ease;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.comments-tab svg {
  opacity: 0.7;
  flex-shrink: 0;
}

.comments-tab:hover {
  background: rgba(139, 92, 246, 0.08);
  border-color: var(--border-default);
  color: var(--text-primary);
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.comments-tab.active {
  background: linear-gradient(135deg, #10b981, #059669);
  border-color: #10b981;
  color: white;
  box-shadow: 0 4px 16px rgba(16, 185, 129, 0.4);
}

.comments-tab.active svg {
  opacity: 1;
}

.comments-tab-count {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 26px;
  height: 26px;
  padding: 0 0.5rem;
  background: rgba(255, 255, 255, 0.25);
  backdrop-filter: blur(10px);
  border-radius: var(--radius-full);
  font-size: 0.8125rem;
  font-weight: 700;
}

.comments-tab:not(.active) .comments-tab-count {
  background: rgba(16, 185, 129, 0.15);
  color: #10b981;
}

/* Empty State */
.comments-empty {
  text-align: center;
  padding: 4rem 2rem;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px dashed var(--border-default);
  border-radius: var(--radius-xl);
}

.comments-empty-icon {
  margin: 0 auto 1.5rem;
  width: 80px;
  height: 80px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: var(--radius-full);
  background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));
  color: #10b981;
}

.comments-empty h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--text-primary);
  margin: 0 0 0.5rem 0;
}

.comments-empty p {
  font-size: 1rem;
  color: var(--text-muted);
  margin: 0;
}

/* Comments List */
.comments-list {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.comments-card {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-xl);
  padding: 1.75rem;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.comments-card:hover {
  border-color: var(--border-default);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(16, 185, 129, 0.15);
  transform: translateX(6px);
}

.comments-card-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  margin-bottom: 1.25rem;
  padding-bottom: 1.25rem;
  border-bottom: 1px solid var(--border-subtle);
}

.comments-author-section {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.comments-avatar {
  width: 52px;
  height: 52px;
  border-radius: var(--radius-full);
  background: linear-gradient(135deg, #10b981, #059669);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 700;
  font-size: 1.375rem;
  flex-shrink: 0;
  box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
}

.comments-author-info {
  display: flex;
  flex-direction: column;
  gap: 0.375rem;
}

.comments-author-name {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 600;
  font-size: 1.0625rem;
  color: var(--text-primary);
}

.comments-author-name svg {
  color: #10b981;
  opacity: 0.8;
}

.comments-author-email {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: var(--text-muted);
}

.comments-author-email svg {
  opacity: 0.6;
}

.comments-meta-section {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 0.5rem;
}

.comments-date {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: var(--text-muted);
  font-family: 'SF Mono', 'Monaco', 'Courier New', monospace;
}

.comments-date svg {
  opacity: 0.6;
}

.comments-post-link {
  display: flex;
  align-items: center;
  gap: 0.625rem;
  font-size: 0.875rem;
  color: var(--text-muted);
  margin-bottom: 1.25rem;
  padding: 1rem;
  background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), rgba(5, 150, 105, 0.03));
  border-radius: var(--radius-md);
  border-left: 3px solid #10b981;
  backdrop-filter: blur(10px);
}

.comments-post-link svg {
  color: #10b981;
  flex-shrink: 0;
}

.comments-post-label {
  font-weight: 600;
}

.comments-post-link a {
  color: #10b981;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.2s ease;
}

.comments-post-link a:hover {
  text-decoration: underline;
  color: #059669;
}

.comments-body {
  color: var(--text-secondary);
  line-height: 1.7;
  margin-bottom: 1.5rem;
  padding: 1.25rem;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(10px);
  border-radius: var(--radius-md);
  border: 1px solid var(--border-subtle);
}

.comments-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding-top: 1.25rem;
  border-top: 1px solid var(--border-subtle);
}

.comments-action-form {
  flex: 1;
  display: flex;
}

.comments-action-select-group {
  flex: 1;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1.125rem;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(10px);
  border: 1px solid var(--border-default);
  border-radius: var(--radius-md);
  transition: all 0.2s ease;
}

.comments-action-select-group:hover {
  border-color: #10b981;
  background: rgba(16, 185, 129, 0.05);
}

.comments-action-select-group svg {
  color: #10b981;
  flex-shrink: 0;
}

.comments-status-select {
  flex: 1;
  background: transparent;
  border: none;
  color: var(--text-primary);
  font-size: 0.9375rem;
  font-weight: 600;
  font-family: inherit;
  cursor: pointer;
  outline: none;
}

.comments-status-select option {
  background: var(--bg-secondary);
  color: var(--text-primary);
}

.comments-btn-view {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: transparent;
  border: 1px solid var(--border-default);
  border-radius: var(--radius-md);
  color: #3b82f6;
  font-size: 0.875rem;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.2s ease;
  backdrop-filter: blur(10px);
}

.comments-btn-view:hover {
  background: rgba(59, 130, 246, 0.15);
  border-color: #3b82f6;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

/* Responsive Design */
@media (max-width: 1024px) {
  .comments-stats {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .comments-header {
    padding: 1.5rem;
  }

  .comments-title {
    font-size: 1.5rem;
  }

  .comments-icon-wrapper {
    width: 52px;
    height: 52px;
  }

  .comments-icon-wrapper svg {
    width: 26px;
    height: 26px;
  }

  .comments-stats {
    grid-template-columns: 1fr;
  }

  .comments-stat-card:hover {
    transform: translateY(-4px);
  }

  .comments-card-header {
    flex-direction: column;
    align-items: flex-start;
  }

  .comments-meta-section {
    align-items: flex-start;
    width: 100%;
  }

  .comments-actions {
    flex-direction: column;
  }

  .comments-action-form {
    width: 100%;
  }

  .comments-btn-view {
    width: 100%;
    justify-content: center;
  }

  .comments-card:hover {
    transform: translateY(-4px);
  }
}
</style>
