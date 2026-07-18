<?php $current = trim($_GET['route'] ?? 'admin', '/'); ?>
<aside class="col-md-3 col-xl-2 sidebar p-3">
    <h1 class="h4 text-white mb-4">Admin Artikel</h1>
    <nav class="d-grid gap-2">
        <a class="<?= $current === 'admin' ? 'active' : '' ?>" href="<?= base_url('admin') ?>">Dashboard</a>
        <a class="<?= starts_with($current, 'admin/articles') ? 'active' : '' ?>" href="<?= base_url('admin/articles') ?>">Daftar Artikel</a>
        <a class="<?= $current === 'admin/articles/create' ? 'active' : '' ?>" href="<?= base_url('admin/articles/create') ?>">Tambah Artikel</a>
        <a class="<?= $current === 'admin/feedback' ? 'active' : '' ?>" href="<?= base_url('admin/feedback') ?>">Feedback</a>
        <a href="<?= base_url('feedback') ?>">Form Feedback</a>
    </nav>
</aside>
