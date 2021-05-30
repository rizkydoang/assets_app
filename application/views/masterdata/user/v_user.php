<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#user" data-toggle="tab"><?php echo ucfirst($this->uri->segment(1)) ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Tab User -->
                    <div class="tab-pane active">
                        <section id="new">
                            <div class="box-header">
                                <button type="submit" class="btn btn-primary" onclick="addUser()">Add New</button>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="table-user" class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>User Code</th>
                                            <th>User Name</th>
                                            <!-- <th>Password</th> -->
                                            <th>Branch</th>
                                            <th>Division</th>
                                            <th width="50px">Status</th>
                                            <th width="10px">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </section>
                    </div>
                    <!-- /#user -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
