<?php
require_once './PROJETOA1/classes/Sessao.php';
Sessao::iniciar();

if (Sessao::get('usuario')) {
    header('Location: dashboard.php');
    exit;
}

$lembrarEmail = $_COOKIE['lembrar_email'] ?? '';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($_GET['registro']) && $_GET['registro'] === 'sucesso'): ?>
        <p style="color: green;">Cadastro realizado com sucesso!</p>
    <?php endif; ?>
    <form action="processa_login.php" method="post">
        <input type="email" name="email" placeholder="E-mail" value="<?= htmlspecialchars($lembrarEmail) ?>" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <label>
            <input type="checkbox" name="lembrar"> Lembrar e-mail
        </label><br>
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
</body>
</html>