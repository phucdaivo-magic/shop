
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
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
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
            <h2 class="text-center py-4">Sản phẩm mới</h2>
        </product-home>
    </div>
    @foreach ($categoryList as $category)
        @if(!$category->url)
        <div class="div my-4"></div>
            <div class="container">
                <product-home :next="'{{ route('site.category.product', $category->id) }}'">
                    <h2 class="text-center py-5">{{ $category->name }}</h2>
                </product-home>
            </div>
        @endif
    @endforeach

@endsection
