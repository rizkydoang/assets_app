<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Rpt_movement extends CI_Controller {

	// function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->model('m_product');
	// 	$this->load->model('m_movement');
    //     cek_login();
	// }

	// public function index()
	// {
	// 	$data['parent_product']		= $this->m_product->listProduct();
	// 	$data['parent_movement']	= $this->m_movement->listMovement();
	// 	$this->template->load('overview', 'report/movement/v_movement');
	// }

	// public function rpt_product_movement()
	// {
	// 	// $data['rpt_movement'] = $this->m_movement->displayMvmentBasedonDivision();
	// 	$data = $this->m_movement->product_movement('2020-01-01','2022-01-01');
	// 	var_dump($data);
	// }

	// public function getAll()
	// {
	// 	$list = $this->m_movement->rptlist();
	// 	$data = array();
	// 	foreach ($list as $value) {
	// 		$row = array();
	// 		$row[] = $value->movement_code;
	// 		$row[] = $value->movement_date;	
	// 		$row[] = $value->movement_created_at;
	// 		$row[] = $value->movement_created_by;
	// 		$row[] = $value->movement_isactive;
	// 		if($value->movement_status == 'Y'){
	// 			$row[] = '<center><span class="label label-success">Completed</span></center>';
	// 		} else if($value->movement_status == 'N'){
	// 			$row[] = '<center><span class="label label-danger">Voided</span></center>';
	// 		} else {
	// 			$row[] = '<center><span class="label label-default">In Progress</span></center>';
	// 		}

	// 		if($value->movement_status == 'Y'){
	// 			$row[] = '<center>
	// 									<div><a class="btn btn-primary btn-xs" onclick="detailMovement('."'".$value->movement_id."'".')" title="View"><i class="fa fa-search"></i></a></div>
	// 								</center>';
	// 		} else if($value->movement_status == 'N'){
	// 			$row[] = '<center>
	// 									<div><a class="btn btn-primary btn-xs" onclick="detailMovement('."'".$value->movement_id."'".')" title="View"><i class="fa fa-search"></i></a></div>
	// 								</center>';
	// 		} else {
	// 			$row[] = '<center>
	// 									<div><a class="btn btn-primary btn-xs" onclick="editMovement('."'".$value->movement_id."'".')" title="Edit"><i class="fa fa-edit"></i></a> <a class="btn btn-danger btn-xs" onclick="deleteMovement('."'".$value->movement_id."'".')" title="Delete"><i class="fa fa-times"></i></a> <a class="btn btn-success btn-xs" onclick="completeMovement('."'".$value->movement_id."'".')" title="Complete"><i class="fa fa-check"></i></a> </div>
	// 								</center>';
	// 		}
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
	

	// public function viewReport()
	// {
	// 	$this->form_validation->set_rules('date_from_rm','date from', 'required',array('required' => 'Please select the %s.'));
	// 	$this->form_validation->set_rules('date_to_rm','date to', 'required',array('required' => 'Please select the %s.'));
	// 	if($this->form_validation->run()){
	// 		$product_id 	= $this->input->post('product_id');
	// 		$movement_id 	= $this->input->post('movement_id');
	// 		$date_from 		= $this->input->post('date_from_rm');
	// 		$date_to 		= $this->input->post('date_to_rm');
	// 		$data = $this->m_movement->viewRptMovement($product_id,$movement_id,$date_from,$date_to);
	// 	} else {
	// 		$data = array(
	// 			'error' 		=> true,
	// 			'date_from_rm_error' 	=> form_error('date_from_rm'),
	// 			'date_to_rm_error' 	=> form_error('date_to_rm')
	// 		);
	// 	}
	// 	echo json_encode($data);
	// }
}
