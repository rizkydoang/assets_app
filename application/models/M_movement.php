<?php

class M_movement extends CI_Model
{
	private $_table = 'movements';

	public function list()
	{
		$this->db->select(
						'movements.movement_id,
						movements.movement_code,
						movements.movement_date,
						movements.movement_description,
						movements.movement_created_at,
						movements.movement_created_by,
						movements.movement_updated_at,
						movements.movement_updated_at,
						movements.movement_isactive,
						movements.movement_status,
						receipts.receipt_code,
						receipts.receipt_status'
			);
			$this->db->from('movements');
			$this->db->join('receipts', 'movements.receipt_id = receipts.receipt_id', 'LEFT');
			$query = $this->db->get()->result();
			return $query;
	}

	public function listmovementsuccess()
	{
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->limit('5');
		$this->db->where('movement_status', 'Y');
		$this->db->order_by('movement_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function rptlist()
	{
		if ($this->session->userdata('login_session')['divisi'] == 1 or $this->session->userdata('login_session')['divisi'] == 2) {
			$this->db->distinct();
			$this->db->select(
				'movements.movement_id,
								movements.movement_status,
								movement_code,
								movement_date,
								movement_created_at,
								movement_created_by,
								movement_isactive'
			);
			$this->db->from($this->_table);
			$this->db->join('movements_details', 'movements_details.movement_id = movements.movement_id', 'left');
			$this->db->where('movements.movement_isactive', 'Y');
			$this->db->where('movements.movement_status', 'Y');
			$query = $this->db->get()->result();
			return $query;
		} else {
			$this->db->distinct();
			$this->db->select(
				'movements.movement_id,
								movements.movement_status,
								movement_code,
								movement_date,
								movement_created_at,
								movement_created_by,
								movement_isactive'
			);
			$this->db->from($this->_table);
			$this->db->join('movements_details', 'movements_details.movement_id = movements.movement_id', 'left');
			$this->db->where('movements_details.movements_details_to_division', $this->session->userdata('login_session')['divisi']);
			$this->db->where('movements.movement_isactive', 'Y');
			$this->db->where('movements.movement_status', 'Y');
			$query = $this->db->get()->result();
			return $query;
		}
	}
	public function jumlahTotalProduk()
	{
		if (is_controller_and_direct()) {
			$this->db->from($this->_table);
			$this->db->join('movements_details', 'movements_details.movement_id = movements.movement_id', 'left');
			$this->db->where('movements.movement_status', 'Y');
			$total = $this->db->count_all_results();
			return $total;
		} else {
			$this->db->from($this->_table);
			$this->db->join('movements_details', 'movements_details.movement_id = movements.movement_id', 'left');
			$this->db->where('movements.movement_status', 'Y');
			$this->db->where('movements_details.movements_details_to_division', $this->session->userdata('login_session')['divisi']);
			$total = $this->db->count_all_results();
			return $total;
		}
	}
	public function jumlahTotalMovements()
	{
		if (is_controller_and_direct()) {
			$this->db->distinct();
			$this->db->select('movement_code');
			$this->db->from('movements');
			$this->db->join('movements_details', 'movements_details.movement_id = movements.movement_id', 'left');
			$this->db->where('movement_status', 'Y');
			$total = $this->db->count_all_results();
			return $total;
		} else {
			$this->db->distinct();
			$this->db->select('movement_code');
			$this->db->from('movements');
			$this->db->join('movements_details', 'movements_details.movement_id = movements.movement_id', 'left');
			$this->db->where('movement_status', 'Y');
			$this->db->where('movements_details.movements_details_to_division', $this->session->userdata('login_session')['divisi']);
			$total = $this->db->count_all_results();
			return $total;
		}
	}
	public function jumlahTotalReceipts()
	{
		if (is_controller_and_direct()) {
			$this->db->select('receipt_code');
			$this->db->from('receipts');
			// $this->db->join('movements', '  movements.receipt_id = receipts.receipt_id', 'left');
			// $this->db->join('receipts_details', '  receipts_details.receipt_id = receipts.receipt_id', 'left');
			// $this->db->join('movements_details', '  movements_details.movement_id = movements.movement_id', 'left');
			$this->db->where('receipts.receipt_status', 'Y');
			$total = $this->db->count_all_results();
			return $total;
		} else {
			$this->db->distinct();
			$this->db->select('receipt_code');
			$this->db->from('receipts');
			$this->db->join('receipts_details', '  receipts_details.receipt_id = receipts.receipt_id', 'left');
			$this->db->join('movements', '  movements.receipt_id = receipts.receipt_id', 'left');
			$this->db->join('movements_details', '  movements_details.movement_id = movements.movement_id', 'left');
			$this->db->where('movements_details.movements_details_to_division', $this->session->userdata('login_session')['divisi']);
			$this->db->where('receipts.receipt_status', 'Y');
			$total = $this->db->count_all_results();
			return $total;
		}
	}

	public function create_movement($movement)
	{
		$this->db->insert('movements', $movement);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	public function create_movement_detail($id_movement)
	{
		$receipts_details_id						= $this->input->post('receipts_details_id');
		$movement_asset_code 						= $this->input->post('movement_asset_code');
		$movement_new 								= $this->input->post('movement_new');
		$movement_from_branch						= $this->input->post('movement_from_branch');
		$movement_from_division						= $this->input->post('movement_from_division');
		$movement_to_branch							= $this->input->post('movement_to_branch');
		$movement_to_division						= $this->input->post('movement_to_division');
		$movements_details_description 				= $this->input->post('movements_details_description');

		$data = array();
		for ($i = 0; $i < count($receipts_details_id); $i++) {
			$insertArray = array(
				'movements_details_rd_id'			=> $receipts_details_id[$i],
				'movements_details_asset_code'		=> $movement_asset_code[$i],
				'movements_details_isnew'  			=> $movement_new[$i],
				'movements_details_from_branch'		=> $movement_from_branch[$i],
				'movements_details_from_division'	=> $movement_from_division[$i],
				'movements_details_to_branch'		=> $movement_to_branch[$i],
				'movements_details_to_division'		=> $movement_to_division[$i],
				'movements_details_description' 	=> $movements_details_description[$i],
				'movement_id' 						=> $id_movement
			);
			array_push($data, $insertArray);
		}
		$this->db->insert_batch('movements_details', $data);
	}

	// public function displayMvmentBasedonDivision()
	// {
	// 	$this->db->distinct();
	// 	$this->db->select('movements.movement_id,
	// 						movement_code,
	// 						movement_date,
	// 						movement_created_at,
	// 						movement_created_by,
	// 						movement_isactive');
	// 	$this->db->from($this->_table);
	// 	$this->db->join('movements_details','movements_details.movement_id = movements.movement_id', 'left');

	// 	$this->db->where('movements.movement_isactive', 'Y');
	// 	// $this->db->where('movements_details.movements_details_to_division', $this->session->userdata('login_session')['divisi']);
	// 	$this->db->where('movements.movement_status', 'Y');
	// 	// $this->db->order_by('movement_id', 'ASC');
	// 	$query = $this->db->get()->result();
	// 	return $query;
	// }
	public function update()
	{
		$post = $this->input->post();
		$this->movement_code 					= strtoupper($post['movement_code']);
		$this->movement_date 					= $post['movement_date'];
		$this->receipt_id 						= $post['receipt_id'];
		$this->movement_description 			= $post['movement_description'];
		$this->movement_updated_at 				= date('Y-m-d H:i:s');
		$this->movement_updated_by 				= $this->session->userdata('login_session')['user_name'];
		$this->db->where(array('movement_id' 	=> $post['movement_id']));
		$this->db->update($this->_table, $this);
	}

	public function update_movement_detail($id_movement)
	{
		$movements_details_id						= $this->input->post('movements_details_id');
		$movement_asset_code 						= $this->input->post('movement_asset_code');
		$movement_new 								= $this->input->post('movement_new');
		$movement_from_branch						= $this->input->post('movement_from_branch');
		$movement_from_division						= $this->input->post('movement_from_division');
		$movement_to_branch							= $this->input->post('movement_to_branch');
		$movement_to_division						= $this->input->post('movement_to_division');
		$movements_details_description 				= $this->input->post('movements_details_description');

		$data = array();
		for ($i = 0; $i < count($movements_details_id); $i++) {
			$insertArray = array(
				'movement_id' 						=> $id_movement,
				'movements_details_id'				=> $movements_details_id[$i],
				'movements_details_asset_code'		=> $movement_asset_code[$i],
				'movements_details_isnew'  			=> $movement_new[$i],
				'movements_details_from_branch'		=> $movement_from_branch[$i],
				'movements_details_from_division'	=> $movement_from_division[$i],
				'movements_details_to_branch'		=> $movement_to_branch[$i],
				'movements_details_to_division'		=> $movement_to_division[$i],
				'movements_details_description' 	=> $movements_details_description[$i],
			);
			array_push($data, $insertArray);
			$this->db->where('movement_id', $id_movement);
			$this->db->update_batch('movements_details', $data, 'movements_details_id');
		}
	}

	public function MovementDetail($id)
	{
		$this->db->select('movements.movement_id,
							movement_code,
							movement_date,
							movement_description,
							movements.receipt_id,
							movement_created_at,
							movement_created_by,
							movement_status,
							movements_details_asset_code,
							receipts.receipt_id,
							receipt_code,
							product_name,
							movements_details_id,
							movements_details_isnew,
							movements_details_from_branch,
							movements_details_from_division,
							movements_details_to_branch,
							movements_details_to_division,
							movements_details_description,
							b1.branch_name AS "to_branch",
							d1.division_name AS "to_division",
							b2.branch_name AS "from_branch",
							d2.division_name AS "from_division"
							');
		$this->db->from('movements');
		$this->db->join('movements_details', 'movements_details.movement_id = movements.movement_id', 'LEFT');
		$this->db->join('receipts_details', 'receipts_details.receipts_details_id  = movements_details.movements_details_rd_id', 'LEFT');
		$this->db->join('receipts', 'receipts.receipt_id = movements.receipt_id', 'LEFT');
		$this->db->join('products', 'products.product_id = receipts_details.receipts_details_product_id', 'LEFT');
		$this->db->join('branches b1', 'b1.branch_id = movements_details.movements_details_to_branch');
		$this->db->join('divisions d1', 'd1.division_id = movements_details.movements_details_to_division');
		$this->db->join('branches b2', 'b2.branch_id = movements_details.movements_details_from_branch');
		$this->db->join('divisions d2', 'd2.division_id = movements_details.movements_details_from_division');
		$this->db->where('movements.movement_id', $id);
		$this->db->order_by('movements_details_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}


	public function complete($id)
	{
		$this->db->set('movement_status', 'Y');
		$this->db->where('movement_id', $id);
		return $this->db->update($this->_table);
	}

	public function delete($id)
	{
		$this->db->set('movement_status', 'N');
		$this->db->where('movement_id', $id);
		return $this->db->update($this->_table);
	}

	public function seqno()
	{
		$this->db->select('(count(movement_id)+1) as no');
		$this->db->where("DATE_FORMAT(movement_created_at,'%Y-%m')", date('Y-m'));
		$this->db->from($this->_table);
		$query = $this->db->get()->result();
		return $query;
	}

	public function listMovement()
	{
		$this->db->select('movement_id,
							movement_code,
							movement_date,
							movement_created_at,
							movement_created_by,
							movement_isactive');
		$this->db->from($this->_table);
		$this->db->where('movement_isactive', 'Y');
		// $this->db->order_by('movement_id', 'ASC');
		$this->db->order_by('movement_id', 'DESC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function listReceipt()
	{
		$this->db->select('receipt_id,
							receipt_code,
							invoice_number,
							receipt_date,
							receipt_created_at,
							receipt_created_by,
							receipt_isactive,
							receipt_status,
							supplier_name');
		$this->db->from('receipts');
		$this->db->join('suppliers', 'suppliers.supplier_id = receipts.supplier_id', 'LEFT');
		$this->db->where('receipt_isactive', 'Y');
		$this->db->where('receipt_status', 'Y');
		$this->db->where('receipts.receipt_id NOT IN (select receipt_id from movements where movement_status="Y" OR movement_status="I")', NULL, FALSE);
		$this->db->order_by('receipt_created_at', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function setMovement()
	{
		$this->db->select('movement_id,
							movement_code,
							movement_date,
							movement_created_at,
							movement_created_by,
							movement_isactive');
		$this->db->from('movements');
		$this->db->where('movement_isactive', 'Y');
		// $this->db->order_by('movement_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function get_receipt_list($receipt_id)
	{
		$this->db->select('receipts_details.receipts_details_id,
						receipts_details.receipts_details_product_id,
						products.product_name,
						receipts_details.receipts_details_qty, 
						receipts.receipt_description');
		$this->db->from('receipts_details');
		$this->db->where('receipts_details.receipt_id', $receipt_id);
		$this->db->join('products', 'products.product_id = receipts_details.receipts_details_product_id', 'left');
		$this->db->join('receipts', 'receipts.receipt_id = receipts_details.receipt_id', 'left');
		$query = $this->db->get()->result();
		return $query;
	}

	//Get Product where on Receipt List (Completed)
	public function get_product_list()
	{
		$this->db->select('receipts_details_id,receipts_details_product_id,product_name,receipts_details_qty');
		$this->db->from('receipts_details');
		$this->db->join('products', 'products.product_id = receipts_details.receipts_details_product_id', 'left');
		$this->db->join('receipts', 'receipts.receipt_id = receipts_details.receipt_id', 'left');
		$this->db->group_by('receipts_details_product_id');
		$query = $this->db->get()->result();
		return $query;
	}

	//Get User where on Receipt List (Completed)
	// public function get_user_list(){
	// 	$this->db->from('users');
	// 	$this->db->where('user_isactive','Y');
	// 	$query = $this->db->get()->result();
	// 	return $query;
	// }

	//Get User where on Receipt List (Completed)
	public function get_branch_list()
	{
		$this->db->from('branches');
		$this->db->where('branch_isactive', 'Y');
		$query = $this->db->get()->result();
		return $query;
	}

	//Get Product where on Receipt List (Completed)
	// public function get_room_list(){
	// 	$this->db->from('rooms');
	// 	$this->db->where('room_isactive','Y');
	// 	$query = $this->db->get()->result();
	// 	return $query;
	// }

	//Get Product where on Receipt List (Completed)
	public function get_division_list()
	{
		$this->db->from('divisions');
		$this->db->where('division_isactive', 'Y');
		$query = $this->db->get()->result();
		return $query;
	}

	public function viewRptMovement($product_id, $movement_id, $date_from, $date_to)
	{
		// $this->db->select('movements_details_id, movement_date, product_name, movements_details_asset_code, from.user_name as user_from, to.user_name as user_to, movements_details_description');
		$this->db->select('movements_details_id, movement_date, product_name, movements_details_asset_code, from.branch_name as from_branch, to.branch_name as to_branch, movements_details_description');
		$this->db->from('movements_details');
		$this->db->join('movements', 'movements.movement_id = movements_details.movement_id', 'left');
		$this->db->join('receipts_details', 'receipts_details.receipts_details_id = movements_details.movements_details_rd_id', 'left');
		$this->db->join('products', 'products.product_id = receipts_details.receipts_details_product_id', 'left');
		// $this->db->join('users as from','from.user_id = movements_details.movements_details_from','left');
		$this->db->join('branches as from', 'from.branch_id = movements_details.movements_details_from_branch', 'left');
		// $this->db->join('users as to','to.user_id = movements_details.movements_details_to','left');
		$this->db->join('branches as to', 'to.branch_id = movements_details.movements_details_to_branch', 'left');
		if ($product_id != '') {
			$this->db->where('receipts_details_product_id', $product_id);
		};
		if ($movement_id != '') {
			$this->db->where('movements_details.movement_id', $movement_id);
		};
		$this->db->where('movement_date BETWEEN "' . $date_from . '" AND "' . $date_to . '"');
		$query = $this->db->get()->result();
		return $query;
	}

	public function product_movement($date_from = null, $date_to = null, $from_division = null, $to_division = null, $status = null)
	{
		$this->db->select('	movement_code,
							r2.receipt_code AS receipt_code,
							movement_date,
							products.product_name,
							movements_details.movements_details_asset_code as kode_aset,
							movements_details.movements_details_isnew AS is_new,
							b1.branch_name AS "to_branch",
							d1.division_name AS "to_division",
							b2.branch_name AS "from_branch",
							d2.division_name AS "from_division",
							movement_status AS movement_status,
							movements_details.movements_details_description AS description');
		$this->db->from('movements');
		$this->db->join('movements_details', 'movements_details.movement_id = movements.movement_id', 'LEFT');
		$this->db->join('receipts r1', 'r1.receipt_id= movements_details.movements_details_rd_id', 'LEFT');
		$this->db->join('receipts_details', 'receipts_details.receipts_details_id = movements_details.movements_details_rd_id', 'left');
		$this->db->join('receipts r2', 'r2.receipt_id = movements.receipt_id', 'LEFT');
		$this->db->join('products', 'products.product_id = receipts_details.receipts_details_product_id', 'left');
		$this->db->join('branches b1', 'b1.branch_id = movements_details.movements_details_to_branch');
		$this->db->join('divisions d1', 'd1.division_id = movements_details.movements_details_to_division');
		$this->db->join('branches b2', 'b2.branch_id = movements_details.movements_details_from_branch');
		$this->db->join('divisions d2', 'd2.division_id = movements_details.movements_details_from_division');
		$this->db->where('movements.movement_status', 'Y');

		if (is_controller_and_direct()) {
			if (!empty($date_from) || !empty($date_to)) {
				$this->db->where('movement_date BETWEEN "' . $date_from . '" AND "' . $date_to . '"');
			}

			if (!empty($from_division)) {
				$this->db->where('d2.division_id', $from_division);
			}
			if (!empty($to_division)) {
				$this->db->where('d1.division_id', $to_division);
			}	
		} else {
			if (!empty($date_from) || !empty($date_to)) {
				$this->db->where('movement_date BETWEEN "' . $date_from . '" AND "' . $date_to . '"');
			}

			$this->db->where('d1.division_id', $this->session->userdata('login_session')['divisi']);
			$this->db->or_where('d2.division_id', $this->session->userdata('login_session')['divisi']); 
		}

		$query = $this->db->get()->result();
		return $query;
	}
}
