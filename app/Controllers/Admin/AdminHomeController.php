<?php
namespace App\Controllers\Admin;

class AdminHomeController {
  public function index() {
    \requireRole(['admin']);
    \render('home-admin');
  }
}
