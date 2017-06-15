<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="icon-info"></i>Info</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal">
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input name="name" type="text" class="form-control" id="name" value="{if isset($shop->name) }{$shop->name|capitalize}{/if}">
        </div>
      </div>

      <div class="form-group">
        <label for="category" class="col-sm-2 control-label">Category</label>
        <div class="col-sm-10">
          <select name="category" class="form-control" id="category">
            <option value="{if isset($shop->category->id_category)} {$shop->category->id_category}{/if}">
            {if isset($shop->category->name)}{$shop->category->name}{/if}
          </option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="col-sm-2 control-label">Description</label>
      <div class="col-sm-10">
        <input name="description" type="text" class="form-control" id="description" value="{if isset($shop->description)} {$shop->description|escape}{/if}">
      </div>
    </div>

    <div class="form-group">
      <label for="image" class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input name="image" type="file" class="form-control" id="image" value="{if isset($shop->image) }{$shop->image}{/if}">
      </div>
    </div>

    <div class="form-group">
      <label for="url" class="col-sm-2 control-label">Url</label>
      <div class="col-sm-10">
        <input name="url" type="text" class="form-control" id="url" value="{if isset($shop->url) }{$shop->url|escape}{/if}">
      </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>

  </form>
</div>
</div>

