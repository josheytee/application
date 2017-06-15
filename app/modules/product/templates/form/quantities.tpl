<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Quantity</h3>
  </div>
  <div class="panel-body">
    <input type="hidden" name="submitted_tabs[]" value="quantity">
    <div class="form-group">
      <label for="quantity" class="col-sm-2 control-label">Quantity</label>
      <div class="col-sm-10">
        <input type="text" name="quantity" class="form-control" id="quantity" placeholder="quantity">
      </div>
    </div>
    <div class="form-group">
      <label for="minimal_quantity" class="col-sm-2 control-label">Minimal Quantity</label>
      <div class="col-sm-10">
        <input type="text" name="minimal_quantity" class="form-control" id="minimal_quantity" placeholder="Minimal Quantity">
      </div>
    </div>

    <div class="form-group">
      <label for="quantity_discount" class="col-sm-2 control-label">Quantity Discount</label>
      <div class="col-sm-10">
        <input type="text" name="quantity_discount" class="form-control" id="quantity_discount" placeholder="Quantity Discount">
      </div>
    </div>


    {include file="./form_footer.tpl"}
  </div>
</div>