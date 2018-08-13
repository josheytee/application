{extends './html.tpl'}
{block 'page'}
	{include "../partials/header.tpl"}
	{$page.regions.breadcrumb}
	<div class="content">
		<div class="products-agileinfo">
			<div class="container">
				<div class="product-agileinfo-grids w3l">
					{$page.regions.highlight}
					<div class="col-md-3 product-agileinfo-grid">
						{$page.regions.sidebar}
					</div>
					<div class="col-md-9 product-agileinfon-grid1 w3l">
						{$page.content}
					</div>
				</div>
			</div>
		</div>
	</div>
	{include "../partials/footer.tpl"}
{/block}
