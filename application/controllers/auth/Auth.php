<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        //rules validasi
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        //menjalankan validasi
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates_auth/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates_auth/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();


        if ($user) {
            if ($password === $user['password']) {
                $data = [
                    'email' => $user['email'],
                    'role_id_role' => $user['role_id_role']
                ];

                $role =  $this->db->get_where('role', ['id_role' => $user['role_id_role']])->row_array();

                if ($role['nama_role'] == 'admin') {
                    $this->session->set_userdata($data);
                    redirect('admin/dashboard'); //tempat admin
                } elseif ($role['nama_role'] == 'mahasiswa') {
                    $this->session->set_userdata($data);
                    redirect('mahasiswa/beranda'); //tempat mahasiswa
                } elseif ($role['nama_role'] == 'mentor') {
                    $this->session->set_userdata($data);
                    redirect('mentor/dashboard'); //tempat mentor
                } elseif ($role['nama_role'] == 'kaprodi') {
                    $this->session->set_userdata($data);
                    redirect('kaprodi/dashboard'); //tempat dosen
                } elseif ($role['nama_role'] == 'dospem') {
                    $this->session->set_userdata($data);
                    redirect('dospem/dashboard'); //tempat dospem
                }
            } else {
                // Jika password salah
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                redirect('auth'); // kembali ke halaman login
            }
        } else {
            // Jika user tidak ditemukan
            $this->session->set_flashdata('message', '<div class="alert 
            alert-danger" role="alert">Email is not registered!</div>');
            redirect('auth'); // kembali ke halaman login
        }
    }

    public function logout()
    {
        // Unset session data
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id_role');

        // Set flash message untuk notifikasi logout
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');

        // Redirect ke halaman login
        redirect('auth'); // Kembali ke halaman login
    }
}
