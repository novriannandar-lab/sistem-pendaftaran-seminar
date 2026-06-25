# Sistem Pendaftaran Seminar Deforka 2026

Aplikasi web pendaftaran seminar berbasis PHP Native + MySQL dengan panel admin lengkap. Fitur upload bukti transfer, verifikasi pembayaran, export Excel, dan manajemen admin.

## ✨ Fitur Utama

### User / Pendaftar
- **Form pendaftaran** lengkap: data diri, universitas, prodi, kelas seminar VIP/Reguler
- **Upload bukti transfer** otomatis masuk folder `/uploads`
- **Generate ID Transaksi** unik otomatis
- **Verifikasi email** via link token
- **Cek status pembayaran** real-time pake ID transaksi

### Admin Panel
- **Login admin** dengan session security
- **Dashboard data pendaftar** + search nama/ID transaksi
- **Update status pembayaran**: Menunggu Verifikasi / Lunas / Ditolak
- **Lihat bukti transfer** langsung di dashboard
- **Export Excel** data peserta 1 klik pake SheetJS
- **Pengaturan tema** ganti warna primary dashboard
- **Tambah admin baru** via menu register
- **Hapus data** peserta permanen

## 🛠️ Tech Stack
- **Backend**: PHP 8.1+ Native, MySQLi Prepared Statement
- **Database**: MySQL 8.0+
- **Frontend**: Bootstrap 5.3, HTML5, CSS3, JavaScript
- **Export**: SheetJS xlsx.full.min.js
- **Server**: Apache/XAMPP

## 📁 Struktur Folder
sistem-pendaftaran-seminar/
├── admin/
│   ├── dashboard.php          # Panel utama admin
│   ├── login.php              # Login admin
│   ├── register.php           # Tambah admin baru
│   ├── logout.php             # Logout session
│   ├── edit_status.php        # Update status pembayaran
│   ├── hapus.php              # Hapus data peserta
│   └── pengaturan.php         # Ganti tema warna
├── assets/
│   └── css/
│       └── style.css          # Styling custom
├── uploads/                   # Folder bukti transfer
├── index.php                  # Landing page
├── daftar.php                 # Form pendaftaran
├── proses_daftar.php          # Proses simpan data
├── upload_bukti.php           # Upload bukti transfer
├── cek_status.php             # Cek status peserta
├── verifikasi.php             # Verifikasi email
├── koneksi.php                # Koneksi database
└── README.md                  # File ini
