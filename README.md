# Laravel Blog - Content Management System

![Laravel](https://img.shields.io/badge/Laravel-11.x-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange?style=flat-square&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

Sistem manajemen blog modern yang dibangun dengan Laravel 11, dilengkapi dengan fitur CRUD lengkap, authentication, dan landing page yang responsif.

## 📋 Deskripsi

Laravel Blog adalah aplikasi web Content Management System (CMS) yang memungkinkan pengguna untuk membuat, mengelola, dan mempublikasikan artikel blog dengan mudah. Aplikasi ini dilengkapi dengan dashboard admin yang intuitif dan landing page yang menarik untuk menampilkan artikel yang telah dipublikasikan.

## ✨ Fitur Utama

### 🔐 Authentication
- ✅ Register & Login System
- ✅ Session Management
- ✅ Logout dengan konfirmasi SweetAlert
- ✅ Password Strength Indicator
- ✅ Remember Me functionality

### 📝 Content Management
- ✅ **CRUD Content Lengkap** (Create, Read, Update, Delete)
- ✅ **Multi-section Content** dengan nomor urut
- ✅ **Upload Multiple Images** dengan preview
- ✅ **Image Caption/Description** untuk setiap gambar
- ✅ **Auto-generate Slug** dari judul
- ✅ **Status Management** (Draft/Publish)
- ✅ **Rich Text Editor** untuk penulisan content

### 🌐 Landing Page
- ✅ **Homepage** dengan grid layout modern
- ✅ **Search Functionality** untuk mencari artikel
- ✅ **Blog Detail Page** dengan layout yang menarik
- ✅ **Share Buttons** (Facebook, Twitter, WhatsApp)
- ✅ **Responsive Design** untuk semua device
- ✅ **Author Information** dan tanggal publikasi

### 🎨 UI/UX Features
- ✅ Modern & Clean Interface
- ✅ Responsive Design (Mobile, Tablet, Desktop)
- ✅ SweetAlert2 untuk notifikasi
- ✅ Loading States & Animations
- ✅ Dynamic Avatar Generation (UI Avatars API)
- ✅ Gradient Color Schemes
- ✅ Bootstrap 5 Components

## 🛠️ Tech Stack

### Backend
- **Laravel** 12.x - PHP Framework
- **MySQL** 8.0+ - Database
- **PHP** 8.4+ - Programming Language

### Frontend
- **Bootstrap** 5.3 - CSS Framework
- **Font Awesome** 6.4 - Icon Library
- **SweetAlert2** - Beautiful Alerts
- **Vanilla JavaScript** - Interactivity

### Tools & Libraries
- **Composer** - Dependency Manager
- **NPM/Yarn** - Package Manager
- **Laravel Mix/Vite** - Asset Bundling
- **UI Avatars API** - Avatar Generation

## 📸 Screenshots

### Dashboard
![Dashboard](screenshots/dashboard.png)

### Create Content
![Create Content](screenshots/create-content.png)

### Landing Page
![Landing Page](screenshots/landing-page.png)

### Blog Detail
![Blog Detail](screenshots/blog-detail.png)

## 📦 Instalasi

### Requirements
- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM (optional)

### Step-by-Step Installation

1. **Clone Repository**
```bash
git clone https://github.com/abdullatip/laravel-blog.git
cd laravel-blog
```

2. **Install Dependencies**
```bash
composer install
```

3. **Copy Environment File**
```bash
cp .env.example .env
```

4. **Generate Application Key**
```bash
php artisan key:generate
```

5. **Configure Database**

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_blog
DB_USERNAME=root
DB_PASSWORD=your_password
```

6. **Run Migrations**
```bash
php artisan migrate
```

7. **Create Storage Link**
```bash
php artisan storage:link
```

8. **Seed Database (Optional)**
```bash
php artisan db:seed
```

9. **Run Development Server**
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## ⚙️ Konfigurasi

### File Upload Configuration

Edit `config/filesystems.php` jika diperlukan:
```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
],
```

### Session Configuration

Edit `config/session.php`:
```php
'lifetime' => 120, // Session lifetime in minutes
'expire_on_close' => false,
```

## 🚀 Penggunaan

### Register & Login
Akun dumy
-Email: admin@gmail.com
-Password: password123 

1. Akses halaman utama: `http://localhost:8000`
2. Klik tombol **"Register"** untuk membuat akun baru
3. Isi form registrasi dengan data yang valid
4. Login menggunakan email dan password yang telah didaftarkan

