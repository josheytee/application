<table class="table table-striped">
    <thead>
    <tr>
        <th>Product</th>
        <th>Description</th>
        <th>Availability</th>
        <th>Unit price</th>
        <th>Quantity</th>
        <th></th>
        <th>total</th>
    </tr>
    </thead>
    <tbody>
    {foreach $products as $product}
        <tr>
            <td><img src="{$product->images->first()->path}" alt="" width="100" height="100"></td>
            <td>
                <h3>{$product->name|capitalize}</h3>
                reference <br>
                {$product->description|truncate}
            </td>
            <td>available</td>
            <td>N {$product->price}</td>
            <td><input type="number"></td>
            <td><span class="fa fa-trash"></td>
            <td>total</td>
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
        <td>e</td>
    </tr>
    <tr>
        <td colspan="2">Total shipping</td>
        <td>d</td>
    </tr>
    <tr>
        <td colspan="2">Total</td>
        <td>e</td>
    </tr>
    </tfoot>
</table>