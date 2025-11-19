<?php
/** @var array $post */
/** @var array $comments */
$title = esc($post['title']);
$canComment = class_exists('Auth') && \Auth::roleIn(['admin', 'author', 'reader']);
?>

<article class="post-article">
  <?php if (!empty($post['cover_path'])): ?>
    <div class="post-cover-wrapper">
      <img src="/uploads/<?= esc($post['cover_path']) ?>" alt="<?= esc($post['title']) ?>" class="post-cover">
      <div class="post-cover-overlay"></div>
    </div>
  <?php endif; ?>

  <div class="post-content-wrapper">
    <div class="post-header">
      <h1 class="post-title"><?= esc($post['title']) ?></h1>
      <div class="post-meta">
        <div class="meta-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          <span><?= esc($post['author'] ?? 'Anonyme') ?></span>
        </div>
        <span class="meta-divider">•</span>
        <div class="meta-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span><?= esc(date('d/m/Y à H:i', strtotime($post['published_at']))) ?></span>
        </div>
      </div>
    </div>

    <div class="post-body">
      <?= $post['body'] /* déjà filtré côté admin */ ?>
    </div>

    <?php if (!empty($post['tags'])): ?>
      <div class="post-tags">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
          <line x1="7" y1="7" x2="7.01" y2="7"></line>
        </svg>
        <?php foreach ($post['tags'] as $t): ?>
          <a class="post-tag" href="/tag/<?= esc($t['slug']) ?>">#<?= esc($t['name']) ?></a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</article>

<!-- Comments Section -->
<section class="comments-section">
  <div class="comments-header">
    <h2 class="comments-title">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
      </svg>
      Kommentare
      <span class="comments-count">(<?= count($comments) ?>)</span>
    </h2>
  </div>

  <?php if (empty($comments)): ?>
    <div class="comments-empty">
      <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
      </svg>
      <p>Noch keine Kommentare</p>
      <p class="comments-empty-subtitle">Seien Sie der Erste, der seine Meinung teilt!</p>
    </div>
  <?php else: ?>
    <ul class="comments-list">
      <?php foreach($comments as $c): ?>
        <li class="comment-item">
          <div class="comment-avatar">
            <?= strtoupper(mb_substr($c['author_name'],0,1,'UTF-8')) ?>
          </div>
          <div class="comment-content">
            <div class="comment-header">
              <strong class="comment-author"><?= esc($c['author_name']) ?></strong>
              <span class="comment-date">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <?= esc(date('d/m/Y à H:i', strtotime($c['created_at']))) ?>
              </span>
            </div>
            <p class="comment-body"><?= nl2br(esc($c['body'])) ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</section>

<!-- Comment Form -->
<section class="comment-form-section">
  <h3 class="comment-form-title">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
    </svg>
    Einen Kommentar hinterlassen
  </h3>

  <?php if ($canComment): ?>
    <form class="comment-form" method="post" action="/post/<?= esc($post['slug']) ?>/comments">
      <?= csrf_field() ?>

      <div class="form-field">
        <label for="body" class="field-label">Nachricht</label>
        <textarea
          id="body"
          name="body"
          class="field-textarea"
          rows="5"
          placeholder="Teilen Sie Ihre Meinung..."
          required></textarea>
      </div>

      <button class="comment-submit-btn" type="submit">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="22" y1="2" x2="11" y2="13"></line>
          <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
        </svg>
        <span>Kommentar veröffentlichen</span>
      </button>
    </form>
  <?php else: ?>
    <div class="comment-login-prompt">
      <div class="login-prompt-icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
          <polyline points="10 17 15 12 10 7"></polyline>
          <line x1="15" y1="12" x2="3" y2="12"></line>
        </svg>
      </div>
      <div class="login-prompt-content">
        <h4>Anmeldung erforderlich</h4>
        <p>Melden Sie sich an, um diesen Artikel zu kommentieren.</p>
      </div>
      <a class="login-prompt-btn" href="/login">
        <span>Anmelden</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </a>
    </div>
  <?php endif; ?>
</section>

<style>
/* ========= Post Article ========= */
.post-article {
  background: var(--surface);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-md);
  margin-bottom: 2rem;
}

.post-cover-wrapper {
  position: relative;
  width: 100%;
  height: 400px;
  overflow: hidden;
}

.post-cover {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.post-cover-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 120px;
  background: linear-gradient(to top, rgba(10, 14, 26, 0.9), transparent);
}

.post-content-wrapper {
  padding: 2rem;
}

.post-header {
  margin-bottom: 2rem;
}

.post-title {
  font-size: 2rem;
  margin: 0 0 1rem;
  line-height: 1.3;
}

.post-meta {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  color: var(--text-muted);
  font-size: 0.9rem;
}

.meta-item {
  display: flex;
  align-items: center;
  gap: 0.4rem;
}

.meta-item svg {
  color: var(--primary);
}

.meta-divider {
  opacity: 0.5;
}

.post-body {
  color: var(--text-secondary);
  line-height: 1.8;
  font-size: 1.05rem;
}

.post-body h1, .post-body h2, .post-body h3 {
  margin-top: 2rem;
  margin-bottom: 1rem;
  color: var(--text-primary);
}

.post-body p {
  margin-bottom: 1.25rem;
}

.post-body a {
  color: var(--primary);
  text-decoration: underline;
}

.post-body code {
  background: rgba(139, 92, 246, 0.1);
  padding: 0.2rem 0.4rem;
  border-radius: 4px;
  font-family: monospace;
  font-size: 0.9em;
}

