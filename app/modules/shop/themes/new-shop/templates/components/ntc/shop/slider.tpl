<div class="banner-w3">
    <div class="demo-1">
        <div id="example1" class="core-slider core-slider__carousel example_1 is-loaded">
            <div class="core-slider_viewport">
                <div class="core-slider_list" style="width: 3900px; transform: translateX(0px);">
                    {*{foreach $paths as $path}{/foreach}*}
                    <div class="core-slider_item" style="width: 975px;">
                        <img src="/application/app/modules/shop/public/1/slider/img/b1.jpg"
                             class="img-responsive" alt="">
                    </div>
                    <div class="core-slider_item" style="width: 975px;">
                        <img src="/application/app/modules/shop/public/1/slider/img/b2.jpg"
                             class="img-responsive" alt="">
                    </div>
                    <div class="core-slider_item" style="width: 975px;">
                        <img src="/application/app/modules/shop/public/1/slider/img/b3.jpg"
                             class="img-responsive" alt="">
                    </div>
                    <div class="core-slider_item" style="width: 975px;">
                        <img src="/application/app/modules/shop/public/1/slider/img/b4.jpg"
                             class="img-responsive" alt="">
                    </div>
                </div>
            </div>
            <div class="core-slider_nav">
                <div class="core-slider_arrow core-slider_arrow__right"></div>
                <div class="core-slider_arrow core-slider_arrow__left"></div>
            </div>
            <div class="core-slider_control-nav">
                <div class="core-slider_control-nav-item is-active"></div>
                <div class="core-slider_control-nav-item"></div>
                <div class="core-slider_control-nav-item"></div>
                <div class="core-slider_control-nav-item"></div>
            </div>
        </div>
    </div>
    <link href="/application/app/modules/shop/themes/new-shop/css/coreSlider.css" rel="stylesheet" type="text/css">
    <script src="/application/app/modules/shop/themes/new-shop/js/coreSlider.js"></script>
    <script>
        $('#example1').coreSlider({
            pauseOnHover: false,
            interval: 3000,
            controlNavEnabled: true
        });

    </script>

</div>