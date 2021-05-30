<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#all" data-toggle="tab">Product Movement</a></li>
				</ul>
				<div class="tab-content">
					<!-- Tab Inventory -->
					<div class="tab-pane fade in active" id="all">
						<section id="new">
							<div class="box-header">
								<form action="<?= base_url('product_movement/ProductMovementexportExcel')?>" method="POST">
									<div class="row" style="width:50%;">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="date_from">Date From
												</label>
													<input type="date" class="form-control" id="date_from"
														name="date_from">
													<span id="date_from_error" class="text-danger"></span>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="date_to" class="control-label">Date To
												</label>
                                                <input type="date" class="form-control" id="date_to"
                                                    name="date_to">
                                                <span id="date_to_error" class="text-danger"></span>
											</div>
										</div>
										<?php if (is_controller_and_direct()) : ?>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="division" class="control-label">From Division</label>
												<select class="form-control select2" id="from_division" name="from_division">
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
												<label for="division" class="control-label">From Division</label>
												<select class="form-control select2" id="from_division" name="from_division" readonly>
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
									<!-- </div> -->

										<?php if (is_controller_and_direct()) : ?>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="division" class="control-label">To Division</label>
												<select class="form-control select2" id="to_division" name="to_division">
													<option value="">No Selected</option>
													<?php foreach ($parent_division as $value) : ?>
													<option value="<?php echo $value->division_id ?>">
														<?php echo $value->division_name ?></option>
													<?php endforeach;?>
												</select>
												<span id="to_division_error" class="text-danger"></span>
											</div>
										</div>
										<?php else : ?>
											<div class="col-sm-6">
											<div class="form-group">
												<label for="division" class="control-label">To Division</label>
												<select class="form-control select2" id="to_division" name="to_division" readonly>
													<?php foreach ($parent_division as $value) : ?>
														<?php if ($value->division_id == $this->session->userdata('login_session')['divisi']) : ?>
														<option value="<?php echo $value->division_id ?>">
															<?php echo $value->division_name ?></option>
														<?php endif ?>
													<?php endforeach;?>
												</select>
												<span id="to_division_error" class="text-danger"></span>
											</div>
										</div>
										<?php endif ?>
									</div>
									<!-- <div class="col-sm-6">
											<div class="form-group">
												<label for="movement_status" class="control-label">Status </label>
												<select class="form-control select2" id="movement_status" name="movement_status">
												<option value="">--Pilih Status--</option>
												<option value="CO">Completed</option> 
												<option value="RE">Void</option>
												</select>
											</div>
										</div> -->

									<button type="button" class="btn btn-primary" id="btn_pro_move_cari">Cari</button>
								
								
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<table id="table-rpt-product-movement" class="table table-bordered table-striped"
									style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Movement Code</th>
											<th>Receipt Code</th>
											<th>Movement Date</th>
											<th>Kode Aset</th>
											<th>Produk Name</th>
											<th>Is New</th>
											<th>From Branch</th>
											<th>From Division</th>
											<th>To Branch</th>
											<th>To Division</th>
											<th>Document Status</th>
											<th>Description</th>
										</tr>
									</thead>
									<tbody>
								</table>
								<!-- <a type="button" href="<?= base_url('product_movement/ProductMovementexportExcel')?>" class="btn btn-success"style="margin-top:10px; float:right;" onclick="printInventory()">Export To Excel</a> -->
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
