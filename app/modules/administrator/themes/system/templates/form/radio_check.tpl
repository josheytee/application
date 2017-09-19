{if is_array($value)}
    {foreach $value as $vlu}
        <label>
            <input {$attributes}>
            {if isset($vlu)}{$vlu}{/if}
        </label>
    {/foreach}
{else}
    <label>
        <input {$attributes}>
        {if isset($value)}{$value}{/if}
    </label>
{/if}
