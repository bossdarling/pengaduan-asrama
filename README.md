# Sistem Informasi Pengaduan Berbasis Web di Asrama Universitas Daharmas Indonesia

Sistem pengaduan berbasis web untuk memudahkan mahasiswa asrama melaporkan masalah dan memantau status penyelesaiannya secara real-time.

## 📋 Deskripsi Proyek

Sistem ini dibangun untuk skripsi dengan judul "RANCANG BANGUN SISTEM INFORMASI PENGADUAN BERBASIS WEB DI ASRAMA UNIVERSITAS DAHARMAS INDONESIA". Sistem ini memungkinkan:

- **Mahasiswa**: Membuat pengaduan, melihat riwayat, dan memantau status penyelesaian
- **Admin**: Mengelola pengaduan, menyetujui pendaftaran mahasiswa, dan membuat laporan

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: HTML, CSS, JavaScript (Vanilla)
- **Database**: MySQL
- **PDF Generation**: barryvdh/laravel-dompdf
- **Authentication**: Laravel Auth System

## 📁 Struktur Proyek

```
pengaduan_asrama/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php      # Login, Register, Logout
│   │   │   ├── StudentController.php  # Dashboard, Pengaduan, Riwayat
│   │   │   └── AdminController.php    # Dashboard, Pengaduan, Mahasiswa, Laporan
│   │   └── Middleware/
│   │       ├── IsAdmin.php            # Middleware untuk admin
│   │       └── IsStudent.php          # Middleware untuk mahasiswa
│   └── Models/
│       ├── User.php                   # Model user (mahasiswa & admin)
│       ├── Category.php              # Model kategori pengaduan
│       └── Complaint.php              # Model pengaduan
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_07_05_171455_create_categories_table.php
│   │   └── 2026_07_05_171455_create_complaints_table.php
│   └── seeders/
│       ├── AdminSeeder.php           # Seeder akun admin
│       └── CategorySeeder.php       # Seeder kategori pengaduan
├── resources/
│   └── views/
│       ├── welcome.blade.php         # Halaman landing page
│       ├── auth/
│       │   ├── login.blade.php       # Halaman login
│       │   └── register.blade.php    # Halaman pendaftaran
│       ├── student/
│       │   ├── dashboard.blade.php   # Dashboard mahasiswa
│       │   ├── create-complaint.blade.php  # Form buat pengaduan
│       │   ├── history.blade.php     # Riwayat pengaduan
│       │   └── show-complaint.blade.php   # Detail pengaduan
│       └── admin/
│           ├── dashboard.blade.php   # Dashboard admin
│           ├── complaints.blade.php  # Kelola pengaduan
│           ├── show-complaint.blade.php   # Detail & proses pengaduan
│           ├── students.blade.php    # Kelola mahasiswa
│           ├── reports.blade.php     # Laporan
│           └── pdf-report.blade.php  # Template PDF
├── routes/
│   └── web.php                       # Routing aplikasi
├── public/
│   └── storage/                      # File upload pengaduan
└── .env                             # Konfigurasi environment
```

## 🚀 Cara Menjalankan Aplikasi

### 1. Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- MySQL/MariaDB
- XAMPP (jika menggunakan Windows)
- Web browser (Chrome, Firefox, dll)

### 2. Instalasi

