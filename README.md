# SuaraSiswa

**SuaraSiswa** adalah platform aspirasi digital yang dirancang untuk memfasilitasi komunikasi antara siswa dan pihak sekolah. Platform ini memungkinkan siswa untuk menyampaikan keluhan, saran, atau aspirasi secara transparan dan terkelola dengan baik.

## 🚀 Fitur Utama

* **Penyampaian Aspirasi**: Siswa dapat mengirimkan aspirasi dengan kategori yang relevan.
* **Manajemen Status**: Pelacakan status aspirasi (Pending, Diproses, Selesai).
* **Sistem Autentikasi**: Login dan registrasi terpisah untuk Siswa dan Admin.
* **Dashboard Admin**: Panel khusus untuk mengelola aspirasi yang masuk dan memberikan tanggapan.
* **Manajemen Profil**: Pengguna dapat memperbarui informasi akun secara mandiri.

## 🛠️ Stack Teknologi

* **Framework**: [Laravel 12](https://laravel.com)
* **Bahasa Pemrograman**: PHP 8.2+
* **Frontend**: Tailwind CSS & Vite
* **Database**: MySQL
* **Starter Kit**: Laravel Breeze (Blade)

## 💻 Panduan Instalasi

Pastikan Anda sudah menginstal **PHP**, **Composer**, **Node.js**, dan **MySQL** di perangkat Anda.

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/username/suarasiswa.git](https://github.com/username/suarasiswa.git)
    cd suarasiswa
    ```

2.  **Instal Dependensi PHP**
    ```bash
    composer install
    ```

3.  **Instal Dependensi Frontend**
    ```bash
    npm install && npm run build
    ```

4.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Migrasi Database**
    Jalankan migrasi untuk membuat tabel dan data awal (seeder).
    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Aplikasi**
    ```bash
    php artisan serve
    ```
    Akses aplikasi di `http://127.0.0.1:8000`.

## 📂 Struktur Folder Utama

* `app/Http/Controllers` - Logika utama aplikasi (Aspirasi, Profil, Auth).
* `app/Models` - Definisi skema data (Aspiration, Category, User).
* `resources/views` - File tampilan antarmuka (Blade templates).
* `routes/web.php` - Definisi rute navigasi aplikasi.
* `database/migrations` - Struktur tabel database.

