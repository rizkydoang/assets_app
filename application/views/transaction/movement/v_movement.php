<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#movement" data-toggle="tab"><?php echo ucfirst($this->uri->segment(1)) ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Tab Movement -->
                    <div class="tab-pane active">
                        <section id="new">
                            <div class="box-header">
                                <button type="submit" class="btn btn-primary" onclick="addMovement()">Add New</button>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="table-movement" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Movement Code</th>
                                            <th>Movement Date</th>
                                            <th>Receipt Code</th>
                                            <th>Receipt Status</th>
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
                    <!-- /#movement -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
