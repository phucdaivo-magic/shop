{{-- name: $option['key'] --}}
{{-- value:  $data['form'][$option['key']] --}}
<div class="col-md-9">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="icon-pencil"></i>
            </span>
        </div>
        <div data-init-plugin="ckeditor" cs-name="{{$option['key']}}"
            {!! isset($option['edit']['attrs']) ? generateAtribute($option['edit']['attrs']): '' !!}>
            {!! $data['form'][$option['key']] !!}
        </div>
        <textarea hidden name="{{$option['key']}}" id="{{$option['key']}}">{!! $data['form'][$option['key']] !!}</textarea>
    </div>
    @if($errors->has($option['key']))
        <div class="help-block"> {{$errors->first($option['key'])}}</div>
    @endif
</div>