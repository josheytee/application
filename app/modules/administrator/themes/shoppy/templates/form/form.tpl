{if isset($errors)}
    {foreach $errors as $name => $messages}
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {$name} :
            {foreach $messages as $message}
                {$message}
            {/foreach}
        </div>
    {/foreach}
{/if}

<form method="post" action="" enctype="multipart/form-data" class="form-horizontal">
    {if isset($form_body)}{$form_body}{/if}
</form>