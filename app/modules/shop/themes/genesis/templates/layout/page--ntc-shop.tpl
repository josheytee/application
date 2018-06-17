{extends './html.tpl'}
{block 'page'}
    {include "../partials/header.tpl"}
    <div class="content">
        {$page.highlight}
        {$page.content}
    </div>
    {include "../partials/footer.tpl"}
{/block}