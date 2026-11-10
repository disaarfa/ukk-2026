
<?php /* Halaman catat_pelanggaran; dipanggil melalui dashboard.php */ ?>

<?php
/* =========================
   AMBIL DATA KELAS
   HANYA XII RPL 1 DAN 2
   ========================= */

$q_kelas = mysqli_query($koneksi, "
    SELECT id, nama
    FROM t_kelas
    WHERE nama IN ('XII RPL 1', 'XII RPL 2')
    AND status_aktif = 1
    ORDER BY nama ASC
");

/* =========================
   AMBIL DATA SISWA
   SESUAI PENEMPATAN KELAS
   ========================= */

$q_siswa = mysqli_query($koneksi, "
    SELECT DISTINCT
        s.id,
        s.nama,
        k.id AS kelas_id,
        k.nama AS nama_kelas
    FROM t_siswa s
    INNER JOIN t_kelas_siswa ks
        ON ks.siswa_id = s.id
    INNER JOIN t_kelas k
        ON k.id = ks.kelas_id
    WHERE s.status_aktif = 1
    AND ks.status_aktif = 1
    AND k.status_aktif = 1
    AND k.nama IN ('XII RPL 1', 'XII RPL 2')
    ORDER BY k.nama ASC, s.nama ASC
");
?>

<div class="form-box">

    <h4>Catat Pelanggaran Siswa</h4>

    <form method="POST">

        <div class="row">

            <!-- PILIH KELAS -->
            <div class="col-md-6 mb-3">

                <label>Kelas</label>

                <select
                    name="kelas_id"
                    id="pilihKelas"
                    class="form-select"
                    required
                >

                    <option value="">-- Pilih Kelas --</option>

                    <?php while ($k = mysqli_fetch_assoc($q_kelas)): ?>

                        <option value="<?= (int)$k['id'] ?>">
                            <?= e($k['nama']) ?>
                        </option>

                    <?php endwhile; ?>

                </select>

            </div>

            <!-- PILIH SISWA -->
            <div class="col-md-6 mb-3">

                <label>Nama Siswa</label>

                <select
                    name="siswa_id"
                    id="pilihSiswa"
                    class="form-select"
                    required
                    disabled
                >

                    <option value="">-- Pilih Kelas Terlebih Dahulu --</option>

                    <?php while ($s = mysqli_fetch_assoc($q_siswa)): ?>

                        <option
                            value="<?= (int)$s['id'] ?>"
                            data-kelas="<?= (int)$s['kelas_id'] ?>"
                            hidden
                        >
                            <?= e($s['nama']) ?>
                        </option>

                    <?php endwhile; ?>

                </select>

            </div>

            <!-- JENIS PELANGGARAN -->
            <div class="col-md-6 mb-3">

                <label>Jenis Pelanggaran</label>

                <select
                    name="pelanggaran_id"
                    class="form-select"
                    required
                >

                    <option value="">
                        -- Pilih Pelanggaran --
                    </option>

                    <?php

                    $q = mysqli_query(
                        $koneksi,
                        "SELECT id,kode,nama,poin
                         FROM t_pelanggaran
                         WHERE status_aktif=1
                         ORDER BY nama"
                    );

                    while ($r = mysqli_fetch_assoc($q)):

                    ?>

                        <option value="<?= (int)$r['id'] ?>">

                            <?= e($r['kode']) ?> -
                            <?= e($r['nama']) ?>
                            (<?= e($r['poin']) ?> poin)

                        </option>

                    <?php endwhile; ?>

                </select>

            </div>

            <!-- TANGGAL -->
            <div class="col-md-6 mb-3">

                <label>Tanggal</label>

                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="<?= date('Y-m-d') ?>"
                    required
                >

            </div>

            <!-- KETERANGAN -->
            <div class="col-12 mb-3">

                <label>Keterangan</label>

                <textarea
                    name="keterangan"
                    class="form-control"
                    rows="4"
                    placeholder="Masukkan keterangan pelanggaran..."
                ></textarea>

            </div>

        </div>

        <button type="submit" class="btn btn-soft">
            Simpan Pelanggaran
        </button>

    </form>

</div>


<!-- =========================
     DATA PELANGGARAN TERBARU
     ========================= -->

<div class="table-box">

    <h4>Data Pelanggaran Terbaru</h4>

    <div class="table-responsive">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

                <?php

                /* =========================
                   PAGINATION 10 DATA
                   ========================= */

                $batas = 10;

                $halaman = isset($_GET['halaman_pelanggaran'])
                    ? max(1, (int) $_GET['halaman_pelanggaran'])
                    : 1;

                /* HITUNG SELURUH DATA */

                $total_query = mysqli_query(
                    $koneksi,
                    "SELECT COUNT(*) AS total
                     FROM t_pelanggaran_siswa"
                );

                $total_data = (int) mysqli_fetch_assoc(
                    $total_query
                )['total'];

                $total_halaman = max(
                    1,
                    (int) ceil($total_data / $batas)
                );

                $halaman = min($halaman, $total_halaman);

                $posisi = ($halaman - 1) * $batas;

                $no = $posisi + 1;

                /* AMBIL DATA TERBARU */

                $q = mysqli_query($koneksi, "
                    SELECT *
                    FROM t_pelanggaran_siswa
                    ORDER BY id DESC
                    LIMIT $posisi, $batas
                ");

                while ($r = mysqli_fetch_assoc($q)):

                ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= e($r['nama_siswa']) ?></td>

                        <td><?= e($r['nama_kelas']) ?></td>

                        <td><?= e($r['nama_pelanggaran']) ?></td>

                        <td><?= e($r['poin']) ?></td>

                        <td><?= e($r['tanggal']) ?></td>

                        <td><?= e($r['status']) ?></td>

                    </tr>

                <?php endwhile; ?>

                <?php if ($total_data === 0): ?>

                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data pelanggaran.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>


    <!-- =========================
         PAGINATION KANAN
         ========================= -->

    <div class="d-flex justify-content-end align-items-center flex-wrap gap-2 mt-3">

        <small class="text-muted">

            Halaman <?= $halaman ?>
            dari <?= $total_halaman ?>
            (<?= $total_data ?> data)

        </small>

        <nav aria-label="Pagination data pelanggaran">

            <ul class="pagination pagination-sm mb-0">

                <li class="page-item <?= ($halaman <= 1) ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=catat_pelanggaran&halaman_pelanggaran=<?= max(1, $halaman - 1) ?>"
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
                            href="dashboard.php?page=catat_pelanggaran&halaman_pelanggaran=<?= $i ?>"
                        >
                            <?= $i ?>
                        </a>

                    </li>

                <?php endfor; ?>

                <li class="page-item <?= ($halaman >= $total_halaman) ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=catat_pelanggaran&halaman_pelanggaran=<?= min($total_halaman, $halaman + 1) ?>"
                    >
                        &raquo;
                    </a>

                </li>

            </ul>

        </nav>

    </div>

</div>


<!-- =========================
     JAVASCRIPT FILTER SISWA
     ========================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const pilihKelas = document.getElementById('pilihKelas');
    const pilihSiswa = document.getElementById('pilihSiswa');

    const semuaSiswa = Array.from(
        pilihSiswa.querySelectorAll('option[data-kelas]')
    );

    function filterSiswa() {

        const kelasId = pilihKelas.value;

        // Kosongkan pilihan siswa
        pilihSiswa.value = '';

        // Hapus status tersembunyi semua siswa
        semuaSiswa.forEach(function (option) {

            const sesuaiKelas = option.dataset.kelas === kelasId;

            option.hidden = !sesuaiKelas;
            option.disabled = !sesuaiKelas;

        });

        // Aktifkan dropdown jika kelas sudah dipilih
        pilihSiswa.disabled = !kelasId;

        // Ubah tulisan pilihan awal
        pilihSiswa.options[0].text = kelasId
            ? '-- Pilih Siswa --'
            : '-- Pilih Kelas Terlebih Dahulu --';

    }

    pilihKelas.addEventListener('change', filterSiswa);

});

</script>
