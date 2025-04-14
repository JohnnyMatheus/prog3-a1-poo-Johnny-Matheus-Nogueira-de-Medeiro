<?php
require_once 'classes/Sessao.php';
Sessao::iniciar();

if (Sessao::get('usuario')) {
    header('Location: dashboard.php');
    exit;
}

$lembrarEmail = $_COOKIE['lembrar_email'] ?? '';
$erro = $_GET['erro'] ?? '';
$dadosLogin = $_SESSION['dados_login'] ?? [];
unset($_SESSION['dados_login']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
        .password-container {
            position: relative;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Login</h1>
                        
                        <!-- Mensagens de erro -->
                        <?php if (!empty($_SESSION['erros_login'])): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($_SESSION['erros_login'] as $erro): ?>
                                        <li><?= htmlspecialchars($erro) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php unset($_SESSION['erros_login']); ?>
                        <?php endif; ?>
                        
                        <?php if (isset($_GET['registro']) && $_GET['registro'] === 'sucesso'): ?>
                            <div class="alert alert-success">Cadastro realizado com sucesso! Faça login para continuar.</div>
                        <?php endif; ?>
                        
                        <?php if ($erro === 'credenciais'): ?>
                            <div class="alert alert-danger">E-mail ou senha incorretos.</div>
                        <?php endif; ?>
                        
                        <form id="loginForm" action="processa_login.php" method="post" novalidate>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="seu@email.com" 
                                       value="<?= htmlspecialchars($dadosLogin['email'] ?? $lembrarEmail) ?>" 
                                       required>
                                <div class="invalid-feedback">Por favor, informe um e-mail válido.</div>
                            </div>
                            
                            <div class="mb-3 password-container">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha" 
                                       placeholder="Sua senha" required>
                                <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
                                <div class="invalid-feedback">Por favor, informe sua senha.</div>
                                <div class="text-end mt-2">
                                    <a href="recuperar_senha.php" class="text-decoration-none">Esqueceu a senha?</a>
                                </div>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="lembrar" id="lembrar"
                                    <?= !empty($lembrarEmail) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="lembrar">Lembrar e-mail</label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Entrar</button>
                            
                            <div class="text-center">
                                <p class="mb-0">Não tem conta? <a href="cadastro.php" class="text-decoration-none">Cadastre-se</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar/ocultar senha
            const togglePassword = document.querySelector('#togglePassword');
            const senha = document.querySelector('#senha');
            
            if (togglePassword && senha) {
                togglePassword.addEventListener('click', function() {
                    const type = senha.getAttribute('type') === 'password' ? 'text' : 'password';
                    senha.setAttribute('type', type);
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }

            // Validação do formulário
            const form = document.getElementById('loginForm');
            if (form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }
        });
    </script>
</body>
</html>