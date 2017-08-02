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
      <div class="row">
        {if $page.sidebar }
          <div class="col-md-2">
            <aside class="layout-sidebar-first" role="complementary">
              {$page.sidebar}
            </aside>
          </div>
        {/if}
        <div class=" col-md-10">
          {$page.content}
        </div>
      </div>


    </main>

    {if $page.footer }
      <footer role="contentinfo">
        {$page.footer}
      </footer>
    {/if}

  </div>{* /.layout-container *}
{/block}