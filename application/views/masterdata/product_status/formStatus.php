<form class="form-horizontal" id="form_status">
  <div class="box-body">
    <div class="form-group">
      <label for="status_code" class="col-sm-2 control-label">Status Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="status_code" name="status_code" style="text-transform:uppercase" readonly>
        <span id="status_code_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="status_name" class="col-sm-2 control-label">Product Status Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="status_name" name="status_name" style="text-transform:uppercase">
        <span id="status_name_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="status_nickname" class="col-sm-2 control-label">Product Status NickName</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="status_nickname" name="status_nickname" style="text-transform:uppercase">
        <span id="status_nickname_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="status_cb"> Active
            <input type="hidden" name="status_isactive" id="status_isactive" value="Y">
          </label>
        </div>
      </div>
    </div>
    <input type="hidden" name="id_status" class="form-control" readonly>
  </div>
  <!-- /.box-body -->
</form>