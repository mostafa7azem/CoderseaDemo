<?php
$cssClass = 'dz-file-preview';
if( $model->type == 'image' ){
    $cssClass = 'dz-image-preview';
}
?>

<div class="dz-preview {{ $cssClass }}">

    <div class="dz-image">
        @if( $model->type == 'image' )
            <img data-dz-thumbnail src="{{ $model->getUrl() }}" />
        @endif
    </div>
    <div class="dz-details">
        <div class="dz-filename"><span data-dz-name>{{ $file->title }}</span></div>
        <br/>
        <div>
            <a href="{{ $model->getUrl() }}" target="_blank">
                <i class="icon icon-cloud-download" style="font-size: 40px;cursor: pointer"></i>
            </a>
        </div>
    </div>

    <a class="tour-dz-remove dz-remove" data-id="{{ $file->id }}" href="javascript:;" data-dz-remove="">Remove file</a>
</div>