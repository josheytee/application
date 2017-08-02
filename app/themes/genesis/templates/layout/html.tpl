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
    <!-- <link rel="stylesheet" href="C:/wamp/www/application/app/themes/genesis/library/bootstrap/css/bootstrap.min.css" type="text/css" media="all"/>
    -->
    <link rel="stylesheet" href="/application/app/themes/genesis/library/bootstrap/css/bootstrap.min.css" type="text/css" media="all"/>

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

    {block 'page'}
      page content
    {/block}
    <script type="text/javascript" src="/application/app/themes/genesis/library/jquery/jquery.js"></script>
    <script type="text/javascript" src="/application/app/themes/genesis/library/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>
