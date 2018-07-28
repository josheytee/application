<div class="product-card">
    <div class="left-block">
        <div class="product-image-container">
            <img src="{$product->images->first()->path}" alt="{$product->images->first()->name}" class="img-responsive">
        </div>
    </div>
    <div class="right-block">
        <h4>{$product->name}</h4>
        {*<p>{$product->description}</p>*}
        <h5><strike>N</strike>{$product->price}</h5>
        {*<a class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> add to cart</a>*}
    </div>

</div>