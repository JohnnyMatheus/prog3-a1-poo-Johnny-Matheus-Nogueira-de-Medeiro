<?php

//Criando a classe usuario e seus atributos privados: nome, e-mail, senha.

class Usuario{
    private string $nome;
    private string $email;
    private string $senha;

// Construtor e método de autenticacão.
// Uso de password hash e password_verify recomendado
public function __construct(string $nome, string $email, string $senha)
{
    $this-> nome = htmlspecialchars($nome);
    $this-> email = htmlspecialchars($email);
    $this-> senha = password_hash($senha,PASSWORD_DEFAULT);
}

public function autenticar(string $senha): bool {
    return password_verify($senha, $this->senha);
}

public function getNome(): string {
    return $this->nome;
}

public function getEmail(): string {
    return $this->email;
}

}


?>