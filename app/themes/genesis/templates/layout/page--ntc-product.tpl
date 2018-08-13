{extends './html.tpl'}
{block 'page'}
    {include "../partials/header.tpl"}
    {$page.regions.breadcrumb}
    <div class="content">
        {$page.regions.highlight}
        <div class="container">
            {$page.content}
        </div>
    </div>
    {include "../partials/footer.tpl"}
{/block}