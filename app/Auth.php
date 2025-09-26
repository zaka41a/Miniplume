<?php
use function db;

class Auth {
  public static function attempt(string $email, string $password): bool {
    if (!self::canTry()) return false;
    $s = db()->prepare('SELECT * FROM users WHERE email=?'); 
    $s->execute([$email]);
    $u = $s->fetch();
    $ok = $u && password_verify($password, $u['password_hash']);
    self::noteAttempt($ok);
    if ($ok) { 
      $_SESSION['uid'] = $u['id']; 
      $_SESSION['role'] = $u['role']; 
    }
    return $ok;
  }

  public static function check(): bool { 
    return isset($_SESSION['uid']); 
  }

  public static function roleIn(array $roles): bool { 
    return self::check() && in_array($_SESSION['role'], $roles, true); 
  }

  public static function logout(): void { 
    session_regenerate_id(true); 
    $_SESSION = []; 
    session_destroy(); 
  }

  private static function ipBin(): string { 
    return inet_pton($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'); 
  }

  private static function canTry(): bool {
    $s = db()->prepare('SELECT attempts,last_attempt FROM login_attempts WHERE ip=?'); 
    $s->execute([self::ipBin()]); 
    $r = $s->fetch();
    if (!$r) return true;
    if ($r['attempts'] < 5) return true;
    return (time() - strtotime($r['last_attempt'])) > 15*60;
  }

  private static function noteAttempt(bool $ok): void {
    if ($ok) { 
      db()->prepare('DELETE FROM login_attempts WHERE ip=?')->execute([self::ipBin()]); 
      return; 
    }
    db()->prepare(
      'INSERT INTO login_attempts(ip,attempts,last_attempt) VALUES(?,1,NOW())
       ON DUPLICATE KEY UPDATE 
         attempts = IF(TIMESTAMPDIFF(MINUTE,last_attempt,NOW())>15, 1, attempts+1),
         last_attempt = NOW()'
    )->execute([self::ipBin()]);
  }
}

function requireRole(array $roles): void {
  if (!Auth::roleIn($roles)) {
    $_SESSION['intended'] = $_SERVER['REQUEST_URI'] ?? '/';
    redirect('/login');
  }
}