1. **Clone atau download project**
   ```bash
   cd C:\xampp\htdocs\pengaduan_asrama
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Konfigurasi Database**
   
   Buka file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pengaduan_asrama
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Buat Database**
   
   Buka phpMyAdmin (http://localhost/phpmyadmin) dan buat database dengan nama `pengaduan_asrama`

5. **Jalankan Migrations**
   ```bash
   php artisan migrate
   ```

6. **Jalankan Seeders** (untuk membuat akun admin dan kategori)
   ```bash
   php artisan db:seed --class=AdminSeeder
   php artisan db:seed --class=CategorySeeder
   ```

7. **Link Storage** (untuk file upload)
   ```bash
   php artisan storage:link
   ```

8. **Jalankan Server**
   ```bash
   php artisan serve
   ```

9. **Buka Aplikasi**
   
   Buka browser dan akses: http://localhost:8000

## 👤 Akun Default

### Admin
- **Email**: admin@asrama.ac.id
- **Password**: admin123

### Mahasiswa
- Daftar melalui halaman pendaftaran
- Menunggu persetujuan admin sebelum bisa login

## 📱 Fitur Aplikasi

### Fitur Mahasiswa
1. **Dashboard**: Melihat statistik pengaduan
2. **Buat Pengaduan**: 
   - Pilih kategori (Kebersihan, Keamanan, Fasilitas, dll)
   - Isi keterangan
   - Upload foto sebagai bukti
3. **Riwayat Pengaduan**: Melihat semua pengaduan yang telah dibuat
4. **Detail Pengaduan**: Melihat detail dan respon admin
5. **Logout**: Keluar dari sistem

### Fitur Admin
1. **Dashboard**: Melihat statistik pengaduan dan mahasiswa
2. **Kelola Pengaduan**:
   - Lihat semua pengaduan yang masuk
   - Filter berdasarkan status, kategori, dan tanggal
   - Lihat detail pengaduan
   - Update status (Menunggu → Dalam Proses → Selesai)
   - Berikan respon/tindakan
3. **Kelola Mahasiswa**:
   - Lihat daftar mahasiswa yang mendaftar
   - Setujui pendaftaran mahasiswa
   - Tolak/Hapus mahasiswa
4. **Laporan**:
   - Lihat statistik pengaduan
   - Filter berdasarkan rentang waktu
   - Download laporan dalam format PDF

## 🎨 Panduan Lengkap Kustomisasi Tampilan

Panduan ini akan membantu Anda mengubah warna, teks, logo, dan tampilan website tanpa merusak fungsionalitas sistem. Semua perubahan dilakukan dengan mengedit file view (`.bladeade.php`) di folder `resources/views/`.

### 📁 Daftar File View yang Bisa Dikustomisasi

Berikut adalah semua file view yang ada di sistem:

**Halaman Publik:**
- `resources/views/welcome.blade.php` - Landing page/beranda

**Halaman Auth:**
- `resources/views/auth/login.blade.php` - Halaman login
- `resources/views/auth/register.blade.php` - Halaman pendaftaran

**Halaman Mahasiswa:**
- `resources/views/student/dashboard.blade.php` - Dashboard mahasiswa
- `resources/views/student/create-complaint.blade.php` - Form buat pengaduan
- `resources/views/student/history.blade.php` - Riwayat pengaduan
- `resources/views/student/show-complaint.blade.php` - Detail pengaduan

**Halaman Admin:**
- `resources/views/admin/dashboard.blade.php` - Dashboard admin
- `resources/views/admin/complaints.blade.php` - Kelola pengaduan
- `resources/views/admin/show-complaint.blade.php` - Detail & proses pengaduan
- `resources/views/admin/students.blade.php` - Kelola mahasiswa
- `resources/views/admin/reports.blade.php` - Laporan
- `resources/views/admin/pdf-report.blade.php` - Template PDF

---

### 🎨 Mengubah Warna Tema Utama

Warna tema utama sistem menggunakan gradient ungu-biru (`#667eea` ke `#764ba2`). Berikut cara mengubahnya:

#### 1. Mengubah Warna Navbar (Header)

Buka file view yang ingin diubah, cari bagian CSS `.navbar`:

```css
.navbar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
```

**Contoh perubahan warna:**
- **Biru Laut:** `linear-gradient(135deg, #0077b6 0%, #00b4d8 100%)`
- **Hijau:** `linear-gradient(135deg, #2d6a4f 0%, #40916c 100%)`
- **Merah:** `linear-gradient(135deg, #d00000 0%, #dc2f02 100%)`
- **Oranye:** `linear-gradient(135deg, #f48c06 0%, #e85d04 100%)`
- **Hitam:** `linear-gradient(135deg, #212529 0%, #343a40 100%)`

#### 2. Mengubah Warna Footer

Cari bagian CSS `.footer`:

```css
.footer {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
```

Ganti dengan warna yang sama dengan navbar agar konsisten, atau warna berbeda sesuai keinginan.

#### 3. Mengubah Warna Tombol Primary

