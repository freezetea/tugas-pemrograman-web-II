<?php require APP_PATH . '/Views/partials/head.php'; ?>
<div class="container-fluid">
    <div class="row">
        <?php require APP_PATH . '/Views/partials/side_nav.php'; ?>
        <main class="col-md-9 col-xl-10 content-shell p-4">
            <div class="mb-4">
                <p class="text-muted mb-1">Masukan pengguna</p>
                <h2 class="mb-0">Feedback Pengguna</h2>
            </div>

            <div class="row g-3">
                <?php if (!$feedback): ?>
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada feedback.</div>
                    </div>
                <?php endif; ?>

                <?php foreach ($feedback as $item): ?>
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-3">
                                    <div>
                                        <h5 class="mb-1"><?= e($item['name']) ?></h5>
                                        <p class="text-muted small mb-0"><?= e($item['email']) ?></p>
                                    </div>
                                    <span class="text-muted small"><?= e($item['created_at']) ?></span>
                                </div>
                                <p class="mt-3 mb-0"><?= nl2br(e($item['message'])) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
<?php require APP_PATH . '/Views/partials/footer.php'; ?>

