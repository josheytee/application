<div class="product-card">
    <div class="left-block">
        <div class="product-image-container">
            {if $product->images->isNotEmpty()}
                <img src="{$product->images->first()->path}" alt="{$product->images->first()->name}"
                     class="img-responsive">
            {/if}
        </div>
        <div class="left-block-price">
            <strike>N</strike>{$product->price}
        </div>
    </div>
    <div class="right-block">
        <h5 class="product-name">
            <a href="{route n='product.index' p=['shop_url'=>$shop_url,'product_id'=>$product->id,'product_url'=>$product->link_rewrite]}">
                {$product->name}
            </a>
        </h5>
        <p>{$product->description}</p>
        <h5 class="right-block-price"><strike>N</strike>{$product->price}</h5>
        <div class="button-container">

            <button type="button" data-toggle="modal" data-target="#myModal" class="myModal">
                <span class="glyphicon glyphicon-shopping-cart"></span>add to cart
            </button>

            <a href="" class="btn btn-primary">More</a>
        </div>
        <div class="product-flags">
        </div>
        <span class="availability">
            <span class="label-success">In Stock</span>
        </span>
    </div>

</div>

{*<script>*}
    {*$(document).ready(function () {*}
        {*$('button.myModal').click(function (e) {*}
            {*alert('clicked');*}
            {*$('div.modal').modal('toggle');*}

            {*let product = $(this).data('product-id');*}

            {*let link = 'http://localhost/application/cart/add/' + 1 + '/' + product;*}
            {*// console.log(product);*}
            {*{route n="order.cart.add" p=['shop_id'=>1,'product_id'=>product]}*}
            {*// $.post(link,*}
            {*//     null,*}
            {*//     function (data, status) {*}
            {*//         console.log("Data: " + data + "\nStatus: " + status);*}
            {*//         alert("Data: " + data + "\nStatus: " + status);*}
            {*//     }*}
            {*// );*}
        {*});*}
    {*});*}
{*</script>*}
{*<div class="myModal fade" tabindex="-1" role="dialog">*}
    {*<div class="modal-dialog">*}
        {*<div class="modal-content">*}
            {*<div class="modal-header">*}
                {*<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>*}
                {*</button>*}
                {*<h4 class="modal-title">Modal title</h4>*}
            {*</div>*}
            {*<div class="modal-body">*}
                {*<p>One fine body&hellip;</p>*}
            {*</div>*}
            {*<div class="modal-footer">*}
                {*<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>*}
                {*<button type="button" class="btn btn-primary">Save changes</button>*}
            {*</div>*}
        {*</div><!-- /.modal-content -->*}
    {*</div><!-- /.modal-dialog -->*}
{*</div><!-- /.modal -->*}
