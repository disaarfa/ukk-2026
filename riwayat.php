
<?php
/* =========================
   HALAMAN RIWAYAT PELANGGARAN
   ========================= */

$user_id = (int) ($_SESSION['user_id'] ?? 0);
$role = strtolower(trim($_SESSION['role'] ?? ''));

/* =========================
   FILTER BERDASARKAN ROLE
   ========================= */

if ($role === 'admin') {

    // ADMIN MELIHAT SEMUA DATA SELESAI

    $filter_sql = "
        WHERE ps.status = 'Selesai'
    ";

} elseif ($role === 'guru') {

    // GURU HANYA MELIHAT DATA
    // YANG DICATAT OLEH DIRINYA SENDIRI

    $filter_sql = "
        WHERE ps.status = 'Selesai'
        AND EXISTS (
            SELECT 1
            FROM t_guru g
            WHERE g.user_id = $user_id
              AND TRIM(SUBSTRING_INDEX(g.nama, ',', 1))
                  = TRIM(ps.nama_guru)
        )
    ";

} elseif ($role === 'wali_kelas') {

    // WALI KELAS HANYA MELIHAT DATA
    // YANG DICATAT OLEH DIRINYA SENDIRI
    // BAIK DI XII RPL 1 MAUPUN XII RPL 2

    $filter_sql = "
        WHERE ps.status = 'Selesai'
        AND EXISTS (
            SELECT 1
            FROM t_wali_kelas wk
            INNER JOIN t_guru g
                ON g.id = wk.guru_id
            WHERE g.user_id = $user_id
              AND TRIM(SUBSTRING_INDEX(g.nama, ',', 1))
                  = TRIM(ps.nama_guru)
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

/* =========================
   PAGINATION
   ========================= */

$batas = 10;

$halaman = isset($_GET['halaman_riwayat'])
    ? max(1, (int) $_GET['halaman_riwayat'])
    : 1;

/* HITUNG TOTAL DATA */

$total_query = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total
    FROM t_pelanggaran_siswa ps
    $filter_sql
");

if (!$total_query) {
    die("Query hitung riwayat gagal: " . mysqli_error($koneksi));
}

$total_data = (int) mysqli_fetch_assoc($total_query)['total'];

$total_halaman = max(1, (int) ceil($total_data / $batas));

$halaman = min($halaman, $total_halaman);

$posisi = ($halaman - 1) * $batas;

$no = $posisi + 1;

/* =========================
   AMBIL DATA RIWAYAT
   ========================= */

$q = mysqli_query($koneksi, "
    SELECT
        ps.id,
        ps.tanggal,
        ps.nama_siswa,
        ps.nama_guru,
        ps.nama_kelas,
        ps.nama_pelanggaran,
        ps.poin,
        ps.tindakan,
        ps.status
    FROM t_pelanggaran_siswa ps
    $filter_sql
    ORDER BY ps.tanggal DESC, ps.id DESC
    LIMIT $posisi, $batas
");

if (!$q) {
    die("Query riwayat gagal: " . mysqli_error($koneksi));
}
?>

<style>

/* WARNA TABEL RIWAYAT */

.table-riwayat {
    width: 100%;
    background: #ffffff !important;
    border-collapse: collapse;
}

.table-riwayat thead th {
    background-color: #d9e9ff !important;
    color: #000000 !important;
    border: 1px solid #dee2e6 !important;
    padding: 8px;
}

.table-riwayat tbody tr,
.table-riwayat tbody tr:nth-child(odd),
.table-riwayat tbody tr:nth-child(even),
.table-riwayat tbody tr:hover {
    background-color: #ffffff !important;
}

.table-riwayat tbody td {
    background-color: #ffffff !important;
    color: #000000 !important;
    border: 1px solid #dee2e6 !important;
    padding: 8px;
}

</style>

<div class="table-box">

    <h4>Riwayat Pelanggaran</h4>

    <div class="table-responsive">

        <table class="table table-bordered table-riwayat">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Siswa</th>
                    <th>Guru Pencatat</th>
                    <th>Kelas</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Tindakan</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

                <?php if (mysqli_num_rows($q) > 0): ?>

                    <?php while ($r = mysqli_fetch_assoc($q)): ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td>
                                <?= e($r['tanggal']) ?>
                            </td>

                            <td>
                                <?= e($r['nama_siswa']) ?>
                            </td>

                            <td>
                                <?= e($r['nama_guru'] ?: '-') ?>
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
                                <?= e($r['tindakan']) ?>
                            </td>

                            <td>
                                <?= e($r['status']) ?>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            Belum ada riwayat pelanggaran.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">

        <small class="text-muted">
            Total <?= $total_data ?> data |
            Halaman <?= $halaman ?> dari <?= $total_halaman ?>
        </small>

        <nav>

            <ul class="pagination pagination-sm mb-0">

                <li class="page-item <?= ($halaman <= 1) ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=riwayat&halaman_riwayat=<?= max(1, $halaman - 1) ?>"
                    >
                        &laquo;
                    </a>

                </li>

                <?php

                $mulai = max(1, $halaman - 2);
                $akhir = min($total_halaman, $halaman + 2);

                for ($i = $mulai; $i <= $akhir; $i++):

                ?>

                    <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">

                        <a
                            class="page-link"
                            href="dashboard.php?page=riwayat&halaman_riwayat=<?= $i ?>"
                        >
                            <?= $i ?>
                        </a>

                    </li>

                <?php endfor; ?>

                <li class="page-item <?= ($halaman >= $total_halaman) ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=riwayat&halaman_riwayat=<?= min($total_halaman, $halaman + 1) ?>"
                    >
                        &raquo;
                    </a>

                </li>

            </ul>

        </nav>

    </div>

</div>
