<?php
require_once 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$nama = $_SESSION['nama_user'];

/*
|--------------------------------------------------------------------------
| MENENTUKAN HALAMAN
|--------------------------------------------------------------------------
*/

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';


/*
|--------------------------------------------------------------------------
| DAFTAR HALAMAN YANG DIPERBOLEHKAN
|--------------------------------------------------------------------------
*/

$allowed_pages = [

    'dashboard',

    // Admin
    'kelola_siswa',
    'kelola_guru',
    'kelola_kelas',
    'kelola_tahun_ajaran',
    'penempatan_siswa',
    'kelola_wali_kelas',
    'kelola_kategori',
    'kelola_jenis_pelanggaran',
    'cetak_export',

    // Guru + Admin
    'catat_pelanggaran',
    'tindakan',
    'laporan',
    'riwayat',
    'rekap_poin',

    // Lainnya
    'about'
];


/*
|--------------------------------------------------------------------------
| CEK HALAMAN
|--------------------------------------------------------------------------
*/

if (!in_array($page, $allowed_pages)) {
    $page = 'dashboard';
}


/*
|--------------------------------------------------------------------------
| MENU ADMIN
|--------------------------------------------------------------------------
*/

$menu_admin = [
    'kelola_siswa' => 'Kelola Siswa',
    'kelola_guru' => 'Kelola Guru',
    'kelola_kelas' => 'Kelola Kelas',
    'kelola_tahun_ajaran' => 'Kelola Tahun Ajaran',
    'penempatan_siswa' => 'Penempatan Siswa',
    'kelola_wali_kelas' => 'Kelola Wali Kelas',
    'kelola_kategori' => 'Kelola Kategori Pelanggaran',
    'kelola_jenis_pelanggaran' => 'Kelola Jenis Pelanggaran',
    'cetak_export' => 'Cetak / Export'
];


/*
|--------------------------------------------------------------------------
| MENU GURU + ADMIN
|--------------------------------------------------------------------------
*/

$menu_guru = [
    'catat_pelanggaran' => 'Catat Pelanggaran',
    'tindakan' => 'Tindakan',
    'laporan' => 'Laporan',
    'riwayat' => 'Riwayat',
    'rekap_poin' => 'Rekap Poin'
];

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Sistem Informasi Pelanggaran Siswa
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }


        /* ==========================
           SIDEBAR
        ========================== */

        .sidebar {
            background: #20252b;
            min-height: 100vh;
            padding: 20px 15px;
        }

        .sidebar-title {
            color: white;
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .menu-link {
            display: block;
            text-decoration: none;
            color: #f1f5f9;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.2s;
        }

        .menu-link:hover {
            background: #bdd9ff;
            color: #17365d;
        }

        .menu-link.active {
            background: #8bbcff;
            color: #17365d;
            font-weight: bold;
        }

        .logout {
            color: #ffb3b3;
        }

        .logout:hover {
            background: #ffcccc;
            color: #7a1f1f;
        }


        /* ==========================
           CONTENT
        ========================== */

        .content {
            padding: 30px;
        }

        .page-title {
            margin-bottom: 5px;
        }


        /* ==========================
           CARD
        ========================== */

        .dashboard-card {
            border-radius: 12px;
            border: none;
            padding: 5px;
            transition: 0.2s;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);
        }

        .card-siswa {
            background: #d9f5df;
        }

        .card-guru {
            background: #fff0bd;
        }

        .card-kelas {
            background: #d9eaff;
        }


        /* ==========================
           FORM
        ========================== */

        .form-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        .btn-soft {
            background: #8bbcff;
            color: #17365d;
            border: none;
        }

        .btn-soft:hover {
            background: #6fa8ed;
            color: white;
        }


        /* ==========================
           ABOUT
        ========================== */

        .about-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }

        .about-header {
            background: linear-gradient(
                135deg,
                #b9d8ff,
                #dcecff
            );

            padding: 30px;
            text-align: center;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .about-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            color: #5689c8;
        }

    </style>

</head>


<body>

