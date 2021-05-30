<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_branch');
		$this->load->model('m_division');
		$this->load->model('m_user');
		cek_login();
		if (!is_controller()) {
            redirect('dashboard');
        }
	}

	public function index()
	{
		$data['parent_branch']= $this->m_branch->listBranch();
		$data['parent_division']= $this->m_division->listDivision();
		$this->template->load('overview', 'masterdata/user/v_user', $data);
	}

	public function getNo()
	{
		$data = $this->m_user->sequence_num();
		echo json_encode($data);
	}

	public function getAll()
	{
		$list = $this->m_user->user_joinlist();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->user_code;
			$row[] = $value->user_name;
			// $row[] = $value->password;
 			$row[] = $value->branch_name;
			$row[] = $value->division_name;
			// $row[] = $value->room_name;
			if($value->user_isactive == 'Y'){
				$row[] = '<center><span class="label label-success">Aktif</span></center>';
			} else {
				$row[] = '<center><span class="label label-danger">Nonaktif</span></center>';
			}
			$row[] = '<center><div>
				<a class="btn btn-primary btn-xs" onclick="detailUser('."'".$value->user_id."'".')" title="Edit"><i class="fa fa-edit"></i></a>
				</center>';
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}

	public function actAdd()
	{
		$this->form_validation->set_rules('user_code','user code', 'required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('user_name','user name', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('password','password', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_id_user','Branch', 'required',array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('division_id_user','Division', 'required',array('required' => 'Please select the %s.'));
		// $this->form_validation->set_rules('room_id_user','Room Name', 'required',array('required' => 'Please select the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_user->create();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 									=> true,
				'user_code_error' 				=> form_error('user_code'),
				'user_name_error' 				=> form_error('user_name'),
				'password_error' 				=> form_error('password'),
				'branch_id_user_error' 		=> form_error('branch_id_user'),
				'division_id_user_error' 	=> form_error('division_id_user'),
				// 'room_id_user_error' 			=> form_error('room_id_user')
			);
		}
		echo json_encode($data);
	}

	public function getDetail($id)
	{
		$data = $this->m_user->read($id);
		echo json_encode($data);
	}

	public function actEdit()
	{
		$this->form_validation->set_rules('user_code','user code', 'required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('user_name','user name', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('password','password', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_id_user','Branch', 'required',array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('division_id_user','Division', 'required',array('required' => 'Please select the %s.'));
		// $this->form_validation->set_rules('room_id_user','Room Name', 'required',array('required' => 'Please select the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_user->update();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = array(
				'error' 									=> true,
				'user_code_error' 				=> form_error('user_code'),
				'user_name_error' 				=> form_error('user_name'),
				'password_error' 				=> form_error('password'),
				'branch_id_user_error' 		=> form_error('branch_id_user'),
				'division_id_user_error' 	=> form_error('division_id_user'),
				// 'room_id_user_error' 			=> form_error('room_id_user')
			);
		}
		echo json_encode($data);
	}
}
