<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Panel title</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <th></th>
                    {foreach $schema.fields as $field}
                    <th>
                        {if isset($field.name)}
                            {$field.name}
                        {/if}
                    </th>
                {/foreach}
                <th></th>
                </thead>
                <tbody>
                    {for $i=0 to $end-1}
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            {foreach $schema.fields as $key => $field}
                                {if $key!='actions'}
                                    <td>{$data.{$i}.{$key}}</td>
                                {else}
                                    <td>
                                        <div class="btn-group">
                                            {*                                            {section name=action loop=$field}*}


                                            {assign var='action' value=$field.0}
                                            {include file="./template/list_action_$action.tpl" id=$data.$i.id name=$options.name|lower action=$action}
                                            {if $field|count>1}
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    {foreach $field as $key => $val}
                                                        <li>
                                                            {if $key != 0}
                                                                {assign var='action' value=$val}
                                                                {include file="./template/list_action_$action.tpl" id=$data.$i.id name=$options.name|lower action=$action}
                                                            {/if}
                                                        </li>
                                                    {/foreach}
                                                    {*<li role="separator" class="divider"></li>
                                                    <li><a href="#"> Delete </a></li>*}
                                                </ul>
                                            {/if}


                                            {*<a href="{$data.{$i}.{$field@key}}" class="btn btn-default">Edit</a>*}
                                        </div>

                                    </td>

                                {/if}
                            {/foreach}

                        </tr>
                    {/for}
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-footer">Panel footer</div>
</div>