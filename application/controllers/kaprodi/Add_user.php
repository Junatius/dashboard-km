<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Add_user extends CI_Controller
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

        $this->data['instansi'] = $this->db->get('instansi')->result_array();
        $this->data['program_studi'] = $this->db->get('program_studi')->result_array();
        $this->data['role'] = $this->db->get('role')->result_array();

        $this->db->select('detail_program.*, instansi.*, program_km.*', 'mahasiswa');
        $this->db->from('detail_program');
        $this->db->join('instansi', 'detail_program.instansi_id_instansi = instansi.id_instansi');
        $this->db->join('program_km', 'detail_program.program_km_id_programkm = program_km.id_programkm');
        $this->data['list_detailprogram'] = $this->db->get()->result_array();
    }

    public function index()
    {

        $this->form_validation->set_rules('role', 'Role', 'trim|required');

        if ($this->form_validation->run() == false) {
            //ambil ambil data user
            $this->data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();

            //untuk mengambil data user untuk semua data dalam mahasiswa
            $this->data['profil'] = $this->db->get_where('kaprodi', ['user_id_user' => $this->data['user']['id_user']])->row_array();

            $this->data['title'] = 'Add User';
            $this->load->view('templates_kaprodi/header', $this->data);
            $this->load->view('templates_kaprodi/sidebar');
            $this->load->view('kaprodi/add_user', $this->data);
            $this->load->view('templates_kaprodi/footer');
        } else {

            if ($this->input->post('role') == 1) {

                $this->form_validation->set_rules('nama_mahasiswa', 'Nama Lengkap', 'trim|required');
                $this->form_validation->set_rules('nim', 'Nim', 'trim|required');
                $this->form_validation->set_rules('ipk', 'IPK', 'trim|required');
                $this->form_validation->set_rules('jenis_kelamin_mahasiswa', 'Jenis Kelamin', 'trim|required');
                $this->form_validation->set_rules('email_mahasiswa', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password_mahasiswa', 'Password', 'trim|required');
                $this->form_validation->set_rules('detail_program', 'Detail Program', 'trim|required');

                if ($this->form_validation->run() == false) {
                    //ambil ambil data user
                    $this->data['user'] = $this->db->get_where('user', ['email' =>
                    $this->session->userdata('email')])->row_array();

                    //untuk mengambil data user untuk semua data dalam mahasiswa
                    $this->data['profil'] = $this->db->get_where('kaprodi', ['user_id_user' => $this->data['user']['id_user']])->row_array();

                    $this->data['title'] = 'Add User';
                    $this->load->view('templates_kaprodi/header', $this->data);
                    $this->load->view('templates_kaprodi/sidebar');
                    $this->load->view('kaprodi/add_user', $this->data);
                    $this->load->view('templates_kaprodi/footer');
                } else {
                    $profil = $this->db->get_where('kaprodi', ['user_id_user' => $this->data['user']['id_user']])->row_array();
                    $cek_email = $this->db->get_where('user', ['email' => $this->input->post('email_mahasiswa')])->row_array();

                    if ($cek_email) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Sudah Digunakan!</div>');
                        redirect('kaprodi/add_user');
                    } else {
                        $data = [
                            'email' => $this->input->post('email_mahasiswa'),
                            'password' => $this->input->post('password_mahasiswa'),
                            'role_id_role' => $this->input->post('role')
                        ];

                        // Mulai transaksi
                        $this->db->trans_start();

                        $this->db->insert('user', $data);

                        $email = $this->input->post('email_mahasiswa');
                        $user = $this->db->get_where('user', ['email' => $email])->row_array();
                        if ($user) {
                            $data = [
                                'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
                                'nim' => $this->input->post('nim'),
                                'ipk' => $this->input->post('ipk'),
                                'jenis_kelamin' => $this->input->post('jenis_kelamin_mahasiswa'),
                                'program_studi_id_prodi' => $profil['program_studi_id_prodi'],
                                'user_id_user' => $user['id_user'],
                                'detail_program_id_detailprogram' => $this->input->post('detail_program'),
                            ];
                            $this->db->insert('mahasiswa', $data);

                            // Selesaikan transaksi
                            $this->db->trans_complete();

                            if ($this->db->trans_status() === FALSE) {
                                $this->db->trans_rollback();
                                // Jika transaksi gagal
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User Mahasiswa has not been added!</div>');
                            } else {
                                // Jika transaksi berhasil
                                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Mahasiswa has been added!</div>');
                            }
                            redirect('kaprodi/add_user');
                        } else {
                            // Jika transaksi gagal
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Tidak Berhasil!</div>');
                            redirect('kaprodi/add_user');
                        }
                    }
                }

                //dospem
            } elseif ($this->input->post('role') == 5) {

                $this->form_validation->set_rules('nama_lengkap_dospem', 'Nama Lengkap', 'trim|required');
                $this->form_validation->set_rules('nip_dospem', 'NIP', 'trim|required');
                $this->form_validation->set_rules('jenis_kelamin_dospem', 'Jenis Kelamin', 'trim|required');
                $this->form_validation->set_rules('email_dospem', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password_dospem', 'Password', 'trim|required');

                if ($this->form_validation->run() == false) {
                    //ambil ambil data user
                    $this->data['user'] = $this->db->get_where('user', ['email' =>
                    $this->session->userdata('email')])->row_array();

                    //untuk mengambil data user untuk semua data dalam mahasiswa
                    $this->data['profil'] = $this->db->get_where('kaprodi', ['user_id_user' => $this->data['user']['id_user']])->row_array();

                    $this->data['title'] = 'Add User';
                    $this->load->view('templates_kaprodi/header', $this->data);
                    $this->load->view('templates_kaprodi/sidebar');
                    $this->load->view('kaprodi/add_user', $this->data);
                    $this->load->view('templates_kaprodi/footer');
                } else {
                    $profil = $this->db->get_where('kaprodi', ['user_id_user' => $this->data['user']['id_user']])->row_array();
                    $cek_email = $this->db->get_where('user', ['email' => $this->input->post('email_dospem')])->row_array();

                    if ($cek_email) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Sudah Digunakan!</div>');
                        redirect('kaprodi/add_user');
                    } else {
                        $data = [
                            'email' => $this->input->post('email_dospem'),
                            'password' => $this->input->post('password_dospem'),
                            'role_id_role' => $this->input->post('role')
                        ];

                        // Mulai transaksi
                        $this->db->trans_start();

                        $this->db->insert('user', $data);

                        $email = $this->input->post('email_dospem');
                        $user = $this->db->get_where('user', ['email' => $email])->row_array();
                        if ($user) {
                            $data = [
                                'nama_dospem' => $this->input->post('nama_lengkap_dospem'),
                                'nip' => $this->input->post('nip_dospem'),
                                'jenis_kelamin' => $this->input->post('jenis_kelamin_dospem'),
                                'program_studi_id_prodi' => $profil['program_studi_id_prodi'],
                                'user_id_user' => $user['id_user'],
                            ];
                            $this->db->insert('dosen_pembimbing', $data);

                            // Selesaikan transaksi
                            $this->db->trans_complete();

                            if ($this->db->trans_status() === FALSE) {
                                $this->db->trans_rollback();
                                // Jika transaksi gagal
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User Dosen Pembimbing has not been added!</div>');
                            } else {
                                // Jika transaksi berhasil
                                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Dosen Pembimbing has been added!</div>');
                            }
                            redirect('kaprodi/add_user');
                        } else {
                            // Jika transaksi gagal
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Tidak Berhasil!</div>');
                            redirect('kaprodi/add_user');
                        }
                    }
                }
            }
        }
    }
}
