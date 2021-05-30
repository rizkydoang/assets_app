<div class="modal fade" id="modal_rptmovement">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table-rptmovement" class="table table-bordered table-striped text-center" style="overflow-x: auto;width:1580px">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th width="200px">Date</th>
                                <th width="350px">Product Name</th>
                                <th width="150px">Asset Code</th>
                                <th width="150px">Status</th>
                                <th width="200px">User From</th>
                                <th width="200px">User To</th>
                                <th width="280px">Description</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_rptmovement">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_closeRptMovement" onclick="resetRptMovement()">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
