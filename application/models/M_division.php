<?php

class M_division extends CI_Model
{
	private $_table = 'divisions';

	public function list()
	{
		$this->db->select('divisions.division_id,
							divisions.division_code,
							divisions.division_name,
							branches.branch_name,
							users.user_name,
							divisions.division_created_at,
							divisions.division_created_by,
							divisions.division_isactive');
		$this->db->from('divisions');
		$this->db->join('branches', 'branches.branch_id = divisions.branch_id', 'Left');
		$this->db->join('users', 'users.user_id = divisions.division_manager_u_id', 'Left');
		$query = $this->db->get()->result();
		return $query;
	}
//    divisions.division_manager,
	public function save()
	{
		$post = $this->input->post();
		$this->division_code 				= strtoupper($post['division_code']);
		$this->division_name 				= strtoupper($post['division_name']);
		$this->branch_id 					= $post['branch_id'];
		$this->division_manager_u_id 		= $post['division_manager_u_id'];
		$this->division_created_at 			= date('Y-m-d H:i:s');
		$this->division_created_by 			= $this->session->userdata('login_session')['user_name'];
		$this->division_isactive 			= $post['division_isactive'];
		// $this->branch_id 					= $post['branch_id'];
		$this->db->insert($this->_table,$this);
	}

	public function detail($id)
	{
		return $this->db->get_where($this->_table, array('division_id' => $id))->row();
	}

	public function update()
	{
		$post = $this->input->post();
		$this->division_code 				= strtoupper($post['division_code']);
		$this->division_name 				= strtoupper($post['division_name']);
		$this->branch_id 					= $post['branch_id'];
		$this->division_manager_u_id		= $post['division_manager_u_id'];
		$this->division_updated_at 			= date('Y-m-d H:i:s');
		$this->division_updated_by 			= $this->session->userdata('login_session')['user_name'];
		$this->division_isactive 			= $post['division_isactive'];
		// $this->branch_id 					= $post['branch_id'];
		$where = array('division_id' => $post['id_division']);
		$this->db->where($where);
		$this->db->update($this->_table,$this);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array('division_id' => $id));
	}

	public function codeNum()
	{
		$this->db->select('(count(division_id)+1) as no');
		$this->db->from($this->_table);
		$query = $this->db->get()->result();
		return $query;
	}

	public function listDivision()
	{
		$this->db->select('division_id,
							division_code,
							division_name,
							branch_id,
							division_manager_u_id,
							division_created_at,
							division_created_by,
							division_isactive');
		$this->db->from($this->_table);
		$this->db->where('division_isactive', 'Y');
		$this->db->order_by('division_name', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function setDivision()
	{
		$this->db->select('division_id,
							division_code,
							division_name,
							branch_id,
							division_manager_u_id,
							division_created_at,
							division_created_by,
							division_isactive');
		$this->db->from('divisions');
		$this->db->where('division_isactive', 'Y');
		// $this->db->order_by('division_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}


	public function chart_division()
	{
		$this->db->select('division_id, division_name');
		$this->db->from('divisions');
		$this->db->where('division_isactive', 'Y');
		$query = $this->db->get()->result_array();
		return $query;
	}
}
