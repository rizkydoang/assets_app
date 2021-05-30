<script type="text/javascript">
	var setSave_division;
	var tb_division;
	readOnly();
	numberOnly();
	activeValue();

  	$(function () {
    	tb_division = $('#table-division').DataTable({
    		'ajax': '<?php echo site_url('division/getAll') ?>',
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

  	function reloadDivision() {
  		tb_division.ajax.reload(null, false);
  	}

	function addDivision() {
		setSave_division = 'add';
		$.ajax({
			url: '<?php echo site_url('division/getNo') ?>',
			type: 'ajax',
			dataType: 'json',
			success: function(data){
				var str = data[0].no;
				while (str.length < 3) {
        	str = '0' + str;
    		}
				var codeNum = 'DV' + str;
        $('[name = division_code]').val(codeNum);
				$('#modal_division').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text('Add New Division');
			}
		});
	}

	function saveDivision() {
		var url;
		if(setSave_division == 'add') {
			url = '<?php echo site_url('division/actAdd') ?>';
		} else {
			url = '<?php echo site_url('division/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_division').serialize(),
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn_saveDivision').attr('disabled',true);
			},
			success: function(data){
				if(data.error){
					if(data.division_code_error != ''){
						$('#division_code_error').html(data.division_code_error);
					} else {
						$('#division_code_error').html('');
					}
					if(data.division_name_error != ''){
						$('#division_name_error').html(data.division_name_error);
					} else {
						$('#division_name_error').html('');
					}
					if(data.branch_id_error != ''){
						$('#branch_id_error').html(data.branch_id_error);
					} else {
						$('#branch_id_error').html('');
					}
					if(data.division_manager_error != ''){
						$('#division_manager_error').html(data.division_manager_error);
					} else {
						$('#division_manager_error').html('');
					}
				}
				if(data.success) {
    				$.bootstrapGrowl(data.success, {
    					type: 'success',
    					width: 'auto',
    					offset: {from: 'top', amount: 50}
    				});
					resetDivision();
					$('#modal_division').modal('hide');
					reloadDivision();
				}
				$('#btn_saveDivision').attr('disabled',false);
			},
			error: function(data){
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if(setSave_division == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

    			$.bootstrapGrowl(html, {
    				type: 'success',
    				width: 'auto',
    				offset: {from: 'top', amount: 50}
    			});
    			$('#modal_division').modal('hide');
			}
		});

	}

	function detailDivision(id){
		setSave_division = 'update';
		var url = '<?php echo site_url('division/getDetail/') ?>';
		$.ajax({
			url: url+id,
			type: 'GET',
			dataType: 'json',
			success: function(data){
				$('[name = id_division]').val(data.division_id);
				$('[name = division_code]').val(data.division_code);
				$('[name = division_name]').val(data.division_name);
				$('[name = branch_id]').val(data.branch_id);
				$('[name = division_manager_u_id]').val(data.division_manager_u_id);
				$('[name = division_isactive]').val(data.division_isactive);
				var active = document.getElementById("division_isactive").innerHTML = data.division_isactive;
				if (active == "N"){
					$('#division_cb').attr('checked', false);
					$('#form_division input').attr('readonly', true);
				}
				$('#modal_division').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text(data.division_name.toUpperCase());
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function deleteDivision(id) {
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
				url: '<?php echo site_url('division/actDelete/') ?>' +id,
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
						reloadDivision();
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

	function resetDivision()
	{
		$("#modal_division").on("hidden.bs.modal", function(){
			$('#division_code_error').html('');
			$('#division_name_error').html('');
			$('#branch_id_error').html('');
			$('#division_manager_error').html('');
			$('#form_division')[0].reset();
		});
	}

	function readOnly() {
	    $('#division_cb').on('change', function() {
	        if ($('#division_cb').is(':checked')) {
	            $('#division_name').attr('readonly', false);
	        } else {
	            $('#form_division input').attr('readonly', true);
	        }
	    });
	}

	function activeValue() {
		var ckbox = $('#division_cb');
		ckbox.attr('checked', true);
		$("input").on('change', function() {
	        if (ckbox.is(':checked')) {
	        	$('[name=division_isactive]').val("Y");
	        } else {
	            $('[name=division_isactive]').val("N");
	        }
	    });
	}
</script>
