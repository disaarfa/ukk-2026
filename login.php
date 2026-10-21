<?php
require_once 'koneksi.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = mysqli_prepare(
        $koneksi,
        "SELECT * FROM t_users WHERE email = ? LIMIT 1"
    );

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);
        $password_db = $user['password'];

        $password_benar = password_verify($password, $password_db);

        // Mendukung password lama yang masih berupa teks biasa.
        if (!$password_benar && $password === $password_db) {
            $password_benar = true;
        }

        if ($password_benar) {

            session_regenerate_id(true);
            session_unset();

            $_SESSION['user_id']   = $user['id'];
            $_SESSION['nama_user'] = $user['name'];
            $_SESSION['email']     = $user['email'];
            $_SESSION['role']      = strtolower(trim($user['role']));

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Email atau password yang kamu masukkan salah.";
        }

    } else {
        $error = "Email atau password yang kamu masukkan salah.";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | Sistem Informasi Pelanggaran Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --biru-utama: #4CA3C7;
            --biru-gelap: #247DA5;
            --cyan: #0099CE;
            --putih: #FFFFFF;
            --abu: #F2F6F9;
            --teks: #263746;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
            margin: 0;
        }

        body {
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--teks);

            background:
                radial-gradient(
                    circle at 15% 20%,
                    rgba(255,255,255,.18),
                    transparent 32%
                ),
                linear-gradient(
                    135deg,
                    #3F94B9 0%,
                    #4CA3C7 48%,
                    #65B7D3 100%
                );

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 24px;
            position: relative;
            overflow-x: hidden;
        }

        /* Hiasan latar belakang */

        body::before,
        body::after {
            content: "";
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            background: rgba(255,255,255,.08);
        }

        body::before {
            width: 300px;
            height: 300px;
            top: -130px;
            left: -90px;
        }

        body::after {
            width: 380px;
            height: 380px;
            right: -160px;
            bottom: -190px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 410px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: var(--putih);
            border: 1px solid rgba(255,255,255,.7);
            border-radius: 22px;
            padding: 38px 35px 30px;

            box-shadow:
                0 22px 55px rgba(26, 66, 88, .20),
                0 4px 12px rgba(26, 66, 88, .08);

            animation: muncul .55s ease;
        }

        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-box {
            width: 68px;
            height: 68px;
            margin: 0 auto 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--putih);
            background: linear-gradient(
                135deg,
                var(--cyan),
                var(--biru-utama)
            );

            border-radius: 20px;
            font-size: 31px;

            box-shadow: 0 8px 20px rgba(0,153,206,.22);
        }

        .judul {
            font-size: 25px;
            font-weight: 750;
            color: #203747;
            letter-spacing: -.5px;
            margin-bottom: 8px;
        }

        .subjudul {
            color: #778995;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 650;
            color: #344B5B;
            margin-bottom: 8px;
        }

        .input-group-custom {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7B9AAA;
            font-size: 17px;
            z-index: 3;
        }

        .form-control {
            height: 49px;
            border: 1px solid #E1EAF0;
            background: #F5F8FA;
            border-radius: 11px !important;

            padding: 12px 43px 12px 43px;
            font-size: 13px;
            color: #263746;

            transition: .2s ease;
        }

        .form-control::placeholder {
            color: #A0AFB8;
        }

        .form-control:focus {
            background: #FFFFFF;
            border-color: var(--cyan);
            box-shadow: 0 0 0 4px rgba(0,153,206,.12);
        }

        .toggle-password {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);

            border: none;
            background: transparent;
            color: #78909C;
            padding: 5px;
            cursor: pointer;
            z-index: 4;
        }

        .toggle-password:hover {
            color: var(--cyan);
        }

        .btn-login {
            width: 100%;
            height: 49px;

            border: none;
            border-radius: 11px;

            color: white;
            background: linear-gradient(
                100deg,
                #0099CE,
                #168DBB
            );

            font-size: 14px;
            font-weight: 700;
            letter-spacing: .2px;

            box-shadow: 0 6px 15px rgba(0,153,206,.23);
            transition: all .2s ease;
        }

        .btn-login:hover {
            color: white;
            background: linear-gradient(
                100deg,
                #0088B9,
                #117DA9
            );

            transform: translateY(-1px);
            box-shadow: 0 9px 19px rgba(0,153,206,.28);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-danger {
            border: 1px solid #F6D1D1;
            border-radius: 10px;
            font-size: 12px;
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 18px;
            border-top: 1px solid #EDF1F4;

            font-size: 11px;
            color: #8797A1;
            line-height: 1.8;
        }

        .login-footer i {
            color: var(--cyan);
            margin-right: 4px;
        }

        @media (max-width: 480px) {
            body {
                padding: 18px;
            }

            .login-card {
                padding: 30px 23px 23px;
                border-radius: 18px;
            }

            .judul {
                font-size: 22px;
            }

            .logo-box {
                width: 60px;
                height: 60px;
                border-radius: 17px;
                font-size: 27px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>

</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <div class="logo-box">
            <i class="bi bi-shield-check"></i>
        </div>

        <div class="text-center">

            <h1 class="judul">
                Selamat Datang
            </h1>

            <p class="subjudul">
                Sistem Informasi Pelanggaran Siswa<br>
                Silakan masuk untuk melanjutkan.
            </p>

        </div>

        <?php if ($error): ?>

            <div class="alert alert-danger d-flex align-items-center gap-2"
                 role="alert">

                <i class="bi bi-exclamation-circle-fill"></i>

                <span>
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                </span>

            </div>

        <?php endif; ?>

        <form method="POST" autocomplete="on">

            <div class="mb-3">

                <label for="email" class="form-label">
                    Alamat Email
                </label>

                <div class="input-group-custom">

                    <i class="bi bi-envelope input-icon"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Masukkan email kamu"
                        value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        autocomplete="username"
                        required
                    >

                </div>

            </div>

            <div class="mb-4">

                <label for="password" class="form-label">
                    Password
                </label>

                <div class="input-group-custom">

                    <i class="bi bi-lock input-icon"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        id="togglePassword"
                        aria-label="Tampilkan password"
                        aria-pressed="false"
                    >
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>

                </div>

            </div>

            <button type="submit" class="btn btn-login">

                <i class="bi bi-box-arrow-in-right me-2"></i>
                Login ke Sistem

            </button>

        </form>

        <div class="login-footer">

            <div>
                <i class="bi bi-shield-lock-fill"></i>
                Akses khusus pengguna terdaftar
            </div>

            <div>
                Sistem Informasi Pelanggaran Siswa
            </div>

        </div>

    </div>

</div>

<script>
    const tombolPassword = document.getElementById('togglePassword');
    const inputPassword = document.getElementById('password');
    const ikonPassword = document.getElementById('eyeIcon');

    tombolPassword.addEventListener('click', function () {

        const sedangTersembunyi = inputPassword.type === 'password';

        inputPassword.type = sedangTersembunyi ? 'text' : 'password';

        ikonPassword.className = sedangTersembunyi
            ? 'bi bi-eye-slash'
            : 'bi bi-eye';

        tombolPassword.setAttribute(
            'aria-pressed',
            sedangTersembunyi ? 'true' : 'false'
        );

        tombolPassword.setAttribute(
            'aria-label',
            sedangTersembunyi ? 'Sembunyikan password' : 'Tampilkan password'
        );
    });
</script>

</body>
</html>
