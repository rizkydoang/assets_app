<form class="form-horizontal" id="form_type">
  <div class="box-body">
    <div class="form-group">
      <label for="type_code" class="col-sm-2 control-label">Type Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="type_code" name="type_code" style="text-transform:uppercase" readonly>
        <span id="type_code_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="type_name" class="col-sm-2 control-label">Type Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="type_name" name="type_name" style="text-transform:uppercase">
        <span id="type_name_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="category_id" class="col-sm-2 control-label">Category</label>
      <div class="col-sm-10">
        <select class="form-control select2" id="category_id" name="category_id" style="width: 50%;">
          <option value="">No Selected</option>
          <?php foreach ($parent as $value) : ?>
            <option value="<?php echo $value->category_id ?>"><?php echo $value->category_name ?></option>
          <?php endforeach;?>
        </select>
        <span id="category_id_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="type_cb"> Active
            <input type="hidden" name="type_isactive" id="type_isactive" value="Y">
          </label>
        </div>
      </div>
    </div>
    <input type="hidden" name="id_type" class="form-control" readonly>
  </div>
  <!-- /.box-body -->
</form>
