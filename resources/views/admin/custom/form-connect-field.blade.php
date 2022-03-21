{{-- name: $option['key'] --}}
{{-- value:  $data['form'][$option['key']] --}}
@php
    $imageList = App\Models\ProductImage::where('product_id', $data['form']['product_id'])
      ->get();
@endphp
<div class="col-md-9">
  <div class="input-group w-100">
    <div class="input-group-prepend">
      <span class="input-group-text">
        <i class="cui-pencil"></i>
      </span>
    </div>
    <div class="form-control-image">

      <label class="item-image">
        <input type="radio" name="{{ $option['key'] }}" hidden value="0" @if(!$data['form'][$option['key']]) checked @endif>
        <div class="item-image-show" style="">
          <i class="icons fa fa-check fa-lg"></i>
          <div class="text">
            <strong>Không chọn</strong>
          </div>
        </div>
      </label>
        @foreach ($imageList as $image)
        <label class="item-image">
          <input @if($image->id == $data['form'][$option['key']]) checked @endif type="radio" name="{{ $option['key'] }}" hidden value="{{ $image->id }}">
          <div class="item-image-show" style="background-image: url('{{  $image->avatar }}')">
            <i class="icons fa fa-check fa-lg"></i>
          </div>
        </label>
        @endforeach
    </div>
  </div>
</div>