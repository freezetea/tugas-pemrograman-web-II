# Mini CRUD Artikel CodeIgniter-style

Aplikasi mini PHP dengan pola MVC seperti CodeIgniter untuk CRUD artikel, form feedback, validasi form, partial layout, dan SweetAlert2.

## Struktur penting

- `public/index.php` - front controller.
- `app/Controllers` - controller admin dan feedback.
- `app/Models` - model artikel dan feedback.
- `app/Views/partials` - `head.php`, `side_nav.php`, `footer.php`.
- `app/Views/admin` - halaman dashboard, artikel, dan feedback.
- `writable/storage.json` - penyimpanan data lokal otomatis dibuat saat aplikasi pertama kali dibuka.

## Menjalankan dengan PHP CLI

Pastikan PHP aktif, lalu jalankan:

```bash
cd codeigniter-mini-crud
php -S localhost:8080 -t public
```

Buka:

- Admin: `http://localhost:8080/?route=admin`
- Feedback publik: `http://localhost:8080/?route=feedback`

## Menjalankan dengan XAMPP

Jika perintah `php` belum masuk PATH, gunakan PHP dari XAMPP:

```bat
C:\xampp\php\php.exe -S localhost:8080 -t C:\Users\Jimmy\OneDrive\Documents\website\codeigniter-mini-crud\public
```

Atau copy folder `codeigniter-mini-crud` ke `C:\xampp\htdocs`, start Apache, lalu buka:

- Admin: `http://localhost/codeigniter-mini-crud/public/?route=admin`
- Feedback publik: `http://localhost/codeigniter-mini-crud/public/?route=feedback`
