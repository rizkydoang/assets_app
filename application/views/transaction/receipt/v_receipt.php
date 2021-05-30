<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#receipt" data-toggle="tab"><?php echo ucfirst($this->uri->segment(1)) ?></a>
					</li>
				</ul>
				<div class="tab-content">
					<!-- Tab Receipt -->
					<div class="tab-pane active">
						<section id="new">
							<?= $this->session->flashdata('pesan'); ?>
							<div class="box-header">
								<button type="submit" class="btn btn-primary" onclick="addReceipt()">Add New</button>
							</div>
							<!-- /.box-header -->
							<div class="box-body table-responsive">
								<table id="table-receipt" class="table table-bordered table-striped text-center" style="width: 100%">
									<thead>
										<tr>
											<th>Receipt Code</th>
											<th>Supplier</th>
											<th>Description</th>
											<th>Receipt Date</th>
											<th>Movement Code</th>
											<th>Movement Status</th>
											<th>Created At</th>
											<th>Created By</th>
											<th width="50px">Status</th>
											<th width="80px">Action</th>
										</tr>
									</thead>
								</table>
							</div>
							<!-- /.box-body -->
						</section>
					</div>
					<!-- /#receipt -->
				</div>
				<!-- /.tab-content -->
			</div>
			<!-- /.nav-tabs-custom -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
