<div class="container-fluid">
    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Beranda</h5>
        </div>
    </div>

    <!-- Greetings-->
    <div class="mb-4">
        <div style="margin-left: 4px">
            <h5><span>Hai,</span>
                <span class="font-weight-bold text-dark"><?= $profil['nama_mahasiswa']; ?> !</span>
                <br>
                <span>Selamat datang di</span>
                <span class="font-weight-bold text-dark">Portal Kampus Merdeka</span>
            </h5>
        </div>
    </div>



    <!-- Content Row -->
    <!-- Card Bagian Identitas -->
    <div class="row">
        <div class="col-6">
            <div class="card mb-4 py-0 border-left-primary">
                <div class="card-body">
                    <span>Nama Lengkap: <span class="font-weight-bold text-dark"> <?= $profil['nama_mahasiswa']; ?></span></span>
                    <br>
                    <span>NIM: <span class="font-weight-bold text-dark"><?= $profil['nim']; ?></span></span>
                    <br>
                    <span>IPK: <span class="font-weight-bold text-dark"><?= $profil['ipk']; ?></span></span>
                    <br>
                    <span>Program Studi: <span class="font-weight-bold text-dark"><?= $programstudi['nama_prodi']; ?></span></span>
                    <br>
                    <span>Dosen Pembimbing: <span class="font-weight-bold text-dark"><?= $dospem['nama_dospem']; ?></span></span>
                </div>
            </div>
        </div>
        <!-- Card Bagian Instansi -->
        <div class="col-6">
            <div class="card mb-4 py-0 border-left-primary">
                <div class="card-body">
                    <span>Nama Program: <span class="font-weight-bold text-dark"><?= $programkm['nama_programkm']; ?></span></span>
                    <br>
                    <span>Nama Instansi: <span class="font-weight-bold text-dark"><?= $instansi['nama_instansi']; ?></span></span>
                    <br>
                    <span>Mentor Instansi: <span class="font-weight-bold text-dark"><?= $mentor['nama_mentor']; ?></span></span>
                    <br>
                    <span>Status Kegiatan: <span class="font-weight-bold text-dark"><?= $detailprogram['status_kegiatan']; ?></span></span>
                </div>
            </div>
        </div>

        <!-- Sertifikat -->

        <div class="col-12">
            <div>
                <?php if (isset($detailprogram['status_kegiatan']) && $detailprogram['status_kegiatan'] === "Selesai") {
                    echo "<div>
                Terima kasih telah berpartisipasi! Klik tombol di bawah ini untuk mengunduh sertifikat Anda:
                <br>
                <a href='" ?><?= isset($sertifikat['file']) && $sertifikat['file'] ? base_url('assets/template/file/sertifikat/') . $sertifikat['file'] : '#'; ?><?php echo "' class='btn btn-success'" ?> <?= isset($sertifikat['file']) && $sertifikat['file'] ? '' : 'disabled'; ?><?php echo ">Download Sertifikat</a>" ?>
                <?= isset($sertifikat['file']) && $sertifikat['file'] ? '' : '<p> Note : Sertifikat Belum Diupload Oleh Mentor</p>'; ?>
            <?php echo "
            </div>";
                } ?>
            </div>
        </div>

    </div>
</div>