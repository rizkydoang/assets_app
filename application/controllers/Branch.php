<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Branch extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_branch');
		$this->load->model('m_user');
		cek_login();
		if (!is_controller()) {
            redirect('dashboard');
        }
	}

	public function index()
	{
		$data['branch_leader']= $this->m_branch->listUser();
		$this->template->load('overview', 'masterdata/branch/v_branch', $data);
		// $data = $this->m_branch->listUser();
		// echo json_encode($data);
	}

	public function getNo()
	{
		$data = $this->m_branch->codeNum();
		echo json_encode($data);
	}

	public function getAll()
	{
		$list = $this->m_branch->list();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->branch_code;
			$row[] = $value->branch_name;
			// $row[] = $value->branch_leader;
			$row[] = date('m/d/Y (H:i:s)', strtotime($value->branch_created_at));
			$row[] = $value->branch_created_by;
			if($value->branch_isactive == 'Y'){
				$row[] = '<center><span class="label label-success">Aktif</span></center>';
			} else {
				$row[] = '<center><span class="label label-danger">Nonaktif</span></center>';
			}

			$row[] = '<center><div>
				<a class="btn btn-primary btn-xs" onclick="detailBranch('."'".$value->branch_id."'".')" title="Edit"><i class="fa fa-edit"></i></a>
				</center>';
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}

	public function actAdd()
	{
		$this->form_validation->set_rules('branch_code','branch code', 'required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_name','branch name', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_address','branch address', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_leader_u_id','branch leader', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_telephone','branch contact number', 'required',array('required' => 'Please enter the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_branch->save();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'branch_code_error' 			=> form_error('branch_code'),
				'branch_name_error' 			=> form_error('branch_name'),
				'branch_address_error' 		=> form_error('branch_address'),
				'branch_leader_error' 		=> form_error('branch_leader_u_id'),
				'branch_telephone_error' 	=> form_error('branch_telephone')
			);
		}
		echo json_encode($data);
	}

	public function getDetail($id)
	{
		$data = $this->m_branch->detail($id);
		echo json_encode($data);
	}

	public function actEdit()
	{
		$this->form_validation->set_rules('branch_code','Branch Code', 'required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_name','branch name', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_address','branch address', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_leader_u_id','branch leader', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_telephone','branch contact number', 'required',array('required' => 'Please enter the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_branch->update();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'branch_code_error' 			=> form_error('branch_code'),
				'branch_name_error' 			=> form_error('branch_name'),
				'branch_address_error' 		=> form_error('branch_address'),
				'branch_leader_error' 		=> form_error('branch_leader_u_id'),
				'branch_telephone_error' 	=> form_error('branch_telephone')
			);
		}
		echo json_encode($data);
	}

	public function actDelete($id)
	{
		$data = $this->m_branch->delete($id);
		echo json_encode(array("status" => TRUE));
	}

	public function getBranch()
	{
		$data = $this->m_branch->setBranch();
		echo json_encode($data);
	}
}
