<?php /* Halaman catat_pelanggaran; dipanggil melalui dashboard.php */ ?>


<div class="form-box">

<h4>
Catat Pelanggaran Siswa
</h4>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nama Siswa</label>

<select
name="siswa_id"
class="form-select"
required
>

<option value="">
-- Pilih Siswa --
</option>

<?php

$q = mysqli_query(
    $koneksi,
    "SELECT id,nama
     FROM t_siswa
     WHERE status_aktif=1
     ORDER BY nama"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<option value="<?= $r['id'] ?>">
<?= e($r['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Jenis Pelanggaran</label>

<select
name="pelanggaran_id"
class="form-select"
required
>

<option value="">
-- Pilih Pelanggaran --
</option>

<?php

$q = mysqli_query(
    $koneksi,
    "SELECT id,kode,nama,poin
     FROM t_pelanggaran
     WHERE status_aktif=1
     ORDER BY nama"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<option value="<?= $r['id'] ?>">
<?= e($r['kode']) ?> -
<?= e($r['nama']) ?>
(<?= e($r['poin']) ?> poin)
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
value="<?= date('Y-m-d') ?>"
required
>

</div>

<div class="col-12 mb-3">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control"
rows="4"
placeholder="Masukkan keterangan pelanggaran..."
></textarea>

</div>

</div>

<button class="btn btn-soft">
Simpan Pelanggaran
</button>

</form>

</div>


<div class="table-box">

<h4>
Data Pelanggaran Terbaru
</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Nama Siswa</th>
<th>Kelas</th>
<th>Pelanggaran</th>
<th>Poin</th>
<th>Tanggal</th>
<th>Status</th>
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

</div>
