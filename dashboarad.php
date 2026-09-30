<?php
require_once 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$nama = $_SESSION['nama_user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <h2> Dashboard</h2>
    <p>Pengguna: <strong><?= htmlspecialchars($nama); ?></strong> | Akses: <strong><?= strtoupper(htmlspecialchars($role)); ?></strong></p>
    <hr>

    <h3>Menu Navigasi:</h3>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>

        <?php if ($role === 'admin'): ?>
            <!-- Menu Khusus Admin -->
            <li><a href="kelola_siswa.php">Kelola Siswa</a></li>
            <li><a href="kelola_guru.php">Kelola Guru</a></li>
            <li><a href="kelola_kelas.php">Kelola Kelas</a></li>
            <li><a href="kelola_tahun_ajaran.php">Kelola Tahun Ajaran</a></li>
            <li><a href="penempatan_siswa.php">Penempatan Siswa</a></li>
            <li><a href="kelola_wali_kelas.php">Kelola Wali Kelas</a></li>
            <li><a href="kelola_kategori.php">Kelola Kategori Pelanggaran</a></li>
            <li><a href="kelola_jenis_pelanggaran.php">Kelola Jenis Pelanggaran</a></li>
            <li><a href="cetak_export.php">Cetak / Export</a></li>
        <?php endif; ?>

        <?php if ($role === 'guru' || $role === 'admin'): ?>
            <!-- Menu Guru & Admin -->
            <li><a href="catat_pelanggaran.php">Catat Pelanggaran</a></li>
            <li><a href="tindakan.php">Tindakan</a></li>
            <li><a href="laporan.php">Laporan</a></li>
            <li><a href="riwayat.php">Riwayat</a></li>
            <li><a href="rekap_poin.php">Rekap Poin</a></li>
        <?php endif; ?>

        <li><a href="logout.php">Logout</a></li>
    </ul>

</body>
</html>