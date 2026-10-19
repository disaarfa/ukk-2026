<?php /* Halaman dashboard; dipanggil melalui dashboard.php */ ?>


<!-- <h2 class="page-title">
    Dashboard
</h2> -->

<div class="dashboard-card">

    <h4>
        Selamat Datang
    </h4>

    <p class="mb-0">
        Halo,
        <strong><?= e($nama) ?></strong>.
        Kamu login sebagai
        <strong><?= e(ucfirst($role)) ?></strong>.
    </p>

</div>

<div class="row">

    <div class="col-md-3">

        <div class="dashboard-card card-siswa">

            <h6>Total Siswa</h6>

            <h2>
                <?= $jml_siswa ?>
            </h2>

        </div>

    </div>


    <div class="col-md-3">

        <div class="dashboard-card card-guru">

            <h6>Total Guru</h6>

            <h2>
                <?= $jml_guru ?>
            </h2>

        </div>

    </div>


    <div class="col-md-3">

        <div class="dashboard-card card-kelas">

            <h6>Total Kelas</h6>

            <h2>
                <?= $jml_kelas ?>
            </h2>

        </div>

    </div>


    <div class="col-md-3">

        <div class="dashboard-card card-pelanggaran">

            <h6>Total Pelanggaran</h6>

            <h2>
                <?= $jml_pelanggaran ?>
            </h2>

        </div>

    </div>

</div>
