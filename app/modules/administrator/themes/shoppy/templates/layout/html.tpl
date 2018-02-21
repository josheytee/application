<!doctype html>
{*<html lang="{$language.iso_code}">*}
<html>

<head>
    {*{block name='head'}
    {include file='_partials/head.tpl'}
    {/block}*}
    <title>
        {block name='title'}
            {($page.title) ? $page.title : admin || Guess}
        {/block}
    </title>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Agbeja oluwatobiloba | tobiagbeja4@gmail.com">
    <meta name="keywords" content="">
    <!-- css -->
    <link rel="stylesheet" href="/application/app/modules/administrator/themes/shoppy/css/bootstrap.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" href="/application/app/modules/administrator/themes/shoppy/css/style.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" href="/application/app/modules/administrator/themes/shoppy/css/font-awesome.css"
          type="text/css"
          media="all"/>
    <!-- css -->

    <!-- js -->
    <script type="text/javascript"
            src="/application/app/modules/administrator/themes/shoppy/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript"
            src="/application/app/modules/administrator/themes/shoppy/js/jquery.form.min.js"></script>
    <!-- js -->
    <!-- script-->
    <script type="application/x-javascript">
      addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- script-->

</head>

<body>

{block 'page'}
    page content
{/block}
<!-- js -->
<script type="text/javascript"
        src="/application/app/modules/administrator/themes/shoppy/js/bootstrap.js"></script>
<script type="text/javascript" src="/application/app/modules/administrator/themes/shoppy/js/main.js"></script>

<!-- js -->

</body>

</html>
