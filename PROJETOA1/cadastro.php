<?php
require 'classes/Sessao.php';
Sessao::iniciar();

if (Sessao::get('usuario')) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Cadastro</h1>
                        <form action="processa_cadastro.php" method="post">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        </form>
                        <p class="mt-3 text-center">Já tem conta? <a href="login.php">Faça login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>