<?php
class Usuario {
    private $nome;
    private $email;
    private $senhaHash;

    public function __construct($nome, $email, $senha) {
        $this->nome = $this->sanitizarNome($nome);
        $this->email = $this->validarEmail($email);
        $this->senhaHash = $this->hashSenha($senha);
    }

    private function sanitizarNome($nome) {
        $nome = trim($nome);

        $nome = htmlspecialchars($nome);
        //$nome = filter_var($nome, FILTER_SANITIZE_STRING);
        if (empty($nome)) {
            throw new Exception("Nome não pode estar vazio.");
        }
        return $nome;
    }

    private function validarEmail($email) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("E-mail inválido.");
        }
        return $email;
    }

    private function hashSenha($senha) {
        if (strlen($senha) < 6) {
            throw new Exception("Senha deve ter pelo menos 6 caracteres.");
        }
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public function verificarSenha($senha) {
        return password_verify($senha, $this->senhaHash);
    }

    // Getters
    public function getNome() { return $this->nome; }
    public function getEmail() { return $this->email; }
}
?>