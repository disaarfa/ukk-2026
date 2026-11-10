<?php
/* =====================================================
   HALAMAN LAPORAN PELANGGARAN
   Dipanggil melalui dashboard.php
   ===================================================== */

$user_id = (int)($_SESSION['user_id'] ?? 0);
$role = strtolower(trim($_SESSION['role'] ?? ''));

$role = str_replace([' ', '-'], '_', $role);

/* =====================================================
   FILTER BERDASARKAN ROLE
   ===================================================== */

$filter_sql = "";

if ($role === 'admin') {

    // Admin melihat semua laporan
    $filter_sql = "";

} elseif ($role === 'guru') {

    // Guru hanya melihat pelanggaran yang dicatat sendiri
    $filter_sql = "
        WHERE EXISTS (
            SELECT 1
            FROM t_guru g
            WHERE g.user_id = $user_id
              AND g.id = ps.guru_id
        )
    ";

} elseif ($role === 'wali_kelas') {

    // Wali kelas melihat semua laporan di kelasnya
    $filter_sql = "
        WHERE EXISTS (
            SELECT 1
            FROM t_wali_kelas wk

            INNER JOIN t_guru g
                ON g.id = wk.guru_id

            WHERE g.user_id = $user_id
              AND wk.kelas_id = ps.kelas_id
              AND wk.status_aktif = 1
              AND wk.tanggal_mulai <= CURDATE()
              AND wk.tanggal_selesai >= CURDATE()
        )
    ";

} else {

    $filter_sql = " WHERE 1 = 0 ";

}
?>

<!-- =====================================================
     JUDUL LAPORAN
     ===================================================== -->

<div class="dashboard-card">

    <h4>Laporan Pelanggaran</h4>

    <p>
        Berikut merupakan data pelanggaran siswa yang tersimpan
        dalam sistem.
    </p>

    <div class="d-flex flex-wrap gap-2 mb-3 no-print">

        <button
            type="button"
            class="btn btn-primary"
            onclick="window.print()"
        >
            <i class="bi bi-printer"></i>
            Cetak Laporan
        </button>

        <a
            href="dashboard.php?page=laporan&export=xls"
            class="btn btn-success"
        >
            <i class="bi bi-file-earmark-excel"></i>
            Export Excel
        </a>

    </div>

</div>

<!-- =====================================================
     TABEL LAPORAN
     ===================================================== -->

<div class="table-box" id="area-laporan">

    <h4 class="judul-cetak">
        Laporan Pelanggaran Siswa
    </h4>

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
                    <th>Guru Pencatat</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            <?php

            /* =========================
               PAGINATION
               ========================= */

            $batas = 10;

            $halaman = isset($_GET['halaman_laporan'])
                ? max(1, (int)$_GET['halaman_laporan'])
                : 1;

            /* =========================
               HITUNG TOTAL DATA
               ========================= */

            $total_query = mysqli_query($koneksi, "

                SELECT COUNT(*) AS total

                FROM t_pelanggaran_siswa ps

                $filter_sql

            ");

            if (!$total_query) {
                die(
                    "Query hitung laporan gagal: "
                    . mysqli_error($koneksi)
                );
            }

            $total_data = (int)mysqli_fetch_assoc(
                $total_query
            )['total'];

            $total_halaman = max(
                1,
                (int)ceil($total_data / $batas)
            );

            /* =========================
               VALIDASI HALAMAN
               ========================= */

            $halaman = min(
                $halaman,
                $total_halaman
            );

            $posisi = ($halaman - 1) * $batas;

            $no = $posisi + 1;

            /* =========================
               AMBIL DATA LAPORAN
               ========================= */

            $q = mysqli_query($koneksi, "

                SELECT

                    ps.*,

                    COALESCE(
                        NULLIF(s.nama, ''),
                        ps.nama_siswa
                    ) AS nama_tampil,

                    COALESCE(
                        NULLIF(ps.nama_guru, ''),
                        '-'
                    ) AS guru_pencatat

                FROM t_pelanggaran_siswa ps

                LEFT JOIN t_siswa s
                    ON s.id = ps.siswa_id

                $filter_sql

                ORDER BY
                    ps.tanggal DESC,
                    ps.id DESC

                LIMIT $posisi, $batas

            ");

            if (!$q) {
                die(
                    "Query laporan gagal: "
                    . mysqli_error($koneksi)
                );
            }

            /* =========================
               TAMPILKAN DATA
               ========================= */

            if (mysqli_num_rows($q) > 0):

                while ($r = mysqli_fetch_assoc($q)):

            ?>

                <tr>

                    <td>
                        <?= $no++ ?>
                    </td>

                    <td>
                        <?= e($r['nama_tampil']) ?>
                    </td>

                    <td>
                        <?= e($r['nama_kelas']) ?>
                    </td>

                    <td>
                        <?= e($r['nama_pelanggaran']) ?>
                    </td>

                    <td>
                        <?= e($r['poin']) ?>
                    </td>

                    <td>
                        <?= e($r['tanggal']) ?>
                    </td>

                    <td>
                        <?= e($r['guru_pencatat']) ?>
                    </td>

                    <td>
                        <?= e($r['status']) ?>
                    </td>

                </tr>

            <?php

                endwhile;

            else:

            ?>

                <tr>

                    <td colspan="8" class="text-center text-muted">
                        Belum ada data pelanggaran siswa.
                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

    <!-- =================================================
         PAGINATION
         ================================================= -->

    <div class="d-flex justify-content-end align-items-center flex-wrap gap-2 mt-3 no-print">

        <small class="text-muted">

            Halaman <?= $halaman ?>

            dari <?= $total_halaman ?>

            (<?= $total_data ?> data)

        </small>

        <nav aria-label="Pagination laporan">

            <ul class="pagination pagination-sm mb-0">

                <li class="page-item <?= ($halaman <= 1) ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=laporan&halaman_laporan=<?= max(1, $halaman - 1) ?>"
                    >
                        &laquo;
                    </a>

                </li>

                <?php

                $mulai = max(1, $halaman - 2);

                $akhir = min(
                    $total_halaman,
                    $halaman + 2
                );

                for (
                    $i = $mulai;
                    $i <= $akhir;
                    $i++
                ):

                ?>

                    <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">

                        <a
                            class="page-link"
                            href="dashboard.php?page=laporan&halaman_laporan=<?= $i ?>"
                        >
                            <?= $i ?>
                        </a>

                    </li>

                <?php endfor; ?>

                <li class="page-item <?= ($halaman >= $total_halaman) ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=laporan&halaman_laporan=<?= min($total_halaman, $halaman + 1) ?>"
                    >
                        &raquo;
                    </a>

                </li>

            </ul>

        </nav>

    </div>

</div>

<!-- =====================================================
     STYLE CETAK
     ===================================================== -->

<style>

.judul-cetak {
    display: none;
}

@media print {

    body * {
        visibility: hidden;
    }

    #area-laporan,
    #area-laporan * {
        visibility: visible;
    }

    #area-laporan {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 10px;
    }

    #area-laporan .table-responsive {
        overflow: visible !important;
    }

    #area-laporan table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11px;
    }

    #area-laporan th,
    #area-laporan td {
        border: 1px solid black !important;
        color: black !important;
        padding: 6px;
    }

    .judul-cetak {
        display: block;
        text-align: center;
        margin-bottom: 20px;
    }

    .no-print,
    .sidebar,
    nav,
    header,
    footer {
        display: none !important;
    }

    @page {
        size: landscape;
        margin: 1cm;
    }

}

</style>
