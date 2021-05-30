<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('m_user');
    }

    private function _has_login()
    {
        if ($this->session->has_userdata('login_session')) {
            redirect('dashboard');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('login_session');

        set_pesan('Berhasil Logout');
        redirect('auth');
    }

    public function index(){
        $this->_has_login();

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = "PT. Sahabat Abadi Sejahtera | Login";
            $this->template->load('auth/master', 'auth/login', $data);
        }else{
            $input = $this->input->post(null, true);

            $cek_user = $this->m_user->cek_user($input['username']);

            if($cek_user > 0 ){
                $password = $this->m_user->get_password($input['username']);
                if (password_verify($input['password'],$password) == true) {
                    $user_db = $this->m_user->userdata($input['username']);
                    if ($user_db['user_isactive'] != 'Y') {
                        set_pesan('Akun Belum Diaktifkan.', false);
                        redirect('auth');
                    } else {
                        $userdata = [
                            'user'  => $user_db['user_id'],
                            'user_name'  => $user_db['user_name'],
                            'divisi'  => $user_db['division_id'],
                            'branch_name'  => $user_db['branch_name'],
                            'division_name'  => $user_db['division_name'],
                            'timestamp' => time()
                        ];
                        $this->session->set_userdata('login_session', $userdata);
                        redirect('dashboard');
                    }
                } else {
                    set_pesan('Password Anda Salah', false);
                    redirect('auth');
                }
            } else{
                set_pesan('Akun Belum Di Daftarkan', false);
                redirect('auth');
            }
        }
    }
}
