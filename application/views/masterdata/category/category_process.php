<script type="text/javascript">
	var setSave_category;
	var tb_category;
	readOnly();
	numberOnly();
	activeValue();

  	$(function () {
    	tb_category = $('#table-category').DataTable({
    		'ajax': '<?php echo site_url('category/getAll') ?>',
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

  	function reloadCategory() {
  		tb_category.ajax.reload(null, false);
  	}

	function addCategory() {
		setSave_category = 'add';
		$.ajax({
			url: '<?php echo site_url('category/getNo') ?>',
			type: 'ajax',
			dataType: 'json',
			success: function(data){
				var str = data[0].no;
				while (str.length < 3) {
        	str = '0' + str;
    		}
				var codeNum = 'CT' + str;
        $('[name = category_code]').val(codeNum);
				$('#modal_category').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text('Add New Category');
			}
		});
	}

	function saveCategory() {
		var url;
		if(setSave_category == 'add') {
			url = '<?php echo site_url('category/actAdd') ?>';
		} else {
			url = '<?php echo site_url('category/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_category').serialize(),
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn_saveCategory').attr('disabled',true);
			},
			success: function(data){
				if(data.error){
					if(data.category_code_error != ''){
						$('#category_code_error').html(data.category_code_error);
					} else {
						$('#category_code_error').html('');
					}
					if(data.category_name_error != ''){
						$('#category_name_error').html(data.category_name_error);
					} else {
						$('#category_name_error').html('');
					}
				}
				if(data.success) {
    				$.bootstrapGrowl(data.success, {
    					type: 'success',
    					width: 'auto',
    					offset: {from: 'top', amount: 50}
    				});
					resetCategory();
					$('#modal_category').modal('hide');
					reloadCategory();
				}
				$('#btn_saveCategory').attr('disabled',false);
			},
			error: function(data){
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if(setSave_category == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

    			$.bootstrapGrowl(html, {
    				type: 'success',
    				width: 'auto',
    				offset: {from: 'top', amount: 50}
    			});
    			$('#modal_category').modal('hide');
			}
		});

	}

	function detailCategory(id){
		setSave_category = 'update';
		var url = '<?php echo site_url('category/getDetail/') ?>';
		$.ajax({
			url: url+id,
			type: 'GET',
			dataType: 'json',
			success: function(data){
				$('[name = id_category]').val(data.category_id);
				$('[name = category_code]').val(data.category_code);
				$('[name = category_name]').val(data.category_name);
				$('[name = category_isactive]').val(data.category_isactive);
				var active = document.getElementById("category_isactive").innerHTML = data.category_isactive;
				if (active == "N"){
					$('#category_cb').attr('checked', false);
					$('#form_category input').attr('readonly', true);
				}
				$('#modal_category').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text(data.category_name.toUpperCase());
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function deleteCategory(id) {
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
				url: '<?php echo site_url('category/actDelete/') ?>' +id,
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
						reloadCategory();
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

	function resetCategory()
	{
		$("#modal_category").on("hidden.bs.modal", function(){
			$('#category_code_error').html('');
			$('#category_name_error').html('');
			$('#form_category')[0].reset();
		});
	}

	function readOnly() {
	    $('#category_cb').on('change', function() {
	        if ($('#category_cb').is(':checked')) {
	            $('#category_name').removeAttr('readonly', false);
	        } else {
	            $('#form_category input').attr('readonly', true);
	        }
	    });
	}

	function activeValue() {
		var ckbox = $('#category_cb');
		ckbox.attr('checked', true);
		$("input").on('change', function() {
	        if (ckbox.is(':checked')) {
	        	$('[name=category_isactive]').val("Y");
	        } else {
	            $('[name=category_isactive]').val("N");
	        }
	    });
	}
</script>