Cari bagian CSS `.btn-primary`:

```css
.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}
```

**Tips:** Ubah juga `box-shadow` dengan warna yang sesuai (rgba dari warna utama dengan opacity 0.3).

#### 4. Mengubah Warna Tombol Secondary

Cari bagian CSS `.btn-secondary`:

```css
.btn-secondary {
    background: white;
    color: #667eea;
    border: 2px solid #667eea;
}
```

Ganti `#667eea` dengan warna tema utama Anda.

#### 5. Mengubah Warna Hero Section (Landing Page)

Buka `resources/views/welcome.blade.php`, cari bagian CSS `.hero`:

```css
.hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 6rem 2rem;
    text-align: center;
}
```

#### 6. Mengubah Warna Stat Card (Dashboard)

Ada beberapa jenis stat card dengan warna berbeda:

```css
/* Primary - Ungu */
.stat-card.primary .stat-card-icon { 
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
}
.stat-card.primary .number { color: #667eea; }

/* Warning - Oranye */
.stat-card.warning .stat-card-icon { 
    background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%); 
}
.stat-card.warning .number { color: #f59e0b; }

/* Info - Biru */
.stat-card.info .stat-card-icon { 
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); 
}
.stat-card.info .number { color: #3b82f6; }

/* Success - Hijau */
.stat-card.success .stat-card-icon { 
    background: linear-gradient(135deg, #10b981 0%, #059669 100%); 
}
.stat-card.success .number { color: #10b981; }

/* Danger - Merah (hanya admin) */
.stat-card.danger .stat-card-icon { 
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); 
}
.stat-card.danger .number { color: #ef4444; }

/* Purple - Ungu (hanya admin) */
.stat-card.purple .stat-card-icon { 
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); 
}
.stat-card.purple .number { color: #8b5cf6; }
```

#### 7. Mengubah Warna Status Badge

Cari bagian CSS `.complaint-status`:

```css
/* Pending - Kuning */
.complaint-status.pending {
    background: #fef3c7;
    color: #d97706;
}

/* In Progress - Biru */
.complaint-status.in_progress {
    background: #dbeafe;
    color: #2563eb;
}

/* Completed - Hijau */
.complaint-status.completed {
    background: #d1fae5;
    color: #059669;
}
```

---

### 📝 Mengubah Teks dan Judul

#### 1. Mengubah Judul Website di Navbar

Cari bagian HTML navbar di setiap file view:

```html
<div class="navbar-brand">
    <span style="font-size: 2rem;">🏛️</span>
    <h1>Sistem Pengaduan Asrama</h1>
</div>
```

Ganti "Sistem Pengaduan Asrama" dengan nama website Anda.

#### 2. Mengubah Nama Universitas/Institusi

Di `resources/views/welcome.blade.php`:

```html
<h1>Sistem Pengaduan Asrama</h1>
<p>Universitas Daharmas Indonesia</p>
```

Di footer semua file view:

```html
<p>© {{ date('Y') }} Universitas Daharmas Indonesia</p>
<small>Sistem Pengaduan Asrama</small>
```

#### 3. Mengubah Teks Menu Navigasi

Di navbar, cari link navigasi dan ganti teksnya:

```html
<div class="nav-links">
    <a href="{{ route('student.dashboard') }}">Dashboard</a>
    <a href="{{ route('student.create-complaint') }}">Buat Pengaduan</a>
    <a href="{{ route('student.history') }}">Riwayat</a>
    <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
</div>
```

#### 4. Mengubah Teks di Landing Page

Buka `resources/views/welcome.blade.php` dan cari bagian yang ingin diubah:

**Hero Section:**
```html
<h1>Sistem Pengaduan Asrama</h1>
<p>Universitas Daharmas Indonesia</p>
<p style="font-size: 1rem; margin-top: 0.5rem;">Laporkan masalah asrama Anda dengan mudah, cepat, dan transparan</p>
```

**Fitur Section:**
```html
<div class="section-title">
    <h2>Fitur Unggulan</h2>
    <p>Sistem pengaduan asrama dengan berbagai fitur modern</p>
</div>
```

