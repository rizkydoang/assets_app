<div class="modal fade" id="modal_receipt">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<?php $this->load->view('transaction/receipt/formReceipt') ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_closeReceipt" onclick="resetReceipt()">Close</button>
				<button type="submit" class="btn btn-primary" onclick="saveReceipt()" id="btn_saveReceipt"><i class="fa fa-save"></i> Save</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal_receiptdetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="form_receiptdetail">
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-sm-4 col-md-4">
								<label for="receipt_code_rd">Receipt Code</label>
							</div>
							<div class="col-sm-12 col-md-12">
								<input type="text" class="form-control" id="receipt_code_rd" name="receipt_code_rd" style="text-transform:uppercase" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-sm-4 col-md-4">
								<label for="invoice_number_rd">Invoice Number</label>
							</div>
							<div class="col-sm-12 col-md-12">
								<input type="text" class="form-control" id="invoice_number_rd" name="invoice_number_rd" style="text-transform:uppercase" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-sm-4 col-md-4">
								<label for="receipt_date_rd">Receipt Date</label>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" id="receipt_date_rd" name="receipt_date_rd" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-sm-4 col-md-4">
								<label for="receipt_date_rd">Supplier</label>
							</div>
							<div class="col-sm-12 col-md-12">
								<input class="form-control" id="supplier_name_rd" name="supplier_name_rd" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<div class="col-sm-4 col-md-4">
								<label for="receipt_description_rd" class="control-label">Description</label>
							</div>
							<div class="col-sm-12 col-md-12">
								<textarea class="form-control" id="receipt_description_rd" name="receipt_description_rd" readonly></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<input type="hidden" class="form-control" id="id_receipt_rd" name="id_receipt_rd" readonly>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="table-receiptdetail" class="table table-bordered table-striped text-center">
									<thead>
										<tr>
											<th width="5%">No.</th>
											<th>Product</th>
											<th width="5%">Qty</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody id="tbody_receiptdetail"></tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- </div> -->
					<!-- /.box-body -->
				</form>

			</div>
			<div class="modal-footer">
				<button type="button" id="tovoidnotcomplete" class="btn btn-danger">Void</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" id="btn_closeReceipt" onclick="resetReceipt()">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
