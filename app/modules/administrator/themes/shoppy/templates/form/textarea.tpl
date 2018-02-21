<div class="form-group">
    <label class="control-label col-lg-3 required">
        		<span class="label-tooltip"
                      data-toggle="tooltip" data-html="true" title=""
                      data-original-title="Invalid characters <>;=#{}">{$name|capitalize}
                </span>
    </label>
    <div class="col-lg-9">
        <textarea name="{$name}" class="form-control" rows="3">{$value|default:'&nbsp;'}</textarea>
    </div>
</div>