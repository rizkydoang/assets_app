<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Product extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_brand');
		$this->load->model('m_category');
		// $this->load->model('m_subcategory');
		$this->load->model('m_type');
		$this->load->model('m_product');
		cek_login();
		if (!is_controller()) {
            redirect('dashboard');
        }
	}

	public function index()
	{
		$data['parent_brand']= $this->m_product->listBrand();
		$data['parent_category']= $this->m_product->listCategory();
		// $data['parent_subcategory']= $this->m_product->listSubcategory();
		$data['parent_type']= $this->m_product->listType();
		$this->template->load('overview', 'masterdata/product/v_product', $data);
	}
	public function getNo()
	{
		$data = $this->m_product->codeNum();
		echo json_encode($data);
	}

	public function getAll()
	{
		$list = $this->m_product->list();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->product_code;
			$row[] = $value->product_name;
			// $row[] = $value->brand_name;
			$row[] = $value->category_name;
			$row[] = $value->product_created_at;
			$row[] = $value->product_created_by;
			if($value->product_isactive == 'Y'){
				$row[] = '<center><span class="label label-success">Aktif</span></center>';
			} else {
				$row[] = '<center><span class="label label-danger">Nonaktif</span></center>';
			}

			$row[] = '<center><div>
				<a class="btn btn-primary btn-xs" onclick="detailProduct('."'".$value->product_id."'".')" title="Edit"><i class="fa fa-edit"></i></a>
				</center>';
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}

	public function actAdd()
	{
		$this->form_validation->set_rules('product_code','product code','required|max_length[7]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('product_name','product name','required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('brand_id_product','brand','required',array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('category_id_product','category','required',array('required' => 'Please select the %s.'));
		// $this->form_validation->set_rules('subcategory_id_product','sub category','required',array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('type_id_product','type','required',array('required' => 'Please select the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_product->save();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 					=> true,
				'product_code_error' 						=> form_error('product_code'),
				'product_name_error' 						=> form_error('product_name'),
				'brand_id_product_error' 				=> form_error('brand_id_product'),
				'category_id_product_error' 		=> form_error('category_id_product'),
				// 'subcategory_id_product_error'	=> form_error('subcategory_id_product'),
				'type_id_product_error' 				=> form_error('type_id_product')
			);
		}
		echo json_encode($data);
	}

	public function getDetail($id)
	{
		$data = $this->m_product->detail($id);
		echo json_encode($data);
	}

	public function actEdit()
	{
		$this->form_validation->set_rules('product_code','product code','required|max_length[7]',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('product_name','product name','required',array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('brand_id_product','brand','required',array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('category_id_product','category','required',array('required' => 'Please select the %s.'));
		// $this->form_validation->set_rules('subcategory_id_product','sub category','required',array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('type_id_product','type','required',array('required' => 'Please select the %s.'));

		if($this->form_validation->run()){
			$data = $this->m_product->update();
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = array(
				'error' 		=> true,
				'product_code_error' 						=> form_error('product_code'),
				'product_name_error' 						=> form_error('product_name'),
				'brand_id_product_error' 				=> form_error('brand_id_product'),
				'category_id_product_error' 		=> form_error('category_id_product'),
				// 'subcategory_id_product_error'	=> form_error('subcategory_id_product'),
				'type_id_product_error' 				=> form_error('type_id_product')
			);
		}
		echo json_encode($data);
	}

	public function getCategory()
	{
		$data = $this->m_category->setCategory();
		echo json_encode($data);
	}

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

	public function getProduct()
	{
		$data = $this->m_product->setProduct();
		echo json_encode($data);
	}


	public function actCategoryChange()
	{
		$category_id = $this->input->post('category_id_product');
    $data = $this->m_product->get_type($category_id);
		echo json_encode($data);
	}

	// public function actSubcategoryChange()
	// {
	// 	$subcategory_id = $this->input->post('subcategory_id_product');
    // $data = $this->m_product->get_type($subcategory_id);
	// 	echo json_encode($data);
	// }
}
