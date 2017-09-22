<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
    <ul id="myTabs" class="nav nav-pills nav-stacked" role="tablist">
        {foreach $forms as $name => $form}
            <li role="presentation" {if $name == 'information'}class="active"{/if}>
                <a href="#{$name}" role="tab" id="{$name}-tab" data-toggle="pill" aria-controls="{$name}"
                   aria-expanded="true">{$name}</a>
            </li>
        {/foreach}
    </ul>
    <div id="myTabContent" class="tab-content">
        {foreach $forms as $name => $form}
        <div role="tabpanel" class="tab-pane fade {if $name == 'information'}active in{/if}" id="{$name}"
             aria-labelledby="{$name}-tab">
                {$form.content}
            </div>
        {/foreach}
    </div>
</div>