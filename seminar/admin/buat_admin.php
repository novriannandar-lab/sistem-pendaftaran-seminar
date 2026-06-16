<?php
// Menyertakan koneksi database - Perbaikan pada fungsi require_once
require_once '../koneksi.php'; 

// Username dan Password baru yang ingin dibuat
$username_baru = 'admin';
$password_baru = 'admin123';

// Mengamankan password menggunakan fungsi hash bawaan PHP
$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

// Hapus akun admin lama jika ada (untuk reset)
$koneksi->query("DELETE FROM admin WHERE username = '$username_baru'");

// Query untuk memasukkan admin baru menggunakan prepared statement
$sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
$stmt = $koneksi->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $username_baru, $password_hash);
    
    if ($stmt->execute()) {
        echo "<div style='padding: 20px; background: #d4edda; color: #155724; border-radius: 5px; font-family: sans-serif; max-width: 500px; margin: 20px auto;'>";
        echo "<h3>&checkmark; Akun Admin Berhasil Dibuat/Reset!</h3>";
        echo "<p><b>Username:</b> " . $username_baru . "</p>";
        echo "<p><b>Password:</b> " . $password_baru . "</p>";
        echo "<hr><a href='login.php' style='color: #155724; font-weight: bold;'>Klik di sini untuk ke halaman Login</a>";
        echo "</div>";
    } else {
        echo "Gagal membuat akun: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Gagal menyiapkan query: " . $koneksi->error;
}

$koneksi->close();
?>