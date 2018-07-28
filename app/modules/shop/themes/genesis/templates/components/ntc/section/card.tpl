{foreach $sections as $section}
    <div class="row section-card">
        <h2>{$section->name|capitalize}</h2>
        <div class="col-md-4 image">
            {foreach $section->images as $image}
                <img src="{$image->path}" alt="{$image->name}">
            {/foreach}
        </div>
        <div class="col-md-8">
            <ul class="row section-product-list">
                {foreach $section->products as $product}
                    <li class="col-md-3">
                        {component n='ntc\product\card' p=['product'=>$product]}
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{/foreach}
