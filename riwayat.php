<?php /* Halaman riwayat; dipanggil melalui dashboard.php */ ?>


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

/* =========================
   PAGINATION 10 DATA
   ========================= */

$batas = 10;

$halaman = isset($_GET['halaman_riwayat'])
    ? max(1, (int) $_GET['halaman_riwayat'])
    : 1;

/* Hitung seluruh data */

$total_query = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total
    FROM t_pelanggaran_siswa
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

/* Ambil data sesuai halaman */

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


<!-- PAGINATION DI SISI KANAN -->

<div class="d-flex justify-content-end align-items-center flex-wrap gap-2 mt-3">

    <small class="text-muted">
        Halaman <?= $halaman ?>
        dari <?= $total_halaman ?>
        (<?= $total_data ?> data)
    </small>

    <nav aria-label="Pagination riwayat pelanggaran">

        <ul class="pagination pagination-sm mb-0">

            <!-- Tombol Sebelumnya -->

            <li class="page-item <?= ($halaman <= 1) ? 'disabled' : '' ?>">

                <a
                    class="page-link"
                    href="dashboard.php?page=riwayat&halaman_riwayat=<?= max(1, $halaman - 1) ?>"
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
                    href="dashboard.php?page=riwayat&halaman_riwayat=<?= $i ?>"
                >
                    <?= $i ?>
                </a>

            </li>

            <?php endfor; ?>

            <!-- Tombol Berikutnya -->

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
