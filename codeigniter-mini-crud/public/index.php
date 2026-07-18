<?php

require_once __DIR__ . '/../app/bootstrap.php';

$route = trim($_GET['route'] ?? 'admin', '/');
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$admin = new AdminController();
$feedback = new FeedbackController();

if ($method === 'POST') {
    verify_csrf();
}

if ($method === 'GET' && $route === 'admin') {
    $admin->dashboard();
    exit;
}

if ($method === 'GET' && $route === 'admin/articles') {
    $admin->articles();
    exit;
}

if ($method === 'GET' && $route === 'admin/articles/create') {
    $admin->createArticle();
    exit;
}

if ($method === 'POST' && $route === 'admin/articles/store') {
    $admin->storeArticle();
    exit;
}

if ($method === 'GET' && $route === 'admin/articles/edit') {
    $admin->editArticle($id);
    exit;
}

if ($method === 'POST' && $route === 'admin/articles/update') {
    $admin->updateArticle($id);
    exit;
}

if ($method === 'POST' && $route === 'admin/articles/delete') {
    $admin->deleteArticle($id);
    exit;
}

if ($method === 'GET' && $route === 'admin/feedback') {
    $admin->feedback();
    exit;
}

if ($method === 'GET' && $route === 'feedback') {
    $feedback->form();
    exit;
}

if ($method === 'POST' && $route === 'feedback/store') {
    $feedback->store();
    exit;
}

http_response_code(404);
echo '404 - Halaman tidak ditemukan.';
