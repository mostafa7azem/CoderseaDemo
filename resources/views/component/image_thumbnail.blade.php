<?php /** @var \Designfy\Template\Models\File $image */ ?>
@if($image->isFound())
    <a href="{{ $image->getUrl() }}" target="_blank">
        <img class="img-thumbnail"
             src="{{ $image->getUrl([$width ?? 150, $height ?? 150]) }}" alt=""/>
    </a>
@else
    <img class="img-thumbnail" width="{{ $width ?? 150 }}" height="{{ $height ?? 150 }}"
         src="{{ $image->getUrl([$width ?? 150, $height ?? 150]) }}" alt=""/>
@endif

