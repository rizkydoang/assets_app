<?php

class M_receipt extends CI_Model
{
	private $_table = 'receipts';

	public function list()
	{
		$this->db->select(
							'receipts.receipt_id,
							receipts.receipt_code,
							suppliers.supplier_name,
							receipts.invoice_number,
							receipts.receipt_date,
							receipts.receipt_created_at,
							receipts.receipt_created_by,
							receipts.receipt_isactive,
							receipts.receipt_status,
							receipts.receipt_description,
							movements.movement_code,
							movements.movement_status'
		);
		$this->db->from('receipts');
		$this->db->join('suppliers', 'suppliers.supplier_id = receipts.supplier_id', 'LEFT');
		$this->db->join('movements', 'receipts.receipt_id = movements.receipt_id', 'LEFT');
		$query = $this->db->get()->result();
		return $query;
	}

	public function listreceiptsuccess()
	{
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->limit('5');
		$this->db->where('receipt_status', 'Y');
		$this->db->order_by('receipt_id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlahTotalReceipt()
	{
		$total = $this->db->count_all('receipts');
		return $total;
	}

	public function create_receipt($receipt)
	{
		$this->db->insert('receipts', $receipt);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	public function create_receipt_detail($id_receipt)
	{
		$receipt_product	= $this->input->post('receipts_details_product_id');
		$receipt_qty 		= $this->input->post('receipts_details_qty');
		$receipt_price 		= $this->input->post('receipts_details_price');

		$data = array();
		for ($i = 0; $i < count($receipt_product); $i++) {
			$insertArray = array(
				'receipt_id' 					=>	$id_receipt,
				'receipts_details_product_id'	=>	$receipt_product[$i],
				'receipts_details_qty'			=>	$receipt_qty[$i],
				'receipts_details_price'  		=>	replaceFormat($receipt_price[$i]),
			);
			array_push($data, $insertArray);
		}
		$receipt_details = $this->db->insert_batch('receipts_details', $data);
		return (isset($receipt_details)) ? $receipt_details : FALSE;
	}

	public function update_receipt_detail($id_receipt)
	{
		$receipt_details_id	= $this->input->post('receipts_details_id');
		$receipt_product	= $this->input->post('receipts_details_product_id');
		$receipt_qty 		= $this->input->post('receipts_details_qty');
		$receipt_price 		= $this->input->post('receipts_details_price');

		$data1 = array();
		$data2 = array();

		for ($i = 0; $i < count($receipt_product); $i++) {
			if (!empty($receipt_details_id[$i])) {
				$updateArray = array(
					'receipt_id' 					=> $id_receipt,
					'receipts_details_id'			=> $receipt_details_id[$i],
					'receipts_details_product_id'	=> $receipt_product[$i],
					'receipts_details_qty'			=> $receipt_qty[$i],
					'receipts_details_price'  		=> replaceFormat($receipt_price[$i]),
				);
				array_push($data1, $updateArray);
				$this->db->where('receipt_id', $id_receipt);
				$this->db->update_batch('receipts_details', $data1, 'receipts_details_id');
			} else {
				$insertArray = array(
					'receipt_id' 					=>	$id_receipt,
					'receipts_details_product_id'	=>	$receipt_product[$i],
					'receipts_details_qty'			=>	$receipt_qty[$i],
					'receipts_details_price'  		=>	replaceFormat($receipt_price[$i]),
				);
				array_push($data2, $insertArray);
				$this->db->insert_batch('receipts_details', $data2);
			}
		}
	}

	public function delete_product_details($id)
	{
		return $this->db->delete('receipts_details', array('receipts_details_id' => $id));
	}

	public function detail($id)
	{
		return $this->db->get_where($this->_table, array('receipt_id' => $id))->row();
	}

	public function update()
	{
		$post = $this->input->post();
		$this->receipt_code 		= strtoupper($post['receipt_code']);
		$this->supplier_id 			= $post['supplier_id_receipt'];
		$this->invoice_number 		= strtoupper($post['invoice_number']);
		$this->receipt_date 		= $post['receipt_date'];
		$this->receipt_description 	= $post['receipt_description'];
		$this->receipt_updated_at 	= date('Y-m-d H:i:s');
		$this->receipt_updated_by 	= $this->session->userdata('login_session')['user_name'];
		$this->db->where(array('receipt_id' => $post['id_receipt']));
		$this->db->update($this->_table, $this);
	}

	public function complete($id)
	{
		$this->db->set('receipt_status', 'Y');
		$this->db->where('receipt_id', $id);
		return $this->db->update($this->_table);
	}

	public function delete($id)
	{
		$this->db->set('receipt_status', 'N');
		$this->db->where('receipt_id', $id);
		return $this->db->update($this->_table);
	}

	public function checkNotMovement($id)
	{
		$query = $this->db->get_where('movements', ['receipt_id' => $id]);
		return $query;
	}


	public function seqno()
	{
		$this->db->select('(count(receipt_id)+1) as no');
		$this->db->where("DATE_FORMAT(receipt_created_at,'%Y-%m')", date('Y-m'));
		$this->db->from($this->_table);
		$query = $this->db->get()->result();
		return $query;
	}

	public function listBrand()
	{
		$this->db->select('brand_id,
							brand_code,
							brand_name,
							brand_created_at,
							brand_created_by,
							brand_isactive');
		$this->db->from('brands');
		$this->db->where('brand_isactive', 'Y');
		// $this->db->order_by('ms_brand_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function listCategory()
	{
		$this->db->select('category_id,
							category_code,
							category_name,
							category_created_at,
							category_created_by,
							category_isactive');
		$this->db->from('categories');
		$this->db->where('category_isactive', 'Y');
		// $this->db->order_by('category_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function listSubcategory()
	{
		$this->db->select('subcategory_id,
							subcategory_code,
							subcategory_name,
							category_id,
							subcategory_created_at,
							subcategory_created_by,
							subcategory_isactive');
		$this->db->from('subcategories');
		$this->db->where('subcategory_isactive', 'Y');
		$this->db->where('category_id', 1);
		// $this->db->order_by('subcategory_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function listType()
	{
		$this->db->select('type_id,
							type_code,
							type_name,
							subcategory_id,
							type_created_at,
							type_created_by,
							type_isactive');
		$this->db->from('types');
		$this->db->where('type_isactive', 'Y');
		$this->db->where('subcategory_id', 3);
		// $this->db->order_by('type_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function ReceiptDetail($id)
	{
		$this->db->select('receipts.receipt_id,
							receipt_code,
							invoice_number,
							receipt_date,
							receipt_created_at,
							receipt_created_by,
							receipt_status,
							receipts.supplier_id,
							supplier_name,
							receipt_description,
							product_code,
							product_name,
							receipts_details_id,
							receipts_details_product_id,
							receipts_details_price,
							receipts_details_qty');
		$this->db->from('receipts');
		$this->db->join('receipts_details', 'receipts_details.receipt_id = receipts.receipt_id', 'LEFT');
		$this->db->join('suppliers', 'suppliers.supplier_id = receipts.supplier_id', 'LEFT');
		$this->db->join('products', 'products.product_id = receipts_details.receipts_details_product_id', 'LEFT');
		$this->db->where('receipts.receipt_id', $id);
		$this->db->order_by('receipts_details_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	// public function listReceiptLineDetail($id)
	// {
	// 	$this->db->select('receipts.receipt_id,
	// 						receipt_code,
	// 						invoice_number,
	// 						receipt_date,
	// 						receipt_created_at,
	// 						receipt_created_by,
	// 						receipt_status,
	// 						supplier_name,
	// 						product_code,
	// 						product_name,
	// 						receipts_details_price');
	// 	$this->db->from('receipts');
	// 	$this->db->join('receipts_details','receipts_details.receipt_id = receipts.receipt_id','LEFT');
	// 	$this->db->join('suppliers','suppliers.supplier_id = receipts.supplier_id','LEFT');
	// 	$this->db->join('products','products.product_id = receipts_details.receipts_details_product_id','LEFT');
	// 	$this->db->where('receipts.receipt_id', $id);
	// 	$this->db->order_by('receipts_details_id', 'ASC');
	// 	$query = $this->db->get()->row();
	// 	return $query;
	// }

	public function setReceipt()
	{
		$this->db->select('receipt_id,
							receipt_code,
							invoice_number,
							receipt_date,
							receipt_created_at,
							receipt_created_by,
							receipt_isactive,
							receipt_status');
		$this->db->from('receipts');
		$this->db->where('receipt_isactive', 'Y');
		// $this->db->order_by('receipt_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function get_category($category_id)
	{
		$this->db->select('subcategory_id,subcategory_name,category_id');
		$this->db->from('subcategories');
		$this->db->where('category_id', $category_id);
		$query = $this->db->get()->result();
		return $query;
	}

	public function get_subcategory($subcategory_id)
	{
		$this->db->select('type_id,type_name,subcategory_id');
		$this->db->from('types');
		$this->db->where('subcategory_id', $subcategory_id);
		$query = $this->db->get()->result_array();
		return $query;
	}

	//Get Product
	public function get_product_list()
	{
		$this->db->from('products');
		$this->db->where('product_isactive', 'Y');
		$query = $this->db->get()->result();
		return $query;
	}
}
