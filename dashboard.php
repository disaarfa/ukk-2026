<?php
require_once 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

/* =====================
   AMBIL DATA USER LOGIN
   ===================== */

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

/* ====================
   MENU
   ==================== */

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

/* =====================
   EXPORT LAPORAN CSV
   ===================== */

if ($page === 'laporan' && ($_GET['export'] ?? '') === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="laporan_pelanggaran_siswa.csv"');

    $output = fopen('php://output', 'w');

    fwrite($output, "\xEF\xBB\xBF");

    fputcsv($output, [
        'No',
        'Siswa',
        'Kelas',
        'Pelanggaran',
        'Poin',
        'Tanggal',
        'Status'
    ]);

    $export_q = mysqli_query(
        $koneksi,
        "SELECT * FROM t_pelanggaran_siswa
         ORDER BY tanggal DESC, id DESC"
    );

    $no_export = 1;

    if ($export_q) {
        while ($row_export = mysqli_fetch_assoc($export_q)) {
            fputcsv($output, [
                $no_export++,
                $row_export['nama_siswa'] ?? '',
                $row_export['nama_kelas'] ?? '',
                $row_export['nama_pelanggaran'] ?? '',
                $row_export['poin'] ?? '',
                $row_export['tanggal'] ?? '',
                $row_export['status'] ?? ''
            ]);
        }
    }

    fclose($output);
    exit;
}

/* ======================
   FUNGSI ESCAPE
   ====================== */

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
    isset($_GET['hapus'], $_GET['id']) &&
    $role === 'admin'
) {
    $jenis = $_GET['hapus'];
    $id = (int)$_GET['id'];

    $tabel = [
        'siswa'       => 't_siswa',
        'guru'        => 't_guru',
        'kelas'       => 't_kelas',
        'tahun'       => 't_tahun_ajaran',
        'kategori'    => 't_pelanggaran_kategori',
        'pelanggaran' => 't_pelanggaran',
        'penempatan'  => 't_kelas_siswa',
        'wali'        => 't_wali_kelas'
    ];

    if ($id <= 0) {
        $error = "ID data tidak valid.";
    } elseif (!isset($tabel[$jenis])) {
        $error = "Jenis data yang akan dihapus tidak ditemukan.";
    } else {
        $nama_tabel = $tabel[$jenis];

        $stmt = mysqli_prepare(
            $koneksi,
            "DELETE FROM `$nama_tabel` WHERE id = ?"
        );

        if (!$stmt) {
            $error = "Query gagal disiapkan: " .
                     mysqli_error($koneksi);
        } else {
            mysqli_stmt_bind_param($stmt, "i", $id);

            $berhasil = mysqli_stmt_execute($stmt);
            $jumlah = mysqli_stmt_affected_rows($stmt);
            $pesan_mysql = mysqli_stmt_error($stmt);

            mysqli_stmt_close($stmt);

            if (!$berhasil) {
                $error = "Data gagal dihapus. Penyebab: " .
                         $pesan_mysql;
            } elseif ($jumlah === 0) {
                $error = "Data tidak ditemukan atau sudah dihapus.";
            } else {
                header(
                    "Location: dashboard.php?page=" .
                    urlencode($page) .
                    "&hapus_berhasil=1"
                );
                exit;
            }
        }
    }
}

