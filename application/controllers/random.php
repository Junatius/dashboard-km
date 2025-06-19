<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Beranda extends CI_Controller
{
    public function index()
    {
        //ambil ambil data user
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        //untuk mengambil data user untuk semua data dalam mahasiswa
        $data['profil'] = $this->db->get_where('mahasiswa', ['user_id_user' => $data['user']['id_user']])->row_array();
        var_dump($data['profil']);
        $data['programstudi'] = $this->db->get_where('program_studi', ['id_prodi' => $data['profil']['program_studi_id_prodi']])->row_array();
        var_dump($data['programstudi']);
        $data['statuskegiatan'] = $this->db->get_where('status_kegiatan', ['id_kegiatankm' => $data['profil']['status_kegiatan_id_kegiatankm']])->row_array();
        var_dump($data['statuskegiatan']);
        $data['programkm'] = $this->db->get_where('program_km', ['id_programkm' => $data['profil']['program_km_id_programkm']])->row_array();
        var_dump($data['programkm']);
        $data['instansi'] = $this->db->get_where('instansi', ['id_instansi' => $data['programkm']['instansi_id_instansi']])->row_array();
        var_dump($data['instansi']);

        $data['title'] = 'Beranda';
        $this->load->view('templates_mahasiswa/header', $data);
        $this->load->view('templates_mahasiswa/sidebar');
        $this->load->view('mahasiswa/beranda', $data);
        $this->load->view('templates_mahasiswa/footer');
    }
}



<!-- Untuk Add User Admin-->
<script type="text/javascript">
    function setForm(value) {


        if (value == 'Mahasiswa') {

            document.getElementById('form_add_user').innerHTML =
                "<div>" +
                "<div class='row pt-3'>" +
                "<div class='form-group col'>" +
                "<label for='nama_lengkap_mahasiswa'>Nama Lengkap</label>" +
                "<input type='text' class='form-control' id='nama_lengkap' name='nama_lengkap' value='<?= set_value('nama_lengkap'); ?>'>" +
                "<?= form_error('nama_lengkap', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                "</div>" +

                "<div class='form-group col'>" +
                "<label for='nim'>NIM</label>" +
                "<input type='text' class='form-control' id='nim' name='nim' value='<?= set_value('nim'); ?>'>" +
                "<?= form_error('nim', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                "</div>" +

                "<div class='form-group col'>" +
                "<label for='password'>Password</label>" +
                "<input type='text' class='form-control' id='password' name='password' value='<?= set_value('password'); ?>'>" +
                "<?= form_error('password', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<div class='form-group col'>" +
                "<label for='ipk'>IPK</label>" +
                "<input type='text' class='form-control' id='ipk' name='ipk' value='<?= set_value('ipk'); ?>'>" +
                "<?= form_error('ipk', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                "</div>" +

                "<div class='form-group col'>" +
                "<label for='program_studi'>Program Studi</label>" +
                "<select class='form-control' id='program_studi' name='program_studi'>" +
                "<option></option>" +
                "<option value='Teknik Informatika'>Teknik Informatika</option>" +
                "<option value='Teknik Elektro'>Teknik Elektro</option>" +
                "<option value='Teknik Sipil'>Teknik Sipil</option>" +
                "<option value='Teknik Lingkungan'>Teknik Lingkungan</option>" +
                "<option value='Teknik Arsitektur'>Teknik Arsitektur</option>" +
                "<option value='Teknik Mesin'>Teknik Mesin</option>" +
                "<option value='Teknik Perencanaan dan Kota'>Teknik Perencanaan dan Kota</option>" +
                "</select>" +
                "<?= form_error('program_studi', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                "</div>" +

                "<div class='form-group col'>" +
                "<label for='jenis_kelamin'>Jenis Kelamin</label>" +
                "<select class='form-control' id='jenis_kelamin' name='jenis_kelamin'>" +
                "<option></option>" +
                "<option value='Laki - Laki'>Laki - Laki</option>" +
                "<option value='Perempuan'>Perempuan</option>" +
                "</select>" +
                "<?= form_error('jenis_kelamin', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<div class='form-group col'>" +
                "<label for='email'>Email</label>" +
                "<input type='text' class='form-control' id='email' name='email' value='<?= set_value('email'); ?>'>" +
                "<?= form_error('email', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                "</div>" +

                "<div class='form-group col'>" +
                "<label for='no_hp'>No. HP</label>" +
                "<input type='text' class='form-control' id='no_hp' name='no_hp' value='<?= set_value('no_hp'); ?>'>" +
                "<?= form_error('no_hp', '<small class=\'text-danger pl-3\'>', '</small>'); ?>" +
                "</div>" +

                "<div class='form-group col'>" +
                "<label for='nama_program'>Nama Program</label>" +
                "<select id='nama_program' name='nama_program' class='form-control'>" +
                "<option></option>" +
                "<option value='Studi Independen'>Studi Independen</option>" +
                "<option value='Magang Bersertifikat'>Magang Bersertifikat</option>" +
                "<option value='Indonesian International Student Mobility Awards'>Indonesian International Student Mobility Awards</option>" +
                "<option value='Kampus Mengajar'>Kampus Mengajar</option>" +
                "<option value='Membangun Desa'>Membangun Desa</option>" +
                "<option value='Proyek Kemanusiaan'>Proyek Kemanusiaan</option>" +
                "<option value='Riset dan Penelitian'>Riset dan Penelitian</option>" +
                "<option value='Kewirausahaan'>Kewirausahaan</option>" +
                "<option value='Pertukaran Pelajar'>Pertukaran Pelajar</option>" +
                "</select>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<div class='form-group col'>" +
                "<label for='nama_instansi'>Nama Instansi</label>" +
                "<input type='text' class='form-control' id='nama_instansi' name='nama_instansi'>" +
                "</div>" +

                "<div class='form-group col'>" +
                "<label for='alamat_instansi'>Alamat Instansi</label>" +
                "<input type='text' class='form-control' id='alamat_instansi' name='alamat_instansi'>" +
                "</div>" +

                "<div class='form-group col'>" +
                "<label for='status_kegiatan'>Status Kegiatan</label>" +
                "<select id='status_kegiatan' name='status_kegiatan' class='form-control'>" +
                "<option></option>" +
                "<option value='Aktif'>Aktif</option>" +
                "<option value='Tidak Aktif'>Tidak Aktif</option>" +
                "</select>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<div class='form-group col-4'>" +
                "<label for='durasi_kegiatan'>Durasi Kegiatan</label>" +
                "<select id='durasi_kegiatan' name='durasi_kegiatan' class='form-control'>" +
                "<option></option>" +
                "<option value='Feb - Jun 2024'>Feb - Jun 2024</option>" +
                "<option value='Agust - Des 2024'>Agust - Des 2024</option>" +
                "</select>" +
                "</div>" +

                "<div class='form-group col-4'>" +
                "<label for='mentor_instansi'>Mentor Instansi</label>" +
                "<input type='text' class='form-control' id='mentor_instansi' name='mentor_instansi'>" +
                "</div>" +
                "</div>" +
                "</div>";
        } else if (value == ' Kaprodi') {
            document.getElementById('Mahasiswa').style = 'display:none;';
            document.getElementById(' Kaprodi').style = 'display:block;';
            document.getElementById('Mentor').style = 'display:none;';
            document.getElementById('DPP').style = 'display:none;';
        } else if (value == 'Mentor') {
            document.getElementById('Mahasiswa').style = 'display:none;';
            document.getElementById(' Kaprodi').style = 'display:none;';
            document.getElementById('Mentor').style = 'display:block;';
            document.getElementById('DPP').style = 'display:none;';
        } else if (value == 'DPP') {
            document.getElementById('Mahasiswa').style = 'display:none;';
            document.getElementById(' Kaprodi').style = 'display:none;';
            document.getElementById('Mentor').style = 'display:none;';
            document.getElementById('DPP').style = 'display:block;';
        } else {
            document.getElementById('Mahasiswa').style = 'display:none;';
            document.getElementById(' Kaprodi').style = 'display:none;';
            document.getElementById('Mentor').style = 'display:none;';
            document.getElementById('DPP').style = 'display:none;';
        }
    };
    // Memastikan fungsi dijalankan ketika halaman selesai dimuat
    document.addEventListener("DOMContentLoaded", function() {
        // Misalnya, atur default tampilan ketika halaman selesai dimuat
        setForm(document.getElementById('select1').value);
    });
