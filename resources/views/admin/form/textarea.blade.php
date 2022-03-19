{{-- name: $option['key'] --}}
{{-- value:  $data['form'][$option['key']] --}}
<div class="col-md-9">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="cui-note"></i>
            </span>
        </div>
        <textarea id="{{$option['key']}}" placeholder="{{ isset($option['edit']['placeholder']) ? $option['edit']['placeholder'] : ''}}"
            class="form-control"
            name="{{$option['key']}}" {!! isset($option['edit']['attrs']) ? generateAtribute($option['edit']['attrs']): '' !!}  >{!! $data['form'][$option['key']]!!}</textarea>
    </div>
    @if($errors->has($option['key']))
        <div class="help-block"> {{$errors->first($option['key'])}}</div>
    @endif
</div>