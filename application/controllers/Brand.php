<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Brand extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_brand');
		cek_login();
		if (!is_controller()) {
            redirect('dashboard');
        }
	}

	public function index()
	{
		$this->template->load('overview', 'masterdata/brand/v_brand');
	}

	public function getNo()
	{
		$data = $this->m_brand->codeNum();
		echo json_encode($data);
	}

	public function getAll()
	{
		$list = $this->m_brand->list();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->brand_code;
			$row[] = $value->brand_name;
			$row[] = date('m/d/Y (H:i:s)', strtotime($value->brand_created_at));
			$row[] = $value->brand_created_by;
			if($value->brand_isactive == 'Y'){
				$row[] = '<center><span class="label label-success">Aktif</span></center>';
			} else {
				$row[] = '<center><span class="label label-danger">Nonaktif</span></center>';
			}

			$row[] = '<center><div>
				<a class="btn btn-primary btn-xs" onclick="detailBrand('."'".$value->brand_id."'".')" title="Edit"><i class="fa fa-edit"></i></a>
				</center>';
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}

	public function actAdd()
	{
		$this->form_validation->set_rules('brand_code','Brand Code', 'required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('brand_name','Brand Name', 'required',array('required' => 'Please enter the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_brand->save();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'brand_code_error' 	=> form_error('brand_code'),
				'brand_name_error' 	=> form_error('brand_name')
			);
		}
		echo json_encode($data);
	}

	public function getDetail($id)
	{
		$data = $this->m_brand->detail($id);
		echo json_encode($data);
	}

	public function actEdit()
	{
		$this->form_validation->set_rules('brand_code','Brand Code', 'required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('brand_name','Brand Name', 'required',array('required' => 'Please enter the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_brand->update();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'brand_code_error' 	=> form_error('brand_code'),
				'brand_name_error' 	=> form_error('brand_name')
			);
		}
		echo json_encode($data);
	}

	public function getBrand()
	{
		$data = $this->m_brand->setBrand();
		echo json_encode($data);
	}
}
