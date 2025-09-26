<?php
namespace App\Models;
use PDO; use function db;
abstract class BaseModel {
protected PDO $pdo;
public function __construct(){ $this->pdo = db(); }
}