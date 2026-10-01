<?php

require_once 'koneksi.php';

session_unset();

session_destroy();

header("Location: login.php");

exit();

?>