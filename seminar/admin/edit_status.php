<?php
session_start();
require_once '../koneksi.php';

if (!isset($_SESSION['admin_logged'])) { die("Akses ditolak."); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi      = htmlspecialchars(trim($_POST['id_transaksi']));
    $status_pembayaran = htmlspecialchars(trim($_POST['status_pembayaran']));
    $allowed_status    = ['Menunggu Verifikasi', 'Lunas', 'Ditolak'];

    if (in_array($status_pembayaran, $allowed_status) && !empty($id_transaksi)) {
        $sql = "UPDATE peserta SET status_pembayaran = ? WHERE id_transaksi = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("ss", $status_pembayaran, $id_transaksi);
        $stmt->execute();
        $stmt->close();
    }
}
header("Location: dashboard.php");
exit();
?>