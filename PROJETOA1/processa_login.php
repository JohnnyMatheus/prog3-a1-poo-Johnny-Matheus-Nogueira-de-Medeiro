<?php
require_once 'classes/Autenticador.php';
require_once 'classes/Sessao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $lembrar = isset($_POST['lembrar']);

    // Validações
    $erros = [];
    
    if (empty($email)) {
        $erros[] = "O campo e-mail é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Por favor, informe um e-mail válido.";
    }
    
    if (empty($senha)) {
        $erros[] = "O campo senha é obrigatório.";
    }
    
    if (!empty($erros)) {
        session_start();
        $_SESSION['erros_login'] = $erros;
        $_SESSION['dados_login'] = ['email' => $email];
        header('Location: login.php');
        exit;
    }

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
        session_start();
        $_SESSION['erros_login'] = ["E-mail ou senha incorretos."];
        $_SESSION['dados_login'] = ['email' => $email];
        header('Location: login.php');
    }
}