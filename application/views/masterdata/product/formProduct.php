<form class="form-horizontal" id="form_product">
  <div class="box-body">
    <div class="form-group">
      <label for="product_code" class="col-sm-2 control-label">Product Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="product_code" name="product_code" style="text-transform:uppercase" readonly>
        <span id="product_code_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="product_name" class="col-sm-2 control-label">Product Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="product_name" name="product_name" style="text-transform:uppercase">
        <span id="product_name_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="brand_id_product" class="col-sm-2 control-label">Brand</label>
      <div class="col-sm-10">
        <select class="form-control select2" id="brand_id_product" name="brand_id_product" style="width: 50%;">
          <option value="">No Selected</option>
          <?php foreach ($parent_brand as $value) : ?>
            <option value="<?php echo $value->brand_id ?>"><?php echo $value->brand_name ?></option>
          <?php endforeach;?>
        </select>
        <span id="brand_id_product_error" class="text-danger"></span>
      </div>
    </div>


    <div class="form-group">
      <label for="category_id_product" class="col-sm-2 control-label">Category</label>
      <div class="col-sm-10">
        <select class="category form-control" id="category_id_product" name="category_id_product" style="width: 50%;">
          <option value="">No Selected</option>
          <?php foreach ($parent_category as $value) : ?>
            <option value="<?php echo $value->category_id ?>"><?php echo $value->category_name ?></option>
          <?php endforeach;?>
        </select>
        <span id="category_id_product_error" class="text-danger"></span>
      </div>
    </div>

    <!-- <div class="form-group">
      <label for="subcategory_id_product" class="col-sm-2 control-label">Sub Category</label>
      <div class="col-sm-10">
        <select class="subcategory form-control" id="subcategory_id_product" name="subcategory_id_product" style="width: 50%;">
          <option value="">No Selected</option>

        </select>
        <span id="subcategory_id_product_error" class="text-danger"></span>
      </div>
    </div> -->

    <div class="form-group">
      <label for="type_id_product" class="col-sm-2 control-label">Type</label>
      <div class="col-sm-10">
        <select class="type form-control" id="type_id_product" name="type_id_product" style="width: 50%;">
          <option value="">No Selected</option>
          <?php foreach ($parent_type as $value) : ?>
            <option value="<?php echo $value->type_id ?>"><?php echo $value->type_name ?></option>
          <?php endforeach;?>
        </select>
        <span id="type_id_product_error" class="text-danger"></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="product_cb"> Active
            <input type="hidden" name="product_isactive" id="product_isactive" value="Y">
          </label>
        </div>
      </div>
    </div>
    
  <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="radio">
          <label>
            <input type="radio" id="cost_center" name="cost_center" value="Y">Cost Center
            <br>
            <input type="radio" id="profit_center" name="cost_center" value="N"> Profit Center
            <!-- <input type="checkbox" id="cost_center"> Cost Center
            <input type="hidden" name="cost_center" id="cost_center" value="N"> -->
          </label>
        </div>
      </div>
    </div>

  <!-- <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="profit_center"> Profit Center
            <input type="hidden" name="profit_center" id="profit_center" value="N">
          </label>
        </div>
      </div>
    </div> -->
    
    <input type="hidden" name="id_product" class="form-control" readonly>
  </div>
  <!-- /.box-body -->
</form>
