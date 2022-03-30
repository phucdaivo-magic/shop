{{-- name: $option['key'] --}}
{{-- value:  $data['form'][$option['key']] --}}
@php
$imageList = App\Models\ProductImage::where('product_id', $data['form']['id'])
    ->orderBy('sort', 'ASC')
    ->get();

  $productPropertyTypeList = App\Models\ProductPropertyType::where('product_id', $data['form']['id'])
    ->orderBy('sort', 'ASC')
    ->with('productPropertyDetails')
    ->get();
@endphp
<div id="form-product" class="col-md-4">
  <product-form
    :images="{{ $imageList }}"
    :properties="{{ $productPropertyTypeList }}"
    get-property-page="{{ route('admin.product.property-type', $data['form']['id']) }}"
    post-image-store="{{ route('admin.api.product.image.store', $data['form']['id']) }}"/>
</div>
