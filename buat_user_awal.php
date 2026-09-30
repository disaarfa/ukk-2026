<?php
// buat_user_awal.php
// Jalankan file ini SATU KALI saja lewat browser untuk membuat user awal
include 'koneksi.php';

// Data User 1 (Admin)
$name1     = 'Administrator Utama';
$email1    = 'admin@sekolah';
$password1 = password_hash('123456', PASSWORD_DEFAULT);
$role1     = 'admin';

// Data User 2 (Guru)
$name2     = 'Guru Pengajar';
$email2    = 'guru@sekolah';
$password2 = password_hash('123456', PASSWORD_DEFAULT);
$role2     = 'guru';

$sql = "INSERT INTO t_users (name, email, password, role) VALUES ";
$sql .= "('$name1', '$email1', '$password1', '$role1'), ";
$sql .= "('$name2', '$email2', '$password2', '$role2')";

if (mysqli_query($koneksi, $sql)) {
    echo 'User admin dan guru berhasil dibuat. Silakan hapus file ini.';
} else {
    echo 'Gagal membuat user: ' . mysqli_error($koneksi);
}
?>