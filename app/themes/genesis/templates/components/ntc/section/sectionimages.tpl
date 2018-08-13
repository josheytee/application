{*<div class="product-agileinfon-top">*}
{*{foreach $images as $image}*}
{*<div class="col-md-6 product-agileinfon-top-left">*}
{*<img class="img-responsive" src="{$image->path}" alt="{$image->name}">*}
{*</div>*}
{*{/foreach}*}
{*<div class="clearfix"></div>*}
{*</div>*}
{if $images->isNotEmpty()}
<div class="section-image"
     style="background: url('{$images->get(0)->path}') right center / cover no-repeat; min-height: 217px;">
    <div class="section-image-content">
        <div class="section-image-name">
            lorem ipsum
        </div>
        <div class="section-image-description">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid corporis dignissimos obcaecati quasi quia
            quidem repellat sapiente similique sunt voluptatem! Aspernatur at cumque deleniti fugiat illo iusto magni
            omnis placeat!
        </div>
    </div>
</div>
{/if}