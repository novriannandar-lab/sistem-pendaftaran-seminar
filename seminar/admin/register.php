<?php
session_start();
require_once '../koneksi.php';

// Kunci: cuma admin login yg bisa buka
if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit();
}

$pesan = '';
$tipe_alert = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (strlen($username) < 4 || strlen($password) < 6) {
        $pesan = 'Username min 4 karakter, password min 6 karakter!';
        $tipe_alert = 'danger';
    } else {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $koneksi->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hash_pass);
        
        if ($stmt->execute()) {
            $pesan = 'Admin baru "'. $username .'" berhasil ditambahkan!';
            $tipe_alert = 'success';
        } else {
            $pesan = 'Gagal! Username sudah dipakai.';
            $tipe_alert = 'danger';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Admin Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark shadow py-3">
        <div class="container px-4">
            <span class="navbar-brand fw-bold text-info">Tambah Admin Baru</span>
            <a href="dashboard.php" class="btn btn-outline-light btn-sm fw-bold">← Kembali ke Dashboard</a>
        </div>
    </nav>

    <div class="container px-4 my-5">
        <div class="col-md-5 mx-auto">
            <div class="card border-0 shadow rounded-3">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Form Registrasi Admin</h4>
                    
                    <?php if($pesan): ?>
                        <div class="alert alert-<?php echo $tipe_alert; ?> py-2"><?php echo $pesan; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username Baru</label>
                            <input type="text" name="username" class="form-control" required minlength="4">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="password" class="form-control" required minlength="6">
                        </div>
                        <button type="submit" class="btn btn-success w-100 fw-bold">Simpan Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>