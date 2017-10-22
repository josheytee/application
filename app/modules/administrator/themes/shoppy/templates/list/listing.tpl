<div class="work-progres">
    <div class="chit-chat-heading">
        <div class="row">
            <div class="col-md-10">
                {$title}
            </div>
            <div class="col-md-2">
                {if isset($headOperations)}
                    <div class="btn-group" role="group" aria-label="tool-bar">
                        {foreach $headOperations as $action => $params}
                            <a class="btn btn-default" href="{$params.url}" role="button">
                                <span class="{$params.icon}"></span>
                                {$params.name}
                            </a>
                        {/foreach}
                    </div>
                {/if}
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th><input type="checkbox" name="product[]" value="id"/></th>
            {foreach $headings as $head}
                <th>{$head}</th>
            {/foreach}
            <th>actions</th>
        </tr>
        </thead>
        <tbody>
        {foreach $form_body as $rows}
            <tr>
                <td><input type="checkbox" name="product[]" value="id"/></td>
                {foreach $rows as $key=> $data}
                    <td>
                        {if ($key == 'operations')}
                            <!-- Split button -->
                            <div class="btn-group">
                                {$data[0]}
                                {if $data|count >1}
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {for $i=1; $i <= $data|count-1; $i++}
                                            {if $data[$i].name != 'delete'}
                                                <li>{$data[$i].action}</li>
                                            {else}
                                                <li role="separator" class="divider"></li>
                                                <li>{$data[$i].action}</li>
                                            {/if}
                                        {/for}
                                    </ul>
                                {/if}
                            </div>
                        {else}
                            {$data}
                        {/if} {*end if operation*}
                    </td>
                {/foreach}
            </tr>
        {/foreach}
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <div class="dropup">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Bulk Operations
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-check"></span>
                    check all
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-unchecked"></span>
                    uncheck all
                </a>
            </li>
            <li role="separator" class="divider"></li>
            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-trash"></span>
                    delete all
                </a>
            </li>
        </ul>
    </div>
</div>