**About Section:**
```html
<h2>Tentang Sistem</h2>
<p>Sistem Pengaduan Asrama Universitas Daharmas Indonesia adalah platform digital...</p>
```

---

### 🧭 Lokasi Navbar dan Footer di Setiap File

Berikut adalah lokasi spesifik navbar dan footer di setiap file view untuk memudahkan Anda mengubahnya:

#### 1. Landing Page (`resources/views/welcome.blade.php`)

**Navbar (baris 356-368):**
```html
<nav class="navbar">
    <div class="navbar-brand">
        <span style="font-size: 2rem;">🏛️</span>
        <h1>Sistem Pengaduan Asrama</h1>
    </div>
    <div class="nav-links">
        <a href="#features">Fitur</a>
        <a href="#about">Tentang</a>
        <a href="#how-it-works">Cara Kerja</a>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Daftar</a>
    </div>
</nav>
```

**Footer (baris 480-506):**
```html
<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>🏛️ Sistem Pengaduan Asrama</h3>
            <p>Platform pengaduan asrama modern untuk Universitas Daharmas Indonesia</p>
        </div>
        <div class="footer-section">
            <h3>Navigasi</h3>
            <p><a href="#features">Fitur</a></p>
            <p><a href="#about">Tentang</a></p>
            <p><a href="#how-it-works">Cara Kerja</a></p>
        </div>
        <div class="footer-section">
            <h3>Akun</h3>
            <p><a href="{{ route('login') }}">Login</a></p>
            <p><a href="{{ route('register') }}">Daftar</a></p>
        </div>
        <div class="footer-section">
            <h3>Kontak</h3>
            <p>📧 admin@udh.ac.id</p>
            <p>📞 +62 xxx xxxx xxxx</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} Universitas Daharmas Indonesia. All rights reserved.</p>
    </div>
</footer>
```

#### 2. Login Page (`resources/views/auth/login.blade.php`)

**Navbar (baris 216-226):**
```html
<nav class="navbar">
    <div class="navbar-brand">
        <span style="font-size: 2rem;">🏛️</span>
        <h1>Sistem Pengaduan Asrama</h1>
    </div>
    <div class="nav-links">
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('register') }}">Daftar</a>
        <a href="{{ route('login') }}" style="opacity: 1; font-weight: 600;">Login</a>
    </div>
</nav>
```

**Footer (baris 269-295):**
```html
<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>🏛️ Sistem Pengaduan Asrama</h3>
            <p>Platform pengaduan asrama modern untuk Universitas Daharmas Indonesia</p>
        </div>
        <div class="footer-section">
            <h3>Navigasi</h3>
            <p><a href="{{ route('home') }}#features">Fitur</a></p>
            <p><a href="{{ route('home') }}#about">Tentang</a></p>
            <p><a href="{{ route('home') }}#how-it-works">Cara Kerja</a></p>
        </div>
        <div class="footer-section">
            <h3>Akun</h3>
            <p><a href="{{ route('login') }}">Login</a></p>
            <p><a href="{{ route('register') }}">Daftar</a></p>
        </div>
        <div class="footer-section">
            <h3>Kontak</h3>
            <p>📧 admin@udh.ac.id</p>
            <p>📞 +62 xxx xxxx xxxx</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} Universitas Daharmas Indonesia. All rights reserved.</p>
    </div>
</footer>
```

#### 3. Register Page (`resources/views/auth/register.blade.php`)

**Navbar dan Footer memiliki struktur yang sama dengan Login Page.**

#### 4. Halaman Mahasiswa (Dashboard, Create Complaint, History, Show Complaint)

**Navbar (contoh dari dashboard.blade.php baris 329-340):**
```html
<nav class="navbar">
    <div class="navbar-brand">
        <span style="font-size: 2rem;">🏛️</span>
        <h1>Sistem Pengaduan Asrama</h1>
    </div>
    <div class="nav-links">
        <a href="{{ route('student.dashboard') }}">Dashboard</a>
        <a href="{{ route('student.create-complaint') }}">Buat Pengaduan</a>
        <a href="{{ route('student.history') }}">Riwayat</a>
        <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
    </div>
</nav>
```

