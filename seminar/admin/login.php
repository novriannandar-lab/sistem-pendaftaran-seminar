<?php
session_start();
require_once '../koneksi.php';

if (isset($_SESSION['admin_logged'])) {
    header("Location: dashboard.php");
    exit();
}

$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_logged'] = true;
                $_SESSION['admin_user']   = $row['username'];
                header("Location: dashboard.php");
                exit();
            } else { $error_msg = "Password salah."; }
        } else { $error_msg = "Admin tidak terdaftar."; }
        $stmt->close();
    }
}
$koneksi->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="card border-0 shadow-lg p-4 rounded-3 bg-white w-100 mx-3" style="max-width: 400px;">
        <div class="card-body">
            <h4 class="fw-bold text-center text-dark mb-1">Admin </h4>
            <p class="text-muted text-center small mb-4">Masuk untuk mengelola data pendaftar.</p>

            <?php if (!empty($error_msg)): ?>
                <div class="alert alert-danger py-2 small fw-bold text-center"><?php echo $error_msg; ?></div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label small fw-semibold text-secondary">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required placeholder="Masukkan username">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required placeholder="Masukkan password">
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-2">Masuk Dashboard</button>
            </form>
            <div class="text-center mt-4">
                <a href="../index.php" class="small text-decoration-none">&larr; Kembali ke Beranda</a>
            </div>
        </div>
    </div>

</body>
</html>