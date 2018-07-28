<div class="product-agileinfon-top">
    {foreach $images as $image}
        <div class="col-md-6 product-agileinfon-top-left">
            <img class="img-responsive" src="{$image->path}" alt="{$image->name}">
        </div>
    {/foreach}
    <div class="clearfix"></div>
</div>