**Footer (contoh dari dashboard.blade.php baris 427-430):**
```html
<footer class="footer">
    <p>© {{ date('Y') }} Universitas Daharmas Indonesia</p>
    <small>Sistem Pengaduan Asrama</small>
</footer>
```

**Catatan:** Semua halaman mahasiswa memiliki navbar dan footer dengan struktur yang sama.

#### 5. Halaman Admin (Dashboard, Complaints, Show Complaint, Students, Reports)

**Navbar (contoh dari dashboard.blade.php baris 362-374):**
```html
<nav class="navbar">
    <div class="navbar-brand">
        <span style="font-size: 2rem;">🏛️</span>
        <h1>Sistem Pengaduan Asrama</h1>
    </div>
    <div class="nav-links">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.complaints') }}">Pengaduan</a>
        <a href="{{ route('admin.students') }}">Mahasiswa</a>
        <a href="{{ route('admin.reports') }}">Laporan</a>
        <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
    </div>
</nav>
```

**Footer (contoh dari dashboard.blade.php baris 493-496):**
```html
<footer class="footer">
    <p>© {{ date('Y') }} Universitas Daharmas Indonesia</p>
    <small>Sistem Pengaduan Asrama</small>
</footer>
```

**Catatan:** Semua halaman admin memiliki navbar dan footer dengan struktur yang sama.

---

### 🖼️ Menambahkan Logo Gambar

#### 1. Siapkan File Logo

- Format: PNG, JPG, atau SVG (PNG disarankan untuk transparansi)
- Ukuran: 100x100 pixel atau 150x150 pixel
- Background transparan (untuk PNG) agar terlihat profesional

#### 2. Tempatkan File Logo

Buat folder `images` di dalam folder `public` jika belum ada:

```
public/
└── images/
    └── logo.png
```

Atau tempatkan langsung di folder `public/`:
```
public/
└── logo.png
```

#### 3. Edit File View untuk Menampilkan Logo

Buka file view yang ingin ditambahkan logo (misalnya `resources/views/student/dashboard.blade.php`), cari bagian navbar:

```html
<div class="navbar-brand">
    <span style="font-size: 2rem;">🏛️</span>
    <h1>Sistem Pengaduan Asrama</h1>
</div>
```

Ganti emoji dengan tag gambar:

```html
<div class="navbar-brand">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 50px; height: 50px;">
    <h1>Sistem Pengaduan Asrama</h1>
</div>
```

**Jika logo di folder public langsung:**
```html
<img src="{{ asset('logo.png') }}" alt="Logo" style="width: 50px; height: 50px;">
```

#### 4. Sesuaikan Ukuran Logo

Ubah `width` dan `height` sesuai kebutuhan:
- Kecil: `width: 30px; height: 30px;`
- Sedang: `width: 50px; height: 50px;` (default)
- Besar: `width: 70px; height: 70px;`

#### 5. Terapkan ke Semua View

Ulangi langkah 3 untuk semua file view yang ingin ditambahkan logo. File yang perlu diubah:
- `resources/views/welcome.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/student/dashboard.blade.php`
- `resources/views/student/create-complaint.blade.php`
- `resources/views/student/history.blade.php`
- `resources/views/student/show-complaint.blade.php`
- `resources/views/admin/dashboard.blade.php`
- `resources/views/admin/complaints.blade.php`
- `resources/views/admin/show-complaint.blade.php`
- `resources/views/admin/students.blade.php`
- `resources/views/admin/reports.blade.php`

---

### 🎯 Mengubah Emoji/Ikon

Sistem menggunakan emoji sebagai ikon. Berikut daftar emoji yang digunakan:

| Lokasi | Emoji | Fungsi |
|--------|-------|--------|
| Navbar | 🏛️ | Logo asrama |
| Dashboard | 📊 | Total pengaduan |
| Dashboard | ⏳ | Menunggu |
| Dashboard | 🔄 | Dalam proses |
| Dashboard | ✅ | Selesai |
| Dashboard | 👥 | Mahasiswa |
| Dashboard | 🔔 | Notifikasi |
| Pengaduan | 📝 | Buat pengaduan |
| Upload | 📸 | Foto |
| Fitur | 🔒 | Keamanan |
| Fitur | 📱 | Responsive |

