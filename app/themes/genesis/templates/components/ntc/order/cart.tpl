<table class="table table-striped" id="cartTable">
    <thead>
    <tr>
        <th>Product</th>
        <th>Description</th>
        <th>Availability</th>
        <th>Unit price</th>
        <th>Quantity</th>
        <th></th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    {foreach $products as $product}
        <tr id="{$product->id}">
            <td><img src="{$product->images->first()->path}" alt="" width="100" height="100"/></td>
            <td>
                <h3>{$product->name|capitalize}</h3>
                reference <br>
                {$product->description|truncate}
            </td>
            <td id="a-{$product->id}">available</td>
            <td>N <span id="p-{$product->id}">{$product->price}</span></td>
            <td><input type="number" min="1" class="qty" id="q-{$product->id}" value="{$product->pivot->quantity}"/>
            </td>
            <td><a href=""><span class="glyphicon glyphicon-trash"> </span></a></td>
            <td>N <span class="p_total" id="t-{$product->id}">{$product->pivot->quantity * $product->price}</span></td>
        </tr>
    {/foreach}
    </tbody>
    <tfoot>
    <tr>
        <td rowspan="4" colspan="4">
            <form action="" class="for">
                <label for="vouchers">
                    Vouchers
                    <input type="text" name="vouchers" id="vouchers">
                </label>
                <input type="submit" name="ok" value="ok">
            </form>
        </td>
    </tr>
    <tr>
        <td colspan="2">Total Products</td>
        <td>N <span id="t-p">0</span></td>
    </tr>
    <tr>
        <td colspan="2">Total shipping</td>
        <td>N <span id="t-s">0</span></td>
    </tr>
    <tr>
        <td colspan="2">Total</td>
        <td>N <span id="t-t">0</span></td>
    </tr>
    </tfoot>
</table>
<script type="application/javascript">
    $(document).ready(function () {
        let product_total = 0;
        $(".p_total").each(function (index, element) {
            product_total += Number.parseInt($(element).text());
        });
        $("#t-p").text(product_total);
        $("#t-t").text(Number.parseInt($("#t-s").text()) + product_total);
        $(".qty").change(function (e) {
            let id = this.id;
            let split = id.split('-');
            let product_id = split[1];
            let val = $(this).val();
            if (Number.parseInt(val)) {
                let qty = $("#q-" + product_id).val();
                let price = $("#p-" + product_id).text();
                $.post("http://localhost/application/cart/{$cart_id}/edit_product/" + product_id + "/quantity/" + qty);
                $("#t-" + product_id).text(price * qty);
                let product_total = 0;
                $(".p_total").each(function (index, element) {
                    product_total += Number.parseInt($(element).text());
                });
                $("#t-p").text(product_total);
                $("#t-t").text(Number.parseInt($("#t-s").text()) + product_total);
            }

        });
    });

</script>
