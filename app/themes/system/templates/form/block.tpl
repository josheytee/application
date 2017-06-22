<div {if isset($attributes)}{$attributes}{/if}>
  {if isset($elements)}
    {foreach $elements as $element}
      {$element}
    {/foreach}
  {/if}

</div>