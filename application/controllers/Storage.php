<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Storage extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('m_status');
		cek_login();
		if (!is_controller()) {
            redirect('dashboard');
        }
	}

    public function index()
	{
		$this->template->load('overview', 'warehouse/storage/v_storage');
	}
}