<div class="container-fluid">

<div class="row">


<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="col-md-3 col-lg-2 sidebar">

    <div class="sidebar-title">
        My Website
    </div>


    <!-- DASHBOARD -->

    <a
        href="dashboard.php?page=dashboard"
        class="menu-link <?= $page == 'dashboard' ? 'active' : '' ?>"
    >
        Dashboard
    </a>


    <!-- =================================================
         MENU KHUSUS ADMIN
    ================================================== -->

    <?php if ($role == 'admin'): ?>

        <hr class="text-secondary">

        <small class="text-secondary">
            MENU ADMIN
        </small>

        <?php foreach ($menu_admin as $link => $text): ?>

            <a
                href="dashboard.php?page=<?= $link ?>"
                class="menu-link <?= $page == $link ? 'active' : '' ?>"
            >

                <?= $text ?>

            </a>

        <?php endforeach; ?>

    <?php endif; ?>


    <!-- =================================================
         MENU GURU + ADMIN
    ================================================== -->

    <hr class="text-secondary">

    <small class="text-secondary">
        MENU PELANGGARAN
    </small>


    <?php foreach ($menu_guru as $link => $text): ?>

        <a
            href="dashboard.php?page=<?= $link ?>"
            class="menu-link <?= $page == $link ? 'active' : '' ?>"
        >

            <?= $text ?>

        </a>

    <?php endforeach; ?>


    <!-- ABOUT -->

    <hr class="text-secondary">

    <a
        href="dashboard.php?page=about"
        class="menu-link <?= $page == 'about' ? 'active' : '' ?>"
    >
        About Me
    </a>


    <!-- LOGOUT -->

    <a
        href="logout.php"
        class="menu-link logout"
    >
        Logout
    </a>

</div>


<!-- =====================================================
     KONTEN
===================================================== -->

<div class="col-md-9 col-lg-10 content">


<?php

/* =====================================================
   DASHBOARD
===================================================== */

if ($page == 'dashboard'):

?>

    <h2 class="page-title">
        Dashboard
    </h2>

    <p>
        Selamat datang di Sistem Informasi Pelanggaran Siswa.
    </p>

    <p>
        Anda login sebagai:
        <strong>
            <?= htmlspecialchars($nama) ?>
        </strong>
    </p>


    <?php if ($role == 'admin'): ?>

        <span class="badge bg-primary">
            ADMINISTRATOR
        </span>

    <?php else: ?>

        <span class="badge bg-secondary">
            GURU
        </span>

    <?php endif; ?>


    <br><br>


    <!-- CARD -->

    <div class="row">


        <!-- SISWA -->

        <div class="col-md-4 mb-3">

            <div class="card dashboard-card card-siswa shadow-sm">

                <div class="card-body">

                    <h5>
                        Kelola Siswa
                    </h5>

                    <h2>
                        120
                    </h2>

                    <a
                        href="dashboard.php?page=kelola_siswa"
                        class="btn btn-sm btn-success"
                    >
                        Kelola
                    </a>

                </div>

            </div>

        </div>


        <!-- GURU -->

        <div class="col-md-4 mb-3">

            <div class="card dashboard-card card-guru shadow-sm">

                <div class="card-body">

                    <h5>
                        Kelola Guru
                    </h5>

                    <h2>
                        25
                    </h2>

                    <a
                        href="dashboard.php?page=kelola_guru"
                        class="btn btn-sm btn-warning"
                    >
                        Kelola
                    </a>

                </div>

            </div>

        </div>


        <!-- KELAS -->

        <div class="col-md-4 mb-3">

            <div class="card dashboard-card card-kelas shadow-sm">

                <div class="card-body">

                    <h5>
                        Kelola Kelas
                    </h5>

                    <h2>
                        12
                    </h2>

                    <a
                        href="dashboard.php?page=kelola_kelas"
                        class="btn btn-sm btn-primary"
                    >
                        Kelola
                    </a>

                </div>

            </div>

        </div>

    </div>


<?php


