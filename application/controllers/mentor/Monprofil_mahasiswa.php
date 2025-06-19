<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Monprofil_mahasiswa extends CI_Controller
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

        $this->data['title'] = 'Monitoring Mahasiswa';
        $this->load->view('templates_mentor/header', $this->data);
        $this->load->view('templates_mentor/sidebar');
        $this->load->view('mentor/monprofil_mahasiswa', $this->data);
        $this->load->view('templates_mentor/footer');
    }

    public function viewprofil_mahasiswa($id_mahasiswa)
    {

        $this->data['id_mahasiswa'] = $id_mahasiswa;
        $this->data['informasi_mahasiswa'] = $this->db->select([
            'mahasiswa.*',
            'detail_program.*',
            'program_studi.*',
            'program_km.*',
            'instansi.*',
            'detail_dosen_pembimbing.*',
            'dosen_pembimbing.*',
            'user.*',
            'role.*',
            'mentor.*',
            'mahasiswa.foto AS foto_mahasiswa',
            'dosen_pembimbing.no_hp AS no_hp_dospem',
            'mentor.no_hp AS no_hp_mentor',
            'mahasiswa.no_hp AS no_hp_mahasiswa' // Memberi alias untuk no_hp dosen pembimbing
        ]) // Select the columns you want
            ->from('mahasiswa')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram')
            ->join('program_studi', 'program_studi.id_prodi = mahasiswa.program_studi_id_prodi')
            ->join('program_km', 'program_km.id_programkm = detail_program.program_km_id_programkm')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.id_dosen_pembimbing = detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', 'left')
            ->join('user', 'user.id_user = mahasiswa.user_id_user')
            ->join('role', 'role.id_role = user.role_id_role')
            ->join('mentor', 'mentor.id_mentor = detail_program.mentor_id_mentor')
            ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
            ->get()
            ->row_array(); // Fetch the result as an array of objects

        $this->data['title'] = 'View Profil Mahasiswa';
        $this->load->view('templates_mentor/header', $this->data);
        $this->load->view('templates_mentor/sidebar');
        $this->load->view('mentor/viewprofil_mahasiswa', $this->data);
        $this->load->view('templates_mentor/footer');
    }
}
