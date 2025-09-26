<?php
namespace App\Controllers\Admin;

class AdsAdminController {
  public function index() {
    \requireRole(['admin']);
    \render('admin/ads-index');
  }
}
