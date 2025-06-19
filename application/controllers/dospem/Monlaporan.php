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

        //ambil ambil data user
        $this->data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        //untuk mengambil data user untuk semua data dalam mahasiswa
        $this->data['profil'] = $this->db->get_where('dosen_pembimbing', ['user_id_user' => $this->data['user']['id_user']])->row_array();

        // Ambil semua mahasiswa dan data utama mereka
        $mahasiswa_list = $this->db->select([
            'mahasiswa.*',
            'detail_program.*',
            'program_km.*',
            'sertifikat.*'
        ])
            ->from('mahasiswa')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram')
            ->join('program_km', 'program_km.id_programkm = detail_program.program_km_id_programkm')
            ->join('sertifikat', 'sertifikat.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->where('detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', $this->data['profil']['id_dosen_pembimbing'])
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

        $this->data['title'] = 'Laporan Mahasiswa';
        $this->load->view('templates_dospem/header', $this->data);
        $this->load->view('templates_dospem/sidebar');
        $this->load->view('dospem/monlaporan', $this->data);
        $this->load->view('templates_dospem/footer');
    }
}
