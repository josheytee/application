
<select {if isset($attributes)}{$attributes}{/if}>
  {foreach  $options as $num => $option}
    {if $option->type == 'group'}
      <optgroup label="{$option->slug}">
        {foreach $option->options as $num => $optn}
          <option value="{$optn->slug}" {if ($optn->selected)}selected = "selected"{/if}>{$optn->value}</option>
        {/foreach}
      </optgroup>
    {else}
      <option value="{$option->slug}" {if ($option->selected)}selected = "selected"{/if}>{$option->value}</option>
    {/if}
  {/foreach}
</select>

{*<select{{ attributes }}>
{% for option in options %}
{% if option.type == 'optgroup' %}
<optgroup label="{{ option.label }}">
{% for sub_option in option.options %}
<option value="{{ sub_option.value }}"{{ sub_option.selected ? ' selected="selected"' }}>{{ sub_option.label }}</option>
{% endfor %}
</optgroup>
{% elseif option.type == 'option' %}
<option value="{{ option.value }}"{{ option.selected ? ' selected="selected"' }}>{{ option.label }}</option>
{% endif %}
{% endfor %}
</select>*}