/* ============
   CRUD SISWA
   ============ */

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
                nis, nisn, nama, jenis_kelamin,
                tanggal_lahir, alamat, status_aktif,
                created_at, updated_at
            )
            VALUES
            (
                '$nis', '$nisn', '$nama_siswa', '$jk',
                '$tanggal', '$alamat', '$status',
                NOW(), NOW()
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

/* ===============
   CRUD GURU
   =============== */

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
                nip, nama, email, status_aktif,
                created_at, updated_at
            )
            VALUES
            (
                '$nip', '$nama_guru', '$email_guru',
                '$status', NOW(), NOW()
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

/* ================
   CRUD KELAS
   ================ */

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
                nama, tingkat, jurusan, status_aktif,
                created_at, updated_at
            )
            VALUES
            (
                '$nama_kelas', '$tingkat', '$jurusan',
                '$status', NOW(), NOW()
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

/* ==================
   CRUD TAHUN AJARAN
   ================== */

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
                nama, tanggal_mulai, tanggal_selesai,
                status_aktif, created_at, updated_at
            )
            VALUES
            (
                '$nama', '$mulai', '$selesai',
                '$status', NOW(), NOW()
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

    header("Location: dashboard.php?page=kelola_tahun_ajaran");
    exit;
}
/* ===============
   CRUD KATEGORI
   =============== */

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
                nama, deskripsi, status_aktif,
                created_at, updated_at
            )
            VALUES
            (
                '$nama', '$deskripsi', '$status',
                NOW(), NOW()
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

    header("Location: dashboard.php?page=kelola_kategori");
    exit;
}

/* =========================
   CRUD JENIS PELANGGARAN
   ========================= */

if (
    $role === 'admin' &&
    $page === 'kelola_jenis_pelanggaran' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {
    $aksi = $_POST['aksi'] ?? '';
    $kategori = (int)($_POST['pelanggaran_kategori_id'] ?? 0);

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
                pelanggaran_kategori_id, kode, nama, poin,
                deskripsi, status_aktif, created_at, updated_at
            )
            VALUES
            (
                '$kategori', '$kode', '$nama', '$poin',
                '$deskripsi', '$status', NOW(), NOW()
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

    header("Location: dashboard.php?page=kelola_jenis_pelanggaran");
    exit;
}

/* ========================
   CRUD PENEMPATAN SISWA
   ======================== */

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
                siswa_id, tahun_ajaran_id, kelas_id,
                tanggal_mulai, tanggal_selesai, status_aktif,
                created_at, updated_at
            )
            VALUES
            (
                '$siswa', '$tahun', '$kelas',
                '$mulai', '$selesai', '$status',
                NOW(), NOW()
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

    header("Location: dashboard.php?page=penempatan_siswa");
    exit;
}

/* ====================
   CRUD WALI KELAS
   ==================== */

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
                tahun_ajaran_id, kelas_id, guru_id,
                tanggal_mulai, tanggal_selesai, status_aktif,
                created_at, updated_at
            )
            VALUES
            (
                '$tahun', '$kelas', '$guru',
                '$mulai', '$selesai', '$status',
                NOW(), NOW()
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

    header("Location: dashboard.php?page=kelola_wali_kelas");
    exit;
}

