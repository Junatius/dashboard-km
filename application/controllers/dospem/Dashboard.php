<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

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

        //ambil ambil data user
        $this->data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        //untuk mengambil data user untuk semua data dalam mahasiswa
        $this->data['profil'] = $this->db->get_where('dosen_pembimbing', ['user_id_user' => $this->data['user']['id_user']])->row_array();

        $this->data['programstudi'] = $this->db->get_where('program_studi', ['id_prodi' => $this->data['profil']['program_studi_id_prodi']])->row_array();

        $this->data['program'] = $this->db->select('*') // Select the columns you want
            ->from('program_km')
            ->join('detail_program', 'detail_program.program_km_id_programkm = program_km.id_programkm', 'left')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi', 'left')
            ->join('mahasiswa', 'mahasiswa.detail_program_id_detailprogram = detail_program.id_detailprogram AND mahasiswa.program_studi_id_prodi = ' . $this->data['profil']['program_studi_id_prodi'], 'left')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa')
            ->where('detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', $this->data['profil']['id_dosen_pembimbing'], 'detail_program.status_kegiatan', 'Sedang Berjalan')
            ->order_by('id_programkm')
            ->get()
            ->result_array(); // Fetch the result as an array of objects

        $this->data['detail_program'] = $this->db->select('*') // Select the columns you want
            ->from('detail_program')
            ->join('mahasiswa', 'mahasiswa.detail_program_id_detailprogram = detail_program.id_detailprogram AND mahasiswa.program_studi_id_prodi = ' . $this->data['profil']['program_studi_id_prodi'], 'left')
            ->join('logbook', 'mahasiswa.id_mahasiswa = logbook.mahasiswa_id_mahasiswa', 'left')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa')
            ->where('detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', $this->data['profil']['id_dosen_pembimbing'], 'detail_program.status_kegiatan', 'Sedang Berjalan')
            ->order_by('id_mahasiswa')
            ->get()
            ->result_array(); // Fetch the result as an array of objects

    }

    public function index()
    {

        // Mengatur judul halaman
        $this->data['title'] = 'Dashboard';
        $this->load->view('templates_dospem/header', $this->data);
        $this->load->view('templates_dospem/sidebar');
        $this->load->view('dospem/dashboard', $this->data);
        $this->load->view('templates_dospem/footer');
    }
}
