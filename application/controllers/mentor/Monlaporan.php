<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Monlaporan extends CI_Controller
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
            ->from('mahasiswa')
            ->join('logbook', 'logbook.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram')
            ->join('program_studi', 'program_studi.id_prodi = mahasiswa.program_studi_id_prodi')
            ->join('program_km', 'program_km.id_programkm = detail_program.program_km_id_programkm')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi')
            ->where('detail_program.mentor_id_mentor', $this->data['profil']['id_mentor'])
            ->get()
            ->result(); // Fetch the result as an array of objects

    }

    public function index()
    {
        $this->data['title'] = 'Laporan Mahasiswa';
        $this->load->view('templates_mentor/header', $this->data);
        $this->load->view('templates_mentor/sidebar');
        $this->load->view('mentor/monlaporan', $this->data);
        $this->load->view('templates_mentor/footer');
    }

    public function edit_laporan($id_logbook)
    {

        $this->data['id_logbook'] = $id_logbook;

        //rules validasi
        $this->form_validation->set_rules('komentar_mentor', 'Komentar Mentor', 'required');
        $this->form_validation->set_rules('status', 'Status Laporan', 'required');

        if ($this->form_validation->run() == false) {
            $this->data['title'] = 'Edit Laporan Mahasiswa';
            $this->load->view('templates_mentor/header', $this->data);
            $this->load->view('templates_mentor/sidebar');
            $this->load->view('mentor/monlaporan', $this->data);
            $this->load->view('templates_mentor/footer');
        } else {

            $komentar_mentor = $this->input->post('komentar_mentor');
            $status = $this->input->post('status');

            $this->db->set('komentar_mentor', $komentar_mentor);
            $this->db->set('status', $status);
            $this->db->where('id_logbook', $id_logbook);
            $this->db->update('logbook');

            $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Report has been edited!</div>');
            redirect('mentor/monlaporan');
        }
    }
}
