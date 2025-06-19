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

        // Ambil data user
        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Ambil data profil Kaprodi
        $this->data['profil'] = $this->db->get_where('kaprodi', ['user_id_user' => $this->data['user']['id_user']])->row_array();

        // Ambil data program studi
        $this->data['programstudi'] = $this->db->get_where('program_studi', ['id_prodi' => $this->data['profil']['program_studi_id_prodi']])->row_array();

        $this->data['program'] = $this->db->select('*') // Select the columns you want
            ->from('program_km')
            ->join('detail_program', 'detail_program.program_km_id_programkm = program_km.id_programkm', 'left')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi', 'left')
            ->join('mahasiswa', 'mahasiswa.detail_program_id_detailprogram = detail_program.id_detailprogram AND mahasiswa.program_studi_id_prodi = ' . $this->data['profil']['program_studi_id_prodi'], 'left')
            ->where('detail_program.status_kegiatan', 'Sedang Berjalan')
            ->order_by('id_programkm')
            ->get()
            ->result_array(); // Fetch the result as an array of objects

        $this->data['detail_program'] = $this->db->select('*') // Select the columns you want
            ->from('detail_program')
            ->join('mahasiswa', 'mahasiswa.detail_program_id_detailprogram = detail_program.id_detailprogram AND mahasiswa.program_studi_id_prodi = ' . $this->data['profil']['program_studi_id_prodi'], 'left')
            ->join('logbook', 'mahasiswa.id_mahasiswa = logbook.mahasiswa_id_mahasiswa', 'left')
            ->where('mahasiswa.program_studi_id_prodi', $this->data['profil']['program_studi_id_prodi'], 'detail_program.status_kegiatan', 'Sedang Berjalan')
            ->order_by('id_mahasiswa')
            ->get()
            ->result_array(); // Fetch the result as an array of objects

        // Ambil semua mahasiswa dan data utama mereka
        $dospem_list = $this->db->select([
            'dosen_pembimbing.*',
        ])
            ->from('dosen_pembimbing')
            ->where('dosen_pembimbing.program_studi_id_prodi', $this->data['profil']['program_studi_id_prodi'])
            ->get()
            ->result_array(); // Ambil sebagai array

        // Ambil semua  mahasiswa terkait
        $mahasiswa = $this->db->select([
            'mahasiswa.*',
            'detail_dosen_pembimbing.*'
        ])
            ->from('mahasiswa')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->where_in('detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', array_column($dospem_list, 'id_dosen_pembimbing'))
            ->get()
            ->result_array();

        $mahasiswa_per_dospem = [];
        foreach ($mahasiswa as $mhs) {
            $mahasiswa_per_dospem[$mhs['dosen_pembimbing_id_dosen_pembimbing']][] = $mhs;
        }

        foreach ($dospem_list as &$dospem) {
            $id_dosen_pembimbing = $dospem['id_dosen_pembimbing'];
            $dospem['mahasiswa'] = isset($mahasiswa_per_dospem[$id_dosen_pembimbing]) ? $mahasiswa_per_dospem[$id_dosen_pembimbing] : []; // Tambahkan logbook jika ada
        }

        // Simpan data mahasiswa yang sudah terorganisir
        $this->data['dospem'] = $dospem_list;
    }


    public function index()
    {
        // Mengatur judul halaman
        $this->data['title'] = 'Dashboard';

        // Memuat tampilan
        $this->load->view('templates_kaprodi/header', $this->data);
        $this->load->view('templates_kaprodi/sidebar');
        $this->load->view('kaprodi/dashboard', $this->data);
        $this->load->view('templates_kaprodi/footer');
    }
}