/* =====================================================
   ABOUT ME
===================================================== */

elseif ($page == 'about'):

?>

    <div class="about-box">

        <div class="about-header">

            <div class="about-icon">
                A
            </div>

            <h2 class="mt-3">
                About Me
            </h2>

            <p>
                Kenalan lebih dekat denganku 💙
            </p>

        </div>


        <h4>
            Halo, aku Arfa!
        </h4>

        <p>
            Perkenalkan, namaku
            <strong>Arfa Disa Okamameliza</strong>.
        </p>

        <p>
            Aku tinggal di Tasikmalaya dan saat ini
            masih terus belajar serta mengembangkan
            kemampuan di bidang teknologi dan pemrograman.
        </p>


        <h5 class="mt-4">
            Biodata Diri
        </h5>

        <table class="table">

            <tr>
                <td width="200">
                    Nama Lengkap
                </td>

                <td>
                    Arfa Disa Okamameliza
                </td>
            </tr>

            <tr>
                <td>
                    Tempat Tinggal
                </td>

                <td>
                    Tasikmalaya
                </td>
            </tr>

            <tr>
                <td>
                    Tanggal Lahir
                </td>

                <td>
                    9 Oktober 2008
                </td>
            </tr>

            <tr>
                <td>
                    Alamat
                </td>

                <td>
                    Cieunteung Gede
                </td>
            </tr>

        </table>


        <h5 class="mt-4">
            Hobi
        </h5>

        <ul>

            <li>
                😴 Tidur
            </li>

            <li>
                🎤 Bernyanyi meskipun suara masih kurang bagus
            </li>

            <li>
                📱 Scrolling untuk mencari hiburan
            </li>

        </ul>


        <h5 class="mt-4">
            Tentang Aku
        </h5>

        <p>

            Aku adalah seseorang yang masih terus belajar
            dan mencoba berbagai hal baru. Aku ingin terus
            mengembangkan kemampuan dan mendapatkan
            pengalaman baru.

        </p>

    </div>


<?php


/* =====================================================
   KELOLA SISWA
===================================================== */

elseif ($page == 'kelola_siswa'):

?>

    <h2>
        Kelola Siswa
    </h2>

    <p>
        Halaman untuk mengelola data siswa.
    </p>


    <div class="form-box">

        <h5>
            Tambah Data Siswa
        </h5>

        <form>

            <div class="mb-3">

                <label>
                    NIS
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Masukkan NIS"
                >

            </div>


            <div class="mb-3">

                <label>
                    Nama Siswa
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Masukkan nama siswa"
                >

            </div>


            <div class="mb-3">

                <label>
                    Kelas
                </label>

                <select class="form-control">

                    <option>
                        Pilih Kelas
                    </option>

                    <option>
                        X RPL
                    </option>

                    <option>
                        XI RPL
                    </option>

                    <option>
                        XII RPL
                    </option>

                </select>

            </div>


            <button
                type="submit"
                class="btn btn-soft"
            >
                Simpan
            </button>

        </form>

    </div>


<?php


/* =====================================================
   KELOLA GURU
===================================================== */

elseif ($page == 'kelola_guru'):

?>

    <h2>
        Kelola Guru
    </h2>

    <p>
        Halaman pengelolaan data guru.
    </p>

    <div class="form-box">

        <h5>
            Tambah Guru
        </h5>

        <form>

            <div class="mb-3">

                <label>
                    NIP
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Masukkan NIP"
                >

            </div>


            <div class="mb-3">

                <label>
                    Nama Guru
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Masukkan nama guru"
                >

            </div>


            <div class="mb-3">

                <label>
                    Mata Pelajaran
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Masukkan mata pelajaran"
                >

            </div>


            <button class="btn btn-soft">
                Simpan
            </button>

        </form>

    </div>


<?php


/* =====================================================
   KELOLA KELAS
===================================================== */

elseif ($page == 'kelola_kelas'):

