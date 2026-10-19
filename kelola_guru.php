<?php /* Halaman kelola_guru; dipanggil melalui dashboard.php */ ?>


<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_guru
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
    <?= $data_edit ? 'Edit Guru' : 'Tambah Guru' ?>
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

<div class="col-md-6 mb-3">

<label>NIP</label>

<input
    type="text"
    name="nip"
    class="form-control"
    required
    value="<?= e($data_edit['nip'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Nama Guru</label>

<input
    type="text"
    name="nama"
    class="form-control"
    required
    value="<?= e($data_edit['nama'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input
    type="email"
    name="email"
    class="form-control"
    value="<?= e($data_edit['email'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select
    name="status_aktif"
    class="form-select"
>

<option
value="1"
<?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>
Aktif
</option>

<option
value="0"
<?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>
Tidak Aktif
</option>

</select>

</div>

</div>

<button class="btn btn-soft">
<?= $data_edit ? 'Update Guru' : 'Tambah Guru' ?>
</button>

<?php if ($data_edit): ?>

<a
    href="dashboard.php?page=kelola_guru"
    class="btn btn-secondary"
>
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Guru</h4>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>
<th>No</th>
<th>NIP</th>
<th>Nama</th>
<th>Email</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query(
    $koneksi,
    "SELECT * FROM t_guru
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nip']) ?></td>

<td><?= e($r['nama']) ?></td>

<td><?= e($r['email']) ?></td>

<td>

<?= $r['status_aktif']
    ? '<span class="badge bg-success">Aktif</span>'
    : '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=kelola_guru&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=kelola_guru&hapus=guru&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus guru ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>
