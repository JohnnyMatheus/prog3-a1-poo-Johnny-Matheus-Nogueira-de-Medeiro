<?php
require_once 'classes/Sessao.php';
Sessao::iniciar();

if (Sessao::get('usuario')) {
    header('Location: dashboard.php');
    exit;
}

$lembrarEmail = $_COOKIE['lembrar_email'] ?? '';
$erro = isset($_GET['erro']) ? $_GET['erro'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Login</h1>
                        
                        <?php if (isset($_GET['registro']) && $_GET['registro'] === 'sucesso'): ?>
                            <div class="alert alert-success">Cadastro realizado com sucesso!</div>
                        <?php endif; ?>
                        
                        <?php if ($erro === 'credenciais'): ?>
                            <div class="alert alert-danger">E-mail ou senha incorretos.</div>
                        <?php endif; ?>
                        
                        <form action="processa_login.php" method="post">
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" 
                                       placeholder="E-mail" value="<?= htmlspecialchars($lembrarEmail) ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="lembrar" id="lembrar">
                                <label class="form-check-label" for="lembrar">Lembrar e-mail</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                        <p class="mt-3 text-center">Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>