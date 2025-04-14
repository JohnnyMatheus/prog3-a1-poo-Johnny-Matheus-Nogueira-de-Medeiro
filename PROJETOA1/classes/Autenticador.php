<?php
/*
 #Classe Autenticador
 • Simula base de dados com array de objetos.
 • Métodos para registro e login
*/

require_once 'Usuario.php';

class Autenticador {
    private static array $usuarios = [];

    public static function registrar(Usuario $usuario): bool {
        foreach (self::$usuarios as $u) {
            if ($u->getEmail() === $usuario->getEmail()) {
                return false; // E-mail já cadastrado
            }
        }
        self::$usuarios[] = $usuario;
        return true;
    }

    public static function login(string $email, string $senha): ?Usuario {
        foreach (self::$usuarios as $usuario) {
            if ($usuario->getEmail() === $email && $usuario->autenticar($senha)) {
                return $usuario;
            }
        }
        return null;
    }
}


?>