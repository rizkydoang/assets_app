<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?= $total_products ?></h3>

					<p>Total Products </p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
			</div>
		</div>

		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?= $total_movements ?></h3>

					<p>Total Movements</p>
				</div>
				<div class="icon">
					<i class="ion ion-map"></i>
				</div>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?= $total_receipts ?></h3>

					<p>Total Receipt</p>
				</div>
				<div class="icon">
					<i class=" ion ion-document-text"></i>
				</div>
			</div>
		</div>
		<?php if (is_controller()) : ?>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?= $total_users ?></h3>

						<p>Total User</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-stalker"></i>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>

	<!-- BAR CHART -->
	<!-- <div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">Bar Chart</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="chart">
				<canvas id="barChart" style="height:230px"></canvas>
			</div>
		</div>
	</div> -->

	<?php if (is_controller()) : ?>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="box box-info py-20">
					<div class="box-header with-border">
						<h3 class="box-title">Latest Movement</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<!-- /.box-header -->
					<!-- Latest Movement -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="latest-movement-dashboard" class="table table-bordered table-striped text-center">
								<thead>
									<tr>
										<th>Movement Code</th>
										<th>Movement Date</th>
										<th>Movement Created At</th>
										<th>Active</th>
										<th>Status</th>
										<th>Description</th>
									</tr>
								</thead>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.box-body -->

					<!-- /.box-footer -->
				</div>
				<!-- /.box -->
			</div>
			<!-- Latest Receipt -->
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="box box-info py-20">
					<div class="box-header with-border">
						<h3 class="box-title">Latest Receipt</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<!-- /.box-header -->

					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<table id="latest-receipt-dashboard" class="table table-bordered table-striped text-center">
							<thead>
								<tr>
									<th>Receipt Code</th>
									<th>Invoice Number</th>
									<th>Receipt Date</th>
									<th>Active</th>
									<th>Status</th>
									<th>Description</th>

								</tr>
							</thead>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /#receipt -->
			</div>
			<!-- /.tab-content -->
		</div>
	<?php endif; ?>
</section>
