<?php

require_once 'koneksi.php';

// Hapus semua data sesi
$_SESSION = [];

session_unset();
session_destroy();

// Kembali ke halaman login
header("Location: login.php");
exit();

?>
