<script type="text/javascript">
	var setSave_type;
	var tb_type;
	readOnly();
	numberOnly();
	activeValue();

  	$(function () {
    	tb_type = $('#table-type').DataTable({
    		'ajax': '<?php echo site_url('type/getAll') ?>',
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

  	function reloadType() {
  		tb_type.ajax.reload(null, false);
  	}

	function addType() {
		setSave_type = 'add';
		$.ajax({
			url: '<?php echo site_url('type/getNo') ?>',
			type: 'ajax',
			dataType: 'json',
			success: function(data){
				var str = data[0].no;
				while (str.length < 3) {
        	str = '0' + str;
    		}
				var codeNum = 'TP' + str;
        $('[name = type_code]').val(codeNum);
				$('#modal_type').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text('Add New Type');
			}
		});
	}

	function saveType() {
		var url;
		if(setSave_type == 'add') {
			url = '<?php echo site_url('type/actAdd') ?>';
		} else {
			url = '<?php echo site_url('type/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_type').serialize(),
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn_saveType').attr('disabled',true);
			},
			success: function(data){
				if(data.error){
					if(data.type_code_error != ''){
						$('#type_code_error').html(data.type_code_error);
					} else {
						$('#type_code_error').html('');
					}
					if(data.type_name_error != ''){
						$('#type_name_error').html(data.type_name_error);
					} else {
						$('#type_name_error').html('');
					}
					// if(data.subcategory_id_error != ''){
					// 	$('#subcategory_id_error').html(data.subcategory_id_error);
					// } else {
					// 	$('#subcategory_id_error').html('');
					// }
					if(data.category_id_error != ''){
						$('#category_id_error').html(data.category_id_error);
					} else {
						$('#category_id_error').html('');
					}
				}
				if(data.success) {
    				$.bootstrapGrowl(data.success, {
    					type: 'success',
    					width: 'auto',
    					offset: {from: 'top', amount: 50}
    				});
					resetType();
					$('#modal_type').modal('hide');
					reloadType();
				}
				$('#btn_saveType').attr('disabled',false);
			},
			error: function(data){
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if(setSave_type == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

    			$.bootstrapGrowl(html, {
    				type: 'success',
    				width: 'auto',
    				offset: {from: 'top', amount: 50}
    			});
    			$('#modal_type').modal('hide');
			}
		});

	}

	function detailType(id){
		setSave_type = 'update';
		var url = '<?php echo site_url('type/getDetail/') ?>';
		$.ajax({
			url: url+id,
			type: 'GET',
			dataType: 'json',
			success: function(data){
				$('[name = id_type]').val(data.type_id);
				$('[name = type_code]').val(data.type_code);
				$('[name = type_name]').val(data.type_name);
				// $('[name = subcategory_id]').val(data.subcategory_id);
				$('[name = category_id]').val(data.category_id);
				$('[name = type_isactive]').val(data.type_isactive);
				var active = document.getElementById("type_isactive").innerHTML = data.type_isactive;
				if (active == "N"){
					$('#type_cb').attr('checked', false);
					$('#form_type input').attr('readonly', true);
				}
				$('#modal_type').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text(data.type_name.toUpperCase());
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function deleteType(id) {
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
				url: '<?php echo site_url('type/actDelete/') ?>' +id,
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
						reloadType();
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

	function resetType()
	{
		$("#modal_type").on("hidden.bs.modal", function(){
			$('#type_code_error').html('');
			$('#type_name_error').html('');
			// $('#subcategory_id_error').html('');
			$('#category_id_error').html('');
			$('#form_type')[0].reset();
		});
	}

	function readOnly() {
	    $('#type_cb').on('change', function() {
	        if ($('#type_cb').is(':checked')) {
	            $('#type_name').attr('readonly', false);
				// $('#form_type input').attr('readonly', false);
	        } else {
	            $('#form_type input').attr('readonly', true);
	        }
	    });
	}

	function activeValue() {
		var ckbox = $('#type_cb');
		ckbox.attr('checked', true);
		$("input").on('change', function() {
	        if (ckbox.is(':checked')) {
	        	$('[name=type_isactive]').val("Y");
	        } else {
	            $('[name=type_isactive]').val("N");
	        }
	    });
	}
</script>
