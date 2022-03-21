<ul class="list-group" style="min-width: 400px">
  @foreach ($item->billProducts as $key => $billProduct)
  <li class="list-group-item d-flex flex-column mt-1">
    <div class="d-flex align-items-start justify-content-between bg-light rounded p-2">
      <span class="d-flex">
        <img class="mr-2" style="width: 70px" src="{{$billProduct->product->avatar }}" alt="">
        <strong class="mx-1" style="min-width: 40px">{{ $billProduct->mount }} x </strong> {{ $billProduct->product->name }}
      </span>
      @switch($billProduct->status)
          @case(0)
          <span class="badge badge-danger badge-pill">Chưa đóng gói</span>
              @break
          @case(1)
          <span class="badge badge-success badge-pill">Đã đóng gói</span>
              @break
          @default

      @endswitch
    </div>
    <div class="my-2" style="width: 100%; height: 1px; background: #eee"></div>
    <div class=" bg-light rounded p-2 mb-1">
      - Đơn giá: <strong>{{ getMoney($billProduct->current_price) }}</strong>
    </div>
    @if (!!$billProduct->billProductDetails->count())
      <div class=" bg-light rounded p-2">
        - Chi tiết:
      <ul>
        @foreach ($billProduct->billProductDetails as $billProductDetail)
          <li>{{ $billProductDetail->productPropertyType->name }}: {{  $billProductDetail->productPropertyDetail->name}}</li>
        @endforeach

      </ul>
    @endif
  </div>
  </li>
  @endforeach
  <li class="list-group-item text-right bg-light">
    Tổng tiền: <strong>{{ getMoney(collect($item->billProducts)->reduce(function($acc, $cur) {
      $acc = $acc + $cur->mount * $cur->current_price;
      return $acc;
    }, 0))}}</strong>
  </li>
  <li class="list-group-item">
    <a href="{{ route('admin.bill.product', [$item->id]) }}" class="btn btn-sm btn-primary text-white">Cập nhật trạng thái sản phẩm</a>
  </li>
</ul>