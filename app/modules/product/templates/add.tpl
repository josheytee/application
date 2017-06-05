<div>
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control"  placeholder="Name" id="name">
        </div>

        <div class="form-group">
            <label for="name">Section</label>
            <select  class="form-control" id="section" >
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control"  placeholder="Price">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" placeholder="description"></textarea>
        </div>


        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image">
            {*<p class="help-block">Example block-level help text here.</p>*}
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox">Available
            </label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>