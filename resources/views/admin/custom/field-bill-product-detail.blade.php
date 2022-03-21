<ul class="list-group" style="min-width: 400px">
  <li class="list-group-item d-flex flex-column mt-1">
    <div class="d-flex align-items-start justify-content-between bg-light rounded p-2">
      <span class="d-flex">
        <img class="mr-2" style="width: 70px" src="{{$item->product->avatar }}" alt="">
        <strong class="mx-1" style="min-width: 40px">{{ $item->mount }} x </strong> {{ $item->product->name }}
      </span>
    </div>
    <div class="my-2" style="width: 100%; height: 1px; background: #eee"></div>
    <div class=" bg-light rounded p-2 mb-1">
      - Đơn giá: <strong>{{ getMoney($item->current_price) }}</strong>
    </div>
    @if (!!$item->billProductDetails->count())
      <div class=" bg-light rounded p-2">
        - Chi tiết:
      <ul>
        @foreach ($item->billProductDetails as $billProductDetail)
          <li>{{ $billProductDetail->productPropertyType->name }}: {{  $billProductDetail->productPropertyDetail->name}}</li>
        @endforeach

      </ul>
    @endif
  </div>
  </li>
</ul>