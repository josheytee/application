<div>
    <form class="form-horizontal {if isset($options.form.class)}{$options.form.class}{/if}" method="{if isset($options.form.method)}{$options.form.method}{/if}" action="{if isset($options.form.action)}{$options.form.action}{/if}">

        {foreach $schema.fields as $field}
            <div class="form-group">
                {block 'label'}
                    {if isset($field.type)&&($field.type!='hidden')}
                        <label for="{if isset($field.label)}{$field.label}{/if}" class="col-sm-2 control-label">{if isset($field.label)}{$field.label}{/if}</label>
                    {/if}
                {/block}
                <div class="col-sm-10">
                    {if isset($field.type)&&($field.type=='hidden')}
                        <input type="{$field.type}" name="{$field@key}" class="form-control {$field.class}" id="{if isset($field.id)}{$field.id}{/if}">
                    {elseif isset($field.type)&&($field.type=='text')}
                        <input type="{$field.type}"  name="{$field@key}" class="form-control {$field.class}" id="{if isset($field.id)}{$field.id}{/if}" placeholder="{$field.label}">
                    {elseif isset($field.type)&&($field.type=='number')}
                        <input type="{$field.type}" name="{$field@key}"  class="form-control {$field.class}" id="{if isset($field.id)}{$field.id}{/if}" placeholder="{$field.label}">
                    {elseif isset($field.type)&&($field.type=='password')}
                        <input type="{$field.type}" name="{$field@key}"  class="form-control {$field.class}" id="{if isset($field.id)}{$field.id}{/if}" placeholder="{$field.name}">
                    {/if}
                </div>
            </div>
        {/foreach}

        {if isset($options.form.submit.0)}
            {foreach $options.form.submit as $opt}
                <input type="submit"
                       class="{if isset($opt.class)}{$opt.class}{/if}"
                       name="{if isset($opt.name)}{$opt.name}{/if}"
                       value="{if isset($opt.value)}{$opt.value}{/if}">
            {/foreach}
        {else}
            <input type="submit"
                   class="{if isset($options.form.submit.class)}{$options.form.submit.class}{/if}"
                   name="{if isset($options.form.submit.name)}{$options.form.submit.name}{/if}"
                   value="{if isset($options.form.submit.value)}{$options.form.submit.value}{/if}"
                   />
        {/if}
    </form>
</div>