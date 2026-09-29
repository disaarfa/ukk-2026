<!-- <?php

include "includes/cek_session.php";

$nama = $_SESSION["nama"];
$role = $_SESSION["role"];

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Dashboard - Sistem Informasi Pelanggaran Siswa</title>

</head>

<body>

    <h1>Dashboard</h1>

    <p>
        Selamat datang,
        <b><?= htmlspecialchars($nama); ?></b>
    </p>

    <p>
        Role:
        <b><?= htmlspecialchars($role); ?></b>
    </p>

    <hr>


    <?php if ($role === "admin"): ?>

        <h2>Menu Admin</h2>

        <ul>

            <li>
                <a href="menu1.php">
                    Menu 1
                </a>
            </li>

            <li>
                <a href="menu2.php">
                    Menu 2
                </a>
            </li>

            <li>
                <a href="menu3.php">
                    Menu 3
                </a>
            </li>

            <li>
                <a href="menu4.php">
                    Menu 4
                </a>
            </li>

        </ul>


    <?php elseif ($role === "guru"): ?>

        <h2>Menu Guru</h2>

        <ul>

            <li>
                <a href="menu3.php">
                    Menu 3
                </a>
            </li>

            <li>
                <a href="menu4.php">
                    Menu 4
                </a>
            </li>

        </ul>

    <?php endif; ?>


    <hr>

    <a href="logout.php">
        Logout
    </a>

</body>

</html> -->



<?php

echo "DASHBOARD BERHASIL DIBUKA";

?>