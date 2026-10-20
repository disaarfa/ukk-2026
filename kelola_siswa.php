<?php /* Halaman kelola_siswa; dipanggil melalui dashboard.php */ ?>


<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_siswa
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
    <?= $data_edit ? 'Edit Siswa' : 'Tambah Siswa' ?>
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

<label>NIS</label>

<input
    type="text"
    name="nis"
    class="form-control"
    required
    value="<?= e($data_edit['nis'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>NISN</label>

<input
    type="text"
    name="nisn"
    class="form-control"
    value="<?= e($data_edit['nisn'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Nama Siswa</label>

<input
    type="text"
    name="nama"
    class="form-control"
    required
    value="<?= e($data_edit['nama'] ?? '') ?>"
>

</div>

<div class="col-md-6 mb-3">

<label>Jenis Kelamin</label>

<select
    name="jenis_kelamin"
    class="form-select"
>

<option value="L"
<?= (($data_edit['jenis_kelamin'] ?? '') === 'L') ? 'selected' : '' ?>>
Laki-laki
</option>

<option value="P"
<?= (($data_edit['jenis_kelamin'] ?? '') === 'P') ? 'selected' : '' ?>>
Perempuan
</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Tanggal Lahir</label>

<input
    type="date"
    name="tanggal_lahir"
    class="form-control"
    value="<?= e($data_edit['tanggal_lahir'] ?? '') ?>"
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

<div class="col-12 mb-3">

<label>Alamat</label>

<textarea
    name="alamat"
    class="form-control"
    rows="3"
><?= e($data_edit['alamat'] ?? '') ?></textarea>

</div>

</div>

<button class="btn btn-soft">

<?= $data_edit ? 'Update Siswa' : 'Tambah Siswa' ?>

</button>

<?php if ($data_edit): ?>

<a
    href="dashboard.php?page=kelola_siswa"
    class="btn btn-secondary"
>
    Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4 class="mb-3">
    Data Siswa
</h4>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>


<thead>
<tr>
    <th>No</th>
    <th>NIS</th>
    <th>NISN</th>
    <th>Nama</th>
    <th>JK</th>
    <th>Tanggal Lahir</th>
    <th>Alamat</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>


</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query(
    $koneksi,
    "SELECT * FROM t_siswa
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['nis']) ?></td>

<td><?= e($r['nisn']) ?></td>

<td><?= e($r['nama']) ?></td>

<td><?= e($r['jenis_kelamin']) ?></td>

<td><?= e($r['tanggal_lahir']) ?></td>

<td><?= e($r['alamat'] ?? '') ?></td>

<td>

<?php if ($r['status_aktif']): ?>

<span class="badge bg-success">
Aktif
</span>

<?php else: ?>

<span class="badge bg-secondary">
Tidak Aktif
</span>

<?php endif; ?>

</td>

<td>

<a
    href="dashboard.php?page=kelola_siswa&edit=<?= $r['id'] ?>"
    class="btn btn-edit btn-sm"
>
    Edit
</a>


<a
    href="dashboard.php?page=kelola_siswa&hapus=siswa&id=<?= (int)$r['id'] ?>"
    class="btn btn-delete btn-sm"
    onclick="return confirm('Yakin ingin menonaktifkan siswa ini? Data dan riwayat pelanggaran tetap disimpan.')"
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
