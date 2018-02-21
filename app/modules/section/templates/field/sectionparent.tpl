<div class="form-group">
    <label for="{$name}" class="control-label col-md-3 required">{$label|capitalize}</label>
    <div class="col-md-9">
        <select class="form-control" name="{$name}" id="{$name}">
            {foreach $sections as  $section}
                {if $value == $section->id}
                    <option value="{$section->id}" selected>{$section->name}</option>
                {else}
                    <option value="{$section->id}">{$section->name}</option>
                {/if}
            {/foreach}
        </select>
    </div>
</div>