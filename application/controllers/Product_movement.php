<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Product_movement extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_movement');
		$this->load->model('m_allreport');
		$this->load->model('m_division');
        cek_login();
	}

    public function index()
	{
		if($this->input->post('date_from') != null || $this->input->post('date_to') != null){
			if($this->input->post('from_division') !=null || $this->input->post('to_division') != null){
				$data['product_movement'] = $this->m_movement->product_movement($this->input->post('date_from'), $this->input->post('date_to'), $this->input->post('from_division'), $this->input->post('to_division'));
				$data['parent_division']= $this->m_division->listDivision();
				$this->template->load('overview', 'report/productmovement/v_productmovement', $data);
			}else{
				$data['product_movement'] = $this->m_movement->product_movement($this->input->post('date_from'), $this->input->post('date_to'));
				$data['parent_division']= $this->m_division->listDivision();
				$this->template->load('overview', 'report/productmovement/v_productmovement', $data);
			}
		}else{
			if($this->input->post('from_division') !=null || $this->input->post('to_division') != null){
				$data['product_movement'] = $this->m_movement->product_movement(null,null,$this->input->post('from_division'), $this->input->post('to_division'));
				$data['parent_division']= $this->m_division->listDivision();
				$this->template->load('overview', 'report/productmovement/v_productmovement', $data);
			}else{
				$data['product_movement'] = $this->m_movement->product_movement();
				$data['parent_division']= $this->m_division->listDivision();
				$this->template->load('overview', 'report/productmovement/v_productmovement', $data);
			}
		}
				// $data = $this->m_movement->product_movement();
				// echo json_encode($data);
	}

	public function productMovement()
	{
		$dateFrom = $this->input->get('date_from');
		$dateTo = $this->input->get('date_to');
		$from_division = $this->input->get('from_division');
		$to_division = $this->input->get('to_division');
		// $status = $this->input->get('movement_status');
		$list = $this->m_movement->product_movement($dateFrom, $dateTo, $from_division, $to_division);

		$data = array();
		$no = 1;
		foreach ($list as $value) {
			$row = array();
			$row[] = $no++;
			$row[] = $value->movement_code;
			$row[] = $value->receipt_code;
			$row[] = $value->movement_date;
			$row[] = $value->kode_aset;
			$row[] = $value->product_name;
			$row[] = $value->is_new;
			$row[] = $value->from_branch;
			$row[] = $value->from_division;
			$row[] = $value->to_branch;
			$row[] = $value->to_division;
			// $row[] = $value->movement_status;
			if($value->movement_status == 'Y'){
				$row[] = '<center><span class="label label-success">Completed</span></center>';
				
			} else if($value->movement_status == 'N'){
				$row[] = '<center><span class="label label-danger">Voided</span></center>';
			} else {
				$row[] = '<center><span class="label label-default">In Progress</span></center>';
			}
			$row[] = $value->description;
			$data[] = $row;

		}
		$result = array('data' => $data );
		echo json_encode($result);
	}


	public function ProductMovementexportExcel(){
		// $data['product_movement'] = $this->m_movement->product_movement();
		$dateFrom = $this->input->post('date_from');
		$dateTo = $this->input->post('date_to');
		$from_division = $this->input->post('from_division');
		$to_division = $this->input->post('to_division');
		// $status = $this->input->get('movement_status');
		$list = $this->m_movement->product_movement($dateFrom, $dateTo, $from_division, $to_division);
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Product Movement');

		$sheet->setCellValue('A1','NO');
		$sheet->setCellValue('B1','Movement Code');
		$sheet->setCellValue('C1','Receipt Code');
		$sheet->setCellValue('D1','Movement Date');
		$sheet->setCellValue('E1','Product');
		$sheet->setCellValue('F1','IsNew');
		$sheet->setCellValue('G1','From Branch');
		$sheet->setCellValue('H1','To Branch');
		$sheet->setCellValue('I1','From Division');
		$sheet->setCellValue('K1','Document Status');
		$sheet->setCellValue('L1','Description');
		// $sheet->setCellValue('J1','Profit Center');
		$sheet->getStyle('A1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('808080');
		$sheet->getStyle('A1:L1')->getFont()->setBold(true);
		$sheet->getStyle('A1:L1')->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$sheet->getStyle('A1:L1')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$sheet->getStyle('A1:L1')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$sheet->getStyle('A1:L1')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$sheet->getStyle('A1:L1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		/**
		 * Data excel
		 */

		$baris = 2;
		$no = 1;
		foreach($list as $dataExcel){
			$sheet->setCellValue('A'.$baris,$no++);
			$sheet->setCellValue('B'.$baris,$dataExcel->movement_code);
			$sheet->setCellValue('C'.$baris,$dataExcel->receipt_code);
			$sheet->setCellValue('D'.$baris,$dataExcel->movement_date);
			$sheet->setCellValue('E'.$baris,$dataExcel->product_name);
			$sheet->setCellValue('F'.$baris,$dataExcel->is_new);
			$sheet->setCellValue('G'.$baris,$dataExcel->from_branch);
			$sheet->setCellValue('I'.$baris,$dataExcel->from_division);
			$sheet->setCellValue('H'.$baris,$dataExcel->to_branch);
			$sheet->setCellValue('J'.$baris,$dataExcel->to_division);
			$sheet->setCellValue('K'.$baris,$dataExcel->movement_status);
			if($dataExcel->movement_status == 'Y'){
				$sheet->setCellValue('K'.$baris,'Completed');				
			} else if($dataExcel->movement_status == 'N'){
				$sheet->setCellValue('K'.$baris,'Void');	
			} else {
				$sheet->setCellValue('K'.$baris,'In Progress');	
			} 
			$sheet->setCellValue('L'.$baris,$dataExcel->description);
			$baris++;
		}

		$writer = new Xlsx($spreadsheet);


		$filename = 'Product_Movement_Report.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
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

			// $row[] = '<center><div>
			// 	<a class="btn btn-primary btn-xs" onclick="detailDivision('."'".$value->division_id."'".')" title="Edit"><i class="fa fa-edit"></i></a>
			// 	</center>';
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);

	}

	

}