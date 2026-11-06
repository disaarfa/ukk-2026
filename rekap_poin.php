
<?php /* Halaman rekap poin; dipanggil melalui dashboard.php */ ?>

<div class="table-box">

    <h4>Rekap Poin Siswa</h4>

    <?php

    $user_id = (int) ($_SESSION['user_id'] ?? 0);
    $role = strtolower(trim($_SESSION['role'] ?? ''));

    /*
       ADMIN : Melihat seluruh rekap poin siswa.
       GURU  : Melihat rekap poin dari pelanggaran
               yang dicatat oleh dirinya sendiri.
    */

    $filter_sql = "";

    if ($role !== 'admin') {

        $filter_sql = "
            WHERE EXISTS (
                SELECT 1
                FROM t_guru g
                WHERE g.user_id = $user_id
                  AND g.id = ps.guru_id
            )
        ";

    }

    /* PAGINATION */

    $batas = 10;

    $halaman = isset($_GET['halaman_rekap'])
        ? max(1, (int) $_GET['halaman_rekap'])
        : 1;

    /* HITUNG JUMLAH SISWA */

    $total_query = mysqli_query($koneksi, "
        SELECT COUNT(DISTINCT ps.siswa_id) AS total

        FROM t_pelanggaran_siswa ps

        $filter_sql
    ");

    if (!$total_query) {
        die("Query hitung rekap gagal: " . mysqli_error($koneksi));
    }

    $total_data = (int) mysqli_fetch_assoc($total_query)['total'];

    $total_halaman = max(
        1,
        (int) ceil($total_data / $batas)
    );

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

            <?php if (mysqli_num_rows($q) > 0): ?>

                <?php while ($r = mysqli_fetch_assoc($q)): ?>

                    <tr>

                        <td>
                            <?= $no++ ?>
                        </td>

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

    <div class="d-flex justify-content-end align-items-center flex-wrap gap-2 mt-3">

        <small class="text-muted">

            Halaman <?= $halaman ?>
            dari <?= $total_halaman ?>
            (<?= $total_data ?> data)

        </small>

        <nav aria-label="Pagination rekap poin">

            <ul class="pagination pagination-sm mb-0">

                <li class="page-item <?= ($halaman <= 1) ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=rekap_poin&halaman_rekap=<?= max(1, $halaman - 1) ?>"
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
                            href="dashboard.php?page=rekap_poin&halaman_rekap=<?= $i ?>"
                        >
                            <?= $i ?>
                        </a>

                    </li>

                <?php endfor; ?>

                <li class="page-item <?= ($halaman >= $total_halaman) ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=rekap_poin&halaman_rekap=<?= min($total_halaman, $halaman + 1) ?>"
                    >
                        &raquo;
                    </a>

                </li>

            </ul>

        </nav>

    </div>

</div>
