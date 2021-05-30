<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view("_partials/head") ?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <?php $this->load->view('_partials/logo') ?>
        <!-- Header Navbar: style can be found in header.less -->
        <?php $this->load->view("_partials/navbar") ?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php $this->load->view("_partials/sidebar") ?>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <?php $this->load->view('_partials/breadcrumb') ?>
        </section>
        <!-- Main content -->
        <?php echo $contents ?> <!-- variabel dari libraries template-->
        <!-- /.content -->
      </div>

      <!-- /.content-wrapper -->
      <!-- Footer -->
      <?php $this->load->view("_partials/footer") ?>
      <!-- ./footer -->

      <!-- Control Sidebar -->
      <!-- <aside class="control-sidebar control-sidebar-dark" style="display: none;"> -->
      <?php //$this->load->view('_partials/control') ?>
      <!-- </aside> -->
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
      <!-- <div class="control-sidebar-bg"></div> -->

    </div>
    <!-- ./wrapper -->
    <?php $this->load->view("_partials/js") ?>
  </body>
</html>

<!-- Modal -->
<?php $this->load->view('transaction/receipt/modal') ?>
<?php $this->load->view('transaction/movement/modal') ?>
<?php $this->load->view('masterdata/brand/modal') ?>
<?php $this->load->view('masterdata/category/modal') ?>
<?php $this->load->view('masterdata/type/modal') ?>
<?php $this->load->view('masterdata/product/modal') ?>
<?php $this->load->view('masterdata/product_status/modal') ?>
<?php $this->load->view('masterdata/branch/modal') ?>
<?php $this->load->view('masterdata/division/modal') ?>
<?php $this->load->view('masterdata/user/modal') ?>
<?php $this->load->view('masterdata/supplier/modal') ?>
<?php $this->load->view('report/movement/modal') ?>

<!-- JS -->
<?php $this->load->view('transaction/receipt/receipt_process') ?>
<?php $this->load->view('transaction/movement/movement_process') ?>
<?php $this->load->view('masterdata/brand/brand_process') ?>
<?php $this->load->view('masterdata/category/category_process') ?>
<?php $this->load->view('masterdata/type/type_process') ?>
<?php $this->load->view('masterdata/product/product_process') ?>
<?php $this->load->view('masterdata/product_status/status_process') ?>
<?php $this->load->view('masterdata/branch/branch_process') ?>
<?php $this->load->view('masterdata/division/division_process') ?>
<?php $this->load->view('masterdata/user/user_process') ?>
<?php $this->load->view('masterdata/supplier/supplier_process') ?>
<?php $this->load->view('report/inventory/inventory_process') ?>
<?php $this->load->view('report/movement/movement_process') ?>
