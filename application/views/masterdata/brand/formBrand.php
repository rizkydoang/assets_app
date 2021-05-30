<form class="form-horizontal" id="form_brand">
  <div class="box-body">
    <div class="form-group">
      <label for="brand_code" class="col-sm-2 control-label">Brand Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="brand_code" name="brand_code" style="text-transform:uppercase" readonly>
        <span id="brand_code_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="brand_name" class="col-sm-2 control-label">Brand Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="brand_name" name="brand_name" style="text-transform:uppercase">
        <span id="brand_name_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="brand_cb"> Active
            <input type="hidden" name="brand_isactive" id="brand_isactive" value="Y">
          </label>
        </div>
      </div>
    </div>
    <input type="hidden" name="id_brand" class="form-control" readonly>
  </div>
  <!-- /.box-body -->
</form>
