<script type="text/javascript">
	var setSave_user;
	var tb_user;
	readOnly();
	numberOnly();
	activeValue();

	$(function () {
		tb_user = $('#table-user').DataTable({
			'ajax': '<?php echo site_url('user/getAll') ?>',
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

	function reloadUser() {
		tb_user.ajax.reload(null, false);
	}

	function addUser() {
		setSave_user = 'add';
		$.ajax({
			url: '<?php echo site_url('user/getNo') ?>',
			type: 'ajax',
			dataType: 'json',
			success: function(data){
				var str = data[0].no;
				while (str.length < 3) {
			str = '0' + str;
			}
				var codeNum = 'US' + str;
		$('[name = user_code]').val(codeNum);
				$('#modal_user').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text('Add New User');
			}
		});
	}

	function saveUser() {
		var url;
		if(setSave_user == 'add') {
			url = '<?php echo site_url('user/actAdd') ?>';
		} else {
			url = '<?php echo site_url('user/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_user').serialize(),
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn_saveUser').attr('disabled',true);
			},
			success: function(data){
				if(data.error){
					if(data.user_code_error != ''){
						$('#user_code_error').html(data.user_code_error);
					} else {
						$('#user_code_error').html('');
					}
					if(data.user_name_error != ''){
						$('#user_name_error').html(data.user_name_error);
					} else {
						$('#user_name_error').html('');
					}
					if(data.password_error != ''){
						$('#password_error').html(data.password_error);
					} else {
						$('#password_error').html('');
					}
					if(data.branch_id_user_error != ''){
						$('#branch_id_user_error').html(data.branch_id_user_error);
					} else {
						$('#branch_id_user_error').html('');
					}
					if(data.division_id_user_error != ''){
						$('#division_id_user_error').html(data.division_id_user_error);
					} else {
						$('#division_id_user_error').html('');
					}
					// if(data.room_id_user_error != ''){
					// 	$('#room_id_user_error').html(data.room_id_user_error);
					// } else {
					// 	$('#room_id_user_error').html('');
					// }
				}
				if(data.success) {
					$.bootstrapGrowl(data.success, {
						type: 'success',
						width: 'auto',
						offset: {from: 'top', amount: 50}
					});
					resetUser();
					$('#modal_user').modal('hide');
					reloadUser();
				}
				$('#btn_saveUser').attr('disabled',false);
			},
			error: function(data){
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if(setSave_user == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

				$.bootstrapGrowl(html, {
					type: 'success',
					width: 'auto',
					offset: {from: 'top', amount: 50}
				});
				$('#modal_user').modal('hide');
			}
		});

	}

	function detailUser(id){
		setSave_user = 'update';
		var url = '<?php echo site_url('user/getDetail/') ?>';
		$.ajax({
			url: url+id,
			type: 'GET',
			dataType: 'json',
			success: function(data){
				$('[name = id_user]').val(data.user_id);
				$('[name = user_code]').val(data.user_code);
				$('[name = user_name]').val(data.user_name);
				$('[name = password]').val(data.password);
				$('[name = branch_id_user]').val(data.branch_id);
				$('[name = division_id_user]').val(data.division_id);
				// $('[name = room_id_user]').val(data.room_id);
				$('[name = user_isactive]').val(data.user_isactive);
				var active = document.getElementById("user_isactive").innerHTML = data.user_isactive;
				if (active == "N"){
					$('#user_cb').attr('checked', false);
					$('#form_user select').attr('readonly', true);
					$('#form_user input').attr('readonly', true);
				}
				$('#modal_user').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text(data.user_name.toUpperCase());
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function deleteUser(id) {
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
				url: '<?php echo site_url('user/actDelete/') ?>' +id,
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
						reloadUser();
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

	function resetUser()
	{
		$("#modal_user").on("hidden.bs.modal", function(){
			$('#user_code_error').html('');
			$('#user_name_error').html('');
			$('#password_error').html('');
			$('#branch_id_user_error').html('');
			$('#division_id_user_error').html('');
			// $('#room_id_user_error').html('');
			// $('#subcategory_id_error').html('');
			$('#form_user')[0].reset();
		});
	}

	function readOnly() {
		$('#user_cb').on('change', function() {
			if ($('#user_cb').is(':checked')) {
				$('#form_user input').attr('readonly', false);
			} else {
				$('#form_user input').attr('readonly', true);
			}
		});
	}

	function activeValue() {
		var ckbox = $('#user_cb');
		ckbox.attr('checked', true);
		$("input").on('change', function() {
			if (ckbox.is(':checked')) {
				$('[name=user_isactive]').val("Y");
				$('#user_code').attr('readonly','true');
			} else {
				$('[name=user_isactive]').val("N");
			}
		});
	}
</script>