Untuk mengubah, cari emoji di file view dan ganti dengan emoji lain. Contoh:

```html
<span style="font-size: 2rem;">🏛️</span>  <!-- Ganti dengan emoji lain -->
```

**Website emoji:** https://emoji.copy/ untuk mencari emoji lain.

---

### 🔤 Mengubah Font

Font default sistem adalah 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif. Untuk mengubah:

Cari bagian CSS `body` di setiap file view:

```css
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f2f5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
```

Ganti dengan font lain:
- **Arial:** `'Arial', sans-serif`
- **Roboto:** `'Roboto', sans-serif` (perlu import Google Fonts)
- **Open Sans:** `'Open Sans', sans-serif` (perlu import Google Fonts)
- **Poppins:** `'Poppins', sans-serif` (perlu import Google Fonts)

**Untuk menggunakan Google Fonts:**
Tambahkan di bagian `<head>` sebelum `<style>`:

```html
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
```

Lalu ubah font-family:
```css
body {
    font-family: 'Poppins', sans-serif;
}
```

---

### 📐 Mengubah Ukuran dan Spacing

#### 1. Mengubah Padding Navbar

Cari bagian CSS `.navbar`:

```css
.navbar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 1rem 2rem;  /* Atur: atas/bawah kiri/kanan */
}
```

Nilai yang umum:
- Kecil: `padding: 0.5rem 1rem;`
- Sedang: `padding: 1rem 2rem;` (default)
- Besar: `padding: 1.5rem 3rem;`

#### 2. Mengubah Ukuran Font Judul

Cari bagian CSS `.navbar-brand h1`:

```css
.navbar-brand h1 {
    font-size: 1.5rem;  /* Ubah ukuran */
    font-weight: 700;
}
```

Nilai yang umum:
- Kecil: `font-size: 1rem;`
- Sedang: `font-size: 1.5rem;` (default)
- Besar: `font-size: 2rem;`

#### 3. Mengubah Ukuran Tombol

Cari bagian CSS `.btn`:

```css
.btn {
    padding: 0.85rem 1.75rem;  /* Atur padding */
    font-size: 0.95rem;       /* Atur ukuran font */
}
```

---

### 🌈 Mengubah Background Color

#### 1. Background Body

Cari bagian CSS `body`:

```css
body {
    background: #f0f2f5;  /* Warna background */
}
```

Warna yang umum:
- Putih: `#ffffff`
- Abu-abu terang: `#f8f9fa`
- Abu-abu: `#f0f2f5` (default)
- Biru sangat muda: `#e3f2fd`

#### 2. Background Card/Container

Cari bagian CSS untuk card:

```css
.stat-card, .card, .form-container {
    background: white;  /* Ganti dengan warna lain */
}
```

---

### 📱 Tips Kustomisasi yang Aman

1. **Backup File:** Sebelum mengedit, selalu backup file view yang akan diubah
2. **Satu per Satu:** Ubah satu elemen dulu, lalu test di browser sebelum lanjut
3. **Gunakan CSS Valid:** Pastikan kode warna hex valid (6 digit)
4. **Konsistensi:** Gunakan warna yang sama di semua halaman untuk tampilan profesional
5. **Responsive:** Jangan mengubah bagian CSS `@media` untuk mobile kecuali Anda paham
6. **Test di Browser:** Setelah mengedit, refresh browser untuk melihat perubahan

---

### 🎨 Contoh Skema Warna Lengkap

#### Skema Biru Laut
```css
/* Navbar & Footer */
background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);

/* Tombol Primary */
background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
color: white;
box-shadow: 0 4px 15px rgba(0, 119, 182, 0.3);

/* Tombol Secondary */
color: #0077b6;
border: 2px solid #0077b6;

/* Stat Cards */
.primary: #0077b6
.warning: #f48c06
.info: #00b4d8
.success: #2d6a4f
```

