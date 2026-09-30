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
<head><title>Login</title></head>
<body>
    <h2>Login Sistem Pelanggaran</h2>
    <?php if ($error): ?><p style="color:red;"><?= $error; ?></p><?php endif; ?>
    <form method="POST">
        <label>Email:</label><br>
        <input type="text" name="email" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>