{extends './html.tpl'}
{block 'page'}
    {include "../partials/header.tpl"}
    {$page.navbar}
    <div id="wrapper" class="container">
        {$page.headerText}
        {$page.container}
    </div>
    {include "../partials/footer.tpl"}
{/block}
