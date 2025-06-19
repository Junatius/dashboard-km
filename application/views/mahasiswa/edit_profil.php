<div class="container-fluid">
    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Edit Profil</h5>
        </div>
    </div>

    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="row">
        <div class="col">
            <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
            <div style="display: inline-block;">
                <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Edit Profile</h6>
            </div>
            <p style="padding-left: 40px; margin-top: -6px;">
                Change information about yourself on this page
            </p>
        </div>
    </div>


    <!-- Edit Account Details -->
    <div class="card shadow mb-4 pb-2">


        <?= form_open_multipart('mahasiswa/profil/edit_profil'); ?>
        <form class="col" style="padding-left: 21px; margin-left: -35px;">
            <div class="card-body pb-2 pt-4">
                <h6 class="font-weight-bold text-primary">Account Details</h6>
                <br>
            </div>
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
                            name="nama_lengkap" value="<?= $profil['nama_mahasiswa']; ?>">
                        <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" id="role"
                            name="role" value="<?= $role['nama_role']; ?>" readonly>
                        <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim"
                            name="nim" value="<?= $profil['nim']; ?>" readonly>
                        <?= form_error('nim', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="programstudi">Program Studi</label>
                        <input type="text" class="form-control" id="programstudi"
                            name="programstudi" value="<?= $programstudi['nama_prodi']; ?>" readonly>
                        <?= form_error('programstudi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="ipk">IPK</label>
                        <input type="text" class="form-control" id="ipk"
                            name="ipk" value="<?= $profil['ipk']; ?>" readonly>
                        <?= form_error('ipk', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email"
                            name="email" value="<?= $user['email']; ?>" readonly>
                    </div>


                    <div class="form-group col-4">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control" id="no_hp"
                            name="no_hp" value="<?= $profil['no_hp']; ?>">
                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="Laki - Laki" <?= (isset($profil['jenis_kelamin']) && $profil['jenis_kelamin'] == "Laki - Laki") ? "selected" : ""; ?>>Laki - Laki</option>
                            <option value="Perempuan" <?= (isset($profil['jenis_kelamin']) && $profil['jenis_kelamin'] == "Perempuan") ? "selected" : ""; ?>>Perempuan</option>
                        </select>
                        <?= form_error("jenis_kelamin", "<small class=\"text-danger pl-3\">", "</small>"); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="nama_program">Nama Program</label>
                        <input type="text" class="form-control" id="nama_program"
                            name="nama_program" value="<?= $programkm['nama_programkm']; ?>" readonly>
                        <?= form_error('nama_program', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="nama_instansi">Nama Instansi</label>
                        <input type="text" class="form-control" id="nama_instansi"
                            name="nama_instansi" value="<?= $instansi['nama_instansi']; ?>" readonly>
                        <?= form_error('nama_instansi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="alamat_instansi">Alamat Instansi</label>
                        <input type="text" class="form-control" id="alamat_instansi"
                            name="alamat_instansi" value="<?= $instansi['alamat_instansi']; ?>" readonly>
                        <?= form_error('alamat_instansi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="status_kegiatan">Status Kegiatan</label>
                        <input type="text" class="form-control" id="status_kegiatan"
                            name="status_kegiatan" value="<?= $detailprogram['status_kegiatan']; ?>" readonly>
                        <?= form_error('status_kegiatan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="nama_mentor">Mentor Instansi</label>
                        <input type="text" class="form-control" id="nama_mentor"
                            name="nama_mentor" value="<?= $mentor['nama_mentor']; ?>" readonly>
                        <?= form_error('nama_mentor', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-4">
                        <label for="nama_dospem">Dosen Pembimbing</label>
                        <input type="text" class="form-control" id="nama_dospem"
                            name="nama_dospem" value="<?= $dospem['nama_dospem']; ?>" readonly>
                        <?= form_error('nama_dospem', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm mt-4" style="margin: auto; display: block;">Simpan</button>
            </div>
        </form>
    </div>
</div>