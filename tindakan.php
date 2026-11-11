<?php
/* HALAMAN TINDAKAN PELANGGARAN */

/* =========================
   PROSES SIMPAN TINDAKAN
   ========================= */

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['simpan_tindakan'])
) {

    $id = (int) ($_POST['id'] ?? 0);
    $tindakan = trim($_POST['tindakan'] ?? '');
    $status = $_POST['status'] ?? 'Pending';

    $status_valid = ['Pending', 'Proses', 'Selesai'];

    if ($id > 0 && in_array($status, $status_valid, true)) {

        $stmt = mysqli_prepare($koneksi, "
            UPDATE t_pelanggaran_siswa
            SET tindakan = ?, status = ?
            WHERE id = ?
        ");

        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "ssi",
                $tindakan,
                $status,
                $id
            );

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            echo '<script>
                window.location.href = "dashboard.php?page=tindakan";
            </script>';

            exit;

        } else {
            die("Gagal menyiapkan query: " . mysqli_error($koneksi));
        }
    }
}
?>

<div class="table-box">

    <h4>Data Tindakan Pelanggaran</h4>

    <div class="table-responsive">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Siswa</th>
                    <th>Guru Pencatat</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Tindakan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php

                /* =========================
                   PAGINATION 10 DATA
                   ========================= */

                $batas = 10;

                $halaman = isset($_GET['halaman_tindakan'])
                    ? max(1, (int) $_GET['halaman_tindakan'])
                    : 1;

                /* HITUNG DATA YANG BELUM SELESAI */

                $total_query = mysqli_query($koneksi, "
                    SELECT COUNT(*) AS total
                    FROM t_pelanggaran_siswa
                    WHERE status IS NULL
                       OR status <> 'Selesai'
                ");

                if (!$total_query) {
                    die("Query hitung tindakan gagal: " . mysqli_error($koneksi));
                }

                $total_data = (int) mysqli_fetch_assoc($total_query)['total'];

                $total_halaman = max(
                    1,
                    (int) ceil($total_data / $batas)
                );

                $halaman = min($halaman, $total_halaman);

                $posisi = ($halaman - 1) * $batas;

                $no = $posisi + 1;

                /* =========================
                   AMBIL DATA TINDAKAN
                   ========================= */

                $q = mysqli_query($koneksi, "
                    SELECT *
                    FROM t_pelanggaran_siswa
                    WHERE status IS NULL
                       OR status <> 'Selesai'
                    ORDER BY id DESC
                    LIMIT $posisi, $batas
                ");

                if (!$q) {
                    die("Query tindakan gagal: " . mysqli_error($koneksi));
                }

                if (mysqli_num_rows($q) > 0):

                    while ($r = mysqli_fetch_assoc($q)):

                        $form_id = 'form_tindakan_' . (int)$r['id'];

                ?>

                <tr>

                    <td>

                        <?= $no++ ?>

                        <form
                            id="<?= $form_id ?>"
                            method="POST"
                            action="dashboard.php?page=tindakan"
                        >
                            <input
                                type="hidden"
                                name="id"
                                value="<?= (int)$r['id'] ?>"
                            >
                        </form>

                    </td>

                    <td>
                        <?= e($r['nama_siswa']) ?>
                    </td>

                    <td>
                        <?= e($r['nama_guru'] ?: '-') ?>
                    </td>

                    <td>
                        <?= e($r['nama_pelanggaran']) ?>
                    </td>

                    <td>
                        <?= e($r['poin']) ?>
                    </td>

                    <td>

                        <input
                            type="text"
                            name="tindakan"
                            form="<?= $form_id ?>"
                            class="form-control form-control-sm"
                            value="<?= e($r['tindakan']) ?>"
                        >

                    </td>

                    <td>

                        <select
                            name="status"
                            form="<?= $form_id ?>"
                            class="form-select form-select-sm"
                        >

                            <option
                                value="Pending"
                                <?= $r['status'] === 'Pending' ? 'selected' : '' ?>
                            >
                                Pending
                            </option>

                            <option
                                value="Proses"
                                <?= $r['status'] === 'Proses' ? 'selected' : '' ?>
                            >
                                Proses
                            </option>

                            <option
                                value="Selesai"
                                <?= $r['status'] === 'Selesai' ? 'selected' : '' ?>
                            >
                                Selesai
                            </option>

                        </select>

                    </td>

                    <td>

                        <button
                            class="btn btn-soft btn-sm"
                            type="submit"
                            name="simpan_tindakan"
                            value="1"
                            form="<?= $form_id ?>"
                        >
                            Simpan
                        </button>

                    </td>

                </tr>

                <?php

                    endwhile;

                else:

                ?>

                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Belum ada data tindakan pelanggaran.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->

    <div class="d-flex justify-content-end align-items-center flex-wrap gap-2 mt-3">

        <small class="text-muted">
            Halaman <?= $halaman ?>
            dari <?= $total_halaman ?>
            (<?= $total_data ?> data)
        </small>

        <nav aria-label="Pagination data tindakan">

            <ul class="pagination pagination-sm mb-0">

                <li class="page-item <?= ($halaman <= 1) ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=tindakan&halaman_tindakan=<?= max(1, $halaman - 1) ?>"
                    >
                        &laquo;
                    </a>

                </li>

                <?php

                $mulai = max(1, $halaman - 2);
                $akhir = min($total_halaman, $halaman + 2);

                for ($i = $mulai; $i <= $akhir; $i++):

                ?>

                    <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">

                        <a
                            class="page-link"
                            href="dashboard.php?page=tindakan&halaman_tindakan=<?= $i ?>"
                        >
                            <?= $i ?>
                        </a>

                    </li>

                <?php endfor; ?>

                <li class="page-item <?= ($halaman >= $total_halaman) ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=tindakan&halaman_tindakan=<?= min($total_halaman, $halaman + 1) ?>"
                    >
                        &raquo;
                    </a>

                </li>

            </ul>

        </nav>

    </div>

</div>
