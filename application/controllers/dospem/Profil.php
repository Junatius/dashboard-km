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

        //ambil ambil data user
        $this->data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        //untuk mengambil data user untuk semua data dalam mahasiswa
        $this->data['profil'] = $this->db->get_where('dosen_pembimbing', ['user_id_user' => $this->data['user']['id_user']])->row_array();

        // Mengambil data role
        $this->data['role'] = $this->db->get_where('role', ['id_role' => $this->data['user']['role_id_role']])->row_array();
    }

    public function index()
    {

        $this->data['title'] = 'Profil';
        $this->load->view('templates_dospem/header', $this->data);
        $this->load->view('templates_dospem/sidebar');
        $this->load->view('dospem/profil', $this->data);
        $this->load->view('templates_dospem/footer');
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

            $this->data['title'] = 'Edit Profil';
            $this->load->view('templates_dospem/header', $this->data);
            $this->load->view('templates_dospem/sidebar');
            $this->load->view('dospem/edit_profil', $this->data);
            $this->load->view('templates_dospem/footer');
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
                    redirect('dospem/profil');
                }
            }

            $this->db->set('nama_dospem', $nama);
            $this->db->set('no_hp', $no_hp);
            $this->db->set('jenis_kelamin', $jenis_kelamin);
            $this->db->where('id_dosen_pembimbing', $profil['id_dosen_pembimbing']);
            $this->db->update('dosen_pembimbing');

            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Your profile has been updated!</div>');
            redirect('dospem/profil');
        }
    }
}
