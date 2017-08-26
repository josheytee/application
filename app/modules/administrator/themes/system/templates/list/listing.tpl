<table class="table table-hover">
    <thead>
    <tr>
        <th>--</th>
        {foreach $headings as $head}
            <th>{$head}</th>
        {/foreach}
        {*<th></th>*}
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
                                    {for $i=1;$i<=$data|count-1;$i++}
                                        <li>{$data[$i]}</li>
                                    {/for}
                                    {*                                        <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>*}
                                </ul>
                            {/if}
                        </div>
                    {else}
                        {$data}
                    {/if}

                </td>
            {/foreach}
        </tr>
    {/foreach}
    </tbody>
    <tfoot>
    <tr></tr>
    </tfoot>
</table>