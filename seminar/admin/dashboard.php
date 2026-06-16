<?php
session_start();
require_once '../koneksi.php';

if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit();
}

$keyword = "";
if (isset($_GET['search'])) {
    $keyword = htmlspecialchars(trim($_GET['search']));
}

if ($keyword != "") {
    $sql = "SELECT * FROM peserta WHERE nama LIKE ? OR id_transaksi LIKE ? ORDER BY id DESC";
    $stmt = $koneksi->prepare($sql);
    $search_param = "%" . $keyword . "%";
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM peserta ORDER BY id DESC";
    $result = $koneksi->query($sql);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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

    <div class="container-fluid px-4 my-5">
        <div class="d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-3 mb-4">
            <h2 class="fw-bold text-dark mb-0">Daftar Pendaftar Seminar</h2>
            
            <form action="dashboard.php" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari nama / ID transaksi..." value="<?php echo $keyword; ?>" style="max-width: 260px;">
                <button type="submit" class="btn btn-primary fw-bold">Cari</button>
                <?php if ($keyword != ""): ?>
                    <a href="dashboard.php" class="btn btn-secondary fw-bold">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark text-uppercase font-xs">
                        <tr>
                            <th class="ps-3">ID Transaksi</th>
                            <th>Nama Lengkap</th>
                            <th>Instansi & Prodi</th>
                            <th>Kontak</th>
                            <th>Kelas & Metode</th>
                            <th>Bukti Transfer</th>
                            <th>Status Pembayaran</th>
                            <th class="text-center pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="ps-3 fw-bold text-primary"><?php echo $row['id_transaksi']; ?></td>
                                    <td>
                                        <div class="fw-bold"><?php echo $row['nama']; ?></div>
                                        <small class="text-muted font-xs"><?php echo $row['jenis_kelamin']; ?></small>
                                    </td>
                                    <td>
                                        <div class="small fw-semibold"><?php echo $row['universitas']; ?></div>
                                        <div class="text-muted font-xs"><?php echo $row['prodi']; ?></div>
                                    </td>
                                    <td>
                                        <div class="small">WA: <?php echo $row['whatsapp']; ?></div>
                                        <div class="text-muted font-xs"><?php echo $row['email']; ?></div>
                                    </td>
                                    <td>
                                        <?php $badgeColor = ($row['kelas_seminar'] === 'vip') ? 'bg-warning text-dark' : 'bg-info text-white'; ?>
                                        <span class="badge <?php echo $badgeColor; ?> font-xs text-uppercase"><?php echo $row['kelas_seminar']; ?></span>
                                        <div class="text-muted font-xs mt-1"><?php echo $row['metode_pembayaran']; ?></div>
                                    </td>
                                    <td>
                                        <a href="../uploads/<?php echo $row['bukti_transfer']; ?>" target="_blank" class="btn btn-link btn-sm p-0 text-decoration-none fw-bold">Lihat Foto &rarr;</a>
                                    </td>
                                    <td>
                                        <form action="edit_status.php" method="POST" class="m-0">
                                            <input type="hidden" name="id_transaksi" value="<?php echo $row['id_transaksi']; ?>">
                                            <select name="status_pembayaran" onchange="this.form.submit()" class="form-select form-select-sm fw-semibold" style="width: 170px;">
                                                <option value="Menunggu Verifikasi" <?php if($row['status_pembayaran'] === 'Menunggu Verifikasi') echo 'selected'; ?>>Menunggu Verifikasi</option>
                                                <option value="Lunas" <?php if($row['status_pembayaran'] === 'Lunas') echo 'selected'; ?>>Lunas</option>
                                                <option value="Ditolak" <?php if($row['status_pembayaran'] === 'Ditolak') echo 'selected'; ?>>Ditolak</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-center pe-3">
                                        <a href="hapus.php?id=<?php echo $row['id_transaksi']; ?>" onclick="return confirm('Hapus permanen data peserta ini?')" class="btn btn-outline-danger btn-sm fw-bold">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Data pendaftar tidak ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>