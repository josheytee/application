<div class="form-group">
    <label class="control-label col-md-3">{$label|capitalize}</label>
    <div class="col-md-9">
        <select class="form-control" name="{$name}">
            {foreach  $options as $key => $option}
                {if $type == 'group'}
                    <optgroup label="{$key}">
                        {foreach $option as $opt_key => $optn}
                            <option value="{$opt_key}" {if $opt_key == $value}selected="selected"{/if}>{$optn}</option>
                        {/foreach}
                    </optgroup>
                {else}
                    <option value="{$key}" {if $key == $value}selected="selected"{/if}>{$option}</option>
                {/if}
            {/foreach}
        </select>
    </div>
</div>
