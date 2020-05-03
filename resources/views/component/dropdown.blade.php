@push('plugin_css')
    @if(!defined('Select2CssLoaded'))
        <link href="{{ asset('dashboard-assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{ asset('dashboard-assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet"
              type="text/css"/>
        @php
            define('Select2CssLoaded', true);
        @endphp
    @endif

@endpush

@push('foot')
    @if(!defined('Select2ScriptLoaded'))
        <script src="{{asset('dashboard-assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
        <script>
            $('.select2').select2({
                'theme': 'bootstrap'
            });
        </script>
        @php
            define('Select2ScriptLoaded', true);
        @endphp
    @endif
@endpush

@php
    $name     = $name     ?? null;
    $data     = $data     ?? [];
    $selected = $selected ?? null;
    ##############################
    $classes  = $classes  ?? null;
    $prompt   = $prompt   ?? null;
    $multiple = $multiple ?? null;
    $options  = $options  ?? [];
@endphp

<select class="select2 form-control {{ $classes ?? '' }}"
        name="{{ $name }}" {{ $multiple ? 'multiple' : '' }}
@foreach($options as $option => $value)
    @if($value)
        {{ "$option=\"$value\"" }}
        @else
        {{ "$option" }}
        @endif
    @endforeach
>
    @if($prompt)
        <option selected disabled hidden>{{ $prompt }}</option>
    @endif
    @foreach($data ?? [] as $key => $value)
        @if(is_array($value))
            <optgroup label="{{ $key }}">
                @foreach($value ?? [] as $sub_key => $sub_value)
                    <option
                        value="{{ $sub_key }}" {{ $sub_key == ($selected ?? null) ? 'selected' : '' }}>{{$sub_value}}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}" {{ $key == ($selected ?? null) ? 'selected' : '' }}>{{$value}}</option>
        @endif
    @endforeach
</select>
