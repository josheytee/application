<script>
  $('#myTabs a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  })
</script>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2 col-md-3">
      <!-- Nav tabs -->
      <ul class="nav nav-pills nav-stacked" role="tablist" id="myTabs">
        <li role="presentation" class="active"><a href="#infomation" aria-controls="infomation" role="tab" data-toggle="tab">Information</a></li>
        <li role="presentation"><a href="#associations" aria-controls="associations" role="tab" data-toggle="tab">Associations</a></li>
        <li role="presentation"><a href="#prices" aria-controls="prices" role="tab" data-toggle="tab">Prices</a></li>
        <li role="presentation"><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">SEO</a></li>
        <li role="presentation"><a href="#Features" aria-controls="Features" role="tab" data-toggle="tab">Features</a></li>
        <li role="presentation"><a href="#Quantity" aria-controls="Quantity" role="tab" data-toggle="tab">Quantity</a></li>
        <li role="presentation"><a href="#Image" aria-controls="Image" role="tab" data-toggle="tab">Image</a></li>

      </ul>
    </div>
    <div class="col-lg-10 col-md-9">
      <!-- Tab panes -->
      <form class="form-horizontal" method="post">
        <input type="hidden" name="{$identifier}" value="">

        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="infomation">
            {include file=".information.tpl"}
          </div>
          <div role="tabpanel" class="tab-pane" id="associations">
            {include file="./assoc.tpl"}
          </div>
          <div role="tabpanel" class="tab-pane" id="prices">
            {include file="./prices.tpl"}
          </div>
          <div role="tabpanel" class="tab-pane" id="seo">
            {include file="./seo.tpl"}
          </div>
          <div role="tabpanel" class="tab-pane" id="Features">
            {include file="./features.tpl"}
          </div>
          <div role="tabpanel" class="tab-pane" id="Quantity">
            {include file="./quantity.tpl"}
          </div>
          <div role="tabpanel" class="tab-pane" id="Image">
            {include file="./image.tpl"}
          </div>
        </div>
      </form>
    </div>
  </div>
</div>