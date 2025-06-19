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
        $this->data['profil'] = $this->db->get_where('admin', ['user_id_user' => $this->data['user']['id_user']])->row_array();

        // Ambil semua mahasiswa dan data utama mereka
        $this->data['mahasiswa_list'] = $this->db->select([
            'mahasiswa.*',
            'detail_program.*',
            'program_km.*',
            'sertifikat.*',
            'instansi.*',
            'program_studi.*'
        ])
            ->from('mahasiswa')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram', 'left')
            ->join('program_km', 'program_km.id_programkm = detail_program.program_km_id_programkm', 'left')
            ->join('sertifikat', 'sertifikat.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi', 'left')
            ->join('program_studi', 'program_studi.id_prodi = mahasiswa.program_studi_id_prodi', 'left')
            ->get()
            ->result_array(); // Ambil sebagai array

        // Ambil semua logbook mahasiswa terkait
        $logbooks = $this->db->select([
            'logbook.*'
        ])
            ->from('logbook')
            ->where_in('logbook.mahasiswa_id_mahasiswa', array_column($this->data['mahasiswa_list'], 'id_mahasiswa')) // Hanya ambil logbook mahasiswa yang sudah diambil
            ->get()
            ->result_array();

        // Organisir logbook berdasarkan mahasiswa
        $logbook_per_mahasiswa = [];
        foreach ($logbooks as $logbook) {
            $logbook_per_mahasiswa[$logbook['mahasiswa_id_mahasiswa']][] = $logbook;
        }

        // Gabungkan logbook ke dalam data mahasiswa
        foreach ($this->data['mahasiswa_list'] as &$mahasiswa) {
            $id_mahasiswa = $mahasiswa['id_mahasiswa'];
            $mahasiswa['logbooks'] = isset($logbook_per_mahasiswa[$id_mahasiswa]) ? $logbook_per_mahasiswa[$id_mahasiswa] : []; // Tambahkan logbook jika ada
        }

        // Simpan data mahasiswa yang sudah terorganisir
        $this->data['mahasiswa'] = $this->data['mahasiswa_list'];

        $this->data['list_logbook'] = $this->db->get('logbook')->result_array();
    }


    public function index()
    {
        $this->data['title'] = 'Laporan Mahasiswa';
        $this->load->view('templates_admin/header', $this->data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/monlaporan', $this->data);
        $this->load->view('templates_admin/footer');
    }

    public function editmonlaporan_mahasiswa($id_logbook)
    {
        $this->data['id_logbook'] = $id_logbook;

        //rules validasi
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('tipe_laporan', 'Tipe Laporan', 'required');
        $this->form_validation->set_rules('uraian_kegiatan', 'Uraian Kegiatan', 'required');
        $this->form_validation->set_rules('komentar_mentor', 'Komentar Mentor', 'required');
        $this->form_validation->set_rules('status', 'Status Laporan', 'required');

        if ($this->form_validation->run() == false) {
            $this->data['title'] = 'Edit Laporan Mahasiswa';
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/monlaporan', $this->data);
            $this->load->view('templates_admin/footer');
        } else {
            $tanggal = $this->input->post('tanggal');
            $tipe_laporan = $this->input->post('tipe_laporan');
            $uraian_kegiatan = $this->input->post('uraian_kegiatan');
            $komentar_mentor = $this->input->post('komentar_mentor');
            $status = $this->input->post('status');

            $this->db->set('tipe_laporan', $tipe_laporan);
            $this->db->set('uraian_kegiatan', $uraian_kegiatan);
            $this->db->set('komentar_mentor', $komentar_mentor);
            $this->db->set('tanggal', $tanggal);
            $this->db->set('status', $status);
            $this->db->where('id_logbook', $id_logbook);
            $this->db->update('logbook');

            $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Report has been edited!</div>');
            redirect('admin/monlaporan');
        }
    }

    public function hapusmonlaporan_mahasiswa($id_logbook)
    {

        $this->db->where('id_logbook', $id_logbook);
        if ($this->db->delete('logbook')) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" rol
            e="alert">Report has been deleted!</div>');
            redirect('admin/monlaporan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" rol
            e="alert">Report has not been deleted!</div>');
            redirect('admin/monlaporan');
        }
    }
}
