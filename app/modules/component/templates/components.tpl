list of configurable components
{*<div class="list-group">*}
{*{dump v=$components}*}
{*{foreach $components as $id => $component}*}
{*{if $component->isConfigurable()}*}
{*<a href="component/{$id|encode}/configure" class="list-group-item">*}
{*<div class="row">*}
{*<div class="col-md-1">*}
{*<img src="{$component->getIcon()}" alt="" class="img-rounded">*}
{*</div>*}
{*<div class="col-md-11">*}
{*<h4 class="list-group-item-heading">{$component->getName()}*}
{*<small>{$component->getVersion()} - by {$component->getAuthor()}</small>*}
{*</h4>*}
{*<p class="list-group-item-text">{$component->getDescription()}</p>*}
{*</div>*}
{*</div>*}
{*</a>*}
{*{/if}*}
{*{/foreach}*}
{*</div>*}
<div class="row">
    {foreach $components as $id => $component}
        <div class="col-md-3">
            <div class="popular-brand">
                <div class="col-md-6 popular-bran-left">
                    <h3>{$component->getName()}
                        <small>{$component->getVersion()} </small>
                    </h3>
                    <h4> by {$component->getAuthor()|upper}</h4>
                    {assign var="description" value="{$component->getDescription()}"}
                    <p>{$description|truncate:40}</p>
                </div>
                <div class="col-md-6 popular-bran-right">
                    <h3> {$component->getIcon()}</h3>
                    {*<img src="{$component->getIcon()}" alt="" class="img-rounded">*}

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    {/foreach}
</div>
