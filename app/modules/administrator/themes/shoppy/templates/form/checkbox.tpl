<div class="form-group">
    <label class="control-label col-md-3" for="{$name}"> {$label|namify} </label>
    <div class="col-md-9">
        {foreach $checks as $key => $check}
            {if is_array($check)}
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="{$key}" id="{$key}" value="{$check.value|default:1}" {($value)}>
                        {$check.label}
                    </label>
                </div>
                {continue}
            {/if}
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="{$check}" id="{$name}" value="{$value|default:1}">
                    {$check|namify}
                </label>
            </div>
        {/foreach}
    </div>
</div>
