<?php

class M_user extends CI_Model
{
	private $_table = 'users';

	public function user_joinlist() {
		$this->db->select('user_id,
							user_code,
							user_name,
							branch_name,
							division_name,
							password,
							users.branch_id,
							users.division_id,
							user_created_at,
							user_created_by,
							user_isactive');
		$this->db->from($this->_table);
		$this->db->join('branches','branches.branch_id = users.branch_id','left');
		$this->db->join('divisions','divisions.division_id = users.division_id','left');
		// $this->db->join('rooms','rooms.room_id = users.room_id','left');
		$this->db->order_by('user_name', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}
	public function jumlahTotalUsers(){
		$total = $this->db->count_all('users');
		return $total;
	}
	public function user_list() {
		return $this->db->get($this->_table)->result();
	}

	public function create() {
		$post = $this->input->post();
		$this->user_code 				= strtoupper($post['user_code']);
		$this->user_name 				= strtoupper($post['user_name']);
		$this->password 				= password_hash(strtoupper($post['password']),PASSWORD_BCRYPT);
		$this->branch_id 				= $post['branch_id_user'];
		$this->division_id 				= $post['division_id_user'];
		$this->user_created_at 			= date('Y-m-d H:i:s');
		$this->user_created_by 			= $this->session->userdata('login_session')['user_name'];
		$this->user_isactive 		= $post['user_isactive'];
		$this->db->insert($this->_table,$this);
	}

	public function read($id) {
		return $this->db->get_where($this->_table, array('user_id' => $id))->row();
	}

	public function update() {
		$post = $this->input->post();
		$this->user_code 				= strtoupper($post['user_code']);
		$this->user_name 				= strtoupper($post['user_name']);
		if ($this->get_password_byid($post['id_user']) == $post['password']){
			$this->password 			= $post['password'];
		}else{
			$this->password 			= password_hash($post['password'], PASSWORD_BCRYPT);
		}
		$this->branch_id 				= $post['branch_id_user'];
		$this->division_id 				= $post['division_id_user'];
		$this->user_updated_at 			= date('Y-m-d H:i:s');
		$this->user_updated_by 			= $this->session->userdata('login_session')['user_name'];
		$this->user_isactive 			= $post['user_isactive'];
		$where = array('user_id' => $post['id_user']);
		$this->db->where($where);
		$this->db->update($this->_table,$this);
	}

	public function delete($id) {
		$this->db->set('user_isactive','N');
		$this->db->where('user_id', $id);
		return $this->db->update($this->_table);
	}

	public function sequence_num() {
		$this->db->select('(count(user_id)+1) as no');
		$this->db->from($this->_table);
		$query = $this->db->get()->result();
		return $query;
	}

	public function cek_user($username)
    {
        $query = $this->db->get_where($this->_table, ['user_name' => $username]);
        return $query->num_rows();
    }

	public function get_password($username)
    {
        $data = $this->db->get_where($this->_table, ['user_name' => $username])->row_array();
        return $data['password'];
    }

	public function get_password_byid($id)
    {
        $data = $this->db->get_where($this->_table, ['user_id' => $id])->row_array();
        return $data['password'];
    }

	public function userdata($username)
    {
		$this->db->select('user_id,
							user_code,
							user_name,
							branch_name,
							division_name,
							password,
							users.branch_id AS branch_id,
							users.division_id AS division_id,
							user_created_at,
							user_created_by,
							user_isactive');
		$this->db->from($this->_table);
		$this->db->join('branches','branches.branch_id = users.branch_id','left');
		$this->db->join('divisions','divisions.division_id = users.division_id','left');
		$this->db->where('user_name', $username);
		$query = $this->db->get()->row_array();
		return $query;
        // return $this->db->get_where('users', ['user_name' => $username])->row_array();
    }

}
