
<?php /* Halaman kelola_wali_kelas; dipanggil melalui dashboard.php */ ?>

<?php
$data_edit = null;

if ($edit_id > 0) {
    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_wali_kelas WHERE id='$edit_id' LIMIT 1"
    );
    $data_edit = mysqli_fetch_assoc($qe);
}
?>

<div class="form-box">
    <h4><?= $data_edit ? 'Edit Wali Kelas' : 'Tambah Wali Kelas' ?></h4>

    <form method="POST">
        <input type="hidden" name="aksi" value="<?= $data_edit ? 'edit' : 'tambah' ?>">

        <?php if ($data_edit): ?>
            <input type="hidden" name="id" value="<?= $data_edit['id'] ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Tahun Ajaran</label>
                <select name="tahun_ajaran_id" class="form-select" required>
                    <?php
                    $q_ta_wali = mysqli_query(
                        $koneksi,
                        "SELECT id,nama FROM t_tahun_ajaran ORDER BY id DESC"
                    );
                    while ($ta = mysqli_fetch_assoc($q_ta_wali)):
                    ?>
                        <option value="<?= $ta['id'] ?>"
                            <?= (($data_edit['tahun_ajaran_id'] ?? '') == $ta['id']) ? 'selected' : '' ?>>
                            <?= e($ta['nama']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Kelas</label>
                <select name="kelas_id" class="form-select" required>
                    <?php
                    $q_kelas_wali = mysqli_query(
                        $koneksi,
                        "SELECT id,nama FROM t_kelas ORDER BY nama"
                    );
                    while ($k = mysqli_fetch_assoc($q_kelas_wali)):
                    ?>
                        <option value="<?= $k['id'] ?>"
                            <?= (($data_edit['kelas_id'] ?? '') == $k['id']) ? 'selected' : '' ?>>
                            <?= e($k['nama']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Guru</label>
                <select name="guru_id" class="form-select" required>
                    <?php
                    $q_guru_wali = mysqli_query(
                        $koneksi,
                        "SELECT id,nama FROM t_guru
                         WHERE status_aktif=1 ORDER BY nama"
                    );
                    while ($g = mysqli_fetch_assoc($q_guru_wali)):
                    ?>
                        <option value="<?= $g['id'] ?>"
                            <?= (($data_edit['guru_id'] ?? '') == $g['id']) ? 'selected' : '' ?>>
                            <?= e($g['nama']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control"
                    value="<?= e($data_edit['tanggal_mulai'] ?? '') ?>">
            </div>

            <div class="col-md-4 mb-3">
                <label>Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control"
                    value="<?= e($data_edit['tanggal_selesai'] ?? '') ?>">
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
            <a href="dashboard.php?page=kelola_wali_kelas" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </form>
</div>

<?php
$per_halaman_wali = 10;

$total_query_wali = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM t_wali_kelas");
$total_data_wali = (int) mysqli_fetch_assoc($total_query_wali)['total'];

$total_halaman_wali = max(1, (int) ceil($total_data_wali / $per_halaman_wali));
$halaman_wali = max(1, (int) ($_GET['halaman'] ?? 1));
$halaman_wali = min($halaman_wali, $total_halaman_wali);
$offset_wali = ($halaman_wali - 1) * $per_halaman_wali;

$q_wali = mysqli_query($koneksi, "
    SELECT
        wk.*,
        ta.nama AS tahun,
        k.nama AS kelas,
        g.nama AS guru
    FROM t_wali_kelas wk
    LEFT JOIN t_tahun_ajaran ta ON wk.tahun_ajaran_id=ta.id
    LEFT JOIN t_kelas k ON wk.kelas_id=k.id
    LEFT JOIN t_guru g ON wk.guru_id=g.id
    ORDER BY wk.id DESC
    LIMIT $offset_wali, $per_halaman_wali
");

$nomor_wali = $offset_wali + 1;
?>

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
                <?php if ($total_data_wali > 0): ?>
                    <?php while ($r = mysqli_fetch_assoc($q_wali)): ?>
                        <tr>
                            <td><?= $nomor_wali++ ?></td>
                            <td><?= e($r['tahun'] ?? '') ?></td>
                            <td><?= e($r['kelas'] ?? '') ?></td>
                            <td><?= e($r['guru'] ?? '') ?></td>
                            <td>
                                <?= $r['status_aktif']
                                    ? '<span class="badge bg-success">Aktif</span>'
                                    : '<span class="badge bg-secondary">Tidak Aktif</span>' ?>
                            </td>
                            <td>
                                <a href="dashboard.php?page=kelola_wali_kelas&edit=<?= $r['id'] ?>"
                                   class="btn btn-edit btn-sm">Edit</a>

                                <a href="dashboard.php?page=kelola_wali_kelas&hapus=wali&id=<?= $r['id'] ?>"
                                   class="btn btn-delete btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus wali kelas ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data wali kelas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
        <small>
            Menampilkan <?= $total_data_wali ? $offset_wali + 1 : 0 ?>–<?= min($offset_wali + $per_halaman_wali, $total_data_wali) ?>
            dari <?= $total_data_wali ?> data
        </small>

        <nav aria-label="Pagination wali kelas">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item <?= $halaman_wali <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="dashboard.php?page=kelola_wali_kelas&halaman=<?= max(1, $halaman_wali - 1) ?>">Sebelumnya</a>
                </li>

                <?php for ($i = 1; $i <= $total_halaman_wali; $i++): ?>
                    <li class="page-item <?= $i == $halaman_wali ? 'active' : '' ?>">
                        <a class="page-link" href="dashboard.php?page=kelola_wali_kelas&halaman=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $halaman_wali >= $total_halaman_wali ? 'disabled' : '' ?>">
                    <a class="page-link" href="dashboard.php?page=kelola_wali_kelas&halaman=<?= min($total_halaman_wali, $halaman_wali + 1) ?>">Selanjutnya</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
