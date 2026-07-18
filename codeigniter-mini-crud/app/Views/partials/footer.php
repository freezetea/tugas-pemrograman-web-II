<?php
$success = flash('success');
$error = flash('error');
?>
        </main>
    </div>
</div>
<script>
const successMessage = <?= json_encode($success) ?>;
const errorMessage = <?= json_encode($error) ?>;

if (successMessage) {
    Swal.fire({ icon: 'success', title: 'Berhasil', text: successMessage, timer: 1800, showConfirmButton: false });
}

if (errorMessage) {
    Swal.fire({ icon: 'error', title: 'Gagal', text: errorMessage });
}

document.querySelectorAll('.delete-form').forEach((form) => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Hapus data?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
</body>
</html>

