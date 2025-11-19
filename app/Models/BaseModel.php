<?php
namespace App\Models;

abstract class BaseModel {
protected \PDO $pdo;
public function __construct(){ $this->pdo = db(); }
}