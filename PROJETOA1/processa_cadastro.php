<?php
require_once 'classes/Usuario.php';
require_once 'classes/Autenticador.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    // Validações básicas
    $erros = [];
    
    if (empty($nome)) {
        $erros[] = "O campo nome é obrigatório.";
    } elseif (strlen($nome) < 3) {
        $erros[] = "O nome deve ter pelo menos 3 caracteres.";
    }
    
    if (empty($email)) {
        $erros[] = "O campo e-mail é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Por favor, informe um e-mail válido.";
    }
    
    if (empty($senha)) {
        $erros[] = "O campo senha é obrigatório.";
    } elseif (strlen($senha) < 8) {
        $erros[] = "A senha deve ter pelo menos 8 caracteres.";
    } elseif (!preg_match('/[A-Z]/', $senha)) {
        $erros[] = "A senha deve conter pelo menos uma letra maiúscula.";
    } elseif (!preg_match('/[a-z]/', $senha)) {
        $erros[] = "A senha deve conter pelo menos uma letra minúscula.";
    } elseif (!preg_match('/[0-9]/', $senha)) {
        $erros[] = "A senha deve conter pelo menos um número.";
    } elseif (!preg_match('/[^A-Za-z0-9]/', $senha)) {
        $erros[] = "A senha deve conter pelo menos um caractere especial.";
    }
    
    if ($senha !== $confirmar_senha) {
        $erros[] = "As senhas não coincidem.";
    }
    
    // Se houver erros, retorna para o formulário
    if (!empty($erros)) {
        session_start();
        $_SESSION['erros_cadastro'] = $erros;
        $_SESSION['dados_cadastro'] = ['nome' => $nome, 'email' => $email];
        header('Location: cadastro.php');
        exit;
    }

    $usuario = new Usuario($nome, $email, $senha);

    if (Autenticador::registrar($usuario)) {
        header('Location: login.php?registro=sucesso');
    } else {
        session_start();
        $_SESSION['erros_cadastro'] = ["E-mail já cadastrado."];
        $_SESSION['dados_cadastro'] = ['nome' => $nome, 'email' => $email];
        header('Location: cadastro.php');
    }
}