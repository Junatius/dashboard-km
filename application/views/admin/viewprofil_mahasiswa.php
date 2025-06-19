<div class="container-fluid">
    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">View Profil Mahasiswa <?= $informasi_mahasiswa['nama_mahasiswa']; ?></h5>
        </div>
    </div>

    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="mb-2">
        <div class="row">
            <div class="col">
                <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
                <div style="display: inline-block;">
                    <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Hi, <?= $profil['username']; ?></h6>
                </div>
                <p style="padding-left: 40px; margin-top: -6px;">
                    information about student on this page
                </p>
            </div>
        </div>
    </div>

    <!-- Isi Konten Profile -->
    <div class="row">
        <div class="col-5" style="margin: auto;">
            <div class="card shadow mb-4 pb-2">
                <div class="card-header pb-0">
                    <h6 class="font-weight-bold" style="color: #2a2a2a;">Profil Picture</h6>
                </div>
                <div class="card-body" style="display: inline-block;">
                    <?php if (!empty($informasi_mahasiswa['foto_mahasiswa']) && file_exists(FCPATH . 'assets/template/img/profil/' . $informasi_mahasiswa['foto_mahasiswa'])) : ?>
                        <img src="<?= base_url('assets/template/img/profil/') . $informasi_mahasiswa['foto_mahasiswa']; ?>"
                            alt="Foto Mahasiswa"
                            style="width: auto; height: 170px; border-radius: 50%; margin: auto; display: block;">
                    <?php else : ?>
                        <img src="<?= base_url('assets/template/img/profil/default.jpg'); ?>"
                            style="width: auto; height: 170px; border-radius: 50%; margin: auto; display: block;">
                    <?php endif; ?>
                </div>

                <div class="text-center">
                    <h6 class="font-weight-bold text-dark"><?= $informasi_mahasiswa['nama_mahasiswa']; ?></h6>
                    <h6 class="font-weight-bold"><?= $informasi_mahasiswa['nama_prodi']; ?></h6>
                    <h6><?= $informasi_mahasiswa['nama_programkm']; ?></h6>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold" style="color: #2a2a2a;">Account Details</h6>
                    <br>
                    <div class="row">
                        <div class="col-5">
                            <span>Nama Lengkap </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['nama_mahasiswa']; ?></p>
                            <span>NIM </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['nim']; ?></p>
                            <span>IPK </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['ipk']; ?></p>
                            <span>Program Studi</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['nama_prodi']; ?></p>
                            <span>Dosen Pembimbing</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['nama_dospem']; ?></p>
                        </div>
                        <div>
                            <span>Role </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['nama_role']; ?></p>
                            <span>Jenis Kelamin</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['jenis_kelamin']; ?></p>
                            <span>Email</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['email']; ?></p>
                            <span>No. Hp Mahasiswa</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['no_hp_mahasiswa']; ?></p>
                            <span>No Hp Dosen Pembimbing</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['no_hp_dospem']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold" style="color: #2a2a2a;">Instansi dan Program</h6>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <span>Nama Program </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['nama_programkm']; ?></p>
                            <span>Nama Instansi </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['nama_instansi']; ?></p>
                            <span>Alamat Instansi </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['alamat_instansi']; ?></p>
                        </div>
                        <div>
                            <span>Status Kegiatan </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['status_kegiatan']; ?></p>
                            <span>Mentor Instansi</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mahasiswa['nama_mentor']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>