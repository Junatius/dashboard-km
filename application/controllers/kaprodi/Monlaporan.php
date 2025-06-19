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

        // Ambil data user
        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Ambil data profil Kaprodi
        $this->data['profil'] = $this->db->get_where('kaprodi', ['user_id_user' => $this->data['user']['id_user']])->row_array();

        // Ambil data program studi
        $this->data['programstudi'] = $this->db->get_where('program_studi', ['id_prodi' => $this->data['profil']['program_studi_id_prodi']])->row_array();

        // Ambil semua mahasiswa dan data utama mereka
        $mahasiswa_list = $this->db->select([
            'mahasiswa.*',
            'detail_program.*',
            'program_km.*',
            'sertifikat.*',
            'instansi.*'
        ])
            ->from('mahasiswa')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram', 'left')
            ->join('program_km', 'program_km.id_programkm = detail_program.program_km_id_programkm', 'left')
            ->join('sertifikat', 'sertifikat.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi', 'left')
            ->where('mahasiswa.program_studi_id_prodi', $this->data['profil']['program_studi_id_prodi'])
            ->get()
            ->result_array(); // Ambil sebagai array

        // Ambil semua logbook mahasiswa terkait
        $logbooks = $this->db->select([
            'logbook.*'
        ])
            ->from('logbook')
            ->where_in('logbook.mahasiswa_id_mahasiswa', array_column($mahasiswa_list, 'id_mahasiswa')) // Hanya ambil logbook mahasiswa yang sudah diambil
            ->get()
            ->result_array();

        // Organisir logbook berdasarkan mahasiswa
        $logbook_per_mahasiswa = [];
        foreach ($logbooks as $logbook) {
            $logbook_per_mahasiswa[$logbook['mahasiswa_id_mahasiswa']][] = $logbook;
        }

        // Gabungkan logbook ke dalam data mahasiswa
        foreach ($mahasiswa_list as &$mahasiswa) {
            $id_mahasiswa = $mahasiswa['id_mahasiswa'];
            $mahasiswa['logbooks'] = isset($logbook_per_mahasiswa[$id_mahasiswa]) ? $logbook_per_mahasiswa[$id_mahasiswa] : []; // Tambahkan logbook jika ada
        }

        // Simpan data mahasiswa yang sudah terorganisir
        $this->data['mahasiswa'] = $mahasiswa_list;
    }

    public function index()
    {
        // Mengatur judul halaman
        $this->data['title'] = 'Laporan Mahasiswa';
        $this->load->view('templates_kaprodi/header', $this->data);
        $this->load->view('templates_kaprodi/sidebar');
        $this->load->view('kaprodi/monlaporan', $this->data);
        $this->load->view('templates_kaprodi/footer');
    }
}
