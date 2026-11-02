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

        // Gera o token CSRF caso ainda não exista na sessão.
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

        $_SESSION['logado'] = true;
    }

    public static function sair(): void
{
    // Gera um novo ID para invalidar a sessão anterior.
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }

    // Limpa os dados da sessão.
    $_SESSION = [];

    // Gera um novo token CSRF.
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

    // Limpa os dados antigos armazenados em memória.
    self::$antigos = null;
}

    public static function flash(string $tipo, string $mensagem): void
    {
        $_SESSION['_flash'][] = [
            'tipo' => $tipo,
            'mensagem' => $mensagem,
        ];
    }

    /**
     * Devolve as mensagens guardadas e já as apaga.
     * As mensagens aparecem uma vez só.
     */
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

    // Retorna o token CSRF da sessão. Cria um token caso ainda não exista.//
     
    public static function tokenCsrf(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    // Verifica se o token enviado corresponde ao token armazenado na sessão.//
    public static function csrfValido(?string $token): bool
    {
        $tokenSessao = $_SESSION['csrf_token'] ?? '';

        return is_string($token)
            && is_string($tokenSessao)
            && $token !== ''
            && hash_equals($tokenSessao, $token);
    }
}
