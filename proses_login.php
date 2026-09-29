<?php

session_start();

include "config/koneksi.php";


// Memastikan data dikirim dari form login
if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: login.php");
    exit;

}


// Mengambil data dari form
$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");


// Mengecek apakah email dan password sudah diisi
if ($email === "" || $password === "") {

    $_SESSION["pesan_error"] = "Email dan password wajib diisi.";

    header("Location: login.php");
    exit;

}


// Mencari user berdasarkan email
$query = "SELECT id, name, email, password, role
          FROM t_users
          WHERE email = ?
          LIMIT 1";


$stmt = mysqli_prepare($koneksi, $query);


// Mengecek apakah query berhasil dibuat
if (!$stmt) {

    $_SESSION["pesan_error"] = "Terjadi kesalahan pada sistem.";

    header("Location: login.php");
    exit;

}


// Memasukkan email ke query
mysqli_stmt_bind_param($stmt, "s", $email);


// Menjalankan query
mysqli_stmt_execute($stmt);


// Mengambil hasil query
$result = mysqli_stmt_get_result($stmt);


// Mengecek apakah email ditemukan
if (mysqli_num_rows($result) === 0) {

    $_SESSION["pesan_error"] = "Email atau password salah.";

    header("Location: login.php");
    exit;

}


// Mengambil data user
$user = mysqli_fetch_assoc($result);


// Mengecek password
if ($password !== $user["password"]) {

    $_SESSION["pesan_error"] = "Email atau password salah.";

    header("Location: login.php");
    exit;

}


// Membuat session login
$_SESSION["login"] = true;

$_SESSION["user_id"] = $user["id"];

$_SESSION["nama"] = $user["name"];

$_SESSION["email"] = $user["email"];

$_SESSION["role"] = $user["role"];


// Setelah berhasil login masuk ke dashboard
header("Location: dashboard.php");

exit;