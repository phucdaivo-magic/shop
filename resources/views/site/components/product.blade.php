  {{-- <div class="card border-0">
      <a href="{{ route('site.product.detail', $product->id) }}"><img class="card-img-top"
              src="{{ asset($product->image()->image ?? '') }}" alt="{{ $product->name }}">
      </a>
      <div class="card-body">
          <h5 class="card-title">{{ $product->name }}</h5>
          <p>{{ number_format($product->price) }} VNĐ</p>
      </div>
  </div> --}}
<card-product :product="{{ $product }}" :key="{{ $product->id }}">

</card-product>