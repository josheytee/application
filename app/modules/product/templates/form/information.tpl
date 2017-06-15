<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="icon-info"></i>Info</h3>
  </div>
  <div class="panel-body">
    <input type="hidden" name="submitted_tabs[]" value="information">
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">Type</label>
      <div class="col-sm-10">
        <div class="radio">
          <label for="simple_product">
            <input type="radio" name="type_product" id="simple_product"
                   {*                   value="{Product::PTYPE_SIMPLE}" {if $product_type == Product::PTYPE_SIMPLE}checked="checked"{/if} *}
                   value="{$product->type}" {if $product->type == 'simple'}checked="checked"{/if}
                   >Standard product
          </label>
        </div>
        <div class="radio">
          <label for="pack_product">
            <input type="radio" name="type_product" id="pack_product"
                   {*                   value="{Product::PTYPE_PACK}" {if $product_type == Product::PTYPE_PACK}checked="checked"{/if}*}
                   value="{$product->type}" {if $product->type == 'pack'}checked="checked"{/if}
                   >Pack of existing products
          </label>
        </div>
        <div class="radio">
          <label for="virtual_product">
            <input type="radio" name="type_product" id="virtual_product"
                   {*                   value="{Product::PTYPE_VIRTUAL}" {if $product_type == Product::PTYPE_VIRTUAL}checked="checked"{/if}*}
                   value="{$product->type}" {if $product->type == 'virtual'}checked="checked"{/if}
                   >Virtual product (services, booking, downloadable products, etc.)
          </label>
        </div>
      </div>
    </div>
    <hr>
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input name="name" type="text" class="form-control" id="name" value="{$product->name}">
      </div>
    </div>
    <div class="form-group">
      <label for="condition" class="col-sm-2 control-label">Condition</label>
      <div class="col-sm-10">
        <select name="condition" id="condition" class="form-control">
          <option value="new" {if $product->condition == 'new'}selected="selected"{/if} >New</option>
          <option value="used" {if $product->condition == 'used'}selected="selected"{/if} >Used</option>
          <option value="refurbished" {if $product->condition == 'refurbished'}selected="selected"{/if}>Refurbished</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="active" class="col-sm-2 control-label">Active</label>
      <div class="col-sm-10">
        <div class="switch" data-on="primary" data-off="danger" >
          <input type="checkbox" name="active" id="active" {if $product->active == 1}checked{/if} >
        </div>
      </div>
    </div>
    <div class="form-group">
      {*<div class="col-lg-1">
      <span class="pull-right">                </span>
      </div>*}
      <label class="control-label col-sm-2" for="available_for_order">
        Options
      </label>
      <div class="col-sm-10">

        <div class="checkbox">
          <label for="available_for_order">
            <input type="checkbox" name="available_for_order" id="available_for_order" value="1" {if $product->available_for_order}checked="checked"{/if} >
            Available for order</label>
        </div>
        <div class="checkbox">
          <label for="show_price">
            <input type="checkbox" name="show_price" id="show_price" value="1" {if $product->show_price}checked="checked"{/if} {if $product->available_for_order}disabled="disabled"{/if} >
            Show price</label>
        </div>
        <div class="checkbox">
          <label for="online_only">
            <input type="checkbox" name="online_only" id="online_only" value="1" {if $product->online_only}checked="checked"{/if} >
            Online only (not sold in your retail store)</label>
        </div>
      </div>
    </div>


    <div class="form-group">
      <label for="location" class="col-sm-2 control-label">Location</label>
      <div class="col-sm-10">
        <input type="text" name="location" class="form-control" id="location" placeholder="Location">
      </div>
    </div>
    <div class="form-group">
      <label for="short_description" class="col-sm-2 control-label">Short Description</label>
      <div class="col-sm-10">
        <textarea name="short_description" cols="10" rows="3" class="form-control" id="short_description" placeholder="sHORT DESCRIPTION">

        </textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="description" class="col-sm-2 control-label">Description</label>
      <div class="col-sm-10">
        <textarea name="description" cols="10" rows="5" class="form-control" id="short_description" placeholder="description">
          {$product->description|escape|wordwrap}
        </textarea>
      </div>
    </div>

    {include file="./form_footer.tpl"}
  </div>
</div>
