<?php

declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', __DIR__);
define('WRITABLE_PATH', ROOT_PATH . '/writable');

foreach ([WRITABLE_PATH, WRITABLE_PATH . '/sessions'] as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
}

session_save_path(WRITABLE_PATH . '/sessions');
session_start();

require_once APP_PATH . '/Core/Controller.php';
require_once APP_PATH . '/Models/BaseModel.php';
require_once APP_PATH . '/Models/ArticleModel.php';
require_once APP_PATH . '/Models/FeedbackModel.php';
require_once APP_PATH . '/Controllers/AdminController.php';
require_once APP_PATH . '/Controllers/FeedbackController.php';

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function starts_with(string $value, string $needle): bool
{
    return substr($value, 0, strlen($needle)) === $needle;
}

function excerpt(?string $value, int $limit = 80): string
{
    $text = trim((string) $value);

    if (strlen($text) <= $limit) {
        return $text;
    }

    return substr($text, 0, $limit) . '...';
}

function app_base_path(): string
{
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
    $base = rtrim($script, '/');

    return $base === '' ? '/index.php' : $base;
}

function base_url(string $route = ''): string
{
    return app_base_path() . '?route=' . ltrim($route, '/');
}

function redirect(string $route): void
{
    header('Location: ' . base_url($route));
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function verify_csrf(): void
{
    $postedToken = $_POST['csrf_token'] ?? '';
    $sessionToken = $_SESSION['csrf_token'] ?? '';

    if (!$postedToken || !$sessionToken || !hash_equals($sessionToken, $postedToken)) {
        http_response_code(419);
        echo '419 - Token form tidak valid. Silakan kembali dan coba lagi.';
        exit;
    }
}

function flash(string $key, ?string $value = null): ?string
{
    if ($value !== null) {
        $_SESSION['flash'][$key] = $value;
        return null;
    }

    $message = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $message;
}

function old(string $field, ?string $default = ''): string
{
    return (string) ($_SESSION['old'][$field] ?? $default);
}

function keep_old(array $data): void
{
    $_SESSION['old'] = $data;
}

function clear_old(): void
{
    unset($_SESSION['old']);
}

function storage_path(): string
{
    return WRITABLE_PATH . '/storage.json';
}

function default_storage(): array
{
    $now = date('Y-m-d H:i:s');

    return [
        'next_article_id' => 3,
        'next_feedback_id' => 1,
        'articles' => [
            [
                'id' => 1,
                'title' => 'Artikel Pertama',
                'content' => 'Konten artikel contoh untuk memulai aplikasi.',
                'status' => 'published',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'title' => 'Catatan Draft',
                'content' => 'Artikel ini masih berstatus draft.',
                'status' => 'draft',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ],
        'feedback' => [],
    ];
}
