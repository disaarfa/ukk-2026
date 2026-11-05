
<?php /* Halaman riwayat; dipanggil melalui dashboard.php */ ?>

<div class="table-box">

    <h4>Riwayat Pelanggaran</h4>

    <?php

    $user_id = (int) ($_SESSION['user_id'] ?? 0);
    $role = strtolower(trim($_SESSION['role'] ?? ''));

    $filter_sql = "";

    if ($role !== 'admin') {

        $filter_sql = "
            WHERE EXISTS (
                SELECT 1
                FROM t_users u
                INNER JOIN t_guru g
                    ON LOWER(TRIM(g.email)) = LOWER(TRIM(u.email))
                INNER JOIN t_wali_kelas wk
                    ON wk.guru_id = g.id
                WHERE u.id = $user_id
                    AND wk.kelas_id = ps.kelas_id
                    AND wk.status_aktif = 1
                    AND wk.tanggal_mulai <= CURDATE()
                    AND (
                        wk.tanggal_selesai IS NULL
                        OR wk.tanggal_selesai >= CURDATE()
                    )
            )
        ";

    }

    /* PAGINATION */

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

    $total_data = $total_query
        ? (int) mysqli_fetch_assoc($total_query)['total']
        : 0;

    $total_halaman = max(
        1,
        (int) ceil($total_data / $batas)
    );

    $halaman = min($halaman, $total_halaman);

    $posisi = ($halaman - 1) * $batas;

    $no = $posisi + 1;

    /* AMBIL DATA RIWAYAT */

    $q = mysqli_query($koneksi, "
        SELECT ps.*
        FROM t_pelanggaran_siswa ps
        $filter_sql
        ORDER BY ps.tanggal DESC, ps.id DESC
        LIMIT $posisi, $batas
    ");

    ?>

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

            <?php if ($q && mysqli_num_rows($q) > 0): ?>

                <?php while ($r = mysqli_fetch_assoc($q)): ?>

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

            <?php else: ?>

                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Belum ada riwayat pelanggaran untuk kelas yang diampu.
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->

    <div class="d-flex justify-content-end align-items-center flex-wrap gap-2 mt-3">

        <small class="text-muted">
            Halaman <?= $halaman ?>
            dari <?= $total_halaman ?>
            (<?= $total_data ?> data)
        </small>

        <nav aria-label="Pagination riwayat pelanggaran">

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
