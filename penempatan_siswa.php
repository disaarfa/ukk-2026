<?php /* Halaman penempatan_siswa; dipanggil melalui dashboard.php */ ?>


<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_kelas_siswa
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
<?= $data_edit ? 'Edit Penempatan' : 'Tambah Penempatan' ?>
</h4>

<form method="POST">

<input
type="hidden"
name="aksi"
value="<?= $data_edit ? 'edit' : 'tambah' ?>"
>

<?php if ($data_edit): ?>

<input
type="hidden"
name="id"
value="<?= $data_edit['id'] ?>"
>

<?php endif; ?>

<div class="row">

<div class="col-md-4 mb-3">

<label>Siswa</label>

<select name="siswa_id" class="form-select" required>

<?php

$qs = mysqli_query(
    $koneksi,
    "SELECT id,nama FROM t_siswa
     ORDER BY nama ASC"
);

while ($s = mysqli_fetch_assoc($qs)):

?>

<option
value="<?= $s['id'] ?>"
<?= (($data_edit['siswa_id'] ?? '') == $s['id']) ? 'selected' : '' ?>
>
<?= e($s['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Tahun Ajaran</label>

<select
name="tahun_ajaran_id"
class="form-select"
required
>

<?php

$qt = mysqli_query(
    $koneksi,
    "SELECT id,nama FROM t_tahun_ajaran
     ORDER BY id DESC"
);

while ($t = mysqli_fetch_assoc($qt)):

?>

<option
value="<?= $t['id'] ?>"
<?= (($data_edit['tahun_ajaran_id'] ?? '') == $t['id']) ? 'selected' : '' ?>
>
<?= e($t['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Kelas</label>

<select
name="kelas_id"
class="form-select"
required
>

<?php

$qk = mysqli_query(
    $koneksi,
    "SELECT id,nama FROM t_kelas
     ORDER BY nama ASC"
);

while ($k = mysqli_fetch_assoc($qk)):

?>

<option
value="<?= $k['id'] ?>"
<?= (($data_edit['kelas_id'] ?? '') == $k['id']) ? 'selected' : '' ?>
>
<?= e($k['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Tanggal Mulai</label>

<input
type="date"
name="tanggal_mulai"
class="form-control"
value="<?= e($data_edit['tanggal_mulai'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Tanggal Selesai</label>

<input
type="date"
name="tanggal_selesai"
class="form-control"
value="<?= e($data_edit['tanggal_selesai'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Status</label>

<select name="status_aktif" class="form-select">

<option value="1"
<?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>
Aktif
</option>

<option value="0"
<?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>
Tidak Aktif
</option>

</select>

</div>

</div>

<button class="btn btn-soft">
<?= $data_edit ? 'Update' : 'Tambah' ?>
</button>

<?php if ($data_edit): ?>

<a
href="dashboard.php?page=penempatan_siswa"
class="btn btn-secondary">
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Penempatan Siswa</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Siswa</th>
<th>Tahun Ajaran</th>
<th>Kelas</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT
        ks.*,
        s.nama AS nama_siswa,
        k.nama AS nama_kelas,
        ta.nama AS tahun
    FROM t_kelas_siswa ks
    LEFT JOIN t_siswa s
        ON ks.siswa_id=s.id
    LEFT JOIN t_kelas k
        ON ks.kelas_id=k.id
    LEFT JOIN t_tahun_ajaran ta
        ON ks.tahun_ajaran_id=ta.id
    ORDER BY ks.id DESC
");

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama_siswa']) ?></td>

<td><?= e($r['tahun']) ?></td>

<td><?= e($r['nama_kelas']) ?></td>

<td>

<?= $r['status_aktif']
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=penempatan_siswa&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=penempatan_siswa&hapus=penempatan&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus penempatan ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>
