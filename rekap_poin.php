<?php /* Halaman rekap_poin; dipanggil melalui dashboard.php */ ?>


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

/* =========================
   PAGINATION 10 DATA
   ========================= */

$batas = 10;

$halaman = isset($_GET['halaman_rekap'])
    ? max(1, (int) $_GET['halaman_rekap'])
    : 1;

/* Hitung jumlah siswa dalam rekap */

$total_query = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total
    FROM (
        SELECT siswa_id, nama_siswa
        FROM t_pelanggaran_siswa
        GROUP BY siswa_id, nama_siswa
    ) AS data_rekap
");

$total_data = (int) mysqli_fetch_assoc($total_query)['total'];

$total_halaman = max(
    1,
    (int) ceil($total_data / $batas)
);

/* Pastikan halaman valid */

$halaman = min($halaman, $total_halaman);

/* Tentukan posisi data */

$posisi = ($halaman - 1) * $batas;

$no = $posisi + 1;

/* Ambil data rekap sesuai halaman */

$q = mysqli_query($koneksi, "
    SELECT
        siswa_id,
        nama_siswa,
        SUM(poin) AS total_poin
    FROM t_pelanggaran_siswa
    GROUP BY siswa_id, nama_siswa
    ORDER BY total_poin DESC
    LIMIT $posisi, $batas
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

<!-- PAGINATION DI SISI KANAN -->

<div class="d-flex justify-content-end align-items-center flex-wrap gap-2 mt-3">

    <small class="text-muted">
        Halaman <?= $halaman ?>
        dari <?= $total_halaman ?>
        (<?= $total_data ?> data)
    </small>

    <nav aria-label="Pagination rekap poin">

        <ul class="pagination pagination-sm mb-0">

            <!-- Tombol Sebelumnya -->

            <li class="page-item <?= ($halaman <= 1) ? 'disabled' : '' ?>">

                <a
                    class="page-link"
                    href="dashboard.php?page=rekap_poin&halaman_rekap=<?= max(1, $halaman - 1) ?>"
                >
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

                <a
                    class="page-link"
                    href="dashboard.php?page=rekap_poin&halaman_rekap=<?= $i ?>"
                >
                    <?= $i ?>
                </a>

            </li>

            <?php endfor; ?>

            <!-- Tombol Berikutnya -->

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
