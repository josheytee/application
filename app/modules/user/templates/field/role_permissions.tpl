<div class="form-group">
    <label class="control-label col-lg-3 required">
        		<span class="label-tooltip"
                      data-toggle="tooltip" data-html="true" title=""
                      data-original-title="Invalid characters <>;=#{}">{$label|namify}</span>
    </label>
    <div class="col-lg-9">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th colspan="2">
                        #
                    </th>
                </tr>
                </thead>
                <tbody>
                {foreach $repo as $id => $handler}
                    <tr>
                        <th colspan="2">
                            <div style="padding-left: 4px">
                                {$id}
                            </div>
                        </th>
                    </tr>
                    {foreach $handler->getPermissions() as $name => $permission}
                        <tr>
                            <td>
                                <div style="padding-left: 8px">
                                    <span class="title">{$permission.title}</span>
                                    {if isset($permission.description)}
                                        <div class="description">
                                            <em class="permission-warning">
                                                {$permission.description}
                                            </em>
                                        </div>
                                    {/if}
                                </div>
                            </td>
                            <td>
                                <input type="checkbox" name="permissions[]" value="{$name}">
                            </td>
                        </tr>
                    {/foreach}
                {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>