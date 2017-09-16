{extends './html.tpl'}
{block 'page'}
    <div class="header">
        <div class="header-top">
            <div class="container">
                {$page.header_top}
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="heder-bottom">
            <div class="container">
                <div class="logo-nav">
                    {$page.header_bottom}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    {$page.banner}

    {$page.highlight}
    <div class="content">
        {$page.content}
    </div>
    {if $page.footer }
        <div class="footer-w3l">
            <div class="container">
                <div class="footer-grids">
                    {$page.footer}
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    {/if}
    {if $page.copy_selection }
        <div class="copy-selection">
            {$page.copy_selection }
        </div>
    {/if}
{/block}