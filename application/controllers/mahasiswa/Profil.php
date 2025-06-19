<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Profil extends CI_Controller
{

    // Buat variabel untuk menampung data
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        // Memuat library atau helper yang diperlukan
        $this->load->library('session');
        $this->load->database();

        // Mengambil data user dari sesi
        $this->data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // Mengambil data profil mahasiswa berdasarkan user_id
        $this->data['profil'] = $this->db->get_where('mahasiswa', ['user_id_user' => $this->data['user']['id_user']])->row_array();

        // Mengambil data program studi
        $this->data['programstudi'] = $this->db->get_where('program_studi', ['id_prodi' => $this->data['profil']['program_studi_id_prodi']])->row_array();

        // Mengambil data detail program
        $this->data['detailprogram'] = $this->db->get_where('detail_program', ['id_detailprogram' => $this->data['profil']['detail_program_id_detailprogram']])->row_array();

        // Mengambil data program km
        $this->data['programkm'] = $this->db->get_where('program_km', ['id_programkm' => $this->data['detailprogram']['program_km_id_programkm']])->row_array();

        // Mengambil data instansi yang terkait dengan program KM
        $this->data['instansi'] = $this->db->get_where('instansi', ['id_instansi' => $this->data['detailprogram']['instansi_id_instansi']])->row_array();

        // Mengambil data mentor
        $this->data['mentor'] = $this->db->get_where('mentor', ['instansi_id_instansi' => $this->data['instansi']['id_instansi']])->row_array();

        // Mengambil data role
        $this->data['role'] = $this->db->get_where('role', ['id_role' => $this->data['user']['role_id_role']])->row_array();

        // Mengambil data program km
        $this->data['programkm'] = $this->db->get_where('program_km', ['id_programkm' => $this->data['detailprogram']['program_km_id_programkm']])->row_array();

        // Mengambil data dosen pembimbing
        $this->data['detaildospem'] = $this->db->get_where('detail_dosen_pembimbing', ['mahasiswa_id_mahasiswa' => $this->data['profil']['id_mahasiswa']])->row_array();

        // Mengambil data dosen pembimbing
        $this->data['dospem'] = $this->db->get_where('dosen_pembimbing', ['id_dosen_pembimbing' => $this->data['detaildospem']['dosen_pembimbing_id_dosen_pembimbing']])->row_array();
    }

    public function index()
    {
        // Mengatur judul halaman
        $this->data['title'] = 'Profile';

        $this->load->view('templates_mahasiswa/header', $this->data);
        $this->load->view('templates_mahasiswa/sidebar');
        $this->load->view('mahasiswa/profil', $this->data);
        $this->load->view('templates_mahasiswa/footer');
    }

    public function edit_profil()
    {
        $this->data['title'] = 'Edit Profil';

        //rules validasi
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');


        if ($this->form_validation->run() == false) {
            // Mengatur judul halaman

            $this->load->view('templates_mahasiswa/header', $this->data);
            $this->load->view('templates_mahasiswa/sidebar');
            $this->load->view('mahasiswa/edit_profil', $this->data);
            $this->load->view('templates_mahasiswa/footer');
        } else {
            $email = $this->input->post('email');
            $nama = $this->input->post('nama_lengkap');
            $no_hp = $this->input->post('no_hp');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $profil = $this->data['profil'];

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
                    redirect('mahasiswa/profil');
                }
            }

            $this->db->set('nama_mahasiswa', $nama);
            $this->db->set('no_hp', $no_hp);
            $this->db->set('jenis_kelamin', $jenis_kelamin);
            $this->db->where('id_mahasiswa', $profil['id_mahasiswa']);
            $this->db->update('mahasiswa');

            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Your profile has been updated!</div>');
            redirect('mahasiswa/profil');
        }
    }
}
