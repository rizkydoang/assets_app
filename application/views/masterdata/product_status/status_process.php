<script type="text/javascript">
	var setSave_status;
	var tb_status;
	readOnly();
	numberOnly();
	activeValue();

	$(function () {
		tb_status = $('#table-status').DataTable({
			'ajax': '<?php echo site_url('status/getAll') ?>',
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

	function reloadStatus() {
		tb_status.ajax.reload(null, false);
	}

	function addStatus() {
		setSave_status = 'add';
		$.ajax({
			url: '<?php echo site_url('status/getNo') ?>',
			type: 'ajax',
			dataType: 'json',
			success: function(data){
				var str = data[0].no;
				while (str.length < 3) {
					str = '0' + str;
				}
				var codeNum = 'ST' + str;
				$('[name = status_code]').val(codeNum);
				$('#modal_status').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text('Add New Status');
			}
		});
	}

	function saveStatus() {
		var url;
		if(setSave_status == 'add') {
			url = '<?php echo site_url('status/actAdd') ?>';
		} else {
			url = '<?php echo site_url('status/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_status').serialize(),
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn_saveStatus').attr('disabled',true);
			},
			success: function(data){
				if(data.error){
					if(data.status_code_error != ''){
						$('#status_code_error').html(data.status_code_error);
					} else {
						$('#status_code_error').html('');
					}
					if(data.status_name_error != ''){
						$('#status_name_error').html(data.status_name_error);
					} else {
						$('#status_name_error').html('');
					}
					if(data.status_nickname_error != ''){
						$('#status_nickname_error').html(data.status_nickname_error);
					} else {
						$('#status_nickname_error').html('');
					}
				}
				if(data.success) {
					$.bootstrapGrowl(data.success, {
						type: 'success',
						width: 'auto',
						offset: {from: 'top', amount: 50}
					});
					resetStatus();
					$('#modal_status').modal('hide');
					reloadStatus();
				}
				$('#btn_saveStatus').attr('disabled',false);
			},
			error: function(data){
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if(setSave_status == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

				$.bootstrapGrowl(html, {
					type: 'success',
					width: 'auto',
					offset: {from: 'top', amount: 50}
				});
				$('#modal_status').modal('hide');
			}
		});

	}

	function detailStatus(id){
		setSave_status = 'update';
		var url = '<?php echo site_url('status/getDetail/') ?>';
		$.ajax({
			url: url+id,
			type: 'GET',
			dataType: 'json',
			success: function(data){
				$('[name = id_status]').val(data.status_id);
				$('[name = status_code]').val(data.status_code);
				$('[name = status_name]').val(data.status_name);
				$('[name = status_nickname]').val(data.status_nickname);
				$('[name = status_isactive]').val(data.status_isactive);
				var active = document.getElementById("status_isactive").innerHTML = data.status_isactive;
				if (active == "N"){
					$('#status_cb').attr('checked', false);
					$('#form_status input').attr('readonly', true);
				}
				$('#modal_status').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text(data.status_name.toUpperCase());
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function deleteStatus(id) {
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
				url: '<?php echo site_url('status/actDelete/') ?>' +id,
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
						reloadStatus();
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

	function resetStatus()
	{
		$("#modal_status").on("hidden.bs.modal", function(){
			$('#status_code_error').html('');
			$('#status_name_error').html('');
			$('#status_nickname_error').html('');
			$('#form_status')[0].reset();
		});
	}

	function readOnly() {
		$('#status_cb').on('change', function() {
			if ($('#status_cb').is(':checked')) {
				$('#status_cb').attr('readonly', false);
				$('#status_name').removeAttr('readonly');
			} else {
				$('#form_status input').attr('readonly', true);
			}
		});
	}

	function activeValue() {
		var ckbox = $('#status_cb');
		ckbox.attr('checked', true);
		$("input").on('change', function() {
			if (ckbox.is(':checked')) {
				$('[name=status_isactive]').val("Y");
			} else {
				$('[name=status_isactive]').val("N");
			}
		});
	}
</script>
