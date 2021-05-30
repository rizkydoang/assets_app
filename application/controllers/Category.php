<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Category extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_category');
		cek_login();
		if (!is_controller()) {
            redirect('dashboard');
        }
	}

	public function index()
	{
		$this->template->load('overview', 'masterdata/category/v_category');
	}

	public function getNo()
	{
		$data = $this->m_category->codeNum();
		echo json_encode($data);
	}

	public function getAll()
	{
		$list = $this->m_category->list();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->category_code;
			$row[] = $value->category_name;
			$row[] = date('m/d/Y (H:i:s)', strtotime($value->category_created_at));
			$row[] = $value->category_created_by;
			if($value->category_isactive == 'Y'){
				$row[] = '<center><span class="label label-success">Aktif</span></center>';
			} else {
				$row[] = '<center><span class="label label-danger">Nonaktif</span></center>';
			}

			$row[] = '<center><div>
				<a class="btn btn-primary btn-xs" onclick="detailCategory('."'".$value->category_id."'".')" title="Edit"><i class="fa fa-edit"></i></a>
				</center>';
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}

	public function actAdd()
	{
		$this->form_validation->set_rules('category_code','category code','required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('category_name','category name','required',array('required' => 'Please enter the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_category->save();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 				=> true,
				'category_code_error' 	=> form_error('category_code'),
				'category_name_error' 	=> form_error('category_name')
			);
		}
		echo json_encode($data);
	}

	public function getDetail($id)
	{
		$data = $this->m_category->detail($id);
		echo json_encode($data);
	}

	public function actEdit()
	{
		$this->form_validation->set_rules('category_code','category code','required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('category_name','category name','required',array('required' => 'Please enter the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_category->update();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'category_code_error' 	=> form_error('category_code'),
				'category_name_error' 	=> form_error('category_name')
			);
		}
		echo json_encode($data);
	}

	public function getCategory()
	{
		$data = $this->m_category->setCategory();
		echo json_encode($data);
	}
}
