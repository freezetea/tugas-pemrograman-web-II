<?php require APP_PATH . '/Views/partials/head.php'; ?>
<div class="container-fluid">
    <div class="row">
        <?php require APP_PATH . '/Views/partials/side_nav.php'; ?>
        <main class="col-md-9 col-xl-10 content-shell p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <p class="text-muted mb-1">Manajemen konten</p>
                    <h2 class="mb-0">Daftar Artikel</h2>
                </div>
                <a class="btn btn-primary" href="<?= base_url('admin/articles/create') ?>">Tambah Artikel</a>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Diperbarui</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!$articles): ?>
                                <tr><td colspan="4" class="text-center text-muted py-4">Belum ada artikel.</td></tr>
                            <?php endif; ?>
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <td>
                                        <strong><?= e($article['title']) ?></strong>
                                        <div class="text-muted small"><?= e(excerpt($article['content'] ?? '', 80)) ?></div>
                                    </td>
                                    <td>
                                        <span class="badge text-bg-<?= $article['status'] === 'published' ? 'success' : 'secondary' ?>">
                                            <?= e(ucfirst($article['status'])) ?>
                                        </span>
                                    </td>
                                    <td><?= e($article['updated_at']) ?></td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-outline-primary" href="<?= base_url('admin/articles/edit&id=' . $article['id']) ?>">Edit</a>
                                        <form class="delete-form d-inline" action="<?= base_url('admin/articles/delete&id=' . $article['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
<?php require APP_PATH . '/Views/partials/footer.php'; ?>
