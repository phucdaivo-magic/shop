{{-- name: $option['key'] --}}
{{-- value:  $data['form'][$option['key']] --}}
<div class="col-md-9">
    <div>
        @empty($data['form'][$option['key']])
            {{-- Chưa có hình --}}
        @elseif(!isset($data['form'][$option['key']]))
        @else
            <div class="control-image">
                <img src="{{ asset($data['form'][$option['key']]) }}" alt="">
            </div>
        @endif
        <div class="input-group">
            <div class="input-group-prepend" style="flex: 1">
                <span class="input-group-text">
                    <i class="icon-camera"></i>
                </span>
                @if(isset($option['edit']['multiple']) && $option['edit']['multiple'])
                    <div id="{{ $option['key'] }}" style="width: 100%" init-controll="upload"
                        cs-name="{{ $option['key'] }}" cs-multiple="true">
                    </div>
                @else
                    <div id="{{ $option['key'] }}" style="width: 100%" init-controll="upload"
                        cs-name="{{ $option['key'] }}" class="cs-form-upload one">
                    </div>
                @endif

            </div>
        </div>
        @if ($errors->has($option['key']))
            <div class="help-block"> {{ $errors->first($option['key']) }}</div>
        @endif
    </div>
</div>
