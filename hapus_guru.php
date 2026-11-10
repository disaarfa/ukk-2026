<?php
require_once 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];

$q_user = mysqli_query(
    $koneksi,
    "SELECT role FROM t_users WHERE id = $user_id LIMIT 1"
);

$user = $q_user ? mysqli_fetch_assoc($q_user) : null;

if (!$user || strtolower(trim($user['role'])) !== 'admin') {
    header("Location: dashboard.php?page=kelola_guru");
    exit;
}

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: dashboard.php?page=kelola_guru");
    exit;
}

mysqli_begin_transaction($koneksi);

try {
    // Hapus penugasan wali kelas terlebih dahulu.
    $stmt = mysqli_prepare(
        $koneksi,
        "DELETE FROM t_wali_kelas WHERE guru_id = ?"
    );
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Gagal menghapus penugasan wali kelas.");
    }

    mysqli_stmt_close($stmt);

    // Hapus guru.
    $stmt = mysqli_prepare(
        $koneksi,
        "DELETE FROM t_guru WHERE id = ?"
    );
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Data guru masih digunakan oleh data lain.");
    }

    if (mysqli_stmt_affected_rows($stmt) === 0) {
        throw new Exception("Data guru tidak ditemukan.");
    }

    mysqli_stmt_close($stmt);
    mysqli_commit($koneksi);

    header("Location: dashboard.php?page=kelola_guru&hapus_berhasil=1");
    exit;

} catch (Throwable $e) {
    mysqli_rollback($koneksi);

    header("Location: dashboard.php?page=kelola_guru&hapus_gagal=1");
    exit;
}
