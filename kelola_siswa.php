
<?php
/* Halaman kelola_siswa; dipanggil melalui dashboard.php */

// =========================
// PENGATURAN PAGINATION
// =========================
$per_halaman = 10;
$halaman = max(1, (int)($_GET['halaman'] ?? 1));

// =========================
// AMBIL DATA UNTUK EDIT
// =========================
$data_edit = null;

if ($edit_id > 0) {
    $stmt_edit = mysqli_prepare(
        $koneksi,
        "SELECT * FROM t_siswa WHERE id=? LIMIT 1"
    );

    mysqli_stmt_bind_param($stmt_edit, "i", $edit_id);
    mysqli_stmt_execute($stmt_edit);

    $hasil_edit = mysqli_stmt_get_result($stmt_edit);
    $data_edit = mysqli_fetch_assoc($hasil_edit);

    mysqli_stmt_close($stmt_edit);
}
?>

<div class="form-box">

    <h4><?= $data_edit ? 'Edit Siswa' : 'Tambah Siswa' ?></h4>

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
                value="<?= (int)$data_edit['id'] ?>"
            >
        <?php endif; ?>

        <div class="row">

            <!-- NIS -->
            <div class="col-md-6 mb-3">
                <label>NIS</label>
                <input
                    type="text"
                    name="nis"
                    class="form-control"
                    required
                    maxlength="10"
                    minlength="10"
                    inputmode="numeric"
                    pattern="[0-9]{10}"
                    title="NIS harus terdiri dari tepat 10 angka."
                    oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)"
                    value="<?= e($data_edit['nis'] ?? '') ?>"
                    placeholder="Masukkan 10 angka NIS"
                >
            </div>

            <!-- NISN -->
            <div class="col-md-6 mb-3">
                <label>NISN</label>
                <input
                    type="text"
                    name="nisn"
                    class="form-control"
                    maxlength="10"
                    minlength="10"
                    inputmode="numeric"
                    pattern="[0-9]{10}"
                    title="Jika diisi, NISN harus terdiri dari tepat 10 angka."
                    oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)"
                    value="<?= e($data_edit['nisn'] ?? '') ?>"
                    placeholder="Masukkan 10 angka NISN"
                >
            </div>

            <!-- NAMA -->
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

            <!-- JENIS KELAMIN -->
            <div class="col-md-6 mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select">

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

            <!-- TANGGAL LAHIR -->
            <div class="col-md-6 mb-3">
                <label>Tanggal Lahir</label>
                <input
                    type="date"
                    name="tanggal_lahir"
                    class="form-control"
                    value="<?= e($data_edit['tanggal_lahir'] ?? '') ?>"
                >
            </div>

            <!-- STATUS -->
            <div class="col-md-6 mb-3">
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

            <!-- ALAMAT -->
            <div class="col-12 mb-3">
                <label>Alamat</label>
                <textarea
                    name="alamat"
                    class="form-control"
                    rows="3"
                ><?= e($data_edit['alamat'] ?? '') ?></textarea>
            </div>

        </div>

        <button type="submit" class="btn btn-soft">
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


<!-- =========================
     TABEL DATA SISWA
========================= -->

<?php

// =========================
// HITUNG JUMLAH SISWA
// =========================
$hasil_total = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM t_siswa"
);

$total_data = (int)mysqli_fetch_assoc($hasil_total)['total'];

$total_halaman = max(
    1,
    (int)ceil($total_data / $per_halaman)
);

$halaman = min($halaman, $total_halaman);
$offset = ($halaman - 1) * $per_halaman;


// =========================
// AMBIL DATA SISWA
// SISWA BARU DITAMPILKAN DULU
// =========================
$stmt_siswa = mysqli_prepare(
    $koneksi,
    "SELECT * FROM t_siswa
     ORDER BY id ASC
     LIMIT ? OFFSET ?"
);

mysqli_stmt_bind_param(
    $stmt_siswa,
    "ii",
    $per_halaman,
    $offset
);

mysqli_stmt_execute($stmt_siswa);
$q = mysqli_stmt_get_result($stmt_siswa);

?>

<div class="table-box">

    <h4 class="mb-3">Data Siswa</h4>

    <p>Jumlah siswa: <?= $total_data ?> data</p>

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

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

            <tbody>

                <?php if (mysqli_num_rows($q) > 0): ?>

                    <?php $no = $offset + 1; ?>

                    <?php while ($r = mysqli_fetch_assoc($q)): ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= e($r['nis']) ?></td>

                            <td><?= e($r['nisn'] ?? '') ?></td>

                            <td><?= e($r['nama']) ?></td>

                            <td><?= e($r['jenis_kelamin']) ?></td>

                            <td><?= e($r['tanggal_lahir'] ?? '') ?></td>

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
                                    href="dashboard.php?page=kelola_siswa&edit=<?= (int)$r['id'] ?>"
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

                <?php else: ?>

                    <tr>
                        <td colspan="9" class="text-center">
                            Belum ada data siswa.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>


    <!-- =========================
         PAGINATION
    ========================= -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

        <small class="text-muted">
            Menampilkan <?= $total_data > 0 ? $offset + 1 : 0 ?>
            - <?= min($offset + $per_halaman, $total_data) ?>
            dari <?= $total_data ?> siswa
        </small>

        <nav aria-label="Pagination siswa">

            <ul class="pagination justify-content-end flex-wrap mb-0">

                <!-- SEBELUMNYA -->
                <li class="page-item <?= $halaman <= 1 ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=kelola_siswa&halaman=<?= max(1, $halaman - 1) ?>"
                    >
                        Sebelumnya
                    </a>

                </li>


                <!-- NOMOR HALAMAN -->
                <?php for ($i = 1; $i <= $total_halaman; $i++): ?>

                    <li class="page-item <?= $i === $halaman ? 'active' : '' ?>">

                        <a
                            class="page-link"
                            href="dashboard.php?page=kelola_siswa&halaman=<?= $i ?>"
                        >
                            <?= $i ?>
                        </a>

                    </li>

                <?php endfor; ?>


                <!-- SELANJUTNYA -->
                <li class="page-item <?= $halaman >= $total_halaman ? 'disabled' : '' ?>">

                    <a
                        class="page-link"
                        href="dashboard.php?page=kelola_siswa&halaman=<?= min($total_halaman, $halaman + 1) ?>"
                    >
                        Selanjutnya
                    </a>

                </li>

            </ul>

        </nav>

    </div>

</div>

<?php
mysqli_stmt_close($stmt_siswa);
?>
