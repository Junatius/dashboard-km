<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikat extends CI_Controller
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

        $this->data['mahasiswa'] = $this->db->select('*') // Select the columns you want
            ->from('mentor')
            ->join('detail_program', 'mentor.id_mentor = detail_program.mentor_id_mentor')
            ->join('mahasiswa', 'mahasiswa.detail_program_id_detailprogram = detail_program.id_detailprogram')
            ->where('detail_program.mentor_id_mentor', $this->data['profil']['id_mentor'])
            ->get()
            ->result(); // Fetch the result as an array of objects
    }

    public function index()
    {
        // Mengatur judul halaman
        $this->data['title'] = 'Sertifikat';

        // Set rules untuk input lainnya jika diperlukan
        $this->form_validation->set_rules('nama_mahasiswa', 'Nama Mahasiswa', 'required');

        // Validasi file upload (custom)
        if (empty($_FILES['file']['name'])) {
            $this->form_validation->set_rules('file', 'Sertifikat', 'required');
        }

        if ($this->form_validation->run() == false) { //jika tidak sesuai balik ke tambah laporan
            $this->load->view('templates_mentor/header', $this->data);
            $this->load->view('templates_mentor/sidebar');
            $this->load->view('mentor/sertifikat', $this->data);
            $this->load->view('templates_mentor/footer');
        } else {
            $sertifikat = $this->input->post('sertifikat');
            $profil = $this->data['profil'];

            $upload_file = $_FILES['file']['name'];

            if ($upload_file) {
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '15360';
                $config['upload_path'] = './assets/template/file/sertifikat/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $new_file = $this->upload->data('file_name');
                    $data = [
                        'file' => $new_file,
                        'mahasiswa_id_mahasiswa' => $this->input->post('nama_mahasiswa'),
                    ];
                    $this->db->insert('sertifikat', $data);
                    $this->session->set_flashdata('message', '<div class="alert 
        alert-success" role="alert">Sertifikat has been added!</div>');
                    redirect('mentor/sertifikat');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('mentor/sertifikat');
                }
            }
        }
    }
}
