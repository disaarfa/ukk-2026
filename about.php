<?php /* Halaman about; dipanggil melalui dashboard.php */ ?>

<style>
    .about-box {
        background: #ffffff;
        padding: 26px;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
        color: inherit;
    }

    .about-box .about-header {
        background: #d9e9ff;
        padding: 22px;
        border-radius: 10px;
        margin-bottom: 24px;
    }

    .about-box .about-header h3 {
        margin: 0 0 6px;
    }

    .about-box .about-header p {
        margin: 0;
    }

    .about-box .about-profile {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 8px 0 22px;
        flex-wrap: wrap;
    }

    .about-box .about-avatar {
        width: 95px;
        height: 95px;
        min-width: 95px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #d9e9ff;
        color: #244f83;
        border: 2px solid #bdd9ff;
        border-radius: 22px;
        font-size: 34px;
        font-weight: bold;
    }

    .about-box .about-profile h4 {
        margin-bottom: 8px;
        font-weight: 700;
    }

    .about-box .about-profile p {
        margin-bottom: 6px;
    }

    .about-box .about-section-title {
        font-weight: 700;
        margin: 22px 0 15px;
    }

    .about-box .about-intro {
        line-height: 1.9;
    }

    .about-box .about-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }

    .about-box .about-info-card {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 17px;
        border: 1px solid #e4eaf2;
        border-radius: 12px;
        transition: 0.2s ease;
        min-width: 0;
    }

    .about-box .about-info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 14px rgba(0, 0, 0, 0.08);
    }

    .about-box .about-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #edf4ff;
        border-radius: 12px;
        font-size: 21px;
    }

    .about-box .about-info-label {
        color: #6c757d;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .about-box .about-info-value {
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .about-box .about-hobby-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 15px;
    }

    .about-box .about-hobby-card {
        background: #edf4ff;
        padding: 22px 12px;
        border-radius: 12px;
        text-align: center;
        transition: 0.2s ease;
    }

    .about-box .about-hobby-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 5px 14px rgba(0, 0, 0, 0.08);
    }

    .about-box .about-hobby-icon {
        font-size: 30px;
        margin-bottom: 10px;
    }

    .about-box .about-hobby-card h6 {
        margin: 0;
        font-weight: 600;
    }

    .about-box .about-quote {
        margin-top: 25px;
        padding: 22px;
        background: #f0f5fc;
        border-left: 5px solid #8bbcff;
        border-radius: 10px;
    }

    .about-box .about-quote p {
        font-style: italic;
        line-height: 1.8;
        margin-bottom: 10px;
    }

    .about-box .about-quote small {
        display: block;
        text-align: right;
        color: #6685ad;
    }

    @media (max-width: 576px) {
        .about-box {
            padding: 16px;
        }

        .about-box .about-info-grid {
            grid-template-columns: 1fr;
        }

        .about-box .about-hobby-grid {
            grid-template-columns: 1fr;
        }

        .about-box .about-header {
            padding: 17px;
        }
    }
</style>

<div class="about-box">

    <!-- HEADER -->
    <div class="about-header">
        <h3>About Me</h3>
        <p>Sistem Informasi Pelanggaran Siswa</p>
    </div>

    <!-- PROFIL -->
    <div class="about-profile">

       <img src="foto.afa.png" alt="Foto Profil" class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover;">

        <div>
            <h4>Arfa Disa Okamaleliza</h4>

            <p>
                <span class="badge"
                    style="background:#8bbcff;color:#173d70;">
                    Siswi XII RPL 2
                </span>
            </p>

            <p>Rekayasa Perangkat Lunak</p>
        </div>

    </div>

    <hr>

    <!-- TENTANG SAYA -->
    <h5 class="about-section-title">Tentang Saya</h5>

    <p class="about-intro">
        Halo, aku arfa boleh di panggil afaa biar ga kaya cowo
    </p>

      <p>
       Setiap baris kode adalah proses belajar, setiap fitur adalah hasil dari usaha, dan setiap kesalahan adalah kesempatan untuk berkembang.
       Sistem Informasi Pelanggaran Siswa ini merupakan salah satu karya yang saya kembangkan sebagai bentuk penerapan ilmu Rekayasa Perangkat Lunak. 
       Bukan hanya tentang membuat sebuah website, tetapi juga tentang menciptakan solusi digital yang bermanfaat, terstruktur, 
       dan memudahkan pekerjaan di lingkungan sekolah.
       Belajar, Berkarya, dan Terus Berkembang.
    </p>

    <!-- INFORMASI PRIBADI -->
    <h5 class="about-section-title">Informasi Pribadi</h5>

    <div class="about-info-grid">

        <div class="about-info-card">
            <div>
                <div class="about-info-label">
                    Tempat, Tanggal Lahir
                </div>
                <div class="about-info-value">
                    Tasikmalaya, 09 Oktober 2008
                </div>
            </div>
        </div>

        <div class="about-info-card">
            <div>
                <div class="about-info-label">Alamat</div>
                <div class="about-info-value">
                    Jln. Cieunteung Gede
                </div>
            </div>
        </div>

        <div class="about-info-card">
            <div>
                <div class="about-info-label">Sekolah</div>
                <div class="about-info-value">
                    SMK Muhammadiyah Tasikmalaya
                </div>
            </div>
        </div>

        <div class="about-info-card">
            <div>
                <div class="about-info-label">Kelas / Jurusan</div>
                <div class="about-info-value">
                    XII RPL 2, Rekayasa Perangkat Lunak
                </div>
            </div>
        </div>

    </div>

    <!-- HOBI -->
    <h5 class="about-section-title">Hobi Aku</h5>

    <div class="about-hobby-grid">

        <div class="about-hobby-card">
            <h6>Tidur Kadang Ketiduran</h6>
        </div>

        <div class="about-hobby-card">
            <h6>Bernyanyi Walau Suara Berserakan</h6>
        </div>

        <div class="about-hobby-card">
            <h6>Scrolling Sosmed / Membaca Novel</h6>
        </div>

    </div>

    <!-- KUTIPAN -->
    <div class="about-quote">
        <p>
            “Pelan-pelan bertumbuh, terus belajar,
            dan tetap jadi diri sendiri.” 
        </p>

        <small>— Afaaa</small>
    </div>

</div>
