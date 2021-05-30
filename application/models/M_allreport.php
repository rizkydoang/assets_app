<?php 

class M_allreport extends CI_Model {

    private $_table = 'movements';

    public function cost_center($date_from=null, $date_to=null, $division =null)
	{
		$this->db->select('	movements_details.movements_details_asset_code as "asset_code",
							products.product_name as "product_name",
							brands.brand_name as "product_brand",
							categories.category_name as "category_product",
							types.type_name AS "type_product",
							branches.branch_name AS "branch_name",
							divisions.division_name AS "division_name",
							products.cost_center AS "product_cost_center"');
		$this->db->from('movements');
		$this->db->join('movements_details','movements_details.movement_id = movements.movement_id','LEFT');
		$this->db->join('receipts_details','receipts_details.receipts_details_id = movements_details.movements_details_rd_id','left');
		$this->db->join('products','products.product_id = receipts_details.receipts_details_product_id','left');
        $this->db->join('brands','brands.brand_id = products.brand_id','left');
        $this->db->join('categories','categories.category_id = products.category_id','left');
        $this->db->join('types','types.type_id = products.type_id','left');
		$this->db->join('branches','branches.branch_id = movements_details.movements_details_to_branch');
		$this->db->join('divisions','divisions.division_id = movements_details.movements_details_to_division');
        $this->db->where('movements.movement_status', 'Y');
        $this->db->where('products.cost_center', 'Y');
        $this->db->where('products.profit_center', 'N');
		if($date_from == null || $date_to == null){
			if(is_controller_and_direct()){
				if($division != null){
					$this->db->where('divisions.division_id', $division);
					$query = $this->db->get()->result();
					return $query;
				}else{
					$query = $this->db->get()->result();
					return $query;
				}
			}else{
				$this->db->where('divisions.division_id', $this->session->userdata('login_session')['divisi']);
				$query = $this->db->get()->result();
				return $query;
			}
		}else{
			if(is_controller_and_direct()){
				if($division != null){
					$this->db->where('divisions.division_id', $division);
					$this->db->where('movement_date BETWEEN "'.$date_from.'" AND "'.$date_to .'"');
					$query = $this->db->get()->result();
					return $query;
				}else{
					$this->db->where('movement_date BETWEEN "'.$date_from.'" AND "'.$date_to .'"');
					$query = $this->db->get()->result();
					return $query;
				}
			}else{
				$this->db->where('divisions.division_id', $this->session->userdata('login_session')['divisi']);
				$this->db->where('movement_date BETWEEN "'.$date_from.'" AND "'.$date_to .'"');
				$query = $this->db->get()->result();
				return $query;
			}
		}
	}


    public function profit_center($date_from=null, $date_to=null, $division =null)
	{
		$this->db->select('	movements_details.movements_details_asset_code as "asset_code",
							products.product_name as "product_name",
							brands.brand_name as "product_brand",
							categories.category_name as "category_product",
							types.type_name AS "type_product",
							branches.branch_name AS "branch_name",
							divisions.division_name AS "division_name",
							products.profit_center AS "product_profit_center"');
		$this->db->from('movements');
		$this->db->join('movements_details','movements_details.movement_id = movements.movement_id','LEFT');
		$this->db->join('receipts_details','receipts_details.receipts_details_id = movements_details.movements_details_rd_id','left');
		$this->db->join('products','products.product_id = receipts_details.receipts_details_product_id','left');
        $this->db->join('brands','brands.brand_id = products.brand_id','left');
        $this->db->join('categories','categories.category_id = products.category_id','left');
        $this->db->join('types','types.type_id = products.type_id','left');
		$this->db->join('branches','branches.branch_id = movements_details.movements_details_to_branch');
		$this->db->join('divisions','divisions.division_id = movements_details.movements_details_to_division');
        $this->db->where('movements.movement_status', 'Y');
        $this->db->where('products.cost_center', 'N');
        $this->db->where('products.profit_center', 'Y');
		
		if($date_from == null || $date_to == null){
			if(is_controller_and_direct()){
				if($division != null){
					$this->db->where('divisions.division_id', $division);
					$query = $this->db->get()->result();
					return $query;
				}else{
					$query = $this->db->get()->result();
					return $query;
				}
			}else{
				$this->db->where('divisions.division_id', $this->session->userdata('login_session')['divisi']);
				$query = $this->db->get()->result();
				return $query;
			}
		}else{
			if(is_controller_and_direct()){
				if($division != null){
					$this->db->where('divisions.division_id', $division);
					$this->db->where('movement_date BETWEEN "'.$date_from.'" AND "'.$date_to .'"');
					$query = $this->db->get()->result();
					return $query;
				}else{
					$this->db->where('movement_date BETWEEN "'.$date_from.'" AND "'.$date_to .'"');
					$query = $this->db->get()->result();
					return $query;
				}
			}else{
				$this->db->where('divisions.division_id', $this->session->userdata('login_session')['divisi']);
				$this->db->where('movement_date BETWEEN "'.$date_from.'" AND "'.$date_to .'"');
				$query = $this->db->get()->result();
				return $query;
			}
		}
	}


    public function all_report($date_from=null, $date_to=null, $division =null)
	{
		$this->db->select('	movements_details.movements_details_asset_code as "asset_code",
							products.product_name as "product_name",
							brands.brand_name as "product_brand",
							categories.category_name as "category_product",
							types.type_name AS "type_product",
							branches.branch_name AS "branch_name",
							divisions.division_name AS "division_name",
							products.cost_center AS "product_cost_center",
							products.profit_center AS "product_profit_center"');
		$this->db->from('movements');
		$this->db->join('movements_details','movements_details.movement_id = movements.movement_id','LEFT');
		$this->db->join('receipts_details','receipts_details.receipts_details_id = movements_details.movements_details_rd_id','left');
		$this->db->join('products','products.product_id = receipts_details.receipts_details_product_id','left');
        $this->db->join('brands','brands.brand_id = products.brand_id','left');
        $this->db->join('categories','categories.category_id = products.category_id','left');
        $this->db->join('types','types.type_id = products.type_id','left');
		$this->db->join('branches','branches.branch_id = movements_details.movements_details_to_branch');
		$this->db->join('divisions','divisions.division_id = movements_details.movements_details_to_division');
        $this->db->where('movements.movement_status', 'Y');
        // $this->db->where('products.cost_center', 'N');
        // $this->db->where('products.profit_center', 'Y');
		
		if($date_from == null || $date_to == null){
			if(is_controller_and_direct()){
				if($division != null){
					$this->db->where('divisions.division_id', $division);
					$query = $this->db->get()->result();
					return $query;
				}else{
					$query = $this->db->get()->result();
					return $query;
				}
			}else{
				$this->db->where('divisions.division_id', $this->session->userdata('login_session')['divisi']);
				$query = $this->db->get()->result();
				return $query;
			}
		}else{
			if(is_controller_and_direct()){
				if($division != null){
					$this->db->where('divisions.division_id', $division);
					$this->db->where('movement_date BETWEEN "'.$date_from.'" AND "'.$date_to .'"');
					$query = $this->db->get()->result();
					return $query;
				}else{
					$this->db->where('movement_date BETWEEN "'.$date_from.'" AND "'.$date_to .'"');
					$query = $this->db->get()->result();
					return $query;
				}
			}else{
				$this->db->where('divisions.division_id', $this->session->userdata('login_session')['divisi']);
				$this->db->where('movement_date BETWEEN "'.$date_from.'" AND "'.$date_to .'"');
				$query = $this->db->get()->result();
				return $query;
			}
		}
	}

	

}