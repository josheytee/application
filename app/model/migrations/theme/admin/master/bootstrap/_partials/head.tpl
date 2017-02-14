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
{if isset($css)}
    {foreach from=$css key=css_uri item=media}
        <link rel="stylesheet" href="{$css_uri|escape:'html':'UTF-8'}" type="text/css" media="{$media|escape:'html':'UTF-8'}"/>
    {/foreach}
{/if}
{if  isset($js)}
    {foreach $js as $js_uri}
        <script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
    {/foreach}
{/if}