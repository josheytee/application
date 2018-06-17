list of configurable components
<div class="list-group">
    {foreach $components as $id => $component}
        {if $component->isConfigurable()}
            <a href="component/{$id|encode}/configure" class="list-group-item">
                <div class="row">
                    <div class="col-md-1">
                        <img src="{$component->getIcon()}" alt="" class="img-rounded">
                    </div>
                    <div class="col-md-11">
                        <h4 class="list-group-item-heading">{$component->getName()}
                            <small>{$component->getVersion()} - by {$component->getAuthor()}</small>
                        </h4>
                        <p class="list-group-item-text">{$component->getDescription()}</p>
                    </div>
                </div>
            </a>
        {/if}
    {/foreach}
</div>