#### Skema Hijau
```css
/* Navbar & Footer */
background: linear-gradient(135deg, #2d6a4f 0%, #40916c 100%);

/* Tombol Primary */
background: linear-gradient(135deg, #2d6a4f 0%, #40916c 100%);
color: white;
box-shadow: 0 4px 15px rgba(45, 106, 79, 0.3);

/* Tombol Secondary */
color: #2d6a4f;
border: 2px solid #2d6a4f;

/* Stat Cards */
.primary: #2d6a4f
.warning: #f48c06
.info: #40916c
.success: #1b4332
```

#### Skema Merah
```css
/* Navbar & Footer */
background: linear-gradient(135deg, #d00000 0%, #dc2f02 100%);

/* Tombol Primary */
background: linear-gradient(135deg, #d00000 0%, #dc2f02 100%);
color: white;
box-shadow: 0 4px 15px rgba(208, 0, 0, 0.3);

/* Tombol Secondary */
color: #d00000;
border: 2px solid #d00000;

/* Stat Cards */
.primary: #d00000
.warning: #f48c06
.info: #dc2f02
.success: #2d6a4f
```

---

### ⚠️ Hal yang TIDAK BOLEH Diubah

Untuk menghindari error, JANGAN ubah:
1. **Blade Directives:** `{{ }}`, `{!! !!}`, `@if`, `@foreach`, `@csrf`, dll
2. **Route Names:** `route('student.dashboard')`, `route('login')`, dll
3. **Variable Names:** `{{ $user->name }}`, `{{ $totalComplaints }}`, dll
4. **Form Attributes:** `name="email"`, `name="password"`, dll
5. **CSS Class Names yang Terkait Logic:** Seperti class yang digunakan untuk JavaScript
6. **Struktur HTML Utama:** Jangan menghapus tag penting seperti `<form>`, `<nav>`, dll

Contoh yang TIDAK BOLEH diubah:
```html
<!-- JANGAN ubah ini -->
{{ route('student.dashboard') }}
{{ $user->name }}
@csrf
@if ($errors->any())
```

Contoh yang BOLEH diubah:
```html
<!-- BOLEH ubah teks ini -->
<h1>Sistem Pengaduan Asrama</h1>
<!-- BOLEH ubah warna ini -->
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
<!-- BOLEH ubah emoji ini -->
🏛️
```

## 📊 Database Schema

### Tabel Users
- `id`: Primary key
- `name`: Nama lengkap
- `email`: Email (unique)
- `password`: Password (hashed)
- `role`: 'admin' atau 'student'
- `nim`: Nomor Induk Mahasiswa
- `phone`: Nomor HP
- `dorm_name`: Nama asrama
- `room_number`: Nomor kamar
- `is_approved`: Status persetujuan (boolean)
- `timestamps`: Created at, Updated at

### Tabel Categories
- `id`: Primary key
- `name`: Nama kategori
- `timestamps`: Created at, Updated at

### Tabel Complaints
- `id`: Primary key
- `user_id`: Foreign key ke users
- `category_id`: Foreign key ke categories
- `description`: Keterangan pengaduan
- `photo`: Path foto bukti
- `status`: 'pending', 'in_progress', 'completed'
- `response`: Respon dari admin
- `timestamps`: Created at, Updated at

## � Mengganti Password/Username Admin

### Cara Mengganti Password Admin

Ada beberapa cara untuk mengganti password admin:

#### Metode 1: Menggunakan Tinker (Rekomendasi)

1. Buka terminal di folder project
2. Jalankan perintah:
   ```bash
   php artisan tinker
   ```
3. Ketik perintah berikut untuk mengganti password:
   ```php
   $admin = App\Models\User::where('email', 'admin@asrama.ac.id')->first();
   $admin->password = bcrypt('password_baru');
   $admin->save();
   ```
4. Keluar dari tinker dengan mengetik `exit`

#### Metode 2: Menggunakan Seeder

1. Buka file `database/seeders/AdminSeeder.php`
2. Ubah password di bagian ini:
   ```php
   \App\Models\User::create([
       'name' => 'Admin',
       'email' => 'admin@asrama.ac.id',
       'password' => bcrypt('password_baru'), // Ganti password di sini
       'role' => 'admin',
       'is_approved' => true,
   ]);
   ```
