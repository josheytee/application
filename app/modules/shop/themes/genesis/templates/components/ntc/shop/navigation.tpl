<div class="logo-nav-left1">
    <nav class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header nav_2">
            <button type="button" class="navbar-toggle navbar-toggle1" data-toggle="collapse"
                    data-target="#bs-megadropdown-tabs">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse in" id="bs-megadropdown-tabs" style="height: auto;">
            {*{$sections}*}
            <ul class="nav navbar-nav">
                {foreach $sections as $section}
                    {*{$section->images}*}
                    <li class="">
                        <a href="{route n='section.single' p=[
                        'shop_url' => $shop_url,
                        'section_url' => $section->url
                        ]}"
                           class="act">{$section->name}</a>
                    </li>
                {/foreach}
            </ul>
        </div>
    </nav>
</div>

{*<ul class="nav navbar-nav">*}
{*<li class="active"><a href="index.html" class="act">Home</a></li>*}
{*<!-- Mega Menu -->*}
{*<li class="dropdown">*}
{*<a href="#" class="dropdown-toggle" data-toggle="dropdown">Women<b class="caret"></b></a>*}
{*<ul class="dropdown-menu multi-column columns-3">*}
{*<div class="row">*}
{*<div class="col-sm-3  multi-gd-img">*}
{*<ul class="multi-column-dropdown">*}
{*<h6>Submenu1</h6>*}
{*<li><a href="products.html">Clothing</a></li>*}
{*<li><a href="products.html">Wallets</a></li>*}
{*<li><a href="products.html">Shoes</a></li>*}
{*<li><a href="products.html">Watches</a></li>*}
{*<li><a href="products.html"> Underwear </a></li>*}
{*<li><a href="products.html">Accessories</a></li>*}
{*</ul>*}
{*</div>*}
{*<div class="col-sm-3  multi-gd-img">*}
{*<ul class="multi-column-dropdown">*}
{*<h6>Submenu2</h6>*}
{*<li><a href="products.html">Sunglasses</a></li>*}
{*<li><a href="products.html">Wallets,Bags</a></li>*}
{*<li><a href="products.html">Footwear</a></li>*}
{*<li><a href="products.html">Watches</a></li>*}
{*<li><a href="products.html">Accessories</a></li>*}
{*<li><a href="products.html">Jewellery</a></li>*}
{*</ul>*}
{*</div>*}
{*<div class="col-sm-3  multi-gd-img">*}
{*<a href="products.html">*}
{*<img src="/application/extensions/modules/ntc/shop/ntc/components/navigation/img/woo.jpg"*}
{*alt=" ">*}
{*</a>*}
{*</div>*}
{*<div class="col-sm-3  multi-gd-img">*}
{*<a href="products.html">*}
{*<img src="/application/extensions/modules/ntc/shop/ntc/components/navigation/img/woo1.jpg"*}
{*alt=" ">*}
{*</a>*}
{*</div>*}
{*<div class="clearfix"></div>*}
{*</div>*}
{*</ul>*}
{*</li>*}
{*<li class="dropdown">*}
{*<a href="#" class="dropdown-toggle" data-toggle="dropdown">Men <b class="caret"></b></a>*}
{*<ul class="dropdown-menu multi-column columns-3">*}
{*<div class="row">*}
{*<div class="col-sm-3  multi-gd-img">*}
{*<ul class="multi-column-dropdown">*}
{*<h6>Submenu1</h6>*}
{*<li><a href="products.html">Clothing</a></li>*}
{*<li><a href="products.html">Wallets</a></li>*}
{*<li><a href="products.html">Shoes</a></li>*}
{*<li><a href="products.html">Watches</a></li>*}
{*<li><a href="products.html"> Underwear </a></li>*}
{*<li><a href="products.html">Accessories</a></li>*}
{*</ul>*}
{*</div>*}
{*<div class="col-sm-3  multi-gd-img">*}
{*<ul class="multi-column-dropdown">*}
{*<h6>Submenu2</h6>*}
{*<li><a href="products.html">Sunglasses</a></li>*}
{*<li><a href="products.html">Wallets,Bags</a></li>*}
{*<li><a href="products.html">Footwear</a></li>*}
{*<li><a href="products.html">Watches</a></li>*}
{*<li><a href="products.html">Accessories</a></li>*}
{*<li><a href="products.html">Jewellery</a></li>*}
{*</ul>*}
{*</div>*}
{*<div class="col-sm-3  multi-gd-img">*}
{*<a href="products1.html">*}
{*<img src="/application/extensions/modules/ntc/shop/ntc/components/navigation/img/woo3.jpg"*}
{*alt=" ">*}
{*</a>*}
{*</div>*}
{*<div class="col-sm-3  multi-gd-img">*}
{*<a href="products1.html">*}
{*<img src="/application/extensions/modules/ntc/shop/ntc/components/navigation/img/woo4.jpg"*}
{*alt=" "></a>*}
{*</div>*}
{*<div class="clearfix"></div>*}
{*</div>*}
{*</ul>*}
{*</li>*}
{*<li><a href="codes.html">Short Codes</a></li>*}
{*<li><a href="mail.html">Mail Us</a></li>*}
{*</ul>*}