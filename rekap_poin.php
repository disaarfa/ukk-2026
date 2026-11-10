<?php
/* HALAMAN REKAP POIN SISWA */

$user_id = (int) ($_SESSION['user_id'] ?? 0);
$role = strtolower(trim($_SESSION['role'] ?? ''));

/* FILTER BERDASARKAN ROLE */

$filter_sql = "";

if ($role === 'admin' || $role === 'guru') {

    // Admin dan guru melihat seluruh rekap poin
    $filter_sql = "";

} elseif ($role === 'wali_kelas') {

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
              AND (
                  wk.tanggal_selesai >= CURDATE()
                  OR wk.tanggal_selesai = '0000-00-00'
              )
        )
    ";

} else {

    $filter_sql = " WHERE 1 = 0 ";

}

/* PAGINATION */

$batas = 10;

$halaman = isset($_GET['halaman_rekap'])
    ? max(1, (int) $_GET['halaman_rekap'])
    : 1;

/* HITUNG JUMLAH SISWA */

$total_query = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total
    FROM (
        SELECT ps.siswa_id
        FROM t_pelanggaran_siswa ps
        $filter_sql
        GROUP BY ps.siswa_id
    ) AS data_rekap
");

if (!$total_query) {
    die("Query hitung rekap gagal: " . mysqli_error($koneksi));
}

$total_data = (int) mysqli_fetch_assoc($total_query)['total'];

$total_halaman = max(1, (int) ceil($total_data / $batas));

$halaman = min($halaman, $total_halaman);

$posisi = ($halaman - 1) * $batas;
$no = $posisi + 1;

/* AMBIL REKAP POIN */

$q = mysqli_query($koneksi, "
    SELECT
        ps.siswa_id,
        ps.nama_siswa,
        SUM(ps.poin) AS total_poin
    FROM t_pelanggaran_siswa ps
    $filter_sql
    GROUP BY
        ps.siswa_id,
        ps.nama_siswa
    ORDER BY
        total_poin DESC,
        ps.nama_siswa ASC
    LIMIT $posisi, $batas
");

if (!$q) {
    die("Query rekap poin gagal: " . mysqli_error($koneksi));
}
?>

<style>
/* WARNA TABEL REKAP POIN */

.table-rekap {
    width: 100%;
    background: #ffffff !important;
    border-collapse: collapse;
}

.table-rekap thead th {
    background-color: #d9e9ff !important;
    color: #000000 !important;
    border: 1px solid #dee2e6 !important;
    padding: 8px;
}

.table-rekap tbody tr,
.table-rekap tbody tr:nth-child(odd),
.table-rekap tbody tr:nth-child(even),
.table-rekap tbody tr:hover {
    background-color: #ffffff !important;
}

.table-rekap tbody td {
    background-color: #ffffff !important;
    color: #000000 !important;
    border: 1px solid #dee2e6 !important;
    padding: 8px;
}
</style>

<div class="table-box">

    <h4>Rekap Poin Siswa</h4>

    <div class="table-responsive">

        <table class="table table-bordered table-rekap">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Siswa</th>
                    <th>Total Poin</th>
                </tr>
            </thead>

            <tbody>

                <?php if (mysqli_num_rows($q) > 0): ?>

                    <?php while ($r = mysqli_fetch_assoc($q)): ?>

                        <tr>
                            <td><?= $no++ ?></td>

                            <td>
                                <?= e($r['nama_siswa']) ?>
                            </td>

                            <td>
                                <span class="badge bg-primary">
                                    <?= e($r['total_poin']) ?> poin
                                </span>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Belum ada data rekap poin siswa.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">

        <small class="text-muted">
            Total <?= $total_data ?> siswa |
            Halaman <?= $halaman ?> dari <?= $total_halaman ?>
        </small>

        <nav>
            <ul class="pagination pagination-sm mb-0">

                <li class="page-item <?= ($halaman <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link"
                       href="dashboard.php?page=rekap_poin&halaman_rekap=<?= max(1, $halaman - 1) ?>">
                        &laquo;
                    </a>
                </li>

                <?php
                $mulai = max(1, $halaman - 2);
                $akhir = min($total_halaman, $halaman + 2);

                for ($i = $mulai; $i <= $akhir; $i++):
                ?>

                    <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
                        <a class="page-link"
                           href="dashboard.php?page=rekap_poin&halaman_rekap=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>

                <?php endfor; ?>

                <li class="page-item <?= ($halaman >= $total_halaman) ? 'disabled' : '' ?>">
                    <a class="page-link"
                       href="dashboard.php?page=rekap_poin&halaman_rekap=<?= min($total_halaman, $halaman + 1) ?>">
                        &raquo;
                    </a>
                </li>

            </ul>
        </nav>

    </div>

</div>
