<?php

session_start();

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Login - Sistem Informasi Pelanggaran Siswa</title>

</head>

<body>

    <h1>Login</h1>

    <h2>Sistem Informasi Pelanggaran Siswa</h2>


    <?php

    if (isset($_SESSION['pesan_error'])) {

        echo "<p>";
        echo $_SESSION['pesan_error'];
        echo "</p>";

        unset($_SESSION['pesan_error']);
    }

    ?>


    <form action="proses_login.php" method="POST">

        <p>

            <label for="email">
                Email
            </label>

            <br>

            <input
                type="email"
                name="email"
                id="email"
                required
            >

        </p>


        <p>

            <label for="password">
                Password
            </label>

            <br>

            <input
                type="password"
                name="password"
                id="password"
                required
            >

        </p>


        <p>

            <button type="submit">
                Login
            </button>

        </p>

    </form>

</body>

</html>