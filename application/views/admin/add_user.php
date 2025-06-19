    <!-- Untuk Add User Admin-->
    <script type="text/javascript">
        function setForm(value) {

            //Role Mahasiswa
            if (value == '1') {
                const div = document.getElementById('form_add_user');
                if (div.innerHTML != '') {
                    div.innerHTML = ''
                }
                document.getElementById('form_add_user').innerHTML =
                    "<div>" +
                    "<div class='row pt-3'>" +
                    "<div class='form-group col'>" +
                    "<label for='nama_mahasiswa'>Nama Lengkap</label>" +
                    "<input type='text' class='form-control' id='nama_mahasiswa' name='nama_mahasiswa' value='<?= set_value('nama_mahasiswa'); ?>'>" +
                    "<?= form_error('nama_mahasiswa', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='nim'>NIM</label>" +
                    "<input type='text' class='form-control' id='nim' name='nim' value='<?= set_value('nim'); ?>'>" +
                    "<?= form_error('nim', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='ipk'>IPK</label>" +
                    "<input type='text' class='form-control' id='ipk' name='ipk' value='<?= set_value('ipk'); ?>'>" +
                    "<?= form_error('ipk', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +
                    "</div>" +


                    "<div class='row'>" +
                    "<div class='form-group col'>" +
                    "<label for='program_studi_mahasiswa'>Program Studi</label>" +
                    "<select class='form-control' id='program_studi_mahasiswa' name='program_studi_mahasiswa'>" +
                    "<option value=''>Pilih Program Studi</option>" +
                    "<?php foreach ($program_studi as $prodi) : ?>" +
                    "<option value='<?= $prodi['id_prodi']; ?>' <?= set_value('program_studi_mahasiswa') == $prodi['id_prodi'] ? 'selected' : ''; ?>><?= $prodi['nama_prodi']; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "<?= form_error('program_studi_mahasiswa', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='jenis_kelamin_mahasiswa'>Jenis Kelamin</label>" +
                    "<select class='form-control' id='jenis_kelamin_mahasiswa' name='jenis_kelamin_mahasiswa'>" +
                    "<option value=''>Pilih Jenis Kelamin</option>" +
                    "<option value='Laki - Laki' <?= set_value('jenis_kelamin_mahasiswa') == 'Laki - Laki' ? 'selected' : ''; ?>>Laki - Laki</option>" +
                    "<option value='Perempuan' <?= set_value('jenis_kelamin_mahasiswa') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>" +
                    "</select>" +
                    "<?= form_error('jenis_kelamin_mahasiswa', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for ='email_mahasiswa'>Email</label>" +
                    "<input type='email' class='form-control' id='email_mahasiswa' name='email_mahasiswa' value='<?= set_value('email_mahasiswa'); ?>'>" +
                    "<?= form_error('email_mahasiswa', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +
                    "</div>" +

                    "<div class='row'>" +
                    "<div class='form-group col-4'>" +
                    "<label for='password_mahasiswa'>Password</label>" +
                    "<input type='password' class='form-control' id='password_mahasiswa' name='password_mahasiswa' value='<?= set_value('password_mahasiswa'); ?>'>" +
                    "<?= form_error('password_mahasiswa', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='detail_program'>Detail Program Kampus Merdeka</label>" +
                    "<select class='form-control' id='detail_program' name='detail_program'>" +
                    "<option value=''>Pilih Detail Program</option>" +
                    "<?php foreach ($list_detailprogram as $detailprogram) : ?>" +
                    "<option value='<?= $detailprogram['id_detailprogram']; ?>' <?= set_value('detail_program') == $detailprogram['id_detailprogram'] ? 'selected' : ''; ?>><?= $detailprogram['nama_programkm'] . ' - ' . $detailprogram['nama_instansi'] . ' ' . '(' . $detailprogram['status_kegiatan'] . ')'; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "<?= form_error('detail_program', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +
                    "</div>" +

                    "</div>";
            }




            //Role Kaprodi
            else if (value == '4') {
                const div = document.getElementById('form_add_user');
                if (div.innerHTML != '') {
                    div.innerHTML = ''
                }
                document.getElementById('form_add_user').innerHTML =
                    "<div class='row pt-3'>" +

                    "<div class='form-group col'>" +
                    "<label for='nama_lengkap_kaprodi'>Nama Lengkap</label>" +
                    "<input type='text' class='form-control' id='nama_lengkap_kaprodi' name='nama_lengkap_kaprodi' value='<?= set_value('nama_lengkap_kaprodi'); ?>'>" +
                    "<?= form_error('nama_lengkap_kaprodi', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='nip_kaprodi'>NIP</label>" +
                    "<input type='text' class='form-control' id='nip_kaprodi' name='nip_kaprodi' value='<?= set_value('nip_kaprodi'); ?>'>" +
                    "<?= form_error('nip_kaprodi', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='program_studi_kaprodi'>Program Studi</label>" +
                    "<select class='form-control' id='program_studi_kaprodi' name='program_studi_kaprodi'>" +
                    "<option value=''>Pilih Program Studi</option>" +
                    "<?php foreach ($program_studi as $prodi) : ?>" +
                    "<option value='<?= $prodi['id_prodi']; ?>' <?= set_value('program_studi_kaprodi') == $prodi['id_prodi'] ? 'selected' : ''; ?>><?= $prodi['nama_prodi']; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "<?= form_error('program_studi_kaprodi', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "</div>" +

                    "<div class='row'>" +

                    "<div class='form-group col'>" +
                    "<label for='jenis_kelamin_kaprodi'>Jenis Kelamin</label>" +
                    "<select class='form-control' id='jenis_kelamin_kaprodi' name='jenis_kelamin_kaprodi'>" +
                    "<option value=''>Pilih Jenis Kelamin</option>" +
                    "<option value='Laki - Laki' <?= set_value('jenis_kelamin_kaprodi') == 'Laki - Laki' ? 'selected' : ''; ?>>Laki - Laki</option>" +
                    "<option value='Perempuan' <?= set_value('jenis_kelamin_kaprodi') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>" +
                    "</select>" +
                    "<?= form_error('jenis_kelamin_kaprodi', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='email_kaprodi'>Email</label>" +
                    "<input type='email' class='form-control' id='email_kaprodi' name='email_kaprodi' value='<?= set_value('email_kaprodi'); ?>'>" +
                    "<?= form_error('email_kaprodi', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='password_kaprodi'>Password</label>" +
                    "<input type='password' class='form-control' id='password_kaprodi' name='password_kaprodi' value='<?= set_value('password_kaprodi'); ?>'>" +
                    "<?= form_error('password_kaprodi', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "</div>";

            }

            //Role Mentor
            else if (value == '3') {
                const div = document.getElementById('form_add_user');
                if (div.innerHTML != '') {
                    div.innerHTML = ''
                }
                document.getElementById('form_add_user').innerHTML =
                    "<div class='row pt-3'>" +

                    "<div class='form-group col'>" +
                    "<label for='nama_lengkap_mentor'>Nama Lengkap</label>" +
                    "<input type='text' class='form-control' id='nama_lengkap_mentor' name='nama_lengkap_mentor' value='<?= set_value('nama_lengkap_mentor'); ?>'>" +
                    "<?= form_error('nama_lengkap_mentor', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='personal_number'>Personal Number</label>" +
                    "<input type='text' class='form-control' id='personal_number' name='personal_number' value='<?= set_value('personal_number'); ?>'>" +
                    "<?= form_error('personal_number', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='instansi'>Instansi</label>" +
                    "<select class='form-control' id='instansi' name='instansi'>" +
                    "<option value=''>Pilih Program Studi</option>" +
                    "<?php foreach ($instansi as $inst) : ?>" +
                    "<option value='<?= $inst['id_instansi']; ?>' <?= set_value('instansi') == $inst['id_instansi'] ? 'selected' : ''; ?>><?= $inst['nama_instansi']; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "<?= form_error('instansi', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "</div>" +

                    "<div class='row'>" +

                    "<div class='form-group col'>" +
                    "<label for='email_mentor'>Email</label>" +
                    "<input type='email' class='form-control' id='email_mentor' name='email_mentor' value='<?= set_value('email_mentor'); ?>'>" +
                    "<?= form_error('email_mentor', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='password_mentor'>Password</label>" +
                    "<input type='password' class='form-control' id='password_mentor' name='password_mentor' value='<?= set_value('password_mentor'); ?>'>" +
                    "<?= form_error('password_mentor', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='jenis_kelamin_mentor'>Jenis Kelamin</label>" +
                    "<select class='form-control' id='jenis_kelamin_mentor' name='jenis_kelamin_mentor'>" +
                    "<option value=''>Pilih Jenis Kelamin</option>" +
                    "<option value='Laki - Laki' <?= set_value('jenis_kelamin_mentor') == 'Laki - Laki' ? 'selected' : ''; ?>>Laki - Laki</option>" +
                    "<option value='Perempuan' <?= set_value('jenis_kelamin_mentor') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>" +
                    "</select>" +
                    "<?= form_error('jenis_kelamin_mentor', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "</div>";
            }

            //Role Dospem
            else if (value == '5') {
                const div = document.getElementById('form_add_user');
                if (div.innerHTML != '') {
                    div.innerHTML = ''
                }
                document.getElementById('form_add_user').innerHTML =
                    "<div class='row pt-3'>" +

                    "<div class='form-group col'>" +
                    "<label for='nama_lengkap_dospem'>Nama Lengkap</label>" +
                    "<input type='text' class='form-control' id='nama_lengkap_dospem' name='nama_lengkap_dospem' value='<?= set_value('nama_lengkap_dospem'); ?>'>" +
                    "<?= form_error('nama_lengkap_dospem', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='nip_dospem'>NIP</label>" +
                    "<input type='text' class='form-control' id='nip_dospem' name='nip_dospem' value='<?= set_value('nip_dospem'); ?>'>" +
                    "<?= form_error('nip_dospem', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='program_studi_dospem'>Program Studi</label>" +
                    "<select class='form-control' id='program_studi_dospem' name='program_studi_dospem'>" +
                    "<option value=''>Pilih Program Studi</option>" +
                    "<?php foreach ($program_studi as $prodi) : ?>" +
                    "<option value='<?= $prodi['id_prodi']; ?>' <?= set_value('program_studi_dospem') == $prodi['id_prodi'] ? 'selected' : ''; ?>><?= $prodi['nama_prodi']; ?></option>" +
                    "<?php endforeach; ?>" +
                    "</select>" +
                    "<?= form_error('program_studi_dospem', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "</div>" +

                    "<div class='row'>" +

                    "<div class='form-group col'>" +
                    "<label for='jenis_kelamin_dospem'>Jenis Kelamin</label>" +
                    "<select class='form-control' id='jenis_kelamin_dospem' name='jenis_kelamin_dospem'>" +
                    "<option>Pilih Jenis Kelamin</option>" +
                    "<option value='Laki - Laki' <?= set_value('jenis_kelamin_dospem') == 'Laki - Laki' ? 'selected' : ''; ?>>Laki - Laki</option>" +
                    "<option value='Perempuan' <?= set_value('jenis_kelamin_dospem') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>" +
                    "</select>" +
                    "<?= form_error('jenis_kelamin_dospem', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='email_dospem'>Email</label>" +
                    "<input type='email' class='form-control' id='email_dospem' name='email_dospem' value='<?= set_value('email_dospem'); ?>'>" +
                    "<?= form_error('email_dospem', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "<div class='form-group col'>" +
                    "<label for='password_dospem'>Password</label>" +
                    "<input type='password' class='form-control' id='password_dospem' name='password_dospem' value='<?= set_value('password_dospem'); ?>'>" +
                    "<?= form_error('password_dospem', '<small class=\"text-danger pl-3\">', '</small>'); ?>" +
                    "</div>" +

                    "</div>";
            }

            //else tanda kosong
            else {
                const div = document.getElementById('form_add_user');
                if (div.innerHTML != '') {
                    div.innerHTML = ''
                }
            }
        };
        // Memastikan fungsi dijalankan ketika halaman selesai dimuat
        document.addEventListener("DOMContentLoaded", function() {
            // Misalnya, atur default tampilan ketika halaman selesai dimuat
            setForm(document.getElementById('select1').value);
        });
    </script>


    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>

        <!-- Card Identifikasi Setiap Halaman Pada Header -->
        <div class="card shadow mb-4">
            <div class="card-body pb-2 pt-3">
                <h5 class="font-weight-bold text-dark">Add User</h5>
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
                    Add User on this page
                </p>
            </div>
        </div>

        <div class="card shadow mb-4 pb-4">
            <div class="card-body pb-2 pt-4">
                <h6 class="font-weight-bold text-primary">Add User</h6>
                <br>
            </div>

            <form class="col" method="post" action="<?= base_url('admin/add_user'); ?>" style="padding-left: 21px; margin-left: -35px;">
                <div class="container mb-3 font-weight-bold text-dark">
                    <div class="row">
                        <div class="form-group col-3">
                            <label>Select Role</label>
                            <select id="select1" name="role" onchange="setForm(this.value)" class="col-12" style="height: 40px;">
                                <option>Select Role</option>
                                <option value='1' <?= set_value('role') == "1" ? 'selected' : ''; ?>>Mahasiswa</option>
                                <option value='4' <?= set_value('role') == "4" ? 'selected' : ''; ?>>Kaprodi</option>
                                <option value='3' <?= set_value('role') == "3" ? 'selected' : ''; ?>>Mentor</option>
                                <option value='5' <?= set_value('role') == "5" ? 'selected' : ''; ?>>Dosen Pembimbing</option>
                            </select>
                        </div>
                    </div>
                    <div id="form_add_user">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-4" style="margin: auto; display: block;">Simpan</button>
            </form>
        </div>
    </div>
    </div>