<?php /* Halaman laporan; dipanggil melalui dashboard.php */ ?>


<div class="dashboard-card">

    <h4>Laporan Pelanggaran</h4>

    <p>
        Berikut merupakan data pelanggaran siswa yang tersimpan
        dalam sistem.
    </p>

    <!-- TOMBOL CETAK DAN EXPORT -->
    <div class="d-flex flex-wrap gap-2 mb-3 no-print">

        <button type="button"
                class="btn btn-primary"
                onclick="window.print()">
            <i class="bi bi-printer"></i> Cetak Laporan
        </button>

        <a href="dashboard.php?page=laporan&export=csv"
           class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Export Excel/CSV
        </a>

    </div>

</div>

<div class="table-box" id="area-laporan">

    <h4 class="judul-cetak">Laporan Pelanggaran Siswa</h4>

    <div class="table-responsive">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Siswa</th>
                    <th>Kelas</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $no = 1;

            $q = mysqli_query($koneksi, "
                SELECT *
                FROM t_pelanggaran_siswa
                ORDER BY tanggal DESC, id DESC
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

            </tbody>

        </table>

    </div>

</div>

<style>
.judul-cetak {
    display: none;
}

@media print {
    body * {
        visibility: hidden;
    }

    #area-laporan,
    #area-laporan * {
        visibility: visible;
    }

    #area-laporan {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 10px;
    }

    #area-laporan .table-responsive {
        overflow: visible !important;
    }

    #area-laporan table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11px;
    }

    #area-laporan th,
    #area-laporan td {
        border: 1px solid black !important;
        color: black !important;
        padding: 6px;
    }

    .judul-cetak {
        display: block;
        text-align: center;
        margin-bottom: 20px;
    }

    .no-print,
    .sidebar,
    nav,
    header,
    footer {
        display: none !important;
    }

    @page {
        size: landscape;
        margin: 1cm;
    }
}
</style>
