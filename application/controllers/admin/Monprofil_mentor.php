<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Monprofil_mentor extends CI_Controller
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

        $this->data['mentor'] = $this->db->select('*') // Select the columns you want
            ->from('mentor')
            ->join('instansi', 'instansi.id_instansi = mentor.instansi_id_instansi')
            ->get()
            ->result(); // Fetch the result as an array of objects

        $this->data['mahasiswa_mentor'] = $this->db->select('*') // Select the columns you want
            ->from('mahasiswa')
            ->join('program_studi', 'program_studi.id_prodi = mahasiswa.program_studi_id_prodi')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.id_dosen_pembimbing = detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', 'left')
            ->join('mentor', 'mentor.id_mentor = detail_program.mentor_id_mentor')
            ->where('detail_program.status_kegiatan', 'Sedang Berjalan')
            ->order_by('id_mahasiswa')
            ->get()
            ->result_array(); // Fetch the result as an array of objects
    }

    public function index()
    {

        $this->data['title'] = 'Monitoring Mentor';
        $this->load->view('templates_admin/header', $this->data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/monprofil_mentor', $this->data);
        $this->load->view('templates_admin/footer');
    }

    public function viewprofil_mentor($id_mentor)
    {
        $this->data['informasi_mentor'] = $this->db->select([
            'mentor.*',
            'instansi.*',
            'user.*',
            'role.*',
            'mentor.foto AS foto_mentor'
        ]) // Select the columns you want
            ->from('mentor')
            ->join('instansi', 'instansi.id_instansi = mentor.instansi_id_instansi')
            ->join('user', 'user.id_user = mentor.user_id_user')
            ->join('role', 'role.id_role = user.role_id_role')
            ->where('mentor.id_mentor', $id_mentor)
            ->get()
            ->row_array(); // Fetch the result as an array of objects

        $this->data['title'] = 'View Profil Mentor';
        $this->load->view('templates_admin/header', $this->data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/viewprofil_mentor', $this->data);
        $this->load->view('templates_admin/footer');
    }

    public function editprofil_mentor($id_mentor)
    {
        $this->data['informasi_mentor'] = $this->db->select([
            'mentor.*',
            'instansi.*',
            'user.*',
            'role.*',
            'mentor.foto AS foto_mentor'
        ]) // Select the columns you want
            ->from('mentor')
            ->join('instansi', 'instansi.id_instansi = mentor.instansi_id_instansi')
            ->join('user', 'user.id_user = mentor.user_id_user')
            ->join('role', 'role.id_role = user.role_id_role')
            ->where('mentor.id_mentor', $id_mentor)
            ->get()
            ->row_array(); // Fetch the result as an array of objects

        $this->data['list_role'] = $this->db->get('role')->result_array();
        $this->data['list_instansi'] = $this->db->get('instansi')->result_array();

        $mentor = $this->db->get_where('mentor', ['id_mentor' => $id_mentor])->row_array();
        $user_id_user = $mentor['user_id_user'];

        //rules validasi
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('nama_role', 'Role', 'trim|required');
        $this->form_validation->set_rules('personal_number', 'Personal Number', 'required');
        $this->form_validation->set_rules('nama_instansi', 'Instansi/Mitra', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() == false) {
            $this->data['title'] = 'Edit Profil Mentor';
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/editprofil_mentor', $this->data);
            $this->load->view('templates_admin/footer');
        } else {
            $nama = $this->input->post('nama_lengkap');
            $personal_number = $this->input->post('personal_number');
            $role_id_role = $this->input->post('nama_role');
            $instansi_id_instansi = $this->input->post('nama_instansi');
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
                    redirect('admin/monprofil_mentor');
                }
            }

            // Mulai transaksi
            $this->db->trans_start();

            $this->db->set('nama_mentor', $nama);
            $this->db->set('jenis_kelamin', $jenis_kelamin);
            $this->db->set('no_hp', $no_hp);
            $this->db->set('personal_number', $personal_number);
            $this->db->set('instansi_id_instansi', $instansi_id_instansi);
            $this->db->where('id_mentor', $id_mentor);
            $this->db->update('mentor');

            $this->db->set('email', $email);
            $this->db->set('role_id_role', $role_id_role);
            $this->db->where('id_user', $user_id_user);
            $this->db->update('user');

            // Selesaikan transaksi
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                // Jika transaksi gagal
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mentor has not been updated!</div>');
            } else {
                // Jika transaksi berhasil
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Mentor has been updated!</div>');
            }
            redirect('admin/monprofil_mentor');
        }
    }

    public function hapusprofil_mentor($id_mentor)
    {
        $mentor = $this->db->get_where('mentor', ['id_mentor' => $id_mentor])->row_array();
        $user_id_user = $mentor['user_id_user'];

        // Mulai transaksi
        $this->db->trans_start();

        $this->db->where('id_mentor', $id_mentor);
        $this->db->delete('mentor');

        $this->db->where('id_user', $user_id_user);
        $this->db->delete('user');

        // Selesaikan transaksi
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            // Jika transaksi gagal
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">mentor has not been deleted!</div>');
        } else {
            // Jika transaksi berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">mentor has been deleted!</div>');
        }

        redirect('admin/monprofil_mentor');
    }

    public function jumlahMahasiswa_mentor($id_mentor)
    {
        $this->data['mahasiswa'] = $this->db->select('*') // Select the columns you want
            ->from('mahasiswa')
            ->join('detail_program', 'detail_program.id_detailprogram = mahasiswa.detail_program_id_detailprogram')
            ->join('program_studi', 'program_studi.id_prodi = mahasiswa.program_studi_id_prodi')
            ->join('program_km', 'program_km.id_programkm = detail_program.program_km_id_programkm')
            ->join('instansi', 'instansi.id_instansi = detail_program.instansi_id_instansi')
            ->join('detail_dosen_pembimbing', 'detail_dosen_pembimbing.mahasiswa_id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.id_dosen_pembimbing = detail_dosen_pembimbing.dosen_pembimbing_id_dosen_pembimbing', 'left')
            ->join('mentor', 'mentor.id_mentor = detail_program.mentor_id_mentor')
            ->where('mentor.id_mentor', $id_mentor)
            ->where('detail_program.status_kegiatan', 'Sedang Berjalan')
            ->get()
            ->result(); // Fetch the result as an array of objects


        $this->data['title'] = 'Monitoring Jumlah Mahasiswa Prodi';
        $this->load->view('templates_admin/header', $this->data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/admin_jumlahMahasiswa_mentor', $this->data);
        $this->load->view('templates_admin/footer');
    }
}
