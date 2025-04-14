<?php
require_once 'classes/Usuario.php';
require_once 'classes/Autenticador.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($nome) || empty($email) || empty($senha)) {
        die("Todos os campos são obrigatórios.");
    }

    $usuario = new Usuario($nome, $email, $senha);

    if (Autenticador::registrar($usuario)) {
        header('Location: login.php?registro=sucesso');
    } else {
        die("E-mail já cadastrado.");
    }
}