{{-- name: $option['key'] --}}
{{-- value:  $data['form'][$option['key']] --}}
<div class="col-md-9">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="cui-check"></i>
            </span>
        </div>
        <div class="form-control">
            <label class="switch switch-pill switch-sm switch-success">
                <input id="{{$option['key']}}" name="{{$option['key']}}" class="switch-input" type="checkbox" {!! $data['form'][$option['key']] == 1 ? 'checked=""' : '' !!})>
                <span class="switch-slider"></span>
            </label>
        </div>
    </div>
    @if($errors->has($option['key']))
        <div class="help-block"> {{$errors->first($option['key'])}}</div>
    @endif
</div>