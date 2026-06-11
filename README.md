# 🐾 RSHP UNAIR — Sistem Informasi Rumah Sakit Hewan Pendidikan

Sistem Informasi berbasis web untuk **Rumah Sakit Hewan Pendidikan Universitas Airlangga (RSHP UNAIR)**. Aplikasi ini mengelola alur pelayanan medis hewan peliharaan, mulai dari registrasi pemilik, pendaftaran antrian dokter, pemeriksaan perawat, diagnosa dokter, hingga akses riwayat medis oleh pemilik hewan.

---

## 📋 Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur](#fitur)
- [Teknologi](#teknologi)
- [Struktur Role Pengguna](#struktur-role-pengguna)
- [Alur Sistem](#alur-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi Database](#konfigurasi-database)
- [Struktur Database](#struktur-database)
- [Struktur Direktori](#struktur-direktori)
- [Screenshot](#screenshot)

---

## 📌 Tentang Proyek

RSHP UNAIR adalah sistem manajemen klinik hewan berbasis Laravel yang mendukung lima role pengguna dengan akses dan fungsi yang berbeda-beda. Sistem ini menggantikan proses manual dengan alur digital yang terintegrasi — dari pendaftaran pasien di loket hingga pencatatan rekam medis oleh dokter.

---

## ✨ Fitur

### 🔐 Autentikasi & Otorisasi
- Login multi-role berbasis database (`role_user`)
- Middleware `CheckRole` untuk proteksi route per role
- Redirect otomatis ke dashboard sesuai role setelah login
- Session management role aktif

### 👨‍💼 Administrator
- Manajemen User (tambah, edit, non-aktifkan)
- Manajemen Role & penempatan Role ke User
- Master data: Jenis Hewan, Ras Hewan, Kategori, Kategori Klinis
- Manajemen Tindakan & Terapi (kode tindakan medis)
- Manajemen data Pemilik dan Hewan Peliharaan (Pet)

### 🏥 Resepsionis
- Registrasi pemilik hewan baru (buat akun User + data Pemilik + Role Pemilik sekaligus)
- Registrasi hewan peliharaan baru (dengan dynamic dropdown Ras berdasarkan Jenis via AJAX)
- Manajemen antrian temu dokter harian
- Update status antrian (Menunggu → Diperiksa → Selesai)

### 🩺 Perawat
- Lihat daftar antrian pasien hari ini
- Input pemeriksaan awal: Anamnesa dan Temuan Klinis
- Update status pasien ke "Sedang Diperiksa" setelah input selesai

### 👨‍⚕️ Dokter
- Dashboard statistik pasien harian (menunggu, sedang diperiksa, selesai, total riwayat)
- Lihat catatan perawat (anamnesa & temuan klinis) sebelum memeriksa
- Input diagnosa dan memilih tindakan/terapi dari daftar kode tindakan
- Update status pasien ke "Selesai" setelah pemeriksaan

### 🐕 Pemilik
- Lihat jadwal temu dokter beserta status antrian hewan peliharaan
- Akses riwayat rekam medis lengkap
- Lihat detail rekam medis: diagnosa, tindakan/terapi yang dilakukan, nama dokter

---

## 🛠 Teknologi

| Komponen | Teknologi |
|---|---|
| Backend Framework | Laravel 11 |
| Frontend Styling | Tailwind CSS (Soft UI Dashboard) |
| Template Engine | Blade |
| Database | MySQL |
| Authentication | Laravel Auth (custom guard) |
| Query | Eloquent ORM + Query Builder |
| Package Manager | Composer, NPM |
| Build Tool | Vite |

---

## 👥 Struktur Role Pengguna

```
Administrator  →  Kelola seluruh master data & user
Resepsionis    →  Registrasi pemilik, pet, dan antrian dokter
Perawat        →  Input pemeriksaan awal (anamnesa & temuan klinis)
Dokter         →  Input diagnosa dan tindakan medis
Pemilik        →  Akses jadwal dan riwayat medis hewan
```

---

## 🔄 Alur Sistem

```
1. Resepsionis mendaftarkan Pemilik + Hewan Peliharaan
        ↓
2. Resepsionis membuat antrian Temu Dokter
        ↓
3. Perawat mengisi Anamnesa & Temuan Klinis → status: "Diperiksa"
        ↓
4. Dokter melihat catatan perawat, mengisi Diagnosa & Tindakan → status: "Selesai"
        ↓
5. Pemilik dapat melihat jadwal & riwayat rekam medis
```

---

## ⚙️ Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/username/rshp-unair.git
cd rshp-unair

# 2. Install dependency PHP
composer install

# 3. Install dependency JavaScript
npm install

# 4. Salin file environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Konfigurasi database di file .env (lihat bagian bawah)

# 7. Jalankan migrasi (jika menggunakan migrasi Laravel)
php artisan migrate

# 8. Build assets
npm run build

# 9. Jalankan server development
php artisan serve
```

---

## 🗄 Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rshp_unair
DB_USERNAME=root
DB_PASSWORD=
```

## 🗂 Struktur Database

### Tabel Utama

| Tabel | Primary Key | Keterangan |
|---|---|---|
| `user` | `iduser` | Data akun pengguna |
| `role` | `idrole` | Daftar role (Admin, Dokter, dll) |
| `role_user` | `idrole_user` | Relasi user ↔ role + status aktif |
| `pemilik` | `idpemilik` | Data pemilik hewan |
| `jenis_hewan` | `idjenis_hewan` | Master jenis hewan (Kucing, Anjing, dll) |
| `ras_hewan` | `idras_hewan` | Master ras hewan, FK ke `jenis_hewan` |
| `pet` | `idpet` | Data hewan peliharaan |
| `kategori` | `idkategori` | Kategori tindakan medis |
| `kategori_klinis` | `idkategori_klinis` | Kategori klinis (Tindakan/Terapi) |
| `kode_tindakan_terapi` | `idkode_tindakan_terapi` | Master kode tindakan & terapi |
| `temu_dokter` | `idreservasi_dokter` | Antrian/reservasi pasien ke dokter |
| `rekam_medis` | `idrekam_medis` | Rekam medis (anamnesa, temuan klinis, diagnosa) |
| `detail_rekam_medis` | `iddetail_rekam_medis` | Detail tindakan per rekam medis |

### Relasi Penting

```
user ─────────── role_user ─────────── role
  │
  └── pemilik
          │
          └── pet ─── ras_hewan ─── jenis_hewan
                │
                └── temu_dokter ──── role_user (dokter)
                          │
                          └── rekam_medis
                                    │
                                    └── detail_rekam_medis ── kode_tindakan_terapi
```

---

## 📁 Struktur Direktori

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Controller untuk role Administrator
│   │   ├── Resepsionis/    # Controller untuk role Resepsionis
│   │   ├── Dokter/         # Controller untuk role Dokter
│   │   ├── Perawat/        # Controller untuk role Perawat
│   │   ├── Pemilik/        # Controller untuk role Pemilik
│   │   ├── Auth/           # Controller autentikasi
│   │   └── Site/           # Controller halaman publik
│   └── Middleware/
│       └── CheckRole.php   # Middleware validasi role
├── Models/
│   ├── User.php
│   ├── Pemilik.php
│   ├── Pet.php
│   ├── RasHewan.php
│   ├── JenisHewan.php
│   ├── Role.php
│   ├── RoleUser.php
│   ├── Kategori.php
│   ├── KategoriKlinis.php
│   └── TindakanTerapi.php
resources/
└── views/
    ├── admin/              # View halaman admin
    ├── resepsionis/        # View halaman resepsionis
    ├── dokter/             # View halaman dokter
    ├── perawat/            # View halaman perawat
    ├── pemilik/            # View halaman pemilik
    ├── auth/               # View login & autentikasi
    ├── layouts/partial/    # Layout utama (sidebar, header, dll)
    └── site/               # View halaman publik
routes/
├── web.php                 # Semua route aplikasi
└── auth.php                # Route autentikasi
```

```
```
