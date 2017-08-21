<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Associations</h3>
  </div>
  <div class="panel-body">
    <input type="hidden" name="submitted_tabs[]" value="associations">
    <div class="form-group">
      <label for="category" class="col-sm-2 control-label">Associated Sections</label>
      <div class="col-sm-10">
        <input type="text" name="id_category" class="form-control" id="category" placeholder="Category">
      </div>
    </div>
    <div class="form-group">
      <label for="shop_id" class="col-sm-2 control-label">Section</label>
      <div class="col-sm-10">
        <input type="text" name="id_shop" class="form-control" id="shop_id" placeholder="Shop_id" value="{$product->getSection()->getName()}">
      </div>
    </div>

  </div>
  {include file="./form_footer.tpl"}
</div>