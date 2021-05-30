<form class="form-horizontal" id="form_category">
  <div class="box-body">
    <div class="form-group">
      <label for="category_code" class="col-sm-2 control-label">Category Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="category_code" name="category_code" style="text-transform:uppercase" readonly>
        <span id="category_code_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="category_name" class="col-sm-2 control-label">Category Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="category_name" name="category_name" style="text-transform:uppercase">
        <span id="category_name_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="category_cb"> Active
            <input type="hidden" name="category_isactive" id="category_isactive" value="Y">
          </label>
        </div>
      </div>
    </div>
    <input type="hidden" name="id_category" class="form-control" readonly>
  </div>
  <!-- /.box-body -->
</form>