?>

    <h2>
        Kelola Kelas
    </h2>

    <p>
        Halaman pengelolaan data kelas.
    </p>


    <div class="form-box">

        <h5>
            Tambah Kelas
        </h5>

        <form>

            <div class="mb-3">

                <label>
                    Nama Kelas
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Contoh: XI RPL 2"
                >

            </div>


            <div class="mb-3">

                <label>
                    Jurusan
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Contoh: RPL"
                >

            </div>


            <button class="btn btn-soft">
                Simpan
            </button>

        </form>

    </div>


<?php


/* =====================================================
   TAHUN AJARAN
===================================================== */

elseif ($page == 'kelola_tahun_ajaran'):

?>

    <h2>
        Kelola Tahun Ajaran
    </h2>

    <div class="form-box">

        <form>

            <div class="mb-3">

                <label>
                    Tahun Ajaran
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="2026/2027"
                >

            </div>

            <button class="btn btn-soft">
                Simpan
            </button>

        </form>

    </div>


<?php


/* =====================================================
   PENEMPATAN SISWA
===================================================== */

elseif ($page == 'penempatan_siswa'):

?>

    <h2>
        Penempatan Siswa
    </h2>

    <div class="form-box">

        <div class="mb-3">

            <label>
                Nama Siswa
            </label>

            <input
                type="text"
                class="form-control"
                placeholder="Pilih siswa"
            >

        </div>


        <div class="mb-3">

            <label>
                Kelas
            </label>

            <input
                type="text"
                class="form-control"
                placeholder="Pilih kelas"
            >

        </div>


        <button class="btn btn-soft">
            Simpan Penempatan
        </button>

    </div>


<?php


/* =====================================================
   WALI KELAS
===================================================== */

elseif ($page == 'kelola_wali_kelas'):

?>

    <h2>
        Kelola Wali Kelas
    </h2>

    <div class="form-box">

        <div class="mb-3">

            <label>
                Nama Guru
            </label>

            <input
                type="text"
                class="form-control"
                placeholder="Masukkan nama guru"
            >

        </div>


        <div class="mb-3">

            <label>
                Kelas
            </label>

            <input
                type="text"
                class="form-control"
                placeholder="Masukkan kelas"
            >

        </div>


        <button class="btn btn-soft">
            Simpan
        </button>

    </div>


<?php


/* =====================================================
   KATEGORI PELANGGARAN
===================================================== */

elseif ($page == 'kelola_kategori'):

?>

    <h2>
        Kelola Kategori Pelanggaran
    </h2>

    <div class="form-box">

        <div class="mb-3">

            <label>
                Nama Kategori
            </label>

            <input
                type="text"
                class="form-control"
                placeholder="Contoh: Kedisiplinan"
            >

        </div>


        <div class="mb-3">

            <label>
                Keterangan
            </label>

            <textarea
                class="form-control"
                placeholder="Keterangan kategori"
            ></textarea>

        </div>


        <button class="btn btn-soft">
            Simpan
        </button>

    </div>


<?php


/* =====================================================
   JENIS PELANGGARAN
===================================================== */

elseif ($page == 'kelola_jenis_pelanggaran'):

?>

    <h2>
        Kelola Jenis Pelanggaran
    </h2>

    <div class="form-box">

        <div class="mb-3">

            <label>
                Nama Pelanggaran
            </label>

            <input
                type="text"
                class="form-control"
                placeholder="Contoh: Terlambat"
            >

        </div>


        <div class="mb-3">

            <label>
                Poin
            </label>

            <input
                type="number"
                class="form-control"
                placeholder="Contoh: 10"
            >

        </div>


        <button class="btn btn-soft">
            Simpan
        </button>

    </div>


<?php


/* =====================================================
   CATAT PELANGGARAN
===================================================== */

elseif ($page == 'catat_pelanggaran'):

