# Sistem Pembayaran PLN - Laravel Application

Selamat datang di **Sistem Pembayaran PLN**!  
Aplikasi ini dirancang untuk memudahkan pengelolaan pembayaran listrik, mulai dari pencatatan pelanggan, pemakaian listrik, hingga proses pembayaran.  
Tersedia fitur lengkap dengan dua role utama: **Admin** dan **Petugas Loket**, sehingga pengelolaan data menjadi lebih terstruktur dan efisien.

## ✨ Fitur Utama

- **Manajemen Pelanggan**: Tambah, edit, dan lihat data pelanggan.
- **Pencatatan Pemakaian**: Rekam penggunaan listrik tiap pelanggan setiap bulan.
- **Hitung Otomatis Biaya**: Sistem otomatis menghitung biaya berdasarkan tarif yang berlaku.
- **Role-Based Access**:
  - **Admin**: Kelola petugas loket dan kontrol penuh terhadap sistem.
  - **Petugas Loket**: Mengelola transaksi pembayaran pelanggan.
- **Cetak Rekening**: Fitur untuk mencetak dokumen rekening listrik pelanggan.
- **Dashboard Interaktif**: Statistik penggunaan listrik dan pembayaran.

---

## 🚀 Installation & Setup Guide

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan aplikasi ini:

### 1. Unzip Project
Ekstrak file project ke dalam folder pilihan Anda.

### 2. Duplicate Environment File
Salin file `.env.example` dan ubah namanya menjadi `.env`.

```bash
cp .env.example .env
```
### 3. Install PHP Dependencies

```bash
composer install
```

### 4.Install JavaScript Dependencies

```bash
npm install
npm run build
```
### 5. Generate key

```bash
php artisan key:generate
```
### 6. Run Migration

```bash
php artisan migrate
```
### 7. Seeding database

```bash
php artisan db:seed
```
### 8. Start Server

```bash
php artisan serve
```

### Acount 
username = admin@gmail.com
🔐 password = admin123

