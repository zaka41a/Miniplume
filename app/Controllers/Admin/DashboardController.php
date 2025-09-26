<?php
namespace App\Controllers\Admin;

class DashboardController {
    public function loginForm() {
        render('admin/login');
    }

    public function login() {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $_SESSION['flash'] = ['type'=>'error','msg'=>'Email ou mot de passe manquant'];
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

    $_SESSION['flash'] = ['type'=>'error','msg'=>'Identifiants incorrects'];
    return redirect('/login');
}


    public function logout() {
        \Auth::logout();
        $_SESSION['flash'] = ['type'=>'success','msg'=>'Déconnecté'];
        return redirect('/');
    }
}
