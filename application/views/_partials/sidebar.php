<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
		<div class="pull-left image">
			<img src="<?php echo base_url('assets/adminlte/dist/img/avatar5.png') ?>" class="img-circle"
				alt="User Image">
		</div>
		<div class="pull-left info">
			<p>
				<?php echo $this->session->userdata('login_session')['user_name'] ?>
			</p>
			<a><i class="fa fa-circle text-success"></i> Online</a>
		</div>
	</div>
	<!-- search form -->
	<!-- <form action="#" class="sidebar-form">
	<div class="input-group">
	<input type="text" name="q" id="q" class="form-control" placeholder="Search...">
	<span class="input-group-btn">
		<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
		</button>
	</span>
	</div>
</form> -->
	<!-- /.search form -->
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu" data-widget="tree" id=list_menu>
		<li class="header">MAIN NAVIGATION</li>
		<li><a href="dashboard"><i
					class="fa fa-tachometer"></i><span>Dashboard</span></a>
		</li>
		<?php if (is_controller()) : ?>
		<li class="treeview" style="height: auto;"><a href="sas_assets"><i
					class="fa fa-credit-card"></i><span>Transaction</span><span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span></a>
			<ul class="treeview-menu" style="display: none;">
				<li><a href="<?= base_url('trx_receipt'); ?>"><i class="fa fa-circle-o"></i>Product Receipt</a>
				</li>
				<li><a href="<?= base_url('trx_movement'); ?>"><i class="fa fa-circle-o"></i>Product Movement</a>
				</li>
				<li><a href="<?= base_url('trx_movement'); ?>"><i class="fa fa-circle-o"></i>Move Product</a>
				</li>
			</ul>
		</li>
		<li class="treeview"><a href=""><i class="fa fa-server"></i><span>Master
					Data</span><span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span></a>
			<ul class="treeview-menu">
				<li><a href="<?= base_url('brand'); ?>"><i class="fa fa-circle-o"></i>Brand</a></li>
				<li><a href="<?= base_url('category'); ?>"><i class="fa fa-circle-o"></i>Category</a></li>
				<li><a href="<?= base_url('type'); ?>"><i class="fa fa-circle-o"></i>Type</a></li>
				<li><a href="<?= base_url('product'); ?>"><i class="fa fa-circle-o"></i>Product</a></li>
				<li><a href="<?= base_url('branch'); ?>"><i class="fa fa-circle-o"></i>Branch</a></li>
				<li><a href="<?= base_url('supplier'); ?>"><i class="fa fa-circle-o"></i>Supplier</a></li>
				<li><a href="<?= base_url('status'); ?>"><i class="fa fa-circle-o"></i>Product Status</a></li>
				<li><a href="<?= base_url('division'); ?>"><i class="fa fa-circle-o"></i>Division</a></li>
				<li><a href="<?= base_url('user'); ?>"><i class="fa fa-circle-o"></i>User</a></li>
			</ul>
		</li>
		<?php endif; ?>
		<li class="treeview"><a href=""><i class="fa fa-database"></i><span>Warehouse</span><span
					class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span></a>
			<ul class="treeview-menu">
				<li><a href="<?= base_url('storage'); ?>"><i class="fa fa-circle-o"></i>Storage</a>
				</li>
			</ul>
		</li>
		<li class="treeview"><a href=""><i class="fa fa-file-archive-o"></i><span>Report</span><span
					class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span></a>
			<ul class="treeview-menu">
				<li><a href="<?= base_url('all_report'); ?>"><i class="fa fa-circle-o"></i>All Report</a>
				</li>
				<li><a href="<?= base_url('cost_center'); ?>"><i class="fa fa-circle-o"></i>Cost Center</a>
				</li>
				<li><a href="<?= base_url('product_movement'); ?>"><i class="fa fa-circle-o"></i>Product
						Movement</a></li>
				<li><a href="<?= base_url('profit_center'); ?>"><i class="fa fa-circle-o"></i>Profit
						Center</a>
				</li>
			</ul>
		</li>
	</ul>
</section>