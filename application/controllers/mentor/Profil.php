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

        // Mengambil data user
        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Mengambil data profil mentor
        $this->data['profil'] = $this->db->get_where('mentor', ['user_id_user' => $this->data['user']['id_user']])->row_array();

        // Mengambil data role
        $this->data['role'] = $this->db->get_where('role', ['id_role' => $this->data['user']['role_id_role']])->row_array();

        // Mengambil data instansi
        $this->data['instansi'] = $this->db->get_where('instansi', ['id_instansi' => $this->data['profil']['instansi_id_instansi']])->row_array();
    }

    public function index()
    {


        $this->data['title'] = 'Profil';
        $this->load->view('templates_mentor/header', $this->data);
        $this->load->view('templates_mentor/sidebar');
        $this->load->view('mentor/profil', $this->data);
        $this->load->view('templates_mentor/footer');
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
            $this->load->view('templates_mentor/header', $this->data);
            $this->load->view('templates_mentor/sidebar');
            $this->load->view('mentor/edit_profil', $this->data);
            $this->load->view('templates_mentor/footer');
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
                    redirect('mentor/profil');
                }
            }

            $this->db->set('nama_mentor', $nama);
            $this->db->set('no_hp', $no_hp);
            $this->db->set('jenis_kelamin', $jenis_kelamin);
            $this->db->where('id_mentor', $profil['id_mentor']);
            $this->db->update('mentor');

            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Your profile has been updated!</div>');
            redirect('mentor/profil');
        }
    }
}
