<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("m_movement");
		$this->load->model("m_receipt");
		$this->load->model("m_product");
		$this->load->model("m_user");
        cek_login();
	}

	public function index()
	{
		$result['movements'] = $this->m_movement->list();
		$result['receipts'] = $this->m_receipt->list();
		$result['total_movements'] = $this->m_movement->jumlahTotalMovements();
		$result['total_products'] = $this->m_movement->jumlahTotalProduk();
		$result['total_receipts'] = $this->m_movement->jumlahTotalReceipts();
		$result['total_users'] = $this->m_user->jumlahTotalUsers();
		$this->template->load('overview', 'dashboard', $result);
		// $result = $this->m_movement->jumlahTotalReceipts()->result();
		// echo json_encode($result);

	}
	public function latesMovement()
	{
		$list = $this->m_movement->listmovementsuccess();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->movement_code;
			$row[] = $value->movement_date;
			$row[] = $value->movement_created_at;
			
			if($value->movement_status == 'Y'){
				$row[] = '<center><span class="label label-success">Completed</span></center>';
			} else if($value->movement_status == 'N'){
				$row[] = '<center><span class="label label-danger">Voided</span></center>';
			} else {
				$row[] = '<center><span class="label label-default">In Progress</span></center>';
			}

			if($value->movement_isactive == 'Y')
			{
				$row[] = '<center><span class="label label-success">Active</span></center>';
			}
			else
			{
				$row[] = '<center><span class="label label-danger">Inactive</span></center>';
			}
			$row[] = $value->movement_description;
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}
	public function latesReceipt()
	{
		$list = $this->m_receipt->listreceiptsuccess();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->receipt_code;
			$row[] = $value->invoice_number;
			$row[] = $value->receipt_date;
			
			if($value->receipt_status == 'Y'){
				$row[] = '<center><span class="label label-success">Completed</span></center>';
			} else if($value->receipt_status == 'N'){
				$row[] = '<center><span class="label label-danger">Voided</span></center>';
			} else {
				$row[] = '<center><span class="label label-default">In Progress</span></center>';
			}

			if($value->receipt_isactive == 'Y')
			{
				$row[] = '<center><span class="label label-success">Active</span></center>';
			}
			else
			{
				$row[] = '<center><span class="label label-danger">Inactive</span></center>';
			}
			$row[] = $value->receipt_description;
			$data[] = $row;
		}
		$result = array('data' => $data );
		echo json_encode($result);
	}
	public function totalProduct(){
		$result=mysql_query("SELECT count(*) from products");
		$data=mysql_fetch_assoc($result);
	}
}