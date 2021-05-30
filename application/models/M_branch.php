<?php

class M_branch extends CI_Model
{
	private $_table = 'branches';

	public function list()
	{
		$this->db->select('branches.branch_id,
							branches.branch_code,
							branches.branch_name,
							users.user_name,
							branches.branch_created_at,
							branches.branch_created_by,
							branches.branch_isactive');
		$this->db->from('branches');
		$this->db->join('users', 'users.user_id = branches.branch_leader_u_id', 'Left');
		$query = $this->db->get()->result();
		return $query;
	}

	public function save()
	{
		$post = $this->input->post();
		$this->branch_code 				= strtoupper($post['branch_code']);
		$this->branch_name 				= strtoupper($post['branch_name']);
		$this->branch_address 			= $post['branch_address'];
		$this->branch_leader_u_id		= $post['branch_leader_u_id'];
		$this->branch_telephone			= $post['branch_telephone'];
		$this->branch_created_at 		= date('Y-m-d H:i:s');
		$this->branch_created_by 		= $this->session->userdata('login_session')['user_name'];
		$this->branch_isactive 			= $post['branch_isactive'];
		$this->db->insert($this->_table,$this);
	}

	public function detail($id)
	{
		return $this->db->get_where($this->_table, array('branch_id' => $id))->row();
	}

	public function update()
	{
		$post = $this->input->post();
		$this->branch_code 				= strtoupper($post['branch_code']);
		$this->branch_name 				= strtoupper($post['branch_name']);
		$this->branch_address 			= $post['branch_address'];
		$this->branch_leader_u_id		= $post['branch_leader_u_id'];
		$this->branch_telephone			= $post['branch_telephone'];
		$this->branch_updated_at 		= date('Y-m-d H:i:s');
		$this->branch_updated_by 		= $this->session->userdata('login_session')['user_name'];
		$this->branch_isactive 			= $post['branch_isactive'];
		$where = array('branch_id' => $post['id_branch']);
		$this->db->where($where);
		$this->db->update($this->_table,$this);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array('branch_id' => $id));
	}

	public function codeNum()
	{
		$this->db->select('(count(branch_id)+1) as no');
		$this->db->from($this->_table);
		$query = $this->db->get()->result();
		return $query;
	}

	public function listBranch()
	{
		$this->db->select('branch_id,
							branch_code,
							branch_name,
							branch_address,
							branch_leader_u_id,
							branch_telephone,
							branch_created_at,
							branch_created_by,
							branch_isactive');
		$this->db->from($this->_table);
		// $this->db->join('users', 'users.branch_id = branches.branch_id', 'Left');
		$this->db->where('branch_isactive', 'Y');
		$this->db->order_by('branch_name', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function listUser()
	{
		$this->db->select('user_id,
							user_code,
							user_name,
							user_created_at,
							user_created_by,
							user_isactive');
		$this->db->from('users');
		$this->db->where('user_isactive', 'Y');
		$this->db->order_by('user_name', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function setBranch()
	{
		$this->db->select('branch_id,
							branch_code,
							branch_name,
							branch_address,
							branch_leader_u_id,
							branch_telephone,
							branch_created_at,
							branch_created_by,
							branch_isactive');
		$this->db->from('branches');
		$this->db->where('branch_isactive', 'Y');
		$query = $this->db->get()->result();
		return $query;
	}
}
