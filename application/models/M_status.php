<?php

class M_status extends CI_Model
{
	private $_table = 'product_status';

    public function list()
	{
		return $this->db->get($this->_table)->result();
	}

    public function save()
	{
		$post = $this->input->post();
		$this->status_code 			= strtoupper($post['status_code']);
		$this->status_name 			= strtoupper($post['status_name']);
        $this->status_nickname		= strtoupper($post['status_nickname']);
		$this->status_created_at 	= date('Y-m-d H:i:s');
		$this->status_created_by 	= $this->session->userdata('login_session')['user_name'];
		$this->status_isactive 		= $post['status_isactive'];
		$this->db->insert($this->_table,$this);
	}

    public function detail($id)
	{
		return $this->db->get_where($this->_table, array('status_id' => $id))->row();
	}

    public function update()
	{
		$post = $this->input->post();
		$this->status_code 			= strtoupper($post['status_code']);
		$this->status_name 			= strtoupper($post['status_name']);
        $this->status_nickname		= strtoupper($post['status_nickname']);
		$this->status_created_at 	= date('Y-m-d H:i:s');
		$this->status_created_by 	= $this->session->userdata('login_session')['user_name'];
		$this->status_isactive 		= $post['status_isactive'];
		$where = array('status_id' => $post['id_status']);
		$this->db->where($where);
		$this->db->update($this->_table,$this);
	}

    public function delete($id)
	{
		return $this->db->delete($this->_table, array('status_id' => $id));
	}

    public function codeNum()
	{
		$this->db->select('(count(status_id)+1) as no');
		$this->db->from($this->_table);
		$query = $this->db->get()->result();
		return $query;
	}
}