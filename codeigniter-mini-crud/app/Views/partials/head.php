<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'Admin Artikel') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background: #f6f7fb; }
        .sidebar { min-height: 100vh; background: #172033; }
        .sidebar a { color: #d7deeb; text-decoration: none; display: block; padding: .85rem 1rem; border-radius: .5rem; }
        .sidebar a:hover, .sidebar a.active { background: #263550; color: #fff; }
        .content-shell { min-height: 100vh; }
        .stat-card { border: 0; box-shadow: 0 10px 30px rgba(20, 31, 54, .08); }
        .form-error { color: #dc3545; font-size: .875rem; margin-top: .25rem; }
        .card { border-radius: .85rem; overflow: hidden; }
        .btn { border-radius: .6rem; }
        .table th { white-space: nowrap; }
        @media (max-width: 767.98px) {
            .sidebar { min-height: auto; }
            .content-shell { min-height: auto; }
        }
    </style>
</head>
<body>
