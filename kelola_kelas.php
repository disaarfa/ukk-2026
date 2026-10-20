<?php /* Halaman kelola_kelas; dipanggil melalui dashboard.php */ ?>


<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_kelas
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
<?= $data_edit ? 'Edit Kelas' : 'Tambah Kelas' ?>
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

<label>Nama Kelas</label>

<input
type="text"
name="nama"
class="form-control"
required
placeholder="Contoh: XII RPL 2"
value="<?= e($data_edit['nama'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Tingkat</label>

<input
type="text"
name="tingkat"
class="form-control"
placeholder="Contoh: XII"
value="<?= e($data_edit['tingkat'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Jurusan</label>

<input
type="text"
name="jurusan"
class="form-control"
placeholder="Contoh: RPL"
value="<?= e($data_edit['jurusan'] ?? '') ?>"
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
<?= $data_edit ? 'Update Kelas' : 'Tambah Kelas' ?>
</button>

<?php if ($data_edit): ?>

<a
href="dashboard.php?page=kelola_kelas"
class="btn btn-secondary">
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Kelas</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Nama Kelas</th>
<th>Tingkat</th>
<th>Jurusan</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query(
    $koneksi,
    "SELECT * FROM t_kelas
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nama']) ?></td>

<td><?= e($r['tingkat']) ?></td>

<td><?= e($r['jurusan']) ?></td>

<td>

<?= $r['status_aktif']
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=kelola_kelas&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>


<a
    href="hapus_siswa.php?id=<?= (int)$r['id'] ?>"
    class="btn btn-delete btn-sm"
    onclick="return confirm('Yakin ingin menghapus siswa ini secara permanen?')"
>
    Hapus
</a>


</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>
