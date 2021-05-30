<div class="modal fade" id="modal_division">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <?php $this->load->view('masterdata/division/formDivision') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_closeDivision" onclick="resetDivision()">Close</button>
        <button type="submit" class="btn btn-primary" onclick="saveDivision()" id="btn_saveDivision"><i class="fa fa-save"></i> Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
