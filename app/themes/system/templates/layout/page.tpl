<!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>

        <meta charset="utf-8">
        <meta name="robots" content="all,follow">
        <meta name="googlebot" content="index,follow,snippet,archive">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Obaju e-commerce template">
        <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
        <meta name="keywords" content="">

        <title>
            {if !empty($title)}
                {$title}
            {/if}

        </title>

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

        <!-- my styles -->
        {*{if isset($css_files)}
        {foreach from=$css_files key=css_uri item=media}
        <link rel="stylesheet" href="{$css_uri|escape:'html':'UTF-8'}" type="text/css" media="{$media|escape:'html':'UTF-8'}" />
        {/foreach}
        {/if}
        {if  isset($js_files)}
        {foreach $js_files as $js_uri}
        <script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
        {/foreach}
        {/if}*}
        <!-- styles -->

        <link href="/Beta/admin/themes/default/css/admin-theme.css" rel="stylesheet">

        <script src="/Beta/web/themes/default/js/respond.min.js"></script>

        <link rel="shortcut icon" href="favicon.png">

        {if  isset($js_files)}
            {foreach $js_files as $js_uri}
                <script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
            {/foreach}
        {/if}   <script src="/Beta/admin/themes/default/js/vendor/bootstrapSwitch.js"></script>


    </head>

    <body>
        {if isset($errors)&&{$errors|@count}>1}
            {include file="errors.tpl"}
        {/if}
        {$page}

        {*   <script src="/Beta/web/themes/default/js/jquery-1.11.0.min.js"></script>*}
        {*   <script src="/Beta/admin/themes/default/js/vendor/bootstrap.min.js"></script>*}
    </body>
</html>