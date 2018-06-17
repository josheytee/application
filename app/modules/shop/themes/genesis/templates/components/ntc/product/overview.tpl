<div class="single-grids">
    <div class="col-md-9 single-grid">
        <div clas="single-top">
            <div class="single-left">
                <div class="flexslider">
                    <div class="flex-viewport" style="overflow: hidden; position: relative;">
                        <ul class="slides"
                            style="width: 1000%; transition-duration: 0.6s; transform: translate3d(-942px, 0px, 0px);">
                            <li data-thumb="/application/app/modules/shop/themes/new-shop/images/si2.jpg" class="clone"
                                aria-hidden="true"
                                style="width: 314px; float: left; display: block;">
                                <div class="thumb-image">
                                    <img src="/application/app/modules/shop/themes/new-shop/images/si2.jpg"
                                         data-imagezoom="true" class="img-responsive"
                                         draggable="false"></div>
                            </li>
                            <li data-thumb="/application/app/modules/shop/themes/new-shop/images/si.jpg"
                                style="width: 314px; float: left; display: block;" class="">
                                <div class="thumb-image">
                                    <img src="/application/app/modules/shop/themes/new-shop/images/si.jpg"
                                         data-imagezoom="true" class="img-responsive"
                                         draggable="false"></div>
                            </li>
                            <li data-thumb="/application/app/modules/shop/themes/new-shop/images/si1.jpg" class=""
                                style="width: 314px; float: left; display: block;">
                                <div class="thumb-image">
                                    <img src="/application/app/modules/shop/themes/new-shop/images/si1.jpg"
                                         data-imagezoom="true" class="img-responsive"
                                         draggable="false"></div>
                            </li>
                            <li data-thumb="/application/app/modules/shop/themes/new-shop/images/si2.jpg"
                                class="flex-active-slide"
                                style="width: 314px; float: left; display: block;">
                                <div class="thumb-image"><img
                                            src="/application/app/modules/shop/themes/new-shop/images/si2.jpg"
                                            data-imagezoom="true" class="img-responsive"
                                            draggable="false"></div>
                            </li>
                            <li data-thumb="/application/app/modules/shop/themes/new-shop/images/si.jpg"
                                style="width: 314px; float: left; display: block;" class="clone"
                                aria-hidden="true">
                                <div class="thumb-image">
                                    <img src="/application/app/modules/shop/themes/new-shop/images/si.jpg"
                                         data-imagezoom="true" class="img-responsive"
                                         draggable="false">
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ol class="flex-control-nav flex-control-thumbs">
                        <li><img src="/application/app/modules/shop/themes/new-shop/images/si.jpg" class=""
                                 draggable="false">
                        </li>
                        <li><img src="/application/app/modules/shop/themes/new-shop/images/si1.jpg" draggable="false"
                                 class="">
                        </li>
                        <li><img src="/application/app/modules/shop/themes/new-shop/images/si2.jpg" draggable="false"
                                 class="flex-active"></li>
                    </ol>
                    <ul class="flex-direction-nav">
                        <li class="flex-nav-prev"><a class="flex-prev" href="#">Previous</a></li>
                        <li class="flex-nav-next"><a class="flex-next" href="#">Next</a></li>
                    </ul>
                </div>
            </div>
            <div class="single-right simpleCart_shelfItem">
                <h4>{$name}</h4>
                <div class="block">
                    <div class="starbox small ghosting">
                        <div class="positioner">
                            <div class="stars">
                                <div class="ghost" style="display: none; width: 42.5px;"></div>
                                <div class="colorbar" style="width: 42.5px;"></div>
                                <div class="star_holder">
                                    <div class="star star-0"></div>
                                    <div class="star star-1"></div>
                                    <div class="star star-2"></div>
                                    <div class="star star-3"></div>
                                    <div class="star star-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="price item_price">$ {$price}</p>
                <div class="description">
                    <p>
                        <span>Quick Overview : </span>
                        {$description|truncate}
                    </p>
                </div>
                <div class="color-quality">
                    <h6>Quality :</h6>
                    <div class="quantity">
                        <div class="quantity-select">
                            <div class="entry value-minus1">&nbsp;</div>
                            <div class="entry value1"><span>1</span></div>
                            <div class="entry value-plus1 active">&nbsp;</div>
                        </div>
                    </div>
                    <!--quantity-->
                    <script>
                        $('.value-plus1').on('click', function () {
                            var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10) + 1;
                            divUpd.text(newVal);
                        });

                        $('.value-minus1').on('click', function () {
                            var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10) - 1;
                            if (newVal >= 1) divUpd.text(newVal);
                        });
                    </script>
                    <!--quantity-->
                </div>
                <div class="women">
                    <span class="size">XL / XXL / S </span>
                    <a href="#" data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</a>
                </div>
                <div class="social-icon">
                    <a href="#"><i class="icon"></i></a>
                    <a href="#"><i class="icon1"></i></a>
                    <a href="#"><i class="icon2"></i></a>
                    <a href="#"><i class="icon3"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-3 single-grid1">
        <h3>Recent Products</h3>
        <div class="recent-grids">
            <div class="recent-left">
                <a href="single.html">
                    <img class="img-responsive " src="/application/app/modules/shop/themes/new-shop/images/r.jpg"
                         alt="">
                </a>
            </div>
            <div class="recent-right">
                <h6 class="best2"><a href="single.html">Lorem ipsum dolor </a></h6>
                <div class="block">
                    <div class="starbox small ghosting">
                        <div class="positioner">
                            <div class="stars">
                                <div class="ghost" style="display: none; width: 42.5px;"></div>
                                <div class="colorbar" style="width: 42.5px;"></div>
                                <div class="star_holder">
                                    <div class="star star-0"></div>
                                    <div class="star star-1"></div>
                                    <div class="star star-2"></div>
                                    <div class="star star-3"></div>
                                    <div class="star star-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class=" price-in1"> $ 29.00</span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="recent-grids">
            <div class="recent-left">
                <a href="single.html">
                    <img class="img-responsive " src="/application/app/modules/shop/themes/new-shop/images/r1.jpg"
                         alt="">
                </a>
            </div>
            <div class="recent-right">
                <h6 class="best2"><a href="single.html">Duis aute irure </a></h6>
                <div class="block">
                    <div class="starbox small ghosting">
                        <div class="positioner">
                            <div class="stars">
                                <div class="ghost" style="display: none; width: 42.5px;"></div>
                                <div class="colorbar" style="width: 42.5px;"></div>
                                <div class="star_holder">
                                    <div class="star star-0"></div>
                                    <div class="star star-1"></div>
                                    <div class="star star-2"></div>
                                    <div class="star star-3"></div>
                                    <div class="star star-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class=" price-in1"> $ 19.00</span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="recent-grids">
            <div class="recent-left">
                <a href="single.html"><img class="img-responsive "
                                           src="/application/app/modules/shop/themes/new-shop/images/r2.jpg" alt=""></a>
            </div>
            <div class="recent-right">
                <h6 class="best2"><a href="single.html">Lorem ipsum dolor </a></h6>
                <div class="block">
                    <div class="starbox small ghosting">
                        <div class="positioner">
                            <div class="stars">
                                <div class="ghost" style="display: none; width: 42.5px;"></div>
                                <div class="colorbar" style="width: 42.5px;"></div>
                                <div class="star_holder">
                                    <div class="star star-0"></div>
                                    <div class="star star-1"></div>
                                    <div class="star star-2"></div>
                                    <div class="star star-3"></div>
                                    <div class="star star-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class=" price-in1"> $ 19.00</span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="recent-grids">
            <div class="recent-left">
                <a href="single.html"><img class="img-responsive "
                                           src="/application/app/modules/shop/themes/new-shop/images/r3.jpg" alt=""></a>
            </div>
            <div class="recent-right">
                <h6 class="best2"><a href="single.html">Ut enim ad minim </a></h6>
                <div class="block">
                    <div class="starbox small ghosting">
                        <div class="positioner">
                            <div class="stars">
                                <div class="ghost" style="display: none; width: 42.5px;"></div>
                                <div class="colorbar" style="width: 42.5px;"></div>
                                <div class="star_holder">
                                    <div class="star star-0"></div>
                                    <div class="star star-1"></div>
                                    <div class="star star-2"></div>
                                    <div class="star star-3"></div>
                                    <div class="star star-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class=" price-in1">$ 45.00</span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
