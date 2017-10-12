{extends './html.tpl'}
{block 'page'}
	{include "../partials/header.tpl"}
	{$page.breadcrumb}
	<div class="content">
		<div class="products-agileinfo">
			<h2 class="tittle">Women's Wear</h2>
			<div class="container">
				<div class="product-agileinfo-grids w3l">
					{$page.highlight}
					<div class="col-md-3 product-agileinfo-grid">
						{$page.sidebar}
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
