@push('foot')
    <script>
        let fileUploadScript = {
            $form: $('.dropzone-form'),
            $removeLinks: $('.tour-dz-remove'),
            dropzoneInstance: false,
            uploadComplete: true,
            newFileAdded: function () {
                this.uploadComplete = false;
            },
            fileUploaded: function (file, response) {
                if (parseInt(response.code) === 0) {
                    this.dropzoneInstance.removeFile(file);
                } else {
                    this.addFileInput(response.id, 'file-' + response.id);
                    file.id = response.id;
                }
            },
            removedFileFromList: function (file) {
                this.$form.find('#file-' + file.id).remove();

                $.ajax({
                    url: '{{route('api.files.delete')}}',
                    headers: {
                        "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    },
                    type: 'post',
                    data: {id: file.id},
                });
            },
            addFileInput: function (value, name) {
                this.$form.append('<input type="hidden" id="' + name + '" name="images[]" value="' + value + '" />');
            },
            init: function () {
                console.log('init');
                let $tourDropzone = $('.tour-dropzone');
                Dropzone.autoDiscover = false;
                if (!$tourDropzone.length) {
                    return;
                }

                this.dropzoneInstance = new Dropzone(".tour-dropzone", {
                    url: '{{route('api.files.upload')}}',
                    headers: {
                        "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    },
                    uploadMultiple: false,
                    addRemoveLinks: true,
                    paramName: 'uploadedFile',
                });
                this.dropzoneInstance.on("addedfile", this.newFileAdded.bind(this));
                this.dropzoneInstance.on("success", this.fileUploaded.bind(this));
                this.dropzoneInstance.on("removedfile", this.removedFileFromList.bind(this));
                this.dropzoneInstance.on("maxfilesexceeded", function(file) { this.removeFile(file); });
                this.$removeLinks.click(function (e) {
                    var link = $(e.currentTarget);
                    var id = link.attr('data-id');
                    link.parent().remove();

                    this.removedFileFromList({"id": id});
                }.bind(this));
            }
        };
        fileUploadScript.init();
    </script>
@endpush

<div class="form-group">
    <div class="col-xs-12">
        @if($title ?? '')
            <label class="control-label">{{$title}}
                <span class="required"> * </span>
            </label>
        @endif
        <div class="tour-dropzone dropzone form-control" id="myDropZone" style="height: 100%">
            @foreach(($files ?? []) as $file)
                @include('dashboard::component.attachment-view',['model' => $file])
                <input type="hidden" id="file-{{ $file->id }}" name="images[]" value="{{ $file->id }}"/>
            @endforeach
        </div>
    </div>
</div>
