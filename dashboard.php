<?php
require_once 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

/* =========================================================
   AMBIL DATA USER LOGIN
========================================================= */

$user_id = (int)$_SESSION['user_id'];

$q_user = mysqli_query($koneksi, "
    SELECT id, name, email, role
    FROM t_users
    WHERE id = '$user_id'
    LIMIT 1
");

$user = mysqli_fetch_assoc($q_user);

if (!$user) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$role  = strtolower(trim($user['role']));
$nama  = $user['name'];
$email = $user['email'];

$_SESSION['role'] = $role;
$_SESSION['nama_user'] = $nama;
$_SESSION['email'] = $email;

$page = $_GET['page'] ?? 'dashboard';
$edit_id = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;

$pesan = '';
$error = '';

/* =========================================================
   MENU
========================================================= */

$menu_admin = [
    'kelola_siswa' => 'Kelola Siswa',
    'kelola_guru' => 'Kelola Guru',
    'kelola_kelas' => 'Kelola Kelas',
    'kelola_tahun_ajaran' => 'Tahun Ajaran',
    'penempatan_siswa' => 'Penempatan Siswa',
    'kelola_wali_kelas' => 'Wali Kelas',
    'kelola_kategori' => 'Kategori Pelanggaran',
    'kelola_jenis_pelanggaran' => 'Jenis Pelanggaran'
];

$menu_guru = [
    'catat_pelanggaran' => 'Catat Pelanggaran',
    'tindakan' => 'Tindakan',
    'laporan' => 'Laporan',
    'riwayat' => 'Riwayat',
    'rekap_poin' => 'Rekap Poin'
];

$allowed_pages = [
    'dashboard',
    'about'
];

if ($role === 'admin') {
    $allowed_pages = array_merge(
        $allowed_pages,
        array_keys($menu_admin)
    );
}

if ($role === 'guru') {
    $allowed_pages = array_merge(
        $allowed_pages,
        array_keys($menu_guru)
    );
}

if (!in_array($page, $allowed_pages)) {
    $page = 'dashboard';
}

/* =========================================================
   FUNGSI ESCAPE
========================================================= */

function e($text)
{
    return htmlspecialchars(
        $text ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}

/* =========================================================
   HAPUS DATA
========================================================= */

if (
    $role === 'admin' &&
    isset($_GET['hapus']) &&
    isset($_GET['id'])
) {

    $jenis = $_GET['hapus'];
    $id = (int)$_GET['id'];

    $tabel = [
        'siswa' => 't_siswa',
        'guru' => 't_guru',
        'kelas' => 't_kelas',
        'tahun' => 't_tahun_ajaran',
        'kategori' => 't_pelanggaran_kategori',
        'pelanggaran' => 't_pelanggaran',
        'penempatan' => 't_kelas_siswa',
        'wali' => 't_wali_kelas'
    ];

    if (isset($tabel[$jenis])) {

        $nama_tabel = $tabel[$jenis];

        $hapus_query = mysqli_query(
            $koneksi,
            "DELETE FROM `$nama_tabel` WHERE id='$id'"
        );

        if (!$hapus_query) {
            $error = "Data tidak bisa dihapus karena masih digunakan oleh data lain.";
        }
    }

    if (!$error) {
        header(
            "Location: dashboard.php?page=" .
            urlencode($page)
        );
        exit;
    }
}

/* =========================================================
   CRUD SISWA
========================================================= */

if (
    $role === 'admin' &&
    $page === 'kelola_siswa' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $aksi = $_POST['aksi'] ?? '';

    $nis = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nis'] ?? '')
    );

    $nisn = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nisn'] ?? '')
    );

    $nama_siswa = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nama'] ?? '')
    );

    $jk = mysqli_real_escape_string(
        $koneksi,
        $_POST['jenis_kelamin'] ?? ''
    );

    $tanggal = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal_lahir'] ?? ''
    );

    $alamat = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['alamat'] ?? '')
    );

    $status = (int)($_POST['status_aktif'] ?? 1);

    if ($aksi === 'tambah') {

        mysqli_query($koneksi, "
            INSERT INTO t_siswa
            (
                nis,
                nisn,
                nama,
                jenis_kelamin,
                tanggal_lahir,
                alamat,
                status_aktif,
                created_at,
                updated_at
            )
            VALUES
            (
                '$nis',
                '$nisn',
                '$nama_siswa',
                '$jk',
                '$tanggal',
                '$alamat',
                '$status',
                NOW(),
                NOW()
            )
        ");

    } elseif ($aksi === 'edit') {

        $id = (int)$_POST['id'];

        mysqli_query($koneksi, "
            UPDATE t_siswa SET
                nis='$nis',
                nisn='$nisn',
                nama='$nama_siswa',
                jenis_kelamin='$jk',
                tanggal_lahir='$tanggal',
                alamat='$alamat',
                status_aktif='$status',
                updated_at=NOW()
            WHERE id='$id'
        ");
    }

    header("Location: dashboard.php?page=kelola_siswa");
    exit;
}

/* =========================================================
   CRUD GURU
========================================================= */

if (
    $role === 'admin' &&
    $page === 'kelola_guru' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $aksi = $_POST['aksi'] ?? '';

    $nip = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nip'] ?? '')
    );

    $nama_guru = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nama'] ?? '')
    );

    $email_guru = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['email'] ?? '')
    );

    $status = (int)($_POST['status_aktif'] ?? 1);

    if ($aksi === 'tambah') {

        mysqli_query($koneksi, "
            INSERT INTO t_guru
            (
                nip,
                nama,
                email,
                status_aktif,
                created_at,
                updated_at
            )
            VALUES
            (
                '$nip',
                '$nama_guru',
                '$email_guru',
                '$status',
                NOW(),
                NOW()
            )
        ");

    } elseif ($aksi === 'edit') {

        $id = (int)$_POST['id'];

        mysqli_query($koneksi, "
            UPDATE t_guru SET
                nip='$nip',
                nama='$nama_guru',
                email='$email_guru',
                status_aktif='$status',
                updated_at=NOW()
            WHERE id='$id'
        ");
    }

    header("Location: dashboard.php?page=kelola_guru");
    exit;
}

/* =========================================================
   CRUD KELAS
========================================================= */

if (
    $role === 'admin' &&
    $page === 'kelola_kelas' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $aksi = $_POST['aksi'] ?? '';

    $nama_kelas = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nama'] ?? '')
    );

    $tingkat = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['tingkat'] ?? '')
    );

    $jurusan = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['jurusan'] ?? '')
    );

    $status = (int)($_POST['status_aktif'] ?? 1);

    if ($aksi === 'tambah') {

        mysqli_query($koneksi, "
            INSERT INTO t_kelas
            (
                nama,
                tingkat,
                jurusan,
                status_aktif,
                created_at,
                updated_at
            )
            VALUES
            (
                '$nama_kelas',
                '$tingkat',
                '$jurusan',
                '$status',
                NOW(),
                NOW()
            )
        ");

    } elseif ($aksi === 'edit') {

        $id = (int)$_POST['id'];

        mysqli_query($koneksi, "
            UPDATE t_kelas SET
                nama='$nama_kelas',
                tingkat='$tingkat',
                jurusan='$jurusan',
                status_aktif='$status',
                updated_at=NOW()
            WHERE id='$id'
        ");
    }

    header("Location: dashboard.php?page=kelola_kelas");
    exit;
}

/* =========================================================
   CRUD TAHUN AJARAN
========================================================= */

if (
    $role === 'admin' &&
    $page === 'kelola_tahun_ajaran' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $aksi = $_POST['aksi'] ?? '';

    $nama = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nama'] ?? '')
    );

    $mulai = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal_mulai'] ?? ''
    );

    $selesai = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal_selesai'] ?? ''
    );

    $status = (int)($_POST['status_aktif'] ?? 1);

    if ($aksi === 'tambah') {

        mysqli_query($koneksi, "
            INSERT INTO t_tahun_ajaran
            (
                nama,
                tanggal_mulai,
                tanggal_selesai,
                status_aktif,
                created_at,
                updated_at
            )
            VALUES
            (
                '$nama',
                '$mulai',
                '$selesai',
                '$status',
                NOW(),
                NOW()
            )
        ");

    } elseif ($aksi === 'edit') {

        $id = (int)$_POST['id'];

        mysqli_query($koneksi, "
            UPDATE t_tahun_ajaran SET
                nama='$nama',
                tanggal_mulai='$mulai',
                tanggal_selesai='$selesai',
                status_aktif='$status',
                updated_at=NOW()
            WHERE id='$id'
        ");
    }

    header(
        "Location: dashboard.php?page=kelola_tahun_ajaran"
    );
    exit;
}

/* =========================================================
   CRUD KATEGORI
========================================================= */

if (
    $role === 'admin' &&
    $page === 'kelola_kategori' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $aksi = $_POST['aksi'] ?? '';

    $nama = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nama'] ?? '')
    );

    $deskripsi = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['deskripsi'] ?? '')
    );

    $status = (int)($_POST['status_aktif'] ?? 1);

    if ($aksi === 'tambah') {

        mysqli_query($koneksi, "
            INSERT INTO t_pelanggaran_kategori
            (
                nama,
                deskripsi,
                status_aktif,
                created_at,
                updated_at
            )
            VALUES
            (
                '$nama',
                '$deskripsi',
                '$status',
                NOW(),
                NOW()
            )
        ");

    } elseif ($aksi === 'edit') {

        $id = (int)$_POST['id'];

        mysqli_query($koneksi, "
            UPDATE t_pelanggaran_kategori SET
                nama='$nama',
                deskripsi='$deskripsi',
                status_aktif='$status',
                updated_at=NOW()
            WHERE id='$id'
        ");
    }

    header(
        "Location: dashboard.php?page=kelola_kategori"
    );
    exit;
}

/* =========================================================
   CRUD JENIS PELANGGARAN
========================================================= */

if (
    $role === 'admin' &&
    $page === 'kelola_jenis_pelanggaran' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $aksi = $_POST['aksi'] ?? '';

    $kategori = (int)(
        $_POST['pelanggaran_kategori_id'] ?? 0
    );

    $kode = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['kode'] ?? '')
    );

    $nama = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nama'] ?? '')
    );

    $poin = (int)($_POST['poin'] ?? 0);

    $deskripsi = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['deskripsi'] ?? '')
    );

    $status = (int)($_POST['status_aktif'] ?? 1);

    if ($aksi === 'tambah') {

        mysqli_query($koneksi, "
            INSERT INTO t_pelanggaran
            (
                pelanggaran_kategori_id,
                kode,
                nama,
                poin,
                deskripsi,
                status_aktif,
                created_at,
                updated_at
            )
            VALUES
            (
                '$kategori',
                '$kode',
                '$nama',
                '$poin',
                '$deskripsi',
                '$status',
                NOW(),
                NOW()
            )
        ");

    } elseif ($aksi === 'edit') {

        $id = (int)$_POST['id'];

        mysqli_query($koneksi, "
            UPDATE t_pelanggaran SET
                pelanggaran_kategori_id='$kategori',
                kode='$kode',
                nama='$nama',
                poin='$poin',
                deskripsi='$deskripsi',
                status_aktif='$status',
                updated_at=NOW()
            WHERE id='$id'
        ");
    }

    header(
        "Location: dashboard.php?page=kelola_jenis_pelanggaran"
    );
    exit;
}

/* =========================================================
   CRUD PENEMPATAN SISWA
========================================================= */

if (
    $role === 'admin' &&
    $page === 'penempatan_siswa' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $aksi = $_POST['aksi'] ?? '';

    $siswa = (int)($_POST['siswa_id'] ?? 0);
    $tahun = (int)($_POST['tahun_ajaran_id'] ?? 0);
    $kelas = (int)($_POST['kelas_id'] ?? 0);

    $mulai = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal_mulai'] ?? ''
    );

    $selesai = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal_selesai'] ?? ''
    );

    $status = (int)($_POST['status_aktif'] ?? 1);

    if ($aksi === 'tambah') {

        mysqli_query($koneksi, "
            INSERT INTO t_kelas_siswa
            (
                siswa_id,
                tahun_ajaran_id,
                kelas_id,
                tanggal_mulai,
                tanggal_selesai,
                status_aktif,
                created_at,
                updated_at
            )
            VALUES
            (
                '$siswa',
                '$tahun',
                '$kelas',
                '$mulai',
                '$selesai',
                '$status',
                NOW(),
                NOW()
            )
        ");

    } elseif ($aksi === 'edit') {

        $id = (int)$_POST['id'];

        mysqli_query($koneksi, "
            UPDATE t_kelas_siswa SET
                siswa_id='$siswa',
                tahun_ajaran_id='$tahun',
                kelas_id='$kelas',
                tanggal_mulai='$mulai',
                tanggal_selesai='$selesai',
                status_aktif='$status',
                updated_at=NOW()
            WHERE id='$id'
        ");
    }

    header(
        "Location: dashboard.php?page=penempatan_siswa"
    );
    exit;
}

/* =========================================================
   CRUD WALI KELAS
========================================================= */

if (
    $role === 'admin' &&
    $page === 'kelola_wali_kelas' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $aksi = $_POST['aksi'] ?? '';

    $tahun = (int)($_POST['tahun_ajaran_id'] ?? 0);
    $kelas = (int)($_POST['kelas_id'] ?? 0);
    $guru = (int)($_POST['guru_id'] ?? 0);

    $mulai = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal_mulai'] ?? ''
    );

    $selesai = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal_selesai'] ?? ''
    );

    $status = (int)($_POST['status_aktif'] ?? 1);

    if ($aksi === 'tambah') {

        mysqli_query($koneksi, "
            INSERT INTO t_wali_kelas
            (
                tahun_ajaran_id,
                kelas_id,
                guru_id,
                tanggal_mulai,
                tanggal_selesai,
                status_aktif,
                created_at,
                updated_at
            )
            VALUES
            (
                '$tahun',
                '$kelas',
                '$guru',
                '$mulai',
                '$selesai',
                '$status',
                NOW(),
                NOW()
            )
        ");

    } elseif ($aksi === 'edit') {

        $id = (int)$_POST['id'];

        mysqli_query($koneksi, "
            UPDATE t_wali_kelas SET
                tahun_ajaran_id='$tahun',
                kelas_id='$kelas',
                guru_id='$guru',
                tanggal_mulai='$mulai',
                tanggal_selesai='$selesai',
                status_aktif='$status',
                updated_at=NOW()
            WHERE id='$id'
        ");
    }

    header(
        "Location: dashboard.php?page=kelola_wali_kelas"
    );
    exit;
}

/* =========================================================
   CATAT PELANGGARAN
========================================================= */

if (
    ($role === 'admin' || $role === 'guru') &&
    $page === 'catat_pelanggaran' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $siswa_id = (int)($_POST['siswa_id'] ?? 0);
    $pel_id = (int)($_POST['pelanggaran_id'] ?? 0);

    $tanggal = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal'] ?? date('Y-m-d')
    );

    $keterangan = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['keterangan'] ?? '')
    );

    $guru_id = 0;

    $qg = mysqli_query($koneksi, "
        SELECT id
        FROM t_guru
        WHERE user_id='$user_id'
        LIMIT 1
    ");

    if ($qg && mysqli_num_rows($qg) > 0) {
        $dg = mysqli_fetch_assoc($qg);
        $guru_id = (int)$dg['id'];
    }

    /*
     * Jika admin tidak terhubung ke t_guru,
     * gunakan guru pertama yang tersedia.
     */
    if ($guru_id === 0) {

        $qg2 = mysqli_query(
            $koneksi,
            "SELECT id FROM t_guru
             WHERE status_aktif=1
             ORDER BY id ASC
             LIMIT 1"
        );

        if ($qg2 && mysqli_num_rows($qg2) > 0) {
            $dg2 = mysqli_fetch_assoc($qg2);
            $guru_id = (int)$dg2['id'];
        }
    }

    $qs = mysqli_query($koneksi, "
        SELECT
            ks.tahun_ajaran_id,
            ks.kelas_id,
            s.nama AS nama_siswa,
            k.nama AS nama_kelas
        FROM t_kelas_siswa ks
        JOIN t_siswa s
            ON ks.siswa_id=s.id
        JOIN t_kelas k
            ON ks.kelas_id=k.id
        WHERE ks.siswa_id='$siswa_id'
        AND ks.status_aktif=1
        LIMIT 1
    ");

    $siswa_data = mysqli_fetch_assoc($qs);

    $qp = mysqli_query($koneksi, "
        SELECT *
        FROM t_pelanggaran
        WHERE id='$pel_id'
        LIMIT 1
    ");

    $pel_data = mysqli_fetch_assoc($qp);

    if (
        $siswa_data &&
        $pel_data &&
        $guru_id > 0
    ) {

        $nama_siswa_db = mysqli_real_escape_string(
            $koneksi,
            $siswa_data['nama_siswa']
        );

        $nama_kelas_db = mysqli_real_escape_string(
            $koneksi,
            $siswa_data['nama_kelas']
        );

        $nama_pel_db = mysqli_real_escape_string(
            $koneksi,
            $pel_data['nama']
        );

        $nama_guru_db = mysqli_real_escape_string(
            $koneksi,
            $nama
        );

        $kategori_id = (int)$pel_data[
            'pelanggaran_kategori_id'
        ];

        $poin = (int)$pel_data['poin'];

        mysqli_query($koneksi, "
            INSERT INTO t_pelanggaran_siswa
            (
                tahun_ajaran_id,
                siswa_id,
                nama_siswa,
                kelas_id,
                nama_kelas,
                pelanggaran_id,
                nama_pelanggaran,
                pelanggaran_kategori_id,
                guru_id,
                nama_guru,
                tanggal,
                keterangan,
                poin,
                tindakan,
                status,
                created_at,
                updated_at
            )
            VALUES
            (
                '{$siswa_data['tahun_ajaran_id']}',
                '$siswa_id',
                '$nama_siswa_db',
                '{$siswa_data['kelas_id']}',
                '$nama_kelas_db',
                '$pel_id',
                '$nama_pel_db',
                '$kategori_id',
                '$guru_id',
                '$nama_guru_db',
                '$tanggal',
                '$keterangan',
                '$poin',
                '',
                'Pending',
                NOW(),
                NOW()
            )
        ");
    }

    header(
        "Location: dashboard.php?page=catat_pelanggaran"
    );
    exit;
}

/* =========================================================
   EDIT TINDAKAN
========================================================= */

if (
    ($role === 'admin' || $role === 'guru') &&
    $page === 'tindakan' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $id = (int)($_POST['id'] ?? 0);

    $tindakan = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['tindakan'] ?? '')
    );

    $status = mysqli_real_escape_string(
        $koneksi,
        $_POST['status'] ?? 'Pending'
    );

    mysqli_query($koneksi, "
        UPDATE t_pelanggaran_siswa SET
            tindakan='$tindakan',
            status='$status',
            updated_at=NOW()
        WHERE id='$id'
    ");

    header(
        "Location: dashboard.php?page=tindakan"
    );
    exit;
}

/* =========================================================
   DATA DASHBOARD
========================================================= */

$jml_siswa = 0;
$jml_guru = 0;
$jml_kelas = 0;
$jml_pelanggaran = 0;

$q = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM t_siswa"
);

if ($q) {
    $jml_siswa = mysqli_fetch_assoc($q)['total'];
}

$q = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM t_guru"
);

