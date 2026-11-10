<?php
/* Halaman kelola_tahun_ajaran; dipanggil melalui dashboard.php */

$data_edit = null;

if ($edit_id > 0) {
    $qe = mysqli_query(
        $koneksi,
        "SELECT * FROM t_tahun_ajaran WHERE id='$edit_id' LIMIT 1"
    );

    $data_edit = mysqli_fetch_assoc($qe);
}
?>

<div class="form-box">

    <h4>
        <?= $data_edit ? 'Edit Tahun Ajaran' : 'Tambah Tahun Ajaran' ?>
    </h4>

    <form method="POST">

        <input type="hidden" name="aksi"
               value="<?= $data_edit ? 'edit' : 'tambah' ?>">

        <?php if ($data_edit): ?>
            <input type="hidden" name="id"
                   value="<?= $data_edit['id'] ?>">
        <?php endif; ?>

        <div class="row">

            <div class="col-md-4 mb-3">
                <label>Tahun Ajaran</label>
                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    required
                    placeholder="2026/2027"
                    value="<?= e($data_edit['nama'] ?? '') ?>"
                >
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

        <button type="submit" class="btn btn-soft">
            <?= $data_edit ? 'Update' : 'Tambah' ?>
        </button>

        <?php if ($data_edit): ?>
            <a href="dashboard.php?page=kelola_tahun_ajaran"
               class="btn btn-secondary">
                Batal
            </a>
        <?php endif; ?>

    </form>
</div>


<?php
/* ================================
   DATA PAGINATION
================================ */

$per_halaman_ta = 10;

$total_query_ta = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM t_tahun_ajaran"
);

$total_data_ta = (int) mysqli_fetch_assoc($total_query_ta)['total'];

$total_halaman_ta = max(
    1,
    (int) ceil($total_data_ta / $per_halaman_ta)
);

$halaman_ta = max(1, (int) ($_GET['halaman'] ?? 1));

$halaman_ta = min($halaman_ta, $total_halaman_ta);

$offset_ta = ($halaman_ta - 1) * $per_halaman_ta;

$q_ta = mysqli_query(
    $koneksi,
    "SELECT * FROM t_tahun_ajaran
     ORDER BY id DESC
     LIMIT $offset_ta, $per_halaman_ta"
);

$nomor_ta = $offset_ta + 1;
?>


<div class="table-box">

    <h4>Data Tahun Ajaran</h4>

    <div class="table-responsive">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Tahun Ajaran</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if ($total_data_ta > 0): ?>

                    <?php while ($r = mysqli_fetch_assoc($q_ta)): ?>

                        <tr>

                            <td><?= $nomor_ta++ ?></td>

                            <td><?= e($r['nama']) ?></td>

                            <td><?= e($r['tanggal_mulai']) ?></td>

                            <td><?= e($r['tanggal_selesai']) ?></td>

                            <td>
                                <?= $r['status_aktif']
                                    ? '<span class="badge bg-success">Aktif</span>'
                                    : '<span class="badge bg-secondary">Tidak Aktif</span>' ?>
                            </td>

                            <td>

                                <a
                                    href="dashboard.php?page=kelola_tahun_ajaran&edit=<?= $r['id'] ?>"
                                    class="btn btn-edit btn-sm">
                                    Edit
                                </a>

                                <a
                                    href="dashboard.php?page=kelola_tahun_ajaran&hapus=tahun&id=<?= $r['id'] ?>"
                                    class="btn btn-delete btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus tahun ajaran ini?')">
                                    Hapus
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data tahun ajaran.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>


    <!-- PAGINATION -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">

        <small>
            Menampilkan
            <?= $total_data_ta ? $offset_ta + 1 : 0 ?>
            –
            <?= min($offset_ta + $per_halaman_ta, $total_data_ta) ?>
            dari <?= $total_data_ta ?> data
        </small>

        <nav aria-label="Pagination tahun ajaran">

            <ul class="pagination pagination-sm mb-0">

                <li class="page-item <?= $halaman_ta <= 1 ? 'disabled' : '' ?>">

                    <a class="page-link"
                       href="dashboard.php?page=kelola_tahun_ajaran&halaman=<?= max(1, $halaman_ta - 1) ?>">
                        Sebelumnya
                    </a>

                </li>

                <?php for ($i = 1; $i <= $total_halaman_ta; $i++): ?>

                    <li class="page-item <?= $i == $halaman_ta ? 'active' : '' ?>">

                        <a class="page-link"
                           href="dashboard.php?page=kelola_tahun_ajaran&halaman=<?= $i ?>">
                            <?= $i ?>
                        </a>

                    </li>

                <?php endfor; ?>

                <li class="page-item <?= $halaman_ta >= $total_halaman_ta ? 'disabled' : '' ?>">

                    <a class="page-link"
                       href="dashboard.php?page=kelola_tahun_ajaran&halaman=<?= min($total_halaman_ta, $halaman_ta + 1) ?>">
                        Selanjutnya
                    </a>

                </li>

            </ul>

        </nav>

    </div>

</div>