{extends './html.tpl'}
{block 'page'}
    {include "../partials/header.tpl"}
    {$page.banner}
    <div class="content">
        {$page.highlight}
        {$page.content}
    </div>
    {include "../partials/footer.tpl"}
{/block}