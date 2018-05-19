<div class="form-group">
    <label class="control-label col-lg-3 required">
        		<span class="label-tooltip"
                      data-toggle="tooltip" data-html="true" title=""
                      data-original-title="Invalid characters <>;=#{}">{$label|namify}</span>
    </label>

    <div class="components col-lg-9">
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
</div>
