<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cost_center extends CI_Controller {

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
		$data['parent_division'] = $this->m_division->listDivision();
		$this->template->load('overview', 'report/costcenter/v_costcenter', $data);
	}

	public function getCostCenter()
	{
		$dateFrom = $this->input->get('date_from');
		$dateTo = $this->input->get('date_to');
		$division = $this->input->get('division');
		$list = $this->m_allreport->cost_center($dateFrom, $dateTo, $division);
		$data = array();
		$no = 1;
		foreach ($list as $value) {
			$row = array();
			$row[] = $no++;
			$row[] = $value->asset_code;
			$row[] = $value->product_name;
			$row[] = $value->product_brand;
			$row[] = $value->category_product;
			$row[] = $value->type_product;
			$row[] = $value->branch_name;
			$row[] = $value->division_name;
			$row[] = $value->product_cost_center;
			// $row[] = $value->product_profit_center;
			$data[] = $row;
		}
		$result = array('data' => $data);
		echo json_encode($result);
	}
	// {
		
	// 	if($this->input->post('date_from') != null || $this->input->post('date_to') != null){
	// 		if($this->input->post('division') != null){
	// 			$data['cost_center'] = $this->m_allreport->cost_center($this->input->post('date_from'), $this->input->post('date_to'), $this->input->post('division'));
	// 			$data['parent_division']= $this->m_division->listDivision();
	// 			$this->template->load('overview', 'report/costcenter/v_costcenter', $data);
	// 		}else{
	// 			$data['cost_center'] = $this->m_allreport->cost_center($this->input->post('date_from'), $this->input->post('date_to'),null);
	// 			$data['parent_division']= $this->m_division->listDivision();
	// 			$this->template->load('overview', 'report/costcenter/v_costcenter', $data);
	// 		}
	// 	}else{
	// 		if($this->input->post('division') != null){
	// 			$data['cost_center'] = $this->m_allreport->cost_center(null,null,$this->input->post('division'));
	// 			$data['parent_division']= $this->m_division->listDivision();
	// 			$this->template->load('overview', 'report/costcenter/v_costcenter', $data);
	// 		}else{
	// 			$data['cost_center'] = $this->m_allreport->cost_center();
	// 			$data['parent_division']= $this->m_division->listDivision();
	// 			$this->template->load('overview', 'report/costcenter/v_costcenter', $data);
	// 		}
	// 	}
	// }
	public function costCenterExportExcel(){
		// $data['costCenter'] = $this->m_allreport->cost_center();
		// $spreadsheet = new Spreadsheet();
		// $sheet = $spreadsheet->getActiveSheet();
		// $sheet->setTitle('Cost Report');
		$dateFrom = $this->input->post('date_from');
		$dateTo = $this->input->post('date_to');
		$division = $this->input->post('division');
		$list = $this->m_allreport->cost_center($dateFrom, $dateTo, $division);
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Cost Center');

		$sheet->setCellValue('A1','NO');
		$sheet->setCellValue('B1','Asset Code');
		$sheet->setCellValue('C1','Product');
		$sheet->setCellValue('D1','Brand');
		$sheet->setCellValue('E1','Category');
		$sheet->setCellValue('F1','Type');
		$sheet->setCellValue('G1','Branch');
		$sheet->setCellValue('H1','Division');
		$sheet->setCellValue('I1','Cost Center');
		// $sheet->setCellValue('J1','Profit Center');
		$sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('808080');
		$sheet->getStyle('A1:I1')->getFont()->setBold(true);
		$sheet->getStyle('A1:I1')->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$sheet->getStyle('A1:I1')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$sheet->getStyle('A1:I1')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$sheet->getStyle('A1:I1')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		/**
		 * Data excel
		 */

		$baris = 2;
		$no = 1;
		foreach ($list as $dataExcel) {
			$sheet->setCellValue('A'.$baris,$no++);
			$sheet->setCellValue('B'.$baris,$dataExcel->asset_code);
			$sheet->setCellValue('C'.$baris,$dataExcel->product_name);
			$sheet->setCellValue('D'.$baris,$dataExcel->product_brand);
			$sheet->setCellValue('E'.$baris,$dataExcel->category_product);
			$sheet->setCellValue('F'.$baris,$dataExcel->type_product);
			$sheet->setCellValue('G'.$baris,$dataExcel->branch_name);
			$sheet->setCellValue('H'.$baris,$dataExcel->division_name);
			$sheet->setCellValue('I'.$baris,$dataExcel->product_cost_center);
			// $sheet->setCellValue('J'.$baris,$dataExcel->product_profit_center);
			$baris++;
		}

		$writer = new Xlsx($spreadsheet);


		$filename = 'Cost_Report.xlsx'; //save our workbook as this file name
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