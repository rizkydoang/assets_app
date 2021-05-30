<h1>
<?php echo ucfirst($this->uri->segment(1)) ?>
</h1>
<ol class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i>Dashboard </a></li>
	<li class="active"><?php echo ucfirst($this->uri->segment(1)) ?></li>
</ol>
