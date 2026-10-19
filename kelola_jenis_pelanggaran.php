<?php /* Halaman kelola_jenis_pelanggaran; dipanggil melalui dashboard.php */ ?>


<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_pelanggaran
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
<?= $data_edit ? 'Edit Jenis Pelanggaran' : 'Tambah Jenis Pelanggaran' ?>
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

<label>Kategori</label>

<select
name="pelanggaran_kategori_id"
class="form-select"
required
>

<?php

$qkat = mysqli_query(
    $koneksi,
    "SELECT * FROM t_pelanggaran_kategori
     WHERE status_aktif=1
     ORDER BY nama ASC"
);

while ($kat = mysqli_fetch_assoc($qkat)):

?>

<option
value="<?= $kat['id'] ?>"
<?= (($data_edit['pelanggaran_kategori_id'] ?? '') == $kat['id']) ? 'selected' : '' ?>
>

<?= e($kat['nama']) ?>

</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Kode</label>

<input
type="text"
name="kode"
class="form-control"
required
placeholder="PLG-051"
value="<?= e($data_edit['kode'] ?? '') ?>"
>

</div>

<div class="col-md-4 mb-3">

<label>Poin</label>

<input
type="number"
name="poin"
class="form-control"
required
value="<?= e($data_edit['poin'] ?? '') ?>"
>

</div>

<div class="col-12 mb-3">

<label>Nama Pelanggaran</label>

<input
type="text"
name="nama"
class="form-control"
required
value="<?= e($data_edit['nama'] ?? '') ?>"
>

</div>

<div class="col-12 mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"
rows="3"
><?= e($data_edit['deskripsi'] ?? '') ?></textarea>

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
href="dashboard.php?page=kelola_jenis_pelanggaran"
class="btn btn-secondary">
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Jenis Pelanggaran</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Kode</th>
<th>Nama Pelanggaran</th>
<th>Poin</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query(
    $koneksi,
    "SELECT * FROM t_pelanggaran
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['kode']) ?></td>

<td><?= e($r['nama']) ?></td>

<td>
<span class="badge bg-primary">
<?= e($r['poin']) ?>
</span>
</td>

<td>

<?= $r['status_aktif']
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=kelola_jenis_pelanggaran&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=kelola_jenis_pelanggaran&hapus=pelanggaran&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus pelanggaran ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>
