<?php

class M_product extends CI_Model
{
	private $_table = 'products';

	public function list()
	{
		$this->db->select('products.product_id,
							products.product_code,
							products.product_name,
							products.brand_id,
							brands.brand_name,
							categories.category_name,
							products.category_id,
							products.type_id,
							products.product_created_at,
							products.product_created_by,
							products.product_isactive,
							products.cost_center,
							products.profit_center');
		$this->db->from('products');
		$this->db->join('brands', 'brands.brand_id = products.brand_id', 'Left');
		$this->db->join('categories', 'categories.category_id = products.category_id', 'Left');
		// $this->db->join('subcategories', 'subcategories.subcategory_id = products.subcategory_id', 'Left');
		$this->db->join('types', 'types.type_id = products.type_id', 'Left');
		$query = $this->db->get()->result();
		return $query;
	}
 //    products.subcategory_id,


	public function active_list() {
		$this->db->select('products.product_id,
							products.product_code,
							products.product_name,
							products.brand_id,
							brands.brand_name,
							products.category_id,
							products.type_id,
							products.product_created_at,
							products.product_created_by,
							products.product_isactive,
							products.cost_center,
							products.profit_center');
		$this->db->from('products');
		$this->db->join('brands', 'brands.brand_id = products.brand_id', 'Left');
		$this->db->join('categories', 'categories.category_id = products.category_id', 'Left');
		// $this->db->join('subcategories', 'subcategories.subcategory_id = products.subcategory_id', 'Left');
		$this->db->join('types', 'types.type_id = products.type_id', 'Left');
		$this->db->where('product_isactive','Y');
		return $this->db->get()->result();
	}

	public function sorted_list($id) {
		$this->db->select('products.product_id,
							products.product_code,
							products.product_name,
							products.brand_id,
							brands.brand_name,
							products.category_id,
							products.type_id,
							products.product_created_at,
							products.product_created_by,
							products.product_isactive,
							products.cost_center,
							products.profit_center');
		$this->db->from('products');
		$this->db->join('brands', 'brands.brand_id = products.brand_id', 'Left');
		$this->db->join('categories', 'categories.category_id = products.category_id', 'Left');
		// $this->db->join('subcategories', 'subcategories.subcategory_id = products.subcategory_id', 'Left');
		$this->db->join('types', 'types.type_id = products.type_id', 'Left');
		$this->db->where('product_id',$id);
		return $this->db->get()->result();
	}

	public function save()
	{
		$post = $this->input->post();
		$this->product_code 				= strtoupper($post['product_code']);
		$this->product_name 				= strtoupper($post['product_name']);
		// $this->product_name 				= $post['brand_id_product'].'/'.$post['category_id_product'].'/'.$post['subcategory_id_product'].'/'.$post['type_id_product'].'/'.strtoupper($post['product_name']);
		$this->product_created_at 			= date('Y-m-d H:i:s');
		$this->product_created_by 			= $this->session->userdata('login_session')['user_name'];
		$this->product_isactive 			= $post['product_isactive'];
		if($post['cost_center'] == 'Y'){
			$this->cost_center		 			= $post['cost_center'];
			$this->profit_center	 			= 'N';
		}elseif($post['cost_center'] == 'N'){
			$this->cost_center		 			= $post['cost_center'];
			$this->profit_center	 			= 'Y';
		}
		// $this->cost_center		 			= $post['cost_center'];
		// $this->profit_center	 			= $post['profit_center'];
		$this->brand_id 					= $post['brand_id_product'];
		$this->category_id 					= $post['category_id_product'];
		// $this->subcategory_id 			= $post['subcategory_id_product'];
		$this->type_id 							= $post['type_id_product'];
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
		if($post['cost_center'] == 'Y'){
			$this->cost_center		 			= $post['cost_center'];
			$this->profit_center	 			= 'N';
		}elseif($post['cost_center'] == 'N'){
			$this->cost_center		 			= $post['cost_center'];
			$this->profit_center	 			= 'Y';
		}
		$this->brand_id 					= $post['brand_id_product'];
		$this->category_id 					= $post['category_id_product'];
		// $this->subcategory_id 			= $post['subcategory_id_product'];
		$this->type_id 							= $post['type_id_product'];
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
		$this->db->order_by('brand_name', 'ASC');
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
		$this->db->order_by('category_name', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	// public function listSubcategory()
	// {
	// 	$this->db->select('subcategory_id,
	// 						subcategory_code,
	// 						subcategory_name,
	// 						category_id,
	// 						subcategory_created_at,
	// 						subcategory_created_by,
	// 						subcategory_isactive');
	// 	$this->db->from('subcategories');
	// 	$this->db->where('subcategory_isactive', 'Y');
	// 	$this->db->where('category_id', 1);
	// 	// $this->db->order_by('subcategory_id', 'ASC');
	// 	$query = $this->db->get()->result();
	// 	return $query;
	// }

	public function listType()
	{
		$this->db->select('type_id,
							type_code,
							type_name,
							type_created_at,
							type_created_by,
							type_isactive');
		$this->db->from('types');
		$this->db->where('type_isactive', 'Y');
		// $this->db->where('subcategory_id', 3);
		$this->db->order_by('type_name', 'ASC');
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
							product_isactive,
							products.cost_center,
							products.profit_center');
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
							type_id,
							product_created_at,
							product_created_by,
							product_isactive,
							products.cost_center,
							products.profit_center');
		$this->db->from('products');
		$this->db->where('product_isactive', 'Y');
		// $this->db->order_by('product_id', 'ASC');
		$query = $this->db->get()->result();
		return $query;
	}

	// public function get_subcategory($category_id) {
	// 	$this->db->select('subcategory_id,subcategory_name');
	// 	$this->db->from('subcategories');
	// 	$this->db->where('category_id', $category_id);
	// 	$query = $this->db->get()->result();
	// 	return $query;
    // }
	
	public function get_type($type_id){
		$this->db->select('*');
		$this->db->from('types');
		$this->db->where('category_id', $type_id);
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
