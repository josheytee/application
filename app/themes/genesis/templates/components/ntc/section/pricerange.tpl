<div class="price">
	<h3>Price Range</h3>
	<ul class="dropdown-menu6">
		<li>
			<div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
				<div class="ui-slider-range ui-widget-header" style="left: 11.1111%; width: 66.6667%;">
				</div>
				<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 11.1111%;"></a>
				<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 77.7778%;"></a>
			</div>
			<input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;">
		</li>
	</ul>
	<script type="text/javascript">//<![CDATA[
      $(window).load(function () {
          $("#slider-range").slider({
              range: true,
              min: 0,
              max: 9000,
              values: [1000, 7000],
              slide: function (event, ui) {
                  $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
              }
          });
          $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

      });//]]>

	</script>
	<script type="text/javascript" src="/application/app/modules/shop/themes/new-shop/js/jquery-ui.js"></script>
</div>