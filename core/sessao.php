<?php

declare(strict_types=1);

namespace Biblioteca\Core;

final class Sessao
{
    private static ?array $antigos = null;

    public static function iniciar(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                'httponly' => true,
                'samesite' => 'Lax',
            ]);

            session_start();
        }

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

    public static function estaLogado(): bool
    {
        return ($_SESSION['logado'] ?? false) === true;
    }

    public static function entrar(): void
    {
        session_regenerate_id(true);

        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['logado'] = true;
    }

    public static function sair(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }

        $_SESSION = [];

        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        self::$antigos = null;
    }

    public static function flash(string $tipo, string $mensagem): void
    {
        $_SESSION['_flash'][] = [
            'tipo' => $tipo,
            'mensagem' => $mensagem,
        ];
    }

    public static function consumirFlashes(): array
    {
        $flashes = $_SESSION['_flash'] ?? [];

        unset($_SESSION['_flash']);

        return $flashes;
    }

    public static function guardarAntigos(array $dados): void
    {
        $_SESSION['_antigos'] = $dados;
    }

    public static function antigo(
        string $campo,
        string $padrao = ''
    ): string {
        if (self::$antigos === null) {
            self::$antigos = $_SESSION['_antigos'] ?? [];

            unset($_SESSION['_antigos']);
        }

        $valor = self::$antigos[$campo] ?? $padrao;

        return is_string($valor) ? $valor : $padrao;
    }

    public static function tokenCsrf(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function csrfValido(?string $token): bool
    {
        $tokenSessao = $_SESSION['csrf_token'] ?? '';

        return is_string($token)
            && is_string($tokenSessao)
            && $token !== ''
            && hash_equals($tokenSessao, $token);
    }
}
