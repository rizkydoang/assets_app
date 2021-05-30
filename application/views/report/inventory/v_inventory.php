<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#all" data-toggle="tab">All Assets</a></li>    
                </ul>
                <div class="tab-content">
                    <!-- Tab Inventory -->
                    <div class="tab-pane fade in active" id="all">
                        <section id="new">
                            <div class="box-header">
                           <div class="row" style="width:50%;">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="date_from_rm">Date From
                                        </label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" id="date_from_rm" name="date_from_rm">
                                            <span id="date_from_rm_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="date_to_rm" class="control-label">Date To
                                        </label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" id="date_to_rm" name="date_to_rm">
                                            <span id="date_to_rm_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                           </div>
                            <!-- <button type="button" class="btn btn-default" onclick="printInventory()">Print Label</button> -->
                            <a class="btn btn-primary">Cari</a>
                                
                        </div>
                            <!-- /.box-header -->
                        <div class="box-body">
                            <table id="table-inventoryall" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="vehicle1" value="Y"></th>
                                        <th>Asset Code</th>
                                        <th>Product Name</th>
                                        <th>Used By</th>
                                        <th>Room</th>
                                        <th>Managed By</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                            <!-- /.box-body -->
                        </section>
                    </div>
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
