{extends './html.tpl'}
{block 'page'}
    {*{include "../partials/header.tpl"}*}
    {$page.regions.breadcrumb}
    <div class="content">
        {$page.regions.highlight}
        {$page.content}
    </div>
    {include "../partials/footer.tpl"}
{/block}