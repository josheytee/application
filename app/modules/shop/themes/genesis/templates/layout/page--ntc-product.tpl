{extends './html.tpl'}
{block 'page'}
	{include "../partials/header.tpl"}
	{$page.breadcrumb}
	<div class="content">
		{$page.highlight}
		<div class="single-wl3">
			<div class="container">
				{$page.content}
			</div>
		</div>
	</div>
	{include "../partials/footer.tpl"}
{/block}