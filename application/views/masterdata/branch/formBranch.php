<form class="form-horizontal" id="form_branch">
  <div class="box-body">
    <div class="form-group">
      <label for="branch_code" class="col-sm-2 control-label">Branch Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="branch_code" name="branch_code" style="text-transform:uppercase" readonly>
        <span id="branch_code_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="branch_name" class="col-sm-2 control-label">Branch Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="branch_name" name="branch_name" style="text-transform:uppercase">
        <span id="branch_name_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="branch_address" class="col-sm-2 control-label">Branch Address</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="branch_address" name="branch_address">
        <span id="branch_address_error" class="text-danger"></span>
      </div>
    </div>
    <!-- <div class="form-group">
      <label for="branch_leader" class="col-sm-2 control-label">Branch Leader</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="branch_leader" name="branch_leader">
        <span id="branch_leader_error" class="text-danger"></span>
      </div>
    </div> -->
    <div class="form-group">
      <label for="branch_leader_u_id" class="col-sm-2 control-label">Branch Leader</label>
      <div class="col-sm-10">
        <select class="form-control select2" id="branch_leader_u_id" name="branch_leader_u_id" style="width: 50%;">
          <option value="">No Selected</option>
          <?php foreach ($branch_leader as $value) : ?>
            <option value="<?php echo $value->user_id ?>"><?php echo $value->user_name ?></option>
          <?php endforeach;?>
        </select>
        <span id="branch_leader_error" class="text-danger"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="branch_telephone" class="col-sm-2 control-label">Branch Telephone Number</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="branch_telephone" name="branch_telephone">
        <span id="branch_telephone_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="branch_cb"> Active
            <input type="hidden" name="branch_isactive" id="branch_isactive" value="Y">
          </label>
        </div>
      </div>
    </div>
    <input type="hidden" name="id_branch" class="form-control" readonly>
  </div>
  <!-- /.box-body -->
</form>
