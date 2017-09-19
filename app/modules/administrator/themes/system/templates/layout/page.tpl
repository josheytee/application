{extends './html.tpl'}
{block 'page'}
    <div class="page-container sidebar-collapsed-back">
        <div class="left-content">
            <div class="mother-grid-inner">
                <div class="header-main">
                    <div class="header-left">
                        {$page.header_left}
                    </div>
                    <div class="header-right">
                        {$page.header_right}
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        var navoffeset = $(".header-main").offset().top;
                        $(window).scroll(function () {
                            var scrollpos = $(window).scrollTop();
                            if (scrollpos >= navoffeset) {
                                $(".header-main").addClass("fixed");
                            } else {
                                $(".header-main").removeClass("fixed");
                            }
                        });

                    });
                </script>
                {$page.breadcrumb}
                <div class="inner-block">
                    {$page.help}
                    {$page.content}
                </div>
            </div>
        </div>
        {if $page.sidebar}
            {$page.sidebar}
        {/if}
        <div class="clearfix"></div>
        {if $page.footer }
            <footer role="contentinfo">
                {$page.footer}
            </footer>
        {/if}

    </div>
    {*.layout-container *}
    <script type="text/javascript"
            src="/application/app/modules/administrator/themes/system/js/main.js"></script>
{/block}
