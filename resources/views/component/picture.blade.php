@php
    $size = $size ?? null;
    $classes = $classes ?? 'lazyload';
    $alt = $alt ?? ''
@endphp
<picture>
    <source srcset="{{ $image->getUrl($size, 'webp') }}" type="image/webp">
    <source srcset="{{ $image->getUrl($size) }}" type="{{ $image->getMime() }}">
    <img src="{{ $image->getUrl($size) }}" class="{{$classes}}" alt="{{ $alt }}">
</picture>
