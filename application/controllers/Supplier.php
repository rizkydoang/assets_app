<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Supplier extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_supplier');
		cek_login();
		if (!is_controller()) {
            redirect('dashboard');
        }
	}

	public function index()
	{
		$this->template->load('overview', 'masterdata/supplier/v_supplier');
	}

	public function getNo()
	{
		$data = $this->m_supplier->codeNum();
		echo json_encode($data);
	}

	public function getAll()
	{
		$list = $this->m_supplier->list();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->supplier_code;
			$row[] = $value->supplier_name;
			$row[] = date('m/d/Y (H:i:s)', strtotime($value->supplier_created_at));
			$row[] = $value->supplier_created_by;
			if($value->supplier_isactive == 'Y'){
				$row[] = '<center><span class="label label-success">Aktif</span></center>';
			} else {
				$row[] = '<center><span class="label label-danger">Nonaktif</span></center>';
			}
			if($value->supplier_isvendor == 'Y'){
				$row[] = '<center><span class="label label-success">Yes</span></center>';
			} else {
				$row[] = '<center><span class="label label-danger">No</span></center>';
			}
			// if($value->supplier_isservice == 'Y'){
			// 	$row[] = '<center><span class="label label-success">Yes</span></center>';
			// } else {
			// 	$row[] = '<center><span class="label label-danger">No</span></center>';
			// }

			$row[] = '<center><div>
				<a class="btn btn-primary btn-xs" onclick="detailSupplier('."'".$value->supplier_id."'".')" title="Edit"><i class="fa fa-edit"></i></a>
				</center>';
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}

	public function actAdd()
	{
		$this->form_validation->set_rules('supplier_code','supplier code', 'required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('supplier_name','supplier name', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('supplier_address','supplier address', 'required',array('required' => 'Please enter the %s.'));
		// $this->form_validation->set_rules('supplier_owner','supplier owner', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('supplier_telephone','supplier contact number', 'required',array('required' => 'Please enter the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_supplier->save();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'supplier_code_error' 			=> form_error('supplier_code'),
				'supplier_name_error' 			=> form_error('supplier_name'),
				'supplier_address_error' 		=> form_error('supplier_address'),
				// 'supplier_owner_error' 			=> form_error('supplier_owner'),
				'supplier_telephone_error' 	=> form_error('supplier_telephone')
			);
		}
		echo json_encode($data);
	}

	public function getDetail($id)
	{
		$data = $this->m_supplier->detail($id);
		echo json_encode($data);
	}

	public function actEdit()
	{
		$this->form_validation->set_rules('supplier_code','supplier code', 'required|max_length[5]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('supplier_name','supplier name', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('supplier_address','supplier address', 'required',array('required' => 'Please enter the %s.'));
		// $this->form_validation->set_rules('supplier_owner','supplier owner', 'required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('supplier_telephone','supplier contact number', 'required',array('required' => 'Please enter the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_supplier->update();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'supplier_code_error' 			=> form_error('supplier_code'),
				'supplier_name_error' 			=> form_error('supplier_name'),
				'supplier_address_error' 		=> form_error('supplier_address'),
				// 'supplier_owner_error' 			=> form_error('supplier_owner'),
				'supplier_telephone_error' 	=> form_error('supplier_telephone')
			);
		}
		echo json_encode($data);
	}

	public function getSupplier()
	{
		$data = $this->m_supplier->setSupplier();
		echo json_encode($data);
	}
}
