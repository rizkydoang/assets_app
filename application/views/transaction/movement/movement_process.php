<script type="text/javascript">
	var setSave_movement;
	var tb_movements;
	readOnly();
	numberOnly();
	activeValue();

	$(function() {
		tb_movements = $('#table-movement').DataTable({
			'ajax': '<?php echo site_url('trx_movement/getAll') ?>',
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
		tb_movement_dashboard = $('#latest-movement-dashboard').DataTable({
			'ajax': '<?php echo site_url('dashboard/latesMovement') ?>',
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



	function reloadMovement() {
		tb_movements.ajax.reload(null, false);
	}

	function addMovement() {
		setSave_movement = 'add';
		$.ajax({
			url: '<?php echo site_url('trx_movement/getNo') ?>',
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

				var codeNum = 'MV' + '-' + date + '-' + str;
				$('[name = movement_code]').val(codeNum);
				$('#modal_movement').modal({
					backdrop: 'static',
					keyboard: false
				});
				$('.modal-title').text('Add New Movement');
				$('#movement_date').datepicker({
					autoclose: true,
					format: 'yyyy-mm-dd'
				}).datepicker('setDate', new Date());
			}
		});
	}

	function saveMovement() {
		var url;
		if (setSave_movement == 'add') {
			url = '<?php echo site_url('trx_movement/actAdd') ?>';
		} else {
			url = '<?php echo site_url('trx_movement/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_movement').serialize(),
			dataType: 'JSON',
			beforeSend: function() {
				$('#btn_saveMovement').attr('disabled', true);
			},
			success: function(data) {
				if (data.error) {
					if (data.movement_code_error != '') {
						$('#movement_code_error').html(data.movement_code_error);
					} else {
						$('#movement_code_error').html('');
					}
					if (data.movement_date_error != '') {
						$('#movement_date_error').html(data.movement_date_error);
					} else {
						$('#movement_date_error').html('');
					}
					if (data.movement_description_error != '') {
						$('#movement_description_error').html(data.movement_description_error);
					} else {
						$('#movement_description_error').html('');
					}
					if (data.receipt_id_movement_error != '') {
						$('#receipt_id_movement_error').html(data.receipt_id_movement_error);
					} else {
						$('#receipt_id_movement_error').html('');
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
					resetMovement();
					$('#modal_movement').modal('hide');
					reloadMovement();
				}
				$('#btn_saveMovement').attr('disabled', false);
			},
			error: function(data) {
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if (setSave_movement == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

				$.bootstrapGrowl(html, {
					type: 'success',
					width: 'auto',
					offset: {
						from: 'top',
						amount: 50
					}
				});
				$('#modal_movement').modal('hide');
				reloadMovement();
			}
		});

	}

	function saveUpdateMovement() {
		var url;
		if (setSave_movement == 'add') {
			url = '<?php echo site_url('trx_movement/actAdd') ?>';
		} else {
			url = '<?php echo site_url('trx_movement/actEdit') ?>';
		}
		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_movementupdate').serialize(),
			dataType: 'JSON',
			// beforeSend: function(){
			// 	$('#btn_saveUpdateMovement').attr('disabled',true);
			// },
			success: function(data) {
				if (data.error) {
					if (data.movement_code_error != '') {
						$('#movement_code_error').html(data.movement_code_error);
					} else {
						$('#movement_code_error').html('');
					}
					if (data.movement_date_error != '') {
						$('#movement_date_error').html(data.movement_date_error);
					} else {
						$('#movement_date_error').html('');
					}
					if (data.receipt_code_error != '') {
						$('#receipt_code_error').html(data.receipt_code_error);
					} else {
						$('#receipt_code_error').html('');
					}
					// console.log(data);
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
					resetMovement();
					$('#modal_movementupdate').modal('hide');
					reloadMovement();
				}
				$('#btn_saveMovement').attr('disabled', false);
			},
			error: function(data) {
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				console.log(data);
				var html = '';
				if (setSave_movement == 'add') {
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
				resetMovement();
				$('#modal_movementupdate').modal('hide');
				reloadMovement();
			}
		});
	}

	function editMovement(id) {
		setSave_movement = 'update';
		var url = '<?php echo site_url('trx_movement/getDetail/') ?>';
		$.ajax({
			url: url + id,
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				console.log(data);
				$('[name = movement_id]').val(data[0].movement_id);
				$('[name = movement_code]').val(data[0].movement_code);
				$('[name = movement_date]').val(data[0].movement_date);
				$('[name = movement_description]').val(data[0].movement_description);
				$('[name = receipt_id]').val(data[0].receipt_id);
				$('[name = receipt_code]').val(data[0].receipt_code);
				$('.modal-title').text(data[0].movement_code.toUpperCase());

				var html = '';
				var i;
				var no = 1;
				for (var i = 0; i < data.length; i++, no++) {
					html += '<tr>' +
						'<td class="hidden"><input type="text" name="movements_details_id[]" value="' + data[i].movements_details_id + '" readonly></td>' +
						'<td><input type="text" class="form-control" name="movement_asset_code[]" value="' + data[i].movements_details_asset_code + '" style="text-transform:uppercase" required></td>' +
						'<td><input type="text" class="form-control" value="' + data[i].product_name + '" readonly></td>' +
						'<td><input type="text" class="form-control text-center" name="movements_details_qty[]" min="1" max="1" value="1" readonly></td>' +
						'<td><input type="checkbox" name="movement_new[]" value="' + data[i].movements_details_isnew + '" checked></td>' +
						'<td><select class="form-control" name="movement_from_branch[]"><option  value="' + data[i].movements_details_from_branch + '"></option></select> </td>' +
						'<td><select class="form-control" name="movement_from_division[]"><option  value="' + data[i].movements_details_from_division + '"></option></select> </td>' +
						'<td><select class="form-control" name="movement_to_branch[]"><option  value="' + data[i].movements_details_to_branch + '" selected></option></select> </td>' +
						'<td><select class="form-control" name="movement_to_division[]"><option  value="' + data[i].movements_details_to_division + '"></select> </td>' +
						'<td><input type="text" class="form-control" name="movements_details_description[]" value="' + data[i].movements_details_description + '" placeholder="Baru"></td>' +
						'<td></td>' +
						'</tr>';
				}
				showBranchMovement();
				showDivisionMovement();
				$('#tbody_movementupdate').html(html);
				$('#modal_movementupdate').modal({
					backdrop: 'static',
					keyboard: false
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
				swal.fire('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function showBranchMovement() {
		$.ajax({
			url: '<?php echo site_url('trx_movement/actAddBranch/') ?>',
			method: 'post',
			data: {},
			dataType: 'json',
			success: function(data) {
				$("select[name='movement_from_branch[]']").each(function() {
					if (this.value == '') {
						var html = '<option value="">No Selected</option>';
						var i;
						for (i = 0; i < data.length; i++) {
							if (this.value != data[i].branch_id) {
								html += '<option value="' + data[i].branch_id + '">' + data[i].branch_name + '</option>';
							} else {
								html += '<option value="' + data[i].branch_id + '" selected>' + data[i].branch_name + '</option>';
							}
						}
						$(this).html(html);
					} else {
						var i;
						for (i = 0; i < data.length; i++) {
							if (this.value != data[i].branch_id) {
								html += '<option value="' + data[i].branch_id + '">' + data[i].branch_name + '</option>';
							} else {
								html += '<option value="' + data[i].branch_id + '" selected>' + data[i].branch_name + '</option>';
							}
						}
						$(this).html(html);
					}
				});
				$("select[name='movement_to_branch[]']").each(function() {
					if (this.value == '') {
						var html = '<option value="">No Selected</option>';
						var i;
						for (i = 0; i < data.length; i++) {
							if (this.value != data[i].branch_id) {
								html += '<option value="' + data[i].branch_id + '">' + data[i].branch_name + '</option>';
							} else {
								html += '<option value="' + data[i].branch_id + '" selected>' + data[i].branch_name + '</option>';
							}
						}
						$(this).html(html);
					} else {
						var i;
						for (i = 0; i < data.length; i++) {
							if (this.value != data[i].branch_id) {
								html += '<option value="' + data[i].branch_id + '">' + data[i].branch_name + '</option>';
							} else {
								html += '<option value="' + data[i].branch_id + '" selected>' + data[i].branch_name + '</option>';
							}
						}
						$(this).html(html);
					}
				});
			}
		});
	}



	function showDivisionMovement() {
		$.ajax({
			url: '<?php echo site_url('trx_movement/actAddDivision/') ?>',
			method: 'post',
			data: {},
			dataType: 'json',
			success: function(data) {
				$("select[name='movement_from_division[]']").each(function() {
					if (this.value == '') {
						var html = '<option value="">No Selected</option>';
						var i;
						for (i = 0; i < data.length; i++) {
							if (this.value != data[i].division_id) {
								html += '<option value="' + data[i].division_id + '">' + data[i].division_name + '</option>';
							} else {
								html += '<option value="' + data[i].division_id + '" selected>' + data[i].division_name + '</option>';
							}
						}
						$(this).html(html);
					} else {
						var i;
						for (i = 0; i < data.length; i++) {
							if (this.value != data[i].division_id) {
								html += '<option value="' + data[i].division_id + '">' + data[i].division_name + '</option>';
							} else {
								html += '<option value="' + data[i].division_id + '" selected>' + data[i].division_name + '</option>';
							}
						}
						$(this).html(html);
					}
				});
				$("select[name='movement_to_division[]']").each(function() {
					if (this.value == '') {
						var html = '<option value="">No Selected</option>';
						var i;
						for (i = 0; i < data.length; i++) {
							if (this.value != data[i].division_id) {
								html += '<option value="' + data[i].division_id + '">' + data[i].division_name + '</option>';
							} else {
								html += '<option value="' + data[i].division_id + '" selected>' + data[i].division_name + '</option>';
							}
						}
						$(this).html(html);
					} else {
						var i;
						for (i = 0; i < data.length; i++) {
							if (this.value != data[i].division_id) {
								html += '<option value="' + data[i].division_id + '">' + data[i].division_name + '</option>';
							} else {
								html += '<option value="' + data[i].division_id + '" selected>' + data[i].division_name + '</option>';
							}
						}
						$(this).html(html);
					}
				});
			}
		});
	}


	function detailMovement(id) {
		var url = '<?php echo site_url('trx_movement/getDetail/') ?>';
		$.ajax({
			url: url + id,
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				if (data[0].movement_status == 'N') {
					$('#tovoidnotcompletemovement').hide();
				} else {
					$('#tovoidnotcompletemovement').show();
				}
				$('[name = id_movement_md]').val(data[0].movement_id);
				$('[name = movement_code_md]').val(data[0].movement_code);
				$('[name = movement_date_md]').val(data[0].movement_date);
				$('[name = receipt_id_md]').val(data[0].receipt_code);
				$('.modal-title').text(data[0].movement_code.toUpperCase());

				var html = '';
				var i;
				var no = 1;
				for (var i = 0; i < data.length; i++, no++) {
					html += '<tr>' +
						'<td class="hidden">' + data[i].movements_details_id + '</td>' +
						'<td>' + no + '</td>' +
						'<td>' + data[i].movements_details_asset_code + '</td>' +
						'<td>' + data[i].product_name + '</td>' +
						'<td>1</td>' +
						'<td>' + data[i].movements_details_isnew + '</td>' +
						'<td>' + data[i].from_branch + '</td>' +
						'<td>' + data[i].from_division + '</td>' +
						'<td>' + data[i].to_branch + '</td>' +
						'<td>' + data[i].to_division + '</td>' +
						'<td>' + data[i].movements_details_description + '</td>' +
						'</tr>';
				}
				$('#tbody_movementdetail').html(html);
				$('#modal_movementdetail').modal({
					backdrop: 'static',
					keyboard: false
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
				swal('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function completeMovement(id) {
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
					url: '<?php echo site_url('trx_movement/actComplete/') ?>' + id,
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
							reloadMovement();
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

	function deleteMovement(id) {
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
					url: '<?php echo site_url('trx_movement/actDeleteNotMovement/') ?>' + id,
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
							reloadMovement();
							$('#modal_movementdetail').modal('hide');
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
							type: 'error',
							showConfirmButton: false,
							timer: 1500
						});
					}
				});
			}
		});
	}

	function resetMovement() {
		$("#modal_movement").on("hidden.bs.modal", function() {
			$('#movement_code').html('');
			$('#movement_date').html('');
			$('#movement_description').html('');
			$('#receipt_id_movement').val('');
			$('#movement_code_error').html('');
			$('#movement_date_error').html('');
			$('#movement_description_error').html('');
			$('#form_movement')[0].reset();
			$('#tbody_movement').html('');
		});
	}

	function resetUpdateMovement() {
		$("#modal_movementupdate").on("hidden.bs.modal", function() {
			$('#movement_code').html('');
			$('#movement_date').html('');
			$('#movement_description').html('');
			$('#receipt_id_movement').val('');
			$('#movement_code_error').html('');
			$('#movement_date_error').html('');
			$('#movement_description_error').html('');
			$('#form_movement')[0].reset();
			$('#tbody_movement').html('');
		});
	}

	function readOnly() {
		$('input[type="checkbox"]').on('change', function() {});
	}

	function activeValue() {
		var ckbox = $('#movement_cb');
		ckbox.attr('checked', true);
		$("input").on('change', function() {
			if (ckbox.is(':checked')) {
				$('[name=movement_isactive]').val("Y");
			} else {
				$('[name=movement_isactive]').val("N");
			}
		});
	}


	function showProductMovement() {
		$.ajax({
			url: '<?php echo site_url('trx_movement/actAddProduct/') ?>',
			method: 'post',
			data: {},
			dataType: 'json',
			success: function(data) {
				$("select[name='receipts_details_id[]']").each(function() {
					if (this.value == '') {
						var html = '<option value="">No Selected</option>';
						var i;
						for (i = 0; i < data.length; i++) {
							html += '<option value=' + data[i].product_id + '>' + data[i].product_name + '</option>';
						}
						$(this).html(html);
					}
				});
			}
		});
	}

	// function showUserMovement(){
	// 	$.ajax({
	// 		url   : '<?php echo site_url('trx_movement/actAddUser/') ?>',
	// 		method: 'post',
	// 		data  : {},
	// 		dataType : 'json',
	// 		success : function(data){
	// 			$("select[name='movement_from[]']").each(function(){
	// 			  if (this.value == '') {
	// 					var html = '<option value="">No Selected</option>';
	// 					var i;
	// 					for(i=0; i<data.length; i++){
	// 						html +=  '<option value='+data[i].user_id+'>'+data[i].user_name+'</option>';
	// 					}
	// 					$(this).html(html);
	// 				}
	// 			});
	// 			$("select[name='movement_to[]']").each(function(){
	// 			  if (this.value == '') {
	// 					var html = '<option value="">No Selected</option>';
	// 					var i;
	// 					for(i=0; i<data.length; i++){
	// 						html +=  '<option value='+data[i].user_id+'>'+data[i].user_name+'</option>';
	// 					}
	// 					$(this).html(html);
	// 				}
	// 			});
	// 		}
	// 	});
	// }


	// function showRoomMovement(){
	// 	$.ajax({
	// 		url   : '<?php echo site_url('trx_movement/actAddRoom/') ?>',
	// 		method: 'post',
	// 		data  : {},
	// 		dataType : 'json',
	// 		success : function(data){
	// 			$("select[name='room_from[]']").each(function(){
	// 			  if (this.value == '') {
	// 					var html = '<option value="">No Selected</option>';
	// 					var i;
	// 					for(i=0; i<data.length; i++){
	// 						html +=  '<option value='+data[i].room_id+'>'+data[i].room_name+'</option>';
	// 					}
	// 					$(this).html(html);
	// 				}
	// 			});
	// 			$("select[name='room_to[]']").each(function(){
	// 			  if (this.value == '') {
	// 					var html = '<option value="">No Selected</option>';
	// 					var i;
	// 					for(i=0; i<data.length; i++){
	// 						html +=  '<option value='+data[i].room_id+'>'+data[i].room_name+'</option>';
	// 					}
	// 					$(this).html(html);
	// 				}
	// 			});
	// 		}
	// 	});
	// }


	$(document).on('click', '#form_movement .add_button', function(e) {
		e.preventDefault();
		var html =
			'<tr id="extra_row">' +
			'<td><input type="text"	class="form-control" name="movement_asset_code[]" required></td>' +
			'<td> <select class="product form-control" name="receipts_details_id[]"></select> </td>' +
			'<td><input type="text" class="form-control text-center" name="movements_details_qty[]" min="1" max="1" value="1" readonly></td>' +
			'<td><input type="checkbox" name="movement_new[]" value="N"></td>' +
			// '<td> <select class="form-control" name="movement_from[]"></select> </td>'+
			'<td> <select class="form-control" name="movement_from_branch[]"></select> </td>' +
			'<td> <select class="form-control" name="movement_from_division[]"></select> </td>' +
			// '<td> <select class="form-control" name="room_from[]"></select> </td>'+
			// '<td> <select class="form-control" name="movement_to[]"></select> </td>'+
			'<td> <select class="form-control" name="movement_to_branch[]"></select> </td>' +
			'<td> <select class="form-control" name="movement_to_division[]"></select> </td>' +
			// '<td> <select class="form-control" name="room_to[]"></select> </td>'+
			'<td><input type="text" class="form-control" name="movements_details_description[]" placeholder="Rusak / Baru"></td>' +
			'<td><a href="javascript:void(0)" class="btn btn-danger btn-sm remove_button"><i class="fa fa-times"></i></a></td>' +
			'</tr>';
		$('#tbody_movement').append(html);
		showProductMovement();
		// showUserMovement();
		showBranchMovement();
		showDivisionMovement();
		// showRoomMovement();
	});


	$(document).on('click', '.remove_button', function(e) {
		e.preventDefault();
		$(this).closest("tr").remove();
	});

	$('#product_id_movement').change(function() {
		var id = $(this).val();
		$.ajax({
			url: '<?php echo base_url('trx_movement/getProduct'); ?>',
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

	$('#receipt_id_movement').change(function(e) {
		e.preventDefault();
		var receipt_id = $(this).val();
		$.ajax({
			method: 'post',
			data: {
				receipt_id: receipt_id
			},
			url: '<?php echo site_url('trx_movement/actReceiptChange') ?>',
			dataType: 'json',
			success: function(data) {
				if (receipt_id == '') {
					var html = '';
					$('#tbody_movement').html(html);
				} else {
					var html = '';
					var i;
					$('#movement_description').val(data[0].receipt_description)
					let number = 0;
					for (var i = 0; i < data.length; i++) {
						for (j = 0; j < data[i].receipts_details_qty; j++) {
							number++;
							html += '<tr>' +
								'<td class="hidden"><input type="text" name="receipts_details_id[]" value="' + data[i].receipts_details_id + '" readonly></td>' +
								'<td width="10px">' + number + '</td>' +
								'<td><input type="text" 	class="form-control" 	name="movement_asset_code[]" style="text-transform:uppercase" required></td>' +
								'<td><input type="text" class="form-control" value="' + data[i].product_name + '" readonly></td>' +
								'<td><input type="text" class="form-control text-center" 	name="movements_details_qty[]" min="1" max="1" value="1" readonly></td>' +
								'<td><input type="checkbox" name="movement_new[]" value="Y" checked></td>' +
								'<td> <select class="form-control" name="movement_from_branch[]"></select> </td>' +
								'<td> <select class="form-control" name="movement_from_division[]"></select> </td>' +
								'<td> <select class="form-control" name="movement_to_branch[]"></select> </td>' +
								'<td> <select class="form-control" name="movement_to_division[]"></select> </td>' +
								'<td><input type="text" class="form-control" name="movements_details_description[]" placeholder="Baru"></td>' +
								'</tr>';
						}
						$('#tbody_movement').html(html);
					}
					// showUserMovement();
					showBranchMovement();
					showDivisionMovement();
					// showRoomMovement();
				}
			}
		});
	});

	// function tovoidmovement() {
	// 	var id_movement = document.getElementById("id_movement_md").value;
	// 	document.getElementById('tovoidnotcompletemovement').href = 'trx_movement/actdeletenotmovement/' + id_movement;
	// 	console.log(id_movement);
	// }

	$('#tovoidnotcompletemovement').click(function(evt) {
		var id_movement = $("#id_movement_md").val();
		deleteMovement(id_movement);
	})
</script>
