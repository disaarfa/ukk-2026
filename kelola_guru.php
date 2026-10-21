<?php
/* Halaman kelola_guru; dipanggil melalui dashboard.php */

// =========================
// PENGATURAN PAGINATION
// =========================
$per_halaman = 10;
$halaman = max(1, (int)($_GET['halaman'] ?? 1));
$edit_id = (int)($_GET['edit'] ?? 0);

$data_edit = null;
$pesan = '';
$berhasil = false;

// =========================
// PROSES TAMBAH DAN EDIT
// =========================
if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['aksi'])
    && in_array($_POST['aksi'], ['tambah', 'edit'], true)) {

    $aksi = $_POST['aksi'];
    $nip = trim($_POST['nip'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $status_aktif = (int)($_POST['status_aktif'] ?? 1);
    $password = $_POST['password'] ?? '';
    $konfirmasi = $_POST['konfirmasi_password'] ?? '';

    if ($nip === '' || $nama === '') {
        $pesan = 'NIP dan nama guru wajib diisi.';
    } elseif (!in_array($status_aktif, [0, 1], true)) {
        $pesan = 'Status guru tidak valid.';
    } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesan = 'Format email tidak valid.';
    } elseif ($aksi === 'tambah' && $password === '') {
        $pesan = 'Password wajib diisi.';
    } elseif ($aksi === 'tambah' && $password !== $konfirmasi) {
        $pesan = 'Password dan konfirmasi password tidak sama.';
    } elseif ($aksi === 'edit' && $password !== '' && $password !== $konfirmasi) {
        $pesan = 'Password dan konfirmasi password tidak sama.';
    } else {
        if ($aksi === 'tambah') {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare(
                $koneksi,
                "INSERT INTO t_guru
                (nip, nama, email, status_aktif, password)
                VALUES (?, ?, ?, ?, ?)"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "sssis",
                $nip,
                $nama,
                $email,
                $status_aktif,
                $hash
            );

        } else {
            $id = (int)($_POST['id'] ?? 0);

            if ($id <= 0) {
                $pesan = 'ID guru tidak valid.';
            } elseif ($password !== '') {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $stmt = mysqli_prepare(
                    $koneksi,
                    "UPDATE t_guru
                     SET nip=?, nama=?, email=?, status_aktif=?, password=?
                     WHERE id=?"
                );

                mysqli_stmt_bind_param(
                    $stmt,
                    "sssisi",
                    $nip,
                    $nama,
                    $email,
                    $status_aktif,
                    $hash,
                    $id
                );

            } else {
                $stmt = mysqli_prepare(
                    $koneksi,
                    "UPDATE t_guru
                     SET nip=?, nama=?, email=?, status_aktif=?
                     WHERE id=?"
                );

                mysqli_stmt_bind_param(
                    $stmt,
                    "sssii",
                    $nip,
                    $nama,
                    $email,
                    $status_aktif,
                    $id
                );
            }
        }

        if ($pesan === '') {
            $berhasil = mysqli_stmt_execute($stmt);

            if ($berhasil) {
                $pesan = $aksi === 'tambah'
                    ? 'Guru berhasil ditambahkan!'
                    : 'Data guru berhasil diperbarui!';
            } else {
                $pesan = 'Gagal menyimpan data. Periksa NIP, email, dan struktur tabel.';
            }

            mysqli_stmt_close($stmt);
        }
    }

    if ($berhasil) {
        echo '<script>alert(' . json_encode($pesan) . ');';
        echo 'window.location.href="dashboard.php?page=kelola_guru";</script>';
        return;
    } else {
        echo '<script>alert(' . json_encode($pesan) . ');</script>';
    }
}

// =========================
// AMBIL DATA UNTUK DIEDIT
// =========================
if ($edit_id > 0) {
    $stmt_edit = mysqli_prepare(
        $koneksi,
        "SELECT id, nip, nama, email, status_aktif
         FROM t_guru
         WHERE id=?
         LIMIT 1"
    );

    mysqli_stmt_bind_param($stmt_edit, "i", $edit_id);
    mysqli_stmt_execute($stmt_edit);

    $hasil_edit = mysqli_stmt_get_result($stmt_edit);
    $data_edit = mysqli_fetch_assoc($hasil_edit);

    mysqli_stmt_close($stmt_edit);

    if (!$data_edit) {
        $edit_id = 0;
    }
}

// =========================
// HITUNG TOTAL HALAMAN
// =========================
$hasil_total = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM t_guru"
);

$total_data = (int)mysqli_fetch_assoc($hasil_total)['total'];
$total_halaman = max(1, (int)ceil($total_data / $per_halaman));

$halaman = min($halaman, $total_halaman);
$offset = ($halaman - 1) * $per_halaman;

// =========================
// AMBIL DATA GURU
// =========================
$stmt_data = mysqli_prepare(
    $koneksi,
    "SELECT * FROM t_guru
     ORDER BY id DESC
     LIMIT ? OFFSET ?"
);

mysqli_stmt_bind_param($stmt_data, "ii", $per_halaman, $offset);
mysqli_stmt_execute($stmt_data);

