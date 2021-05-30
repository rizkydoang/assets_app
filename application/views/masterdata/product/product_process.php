<script type="text/javascript">
	var setSave_product;
	var tb_product;
	readOnly();
	numberOnly();
	activeValue();
	// costCenter();
	// profitCenter();

	$(function () {
		tb_product = $('#table-product').DataTable({
			'ajax': '<?php echo site_url('product/getAll') ?>',
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

	function reloadProduct() {
		tb_product.ajax.reload(null, false);
	}

	function addProduct() {
		setSave_product = 'add';
		$.ajax({
			url: '<?php echo site_url('product/getNo') ?>',
			type: 'ajax',
			dataType: 'json',
			success: function(data){
				var str = data[0].no;
				while (str.length < 4) {
			str = '0' + str;
			}
				var codeNum = 'P' + str;
		$('[name = product_code]').val(codeNum);
				$('#modal_product').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text('Add New Product');
			}
		});
	}

	function saveProduct() {
		var url;
		if(setSave_product == 'add') {
			url = '<?php echo site_url('product/actAdd') ?>';
		} else {
			url = '<?php echo site_url('product/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_product').serialize(),
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn_saveProduct').attr('disabled',true);
			},
			success: function(data){
				if(data.error){
					if(data.product_code_error != ''){
						$('#product_code_error').html(data.product_code_error);
					} else {
						$('#product_code_error').html('');
					}
					if(data.product_name_error != ''){
						$('#product_name_error').html(data.product_name_error);
					} else {
						$('#product_name_error').html('');
					}
					if(data.brand_id_product_error != ''){
						$('#brand_id_product_error').html(data.brand_id_product_error);
					} else {
						$('#brand_id_product_error').html('');
					}
					if(data.category_id_product_error != ''){
						$('#category_id_product_error').html(data.category_id_product_error);
					} else {
						$('#category_id_product_error').html('');
					}
					if(data.type_id_product_error != ''){
						$('#type_id_product_error').html(data.type_id_product_error);
					} else {
						$('#type_id_product_error').html('');
					}
				}
				if(data.success) {
					$.bootstrapGrowl(data.success, {
						type: 'success',
						width: 'auto',
						offset: {from: 'top', amount: 50}
					});
					resetProduct();
					$('#modal_product').modal('hide');
					reloadProduct();
				}
				$('#btn_saveProduct').attr('disabled',false);
			},
			error: function(data){
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if(setSave_product == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

				$.bootstrapGrowl(html, {
					type: 'success',
					width: 'auto',
					offset: {from: 'top', amount: 50}
				});
				resetProduct();
				$('#modal_product').modal('hide');
				reloadProduct();
				$('#btn_saveProduct').attr('disabled',false);
			}
		});

	}

	function detailProduct(id){
		setSave_product = 'update';
		var url = '<?php echo site_url('product/getDetail/') ?>';
		$.ajax({
			url: url+id,
			type: 'GET',
			dataType: 'json',
			success: function(data){
				$('[name = id_product]').val(data.product_id);
				$('[name = product_code]').val(data.product_code);
				$('[name = product_name]').val(data.product_name);
				$('[name = brand_id_product]').val(data.brand_id);
				$('[name = category_id_product]').val(data.category_id);
				$('[name = type_id_product]').val(data.type_id);
				// $('[name = cost_center]').val(data.cost_center);
				// $('[name = profit_center]').val(data.profit_center);
				$('[name = product_isactive]').val(data.product_isactive);
				// var cost = document.getElementById("cost_center").innerHTML = data.cost_center;
				// var profit = document.getElementById("profit_center").innerHTML = data.profit_center;
				// var active = document.getElementById("product_isactive").innerHTML = data.product_isactive;
				if (data.product_isactive == "N"){
					$('#product_cb').attr('checked', false);
					$('#form_product input').attr('readonly', true);
				} else {
					$('#product_cb').attr('checked', true);
					$('#form_product input').attr('readonly', false);
				}
				if (data.cost_center == "N"){
					$('#cost_center').attr('checked', false);
				} else {
					$('#cost_center').attr('checked', true);
				}
				if (data.profit_center == "N"){
					$('#profit_center').attr('checked', false);
				} else {
					$('#profit_center').attr('checked', true);
				}
				$('#modal_product').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text(data.product_name.toUpperCase());
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal('Error Get Data', 'Please try again', 'error');
			}
		});
		
	}

	function deleteProduct(id) {
		swal({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
		},
		function(){
			$.ajax({
				url: '<?php echo site_url('product/actDelete/') ?>' +id,
				type: 'POST',
				dataType: 'JSON',
				success: function(data){
					if(data.status){
						swal({
							title: 'Deleted!',
							text: 'Your data has been deleted.',
							type: 'success',
							showConfirmButton: false,
							timer: 1000
						});
						$(this).remove(); //Remove data dari table
						reloadProduct();
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					swal({
						title: 'Error deleting !',
						text: 'Please try again',
						type: 'error',
						showConfirmButton: false,
						timer: 1500
					});
				}
			});
		});
	}

	function resetProduct()
	{
		$("#modal_product").on("hidden.bs.modal", function(){
			$('#product_code_error').html('');
			$('#product_name_error').html('');
			$('#brand_id_product_error').html('');
			$('#category_id_product_error').html('');
			// $('#subcategory_id_product_error').html('');
			$('#type_id_product_error').html('');
			$('#form_product')[0].reset();
		});
	}

	function readOnly() {
		$('#product_cb').on('change', function() {
			if ($('#product_cb').is(':checked')) {
				$('#product_cb').attr('readonly', false);
				$('#product_name').removeAttr('readonly');
			} else {
				$('#form_product input').attr('readonly', true);
			}
		});
	}

	function activeValue() {
		var ckbox = $('#product_cb');
		ckbox.attr('checked', true);
		$("input").on('change', function() {
			if (ckbox.is(':checked')) {
				return $('[name=product_isactive]').val("Y");
			} else {
				return $('[name=product_isactive]').val("N");
			}
		});
	}

	// function costCenter() {
	// 	var cost = $('#cost_center');
	// 	// ckbox.attr('checked', true);
	// 	$("input").on('change', function() {
	// 		if (cost.is(':checked') == TRUE) {
	// 			return $('[name=cost_center]').val("Y");
	// 		} else {
	// 		return $('[name=cost_center]').val("N");
	// 		}
	// 	});
	// }

	// function profitCenter() {
	// 	var profit = $('#profit_center');
	// 	// ckbox.attr('checked', true);
	// 	$("input").on('change', function() {
	// 		if (profit.is(':checked') == TRUE) {
	// 			return $('[name=profit_center]').val("Y");
	// 		} else {
	// 			return $('[name=profit_center]').val("N");
	// 		}
	// 	});
	// }

	// $(document).ready(function(){

	// 	$('#category_id_product').change(function(){
	//       	var category_id_product = $(this).val();
	//       	$.ajax({
	// 			url   : '<?php echo site_url('product/actCategoryChange/') ?>',
	// 	        method: 'post',
	// 	        data  : {category_id_product:category_id_product},
	// 	        dataType : 'json',
	// 	        success : function(data){
	// 	          	var html = '<option value="">No Selected</option>';
	// 	          	var i;
	// 	          	for(i=0; i<data.length; i++){
	// 	            	html +=  '<option value='+data[i].subcategory_id+'>'+data[i].subcategory_name+'</option>';
	// 	          	}
	// 	          	$('.subcategory').html(html);
	// 	        }
	//       	});
	//     });

	// 	$("#subcategory_id_product").change(function(){
	//       	var subcategory_id_product = $(this).val();
	//       	$.ajax({
	// 					url   : '<?php echo site_url('product/actSubcategoryChange/') ?>',
	// 	        method: 'post',
	// 	        data  : {subcategory_id_product:subcategory_id_product},
	// 	        dataType : 'json',
	// 	        success : function(data){
	// 	          	var html = '<option value="">No Selected</option>';
	// 	          	var i;
	// 	          	for(i=0; i<data.length; i++){
	// 	            	html +=  '<option value='+data[i].type_id+'>'+data[i].type_name+'</option>';
	// 	          	}
	// 	          	$('.type').html(html);
	// 	        }
	//       	});
	//     });
	// });

	$(document).ready(function(){

	$('#category_id_product').change(function(){
		var category_id_product = $(this).val();
		$.ajax({
			url   : '<?php echo site_url('product/actCategoryChange/') ?>',
			method: 'post',
			data  : {category_id_product:category_id_product},
			dataType : 'json',
			success : function(data){
				var html = '<option value="">No Selected</option>';
				var i;
				for(i=0; i<data.length; i++){
					html +=  '<option value='+data[i].type_id+'>'+data[i].type_name+'</option>';
				}
				$('.type').html(html);
			}
		});
	});

// $("#subcategory_id_product").change(function(){
// 	  var subcategory_id_product = $(this).val();
// 	  $.ajax({
// 				url   : '<?php echo site_url('product/actSubcategoryChange/') ?>',
// 		method: 'post',
// 		data  : {subcategory_id_product:subcategory_id_product},
// 		dataType : 'json',
// 		success : function(data){
// 			  var html = '<option value="">No Selected</option>';
// 			  var i;
// 			  for(i=0; i<data.length; i++){
// 				html +=  '<option value='+data[i].type_id+'>'+data[i].type_name+'</option>';
// 			  }
// 			  $('.type').html(html);
// 		}
// 	  });
// });
});
</script>