### Membuat Content Baru

1. Login ke dashboard
2. Klik menu **"Manajemen Content"**
3. Klik tombol **"Tambah Content"**
4. Isi informasi dasar:
   - Judul Content
   - Status (Draft/Publish)
5. Tambah bagian content:
   - Nomor urut
   - Subjudul (opsional)
   - Isi/Deskripsi
   - Upload gambar
   - Deskripsi gambar
6. Klik **"Tambah Bagian Content"** untuk menambah section baru
7. Klik **"Simpan Content"**

### Edit & Delete Content

1. Pada halaman **Manajemen Content**, klik:
   - **👁️ Icon View** untuk melihat detail
   - **✏️ Icon Edit** untuk mengedit
   - **🗑️ Icon Delete** untuk menghapus (dengan konfirmasi)

### Melihat Landing Page

1. Klik menu **"Lihat Website"** di sidebar
2. Atau akses langsung: `http://localhost:8000`
3. Landing page akan menampilkan semua artikel dengan status **"Publish"**

## 📁 Struktur Project

```
laravel-blog/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── ContentController.php
│   │       └── LandingController.php
│   └── Models/
│       ├── User.php
│       ├── Content.php
│       ├── Gambar.php
│       └── IsiContent.php
├── database/
│   └── migrations/
│       ├── xxxx_create_users_table.php
│       ├── xxxx_create_contents_table.php
│       ├── xxxx_create_gambars_table.php
│       └── xxxx_create_isi_contents_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   └── landing.blade.php
│       ├── contents/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── landing/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       └── auth/
│           ├── login.blade.php
│           └── register.blade.php
├── routes/
│   └── web.php
├── public/
│   └── storage/ (symlink)
└── storage/
    └── app/
        └── public/
            └── gambars/ (uploaded images)
```

## 🗃️ Database Schema

### Tables

#### `users`
- id (PK)
- name
- email (unique)
- password
- email_verified_at
- remember_token
- timestamps

#### `contents`
- id (PK)
- judul
- slug (unique)
- user_id (FK → users)
- status (enum: draft, publish)
- timestamps

#### `gambars`
- id (PK)
- path
- description
- content_id (FK → contents)
- timestamps

#### `isi_contents`
- id (PK)
- nomor
- subjudul
- isi
- gambar_id (FK → gambars)
- content_id (FK → contents)
- timestamps

## 🔒 Security Features

- ✅ CSRF Protection
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ XSS Protection
- ✅ Password Hashing (bcrypt)
- ✅ Authentication Middleware
- ✅ Input Validation
- ✅ File Upload Validation

## 🐛 Troubleshooting

### Storage Link Error
```bash
php artisan storage:link
```

### Migration Error
```bash
php artisan migrate:fresh
```

### Cache Issues
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Permission Issues (Linux/Mac)
```bash
chmod -R 755 storage bootstrap/cache
```

## 🤝 Contributing

Contributions, issues, dan feature requests sangat diterima!

1. Fork repository ini
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Abdul Latip**
- NIM: C2383207029
- GitHub: [@abdullatip](https://github.com/abdullatip)
- Email: abdullatip@example.com

## 🙏 Acknowledgments

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com)
- [Font Awesome Icons](https://fontawesome.com)
- [SweetAlert2](https://sweetalert2.github.io)
- [UI Avatars API](https://ui-avatars.com)

## 📞 Support

Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan:
- 🐛 [Open an Issue](https://github.com/abdullatip/laravel-blog/issues)
- 💬 Contact via email

---

⭐ **Jika project ini membantu Anda, jangan lupa berikan Star!** ⭐

Made with ❤️ by Abdul Latip
