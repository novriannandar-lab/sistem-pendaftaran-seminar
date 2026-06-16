<?php
session_start();
require_once '../koneksi.php';

if (!isset($_SESSION['admin_logged'])) { die("Akses ditolak."); }

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_transaksi = htmlspecialchars(trim($_GET['id']));

    // Hapus berkas file gambar di folder uploads
    $sql_file = "SELECT bukti_transfer FROM peserta WHERE id_transaksi = ?";
    $stmt_file = $koneksi->prepare($sql_file);
    $stmt_file->bind_param("s", $id_transaksi);
    $stmt_file->execute();
    $res_file = $stmt_file->get_result();

    if ($res_file->num_rows === 1) {
        $row = $res_file->fetch_assoc();
        $path_file = "../uploads/" . $row['bukti_transfer'];
        if (file_exists($path_file)) { unlink($path_file); }
    }
    $stmt_file->close();

    // Hapus record data di tabel mysql
    $sql_del = "DELETE FROM peserta WHERE id_transaksi = ?";
    $stmt_del = $koneksi->prepare($sql_del);
    $stmt_del->bind_param("s", $id_transaksi);
    $stmt_del->execute();
    $stmt_del->close();
}
header("Location: dashboard.php");
exit();
?>