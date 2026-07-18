<?php
$isEdit = $article !== null;
$selectedStatus = old('status', $article['status'] ?? 'draft');
require APP_PATH . '/Views/partials/head.php';
?>
<div class="container-fluid">
    <div class="row">
        <?php require APP_PATH . '/Views/partials/side_nav.php'; ?>
        <main class="col-md-9 col-xl-10 content-shell p-4">
            <div class="mb-4">
                <p class="text-muted mb-1">Artikel</p>
                <h2 class="mb-0"><?= e($title) ?></h2>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="<?= e($action) ?>" method="post" novalidate>
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label" for="title">Judul</label>
                            <input class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" id="title" name="title" value="<?= e(old('title', $article['title'] ?? '')) ?>" required>
                            <?php if (isset($errors['title'])): ?>
                                <div class="form-error"><?= e($errors['title']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="content">Konten</label>
                            <textarea class="form-control" id="content" name="content" rows="7"><?= e(old('content', $article['content'] ?? '')) ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select <?= isset($errors['status']) ? 'is-invalid' : '' ?>" id="status" name="status" required>
                                <option value="">Pilih status</option>
                                <option value="draft" <?= $selectedStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
                                <option value="published" <?= $selectedStatus === 'published' ? 'selected' : '' ?>>Published</option>
                            </select>
                            <?php if (isset($errors['status'])): ?>
                                <div class="form-error"><?= e($errors['status']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-primary" type="submit"><?= $isEdit ? 'Simpan Perubahan' : 'Simpan Artikel' ?></button>
                            <a class="btn btn-outline-secondary" href="<?= base_url('admin/articles') ?>">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
<?php require APP_PATH . '/Views/partials/footer.php'; ?>
