<div class="row">
    {foreach $addresses as $address}
        <div class="col-xs-12 col-sm-6">
            <ul class="address first_item item box">
                <li>
                    <h3 class="page-subheading">
                        Delivery address
                        <span class="address_alias">({$address->alias})</span>
                    </h3>
                </li>
                <li><span class="address_name">{$user->firstname|capitalize} {$user->lastname|capitalize}</span></li>
                <li><span class="address_address1">{$address->address1}</span></li>
                <li><span class="address_address1">{$address->address2}</span></li>
                <li><span class="address_city">{$address->state}</span>
                </li>

                <li><span class="address_phone">{$address->phone}</span>
                </li>
                <li><span class="address_phone_mobile"></span>
                </li>
            </ul>
        </div>
    {/foreach}
</div>