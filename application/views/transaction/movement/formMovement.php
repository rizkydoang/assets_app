<form class="form-horizontal" id="form_movement">
	<div class="box-body">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<div class="col-sm-2 col-md-3">
						<label for="movement_code">Movement Code</label>
					</div>
					<div class="col-sm-10 col-md-9">
						<input type="text" class="form-control" id="movement_code" name="movement_code" style="text-transform:uppercase" readonly>
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
							<input type="text" class="form-control" id="movement_date" name="movement_date">
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
						<label for="receipt_id_movement" class="control-label">Receipt Code</label>
					</div>
					<div class="col-sm-10 col-md-10">
						<select class="form-control" id="receipt_id_movement" name="receipt_id_movement">
							<option value="">No Selected</option>
							<?php foreach ($parent_receipt as $value) : ?>
								<option value="<?php echo $value->receipt_id ?>"><?php echo $value->receipt_code ?> /
									<?php echo $value->supplier_name ?></option>
							<?php endforeach; ?>
						</select>
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
				<input type="hidden" name="id_movement" class="form-control" readonly>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-12" style="margin-top:20px;">
				<div class="table-responsive">
					<table id="table-movementline table-responsive" class="table table-bordered table-striped text-center" style="overflow-x: auto;width:100%">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th width="200px">Asset Code</th>
								<th width="300px">Product</th>
								<th width="70px">Qty</th>
								<th width="80px">Is New</th>
								<th width="200px">From Branch</th>
								<th width="200px">From Division</th>
								<th width="200px">To Branch</th>
								<th width="200px">To Division</th>
								<th width="280px">Description</th>
							</tr>
						</thead>
						<tbody id="tbody_movement">

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</form>
