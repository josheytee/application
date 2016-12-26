<!doctype html>
<html lang="{$language.iso_code}">

    <head>
        {block name='head'}
            {include file='_partials/head.tpl'}
        {/block}
    </head>

    <body>

        <main>
            <header id="header">
                {block name='header'}

                {/block}
            </header>
            <div class="container">

                {block name="left_column"}
                    <div id="left-column" class="col-xs-12 col-sm-4 col-md-3">
                    </div>
                {/block}

                {block name="right_column"}
                    <div id="right-column" class="col-xs-12 col-sm-8 col-md-9">
                    </div>
                {/block}

                {block name="content_wrapper"}
                    <div id="content-wrapper" class="left-column right-column">
                        {block name="content"}
                            <p>Hello world! This is HTML5 Boilerplate.</p>
                        {/block}
                    </div>
                {/block}

            </div>
            <footer id="footer">
                {block name="footer"}
                {/block}
            </footer>

        </main>

    </body>

</html>
