<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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

        // Mengambil data instansi
        $this->data['instansi'] = $this->db->get_where('instansi', ['id_instansi' => $this->data['profil']['instansi_id_instansi']])->row_array();

        $this->data['program'] = $this->db->select('*') // Select the columns you want
            ->from('program_km')
            ->join('detail_program', 'detail_program.program_km_id_programkm = program_km.id_programkm', 'left')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi', 'left')
            ->join('mahasiswa', 'mahasiswa.detail_program_id_detailprogram = detail_program.id_detailprogram AND detail_program.mentor_id_mentor = ' . $this->data['profil']['id_mentor'], 'left')
            ->where('detail_program.status_kegiatan', 'Sedang Berjalan')
            ->get()
            ->result_array(); // Fetch the result as an array of objects

        $this->data['detail_program'] = $this->db->select('*') // Select the columns you want
            ->from('detail_program')
            ->join('mahasiswa', 'mahasiswa.detail_program_id_detailprogram = detail_program.id_detailprogram AND detail_program.mentor_id_mentor = ' . $this->data['profil']['id_mentor'])
            ->join('logbook', 'mahasiswa.id_mahasiswa = logbook.mahasiswa_id_mahasiswa', 'left')
            ->where('detail_program.status_kegiatan', 'Sedang Berjalan')
            ->order_by('id_mahasiswa')
            ->get()
            ->result_array(); // Fetch the result as an array of objects
    }

    public function index()
    {
        // Mengatur judul halaman
        $this->data['title'] = 'Dashboard';

        $this->load->view('templates_mentor/header', $this->data);
        $this->load->view('templates_mentor/sidebar');
        $this->load->view('mentor/dashboard', $this->data);
        $this->load->view('templates_mentor/footer');
    }
}
