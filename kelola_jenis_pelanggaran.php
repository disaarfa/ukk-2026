<?php /* Halaman kelola_jenis_pelanggaran; dipanggil melalui dashboard.php */ ?>

<?php
$data_edit = null;

if ($edit_id > 0) {
    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_pelanggaran WHERE id='$edit_id' LIMIT 1"
    );
    $data_edit = mysqli_fetch_assoc($qe);
}
?>

<div class="form-box">
    <h4><?= $data_edit ? 'Edit Jenis Pelanggaran' : 'Tambah Jenis Pelanggaran' ?></h4>

    <form method="POST">
        <input type="hidden" name="aksi" value="<?= $data_edit ? 'edit' : 'tambah' ?>">

        <?php if ($data_edit): ?>
            <input type="hidden" name="id" value="<?= $data_edit['id'] ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Kategori</label>
                <select name="pelanggaran_kategori_id" class="form-select" required>
                    <?php
                    $qkat_jenis = mysqli_query(
                        $koneksi,
                        "SELECT * FROM t_pelanggaran_kategori
                         WHERE status_aktif=1 ORDER BY nama ASC"
                    );
                    while ($kat = mysqli_fetch_assoc($qkat_jenis)):
                    ?>
                        <option value="<?= $kat['id'] ?>"
                            <?= (($data_edit['pelanggaran_kategori_id'] ?? '') == $kat['id']) ? 'selected' : '' ?>>
                            <?= e($kat['nama']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Kode</label>
                <input type="text" name="kode" class="form-control" required
                    placeholder="PLG-051" value="<?= e($data_edit['kode'] ?? '') ?>">
            </div>

            <div class="col-md-4 mb-3">
                <label>Poin</label>
                <input type="number" name="poin" class="form-control" required
                    value="<?= e($data_edit['poin'] ?? '') ?>">
            </div>

            <div class="col-12 mb-3">
                <label>Nama Pelanggaran</label>
                <input type="text" name="nama" class="form-control" required
                    value="<?= e($data_edit['nama'] ?? '') ?>">
            </div>

            <div class="col-12 mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"><?= e($data_edit['deskripsi'] ?? '') ?></textarea>
            </div>

            <div class="col-md-4 mb-3">
                <label>Status</label>
                <select name="status_aktif" class="form-select">
                    <option value="1" <?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>Aktif</option>
                    <option value="0" <?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>Tidak Aktif</option>
                </select>
            </div>
        </div>

        <button class="btn btn-soft"><?= $data_edit ? 'Update' : 'Tambah' ?></button>

        <?php if ($data_edit): ?>
            <a href="dashboard.php?page=kelola_jenis_pelanggaran" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </form>
</div>

<?php
$per_halaman_jenis = 10;

$total_query_jenis = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM t_pelanggaran");
$total_data_jenis = (int) mysqli_fetch_assoc($total_query_jenis)['total'];

$total_halaman_jenis = max(1, (int) ceil($total_data_jenis / $per_halaman_jenis));
$halaman_jenis = max(1, (int) ($_GET['halaman'] ?? 1));
$halaman_jenis = min($halaman_jenis, $total_halaman_jenis);
$offset_jenis = ($halaman_jenis - 1) * $per_halaman_jenis;

$q_jenis = mysqli_query(
    $koneksi,
    "SELECT * FROM t_pelanggaran
     ORDER BY id DESC
     LIMIT $offset_jenis, $per_halaman_jenis"
);
$nomor_jenis = $offset_jenis + 1;
?>

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
                <?php if ($total_data_jenis > 0): ?>
                    <?php while ($r = mysqli_fetch_assoc($q_jenis)): ?>
                        <tr>
                            <td><?= $nomor_jenis++ ?></td>
                            <td><?= e($r['kode']) ?></td>
                            <td><?= e($r['nama']) ?></td>
                            <td><span class="badge bg-primary"><?= e($r['poin']) ?></span></td>
                            <td>
                                <?= $r['status_aktif']
                                    ? '<span class="badge bg-success">Aktif</span>'
                                    : '<span class="badge bg-secondary">Tidak Aktif</span>' ?>
                            </td>
                            <td>
                                <a href="dashboard.php?page=kelola_jenis_pelanggaran&edit=<?= $r['id'] ?>"
                                   class="btn btn-edit btn-sm">Edit</a>

                                <a href="dashboard.php?page=kelola_jenis_pelanggaran&hapus=pelanggaran&id=<?= $r['id'] ?>"
                                   class="btn btn-delete btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus pelanggaran ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data jenis pelanggaran.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
        <small>
            Menampilkan <?= $total_data_jenis ? $offset_jenis + 1 : 0 ?>–<?= min($offset_jenis + $per_halaman_jenis, $total_data_jenis) ?>
            dari <?= $total_data_jenis ?> data
        </small>

        <nav aria-label="Pagination jenis pelanggaran">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item <?= $halaman_jenis <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="dashboard.php?page=kelola_jenis_pelanggaran&halaman=<?= max(1, $halaman_jenis - 1) ?>">Sebelumnya</a>
                </li>

                <?php for ($i = 1; $i <= $total_halaman_jenis; $i++): ?>
                    <li class="page-item <?= $i == $halaman_jenis ? 'active' : '' ?>">
                        <a class="page-link" href="dashboard.php?page=kelola_jenis_pelanggaran&halaman=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $halaman_jenis >= $total_halaman_jenis ? 'disabled' : '' ?>">
                    <a class="page-link" href="dashboard.php?page=kelola_jenis_pelanggaran&halaman=<?= min($total_halaman_jenis, $halaman_jenis + 1) ?>">Selanjutnya</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
