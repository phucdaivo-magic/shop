@extends('layouts.site')

@section('content')
    <div class="pane-header">
        <h1>Sản phẩm</h1>
    </div>
    <div class="container">
        <h3 class="py-5 font-weight-bold text-center">Danh sách sản phẩm</h3>
        <div class="row">
            <div class="col-md-3 mb-2">
                @include('site.components.category')
            </div>
            <div class="col-md-9">
                <product-category :next="'{{ $loadProduct }}'">
                </product-category>
            </div>
        </div>
    </div>
@endsection
