<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#all" data-toggle="tab">Cost Center</a></li>
				</ul>
				<div class="tab-content">
					<!-- Tab Inventory -->
					<div class="tab-pane fade in active" id="all">
					<form action="<?= base_url('Cost_center/costCenterExportExcel') ?>" method="POST">
						<section id="new">
							<div class="box-header">
									<div class="row" style="width:50%;">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="date_from">Date From
												</label>
												<input type="date" class="form-control" id="date_from" name="date_from">
												<span id="date_from_error" class="text-danger"></span>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="date_to" class="control-label">Date To
												</label>
												<input type="date" class="form-control" id="date_to" name="date_to">
												<span id="date_to_error" class="text-danger"></span>
											</div>
										</div>
										<?php if (is_controller_and_direct()) : ?>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="division" class="control-label">Division</label>
												<select class="form-control select2" id="division" name="division">
													<option value="">No Selected</option>
													<?php foreach ($parent_division as $value) : ?>
													<option value="<?php echo $value->division_id ?>">
														<?php echo $value->division_name ?></option>
													<?php endforeach;?>
												</select>
												<span id="from_division_error" class="text-danger"></span>
											</div>
										</div>
										<?php else : ?>
											<div class="col-sm-6">
											<div class="form-group">
												<label for="division" class="control-label">Division</label>
												<select class="form-control select2" id="division" name="division" readonly>
													<?php foreach ($parent_division as $value) : ?>
														<?php if ($value->division_id == $this->session->userdata('login_session')['divisi']) : ?>
														<option value="<?php echo $value->division_id ?>">
															<?php echo $value->division_name ?></option>
														<?php endif ?>
													<?php endforeach;?>
												</select>
												<span id="from_division_error" class="text-danger"></span>
											</div>
										</div>
										<?php endif ?>
									</div>
									<!-- <button type="button" class="btn btn-default" onclick="printInventory()">Print Label</button> -->
									<button type="button" class="btn btn-primary" id="btn_cost_cari">Cari</button>
						
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<table id="table-rpt-cost_center" class="table table-bordered table-striped" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Asset Code</th>
											<th>Product</th>
											<th>Brand</th>
											<th>Category</th>
											<th>Type</th>
											<th>Branch</th>
											<th>Division</th>
											<th>Cost Center</th>
										</tr>

									</thead>
								</table>
								<button type="submit" class="btn btn-success" style="margin-top:10px; float:right;"> Export To Excel</button>
							</div>
							<!-- /.box-body -->
						</section>
						</form>
					</div>
				</div>
				<!-- /.tab-content -->
			</div>
			<!-- /.nav-tabs-custom -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>