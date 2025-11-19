<?php
namespace App\Controllers\Admin;

class DashboardController {
    public function loginForm() {
        render('admin/login');
    }

    public function login() {
    \csrf_check();
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $_SESSION['flash'] = ['type'=>'error','msg'=>'E-Mail oder Passwort fehlt'];
        return redirect('/login');
    }

    if (\Auth::attempt($email, $password)) {
        // URL initiale demandée (intended) prioritaire
        if (!empty($_SESSION['intended'])) {
            $to = $_SESSION['intended'];
            unset($_SESSION['intended']);
            return redirect($to);
        }

        // Map de redirection par rôle
        $role = $_SESSION['role'] ?? 'reader';
        if ($role === 'admin')  return redirect('/admin/posts');
        if ($role === 'author') return redirect('/');       // <<< auteurs -> accueil
        return redirect('/');                               // reader -> accueil
    }

    $_SESSION['flash'] = ['type'=>'error','msg'=>'Ungültige Anmeldedaten'];
    return redirect('/login');
}


    public function logout() {
        \csrf_check();
        \Auth::logout();
        $_SESSION['flash'] = ['type'=>'success','msg'=>'Abgemeldet'];
        return redirect('/');
    }
}
