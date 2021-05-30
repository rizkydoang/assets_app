<form class="form-horizontal" id="form_user">
  <div class="box-body">
    <div class="form-group">
      <label for="user_code" class="col-sm-2 control-label">User Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="user_code" name="user_code" style="text-transform:uppercase" readonly>
        <span id="user_code_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="user_name" class="col-sm-2 control-label">User Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="user_name" name="user_name" style="text-transform:uppercase">
        <span id="user_name_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="password" name="password" style="text-transform:uppercase">
        <span id="password_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="branch_id_user" class="col-sm-2 control-label">Branch</label>
      <div class="col-sm-10">
        <select class="form-control select2" id="branch_id_user" name="branch_id_user" style="width: 50%;">
          <option value="">No Selected</option>
          <?php foreach ($parent_branch as $value) : ?>
            <option value="<?php echo $value->branch_id ?>"><?php echo $value->branch_name ?></option>
          <?php endforeach;?>
        </select>
        <span id="branch_id_user_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="division_id_user" class="col-sm-2 control-label">Division</label>
      <div class="col-sm-10">
        <select class="form-control select2" id="division_id_user" name="division_id_user" style="width: 50%;">
          <option value="">No Selected</option>
          <?php foreach ($parent_division as $value) : ?>
            <option value="<?php echo $value->division_id ?>"><?php echo $value->division_name ?></option>
          <?php endforeach;?>
        </select>
        <span id="division_id_user_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="user_cb"> Active
            <input type="hidden" name="user_isactive" id="user_isactive" value="Y">
          </label>
        </div>
      </div>
    </div>
    <input type="hidden" name="id_user" class="form-control" readonly>
  </div>
  <!-- /.box-body -->
</form>
