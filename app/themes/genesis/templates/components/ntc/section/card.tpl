{foreach $sections as $section}
    <div class="row section-card">
        <h2>{$section->name|capitalize}</h2>
        <div class="col-md-4 left-block">
            {if $section->images->isNotEmpty()}
                <div class="image">
                    <img src="{$section->images->first()->path}" alt="{$section->images->first()->name}">
                </div>
            {/if}

            {if $section->getSiblings()->isNotEmpty()}
                <div class="section-siblings">
                    <ul>
                        {foreach $section->getSiblings() as $sibling}
                            <li><a href="{route n='section.single' p=['shop_url'=>$shop_url,'section_url'=>$sibling->url]}">{$sibling->name}</a></li>
                        {/foreach}
                    </ul>
                </div>
            {/if}
        </div>

        <div class="col-md-8">
            <ul class="row section-product-list">
                {foreach $section->products as $product}
                    <li class="col-md-3">
                        {component n='ntc\product\card' p=['shop_url'=>$shop_url,'product'=>$product]}
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{/foreach}
