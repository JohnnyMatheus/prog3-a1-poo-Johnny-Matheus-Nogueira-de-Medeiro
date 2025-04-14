<?php
require_once 'classes/Autenticador.php';
require_once 'classes/Sessao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $lembrar = isset($_POST['lembrar']);

    $usuario = Autenticador::login($email, $senha);

    if ($usuario) {
        Sessao::set('usuario', $usuario->getNome());
        
        if ($lembrar) {
            setcookie('lembrar_email', $email, time() + 86400 * 30, '/');
        } else {
            setcookie('lembrar_email', '', time() - 3600, '/');
        }

        header('Location: dashboard.php');
    } else {
        die("E-mail ou senha incorretos.");
    }
}