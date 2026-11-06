# README

## 1. Cara Instalasi

1. Clone repository:

   git clone URL_REPOSITORY

2. Masuk ke folder project:

   cd kelas-online

3. Install dependency:

   composer install

4. Salin file environment:

   cp .env.example .env

5. Buat database dengan nama `kelas_online`, lalu sesuaikan konfigurasi database di file `.env`.
6. Generate application key:

   php artisan key:generate

7. Jalankan migration dan seeder:

   php artisan migrate --seed

8. Jalankan aplikasi:

   php artisan serve

## 2. Akun Login Admin

- **Email:** admin@kelasonline.test
- **Password:** admin12345

## 3. Versi PHP dan Laravel

- **PHP:** 8.3
- **Laravel:** 13.40.0

## 4. Template yang Digunakan

- **Nama Template:** Nexora – SaaS & Digital Agency Bootstrap Theme
- **Framework CSS:** Bootstrap 5.3.3
- **Sumber:** ThemeWagon