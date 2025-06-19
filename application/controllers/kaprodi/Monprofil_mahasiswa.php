<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Monprofil_mahasiswa extends CI_Controller
{
    // Buat variabel untuk menampung data
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        // Memuat library atau helper yang diperlukan
        $this->load->library('session');
        $this->load->database();

        // Ambil data user
        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Ambil data profil Kaprodi
        $this->data['profil'] = $this->db->get_where('kaprodi', ['user_id_user' => $this->data['user']['id_user']])->row_array();

        // Ambil data program studi
        $this->data['programstudi'] = $this->db->get_where('program_studi', ['id_prodi' => $this->data['profil']['program_studi_id_prodi']])->row_array();

        $this->data['mahasiswa'] = $this->db->select('*') // Select the columns you want
            ->from('mahasiswa')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram')
            ->join('program_studi', 'program_studi.id_prodi = mahasiswa.program_studi_id_prodi')
            ->join('program_km', 'program_km.id_programkm = detail_program.program_km_id_programkm')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.id_dosen_pembimbing = detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', 'left')
            ->where('mahasiswa.program_studi_id_prodi', $this->data['profil']['program_studi_id_prodi'])
            ->get()
            ->result(); // Fetch the result as an array of objects
    }

    public function index()
    {

        $this->data['title'] = 'Monitoring Mahasiswa';
        $this->load->view('templates_kaprodi/header', $this->data);
        $this->load->view('templates_kaprodi/sidebar');
        $this->load->view('kaprodi/monprofil_mahasiswa', $this->data);
        $this->load->view('templates_kaprodi/footer');
    }

    public function viewprofil_mahasiswa($id_mahasiswa)
    {

        $this->data['informasi_mahasiswa'] = $this->db->select([
            'mahasiswa.*',
            'detail_program.*',
            'program_studi.*',
            'program_km.*',
            'instansi.*',
            'detail_dosen_pembimbing.*',
            'dosen_pembimbing.*',
            'user.*',
            'role.*',
            'mentor.*',
            'kaprodi.*',
            'mahasiswa.foto AS foto_mahasiswa',
            'dosen_pembimbing.no_hp AS no_hp_dospem',
            'mentor.no_hp AS no_hp_mentor',
            'mahasiswa.no_hp AS no_hp_mahasiswa' // Memberi alias untuk no_hp dosen pembimbing
        ]) // Select the columns you want
            ->from('mahasiswa')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram')
            ->join('program_studi', 'program_studi.id_prodi = mahasiswa.program_studi_id_prodi')
            ->join('program_km', 'program_km.id_programkm = detail_program.program_km_id_programkm')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.id_dosen_pembimbing = detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', 'left')
            ->join('mentor', 'mentor.id_mentor = detail_program.mentor_id_mentor', 'left')
            ->join('user', 'user.id_user = mahasiswa.user_id_user')
            ->join('role', 'role.id_role = user.role_id_role')
            ->join('kaprodi', 'kaprodi.program_studi_id_prodi = program_studi.id_prodi')
            ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
            ->get()
            ->row_array(); // Fetch the result as an array of objects


        $this->data['title'] = 'View Profil Mahasiswa';
        $this->load->view('templates_kaprodi/header', $this->data);
        $this->load->view('templates_kaprodi/sidebar');
        $this->load->view('kaprodi/viewprofil_mahasiswa', $this->data);
        $this->load->view('templates_kaprodi/footer');
    }

    public function editprofil_mahasiswa($id_mahasiswa)
    {

        $this->data['title'] = 'Edit Profil Mahasiswa';

        $this->data['informasi_mahasiswa'] = $this->db->select([
            'mahasiswa.*',
            'detail_program.*',
            'program_studi.*',
            'program_km.*',
            'instansi.*',
            'detail_dosen_pembimbing.*',
            'dosen_pembimbing.*',
            'user.*',
            'role.*',
            'mentor.*',
            'kaprodi.*',
            'mahasiswa.foto AS foto_mahasiswa',
            'dosen_pembimbing.no_hp AS no_hp_dospem',
            'mentor.no_hp AS no_hp_mentor',
            'mahasiswa.no_hp AS no_hp_mahasiswa' // Memberi alias untuk no_hp dosen pembimbing
        ]) // Select the columns you want
            ->from('mahasiswa')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram')
            ->join('program_studi', 'program_studi.id_prodi = mahasiswa.program_studi_id_prodi')
            ->join('program_km', 'program_km.id_programkm = detail_program.program_km_id_programkm')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.id_dosen_pembimbing = detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', 'left')
            ->join('mentor', 'mentor.id_mentor = detail_program.mentor_id_mentor', 'left')
            ->join('user', 'user.id_user = mahasiswa.user_id_user')
            ->join('role', 'role.id_role = user.role_id_role')
            ->join('kaprodi', 'kaprodi.program_studi_id_prodi = program_studi.id_prodi')
            ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
            ->get()
            ->row_array(); // Fetch the result as an array of objects

        //ambil tabel dospem
        $this->data['list_dosen'] = $this->db->get('dosen_pembimbing')->result_array();


        //rules validasi
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('nim', 'Nim', 'trim|required');
        $this->form_validation->set_rules('ipk', 'IPK', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_kaprodi/header', $this->data);
            $this->load->view('templates_kaprodi/sidebar');
            $this->load->view('kaprodi/editprofil_mahasiswa', $this->data);
            $this->load->view('templates_kaprodi/footer');
        } else {
            $nama = $this->input->post('nama_lengkap');
            $nim = $this->input->post('nim');
            $ipk = $this->input->post('ipk');
            $no_hp = $this->input->post('no_hp');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $id_dosen_pembimbing = $this->input->post('nama_dospem');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/template/img/profil/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('foto', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('kaprodi/monprofil_mahasiswa');
                }
            }

            $this->db->set('nama_mahasiswa', $nama);
            $this->db->set('ipk', $ipk);
            $this->db->set('nim', $nim);
            $this->db->set('no_hp', $no_hp);
            $this->db->set('jenis_kelamin', $jenis_kelamin);
            $this->db->where('id_mahasiswa', $id_mahasiswa);
            $this->db->update('mahasiswa');

            // Cek apakah mahasiswa sudah memiliki dospem di detail_dosen_pembimbing
            $cek_dospem = $this->db->get_where('detail_dosen_pembimbing', ['mahasiswa_id_mahasiswa' => $id_mahasiswa])->row_array();

            if ($cek_dospem) {
                // Jika sudah ada, update dospem
                $this->db->set('dosen_pembimbing_id_dosen_pembimbing', $id_dosen_pembimbing);
                $this->db->where('mahasiswa_id_mahasiswa', $id_mahasiswa);
                $this->db->update('detail_dosen_pembimbing');
            } else {
                // Jika belum ada, insert data baru
                $this->db->insert('detail_dosen_pembimbing', [
                    'mahasiswa_id_mahasiswa' => $id_mahasiswa,
                    'dosen_pembimbing_id_dosen_pembimbing' => $id_dosen_pembimbing
                ]);
            }

            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Profile mahasiswa has been updated!</div>');
            redirect('kaprodi/monprofil_mahasiswa');
        }
    }

    public function hapusprofil_mahasiswa($id_mahasiswa)
    {

        $mahasiswa = $this->db->get_where('mahasiswa', ['id_mahasiswa' => $id_mahasiswa])->row_array();
        $user_id_user = $mahasiswa['user_id_user'];

        // Mulai transaksi
        $this->db->trans_start();

        // Hapus data mahasiswa dari tabel mahasiswa
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->delete('mahasiswa');

        $this->db->where('id_user', $user_id_user);
        $this->db->delete('user');

        // Selesaikan transaksi
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            // Jika transaksi gagal
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mahasiswa has not been deleted!</div>');
        } else {
            // Jika transaksi berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Mahasiswa has been deleted!</div>');
        }

        redirect('kaprodi/monprofil_mahasiswa');
    }
}
