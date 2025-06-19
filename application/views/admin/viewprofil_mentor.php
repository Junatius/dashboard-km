<div class="container-fluid">
    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Profil Mentor</h5>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Content Row -->
    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="mb-2">
        <div class="row">
            <div class="col">
                <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
                <div style="display: inline-block;">
                    <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Hi, <?= $profil['username']; ?></h6>
                </div>
                <p style="padding-left: 40px; margin-top: -6px;">
                    information about mentor on this page
                </p>
            </div>
        </div>
    </div>

    <!-- Isi Konten Foto Profile -->
    <div class="row">
        <div class="col-5" style="margin: auto;">
            <div class="card shadow mb-4 pb-2">
                <div class="card-header pb-0">
                    <h6 class="font-weight-bold" style="color: #2a2a2a;">Profil Picture</h6>
                </div>
                <div class=" card-body" style="display: inline-block;">
                    <?php if (!empty($informasi_mentor['foto_mentor']) && file_exists(FCPATH . 'assets/template/img/profil/' . $informasi_mentor['foto_mentor'])) : ?>
                        <img src="<?= base_url('assets/template/img/profil/') . $informasi_mentor['foto_mentor']; ?>"
                            alt="Foto Mahasiswa"
                            style="width: auto; height: 170px; border-radius: 50%; margin: auto; display: block;">
                    <?php else : ?>
                        <img src="<?= base_url('assets/template/img/profil/default.jpg'); ?>"
                            style="width: auto; height: 170px; border-radius: 50%; margin: auto; display: block;">
                    <?php endif; ?>
                </div>
                <div class="text-center">
                    <h6 class="font-weight-bold text-dark"><?= $informasi_mentor['nama_mentor']; ?></h6>
                    <h6 class="font-weight-bold"><?= $informasi_mentor['personal_number']; ?></h6>
                    <h6><?= $informasi_mentor['alamat_instansi']; ?></h6>
                </div>
            </div>
        </div>

        <!-- Isi Konten Profil Bagian Details Account-->
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold" style="color: #2a2a2a;">Account Details</h6>
                    <br>
                    <div class="row">
                        <div class="col-5">
                            <span>Nama Lengkap </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mentor['nama_mentor']; ?></p>
                            <span>Personal Number </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mentor['personal_number']; ?></p>
                            <span>Role</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mentor['nama_role']; ?></p>
                            <span>Jenis Kelamin</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mentor['jenis_kelamin']; ?></p>
                        </div>
                        <div>
                            <span>Nama Instansi </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mentor['nama_instansi']; ?></p>
                            <span>Alamat Instansi </span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mentor['alamat_instansi']; ?></p>
                            <span>Email</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mentor['email']; ?></p>
                            <span>No. Hp</span>
                            <p class="font-weight-bold text-secondary"><?= $informasi_mentor['no_hp']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>