<?php

class M_category extends CI_Model
{
	private $_table = 'categories';

	public function list()
	{
		return $this->db->get($this->_table)->result();
	}

	public function save()
	{
		$post = $this->input->post();
		$this->category_code 				= strtoupper($post['category_code']);
		$this->category_name 				= strtoupper($post['category_name']);
		$this->category_created_at 			= date('Y-m-d H:i:s');
		$this->category_created_by 			= $this->session->userdata('login_session')['user_name'];
		$this->category_isactive 			= $post['category_isactive'];
		$this->db->insert($this->_table,$this);
	}

	public function detail($id)
	{
		return $this->db->get_where($this->_table, array('category_id' => $id))->row();
	}

	public function update()
	{
		$post = $this->input->post();
		$this->category_code 				= strtoupper($post['category_code']);
		$this->category_name 				= strtoupper($post['category_name']);
		$this->category_updated_at 			= date('Y-m-d H:i:s');
		$this->category_updated_by 			= $this->session->userdata('login_session')['user_name'];
		$this->category_isactive 			= $post['category_isactive'];
		$where = array('category_id' => $post['id_category']);
		$this->db->where($where);
		$this->db->update($this->_table,$this);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array('category_id' => $id));
	}

	public function codeNum()
	{
		$this->db->select('(count(category_id)+1) as no');
		$this->db->from($this->_table);
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
		$this->db->from($this->_table);
		$this->db->where('category_isactive', 'Y');
		$this->db->order_by('category_name');
		$query = $this->db->get()->result();
		return $query;
	}

	public function setCategory()
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
}
