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
<div class="rows">
	<div class="col-md-3">
		<ul id="myTabs" class="nav nav-pills nav-stacked" role="tablist">
			{foreach $forms as $name => $form}
				<li role="presentation" {if $name == 'information'}class="active"{/if}>
					<a href="#{$name}" role="tab" id="{$name}-tab" data-toggle="pill" aria-controls="{$name}"
						 aria-expanded="true">{$name}</a>
				</li>
			{/foreach}
		</ul>
	</div>
	<div class="col-md-9">
		<form {if isset($attributes)}{$attributes}{/if} enctype="">
			<div id="myTabContent" class="tab-content">
				{foreach $forms as $name => $form}
					<div role="tabpanel" class="tab-pane fade {if $name == 'information'}active in{/if}" id="{$name}"
							 aria-labelledby="{$name}-tab">
						{$form}
					</div>
				{/foreach}
			</div>
		</form>
	</div>
</div>