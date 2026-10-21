<?php /* Halaman kelola_kelas; dipanggil melalui dashboard.php */ ?>

<?php
$data_edit = null;

if ($edit_id > 0) {
    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_kelas WHERE id='$edit_id' LIMIT 1"
    );
    $data_edit = mysqli_fetch_assoc($qe);
}
?>

<div class="form-box">
    <h4><?= $data_edit ? 'Edit Kelas' : 'Tambah Kelas' ?></h4>

    <form method="POST">
        <input type="hidden" name="aksi" value="<?= $data_edit ? 'edit' : 'tambah' ?>">

        <?php if ($data_edit): ?>
            <input type="hidden" name="id" value="<?= $data_edit['id'] ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Nama Kelas</label>
                <input type="text" name="nama" class="form-control" required
                    placeholder="Contoh: XII RPL 2"
                    value="<?= e($data_edit['nama'] ?? '') ?>">
            </div>

            <div class="col-md-4 mb-3">
                <label>Tingkat</label>
                <input type="text" name="tingkat" class="form-control"
                    placeholder="Contoh: XII"
                    value="<?= e($data_edit['tingkat'] ?? '') ?>">
            </div>

            <div class="col-md-4 mb-3">
                <label>Jurusan</label>
                <input type="text" name="jurusan" class="form-control"
                    placeholder="Contoh: RPL"
                    value="<?= e($data_edit['jurusan'] ?? '') ?>">
            </div>

            <div class="col-md-4 mb-3">
                <label>Status</label>
                <select name="status_aktif" class="form-select">
                    <option value="1" <?= (($data_edit['status_aktif'] ?? 1) == 1) ? 'selected' : '' ?>>Aktif</option>
                    <option value="0" <?= (($data_edit['status_aktif'] ?? 1) == 0) ? 'selected' : '' ?>>Tidak Aktif</option>
                </select>
            </div>
        </div>

        <button class="btn btn-soft">
            <?= $data_edit ? 'Update Kelas' : 'Tambah Kelas' ?>
        </button>

        <?php if ($data_edit): ?>
            <a href="dashboard.php?page=kelola_kelas" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </form>
</div>

<?php
$per_halaman_kelas = 10;

$total_query_kelas = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM t_kelas"
);
$total_data_kelas = (int) mysqli_fetch_assoc($total_query_kelas)['total'];

$total_halaman_kelas = max(1, (int) ceil($total_data_kelas / $per_halaman_kelas));
$halaman_kelas = max(1, (int) ($_GET['halaman'] ?? 1));
$halaman_kelas = min($halaman_kelas, $total_halaman_kelas);
$offset_kelas = ($halaman_kelas - 1) * $per_halaman_kelas;

$q_kelas = mysqli_query(
    $koneksi,
    "SELECT * FROM t_kelas
     ORDER BY id DESC
     LIMIT $offset_kelas, $per_halaman_kelas"
);
$nomor_kelas = $offset_kelas + 1;
?>

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
                <?php if ($total_data_kelas > 0): ?>
                    <?php while ($r = mysqli_fetch_assoc($q_kelas)): ?>
                        <tr>
                            <td><?= $nomor_kelas++ ?></td>
                            <td><?= e($r['nama']) ?></td>
                            <td><?= e($r['tingkat']) ?></td>
                            <td><?= e($r['jurusan']) ?></td>
                            <td>
                                <?= $r['status_aktif']
                                    ? '<span class="badge bg-success">Aktif</span>'
                                    : '<span class="badge bg-secondary">Tidak Aktif</span>' ?>
                            </td>
                            <td>
                                <a href="dashboard.php?page=kelola_kelas&edit=<?= $r['id'] ?>"
                                   class="btn btn-edit btn-sm">Edit</a>

                                <a href="hapus_siswa.php?id=<?= (int) $r['id'] ?>"
                                   class="btn btn-delete btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini secara permanen?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data kelas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
        <small>
            Menampilkan
            <?= $total_data_kelas ? $offset_kelas + 1 : 0 ?>–<?= min($offset_kelas + $per_halaman_kelas, $total_data_kelas) ?>
            dari <?= $total_data_kelas ?> data
        </small>

        <nav aria-label="Pagination kelas">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item <?= $halaman_kelas <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link"
                       href="dashboard.php?page=kelola_kelas&halaman=<?= max(1, $halaman_kelas - 1) ?>">
                        Sebelumnya
                    </a>
                </li>

                <?php for ($i = 1; $i <= $total_halaman_kelas; $i++): ?>
                    <li class="page-item <?= $i == $halaman_kelas ? 'active' : '' ?>">
                        <a class="page-link"
                           href="dashboard.php?page=kelola_kelas&halaman=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $halaman_kelas >= $total_halaman_kelas ? 'disabled' : '' ?>">
                    <a class="page-link"
                       href="dashboard.php?page=kelola_kelas&halaman=<?= min($total_halaman_kelas, $halaman_kelas + 1) ?>">
                        Selanjutnya
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
