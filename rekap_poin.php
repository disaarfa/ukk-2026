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
