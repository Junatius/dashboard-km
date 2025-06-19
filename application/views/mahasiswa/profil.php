<div class="container-fluid">

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Profil Mahasiswa</h5>
        </div>
    </div>

    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="mb-2">
        <div class="row">
            <div class="col">
                <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
                <div style="display: inline-block;">
                    <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Hi, <?= $profil['nama_mahasiswa']; ?></h6>
                </div>
                <p style="padding-left: 40px; margin-top: -6px;">
                    information about yourself on this page
                </p>
            </div>

            <!-- Button Edit Profile -->
            <div class="col">
                <div style="margin-top: 12px">
                    <div class="mb">
                        <a href="<?= base_url("mahasiswa/profil/edit_profil") ?>" style="float: right; color: #4469d7;" class="btn  border border-primary font-weight-bold btn-sm"><i class="bi bi-pencil-square "></i> Edit Profile</a><br></br>
                    </div>
                </div>
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
                <div class=" card-body" style="display: inline-block;">
                    <?php if (!empty($profil['foto']) && file_exists(FCPATH . 'assets/template/img/profil/' . $profil['foto'])) : ?>
                        <img src="<?= base_url('assets/template/img/profil/') . $profil['foto']; ?>"
                            alt="Foto Mahasiswa"
                            style="width: auto; height: 170px; border-radius: 50%; margin: auto; display: block;">
                    <?php else : ?>
                        <img src="<?= base_url('assets/template/img/profil/default.jpg'); ?>"
                            style="width: auto; height: 170px; border-radius: 50%; margin: auto; display: block;">
                    <?php endif; ?>
                </div>
                <div class="text-center">
                    <h6 class="font-weight-bold text-dark"><?= $profil['nama_mahasiswa']; ?></h6>
                    <h6 class="font-weight-bold"><?= $programstudi['nama_prodi']; ?></h6>
                    <h6><?= $programkm['nama_programkm']; ?></h6>
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
                            <p class="font-weight-bold text-secondary"><?= $profil['nama_mahasiswa']; ?></p>
                            <span>NIM </span>
                            <p class="font-weight-bold text-secondary"><?= $profil['nim']; ?></p>
                            <span>IPK </span>
                            <p class="font-weight-bold text-secondary"><?= $profil['ipk']; ?></p>
                            <span>Program Studi</span>
                            <p class="font-weight-bold text-secondary"><?= $programstudi['nama_prodi']; ?></p>
                        </div>
                        <div>
                            <span>Role </span>
                            <p class="font-weight-bold text-secondary"><?= $role['nama_role']; ?></p>
                            <span>Jenis Kelamin</span>
                            <p class="font-weight-bold text-secondary"><?= $profil['jenis_kelamin']; ?></p>
                            <span>Email</span>
                            <p class="font-weight-bold text-secondary"><?= $user['email']; ?></p>
                            <span>No. Hp</span>
                            <p class="font-weight-bold text-secondary"><?= $profil['no_hp']; ?></p>
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
                            <p class="font-weight-bold text-secondary"><?= $programkm['nama_programkm']; ?></p>
                            <span>Nama Instansi </span>
                            <p class="font-weight-bold text-secondary"><?= $instansi['nama_instansi']; ?></p>
                            <span>Alamat Instansi </span>
                            <p class="font-weight-bold text-secondary"><?= $instansi['alamat_instansi']; ?></p>
                        </div>
                        <div>
                            <span>Status Kegiatan </span>
                            <p class="font-weight-bold text-secondary"><?= $detailprogram['status_kegiatan']; ?></p>
                            <span>Mentor Instansi</span>
                            <p class="font-weight-bold text-secondary"><?= $mentor['nama_mentor']; ?></p>
                            <span>Dosen Pembimbing</span>
                            <p class="font-weight-bold text-secondary"><?= $dospem['nama_dospem']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>