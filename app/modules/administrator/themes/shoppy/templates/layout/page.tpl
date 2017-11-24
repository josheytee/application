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
                        var navoffeset = $(".header-main").offset().top + 1;
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
        <div class="copyrights">
            <p>© 2016 Shoppy. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
        </div>
    </div>
    {*.layout-container *}
{/block}
