<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Laporan extends CI_Controller
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

        // Mengambil data do logbook
        $this->data['logbook'] = $this->db->from('logbook') // Menggunakan query builder 'from'
            ->where('mahasiswa_id_mahasiswa', $this->data['profil']['id_mahasiswa'])
            ->order_by('tipe_laporan', 'ASC') // Pengurutan berdasarkan tipe_laporan
            ->get() // Menjalankan query
            ->result_array(); // Mengambil hasilnya sebagai array

        date_default_timezone_set('Asia/Singapore');
    }

    public function index()
    {

        $this->data['title'] = 'Laporan';
        $this->load->view('templates_mahasiswa/header', $this->data);
        $this->load->view('templates_mahasiswa/sidebar');
        $this->load->view('mahasiswa/laporan', $this->data);
        $this->load->view('templates_mahasiswa/footer');
    }

    public function tambah_laporan()
    {
        // Mengatur judul halaman
        $this->data['title'] = 'Tambah Laporan';

        //rules validasi
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('tipe_laporan', 'Tipe Laporan', 'required');

        if ($this->form_validation->run() == false) { //jika tidak sesuai balik ke tambah laporan
            $this->load->view('templates_mahasiswa/header', $this->data);
            $this->load->view('templates_mahasiswa/sidebar');
            $this->load->view('mahasiswa/tambah_laporan', $this->data);
            $this->load->view('templates_mahasiswa/footer');
        } else {
            $tanggal_upload = date('Y-m-d H:i:s');
            $tanggal = $this->input->post('tanggal');
            $tipe_laporan = $this->input->post('tipe_laporan');
            $uraian_kegiatan = $this->input->post('uraian_kegiatan');
            $logbook = $this->data['logbook'];
            $profil = $this->data['profil'];

            if ($tipe_laporan == 'Laporan Akhir') { //cek bagian laporan akhir
                //cek jika ada file yang akan diupload
                // Validasi file upload (custom)
                $upload_file = $_FILES['file']['name'];

                if ($upload_file) {
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '15360';
                    $config['upload_path'] = './assets/template/file/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('file')) {
                        $new_file = $this->upload->data('file_name');
                        $data = [
                            'tipe_laporan' => $this->input->post('tipe_laporan'),
                            'uraian_kegiatan' => $new_file,
                            'tanggal' => $this->input->post('tanggal'),
                            'tanggal_upload' => $tanggal_upload,
                            'mahasiswa_id_mahasiswa' => $profil['id_mahasiswa']
                        ];
                        $this->db->insert('logbook', $data);
                        $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Your report has been added!</div>');
                        redirect('mahasiswa/laporan');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                        redirect('mahasiswa/laporan');
                    }
                } else {
                    var_dump($upload_file);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">File must be inputed!</div>');
                    redirect('mahasiswa/laporan/tambah_laporan');
                }
            } else { //untuk laporan mingguan dan laporan harian

                //rules 
                $this->form_validation->set_rules('uraian_kegiatan', 'Uraian Kegiatan', 'required');

                if ($this->form_validation->run() == false) { //jika tidak sesuai balik ke tambah laporan
                    $this->load->view('templates_mahasiswa/header', $this->data);
                    $this->load->view('templates_mahasiswa/sidebar');
                    $this->load->view('mahasiswa/tambah_laporan', $this->data);
                    $this->load->view('templates_mahasiswa/footer');
                } else { //jika sesuai maka simpan data ke database dari form view/page
                    $data = [
                        'tipe_laporan' => $this->input->post('tipe_laporan'),
                        'uraian_kegiatan' => $this->input->post('uraian_kegiatan'),
                        'tanggal' => $this->input->post('tanggal'),
                        'tanggal_upload' => $tanggal_upload,
                        'mahasiswa_id_mahasiswa' => $profil['id_mahasiswa']
                    ];
                    $this->db->insert('logbook', $data);
                    $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Your report has been added!</div>');
                    redirect('mahasiswa/laporan');
                }
            }
        }
    }

    public function edit_laporan($id_logbook)
    {

        $this->data['id_logbook'] = $id_logbook;

        $tanggal_upload = date('Y-m-d H:i:s');

        //rules validasi
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('tipe_laporan', 'Tipe Laporan', 'required');

        if ($this->form_validation->run() == false) { //jika tidak sesuai balik ke laporan
            $this->load->view('templates_mahasiswa/header', $this->data);
            $this->load->view('templates_mahasiswa/sidebar');
            $this->load->view('mahasiswa/laporan', $this->data);
            $this->load->view('templates_mahasiswa/footer');
        } else {
            $tanggal_upload = date('Y-m-d H:i:s');
            $tanggal = $this->input->post('tanggal');
            $tipe_laporan = $this->input->post('tipe_laporan');
            $uraian_kegiatan = $this->input->post('uraian_kegiatan');
            $logbook = $this->data['logbook'];

            if ($tipe_laporan == 'Laporan Akhir') { //cek bagian laporan akhir
                //cek jika ada file yang akan diupload
                // Validasi file upload (custom)

                $upload_file = $_FILES['file']['name'];

                if ($upload_file) {
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '15360';
                    $config['upload_path'] = './assets/template/file/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('file')) {
                        $new_file = $this->upload->data('file_name');

                        $this->db->set('tipe_laporan', $tipe_laporan);
                        $this->db->set('uraian_kegiatan', $new_file);
                        $this->db->set('tanggal', $tanggal);
                        $this->db->set('tanggal_upload', $tanggal_upload);
                        $this->db->where('id_logbook', $id_logbook);
                        $this->db->update('logbook');

                        $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Your report has been edited!</div>');
                        redirect('mahasiswa/laporan');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                        redirect('mahasiswa/laporan');
                    }
                } else {
                    var_dump($upload_file);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $upload_file . '</div>');
                    redirect('mahasiswa/laporan');
                }
            } else { //untuk laporan mingguan dan laporan harian

                //rules 
                $this->form_validation->set_rules('uraian_kegiatan', 'Uraian Kegiatan', 'required');

                if ($this->form_validation->run() == false) { //jika tidak sesuai balik ke tambah laporan
                    $this->load->view('templates_mahasiswa/header', $this->data);
                    $this->load->view('templates_mahasiswa/sidebar');
                    $this->load->view('mahasiswa/laporan', $this->data);
                    $this->load->view('templates_mahasiswa/footer');
                } else { //jika sesuai maka simpan data ke database dari form view/page

                    $this->db->set('tipe_laporan', $tipe_laporan);
                    $this->db->set('uraian_kegiatan', $uraian_kegiatan);
                    $this->db->set('tanggal', $tanggal);
                    $this->db->set('tanggal_upload', $tanggal_upload);
                    $this->db->where('id_logbook', $id_logbook);
                    $this->db->update('logbook');

                    $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Your report has been edited!</div>');
                    redirect('mahasiswa/laporan');
                }
            }
        }
    }

    public function hapus_laporan($id_logbook)
    {
        $this->db->where('id_logbook', $id_logbook);
        if ($this->db->delete('logbook')) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" rol
            e="alert">Your report has been deleted!</div>');
            redirect('mahasiswa/laporan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" rol
            e="alert">Your report has not been deleted!</div>');
            redirect('mahasiswa/laporan');
        }
    }
}
