<?php


class Session
{
    private static bool $isStarted = false;

    public static function isStarted(): bool
    {
        self::$isStarted = session_status() === PHP_SESSION_ACTIVE;

        return self::$isStarted;
    }

    public static function start(): bool
    {
        if (self::$isStarted) {
            return true;
        }

        if (session_status() === PHP_SESSION_ACTIVE) {
            self::$isStarted = true;

            return true;
        }

        session_start();
        self::$isStarted = true;

        return true;
    }

    public static function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public static function get(string $key, $default = null): mixed
    {
        if (self::has($key)) {
            return $_SESSION[$key];
        }

        return $default;
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function clear(): void
    {
        $_SESSION = [];
    }

    public static function all()
    {
        return $_SESSION;
    }

    public static function remove(string $key): void
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }
}