$q = mysqli_stmt_get_result($stmt_data);
?>

<!-- =========================
     FORM TAMBAH / EDIT GURU
========================= -->

<div class="form-box">

    <h4><?= $data_edit ? 'Edit Guru' : 'Tambah Guru' ?></h4>

    <form method="POST"
          action="dashboard.php?page=kelola_guru<?= $data_edit ? '&edit=' . (int)$data_edit['id'] : '' ?>">

        <input type="hidden"
               name="aksi"
               value="<?= $data_edit ? 'edit' : 'tambah' ?>">

        <?php if ($data_edit): ?>
            <input type="hidden"
                   name="id"
                   value="<?= (int)$data_edit['id'] ?>">
        <?php endif; ?>

        <div class="row">

            <!-- BARIS 1 -->
            
            <div class="col-md-6 mb-3">
            <label>NIP</label>
            <input
                  type="text"
                  name="nip"
                  class="form-control"
                  required
                  maxlength="15"
                  inputmode="numeric"
                  pattern="[0-9]{1,15}"
                 title="NIP hanya boleh berisi angka, maksimal 15 digit."
                 oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15)"
                 value="<?= e($data_edit['nip'] ?? '') ?>"
                 placeholder="Masukkan NIP maksimal 15 angka"
             >
            </div>


            <div class="col-md-6 mb-3">
                <label>Nama Guru</label>
                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    required
                    value="<?= e($data_edit['nama'] ?? '') ?>"
                >
            </div>

            <!-- BARIS 2: EMAIL DAN PASSWORD -->
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="<?= e($data_edit['email'] ?? '') ?>"
                >
            </div>

            <div class="col-md-6 mb-3">
                <label>Password <?= $data_edit ? '(opsional)' : '' ?></label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    <?= $data_edit ? '' : 'required' ?>
                    autocomplete="new-password"
                    placeholder="<?= $data_edit ? 'Kosongkan jika tidak diubah' : 'Masukkan password' ?>"
                >
            </div>

            <!-- BARIS 3: STATUS DAN KONFIRMASI -->
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

            <div class="col-md-6 mb-3">
                <label>Konfirmasi Password</label>
                <input
                    type="password"
                    name="konfirmasi_password"
                    class="form-control"
                    <?= $data_edit ? '' : 'required' ?>
                    autocomplete="new-password"
                    placeholder="Ulangi password"
                >
            </div>

        </div>

        <button type="submit" class="btn btn-soft">
            <?= $data_edit ? 'Update Guru' : 'Tambah Guru' ?>
        </button>

        <?php if ($data_edit): ?>
            <a href="dashboard.php?page=kelola_guru"
               class="btn btn-secondary">
                Batal
            </a>
        <?php endif; ?>

    </form>

</div>


<!-- =========================
     TABEL DATA GURU
========================= -->

<div class="table-box">

    <h4>Data Guru</h4>

    <p>Jumlah guru: <?= $total_data ?> data</p>

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Email</th>
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
                            <td><?= e($r['nip']) ?></td>
                            <td><?= e($r['nama']) ?></td>
                            <td><?= e($r['email'] ?? '') ?></td>

                            <td>
                                <?= $r['status_aktif']
                                    ? '<span class="badge bg-success">Aktif</span>'
                                    : '<span class="badge bg-secondary">Tidak Aktif</span>' ?>
                            </td>

                            <td>
                                <a
                                    href="dashboard.php?page=kelola_guru&edit=<?= (int)$r['id'] ?>"
                                    class="btn btn-edit btn-sm">
                                    Edit
                                </a>

                                <a
                                    href="hapus_guru.php?id=<?= (int)$r['id'] ?>"
                                    class="btn btn-delete btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus guru ini secara permanen?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data guru.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <!-- ===================
         PAGINATION DI KANAN
        =================== -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

        <small class="text-muted">
            Menampilkan
            <?= $total_data > 0 ? $offset + 1 : 0 ?>
            -
            <?= min($offset + $per_halaman, $total_data) ?>
            dari <?= $total_data ?> data
        </small>

        <nav aria-label="Navigasi halaman guru">

            <ul class="pagination justify-content-end flex-wrap mb-0">

                <li class="page-item <?= $halaman <= 1 ? 'disabled' : '' ?>">
                    <a
                        class="page-link"
                        href="dashboard.php?page=kelola_guru&halaman=<?= max(1, $halaman - 1) ?>">
                        Sebelumnya
                    </a>
                </li>

                <?php for ($i = 1; $i <= $total_halaman; $i++): ?>

                    <li class="page-item <?= $i === $halaman ? 'active' : '' ?>">
                        <a
                            class="page-link"
                            href="dashboard.php?page=kelola_guru&halaman=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>

                <?php endfor; ?>

                <li class="page-item <?= $halaman >= $total_halaman ? 'disabled' : '' ?>">
                    <a
                        class="page-link"
                        href="dashboard.php?page=kelola_guru&halaman=<?= min($total_halaman, $halaman + 1) ?>">
                        Selanjutnya
                    </a>
                </li>

            </ul>

        </nav>

    </div>

</div>

<?php mysqli_stmt_close($stmt_data); ?>
