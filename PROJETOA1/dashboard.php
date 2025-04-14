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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .user-card {
            max-width: 500px;
            margin: 0 auto;
        }
        .welcome-header {
            color: #0d6efd;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Meu Sistema</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    Olá, <?= htmlspecialchars(Sessao::get('usuario')) ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-white">
                        <h2 class="welcome-header text-center mb-0">Bem-vindo ao Painel</h2>
                    </div>
                    <div class="card-body text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#0d6efd" class="bi bi-person-circle mb-3" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <h3 class="mb-4"><?= htmlspecialchars(Sessao::get('usuario')) ?></h3>
                        
                        <?php if ($emailLembrado): ?>
                            <div class="alert alert-info">
                                E-mail lembrado: <strong><?= htmlspecialchars($emailLembrado) ?></strong>
                            </div>
                        <?php endif; ?>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                            <a href="#" class="btn btn-primary me-md-2">Meu Perfil</a>
                            <a href="#" class="btn btn-outline-secondary">Configurações</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>