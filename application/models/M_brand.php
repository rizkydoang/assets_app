<?php

class M_brand extends CI_Model
{
	private $_table = 'brands';

	public function list()
	{
		return $this->db->get($this->_table)->result();
	}

	public function save()
	{
		$post = $this->input->post();
		$this->brand_code 			= strtoupper($post['brand_code']);
		$this->brand_name 			= strtoupper($post['brand_name']);
		$this->brand_created_at 	= date('Y-m-d H:i:s');
		$this->brand_created_by 	= $this->session->userdata('login_session')['user_name'];
		$this->brand_isactive 		= $post['brand_isactive'];
		$this->db->insert($this->_table,$this);
	}

	public function detail($id)
	{
		return $this->db->get_where($this->_table, array('brand_id' => $id))->row();
	}

	public function update()
	{
		$post = $this->input->post();
		$this->brand_code 			= strtoupper($post['brand_code']);
		$this->brand_name 			= strtoupper($post['brand_name']);
		$this->brand_updated_at 	= date('Y-m-d H:i:s');
		$this->brand_updated_by 	= $this->session->userdata('login_session')['user_name'];
		$this->brand_isactive 		= $post['brand_isactive'];
		$where = array('brand_id' => $post['id_brand']);
		$this->db->where($where);
		$this->db->update($this->_table,$this);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array('brand_id' => $id));
	}

	public function codeNum()
	{
		$this->db->select('(count(brand_id)+1) as no');
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
		$this->db->from($this->_table);
		$this->db->where('brand_isactive', 'Y');
		// $this->db->order_by('ms_brand_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function setBrand()
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
}
