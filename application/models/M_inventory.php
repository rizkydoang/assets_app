<?php

class M_inventory extends CI_Model
{

	public function all_list()
	{
		$this->db->select('movements.movement_id ,
							movement_date,
							movements_details_asset_code,
							product_name,
							branch_name,
							division_name,
							movement_created_by');
		$this->db->from('movements');
		$this->db->join('movements_details', 'movements_details.movement_id = movements.movement_id');
		$this->db->join('receipts_details', 'receipts_details.receipts_details_id = movements_details.movements_details_rd_id');
		$this->db->join('products', 'products.product_id = receipts_details.receipts_details_product_id');
		// $this->db->join('users', 'users.user_id = movements_details.movements_details_to');
		$this->db->join('branches','branches.branch_id = movements_details.movements_details_to_branch');
		// $this->db->join('rooms', 'rooms.room_id = movements_details.movements_details_room_to');
		$this->db->join('divisions','divisions.division_id = movements_details.movements_details_to_divisions');
		$query = $this->db->get()->result();
		return $query;
	}
	 // user_name,
	//  room_name,

	// public function service_list()
	// {
	// 	$this->db->select('services_details_asset_code,
	// 										 product_name,
	// 										 service_date,
	// 										 supplier_name');
	// 	$this->db->from('services');
	// 	$this->db->join('services_details', 'services_details.service_id = services.service_id');
	// 	$this->db->join('movements_details', 'movements_details.movements_details_asset_code = services_details.services_details_asset_code');
	// 	$this->db->join('receipts_details', 'receipts_details.receipts_details_id = movements_details.movements_details_rd_id');
	// 	$this->db->join('products', 'products.product_id = receipts_details.receipts_details_product_id');
	// 	$this->db->join('suppliers', 'suppliers.supplier_id = services.supplier_id');
	// 	$query = $this->db->get()->result();
	// 	return $query;
	// }

	// public function trash_list()
	// {
	// 	$this->db->select('movements.movement_id ,
	// 										 movement_date,
	// 	                   movements_details_asset_code,
	// 										 product_name,
	// 										 movements_details_to,
	// 										 room_name,
	// 										 movement_created_by');
	// 	$this->db->from('movements');
	// 	$this->db->join('movements_details', 'movements_details.movement_id = movements.movement_id');
	// 	$this->db->join('receipts_details', 'receipts_details.receipts_details_id = movements_details.movements_details_rd_id');
	// 	$this->db->join('products', 'products.product_id = receipts_details.receipts_details_product_id');
	// 	$this->db->join('rooms', 'rooms.room_id = movements_details.movements_details_room_to');
	// 	$this->db->where('room_id','2');
	// 	$query = $this->db->get()->result();
	// 	return $query;
	// }

	public function save()
	{
		$post = $this->input->post();
		$this->product_code 				= strtoupper($post['product_code']);
		$this->product_name 				= strtoupper($post['product_name']);
		// $this->product_name 				= $post['brand_id_product'].'/'.$post['category_id_product'].'/'.$post['subcategory_id_product'].'/'.$post['type_id_product'].'/'.strtoupper($post['product_name']);
		$this->product_created_at 			= date('Y-m-d H:i:s');
		$this->product_created_by 			= $this->session->userdata('login_session')['user_name'];
		$this->product_isactive 			= $post['product_isactive'];
		$this->brand_id 					= $post['brand_id_product'];
		$this->category_id 					= $post['category_id_product'];
		$this->subcategory_id 				= $post['subcategory_id_product'];
		$this->type_id 						= $post['type_id_product'];
		$this->db->insert($this->_table,$this);
	}

	public function detail($id)
	{
		return $this->db->get_where($this->_table, array('product_id' => $id))->row();
	}

	public function update()
	{
		$post = $this->input->post();
		$this->product_code 				= strtoupper($post['product_code']);
		$this->product_name 				= strtoupper($post['product_name']);
		// $this->product_name 				= $post['brand_id_product'].'/'.$post['category_id_product'].'/'.$post['subcategory_id_product'].'/'.$post['type_id_product'].'/'.strtoupper($post['product_name']);
		$this->product_updated_at 			= date('Y-m-d H:i:s');
		$this->product_updated_by 			= $this->session->userdata('login_session')['user_name'];
		$this->product_isactive 			= $post['product_isactive'];
		$this->brand_id 					= $post['brand_id_product'];
		$this->category_id 					= $post['category_id_product'];
		$this->subcategory_id 				= $post['subcategory_id_product'];
		$this->type_id 						= $post['type_id_product'];
		$where = array('product_id' => $post['id_product']);
		$this->db->where($where);
		$this->db->update($this->_table,$this);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array('product_id' => $id));
	}

	public function codeNum()
	{
		$this->db->select('(count(product_id)+1) as no');
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

	public function listProduct()
	{
		$this->db->select('product_id,
							product_code,
							product_name,
							brand_id,
							product_created_at,
							product_created_by,
							product_isactive');
		$this->db->from($this->_table);
		$this->db->where('product_isactive', 'Y');
		// $this->db->order_by('product_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function setProduct()
	{
		$this->db->select('product_id,
							product_code,
							product_name,
							brand_id,
							category_id,
							subcategory_id,
							type_id,
							product_created_at,
							product_created_by,
							product_isactive');
		$this->db->from('products');
		$this->db->where('product_isactive', 'Y');
		// $this->db->order_by('product_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function get_subcategory($category_id) {
		$this->db->select('subcategory_id,subcategory_name');
		$this->db->from('subcategories');
		$this->db->where('category_id', $category_id);
		$query = $this->db->get()->result();
		return $query;
    }

    public function get_type($subcategory_id){
		$this->db->select('type_id,type_name');
		$this->db->from('types');
		$this->db->where('subcategory_id', $subcategory_id);
		$query = $this->db->get()->result();
		return $query;
    }

		public function get_product() {
			$id = $this->input->post('id');

			$this->db->where('product_id', $id);
			$query = $this->db->get('products');
			return $query->result();
		}
}
