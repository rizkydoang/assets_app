<?php

class M_supplier extends CI_Model
{
	private $_table = 'suppliers';

	public function list()
	{
		return $this->db->get($this->_table)->result();
	}

	public function listSupplierSC()
	{
		$this->db->select('supplier_id,
							supplier_code,
							supplier_name,
							supplier_address,
							supplier_telephone,
							supplier_isservice,
							supplier_created_at,
							supplier_created_by,
							supplier_isactive');
		$this->db->from($this->_table);
		$this->db->where('supplier_isactive', 'Y');
		// $this->db->order_by('supplier_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function save()
	{
		$post = $this->input->post();
		$this->supplier_code 				= strtoupper($post['supplier_code']);
		$this->supplier_name 				= strtoupper($post['supplier_name']);
		$this->supplier_address 		= $post['supplier_address'];
		// $this->supplier_owner 			= $post['supplier_owner'];
		$this->supplier_telephone		= $post['supplier_telephone'];
		$this->supplier_isvendor 		= $post['supplier_isvendor'];
		// $this->supplier_isservice 	= $post['supplier_isservice'];
		$this->supplier_created_at 		= date('Y-m-d H:i:s');
		$this->supplier_created_by 		= $this->session->userdata('login_session')['user_name'];
		$this->supplier_isactive 		= $post['supplier_isactive'];
		$this->supplier_isvendor 		= $post['supplier_isvendor'];
		// $this->supplier_isservice 	= $post['supplier_isservice'];
		$this->db->insert($this->_table,$this);
	}

	public function detail($id)
	{
		return $this->db->get_where($this->_table, array('supplier_id' => $id))->row();
	}

	public function update()
	{
		$post = $this->input->post();
		$this->supplier_code 				= strtoupper($post['supplier_code']);
		$this->supplier_name 				= strtoupper($post['supplier_name']);
		$this->supplier_address 		= $post['supplier_address'];
		// $this->supplier_owner 			= $post['supplier_owner'];
		$this->supplier_telephone		= $post['supplier_telephone'];
		$this->supplier_isvendor 		= $post['supplier_isvendor'];
		// $this->supplier_isservice 	= $post['supplier_isservice'];
		$this->supplier_updated_at 		= date('Y-m-d H:i:s');
		$this->supplier_updated_by 		= $this->session->userdata('login_session')['user_name'];
		$this->supplier_isactive 		= $post['supplier_isactive'];
		$this->supplier_isvendor 		= $post['supplier_isvendor'];
		// $this->supplier_isservice 	= $post['supplier_isservice'];
		$where = array('supplier_id' => $post['id_supplier']);
		$this->db->where($where);
		$this->db->update($this->_table,$this);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array('supplier_id' => $id));
	}

	public function codeNum()
	{
		$this->db->select('(count(supplier_id)+1) as no');
		$this->db->from($this->_table);
		$query = $this->db->get()->result();
		return $query;
	}

	public function listSupplier()
	{
		$this->db->select('supplier_id,
							supplier_code,
							supplier_name,
							supplier_address,
							supplier_telephone,
							supplier_isvendor,
							supplier_created_at,
							supplier_created_by,
							supplier_isactive');
		$this->db->from($this->_table);
		$this->db->where('supplier_isactive', 'Y');
		// $this->db->order_by('supplier_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function setSupplier()
	{
		$this->db->select('supplier_id,
							supplier_code,
							supplier_name,
							supplier_address,
							supplier_telephone,
							supplier_isvendor,
							supplier_telephone,
							supplier_created_at,
							supplier_created_by,
							supplier_isactive');
		$this->db->from('suppliers');
		$this->db->where('supplier_isactive', 'Y');
		// $this->db->order_by('supplier_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}
}
