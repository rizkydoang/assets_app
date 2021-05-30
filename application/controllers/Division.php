<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Division extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_division');
		$this->load->model('m_branch');
		$this->load->model('m_user');
		cek_login();
		if (!is_controller()) {
            redirect('dashboard');
        }
	}

	public function index()
	{
		$data['parent']= $this->m_branch->listBranch();
		$data['user']= $this->m_user->user_joinlist();
		$this->template->load('overview', 'masterdata/division/v_division', $data);
	}

	public function getNo()
	{
		$data = $this->m_division->codeNum();
		echo json_encode($data);
	}

	public function getAll()
	{
		$list = $this->m_division->list();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->division_code;
			$row[] = $value->division_name;
			$row[] = $value->branch_name;
			$row[] = $value->user_name;
			// $row[] = $value->division_manager_u_id;
			$row[] = date('m/d/Y (H:i:s)', strtotime($value->division_created_at));
			$row[] = $value->division_created_by;
			if($value->division_isactive == 'Y'){
				$row[] = '<center><span class="label label-success">Aktif</span></center>';
			} else {
				$row[] = '<center><span class="label label-danger">Nonaktif</span></center>';
			}

			$row[] = '<center><div>
				<a class="btn btn-primary btn-xs" onclick="detailDivision('."'".$value->division_id."'".')" title="Edit"><i class="fa fa-edit"></i></a>
				</center>';
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}

	public function actAdd()
	{
		$this->form_validation->set_rules('division_code','division code','required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('division_name','division name','required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_id','branch name','required',array('required' => 'Please select the %s.'));
		// $this->form_validation->set_rules('division_manager','division manager','required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('division_manager_u_id','division manager','required',array('required' => 'Please select the %s.'));
		
		if($this->form_validation->run()){
			$data = $this->m_division->save();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 				=> true,
				'division_code_error' 	=> form_error('division_code'),
				'division_name_error' 	=> form_error('division_name'),
				'branch_id_error' 			=> form_error('branch_id'),
				'division_manager_error'=> form_error('division_manager_u_id')
			);
		}
		echo json_encode($data);
	}

	public function getDetail($id)
	{
		$data = $this->m_division->detail($id);
		echo json_encode($data);
	}

	public function actEdit()
	{
		$this->form_validation->set_rules('division_code','division code','required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('division_name','division name','required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('branch_id','branch name','required',array('required' => 'Please select the %s.'));
		// $this->form_validation->set_rules('division_manager','division manager','required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('division_manager_u_id','division manager','required',array('required' => 'Please select the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_division->update();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'division_code_error' 	=> form_error('division_code'),
				'division_name_error' 	=> form_error('division_name'),
				'branch_id_error' 			=> form_error('branch_id'),
				'division_manager_error'=> form_error('division_manager_u_id')
			);
		}
		echo json_encode($data);
	}

	public function getDivision()
	{
		$data = $this->m_division->setdivision();
		echo json_encode($data);
	}


	public function getChartDivision()
	{
		$data = $this->m_division->chart_division();
		echo json_encode($data);
	}

	public function getChartDivisionCount()
	{
		$data = $this->m_division->chart_division_count();
		echo json_encode($data);
	}
}
