<?php
/*
 Classe Sessao
 • Métodos estáticos: iniciar, set, get, destruir.

*/

class Sessao {
    public static function iniciar(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $chave, $valor): void {
        self::iniciar();
        $_SESSION[$chave] = $valor;
    }

    public static function get(string $chave) {
        self::iniciar();
        return $_SESSION[$chave] ?? null;
    }

    public static function destruir(): void {
        self::iniciar();
        session_unset();
        session_destroy();
    }
}



?>