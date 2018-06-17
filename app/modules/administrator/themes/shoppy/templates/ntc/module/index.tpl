<div class="row">
    <div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item">
                <form action="">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">
                            <span class="glyphicon glyphicon-search"></span></span>
                        <input type="search" class="form-control" placeholder="search"
                               aria-describedby="basic-addon1">
                    </div>
                </form>
            </li>
            <li class="list-group-item">
                <span class="badge">14</span>
                Cras justo odio
            </li>
        </ul>
    </div>
    <div class="col-md-8">
        <table class="table">
            <thead>
            <th colspan="4">

                <!--start filter module-->
                <form method="post" class="form-inline">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Filter by</label>
                                <select name="module_install" id="module_install_filter" class="form-control ">
                                    <option value="installedUninstalled">Installed &amp; Not Installed</option>
                                    <option value="installed">Installed Modules</option>
                                    <option value="uninstalled">Modules Not Installed</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <select name="module_status" id="module_status_filter" class="form-control ">
                                    <option value="enabledDisabled">Enabled &amp; Disabled</option>
                                    <option value="enabled">Enabled Modules</option>
                                    <option value="disabled">Disabled Modules</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Authors</label>
                                <select class="filter " name="module_type" id="module_type_filter">
                                    <!-- <option value="allModules" >All Modules</option>
                                    <option value="nativeModules" >Free Modules</option>
                                    <option value="partnerModules" >Partner Modules (Free)</option>
                                    <option value="mustHaveModules" >Must Have</option>
                                    <option value="addonsModules" >Modules purchased on Addons</option> -->
                                    <option value="allModules">All authors</option>
                                    <option value="authorModules[prestashop]">prestashop</option>
                                    <!-- <option value="otherModules" >Other Modules</option> -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- <span>
                        <select class="filter fixed-width-lg" name="country_module_value" id="country_module_value_filter">
                            <option value="0" >All countries</option>
                            <option value="1" >Current country United States</option>
                        </select>
                    </span> -->
                    <!-- <span class="pull-right">
                        <button class="btn btn-default " type="submit" name="resetFilterModules">
                            <i class="icon-eraser"></i>
                            Reset
                        </button>
                        <button class="btn btn-default " name="filterModules" id="filterModulesButton" type="submit">
                            <i class="icon-filter"></i>
                            Filter
                        </button>
                    </span> -->
                </form>
                <!--end filter module-->

            </th>
            </thead>
            <tbody>
            {foreach $repositories as $name=> $repository}
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div>
                            <h3>{$repository.name}
                                <small>
                                    {$repository.version|default:'1.0.0'}
                                </small>
                            </h3>
                            <small>{$repository.author|default:'ntc'|upper}</small>
                            <p>{$repository.description}</p>
                        </div>
                    </td>
                    <td>
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-plus"></span>
                                Install
                            </button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-minus"></span>
                                        Uninstall
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-off"></span>
                                        Enable
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-wrench"></span>
                                        Configure
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-trash"></span>
                                        Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>