if ($q) {
    $jml_guru = mysqli_fetch_assoc($q)['total'];
}

$q = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM t_kelas"
);

if ($q) {
    $jml_kelas = mysqli_fetch_assoc($q)['total'];
}

$q = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM t_pelanggaran_siswa"
);

if ($q) {
    $jml_pelanggaran = mysqli_fetch_assoc($q)['total'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

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

/* SIDEBAR */

.sidebar {
    background: #20252b;
    min-height: 100vh;
    padding: 20px 15px;
    position: sticky;
    top: 0;
}

.sidebar-title {
    color: white;
    font-size: 21px;
    font-weight: bold;
    margin-bottom: 25px;
}

.menu-title {
    color: #aeb8c4;
    font-size: 12px;
    margin-top: 15px;
    margin-bottom: 8px;
}

.menu-link {
    display: block;
    color: #f1f5f9;
    text-decoration: none;
    padding: 10px 14px;
    border-radius: 8px;
    margin-bottom: 5px;
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

/* CONTENT */

.content {
    padding: 30px;
}

.page-title {
    color: #17365d;
    font-weight: bold;
    margin-bottom: 25px;
}

/* CARD */

.dashboard-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 3px 12px rgba(0,0,0,.08);
    margin-bottom: 20px;
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

.card-pelanggaran {
    background: #e5ddff;
}

/* FORM */

.form-box {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 3px 12px rgba(0,0,0,.08);
    margin-bottom: 25px;
}

.form-control,
.form-select {
    border-radius: 8px;
}

/* BUTTON */

.btn-soft {
    background: #8bbcff;
    color: #17365d;
    border: none;
}

.btn-soft:hover {
    background: #6da9f5;
    color: #17365d;
}

.btn-edit {
    background: #ffd66b;
    color: #513d00;
    border: none;
}

.btn-delete {
    background: #ff9e9e;
    color: #681b1b;
    border: none;
}

/* TABLE */

.table-box {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 3px 12px rgba(0,0,0,.08);
}

.table th {
    background: #d9eaff;
    color: #17365d;
    white-space: nowrap;
}

.table td {
    vertical-align: middle;
}

/* ABOUT */

.about-box {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 3px 12px rgba(0,0,0,.08);
}

.about-header {
    background: #d9eaff;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

/* MOBILE */

@media(max-width: 768px) {

    .sidebar {
        min-height: auto;
        position: relative;
    }

    .content {
        padding: 15px;
    }

    .table-box {
        overflow-x: auto;
    }

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
        Sistem Pelanggaran
    </div>

    <div class="menu-title">
        MENU UTAMA
    </div>

    <a
        href="dashboard.php?page=dashboard"
        class="menu-link <?= $page === 'dashboard' ? 'active' : '' ?>"
    >
        Dashboard
    </a>

    <?php if ($role === 'admin'): ?>

        <div class="menu-title">
            MENU ADMIN
        </div>

        <?php foreach ($menu_admin as $link => $text): ?>

            <a
                href="dashboard.php?page=<?= $link ?>"
                class="menu-link <?= $page === $link ? 'active' : '' ?>"
            >
                <?= e($text) ?>
            </a>

        <?php endforeach; ?>

    <?php endif; ?>


    <?php if ($role === 'guru'): ?>

        <div class="menu-title">
            MENU GURU
        </div>

        <?php foreach ($menu_guru as $link => $text): ?>

            <a
                href="dashboard.php?page=<?= $link ?>"
                class="menu-link <?= $page === $link ? 'active' : '' ?>"
            >
                <?= e($text) ?>
            </a>

        <?php endforeach; ?>

    <?php endif; ?>


    <div class="menu-title">
        LAINNYA
    </div>

    <a
        href="dashboard.php?page=about"
        class="menu-link <?= $page === 'about' ? 'active' : '' ?>"
    >
        About
    </a>

    <a
        href="logout.php"
        class="menu-link"
        onclick="return confirm('Yakin ingin keluar?')"
    >
        Logout
    </a>

</div>


<!-- =====================================================
     CONTENT
===================================================== -->

<div class="col-md-9 col-lg-10 content">

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="page-title mb-1">
            <?= e(ucwords(str_replace('_', ' ', $page))) ?>
        </h2>

        <small class="text-secondary">
            Login sebagai:
            <strong><?= e($nama) ?></strong>
            —
            <?= e(strtoupper($role)) ?>
        </small>
    </div>

</div>


<?php if ($error): ?>

<div class="alert alert-danger">
    <?= e($error) ?>
</div>

<?php endif; ?>


<!-- =====================================================
     DASHBOARD
===================================================== -->

<?php if ($page === 'dashboard'): ?>

<h2 class="page-title">
    Dashboard
</h2>

<div class="row">

    <div class="col-md-3">

        <div class="dashboard-card card-siswa">

            <h6>Total Siswa</h6>

            <h2>
                <?= $jml_siswa ?>
            </h2>

        </div>

    </div>


    <div class="col-md-3">

        <div class="dashboard-card card-guru">

            <h6>Total Guru</h6>

            <h2>
                <?= $jml_guru ?>
            </h2>

        </div>

    </div>


    <div class="col-md-3">

        <div class="dashboard-card card-kelas">

            <h6>Total Kelas</h6>

            <h2>
                <?= $jml_kelas ?>
            </h2>

        </div>

    </div>


    <div class="col-md-3">

        <div class="dashboard-card card-pelanggaran">

            <h6>Total Pelanggaran</h6>

            <h2>
                <?= $jml_pelanggaran ?>
            </h2>

        </div>

    </div>

</div>


<div class="dashboard-card">

    <h4>
        Selamat Datang
    </h4>

    <p class="mb-0">
        Halo,
        <strong><?= e($nama) ?></strong>.
        Kamu login sebagai
        <strong><?= e(ucfirst($role)) ?></strong>.
    </p>

</div>


<!-- =====================================================
     KELOLA SISWA
===================================================== -->

<?php elseif ($page === 'kelola_siswa'): ?>

<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_siswa
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
    <?= $data_edit ? 'Edit Siswa' : 'Tambah Siswa' ?>
</h4>

<form method="POST">

<input
    type="hidden"
    name="aksi"
    value="<?= $data_edit ? 'edit' : 'tambah' ?>"
>

<?php if ($data_edit): ?>

<input
    type="hidden"
    name="id"
    value="<?= $data_edit['id'] ?>"
>

<?php endif; ?>

<div class="row">

<div class="col-md-6 mb-3">

<label>NIS</label>

<input
    type="text"
    name="nis"
    class="form-control"
    required
    value="<?= e($data_edit['nis'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>NISN</label>

<input
    type="text"
    name="nisn"
    class="form-control"
    value="<?= e($data_edit['nisn'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Nama Siswa</label>

<input
    type="text"
    name="nama"
    class="form-control"
    required
    value="<?= e($data_edit['nama'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Jenis Kelamin</label>

<select
    name="jenis_kelamin"
    class="form-select"
>

<option value="L"
<?= (($data_edit['jenis_kelamin'] ?? '') === 'L') ? 'selected' : '' ?>>
Laki-laki
</option>

<option value="P"
<?= (($data_edit['jenis_kelamin'] ?? '') === 'P') ? 'selected' : '' ?>>
Perempuan
</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Tanggal Lahir</label>

<input
    type="date"
    name="tanggal_lahir"
    class="form-control"
    value="<?= e($data_edit['tanggal_lahir'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select
    name="status_aktif"
    class="form-select"
>

<option
value="1"
<?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>
Aktif
</option>

<option
value="0"
<?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>
Tidak Aktif
</option>

</select>

</div>

<div class="col-12 mb-3">

<label>Alamat</label>

<textarea
    name="alamat"
    class="form-control"
    rows="3"
><?= e($data_edit['alamat'] ?? '') ?></textarea>

</div>

</div>

<button class="btn btn-soft">

<?= $data_edit ? 'Update Siswa' : 'Tambah Siswa' ?>

</button>

<?php if ($data_edit): ?>

<a
    href="dashboard.php?page=kelola_siswa"
    class="btn btn-secondary"
>
    Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4 class="mb-3">
    Data Siswa
</h4>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>
<th>No</th>
<th>NIS</th>
<th>NISN</th>
<th>Nama</th>
<th>JK</th>
<th>Tanggal Lahir</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query(
    $koneksi,
    "SELECT * FROM t_siswa
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nis']) ?></td>

<td><?= e($r['nisn']) ?></td>

<td><?= e($r['nama']) ?></td>

<td><?= e($r['jenis_kelamin']) ?></td>

<td><?= e($r['tanggal_lahir']) ?></td>

<td>

<?php if ($r['status_aktif']): ?>

<span class="badge bg-success">
Aktif
</span>

<?php else: ?>

<span class="badge bg-secondary">
Tidak Aktif
</span>

<?php endif; ?>

</td>

<td>

<a
    href="dashboard.php?page=kelola_siswa&edit=<?= $r['id'] ?>"
    class="btn btn-edit btn-sm"
>
    Edit
</a>

<a
    href="dashboard.php?page=kelola_siswa&hapus=siswa&id=<?= $r['id'] ?>"
    class="btn btn-delete btn-sm"
    onclick="return confirm('Yakin ingin menghapus siswa ini?')"
>
    Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     KELOLA GURU
===================================================== -->

<?php elseif ($page === 'kelola_guru'): ?>

<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_guru
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
    <?= $data_edit ? 'Edit Guru' : 'Tambah Guru' ?>
</h4>

<form method="POST">

<input
    type="hidden"
    name="aksi"
    value="<?= $data_edit ? 'edit' : 'tambah' ?>"
>

<?php if ($data_edit): ?>

<input
    type="hidden"
    name="id"
    value="<?= $data_edit['id'] ?>"
>

<?php endif; ?>

<div class="row">

<div class="col-md-6 mb-3">

<label>NIP</label>

<input
    type="text"
    name="nip"
    class="form-control"
    required
    value="<?= e($data_edit['nip'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Nama Guru</label>

<input
    type="text"
    name="nama"
    class="form-control"
    required
    value="<?= e($data_edit['nama'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input
    type="email"
    name="email"
    class="form-control"
    value="<?= e($data_edit['email'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select
    name="status_aktif"
    class="form-select"
>

<option
value="1"
<?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>
Aktif
</option>

<option
value="0"
<?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>
Tidak Aktif
</option>

</select>

</div>

</div>

<button class="btn btn-soft">
<?= $data_edit ? 'Update Guru' : 'Tambah Guru' ?>
</button>

<?php if ($data_edit): ?>

<a
    href="dashboard.php?page=kelola_guru"
    class="btn btn-secondary"
>
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Guru</h4>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>
<th>No</th>
<th>NIP</th>
<th>Nama</th>
<th>Email</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query(
    $koneksi,
    "SELECT * FROM t_guru
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nip']) ?></td>

<td><?= e($r['nama']) ?></td>

<td><?= e($r['email']) ?></td>

<td>

<?= $r['status_aktif']
    ? '<span class="badge bg-success">Aktif</span>'
    : '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=kelola_guru&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=kelola_guru&hapus=guru&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus guru ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     KELOLA KELAS
===================================================== -->

<?php elseif ($page === 'kelola_kelas'): ?>

<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_kelas
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
<?= $data_edit ? 'Edit Kelas' : 'Tambah Kelas' ?>
</h4>

<form method="POST">

<input
type="hidden"
name="aksi"
value="<?= $data_edit ? 'edit' : 'tambah' ?>"
>

<?php if ($data_edit): ?>

<input
type="hidden"
name="id"
value="<?= $data_edit['id'] ?>"
>

<?php endif; ?>

<div class="row">

<div class="col-md-4 mb-3">

<label>Nama Kelas</label>

<input
type="text"
name="nama"
class="form-control"
required
placeholder="Contoh: XII RPL 2"
value="<?= e($data_edit['nama'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Tingkat</label>

<input
type="text"
name="tingkat"
class="form-control"
placeholder="Contoh: XII"
value="<?= e($data_edit['tingkat'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Jurusan</label>

<input
type="text"
name="jurusan"
class="form-control"
placeholder="Contoh: RPL"
value="<?= e($data_edit['jurusan'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Status</label>

<select name="status_aktif" class="form-select">

<option value="1"
<?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>
Aktif
</option>

<option value="0"
<?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>
Tidak Aktif
</option>

</select>

</div>

</div>

<button class="btn btn-soft">
<?= $data_edit ? 'Update Kelas' : 'Tambah Kelas' ?>
</button>

<?php if ($data_edit): ?>

<a
href="dashboard.php?page=kelola_kelas"
class="btn btn-secondary">
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Kelas</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Nama Kelas</th>
<th>Tingkat</th>
<th>Jurusan</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query(
    $koneksi,
    "SELECT * FROM t_kelas
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama']) ?></td>

<td><?= e($r['tingkat']) ?></td>

<td><?= e($r['jurusan']) ?></td>

<td>

<?= $r['status_aktif']
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=kelola_kelas&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=kelola_kelas&hapus=kelas&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus kelas ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     TAHUN AJARAN
===================================================== -->

<?php elseif ($page === 'kelola_tahun_ajaran'): ?>

<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_tahun_ajaran
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
<?= $data_edit ? 'Edit Tahun Ajaran' : 'Tambah Tahun Ajaran' ?>
</h4>

<form method="POST">

<input
type="hidden"
name="aksi"
value="<?= $data_edit ? 'edit' : 'tambah' ?>"
>

<?php if ($data_edit): ?>

<input
type="hidden"
name="id"
value="<?= $data_edit['id'] ?>"
>

<?php endif; ?>

<div class="row">

<div class="col-md-4 mb-3">

<label>Tahun Ajaran</label>

<input
type="text"
name="nama"
class="form-control"
required
placeholder="2026/2027"
value="<?= e($data_edit['nama'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Tanggal Mulai</label>

<input
type="date"
name="tanggal_mulai"
class="form-control"
value="<?= e($data_edit['tanggal_mulai'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Tanggal Selesai</label>

<input
type="date"
name="tanggal_selesai"
class="form-control"
value="<?= e($data_edit['tanggal_selesai'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Status</label>

<select name="status_aktif" class="form-select">

<option value="1"
<?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>
Aktif
</option>

<option value="0"
<?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>
Tidak Aktif
</option>

</select>

</div>

</div>

<button class="btn btn-soft">
<?= $data_edit ? 'Update' : 'Tambah' ?>
</button>

<?php if ($data_edit): ?>

<a
href="dashboard.php?page=kelola_tahun_ajaran"
class="btn btn-secondary">
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Tahun Ajaran</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Tahun Ajaran</th>
<th>Mulai</th>
<th>Selesai</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query(
    $koneksi,
    "SELECT * FROM t_tahun_ajaran
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama']) ?></td>

<td><?= e($r['tanggal_mulai']) ?></td>

<td><?= e($r['tanggal_selesai']) ?></td>

<td>

<?= $r['status_aktif']
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=kelola_tahun_ajaran&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=kelola_tahun_ajaran&hapus=tahun&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus tahun ajaran ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     KATEGORI PELANGGARAN
===================================================== -->

<?php elseif ($page === 'kelola_kategori'): ?>

<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_pelanggaran_kategori
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
<?= $data_edit ? 'Edit Kategori' : 'Tambah Kategori' ?>
</h4>

<form method="POST">

<input
type="hidden"
name="aksi"
value="<?= $data_edit ? 'edit' : 'tambah' ?>"
>

<?php if ($data_edit): ?>

<input
type="hidden"
name="id"
value="<?= $data_edit['id'] ?>"
>

<?php endif; ?>

<div class="mb-3">

<label>Nama Kategori</label>

<input
type="text"
name="nama"
class="form-control"
required
value="<?= e($data_edit['nama'] ?? '') ?>"
>

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"
rows="3"
><?= e($data_edit['deskripsi'] ?? '') ?></textarea>

</div>

<div class="mb-3">

<label>Status</label>

<select name="status_aktif" class="form-select">

<option value="1"
<?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>
Aktif
</option>

<option value="0"
<?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>
Tidak Aktif
</option>

</select>

</div>

<button class="btn btn-soft">
<?= $data_edit ? 'Update' : 'Tambah' ?>
</button>

<?php if ($data_edit): ?>

<a
href="dashboard.php?page=kelola_kategori"
class="btn btn-secondary">
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Kategori Pelanggaran</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Nama</th>
<th>Deskripsi</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query(
    $koneksi,
    "SELECT * FROM t_pelanggaran_kategori
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama']) ?></td>

<td><?= e($r['deskripsi']) ?></td>

<td>

<?= $r['status_aktif']
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=kelola_kategori&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=kelola_kategori&hapus=kategori&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus kategori ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     JENIS PELANGGARAN
===================================================== -->

<?php elseif ($page === 'kelola_jenis_pelanggaran'): ?>

<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_pelanggaran
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
<?= $data_edit ? 'Edit Jenis Pelanggaran' : 'Tambah Jenis Pelanggaran' ?>
</h4>

<form method="POST">

<input
type="hidden"
name="aksi"
value="<?= $data_edit ? 'edit' : 'tambah' ?>"
>

<?php if ($data_edit): ?>

<input
type="hidden"
name="id"
value="<?= $data_edit['id'] ?>"
>

<?php endif; ?>

<div class="row">

<div class="col-md-4 mb-3">

<label>Kategori</label>

<select
name="pelanggaran_kategori_id"
class="form-select"
required
>

<?php

$qkat = mysqli_query(
    $koneksi,
    "SELECT * FROM t_pelanggaran_kategori
     WHERE status_aktif=1
     ORDER BY nama ASC"
);

while ($kat = mysqli_fetch_assoc($qkat)):

?>

<option
value="<?= $kat['id'] ?>"
<?= (($data_edit['pelanggaran_kategori_id'] ?? '') == $kat['id']) ? 'selected' : '' ?>
>

<?= e($kat['nama']) ?>

</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Kode</label>

<input
type="text"
name="kode"
class="form-control"
required
placeholder="PLG-051"
value="<?= e($data_edit['kode'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Poin</label>

<input
type="number"
name="poin"
class="form-control"
required
value="<?= e($data_edit['poin'] ?? '') ?>"
>

</div>

<div class="col-12 mb-3">

<label>Nama Pelanggaran</label>

<input
type="text"
name="nama"
class="form-control"
required
value="<?= e($data_edit['nama'] ?? '') ?>"
>

</div>

<div class="col-12 mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"
rows="3"
><?= e($data_edit['deskripsi'] ?? '') ?></textarea>

</div>

<div class="col-md-4 mb-3">

<label>Status</label>

<select name="status_aktif" class="form-select">

<option value="1"
<?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>
Aktif
</option>

<option value="0"
<?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>
Tidak Aktif
</option>

</select>

</div>

</div>

<button class="btn btn-soft">
<?= $data_edit ? 'Update' : 'Tambah' ?>
</button>

<?php if ($data_edit): ?>

<a
href="dashboard.php?page=kelola_jenis_pelanggaran"
class="btn btn-secondary">
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Jenis Pelanggaran</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Kode</th>
<th>Nama Pelanggaran</th>
<th>Poin</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query(
    $koneksi,
    "SELECT * FROM t_pelanggaran
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['kode']) ?></td>

<td><?= e($r['nama']) ?></td>

<td>
<span class="badge bg-primary">
<?= e($r['poin']) ?>
</span>
</td>

<td>

<?= $r['status_aktif']
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=kelola_jenis_pelanggaran&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=kelola_jenis_pelanggaran&hapus=pelanggaran&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus pelanggaran ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     PENEMPATAN SISWA
===================================================== -->

<?php elseif ($page === 'penempatan_siswa'): ?>

<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_kelas_siswa
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
<?= $data_edit ? 'Edit Penempatan' : 'Tambah Penempatan' ?>
</h4>

<form method="POST">

<input
type="hidden"
name="aksi"
value="<?= $data_edit ? 'edit' : 'tambah' ?>"
>

<?php if ($data_edit): ?>

<input
type="hidden"
name="id"
value="<?= $data_edit['id'] ?>"
>

<?php endif; ?>

<div class="row">

<div class="col-md-4 mb-3">

<label>Siswa</label>

<select name="siswa_id" class="form-select" required>

<?php

$qs = mysqli_query(
    $koneksi,
    "SELECT id,nama FROM t_siswa
     ORDER BY nama ASC"
);

while ($s = mysqli_fetch_assoc($qs)):

?>

<option
value="<?= $s['id'] ?>"
<?= (($data_edit['siswa_id'] ?? '') == $s['id']) ? 'selected' : '' ?>
>
<?= e($s['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Tahun Ajaran</label>

<select
name="tahun_ajaran_id"
class="form-select"
required
>

<?php

$qt = mysqli_query(
    $koneksi,
    "SELECT id,nama FROM t_tahun_ajaran
     ORDER BY id DESC"
);

while ($t = mysqli_fetch_assoc($qt)):

?>

<option
value="<?= $t['id'] ?>"
<?= (($data_edit['tahun_ajaran_id'] ?? '') == $t['id']) ? 'selected' : '' ?>
>
<?= e($t['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Kelas</label>

<select
name="kelas_id"
class="form-select"
required
>

<?php

$qk = mysqli_query(
    $koneksi,
    "SELECT id,nama FROM t_kelas
     ORDER BY nama ASC"
);

while ($k = mysqli_fetch_assoc($qk)):

?>

<option
value="<?= $k['id'] ?>"
<?= (($data_edit['kelas_id'] ?? '') == $k['id']) ? 'selected' : '' ?>
>
<?= e($k['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Tanggal Mulai</label>

<input
type="date"
name="tanggal_mulai"
class="form-control"
value="<?= e($data_edit['tanggal_mulai'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Tanggal Selesai</label>

<input
type="date"
name="tanggal_selesai"
class="form-control"
value="<?= e($data_edit['tanggal_selesai'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Status</label>

<select name="status_aktif" class="form-select">

<option value="1"
<?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>
Aktif
</option>

<option value="0"
<?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>
Tidak Aktif
</option>

</select>

</div>

</div>

<button class="btn btn-soft">
<?= $data_edit ? 'Update' : 'Tambah' ?>
</button>

<?php if ($data_edit): ?>

<a
href="dashboard.php?page=penempatan_siswa"
class="btn btn-secondary">
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Penempatan Siswa</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Siswa</th>
<th>Tahun Ajaran</th>
<th>Kelas</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT
        ks.*,
        s.nama AS nama_siswa,
        k.nama AS nama_kelas,
        ta.nama AS tahun
    FROM t_kelas_siswa ks
    LEFT JOIN t_siswa s
        ON ks.siswa_id=s.id
    LEFT JOIN t_kelas k
        ON ks.kelas_id=k.id
    LEFT JOIN t_tahun_ajaran ta
        ON ks.tahun_ajaran_id=ta.id
    ORDER BY ks.id DESC
");

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama_siswa']) ?></td>

<td><?= e($r['tahun']) ?></td>

<td><?= e($r['nama_kelas']) ?></td>

<td>

<?= $r['status_aktif']
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=penempatan_siswa&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=penempatan_siswa&hapus=penempatan&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus penempatan ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     WALI KELAS
===================================================== -->

<?php elseif ($page === 'kelola_wali_kelas'): ?>

<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_wali_kelas
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
<?= $data_edit ? 'Edit Wali Kelas' : 'Tambah Wali Kelas' ?>
</h4>

<form method="POST">

<input
type="hidden"
name="aksi"
value="<?= $data_edit ? 'edit' : 'tambah' ?>"
>

<?php if ($data_edit): ?>

<input
type="hidden"
name="id"
value="<?= $data_edit['id'] ?>"
>

<?php endif; ?>

<div class="row">

<div class="col-md-4 mb-3">

<label>Tahun Ajaran</label>

<select
name="tahun_ajaran_id"
class="form-select"
required
>

<?php

$q = mysqli_query(
    $koneksi,
    "SELECT id,nama
     FROM t_tahun_ajaran
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<option
value="<?= $r['id'] ?>"
<?= (($data_edit['tahun_ajaran_id'] ?? '') == $r['id']) ? 'selected' : '' ?>
>
<?= e($r['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Kelas</label>

<select
name="kelas_id"
class="form-select"
required
>

<?php

$q = mysqli_query(
    $koneksi,
    "SELECT id,nama
     FROM t_kelas
     ORDER BY nama"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<option
value="<?= $r['id'] ?>"
<?= (($data_edit['kelas_id'] ?? '') == $r['id']) ? 'selected' : '' ?>
>
<?= e($r['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Guru</label>

<select
name="guru_id"
class="form-select"
required
>

<?php

$q = mysqli_query(
    $koneksi,
    "SELECT id,nama
     FROM t_guru
     WHERE status_aktif=1
     ORDER BY nama"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<option
value="<?= $r['id'] ?>"
<?= (($data_edit['guru_id'] ?? '') == $r['id']) ? 'selected' : '' ?>
>
<?= e($r['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Tanggal Mulai</label>

<input
type="date"
name="tanggal_mulai"
class="form-control"
value="<?= e($data_edit['tanggal_mulai'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Tanggal Selesai</label>

<input
type="date"
name="tanggal_selesai"
class="form-control"
value="<?= e($data_edit['tanggal_selesai'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Status</label>

<select name="status_aktif" class="form-select">

<option value="1"
<?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>
Aktif
</option>

<option value="0"
<?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>
Tidak Aktif
</option>

</select>

</div>

</div>

<button class="btn btn-soft">
<?= $data_edit ? 'Update' : 'Tambah' ?>
</button>

<?php if ($data_edit): ?>

<a
href="dashboard.php?page=kelola_wali_kelas"
class="btn btn-secondary">
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Wali Kelas</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Tahun</th>
<th>Kelas</th>
<th>Guru</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT
        wk.*,
        ta.nama AS tahun,
        k.nama AS kelas,
        g.nama AS guru
    FROM t_wali_kelas wk
    LEFT JOIN t_tahun_ajaran ta
        ON wk.tahun_ajaran_id=ta.id
    LEFT JOIN t_kelas k
        ON wk.kelas_id=k.id
    LEFT JOIN t_guru g
        ON wk.guru_id=g.id
    ORDER BY wk.id DESC
");

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['tahun']) ?></td>

<td><?= e($r['kelas']) ?></td>

<td><?= e($r['guru']) ?></td>

<td>

<?= $r['status_aktif']
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=kelola_wali_kelas&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=kelola_wali_kelas&hapus=wali&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus wali kelas ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     CATAT PELANGGARAN
===================================================== -->

<?php elseif ($page === 'catat_pelanggaran'): ?>

<div class="form-box">

<h4>
Catat Pelanggaran Siswa
</h4>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nama Siswa</label>

<select
name="siswa_id"
class="form-select"
required
>

<option value="">
-- Pilih Siswa --
</option>

<?php

$q = mysqli_query(
    $koneksi,
    "SELECT id,nama
     FROM t_siswa
     WHERE status_aktif=1
     ORDER BY nama"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<option value="<?= $r['id'] ?>">
<?= e($r['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Jenis Pelanggaran</label>

<select
name="pelanggaran_id"
class="form-select"
required
>

<option value="">
-- Pilih Pelanggaran --
</option>

<?php

$q = mysqli_query(
    $koneksi,
    "SELECT id,kode,nama,poin
     FROM t_pelanggaran
     WHERE status_aktif=1
     ORDER BY nama"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<option value="<?= $r['id'] ?>">
<?= e($r['kode']) ?> -
<?= e($r['nama']) ?>
(<?= e($r['poin']) ?> poin)
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
value="<?= date('Y-m-d') ?>"
required
>

</div>

<div class="col-12 mb-3">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control"
rows="4"
placeholder="Masukkan keterangan pelanggaran..."
></textarea>

</div>

</div>

<button class="btn btn-soft">
Simpan Pelanggaran
</button>

</form>

</div>


<div class="table-box">

<h4>
Data Pelanggaran Terbaru
</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Nama Siswa</th>
<th>Kelas</th>
<th>Pelanggaran</th>
<th>Poin</th>
<th>Tanggal</th>
<th>Status</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT *
    FROM t_pelanggaran_siswa
    ORDER BY id DESC
");

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama_siswa']) ?></td>

<td><?= e($r['nama_kelas']) ?></td>

<td><?= e($r['nama_pelanggaran']) ?></td>

<td><?= e($r['poin']) ?></td>

<td><?= e($r['tanggal']) ?></td>

<td><?= e($r['status']) ?></td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     TINDAKAN
===================================================== -->

<?php elseif ($page === 'tindakan'): ?>

<div class="table-box">

<h4>
Data Tindakan Pelanggaran
</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Siswa</th>
<th>Pelanggaran</th>
<th>Poin</th>
<th>Tindakan</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT *
    FROM t_pelanggaran_siswa
    ORDER BY id DESC
");

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama_siswa']) ?></td>

<td><?= e($r['nama_pelanggaran']) ?></td>

<td><?= e($r['poin']) ?></td>

<td>

<form method="POST">

<input
type="hidden"
name="id"
value="<?= $r['id'] ?>"
>

<input
type="text"
name="tindakan"
class="form-control form-control-sm"
value="<?= e($r['tindakan']) ?>"
>

</td>

<td>

<select
name="status"
class="form-select form-select-sm"
>

<option
value="Pending"
<?= $r['status'] === 'Pending' ? 'selected' : '' ?>>
Pending
</option>

<option
value="Proses"
<?= $r['status'] === 'Proses' ? 'selected' : '' ?>>
Proses
</option>

<option
value="Selesai"
<?= $r['status'] === 'Selesai' ? 'selected' : '' ?>>
Selesai
</option>

</select>

</td>

<td>

<button
class="btn btn-soft btn-sm"
type="submit"
>
Simpan
</button>

</form>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     LAPORAN
===================================================== -->

<?php elseif ($page === 'laporan'): ?>

<div class="dashboard-card">

<h4>
Laporan Pelanggaran
</h4>

<p>
Berikut merupakan data pelanggaran siswa yang tersimpan
dalam sistem.
</p>

</div>

<div class="table-box">

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Siswa</th>
<th>Kelas</th>
<th>Pelanggaran</th>
<th>Poin</th>
<th>Tanggal</th>
<th>Status</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT *
    FROM t_pelanggaran_siswa
    ORDER BY tanggal DESC, id DESC
");

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama_siswa']) ?></td>

<td><?= e($r['nama_kelas']) ?></td>

<td><?= e($r['nama_pelanggaran']) ?></td>

<td><?= e($r['poin']) ?></td>

<td><?= e($r['tanggal']) ?></td>

<td><?= e($r['status']) ?></td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     RIWAYAT
===================================================== -->

<?php elseif ($page === 'riwayat'): ?>

<div class="table-box">

<h4>
Riwayat Pelanggaran
</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Tanggal</th>
<th>Siswa</th>
<th>Kelas</th>
<th>Pelanggaran</th>
<th>Poin</th>
<th>Tindakan</th>
<th>Status</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT *
    FROM t_pelanggaran_siswa
    ORDER BY tanggal DESC, id DESC
");

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['tanggal']) ?></td>

<td><?= e($r['nama_siswa']) ?></td>

<td><?= e($r['nama_kelas']) ?></td>

<td><?= e($r['nama_pelanggaran']) ?></td>

<td><?= e($r['poin']) ?></td>

<td><?= e($r['tindakan']) ?></td>

<td><?= e($r['status']) ?></td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     REKAP POIN
===================================================== -->

<?php elseif ($page === 'rekap_poin'): ?>

<div class="table-box">

<h4>
Rekap Poin Siswa
</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Siswa</th>
<th>Total Poin</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT
        siswa_id,
        nama_siswa,
        SUM(poin) AS total_poin
    FROM t_pelanggaran_siswa
    GROUP BY siswa_id, nama_siswa
    ORDER BY total_poin DESC
");

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama_siswa']) ?></td>

<td>

<span class="badge bg-primary">
<?= e($r['total_poin']) ?> poin
</span>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>


<!-- =====================================================
     ABOUT
===================================================== -->

<?php elseif ($page === 'about'): ?>

<div class="about-box">

<div class="about-header">

<h3>
About
</h3>

<p class="mb-0">
Sistem Informasi Pelanggaran Siswa
</p>

</div>

<h5>
Tentang Saya
</h5>

<p>
Halo, aku Arfa.
</p>

<p>
Nama: <strong>Arfa Disa Okamameliza</strong>
</p>

<p>
Tempat, tanggal lahir:
<strong>Tasikmalaya, 9 Oktober 2008</strong>
</p>

<p>
Alamat:
<strong>Cieunteung Gede</strong>
</p>

<h5 class="mt-4">
Hobi
</h5>

<ul>
<li>Tidur</li>
<li>Bernyanyi</li>
<li>Scrolling</li>
</ul>

</div>

<?php endif; ?>

</div>

</div>

</div>

</body>
</html>