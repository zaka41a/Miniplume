<?php
namespace App\Models;
class User extends BaseModel {
  public function all(): array {
    return $this->pdo->query("SELECT id,name,email,role,created_at FROM users ORDER BY id DESC")->fetchAll();
  }
  public function find(int $id): ?array {
    $s=$this->pdo->prepare("SELECT id,name,email,role FROM users WHERE id=?"); $s->execute([$id]);
    return $s->fetch() ?: null;
  }
  public function create(string $name,string $email,string $password,string $role): int {
    $h=password_hash($password, PASSWORD_DEFAULT);
    $s=$this->pdo->prepare("INSERT INTO users(name,email,password_hash,role) VALUES(?,?,?,?)");
    $s->execute([$name,$email,$h,$role]); return (int)$this->pdo->lastInsertId();
  }
  public function updateUser(int $id,string $name,string $email,?string $password,string $role): void {
    if ($password) {
      $h=password_hash($password,PASSWORD_DEFAULT);
      $s=$this->pdo->prepare("UPDATE users SET name=?,email=?,password_hash=?,role=? WHERE id=?");
      $s->execute([$name,$email,$h,$role,$id]);
    } else {
      $s=$this->pdo->prepare("UPDATE users SET name=?,email=?,role=? WHERE id=?");
      $s->execute([$name,$email,$role,$id]);
    }
  }
  public function delete(int $id): void {
    $this->pdo->prepare("DELETE FROM users WHERE id=?")->execute([$id]);
  }
}
