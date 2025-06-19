<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Monprofil_dospem extends CI_Controller
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

        $this->data['dospem'] = $this->db->select('*') // Select the columns you want
            ->from('dosen_pembimbing')
            ->join('program_studi', 'program_studi.id_prodi = dosen_pembimbing.program_studi_id_prodi')
            ->get()
            ->result(); // Fetch the result as an array of objects

        $this->data['detail_program'] = $this->db->select('*') // Select the columns you want
            ->from('detail_program')
            ->join('mahasiswa', 'mahasiswa.detail_program_id_detailprogram = detail_program.id_detailprogram')
            ->join('logbook', 'mahasiswa.id_mahasiswa = logbook.mahasiswa_id_mahasiswa', 'left')
            ->where('detail_program.status_kegiatan', 'Sedang Berjalan')
            ->order_by('id_mahasiswa')
            ->get()
            ->result_array(); // Fetch the result as an array of objects

        $this->data['mahasiswa_dospem'] = $this->db->select('*') // Select the columns you want
            ->from('mahasiswa')
            ->join('program_studi', 'program_studi.id_prodi = mahasiswa.program_studi_id_prodi')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.id_dosen_pembimbing = detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', 'left')
            ->where('detail_program.status_kegiatan', 'Sedang Berjalan')
            ->order_by('id_mahasiswa')
            ->get()
            ->result_array(); // Fetch the result as an array of objects

    }

    public function index()
    {
        $this->data['title'] = 'Monitoring dospem';
        $this->load->view('templates_admin/header', $this->data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/monprofil_dospem', $this->data);
        $this->load->view('templates_admin/footer');
    }

    public function viewprofil_dospem($id_dosen_pembimbing)
    {
        $this->data['informasi_dospem'] = $this->db->select([
            'dosen_pembimbing.*',
            'user.*',
            'role.*',
            'program_studi.*',
            'dosen_pembimbing.foto AS foto_dospem'
        ]) // Select the columns you want
            ->from('dosen_pembimbing')
            ->join('program_studi', 'program_studi.id_prodi = dosen_pembimbing.program_studi_id_prodi')
            ->join('user', 'user.id_user = dosen_pembimbing.user_id_user')
            ->join('role', 'role.id_role = user.role_id_role')
            ->where('dosen_pembimbing.id_dosen_pembimbing', $id_dosen_pembimbing)
            ->get()
            ->row_array(); // Fetch the result as an array of objects



        $this->data['title'] = 'View Profil dospem';
        $this->load->view('templates_admin/header', $this->data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/viewprofil_dospem', $this->data);
        $this->load->view('templates_admin/footer');
    }

    public function editprofil_dospem($id_dosen_pembimbing)
    {
        $this->data['informasi_dospem'] = $this->db->select([
            'dosen_pembimbing.*',
            'user.*',
            'role.*',
            'program_studi.*',
            'dosen_pembimbing.foto AS foto_dospem'
        ]) // Select the columns you want
            ->from('dosen_pembimbing')
            ->join('program_studi', 'program_studi.id_prodi = dosen_pembimbing.program_studi_id_prodi')
            ->join('user', 'user.id_user = dosen_pembimbing.user_id_user')
            ->join('role', 'role.id_role = user.role_id_role')
            ->where('dosen_pembimbing.id_dosen_pembimbing', $id_dosen_pembimbing)
            ->get()
            ->row_array(); // Fetch the result as an array of objects

        $this->data['list_role'] = $this->db->get('role')->result_array();
        $this->data['list_programstudi'] = $this->db->get('program_studi')->result_array();

        $dosen_pembimbing = $this->db->get_where('dosen_pembimbing', ['id_dosen_pembimbing' => $id_dosen_pembimbing])->row_array();
        $user_id_user = $dosen_pembimbing['user_id_user'];

        //rules validasi
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('nip', 'NIP', 'trim|required');
        $this->form_validation->set_rules('nama_role', 'Role', 'required');
        $this->form_validation->set_rules('program_studi', 'Program Studi', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() == false) {
            $this->data['title'] = 'Edit Profil dospem';
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/editprofil_dospem', $this->data);
            $this->load->view('templates_admin/footer');
        } else {
            $nama = $this->input->post('nama_lengkap');
            $nip = $this->input->post('nip');
            $role_id_role = $this->input->post('nama_role');
            $program_studi = $this->input->post('program_studi');
            $email = $this->input->post('email');
            $no_hp = $this->input->post('no_hp');
            $jenis_kelamin = $this->input->post('jenis_kelamin');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/template/img/profil/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('foto', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('admin/monprofil_dospem');
                }
            }

            // Mulai transaksi
            $this->db->trans_start();

            $this->db->set('nama_dospem', $nama);
            $this->db->set('nip', $nip);
            $this->db->set('no_hp', $no_hp);
            $this->db->set('jenis_kelamin', $jenis_kelamin);
            $this->db->set('program_studi_id_prodi', $program_studi);
            $this->db->where('id_dosen_pembimbing', $id_dosen_pembimbing);
            $this->db->update('dosen_pembimbing');

            $this->db->set('email', $email);
            $this->db->set('role_id_role', $role_id_role);
            $this->db->where('id_user', $user_id_user);
            $this->db->update('user');

            // Selesaikan transaksi
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                // Jika transaksi gagal
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dosen Pembimbing has not been updated!</div>');
            } else {
                // Jika transaksi berhasil
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dosen Pembimbing has been updated!</div>');
            }
            redirect('admin/monprofil_dospem');
        }
    }

    public function hapusprofil_dospem($id_dosen_pembimbing)
    {
        $dosen_pembimbing = $this->db->get_where('dosen_pembimbing', ['id_dosen_pembimbing' => $id_dosen_pembimbing])->row_array();
        $user_id_user = $dosen_pembimbing['user_id_user'];

        // Mulai transaksi
        $this->db->trans_start();

        $this->db->where('id_dosen_pembimbing', $id_dosen_pembimbing);
        $this->db->delete('dosen_pembimbing');

        $this->db->where('id_user', $user_id_user);
        $this->db->delete('user');

        // Selesaikan transaksi
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            // Jika transaksi gagal
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dosen Pembimbing has not been deleted!</div>');
        } else {
            // Jika transaksi berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dosen Pembimbing has been deleted!</div>');
        }

        redirect('admin/monprofil_dospem');
    }

    public function jumlahMahasiswa_dospem($id_dosen_pembimbing)
    {
        $this->data['mahasiswa'] = $this->db->select('*') // Select the columns you want
            ->from('mahasiswa')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram')
            ->join('program_studi', 'program_studi.id_prodi = mahasiswa.program_studi_id_prodi')
            ->join('program_km', 'program_km.id_programkm = detail_program.program_km_id_programkm')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.id_dosen_pembimbing = detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', 'left')
            ->where('dosen_pembimbing.id_dosen_pembimbing', $id_dosen_pembimbing)
            ->where('detail_program.status_kegiatan', 'Sedang Berjalan')
            ->get()
            ->result(); // Fetch the result as an array of objects

        $dosen_pembimbing = $this->db->get_where('dosen_pembimbing', ['id_dosen_pembimbing' => $id_dosen_pembimbing])->row_array();
        $this->data['nama_dospem'] = $dosen_pembimbing['nama_dospem'];

        $this->data['title'] = 'Monitoring Jumlah Mahasiswa Prodi';
        $this->load->view('templates_admin/header', $this->data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/admin_jumlahMahasiswa_dospem', $this->data);
        $this->load->view('templates_admin/footer');
    }
}
