@php
use App\Models\Product;
$productList = Product::get();
@endphp

@php
$categoryList = App\Models\Category::where('home', true)
->orderBy('sort', 'ASC')
->get();

@endphp
@extends('layouts.site')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md d-none d-md-block" style="max-width: 215px">
      @include('site.components.category')
    </div>
    <div class="col-md-7">
      <div id="carouselExampleControls" class="carousel slide card p-2 mt-2" style="border-color: #eee" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://mcdn.nhanh.vn/store/7136/bn/Slide_3.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://mcdn.nhanh.vn/store/7136/bn/Slide_1_.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://mcdn.nhanh.vn/store/7136/bn/Slide_2_.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="col-md d-none d-md-block">
      <div class="card p-2 mt-2">
          <img src="http://shop.phucdaivo.com/public/uploads/editer/images/1649004979_Screen%20Shot%202022-04-03%20at%2023.46.36.png" alt=""  class="w-100 d-block" >
      </div>

    </div>
  </div>
</div>
<div class="div my-4"></div>
<div class="container">
  <img src="http://shop.phucdaivo.com/public/uploads/editer/images/1649003885_Screen Shot 2022-04-03 at 23.35.48.png" class="w-100 d-block" alt="">
</div>
<div class="div my-4"></div>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <img src="https://mcdn.nhanh.vn/store/7136/bn/Banner_doi__Nam_.jpg" class="w-100" alt="">
    </div>
    <div class="col-md-4">
      <img src="https://mcdn.nhanh.vn/store/7136/bn/Banner_doi__Nu__.jpg" class="w-100" alt="">
    </div>
    <div class="col-md-4">
      <img src="https://mcdn.nhanh.vn/store/7136/bn/Banner_doi__Nam_.jpg" class="w-100" alt="">
    </div>
  </div>
</div>
<div class="div my-4"></div>
<div class="container">
  <product-home :next="'{{ route('site.product.all') }}'">
    <h2 class="text-center py-1">S???n ph???m m???i</h2>
  </product-home>
</div>
@foreach ($categoryList as $category)
@if(!$category->url)
<div class="div my-4"></div>
<div class="container">
  <product-home :next="'{{ route('site.category.product', $category->id) }}'">
    <h2 class="text-center py-1">{{ $category->name }}</h2>
  </product-home>
</div>
@endif
@endforeach

<div class="div my-4"></div>
<div class="container">
<img class="w-100 d-block"  src="http://shop.phucdaivo.com/public/uploads/editer/images/1649004276_Screen Shot 2022-04-03 at 23.43.29.png">
</div>

<div class="over-shop">
  <div class="div"></div>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="d-flex">
          <div class="icon mr-2 text-muted" style="font-size: 40px"><i class="pe-7s-car"></i></div>
          <div class="pl-2">
            <div class="display-5 font-weight-bold mb-2">MI???N PH?? GIAO H??NG</div>
            <p class="text-muted">Mi???n ph?? v???n chuy???n ????n ?????t h??ng tr??n 1000.000vn?? n???i th??nh TP.HCM.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="d-flex">
          <div class="icon mr-2 text-muted" style="font-size: 40px"><i class="pe-7s-help2"></i></div>
          <div class="pl-2">
            <div class="display-5 font-weight-bold mb-2">H??? TR??? 24/7</div>
            <p class="text-muted">H??? tr???, t?? v???n kh??ch h??ng 24 gi??? trong ng??y, 7 ng??y trong tu???n.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="d-flex">
          <div class="icon mr-2 text-muted" style="font-size: 40px"><i class="pe-7s-gift"></i></div>
          <div class="pl-2">
            <div class="display-5 font-weight-bold mb-2">S???N PH???M M???I 100%</div>
            <p class="text-muted">S???n ph???m ho??n to??n m???i 100% ch??a qua s??? d???ng, nguy??n seal t??? nh?? s???n xu???t.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="d-flex">
          <div class="icon mr-2 text-muted" style="font-size: 40px"><i class="pe-7s-plane"></i></div>
          <div class="pl-2">
            <div class="display-5 font-weight-bold mb-2">SHIP COD TO??N QU???C</div>
            <p class="text-muted">Giao h??ng v?? thu ti???n t???n n??i tr??n to??n qu???c.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection