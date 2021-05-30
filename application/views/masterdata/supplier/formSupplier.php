<form class="form-horizontal" id="form_supplier">
  <div class="box-body">
    <div class="form-group">
      <label for="supplier_code" class="col-sm-2 control-label">Supplier Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="supplier_code" name="supplier_code" style="text-transform:uppercase" readonly>
        <span id="supplier_code_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="supplier_name" class="col-sm-2 control-label">Supplier Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="supplier_name" name="supplier_name" style="text-transform:uppercase">
        <span id="supplier_name_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="supplier_address" class="col-sm-2 control-label">Supplier Address</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="supplier_address" name="supplier_address">
        <span id="supplier_address_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="supplier_telephone" class="col-sm-2 control-label">Supplier Telephone Number</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="supplier_telephone" name="supplier_telephone">
        <span id="supplier_telephone_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="supplier_cb"> Active
            <input type="hidden" name="supplier_isactive" id="supplier_isactive" value="Y">
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="supplier_iv"> Is Vendor
            <input type="hidden" name="supplier_isvendor" id="supplier_isvendor" value="Y">
          </label>
        </div>
      </div>
    </div>
    <input type="hidden" name="id_supplier" class="form-control" readonly>
  </div>
  <!-- /.box-body -->
</form>
