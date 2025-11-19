<?php
namespace App\Controllers\Admin;
use App\Models\User;
class UserAdminController {
  public function index(){ \requireRole(['admin']); $users=(new User())->all(); render('admin/users-index', compact('users')); }
  public function create(){ \requireRole(['admin']); render('admin/users-form', ['user'=>null]); }
  public function store(){
    \requireRole(['admin']);
    \csrf_check();
    (new User())->create(trim($_POST['name']), trim($_POST['email']), $_POST['password'], $_POST['role']);
    $_SESSION['flash']=['type'=>'success','msg'=>'Benutzer erstellt']; return redirect('/admin/users');
  }
  public function edit($id){ \requireRole(['admin']); $user=(new User())->find((int)$id); render('admin/users-form', compact('user')); }
  public function update($id){
    \requireRole(['admin']);
    \csrf_check();
    (new User())->updateUser((int)$id, trim($_POST['name']), trim($_POST['email']), ($_POST['password']??'') ?: null, $_POST['role']);
    $_SESSION['flash']=['type'=>'success','msg'=>'Benutzer aktualisiert']; return redirect('/admin/users');
  }
  public function destroy($id){ \requireRole(['admin']); \csrf_check(); (new User())->delete((int)$id); $_SESSION['flash']=['type'=>'success','msg'=>'Benutzer gelöscht']; return redirect('/admin/users'); }
}
