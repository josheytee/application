{extends './html.tpl'}
{block 'page'}
    {include "../partials/header.tpl"}
      <div id="wrapper" class="container">
        <section class="navbar main-menu">
      			<div class="navbar-inner main-menu">
              {$page.navbar}
            </div>
        </section>
        {$page.slider}
        {$page.headerText}
        {$page.content}

    </div>
    {include "../partials/footer.tpl"}
{/block}
