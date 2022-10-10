<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('role_id')) {
            if ($this->session->userdata('role_id') == 1) {
                redirect('admin/dashboard');
            } else if ($this->session->userdata('role_id') == 2) {
                redirect('user/dashboard');
            } else if ($this->session->userdata('role_id') == 3) {
                redirect('user/dashboard');
            }
        }
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('password', 'Password');
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else { //validasi sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) { //jika login dengan HANKAM
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'image' => $user['image'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if ($data['role_id'] == 1) {
                    redirect('admin/dashboard');
                } else if ($data['role_id'] == 2) {
                    redirect('user/dashboard');
                } else if ($data['role_id'] == 3) {
                    redirect('user/dashboard');
                }
            } else { //salah password
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password salah!
                </div>');
                $this->session->set_flashdata('email', $email);
                redirect('auth');
            }
        } else { //belum registrasi
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Akun anda belum terdaftar!
             </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('image');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Logout!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
