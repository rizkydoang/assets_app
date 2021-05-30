<div class="modal fade" id="modal_movement">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<?php $this->load->view('transaction/movement/formMovement') ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_closeMovement" onclick="resetMovement()">Close</button>
				<button type="submit" class="btn btn-primary" onclick="saveMovement()" id="btn_saveMovement"><i class="fa fa-save"></i> Save</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal_movementdetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="form_movementdetail">
					<div class="box-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-sm-2 col-md-3">
										<label for="movement_code_md">Movement Code</label>
									</div>
									<div class="col-sm-10 col-md-9">
										<input type="text" class="form-control" id="movement_code_md"
											name="movement_code_md" style="text-transform:uppercase" readonly>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-md-offset-4">
								<div class="form-group">
									<div class="col-sm-2 col-md-3">
										<label for="movement_date_md">Movement Date</label>
									</div>
									<div class="col-sm-10 col-md-9">
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control" id="movement_date_md"
												name="movement_date_md" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-sm-2 col-md-2">
										<label for="receipt_id_md" class="control-label">Receipt Code</label>
									</div>
									<div class="col-sm-10 col-md-10">
										<input type="text" class="form-control" id="receipt_id_md" name="receipt_id_md"
											readonly>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<input type="hidden" class="form-control" id="id_movement_md" name="id_movement_md"
									readonly>
							</div>
						</div>

						<hr>

						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="table-movementdetail"
										class="table table-bordered table-striped text-center"
										style="overflow-x: auto;width:1780px">
										<thead>
											<tr>
												<th width="50px">No</th>
												<th width="150px">Asset Code</th>
												<th width="350px">Product</th>
												<th width="70px">Qty</th>
												<th width="80px">Is New</th>
												<th width="200px">From Branch</th>
												<th width="200px">From Division</th>
												<th width="200px">To Branch</th>
												<th width="200px">To Division</th>
												<th width="280px">Description</th>
											</tr>
										</thead>
										<tbody id="tbody_movementdetail">

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="tovoidnotcompletemovement" class="btn btn-danger">Void</button>
				<button type="button" class="btn default" data-dismiss="modal" id="btn_closeMovement" onclick="resetMovement()">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- Modal Update -->
<div class="modal fade" id="modal_movementupdate">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="form_movementupdate">
					<div class="box-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-sm-2 col-md-3">
										<label for="movement_code">Movement Code</label>
									</div>
									<div class="col-sm-10 col-md-9">
										<input type="text" class="form-control" id="movement_code" name="movement_code"
											style="text-transform:uppercase" readonly>
										<span id="movement_code_error" class="text-danger"></span>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-md-offset-4">
								<div class="form-group">
									<div class="col-sm-2 col-md-3">
										<label for="movement_date">Movement Date</label>
									</div>
									<div class="col-sm-10 col-md-9">
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control" id="movement_date"
												name="movement_date" readonly>
											<span id="movement_date_error" class="text-danger"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-sm-2 col-md-2">
										<label for="receipt_code" class="control-label">Receipt Code</label>
									</div>
									<div class="col-sm-10 col-md-10">
										<input type="hidden" class="form-control" id="receipt_id"
											name="receipt_id" readonly>
										<input type="text" class="form-control" id="receipt_code" name="receipt_code"
											readonly>
										<span id="receipt_id_movement_error" class="text-danger"></span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-sm-2 col-md-3">
										<label for="movement_description" class="control-label">Description</label>
									</div>
									<div class="col-sm-10 col-md-9">
										<input type="text" class="form-control" id="movement_description" name="movement_description">
										<span id="movement_description_error" class="text-danger"></span>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<input type="hidden" class="form-control" id="movement_id" name="movement_id" readonly>
							</div>
						</div>

						<hr>

						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="table-movementdetail"
										class="table table-bordered table-striped text-center"
										style="overflow-x: auto;width:1780px">
										<thead>
											<tr>
												<th width="150px">Asset Code</th>
												<th width="350px">Product</th>
												<th width="70px">Qty</th>
												<th width="80px">Is New</th>
												<th width="200px">From Branch</th>
												<th width="200px">From Division</th>
												<th width="200px">To Branch</th>
												<th width="200px">To Division</th>
												<th width="280px">Description</th>
											</tr>
										</thead>
										<tbody id="tbody_movementupdate">

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_closeMovement" onclick="resetUpdateMovement()">Close</button>
				<button type="submit" class="btn btn-primary" onclick="saveUpdateMovement()" id="btn_saveUpdateMovement"><i class="fa fa-save"></i> Update</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