/* ======================
   CATAT PELANGGARAN
   ====================== */

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
        SELECT id FROM t_guru
        WHERE user_id='$user_id'
        LIMIT 1
    ");

    if ($qg && mysqli_num_rows($qg) > 0) {
        $dg = mysqli_fetch_assoc($qg);
        $guru_id = (int)$dg['id'];
    }

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
        JOIN t_siswa s ON ks.siswa_id=s.id
        JOIN t_kelas k ON ks.kelas_id=k.id
        WHERE ks.siswa_id='$siswa_id'
        AND ks.status_aktif=1
        LIMIT 1
    ");

    $siswa_data = $qs ? mysqli_fetch_assoc($qs) : null;

    $qp = mysqli_query($koneksi, "
        SELECT * FROM t_pelanggaran
        WHERE id='$pel_id'
        LIMIT 1
    ");

    $pel_data = $qp ? mysqli_fetch_assoc($qp) : null;

    if ($siswa_data && $pel_data && $guru_id > 0) {
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

        $kategori_id = (int)$pel_data['pelanggaran_kategori_id'];
        $poin = (int)$pel_data['poin'];

        mysqli_query($koneksi, "
            INSERT INTO t_pelanggaran_siswa
            (
                tahun_ajaran_id, siswa_id, nama_siswa,
                kelas_id, nama_kelas, pelanggaran_id,
                nama_pelanggaran, pelanggaran_kategori_id,
                guru_id, nama_guru, tanggal, keterangan,
                poin, tindakan, status, created_at, updated_at
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

    header("Location: dashboard.php?page=catat_pelanggaran");
    exit;
}

/* ===================
   EDIT TINDAKAN
   =================== */

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

    header("Location: dashboard.php?page=tindakan");
    exit;
}


/* ==================
   DATA DASHBOARD
   ================== */

$jml_siswa = 0;
$jml_guru = 0;
$jml_kelas = 0;
$jml_pelanggaran = 0;

$q = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM t_siswa");
if ($q) {
    $jml_siswa = mysqli_fetch_assoc($q)['total'];
}

$q = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM t_guru");
if ($q) {
    $jml_guru = mysqli_fetch_assoc($q)['total'];
}

$q = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM t_kelas");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Informasi Pelanggaran Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0f6ff;
            color: #263b59;
        }

        /* SIDEBAR */
        .sidebar {
            background: #e2efff;
            min-height: 100vh;
            padding: 20px 15px;
            position: sticky;
            top: 0;
            border-right: 1px solid #cbdff8;
        }

        .sidebar-title {
            color: #234b7b;
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .menu-title {
            color: #7188a6;
            font-size: 12px;
            margin-top: 15px;
            margin-bottom: 8px;
        }

        .menu-link {
            display: block;
            color: #365577;
            text-decoration: none;
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

        /* CONTENT */
        .content {
            padding: 30px;
        }

        .page-title {
            color: #234b7b;
            font-weight: bold;
            margin-bottom: 25px;
        }

        /* CARD */
        .dashboard-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(65, 105, 160, 0.10);
            margin-bottom: 20px;
            border: 1px solid #e1ebf8;
        }

        .card-siswa {
            background: #dceeff;
        }

        .card-guru {
            background: #e7e4ff;
        }

        .card-kelas {
            background: #d9f3f0;
        }

        .card-pelanggaran {
            background: #fce5f0;
        }

        /* FORM */
        .form-box {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(65, 105, 160, 0.10);
            margin-bottom: 25px;
            border: 1px solid #e1ebf8;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border-color: #cfdef0;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #8bbcff;
            box-shadow: 0 0 0 0.2rem rgba(139, 188, 255, 0.25);
        }

        /* BUTTON */
        .btn-soft {
            background: #8bbcff;
            color: #17365d;
            border: none;
            border-radius: 8px;
        }

        .btn-soft:hover {
            background: #6da9f5;
            color: #17365d;
        }

        .btn-edit {
            background: #d9e7ff;
            color: #234b7b;
            border: none;
            border-radius: 7px;
        }

        .btn-edit:hover {
            background: #bdd5ff;
            color: #17365d;
        }

        .btn-delete {
            background: #ffdfe5;
            color: #8b3045;
            border: none;
            border-radius: 7px;
        }

        .btn-delete:hover {
            background: #ffc7d2;
            color: #762338;
        }

        /* TABLE */
        .table-box {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(65, 105, 160, 0.10);
            border: 1px solid #e1ebf8;
        }

        .table th {
            background: #d9eaff;
            color: #234b7b;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
        }

        .table tbody tr:hover td {
            background: #f2f7ff;
        }

        /* ABOUT */
        .about-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(65, 105, 160, 0.10);
            border: 1px solid #e1ebf8;
        }

        .about-header {
            background: #d9eaff;
            color: #234b7b;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* PENCARIAN TABEL */
        .search-table-box {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }

        .search-table {
            width: 100%;
            max-width: 350px;
            padding: 10px 14px;
            border: 1px solid #cbdff5;
            border-radius: 10px;
            outline: none;
            background: #ffffff;
            color: #334155;
            transition: 0.2s;
        }

        .search-table:focus {
            border-color: #8bbcff;
            box-shadow: 0 0 0 3px rgba(139, 188, 255, 0.2);
        }

        .search-info {
            font-size: 13px;
            color: #7188a6;
            margin-top: 5px;
        }

        /* MOBILE */
        @media (max-width: 768px) {
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

        @media (max-width: 576px) {
            .search-table-box {
                justify-content: stretch;
            }

            .search-table {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 sidebar">
            <div class="sidebar-title">
                Sistem Informasi Pelanggaran Siswa
            </div>

            <div class="menu-title">MENU UTAMA</div>

            <a
                href="dashboard.php?page=dashboard"
                class="menu-link <?= $page === 'dashboard' ? 'active' : '' ?>"
            >
                Dashboard
            </a>

            <?php if ($role === 'admin'): ?>
                <div class="menu-title">MENU ADMIN</div>

                <?php foreach ($menu_admin as $link => $text): ?>
                    <a
                        href="dashboard.php?page=<?= e($link) ?>"
                        class="menu-link <?= $page === $link ? 'active' : '' ?>"
                    >
                        <?= e($text) ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($role === 'guru'): ?>
                <div class="menu-title">MENU GURU</div>

                <?php foreach ($menu_guru as $link => $text): ?>
                    <a
                        href="dashboard.php?page=<?= e($link) ?>"
                        class="menu-link <?= $page === $link ? 'active' : '' ?>"
                    >
                        <?= e($text) ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="menu-title">LAINNYA</div>

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

        <!-- CONTENT -->
        <div class="col-md-9 col-lg-10 content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="page-title mb-1">
                        <?= e(ucwords(str_replace('_', ' ', $page))) ?>
                    </h2>
                </div>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <?php
            $halaman_file = [
                'dashboard' => 'beranda.php',
                'kelola_siswa' => 'kelola_siswa.php',
                'kelola_guru' => 'kelola_guru.php',
                'kelola_kelas' => 'kelola_kelas.php',
                'kelola_tahun_ajaran' => 'kelola_tahun_ajaran.php',
                'kelola_kategori' => 'kelola_kategori.php',
                'kelola_jenis_pelanggaran' => 'kelola_jenis_pelanggaran.php',
                'penempatan_siswa' => 'penempatan_siswa.php',
                'kelola_wali_kelas' => 'kelola_wali_kelas.php',
                'catat_pelanggaran' => 'catat_pelanggaran.php',
                'tindakan' => 'tindakan.php',
                'laporan' => 'laporan.php',
                'riwayat' => 'riwayat.php',
                'rekap_poin' => 'rekap_poin.php',
                'about' => 'about.php'
            ];

            if (isset($halaman_file[$page])) {
                require __DIR__ . '/' . $halaman_file[$page];
            }
            ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tables = document.querySelectorAll(
        '.table-box table, .dashboard-card table, #area-laporan table'
    );

    tables.forEach(function (table) {
        if (table.dataset.searchReady === '1') {
            return;
        }

        table.dataset.searchReady = '1';

        const searchBox = document.createElement('div');
        searchBox.className = 'search-table-box';

        const input = document.createElement('input');
        input.type = 'search';
        input.className = 'search-table';
        input.placeholder = '🔍 Cari data dalam tabel...';
        input.setAttribute('aria-label', 'Cari data tabel');

        searchBox.appendChild(input);

        const wrapper = table.closest('.table-responsive');

        if (wrapper) {
            wrapper.parentNode.insertBefore(searchBox, wrapper);
        } else {
            table.parentNode.insertBefore(searchBox, table);
        }

        const info = document.createElement('div');
        info.className = 'search-info';
        searchBox.insertAdjacentElement('afterend', info);

        const rows = Array.from(
            table.querySelectorAll('tbody tr')
        );

        function filterRows() {
            const keyword = input.value.trim().toLowerCase();
            let jumlah = 0;

            rows.forEach(function (row) {
                const text = row.textContent.toLowerCase();
                const cocok = text.includes(keyword);

                row.style.display = cocok ? '' : 'none';

                if (cocok) {
                    jumlah++;
                }
            });

            info.textContent = keyword
                ? jumlah + ' data ditemukan'
                : rows.length + ' data ditampilkan';
        }

        input.addEventListener('input', filterRows);
        filterRows();
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>