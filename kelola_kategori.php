<?php /* Halaman kelola_kategori; dipanggil melalui dashboard.php */ ?>

<?php
$data_edit = null;

if ($edit_id > 0) {
    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_pelanggaran_kategori WHERE id='$edit_id' LIMIT 1"
    );
    $data_edit = mysqli_fetch_assoc($qe);
}
?>

<div class="form-box">
    <h4><?= $data_edit ? 'Edit Kategori' : 'Tambah Kategori' ?></h4>

    <form method="POST">
        <input type="hidden" name="aksi" value="<?= $data_edit ? 'edit' : 'tambah' ?>">

        <?php if ($data_edit): ?>
            <input type="hidden" name="id" value="<?= $data_edit['id'] ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama" class="form-control" required
                value="<?= e($data_edit['nama'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"><?= e($data_edit['deskripsi'] ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status_aktif" class="form-select">
                <option value="1" <?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>Aktif</option>
                <option value="0" <?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>Tidak Aktif</option>
            </select>
        </div>

        <button class="btn btn-soft"><?= $data_edit ? 'Update' : 'Tambah' ?></button>

        <?php if ($data_edit): ?>
            <a href="dashboard.php?page=kelola_kategori" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </form>
</div>

<?php
$per_halaman_kategori = 10;

$total_query_kategori = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM t_pelanggaran_kategori"
);
$total_data_kategori = (int) mysqli_fetch_assoc($total_query_kategori)['total'];

$total_halaman_kategori = max(1, (int) ceil($total_data_kategori / $per_halaman_kategori));
$halaman_kategori = max(1, (int) ($_GET['halaman'] ?? 1));
$halaman_kategori = min($halaman_kategori, $total_halaman_kategori);
$offset_kategori = ($halaman_kategori - 1) * $per_halaman_kategori;

$q_kategori = mysqli_query(
    $koneksi,
    "SELECT * FROM t_pelanggaran_kategori
     ORDER BY id DESC
     LIMIT $offset_kategori, $per_halaman_kategori"
);
$nomor_kategori = $offset_kategori + 1;
?>

<div class="table-box">
    <h4>Data Kategori Pelanggaran</h4>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($total_data_kategori > 0): ?>
                    <?php while ($r = mysqli_fetch_assoc($q_kategori)): ?>
                        <tr>
                            <td><?= $nomor_kategori++ ?></td>
                            <td><?= e($r['nama']) ?></td>
                            <td><?= e($r['deskripsi']) ?></td>
                            <td>
                                <?= $r['status_aktif']
                                    ? '<span class="badge bg-success">Aktif</span>'
                                    : '<span class="badge bg-secondary">Tidak Aktif</span>' ?>
                            </td>
                            <td>
                                <a href="dashboard.php?page=kelola_kategori&edit=<?= $r['id'] ?>"
                                   class="btn btn-edit btn-sm">Edit</a>

                                <a href="dashboard.php?page=kelola_kategori&hapus=kategori&id=<?= $r['id'] ?>"
                                   class="btn btn-delete btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data kategori pelanggaran.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
        <small>
            Menampilkan <?= $total_data_kategori ? $offset_kategori + 1 : 0 ?>–<?= min($offset_kategori + $per_halaman_kategori, $total_data_kategori) ?>
            dari <?= $total_data_kategori ?> data
        </small>

        <nav aria-label="Pagination kategori pelanggaran">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item <?= $halaman_kategori <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="dashboard.php?page=kelola_kategori&halaman=<?= max(1, $halaman_kategori - 1) ?>">Sebelumnya</a>
                </li>

                <?php for ($i = 1; $i <= $total_halaman_kategori; $i++): ?>
                    <li class="page-item <?= $i == $halaman_kategori ? 'active' : '' ?>">
                        <a class="page-link" href="dashboard.php?page=kelola_kategori&halaman=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $halaman_kategori >= $total_halaman_kategori ? 'disabled' : '' ?>">
                    <a class="page-link" href="dashboard.php?page=kelola_kategori&halaman=<?= min($total_halaman_kategori, $halaman_kategori + 1) ?>">Selanjutnya</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
