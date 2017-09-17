{*
<script>
$('#myTabs a').click(function (e) {
e.preventDefault();
$(this).tab('show');
})
</script>*}
<div class="container-fluid">
  <div class="row">
    <div class="productTabs col-lg-2 col-md-3">
      <div class="list-group">
        {foreach $product_tabs key=numStep item=tab}
          {if $tab.name != "Pack"}
            <a class="list-group-item {if $tab.selected}active{/if}" id="link-{$tab.id}" href="{$tab.href|escape:'html':'UTF-8'}">{$tab.name}</a>
          {/if}

        {/foreach}


      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function () {
        mod_evasive = true;
        $(".productTabs a").click(function (e) {
          e.preventDefault();
          // currentId is the current product tab id
          currentId = false;
          if ($(".productTabs a.active").length)
            currentId = $(".productTabs a.active").attr('id').substr(5);
          // id is the wanted producttab id
          id = $(this).attr('id').substr(5);
          // Update submit button value
          var split_position = id.indexOf('-') + 1;
          var btn_name = id.substr(split_position);

          if ($(this).attr("id") != $(".productTabs a.active ").attr('id'))
          {
            $(".productTabs a").removeClass('active');
            $("#product-tab-content-" + currentId).hide();
          }

          // if the tab has not already been loaded, load it now
          tabs_manager.display(id, true);

          tabs_manager.onLoad(id, function () {
            $("#product-tab-content-" + id).show(0, function () {
              $(this).trigger('displayed');
            });
            $("#link-" + id).addClass('active');
          });

        });
      {* Fill an array with tabs that need to be preloaded *}
        var tabs_to_preload = [];
      {foreach $tabs_preloaded as $tab_name => $value}

        {* If the tab was not given a loading priority number it will not be preloaded *}
        {if (is_numeric($value))}
        if ($("#product-tab-content-" + '{$tab_name}').hasClass('not-loaded'))
          tabs_to_preload.push('{$tab_name}');
        {/if}
      {/foreach}
      {*               alert(tabs_to_preload.toString());*}
        tabs_manager.tabs_to_preload = tabs_to_preload.slice(0);
        tabs_manager.displayBulk(tabs_to_preload);
      });
    </script>
    <div class="col-lg-10 col-md-9">
      <!-- Tab panes -->
      <form class="form-horizontal" method="post">
        <input type="hidden" name="{$identifier}" value="">
        {foreach $product_tabs key=numStep item=tab}
          <div id="product-tab-content-{$tab.id}" class="{if !$tab.selected}not-loaded{/if} product-tab-content" {if !$tab.selected}style="display:none"{/if}>
            {if $tab.selected}
              {$custom_form}
            {/if}
          </div>
        {/foreach}

      </form>
    </div>
  </div>
  <script src="/application/app/modules/product/js/product.js"></script>
</div>
