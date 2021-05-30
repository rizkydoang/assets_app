<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#menu" data-toggle="tab"><?php echo ucfirst($this->uri->segment(1)) ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <span id="success_message"></span>
                    <span id="error_message"></span>
                    <!-- Tab Menu -->
                    <div class="tab-pane active">
                        <section id="new">
                            <div class="box-header">
                                <button type="button" class="btn btn-primary" onclick="reloadOrder()" title="Refresh"><i class="fa fa-refresh"></i> Refresh</button>
                            </div>
                            <div class="box-body">
                                <table id="table-orderstatus" class="table table-bordered table-striped" style="width:100%">
                                    <thead>                                        
                                        <tr>
                                            <th width="150px">Documentno</th>
                                            <th width="85px">Date Ordered</th>
                                            <th>Business Partner</th>
                                            <th width="85px">Invoice Rule</th>
                                            <th width="85px">Warehouse</th>
                                            <th width="50px">Process</th>
                                            <th width="50px">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </section>
                    </div>
                    <!-- /#menu -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>