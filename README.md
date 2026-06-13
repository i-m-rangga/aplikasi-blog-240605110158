# Nusantara News — CMS Blog

> Proyek UAS Web Programming | Laravel 11

---

## 👤 Identitas Mahasiswa

| Keterangan   | Isi                        |
|--------------|----------------------------|
| **Nama Lengkap** | `[NAMA LENGKAP ANDA]`  |
| **NIM**          | `[NIM ANDA]`           |
| **Mata Kuliah**  | Web Programming            |
| **Semester**     | Genap 2024/2025            |

---

## 📝 Deskripsi Aplikasi

**Nusantara News** adalah aplikasi *Content Management System* (CMS) Blog berbasis **Laravel 11** yang dibangun sebagai tugas akhir (UAS) mata kuliah Web Programming.

Aplikasi ini terdiri dari dua bagian utama:

### 🔐 Panel Admin (Back-End)
Halaman khusus untuk penulis/administrator yang telah login. Fitur yang tersedia:
- **Autentikasi** — Login & logout menggunakan tabel `penulis` dengan kolom `user_name`.
- **Kelola Artikel** — CRUD artikel lengkap dengan upload gambar *cover*.
- **Kelola Kategori** — CRUD kategori artikel.
- **Kelola Penulis** — CRUD data penulis lengkap dengan upload foto profil.

### 🌐 Halaman Publik (Front-End)
Halaman yang dapat diakses siapa saja tanpa perlu login. Fitur yang tersedia:
- **Beranda** — Menampilkan 5 artikel terbaru dengan cuplikan isi.
- **Filter Kategori** — Klik kategori di sidebar untuk menyaring artikel.
- **Detail Artikel** — Membaca artikel secara lengkap.
- **Artikel Terkait** — Sidebar menampilkan artikel lain dari kategori yang sama.

---

## 🗄️ Struktur Database

| Tabel              | Kolom Utama                                                              |
|--------------------|--------------------------------------------------------------------------|
| `penulis`          | `id`, `nama_depan`, `nama_belakang`, `user_name`, `password`, `foto`    |
| `kategori_artikel` | `id`, `nama_kategori`, `keterangan`                                     |
| `artikel`          | `id`, `id_penulis`, `id_kategori`, `judul`, `isi`, `gambar`, `hari_tanggal` |

---

## 🚀 Langkah Menjalankan Aplikasi Secara Lokal

### Prasyarat
Pastikan komputer Anda sudah terinstal:
- PHP >= 8.2
- Composer
- MySQL
- (Opsional) XAMPP / Laragon

### 1. Clone Repositori
```bash
git clone https://github.com/rahmatrafii/web-programming-modul-10.git
cd web-programming-modul-10
```

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Salin File Konfigurasi Environment
```bash
cp .env.example .env
```

### 4. Konfigurasi Database
Buka file `.env` dan sesuaikan pengaturan berikut:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_blog
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Buat Database
Buat database baru bernama `db_blog` di MySQL/phpMyAdmin, lalu jalankan migrasi:
```bash
php artisan migrate
```

### 7. Buat Symbolic Link Storage
Agar gambar artikel dan foto penulis dapat diakses publik:
```bash
php artisan storage:link
```

### 8. (Opsional) Isi Data Awal
Jika ingin langsung mencoba dengan data contoh, gunakan Tinker:
```bash
php artisan tinker
```

### 9. Jalankan Server Lokal
```bash
php artisan serve
```

Aplikasi dapat diakses di: **http://127.0.0.1:8000**

| URL              | Keterangan              |
|------------------|-------------------------|
| `/`              | Halaman beranda publik  |
| `/artikel/{id}`  | Halaman detail artikel  |
| `/login`         | Login panel admin       |
| `/dashboard`     | Dashboard admin         |

### Akun Default Admin
Setelah seeder dijalankan, gunakan akun berikut untuk login:

| Username | Password   |
|----------|------------|
| `iqbal`  | `12345678` |

---

## 🎥 Video Demonstrasi

> Tonton demo lengkap aplikasi di YouTube:

**[🔗 Klik di sini untuk menonton video demonstrasi](https://youtu.be/LINK_VIDEO_YOUTUBE_ANDA)**

> ⚠️ *Ganti `LINK_VIDEO_YOUTUBE_ANDA` dengan URL video YouTube Anda.*

---

## 🛠️ Teknologi yang Digunakan

| Teknologi       | Versi / Keterangan         |
|-----------------|----------------------------|
| Laravel         | 11.x                       |
| PHP             | 8.2+                       |
| MySQL           | 8.x                        |
| Bootstrap       | 5.3 (via CDN)              |
| Bootstrap Icons | 1.11 (via CDN)             |
| Google Fonts    | Inter, Playfair Display    |
| Laravel Storage | Untuk manajemen file gambar |

---

## 📁 Struktur Direktori Penting

```
web-programming-modul-10/
├── app/
│   ├── Http/Controllers/
│   │   ├── PublicController.php       ← Controller halaman publik (baru)
│   │   ├── ArtikelController.php      ← CRUD artikel (admin)
│   │   ├── PenulisController.php      ← CRUD penulis (admin)
│   │   ├── KategoriArtikelController.php
│   │   └── LoginController.php
│   └── Models/
│       ├── Artikel.php
│       ├── KategoriArtikel.php
│       └── Penulis.php
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php             ← Layout admin
│   │   └── public.blade.php          ← Layout publik (baru)
│   └── public/
│       ├── beranda.blade.php          ← Halaman beranda publik (baru)
│       └── detail.blade.php           ← Halaman detail artikel publik (baru)
└── routes/
    └── web.php
```

---

*Dibuat dengan ❤️ menggunakan Laravel 11 & Bootstrap 5*
