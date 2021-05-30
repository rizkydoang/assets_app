<form class="form-horizontal" id="form_receipt">
	<div class="box-body">
		<div class="col-md-6">
						<div class="form-group">
							<div class="col-sm-4 col-md-4">
						<label for="receipt_code">Receipt Code</label>
					</div>
					<div class="col-sm-12 col-md-12">
						<input type="text" class="form-control" id="receipt_code" name="receipt_code" style="text-transform:uppercase" readonly>
						<span id="receipt_code_error" class="text-danger"></span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
						<div class="form-group">
							<div class="col-sm-4 col-md-4">
						<label for="invoice_number">Invoice Number</label>
					</div>
					<div class="col-sm-12 col-md-12">
						<input type="text" class="form-control" id="invoice_number" name="invoice_number" style="text-transform:uppercase">
						<span id="invoice_number_error" class="text-danger"></span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
						<div class="form-group">
							<div class="col-sm-4 col-md-4">
						<label for="receipt_date">Receipt Date</label>
					</div>
					<div class="col-sm-12 col-md-12">
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control" id="receipt_date" name="receipt_date">
							<span id="receipt_date_error" class="text-danger"></span>
						</div>
					</div>
				</div>
			</div>
		<div class="col-md-6">
						<div class="form-group">
							<div class="col-sm-4 col-md-4">
						<label for="supplier_id_receipt" class="control-label">Supplier</label>
					</div>
					<div class="col-sm-12 col-md-12">
						<select class="form-control" id="supplier_id_receipt" name="supplier_id_receipt">
							<option value="">No Selected</option>
							<?php foreach ($parent_supplier as $value) : ?>
								<option value="<?php echo $value->supplier_id ?>"><?php echo $value->supplier_name ?></option>
							<?php endforeach; ?>
						</select>
						<span id="supplier_id_receipt_error" class="text-danger"></span>
					</div>
				</div>
			</div>
			<div class="col-md-12">
						<div class="form-group">
							<div class="col-sm-4 col-md-4">
						<label for="receipt_description" class="control-label">Description</label>
					</div>
					<div class="col-sm-12 col-md-12">
						<textarea class="form-control" id="receipt_description" name="receipt_description"></textarea>
						<span id="receipt_description_error" class="text-danger"></span>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<input type="hidden" name="id_receipt" id="id_receipt" class="form-control">
			</div>

		<hr>
		<div class="row">
			<div class="col-md-12">
				<div class="text-right">
					<button type="button" name="button" class="btn btn-primary add_button"><i class="fa fa-plus"></i></button>
				</div>
			</div>
			<span id="receipts_details_product_id_error" class="text-danger"></span>
			<div class="col-md-12" style="margin-top:20px;">
				<div class="table-responsive">
					<table id="table-receiptline" class="table table-bordered table-striped text-center">
						<thead>
							<tr>
								<th>Product</th>
								<th width="12%">Qty</th>
								<th>Price</th>
								<th width="5%">Action</th>
							</tr>
						</thead>
						<tbody id="tbody_receipt">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</form>
