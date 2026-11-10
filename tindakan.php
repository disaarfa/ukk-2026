
<?php /* Halaman tindakan; dipanggil melalui dashboard.php */ ?>

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

                /* HITUNG TOTAL DATA */

                $total_query = mysqli_query($koneksi, "
                    SELECT COUNT(*) AS total
                    FROM t_pelanggaran_siswa
                ");

                $total_data = (int) mysqli_fetch_assoc($total_query)['total'];

                $total_halaman = max(
                    1,
                    (int) ceil($total_data / $batas)
                );

                /* PASTIKAN HALAMAN VALID */

                $halaman = min($halaman, $total_halaman);

                /* TENTUKAN POSISI DATA */

                $posisi = ($halaman - 1) * $batas;

                $no = $posisi + 1;

                /* AMBIL DATA */

                $q = mysqli_query($koneksi, "
                    SELECT *
                    FROM t_pelanggaran_siswa
                    ORDER BY id DESC
                    LIMIT $posisi, $batas
                ");

                if (!$q) {
                    die("Query tindakan gagal: " . mysqli_error($koneksi));
                }

                if (mysqli_num_rows($q) > 0):

                    while ($r = mysqli_fetch_assoc($q)):

                ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td><?= e($r['nama_siswa']) ?></td>

                    <td>
                        <?= e($r['nama_guru'] ?: '-') ?>
                    </td>

                    <td><?= e($r['nama_pelanggaran']) ?></td>

                    <td><?= e($r['poin']) ?></td>

                    <td>

                        <form method="POST">

                            <input
                                type="hidden"
                                name="id"
                                value="<?= (int)$r['id'] ?>"
                            >

                            <input
                                type="text"
                                name="tindakan"
                                class="form-control form-control-sm"
                                value="<?= e($r['tindakan']) ?>"
                            >

                    </td>

                    <td>

                        <select
                            name="status"
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
                        >
                            Simpan
                        </button>

                        </form>

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


    <!-- =========================
         PAGINATION DI SISI KANAN
         ========================= -->

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
