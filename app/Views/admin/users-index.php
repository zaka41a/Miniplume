<?php
/** @var array $users */
$title='Admin – Benutzer';

// Calculate statistics
$total = count($users);
$admins = count(array_filter($users, fn($u) => $u['role'] === 'admin'));
$authors = count(array_filter($users, fn($u) => $u['role'] === 'author'));
$readers = count(array_filter($users, fn($u) => $u['role'] === 'reader'));
?>

<!-- Hero Header -->
<div class="users-hero">
  <div class="users-hero-bg"></div>
  <div class="users-hero-content">
    <div class="users-hero-icon">
      <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
        <circle cx="9" cy="7" r="4"></circle>
        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
      </svg>
    </div>
    <div>
      <p class="users-hero-subtitle">Verwalten Sie Ihre Benutzer</p>
      <h1 class="users-hero-title">Benutzer</h1>
      <p class="users-hero-desc">Konten und Rollen verwalten</p>
    </div>
  </div>
  <div class="users-hero-actions">
    <a class="users-btn-create" href="/admin/users/create">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      Neuer Benutzer
    </a>
  </div>
</div>

<!-- Statistics Cards -->
<div class="users-stats">
  <div class="users-stat-card">
    <div class="users-stat-icon users-stat-icon-total">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
        <circle cx="9" cy="7" r="4"></circle>
        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
      </svg>
    </div>
    <div class="users-stat-content">
      <div class="users-stat-value"><?= $total ?></div>
      <div class="users-stat-label">Gesamtbenutzer</div>
    </div>
  </div>

  <div class="users-stat-card">
    <div class="users-stat-icon users-stat-icon-admin">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
        <path d="M2 17l10 5 10-5"></path>
        <path d="M2 12l10 5 10-5"></path>
      </svg>
    </div>
    <div class="users-stat-content">
      <div class="users-stat-value"><?= $admins ?></div>
      <div class="users-stat-label">Administratoren</div>
      <div class="users-stat-trend">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
        </svg>
        <?= $total > 0 ? round(($admins / $total) * 100) : 0 ?>%
      </div>
    </div>
  </div>

  <div class="users-stat-card">
    <div class="users-stat-icon users-stat-icon-author">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
        <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
        <path d="M2 2l7.586 7.586"></path>
        <circle cx="11" cy="11" r="2"></circle>
      </svg>
    </div>
    <div class="users-stat-content">
      <div class="users-stat-value"><?= $authors ?></div>
      <div class="users-stat-label">Autoren</div>
      <div class="users-stat-trend">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
        </svg>
        <?= $total > 0 ? round(($authors / $total) * 100) : 0 ?>%
      </div>
    </div>
  </div>

  <div class="users-stat-card">
    <div class="users-stat-icon users-stat-icon-reader">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
      </svg>
    </div>
    <div class="users-stat-content">
      <div class="users-stat-value"><?= $readers ?></div>
      <div class="users-stat-label">Leser</div>
      <div class="users-stat-trend">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
        </svg>
        <?= $total > 0 ? round(($readers / $total) * 100) : 0 ?>%
      </div>
    </div>
  </div>
</div>

<!-- Users List -->
<?php if (empty($users)): ?>
  <div class="users-empty">
    <div class="users-empty-icon">
      <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
        <circle cx="9" cy="7" r="4"></circle>
        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
      </svg>
    </div>
    <h3 class="users-empty-title">Keine Benutzer erstellt</h3>
    <p class="users-empty-desc">Erstellen Sie zunächst Ihr erstes Benutzerkonto</p>
    <a class="users-empty-btn" href="/admin/users/create">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      Benutzer erstellen
    </a>
  </div>
