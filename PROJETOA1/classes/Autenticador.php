<?php
/*
 #Classe Autenticador
 • Simula base de dados com array de objetos.
 • Métodos para registro e login
*/

require_once 'Usuario.php';

class Autenticador {
    public static function registrar(Usuario $usuario): bool {
        self::iniciar();
        foreach ($_SESSION['usuarios'] ?? [] as $u) {
            if ($u->getEmail() === $usuario->getEmail()) {
                return false;
            }
        }
        $_SESSION['usuarios'][] = $usuario;
        return true;
    }

    public static function login(string $email, string $senha): ?Usuario {
        self::iniciar();
        foreach ($_SESSION['usuarios'] ?? [] as $usuario) {
            if ($usuario->getEmail() === $email && $usuario->autenticar($senha)) {
                return $usuario;
            }
        }
        return null;
    }

    private static function iniciar(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}


?>