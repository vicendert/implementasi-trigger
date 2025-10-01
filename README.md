# 🎯 Sistem Absensi Karyawan

> Aplikasi web berbasis Laravel untuk pengelolaan data karyawan dan absensi dengan sistem trigger otomatis

## 📋 Daftar Isi

- [Tentang Aplikasi](#-tentang-aplikasi)
- [Fitur Utama](#-fitur-utama)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Panduan Setup Windows](#-panduan-setup-windows)
- [Setup Database](#-setup-database)
- [Cara Menjalankan Aplikasi](#-cara-menjalankan-aplikasi)
- [Entity Relationship Diagram (ERD)](#-entity-relationship-diagram-erd)
- [Software Development Life Cycle (SDLC)](#-software-development-life-cycle-sdlc)
- [Flowchart Sistem](#-flowchart-sistem)
- [Login Credentials](#-login-credentials)
- [Struktur Database](#-struktur-database)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Troubleshooting](#-troubleshooting)

---

## 🚀 Tentang Aplikasi

Sistem Absensi Karyawan adalah aplikasi web yang dirancang untuk memudahkan pengelolaan data karyawan dan pencatatan kehadiran. Aplikasi ini mengimplementasikan sistem trigger database untuk otomatisasi reset ID auto-increment ketika data terakhir dihapus.

### ✨ Highlight Features
- **🔐 Role-Based Authentication** - Sistem login dengan role Admin dan Employee
- **🎯 Auto-Increment Management** - Reset otomatis ID ketika data terakhir dihapus
- **📊 ID Management Tools** - Tools untuk mengelola ID database secara manual
- **🎨 Modern UI/UX** - Interface responsif dengan Bootstrap 5 dan animasi CSS
- **🛡️ CSRF Protection** - Perlindungan keamanan Laravel yang lengkap

---

## 🌟 Fitur Utama

### 👥 Manajemen Karyawan
- ✅ **CRUD Operations** - Create, Read, Update, Delete data karyawan
- ✅ **Validasi NIK Unik** - Sistem validasi nomor induk karyawan
- ✅ **Auto-Reset ID** - Reset otomatis ID ketika karyawan terakhir dihapus
- ✅ **Manual ID Management** - Tools untuk reset manual auto-increment ID
- ✅ **Bulk Delete** - Hapus semua data dan reset ID sekaligus

### 📅 Manajemen Absensi
- ✅ **Multi-Status Support** - Hadir, Izin, Sakit, Alpha
- ✅ **Date Tracking** - Pencatatan tanggal kehadiran
- ✅ **Notes System** - Keterangan tambahan untuk setiap absensi
- ✅ **Employee Linking** - Relasi dengan data karyawan
- ✅ **ID Management** - Tools pengelolaan ID yang sama seperti karyawan

### 🔐 Sistem Autentikasi
- ✅ **Role-Based Access** - Admin dan Employee dengan hak akses berbeda
- ✅ **Secure Login** - Hash password dan session management
- ✅ **Change Password** - Fitur ganti password untuk semua user
- ✅ **Access Control** - Middleware untuk kontrol akses halaman

### 🎨 User Interface
- ✅ **Responsive Design** - Kompatibel dengan desktop dan mobile
- ✅ **Modern Bootstrap 5** - UI framework terkini
- ✅ **Font Awesome Icons** - Icon set yang lengkap
- ✅ **Smooth Animations** - Transisi dan animasi yang halus
- ✅ **Gradient Themes** - Tema warna gradien yang menarik

---

## 💻 Persyaratan Sistem

### Minimum Requirements (Windows)
- **OS**: Windows 10/11
- **PHP**: 8.1 atau lebih tinggi
- **MySQL**: 5.7 atau lebih tinggi
- **Web Server**: Apache (via XAMPP)
- **Memory**: 4GB RAM
- **Storage**: 1GB ruang kosong

### Recommended Requirements
- **OS**: Windows 11
- **PHP**: 8.2+
- **MySQL**: 8.0+
- **Memory**: 8GB RAM
- **Storage**: 2GB ruang kosong

---

## 🛠️ Panduan Setup Windows

### Langkah 1: Install XAMPP

1. **Download XAMPP**
   ```
   https://www.apachefriends.org/download.html
   ```
   - Pilih versi PHP 8.1+ untuk Windows

2. **Install XAMPP**
   - Jalankan installer sebagai Administrator
   - Install di lokasi default: `C:\xampp`
   - Centang komponen: Apache, MySQL, PHP, phpMyAdmin

3. **Start Services**
   - Buka XAMPP Control Panel
   - Start Apache dan MySQL
   - Pastikan status keduanya "Running" (hijau)

### Langkah 2: Install Composer

1. **Download Composer**
   ```
   https://getcomposer.org/Composer-Setup.exe
   ```

2. **Install Composer**
   - Jalankan installer
   - Pilih PHP executable: `C:\xampp\php\php.exe`
   - Ikuti proses instalasi hingga selesai

3. **Verifikasi Installation**
   ```powershell
   composer --version
   ```

### Langkah 3: Install Git (Opsional)

1. **Download Git**
   ```
   https://git-scm.com/download/win
   ```

2. **Install Git**
   - Gunakan setting default
   - Pilih "Use Git from Windows Command Prompt"

---

## 🗄️ Setup Database

### Langkah 1: Akses phpMyAdmin

1. **Buka Browser**
   ```
   http://localhost/phpmyadmin
   ```

2. **Login ke phpMyAdmin**
   - Username: `root`
   - Password: (kosong)

### Langkah 2: Buat Database

1. **Klik "New" di sidebar kiri**
2. **Buat database baru**
   - Database name: `implementasi_trigger`
   - Collation: `utf8mb4_general_ci`
3. **Klik "Create"**

### Langkah 3: Setup Project

1. **Clone/Download Project**
   ```powershell
   # Jika menggunakan Git
   cd C:\xampp\htdocs
   git clone https://github.com/vicendert/implementasi-trigger.git
   
   # Atau extract ZIP file ke C:\xampp\htdocs\implementasi-trigger
   ```

2. **Install Dependencies**
   ```powershell
   cd C:\xampp\htdocs\implementasi-trigger
   composer install
   ```

3. **Setup Environment**
   ```powershell
   # Copy file environment
   copy .env.example .env
   
   # Generate application key
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   - Edit file `.env`
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=implementasi_trigger
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan Migration & Seeder**
   ```powershell
   # Jalankan migration
   php artisan migrate
   
   # Jalankan seeder untuk data sample
   php artisan db:seed
   ```

---

## 🚀 Cara Menjalankan Aplikasi

### Method 1: Laravel Development Server (Recommended)

1. **Buka Terminal/Command Prompt**
   ```powershell
   cd C:\xampp\htdocs\implementasi-trigger
   ```

2. **Start Laravel Server**
   ```powershell
   php artisan serve
   ```

3. **Akses Aplikasi**
   ```
   http://localhost:8000
   ```

### Method 2: XAMPP Virtual Host

1. **Edit hosts file**
   - File: `C:\Windows\System32\drivers\etc\hosts`
   - Tambahkan: `127.0.0.1 absensi.local`

2. **Konfigurasi Virtual Host**
   - File: `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
   ```apache
   <VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs/implementasi-trigger/public"
       ServerName absensi.local
       <Directory "C:/xampp/htdocs/implementasi-trigger/public">
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

3. **Restart Apache** dan akses `http://absensi.local`

---

## 📊 Entity Relationship Diagram (ERD)

### Database Schema

```sql
-- Tabel Users (untuk autentikasi)
users
├── id (Primary Key, Auto Increment)
├── name (VARCHAR, NOT NULL)
├── email (VARCHAR, UNIQUE, NOT NULL)
├── password (VARCHAR, NOT NULL)
├── role (ENUM: 'admin', 'employee')
├── created_at (TIMESTAMP)
└── updated_at (TIMESTAMP)

-- Tabel Karyawan (data karyawan)
karyawan
├── id (Primary Key, Auto Increment)
├── nama (VARCHAR, NOT NULL)
├── nik (VARCHAR, UNIQUE, NOT NULL)
├── jabatan (VARCHAR, NOT NULL)
├── alamat (TEXT, NOT NULL)
├── created_at (TIMESTAMP)
└── updated_at (TIMESTAMP)

-- Tabel Absensi (data kehadiran)
absensi
├── id (Primary Key, Auto Increment)
├── karyawan_id (Foreign Key → karyawan.id)
├── tanggal (DATE, NOT NULL)
├── status (ENUM: 'hadir', 'izin', 'sakit', 'alpha')
├── keterangan (TEXT, NULLABLE)
├── created_at (TIMESTAMP)
└── updated_at (TIMESTAMP)
```

### Relationships
- **One to Many**: `karyawan` → `absensi`
- **Foreign Key**: `absensi.karyawan_id` references `karyawan.id`

### Database Triggers (Implementasi Trigger)

```sql
-- Trigger untuk reset auto-increment karyawan
DELIMITER //
CREATE TRIGGER reset_karyawan_auto_increment 
AFTER DELETE ON karyawan
FOR EACH ROW
BEGIN
    DECLARE max_id INT DEFAULT 0;
    SELECT COALESCE(MAX(id), 0) INTO max_id FROM karyawan;
    IF max_id = 0 THEN
        ALTER TABLE karyawan AUTO_INCREMENT = 1;
    END IF;
END//
DELIMITER ;

-- Trigger untuk reset auto-increment absensi
DELIMITER //
CREATE TRIGGER reset_absensi_auto_increment 
AFTER DELETE ON absensi
FOR EACH ROW
BEGIN
    DECLARE max_id INT DEFAULT 0;
    SELECT COALESCE(MAX(id), 0) INTO max_id FROM absensi;
    IF max_id = 0 THEN
        ALTER TABLE absensi AUTO_INCREMENT = 1;
    END IF;
END//
DELIMITER ;
```

---

## 📋 Software Development Life Cycle (SDLC)

### 1. 📊 Planning Phase
- **Analisis Kebutuhan**: Sistem absensi digital untuk menggantikan pencatatan manual
- **Tujuan**: Efisiensi pengelolaan data karyawan dan absensi
- **Scope**: Web application dengan fitur CRUD dan autentikasi

### 2. 🎯 Analysis Phase
- **Functional Requirements**:
  - Manajemen data karyawan (CRUD)
  - Pencatatan absensi (CRUD) 
  - Sistem autentikasi berbasis role
  - Auto-increment management dengan trigger
- **Non-Functional Requirements**:
  - Response time < 2 detik
  - UI responsif untuk desktop dan mobile
  - Keamanan data dengan Laravel security features

### 3. 🏗️ Design Phase
- **Database Design**: ERD dengan 3 tabel utama (users, karyawan, absensi)
- **UI/UX Design**: Bootstrap 5 dengan tema modern dan gradien
- **Architecture**: MVC pattern dengan Laravel framework
- **Security Design**: Middleware, CSRF protection, password hashing

### 4. 💻 Implementation Phase
- **Backend**: Laravel 10 dengan PHP 8.1+
- **Frontend**: Blade templates + Bootstrap 5 + Font Awesome
- **Database**: MySQL dengan trigger implementation
- **Features**: Role-based access, auto-increment management, modern UI

### 5. 🧪 Testing Phase
- **Unit Testing**: Model dan Controller testing
- **Integration Testing**: Database relationship testing
- **User Acceptance Testing**: End-to-end feature testing
- **Security Testing**: Authentication dan authorization testing

### 6. 🚀 Deployment Phase
- **Environment**: XAMPP untuk development
- **Configuration**: Environment variables, database setup
- **Documentation**: Comprehensive setup guide dan user manual

---

## 🔄 Flowchart Sistem

### 1. Autentikasi Flow
```
Start → Login Page → Validate Credentials → Role Check → Admin/Employee Dashboard
```

### 2. Manajemen Karyawan Flow
```
Dashboard → Karyawan List → [Add/Edit/Delete/ID Management] → Validation → Database Update → Success/Error Response
```

### 3. Manajemen Absensi Flow
```
Dashboard → Absensi List → [Add/Edit/Delete/ID Management] → Validation → Database Update → Success/Error Response
```

### 4. Auto-Increment Reset Flow
```
Delete Action → Check if Last Record → Trigger Execution → Auto-Increment Reset → Confirmation
```

---

## 🔑 Login Credentials

### Default Admin Account
```
Email: admin@example.com
Password: password
Role: Admin
```

### Default Employee Account
```
Email: employee@example.com  
Password: password
Role: Employee
```

### Sample Employee Data
- **Karyawan 1**: John Doe (NIK: 123456789)
- **Karyawan 2**: Jane Smith (NIK: 987654321)

---

## 🗃️ Struktur Database

### Migrations yang Tersedia

1. **2014_10_12_000000_create_users_table.php**
   - Tabel autentikasi pengguna
   - Fields: id, name, email, password, role

2. **2024_09_22_042538_create_karyawans_table.php**
   - Tabel master data karyawan
   - Fields: id, nama, nik, jabatan, alamat

3. **2024_09_22_143616_create_absensis_table.php**
   - Tabel data absensi
   - Fields: id, karyawan_id, tanggal, status, keterangan

### Seeders yang Tersedia

1. **AdminSeeder.php**
   - Data admin dan employee default
   - Password terenkripsi dengan bcrypt

2. **KaryawanSeeder.php**
   - Data sample karyawan untuk testing
   - NIK unik untuk setiap karyawan

---

## ⚙️ Teknologi yang Digunakan

### Backend Framework
- **Laravel 10** - PHP framework dengan fitur lengkap
- **PHP 8.1+** - Programming language
- **MySQL 8.0** - Relational database
- **Composer** - Dependency manager

### Frontend Technologies
- **Blade Templates** - Laravel templating engine
- **Bootstrap 5** - CSS framework
- **Font Awesome 6** - Icon library
- **jQuery** - JavaScript library

### Development Tools
- **XAMPP** - Local development environment
- **Git** - Version control system
- **VS Code** - Code editor (recommended)

### Security Features
- **CSRF Protection** - Laravel built-in CSRF
- **Password Hashing** - bcrypt algorithm
- **Session Management** - File-based sessions
- **SQL Injection Prevention** - Eloquent ORM protection

---

## 🔧 Troubleshooting

### ❌ Masalah Umum & Solusi

#### 1. Error "Class 'App\Http\Controllers\KaryawanController' not found"
```powershell
# Regenerate autoload files
composer dump-autoload
```

#### 2. CSRF Token Mismatch
```powershell
# Clear cache dan session
php artisan cache:clear
php artisan session:flush
```

#### 3. Database Connection Error
- Pastikan MySQL service running di XAMPP
- Cek konfigurasi database di file `.env`
- Pastikan database `implementasi_trigger` sudah dibuat

#### 4. Laravel Server Error 500
```powershell
# Check error logs
php artisan log:clear
# Set debug mode
# Edit .env: APP_DEBUG=true
```

#### 5. Composer Install Gagal
- Pastikan PHP 8.1+ terinstall
- Pastikan internet connection stabil
- Jalankan: `composer clear-cache`

#### 6. Route Not Found (404 Error)
```powershell
# Clear route cache
php artisan route:clear
# Restart development server
php artisan serve
```

### 🆘 Kontak Support

Jika mengalami masalah yang tidak ada di troubleshooting guide:

1. **Check Documentation**: Baca ulang setup guide ini
2. **Check Laravel Logs**: `storage/logs/laravel.log`
3. **Check Error Messages**: Enable debug mode di `.env`
4. **Community Support**: Laravel Indonesia Facebook Group

---

## 📄 Lisensi

Aplikasi ini dikembangkan untuk keperluan edukasi dan dapat digunakan secara bebas.

---

## 🚀 Kontribusi

Aplikasi ini merupakan implementasi sistem absensi karyawan dengan fokus pada implementasi database trigger untuk auto-increment management. Dikembangkan sebagai studi kasus SDLC lengkap dari planning hingga deployment.

### Key Learning Points:
- ✅ Laravel MVC Architecture
- ✅ Database Triggers Implementation  
- ✅ Role-Based Authentication
- ✅ Modern UI/UX with Bootstrap 5
- ✅ CRUD Operations dengan validasi
- ✅ Auto-Increment Management System

---

**Happy Coding! 🎉**

> Dibuat dengan ❤️ menggunakan Laravel Framework
