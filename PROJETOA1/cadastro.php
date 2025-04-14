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
                        <form id="formCadastro" action="processa_cadastro.php" method="post" novalidate>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                                <div class="invalid-feedback">Por favor, informe seu nome.</div>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="E-mail" required
                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                <div class="invalid-feedback">Por favor, informe um e-mail válido.</div>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="senha" id="senha" 
                                       placeholder="Senha" required minlength="8"
                                       pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                                <div class="invalid-feedback">
                                    A senha deve conter pelo menos:<br>
                                    - 8 caracteres<br>
                                    - 1 letra maiúscula<br>
                                    - 1 letra minúscula<br>
                                    - 1 número<br>
                                    - 1 caractere especial
                                </div>
                                <div class="progress mt-2" style="height: 5px;">
                                    <div id="passwordStrength" class="progress-bar" role="progressbar"></div>
                                </div>
                                <small class="text-muted">Força da senha: <span id="strengthText">fraca</span></small>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="confirmar_senha" 
                                       placeholder="Confirmar Senha" required>
                                <div class="invalid-feedback">As senhas não coincidem.</div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formCadastro');
            const senhaInput = document.getElementById('senha');
            const confirmarSenhaInput = document.querySelector('input[name="confirmar_senha"]');
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('strengthText');

            // Validação de força da senha
            senhaInput.addEventListener('input', function() {
                const password = senhaInput.value;
                let strength = 0;
                
                // Verifica o comprimento
                if (password.length >= 8) strength += 1;
                if (password.length >= 12) strength += 1;
                
                // Verifica caracteres diversos
                if (/[A-Z]/.test(password)) strength += 1;
                if (/[0-9]/.test(password)) strength += 1;
                if (/[^A-Za-z0-9]/.test(password)) strength += 1;
                
                // Atualiza a barra de progresso
                const width = strength * 20;
                strengthBar.style.width = width + '%';
                
                // Atualiza cores e texto
                if (strength <= 2) {
                    strengthBar.className = 'progress-bar bg-danger';
                    strengthText.textContent = 'Fraca';
                } else if (strength <= 4) {
                    strengthBar.className = 'progress-bar bg-warning';
                    strengthText.textContent = 'Média';
                } else {
                    strengthBar.className = 'progress-bar bg-success';
                    strengthText.textContent = 'Forte';
                }
            });

            // Validação de confirmação de senha
            confirmarSenhaInput.addEventListener('input', function() {
                if (confirmarSenhaInput.value !== senhaInput.value) {
                    confirmarSenhaInput.setCustomValidity('As senhas não coincidem');
                    confirmarSenhaInput.classList.add('is-invalid');
                } else {
                    confirmarSenhaInput.setCustomValidity('');
                    confirmarSenhaInput.classList.remove('is-invalid');
                }
            });

            // Validação do formulário
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    </script>
</body>
</html>