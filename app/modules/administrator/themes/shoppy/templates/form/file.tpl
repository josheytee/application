<div class="form-group">
    <label for="file" class="control-label col-md-3">{$name|namify}</label>
    <div class="col-md-9">
        <input type="file" id="file" class="form-control"/>
        <span style="display: none" id="spinal">
      <i class="fa fa-spinner fa-pulse  fa-fw"></i>
      <span class="sr-only">Loading...</span>
    </span>
        <div class="success">
            {if (isset($value))}
                {foreach $value as $files}
                    <div class="col-xs-6 col-md-3" id="{$name}_' + result.id + '">
                        <input type="hidden" name="{$name}[{$files->id}]" value="{$files->name}">
                        <a href="#" class="thumbnail">
                            <img src="{$files->path}" alt="{$files->name}">
                        </a>
                        <a class="btn btn-default" id="deleteImage" data-{$name}="{$files->id}" href="#">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </div>
                {/foreach}
            {/if}
        </div>
        <div class="error"></div>
    </div>
</div>
<script type="application/javascript">
    $(document).ready(function () {

        var Upload = function (file) {
            this.file = file;
        };
        Upload.prototype.getType = function () {
            return this.file.type;
        };
        Upload.prototype.getName = function () {
            return this.file.name;
        };
        Upload.prototype.getSize = function () {
            return this.file.size;
        };
        Upload.prototype.progressHandling = function (e) {
            var percent = 0;
            var position = e.loaded || e.position;

            var total = e.total;
            var progress_bar_id = '#progress-wrp';
            if (e.lengthComputable) {
                percent = Math.ceil(position / total * 100);
            }
            $(progress_bar_id + ".progress-bar").css("width", +percent + '%');
            $(progress_bar_id + ".status").text(percent + '%');
        };
        Upload.prototype.doUpload = function (url) {
            var that = this;
            var formData = new FormData();
            formData.append('file', this.file, this.getName());
            formData.append('uploaded_file', true);
            formData.append('type', 'cover');
            $.ajax({
                url: url || '{$uploadUrl}',
                data: formData,
                method: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                async: true,
                beforeSend: function (xhr) {
                    $('#spinal').show();
                },
                complete: function (xhr, status) {
                    $('#spinal').hide();
                    $('#file').val('');
                },
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        myXhr.upload.addEventListener('progress', that.progressHandling, false);
                    }
                    return myXhr;
                },
                success: function (result, status, xhr) {
                    // console.log(result);
                    // $('.success').html(result);
                    var image_container = '<div class="col-xs-6 col-md-3" id="{$name}_' + result.id + '">\n' +
                        '                    <input type="hidden" name="{$name}[' + result.id + ']" value="' + result.name + '">\n' +
                        '                    <a href="#" class="thumbnail">\n' +
                        '                        <img src="' + result.path + '" alt="' + result.name + '">\n' +
                        '                    </a>\n' +
                        '                    <a class="btn btn-default" id="deleteImage" data-{$name}="' + result.id + '" href="#">\n' +
                        '                        <i class="fa fa-trash"></i> Delete\n' +
                        '                    </a>\n' +
                        '                </div>';
                    $('.success').append(image_container);
                },
                error: function (xhr, status, error) {
                    console.log(error);
                    console.log(xhr.responseText);
                    console.log(status);

                }
            });
        };

        $("#file").on('change', function (e) {
            var files = e.target.files;
            var upload = new Upload(files[0]);
            //maybe check size or type

            //excute
            upload.doUpload();
        });

        $(".success").on('click', '#deleteImage', function (e) {
            var image_id = $("#deleteImage").data('{$name}');
            $.post('{$deleteUrl}' + image_id,
                null,
                function (data, status) {
                    $("#{$name}_" + image_id).remove();
                    alert("Data: " + data + "\nStatus: " + status);
                    // console.log(data);
                    // $('.error').append(data);
                });
        });
    });
</script>
