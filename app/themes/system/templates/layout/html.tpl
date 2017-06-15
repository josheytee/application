<!doctype html>
{*<html lang="{$language.iso_code}">*}
<html>

  <head>
    {*{block name='head'}
    {include file='_partials/head.tpl'}
    {/block}*}
    <title>
      Guess
    </title>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Agbeja oluwatobiloba | tobiagbeja4@gmail.com">
    <meta name="keywords" content="">
    <!-- <link rel="stylesheet" href="C:/wamp/www/application/app/themes/system/library/bootstrap/css/bootstrap.min.css" type="text/css" media="all"/>
    -->
    <link rel="stylesheet" href="/application/app/themes/system/library/bootstrap/css/bootstrap.min.css" type="text/css" media="all"/>

    {*  {if isset($css)}
    {foreach from=$css key=css_uri item=media}
    <link rel="stylesheet" href="{$css_uri|escape:'html':'UTF-8'}" type="text/css" media="{$media|escape:'html':'UTF-8'}"/>
    {/foreach}
    {/if}
    {if  isset($js)}
    {foreach $js as $js_uri}
    <script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
    {/foreach}
    {/if}*}
  </head>

  <body>
    <script type="text/javascript" src="/application/app/themes/system/library/jquery/jquery.js"></script>
    <script type="text/javascript" src="/application/app/themes/system/library/bootstrap/js/bootstrap.min.js"></script>
    <main>
      <header id="header">
        {block name='header'}
          {if isset($header)}
            {$header}
          {/if}
        {/block}
      </header>
      <div class="container">

        {block name="sidebar_right"}
          <div id="left-column" class="col-xs-12 col-sm-4 col-md-3">
            {if isset($sidebar_right)}
              {$sidebar_right}
            {/if}

          </div>
        {/block}

        {block name="sidebar_left"}
          <div id="right-column" class="col-xs-12 col-sm-8 col-md-9">
            {if isset($sidebar_left)}
              {$sidebar_left}
            {/if}
          </div>
        {/block}

        <div id="content-wrapper" class="left-column right-column">
          {block name="breadcrumb"}
            {if isset($breadcrumb)}
              {$breadcrumb}
            {/if}

          {/block}
          {block name="highlighted"}
            {$highlighted}
          {/block}
          {block name="container"}
            {$container}
          {/block}
        </div>

      </div>
      <footer id="footer">
        {block name="footer"}
          {$footer}
        {/block}
      </footer>

    </main>

  </body>

</html>
