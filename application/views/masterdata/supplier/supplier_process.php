<script type="text/javascript">
	var setSave_supplier;
	var tb_supplier;
	readOnly();
	numberOnly();
	activeValue();

  	$(function () {
    	tb_supplier = $('#table-supplier').DataTable({
    		'ajax': '<?php echo site_url('supplier/getAll') ?>',
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

  	function reloadSupplier() {
  		tb_supplier.ajax.reload(null, false);
  	}

	function addSupplier() {
		setSave_supplier = 'add';
		$.ajax({
			url: '<?php echo site_url('supplier/getNo') ?>',
			type: 'ajax',
			dataType: 'json',
			success: function(data){
				var str = data[0].no;
				while (str.length < 3) {
        	str = '0' + str;
    		}
				var codeNum = 'SP' + str;
        $('[name = supplier_code]').val(codeNum);
				$('#modal_supplier').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text('Add New Supplier');
			}
		});
	}

	

	function saveSupplier() {
		var url;
		if(setSave_supplier == 'add') {
			url = '<?php echo site_url('supplier/actAdd') ?>';
		} else {
			url = '<?php echo site_url('supplier/actEdit') ?>';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $('#form_supplier').serialize(),
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn_saveSupplier').attr('disabled',true);
			},
			success: function(data){
				if(data.error){
					if(data.supplier_code_error != ''){
						$('#supplier_code_error').html(data.supplier_code_error);
					} else {
						$('#supplier_code_error').html('');
					}
					if(data.supplier_name_error != ''){
						$('#supplier_name_error').html(data.supplier_name_error);
					} else {
						$('#supplier_name_error').html('');
					}
					if(data.supplier_address_error != ''){
						$('#supplier_address_error').html(data.supplier_address_error);
					} else {
						$('#supplier_address_error').html('');
					}
					if(data.supplier_telephone_error != ''){
						$('#supplier_telephone_error').html(data.supplier_telephone_error);
					} else {
						$('#supplier_telephone_error').html('');
					}
				}
				if(data.success) {
    				$.bootstrapGrowl(data.success, {
    					type: 'success',
    					width: 'auto',
    					offset: {from: 'top', amount: 50}
    				});
					resetSupplier();
					$('#modal_supplier').modal('hide');
					reloadSupplier();
				}
				$('#btn_saveSupplier').attr('disabled',false);
			},
			error: function(data){
				// error: function(jqXHR, textStatus, errorThrown){ //Get Paramater error
				var html = '';
				if(setSave_supplier == 'add') {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid inserted!';
				} else {
					html = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Your data invalid updated!';
				}

    			$.bootstrapGrowl(html, {
    				type: 'success',
    				width: 'auto',
    				offset: {from: 'top', amount: 50}
    			});
    			$('#modal_supplier').modal('hide');
			}
		});

	}

	function detailSupplier(id){
		setSave_supplier = 'update';
		var url = '<?php echo site_url('supplier/getDetail/') ?>';
		$.ajax({
			url: url+id,
			type: 'GET',
			dataType: 'json',
			success: function(data){
				$('[name = id_supplier]').val(data.supplier_id);
				$('[name = supplier_code]').val(data.supplier_code);
				$('[name = supplier_name]').val(data.supplier_name);
				$('[name = supplier_address]').val(data.supplier_address);
				$('[name = supplier_telephone]').val(data.supplier_telephone);
				$('[name = supplier_isactive]').val(data.supplier_isactive);
				$('[name = supplier_isvendor]').val(data.supplier_isvendor);
				var active 	= document.getElementById("supplier_isactive").innerHTML = data.supplier_isactive;
				var vendor 	= document.getElementById("supplier_isvendor").innerHTML = data.supplier_isvendor;
				if (active == "N" ){
					$('#supplier_cb').attr('checked', false);
					$('#form_supplier input').attr('readonly', true);
				} else if (vendor == "N"){
					$('#supplier_iv').attr('checked', false);
				}
				$('#modal_supplier').modal({backdrop: 'static', keyboard: false});
				$('.modal-title').text(data.supplier_name.toUpperCase());
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal('Error Get Data', 'Please try again', 'error');
			}
		});
	}

	function deleteSupplier(id) {
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
				url: '<?php echo site_url('supplier/actDelete/') ?>' +id,
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
						reloadSupplier();
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

	function resetSupplier()
	{
		$("#modal_supplier").on("hidden.bs.modal", function(){
			$('#supplier_code_error').html('');
			$('#supplier_name_error').html('');
			$('#supplier_address_error').html('');
			$('#supplier_telephone_error').html('');
			$('#form_supplier')[0].reset();
		});
	}

	function readOnly() {
	    $('#supplier_cb').on('change', function() {
	        if ($('#supplier_cb').is(':checked')) {
	            $('#form_supplier input').attr('readonly', false);
	        } else {
	            $('#form_supplier input').attr('readonly', true);
	        }
	    });
	}

	function activeValue() {
		var active 	= $('#supplier_cb');
		var vendor 	= $('#supplier_iv');
		// var service = $('#supplier_sc');
		active.attr('checked', true);
		vendor.attr('checked', true);
		// service.attr('checked', true);
		$("input").on('change', function() {
      if (active.is(':checked')) {
      	$('[name=supplier_isactive]').val("Y");
      } else {
          $('[name=supplier_isactive]').val("N");
      }
      if (vendor.is(':checked')) {
      	$('[name=supplier_isvendor]').val("Y");
      } else {
          $('[name=supplier_isvendor]').val("N");
      }
    //   if (service.is(':checked')) {
    //   	$('[name=supplier_isservice]').val("Y");
    //   } else {
    //       $('[name=supplier_isservice]').val("N");
    //   }
	  });
	}
</script>
