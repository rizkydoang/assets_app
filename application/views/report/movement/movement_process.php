<script type="text/javascript">
		$('.date').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd'
		}).datepicker('setDate', new Date());


		$(function () {
			tb_movement = $('#table-rpt-movement').DataTable({
				'ajax': '<?php echo site_url('rpt_movement/getAll') ?>',
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

		function viewRptMovement(){
			var product_id 		= $('#product_code_rm').val();
			var movement_id 	= $('#movement_code_rm').val();
			var date_from_rm 	= $('#date_from_rm').val();
			var date_to_rm 		= $('#date_to_rm').val();
			var url = '<?php echo site_url('rpt_movement/viewReport') ?>';
			$.ajax({
				url		: url,
				data 	:{product_id:product_id, movement_id:movement_id, date_from_rm:date_from_rm, date_to_rm:date_to_rm},
				type	: 'POST',
				dataType: 'json',
				success: function(data){
					var html = '';
					var i;
					var no = 1;
					for (var i=0; i<data.length; i++,no++){
						html += '<tr>'+
						'<td class="hidden">'+data[i].movements_details_id+'</td>'+
						'<td>'+ no +'</td>'+
						'<td>'+data[i].movement_date+'</td>'+
						'<td>'+data[i].product_name+'</td>'+
						'<td>'+data[i].movements_details_asset_code+'</td>'+
						'<td>Status Barang</td>'+
						'<td>'+data[i].user_from+'</td>'+
						'<td>'+data[i].user_to+'</td>'+
						'<td>'+data[i].movements_details_description+'</td>'+
						'</tr>';
					}
					$('#tbody_rptmovement').html(html);
					$('#modal_rptmovement').modal({backdrop: 'static', keyboard: false});
					$('.modal-title').text(date_from_rm + ' to ' + date_to_rm.toUpperCase());
				},
				error: function(jqXHR, textStatus, errorThrown){
					swal.fire('Error Get Data', 'Please try again', 'error');
				}
			});
		}


		function resetRptMovement()
		{
			$("#modal_rptmovement").on("hidden.bs.modal", function(){
				$('#tbody_rptmovement').html('');
			});

		}
</script>