3. Jalankan seeder ulang:
   ```bash
   php artisan db:seed --class=AdminSeeder
   ```

#### Metode 3: Menggunakan phpMyAdmin

1. Buka phpMyAdmin (http://localhost/phpmyadmin)
2. Pilih database `pengaduan_asrama`
3. Buka tabel `users`
4. Cari baris dengan email `admin@asrama.ac.id`
5. Klik "Edit"
6. Di kolom `password`, masukkan password baru yang sudah di-hash
7. Untuk meng-hash password, gunakan fungsi bcrypt di PHP atau generate di https://bcrypt-generator.com/
8. Klik "Go" untuk menyimpan

### Cara Mengganti Username/Email Admin

#### Metode 1: Menggunakan Tinker

1. Buka terminal di folder project
2. Jalankan perintah:
   ```bash
   php artisan tinker
   ```
3. Ketik perintah berikut:
   ```php
   $admin = App\Models\User::where('email', 'admin@asrama.ac.id')->first();
   $admin->email = 'email_baru@domain.com';
   $admin->name = 'Nama Baru'; // Opsional: ganti nama juga
   $admin->save();
   ```
4. Keluar dari tinker dengan mengetik `exit`

#### Metode 2: Menggunakan Seeder

1. Buka file `database/seeders/AdminSeeder.php`
2. Ubah email dan nama:
   ```php
   \App\Models\User::create([
       'name' => 'Nama Baru', // Ganti nama
       'email' => 'email_baru@domain.com', // Ganti email
       'password' => bcrypt('admin123'),
       'role' => 'admin',
       'is_approved' => true,
   ]);
   ```
3. Jalankan seeder ulang:
   ```bash
   php artisan db:seed --class=AdminSeeder
   ```

#### Metode 3: Menggunakan phpMyAdmin

1. Buka phpMyAdmin (http://localhost/phpmyadmin)
2. Pilih database `pengaduan_asrama`
3. Buka tabel `users`
4. Cari baris dengan email `admin@asrama.ac.id`
5. Klik "Edit"
6. Ubah kolom `email` dan/atau `name`
7. Klik "Go" untuk menyimpan

### Tips Keamanan

- Gunakan password yang kuat (minimal 8 karakter, kombinasi huruf, angka, dan simbol)
- Jangan gunakan password yang mudah ditebak seperti "123456", "password", dll
- Ganti password secara berkala untuk keamanan
- Jangan berbagi kredensial admin dengan orang yang tidak berwenang

## �🔧 Troubleshooting

### Error "SQLSTATE[HY000] [2002] Connection refused"
Pastikan MySQL/XAMPP sudah berjalan. Buka XAMPP Control Panel dan start Apache dan MySQL.

### Error "Storage link failed"
Jalankan perintah:
```bash
php artisan storage:link
```

### Error "Class not found"
Jalankan:
```bash
composer install
php artisan clear-compiled
php artisan optimize
```

### Foto tidak muncul
Pastikan folder `storage/app/public/complaints` memiliki permission yang benar dan storage link sudah dibuat.

## 📝 Catatan untuk Skripsi

### Flow Pengaduan
1. Mahasiswa mendaftar → Menunggu persetujuan admin
2. Admin menyetujui → Mahasiswa bisa login
3. Mahasiswa membuat pengaduan → Status: Menunggu
4. Admin memproses → Status: Dalam Proses
5. Admin menyelesaikan → Status: Selesai

### Kategori Pengaduan Default
- Kebersihan
- Keamanan
- Fasilitas
- Lainnya

### Status Pengaduan
- **Pending**: Menunggu diproses admin
- **In Progress**: Sedang dalam proses penyelesaian
- **Completed**: Sudah selesai

## 🤝 Kontribusi

Proyek ini dibuat untuk keperluan skripsi. Jika ingin mengembangkan lebih lanjut:

1. Fork project
2. Buat branch baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buka Pull Request

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik (skripsi).

## 👨‍💻 Penulis

Dibuat untuk skripsi Sistem Informasi - Universitas Daharmas Indonesia

---

**Selamat mengerjakan skripsi! Semoga sukses! 🎓**
