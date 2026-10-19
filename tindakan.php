<?php /* Halaman tindakan; dipanggil melalui dashboard.php */ ?>


<div class="table-box">

<h4>
Data Tindakan Pelanggaran
</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Siswa</th>
<th>Pelanggaran</th>
<th>Poin</th>
<th>Tindakan</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT *
    FROM t_pelanggaran_siswa
    ORDER BY id DESC
");

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama_siswa']) ?></td>

<td><?= e($r['nama_pelanggaran']) ?></td>

<td><?= e($r['poin']) ?></td>

<td>

<form method="POST">

<input
type="hidden"
name="id"
value="<?= $r['id'] ?>"
>

<input
type="text"
name="tindakan"
class="form-control form-control-sm"
value="<?= e($r['tindakan']) ?>"
>

</td>

<td>

<select
name="status"
class="form-select form-select-sm"
>

<option
value="Pending"
<?= $r['status'] === 'Pending' ? 'selected' : '' ?>>
Pending
</option>

<option
value="Proses"
<?= $r['status'] === 'Proses' ? 'selected' : '' ?>>
Proses
</option>

<option
value="Selesai"
<?= $r['status'] === 'Selesai' ? 'selected' : '' ?>>
Selesai
</option>

</select>

</td>

<td>

<button
class="btn btn-soft btn-sm"
type="submit"
>
Simpan
</button>

</form>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>
