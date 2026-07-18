<?php require APP_PATH . '/Views/partials/head.php'; ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <p class="text-muted mb-1">Form pengguna</p>
                    <h1 class="h2 mb-0">Kirim Feedback</h1>
                </div>
                <a class="btn btn-outline-secondary" href="<?= base_url('admin') ?>">Admin</a>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="<?= base_url('feedback/store') ?>" method="post" novalidate>
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label" for="name">Nama</label>
                            <input class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= e(old('name')) ?>" required>
                            <?php if (isset($errors['name'])): ?>
                                <div class="form-error"><?= e($errors['name']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" type="email" value="<?= e(old('email')) ?>" required>
                            <?php if (isset($errors['email'])): ?>
                                <div class="form-error"><?= e($errors['email']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="message">Pesan</label>
                            <textarea class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>" id="message" name="message" rows="5" required><?= e(old('message')) ?></textarea>
                            <?php if (isset($errors['message'])): ?>
                                <div class="form-error"><?= e($errors['message']) ?></div>
                            <?php endif; ?>
                        </div>

                        <button class="btn btn-primary w-100" type="submit">Kirim Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$success = flash('success');
$error = flash('error');
?>
<script>
const successMessage = <?= json_encode($success) ?>;
const errorMessage = <?= json_encode($error) ?>;

if (successMessage) {
    Swal.fire({ icon: 'success', title: 'Berhasil', text: successMessage, timer: 1800, showConfirmButton: false });
}

if (errorMessage) {
    Swal.fire({ icon: 'error', title: 'Gagal', text: errorMessage });
}
</script>
</body>
</html>
