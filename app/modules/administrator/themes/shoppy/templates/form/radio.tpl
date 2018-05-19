<div class="form-group">
    <label class="control-label col-md-3"> {$name|capitalize} </label>
    <div class="col-md-9">
        {foreach $radios as $key => $text}
            <div class="radio">
                <label>
                    <input type="radio" name="{$name}" id="optionsRadios1"
                           value="{$key}"{if $key==$value} checked{/if}>
                    {$text}
                </label>
            </div>
        {/foreach}
    </div>
</div>