<?php else: ?>
  <div class="users-table-wrapper">
    <table class="users-table">
      <thead>
        <tr>
          <th class="users-th-id">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="8" y1="6" x2="21" y2="6"></line>
              <line x1="8" y1="12" x2="21" y2="12"></line>
              <line x1="8" y1="18" x2="21" y2="18"></line>
              <line x1="3" y1="6" x2="3.01" y2="6"></line>
              <line x1="3" y1="12" x2="3.01" y2="12"></line>
              <line x1="3" y1="18" x2="3.01" y2="18"></line>
            </svg>
            ID
          </th>
          <th class="users-th-user">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            Benutzer
          </th>
          <th class="users-th-role">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            Rolle
          </th>
          <th class="users-th-date">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Anmeldung
          </th>
          <th class="users-th-actions">Aktionen</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $u): ?>
        <tr class="users-table-row">
          <td class="users-td-id">
            <span class="users-id-badge">#<?= (int)$u['id'] ?></span>
          </td>
          <td class="users-td-user">
            <div class="users-user-cell">
              <div class="users-user-avatar">
                <?= strtoupper(substr($u['name'], 0, 1)) ?>
              </div>
              <div class="users-user-info">
                <div class="users-user-name"><?= esc($u['name']) ?></div>
                <div class="users-user-email"><?= esc($u['email']) ?></div>
              </div>
            </div>
          </td>
          <td class="users-td-role">
            <?php
              $roleIcons = [
                'admin' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>',
                'author' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path></svg>',
                'reader' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>'
              ];
              $roleClasses = [
                'admin' => 'users-role-admin',
                'author' => 'users-role-author',
                'reader' => 'users-role-reader'
              ];
            ?>
            <span class="users-role-badge <?= $roleClasses[$u['role']] ?? '' ?>">
              <?= $roleIcons[$u['role']] ?? '' ?>
              <?= esc(ucfirst($u['role'])) ?>
            </span>
          </td>
          <td class="users-td-date">
            <div class="users-date-cell">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
              <?= esc(date('d/m/Y', strtotime($u['created_at']))) ?>
            </div>
          </td>
          <td class="users-td-actions">
            <div class="users-action-buttons">
              <a class="users-btn-edit" href="/admin/users/<?= (int)$u['id'] ?>/edit" title="Bearbeiten">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
              </a>
              <form method="post" action="/admin/users/<?= (int)$u['id'] ?>/delete" style="display:inline" onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Benutzer löschen möchten?')">
                <?= csrf_field() ?>
                <button class="users-btn-delete" type="submit" title="Löschen">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                  </svg>
                </button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<style>
/* ==================== ANIMATIONS ==================== */
@keyframes users-float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  33% { transform: translateY(-12px) rotate(3deg); }
  66% { transform: translateY(-6px) rotate(-3deg); }
}

@keyframes users-pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.85; transform: scale(1.05); }
}

