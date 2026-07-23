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

## 🎨 Kustomisasi Tampilan

### Menambahkan Logo Website

Untuk menambahkan logo kecil di website:

1. **Siapkan file logo**
   - Siapkan file logo dalam format PNG, JPG, atau SVG
   - Ukuran yang disarankan: 100x100 pixel atau 150x150 pixel
   - Beri nama file yang mudah diingat, misalnya `logo.png`

2. **Tempatkan file logo**
   - Buat folder baru di dalam folder `public` jika belum ada:
     ```
     public/
     └── images/
         └── logo.png
     ```
   - Atau bisa juga ditempatkan langsung di folder `public/`:
     ```
     public/
     └── logo.png
     ```

3. **Edit file view untuk menampilkan logo**
   
   Buka file view yang ingin ditambahkan logo, misalnya:
   - `resources/views/welcome.blade.php` (landing page)
   - `resources/views/student/dashboard.blade.php` (dashboard mahasiswa)
   - `resources/views/admin/dashboard.blade.php` (dashboard admin)
   
   Cari bagian navbar atau header, lalu tambahkan tag img:
   ```html
   <nav class="navbar">
       <div style="display: flex; align-items: center; gap: 1rem;">
           <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 50px; height: 50px;">
           <h1>🏛️ Sistem Pengaduan Asrama</h1>
       </div>
       <div class="nav-links">
           <!-- menu links -->
       </div>
   </nav>
   ```

4. **Jika logo ditempatkan langsung di folder public:**
   ```html
   <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 50px; height: 50px;">
   ```

5. **Sesuaikan ukuran logo**
   - Ubah nilai `width` dan `height` sesuai kebutuhan
   - Contoh ukuran yang umum:
     - Kecil: 30x30 atau 40x40 pixel
     - Sedang: 50x50 atau 60x60 pixel
     - Besar: 80x80 atau 100x100 pixel

6. **Terapkan ke semua view**
   - Ulangi langkah 3 untuk semua file view yang ingin ditambahkan logo:
     - `resources/views/student/dashboard.blade.php`
     - `resources/views/student/create-complaint.blade.php`
     - `resources/views/student/history.blade.php`
     - `resources/views/student/show-complaint.blade.php`
     - `resources/views/admin/dashboard.blade.php`
     - `resources/views/admin/complaints.blade.php`
     - `resources/views/admin/show-complaint.blade.php`
     - `resources/views/admin/students.blade.php`
     - `resources/views/admin/reports.blade.php`

### Mengubah Warna Tema

Buka file view yang ingin diubah (misalnya `resources/views/student/dashboard.blade.php`) dan cari bagian CSS:

```css
.navbar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
```

Ganti kode warna hex (`#667eea`, `#764ba2`) dengan warna yang diinginkan.

### Mengubah Logo/Ikon

Cari emoji atau ikon di file view dan ganti dengan emoji lain:
- 🏛️ untuk logo asrama
- 📝 untuk pengaduan
- 👥 untuk mahasiswa
- dll.

### Mengubah Teks

Cari teks yang ingin diubah di file view dan ganti sesuai kebutuhan. Contoh di `resources/views/welcome.blade.php`:

```html
<h1>🏛️ Sistem Pengaduan Asrama</h1>
<p>Universitas Daharmas Indonesia</p>
```

Ganti dengan nama institusi Anda.

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
