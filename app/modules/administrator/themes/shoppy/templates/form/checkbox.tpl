<div class="form-group">
    <label class="control-label col-md-3" for="{$name}"> {$label|namify} </label>
    <div class="col-md-9">
        {foreach $checks as $key => $text}
            {if is_array($text)}
                {$toggle = (explode('|',$text.toggle|default:'1|0'))}
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="{$key}" id="{$key}"
                               value="{$text.value}">
                        {$text.text}
                    </label>
                </div>
                {continue}
            {/if}
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="{$text}" id="{$name}">
                    {$text|namify}
                </label>
            </div>
        {/foreach}
    </div>
</div>