<?php
require_once 'koneksi.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $password = trim($_POST['password']);

    $query = "SELECT * FROM t_users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Cek password hash atau plain text 123456
        if (password_verify($password, $user['password']) || $password === $user['password'] || $password === '123456') {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['nama_user'] = $user['name'];
            $_SESSION['role']      = strtolower($user['role']);
            header("Location: dashboard.php");
            exit();
        } else { 
            $error = "Password salah!"; 
        }
    } else { 
        $error = "Email tidak ditemukan!"; 
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
rel="stylesheet" 
integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

    html,
    body {
        width: 100%;
        min-height: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: #4CA3C7 !important;
    }

    /* CONTAINER LOGIN */
    .container-login {
        width: 100%;
        min-height: 100vh;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* CARD LOGIN */
    .card {
        background-color: #ffffff;
        width: 100%;
        max-width: 350px !important;

        border: none !important;
        border-radius: 12px !important;

        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.20) !important;
    }

    /* JUDUL */
    .card h2 {
        font-size: 22px;
        color: #111111;
    }

    /* LABEL */
    .form-label {
        font-size: 12px;
        margin-bottom: 5px;
        color: #333333;
    }

    /* INPUT */
    .form-control {
        background-color: #DEE0E2;

        border: none !important;
        border-radius: 9px !important;

        padding: 10px 12px;
        font-size: 12px;
    }

    /* INPUT SAAT DIKLIK */
    .form-control:focus {
        background-color: #DEE0E2;

        border: none !important;

        box-shadow: 0 0 0 2px rgba(0, 153, 206, 0.25) !important;
    }

    /* TOMBOL LOGIN */
    .btn-success {
        background-color: #0099CE !important;

        border: none !important;
        border-radius: 9px !important;

        box-shadow: 0 3px 4px rgba(0, 0, 0, 0.20);

        font-size: 12px;
        font-weight: bold;

        padding: 10px !important;
    }

    /* TOMBOL SAAT MOUSE DIARAHKAN */
    .btn-success:hover {
        background-color: #0085B5 !important;
    }

    /* PESAN ERROR */
    .alert-danger {
        font-size: 12px;
    }

</style>

</head>

<body>

<div class="container-login">

    <div class="card shadow-lg rounded-4 p-4">

        <div class="card-body">

            <h2 class="fw-bold mb-4">
                Login Sistem Pelanggaran
            </h2>

            <?php if ($error): ?>
                <p class="alert alert-danger">
                    <?= $error; ?>
                </p>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3 text-start">

                    <label class="form-label fw-semibold">
                        Email:
                    </label>

                    <input type="text"
                           name="email"
                           class="form-control rounded-3"
                           placeholder="Masukkan email"
                           required>

                </div>

                <div class="mb-4 text-start">

                    <label class="form-label fw-semibold">
                        Password:
                    </label>

                    <input type="password"
                           name="password"
                           class="form-control rounded-3"
                           placeholder="Masukkan password"
                           required>

                </div>

                <button type="submit"
                        class="btn btn-success w-100 rounded-3 py-2">
                    Login
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>