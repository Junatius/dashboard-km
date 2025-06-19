<div class="container-fluid">
    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Edit Profil Mentor</h5>
        </div>
    </div>

    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="row">
        <div class="col">
            <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
            <div style="display: inline-block;">
                <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Hi, <?= $profil['username']; ?></h6>
            </div>
            <p style="padding-left: 40px; margin-top: -6px;">
                Change information about mentor on this page
            </p>
        </div>
    </div>


    <!-- Edit Account Details -->
    <div class="card shadow mb-4 pb-2">
        <div class="card-body pb-2 pt-4">
            <h6 class="font-weight-bold text-primary">Data Diri</h6>
            <br>
        </div>

        <?= form_open_multipart('admin/monprofil_mentor/editprofil_mentor/' . $informasi_mentor['id_mentor']); ?>
        <form action="<?= base_url('admin/monprofil_mentor/editprofil_mentor/' . $informasi_mentor['id_mentor']); ?>" method="POST" class="col" style="padding-left: 21px; margin-left: -35px;">
            <div class="container mb-3 font-weight-bold text-dark">
                <div class="row">
                    <div class="form-group col-4">
                        <label>Foto Profil</label>
                        <div class="custom-file">
                            <div>
                                <input type="file" class="custom-file-input"
                                    id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap"
                            name="nama_lengkap" value="<?= $informasi_mentor['nama_mentor']; ?>">
                        <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="nama_role">Role</label>
                        <select class="form-control" id="nama_role" name="nama_role">
                            <option value=""></option>
                            <?php foreach ($list_role as $role) : ?>
                                <option value="<?= $role['id_role']; ?>"
                                    <?= ($informasi_mentor['role_id_role'] == $role['id_role']) ? 'selected' : ''; ?>>
                                    <?= $role['nama_role']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('nama_role', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="personal_number">Personal Number</label>
                        <input type="text" class="form-control" id="personal_number"
                            name="personal_number" value="<?= $informasi_mentor['personal_number']; ?>">
                    </div>

                    <div class="form-group col-4">
                        <label for="nama_instansi">Instansi/Mitra</label>
                        <select class="form-control" id="nama_instansi" name="nama_instansi">
                            <option value=""></option>
                            <?php foreach ($list_instansi as $instansi) : ?>
                                <option value="<?= $instansi['id_instansi']; ?>"
                                    <?= ($informasi_mentor['instansi_id_instansi'] == $instansi['id_instansi']) ? 'selected' : ''; ?>>
                                    <?= $instansi['nama_instansi']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('nama_instansi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email"
                            name="email" value="<?= $informasi_mentor['email']; ?>">
                    </div>

                    <div class="form-group col-4">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control" id="no_hp"
                            name="no_hp" value="<?= $informasi_mentor['no_hp']; ?>">
                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="Laki - Laki" <?= (isset($informasi_mentor['jenis_kelamin']) && $informasi_mentor['jenis_kelamin'] == "Laki - Laki") ? "selected" : ""; ?>>Laki - Laki</option>
                            <option value="Perempuan" <?= (isset($informasi_mentor['jenis_kelamin']) && $informasi_mentor['jenis_kelamin'] == "Perempuan") ? "selected" : ""; ?>>Perempuan</option>
                        </select>
                        <?= form_error("jenis_kelamin", "<small class=\"text-danger pl-3\">", "</small>"); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm mt-4" style="margin: auto; display: block;">Simpan</button>
            </div>
        </form>
    </div>
</div>