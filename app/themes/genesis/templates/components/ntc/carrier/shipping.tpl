<table class="table table-bordered">
    <thead>
    <tr>
        <td colspan="4">
            select your carrier service
        </td>
    </tr>
    </thead>
    <tbody>
    {foreach $carriers as $carrier}
        <tr>
            <td><input type="radio" name="shipping"></td>
            <td><img src="{$carrier->logo}" alt="" width="100" height="100"></td>
            <td>
                <strong><a href="{route n='carrier.single' p=['url'=>{$carrier->url}]}">{$carrier->name|capitalize}</a></strong>
                <br>
                Delivery Time:
                {$carrier->delay}
            </td>
            <td>
                {if $carrier->price == 0}
                    <span class="label label-info">Free</span>
                {else}
                    {$carrier->price}
                {/if}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>