# Inventory Management System

Project ini dibuat untuk tugas Mini Project 3 pada materi Relational Database dan Advanced PHP. Aplikasi digunakan untuk mencatat barang, supplier, kategori, serta transaksi stok masuk dan keluar.

## Fitur
- Login dan logout dengan role admin/staff
- Data kategori, produk, dan supplier
- Relasi produk dengan supplier
- Transaksi stok masuk dan keluar beserta histori
- Pencarian, filter kategori, dan pengurutan produk
- Dashboard dan laporan stok
- Prepared statement, validasi input, output escaping, password hashing, CSRF token, dan transaksi database

## Cara menjalankan
1. Ekstrak folder `inventory-app` ke folder `htdocs` XAMPP.
2. Jalankan Apache dan MySQL dari XAMPP Control Panel.
3. Buka phpMyAdmin melalui `http://localhost/phpmyadmin`.
4. Pilih menu **Import**, lalu pilih file `database/schema.sql` dari folder project.
5. Jika username atau password MySQL kamu berbeda, sesuaikan pengaturan di `config/database.php`.
6. Buka `http://localhost/inventory-app/public/`.
7. Login dengan akun awal berikut:
   - Username: `admin`
   - Password: `password`

## Catatan
- Ganti password akun awal setelah berhasil login.
- Akun staff dapat dibuat dari menu **Pengguna** oleh admin.
- Barang keluar tidak dapat melebihi stok yang tersedia.
- Produk yang sudah memiliki histori transaksi tidak dapat dihapus supaya catatan stok tetap aman.
- Project ini dibuat untuk pembelajaran dan masih bisa dikembangkan lagi sesuai kebutuhan tugas.
