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

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT *
    FROM t_pelanggaran_siswa
    ORDER BY tanggal DESC, id DESC
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

</div>
