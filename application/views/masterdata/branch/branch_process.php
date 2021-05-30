<script type="text/javascript">
	var setSave_branch;
	var tb_branch;
	readOnly();
	numberOnly();
	activeValue();

	$(function () {
		tb_branch = $('#table-branch').DataTable({
			'ajax': '<?php echo site_url('branch/getAll') ?>',
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

	function reloadBranch() {
		tb_branch.ajax.reload(null, false);
	}

	function addBranch() {
		setSave_branch = 'add';
		$.ajax({
			url: '<?php echo site_url('branch/getNo') ?>',
			type: 'ajax',
			dataType: 'json',
			success: function(data){
				var str = data[0].no;
				while (str.length < 3) {
				str = '0' + str;
			}
				var codeNum = 'BC' + str;
		$('[name = branch_code]').val(codeNum);
				$('#modal_branch').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text('Add New Branch');
			}
		});
	}

	function saveBranch() {
		var url;
		if(setSave_branch == 'add') {
			url = '<?php echo site_url('branch/actAdd') ?>';
		} else {
			url = '<?php echo site_url('branch/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_branch').serialize(),
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn_saveBranch').attr('disabled',true);
			},
			success: function(data){
				if(data.error){
					if(data.branch_code_error != ''){
						$('#branch_code_error').html(data.branch_code_error);
					} else {
						$('#branch_code_error').html('');
					}
					if(data.branch_name_error != ''){
						$('#branch_name_error').html(data.branch_name_error);
					} else {
						$('#branch_name_error').html('');
					}
					if(data.branch_address_error != ''){
						$('#branch_address_error').html(data.branch_address_error);
					} else {
						$('#branch_address_error').html('');
					}
					if(data.branch_leader_error != ''){
						$('#branch_leader_error').html(data.branch_leader_error);
					} else {
						$('#branch_leader_error').html('');
					}
					if(data.branch_telephone_error != ''){
						$('#branch_telephone_error').html(data.branch_telephone_error);
					} else {
						$('#branch_telephone_error').html('');
					}
				}
				if(data.success) {
					$.bootstrapGrowl(data.success, {
						type: 'success',
						width: 'auto',
						offset: {from: 'top', amount: 50}
					});
					resetBranch();
					$('#modal_branch').modal('hide');
					reloadBranch();
				}
				$('#btn_saveBranch').attr('disabled',false);
			},
			error: function(data){
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if(setSave_branch == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

				$.bootstrapGrowl(html, {
					type: 'success',
					width: 'auto',
					offset: {from: 'top', amount: 50}
				});
				$('#modal_branch').modal('hide');
			}
		});

	}

	function detailBranch(id){
		setSave_branch = 'update';
		var url = '<?php echo site_url('branch/getDetail/') ?>';
		$.ajax({
			url: url+id,
			type: 'GET',
			dataType: 'json',
			success: function(data){
				$('[name = id_branch]').val(data.branch_id);
				$('[name = branch_code]').val(data.branch_code);
				$('[name = branch_name]').val(data.branch_name);
				$('[name = branch_address]').val(data.branch_address);
				$('[name = branch_leader_u_id]').val(data.branch_leader_u_id);
				$('[name = branch_telephone]').val(data.branch_telephone);
				$('[name = branch_isactive]').val(data.branch_isactive);
				var active = document.getElementById("branch_isactive").innerHTML = data.branch_isactive;
				if (active == "N"){
					$('#branch_cb').attr('checked', false);
					$('#form_branch input').attr('readonly', true);
				}
				$('#modal_branch').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text(data.branch_name.toUpperCase());
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function deleteBranch(id) {
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
				url: '<?php echo site_url('branch/actDelete/') ?>' +id,
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
						reloadBranch();
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

	function resetBranch()
	{
		$("#modal_branch").on("hidden.bs.modal", function(){
			$('#branch_code_error').html('');
			$('#branch_name_error').html('');
			$('#branch_address_error').html('');
			$('#branch_leader_error').html('');
			$('#branch_telephone_error').html('');
			$('#form_branch')[0].reset();
		});
	}

	function readOnly() {
		$('#branch_cb').on('change', function() {
			if ($('#branch_cb').is(':checked')) {
				$('#branch_cb').attr('readonly', false);
				$('#branch_name').removeAttr('readonly');
				$('#branch_address').removeAttr('readonly');
				$('#branch_telephone').removeAttr('readonly');
			} else {
				$('#form_branch input').attr('readonly', true);
			}
		});
	}


	function activeValue() {
		var ckbox = $('#branch_cb');
		ckbox.attr('checked', true);
		$("input").on('change', function() {
			if (ckbox.is(':checked')) {
				$('[name=branch_isactive]').val("Y");
			} else {
				$('[name=branch_isactive]').val("N");
			}
		});
	}
</script>
