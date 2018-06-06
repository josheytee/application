<h2 class="tittle">{$section->name}</h2>
<div class="mens-toolbar">
    <p>Showing 1–9 of 21 results</p>
    <p class="showing">Sorting By
        <select>
            <option value=""> Name</option>
            <option value=""> Rate</option>
            <option value=""> Color</option>
            <option value=""> Price</option>
        </select>
    </p>
    <p>Show
        <select>
            <option value=""> 9</option>
            <option value=""> 10</option>
            <option value=""> 11</option>
            <option value=""> 12</option>
        </select>
    </p>
    <div class="clearfix"></div>
</div>

<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav1 nav1-tabs left-tab" role="tablist">
        <ul id="myTab" class="nav nav-tabs left-tab" role="tablist">
            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab"
                                                      aria-controls="home" aria-expanded="true">
                    <img src="/application/app/modules/shop/themes/new-shop/images/menu1.png"></a></li>
            <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab"
                                       aria-controls="profile"><img
                            src="/application/app/modules/shop/themes/new-shop/images/menu.png"></a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                {foreach $sectionProducts->chunk(3) as $chunk}
                    <div class="product-tab prod1">
                        {foreach $chunk as $sectionProduct}
                            {*{dump($sectionProduct->images)}*}
                            <div class="col-md-4 product-tab-grid simpleCart_shelfItem">
                                <div class="grid-arr">
                                    <div class="grid-arrival">
                                        <figure>
                                            <a href="#" class="new-gri" data-toggle="modal" data-target="#myModal1">
                                                {foreach $sectionProduct->images as $image}
                                                    <div class="grid-img">
                                                        <img src="{$image->path}" class="img-responsive"
                                                             alt="{$image->name}">
                                                    </div>
                                                {/foreach}

                                                {*<div class="grid-img">*}
                                                {*<img src="/application/app/modules/shop/themes/new-shop/images/p5.jpg"*}
                                                {*class="img-responsive" alt="">*}
                                                {*</div>*}
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="block">
                                        <div class="starbox small ghosting"></div>
                                    </div>
                                    <div class="women">
                                        <h6><a href="{route n='product.index' p=[
                                            'id'=>$sectionProduct->id,
                                            'url'=>$sectionProduct->link_rewrite
                                            ]}">{$sectionProduct->name}</a></h6>
                                        <span class="size">XL / XXL / S </span>
                                        <p>
                                            <del>$100.00</del>
                                            <em class="item_price">${$sectionProduct->price}</em></p>
                                        <a href="#" data-product-id={$sectionProduct->id} class="my-cart-b item_add
                                           addToCart">Add
                                        To Cart</a>
                                    </div>
                                </div>
                            </div>
                        {/foreach}
                        <div class="clearfix"></div>
                    </div>
                {/foreach}

            </div>


            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                {foreach $sectionProducts as $sectionProduct}
                    <div class="product-tab1 prod3">
                        <div class="col-md-4 product-tab1-grid">
                            <div class="grid-arr">
                                <div class="grid-arrival">
                                    <figure>
                                        <a href="#" class="new-gri" data-toggle="modal" data-target="#myModal1">
                                            {foreach $sectionProduct->images as $image}
                                                <div class="grid-img">
                                                    <img src="{$image->path}"
                                                         class="img-responsive" alt="{$image->name}">
                                                </div>
                                            {/foreach}
                                        </a>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 product-tab1-grid1 simpleCart_shelfItem">
                            <div class="block">
                                <div class="starbox small ghosting"></div>
                            </div>
                            <div class="women">
                                <h6><a href="single.html">{$sectionProduct->name}</a></h6>
                                <span class="size">XL / XXL / S </span>
                                <p>{$sectionProduct->description|truncate}</p>
                                <p>
                                    <del>$100.00</del>
                                    <em class="item_price">${$sectionProduct->price}</em></p>
                                <a href="#" data-product-id={$sectionProduct->id} class="my-cart-b item_add addToCart">Add
                                To Cart</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                {/foreach}
            </div>
        </div>
    </ul>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="mySmallModalLabel">Product successfully added to your shopping cart</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="path}" alt="$name}">
                    </div>
                    <div class="col-md-6">
                        there are count} items in your cart
                        <br>
                        total products $
                        total shipping
                        total
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary"> close </button>
                        <a href="{route n='order.index' p=['key'=>03k39]}" class="btn btn-primary">check out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('a.addToCart').click(function (e) {
            $('div.bs-example-modal-sm').modal('toggle');

            let product = $(this).data('product-id');

            let link = 'http://localhost/application/cart/add/' + 1 + '/' + product;
            // console.log(product);
            {*{route n="order.cart.add" p=['shop_id'=>1,'product_id'=>product]}*}
            // $.post(link,
            //     null,
            //     function (data, status) {
            //         console.log("Data: " + data + "\nStatus: " + status);
            //         alert("Data: " + data + "\nStatus: " + status);
            //     }
            // );
        });
    });
</script>
