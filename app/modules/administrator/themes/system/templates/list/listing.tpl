<table class="table table-hover">
  <thead>

    <tr>
      <th>--</th>
        {foreach $headings as $head}
        <th>{$head}</th>
        {/foreach}
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="checkbox" name="product[]" value="id"/></td>
      <td>id</td>
      <td>name</td>
      <td>
        <!-- Split button -->
        <div class="btn-group">
          <button type="button" class="btn btn-danger">Action</button>
          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </div>
      </td>
    </tr>
  </tbody>
  <tfoot>
    <tr></tr>
  </tfoot>
</table>