</script>


<div class="container-fluid">
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
                <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Add User</h6>
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
                            <option value="Mahasiswa" <?php echo (set_value('role') == "Mahasiswa") ? 'selected' : ''; ?>>Mahasiswa</option>
                            <option value=" Kaprodi" <?php echo (set_value('role') == " Kaprodi") ? 'selected' : ''; ?>>Kaprodi</option>
                            <option value="Mentor" <?php echo (set_value('role') == "Mentor") ? 'selected' : ''; ?>>Mentor</option>
                            <option value="DPP" <?php echo (set_value('role') == "DPP") ? 'selected' : ''; ?>>DPP</option>
                        </select>
                    </div>
                </div>

                <div id="form_add_user">

                </div>



                <!-- Role Kaprodi -->
                <div id=" Kaprodi" style="display: none">
                    <div class="row pt-3">
                        <div class="form-group col">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                        </div>

                        <div class="form-group col">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip">
                        </div>

                        <div class="form-group col">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group col">
                            <label for="program_studi">Program Studi</label>
                            <input type="text" class="form-control" id="program_studi" name="program_studi">
                        </div>

                        <div class="form-group col">
                            <label for="no_hp">No. HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp">
                        </div>

                        <div class=" form-group col">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= set_value('jenis_kelamin'); ?>">
                                <option></option>
                                <option value="Laki - Laki">Laki - Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <!-- Tutup Role Kaprodi -->

                <!-- Role Mentor -->
                <div id="Mentor" style="display: none">
                    <div class="row pt-3">
                        <div class="form-group col">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                        </div>

                        <div class="form-group col">
                            <label for="personal_number">Personal Number</label>
                            <input type="text" class="form-control" id="personal_number" name="personal_number">
                        </div>

                        <div class="form-group col">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group col">
                            <label for="no_hp">No. HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp">
                        </div>

                        <div class=" form-group col">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= set_value('jenis_kelamin'); ?>">
                                <option></option>
                                <option value="Laki - Laki">Laki - Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label for="nama_instansi">Nama Instansi</label>
                            <input type="text" class="form-control" id="nama_instansi" name="nama_instansi">
                        </div>

                        <div class="form-group col-4">
                            <label for="alamat_instansi">Alamat Instansi</label>
                            <input type="text" class="form-control" id="alamat_instansi" name="alamat_instansi">
                        </div>
                    </div>
                </div>
                <!-- Tutup Role Mentor -->

                <!-- Role DPP -->
                <div id="DPP" style="display: none">
                    <div class="row pt-3">
                        <div class="form-group col">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                        </div>

                        <div class="form-group col">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group col">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm mt-4" style="margin: auto; display: block;">Simpan</button>
        </form>
    </div>
</div>
</div>