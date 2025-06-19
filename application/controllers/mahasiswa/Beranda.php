<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Beranda extends CI_Controller
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
        $this->data['mentor'] = $this->db->get_where('mentor', ['id_mentor' => $this->data['detailprogram']['mentor_id_mentor']])->row_array();

        // Mengambil data sertifikat
        $this->data['sertifikat'] = $this->db->get_where('sertifikat', ['mahasiswa_id_mahasiswa' => $this->data['profil']['id_mahasiswa']])->row_array();

        // Mengambil data dosen pembimbing
        $this->data['detaildospem'] = $this->db->get_where('detail_dosen_pembimbing', ['mahasiswa_id_mahasiswa' => $this->data['profil']['id_mahasiswa']])->row_array();

        // Mengambil data dosen pembimbing
        $this->data['dospem'] = $this->db->get_where('dosen_pembimbing', ['id_dosen_pembimbing' => $this->data['detaildospem']['dosen_pembimbing_id_dosen_pembimbing']])->row_array();
    }


    public function index()
    {
        // Mengatur judul halaman
        $this->data['title'] = 'Beranda';

        $this->load->view('templates_mahasiswa/header', $this->data);
        $this->load->view('templates_mahasiswa/sidebar');
        $this->load->view('mahasiswa/beranda', $this->data);
        $this->load->view('templates_mahasiswa/footer');
    }
}
