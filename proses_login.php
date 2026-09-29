<?php

session_start();


// ========================================
// KONEKSI DATABASE
// ========================================

include __DIR__ . "/config/koneksi.php";


// ========================================
// CEK APAKAH DATA DIKIRIM DARI FORM
// ========================================

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: login.php");
    exit;

}


// ========================================
// MENGAMBIL DATA DARI FORM
// ========================================

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";


// ========================================
// CEK DATA KOSONG
// ========================================

if ($email == "" || $password == "") {

    $_SESSION["pesan_error"] = "Email dan password harus diisi.";

    header("Location: login.php");
    exit;

}


// ========================================
// MENCARI USER BERDASARKAN EMAIL
// ========================================

$query = "SELECT id, name, email, password, role
          FROM t_users
          WHERE email = ?
          LIMIT 1";


$stmt = mysqli_prepare($koneksi, $query);


// ========================================
// CEK QUERY
// ========================================

if (!$stmt) {

    $_SESSION["pesan_error"] = "Terjadi kesalahan saat menjalankan login.";

    header("Location: login.php");
    exit;

}


// ========================================
// MASUKKAN EMAIL KE QUERY
// ========================================

mysqli_stmt_bind_param($stmt, "s", $email);


// ========================================
// JALANKAN QUERY
// ========================================

mysqli_stmt_execute($stmt);


// ========================================
// AMBIL HASIL
// ========================================

$result = mysqli_stmt_get_result($stmt);


// ========================================
// CEK EMAIL
// ========================================

if (mysqli_num_rows($result) == 0) {

    $_SESSION["pesan_error"] = "Email tidak ditemukan.";

    header("Location: login.php");
    exit;

}


// ========================================
// AMBIL DATA USER
// ========================================

$user = mysqli_fetch_assoc($result);


// ========================================
// CEK PASSWORD
// ========================================

if ($password != $user["password"]) {

    $_SESSION["pesan_error"] = "Password salah.";

    header("Location: login.php");
    exit;

}


// ========================================
// LOGIN BERHASIL
// ========================================

$_SESSION["login"] = true;

$_SESSION["user_id"] = $user["id"];

$_SESSION["nama"] = $user["name"];

$_SESSION["email"] = $user["email"];

$_SESSION["role"] = $user["role"];


// ========================================
// MASUK KE DASHBOARD
// ========================================

header("Location: dashboard.php");

exit;

?>