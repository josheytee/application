{extends './html.tpl'}
{block 'page'}
  <div class="layout-container">

    <header role="banner">
      {$page.header}
    </header>

    {*      {$page.primary_menu}*}
    {*      {$page.secondary_menu}*}

    {$page.breadcrumb}

    {*    {$page.highlighted}*}

    {$page.help}

    <main role="main">
      <a id="main-content" tabindex="-1"></a>{* link is in html.html.twig *}
      {if $page.sidebar }
        <aside class="layout-sidebar-first" role="complementary">
          {$page.sidebar}
        </aside>
      {/if}

      <div class="layout-content">
        {$page.content}
      </div>{* /.layout-content *}


    </main>

    {if $page.footer }
      <footer role="contentinfo">
        {$page.footer}
      </footer>
    {/if}

  </div>{* /.layout-container *}
{/block}