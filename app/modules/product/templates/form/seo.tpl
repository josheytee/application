<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">SEO</h3>
  </div>
  <div class="panel-body">
    <input type="hidden" name="submitted_tabs[]" value="seo">
    <div class="form-group">
      <label for=" meta_title" class="col-sm-2 control-label">Meta Title</label>
      <div class="col-sm-10">
        <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta Title">
      </div>
    </div>
    <div class="form-group">
      <label for="meta_keywords" class="col-sm-2 control-label">Meta Keywords</label>
      <div class="col-sm-10">
        <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" placeholder="Meta Keywords">
        <a href="quantities.tpl"></a>
      </div>
    </div>
    <div class="form-group">
      <label for="meta_description" class="col-sm-2 control-label">Meta Description</label>
      <div class="col-sm-10">
        <input type="text" name="meta_description" class="form-control" id="meta_description" placeholder="Meta Description">
      </div>
    </div>
    <div class="form-group">
      <label for="link_rewrite" class="col-sm-2 control-label">Friendly URL</label>
      <div class="col-sm-10">
        <input type="link_rewrite" name="link_rewrite" class="form-control" id="link_rewrite" placeholder="Friendly URL">
      </div>
    </div>

    {include file="./form_footer.tpl"}
  </div>
</div>