<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Status extends CI_Controller {

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
		$this->template->load('overview', 'masterdata/product_status/v_status');
	}

    public function getNo()
	{
		$data = $this->m_status->codeNum();
		echo json_encode($data);
	}

    public function getAll()
	{
		$list = $this->m_status->list();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->status_code;
			$row[] = $value->status_name;
            $row[] = $value->status_nickname;
			$row[] = date('m/d/Y (H:i:s)', strtotime($value->status_created_at));
			$row[] = $value->status_created_by;
			if($value->status_isactive == 'Y'){
				$row[] = '<center><span class="label label-success">Aktif</span></center>';
			} else {
				$row[] = '<center><span class="label label-danger">Nonaktif</span></center>';
			}

			$row[] = '<center><div>
				<a class="btn btn-primary btn-xs" onclick="detailStatus('."'".$value->status_id."'".')" title="Edit"><i class="fa fa-edit"></i></a>
				</center>';
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}

    public function actAdd()
	{
		$this->form_validation->set_rules('status_code','Status Code', 'required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('status_name','Status Name', 'required',array('required' => 'Please enter the %s.'));
        $this->form_validation->set_rules('status_nickname','Status Nick Name', 'required',array('required' => 'Please enter the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_status->save();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'status_code_error' 	=> form_error('status_code'),
				'status_name_error' 	=> form_error('status_name'),
                'status_nickname_error' => form_error('status_nickname')
			);
		}
		echo json_encode($data);
	}

    public function getDetail($id)
	{
		$data = $this->m_status->detail($id);
		echo json_encode($data);
	}

    public function actEdit()
	{
		$this->form_validation->set_rules('status_code','Status Code', 'required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('status_name','Status Name', 'required',array('required' => 'Please enter the %s.'));
        $this->form_validation->set_rules('status_nickname','Status Nick Name', 'required',array('required' => 'Please enter the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_status->update();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'status_code_error' 	=> form_error('status_code'),
				'status_name_error' 	=> form_error('status_name'),
                'status_nickname_error' => form_error('status_nickname')
			);
		}
		echo json_encode($data);
	}

    public function getStatus()
	{
		$data = $this->m_status->setStatus();
		echo json_encode($data);
	}

}
