<form class="form-horizontal" id="form_division">
  <div class="box-body">
    <div class="form-group">
      <label for="division_code" class="col-sm-2 control-label">Division Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="division_code" name="division_code" style="text-transform:uppercase" readonly>
        <span id="division_code_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="division_name" class="col-sm-2 control-label">Division Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="division_name" name="division_name" style="text-transform:uppercase">
        <span id="division_name_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="branch_id" class="col-sm-2 control-label">Branch</label>
      <div class="col-sm-10">
        <select class="form-control select2" id="branch_id" name="branch_id" style="width: 50%;">
          <option value="">No Selected</option>
          <?php foreach ($parent as $value) : ?>
            <option value="<?php echo $value->branch_id ?>"><?php echo $value->branch_name ?></option>
          <?php endforeach;?>
        </select>
        <span id="branch_id_error" class="text-danger"></span>
      </div>
    </div>
    <!-- <div class="form-group">
      <label for="division_manager" class="col-sm-2 control-label">Manager</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="division_manager" name="division_manager">
        <span id="division_manager_error" class="text-danger"></span>
      </div>
    </div> -->
    <div class="form-group">
      <label for="division_manager_u_id" class="col-sm-2 control-label">Division Manager</label>
      <div class="col-sm-10">
        <select class="form-control select2" id="division_manager_u_id" name="division_manager_u_id" style="width: 50%;">
          <option value="">No Selected</option>
          <?php foreach ($user as $value) : ?>
            <option value="<?php echo $value->user_id ?>"><?php echo $value->user_name ?></option>
          <?php endforeach;?>
        </select>
        <span id="division_manager_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="division_cb"> Active
            <input type="hidden" name="division_isactive" id="division_isactive" value="Y">
          </label>
        </div>
      </div>
    </div>
    <input type="hidden" name="id_division" class="form-control" readonly>
  </div>
  <!-- /.box-body -->
</form>
