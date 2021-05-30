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
	// public function exportExcel(){
	// 	$data['product_movement'] = $this->m_movement->product_movement();
	// 	require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
	// 	require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

	// 	$excel = new PHPExcel();
	// 	$excel->getProperties()->setCreator("Sas_Asset");
	// 	$excel->getProperties()->setLastModifiedBy("Sas_Asset");
	// 	$excel->getProperties()->setTitle("Product Movement");
	// 	$excel->setActiveSheetIndex(0);

	// 	$excel->getActiveSheet()->setCellValue('A1','NO');
	// 	$excel->getActiveSheet()->setCellValue('B1','Movement Code');
	// 	$excel->getActiveSheet()->setCellValue('C1','Receipt Code');
	// 	$excel->getActiveSheet()->setCellValue('D1','Movement Date');
	// 	$excel->getActiveSheet()->setCellValue('E1','Product');
	// 	$excel->getActiveSheet()->setCellValue('F1','IsNew');
	// 	$excel->getActiveSheet()->setCellValue('G1','From Branch');
	// 	$excel->getActiveSheet()->setCellValue('H1','To Branch');
	// 	$excel->getActiveSheet()->setCellValue('I1','From Division');
	// 	$excel->getActiveSheet()->setCellValue('J1','To Division');
	// 	$excel->getActiveSheet()->setCellValue('K1','Document Status');
	// 	$excel->getActiveSheet()->setCellValue('L1','Description');

	// 	$baris = 2;
	// 	$no = 1;
	// 	foreach($data['product_movement'] as $dataExcel){
	// 		$excel->getActiveSheet()->setCellValue('A'.$baris,$no++);
	// 		$excel->getActiveSheet()->setCellValue('B'.$baris,$dataExcel->movement_code);
	// 		$excel->getActiveSheet()->setCellValue('C'.$baris,$dataExcel->receipt_code);
	// 		$excel->getActiveSheet()->setCellValue('D'.$baris,$dataExcel->movement_date);
	// 		$excel->getActiveSheet()->setCellValue('E'.$baris,$dataExcel->product_name);
	// 		$excel->getActiveSheet()->setCellValue('F'.$baris,$dataExcel->is_new);
	// 		$excel->getActiveSheet()->setCellValue('G'.$baris,$dataExcel->from_branch);
	// 		$excel->getActiveSheet()->setCellValue('I'.$baris,$dataExcel->from_division);
	// 		$excel->getActiveSheet()->setCellValue('H'.$baris,$dataExcel->to_branch);
	// 		$excel->getActiveSheet()->setCellValue('J'.$baris,$dataExcel->to_division);
	// 		$excel->getActiveSheet()->setCellValue('K'.$baris,$dataExcel->movement_status);
	// 		$excel->getActiveSheet()->setCellValue('L'.$baris,$dataExcel->description);
	// 		$baris++;
	// 	}
	// 	$excel-> getActiveSheet()->setTitle("Product Movement");
	// 	header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	// 	header('Content-Disposition: attachment;filename="Product_Movement.xls"');
	// 	header('Cache-Control: max-age=0');
	// 	$writer = PHPExcel_IOFactory::createwriter($excel, 'Excel2007');
	// 	$writer->save('php://output');
	// 	exit;

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
