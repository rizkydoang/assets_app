<script type="text/javascript">
	var setSave_brand;
	var tb_brand;
	readOnly();
	numberOnly();
	activeValue();

  	$(function () {
    	tb_brand = $('#table-brand').DataTable({
    		'ajax': '<?php echo site_url('brand/getAll') ?>',
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

  	function reloadBrand() {
  		tb_brand.ajax.reload(null, false);
  	}

	function addBrand() {
		setSave_brand = 'add';
		$.ajax({
			url: '<?php echo site_url('brand/getNo') ?>',
			type: 'ajax',
			dataType: 'json',
			success: function(data){
				var str = data[0].no;
				while (str.length < 3) {
        	str = '0' + str;
    		}
				var codeNum = 'BR' + str;
        $('[name = brand_code]').val(codeNum);
				$('#modal_brand').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text('Add New Brand');
			}
		});
	}

	function saveBrand() {
		var url;
		if(setSave_brand == 'add') {
			url = '<?php echo site_url('brand/actAdd') ?>';
		} else {
			url = '<?php echo site_url('brand/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_brand').serialize(),
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn_saveBrand').attr('disabled',true);
			},
			success: function(data){
				if(data.error){
					if(data.brand_code_error != ''){
						$('#brand_code_error').html(data.brand_code_error);
					} else {
						$('#brand_code_error').html('');
					}
					if(data.brand_name_error != ''){
						$('#brand_name_error').html(data.brand_name_error);
					} else {
						$('#brand_name_error').html('');
					}
				}
				if(data.success) {
    				$.bootstrapGrowl(data.success, {
    					type: 'success',
    					width: 'auto',
    					offset: {from: 'top', amount: 50}
    				});
					resetBrand();
					$('#modal_brand').modal('hide');
					reloadBrand();
				}
				$('#btn_saveBrand').attr('disabled',false);
			},
			error: function(data){
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if(setSave_brand == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

    			$.bootstrapGrowl(html, {
    				type: 'success',
    				width: 'auto',
    				offset: {from: 'top', amount: 50}
    			});
    			$('#modal_brand').modal('hide');
			}
		});

	}

	function detailBrand(id){
		setSave_brand = 'update';
		var url = '<?php echo site_url('brand/getDetail/') ?>';
		$.ajax({
			url: url+id,
			type: 'GET',
			dataType: 'json',
			success: function(data){
				$('[name = id_brand]').val(data.brand_id);
				$('[name = brand_code]').val(data.brand_code);
				$('[name = brand_name]').val(data.brand_name);
				$('[name = brand_isactive]').val(data.brand_isactive);
				var active = document.getElementById("brand_isactive").innerHTML = data.brand_isactive;
				if (active == "N"){
					$('#brand_cb').attr('checked', false);
					$('#form_brand input').attr('readonly', true);
				}
				$('#modal_brand').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text(data.brand_name.toUpperCase());
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function deleteBrand(id) {
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
				url: '<?php echo site_url('brand/actDelete/') ?>' +id,
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
						reloadBrand();
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

	function resetBrand()
	{
		$("#modal_brand").on("hidden.bs.modal", function(){
			$('#brand_code_error').html('');
			$('#brand_name_error').html('');
			$('#form_brand')[0].reset();
		});
	}

	function readOnly() {
	    $('#brand_cb').on('change', function() {
	        if ($('#brand_cb').is(':checked')) {
				$('#brand_cb').attr('readonly', false);
	            $('#brand_name').removeAttr('readonly');
	        } else {
	            $('#form_brand input').attr('readonly', true);
	        }
	    });
	}

	function activeValue() {
		var ckbox = $('#brand_cb');
		ckbox.attr('checked', true);
		$("input").on('change', function() {
	        if (ckbox.is(':checked')) {
	        	$('[name=brand_isactive]').val("Y");
	        } else {
	            $('[name=brand_isactive]').val("N");
	        }
	    });
	}
</script>
