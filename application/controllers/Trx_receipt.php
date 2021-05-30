<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trx_receipt extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_receipt');
		$this->load->model('m_supplier');
		$this->load->model('m_product');
		cek_login();
		if (!is_controller()) {
			redirect('dashboard');
		}
	}

	public function index()
	{
		$data['parent_supplier'] = $this->m_supplier->listSupplier();
		$data['parent_product'] = $this->m_product->listProduct();
		$this->template->load('overview', 'transaction/receipt/v_receipt', $data);
	}

	public function getNo()
	{
		$data = $this->m_receipt->seqno();
		echo json_encode($data);
	}

	public function getAll()
	{
		$list = $this->m_receipt->list();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->receipt_code;
			$row[] = $value->supplier_name;
			$row[] = $value->invoice_number;
			$row[] = date('d-M-Y', strtotime($value->receipt_date));
			$row[] = $value->movement_code;
			if ($value->movement_status == 'Y') {
				$row[] = '<center><span class="label label-success">Completed</span></center>';
			} else if ($value->movement_status == 'N') {
				$row[] = '<center><span class="label label-danger">Voided</span></center>';
			} else {
				$row[] = '';
			}
			$row[] = date('d-M-Y (H:i:s)', strtotime($value->receipt_created_at));
			$row[] = $value->receipt_created_by;
			if ($value->receipt_status == 'Y') {
				$row[] = '<center><span class="label label-success">Completed</span></center>';
			} else if ($value->receipt_status == 'N') {
				$row[] = '<center><span class="label label-danger">Voided</span></center>';
			} else {
				$row[] = '<center><span class="label label-default">In Progress</span></center>';
			}

			if ($value->receipt_status == 'Y') {
				$row[] = '<center>
							<div><a class="btn btn-primary btn-xs" onclick="detailReceipt(' . "'" . $value->receipt_id . "'" . ')" title="View"><i class="fa fa-search"></i></a></div>
						</center>';
			} else if ($value->receipt_status == 'N') {
				$row[] = '<center>
							<div><a class="btn btn-primary btn-xs" onclick="detailReceipt(' . "'" . $value->receipt_id . "'" . ')" title="View"><i class="fa fa-search"></i></a></div>
						</center>';
			} else {
				$row[] = '<center>
							<div>
								<a class="btn btn-primary btn-xs" onclick="editReceipt(' . "'" . $value->receipt_id . "'" . ')" title="Edit"><i class="fa fa-edit"></i></a> 
								<a class="btn btn-danger btn-xs" onclick="deleteReceipt(' . "'" . $value->receipt_id . "'" . ')" title="Void"><i class="fa fa-times"></i></a> 
								<a class="btn btn-success btn-xs" onclick="completeReceipt(' . "'" . $value->receipt_id . "'" . ')" title="Complete"><i class="fa fa-check"></i></a> 
							</div>
						</center>';
			}
			$data[] = $row;
		}
		$result = array('data' => $data);
		echo json_encode($result);
	}

	public function actAdd()
	{
		$this->form_validation->set_rules('receipt_code', 'receipt code', 'required', array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('invoice_number', 'invoice number', 'required', array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('receipt_date', 'receipt date', 'required', array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('receipt_description', 'receipt description', 'required', array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('supplier_id_receipt', 'supplier', 'required', array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('receipts_details_product_id[]', 'Receipts Details', 'required', array('required' => 'Please add the %s.'));

		if ($this->form_validation->run()) {
			$receipt = array(
				'receipt_code' 				=> $this->input->post('receipt_code'),
				'invoice_number' 			=> $this->input->post('invoice_number'),
				'receipt_date' 				=> $this->input->post('receipt_date'),
				'receipt_description' 		=> $this->input->post('receipt_description'),
				'receipt_created_at' 		=> date('Y-m-j H:i:s'),
				'receipt_created_by' 		=> $this->session->userdata('login_session')['user_name'],
				'receipt_isactive'			=> 'Y',
				'receipt_status' 			=> 'I',
				'supplier_id' 				=> $this->input->post('supplier_id_receipt')
			);

			$id_receipt = $this->m_receipt->create_receipt($receipt);
			$this->m_receipt->create_receipt_detail($id_receipt);
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 					=> true,
				'receipt_code_error' 		=> form_error('receipt_code'),
				'invoice_number_error' 		=> form_error('invoice_number'),
				'receipt_date_error' 		=> form_error('receipt_date'),
				'receipt_description_error' => form_error('receipt_description'),
				'supplier_id_receipt_error' => form_error('supplier_id_receipt'),
				'receipts_details_product_id_error' => form_error('receipts_details_product_id[]')
			);
		}
		echo json_encode($data);
	}

	public function getDetail($id)
	{
		$data = $this->m_receipt->ReceiptDetail($id);
		echo json_encode($data);
	}

	public function delete_product_details_id($id)
	{
		$data = $this->m_receipt->delete_product_details($id);
		echo json_encode(array("status" => TRUE));
	}


	public function actEdit()
	{
		$this->form_validation->set_rules('receipt_code', 'receipt code', 'required', array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('invoice_number', 'invoice number', 'required', array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('receipt_date', 'receipt date', 'required', array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('receipt_description', 'receipt description', 'required', array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('supplier_id_receipt', 'supplier', 'required', array('required' => 'Please select the %s.'));

		if ($this->form_validation->run()) {
			$this->m_receipt->update();
			$this->m_receipt->update_receipt_detail($this->input->post('id_receipt'));
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = array(
				'error' 					=> true,
				'receipt_code_error' 		=> form_error('receipt_code'),
				'invoice_number_error' 		=> form_error('invoice_number'),
				'receipt_date_error' 		=> form_error('receipt_date'),
				'receipt_description_error' => form_error('receipt_description'),
				'supplier_id_receipt_error' => form_error('supplier_id_receipt')
			);
		}
		echo json_encode($data);
	}

	public function actComplete($id)
	{
		$data = $this->m_receipt->complete($id);
		echo json_encode(array("status" => TRUE));
	}

	public function actDeleteNotMovement($id)
	{
		$check = $this->m_receipt->checkNotMovement($id);
		$row = $check->row();
		if ($check->num_rows() > 0 && $row->movement_status == 'Y') {
			$data = array(
				'status' => FALSE,
				'pesan' => 'Void Movement First'
			);
		} else {
			$this->m_receipt->delete($id);
			$data = array(
				'status' => TRUE,
				'pesan' => 'Void Success'
			);
		}
		echo json_encode($data);
	}

	public function getCategory()
	{
		$data = $this->m_category->setCategory();
		echo json_encode($data);
	}

	public function getSubcategory()
	{
		$data = $this->m_subcategory->setSubcategory();
		echo json_encode($data);
	}

	public function getType()
	{
		$data = $this->m_type->setType();
		echo json_encode($data);
	}

	public function getReceipt()
	{
		$data = $this->m_receipt->setReceipt();
		echo json_encode($data);
	}

	public function getProduct()
	{
		$data = $this->m_product->get_product();
		echo json_encode($data);
	}

	public function actAddProduct()
	{
		$data = $this->m_receipt->get_product_list();
		echo json_encode($data);
	}

	public function actCategoryChange()
	{
		$category_id = $this->input->post('category_id_receipt');
		$data = $this->m_receipt->get_category($category_id);
		echo json_encode($data);
	}

	public function actSubcategoryChange()
	{
		$subcategory_id = $this->input->post('subcategory_id_receipt');
		$data = $this->m_receipt->get_subcategory($subcategory_id);
		echo json_encode($data);
	}
}
