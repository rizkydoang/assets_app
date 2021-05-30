<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Type extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_category');
		// $this->load->model('m_subcategory');
		$this->load->model('m_type');
		cek_login();
		if (!is_controller()) {
            redirect('dashboard');
        }
	}

// belum di setting di m_category
	public function index()
	{
		$data['parent']= $this->m_category->listCategory();
		$this->template->load('overview', 'masterdata/type/v_type', $data);
	}

	public function getNo()
	{
		$data = $this->m_type->codeNum();
		echo json_encode($data);
	}

	public function getAll()
	{
		$list = $this->m_type->list();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->type_code;
			$row[] = $value->type_name;
			// $row[] = $value->subcategory_name;
			$row[] = $value->category_name;
			$row[] = $value->type_created_at;
			$row[] = $value->type_created_by;
			if($value->type_isactive == 'Y'){
				$row[] = '<center><span class="label label-success">Aktif</span></center>';
			} else {
				$row[] = '<center><span class="label label-danger">Nonaktif</span></center>';
			}

			$row[] = '<center><div>
				<a class="btn btn-primary btn-xs" onclick="detailType('."'".$value->type_id."'".')" title="Edit"><i class="fa fa-edit"></i></a>
				</center>';
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}

	public function actAdd()
	{
		$this->form_validation->set_rules('type_code','type code','required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('type_name','type name','required',array('required' => 'Please enter the %s.'));
		// $this->form_validation->set_rules('subcategory_id','sub category name','required',array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('category_id','category name','required',array('required' => 'Please select the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_type->save();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 					=> true,
				'type_code_error' 	=> form_error('type_code'),
				'type_name_error' 	=> form_error('type_name'),
				// 'subcategory_id_error' 			=> form_error('subcategory_id')
				'category_id_error' 			=> form_error('category_id')
			);
		}
		echo json_encode($data);
	}

	public function getDetail($id)
	{
		$data = $this->m_type->detail($id);
		echo json_encode($data);
	}

	public function actEdit()
	{
		$this->form_validation->set_rules('type_code','type code','required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('type_name','type name','required',array('required' => 'Please enter the %s.'));
		// $this->form_validation->set_rules('subcategory_id','sub category name','required',array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('category_id','category name','required',array('required' => 'Please select the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_type->update();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'type_code_error' 	=> form_error('type_code'),
				'type_name_error' 	=> form_error('type_name'),
				'category_id_error' => form_error('category_id')
			);
		}
		echo json_encode($data);
	}

	// public function getCategory()
	// {
	// 	$data = $this->m_category->setCategory();
	// 	echo json_encode($data);
	// }

	// public function getSubcategory()
	// {
	// 	$data = $this->m_subcategory->setSubcategory();
	// 	echo json_encode($data);
	// }

	public function getType()
	{
		$data = $this->m_type->setType();
		echo json_encode($data);
	}
}
