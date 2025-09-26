<?php
// Erreurs (prod: display_errors=0, log vers storage/logs/error.log)
ini_set('display_errors', 1);
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../storage/logs/error.log');


// Sessions + cookies sûrs
session_set_cookie_params([
'lifetime' => 0,
'path' => '/',
'secure' => isset($_SERVER['HTTPS']),
'httponly' => true,
'samesite' => 'Lax',
]);
session_name('MINICMSSESSID');
session_start();


// Config DB
const DB_DSN  = 'mysql:host=127.0.0.1;dbname=minicms;charset=utf8mb4';
const DB_USER = 'root';
const DB_PASS = 'root';


function db(): PDO {
static $pdo;
if (!$pdo) {
$pdo = new PDO(DB_DSN, DB_USER, DB_PASS, [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES => false,
]);
}
return $pdo;
}