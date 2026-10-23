
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
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['aksi'])
    && in_array($_POST['aksi'], ['tambah', 'edit'], true)
) {
    $aksi = $_POST['aksi'];
    $nip = trim($_POST['nip'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $status_aktif = (int)($_POST['status_aktif'] ?? 1);
    $password = $_POST['password'] ?? '';
    $konfirmasi = $_POST['konfirmasi_password'] ?? '';

    if ($nip === '' || $nama === '') {
        $pesan = 'NIP dan nama guru wajib diisi.';
    } elseif (
        $email === '' ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        $pesan = 'Email wajib diisi dengan format yang benar.';
    } elseif (!in_array($status_aktif, [0, 1], true)) {
        $pesan = 'Status guru tidak valid.';
    } elseif ($aksi === 'tambah' && $password === '') {
        $pesan = 'Password wajib diisi.';
    } elseif (
        ($aksi === 'tambah' || $password !== '')
        && $password !== $konfirmasi
    ) {
        $pesan = 'Password dan konfirmasi password tidak sama.';
    } else {
        try {
            mysqli_begin_transaction($koneksi);

            // ==================================
            // PROSES TAMBAH GURU
            // ==================================
            if ($aksi === 'tambah') {

                // CEK EMAIL AGAR TIDAK DUPLIKAT
                $stmt_cek = mysqli_prepare(
                    $koneksi,
                    "SELECT id FROM t_users
                     WHERE email = ?
                     LIMIT 1"
                );

                mysqli_stmt_bind_param(
                    $stmt_cek,
                    "s",
                    $email
                );

                mysqli_stmt_execute($stmt_cek);
                mysqli_stmt_store_result($stmt_cek);

                if (mysqli_stmt_num_rows($stmt_cek) > 0) {
                    mysqli_stmt_close($stmt_cek);

                    throw new Exception(
                        'Email sudah digunakan oleh akun lain.'
                    );
                }

                mysqli_stmt_close($stmt_cek);

                // HASH PASSWORD
                $hash = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

                // 1. SIMPAN AKUN KE TABEL T_USERS
                $stmt_user = mysqli_prepare(
                    $koneksi,
                    "INSERT INTO t_users
                    (name, email, password, role)
                    VALUES (?, ?, ?, 'guru')"
                );

                mysqli_stmt_bind_param(
                    $stmt_user,
                    "sss",
                    $nama,
                    $email,
                    $hash
                );

                if (!mysqli_stmt_execute($stmt_user)) {
                    $error = mysqli_stmt_error($stmt_user);
                    mysqli_stmt_close($stmt_user);

                    throw new Exception(
                        'Gagal menyimpan akun ke t_users: ' . $error
                    );
                }

                // AMBIL ID USER YANG BARU DIBUAT
                $user_id = mysqli_insert_id($koneksi);

                mysqli_stmt_close($stmt_user);

                // 2. SIMPAN DATA KE TABEL T_GURU
                // Tabel t_guru tidak memiliki kolom password.
                // Akun dihubungkan menggunakan user_id.
                $stmt_guru = mysqli_prepare(
                    $koneksi,
                    "INSERT INTO t_guru
                    (nip, nama, email, status_aktif, user_id)
                    VALUES (?, ?, ?, ?, ?)"
                );

                mysqli_stmt_bind_param(
                    $stmt_guru,
                    "sssii",
                    $nip,
                    $nama,
                    $email,
                    $status_aktif,
                    $user_id
                );

                if (!mysqli_stmt_execute($stmt_guru)) {
                    $error = mysqli_stmt_error($stmt_guru);
                    mysqli_stmt_close($stmt_guru);

                    throw new Exception(
                        'Gagal menyimpan data ke t_guru: ' . $error
                    );
                }

                mysqli_stmt_close($stmt_guru);

                $pesan =
                    'Guru berhasil ditambahkan ke t_users dan t_guru!';

            } else {

                // ==================================
                // PROSES EDIT GURU
                // ==================================
                $id = (int)($_POST['id'] ?? 0);

                if ($id <= 0) {
                    throw new Exception('ID guru tidak valid.');
                }

                // AMBIL DATA GURU LAMA
                $stmt_lama = mysqli_prepare(
                    $koneksi,
                    "SELECT id, nama, email, user_id
                     FROM t_guru
                     WHERE id = ?
                     LIMIT 1"
                );

                mysqli_stmt_bind_param(
                    $stmt_lama,
                    "i",
                    $id
                );

                mysqli_stmt_execute($stmt_lama);

                $hasil_lama = mysqli_stmt_get_result($stmt_lama);
                $data_lama = mysqli_fetch_assoc($hasil_lama);

                mysqli_stmt_close($stmt_lama);

                if (!$data_lama) {
                    throw new Exception(
                        'Data guru tidak ditemukan.'
                    );
                }

                $user_id = (int)($data_lama['user_id'] ?? 0);
                $email_lama = $data_lama['email'] ?? '';

                // Jika user_id kosong, coba cari akun berdasarkan
                // email lama dan role guru.
                if ($user_id <= 0 && $email_lama !== '') {
                    $stmt_cari = mysqli_prepare(
                        $koneksi,
                        "SELECT id
                         FROM t_users
                         WHERE email = ? AND role = 'guru'
                         LIMIT 1"
                    );

                    mysqli_stmt_bind_param(
                        $stmt_cari,
                        "s",
                        $email_lama
                    );

                    mysqli_stmt_execute($stmt_cari);

                    $hasil_cari = mysqli_stmt_get_result($stmt_cari);
                    $akun_lama = mysqli_fetch_assoc($hasil_cari);

                    mysqli_stmt_close($stmt_cari);

                    if ($akun_lama) {
                        $user_id = (int)$akun_lama['id'];
                    }
                }

                // CEK EMAIL BARU AGAR TIDAK DUPLIKAT
                $stmt_cek = mysqli_prepare(
                    $koneksi,
                    "SELECT id FROM t_users
                     WHERE email = ? AND id <> ?
                     LIMIT 1"
                );

                mysqli_stmt_bind_param(
                    $stmt_cek,
                    "si",
                    $email,
                    $user_id
                );

                mysqli_stmt_execute($stmt_cek);
                mysqli_stmt_store_result($stmt_cek);

                if (mysqli_stmt_num_rows($stmt_cek) > 0) {
                    mysqli_stmt_close($stmt_cek);

                    throw new Exception(
                        'Email sudah digunakan akun lain.'
                    );
                }

                mysqli_stmt_close($stmt_cek);

                // JIKA BELUM ADA AKUN, PASSWORD WAJIB DIISI
                if ($user_id <= 0 && $password === '') {
                    throw new Exception(
                        'Guru ini belum memiliki akun login. ' .
                        'Isi password untuk membuat akun guru.'
                    );
                }

                // ==================================
                // UPDATE ATAU BUAT AKUN T_USERS
                // ==================================
                if ($user_id > 0) {

                    if ($password !== '') {
                        $hash = password_hash(
                            $password,
                            PASSWORD_DEFAULT
                        );

                        $stmt_user = mysqli_prepare(
                            $koneksi,
                            "UPDATE t_users
                             SET name = ?, email = ?, password = ?
                             WHERE id = ? AND role = 'guru'"
                        );

                        mysqli_stmt_bind_param(
                            $stmt_user,
                            "sssi",
                            $nama,
                            $email,
                            $hash,
                            $user_id
                        );

                    } else {
                        $stmt_user = mysqli_prepare(
                            $koneksi,
                            "UPDATE t_users
                             SET name = ?, email = ?
                             WHERE id = ? AND role = 'guru'"
                        );

                        mysqli_stmt_bind_param(
                            $stmt_user,
                            "ssi",
                            $nama,
                            $email,
                            $user_id
                        );
                    }

                    if (!mysqli_stmt_execute($stmt_user)) {
                        $error = mysqli_stmt_error($stmt_user);
                        mysqli_stmt_close($stmt_user);

                        throw new Exception(
                            'Gagal memperbarui t_users: ' . $error
                        );
                    }

                    // Pastikan akun benar-benar ditemukan
                    // dengan role guru.
                    if (mysqli_stmt_affected_rows($stmt_user) === 0) {
                        // Query UPDATE bisa menghasilkan 0 perubahan
                        // jika nilainya tidak berubah. Periksa keberadaan.
                        mysqli_stmt_close($stmt_user);

                        $stmt_periksa = mysqli_prepare(
                            $koneksi,
                            "SELECT id FROM t_users
                             WHERE id = ? AND role = 'guru'
                             LIMIT 1"
                        );

                        mysqli_stmt_bind_param(
                            $stmt_periksa,
                            "i",
                            $user_id
                        );

                        mysqli_stmt_execute($stmt_periksa);

                        $hasil_periksa = mysqli_stmt_get_result(
                            $stmt_periksa
                        );

                        $akun_ada = mysqli_fetch_assoc(
                            $hasil_periksa
                        );

                        mysqli_stmt_close($stmt_periksa);

                        if (!$akun_ada) {
                            throw new Exception(
                                'Akun guru tidak ditemukan di t_users.'
                            );
                        }
                    } else {
                        mysqli_stmt_close($stmt_user);
                    }

                } else {

                    // BUAT AKUN BARU UNTUK GURU LAMA
                    $hash = password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    );

                    $stmt_user = mysqli_prepare(
                        $koneksi,
                        "INSERT INTO t_users
                        (name, email, password, role)
                        VALUES (?, ?, ?, 'guru')"
                    );

                    mysqli_stmt_bind_param(
                        $stmt_user,
                        "sss",
                        $nama,
                        $email,
                        $hash
                    );

                    if (!mysqli_stmt_execute($stmt_user)) {
                        $error = mysqli_stmt_error($stmt_user);
                        mysqli_stmt_close($stmt_user);

                        throw new Exception(
                            'Gagal membuat akun guru: ' . $error
                        );
                    }

                    $user_id = mysqli_insert_id($koneksi);

                    mysqli_stmt_close($stmt_user);
                }

                // ==================================
                // UPDATE DATA T_GURU
                // ==================================
                $stmt_guru = mysqli_prepare(
                    $koneksi,
                    "UPDATE t_guru
                     SET nip = ?,
                         nama = ?,
                         email = ?,
                         status_aktif = ?,
                         user_id = ?
                     WHERE id = ?"
                );

                mysqli_stmt_bind_param(
                    $stmt_guru,
                    "sssiii",
                    $nip,
                    $nama,
                    $email,
                    $status_aktif,
                    $user_id,
                    $id
                );

                if (!mysqli_stmt_execute($stmt_guru)) {
                    $error = mysqli_stmt_error($stmt_guru);
                    mysqli_stmt_close($stmt_guru);

                    throw new Exception(
                        'Gagal memperbarui t_guru: ' . $error
                    );
                }

                mysqli_stmt_close($stmt_guru);

                $pesan =
                    'Data guru dan akun login berhasil diperbarui!';
            }

            // SIMPAN SEMUA PERUBAHAN
            mysqli_commit($koneksi);
            $berhasil = true;

        } catch (Throwable $e) {
            mysqli_rollback($koneksi);

            $pesan = $e->getMessage();
        }
    }

    echo '<script>alert(' . json_encode($pesan) . ');';

    if ($berhasil) {
        echo 'window.location.href="dashboard.php?page=kelola_guru";';
    }

    echo '</script>';

    if ($berhasil) {
        return;
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
         WHERE id = ?
         LIMIT 1"
    );

    mysqli_stmt_bind_param(
        $stmt_edit,
        "i",
        $edit_id
    );

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

$total_halaman = max(
    1,
    (int)ceil($total_data / $per_halaman)
);

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

mysqli_stmt_bind_param(
    $stmt_data,
    "ii",
    $per_halaman,
    $offset
);

mysqli_stmt_execute($stmt_data);

$q = mysqli_stmt_get_result($stmt_data);
?>

<!-- FORM TAMBAH / EDIT GURU -->

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
                    oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,15)"
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

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    required
                    value="<?= e($data_edit['email'] ?? '') ?>"
                    placeholder="Masukkan email guru"
                >
            </div>

            <div class="col-md-6 mb-3">
                <label>
                    Password <?= $data_edit ? '(opsional)' : '' ?>
                </label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    <?= $data_edit ? '' : 'required' ?>
                    autocomplete="new-password"
                    placeholder="<?= $data_edit ? 'Kosongkan jika tidak diubah' : 'Masukkan password' ?>"
                >
            </div>

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

<!-- TABEL DATA GURU -->

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

    <!-- PAGINATION DI KANAN -->

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
