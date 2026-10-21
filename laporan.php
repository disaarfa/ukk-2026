
<?php /* Halaman laporan; dipanggil melalui dashboard.php */ ?>


<div class="dashboard-card">

    <h4>Laporan Pelanggaran</h4>

    <p>
        Berikut merupakan data pelanggaran siswa yang tersimpan
        dalam sistem.
    </p>

    <!-- TOMBOL CETAK DAN EXPORT -->
    <div class="d-flex flex-wrap gap-2 mb-3 no-print">

        <button type="button"
                class="btn btn-primary"
                onclick="window.print()">
            <i class="bi bi-printer"></i> Cetak Laporan
        </button>

        <a href="dashboard.php?page=laporan&export=csv"
           class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Export Excel/CSV
        </a>

    </div>

</div>

<div class="table-box" id="area-laporan">

    <h4 class="judul-cetak">Laporan Pelanggaran Siswa</h4>

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

            /* =========================
               PAGINATION 10 DATA
               ========================= */

            $batas = 10;

            $halaman = isset($_GET['halaman_laporan'])
                ? max(1, (int) $_GET['halaman_laporan'])
                : 1;

            // Hitung total data
            $total_query = mysqli_query($koneksi, "
                SELECT COUNT(*) AS total
                FROM t_pelanggaran_siswa
            ");

            $total_data = (int) mysqli_fetch_assoc($total_query)['total'];

            $total_halaman = max(
                1,
                (int) ceil($total_data / $batas)
            );

            // Pastikan halaman valid
            $halaman = min($halaman, $total_halaman);

            // Tentukan posisi data
            $posisi = ($halaman - 1) * $batas;

            $no = $posisi + 1;

            // Ambil data berdasarkan halaman
            $q = mysqli_query($koneksi, "
                SELECT *
                FROM t_pelanggaran_siswa
                ORDER BY tanggal DESC, id DESC
                LIMIT $posisi, $batas
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

    <!-- PAGINATION DI SISI KANAN -->
    <div class="d-flex justify-content-end align-items-center flex-wrap gap-2 mt-3 no-print">

        <small class="text-muted">
            Halaman <?= $halaman ?>
            dari <?= $total_halaman ?>
            (<?= $total_data ?> data)
        </small>

        <nav aria-label="Pagination laporan">

            <ul class="pagination pagination-sm mb-0">

                <!-- Sebelumnya -->
                <li class="page-item <?= ($halaman <= 1) ? 'disabled' : '' ?>">

                    <a class="page-link"
                       href="dashboard.php?page=laporan&halaman_laporan=<?= max(1, $halaman - 1) ?>">
                        &laquo;
                    </a>

                </li>

                <!-- Nomor Halaman -->
                <?php

                $mulai = max(1, $halaman - 2);
                $akhir = min($total_halaman, $halaman + 2);

                for ($i = $mulai; $i <= $akhir; $i++):

                ?>

                <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">

                    <a class="page-link"
                       href="dashboard.php?page=laporan&halaman_laporan=<?= $i ?>">
                        <?= $i ?>
                    </a>

                </li>

                <?php endfor; ?>

                <!-- Berikutnya -->
                <li class="page-item <?= ($halaman >= $total_halaman) ? 'disabled' : '' ?>">

                    <a class="page-link"
                       href="dashboard.php?page=laporan&halaman_laporan=<?= min($total_halaman, $halaman + 1) ?>">
                        &raquo;
                    </a>

                </li>

            </ul>

        </nav>

    </div>

</div>

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
