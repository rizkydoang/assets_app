<?php

class M_type extends CI_Model
{
	private $_table = 'types';

	public function list()
	{
		$this->db->select('types.type_id,
							types.type_code,
							types.type_name,
							categories.category_name,
							types.type_created_at,
							types.type_created_by,
							types.type_isactive');
		$this->db->from('types');
		$this->db->join('categories', 'categories.category_id = types.category_id', 'Left');
		$query = $this->db->get()->result();
		return $query;
	}
	// subcategories.subcategory_name,

	public function save()
	{
		$post = $this->input->post();
		$this->type_code 			= strtoupper($post['type_code']);
		$this->type_name 			= strtoupper($post['type_name']);
		$this->type_created_at 		= date('Y-m-d H:i:s');
		$this->type_created_by 		= $this->session->userdata('login_session')['user_name'];
		$this->type_isactive 		= $post['type_isactive'];
		// $this->subcategory_id 	= $post['subcategory_id'];
		$this->category_id			= $post['category_id'];
		$this->db->insert($this->_table,$this);
	}

	public function detail($id)
	{
		return $this->db->get_where($this->_table, array('type_id' => $id))->row();
	}

	public function update()
	{
		$post = $this->input->post();
		$this->type_code 			= strtoupper($post['type_code']);
		$this->type_name 			= strtoupper($post['type_name']);
		$this->type_updated_at 		= date('Y-m-d H:i:s');
		$this->type_updated_by 		= $this->session->userdata('login_session')['user_name'];
		$this->type_isactive 		= $post['type_isactive'];
		// $this->subcategory_id 	= $post['subcategory_id'];
		$this->category_id 	= $post['category_id'];
		$where = array('type_id' => $post['id_type']);
		$this->db->where($where);
		$this->db->update($this->_table,$this);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array('type_id' => $id));
	}

	public function codeNum()
	{
		$this->db->select('(count(type_id)+1) as no');
		$this->db->from($this->_table);
		$query = $this->db->get()->result();
		return $query;
	}

	public function listType()
	{
		$this->db->select('type_id,
							type_code,
							type_name,
							category_id,
							type_created_at,
							type_created_by,
							type_isactive');
		$this->db->from($this->_table);
		$this->db->where('type_isactive', 'Y');
		// $this->db->order_by('type_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}
	// subcategory_id,

	public function setType()
	{
		$this->db->select('type_id,
							type_code,
							type_name,
							category_id,
							type_created_at,
							type_created_by,
							type_isactive');
		$this->db->from('types');
		$this->db->where('type_isactive', 'Y');
		// $this->db->order_by('type_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}
}
