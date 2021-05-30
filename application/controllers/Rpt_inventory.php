<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Rpt_inventory extends CI_Controller {

	// function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->model('m_inventory');
    //     cek_login();
	// }

	// public function index()
	// {
	// 	$this->template->load('overview', 'report/inventory/v_inventory');
	// }

	// public function getAll()
	// {
	// 	$list = $this->m_inventory->all_list();
	// 	$data = array();
	// 	foreach ($list as $value) {
	// 		$row = array();
	// 		$row[] = '<input type="checkbox" name="vehicle1" value="Y">';
	// 		$row[] = $value->movements_details_asset_code;
	// 		$row[] = $value->product_name;
	// 		$row[] = $value->user_name;
	// 		$row[] = $value->room_name;
	// 		$row[] = $value->movement_created_by;
	// 		$data[] = $row;
	// 	}
	// 	$result = array('data' => $data );
	// 	echo json_encode($result);
	// }

	// public function getService()
	// {
	// 	$list = $this->m_inventory->service_list();
	// 	$data = array();
	// 	foreach ($list as $value) {
	// 		$row = array();
	// 		$row[] = '<input type="checkbox" name="vehicle1" value="Y">';
	// 		$row[] = $value->services_details_asset_code;
	// 		$row[] = $value->product_name;
	// 		$row[] = $value->service_date;
	// 		$row[] = $value->supplier_name;
	// 		$data[] = $row;
	// 	}
	// 	$result = array('data' => $data );
	// 	echo json_encode($result);
	// }

	// public function getTrash()
	// {
	// 	$list = $this->m_inventory->trash_list();
	// 	$data = array();
	// 	foreach ($list as $value) {
	// 		$row = array();
	// 		$row[] = '<input type="checkbox" name="vehicle1" value="Y">';
	// 		$row[] = $value->movements_details_asset_code;
	// 		$row[] = $value->product_name;
	// 		$row[] = $value->movement_created_by;
	// 		$row[] = $value->movement_created_at;
	// 		$data[] = $row;
	// 	}
	// 	$result = array('data' => $data );
	// 	echo json_encode($result);
	// }

	// public function getDetail($id)
	// {
	// 	$data = $this->m_product->detail($id);
	// 	echo json_encode($data);
	// }

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

	// public function getType()
	// {
	// 	$data = $this->m_type->setType();
	// 	echo json_encode($data);
	// }

	// public function getProduct()
	// {
	// 	$data = $this->m_product->setProduct();
	// 	echo json_encode($data);
	// }


	// public function actCategoryChange()
	// {
	// 	$category_id = $this->input->post('category_id_product');
    // $data = $this->m_product->get_subcategory($category_id);
	// 	echo json_encode($data);
	// }

	// public function actSubcategoryChange()
	// {
	// 	$subcategory_id = $this->input->post('subcategory_id_product');
    // $data = $this->m_product->get_type($subcategory_id);
	// 	echo json_encode($data);
	// }
}
