<?php

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        require APP_PATH . '/Views/' . $view . '.php';
    }

    protected function validateArticle(array $input): array
    {
        $errors = [];
        $title = trim($input['title'] ?? '');
        $status = trim($input['status'] ?? '');

        if ($title === '') {
            $errors['title'] = 'Judul wajib diisi.';
        } elseif (strlen($title) < 3) {
            $errors['title'] = 'Judul minimal 3 karakter.';
        }

        if ($status === '') {
            $errors['status'] = 'Status wajib dipilih.';
        } elseif (!in_array($status, ['draft', 'published'], true)) {
            $errors['status'] = 'Status tidak valid.';
        }

        return $errors;
    }

    protected function validateFeedback(array $input): array
    {
        $errors = [];
        $name = trim($input['name'] ?? '');
        $email = trim($input['email'] ?? '');
        $message = trim($input['message'] ?? '');

        if ($name === '') {
            $errors['name'] = 'Nama wajib diisi.';
        } elseif (strlen($name) < 3) {
            $errors['name'] = 'Nama minimal 3 karakter.';
        }

        if ($email === '') {
            $errors['email'] = 'Email wajib diisi.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Format email tidak valid.';
        }

        if ($message === '') {
            $errors['message'] = 'Pesan wajib diisi.';
        } elseif (strlen($message) < 10) {
            $errors['message'] = 'Pesan minimal 10 karakter.';
        }

        return $errors;
    }
}
