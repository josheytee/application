<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Prices</h3>
  </div>
  <div class="panel-body">
    <input type="hidden" name="submitted_tabs[]" value="prices">
    <div class="form-group">
      <label for="price" class="col-sm-2 control-label">Price</label>
      <div class="col-sm-10">
        <input type="text" name="price" class="form-control" id="price" placeholder="Price" value="{$product->price}">
      </div>
    </div>
    <div class="form-group">
      <label for="wholesale_price" class="col-sm-2 control-label">Wholesale Price</label>
      <div class="col-sm-10">
        <input type="text" name="wholesale_price" class="form-control" id="wholesale_price" placeholder="Wholesale Price">
      </div>
    </div>
    {include file="./form_footer.tpl"}
  </div>
</div>