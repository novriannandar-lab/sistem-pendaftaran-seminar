<?php
session_start();
require_once '../koneksi.php';

// Proteksi Session Halaman Admin
if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit();
}

$msg = "";

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $badge_text = htmlspecialchars(strip_tags(trim($_POST['badge_text'])));
    $judul      = htmlspecialchars(strip_tags(trim($_POST['judul'])));
    $tema       = htmlspecialchars(strip_tags(trim($_POST['tema'])));
    $tanggal    = htmlspecialchars(strip_tags(trim($_POST['tanggal'])));
    $lokasi     = htmlspecialchars(strip_tags(trim($_POST['lokasi'])));
    $deskripsi  = htmlspecialchars(strip_tags(trim($_POST['deskripsi'])));

    // Update menggunakan Prepared Statement
    $sql = "UPDATE seminar_info SET badge_text=?, judul=?, tema=?, tanggal=?, lokasi=?, deskripsi=? WHERE id=1";
    $stmt = $koneksi->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssssss", $badge_text, $judul, $tema, $tanggal, $lokasi, $deskripsi);
        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success fw-bold shadow-sm'>Konten beranda berhasil diperbarui!</div>";
        } else {
            $msg = "<div class='alert alert-danger fw-bold shadow-sm'>Gagal memperbarui data: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
}

// Ambil data terkini untuk ditampilkan di form
$query = $koneksi->query("SELECT * FROM seminar_info WHERE id=1");
$info = $query->fetch_assoc();
$koneksi->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Tema Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark shadow sticky-top py-3">
        <div class="container-fluid px-4">
            <span class="navbar-brand fw-bold text-info fs-5">Admin Panel 2026</span>
            <div class="d-flex align-items-center gap-3">
                <span class="text-light small">Halo, <strong><?php echo $_SESSION['admin_user']; ?></strong></span>
                <a href="logout.php" class="btn btn-danger btn-sm fw-bold px-3">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container my-5" style="max-width: 800px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Pengaturan Tema Beranda</h2>
            <a href="dashboard.php" class="btn btn-secondary btn-sm fw-bold px-3">&larr; Data Pendaftar</a>
        </div>

        <?php echo $msg; ?>

        <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
            <form action="pengaturan.php" method="POST">
                
                <div class="mb-3">
                    <label for="badge_text" class="form-label fw-semibold text-muted">Teks Badge Atas</label>
                    <input type="text" id="badge_text" name="badge_text" class="form-control" value="<?php echo $info['badge_text']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold text-muted">Judul Utama Seminar</label>
                    <input type="text" id="judul" name="judul" class="form-control" value="<?php echo $info['judul']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="tema" class="form-label fw-semibold text-muted">Tema Lengkap Seminar</label>
                    <textarea id="tema" name="tema" class="form-control" rows="2" required><?php echo $info['tema']; ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label fw-semibold text-muted">Tanggal Pelaksanaan</label>
                        <input type="text" id="tanggal" name="tanggal" class="form-control" value="<?php echo $info['tanggal']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lokasi" class="form-label fw-semibold text-muted">Tempat / Media</label>
                        <input type="text" id="lokasi" name="lokasi" class="form-control" value="<?php echo $info['lokasi']; ?>" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold text-muted">Deskripsi Singkat Event</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required><?php echo $info['deskripsi']; ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm py-2">Simpan Perubahan Konten</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>