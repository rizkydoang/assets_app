<!-- <script type="text/javascript">
	var tb_inventory;
	var tb_service;
	var tb_trash;

  	$(function () {
    	tb_inventory = $('#table-inventoryall').DataTable({
    		'ajax': '<?php echo site_url('rpt_inventory/getAll') ?>',
    		'processing': true,
	        'language': {
	          'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
	        },
    		'orders': [],
    		'columnDefs': [
    			{
    				'targets': 0, //first column
    				'orderable': false, //set not orderable
    			},
    		]
    	});

			tb_service = $('#table-inventoryservice').DataTable({
    		'ajax': '<?php echo site_url('rpt_inventory/getService') ?>',
    		'processing': true,
	        'language': {
	          'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
	        },
    		'orders': [],
    		'columnDefs': [
    			{
    				'targets': 0, //first column
    				'orderable': false, //set not orderable
    			},
    		]
    	});

			tb_trash = $('#table-inventorytrash').DataTable({
    		'ajax': '<?php echo site_url('rpt_inventory/getTrash') ?>',
    		'processing': true,
	        'language': {
	          'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
	        },
    		'orders': [],
    		'columnDefs': [
    			{
    				'targets': -1, //last column
    				'orderable': false, //set not orderable
    			},
    		]
    	});
  	});

  	function reloadInventory() {
  		tb_inventory.ajax.reload(null, false);
  	}


	// function detailProduct(id){
	// 	setSave_product = 'update';
	// 	var url = '<?php echo site_url('product/getDetail/') ?>';
	// 	$.ajax({
	// 		url: url+id,
	// 		type: 'GET',
	// 		dataType: 'json',
	// 		success: function(data){
	// 			$('[name = id_product]').val(data.product_id);
	// 			$('[name = product_code]').val(data.product_code);
	// 			$('[name = product_name]').val(data.product_name);
	// 			$('[name = brand_id_product]').val(data.brand_id);
	// 			$('[name = category_id_product]').val(data.category_id);
	// 			$('[name = subcategory_id_product]').val(data.subcategory_id);
	// 			$('[name = type_id_product]').val(data.type_id);
	// 			$('[name = product_isactive]').val(data.product_isactive);
	// 			var active = document.getElementById("product_isactive").innerHTML = data.product_isactive;
	// 			if (active == "N"){
	// 				$('#product_cb').attr('checked', false);
	// 				$('#form_product input').attr('readonly', true);
	// 			}
	// 			$('#modal_product').modal({backdrop: 'static', keyboard: false});
	// 			$('.modal-title').text(data.product_name.toUpperCase());
	// 		},
	// 		error: function(jqXHR, textStatus, errorThrown){
	// 			swal('Error Get Data', 'Please try again', 'error');
	// 		}
	// 	});
	// }

</script> -->
