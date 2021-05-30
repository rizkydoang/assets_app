<div class="modal fade" id="modal_order">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <?php $this->load->view('order/v_orderline') ?>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close" onclick="resetOrder()">Close</button> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Close</button>
        <button type="submit" class="btn btn-primary" id="btnSaveOrderline"><i class="fa fa-save"></i> Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->