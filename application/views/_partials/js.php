<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/adminlte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/adminlte/bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- Bootstrap growl -->
<script src="<?php echo base_url('assets/adminlte/bower_components/bootstrap-growl/dist/jquery.bootstrap-growl.min.js') ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') ?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('/assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js') ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/moment/min/moment.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('/assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('/assets/adminlte/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('/assets/adminlte/dist/js/demo.js') ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php //echo base_url('/assets/adminlte/bower_components/datatables-checkboxes/js/dataTables.checkboxes.min.js') 
				?>"></script>
<!-- Sweet Alert -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
<!-- CK Editor -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/ckeditor/ckeditor.js') ?>"></script>
<!-- mask thousand separator -->
<script src="<?php echo base_url('/assets/autoNumeric/autoNumeric.js') ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('/assets/adminlte/bower_components/chart.js/Chart.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<? //php echo base_url('/assets/adminlte/dist/js/pages/dashboard2.js') 
				?>"></script>
<!-- AutoNumeric Rupiah -->
<script src="<?php echo base_url('/assets/autoNumeric/autoNumeric.js') ?>"></script>
<!-- Main content -->
<!-- Chart JS -->
<script>
	var dData = function() {
		// Masukin data
		return Math.round(Math.random() * 90) + 10
	};

	//CHART BAR

	var data_array = [];
	var array_bar = [21, 22, 31, 42]; // Data array dummy
	var httpGet = function() {
		fetch('<?php echo site_url('division/getChartDivision') ?>')
			.then((response) => {
				return response.json();
			})
			.then((json) => {
				for (var i = 0; i < json.length; i++) {
					array_bar.push(Number(json[i]['division_id'])); // masukan data dari db ke dummy
				}
			});
	};

	var data_bar = httpGet();
	var index = 11;
	var barChartData = {
		labels: [
			"sddd", "asdaasdasdsd", 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd'
		],
		datasets: [{
			fillColor: "rgba(0,60,100,1)",
			strokeColor: "black",
			data: array_bar
		}]
	}

	var ctx = document.getElementById("barChart").getContext("2d");
	var barChartDemo = new Chart(ctx).Bar(barChartData, {
		responsive: true,
		barValueSpacing: 2
	});
</script>

<!-- Pusher -->
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script type="text/javascript">
	// $(document).ready(function () {
	//     $('.select2').select2();

	//     CKEDITOR.replace('editor_email');

	//     totalInProgress();
	//     totalCompleted();
	//     totalDrafted();
	//     setInterval('totalDrafted()', 1000);

	// });

	//setnumber only
	function numberOnly() {
		$('input[type="number"]').keypress(function(event) { //Required Number
			var keycode = event.which;
			if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
				event.preventDefault();
			}
		});
	}

	function totalCompleted() {
		$.ajax({
			url: '<?php echo site_url('order/getTotalCompleted') ?>',
			data: {},
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				$.each(data, function(index, value) {
					$('#completed').html(value.total);
				});
			}
		});
	}

	function totalDrafted() {
		$.ajax({
			url: '<?php echo site_url('order/getTotalDrafted') ?>',
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				$.each(data, function(index, value) {
					$('#draft').html(value.total);
				});
			}
		});
	}

	function totalInProgress() {
		$.ajax({
			url: '<?php echo site_url('order/getTotalInProgress') ?>',
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				$.each(data, function(index, value) {
					$('#inprogess').html(value.total);
				});
			}
		});
	}
</script>
<script>
	function rupiah() {
		$('.rupiah').autoNumeric('init', {
			aSep: '.',
			aDec: ',',
			mDec: '0'
		});
	}
</script>

<script>
	var tableAllReport;
	tableAllReport = $('#table-all-report').DataTable({
		'processing': true,
		'language': {
			'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
		},
		"sAjaxSource": '<?php echo site_url() ?>' + 'All_report/getAllReport',
		"fnServerParams": function(aoData) {
			aoData.push({
				"name": "date_from",
				"value": $('#date_from').val()
			});
			aoData.push({
				"name": "date_to",
				"value": $('#date_to').val()
			});
			aoData.push({
				"name": "division",
				"value": $('#division option:selected').val()
			});
		}
	});

	function refresh_table() {
		tableAllReport.ajax.reload(null, false);
	}

	$('#btn_all_cari').click(function() {
		refresh_table();
	});
</script>

<script>
	var tableCostCenter;
	// tableCostCenter = $('#table-rpt-cost-center').DataTable({
	tableCostCenter = $('#table-rpt-cost_center').DataTable({ 
		'processing': true,
		'language': {
			'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
		},
		"sAjaxSource": '<?php echo site_url() ?>' + 'cost_center/getCostCenter',
		"fnServerParams": function(aoData) {
			aoData.push({
				"name": "date_from",
				"value": $('#date_from').val()
			});
			aoData.push({
				"name": "date_to",
				"value": $('#date_to').val()
			});
			aoData.push({
				"name": "division",
				"value": $('#division option:selected').val()
			});
		}
	});

	function refresh_tableCost() {
		tableCostCenter.ajax.reload(null, false);
	}

	$('#btn_cost_cari').click(function() {
		refresh_tableCost();
	});
</script>

<script>
	var tableProfitCenter;
	// tableCostCenter = $('#table-rpt-cost-center').DataTable({
	tableProfitCenter = $('#table-rpt-profit_center').DataTable({ 
		'processing': true,
		'language': {
			'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
		},
		"sAjaxSource": '<?php echo site_url() ?>' + 'Profit_center/getProfitCenter',
		"fnServerParams": function(aoData) {
			aoData.push({
				"name": "date_from",
				"value": $('#date_from').val()
			});
			aoData.push({
				"name": "date_to",
				"value": $('#date_to').val()
			});
			aoData.push({
				"name": "division",
				"value": $('#division option:selected').val()
			});
		}
	});

	function refresh_tableProfit() {
		tableProfitCenter.ajax.reload(null, false);
	}

	$('#btn_profit_cari').click(function() {
		refresh_tableProfit();
	});
</script>

<script>
	var tableProMove;
	// tableCostCenter = $('#table-rpt-cost-center').DataTable({
	tableProMove = $('#table-rpt-product-movement').DataTable({ 
		'processing': true,
		'language': {
			'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
		},
		"sAjaxSource": '<?php echo site_url() ?>' + 'product_movement/productMovement',
		"fnServerParams": function(aoData) {
			aoData.push({
				"name": "date_from",
				"value": $('#date_from').val()
			});
			aoData.push({
				"name": "date_to",
				"value": $('#date_to').val()
			});
			aoData.push({
				"name": "from_division",
				"value": $('#from_division option:selected').val()
			});
			aoData.push({
				"name": "to_division",
				"value": $('#to_division option:selected').val()
			});
			aoData.push({
				"name": "movement_status",
				"value": $('#movement_status option:selected').val()
			});
			console.log(aoData)
		}
	});

	function refresh_tableProMove() {
		tableProMove.ajax.reload(null, false);
	}

	$('#btn_pro_move_cari').click(function() {
		refresh_tableProMove();
	});
</script>