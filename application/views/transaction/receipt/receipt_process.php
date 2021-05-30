<script type="text/javascript">
	var setSave_receipt;
	var tb_receipt;
	readOnly();
	numberOnly();
	activeValue();

	$(function() {
		tb_receipt = $('#table-receipt').DataTable({
			'ajax': '<?php echo site_url('trx_receipt/getAll') ?>',
			'processing': true,
			'language': {
				'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
			},
			'orders': [],
			'columnDefs': [{
				'targets': -1, //last column
				'orderable': false, //set not orderable
			}, ]
		});
	});


	$(function() {
		tb_receipt_dashboard = $('#latest-receipt-dashboard').DataTable({
			'ajax': '<?php echo site_url('dashboard/latesReceipt') ?>',
			'processing': true,
			'language': {
				'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
			},
			'orders': [],
			'columnDefs': [{
				'targets': -1, //last column
				'orderable': false, //set not orderable
			}, ]
		});
	});

	function reloadReceipt() {
		tb_receipt.ajax.reload(null, false);
	}

	function addReceipt() {
		setSave_receipt = 'add';
		$.ajax({
			url: '<?php echo site_url('trx_receipt/getNo') ?>',
			type: 'ajax',
			dataType: 'json',
			success: function(data) {
				var str = data[0].no;
				while (str.length < 4) {
					str = '0' + str;
				}

				var now = new Date();
				var month = now.getMonth();
				var year = now.getFullYear();
				month = (month + 1).toString();

				if (month.length === 1) {
					month = '0' + month;
				}
				year = year.toString().substr(-2);
				var date = year + '' + month;

				var codeNum = 'RC' + '-' + date + '-' + str;
				$('[name = receipt_code]').val(codeNum);
				$('#modal_receipt').modal({
					backdrop: 'static',
					keyboard: false
				});
				$('.modal-title').text('Add New Receipt');
				$('#receipt_date').datepicker({
					autoclose: true,
					format: 'yyyy-mm-dd'
				}).datepicker('setDate', new Date());
			}
		});
	}

	// function editReceipt(id){
	// 	setSave_receipt = 'update';
	// 	var url = '<?php echo site_url('trx_receipt/getDetail/') ?>';
	// 	$.ajax({
	// 		url: url+id,
	// 		type: 'GET',
	// 		dataType: 'json',
	// 		success: function(data){
	// 			$('[name = id_receipt]').val(data[0].receipt_id);
	// 			$('[name = receipt_code]').val(data[0].receipt_code);
	// 			$('[name = invoice_number]').val(data[0].invoice_number);
	// 			$('[name = receipt_date]').val(data[0].receipt_date);
	// 			$('[name = supplier_id_receipt]').val(data[0].supplier_id);
	// 			$('[name = receipt_description]').val(data[0].receipt_description);
	// 			$('.modal-title').text(data[0].receipt_code.toUpperCase());

	// 			var html = '';
	// 			var i;
	// 			for (var i=0; i<data.length; i++){
	// 				html += '<tr>'+
	// 				'<td class="hidden"><input type="text" class="form-control" name="receipts_details_id[]" value="'+data[i].receipts_details_id+'"></td>'+
	// 				'<td> <select class="form-control" name="receipts_details_product_id[]" value="'+data[i].receipts_details_product_id+'"></select> </td>'+
	// 				'<td> <select class="qty form-control" name="receipts_details_qty[]"><option value="1">1</option> <option value="2" selected>2</option></select> </td>'+
	// 				'<td><input type="text" class="form-control" name="receipts_details_price[]" value="'+data[i].receipts_details_price+'"></td>'+
	// 				'<td><a href="javascript:void(0)" class="btn btn-danger btn-sm remove_button"><i class="fa fa-times"></i></a></td>'+
	// 				'</tr>';
	// 				console.log(data[i].receipts_details_qty);
	// 			}
	// 			$('#tbody_receipt').html(html);
	// 			$('#modal_receipt').modal({backdrop: 'static', keyboard: false});
	// 			showProductReceipt();
	// 			// showQtyReceipt();
	// 		},
	// 		error: function(jqXHR, textStatus, errorThrown){
	// 			swal.fire('Error Get Data', 'Please try again', 'error');
	// 		}
	// 	});
	// }

	function saveReceipt() {
		var url;
		if (setSave_receipt == 'add') {
			url = '<?php echo site_url('trx_receipt/actAdd') ?>';
		} else {
			url = '<?php echo site_url('trx_receipt/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_receipt').serialize(),
			dataType: 'JSON',
			beforeSend: function() {
				$('#btn_saveReceipt').attr('disabled', true);
			},
			success: function(data) {
				if (data.error) {
					if (data.receipt_code_error != '') {
						$('#receipt_code_error').html(data.receipt_code_error);
					} else {
						$('#receipt_code_error').html('');
					}
					if (data.invoice_number_error != '') {
						$('#invoice_number_error').html(data.invoice_number_error);
					} else {
						$('#invoice_number_error').html('');
					}
					if (data.supplier_id_receipt_error != '') {
						$('#supplier_id_receipt_error').html(data.supplier_id_receipt_error);
					} else {
						$('#supplier_id_receipt_error').html('');
					}
					if (data.receipt_description_error != '') {
						$('#receipt_description_error').html(data.receipt_description_error);
					} else {
						$('#receipt_description_error').html('');
					}
					if (data.receipts_details_product_id_error != '') {
						$('#receipts_details_product_id_error').html(data.receipts_details_product_id_error);
					} else {
						$('#receipts_details_product_id_error').html('');
					}
				}
				if (data.success) {
					$.bootstrapGrowl(data.success, {
						type: 'success',
						width: 'auto',
						offset: {
							from: 'top',
							amount: 50
						}
					});
					resetReceipt();
					$('#modal_receipt').modal('hide');
					reloadReceipt();
				}
				$('#btn_saveReceipt').attr('disabled', false);
			},
			error: function(data) {
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if (setSave_receipt == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

				$.bootstrapGrowl(html, {
					type: 'error',
					width: 'auto',
					offset: {
						from: 'top',
						amount: 50
					}
				});
				$('#modal_receipt').modal('hide');
				$('#btn_saveReceipt').attr('disabled', false);
				reloadReceipt();
				resetReceipt();
			}
		});

	}

	function showProductReceipt() {
		$.ajax({
			url: '<?php echo site_url('trx_receipt/actAddProduct/') ?>',
			method: 'post',
			data: {},
			dataType: 'json',
			success: function(data) {
				$("select[name='receipts_details_product_id[]']").each(function() {
					if (this.value == '') {
						var html = '<option value="">No Selected</option>';
						var i;
						for (i = 0; i < data.length; i++) {
							if (this.value != data[i].product_id) {
								html += '<option value="' + data[i].product_id + '">' + data[i].product_name + '</option>';
							} else {
								html += '<option value="' + data[i].product_id + '" selected>' + data[i].product_name + '</option>';
							}
						}
						$(this).html(html);
					} else {
						var i;
						for (i = 0; i < data.length; i++) {
							if (this.value != data[i].product_id) {
								html += '<option value="' + data[i].product_id + '">' + data[i].product_name + '</option>';
							} else {
								html += '<option value="' + data[i].product_id + '" selected>' + data[i].product_name + '</option>';
							}
						}
						$(this).html(html);
					}
				});
			}
		});
	}

	// function showQtyReceipt() {
	// 	$("select[name='receipts_details_qty[]']").each(function() {
	// 		if (this.value == '') {
	// 			var html = '';
	// 			var i;
	// 			for (i = 1; i < 11; i++) {
	// 				html += '<option value=' + i + '>' + i + '</option>';
	// 			}
	// 			$(this).html(html);
	// 		}
	// 	});
	// }

	function editReceipt(id) {
		setSave_receipt = 'update';
		var url = '<?php echo site_url('trx_receipt/getDetail/') ?>';
		$.ajax({
			url: url + id,
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				// console.log(data);
				$('[name = id_receipt]').val(data[0].receipt_id);
				$('[name = receipt_code]').val(data[0].receipt_code);
				$('[name = invoice_number]').val(data[0].invoice_number);
				$('[name = receipt_date]').val(data[0].receipt_date);
				$('[name = supplier_id_receipt]').val(data[0].supplier_id);
				$('[name = receipt_description]').val(data[0].receipt_description);
				$('.modal-title').text(data[0].receipt_code.toUpperCase());

				var html = '';
				var i;
				for (var i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td class="hidden"><input type="text" class="form-control" name="receipts_details_id[]" value="' + data[i].receipts_details_id + '"></td>' +
						'<td> <select class="form-control" name="receipts_details_product_id[]" ><option value="' + data[i].receipts_details_product_id + '" >' + data[i].product_name + '</option> </select></td>' +
						'<td> <input type="text" class="qty form-control" name="receipts_details_qty[]"value="' + data[i].receipts_details_qty + '"></td>' +
						'<td> <input type="text" class="form-control rupiah" name="receipts_details_price[]" value="' + data[i].receipts_details_price + '"></td>' +
						'<td><a onclick="deleteReceiptDetail(' + data[i].receipts_details_id + ')" class="btn btn-danger btn-sm remove_button"><i class="fa fa-times"></i></a></td>' +
						'</tr>';
				}
				$('#tbody_receipt').html(html);
				$('#modal_receipt').modal({
					backdrop: 'static',
					keyboard: false
				});
				showProductReceipt();
				// showQtyReceipt();
				rupiah();
			},
			error: function(jqXHR, textStatus, errorThrown) {
				swal.fire('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function detailReceipt(id) {
		var url = '<?php echo site_url('trx_receipt/getDetail/') ?>';
		$.ajax({
			url: url + id,
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				if (data[0].receipt_status == 'N') {
					$('#tovoidnotcomplete').hide();
				} else {
					$('#tovoidnotcomplete').show();
				}
				$('[name = id_receipt_rd]').val(data[0].receipt_id);
				$('[name = receipt_code_rd]').val(data[0].receipt_code);
				$('[name = invoice_number_rd]').val(data[0].invoice_number);
				$('[name = receipt_date_rd]').val(data[0].receipt_date);
				$('[name = supplier_name_rd]').val(data[0].supplier_name);
				$('[name = receipt_description_rd]').val(data[0].receipt_description);
				$('.modal-title').text(data[0].receipt_code.toUpperCase());
				var html = '';
				var i;
				var no = 1;
				for (var i = 0; i < data.length; i++, no++) {
					html += '<tr>' +
						'<td class="hidden">' + data[i].receipts_details_id + '</td>' +
						'<td>' + no + '</td>' +
						'<td>' + data[i].product_name + '</td>' +
						'<td>' + data[i].receipts_details_qty + '</td>' +
						'<td>' + data[i].receipts_details_price + '</td>' +
						'</tr>';
				}
				$('#tbody_receiptdetail').html(html);
				$('#modal_receiptdetail').modal({
					backdrop: 'static',
					keyboard: false
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
				swal.fire('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function completeReceipt(id) {
		swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, complete it!'
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					url: '<?php echo site_url('trx_receipt/actComplete/') ?>' + id,
					type: 'POST',
					dataType: 'JSON',
					success: function(data) {
						if (data.status) {
							swal.fire({
								title: 'Completed!',
								text: 'Your data has been completed.',
								icon: 'success',
								showConfirmButton: false,
								timer: 1500
							});
							reloadReceipt();
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						swal.fire({
							title: 'Error completing !',
							text: 'Please try again',
							icon: 'error',
							showConfirmButton: false,
							timer: 1500
						});
					}
				});
			}
		});
	}

	function deleteReceipt(id) {
		swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Void it!'
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					url: '<?php echo site_url('trx_receipt/actDeleteNotMovement/') ?>' + id,
					type: 'POST',
					dataType: 'JSON',
					success: function(data) {
						if (data.status) {
							swal.fire({
								title: 'Success!',
								text: data.pesan,
								icon: 'success',
								showConfirmButton: false,
								timer: 1000
							});
							$(this).remove(); //Remove data dari table
							reloadReceipt();
							$('#modal_receiptdetail').modal('hide');
						} else {
							swal.fire({
								title: 'Failed!',
								text: data.pesan,
								icon: 'error',
								showConfirmButton: false,
								timer: 2000
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						swal.fire({
							title: 'Error deleting !',
							text: 'Please try again',
							icon: 'error',
							showConfirmButton: false,
							timer: 1500
						});
					}
				});
			}
		});
	}

	function deleteReceiptDetail(id) {
		$.ajax({
			url: '<?php echo site_url('trx_receipt/delete_product_details_id/') ?>' + id,
			type: 'POST',
			dataType: 'JSON',
			success: function(data) {
				if (data.status) {
					swal.fire({
						title: 'Deleted!',
						text: 'Your data has been deleted.',
						icon: 'success',
						showConfirmButton: false,
						timer: 1000
					});
					$(this).remove(); //Remove data dari table
					reloadReceipt();
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				swal.fire({
					title: 'Error deleting !',
					text: 'Please try again',
					icon: 'error',
					showConfirmButton: false,
					timer: 1500
				});
			}
		});
	}

	function resetReceipt() {
		$("#modal_receipt").on("hidden.bs.modal", function() {
			$('#receipt_code_error').html('');
			$('#invoice_number_error').html('');
			$('#invoice_date_error').html('');
			$('#supplier_id_receipt_error').html('');
			$('#receipt_date_error').html('');
			$('#receipt_description_error').html('');
			$('#receipts_details_product_id_error').html('');
			$('#form_receipt')[0].reset();
			$('#tbody_receipt').html('');
		});

	}

	function readOnly() {
		$('#receipt_cb').on('change', function() {
			if ($('#receipt_cb').is(':checked')) {
				$('#form_receipt input').attr('readonly', false);
			} else {
				$('#form_receipt input').attr('readonly', true);
			}
		});
	}

	function activeValue() {
		var ckbox = $('#receipt_cb');
		ckbox.attr('checked', true);
		$("input").on('change', function() {
			if (ckbox.is(':checked')) {
				$('[name=receipt_isactive]').val("Y");
			} else {
				$('[name=receipt_isactive]').val("N");
			}
		});
	}

	$(document).on('click', '#form_receipt .add_button', function(e) {
		e.preventDefault();
		var html =
			'<tr id="extra_row">' +
			'<td> <select class="form-control" name="receipts_details_product_id[]"></select> </td>' +
			// '<td> <select class="form-control" name="receipts_details_qty[]"></select> </td>' +
			'<td><input type="text" maxlength="3" class="form-control" name="receipts_details_qty[]" data-a-dec="," data-a-sep="."></td>' +
			'<td><input type="text" class="form-control rupiah" name="receipts_details_price[]" data-a-dec="," data-a-sep="."></td>' +
			'<td><a href="javascript:void(0)" class="btn btn-danger btn-sm remove_button"><i class="fa fa-times"></i></a></td>' +
			'</tr>';
		$('#tbody_receipt').append(html);
		showProductReceipt();
		// showQtyReceipt();
		rupiah();
	});

	$(document).ready(function() {
		$('[name=receipts_details_price]').autoNumeric('init', {
			aSep: '.',
			aDec: ',',
			mDec: '0'
		});

		$('#category_id_receipt').change(function() {
			var category_id_receipt = $(this).val();
			$.ajax({
				url: '<?php echo site_url('trx_receipt/actCategoryChange/') ?>',
				method: 'post',
				data: {
					category_id_receipt: category_id_receipt
				},
				dataType: 'json',
				success: function(data) {
					var html = '<option value="">No Selected</option>';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].subcategory_id + '>' + data[i].subcategory_name + '</option>';
					}
					$('.subcategory').html(html);
				}
			});
		});

		$("#subcategory_id_receipt").change(function() {
			var subcategory_id_receipt = $(this).val();
			$.ajax({
				url: '<?php echo site_url('trx_receipt/actSubcategoryChange/') ?>',
				method: 'post',
				data: {
					subcategory_id_receipt: subcategory_id_receipt
				},
				dataType: 'json',
				success: function(data) {
					var html = '<option value="">No Selected</option>';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].subcategory_id + '>' + data[i].subcategory_name + '</option>';
					}
					$('.receipt').html(html);
				}
			});
		});
	});


	$('#product_id_receipt').change(function() {
		var id = $(this).val();
		$.ajax({
			url: '<?php echo base_url('trx_receipt/getProduct'); ?>',
			method: 'post',
			data: {
				id: id
			},
			async: true,
			dataType: 'json',
			success: function(data) {
				var name = '';
				var price = '';
				var i;
				for (i = 0; i < data.length; i++) {
					name += data[i].product_name;
				}
				$('#name').val(name);
			}
		});
	});

	$('#tovoidnotcomplete').click(function(evt) {
		var id_receipt = $("#id_receipt_rd").val();
		deleteReceipt(id_receipt);
	})
</script>
