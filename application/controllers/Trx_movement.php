<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trx_movement extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_receipt');
		$this->load->model('m_movement');
		cek_login();
		if (!is_controller()) {
			redirect('dashboard');
		}
	}

	public function index()
	{
		$data['parent_movement'] = $this->m_movement->listMovement();
		$data['parent_receipt'] = $this->m_movement->listReceipt();
		$this->template->load('overview', 'transaction/movement/v_movement', $data);
	}

	public function getNo()
	{
		$data = $this->m_movement->seqno();
		echo json_encode($data);
	}

	public function getAll()
	{
		$list = $this->m_movement->list();
		$data = array();
		foreach ($list as $value) {
			$row = array();
			$row[] = $value->movement_code;
			$row[] = $value->movement_date;
			$row[] = $value->receipt_code;
			if ($value->receipt_status == 'Y') {
				$row[] = '<center><span class="label label-success">Completed</span></center>';
			} else if ($value->receipt_status == 'N') {
				$row[] = '<center><span class="label label-danger">Voided</span></center>';
			}
			$row[] = $value->movement_created_at;
			$row[] = $value->movement_created_by;
			if ($value->movement_status == 'Y') {
				$row[] = '<center><span class="label label-success">Completed</span></center>';
			} else if ($value->movement_status == 'N') {
				$row[] = '<center><span class="label label-danger">Voided</span></center>';
			} else {
				$row[] = '<center><span class="label label-default">In Progress</span></center>';
			}

			if ($value->movement_status == 'Y') {
				$row[] = '<center>
										<div><a class="btn btn-primary btn-xs" onclick="detailMovement(' . "'" . $value->movement_id . "'" . ')" title="View"><i class="fa fa-search"></i></a></div>
									</center>';
			} else if ($value->movement_status == 'N') {
				$row[] = '<center>
										<div><a class="btn btn-primary btn-xs" onclick="detailMovement(' . "'" . $value->movement_id . "'" . ')" title="View"><i class="fa fa-search"></i></a></div>
									</center>';
			} else {
				$row[] = '<center>
										<div><a class="btn btn-primary btn-xs" onclick="editMovement(' . "'" . $value->movement_id . "'" . ')" title="Edit"><i class="fa fa-edit"></i></a> <a class="btn btn-danger btn-xs" onclick="deleteMovement(' . "'" . $value->movement_id . "'" . ')" title="Delete"><i class="fa fa-times"></i></a> <a class="btn btn-success btn-xs" onclick="completeMovement(' . "'" . $value->movement_id . "'" . ')" title="Complete"><i class="fa fa-check"></i></a> </div>
									</center>';
			}
			$data[] = $row;
		}
		$result = array('data' => $data);
		echo json_encode($result);
	}

	public function actAdd()
	{
		$this->form_validation->set_rules('movement_code', 'movement code', 'required', array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('movement_date', 'movement date', 'required', array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('movement_description', 'movement description', 'required', array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('receipt_id_movement', 'receipt id movement', 'required', array('required' => 'Please select the %s.'));

		if ($this->form_validation->run()) {
			$movement = array(
				'movement_code' 		=> $this->input->post('movement_code'),
				'movement_date' 		=> $this->input->post('movement_date'),
				'movement_description' 	=> $this->input->post('movement_description'),
				'movement_created_at' 	=> date('Y-m-j H:i:s'),
				'movement_created_by' 	=> $this->session->userdata('login_session')['user_name'],
				'movement_isactive'		=> 'Y',
				'movement_status' 		=> 'I',
				'receipt_id' 			=> $this->input->post('receipt_id_movement')
			);
			$id_movement = $this->m_movement->create_movement($movement);
			$this->m_movement->create_movement_detail($id_movement);
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been inserted successfully!');
		} else {
			$data = array(
				'error' 						=> true,
				'movement_code_error' 			=> form_error('movement_code'),
				'movement_date_error' 			=> form_error('movement_date'),
				'movement_description_error' 	=> form_error('movement_description'),
				'receipt_id_movement_error' 	=> form_error('receipt_id_movement')
			);
		}
		echo json_encode($data);
	}

	public function getDetail($id)
	{
		$data = $this->m_movement->MovementDetail($id);
		echo json_encode($data);
	}

	public function actEdit()
	{
		$this->form_validation->set_rules('movement_id', 'movement code', 'required', array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('movement_code', 'movement code', 'required', array('required' => 'Please enter the %s.'));
		$this->form_validation->set_rules('movement_date', 'movement date', 'required', array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('receipt_id', 'receipt Code movement', 'required', array('required' => 'Please select the %s.'));
		$this->form_validation->set_rules('movement_description', 'receipt Description', 'required', array('required' => 'Please select the %s.'));

		if ($this->form_validation->run()) {
			$data = $this->m_movement->update();
			$this->m_movement->update_movement_detail($this->input->post('movement_id'));
			$data = array('success' => '<h4><i class="icon fa fa-check"></i> Success!</h4> Your data has been updated successfully!');
		} else {
			$data = $this->m_movement->update();
			$data = array(
				'error' 					=> true,
				'movement_id_error' 		=> form_error('movement_id'),
				'movement_code_error' 		=> form_error('movement_code'),
				'movement_date_error' 		=> form_error('movement_date'),
				'receipt_code_error' 		=> form_error('receipt_code'),
				'movement_description_error' 		=> form_error('movement_description')
			);
		}
		echo json_encode($data);
	}

	public function actComplete($id)
	{
		$data = $this->m_movement->complete($id);
		echo json_encode(array("status" => TRUE));
	}

	public function actDelete($id)
	{
		$data = $this->m_movement->delete($id);
		echo json_encode(array("status" => TRUE));
	}

	public function actDeleteNotMovement($id)
	{
		$result = $this->m_movement->delete($id);
		if ($result) {
			$data = array(
				'status' => TRUE,
				'pesan' => 'Void Success'
			);
		} else {
			$data = array(
				'status' => FALSE,
				'pesan' => 'Void Failed'
			);
		}
		echo json_encode($data);
	}

	public function actReceiptChange()
	{
		$receipt_id = $this->input->post('receipt_id');
		$data = $this->m_movement->get_receipt_list($receipt_id);
		echo json_encode($data);
	}

	public function actAddProduct()
	{
		$data = $this->m_movement->get_product_list();
		echo json_encode($data);
	}

	// public function actAddUser() {
	// 	$data = $this->m_movement->get_user_list();
	//    echo json_encode($data);
	// }

	public function actAddBranch()
	{
		$data = $this->m_movement->get_branch_list();
		echo json_encode($data);
	}

	// 	public function actAddRoom() {
	// 		$data = $this->m_movement->get_room_list();
	//     echo json_encode($data);
	// 	}
	// }

	public function actAddDivision()
	{
		$data = $this->m_movement->get_division_list();
		echo json_encode($data);
	}
}
