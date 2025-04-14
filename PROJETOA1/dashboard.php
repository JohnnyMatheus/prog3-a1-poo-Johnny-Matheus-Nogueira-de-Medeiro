<?php
require_once 'classes/Sessao.php';
Sessao::iniciar();

if (!Sessao::get('usuario')) {
    header('Location: login.php');
    exit;
}

$emailLembrado = $_COOKIE['lembrar_email'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, <?= htmlspecialchars(Sessao::get('usuario')) ?>!</h1>
    <?php if ($emailLembrado): ?>
        <p>E-mail lembrado: <?= htmlspecialchars($emailLembrado) ?></p>
    <?php endif; ?>
    <a href="logout.php">Sair</a>
</body>
</html>