?>

    <h2>
        Catat Pelanggaran
    </h2>

    <p>
        Silakan masukkan data pelanggaran siswa.
    </p>


    <div class="form-box">

        <form>

            <div class="mb-3">

                <label>
                    Nama Siswa
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Masukkan nama siswa"
                >

            </div>


            <div class="mb-3">

                <label>
                    Jenis Pelanggaran
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Masukkan jenis pelanggaran"
                >

            </div>


            <div class="mb-3">

                <label>
                    Tanggal
                </label>

                <input
                    type="date"
                    class="form-control"
                >

            </div>


            <div class="mb-3">

                <label>
                    Keterangan
                </label>

                <textarea
                    class="form-control"
                    rows="4"
                    placeholder="Masukkan keterangan"
                ></textarea>

            </div>


            <button class="btn btn-soft">
                Simpan Pelanggaran
            </button>

        </form>

    </div>


<?php


/* =====================================================
   TINDAKAN
===================================================== */

elseif ($page == 'tindakan'):

?>

    <h2>
        Tindakan
    </h2>

    <div class="form-box">

        <div class="mb-3">

            <label>
                Nama Siswa
            </label>

            <input
                type="text"
                class="form-control"
                placeholder="Nama siswa"
            >

        </div>


        <div class="mb-3">

            <label>
                Tindakan
            </label>

            <select class="form-control">

                <option>
                    Pilih Tindakan
                </option>

                <option>
                    Teguran
                </option>

                <option>
                    Peringatan
                </option>

                <option>
                    Pemanggilan Orang Tua
                </option>

            </select>

        </div>


        <button class="btn btn-soft">
            Simpan Tindakan
        </button>

    </div>


<?php


/* =====================================================
   LAPORAN
===================================================== */

elseif ($page == 'laporan'):

?>

    <h2>
        Laporan
    </h2>

    <div class="form-box">

        <h5>
            Laporan Pelanggaran Siswa
        </h5>

        <p>
            Halaman ini digunakan untuk melihat
            dan mencetak laporan pelanggaran siswa.
        </p>


        <button class="btn btn-soft">
            Cetak Laporan
        </button>

    </div>


<?php


/* =====================================================
   RIWAYAT
===================================================== */

elseif ($page == 'riwayat'):

?>

    <h2>
        Riwayat
    </h2>

    <div class="form-box">

        <h5>
            Riwayat Pelanggaran
        </h5>

        <table class="table table-bordered mt-3">

            <thead>

                <tr>

                    <th>
                        No
                    </th>

                    <th>
                        Nama Siswa
                    </th>

                    <th>
                        Pelanggaran
                    </th>

                    <th>
                        Tanggal
                    </th>

                </tr>

            </thead>


            <tbody>

                <tr>

                    <td>
                        1
                    </td>

                    <td>
                        Contoh Siswa
                    </td>

                    <td>
                        Terlambat
                    </td>

                    <td>
                        30-09-2026
                    </td>

                </tr>

            </tbody>

        </table>

    </div>


<?php


/* =====================================================
   REKAP POIN
===================================================== */

elseif ($page == 'rekap_poin'):

?>

    <h2>
        Rekap Poin
    </h2>

    <div class="form-box">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>
                        No
                    </th>

                    <th>
                        Nama Siswa
                    </th>

                    <th>
                        Total Poin
                    </th>

                </tr>

            </thead>


            <tbody>

                <tr>

                    <td>
                        1
                    </td>

                    <td>
                        Contoh Siswa
                    </td>

                    <td>
                        10
                    </td>

                </tr>

            </tbody>

        </table>

    </div>


<?php


/* =====================================================
   CETAK / EXPORT
===================================================== */

elseif ($page == 'cetak_export'):

?>

    <h2>
        Cetak / Export
    </h2>

    <div class="form-box">

        <p>
            Gunakan menu berikut untuk mencetak
            atau mengekspor data sistem.
        </p>

        <button
            onclick="window.print()"
            class="btn btn-soft"
        >
            🖨 Cetak Halaman
        </button>

    </div>


<?php


/* =====================================================
   DEFAULT
===================================================== */

else:

?>

    <h2>
        Halaman
    </h2>

    <div class="form-box">

        Halaman belum tersedia.

    </div>

<?php endif; ?>


</div>

</div>

</div>

</body>

</html>