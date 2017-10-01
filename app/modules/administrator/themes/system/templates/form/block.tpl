<div {if isset($attributes)}{$attributes}{/if}>
    {if isset($elements)}
        {foreach $elements as $element}
            {if is_array($element)}
                {foreach $element as $button}
                    {$button}
                {/foreach}
                {continue}
            {/if}
            {$element}
        {/foreach}
    {/if}

</div>