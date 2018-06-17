field
<div class="components">
    <ul class="component-list">
        {foreach $components as $component}
            <li>
                <label>
                    <input type="checkbox" name="components[]" value="{$component->getName()}"/>
                    <div class="component">
                        <img src="{$component->getIcon()}" alt="">
                        <span class="component-name">{$component->getName()}</span>
                        <p class="component-description">
                            {$component->getDescription()}
                        </p>
                    </div>
                </label>
            </li>
        {/foreach}
    </ul>
</div>