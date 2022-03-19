{{-- name   : $option['key']                  --}}
{{-- value  : $data['form'][$option['key']]   --}}
<div class="col-md-9">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="cui-list"></i>
            </span>
        </div>
        <select id="{{$option['key']}}" value="{{ $data['form'][$option['key']] }}" {!! isset($option['edit']['attrs']) ? generateAtribute($option['edit']['attrs']): '' !!} class="form-control" name="{{$option['key']}}" id="{{$option['key']}}">
            @php
                $options = [];
                if(is_callable($option['edit']['dataSource'])) {
                    $options = call_user_func($option['edit']['dataSource'], $data['form']);
                } else {
                    $options = $option['edit']['dataSource'];
                }
            @endphp
            @foreach ($options as $op)
                <option
                    @if($op['id'] == $data['form'][$option['key']])
                    selected
                    @endif
                    value="{{isset($option['edit']['map']) ? $op[$option['edit']['map'][0]] : $op['id']}}">
                    {{isset($option['edit']['map']) ? $op[$option['edit']['map'][1]] : $op['id']}}
                </option>
            @endforeach
        </select>
    </div>
    @if($errors->has($option['key']))
        <div class="help-block"> {{$errors->first($option['key'])}}</div>
    @endif
</div>