.post-body pre {
  background: rgba(0, 0, 0, 0.3);
  padding: 1rem;
  border-radius: var(--radius-md);
  overflow-x: auto;
  margin: 1.5rem 0;
}

.post-tags {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-top: 2rem;
  padding-top: 1.5rem;
  border-top: 1px solid var(--border-subtle);
}

.post-tags svg {
  color: var(--primary);
}

.post-tag {
  padding: 0.4rem 0.875rem;
  background: rgba(139, 92, 246, 0.1);
  border: 1px solid var(--border-default);
  border-radius: var(--radius-full);
  color: var(--primary);
  font-size: 0.85rem;
  font-weight: 600;
  text-decoration: none;
  transition: all var(--transition-fast);
}

.post-tag:hover {
  background: rgba(139, 92, 246, 0.2);
  border-color: var(--primary);
  transform: translateY(-1px);
}

/* ========= Comments Section ========= */
.comments-section {
  background: var(--surface);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-lg);
  padding: 2rem;
  box-shadow: var(--shadow-md);
  margin-bottom: 2rem;
}

.comments-header {
  margin-bottom: 1.5rem;
}

.comments-title {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 1.5rem;
  margin: 0;
}

.comments-title svg {
  color: var(--primary);
}

.comments-count {
  color: var(--text-muted);
  font-size: 1rem;
  font-weight: 500;
}

.comments-empty {
  text-align: center;
  padding: 3rem 1rem;
  color: var(--text-muted);
}

.comments-empty svg {
  margin-bottom: 1rem;
  opacity: 0.5;
}

.comments-empty p {
  margin: 0.5rem 0;
}

.comments-empty-subtitle {
  font-size: 0.9rem;
  opacity: 0.7;
}

.comments-list {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.comment-item {
  display: flex;
  gap: 1rem;
  padding: 1.25rem;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-md);
  transition: all var(--transition-fast);
}

.comment-item:hover {
  background: rgba(139, 92, 246, 0.03);
  border-color: var(--border-default);
}

.comment-avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 1.2rem;
  color: white;
  flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
}

.comment-content {
  flex: 1;
}

.comment-header {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 0.75rem;
  flex-wrap: wrap;
}

.comment-author {
  color: var(--text-primary);
  font-size: 1rem;
}

.comment-date {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  color: var(--text-muted);
  font-size: 0.85rem;
}

.comment-date svg {
  opacity: 0.7;
}

.comment-body {
  color: var(--text-secondary);
  line-height: 1.6;
  margin: 0;
}

/* ========= Comment Form Section ========= */
.comment-form-section {
  background: var(--surface);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-lg);
  padding: 2rem;
  box-shadow: var(--shadow-md);
}

.comment-form-title {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 1.25rem;
  margin: 0 0 1.5rem;
}

.comment-form-title svg {
  color: var(--primary);
}

.comment-form {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.form-field {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.field-label {
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--text-primary);
}

.field-input,
.field-textarea {
  padding: 0.75rem 1rem;
  background: rgba(255, 255, 255, 0.03);
  border: 2px solid var(--border-default);
  border-radius: var(--radius-md);
  color: var(--text-primary);
  font-size: 0.95rem;
  font-family: inherit;
  transition: all var(--transition-fast);
}

.field-input::placeholder,
.field-textarea::placeholder {
  color: var(--text-muted);
  opacity: 0.6;
}

.field-input:hover,
.field-textarea:hover {
  border-color: rgba(139, 92, 246, 0.3);
  background: rgba(255, 255, 255, 0.05);
}

.field-input:focus,
.field-textarea:focus {
  outline: none;
  border-color: var(--primary);
  background: rgba(255, 255, 255, 0.06);
  box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
}

.field-textarea {
  resize: vertical;
  min-height: 120px;
}

.comment-submit-btn {
  padding: 0.875rem 1.5rem;
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  border: none;
  border-radius: var(--radius-md);
  color: white;
  font-weight: 600;
  font-size: 0.95rem;
  font-family: inherit;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
  transition: all var(--transition-fast);
  align-self: flex-start;
}

.comment-submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
}

.comment-submit-btn:active {
  transform: translateY(0);
}

/* ========= Login Prompt ========= */
.comment-login-prompt {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  padding: 2rem;
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(99, 102, 241, 0.05));
  border: 2px dashed var(--border-default);
  border-radius: var(--radius-md);
}

.login-prompt-icon {
  width: 64px;
  height: 64px;
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
}

.login-prompt-content {
  flex: 1;
}

.login-prompt-content h4 {
  margin: 0 0 0.5rem;
  color: var(--text-primary);
  font-size: 1.1rem;
}

.login-prompt-content p {
  margin: 0;
  color: var(--text-muted);
  font-size: 0.95rem;
}

.login-prompt-btn {
  padding: 0.75rem 1.5rem;
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  border: none;
  border-radius: var(--radius-md);
  color: white;
  font-weight: 600;
  font-size: 0.9rem;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
  transition: all var(--transition-fast);
}

.login-prompt-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
}

/* ========= Responsive ========= */
@media (max-width: 768px) {
  .post-cover-wrapper {
    height: 250px;
  }

  .post-content-wrapper {
    padding: 1.5rem;
  }

  .post-title {
    font-size: 1.5rem;
  }

  .post-body {
    font-size: 1rem;
  }

  .comment-login-prompt {
    flex-direction: column;
    text-align: center;
  }

  .comment-submit-btn,
  .login-prompt-btn {
    width: 100%;
  }
}
</style>
