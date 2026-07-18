<?php require APP_PATH . '/Views/partials/head.php'; ?>
<div class="container-fluid">
    <div class="row">
        <?php require APP_PATH . '/Views/partials/side_nav.php'; ?>
        <main class="col-md-9 col-xl-10 content-shell p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <p class="text-muted mb-1">Ringkasan</p>
                    <h2 class="mb-0">Dashboard</h2>
                </div>
                <a class="btn btn-primary" href="<?= base_url('admin/articles/create') ?>">Tambah Artikel</a>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-1">Jumlah Artikel</p>
                            <h3 class="display-6 mb-0"><?= e((string) $articleCount) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-1">Jumlah Feedback</p>
                            <h3 class="display-6 mb-0"><?= e((string) $feedbackCount) ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-1">
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <strong>Artikel Terbaru</strong>
                            <a class="small text-decoration-none" href="<?= base_url('admin/articles') ?>">Lihat semua</a>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php if (!$latestArticles): ?>
                                <div class="list-group-item text-muted">Belum ada artikel.</div>
                            <?php endif; ?>
                            <?php foreach ($latestArticles as $article): ?>
                                <a class="list-group-item list-group-item-action d-flex justify-content-between gap-3" href="<?= base_url('admin/articles/edit&id=' . $article['id']) ?>">
                                    <span>
                                        <strong class="d-block"><?= e($article['title']) ?></strong>
                                        <small class="text-muted"><?= e(excerpt($article['content'] ?? '', 70)) ?></small>
                                    </span>
                                    <span class="badge align-self-start text-bg-<?= $article['status'] === 'published' ? 'success' : 'secondary' ?>">
                                        <?= e(ucfirst($article['status'])) ?>
                                    </span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <strong>Feedback Terbaru</strong>
                            <a class="small text-decoration-none" href="<?= base_url('admin/feedback') ?>">Lihat semua</a>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php if (!$latestFeedback): ?>
                                <div class="list-group-item text-muted">Belum ada feedback.</div>
                            <?php endif; ?>
                            <?php foreach ($latestFeedback as $item): ?>
                                <div class="list-group-item">
                                    <strong class="d-block"><?= e($item['name']) ?></strong>
                                    <small class="text-muted"><?= e($item['email']) ?></small>
                                    <p class="small mb-0 mt-2"><?= e(excerpt($item['message'], 90)) ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
<?php require APP_PATH . '/Views/partials/footer.php'; ?>
