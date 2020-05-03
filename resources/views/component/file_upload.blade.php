@push('plugin_css')
    @if(!defined('BootstrapFileinputCssLoaded'))
        <link href="{{ asset('dashboard-assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>
        @php
            define('BootstrapFileinputCssLoaded', true);
        @endphp
    @endif
@endpush

@push('script_plugin')
    @if(!defined('BootstrapFileinputJSLoaded'))
        <script src="{{ asset('dashboard-assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"></script>
        @php
            define('BootstrapFileinputJSLoaded', true);
        @endphp
    @endif
@endpush

@php
    $name = $name ?? '';
    $title = $title ?? null;
    $formGroupClasses = $formGroupClasses ?? '';
    $styleMaxHeight = $styleMaxHeight ?? '200px';
    $styleMaxWidth = $styleMaxWidth ?? '200px';
    $fileWidth = $fileWidth ?? '4';
    $labelWidth = $labelWidth ?? '3';
    $required = $required ?? false;
    $accept = $accept ?? null;
@endphp
<div class="form-group @error($name) has-error @enderror">
    @if($title)
        <label class="control-label" for="cover">{{ $title }}@if ($required?? false)<span class="required"> * </span>@endif
            <br/>{{$size??''}}
        </label>
    @endif
    <div class="col-md-{{$fileWidth}}">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="max-width: {{$styleMaxWidth}};max-height: {{$styleMaxHeight }};">
                <img src="{{ $url ?? asset(config('dashboard.default_image_path')) }}" alt=""/>
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: {{$styleMaxWidth}};max-height: {{$styleMaxHeight }};"></div>
            <div>
                <span class="btn default btn-file">
                    <span class="fileinput-new">@lang('Select image')</span>
                    <span class="fileinput-exists">@lang('Change')</span>
                    <input type="file"
                           name="{{ $name }}"
                           {{ $required ? 'required' : '' }}
                           @if($accept) accept="{{$accept}}" @endif>
                </span>
                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> @lang('Remove') </a>
            </div>
        </div>
    </div>
    @error($name)
        <span class="help-block"> {{ $message }} </span>
    @enderror
</div>
