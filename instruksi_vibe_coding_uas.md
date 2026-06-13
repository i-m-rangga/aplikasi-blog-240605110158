# Instruksi Vibe Coding: Pengembangan Front-End CMS Blog (Laravel 11)

## Konteks Proyek Saat Ini
Proyek ini adalah "Sistem Manajemen Blog (CMS)" yang telah dibangun hingga tahap penyelesaian *back-end* (Modul 10).
- **Framework:** Laravel 11.
- **Status:** Fitur *back-end* (halaman administrator) sudah selesai. Autentikasi telah dikustomisasi menggunakan tabel `penulis` dan kolom `user_name`. Fitur CRUD untuk Kategori, Penulis, dan Artikel sudah berjalan dan dilindungi *middleware* `auth`.
- **Manajemen File:** Menggunakan Laravel Storage (`public/foto` untuk profil penulis, `public/gambar` untuk *cover* artikel).

## Aturan Sangat Ketat (PENTING!)
Saat men-generate kode, AI **WAJIB** mematuhi aturan berikut dan dilarang berasumsi di luar instruksi ini:
1. **TIDAK BOLEH MEMBUAT PROYEK BARU.** Lanjutkan modifikasi di proyek Laravel yang sudah ada (`aplikasi-blog`).
2. **TIDAK BOLEH MENGUBAH DATABASE.** Dilarang membuat *migration* baru, menambah/menghapus kolom, atau mengubah konfigurasi tabel. Gunakan skema yang sudah ada.
3. **PISAHKAN ARSITEKTUR:** - Buat **Controller baru khusus untuk pengunjung publik** (misalnya: `PublicController` atau `BlogController`). Jangan campur atau mengubah Controller admin (*Resource Controller* yang sudah ada).
   - Buat **Layout Blade baru khusus publik** (misalnya: `layouts.public` atau `layouts.front`). Jangan gunakan layout admin (`layouts.app`).
4. **TANPA AUTHENTICATION UNTUK PUBLIK:** Route untuk halaman pengunjung **TIDAK BOLEH** dilindungi oleh *middleware* `auth`. Harus dapat diakses tanpa login.

## Struktur Database & Model (Referensi AI)
Struktur Model sudah ada dan menggunakan relasi Eloquent (`hasMany`, `belongsTo`).
- **Tabel `penulis`** (Model: `Penulis`): `id`, `nama_depan`, `nama_belakang`, `user_name`, `password`, `foto`.
- **Tabel `kategori_artikel`** (Model: `KategoriArtikel`): `id`, `nama_kategori`, `keterangan`.
- **Tabel `artikel`** (Model: `Artikel`): `id`, `id_penulis`, `id_kategori`, `judul`, `isi`, `gambar`, `hari_tanggal`.

## Spesifikasi Tugas (Target Fitur)

### 1. Halaman Utama / Beranda (URL Publik)
- **Konten Utama:** Tampilkan **5 artikel terbaru** (diurutkan berdasarkan id/tanggal menurun). Setiap item (*card*) artikel harus menampilkan:
  - Gambar *cover* (menggunakan `asset('storage/gambar/nama_file')`).
  - Label Kategori.
  - Judul artikel.
  - Nama Penulis (gabungan `nama_depan` dan `nama_belakang`) & Tanggal.
  - Cuplikan isi artikel (gunakan helper `Str::limit()`).
  - Tombol atau *link* "Baca Selengkapnya".
- **Sidebar (Widget Kategori):** Tampilkan daftar Kategori Artikel.
- **Fitur Filter:** Jika pengunjung mengklik salah satu kategori di sidebar, area konten utama harus berubah untuk hanya menampilkan artikel dari kategori yang diklik tersebut.

### 2. Halaman Detail Artikel (URL: Detail Publik)
- **Konten Utama:** Menampilkan satu artikel secara utuh. Terdiri dari: Gambar sampul ukuran penuh, Judul besar, Label Kategori, Nama Penulis, Tanggal, dan `isi` artikel secara keseluruhan.
- **Sidebar (Artikel Terkait):** Menampilkan maksimal **5 artikel lain dari kategori yang sama** (*related articles*). Pastikan artikel yang sedang dibaca saat ini dieksklusi (tidak ikut muncul) dari daftar *widget* ini.

## Panduan Tampilan (UI/UX)
- Gunakan **Bootstrap 5** (melalui CDN) untuk mempercepat perancangan tata letak.
- Tampilan harus *clean*, *simple*, dan *elegant* dengan warna yang harmonis agar konsisten dengan nuansa CMS Admin yang sudah dibuat pada Modul 10.
