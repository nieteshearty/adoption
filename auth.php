<?php
session_start();

function users_data_file()
{
    return __DIR__ . '/users_data.json';
}

function load_users()
{
    $file = users_data_file();
    if (!file_exists($file)) {
        $default = [
            'admin' => [
                'password' => 'admin123',
                'role' => 'admin',
            ],
        ];
        save_users($default);
        return $default;
    }

    $json = file_get_contents($file);
    $data = json_decode($json, true);
    if (!is_array($data)) {
        $data = [];
    }
    return $data;
}

function save_users(array $users)
{
    $file = users_data_file();
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

function current_user()
{
    return $_SESSION['user'] ?? null;
}

function is_logged_in()
{
    return current_user() !== null;
}

function is_admin()
{
    $user = current_user();
    return $user && ($user['role'] ?? '') === 'admin';
}

function require_login()
{
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function require_admin()
{
    if (!is_admin()) {
        header('Location: login.php');
        exit;
    }
}
