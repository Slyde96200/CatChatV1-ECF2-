<?php


class Session
{

    public static function isConnected(): bool
    {
        return !empty($_SESSION['connected']);
    }

    public static function connect(array $user)
    {
        $_SESSION['connected'] = true;
        $_SESSION['user'] = $user;
    }


    public static function disconnect()
    {
        $_SESSION['connected'] = false;
        $_SESSION['user'] = null;
    }


    public static function addFlash(string $type, string $message)
    {
        if (empty($_SESSION['messages'])) {
            $_SESSION['messages'] = [
                'error' => [],
                'success' => [],
            ];
        }
        $_SESSION['messages'][$type][] = $message;
    }


    public static function getFlashes(string $type): array
    {
        if (empty($_SESSION['messages'])) {
            return [];
        }

        $messages = $_SESSION['messages'][$type];

        $_SESSION['messages'][$type] = [];

        return $messages;
    }


    public static function hasFlashes(string $type): bool
    {
        if (empty($_SESSION['messages'])) {
            return false;
        }

        return !empty($_SESSION['messages'][$type]);
    }


    public static function isActualUser(int $user_id)
    {
        if (!self::isConnected()) {
            return false;
        }

        return $user_id == $_SESSION['user']['id'];
    }

    public static function updateUser(array $user)
    {
        $_SESSION['user'] = $user;
    }

    public static function getUser(): ?array
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }
}
