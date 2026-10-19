<?php /* Halaman kelola_wali_kelas; dipanggil melalui dashboard.php */ ?>


<?php

$data_edit = null;

if ($edit_id > 0) {

    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_wali_kelas
         WHERE id='$edit_id'
         LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}

?>

<div class="form-box">

<h4>
<?= $data_edit ? 'Edit Wali Kelas' : 'Tambah Wali Kelas' ?>
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

<label>Tahun Ajaran</label>

<select
name="tahun_ajaran_id"
class="form-select"
required
>

<?php

$q = mysqli_query(
    $koneksi,
    "SELECT id,nama
     FROM t_tahun_ajaran
     ORDER BY id DESC"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<option
value="<?= $r['id'] ?>"
<?= (($data_edit['tahun_ajaran_id'] ?? '') == $r['id']) ? 'selected' : '' ?>
>
<?= e($r['nama']) ?>
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

$q = mysqli_query(
    $koneksi,
    "SELECT id,nama
     FROM t_kelas
     ORDER BY nama"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<option
value="<?= $r['id'] ?>"
<?= (($data_edit['kelas_id'] ?? '') == $r['id']) ? 'selected' : '' ?>
>
<?= e($r['nama']) ?>
</option>

<?php endwhile; ?>

</select>

</div>

<div class="col-md-4 mb-3">

<label>Guru</label>

<select
name="guru_id"
class="form-select"
required
>

<?php

$q = mysqli_query(
    $koneksi,
    "SELECT id,nama
     FROM t_guru
     WHERE status_aktif=1
     ORDER BY nama"
);

while ($r = mysqli_fetch_assoc($q)):

?>

<option
value="<?= $r['id'] ?>"
<?= (($data_edit['guru_id'] ?? '') == $r['id']) ? 'selected' : '' ?>
>
<?= e($r['nama']) ?>
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
href="dashboard.php?page=kelola_wali_kelas"
class="btn btn-secondary">
Batal
</a>

<?php endif; ?>

</form>

</div>


<div class="table-box">

<h4>Data Wali Kelas</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Tahun</th>
<th>Kelas</th>
<th>Guru</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;

$q = mysqli_query($koneksi, "
    SELECT
        wk.*,
        ta.nama AS tahun,
        k.nama AS kelas,
        g.nama AS guru
    FROM t_wali_kelas wk
    LEFT JOIN t_tahun_ajaran ta
        ON wk.tahun_ajaran_id=ta.id
    LEFT JOIN t_kelas k
        ON wk.kelas_id=k.id
    LEFT JOIN t_guru g
        ON wk.guru_id=g.id
    ORDER BY wk.id DESC
");

while ($r = mysqli_fetch_assoc($q)):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= e($r['tahun']) ?></td>

<td><?= e($r['kelas']) ?></td>

<td><?= e($r['guru']) ?></td>

<td>

<?= $r['status_aktif']
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-secondary">Tidak Aktif</span>' ?>

</td>

<td>

<a
href="dashboard.php?page=kelola_wali_kelas&edit=<?= $r['id'] ?>"
class="btn btn-edit btn-sm">
Edit
</a>

<a
href="dashboard.php?page=kelola_wali_kelas&hapus=wali&id=<?= $r['id'] ?>"
class="btn btn-delete btn-sm"
onclick="return confirm('Yakin ingin menghapus wali kelas ini?')">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>
