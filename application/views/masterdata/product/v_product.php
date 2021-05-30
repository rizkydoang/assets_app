<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#product" data-toggle="tab"><?php echo ucfirst($this->uri->segment(1)) ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Tab Product -->
                    <div class="tab-pane active">
                        <section id="new">
                            <div class="box-header">
                                <button type="submit" class="btn btn-primary" onclick="addProduct()">Add New</button>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="table-product" class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Created At</th>
                                            <th>Created By</th>
                                            <th width="50px">Status</th>
                                            <th width="10px">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </section>
                    </div>
                    <!-- /#product -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