@keyframes users-slideUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ==================== HERO HEADER ==================== */
.users-hero {
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
  animation: users-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.users-hero-bg {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(circle at 20% 30%, rgba(168, 85, 247, 0.15) 0%, transparent 50%),
    radial-gradient(circle at 80% 70%, rgba(124, 58, 237, 0.12) 0%, transparent 50%),
    radial-gradient(circle at 40% 80%, rgba(147, 51, 234, 0.08) 0%, transparent 50%);
  opacity: 0.6;
  animation: users-pulse 8s ease-in-out infinite;
}

.users-hero-content {
  position: relative;
  display: flex;
  align-items: center;
  gap: 1.75rem;
  margin-bottom: 1.5rem;
}

.users-hero-icon {
  width: 80px;
  height: 80px;
  min-width: 80px;
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow:
    0 20px 40px rgba(59, 130, 246, 0.5),
    0 0 60px rgba(59, 130, 246, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.1),
    inset 0 1px 2px rgba(255, 255, 255, 0.3);
  animation: users-float 6s ease-in-out infinite;
  position: relative;
}

.users-hero-icon::before {
  content: '';
  position: absolute;
  inset: -4px;
  background: linear-gradient(135deg, #60a5fa, #2563eb);
  border-radius: 24px;
  opacity: 0.6;
  filter: blur(12px);
  z-index: -1;
  animation: users-pulse 4s ease-in-out infinite;
}

.users-hero-icon svg {
  color: white;
  filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
}

.users-hero-subtitle {
  margin: 0 0 0.375rem 0;
  font-size: 0.8125rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  color: #60a5fa;
  opacity: 0.9;
}

.users-hero-title {
  margin: 0 0 0.5rem 0;
  font-size: 2.5rem;
  font-weight: 800;
  line-height: 1.1;
  background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 50%, #2563eb 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: -0.5px;
}

.users-hero-desc {
  margin: 0;
  font-size: 0.9375rem;
  color: rgba(255, 255, 255, 0.65);
  line-height: 1.5;
}

.users-hero-actions {
  position: relative;
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.users-btn-create {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 1rem 2rem;
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  border: none;
  border-radius: 12px;
  color: white;
  font-weight: 700;
  font-size: 0.9375rem;
  text-decoration: none;
  box-shadow:
    0 8px 24px rgba(59, 130, 246, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.2);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
  cursor: pointer;
}

.users-btn-create::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transform: translateX(-100%);
  transition: transform 0.6s;
}

.users-btn-create:hover {
  transform: translateY(-2px);
  box-shadow:
    0 12px 32px rgba(59, 130, 246, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.2),
    inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.users-btn-create:hover::before {
  transform: translateX(100%);
}

.users-btn-create:active {
  transform: translateY(0);
}

/* ==================== STATISTICS CARDS ==================== */
.users-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1.25rem;
  margin-bottom: 2rem;
  animation: users-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.1s backwards;
}

.users-stat-card {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(168, 85, 247, 0.15);
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

.users-stat-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(168, 85, 247, 0.03), rgba(124, 58, 237, 0.02));
  opacity: 0;
  transition: opacity 0.3s;
}

.users-stat-card:hover {
  transform: translateY(-4px);
  border-color: rgba(168, 85, 247, 0.3);
  box-shadow:
    0 12px 24px rgba(0, 0, 0, 0.15),
    0 0 32px rgba(168, 85, 247, 0.15);
}

.users-stat-card:hover::before {
  opacity: 1;
}

.users-stat-icon {
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

.users-stat-card:hover .users-stat-icon {
  transform: scale(1.05) rotate(-5deg);
}

.users-stat-icon::before {
  content: '';
  position: absolute;
  inset: -2px;
  border-radius: 16px;
  opacity: 0.5;
  filter: blur(10px);
  z-index: -1;
}

.users-stat-icon-total {
  background: linear-gradient(135deg, #a855f7, #7c3aed);
  box-shadow: 0 8px 24px rgba(168, 85, 247, 0.35);
}

.users-stat-icon-total::before {
  background: linear-gradient(135deg, #c084fc, #7c3aed);
}

.users-stat-icon-admin {
  background: linear-gradient(135deg, #f59e0b, #d97706);
  box-shadow: 0 8px 24px rgba(245, 158, 11, 0.35);
}

.users-stat-icon-admin::before {
  background: linear-gradient(135deg, #fbbf24, #d97706);
}

.users-stat-icon-author {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  box-shadow: 0 8px 24px rgba(59, 130, 246, 0.35);
}

.users-stat-icon-author::before {
  background: linear-gradient(135deg, #60a5fa, #2563eb);
}

.users-stat-icon-reader {
  background: linear-gradient(135deg, #10b981, #059669);
  box-shadow: 0 8px 24px rgba(16, 185, 129, 0.35);
}

.users-stat-icon-reader::before {
  background: linear-gradient(135deg, #34d399, #059669);
}

.users-stat-icon svg {
  color: white;
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
}

.users-stat-content {
  flex: 1;
  position: relative;
}

.users-stat-value {
  font-size: 2rem;
  font-weight: 800;
  line-height: 1;
  background: linear-gradient(135deg, #c084fc, #a78bfa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 0.375rem;
}

.users-stat-label {
  font-size: 0.8125rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.5);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.users-stat-trend {
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
  margin-top: 0.375rem;
  padding: 0.25rem 0.5rem;
  background: rgba(168, 85, 247, 0.1);
  border-radius: 6px;
  font-size: 0.6875rem;
  font-weight: 700;
  color: #c084fc;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}

.users-stat-trend svg {
  color: #a855f7;
}

/* ==================== USERS TABLE ==================== */
.users-table-wrapper {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(168, 85, 247, 0.12);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  animation: users-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards;
}

.users-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
}

.users-table thead {
  background: linear-gradient(135deg, rgba(168, 85, 247, 0.08), rgba(124, 58, 237, 0.05));
  border-bottom: 2px solid rgba(168, 85, 247, 0.15);
}

.users-table thead th {
  padding: 1.125rem 1.5rem;
  text-align: left;
  font-weight: 700;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: rgba(255, 255, 255, 0.6);
}

.users-table thead th svg {
  vertical-align: middle;
  margin-right: 0.5rem;
  opacity: 0.7;
  color: #c084fc;
}

.users-table-row {
  border-bottom: 1px solid rgba(168, 85, 247, 0.06);
  transition: all 0.2s ease;
}

.users-table-row:last-child {
  border-bottom: none;
}

.users-table-row:hover {
  background: rgba(168, 85, 247, 0.05);
}

.users-table tbody td {
  padding: 1.125rem 1.5rem;
  vertical-align: middle;
}

.users-th-id, .users-td-id {
  width: 80px;
}

.users-th-role, .users-td-role {
  width: 160px;
}

.users-th-date, .users-td-date {
  width: 150px;
}

.users-th-actions, .users-td-actions {
  width: 120px;
  text-align: right;
}

/* User Cell */
.users-user-cell {
  display: flex;
  align-items: center;
  gap: 0.875rem;
}

.users-user-avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: linear-gradient(135deg, #a855f7, #7c3aed);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 700;
  font-size: 1.125rem;
  flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(168, 85, 247, 0.35);
}

.users-user-info {
  flex: 1;
  min-width: 0;
}

.users-user-name {
  font-weight: 600;
  font-size: 0.9375rem;
  color: rgba(255, 255, 255, 0.95);
  margin-bottom: 0.25rem;
}

.users-user-email {
  font-size: 0.8125rem;
  color: rgba(255, 255, 255, 0.5);
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* Badges */
.users-id-badge {
  font-family: 'SF Mono', 'Monaco', 'Courier New', monospace;
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.5);
  font-weight: 600;
}

.users-role-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.4375rem 0.875rem;
  border-radius: 20px;
  font-size: 0.8125rem;
  font-weight: 700;
  border: 1px solid;
  backdrop-filter: blur(10px);
  text-transform: capitalize;
}

.users-role-admin {
  background: rgba(245, 158, 11, 0.15);
  color: #fbbf24;
  border-color: rgba(245, 158, 11, 0.3);
}

.users-role-author {
  background: rgba(59, 130, 246, 0.15);
  color: #60a5fa;
  border-color: rgba(59, 130, 246, 0.3);
}

.users-role-reader {
  background: rgba(16, 185, 129, 0.15);
  color: #34d399;
  border-color: rgba(16, 185, 129, 0.3);
}

.users-date-cell {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: rgba(255, 255, 255, 0.5);
  font-size: 0.875rem;
  font-family: 'SF Mono', Monaco, monospace;
}

.users-date-cell svg {
  opacity: 0.6;
  color: #c084fc;
}

/* Action Buttons */
.users-action-buttons {
  display: flex;
  gap: 0.5rem;
  justify-content: flex-end;
}

.users-btn-edit,
.users-btn-delete {
  width: 38px;
  height: 38px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 10px;
  border: 1px solid;
  background: transparent;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  backdrop-filter: blur(10px);
}

.users-btn-edit {
  color: #c084fc;
  border-color: rgba(168, 85, 247, 0.2);
}

.users-btn-edit:hover {
  background: rgba(168, 85, 247, 0.15);
  border-color: #c084fc;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(168, 85, 247, 0.3);
}

.users-btn-delete {
  color: #ef4444;
  border-color: rgba(239, 68, 68, 0.2);
}

.users-btn-delete:hover {
  background: rgba(239, 68, 68, 0.12);
  border-color: #ef4444;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(239, 68, 68, 0.2);
}

/* ==================== EMPTY STATE ==================== */
.users-empty {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 4rem 2rem;
  text-align: center;
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border: 2px dashed rgba(168, 85, 247, 0.2);
  border-radius: 20px;
  animation: users-slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards;
}

.users-empty-icon {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  background: linear-gradient(135deg, rgba(168, 85, 247, 0.1), rgba(124, 58, 237, 0.05));
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
  animation: users-pulse 3s ease-in-out infinite;
}

.users-empty-icon svg {
  color: rgba(168, 85, 247, 0.5);
}

.users-empty-title {
  margin: 0 0 0.75rem 0;
  font-size: 1.5rem;
  font-weight: 700;
  background: linear-gradient(135deg, #c084fc, #a78bfa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.users-empty-desc {
  margin: 0 0 2rem 0;
  font-size: 0.9375rem;
  color: rgba(255, 255, 255, 0.5);
  max-width: 400px;
  line-height: 1.6;
}

.users-empty-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 1rem 2rem;
  background: linear-gradient(135deg, #a855f7, #7c3aed);
  border: none;
  border-radius: 12px;
  color: white;
  font-weight: 700;
  font-size: 0.9375rem;
  text-decoration: none;
  box-shadow:
    0 8px 24px rgba(168, 85, 247, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.1);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.users-empty-btn:hover {
  transform: translateY(-2px);
  box-shadow:
    0 12px 32px rgba(168, 85, 247, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.2);
}

.users-empty-btn:active {
  transform: translateY(0);
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 1024px) {
  .users-stats {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .users-hero {
    padding: 2rem 1.5rem;
  }

  .users-hero-content {
    flex-direction: column;
    align-items: flex-start;
    gap: 1.25rem;
  }

  .users-hero-icon {
    width: 64px;
    height: 64px;
    min-width: 64px;
  }

  .users-hero-icon svg {
    width: 36px;
    height: 36px;
  }

  .users-hero-title {
    font-size: 2rem;
  }

  .users-hero-actions {
    width: 100%;
  }

  .users-btn-create {
    width: 100%;
    justify-content: center;
  }

  .users-stats {
    grid-template-columns: 1fr;
  }

  .users-table-wrapper {
    overflow-x: auto;
  }

  .users-table {
    min-width: 800px;
  }
}

@media (max-width: 480px) {
  .users-hero-title {
    font-size: 1.75rem;
  }

  .users-stat-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
  }

  .users-stat-icon svg {
    width: 22px;
    height: 22px;
  }

  .users-stat-value {
    font-size: 1.5rem;
  }
}
</style>
